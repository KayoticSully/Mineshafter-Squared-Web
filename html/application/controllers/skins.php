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
            $this->javascripts = array('Three', 'skin-viewer-3d');
            $this->variables = array('skin' => $skin);
        }
    }
}