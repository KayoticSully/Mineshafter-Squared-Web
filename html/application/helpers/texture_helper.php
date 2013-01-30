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
        // create location and move file
        
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