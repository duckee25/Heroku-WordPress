<?php 

/*-----------------------------------------------------------------------------------*/
/*	Include functions to handle ajax calls
/*-----------------------------------------------------------------------------------*/


/* Update latest theme version (we use internally for new version introduction text) */

if(!function_exists('sdw_update_version')):
function sdw_update_version(){
	update_option('sdw_theme_version',THEME_VERSION);
	die();
}
endif;

add_action('wp_ajax_sdw_update_version', 'sdw_update_version');

/* Hide welcome screen */

if(!function_exists('sdw_hide_welcome')):
function sdw_hide_welcome(){
	update_option('sdw_welcome_box_displayed', true);
	die();
}
endif;

add_action('wp_ajax_sdw_hide_welcome', 'sdw_hide_welcome');


?>