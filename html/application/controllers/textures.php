<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Textures
 * 
 * @author      Ryan Sullivan (kayoticsully@gmail.com)
 */
class Textures extends MS2_Controller {
    
    public function index()
    {
        
    }
    
    /**
    * @name    form
    * @author  Ryan Sullivan <kayoticsully@gmail.com>
    *
    * Displays the form needed to edit or create a texture file
    */
    public function form()
    {
        $this->load->helper('form');
    }
}
/* End of file textures.php */
/* Location: ./application/controllers/textures.php */