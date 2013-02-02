<?php if     ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Textures
 * 
 * @author      Ryan Sullivan (kayoticsully@gmail.com)
 */
class Textures extends MS2_Controller {
    
    const texture_folder = 'assets/textures';
    const texture_basename = 'base.png';
    
    public function index()
    {
        
        $this->javascripts = array('Three', 'texture_actions', 'skin-viewer-iso', 'skin-viewer-3d');
        
        if (isset($this->user))
        {
            $skins = $this->user->skins;
            //$skins = array_merge($skins, $skins, $skins, $skins, $skins, $skins);
            //$skins = array_merge($skins, $skins, $skins, $skins, $skins, $skins);
        }
        
        if (!isset($skins))
        {
            $skins = array();
        }
        
        $this->variables = array('skins' => $skins, 'user' => $this->user);
        
        if(isset($this->user))
        {
            $this->variables['active_skin'] = $this->user->active_skin();
        }
    }
    
    /**
    * @name    form
    * @author  Ryan Sullivan <kayoticsully@gmail.com>
    *
    * Displays the form needed to edit or create a texture file
    */
    public function form()
    {
        $this->load->helper('form');
    }
    
    public function upload_skin()
    {
        $this->protect('user');
        
        $this->load->helper('texture');
        
        $skin_name = $this->input->post('name');
        if (in_array($skin_name, array('set_active', 'remove_active')))
        {
            $result = array('error' => '???');
        }
        else
        {
            // get highest texture location value
            $location = Data::find_by_key('highest-texture-location');
            $file_name = $location->value;
            $file_name++;
            $location->value = $file_name;
            
            // uploader settings
            $config['allowed_types']    = 'png'; // minecraft textures need to be png's
            $config['max_size']	    = '5';   // most minecraft textures are between 1 - 4 kb
            $config['max_width']        = '64';  // width of a minecraft texture
            $config['max_height']       = '32';  // height of a minecraft texture
            $config['file_name']        = $file_name;
            
            $result = $this->upload($config);
            
            // if success
            if (key_exists('upload_data', $result))
            {
                // save new highest location back to database
                $location->save();
                
                // chop up the skin for 3d view
                chop_skin_for_3d($result['upload_data']);
                
                // Create Skin Record
                $skin = new Skin();
                $skin->name = $skin_name;
                $skin->texture_id = $result['upload_data']['texture_id'];
                $skin->owner_id = $this->user->id;
                if ($skin->save())
                {
                    $result['skin_data']['name'] = $skin->name;
                    
                    // add skin to user's library
                    $user_skin = new Userskin();
                    $user_skin->user_id = $this->user->id;
                    $user_skin->skin_id = $skin->id;
                    if(!$user_skin->save()) {
                        $this->delete_texture($result['upload_data']);
                        $skin->delete();
                        $result = array('error' => '???');
                    }
                }
                else
                {
                    // if save failed delete texture
                    $this->delete_texture($result['upload_data']);
                    $result = array('error' => '???');
                }
            }
        }
        
        $this->load->view('json', array('json' => $result));
    }
    
    private function delete_texture($file_data)
    {
        $texture = Texture::find_by_id($file_data['texture_id']);
        $texture->delete();
        
        // delete images
        unlink($file_data['file_path']);
    }
    
    /**
    * @name    upload
    * @author  Ryan Sullivan <kayoticsully@gmail.com>
    *
    * @param    $config settings for the file uploader
    * @return   error or file data
    * Handles a new file upload and creates a new texture with it
    */
    private function upload($config)
    {
        $config['upload_path']      = './uploads/';
        $config['overwrite']        = TRUE;
        
        $this->load->library('upload', $config);
        
        // try to upload
        if ( ! $this->upload->do_upload())
        {
            return array('error' => $this->upload->display_errors());
        }
        else
        {
            $data = $this->upload->data();
            $hash = md5_file($data['full_path']) . sha1_file($data['full_path']);
            
            // make sure texture has not been uploaded
            $collision = Texture::find_by_hash($hash);
            if ($collision)
            {
                unlink($data['full_path']);
                return array('error' => 'COLLISION'); 
            }
            
            // move file into texture file system
            $location_path = getcwd() . '/' . Textures::texture_folder . '/' . texture_file_path($data['raw_name']);
            
            if (!is_dir($location_path) && !mkdir($location_path, 0777, TRUE))
            {
                return array('error' => 'could not create folder'); 
            }
            
            $new_full_path = $location_path . '/' . Textures::texture_basename;
            if (rename($data['full_path'], $new_full_path))
            {
                // update file data info
                $data['file_path'] = $location_path;
                $data['full_path'] = $new_full_path;
                $data['file_name'] = Textures::texture_basename;
                $data['raw_name']  = str_replace('.png', '', Textures::texture_basename);
            }
            else
            {
                return array('error' => 'could not move file'); 
            }
            
            // create texture database record
            $texture = new Texture();
            $texture->location = $config['file_name'];
            $texture->hash = $hash;
            if (!$texture->save())
            {
                return array('error' => 'could not create texture record');
            }
            
            $data['texture_id'] = $texture->id;
            $data['texture_location'] = $texture->location;
            $data['texture_hash'] = $texture->hash;
            
            return array('upload_data' => $data);
        }
    }
}
/* End of file textures.php */
/* Location: ./application/controllers/textures.php */