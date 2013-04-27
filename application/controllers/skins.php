<?php if     ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Textures
 * 
 * @author      Ryan Sullivan (kayoticsully@gmail.com)
 */
class Skins extends MS2_Controller {
    
    private $skin_query_limit = 27;
    
    public function index($skin_name)
    {
        $this->title    =  'Minecraft Skin ' . $skin_name;
        $this->load->helper('array');
        
        // get skin
        $skin = Skin::find_by_name(urldecode($skin_name));
        
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
            $this->load->view('raw', array('raw' => $userskin->save()));
        }
    }
    
    public function remove_active()
    {
        $this->protect('user');
        
        $data = array('active' => '0');
        Userskin::table()->update($data, array('user_id' => array($this->user->id)));
        
        $this->load->view('raw', array('raw' => 'true'));
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
                    $this->load->view('raw', array('raw' => 'true'));
                }
                else
                {
                    $this->load->view('raw', array('raw' => 'false'));
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
                $this->load->view('raw', array('raw' => $link->delete()));
            }
        }
    }
    
    public function json($type, $offset = 0)
    {
        $this->load->helper('array');
        $own_all_skins = FALSE;
        
        // based on type limit initial query
        $skins = array();
        switch ($type)
        {
            case 'public':
                // everything is public for now so we can just grab any set of skins
                $skins = Skin::find('all', array('limit' => $this->skin_query_limit, 'offset' => $offset));
            break;
            
            case 'library':
                if ($this->user)
                {
                    $own_all_skins = TRUE;
                    $skins = Userskin::find('all', array('conditions' => array('user_id = ?', $this->user->id),
                                                         'limit' => $this->skin_query_limit, 'offset' => $offset));
                }
            break;
        }
        
        $logged_in = FALSE;
        if ($this->user)
        {
            $logged_in = TRUE;
        }
        
        // get rackspace information just incase
        $rackspace = $this->config->item('use_rackspace', 'mineshaftersuqared');
        $rsLocation = $this->config->item('containerURL', 'rackspace');
        
        $skins_assoc = array();
        if ($skins)
        {
            foreach($skins as $skin)
            {
                if($skin instanceof Userskin)
                {
                    $skin = $skin->skin;
                }
                
                $skin_assoc = $skin->to_assoc();
                
                if ($own_all_skins || ($logged_in && in_array_id_check($this->user, $skin->users)))
                {
                    $skin_assoc['in_library'] = TRUE;
                }
                else
                {
                    $skin_assoc['in_library'] = FALSE;
                }
                
                $skins_assoc[] = $skin_assoc;
            }
        }
        
        $this->load->view('json', array('json' => $skins_assoc));
    }
    
    public function json_single($id)
    {
        $skin = Skin::find_by_id($id);
        
        if ($skin)
        {
            $this->load->helper('array');
            $skin_assoc = $skin->to_assoc();
            if ($this->user && in_array_id_check($this->user, $skin->users))
            {
                $skin_assoc['in_library'] = TRUE;
            }
            else
            {
                $skin_assoc['in_library'] = FALSE;
            }
            
            $this->load->view('json', array('json' => $skin_assoc));
        }
    }
    
    public function download($skinId)
    {
        $this->load->helper('download');
        $skin = Skin::find_by_id($skinId);
        $texture_location = $skin->base_location();
        $texture_contents = file_get_contents($texture_location);
        $name = $skin->name . '.png';
        
        force_download($name, $texture_contents);
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