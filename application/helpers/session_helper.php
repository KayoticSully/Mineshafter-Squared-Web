<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @name    generate_session_id
 *
 * Generates a game session token used for login
 *
 * @access	public
 * @return	string  session token
 */

// helper functions for this controller
if (! function_exists('generate_session_id'))
{
    function generate_session_id()
    {
        // generate rand num
        srand(time());
        $randNum = rand(1000000000, 2147483647).rand(1000000000, 2147483647).rand(0,9);
        
        if(!User::find_by_session($randNum))
        {
            return $randNum;
        }
        else
        {
            return generate_session_id();
        }
    }
}