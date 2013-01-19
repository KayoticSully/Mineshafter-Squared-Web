<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Server
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class Server extends ActiveRecord\Model {
    static $has_many = array(
        array('Managers'),
        array('Users', 'through' => 'managers')
    );
    
    public function page_link()
    {
        return '/server/' . str_replace(' ', '_', $this->name);
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