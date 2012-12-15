<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Downloads
 * 
 * @author      Ryan Sullivan
 */
class Downloads extends MS2_Controller {
    
    public function admin()
    {
        $this->variables = array("download_groups" => DownloadGroup::all());
    }
    
    public function html()
    {
        $this->variables = array("download_groups" => DownloadGroup::all());
    }
    
    public function edit_group($group_name)
    {
        $group_name = str_replace('_', ' ', $group_name);
        $group = DownloadGroup::find_by_name($group_name);
        
        $this->variables = array("group" => $group);
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */