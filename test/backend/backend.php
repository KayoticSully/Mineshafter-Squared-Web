<?php
error_reporting(E_ALL);

//List of Variables used on the site
if(isset($_GET['user'])) $user = htmlentities($_GET['user'],ENT_QUOTES); //Minecraft Username
if(isset($_GET['refresh'])) $refresh = htmlentities($_GET['refresh'],ENT_QUOTES); //Used for refreshing minecraft skins

//Check for hooligans
if(isset($_GET['refresh']) && $user == "") {
	// If this was executed, all skins would be erased.
	echo "Please don't try and glitch things.<br/>\nThanks.";
	exit;
}

function minecraft_skin_3d_part($original, $user, $xpos, $ypos, $width, $height, $texturesize, $name, $flipx, $flipy) {
   $temp = imagecreatetruecolor($texturesize,$texturesize);
   $trans = imagecolorallocatealpha($temp,255,255,255,127);
   $x = $xpos;
   $y = $ypos;
   $w = $width;
   $h = $height;
   imagealphablending($temp, false);
   imagesavealpha($temp, true);
   if($flipx == TRUE && $flipy == TRUE) {
    $xpos = $xpos + $width -1;
	$width = 0 - $width;
	$ypos = $ypos + $height -1;
	$height = 0 - $height;
   } else if($flipx == TRUE) {
    $xpos = $xpos + $width-1;
	$width = 0 - $width;
   } else if($flipy == TRUE) {
	$ypos = $ypos + $height-1;
	$height = 0 - $height;
   }
   //Copy Part To New 'Canvas'
   imagecopyresampled($temp, $original, 0, 0, $xpos, $ypos, $texturesize, $texturesize, $width, $height);
   //Make One-Color Hats Transparent
   $match = imagecolorat($original,$x,$y);
   $transparent = true;
   if(substr($name,0,3) == "hat") {
	for ($x2=$x;$x2<($x+$w);$x2++) {
     for ($y2=$y;$y2<($y+$h);$y2++) {
	  if(imagecolorat($original,$x2,$y2) != $match) {
	   $transparent = false;
	   break 2;
	  }
	 }
	}
   }
   if ($transparent == true && substr($name,0,3) == "hat") {
	imagefilledrectangle($temp,0,0,$texturesize,$texturesize,$trans);
   }
   //Save Image
   imagepng($temp, "images/skins/".$user."/".$name.".png");
   imagedestroy($temp); 
}

function minecraft_skin_download($user) {
 if(!file_exists('images/skins/'.$user.'/base.png')) {
  if(@getimagesize('http://s3.amazonaws.com/MinecraftSkins/'.$user.'.png')) {
   //Make a new directory
   If(!is_dir('images/skins/'.$user)) {
    mkdir('images/skins/'.$user,0777);
   }
   //Download the skin from Minecraft.net and put it in /images/skins/
   $url = 'http://s3.amazonaws.com/MinecraftSkins/'.$user.'.png';
   $img = 'images/skins/'.$user.'/base.png';
   file_put_contents($img, file_get_contents($url));
   
   //Create another image twice the size
   $original = imagecreatefrompng('images/skins/'.$user.'/base.png');
   
   /////////////////////////
   // Body Parts (for 3D) //
   /////////////////////////

   minecraft_skin_3d_part($original,$user,40,0,8,8,256,"hat_top", TRUE, TRUE);
   minecraft_skin_3d_part($original,$user,48,0,8,8,256,"hat_bottom", TRUE, FALSE);
   minecraft_skin_3d_part($original,$user,32,8,8,8,256,"hat_left", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,40,8,8,8,256,"hat_front", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,48,8,8,8,256,"hat_right", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,56,8,8,8,256,"hat_back", FALSE, FALSE);
   
   minecraft_skin_3d_part($original,$user,8,0,8,8,256,"head_top", TRUE, TRUE);
   minecraft_skin_3d_part($original,$user,16,0,8,8,256,"head_bottom", TRUE, FALSE);
   minecraft_skin_3d_part($original,$user,0,8,8,8,256,"head_left", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,8,8,8,8,256,"head_front", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,16,8,8,8,256,"head_right", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,24,8,8,8,256,"head_back", FALSE, FALSE);

   minecraft_skin_3d_part($original,$user,20,16,8,4,256,"body_top", TRUE, TRUE);
   minecraft_skin_3d_part($original,$user,28,16,8,4,256,"body_bottom", TRUE, FALSE);
   minecraft_skin_3d_part($original,$user,28,20,4,12,256,"body_right", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,20,20,8,12,256,"body_front", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,16,20,4,12,256,"body_left", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,32,20,8,12,256,"body_back", FALSE, FALSE);

   minecraft_skin_3d_part($original,$user,44,16,4,4,256,"arm_left_top", TRUE, TRUE);
   minecraft_skin_3d_part($original,$user,48,16,4,4,256,"arm_left_bottom", TRUE, FALSE);
   minecraft_skin_3d_part($original,$user,40,20,4,12,256,"arm_left_outer", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,44,20,4,12,256,"arm_left_front", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,48,20,4,12,256,"arm_left_inner", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,52,20,4,12,256,"arm_left_back", FALSE, FALSE);

   minecraft_skin_3d_part($original,$user,44,16,4,4,256,"arm_right_top", FALSE, TRUE);
   minecraft_skin_3d_part($original,$user,48,16,4,4,256,"arm_right_bottom", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,40,20,4,12,256,"arm_right_outer", TRUE, FALSE);
   minecraft_skin_3d_part($original,$user,44,20,4,12,256,"arm_right_front", TRUE, FALSE);
   minecraft_skin_3d_part($original,$user,48,20,4,12,256,"arm_right_inner", TRUE, FALSE);
   minecraft_skin_3d_part($original,$user,52,20,4,12,256,"arm_right_back", TRUE, FALSE);

   minecraft_skin_3d_part($original,$user,4,16,4,4,256,"leg_left_top", TRUE, TRUE);
   minecraft_skin_3d_part($original,$user,8,16,4,4,256,"leg_left_bottom", TRUE, FALSE);
   minecraft_skin_3d_part($original,$user,0,20,4,12,256,"leg_left_outer", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,4,20,4,12,256,"leg_left_front", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,8,20,4,12,256,"leg_left_inner", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,12,20,4,12,256,"leg_left_back", FALSE, FALSE);

   minecraft_skin_3d_part($original,$user,4,16,4,4,256,"leg_right_top", FALSE, TRUE);
   minecraft_skin_3d_part($original,$user,8,16,4,4,256,"leg_right_bottom", FALSE, FALSE);
   minecraft_skin_3d_part($original,$user,8,20,4,12,256,"leg_right_outer", TRUE, FALSE);
   minecraft_skin_3d_part($original,$user,4,20,4,12,256,"leg_right_front", TRUE, FALSE);
   minecraft_skin_3d_part($original,$user,0,20,4,12,256,"leg_right_inner", TRUE, FALSE);
   minecraft_skin_3d_part($original,$user,12,20,4,12,256,"leg_right_back", TRUE, FALSE);
   
   //Release original from memory (Skin from minecraft.net)
   imagedestroy($original);
  }
 }
}

function minecraft_skin_delete($user) {
 rrmdir('images/skins/'.$user);
}

// Functions not created by me
include_once('rmdir.php'); // Script found on php.net that removes all the files in a folder, then the folder itself
?>
