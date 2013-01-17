<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Server_list
 * 
 * @author      Ryan Sullivan
 */
class Server_list extends MS2_Controller {
    private $min_server_name_length = 8;
    
    public function index()
    {
        //$this->javascripts = array('bootstrap-affix');
        $this->variables = array('servers' => Server::find('all'));
    }
    
    public function test()
    {
        // dns_get_record
        // gethostbyname
        // gethostbyaddr
    }
    
    public function add_new_server()
    {
        $this->protect('user');
        
        $server_name = $this->input->get('serverName');
        // TODO
        $server_address = $this->sanitize_url($this->input->get('serverAddress'));
        $server_description = $this->input->get('serverDescription');
        
        // check for min length
        if (strlen($server_name) < $this->min_server_name_length)
        {
            exit('name too short');
        }
        
        // check for invalid characters
        if (! preg_match('/^(([a-zA-Z]|\d)(\s)?){' . $this->min_server_name_length . ',}$/', $server_name))
        {
            exit('invalid characters');
        }
        
        // check for unique name
        $check = Server::find_by_name($server_name);
        
        if ($check)
        {
            exit("name taken");
        }
        
        // check for valid address
        if (!$this->valid_address($server_address))
        {
           exit("invalid address");
        }
        
        // check for unique address
        $check = Server::find_by_address($server_address);
        
        if ($check)
        {
            exit("address taken");
        }
        
        // create new server
        $server = new Server();
        $server->name           = $server_name;
        $server->address        = $server_address;
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
                echo "manager error";
            }
        }
        else
        {
            echo "server error";
        }
    }
    
    /**
     * Validates a web address (ip or url)
     *
     * @author  Ryan Sullivan (kayoticsully@gmail.com)
     */
    private function valid_address($address)
    {
        if ($this->valid_ip($address))
        {
            return true;
        }
        else if ($this->valid_url($address))
        {
            return $this->valid_address(gethostbyname($address));
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Validates that a URL has proper form
     *
     * @author  Ryan Sullivan (kayoticsully@gmail.com)
     */
    private function valid_url($url)
    {
        return filter_var('http://' . $url, FILTER_VALIDATE_URL);
    }
    
    /**
     * Validates that an IP address has proper form
     *
     * @author  Ryan Sullivan (kayoticsully@gmail.com)
     */
    private function valid_ip($ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE | FILTER_FLAG_NO_PRIV_RANGE);
    }
    
    // TODO
    private function sanitize_url($url) {
        $sanitize = str_replace('http://', '', $url);
        return basename(explode('/', $sanitize)[0]);
    }
}

/* End of file server_list.php */
/* Location: ./application/controllers/server_list.php */