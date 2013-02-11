<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Tag
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class Tag extends ActiveRecord\Model {
    static $has_many = array(
        array('Texturetags'),
        array('Textures', 'through' => 'texturetags')
    );
}