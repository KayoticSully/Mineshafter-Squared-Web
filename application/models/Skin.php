<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Skin
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */

// this is needed since the Textures class constants are used
require_once('application/controllers/textures.php');

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
    
    public function file_path()
    {
        return Textures::texture_folder . '/' . $this->texture->file_path();
    }
    
    public function is_public()
    {
        // kind of hacky, but it works
        require_once('application/helpers/array_helper.php');
        
        // get public tag
        $public = Tag::find_by_name('Public');
        
        // check to see if that tag is related to the skin's texture
        if (in_array_id_check($public, $this->texture->tags))
        {
            return TRUE; 
        }
        else
        {
            return FALSE;
        }
    }
    
    public function to_assoc()
    {
        $skin = array();
        $skin['id']             = $this->id;
        $skin['name']           = $this->name;
        
        if(RACKSPACE)
        {
            $skin['location']   = TEXTURE_CDN.'/'.$this->texture->location.'.png';
        }
        else
        {
            // the forward slash is to force the file to be loaded from the site's
            // url and not the CDN
            $skin['location']   = '/'.$this->base_location();
        }
        
        return $skin;
    }
}