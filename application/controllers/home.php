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
    private $tumblr_api_url     = 'http://api.tumblr.com/v2/blog/';
    private $tumblr_basename    = 'mineshaftersquared.tumblr.com';
    private $tumblr_oauth_key   = 'qbyWHm4qD00vblTRalf3sO2LRwuAnVqZkh7F6mkhxGVlr6PLow';
    protected $title            = 'Mineshafter Squared, Free to play, Minecraft proxy';
    
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
        $test = urldecode('a%3A5%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%22a189805ebe3ce09b59807055c0b80914%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A13%3A%22192.168.1.106%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A108%3A%22Mozilla%2F5.0+%28Windows+NT+6.2%3B+WOW64%29+AppleWebKit%2F537.22+%28KHTML%2C+like+Gecko%29+Chrome%2F25.0.1364.84+Safari%2F537.22%22%3Bs%3A13%3A%22last_activity%22%3Bi%3A1360843503%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3B%7D3cf3f67cc9fc86baa8f863d579cf6d33');
        $this->load->view('pre', array('pre' => $this->input->cookie('PHPSESSID')));
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
