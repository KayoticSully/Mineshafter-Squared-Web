<?php

/**
 * Rackspace
 * A library helper to load the rackspace
 * API library into CodeIgniter
 */
class Rackspace {
    private $connection = NULL;
    private $CI         = NULL;
    
    function __construct()
    {
        // load dependencies
        require_once 'php-opencloud/lib/php-opencloud.php';
        $this->CI = get_instance();
        
        // setup API connection
        $this->connection = new \OpenCloud\Rackspace(
            $this->CI->config->item('identity_url', 'rackspace'),
            array(
                'username'  => $this->CI->config->item('username', 'rackspace'),
                'apiKey'    => $this->CI->config->item('apiKey', 'rackspace')
            ));
    }
    
    /**
     * Build and return an instance of the cloud files API object
     */
    public function CloudFiles($containerName = NULL)
    {
        $region = $this->CI->config->item('region', 'rackspace');
        
        // connect 
        $cFiles = $this->connection->ObjectStore('cloudFiles', $region);
        
        if($containerName != NULL)
        {
            return $cFiles->Container($containerName);
        }
        else
        {
            return $cFiles;
        }
    }
}
