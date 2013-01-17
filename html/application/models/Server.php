<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Server
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class Server extends ActiveRecord\Model {
    static $has_many = array(
        array('Managers'),
        array('Users', 'through' => 'managers')
    );
}