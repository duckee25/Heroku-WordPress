<?php
/**
 * Customize options for the theme
 *
 */


if (is_admin()) {

				

		        
				// add page to theme options

				$args = array();
				$args['id'] = ktt_var_name('customize-page');
				$args['page_title'] = __('Customize Options',THEME_TEXTDOMAIN);
				$args['page_description'] = __('Customize settings for post covers.', THEME_TEXTDOMAIN);
				$args['menu_title'] = __('Customize Options',THEME_TEXTDOMAIN);
				$args['menu_order'] = 3;
				$args['parent'] = 'theme-options';

				$new_admin_submenu = new KTT_admin_submenu($args);



}

include('site-general.php');
include('site-frontpage.php');
include('post-covers.php');
include('site-sidebar.php');
include('post-content.php');
include('category-pages.php');
include('author-profile.php');