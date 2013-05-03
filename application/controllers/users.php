<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 * 
 * @author      Ryan Sullivan (kayoticsully@gmail.com)
 */
class Users extends MS2_Controller {
    protected $title        = 'User Profile';
    
    /**
     * @name    index
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Displays a server's page
     */
    public function index($name)
    {
        $this->title = $name . '\'s Profile';
        $user = User::find_by_username($name);
        $this->javascripts = array('Three', 'skin-viewer-3d', 'objects/ObjectList', 'objects/Server');
        
        date_default_timezone_set('UTC');
        
        $user_servers   = $user->servers;
        $server_arr     = array();
        foreach($user_servers as $server)
        {
            $server_arr[] = $server->toAssoc();
        }
        
        if($user)
        {
            $this->variables = array(
                'user' => $user,
                'servers' => $server_arr
            );
        }
    }
}
/* End of file users.php */
/* Location: ./application/controllers/users.php */