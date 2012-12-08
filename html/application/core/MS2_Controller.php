<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MS2_Controller
 * 
 * @author      Ryan Sullivan
 */
class MS2_Controller extends CI_Controller {
    protected $shell_view       = 'shell';
    protected $application_view = 'application';
    
    protected $assets            = array();
    protected $css              = array();
    protected $javascripts       = array();
    
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
        // Development setup
        //----------------------------------------------------
        if (ENVIRONMENT == 'development')
        {
            $this->less = new lessc;
            $this->less->setFormatter('lessjs');
            $this->less->setImportDir($this->less_path);
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
        // only ouput full site if controller function is index
        if ($this->router->method == 'index')
        {
            //----------------------------------------------------
            // APPLICATION
            //----------------------------------------------------
            // This loads the application part of the page.  This
            // contains the current page's output and all the
            // navigation for the site.
            //
            $application_variables['content'] = $output;
            $application_render = $this->load->view($this->application_view, $application_variables, TRUE);
            
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
                    $javascript_links .= '<script src="' . $file_path . ASSET_FORCE . '"></script>'."\n";
                }
            }
            
            //----------------------------------------------------
            // SHELL
            //----------------------------------------------------
            // This loads the site shell.  The application is
            // loaded into the shell, this is the final output
            // of a page.  The shell contains the top bar, which
            // includes user login and other user account features.
            //
            $layout_variables['application'] = $application_render;
            $layout_variables['css_links'] = $css_links;
            $layout_variables['javascript_links'] = $javascript_links;
            echo $this->load->view($this->shell_view, $layout_variables, TRUE);
        }
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
        
        // see if the cache exists
        if (file_exists($cache_file))
        {
            $cache = unserialize(file_get_contents($cache_file));
        }
        else
        {
            $cache = $this->less_path . $asset_name . $this->less_ext;
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
}

/* End of file MS2_Controller.php */
/* Location: ./application/core/MS2_Controller.php */