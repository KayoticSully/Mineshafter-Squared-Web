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
        $this->javascripts = array('bootstrap-button', 'bootstrap-tab', 'post', 'announcements');
        $this->variables = array("download_groups" => DownloadGroup::all());
    }
    
    public function admin()
    {
        
    }
    
    public function announcements($limit=1, $offset=0)
    {
        $query = array();
        $query['limit'] = $limit;
        $query['offset'] = $offset;
        
        echo $this->tumblr_request('posts', $query);
    }
    
    public function phpinfo() {
        phpinfo();
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