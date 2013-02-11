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

if ( ! function_exists('curlGet'))
{
    function curlGet($url, $parameters='', $port = null)
    {
        // create curl
        $churl = curl_init();
       
        if ($port != null)
        {
            curl_setopt($churl, CURLOPT_PORT, $port);
        }
        
        // add parameters
        curl_setopt($churl, CURLOPT_URL, $url."?".$parameters);
        curl_setopt($churl, CURLOPT_RETURNTRANSFER, true);
        
        // get response
        $response = curl_exec($churl);
        curl_close($churl);
        
        // return response
        return $response;
    }
}