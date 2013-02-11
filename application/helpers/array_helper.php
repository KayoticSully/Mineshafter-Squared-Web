<?php
/**
 * @name    in array id check
 * @author  Ryan Sullivan <kayoticsully@gmail.com>
 *
 * Checks to see if the specified database object is in
 * an array of database objects.
 *
 * @return TRUE if the object is found, FALSE otherwise
 */
if (! function_exists('in_array_id_check'))
{
    function in_array_id_check($needle, $haystack)
    {
        foreach($haystack as $hay)
        {
            if($hay->id == $needle->id)
            {
                return true;
            }
        }
        
        return false;
    }
}

if (! function_exists('array_reduce_objects'))
{
    function array_reduce_objects($array)
    {
        $subset = array();
        foreach ($array as $element)
        {
            if(!in_array_id_check($element, $subset))
            {
                $subset[] = $element;
            }
        }
        
        return $subset;
    }
}