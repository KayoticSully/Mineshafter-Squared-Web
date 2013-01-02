<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Data
 * 
 * @author      Ryan Sullivan
 */
class Datas extends MS2_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->protect('admin');
    }
    
    public function admin()
    {
        $this->variables['datas'] = Data::find('all');
    }
}

/* End of file data.php */
/* Location: ./application/controllers/data.php */