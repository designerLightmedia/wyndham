<?php
/**
 * @version $Id$
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright Center for History and New Media, 2010
 * @package Then Now Image Contribution
 */

/**
 * Contribution plugin class
 *
 * @copyright Center for History and New Media, 2010
 * @package Contribution
 */
class ThenNowImagePlugin
{
   
	private static $_hooks = array(
        'install',
        'uninstall',
        'upgrade',
        'define_acl',
        'define_routes',
		'public_theme_header',
		'public_theme_footer'
       
    );

    private static $_filters = array(
      
        'public_navigation_main'
       
		);

    public static $options = array(
        'then_now_image_page_path'
        
    );

    private $_db;

    /**
     * Initializes instance properties and hooks the plugin into Omeka.
     */
    public function __construct()
    {
        $this->_db = get_db();
        $this->addHooksAndFilters();
    }

    /**
     * Centralized location where plugin hooks and filters are added
     */
    public function addHooksAndFilters()
    {
        foreach (self::$_hooks as $hookName) {
            $functionName = Inflector::variablize($hookName);
            add_plugin_hook($hookName, array($this, $functionName));
        }

        foreach (self::$_filters as $filterName) {
            $functionName = Inflector::variablize($filterName);
            add_filter($filterName, array($this, $functionName));
        }
    }

    /**
     * then install hook
     */
    public function install()
    {
        


    }

    /**
     * Contribution uninstall hook
     */
    public function uninstall()
    {
  
    }

    public function upgrade($oldVersion, $newVersion)
    {
        
		
    }

	/**
     * Contribution define_acl hook
     * Restricts access to admin-only controllers and actions.
     */
    public function defineAcl($acl)
    {
        
		
		$resourceList = array(
            'ThenNowImage_ThenNowImage' => array('contribute-then-now-image', 'index', 'terms', 'thankyou', 'type-form')
            
        );
        $acl->loadResourceList($resourceList);
		

        $acl->allow(null, 'ThenNowImage_ThenNowImage');
    }

    /**
     * Contribution define_routes hook
     * Defines public-only routes that set the contribution controller as the
     * only accessible one.
     */
    public function defineRoutes($router)
    {
       
		// at very least you need this to tell it which controller and hence which view for public view
		// as long as this has 'Default' in it
		$router->addRoute('Default',
                new Zend_Controller_Router_Route('then-now-image/:action/*',
                    array('module'     => 'then-now-image',
                          'controller' => 'then-now-image',
                          'action'     => 'contribute-then-now-image')));
		
    }
	
	public function publicThemeHeader($request) {
	
		/* 
			load the two needed JS files in views/public/javascripts/
			that contain loopThroughDiv() method
		*/
		queue_js('jquery.beforeafter-1.4.min');
		queue_js('then-now-image');	
	}

	public function publicThemeFooter($request) {
	
		/*
			called in the footer so as to render the then now effect after page load,
			this calls the method loopThroughDiv() if it finds then now prefix
		*/
		$ok_1 = false;
		$ok_2 = false;
		$prefix_1 = '1_thennow';
		$prefix_2 = '2_thennow';
		$c = 0;
		$img_array = array();
		// get the URL as shown in the browser
		$url = $_SERVER['REQUEST_URI'];
		// if it has the word 'show' in it then we know we are in the items/show area otherwise loop_files_for_item() will error
		if(strstr($url,'show')) {
		
		// create the array with 2 original filenames
		// this loop uses a function loop_files_for_item() and $file->original_filename
			while(loop_files_for_item()){
				$file = get_current_file();
				$extension = pathinfo($file->original_filename, PATHINFO_BASENAME);
				$img_array[$c] = $extension;
				//echo $extension;
				$c++;
			}
			// if the trigger is found in the 1st image
			if(strstr($img_array[0],$prefix_1) || strstr($img_array[0],$prefix_2)) {
				$ok_1 = true;
			}
			// if the trigger is found in the 2nd image
			if(strstr($img_array[1],$prefix_1) || strstr($img_array[1],$prefix_2)) {
				$ok_2 = true;
			}
			
			if($ok_1 && $ok_2) {
				// call function at end of the page if it found a then now trigger
				echo "<script type=\"text/javascript\">
					loopThroughDiv('$img_array[0]','$img_array[1]');
				</script>";
			}
		
		}
	
	}

    
    /**
     * Append a Contribution entry to the public navigation.
     *
     * @param array $nav
     * @return array
     */
    public function publicNavigationMain($nav)
    {
		// uri should match the name of the view/public/folder
        $nav['Then and Now Image Contribute'] = uri('then-now-image');
		return $nav;
    }
    
    /**
     * Append routes that render element text form input.
     * 
     * @param array $routes
     * @return array
     */
    public function simpleVocabRoutes($routes)
    {
       
    }

   
}
