<?php
/**
 * Add logo and favicon support in settings/media
 *
 */


// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


				// add page to theme options

				$args = array();
				$args['id'] = ktt_var_name('general-page');
				$args['page_title'] = 'General';
				$args['page_description'] = '';
				$args['menu_title'] = 'General';
				$args['menu_order'] = 1;
				$args['parent'] = 'theme-options';

				$new_admin_submenu = new KTT_admin_submenu($args);




				// add section for logo and favicon


				$args                           	= array();
				$args['section_id']              	= ktt_var_name('logo_and_icon');
				$args['section_name']            	= __('Site logo & Favicon', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Add a custom logo and favicon to your site.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('general-page');

				$KTT_new_section = new KTT_new_section($args);





				// add option to admin panel (logo image)

				$args                           	= array();
				$args['option_id']              	= ktt_var_name('logo_image');
				$args['option_name']            	= __('Logo image', THEME_TEXTDOMAIN);
				$args['option_label']           	= __('', THEME_TEXTDOMAIN);
				$args['option_description']     	= __('Upload a logo image for your site.', THEME_TEXTDOMAIN);
				$args['option_type']            	= 'image';
				$args['option_order']				= 1;
				$args['option_page']            	= ktt_var_name('general-page');
				$args['option_page_section']    	= ktt_var_name('logo_and_icon');


				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel (favicon)

				$args                           	= array();
				$args['option_id']              	= ktt_var_name('favicon');
				$args['option_name']            	= __('Favicon', THEME_TEXTDOMAIN);
				$args['option_label']           	= __('', THEME_TEXTDOMAIN);
				$args['option_description']     	= __('Upload a favicon image for your site.', THEME_TEXTDOMAIN);
				$args['option_type']            	= 'image';
				$args['option_order']				= 2;
				$args['option_page']            	= ktt_var_name('general-page');
				$args['option_page_section']    	= ktt_var_name('logo_and_icon');


				$KTT_new_setting = new KTT_new_setting($args);

}




// add the favicon to the <head> section

add_action('wp_head', 'KTT_print_favicon');
function KTT_print_favicon() {

	$favicon = get_option(ktt_var_name('favicon'));
	if ($favicon) {
		?><link rel="icon" 
	 	type="image/png" 
	 	href="<?php echo wp_get_attachment_url($favicon);?>">
		<?php
	}

}


?>