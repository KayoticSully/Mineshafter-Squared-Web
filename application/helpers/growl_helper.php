<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
                $CI->load->library('Growl', array('app_name' => $CI->growl_appname));
                $CI->growl->addNotification('New User');
                $CI->growl->addNotification('Proxied Auth');
                $CI->growl->addNotification('Lockout');
                $CI->growl->register($connection);
                $CI->growl_active = TRUE;
            }
            
            $CI->growl->notify($connection, $type, $title, $message);
        }
    }
}