<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Downloads
 * 
 * @author      Ryan Sullivan
 */
class Downloads extends MS2_Controller {
    
    /**
     * Class Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * @name    admin
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Admin page to manage downloads
     */
    public function admin()
    {
        $this->protect('admin');
        
        $this->javascripts = array('editable_table');
        $this->variables = array("download_groups" => Downloadgroup::find('all'));
    }
    
    /**
     * @name    html
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Displays html for the download's listing
     */
    public function html()
    {
        $this->variables = array("download_groups" => Downloadgroup::find('all'));
    }
    
    /**
     * @name    save row
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Saves a single download's row
     */
    public function save_row($id)
    {
        $this->protect('admin');
        
        $file = Download::find_by_id($id);
        $file->name = trim($this->input->post('name'));
        $file->link = trim($this->input->post('link'));
        
        if ($file->save())
            echo "true";
        else
            echo "false";
    }
    
    /**
     * @name    delete row
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Deletes a single downlod's row
     */
    public function delete_row($id)
    {
        $this->protect('admin');
        
        $file = Download::find_by_id($id);
        
        if($file->delete())
            echo "true";
        else
            echo "false";
    }
    
    /**
     * @name    edit group
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Displays forms to edit a group of download's
     */
    public function edit_group($group_name)
    {
        $this->protect('admin');
        
        $this->load->helper(array('form', 'table'));
        
        $group_name = str_replace('_', ' ', $group_name);
        $group = Downloadgroup::find_by_name($group_name);
        
        $this->variables = array("group" => $group);
    }
    
    /**
     * @name    admin
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Save's edits to a group of downloads
     */
    public function save_group($id)
    {
        $this->protect('admin');
        
        $group = Downloadgroup::find_by_id($id);
        
        $group->name = trim($this->input->post('name'));;
        $group->version = trim($this->input->post('version'));
        $group->description = trim($this->input->post('description'));
        
        if ($group->save())
            echo "true";
        else
            echo "false";
    }
}

/* End of file downloads.php */
/* Location: ./application/controllers/downloads.php */