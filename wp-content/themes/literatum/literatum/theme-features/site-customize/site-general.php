<?php
/**
 * Customize options for the theme
 *
 */




// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


				// add page to theme options

				$args = array();
				$args['id'] = ktt_var_name('customize-general');
				$args['page_title'] = __('General',THEME_TEXTDOMAIN);
				$args['page_description'] = __('Customize the general elements of the theme.', THEME_TEXTDOMAIN);
				$args['menu_title'] = __('General',THEME_TEXTDOMAIN);
				$args['menu_order'] = 1;
				$args['parent'] = ktt_var_name('customize-page');

				$new_admin_submenu = new KTT_admin_submenu($args);




				// add section 

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('site_header-section');
				$args['section_name']            	= __('Site header', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Configure the header of the site.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('customize-general');

				$KTT_new_section = new KTT_new_section($args);




				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('site_header_slogan');
				$args['option_name']            = __('Website slogan font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style of text used as website slogan.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 1;
				$args['option_type_vars']		= array(
													'selector' => 'div.logo .logo-legend',
													'size' => true,
													'line_height' => true,
													//'color' => true,
													//'load_all_variants' => true,
													);
				/*
				$args['option_default'] 		= array(
													'size' => '',
													'size_unit' => '',
													//'color' => '#5f5858',
													);
													*/
				$args['option_page']            = ktt_var_name('customize-general');
				$args['option_page_section']    = ktt_var_name('site_header-section');;

				$KTT_new_setting = new KTT_new_setting($args);






				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('site_main_menu');
				$args['option_name']            = __('Main menu font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style of the main menu displayed in the top right of the page.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 2;
				$args['option_type_vars']		= array(
													'selector' => 'ul.main-menu  li a',
													'size' => true,
													//'line_height' => true,
													//'color' => true,
													//'load_all_variants' => true,
													);
				/*
				$args['option_default'] 		= array(
													'size' => '',
													'size_unit' => '',
													//'color' => '#5f5858',
													);
													*/
				$args['option_page']            = ktt_var_name('customize-general');
				$args['option_page_section']    = ktt_var_name('site_header-section');;

				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_content_color_links');
				$args['option_name']            = __('Content link color', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the color of the links in the post content.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'css_colors';
				$args['option_order'] 			= 3;
				$args['option_type_vars']		= array(
													'link_color' => array(
														'selector' => 'article .entry-content a, .entry-footer a',
														'property' => 'color',
														'label' => __('Link color', THEME_TEXTDOMAIN),
														
														),
													'link_color_hover' => array(
														'selector' => 'article .entry-content a:hover, .entry-footer a:hover',
														'property' => 'color',
														'label' => __('Link color on hover', THEME_TEXTDOMAIN),
														)
												);
				$args['option_default'] 		= array(
													'link_color' => array('value' => '#4169E1'),
													'link_color_hover' => array('value' => '#191970'),
													);
				$args['option_page']            = ktt_var_name('customize-content-page');
				$args['option_page_section']	= ktt_var_name('post_content-section');

				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_content_bottom_info_display');
				$args['option_name']            = __('Bottom info', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Select the post information you want to be displayed under the post content.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'checkboxes';
				$args['option_order'] 			= 5;
				$args['option_type_vars']		= array(
													'categories' => __('Post categories and tags', THEME_TEXTDOMAIN),
													'permalink' => __('Post permalink', THEME_TEXTDOMAIN),
													
													);
				$args['option_default'] 		= array(
													'categories' => 1,
													'permalink' => 1,
													);
				$args['option_page']            = ktt_var_name('customize-content-page');
				$args['option_page_section']	= ktt_var_name('post_content-section');
				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_content_social_share_display');
				$args['option_name']            = __('Bottom share links', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Select the share links you want to be displayed under the post content.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'checkboxes';
				$args['option_order'] 			= 6;
				$args['option_type_vars']		= array(
													'twitter' => __('Twitter', THEME_TEXTDOMAIN),
													'facebook' => __('Facebook', THEME_TEXTDOMAIN),
													
													);
				$args['option_default'] 		= array(
													'twitter' => 1,
													'facebook' => 1,
													);
				$args['option_page']            = ktt_var_name('customize-content-page');
				$args['option_page_section']	= ktt_var_name('post_content-section');
				$KTT_new_setting = new KTT_new_setting($args);





				

}


?>