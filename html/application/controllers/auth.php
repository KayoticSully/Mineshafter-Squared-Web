<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Auth
 * 
 * @author      Ryan Sullivan <kayoticsully@gmail.com>
 */
class Auth extends MS2_Controller {
    
    //Minecraft Auth "API" Variables
    private $mc_auth_url        = 'http://login.minecraft.net';
    private $premium_regex      = "/\b[0-9]{13}\b:\b\w+\b:\S+:\b[0-9|a-z]+\b:\b[0-9|a-z]+\b/";
    private $migration_regex    = "/Account migrated, use e-mail as username./";
    private $free_regex         = "/User not premium/";
    private $bad_regex          = "/Bad login/";
    private $locked_regex       = "/Too many failed logins/";
    
    /**
     * @name    Login
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Handles user login requests
     */
    public function login()
    {
        // get input
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        
        // check against local database
        $user = User::login($username, $password);
        
        // if we got back an error code, handle it
        if(! $user instanceof User)
        {
            switch ($user)
            {
                case BAD_USER:
                    // attempt to add new user
                    $user = $this->addNewUser($username, $password);
                break;
                
                case BAD_INPUT:
                    $user = "Bad Input";
                break;
                
                case BAD_PASSWORD:
                    $user = "Bad Password";
                break;
            }
        }
        
        // Login
        // This check needs to be performed again incase addNewUser
        // is able to verify at Minecraft.net and create a new user
        // account
        if($user instanceof User)
        {
            $this->session->set_userdata('user_id', $user->id);
            $user->last_web_login = time();
            $user->save();
            $this->load->view('raw', array('raw' => 'OK'));
        }
        else
        {
            $this->load->view('raw', array('raw' => $user));
        }
    }
    
    /**
     * @name    Logout
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Handles user logout requests
     */
    public function logout()
    {
        $this->load->helper('url');
        
        $this->session->unset_userdata('user_id');
        
        $dest = $this->input->get('page') ? $this->input->get('page') : '/';
        redirect($dest);
    }
    
    /**
     * @name    Add New User
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Attempts to create a new user
     */
    private function addNewUser($username, $password)
    {
        $bad_count = $this->cache->get("mc-bad-request");
        if($bad_count === FALSE)
        {
            $bad_count = 0;
        }
        
        // if we have already hit our maximum bad request quota
        // block the rest of the function and let the client know.
        if ($bad_count >= 9)
        {
            
            return "locked";
        }
        
        // query MCNet
        $mcnetResponse = $this->queryMCNet($username, $password);
        
        // find a match for the response
        if (preg_match($this->migration_regex, $mcnetResponse) == 1)
        {
            // migration
            return "migrated";
        }
        else if (preg_match($this->premium_regex, $mcnetResponse) == 1 || preg_match($this->free_regex, $mcnetResponse) == 1)
        {
            // get user type
            $usertype = Usertype::find_by_name('User');
            
            // create new user
            $user = new User();
            // set the password
            $user->password     = $password;
            $user->usertype_id  = $usertype->id;
            
            // load email helper
            $this->load->helper('email');
            // check to see if username is an email address
            if (valid_email($username))
            {
                // Mojang account, set email address
                $user->email = $username;
                
                // get username
                $responseArray = explode(':', $mcnetResponse);
                // set username
                $user->username = $responseArray[2];
                
                // must be premium
                $user->premium = 1;
            }
            else
            {
                // normal minecraft account
                $user->username = $username;
                
                // check again for premium, just to keep track of it
                // TODO: Find a better way so we don't have to run this regex twice
                if (preg_match($this->premium_regex, $mcnetResponse) == 1)
                {
                    $user->premium = 1;
                }
                else
                {
                    $user->premium = 0;
                }
            }
            
            $user->save();
            
            // respond with serialized new user
            return $user;
        }
        else if (preg_match($this->bad_regex, $mcnetResponse) == 1)
        {
            // increment and save our bad request
            $bad_count++;
            $this->cache->save("mc-bad-request", $bad_count, 300);
            
            // bad login
            return "bad login : $bad_count";
        }
        else if (preg_match($this->locked_regex, $mcnetResponse) == 1)
        {
            $this->cache->save("mc-bad-request", 10, 300);
            return "locked";
        }
        
        // something went really wrong
        // TODO: Log what happened
    }
    
    /**
     * @name    checkMCNet
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     * 
     * Makes requests to the official minecraft auth servers.
     */
    private function queryMCNet($username, $password)
    {
        $this->load->helper('connection');
        
        // data to send to minecraft.net
        $postParams = "user=".urlencode($username)."&password=".$password."&version=13";
        
        // send the request
        $response = trim(curlGet($this->mc_auth_url, $postParams));
        
        return $response;
    }
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */