<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Auth
 * 
 * @author      Ryan Sullivan
 */
class Auth extends MS2_Controller {
    
    //Minecraft Auth "API" Variables
    private $mc_auth_url        = 'http://login.minecraft.net';
    private $premium_regex_1    = "/\b[0-9]{13}\b:\b\w+\b:";
    private $premium_regex_2    = ":\b[0-9|a-z]+\b:\b[0-9|a-z]+\b/";
    private $migration_regex    = "/Account migrated, use e-mail as username./";
    private $free_regex         = "/User not premium/";
    private $bad_regex          = "/Bad login/";
    
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
        $user = User::validate($username, $password);
        
        // if we got back an error code, handle it
        if(! $user instanceof User)
        {
            switch ($user)
            {
                case BAD_USER:
                    echo $this->addNewUser($username, $password);
                break;
                
                case BAD_INPUT:
                    echo "Bad Input";
                break;
                
                case BAD_PASSWORD:
                    echo "Bad Password";
                break;
            }
        }
        
        // Login
        if($user instanceof User)
        {
            $this->session->set_userdata('user_id', $user->id);
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
        $this->session->unset_userdata('user_id');
    }
    
    /**
     * @name    Add New User
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Attempts to create a new user
     */
    private function addNewUser($username, $password)
    {
        $mcnetResponse = $this->queryMCNet($username, $password);
        echo $mcnetResponse;
        //echo preg_match($this->premium_regex($username), $mcnetResponse);
        /*
        if (preg_match($this->migration_regex, $mcnetResponse) == 1)
        {
            // migration
            echo "migration";
        }
        else if (preg_match($this->premium_regex($username), $mcnetResponse) == 1 || preg_match($this->free_regex, $mcnetResponse) == 1)
        {
            // create new user
            echo "create new user";
        }
        else if (preg_match($this->bad_regex, $mcnetResponse) == 1)
        {
            // bad login
            echo "bad login";
        }
        */
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
        $postParams = "user=".$username."&password=".$password."&version=13";
        
        // send the request
        $response = trim(curlPost($this->mc_auth_url, $postParams));
        
        return $response;
    }
    
    /**
     * @name    premium regex
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Builds the premium regex
     */
    private function premium_regex($username)
    {
        return $this->premium_regex_1 . $username . $this->premium_regex_2;
    }
}

/* End of file home.php */
/* Location: ./application/controllers/auth.php */