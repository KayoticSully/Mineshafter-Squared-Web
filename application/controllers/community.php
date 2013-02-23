<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Help
 * 
 * @author      Ryan Sullivan
 */
class Community extends MS2_Controller {
    
    public function index()
    {
        $this->javascripts = array('socket.io', 'objects/ObjectList', 'objects/Topic');
        
        if (isset($this->user))
        {
            $uid = $this->get_unique_token();
            
            $this->user->async_token = $uid;
            if (!$this->user->save())
            {
               $uid = 0; 
            }
        }
        else
        {
            $uid = 0; 
        }
        
        $this->variables = array('async_token' => $uid);
    }
    
    private function get_unique_token()
    {
        $uid = uniqid();
        
        if (User::find_by_async_token($uid))
        {
            return $this->get_unique_token();
        }
        else
        {
            return $uid;
        }
    }
}

/* End of file community.php */
/* Location: ./application/controllers/community.php */