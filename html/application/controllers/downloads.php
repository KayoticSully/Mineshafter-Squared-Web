<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Downloads
 * 
 * @author      Ryan Sullivan
 */
class Downloads extends MS2_Controller {
    
    public function admin()
    {
        
    }
    
    public function html()
    {
        $this->variables = array("download_groups" => DownloadGroup::all());
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */