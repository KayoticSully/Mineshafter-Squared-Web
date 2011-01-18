<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Server_list
 * 
 * @author      Ryan Sullivan (kayoticsully@gmail.com)
 */
class Server_list extends MS2_Controller {
    /**
     * Class Variables
     */
    private $min_server_name_length = 8;
    protected $title        = 'Minecraft Servers';
    
    /**
     * @name    index
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Displays the server list
     */
    public function index()
    {
        $this->javascripts = array('objects/Server', 'objects/ObjectList');
        
        $this->variables = array('user' => $this->user);
    }
    
    /**
     * @name    json
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Returns JSON representation of the next set of servers
     * in the server starting at the offset.
     */
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
    
    /**
     * @name    remove vote
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Removes the user's vote for a specified server
     */
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
    
    /**
     * @name    up_vote
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Creates a user's vote for the specified server
     */
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
                $this->load->view('raw', array('raw' => 'false'));
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
                    $this->load->view('raw', array('raw' => 'true'));
                }
                else
                {
                    $vote->delete();
                    $this->load->view('raw', array('raw' => 'false'));
                }
            }
        }
        else
        {
            $this->load->view('raw', array('raw' => 'false'));
        }
    }
    
    /**
     * @name    add new server
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Creates a new server in the database
     */
    public function add_new_server()
    {
        $this->protect('user');
        
        $server_name = $this->input->get('name', TRUE);
        $server_address = $this->input->get('address', TRUE);
        $server_description = $this->input->get('description', TRUE);
        
        if ($server_name == '' OR $server_address == '' OR $server_description == '')
        {
            $this->load->view('raw', array('raw' => 'All fields are required'));
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
                $this->load->view('raw', array('raw' => $ex->getMessage()));
                $server = false;
            }
            
            if ($server && $server->save()) {
                // setup manager
                $manager = new Manager();
                $manager->user_id = $this->user->id;
                $manager->server_id = $server->id;
                
                if ($manager->save())
                {
                    $this->load->view('raw', array('raw' => 'OK'));
                }
                else
                {
                    $server->delete();
                    $this->load->view('raw', array('raw' => 'There has been a database error, please report this'));
                }
            }
        }
    }
}

/* End of file server_list.php */
/* Location: ./application/controllers/server_list.php */