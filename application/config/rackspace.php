<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Rackspace Config
 *
 * Credentials and other info for Rackspace API
 */

// the location to authenticate against
$config['identity_url'] = 'https://identity.api.rackspacecloud.com/v2.0';

// login credentials
$config['username']     = 'Your Rackspace Username';
$config['apiKey']       = 'Your API Key';

// CloudFiles specifics
$config['region']       = 'DFW';
$config['container']    = 'Mineshafter Squared Textures';
$config['containerURL'] = '/cdn/textures'; // this is a shortcut to an NGINX proxy_pass location
                                           // This is needed otherwise cross-origin errors will crop up.


/* End of file rackspace.php */
/* Location: ./application/config/rackspace.php */