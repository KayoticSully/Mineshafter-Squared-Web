<?php if     ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Textures
 * 
 * @author      Ryan Sullivan (kayoticsully@gmail.com)
 */
class Skins extends MS2_Controller {
    
    public function index($skin_name)
    {
        $this->load->helper('array');
        
        // get skin
        $skin = Skin::find_by_name($skin_name);
        
        // make sure skin exists
        if(!$skin) {
            redirect('/textures');
        }
        
        // see if user is logged in
        $user = false;
        if($this->user)
        {
            $user = $this->user;
        }
        
        $this->javascripts = array('Three', 'texture_actions', 'skin-viewer-iso', 'skin-viewer-3d');
        $this->variables = array('skin' => $skin,
                                 'user' => $user);
    }
    
    public function set_active($id)
    {
        $this->protect('user');
        
        // make sure skin exists
        $skin = Skin::find_by_id($id);
        
        if ($skin)
        {
            $data = array('active' => '0');
            Userskin::table()->update($data, array('user_id' => array($this->user->id)));
            $userskin = Userskin::find_by_skin_id_and_user_id($skin->id, $this->user->id);
            
            if(!$userskin)
            {
                $userskin = $this->create_skin_link($this->user->id, $skin->id);
            }
            
            $userskin->active = 1;
            echo $userskin->save();
        }
    }
    
    public function remove_active()
    {
        $this->protect('user');
        
        $data = array('active' => '0');
        Userskin::table()->update($data, array('user_id' => array($this->user->id)));
        
        echo 'true';
    }
    
    public function add_to_library($id)
    {
        $this->protect('User');
        
        // make sure skin exists
        $skin = Skin::find_by_id($id);
        
        if($skin) {
            // make sure its not already in library
            $link = Userskin::find_by_skin_id_and_user_id($skin->id, $this->user->id);
            
            if(!$link) {
                if ($this->create_skin_link($this->user->id, $skin->id))
                {
                    echo 'true';
                }
                else
                {
                    echo 'false';
                }
            }
        }
    }
    
    public function remove_from_library($id)
    {
        $this->protect('User');
        
        // make sure skin exists
        $skin = Skin::find_by_id($id);
        
        if($skin) {
            $link = Userskin::find_by_skin_id_and_user_id($skin->id, $this->user->id);
            
            if($link) {
                echo $link->delete();
            }
        }
    }
    
    private function create_skin_link($user_id, $skin_id)
    {
        $new_link = new Userskin();
        $new_link->skin_id = $skin_id;
        $new_link->user_id = $user_id;
        if ($new_link->save())
        {
            return $new_link;
        }
        else
        {
            return false;
        }
    }
}