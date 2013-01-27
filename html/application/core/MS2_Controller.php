<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MS2_Controller
 * 
 * @author      Ryan Sullivan
 */
class MS2_Controller extends CI_Controller {
    protected $shell_view       = 'shell';
    protected $application_view = 'layouts/application';
    protected $variables        = array();
    protected $navbar           = 'navs/public';
    
    protected $assets           = array();
    protected $css              = array();
    protected $javascripts      = array();
    
    protected $assets_folder    = 'assets/';
    protected $less_path;
    protected $css_path;
    protected $cache_path;
    protected $javascript_path;
    
    protected $less_ext         = '.less';
    protected $css_ext          = '.css';
    protected $cache_ext        = '.cache';
    protected $javascript_ext   = '.js';
    
    protected $less             = NULL;
    
    protected $page_cache_key;
    protected $page_cache_time  = 60; // seconds
    
    // THIS MAY MOVE TO KEEP THE SUPERCLASS CLEAN
    public $user             = NULL;

    /**
     * __construct
     *
     * The constructor loads any default values that are usually
     * used on every page
     */
    public function __construct()
    {
        parent::__construct();
        
        //----------------------------------------------------
        // Setup derived properties
        //----------------------------------------------------
        $this->less_path        = $this->assets_folder . 'less/';
        $this->css_path         = $this->assets_folder . 'css/';
        $this->cache_path       = $this->less_path     . 'cache/';
        $this->javascript_path  = $this->assets_folder . 'javascript/';
        
        //----------------------------------------------------
        // Set default assets
        //----------------------------------------------------
        $this->assets = array('application', $this->router->fetch_class());
        $this->load->spark('php-activerecord/0.0.2');
        
        //----------------------------------------------------
        // Check if user is logged in
        //----------------------------------------------------
        $user_id = $this->session->userdata('user_id');
        if($user_id)
        {
            $this->user = User::find_by_id($user_id);
        }
        
        //----------------------------------------------------
        // Setup cache
        //----------------------------------------------------
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        
        if (! $this->cache->apc->is_supported())
        {
            $this->load->driver('cache', array('adapter' => 'file'));
        }
        
        //----------------------------------------------------
        // Development setup
        //----------------------------------------------------
        if (ENVIRONMENT == 'development')
        {
            $this->less = new lessc;
            $this->less->setFormatter('lessjs');
            $this->less->setImportDir($this->less_path);
        }
        
        //----------------------------------------------------
        // Production setup
        //----------------------------------------------------
        if (ENVIRONMENT == 'production')
        {
            $cache_key = str_replace('/', '-', $this->router->uri->uri_string);
            
            if (trim($cache_key) == '')
            {
               $cache_key = "home"; 
            }
            
            // cache all pages
            $this->page_cache_key = $cache_key;
            $page = $this->cache->get($this->page_cache_key);
            
            // if page is cached then print it and exit
            if($page)
            {
                echo $page;
                exit(0);
            }
        }
    }
    
    /**
     * _output
     *
     * Controls the final output for ever page.  This function
     * works in revese.  Starting with the page specific content
     * it works at wrapping each layer of the site around it
     * before final display.
     *
     * @param string $output The page specific content that is loaded
     */
    public function _output($output)
    {
        //----------------------------------------------------
        // Some default javascript to include
        //----------------------------------------------------
        $this->javascripts = array_merge($this->javascripts, array('bootstrap-tooltip', 'bootstrap-popover',
                                                                   'bootstrap-dropdown', 'bootstrap-modal',
                                                                   'bootstrap-transition', 'bootstrap-collapse'));
        
        //----------------------------------------------------
        // DEFAULT OUTPUT
        //----------------------------------------------------
        // By default the view at "views/controller/function.php"
        // will be loaded.  Any view rendered within the function
        // completely overrides this behavior.
        //
        if (!$output)
        {
            $view = $this->router->class . '/' . $this->router->method;
            
            if (file_exists(APPPATH.'views/' . $view . '.php'))
            {
                $output = $this->load->view($view, $this->variables, TRUE);
            }
        }
        
        //----------------------------------------------------
        // SPECIAL METHODS
        //----------------------------------------------------
        // There are some special methods that recieve default
        // behavior.
        //
        if ($this->router->method == 'index' || $this->router->method == 'admin')
        {
            //----------------------------------------------------
            // ASSETS
            //----------------------------------------------------
            // Here we run through all asset files and create css / js
            // links for the application to load.
            //
            $css_links = '';
            $asset_force = '';
            foreach (array_merge($this->assets, $this->css) as $less_asset)
            {
                if (ENVIRONMENT == 'development')
                {
                    $this->compile_less($less_asset);
                }
                
                // build file path
                $file_path = $this->css_path . $less_asset . $this->css_ext;
                if (file_exists($file_path))
                {
                    $css_links .= link_tag($file_path . ASSET_FORCE) . "\n";
                }
            }
            
            $javascript_links = '';
            foreach (array_merge($this->assets, $this->javascripts) as $js_asset)
            {
                $file_path = $this->javascript_path . $js_asset . $this->javascript_ext;
                if(file_exists($file_path))
                {
                    $javascript_links .= '<script src="/' . $file_path . ASSET_FORCE . '"></script>'."\n";
                }
            }
            
            //----------------------------------------------------
            // Application Wrapper
            //----------------------------------------------------
            //
            $application_variables['content']       = $output;
            $application_render = $this->load->view($this->application_view, $application_variables, TRUE);
            
            //----------------------------------------------------
            // SHELL
            //----------------------------------------------------
            // This loads the site shell.  The application is
            // loaded into the shell, this is the final output
            // of a page.  The shell contains the top bar, which
            // includes user login and other user account features.
            //
            $this->load->library('user_agent');
            
            $layout_variables['application']        = $application_render;
            $layout_variables['css_links']          = $css_links;
            $layout_variables['javascript_links']   = $javascript_links;
            $layout_variables['navbar']             = $this->navbar;
            $layout_variables['active_menu']        = $this->router->class;
            $layout_variables['user']               = $this->user;
            $layout_variables['browser']            = $this->agent->browser();
            
            $output = $this->load->view($this->shell_view, $layout_variables, TRUE);
        }
        
        if(ENVIRONMENT == "production")
        {
            $this->cache->save($this->page_cache_key, $output, $this->page_cache_time);
        }
        
        echo $output;
    }
    
    /**
     * Makes a cURL request and returns the response
     *
     * @access  protected
     * @author  Ryan Sullivan <ryan@kayoticlabs.com>
     * @param   string $url
     * @return  string
     */
    protected function do_curl($url)
    {
        // create curl resource
        $ch = curl_init();
        
        // set properties
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // execute and get results
        $response = curl_exec($ch);
        
        // cleanup
        curl_close($ch);
        
        return $response;
    }
    
    /**
     * Compiles less to css for a given asset
     * 
     * @access  private
     * @author  Ryan Sullivan <ryan@kayoticlabs.com>
     * @param   string $asset_name Name of the asset to compile
     */
    private function compile_less($asset_name)
    {
        $cache_file = $this->cache_path . $asset_name . $this->cache_ext;
        $less_file  = $this->less_path . $asset_name . $this->less_ext;
        // see if the cache exists
        if (file_exists($cache_file)) // see if there is a cache
        {
            $cache = unserialize(file_get_contents($cache_file));
        }
        else if (file_exists($less_file)) // make sure less file exists
        {
            $cache = $less_file;
        }
        else // nothing to do here
        {
            return null;
        }
        
        // compile file and check cache
        $new_cache = $this->less->cachedCompile($cache);
        
        if (!is_array($cache) OR $new_cache["updated"] > $cache["updated"])
        {
            $output_file = $this->css_path . $asset_name . $this->css_ext;
            file_put_contents($cache_file, serialize($new_cache));
            file_put_contents($output_file, $new_cache['compiled']);
        }
    }
    
    protected function protect($type)
    {
        $this->load->helper('url');
        
        // if not logged in
        if (!$this->user)
        {
            // prevent view
            redirect('');
        }
        
        // if input is direct level use that
        if (is_numeric($type))
        {
            $level = $type;
        }
        else
        {
            // look up usertype level by name
            $usertype = Usertype::find_by_name($type);
            $level = $usertype->level;
        }
        
        // if current user does not have access to specified level
        if ($this->user->type->level > $level)
        {
            // prevent view
            redirect('');
        }
    }
}

/* End of file MS2_Controller.php */
/* Location: ./application/core/MS2_Controller.php */