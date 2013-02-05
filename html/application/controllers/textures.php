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
        $this->load->helper('array');
        $this->javascripts = array('Three', 'texture_actions', 'skin-viewer-iso', 'skin-viewer-3d', 'objects/ObjectList', 'objects/Texture');
        
        // get other data that is needed
        $default = Data::find_by_key('default-skin');
        $default_skin = Skin::find_by_name($default->value);
        
        // set variables for view
        $this->variables = array('user' => $this->user, 'default_skin' => $default_skin);
        
        if (isset($this->user))
        {
            $this->variables['active_skin'] = $this->user->active_skin();
        }
        else
        {
            $default_skin = Data::find_by_key('default-skin');
            $this->variables['active_skin'] = Skin::find_by_name($default_skin->value);
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
        if (in_array($skin_name, array('index', 'set_active', 'remove_active', 'add_to_library', 'remove_from_library')))
        {
            $result = array('error' => lang('error-disallowed-name'));
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
            $config['max_size']	        = '5';   // most minecraft textures are between 1 - 4 kb
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
                        $result = array('error' => lang('error-db-save'));
                    }
                }
                else
                {
                    // if save failed delete texture
                    $this->delete_texture($result['upload_data']);
                    $result = array('error' => lang('error-db-save'));
                }
            }
        }
        
        $this->load->view('json', array('json' => $result));
    }
    
    /**
    * @name    add_tag
    * @author  Ryan Sullivan <kayoticsully@gmail.com>
    *
    * Adds a the specified tag to a specified texture
    */
    public function add_tag()
    {
        $this->load->helper('string');
        $this->load->helper('inflector');
        
        // get texture in question
        $texture = Texture::find_by_id($this->input->get('texture_id'));
        
        // prepare the result array
        $result = array();
        $result['tags'] = array();
        $result['errors'] = array();
        
        // make sure the texture exists first
        if ($texture)
        {
            // remove typos of multiple commas or commas at the end of the input
            $tags_str = reduce_multiples($this->input->get('tag'), ',', TRUE);
            // strip out quotes
            $tags_str = strip_quotes($tags_str);
            
            // translaste input to array
            $tags = explode(',', $tags_str);
            
            foreach ($tags as $tag_str)
            {
                // format tag
                $tag_name = ucwords(trim($tag_str));
                // get plural
                $tag_name_plural = plural($tags_str);
                
                // build array of variations on tag name
                $possible_names = array();
                $possible_names[] = $tag_name;
                
                // add plural to possible names if it is different
                if ($tag_name !== $tag_name_plural)
                {
                    $possible_names[] = $tag_name_plural;
                }
                
                // see if tag or similar already exists
                $tag = Tag::first(array('conditions' => array('name in (?)', $possible_names)));
                $already_added = false;
                
                if ($tag)
                {
                    $this->load->helper('array');
                    if (in_array_id_check($texture, $tag->textures))
                    {
                        $already_added = true;
                    }
                }
                else
                {
                    // if it is a new tag create it
                    $tag = new Tag();
                    $tag->name = $tag_name;
                    $tag->save();
                }
                
                // add texture to tag
                if(!$already_added)
                {
                    $texture_tag = new Texturetag();
                    $texture_tag->tag_id = $tag->id;
                    $texture_tag->texture_id = $texture->id;
                    $texture_tag->save();
                    
                    $result['tags'][] = $tag->name;
                }
            } // end foreach
        } // end if ($texture)
        else
        {
            echo "fail " . $this->input->get('texture_id');
        }
        
        $this->load->view('json', array('json' => $result));
    }
    
    /**
    * @name    delete_texture
    * @author  Ryan Sullivan <kayoticsully@gmail.com>
    *
    * @param    $file_data data about the texture to delete
    * 
    * Deletes a texture in the database and on disk
    */
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
                $result = array();
                $result['info'] = lang('upload-collision');
                // this is okay for now, but will need to be changed to support capes
                $result['skin_data'] = array('name' => $collision->skins[0]->name);
                return $result;
            }
            
            // move file into texture file system
            $location_path = getcwd() . '/' . Textures::texture_folder . '/' . texture_file_path($data['raw_name']);
            
            if (!is_dir($location_path) && !mkdir($location_path, 0777, TRUE))
            {
                return array('error' => lang('upload-folder-crate') . $location_path); 
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
                return array('error' => lang('upload-move-file') . $data['full_path'] . ' to ' . $new_full_path); 
            }
            
            // create texture database record
            $texture = new Texture();
            $texture->location = $config['file_name'];
            $texture->hash = $hash;
            if (!$texture->save())
            {
                return array('error' => lang('upload-texture-create'));
            }
            
            // give public tag
            $texture->make_public();
            
            $data['texture_id'] = $texture->id;
            $data['texture_location'] = $texture->location;
            $data['texture_hash'] = $texture->hash;
            
            return array('upload_data' => $data);
        }
    }
}
/* End of file textures.php */
/* Location: ./application/controllers/textures.php */