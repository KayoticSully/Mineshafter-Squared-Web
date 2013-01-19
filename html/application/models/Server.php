<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Server
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class Server extends ActiveRecord\Model {
    static $has_many = array(
        array('Managers'),
        array('Servervotes'),
        array('Owners', 'class' => 'User', 'through' => 'managers'),
        array('Votes', 'class' => 'User', 'through' => 'servervotes')
    );
    
    private $min_name_length = 8;
    
    public function page_link()
    {
        return '/server/' . str_replace(' ', '_', $this->name);
    }
    
    public function set_description($description)
    {
        $this->assign_attribute('description', strip_tags($description));
    }
    
    public function set_name($name)
    {
        // check for min length
        if (strlen($name) < $this->min_name_length)
        {
            throw new Exception('The server name is too short, please use a name
                 over ' . $this->min_name_length . ' characters long.');
        }
        
        // check for invalid characters
        if (! preg_match('/^(([a-zA-Z]|\d)(\s)?){' . $this->min_name_length . ',}$/', $name))
        {
            throw new Exception('That server name is not allowed.<br>Please only use alpha-numeric
                  characters (a-z, A-Z, 0-9)');
        }
        
        // check for unique name
        $check_arr = $this->find_by_sql('SELECT * FROM servers WHERE name=?', array($name));
        
        $check = $check_arr[0];
        if ($check && $check->id != $this->id)
        {
            throw new Exception("That server name has already been taken.  Please use a different name");
        }
        
        $this->assign_attribute('name', $name);
    }
    
    public function set_address($address)
    {
        $address_object = parse_url($address);
        
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
            throw new Exception('Server address is invalid.  Please provide a URL that
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
        
        $CI = get_instance();
        $CI->load->helper('address');
        
        // check for valid address
        if (! valid_address($server_address))
        {
            throw new Exception('Server address is invalid.  Please provide a URL that
                  points to your server or the IP address of your server.
                  If you are running your server off this computer, your
                  IP address is ' . $_SERVER['REMOTE_ADDR']);
        }
        
        // check for unique address
        $check_arr = $this->find_by_sql('SELECT * FROM servers WHERE address=? AND port=?',
                                    array($server_address, $server_port));
        
        $check = $check_arr[0];
        if ($check && $check->id != $this->id)
        {
            throw new Exception("This server address and port combination is already in use.");
        }
        
        
        $this->assign_attribute('address', $server_address);
        $this->assign_attribute('port', $server_port);
    }
    
    public function toAssoc()
    {
        $server = array();
        $server['id']          = $this->id;
        $server['name']        = $this->name;
        $server['address']     = $this->address;
        $server['port']        = $this->port;
        $server['page_link']   = $this->page_link();
        $server['description'] = $this->description;
        
        // calulate vote based information
        $votes = $this->votes;
        $server['votes']       = count($votes);
        
        $CI = get_instance();
        $voted = false;
        if(in_array($CI->user, $votes))
        {
            $voted = true;
        }
        
        $server['voted']       = $voted;
        
        return $server;
    }
    
    public function full_address()
    {
        $address = $this->address;
        
        if ($this->port != 25565)
        {
            $address .= ':' . $this->port;
        }
        
        return $address;
    }
}