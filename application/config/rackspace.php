<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Rackspace Config
 *
 * Credentials and other info for Rackspace API
 */

// the location to authenticate against
$config['identity_url'] = 'https://identity.api.rackspacecloud.com/v2.0';

// login credentials
$config['username']     = 'kayoticsullym';
$config['apiKey']       = '717c4058653bcb986b2f95fd15d1b336';

// CloudFiles specifics
$config['region']       = 'DFW';
$config['container']    = 'Mineshafter Squared Textures';
$config['containerURL'] = '/cdn/textures'; // this is a shortcut to an NGINX proxy_pass location
                                           // This is needed otherwise cross-origin errors will crop up.


/* End of file mineshaftersquared.php */
/* Location: ./application/config/mineshaftersquared.php */