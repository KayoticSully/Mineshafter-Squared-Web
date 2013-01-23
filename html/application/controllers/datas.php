<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Data
 * 
 * @author      Ryan Sullivan <kayoticsully@gmail.com>
 */
class Datas extends MS2_Controller {
    
    /**
     * Class Constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->protect('admin');
    }
    
    /**
     * @name    admin
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Admin page to manage site data
     */
    public function admin()
    {
        $this->load->helper('table');
        $this->javascripts = array('editable_table');
        
        $this->variables['datas'] = Data::find('all');
    }
    
    /**
     * @name    save row
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Saves a single row of data to the database
     */
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
    
    /**
     * @name    delete row
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Deletes a single row of data from the database
     */
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