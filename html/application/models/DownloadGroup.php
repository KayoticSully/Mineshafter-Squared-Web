<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * DownloadGroup
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class DownloadGroup extends ActiveRecord\Model {
    static $table_name = 'download_groups';
    static $has_many = array(array('downloads'));
}