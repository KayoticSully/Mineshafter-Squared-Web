<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Texture Tag
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class Texturetag extends ActiveRecord\Model {
    static $table_name = 'texture_tags';
    static $belongs_to = array(
        array('Texture'),
        array('Tag')
    );
}