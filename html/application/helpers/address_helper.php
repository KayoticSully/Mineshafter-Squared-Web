<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Validates a web address (ip or url)
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 * @access  public
 * @param   address url/ip to validate
 * @return  true if valid false otherwise
 */
if ( ! function_exists('valid_address'))
{
    function valid_address($address)
    {
        if (valid_ip($address) OR valid_url($address))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

/**
 * Validates that a URL has proper form
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 * @access  public
 * @param   address url/ip to validate
 * @return  true if valid false otherwise
 */
if ( ! function_exists('valid_url'))
{
    function valid_url($url)
    {
        $ip = gethostbyname($url);
        return valid_ip($ip);
    }
}

/**
 * Validates that an IP address has proper form
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 * @access  public
 * @param   address url/ip to validate
 * @return  true if valid false otherwise
 */
if ( ! function_exists('valid_ip'))
{
    function valid_ip($ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE | FILTER_FLAG_NO_PRIV_RANGE);
    }
}