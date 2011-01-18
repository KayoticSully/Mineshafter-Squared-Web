<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Help
 * 
 * @author      Ryan Sullivan
 */
class Community extends MS2_Controller {
    
    public function index()
    {
       $this->javascripts = array('socket.io');
       if($this->user) {
        $userid = $this->user->id;
       }
       else
       {
        $userid = -1;
       }
       $this->variables = array('userid' => $userid);
    }
}

/* End of file community.php */
/* Location: ./application/controllers/community.php */