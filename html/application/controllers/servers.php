<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Server
 * 
 * @author      Ryan Sullivan (kayoticsully@gmail.com)
 */
class Servers extends MS2_Controller {
    /**
     * @name    index
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Displays a server's page
     */
    public function index($name)
    {
        $real_name = str_replace('_', ' ', $name);
        $server = Server::find_by_name($real_name);
        
        if (!$server)
        {
            $this->load->helper('url');
            redirect('/server_list');
        }
        
        $owner = false;
        if ($this->user && $this->in_array_id_check($this->user, $server->owners))
        {
            $owner = true;
        }
        
        $this->javascripts = array('objects/Server', 'bootstrap-alert');
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
        
        // get inputs
        $server_id = $this->input->get('id');
        $server_name = $this->input->get('name');
        $server_address = $this->input->get('address');
        $server_description = $this->input->get('description');
        
        // find server
        $server = Server::find_by_id($server_id);
        // make sure it exists
        if ($server && $this->in_array_id_check($this->user, $server->owners))
        {
            $successful = TRUE;
            try {
                $server->name = $server_name;
                $server->address = $server_address;
                $server->description = $server_description;
            } catch(Exception $ex) {
                echo $ex->getMessage();
                $successful = FALSE;
            }
            
            if ($successful && $server->save())
            {
                echo "OK";
            }
        }
        else
        {
            echo "You do not have rights to this server.";
        }
    }
    
    /**
     * @name    in array id check
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Checks to see if the specified database object is in
     * an array of database objects.
     *
     * @return TRUE if the object is found, FALSE otherwise
     */
    private function in_array_id_check($needle, $haystack)
    {
        foreach($haystack as $hay)
        {
            if($hay->id == $needle->id)
            {
                return true;
            }
        }
        
        return false;
    }
}
/* End of file server.php */
/* Location: ./application/controllers/server.php */