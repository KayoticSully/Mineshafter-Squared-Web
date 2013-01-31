<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Textures
 * 
 * @author      Ryan Sullivan (kayoticsully@gmail.com)
 */
class Textures extends MS2_Controller {
    
    private $texture_folder = 'assets/textures';
    private $texture_basename = 'base.png';
    
    public function index()
    {
        
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
        $this->load->helper('texture');
        
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
        }
        
        $this->load->view('json', array('json' => $result));
    }
    
    public function skin_3d($skin)
    {
        $this->force_shell = TRUE;
        
        $texture = Texture::find_by_location($skin);
        if ($texture)
        {
            $variables = array('location' => '/'.$this->texture_folder.'/'.$texture->file_path());
            $this->javascripts = array('3d/RequestAnimationFrame', '3d/Three');
            $this->extra_js = $this->load->view('textures/skin_script', $variables, TRUE);
            $this->variables = $variables;
        }
        
        $this->variables = $variables;
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
            $location_path = getcwd() . '/' . $this->texture_folder . '/' . texture_file_path($data['raw_name']);
            
            if (! mkdir($location_path, 0777, TRUE))
            {
                return array('error' => 'could not create folder'); 
            }
            
            $new_full_path = $location_path . '/' . $this->texture_basename;
            if (rename($data['full_path'], $new_full_path))
            {
                // update file data info
                $data['file_path'] = $location_path;
                $data['full_path'] = $new_full_path;
                $data['file_name'] = $this->texture_basename;
                $data['raw_name']  = str_replace('.png', '', $this->texture_basename);
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