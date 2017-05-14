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
				$args['id'] = ktt_var_name('customize-author-profile');
				$args['page_title'] = __('Author profile',THEME_TEXTDOMAIN);
				$args['page_description'] = __('Customize settings for the post content.', THEME_TEXTDOMAIN);
				$args['menu_title'] = __('Author Profile',THEME_TEXTDOMAIN);
				$args['menu_order'] = 6;
				$args['parent'] = ktt_var_name('customize-page');

				$new_admin_submenu = new KTT_admin_submenu($args);




				// add section 

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('author_profile-section');
				$args['section_name']            	= __('Author pages', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Configure the author page style.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('customize-author-profile');

				$KTT_new_section = new KTT_new_section($args);




				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('author_name_font');
				$args['option_name']            = __('Author name font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style of the author name.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 1;
				$args['option_type_vars']		= array(
													'selector' => '.author-profile-info .author-name ',
													
													//'line_height' => true,
													//'color' => true,
													//'load_all_variants' => true,
													);
				$args['option_default'] 		= array(
													
													);
				$args['option_page']            = ktt_var_name('customize-author-profile');
				$args['option_page_section']    = ktt_var_name('author_profile-section');;

				$KTT_new_setting = new KTT_new_setting($args);



				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('author_bio_font');
				$args['option_name']            = __('Author bio font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style of the author bio.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 2;
				$args['option_type_vars']		= array(
													'selector' => '.author-profile-info .author-desc ',
													'size' => true,
													'line_height' => true,
													//'color' => true,
													//'load_all_variants' => true,
													);
				$args['option_default'] 		= array(
													
													);
				$args['option_page']            = ktt_var_name('customize-author-profile');
				$args['option_page_section']    = ktt_var_name('author_profile-section');;

				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel
/*
				$args                           = array();
				$args['option_id']              = ktt_var_name('post_content_link_colors');
				$args['option_name']            = __('Link color', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the color of the links in the post content.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'colors';
				$args['option_order'] 			= 3;
				$args['option_type_vars']		= array(
													'selector' => '.article-card.squarebig > .inner  .inner .post-subtitle',
													'size' => true,
													'font_style' => true,
													);
				$args['option_default'] 		= array(
													'size' => 22,
													'size_unit' => 'pt',
													);
				$args['option_page']            = ktt_var_name('customize-content-page');
				$args['option_page_section']	= ktt_var_name('post_content-section');

				$KTT_new_setting = new KTT_new_setting($args);
*/





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