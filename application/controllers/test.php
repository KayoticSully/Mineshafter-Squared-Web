<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Test
 * 
 * @author      Ryan Sullivan
 */
class Test extends MS2_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * @name    index
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Displays the site's homepage
     */
    public function index()
    {
        $container = $this->rackspace->CloudFiles('Mineshafter Squared Textures');
        
        $list = '';
        $objlist = $container->ObjectList();
        while($object = $objlist->Next()) {
            $list .= sprintf("<p>Object %s size=%u</p>", $object->name, $object->bytes);
        }
        
        $this->load->view('raw', array('raw' => $list));
    }
}