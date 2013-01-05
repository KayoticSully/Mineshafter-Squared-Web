<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Download
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class Download extends ActiveRecord\Model {
    static $belongs_to = array(array('Downloadgroup', 'foreign_key' => 'download_group_id'));
}