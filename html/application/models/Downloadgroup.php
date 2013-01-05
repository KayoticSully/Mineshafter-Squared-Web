<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Downloadgroup
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class Downloadgroup extends ActiveRecord\Model {
    static $table_name = 'download_groups';
    static $has_many = array(array('Downloads', 'foreign_key' => 'download_group_id'));
    
    public function edit_link()
    {
        return '/downloads/edit_group/' . str_replace(' ', '_', $this->name);
    }
}