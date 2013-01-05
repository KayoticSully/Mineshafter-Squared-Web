<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class User extends ActiveRecord\Model {
    // database information
    static $belongs_to = array(array('type', 'class_name' => 'Usertype'));
    
    /**
     * @name    Validate
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Validates if a user is in the local database and if the
     * password is the correct one.
     */
    public static function login($username, $password)
    {
        // make sure input is even worth checking
        if (trim($username) != "" && trim($password != ""))
        {
            // try to find user in local database
            
            // load email helper
            $CI = get_instance();
            $CI->load->helper('email');
            
            // check to see if username is an email address
            if (valid_email($username))
            {
                // if username is an email address
                $user = User::find_by_email($username);
            }
            else
            {
                // try and find user by username
                $user = User::find_by_username($username);
            }
            
            if ($user)
            {
                // if user is in database return the user object
                if ($user->check_password($password))
                {
                    return $user;
                }
                else
                {
                    // they exist but the wrong password was given
                    return BAD_PASSWORD;
                }
            }
            else
            {
                // user does not exist in database
                return BAD_USER;
            }
        }
        else
        {
            // we didn't get good input to bother checking
            return BAD_INPUT;
        }
    }
    
    /**
     * @name    Check Password
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Checkes to see if the password provided is the user's
     * password.
     */
    public function check_password($password)
    {
        $salt = substr($this->hashed_password, 0, 64);
        $hash = substr($this->hashed_password, 64, 64);
        
        $password_hash = hash('sha256', $salt . $password);
        
        if ($password_hash == $hash)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    /**
     * @name    Set Password
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Passively runs when password gets set. Used for
     * creating a user or changing a password
     */
    function set_password($plaintext) 
    {
        // generate new salt
        $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        $hash = hash('sha256', $salt . $plaintext);
        
        // save salt and password
        $this->hashed_password = $salt . $hash;
    }
}