<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * AccountType
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class Usertype extends ActiveRecord\Model {
    // database information
    static $has_many = array(array('Users'));
}