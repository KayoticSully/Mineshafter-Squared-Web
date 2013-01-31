<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @name    create_skin_3d_part
 * @author  Ryan Sullivan <kayoticsully@gmail.com>
 * 
 * @access  public
 * @return	
 */

// helper functions for this controller
if (! function_exists('create_skin_3d_part'))
{
    function create_skin_3d_part($original, $location, $xpos, $ypos, $width, $height, $texturesize, $name, $flipx, $flipy)
    {
        $temp = imagecreatetruecolor($texturesize,$texturesize);
        $trans = imagecolorallocatealpha($temp,255,255,255,127);
        $x = $xpos;
        $y = $ypos;
        $w = $width;
        $h = $height;
        
        imagealphablending($temp, false);
        imagesavealpha($temp, true);
        if ($flipx == TRUE && $flipy == TRUE)
        {
            $xpos = $xpos + $width -1;
            $width = 0 - $width;
            $ypos = $ypos + $height -1;
            $height = 0 - $height;
        }
        else if ($flipx == TRUE)
        {
            $xpos = $xpos + $width-1;
            $width = 0 - $width;
        }
        else if($flipy == TRUE)
        {
            $ypos = $ypos + $height-1;
            $height = 0 - $height;
        }
        
        //Copy Part To New 'Canvas'
        imagecopyresampled($temp, $original, 0, 0, $xpos, $ypos, $texturesize, $texturesize, $width, $height);
        //Make One-Color Hats Transparent
        $match = imagecolorat($original,$x,$y);
        $transparent = true;
        
        if (substr($name,0,3) == "hat")
        {
            for ($x2=$x;$x2<($x+$w);$x2++)
            {
                for ($y2=$y;$y2<($y+$h);$y2++)
                {
                    if (imagecolorat($original,$x2,$y2) != $match)
                    {
                        $transparent = false;
                        break 2;
                    }
                }
            }
        }
        
        if ($transparent == true && substr($name,0,3) == "hat")
        {
            imagefilledrectangle($temp,0,0,$texturesize,$texturesize,$trans);
        }
        
        //Save Image
        imagepng($temp, $location."/".$name.".png");
        imagedestroy($temp);
    }
}

/**
 * @name    chop_skin_for_3d
 * @author  Ryan Sullivan <kayoticsully@gmail.com>
 * 
 * @access  public
 * @return	
 */

// helper functions for this controller
if (! function_exists('chop_skin_for_3d'))
{
    function chop_skin_for_3d($file_data)
    {
        //Create another image twice the size
        $original = imagecreatefrompng($file_data['full_path']);
        
        /////////////////////////
        // Body Parts (for 3D) //
        /////////////////////////
     
        create_skin_3d_part($original, $file_data['file_path'], 40, 0, 8, 8, 256, "hat_top", TRUE, TRUE);
        create_skin_3d_part($original, $file_data['file_path'], 48, 0, 8, 8, 256, "hat_bottom", TRUE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 32, 8, 8, 8, 256, "hat_left", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 40, 8, 8, 8, 256, "hat_front", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 48, 8, 8, 8, 256, "hat_right", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 56, 8, 8, 8, 256, "hat_back", FALSE, FALSE);
        
        create_skin_3d_part($original, $file_data['file_path'], 8, 0, 8, 8, 256, "head_top", TRUE, TRUE);
        create_skin_3d_part($original, $file_data['file_path'], 16, 0, 8, 8, 256, "head_bottom", TRUE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 0, 8, 8, 8, 256, "head_left", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 8, 8, 8, 8, 256, "head_front", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 16, 8, 8, 8, 256, "head_right", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 24, 8, 8, 8, 256, "head_back", FALSE, FALSE);
       
        create_skin_3d_part($original, $file_data['file_path'], 20, 16, 8, 4, 256, "body_top", TRUE, TRUE);
        create_skin_3d_part($original, $file_data['file_path'], 28, 16, 8, 4, 256, "body_bottom", TRUE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 28, 20, 4, 12, 256, "body_right", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 20, 20, 8, 12, 256, "body_front", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 16, 20, 4, 12, 256, "body_left", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 32, 20, 8, 12, 256, "body_back", FALSE, FALSE);
       
        create_skin_3d_part($original, $file_data['file_path'], 44, 16, 4, 4, 256, "arm_left_top", TRUE, TRUE);
        create_skin_3d_part($original, $file_data['file_path'], 48, 16, 4, 4, 256, "arm_left_bottom", TRUE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 40, 20, 4, 12, 256, "arm_left_outer", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 44, 20, 4, 12, 256, "arm_left_front", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 48, 20, 4, 12, 256, "arm_left_inner", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 52, 20, 4, 12, 256, "arm_left_back", FALSE, FALSE);
       
        create_skin_3d_part($original, $file_data['file_path'], 44, 16, 4, 4, 256, "arm_right_top", FALSE, TRUE);
        create_skin_3d_part($original, $file_data['file_path'], 48, 16, 4, 4, 256, "arm_right_bottom", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 40, 20, 4, 12, 256, "arm_right_outer", TRUE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 44, 20, 4, 12, 256, "arm_right_front", TRUE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 48, 20, 4, 12, 256, "arm_right_inner", TRUE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 52, 20, 4, 12, 256, "arm_right_back", TRUE, FALSE);
       
        create_skin_3d_part($original, $file_data['file_path'], 4, 16, 4, 4, 256, "leg_left_top", TRUE, TRUE);
        create_skin_3d_part($original, $file_data['file_path'], 8, 16, 4, 4, 256, "leg_left_bottom", TRUE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 0, 20, 4, 12, 256, "leg_left_outer", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 4, 20, 4, 12, 256, "leg_left_front", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 8, 20, 4, 12, 256, "leg_left_inner", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 12, 20, 4, 12, 256, "leg_left_back", FALSE, FALSE);
       
        create_skin_3d_part($original, $file_data['file_path'], 4, 16, 4, 4, 256, "leg_right_top", FALSE, TRUE);
        create_skin_3d_part($original, $file_data['file_path'], 8, 16, 4, 4, 256, "leg_right_bottom", FALSE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 8, 20, 4, 12, 256, "leg_right_outer", TRUE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 4, 20, 4, 12, 256, "leg_right_front", TRUE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 0, 20, 4, 12, 256, "leg_right_inner", TRUE, FALSE);
        create_skin_3d_part($original, $file_data['file_path'], 12, 20, 4, 12, 256, "leg_right_back", TRUE, FALSE);
        
        //Release original from memory (Skin from minecraft.net)
        imagedestroy($original);
    }
}

/**
 * @name    texture_file_path
 * @author  Ryan Sullivan <kayoticsully@gmail.com>
 *
 * Creates a useable filepath from the location string
 * 
 * @access  public
 * @param   $location location string to parse
 * @return	
 */

// helper functions for this controller
if (! function_exists('texture_file_path'))
{
    function texture_file_path($location)
    {
        return substr($location, 0, 3) . '/' . substr($location, 3);
    }
}