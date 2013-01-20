<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Server_list
 * 
 * @author      Ryan Sullivan (kayoticsully@gmail.com)
 */
class Server_list extends MS2_Controller {
    private $min_server_name_length = 8;
    
    public function index()
    {
        $this->javascripts = array('Server', 'ServerList', 'bootstrap-modal', 'bootstrap-transition');
        
        $this->variables = array('user' => $this->user);
    }
    
    public function json($offset)
    {
        $servers = Server::find('all', array('limit' => 5, 'offset' => $offset, 'order' => 'vote_count desc'));
        
        $server_arr = array();
        foreach($servers as $server)
        {
            $server_arr[] = $server->toAssoc();
        }
        
        $this->load->view('json', array('json' => json_encode($server_arr)));
    }
    
    public function remove_vote($id)
    {
        $this->protect('user');
        
        // make sure server exists
        $server = Server::find_by_id($id);
        
        if (!$server)
        {
            exit('false');
        }
        
        // make sure this vote has not been cast
        $user_id = $this->user->id;
        $server_id = $server->id;
        $vote = Servervote::find_by_user_id_and_server_id($user_id, $server_id);
        
        // decrement server count
        $server->vote_count--;
        
        if($vote && $vote->delete() && $server->save()) {
            exit('true');
        } else {
            exit('false');
        }
    }
    
    public function up_vote($id)
    {
        $this->protect('user');
        
        // make sure server exists
        $server = Server::find_by_id($id);
        
        if ($server)
        {
            // make sure this vote has not been cast
            $user_id = $this->user->id;
            $server_id = $server->id;
            $vote = Servervote::find_by_user_id_and_server_id($user_id, $server_id);
            // if they have voted kill script here
            if($vote) {
                echo 'false';
            }
            else
            {
                // log the vote for this user
                $vote = new Servervote();
                $vote->user_id = $user_id;
                $vote->server_id = $server_id;
                
                // increment server count for performance
                $server->vote_count++;
                
                if ($vote->save() && $server->save())
                {
                    echo 'true';
                }
                else
                {
                    $vote->delete();
                    echo 'false'; 
                }
            }
        }
        else
        {
            echo 'false';
        }
    }
    
    public function add_new_server()
    {
        $this->protect('user');
        
        $server_name = $this->input->get('name');
        $server_address = $this->input->get('address');
        $server_description = $this->input->get('description');
        
        if ($server_name == '' OR $server_address == '' OR $server_description == '')
        {
            echo 'All fields are required';
        }
        else
        {
            // create new server
            $server = new Server();
            try {
                $server->name           = $server_name;
                $server->address        = $server_address;
                $server->description    = $server_description;
            } catch (Exception $ex) {
                echo $ex->getMessage();
                $server = false;
            }
            
            if ($server && $server->save()) {
                // setup manager
                $manager = new Manager();
                $manager->user_id = $this->user->id;
                $manager->server_id = $server->id;
                
                if ($manager->save())
                {
                    echo("OK");
                }
                else
                {
                    $server->delete();
                    echo "There has been a database error, please report this";
                }
            }
        }
    }
}

/* End of file server_list.php */
/* Location: ./application/controllers/server_list.php */