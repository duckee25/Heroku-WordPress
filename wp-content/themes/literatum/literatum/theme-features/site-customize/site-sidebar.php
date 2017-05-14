<?php
/**
 * Customize options for the theme's sidebar
 *
 */




// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


				// add page to theme options

				$args = array();
				$args['id'] = ktt_var_name('customize-sidebar');
				$args['page_title'] = __('Post content',THEME_TEXTDOMAIN);
				$args['page_description'] = __('Customize settings for the post content.', THEME_TEXTDOMAIN);
				$args['menu_title'] = __('Sidebar',THEME_TEXTDOMAIN);
				$args['menu_order'] = 4;
				$args['parent'] = ktt_var_name('customize-page');

				$new_admin_submenu = new KTT_admin_submenu($args);




				// add section 

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('sidebar-section');
				$args['section_name']            	= __('Sidebar', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Customize the sidebar style.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('customize-sidebar');

				$KTT_new_section = new KTT_new_section($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('sidebar_background_color');
				$args['option_name']            = __('Sidebar background color', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the background color of the sidebar.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'css_colors';
				$args['option_order'] 			= 61;
				$args['option_type_vars']		= array(
													'background_color' => array(
														'selector' => '.mp-menu',
														'property' => 'background-color',
														'label' => __('Background color', THEME_TEXTDOMAIN),
														)
												);
				$args['option_default'] 		= array(
													'background_color' => array('value' => '#27262B')
													);
				$args['option_page']            = ktt_var_name('customize-sidebar');
				$args['option_page_section']	= ktt_var_name('sidebar-section');

				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('sidebar_width');
				$args['option_name']            = __('Sidebar width', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('', THEME_TEXTDOMAIN);
				$args['option_type']            = 'css_texts';
				$args['option_order'] 			= 62;
				$args['option_type_vars']		= array(
													'sidebar_width' => array(
														'selector' => '.mp-menu',
														'property' => 'width',
														'style' => 'max-width:100px;',
														'label' => __('Adjust the width of the sidebar.', THEME_TEXTDOMAIN),
														
														)
												);
				$args['option_default'] 		= array(
													'sidebar_width' => array('value' => '300px'),
													);

				$args['option_page']            = ktt_var_name('customize-sidebar');
				$args['option_page_section']	= ktt_var_name('sidebar-section');

				$KTT_new_setting = new KTT_new_setting($args);











				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('sidebar_font');
				$args['option_name']            = __('Sidebar general font style', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the general font style for the text displayed in the sidebar.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 63;
				$args['option_type_vars']		= array(
													'selector' => '.mp-menu, .mp-menu .widget input, .mp-menu h3, .mp-menu span, .mp-menu div, .mp-menu .widget, .mp-menu ul li',
													'size' => true,
													'line_height' => false,
													'color' => true,
													'load_all_variants' => false,
													);
				$args['option_default'] 		= array(
													'size' => '',
													'size_unit' => '',
													'color' => '#999999',
													);
				$args['option_page']            = ktt_var_name('customize-sidebar');
				$args['option_page_section']    = ktt_var_name('sidebar-section');;

				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('sidebar_color_links');
				$args['option_name']            = __('Sidebar links color', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the color of the links of the sidebar.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'css_colors';
				$args['option_order'] 			= 64;
				$args['option_type_vars']		= array(
													'link_color' => array(
														'selector' => '.mp-menu a',
														'property' => 'color',
														'label' => __('Link color', THEME_TEXTDOMAIN),
														
														),
													'link_color_hover' => array(
														'selector' => '.mp-menu a:hover',
														'property' => 'color',
														'label' => __('Link color on hover', THEME_TEXTDOMAIN),
														)
												);
				$args['option_default'] 		= array(
													'link_color' => array('value' => '#eaeaea'),
													'link_color_hover' => array('value' => '#ffffff'),
													);
				$args['option_page']            = ktt_var_name('customize-sidebar');
				$args['option_page_section']	= ktt_var_name('sidebar-section');

				$KTT_new_setting = new KTT_new_setting($args);






				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('sidebar_widget_captions');
				$args['option_name']            = __('Sidebar widget captions', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Adjust the general font style for the captions/titles of the widgets in the sidebar.', THEME_TEXTDOMAIN);
				$args['option_type']            = 'font';
				$args['option_order'] 			= 65;
				$args['option_type_vars']		= array(
													'selector' => '.mp-menu .widget .widget-title',
													'size' => true,
													'line_height' => false,
													'color' => true,
													'load_all_variants' => false,
													);
				$args['option_default'] 		= array(
													'size' => '17',
													'size_unit' => 'px',
													'color' => '#999999',
													);
				$args['option_page']            = ktt_var_name('customize-sidebar');
				$args['option_page_section']    = ktt_var_name('sidebar-section');;

				$KTT_new_setting = new KTT_new_setting($args);

				

}


?>