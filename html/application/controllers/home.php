<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Home
 * 
 * @author      Ryan Sullivan
 */
class Home extends MS2_Controller {
    /**
     * Class Variables
     */
    private $tumblr_api_url = 'http://api.tumblr.com/v2/blog/';
    private $tumblr_basename = 'mineshaftersquared.tumblr.com';
    private $tumblr_oauth_key = 'qbyWHm4qD00vblTRalf3sO2LRwuAnVqZkh7F6mkhxGVlr6PLow';
    
    /**
     * @name    index
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Displays the site's homepage
     */
    public function index()
    {
        $this->javascripts = array('bootstrap-button', 'bootstrap-tab', 'objects/Post', 'jquery-plugins/announcements', 'jquery-plugins/load-and-cache');
    }
    
    public function test() {
        $connection = array('address' => 'server.mineshaftersquared.com', 'password' => 'testtest');
        
        $this->load->library('Growl');
        $this->growl->addNotification('New User');
        
        $this->growl->register($connection);
        $this->growl->notify($connection, 'New User', 'Some Title', 'Some message to display');
        
        $this->load->view('raw', array('raw' => 'test!'));
    }
    
    /**
     * @name    announcements
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Returns announcement data in JSON form
     */
    public function announcements($limit=1, $offset=0, $type='html')
    {
        $query = array();
        $query['limit'] = $limit;
        $query['offset'] = $offset;
        $cache_key = 'tumblr-posts';
        
        $posts = $this->cache->get($cache_key);
        
        if(! $posts)
        {
            $json = $this->tumblr_request('posts', $query);
            $tumblr = json_decode($json);
            $posts  = $tumblr->response->posts;
            
            // cache for the day
            $this->cache->save($cache_key, $posts, 86400);
        }
        
        switch ($type)
        {
            case 'json':
                $this->load->view('json', array('json' => json_encode($posts)));
            break;
            
            case 'html':
                $this->variables = array('posts' => $posts);
            break;
        }
    }
    
    /**
     * @name    login form
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Displays the user login form
     */
    public function login_form() {
        $this->load->helper('form');
    }
    
    /**
     * @name    tumblr request
     * @author  Ryan Sullivan <kayoticsully@gmail.com>
     *
     * Queries the tumblr api
     */
    private function tumblr_request($method, $properties)
    {
        $query = http_build_query($properties);
        
        $url = $this->tumblr_api_url . $this->tumblr_basename . "/";
        $url .= $method . "?api_key=" . $this->tumblr_oauth_key . '&';
        $url .= $query;
        
        return $this->do_curl($url);
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
