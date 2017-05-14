<?php
/*
Plugin Name: Kohette Framework
Plugin URI:
Description: Load the theme configuration and custom functions & features.
Author: Rafael Martín
Author URI: http://kohette.com/
Version: 1.2.4
*/


class kohette_framework {

    private $theme_config;
    public $prefix;
    public $textdomain;

    function kohette_framework($theme_config) {

            $this->set_fw_constants();
    		    $this->set_theme_config($theme_config);
          	$this->load_framework_functions(); // load custom functions
          	$this->load_framework_modules(); // load framework handy classes
            $this->load_framework_hooks(); // load custom functions
            $this->create_theme_options_page();


    }



    /**
    * set the default constants of the framework
    */
    private function set_fw_constants() {

        /**
        * this defines the path of the resources of the framework
        */
        define("KOHETTE_FW_RESOURCES" , str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, dirname(__FILE__)) . '/resources/');


        /**
        * this define a constant for every folder of the theme directory
        * if the folder is named "the libs" the constant associated will be THEME_THE_LIBS_PATH
        */
        foreach (glob(get_stylesheet_directory() . "/*", GLOB_ONLYDIR) as $filename) {

            $name = basename($filename);
            $name = str_replace(' ', '_', $name);
            $name = str_replace('-', '_', $name);

            define("THEME_"  . strtoupper($name) . '_PATH', $filename);

        };

    }




    /**
    * set the basic configuration of the theme
    */
    private function set_theme_config($theme_config) {

        $this->theme_config = $theme_config;

        /**
        * We create the defined constants for the theme
        */
        if (isset($theme_config['constants'])) {
        foreach($theme_config['constants'] as $item => $value) {

            $this->$item = $theme_config['constants'][$item];
            define("THEME_" . strtoupper($item) , $this->$item);

        }
        }

    }



    /**
    * load framework custom functions
    */
    private function load_framework_functions() {
		include('functions/basic-functions.php');
    }



    /**
    * load framework handy classes
    */
    private function load_framework_modules() {

    	foreach (glob(dirname(__FILE__). "/modules/*", GLOB_ONLYDIR) as $filename) {
        	include('modules/' . basename($filename) . '/' . basename($filename) . '.php') ;
		  };

    }


    /**
    * load framework hooks to improve WordPress
    */
    private function load_framework_hooks() {

        foreach (glob(dirname(__FILE__). "/hooks/*", GLOB_ONLYDIR) as $filename) {
            include('hooks/' . basename($filename) . '/' . basename($filename) . '.php') ;
        };

    }


    /**
    * create the theme options admin page/menu
    */
    private function create_theme_options_page() {

        $args = array();
        $args['id']             = 'theme-options';
        $args['page_title']     = 'Theme Options';
        $args['menu_title']     = 'Theme options';
        $args['page']           = ''; //array( &$this, 'default_theme_options_page');

        $new_admin_page = new KTT_admin_menu($args);



    }

    function default_theme_options_page() {
        global $submenu;

    }



    /**
    * theme activation hook
    */
    function theme_activation_hook() {

        global $pagenow;
        if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {

            set_default_options();

        }
    }



    /**
    * include the plugin file in the theme
    */
    private function run_activate_plugin( $plugin_source ) {
	    include($plugin_source);
	}



	/**
    * load the list of plugins
    */
    function load_plugins($plugins) {

    	require_once(ABSPATH . 'wp-admin/includes/plugin.php');

    	foreach ($plugins as $plugin => $plugin_config) {

    		$plugin_data = get_plugin_data($plugin_config['source']);

    		$this->run_activate_plugin($plugin_config['source']);

    	}

    }




}
