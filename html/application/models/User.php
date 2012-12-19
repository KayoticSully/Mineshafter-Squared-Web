<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class User extends ActiveRecord\Model {
    
    /**
     * @name    Validate
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Validates if a user is in the local database and if the
     * password is the correct one.
     */
    public static function validate($username, $password)
    {
        // make sure input is even worth checking
        if (trim($username) != "" && trim($password != ""))
        {
            // try to find user in local database
            $user = User::find_by_username($username);
            
            if ($user)
            {
                // if user is in database return the user object
                if ($user->validate_password($password))
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
}