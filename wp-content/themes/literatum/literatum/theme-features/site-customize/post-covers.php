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
				$args['id'] = ktt_var_name('customize-cover-page');
				$args['page_title'] = __('Post covers',THEME_TEXTDOMAIN);
				$args['page_description'] = __('Customize settings for post covers.', THEME_TEXTDOMAIN);
				$args['menu_title'] = __('Post covers',THEME_TEXTDOMAIN);
				$args['menu_order'] = 3;
				$args['parent'] = ktt_var_name('customize-page');

				$new_admin_submenu = new KTT_admin_submenu($args);




				// add section 

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('post_cover_1-section');
				$args['section_name']            	= __('Big post cover', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Configure the post cover. This changes the aspect of the post cover in the single post page and in the first post of the home page also.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('customize-cover-page');

				$KTT_new_section = new KTT_new_section($args);







				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_cover_1_title_font');
				$args['option_name']            = __('Post title font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style for the post titles.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 1;
				$args['option_type_vars']		= array(
													'selector' => '.article-card.squarebig > .inner .inner .title, #card-nextpost.article-card > .inner .inner .title',
													'size' => false,
													);
				$args['option_page']            = ktt_var_name('customize-cover-page');
				$args['option_page_section']	= ktt_var_name('post_cover_1-section');

				$KTT_new_setting = new KTT_new_setting($args);




				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_cover_1_display_subtitle');
				$args['option_name']            = __('Display subtitle', THEME_TEXTDOMAIN);
				$args['option_label']           = __('Display the subtitle of the article if it is available.', THEME_TEXTDOMAIN);
				$args['option_description']     = __("Check this option to display the article's subtitle.",THEME_TEXTDOMAIN);
				$args['option_type']            = 'checkbox';
				$args['option_page']            = ktt_var_name('customize-cover-page');
				$args['option_page_section']    = ktt_var_name('post_cover_1-section');
				$args['option_default']			= '1';

				$KTT_new_setting = new KTT_new_setting($args);






				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_cover_1_subtitle_font');
				$args['option_name']            = __('Post subtitle font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style for the post subtitle.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
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
				$args['option_page']            = ktt_var_name('customize-cover-page');
				$args['option_page_section']	= ktt_var_name('post_cover_1-section');

				$KTT_new_setting = new KTT_new_setting($args);



				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_cover_1_align');
				$args['option_name']            = __('Text align', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Selecciona la posición por defecto dónde quieres que aparezca el título y la demás informacion del artículo.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'select';
				$args['option_order'] 			= 4;
				$args['option_type_vars']		= array(
														'' => __('Centered',THEME_TEXTDOMAIN),
														'info-align-left' => __('Left center', THEME_TEXTDOMAIN),
														'info-align-bottom' => __('Center bottom',THEME_TEXTDOMAIN),
														'info-align-bottom info-align-left' => __('Left bottom',THEME_TEXTDOMAIN),
													);
				$args['option_default'] 		= '';
				$args['option_page']            = ktt_var_name('customize-cover-page');
				$args['option_page_section']	= ktt_var_name('post_cover_1-section');

				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_cover_1_meta_info_display');
				$args['option_name']            = __('Display post info', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Select the information you want to appear around the title/subtitle.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'checkboxes';
				$args['option_order'] 			= 5;
				$args['option_type_vars']		= array(
													'categories' => __('Post categories', THEME_TEXTDOMAIN),
													'date' => __('Post date', THEME_TEXTDOMAIN),
													'author' => __('Post author', THEME_TEXTDOMAIN),
													'comments' => __('Post comments', THEME_TEXTDOMAIN),
													);
				$args['option_default'] 		= array(
													'categories' => 1,
													'date' => 0,
													'author' => 1,
													'comments' => 1,
													);
				$args['option_page']            = ktt_var_name('customize-cover-page');
				$args['option_page_section']	= ktt_var_name('post_cover_1-section');

				if (function_exists('KTT_show_post_read_time_is_active') && KTT_show_post_read_time_is_active()) {
					$args['option_type_vars']['read_time'] = __('Post read time', THEME_TEXTDOMAIN);
					$args['option_default']['read_time'] = 1;
				}

				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_cover_1_meta_info_font');
				$args['option_name']            = __('Post info font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style of the post meta information.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 6;
				$args['option_type_vars']		= array(
													'selector' => '.article-card > .inner  .inner .meta',
													'size' => true,
													'font_style' => true,
													);
				$args['option_default'] 		= array(
													'size' => 13,
													'size_unit' => 'pt',
													);
				$args['option_page']            = ktt_var_name('customize-cover-page');
				$args['option_page_section']	= ktt_var_name('post_cover_1-section');

				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_cover_1_social_share_display');
				$args['option_name']            = __('Display share links', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Select the share links you want to be displayed above the post title.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'checkboxes';
				$args['option_order'] 			= 7;
				$args['option_type_vars']		= array(
													'twitter' => __('Tweet this', THEME_TEXTDOMAIN),
													'facebook' => __('Share on Facebook', THEME_TEXTDOMAIN),
													'read_later' => __('Read later', THEME_TEXTDOMAIN),
													);
				$args['option_default'] 		= array(
													'twitter' => 1,
													'facebook' => 1,
													'read_later' => 1,
													);
				$args['option_page']            = ktt_var_name('customize-cover-page');
				$args['option_page_section']	= ktt_var_name('post_cover_1-section');
				$KTT_new_setting = new KTT_new_setting($args);




				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_cover_1_mask_opacity');
				$args['option_name']            = __('Mask opacity', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __("Select the mask opacity of the image. 90% = the darkest.",THEME_TEXTDOMAIN);
				$args['option_type']            = 'select';
				$args['option_type_vars']		= array(
													'0.0' => '0%',
													'0.1' => '10%',
													'0.2' => '20%',
													'0.3' => '30%',
													'0.4' => '40%',
													'0.5' => '50%',
													'0.6' => '60%',
													'0.7' => '70%',
													'0.8' => '80%',
													'0.9' => '90%');
				$args['option_order']			= 8;
				$args['option_page']            = ktt_var_name('customize-cover-page');
				$args['option_page_section']    = ktt_var_name('post_cover_1-section');
				$args['option_default']			= '0.4';

				$KTT_new_setting = new KTT_new_setting($args);




				
				// -----------------------------------------------------------------------------------------


				// add section 

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('post_minicover_1-section');
				$args['section_name']            	= __('Small post cover', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Configure the small post cover. These covers appear in the home page under the latest post big cover.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('customize-cover-page');

				$KTT_new_section = new KTT_new_section($args);


				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_minicover_1_title_font');
				$args['option_name']            = __('Post title font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style for the post titles.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 9;
				$args['option_type_vars']		= array(
													'selector' => '.article-card.square > .inner .inner .title',
													'size' => false,
													);
				$args['option_page']            = ktt_var_name('customize-cover-page');
				$args['option_page_section']	= ktt_var_name('post_minicover_1-section');

				$KTT_new_setting = new KTT_new_setting($args);



				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_minicover_1_meta_info_display');
				$args['option_name']            = __('Display post info', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Select the information you want to appear under the title/subtitle.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'checkboxes';
				$args['option_order'] 			= 10;
				$args['option_type_vars']		= array(
													'date' => __('Post date', THEME_TEXTDOMAIN),
													'author' => __('Post author', THEME_TEXTDOMAIN),
													'comments' => __('Post comments', THEME_TEXTDOMAIN),
													);
				$args['option_default'] 		= array(
													'date' => 0,
													'author' => 1,
													'comments' => 1,
													);
				$args['option_page']            = ktt_var_name('customize-cover-page');
				$args['option_page_section']	= ktt_var_name('post_minicover_1-section');

				if (function_exists('KTT_show_post_read_time_is_active') && KTT_show_post_read_time_is_active()) {
					$args['option_type_vars']['read_time'] = __('Post read time', THEME_TEXTDOMAIN);
					$args['option_default']['read_time'] = 0;
				}

				$KTT_new_setting = new KTT_new_setting($args);




				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_minicover_1_hover_effect');
				$args['option_name']            = __('Hover effect', THEME_TEXTDOMAIN);
				$args['option_label']           = __('Display the post information only on hover.', THEME_TEXTDOMAIN);
				$args['option_description']     = __("Check this option to display the post information only when the visitor put the cursor hover the cover.",THEME_TEXTDOMAIN);
				$args['option_type']            = 'checkbox';
				$args['option_order']			= 11;
				$args['option_page']            = ktt_var_name('customize-cover-page');
				$args['option_page_section']    = ktt_var_name('post_minicover_1-section');
				$args['option_default']			= '';

				$KTT_new_setting = new KTT_new_setting($args);



				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('post_minicover_1_mask_opacity');
				$args['option_name']            = __('Mask opacity', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __("Select the mask opacity of the image. 90% = the darkest.",THEME_TEXTDOMAIN);
				$args['option_type']            = 'select';
				$args['option_type_vars']		= array(
													'0.0' => '0%',
													'0.1' => '10%',
													'0.2' => '20%',
													'0.3' => '30%',
													'0.4' => '40%',
													'0.5' => '50%',
													'0.6' => '60%',
													'0.7' => '70%',
													'0.8' => '80%',
													'0.9' => '90%');
				$args['option_order']			= 12;
				$args['option_page']            = ktt_var_name('customize-cover-page');
				$args['option_page_section']    = ktt_var_name('post_minicover_1-section');
				$args['option_default']			= '0.4';

				$KTT_new_setting = new KTT_new_setting($args);

}


?>