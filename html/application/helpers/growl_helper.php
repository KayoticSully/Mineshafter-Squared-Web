<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * curlGet
 *
 * Sends a CURL get request to specified url
 *
 * @access	public
 * @param	string  url to send request to
 * @param	string	parameters to send
 * @param	number	port to send request to
 * @return	string  response
 */

if ( ! function_exists('growl'))
{
    function growl($type, $title, $message)
    {
        // get CI context
        $CI = get_instance();
        if ($CI->growl_enabled)
        {
            $connection = array('address' => $CI->growl_address, 'password' => $CI->growl_password);
            
            if (!$CI->growl_active)
            {
                $CI->load->library('Growl');
                $CI->growl->addNotification($type);
                $CI->growl->register($connection);
                $CI->growl_active = TRUE;
            }
            
            $CI->growl->notify($connection, $type, $title, $message);
        }
    }
}