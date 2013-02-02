<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Texture
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class Texture extends ActiveRecord\Model {
    static $has_many = array(
        array('Skins'),
        array('Texturetags'),
        array('Tags', 'through' => 'texturetags')
    );
    
    public function file_path()
    {
        return substr($this->location, 0, 3) . '/' . substr($this->location, 3);
    }
}