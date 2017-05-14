<?php

/*-----------------------------------------------------------------------------------*/
/*	Register Menus
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'sdw_register_menus' ) ) :
    function sdw_register_menus() {
	    register_nav_menu('sdw_main_navigation_menu', __( 'Main Navigation' , THEME_SLUG));
	   	register_nav_menu('sdw_social_menu', __( 'Social menu' , THEME_SLUG));
	    register_nav_menu('sdw_footer_menu', __( 'Footer Menu' , THEME_SLUG));
	    register_nav_menu('sdw_404_menu', __( '404 Menu' , THEME_SLUG));
    }
endif;

?>