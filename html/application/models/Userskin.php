<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * AccountType
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class Userskin extends ActiveRecord\Model {
    // database information
    static $table_name = 'user_skins';
    
    static $belongs_to = array(
        array('User'),
        array('Skin')
    );
}