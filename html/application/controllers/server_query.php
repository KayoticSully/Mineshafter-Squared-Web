<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Server Query
 * 
 * @author      Ryan Sullivan (kayoticsully@gmail.com)
 */
class Server_query extends MS2_Controller {
    /**
     * Class Variables
     */
    private $query_cache_time   = 300;
    private $query_timeout      = 2;
    private $default_output     = 'json';
    private $output_options     = array('json', 'pre');
    
    /**
     * @name    run
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Runs a query at the specified server on the specified port
     * and returns data based on the specified filters and output settings
     */
    public function run()
    {
        // get input
        $server_name = $this->input->get('server');
        $server_port = $this->input->get('port');
        $filters     = $this->input->get('filters');
        $output      = $this->input->get('output');
        $realtime    = $this->input->get('realtime');
        
        if ($realtime == FALSE)
        {
            $info = $this->cache->get('query-' . $server_name);
        }
        
        if (!$info)
        {
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
                
                $server = Server::find_by_address_and_port($address, $server_port);
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
            
            try {
                $this->minecraftquery->connect($address, $server_port, 1);
            } catch(Exception $ex) {
                //exit('Error: ' . $ex->getMessage());
            }
            
            // build up return object
            $info = $this->minecraftquery->getInfo();
            $info['PlayerList'] = $this->minecraftquery->getPlayerList();
            $info['Online'] = $this->minecraftquery->isOnline();
            
            $this->cache->save('query-' . $server_name, $info, $this->query_cache_time);
            
            if($server)
            {
                
            }
        }
        
        if ($filters)
        {
            $info = array_intersect_key($info, $this->parse_filters($filters));
        }
        
        if (!in_array($output, $this->output_options))
        {
            $output = $this->default_output;
        }
        
        // print out object as json
        $this->load->view($output, array($output => $info));
    }
    
    /**
     * @name    parse filters
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Takes in a comma separated list and returns an object
     * where each item in the list is the key with a value of TRUE
     */
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