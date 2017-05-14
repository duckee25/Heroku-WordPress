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
				$args['id'] = ktt_var_name('customize-frontpage');
				$args['page_title'] = __('Frontpage',THEME_TEXTDOMAIN);
				$args['page_description'] = __('Customize the frontpage of the site.', THEME_TEXTDOMAIN);
				$args['menu_title'] = __('Frontpage',THEME_TEXTDOMAIN);
				$args['menu_order'] = 2;
				$args['parent'] = ktt_var_name('customize-page');

				$new_admin_submenu = new KTT_admin_submenu($args);




				// add section 

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('site_frontpage_style-section');
				$args['section_name']            	= __('Frontpage style', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Set the main style of the frontpage.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('customize-frontpage');

				$KTT_new_section = new KTT_new_section($args);







				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('frontpage_style');
				$args['option_name']            = __('Frontpage main style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Select the style of the frontpage.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'select';
				$args['option_order'] 			= 1;
				$args['option_type_vars']		= array(
														
														'grid' => __('Mosaic grid (Default)', THEME_TEXTDOMAIN),
														'itemslist' => __('Simple list of articles',THEME_TEXTDOMAIN),
														'3columns' => __('Articles in 3 columns',THEME_TEXTDOMAIN),
														
													);
				$args['option_default'] 		= 'grid';
				$args['option_page']            = ktt_var_name('customize-frontpage');
				$args['option_page_section']	= ktt_var_name('site_frontpage_style-section');

				$KTT_new_setting = new KTT_new_setting($args);









				// add section 

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('site_frontpage_config-section');
				$args['section_name']            	= __('Frontpage configuration', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Configure the display of the frontpage. These options are required for al the frontpage styles except the "Mosaic grid"', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('customize-frontpage');

				$KTT_new_section = new KTT_new_section($args);








				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('frontpage_title');
				$args['option_name']            = __('Frontpage header title', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Introduce the title to display in the header of the frontpage.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'text';
				$args['option_order'] 			= 2;
				
				$args['option_default'] 		= get_bloginfo('name');
				$args['option_page']            = ktt_var_name('customize-frontpage');
				$args['option_page_section']	= ktt_var_name('site_frontpage_config-section');

				$KTT_new_setting = new KTT_new_setting($args);




				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('frontpage_title_font');
				$args['option_name']            = __('Frontpage header title font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style for the frontpage title.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 3;
				$args['option_type_vars']		= array(
													'selector' => '.article-card.frontpage-head > .inner .inner .title',
													'size' => true,
													);
				$args['option_page']            = ktt_var_name('customize-frontpage');
				$args['option_page_section']	= ktt_var_name('site_frontpage_config-section');

				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('frontpage_subtitle');
				$args['option_name']            = __('Frontpage header subtitle', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('You can introduce a subtitle to display it in the header of the frontpage under the title.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'wp_editor';
				$args['option_order'] 			= 4;
				$args['option_type_vars'] 		= array(
												    	'wpautop' => false,
												    	'media_buttons' => false,
												    	'textarea_name' => ktt_var_name('frontpage_subtitle'),
												    	'textarea_rows' => 2,
												    	'teeny' 	=> true,
												    	'quicktags' => false,
												    	'tinymce' => false,
												      	);
				$args['option_page']            = ktt_var_name('customize-frontpage');
				$args['option_page_section']	= ktt_var_name('site_frontpage_config-section');

				$KTT_new_setting = new KTT_new_setting($args);






				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('frontpage_subtitle_font');
				$args['option_name']            = __('Frontpage header subtitle font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the font style for frontpage subtitle.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 5;
				$args['option_type_vars']		= array(
													'selector' => '.article-card.frontpage-head > .inner .inner .description',
													'size' => true,
													);
				$args['option_page']            = ktt_var_name('customize-frontpage');
				$args['option_page_section']	= ktt_var_name('site_frontpage_config-section');

				$KTT_new_setting = new KTT_new_setting($args);






				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('frontpage_header_background');
				$args['option_name']            = __('Frontpage header background image', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('You can set a background image to display it in the header of the frontpage. If you do not select any image as background image, it will be automatically selected the featured image of the most recent article published.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'image';
				$args['option_order'] 			= 6;
				
				$args['option_page']            = ktt_var_name('customize-frontpage');
				$args['option_page_section']	= ktt_var_name('site_frontpage_config-section');

				$KTT_new_setting = new KTT_new_setting($args);








				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('frontpage_head_height');
				$args['option_name']            = __('Frontpage head height', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('', THEME_TEXTDOMAIN);
				$args['option_type']            = 'css_texts';
				$args['option_order'] 			= 7;
				$args['option_type_vars']		= array(
													'frontpage_head_height' => array(
														'selector' => '.article-card.pagehead.frontpage-head ',
														'property' => 'height',
														'style' => 'max-width:100px;',
														'label' => __('Adjust the height of the frontpage header.', THEME_TEXTDOMAIN),
														
														)
												);
				$args['option_default'] 		= array(
													'frontpage_head_height' => array('value' => '50vh'),
													);

				$args['option_page']            = ktt_var_name('customize-frontpage');
				$args['option_page_section']	= ktt_var_name('site_frontpage_config-section');

				$KTT_new_setting = new KTT_new_setting($args);








}


?>