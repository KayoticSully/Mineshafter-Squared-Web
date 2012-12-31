<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Update
 * 
 * @author      Ryan Sullivan <kayoticsully@gmail.com>
 */
class Game extends MS2_Controller {
    
    /**
     * @name    update
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     * 
     * @param   $type string Either 'client' or 'server'
     * @return  string version of proxy
     * 
     * Is checked on proxy boot.
     */
    public function update($type)
    {
        echo Data::find_by_key("$type-version")->value;
    }
    
    /**
     * @name    get_version
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * @returns (echoes out) login token string or error message
     * 
     * Is hit for game login.  Performs game authentication for initial login
     */
    public function get_version()
    {
        // get input
        $username = $this->input->post('user');
        $password = $this->input->post('password');
        
        // try to log user in
        $user = User::login($username, $password);
        
        if ($user instanceof User)
        {
            // load in the session helper
            $this->load->helper('session');
            
            // set the user's session token
            $user->session = generate_session_id();
            $user->last_game_login = time();
            $user->save();
            
            // get the current game build
            $game_build = Data::find_by_key('game-build')->value;
            
            // create the login token string and echo it out
            echo $game_build . ':deprecated:' . $user->username . ':' . $user->session;
        }
        else
        {
            // there was an error, lets go handle that
            switch ($user)
            {
                case BAD_INPUT:
                    echo 'Bad input';
                break;
                
                case BAD_PASSWORD:
                    echo 'Invalid password';
                break;
                
                case BAD_USER:
                    echo 'User does not exist';
                break;
            }
        }
    }
}

/* End of file game.php */
/* Location: ./application/controllers/game.php */