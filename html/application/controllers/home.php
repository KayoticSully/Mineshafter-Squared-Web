<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Home
 * 
 * @author      Ryan Sullivan
 */
class Home extends MS2_Controller {
    
    private $tumblr_api_url = 'http://api.tumblr.com/v2/blog/';
    private $tumblr_basename = 'mineshaftersquared.tumblr.com';
    private $tumblr_oauth_key = 'qbyWHm4qD00vblTRalf3sO2LRwuAnVqZkh7F6mkhxGVlr6PLow';
    
    public function index()
    {
        $this->javascripts = array('bootstrap-button', 'bootstrap-tab', 'post', 'announcements', 'loadAndCache');
    }
    
    public function admin()
    {
        $this->protect('admin');
    }
    
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
    
    public function phpinfo() {
        phpinfo();
    }
    
    public function login_form() {
        
    }
    
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