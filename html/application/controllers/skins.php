<?php if     ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Textures
 * 
 * @author      Ryan Sullivan (kayoticsully@gmail.com)
 */
class Skins extends MS2_Controller {
    
    public function index($skin_name)
    {
        $skin = Skin::find_by_name($skin_name);
        
        if ($skin && $this->user && $skin->owner->id == $this->user->id)
        {
            $this->javascripts = array('Three', 'texture_actions', 'skin-viewer-iso', 'skin-viewer-3d');
            $this->variables = array('skin' => $skin, 'user' => $this->user);
        }
    }
    
    public function set_active($id)
    {
        $this->protect('user');
        
        $data = array('active' => '0');
        Userskin::table()->update($data, array('user_id' => array($this->user->id)));
        $userskin = Userskin::find_by_id_and_user_id($id, $this->user->id);
        $userskin->active = 1;
        echo $userskin->save();
    }
    
    public function remove_active()
    {
        $this->protect('user');
        
        $data = array('active' => '0');
        Userskin::table()->update($data, array('user_id' => array($this->user->id)));
        echo 'true';
    }
}