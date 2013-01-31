<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Skin
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class Skin extends ActiveRecord\Model {
    static $belongs_to = array(
        array('Texture'),
        array('Owner', 'class' => 'User', 'foreign_key' => 'owner_id')
    );
    
    static $has_many = array(
        array('Userskins'),
        array('Users', 'through' => 'userskins'),
    );
    
    public function base_location()
    {
        return Textures::texture_folder . '/' . $this->texture->file_path() . '/' . Textures::texture_basename;
    }
}