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
				$args['id'] = ktt_var_name('customize-category-page');
				$args['page_title'] = __('Category pages',THEME_TEXTDOMAIN);
				$args['page_description'] = __('Customize settings for the category pages.', THEME_TEXTDOMAIN);
				$args['menu_title'] = __('Category pages',THEME_TEXTDOMAIN);
				$args['menu_order'] = 5;
				$args['parent'] = ktt_var_name('customize-page');

				$new_admin_submenu = new KTT_admin_submenu($args);




				// add section 

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('category_head-section');
				$args['section_name']            	= __('Category page header', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Configure the header of the category pages.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('customize-category-page');

				$KTT_new_section = new KTT_new_section($args);




				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('category_page_title_font');
				$args['option_name']            = __('Header title font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style of the category title displayed in the header of the category page.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 1;
				$args['option_type_vars']		= array(
													'selector' => '.article-card.category-head .inner a.title',
													);
				$args['option_default'] 		= '';
				$args['option_page']            = ktt_var_name('customize-category-page');
				$args['option_page_section']    = ktt_var_name('category_head-section');;

				$KTT_new_setting = new KTT_new_setting($args);


				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('category_page_subtitle_font');
				$args['option_name']            = __('Header subtitle font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style of the category subtitle displayed in the header of the category page.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 2;
				$args['option_type_vars']		= array(
													'selector' => '.article-card.category-head .inner .description',
													);
				$args['option_default'] 		= '';
				$args['option_page']            = ktt_var_name('customize-category-page');
				$args['option_page_section']    = ktt_var_name('category_head-section');;

				$KTT_new_setting = new KTT_new_setting($args);

















				// add section 

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('category_default_loop-section');
				$args['section_name']            	= __('Category Template: Simple list of articles', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Configure the style of the Simple list of styles template.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('customize-category-page');

				$KTT_new_section = new KTT_new_section($args);




				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('category_default_loop_title_font');
				$args['option_name']            = __('Posts title font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style of the post titles displayed in this category template.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 3;
				$args['option_type_vars']		= array(
													'selector' => '.loop_default-posts-list li .title',
													'color' => true,
													'size' => true,
													'line_height' => true,
													);
				$args['option_default'] 		= array(
													'color' => '#3e3e3e');
				$args['option_page']            = ktt_var_name('customize-category-page');
				$args['option_page_section']    = ktt_var_name('category_default_loop-section');;

				$KTT_new_setting = new KTT_new_setting($args);



				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('category_default_loop_excerpt_font');
				$args['option_name']            = __('Posts excerpt font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style of the post excerpts displayed in this category template.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 4;
				$args['option_type_vars']		= array(
													'selector' => '.loop_default-posts-list li .excerpt',
													'color' => true,
													'size' => true,
													'line_height' => true,
													'font_style' => true
													);
				$args['option_default'] 		= array(
													'color' => '#807070');
				$args['option_page']            = ktt_var_name('customize-category-page');
				$args['option_page_section']    = ktt_var_name('category_default_loop-section');;

				$KTT_new_setting = new KTT_new_setting($args);




				
				// add option to admin panel
				
				$args                           = array();
				$args['option_id']              = ktt_var_name('cateogry_default_loop_meta_info_display');
				$args['option_name']            = __('Display post info', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Select the information you want to appear under the post exceprt.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'checkboxes';
				$args['option_order'] 			= 7;
				$args['option_type_vars']		= array(
													'date' => __('Post date', THEME_TEXTDOMAIN),
													'author' => __('Post author', THEME_TEXTDOMAIN),
													'comments' => __('Post comments', THEME_TEXTDOMAIN),
													);
				$args['option_default'] 		= array(
													'date' => 1,
													'author' => 1,
													'comments' => 1,
													);
				$args['option_page']            = ktt_var_name('customize-category-page');
				$args['option_page_section']	= ktt_var_name('post_default_loop-section');

				if (function_exists('KTT_show_post_read_time_is_active') && KTT_show_post_read_time_is_active()) {
					$args['option_type_vars']['read_time'] = __('Post read time', THEME_TEXTDOMAIN);
					$args['option_default']['read_time'] = 1;
				}

				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('category_default_loop_meta_font');
				$args['option_name']            = __('Posts meta font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style of the post meta info displayed in this category template.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 6;
				$args['option_type_vars']		= array(
													'selector' => '.loop_default-posts-list li .excerpt',
													'color' => true,
													'size' => true,
													'line_height' => true,
													'font_style' => true
													);
				$args['option_default'] 		= array(
													'color' => '#67747C');
				$args['option_page']            = ktt_var_name('customize-category-page');
				$args['option_page_section']    = ktt_var_name('category_default_loop-section');;

				$KTT_new_setting = new KTT_new_setting($args);





















				// add section 

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('category_3columns_loop-section');
				$args['section_name']            	= __('Category Template: 3 Columns', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Configure the style of the 3 columns template.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('customize-category-page');

				$KTT_new_section = new KTT_new_section($args);




				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('category_3columns_loop_title_font');
				$args['option_name']            = __('Posts title font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style of the post titles displayed in this category template.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 13;
				$args['option_type_vars']		= array(
													'selector' => '.loop_3columns-posts-list li .title',
													'color' => true,
													'size' => true,
													'line_height' => true,
													);
				$args['option_default'] 		= array(
													'color' => '#3e3e3e');
				$args['option_page']            = ktt_var_name('customize-category-page');
				$args['option_page_section']    = ktt_var_name('category_3columns_loop-section');;

				$KTT_new_setting = new KTT_new_setting($args);



				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('category_3columns_loop_excerpt_font');
				$args['option_name']            = __('Posts excerpt font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style of the post excerpts displayed in this category template.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 14;
				$args['option_type_vars']		= array(
													'selector' => '.loop_3columns-posts-list li .excerpt',
													'color' => true,
													'size' => true,
													'line_height' => true,
													'font_style' => true
													);
				$args['option_default'] 		= array(
													'color' => '#807070');
				$args['option_page']            = ktt_var_name('customize-category-page');
				$args['option_page_section']    = ktt_var_name('category_3columns_loop-section');;

				$KTT_new_setting = new KTT_new_setting($args);




				
				// add option to admin panel
				
				$args                           = array();
				$args['option_id']              = ktt_var_name('cateogry_3columns_loop_meta_info_display');
				$args['option_name']            = __('Display post info', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Select the information you want to appear under the post exceprt.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'checkboxes';
				$args['option_order'] 			= 17;
				$args['option_type_vars']		= array(
													'date' => __('Post date', THEME_TEXTDOMAIN),
													'author' => __('Post author', THEME_TEXTDOMAIN),
													'comments' => __('Post comments', THEME_TEXTDOMAIN),
													);
				$args['option_default'] 		= array(
													'date' => 1,
													'author' => 1,
													'comments' => 1,
													);
				$args['option_page']            = ktt_var_name('customize-category-page');
				$args['option_page_section']	= ktt_var_name('post_3columns_loop-section');

				if (function_exists('KTT_show_post_read_time_is_active') && KTT_show_post_read_time_is_active()) {
					$args['option_type_vars']['read_time'] = __('Post read time', THEME_TEXTDOMAIN);
					$args['option_default']['read_time'] = 1;
				}

				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('category_3columns_loop_meta_font');
				$args['option_name']            = __('Posts meta font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style of the post meta info displayed in this category template.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 16;
				$args['option_type_vars']		= array(
													'selector' => '.loop_3columns-posts-list li .excerpt',
													'color' => true,
													'size' => true,
													'line_height' => true,
													'font_style' => true
													);
				$args['option_default'] 		= array(
													'color' => '#67747C');
				$args['option_page']            = ktt_var_name('customize-category-page');
				$args['option_page_section']    = ktt_var_name('category_3columns_loop-section');;

				$KTT_new_setting = new KTT_new_setting($args);


}


?>