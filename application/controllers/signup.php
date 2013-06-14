<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Signup
 * 
 * @author      Ryan Sullivan
 */
class Signup extends MS2_Controller {
    /**
     * Class Variables
     */
    protected $title            = 'Signup for Mineshafter Squared';
    
    /**
     * @name    index
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Displays the site's signup page
     */
    public function index()
    {
        //$this->javascripts = array('bootstrap-button', 'bootstrap-tab', 'objects/Post', 'jquery-plugins/announcements', 'jquery-plugins/load-and-cache');
        $this->load->helper('form');
        
        $this->variables = array('prefix' => $this->config->item('site_user_prefix', 'mineshaftersquared'));
    }
}

/* End of file signup.php */
/* Location: ./application/controllers/signup.php */
