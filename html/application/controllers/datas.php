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
        $this->load->helper('table');
        $this->javascripts = array('editable_table');
        
        $this->variables['datas'] = Data::find('all');
    }
    
    public function save_row($id)
    {
        $data = Data::find_by_id($id);
        $data->key = trim($this->input->post('key'));
        $data->value = trim($this->input->post('value'));
        
        if ($data->save())
            echo "true";
        else
            echo "false";
    }
    
    public function delete_row($id)
    {
        $data = Data::find_by_id($id);
        
        if($data->delete())
            echo "true";
        else
            echo "false";
    }
}

/* End of file data.php */
/* Location: ./application/controllers/data.php */