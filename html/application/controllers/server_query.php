<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Server Query
 * 
 * @author      Ryan Sullivan (kayoticsully@gmail.com)
 */
class Server_query extends MS2_Controller {
    
    public function json()
    {
        // get input
        $server_name = $this->input->get('server');
        $server_port = $this->input->get('port');
        $filters     = $this->input->get('filters');
        
        if(!$server_name || $server_name == '')
        {
            exit('Error: No Input');
        }
        
        // see if server name is an address
        $this->load->helper('address');
        if (valid_address($server_name))
        {
            $address = $server_name;
            
            // if port was not set use default minecraft port
            if (! $server_port)
            {
                $server_port = 25565;
            }
        }
        else
        {
            // if its not an address, see if it is a name of a known server
            $server = Server::find_by_name($server_name);
            if ($server)
            {
                $address = $server->address;
                $server_port = $server->port;
            }
            else
            {
                exit("Error: Invalid Server");
            }
        }
        
        // run query
        $this->load->library('Minecraftquery');
        $this->minecraftquery->connect($address, $server_port);
        
        // build up return object
        $info = $this->minecraftquery->getInfo();
        $info['PlayerList'] = $this->minecraftquery->getPlayerList();
        $info['Online'] = $this->minecraftquery->isOnline();
        
        if ($filters)
        {
            $info = array_intersect_key($info, $this->parse_filters($filters));
        }
        
        // print out object as json
        $this->load->view('json', array('json' => $info));
    }
    
    private function parse_filters($filters)
    {
        $filter_arr = explode(',', $filters);
        
        $filter_obj = array();
        foreach ($filter_arr as $filter)
        {
            $filter_obj[$filter] = TRUE;
        }
        
        return $filter_obj;
    }
}
/* End of file server_query.php */
/* Location: ./application/controllers/server_query.php */