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
    	if($type == "server") // Temporary fix (destined to change)
		{
			echo Data::find_by_key("client-version")->value;
		}else{
			echo Data::find_by_key("$type-version")->value;
		}
    }
    
    /**
     * @name    get_version
     * @author  Ryan Sullivan (kayoticsully@gmail.com)
	 * @author  Damiano Amatruda (damihack@facebook.com)
     *
     * @returns (echoes out) login token string or error message
     * 
     * Is hit for game login.  Performs game authentication for initial client login
     */
    public function get_version()
    {
    	// Get input
		$username = $this->input->post('user');
		$password = $this->input->post('password');

        // Checks if it is a Java launcher or an inclusion of the website
		if (strpos($_SERVER['HTTP_USER_AGENT'],"Java") === 0 || strpos($_SERVER['HTTP_USER_AGENT'],$_SERVER['HTTP_HOST']) === 0 || $username != "" || $password != "") {

        
			// Try to log user in
			$user = User::login($username, $password);

			// Sets the JSON type
			header("Content-Type: application/json; charset=UTF-8");
        
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
					exit;
				}
				else
				{
					// there was an error, lets go handle that
					switch ($user)
					{
						case BAD_INPUT:
						break;
                
						case BAD_PASSWORD:
							echo 'Bad login';
						exit; break;
                
						case BAD_USER:
							$this->load->helper('url');
							echo 'Please sign in on the website first';
						exit; break;
					}
				}
		}
		header("HTTP/1.0 404 Not Found");
		include_once("../application/errors/error_404.php");
		exit;
	}
    
    /**
     * @name    join_server
     * @author  Ryan Sullivan (kayoticsully@gmail.com)
     *
     * Second step in multiplayer server logon. (First step
     * is between the server anc the game client). This takes
     * the server id and logs it into the database for the provided
     * user.
     */
    public function join_server()
    {
        // get input
        $username   = $this->input->get('user');
        $session_id = $this->input->get('sessionId');
        $server_id  = $this->input->get('serverId');
        
        // retrieve user info and verify session for user
        $user = User::find_by_username_and_session($username, $session_id);
        
        // if everything is valid
        if ($user)
        {
            // save the server id for the user
            $user->server = $server_id;
            
            if($user->save())
            {   
                // everything saved properly
                echo "OK";
            }
            else
            {
                echo "Problem with login";
            }
        }
        else
        {
            echo "Bad login";
        }
    }
    
    /**
     * @name    check_server
     * @author  Ryan Sullivan (kayoticsully@gmail.com)
     *
     * Third step in the multiplayer logon process.  Server
     * sends up the user and its server id, this is checked against
     * the database to make sure nothing strange is going on
     */
    public function check_server()
    {
        // get input
        $username   = $this->input->get('user');
        $server_id  = $this->input->get('serverId');
        
        // retrieve user info
        $user       = User::find_by_username_and_server($username, $server_id);
        
        if ($user)
        {
            // if everything checks out, let the server know
            // the player is good to go
            echo "YES";
        }
        else
        {
            // if we can't resolve anything check the minecraft servers to keep
            // compatability with non-cracked clients
            $this->load->helper('connection');
            
            // TODO
            // This will be the line of code once the site goes live
            //echo curlPost('http://session.minecraft.net/game/checkserver.jsp', 'user='.$username.'&serverId='.$server_id);
            
            // for now to keep compatibility with the old system we will go through there.
            echo curlPost('http://mineshaftersquared.com/game/checkserver', 'user='.$username.'&serverId='.$server_id);
        }
    }
    
    public function get_skin($username)
    {
        // load up the download helper
        $this->load->helper('download');
        
        // see if the username exists
        $user = User::find_by_username($username);
        
        if ($user)
        {
            $skin = $user->active_skin();
            
            if ($skin)
            {
                // if the active skin is found, grab the file and
                // force it upon the game client.
                $file = $skin->base_location();
                force_download($username . '.png', file_get_contents($file));
            }
        }
    }
}

/* End of file game.php */
/* Location: ./application/controllers/game.php */
