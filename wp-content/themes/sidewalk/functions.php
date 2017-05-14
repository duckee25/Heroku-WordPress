<?php

/*	Define Theme Vars */
define( 'THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'THEME_URI', trailingslashit( get_template_directory_uri() ) );
define( 'THEME_NAME', 'Sidewalk' );
define( 'THEME_SLUG', 'sidewalk' );
define( 'THEME_VERSION', '1.1' );
define( 'THEME_OPTIONS', 'sdw_settings' );
define( 'JS_URI', trailingslashit( THEME_URI . 'js' ) );
define( 'CSS_URI', trailingslashit( THEME_URI . 'css' ) );
define( 'IMG_DIR', trailingslashit( THEME_DIR . 'images' ) );
define( 'IMG_URI', trailingslashit( THEME_URI . 'images' ) );

/* Define content width */
if( !isset( $content_width ) ) {
	$content_width = 640;
}

/*	After Theme Setup Hook */
add_action( 'after_setup_theme', 'sdw_theme_setup' );

function sdw_theme_setup() {

	/* Load frontend scripts and styles */
	add_action( 'wp_enqueue_scripts', 'sdw_load_scripts' );

	/* Load admin scripts and styles */
	add_action( 'admin_enqueue_scripts', 'sdw_load_admin_scripts' );

	/* Register sidebars */
	add_action( 'widgets_init', 'sdw_register_sidebars' );

	/* Register menus */
	add_action( 'init', 'sdw_register_menus' );

	/* Register widgets */
	add_action( 'widgets_init', 'sdw_register_widgets' );

	/* Add thumbnails support */
	add_theme_support( 'post-thumbnails' );

	/* Add theme support for title tag (since wp 4.1) */
	add_theme_support( 'title-tag' );


	/* Add image sizes */
	$image_sizes = sdw_get_image_sizes();

	if ( !empty( $image_sizes ) ) {
		foreach ( $image_sizes as $id => $size ) {
			add_image_size( $id, $size['args']['w'], $size['args']['h'], $size['args']['crop'] );
		}
	}

	/* Add post formats support */
	add_theme_support( 'post-formats', array(
			'audio', 'gallery', 'image', 'video'
		) );

	/* Support for HTML5 */
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery' ) );

	/* Automatic Feed Links */
	add_theme_support( 'automatic-feed-links' );

}


/* Load frontend styles */
function sdw_load_styles() {

	//Load fonts
	$fonts = sdw_generate_font_links();
	if ( !empty( $fonts ) ) {
		foreach ( $fonts as $k => $font ) {
			wp_register_style( 'sdw-font-'.$k, $font, false, THEME_VERSION, 'screen' );
			wp_enqueue_style( 'sdw-font-'.$k );
		}
	}

	//Load main css file
	wp_register_style( 'sdw-style', THEME_URI . 'style.css', false, THEME_VERSION, 'screen, print' );
	wp_enqueue_style( 'sdw-style' );

	//Add dynamic styles generated from theme options
	wp_add_inline_style( 'sdw-style', sdw_generate_dynamic_css() );

	//Enqueue font awsm icons if css is not already included via plugin
	if ( !wp_style_is( 'mks_shortcodes_fntawsm_css', 'enqueued' ) ) {
		wp_register_style( 'sdw_font_awesome', CSS_URI . '/font-awesome.min.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_style( 'sdw_font_awesome' );
	}

	//Load responsive css
	wp_register_style( 'sdw-responsive', CSS_URI . 'responsive.css', array( 'sdw-style' ), THEME_VERSION, 'screen' );
	wp_enqueue_style( 'sdw-responsive' );


	//Load RTL css
	if ( sdw_is_rtl() ) {
		wp_register_style( 'sdw-rtl', CSS_URI . 'rtl.css', array( 'sdw-style', 'sdw-responsive' ), THEME_VERSION, 'screen' );
		wp_enqueue_style( 'sdw-rtl' );
	}

}


/* Load frontend scripts */
function sdw_load_scripts() {

	sdw_load_styles();

	wp_enqueue_script( 'sdw-images-loaded', JS_URI . 'imagesloaded.pkgd.min.js', array( 'jquery' ), THEME_VERSION, true );
	wp_enqueue_script( 'sdw-magnific-popup', JS_URI . 'jquery.magnific-popup.min.js', array( 'jquery' ), THEME_VERSION, true );
	wp_enqueue_script( 'sdw-affix', JS_URI . 'affix.js', array( 'jquery' ), THEME_VERSION, true );
	wp_enqueue_script( 'sdw-owl-carousel', JS_URI . 'owl.carousel.min.js', array( 'jquery' ), THEME_VERSION, true );
	wp_enqueue_script( 'sdw-fitvid-js', JS_URI . 'jquery.fitvids.js', array( 'jquery' ), THEME_VERSION, true );
	wp_enqueue_script( 'sdw-sidr', JS_URI . 'jquery.sidr.min.js', array( 'jquery' ), THEME_VERSION, true );
	
	if(sdw_get_option('smooth_scroll')) {
		wp_enqueue_script( 'sdw-smooth', JS_URI . 'smooth.scroll.js', array( 'jquery' ), THEME_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'sdw-custom', JS_URI . 'custom.js', array( 'jquery' ), THEME_VERSION, true );
	wp_localize_script( 'sdw-custom', 'sdw_js_settings', sdw_get_js_settings() );


}

/* Load admin scripts and styles */
function sdw_load_admin_scripts() {

	global $pagenow, $typenow;

	//Load amdin css
	wp_register_style( 'sdw-admin-style', CSS_URI . 'admin.css', false, THEME_VERSION, 'screen' );
	wp_enqueue_style( 'sdw-admin-style' );
 
	//Load category JS   
	if ( $pagenow == 'edit-tags.php' && isset( $_GET['taxonomy'] ) && $_GET['taxonomy'] == 'category' ) {
		wp_enqueue_media();
		wp_enqueue_script( 'sdw-category', JS_URI.'metaboxes-category.js', array( 'jquery'), THEME_VERSION );
	}

	//Load post & page metaboxes js
	if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
		if ( $typenow == 'post' ) {
			wp_enqueue_script( 'sdw-post', JS_URI.'metaboxes-post.js', array( 'jquery' ), THEME_VERSION );
		} elseif ( $typenow == 'page' ) {
			wp_enqueue_script( 'sdw-page', JS_URI.'metaboxes-page.js', array( 'jquery' ), THEME_VERSION );
		}
	}

}

/* Support localization */
load_theme_textdomain( THEME_SLUG, THEME_DIR . 'languages' );


/* Helpers and utility functions */
require_once 'include/helpers.php';

/* Menus */
require_once 'include/menus.php';

/* Sidebars */
require_once 'include/sidebars.php';

/* Widgets */
require_once 'include/widgets.php';

/* Add custom metaboxes */
require_once 'include/metaboxes.php';

/* Snippets (modify/add some special features to this theme) */
require_once 'include/snippets.php';

/* Include AJAX action handlers */
require_once 'include/ajax.php';

/* Include plugins (required or recommended for this theme) */
require_once 'include/plugins.php';

/* Theme Options */
require_once 'include/options.php';

?>