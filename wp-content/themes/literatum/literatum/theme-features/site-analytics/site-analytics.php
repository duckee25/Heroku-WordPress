<?php
/**
 * Add a custom css input 
 *
 */



// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


				// add page to theme options

				$args = array();
				$args['id'] = ktt_var_name('analytics_page');
				$args['page_title'] = 'Analytics';
				$args['page_description'] = __('Configure this fields to see the analytics of your website.', THEME_TEXTDOMAIN);
				$args['menu_title'] = 'Analytics';
				$args['menu_order'] = 9;
				$args['parent'] = 'theme-options';

				$new_admin_submenu = new KTT_admin_submenu($args);







				// add google analytics section

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('google_analytics_section');
				$args['section_name']            	= __('Google Analytics', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Configuration of the site for Google Analytics.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('analytics_page');

				$KTT_new_section = new KTT_new_section($args);






				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('google_analytics_id');
				$args['option_name']            = __('Google Analytics ID', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Introduce the ID code of the site in your Google Analytics account. (UA-00000000-0)', THEME_TEXTDOMAIN);
				$args['option_type']            = 'text';
				$args['option_order']            = 1;
				$args['option_page']            = ktt_var_name('analytics_page');
				$args['option_page_section']	= ktt_var_name('google_analytics_section');

				$KTT_new_setting = new KTT_new_setting($args);




				$args                           = array();
				$args['option_id']              = ktt_var_name('google_analytics_active');
				$args['option_name']            = __('Active Google analytics', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = sprintf(__('Check this option to active Google Analytics in %s', THEME_TEXTDOMAIN), get_bloginfo('name'));
				$args['option_type']            = 'checkbox';
				$args['option_order']           = 2;
				$args['option_page']            = ktt_var_name('analytics_page');
				$args['option_page_section']	= ktt_var_name('google_analytics_section');

				$KTT_new_setting = new KTT_new_setting($args);




				$args                           = array();
				$args['option_id']              = ktt_var_name('google_analytics_position');
				$args['option_name']            = __('Google Analytics position', THEME_TEXTDOMAIN);
				$args['option_label']           = __('', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Where should the tracking code be placed?', THEME_TEXTDOMAIN);
				$args['option_type']            = 'select';
				$args['option_type_vars']		= array(
														'header' => __('In header (Recommended)', THEME_TEXTDOMAIN),
														'footer' => __('In footer', THEME_TEXTDOMAIN)
														);
				$args['option_order']           = 3;
				$args['option_page']            = ktt_var_name('analytics_page');
				$args['option_page_section']	= ktt_var_name('google_analytics_section');

				$KTT_new_setting = new KTT_new_setting($args);

}






// check if google analytics is active
function KTT_google_analytics_is_active() {
	$is_active = get_option(ktt_var_name('google_analytics_active'));
	$code = get_option(ktt_var_name('google_analytics_id'));
	if ($is_active && $code) return true;
}




// add the custom css to wp_head
function KTT_print_google_analytics_code() {
	$analytics_id = get_option(ktt_var_name('google_analytics_id'));

	if ($analytics_id) {?>
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create','<?php echo $analytics_id;?>','auto');
		ga('require','displayfeatures');
		ga('send','pageview');
		</script>
	<?php } 
}


// place the google analytics code in the selected spot
if (KTT_google_analytics_is_active()) {
	$position = get_option(ktt_var_name('google_analytics_id'));

	if ($position == 'footer') {

		add_action('wp_footer', 'KTT_print_google_analytics_code');

	} else {

		add_action('wp_head', 'KTT_print_google_analytics_code');

	}
	
}



?>