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
    
    public function save_file($id)
    {
        $file = Download::find_by_id($id);
        $file->name = trim($this->input->post('name'));
        $file->link = trim($this->input->post('link'));
        
        if ($file->save())
            echo "true";
        else
            echo "false";
    }
    
    public function delete_file($id)
    {
        $file = Download::find_by_id($id);
        
        if($file->delete())
            echo "true";
        else
            echo "false";
    }
    
    public function save_group($id)
    {
        $group = DownloadGroup::find_by_id($id);
        
        $group->name = trim($this->input->post('name'));;
        $group->version = trim($this->input->post('version'));
        $group->description = trim($this->input->post('description'));
        
        if ($group->save())
            echo "true";
        else
            echo "false";
    }
}

/* End of file home.php */
/* Location: ./application/controllers/downloads.php */