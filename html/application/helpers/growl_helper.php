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
        $connection = array('address' => $this->growl_address, 'password' => $this->growl_password);
        
        if(!$this->growl_active) {
            $this->load->library('Growl');
            $this->growl->addNotification($type);
            $this->growl->register($connection);
            $this->growl_active = TRUE;
        }
        
        $this->growl->notify($connection, $type, $title, $message);
    }
}