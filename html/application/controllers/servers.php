<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Server
 * 
 * @author      Ryan Sullivan (kayoticsully@gmail.com)
 */
class Servers extends MS2_Controller {
    
    public function index($name)
    {
        $real_name = str_replace('_', ' ', $name);
        $server = Server::find_by_name($real_name);
        
        if (!$server)
        {
            $this->load->helper('url');
            redirect('/server_list');
        }
        
        $this->variables = array('server' => $server);
    }
}
/* End of file server.php */
/* Location: ./application/controllers/server.php */