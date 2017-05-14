<?php 
function forte_sessions() {
    if (!session_id()) {
        session_start();
		session_name( 'PHPSESSID' );
    }
}
add_action('init', 'forte_sessions');

/*=========================================================================================*/

function pix_add_option($name, $value, $icl) {
	global $wpdb;
	$value = maybe_serialize( $value );
	$wpdb_forte = $wpdb->prefix . 'forte';
	$query = "SELECT * FROM $wpdb_forte WHERE name='$name' ";
	$result = $wpdb->get_results($query);
	if ( !$wpdb->num_rows ) {
		$wpdb->insert( $wpdb_forte, array('name'=>$name,'value'=>$value,'icl'=>$icl) );
	}
}

function pix_add_raw_option($name, $value, $icl) {
	global $wpdb;
	$wpdb_forte = $wpdb->prefix . 'forte';
	$query = "SELECT * FROM $wpdb_forte WHERE name='$name' ";
	$result = $wpdb->get_results($query);
	if ( !$wpdb->num_rows ) {
		$wpdb->insert( $wpdb_forte, array('name'=>$name,'value'=>$value,'icl'=>$icl) );
	}
}

function pix_get_icl($name) {
	global $wpdb;
	$wpdb_forte = $wpdb->prefix . 'forte';
	$results = $wpdb->get_results("SELECT icl FROM $wpdb_forte WHERE name = '$name'");
}

function pix_get_option($name) {
	global $wpdb;
	
	$wpdb_forte = $wpdb->prefix . 'forte';
	$row = $wpdb->get_row("SELECT * FROM $wpdb_forte WHERE name = '$name'", ARRAY_A);

	if($row['name']=='') {
		return false;
	} else {
		$results = $wpdb->get_results("SELECT * FROM $wpdb_forte WHERE name = '$name'");

		foreach ( $results as $result ) 
		{
			
			if (function_exists('icl_t') && icl_t('Forte', $result->name, $result->value)!='') {
				$return = maybe_unserialize(icl_t('Forte', $result->name, $result->value));
			} else {
				$return = maybe_unserialize($result->value);
			}

		}
		
		if ( is_string($return ) ) {
			$return = stripslashes($return);
		}

		return $return;

	}
	
}

function pix_get_raw_option($name) {
	global $wpdb;
	
	$wpdb_forte = $wpdb->prefix . 'forte';
	$row = $wpdb->get_row("SELECT * FROM $wpdb_forte WHERE name = '$name'", ARRAY_A);

	if($row['name']=='') {
		return false;
	} else {
		$results = $wpdb->get_results("SELECT * FROM $wpdb_forte WHERE name = '$name'");

		foreach ( $results as $result ) 
		{			
			$return = $result->value;
		}
		
		if ( is_string($return ) ) {
			$return = stripslashes($return);
		}

		return $return;

	}
	
}

function pix_esc_option($name) {
	if ( is_string($name ) ) {
		$name = pix_get_option($name);
	}
	return $name;
}

function pix_update_option($name, $value) {
	global $wpdb;
	$wpdb_forte = $wpdb->prefix . 'forte';
	$icl_row = $wpdb->get_row("SELECT * FROM $wpdb_forte WHERE name = '$name'");
	
	$value = maybe_serialize( $value );
	$wpdb->update( $wpdb_forte, array( 'value' => $value ), array( 'name' => $name ) );
	if ( isset($icl_row->icl) && $icl_row->icl == 'true' && function_exists('icl_register_string') ) {
		icl_register_string('Forte', $name, $value);
	}
}

function pix_delete_option($name) {
	global $wpdb;
	$wpdb_forte = $wpdb->prefix . 'forte';
	$wpdb->query( "DELETE FROM $wpdb_forte WHERE name = '$name'" );
}

		


add_action('wp_ajax_data_save', 'forte_save_ajax');


require_once('functions/lib/pix_google_arrays.php');
require_once('functions/lib/pix_admin.php');
require_once('functions/lib/pix_functions.php');
require_once('functions/lib/pix_navmenu.php');
require_once('functions/lib/pix_metaboxes.php');
require_once('functions/lib/pix_googlefonts.php');
require_once('functions/lib/pix_import.php');
require_once('functions/lib/pix_menu.php');
	require_once('functions/lib/admin/pix_interface.php');
	require_once('functions/lib/admin/pix_adminpanel.php');
	require_once('functions/lib/admin/pix_floatingicons.php');
	require_once('functions/lib/admin/pix_frontheader.php');
	require_once('functions/lib/admin/pix_navmenus.php');
	require_once('functions/lib/admin/pix_navsection.php');
	require_once('functions/lib/admin/pix_mainsection.php');
	require_once('functions/lib/admin/pix_footersection.php');
	require_once('functions/lib/admin/pix_sidebar.php');
	require_once('functions/lib/admin/pix_sliding_sidebar.php');
	require_once('functions/lib/admin/pix_generalseo.php');
	require_once('functions/lib/admin/pix_importexport.php');
	require_once('functions/lib/admin/pix_select_fonts.php');
	require_once('functions/lib/admin/pix_typo.php');
	require_once('functions/lib/admin/pix_headings_typo.php');
	require_once('functions/lib/admin/pix_layout_colors.php');
	require_once('functions/lib/admin/pix_section_colors.php');
	require_once('functions/lib/admin/pix_buttons.php');
	require_once('functions/lib/admin/pix_other_colors.php');
	require_once('functions/lib/admin/pix_slider_colors.php');
	require_once('functions/lib/admin/pix_tooltip_colors.php');
	require_once('functions/lib/admin/pix_pagenavi_colors.php');
	require_once('functions/lib/admin/pix_sidebargenerator.php');
	require_once('functions/lib/admin/pix_slideshowgenerator.php');
	require_once('functions/lib/admin/pix_slideshowcolors.php');
	require_once('functions/lib/admin/pix_slideshowmanage.php');
	require_once('functions/lib/admin/pix_contactformgenerator.php');
	require_once('functions/lib/admin/pix_contactformmanage.php');
	require_once('functions/lib/admin/pix_tablesgenerator.php');
	require_once('functions/lib/admin/pix_tablecolors.php');
	require_once('functions/lib/admin/pix_tablemanage.php');
	require_once('functions/lib/admin/pix_pages.php');
	require_once('functions/lib/admin/pix_captcha.php');
	require_once('functions/lib/admin/pix_posts.php');
	require_once('functions/lib/admin/pix_posts_page.php');
	require_once('functions/lib/admin/pix_404.php');
	require_once('functions/lib/admin/pix_archive.php');
	require_once('functions/lib/admin/pix_category.php');
	require_once('functions/lib/admin/pix_post_related.php');
	require_once('functions/lib/admin/pix_search.php');
	require_once('functions/lib/admin/pix_portfolio.php');
	require_once('functions/lib/admin/pix_gallery.php');
	require_once('functions/lib/admin/pix_portfolio_archive.php');
	require_once('functions/lib/admin/pix_portfolio_related.php');
	require_once('functions/lib/admin/pix_woo.php');
	require_once('functions/lib/admin/pix_customstyles.php');
	require_once('functions/lib/admin/pix_permissions.php');
	require_once('functions/lib/admin/pix_categoryhack.php');
	require_once('functions/lib/admin/pix_galleryhack.php');
	require_once('functions/lib/admin/pix_tweets.php');
require_once('functions/lib/pix_shortcodes.php');
require_once('functions/lib/pix_sidebar-generator.php');
require_once('functions/lib/pix_post-types.php');
require_once('functions/lib/pix_tinymce-buttons.php');
require_once('functions/lib/pix_widgets.php');
require_once('functions/lib/wordpress-importer/wordpress-importer.php');
require_once('functions/lib/pix_updates.php');

$forte_includes = ABSPATH . 'wp-content/forte_includes/includes.php';
if ( file_exists($forte_includes) ) {
	require_once( $forte_includes );
}


global $woocommerce_en;
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('woocommerce/woocommerce.php')) {
    $woocommerce_en = 'active';
	require_once('functions/lib/pix_woocommerce.php');
} else {
    $woocommerce_en = 'inactive';
}



global $mediaelement_en;
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('media-element-html5-video-and-audio-player/mediaelement-js-wp.php')) {
    $mediaelement_en = 'active';
} else {
    $mediaelement_en = 'inactive';
}



global $wpml_en;
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('sitepress-multilingual-cms/sitepress.php')) {
    $wpml_en = 'active';
} else {
    $wpml_en = 'inactive';
}

/*=========================================================================================*/

add_filter( 'wp_get_attachment_image_attributes', 'pix_filter_gallery_img_atts', 10, 2 );
if ( !function_exists('pix_filter_gallery_img_atts')) :
function pix_filter_gallery_img_atts( $atts, $attachment ) {
    if ( isset($atts['srcset']) )
    	unset($atts['srcset']);

    return $atts;
}
endif;

add_action( 'admin_notices', 'pix_updater_notice' );
function pix_updater_notice() {
	if ( function_exists( 'wordpress_importer_init' ) ) {
    ?>
    <div class="update-nag notice">
        <p><?php _e( 'Please, deactivate your version of Wordpress Importer plugin to use the version that comes with the theme', 'forte' ); ?></p>
    </div>
    <?php
	}
}
