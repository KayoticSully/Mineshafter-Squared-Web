<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Servers
 * 
 * @author      Ryan Sullivan (kayoticsully@gmail.com)
 */
class Servers extends MS2_Controller {
    protected $title        = 'Minecraft Server';
    
    /**
     * @name    index
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Displays a server's page
     */
    public function index($name)
    {
        $this->title = $name . ' Server';
        $this->load->helper('array');
        $real_name = str_replace('_', ' ', $name);
        $server = Server::find_by_name($real_name);
        
        if (!$server)
        {
            $this->load->helper('url');
            redirect('/server_list');
        }
        
        $owner = false;
        if ($this->user && in_array_id_check($this->user, $server->owners))
        {
            $owner = true;
        }
        
        $this->javascripts = array('objects/Server', 'bootstrap-alert', 'skin-viewer-iso');
        $this->variables = array('server' => $server,
                                 'json' => json_encode($server->toAssoc()),
                                 'owner' => $owner);
    }
    
    /**
     * @name    form
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Displays the form needed to edit or create a server
     */
    public function form($id=0)
    {
        $this->load->helper('form');
        if($id != 0)
        {
            $server = Server::find_by_id($id);
            $this->variables = array('server' => $server);
        }
    }
    
    /**
     * @name    update
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Updates a server's data
     */
    public function update()
    {
        $this->protect('user');
        $this->load->helper('array');
        
        // get inputs
        $server_id = $this->input->get('id');
        $server_name = $this->input->get('name');
        $server_address = $this->input->get('address');
        $server_description = $this->input->get('description');
        
        // find server
        $server = Server::find_by_id($server_id);
        // make sure it exists
        if ($server && in_array_id_check($this->user, $server->owners))
        {
            $successful = TRUE;
            try {
                $server->name = $server_name;
                $server->address = $server_address;
                $server->description = $server_description;
            } catch(Exception $ex) {
                $this->load->view('raw', array('raw' => $ex->getMessage()));
                $successful = FALSE;
            }
            
            if ($successful && $server->save())
            {
                $this->load->view('raw', array('raw' => 'OK'));
            }
        }
        else
        {
            $this->load->view('raw', array('raw' => 'You do not have rights to this server.'));
        }
    }
}
/* End of file server.php */
/* Location: ./application/controllers/server.php */