<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Manager
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class Manager extends ActiveRecord\Model {
    static $belongs_to = array(
        array('User'),
        array('Server')
    );
}