<?php
/*------------------ FORTE ------------------*/
function add_forte_plugin() {
	global $typenow, $pagenow;
	if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
		if ( empty( $typenow ) && !empty( $_GET['post'] ) ) {
	        $post = get_post( $_GET['post'] );
	        $typenow = $post->post_type;
	    } elseif ( empty( $typenow ) && !empty( $_GET['post_type'] ) ) {
	        $typenow = $_GET['post_type'];
	    } else {
	        $typenow = 'post';
		}
		
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
		if ( get_user_option('rich_editing') == 'true' && ( $typenow == 'page' ) ) {
			add_filter('mce_external_plugins', 'add_forte_js');
			add_filter('mce_buttons_3', 'register_forte_buttons_page');
		}
		if ( get_user_option('rich_editing') == 'true' && ( $typenow == 'post' || $typenow == 'portfolio' ) ) {
			add_filter('mce_external_plugins', 'add_forte_js');
			add_filter('mce_buttons_3', 'register_forte_buttons_the_rest');
		}
	}
}

add_action('init', 'add_forte_plugin');


function add_forte_js($plugin_array) {
	global $pagenow;
	if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
		$plugin_array['forte'] = get_template_directory_uri().'/functions/scripts/shortcode_buttons.js';
		return $plugin_array;
	}
}

function register_forte_buttons_page($buttons) {
   array_push(
		$buttons, 
		"pix_edittext_sc",
		"pix_slideshow_sc",
		"pix_googlemap_sc",
		"pix_contactform_sc",
		"pix_tooltip_sc",
		"pix_video_sc",
		"pix_audio_sc",
		"pix_accordion_sc",
		"pix_tab_sc",
		"pix_column_sc",
		"pix_sitemap_sc",
		"pix_box_sc",
		"pix_dropcap_sc",
		"pix_button_sc",
		"pix_pricetable_sc",
		"pix_testimonial_sc",
		"pix_hr_sc",
		"pix_clear_sc",
		"pix_tweet_sc",
		"pix_gallery_sc",
		"pix_category_sc"
	);
   return $buttons;
}
function register_forte_buttons_the_rest($buttons) {
   array_push(
		$buttons, 
		"pix_edittext_sc",
		"pix_slideshow_sc",
		"pix_googlemap_sc",
		"pix_contactform_sc",
		"pix_tooltip_sc",
		"pix_video_sc",
		"pix_audio_sc",
		"pix_accordion_sc",
		"pix_tab_sc",
		"pix_column_sc",
		"pix_sitemap_sc",
		"pix_box_sc",
		"pix_dropcap_sc",
		"pix_button_sc",
		"pix_pricetable_sc",
		"pix_testimonial_sc",
		"pix_hr_sc",
		"pix_clear_sc",
		"pix_tweet_sc"
	);
   return $buttons;
}



/*------------------ ### ------------------*/

function pix_refresh_mce($ver) {
  $ver += 3;
  return $ver;
}

add_filter( 'tiny_mce_version', 'pix_refresh_mce');

