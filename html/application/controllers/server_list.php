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
        $this->javascripts = array('Server', 'ServerList');
        
        $this->variables = array('user' => $this->user);
    }
    
    public function test() {
        if ( ! $foo = $this->cache->get('foo'))
        {
            echo 'Saving to the cache!<br />';
            $foo = 'foobarbaz!';
            
            // Save into the cache for 5 minutes
            $this->cache->save('foo', $foo, 300);
        }
        
        echo $foo;
    }
    
    public function json($offset)
    {
        $servers = Server::find('all', array('limit' => 5, 'offset' => $offset));
        
        $server_arr = array();
        foreach($servers as $server)
        {
            $server_arr[] = $server->toAssoc();
        }
        
        $this->load->view('json', array('json' => json_encode($server_arr)));
    }
    
    public function add_new_server()
    {
        $this->protect('user');
        
        $server_name = $this->input->get('serverName');
        $address_object = parse_url($this->input->get('serverAddress'));
        $server_description = $this->input->get('serverDescription');
        
        // check for min length
        if (strlen($server_name) < $this->min_server_name_length)
        {
            exit('The server name is too short, please use a name
                 over ' . $this->min_server_name_length . ' characters long.');
        }
        
        // check for invalid characters
        if (! preg_match('/^(([a-zA-Z]|\d)(\s)?){' . $this->min_server_name_length . ',}$/', $server_name))
        {
            exit('That server name is not allowed.  Please only use alpha-numeric
                  characters (A-Z upper/lowercase, numbers, and spaces).');
        }
        
        // check for unique name
        $check = Server::find_by_name($server_name);
        
        if ($check)
        {
            exit("That server name has already been taken.  Please use a different name");
        }
        
        // get server address from full address input
        if (array_key_exists('path', $address_object))
        {
            $server_address = $address_object['path'];
        }
        else if (array_key_exists('host', $address_object))
        {
            $server_address = $address_object['host'];
        }
        else
        {
            exit('Server address is invalid.  Please provide a URL that
                  points to your server or the IP address of your server.
                  If you are running your server off this computer, your
                  IP address is ' . $_SERVER['REMOTE_ADDR']);
        }
        
        // make sure we only have the base name
        $server_address_arr = explode('/', $server_address);
        $server_address = $server_address_arr[0];
        
        // get port or set to default
        if (array_key_exists('port', $address_object))
        {
            $server_port = $address_object['port'];
        }
        else
        {
            $server_port = 25565;
        }
        
        $this->load->helper('address');
        
        // check for valid address
        if (! valid_address($server_address))
        {
           exit('Server address is invalid.  Please provide a URL that
                  points to your server or the IP address of your server.
                  If you are running your server off this computer, your
                  IP address is ' . $_SERVER['REMOTE_ADDR']);
        }
        
        // check for unique address
        $check = Server::find_by_address_and_port($server_address, $server_port);
        
        if ($check)
        {
            exit("This server address and port combination is already in use.");
        }
        
        // create new server
        $server = new Server();
        $server->name           = $server_name;
        $server->address        = $server_address;
        $server->port           = $server_port;
        $server->description    = $server_description;
        
        if ($server->save()) {
            // setup manager
            $manager = new Manager();
            $manager->user_id = $this->user->id;
            $manager->server_id = $server->id;
            
            if ($manager->save())
            {
                echo "OK";
            }
            else
            {
                $server->delete();
                echo "There has been a database error, please report this";
            }
        }
        else
        {
            echo "There has been a database error, please report this";
        }
    }
}

/* End of file server_list.php */
/* Location: ./application/controllers/server_list.php */