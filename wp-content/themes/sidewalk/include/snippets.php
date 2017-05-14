<?php
/*-----------------------------------------------------------------------------------*/
/*	Include snippets to modify/add some features to this theme
/*-----------------------------------------------------------------------------------*/

/* Allow shortcodes in widgets */
add_filter( 'widget_text', 'do_shortcode' );

/* Add classes to body tag */
if ( !function_exists( 'sdw_body_class' ) ):
	function sdw_body_class( $classes ) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

		//Add some broswer classes which can be usefull for some css hacks later
		if ( $is_lynx ) $classes[] = 'lynx';
		elseif ( $is_gecko ) $classes[] = 'gecko';
		elseif ( $is_opera ) $classes[] = 'opera';
		elseif ( $is_NS4 ) $classes[] = 'ns4';
		elseif ( $is_safari ) $classes[] = 'safari';
		elseif ( $is_chrome ) $classes[] = 'chrome';
		elseif ( $is_IE ) $classes[] = 'ie';
		else $classes[] = 'unknown';

		if ( $is_iphone ) $classes[] = 'iphone';

		// Detect cover class
		$cover = sdw_get_cover_data();

		if ( $cover['img'] ) {
			$classes[] = 'sdw-has-cover';

			if ( sdw_get_option( 'cover_indent' ) ) {
				$classes[] = 'sdw-cover-indent';
			}
		}

		//Check sidebar layout class
		$sidebar = sdw_get_current_sidebar();
		$classes[] = 'sdw-sid-'.$sidebar['use_sidebar'];

		//Check body layout
		if ( sdw_get_option( 'body_layout' ) == 'boxed' ) {
			$classes[] = 'sdw-boxed';
		}

		return $classes;
	}
endif;

add_filter( 'body_class', 'sdw_body_class' );

/* Backwards support for wp title tag ( if version < wp 4.1) */
if ( ! function_exists( '_wp_render_title_tag' ) ) :

	if ( ! function_exists( 'sdw_render_title' ) ) :
		function sdw_render_title() {
			echo '<title>';
			wp_title( '|', true, 'right' );
			echo '</title>';
		}
	endif;


add_action( 'wp_head', 'sdw_render_title' );

/* Add wp_title filter */
if ( !function_exists( 'sdw_wp_title' ) ):
	function sdw_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() )
			return $title;

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', THEME_SLUG ), max( $paged, $page ) );

		return $title;
	}
endif;

add_filter( 'wp_title', 'sdw_wp_title', 10, 2 );

endif;

/* Run Theme Update Check */
if ( !function_exists( 'sdw_run_updater' ) ):
	function sdw_run_updater() {

		$user = sdw_get_option( 'theme_update_username' );
		$apikey = sdw_get_option( 'theme_update_apikey' );
		if ( !empty( $user ) && !empty( $apikey ) ) {
			include_once 'classes/class-pixelentity-theme-update.php';
			PixelentityThemeUpdate::init( $user, $apikey );
		}
	}
endif;

add_action( 'admin_init', 'sdw_run_updater' );


/* Extend user social profiles  */
if ( !function_exists( 'sdw_user_social_profiles' ) ):
	function sdw_user_social_profiles( $contactmethods ) {

		unset( $contactmethods['aim'] );
		unset( $contactmethods['yim'] );
		unset( $contactmethods['jabber'] );

		$social = sdw_get_social();
		foreach ( $social as $soc_id => $soc_name ) {
			if ( $soc_id ) {
				$contactmethods[$soc_id] = $soc_name;
			}
		}
		return $contactmethods;
	}
endif;

add_filter( 'user_contactmethods', 'sdw_user_social_profiles' );

/* Delete our custom category meta from database on category deletion */
if ( !function_exists( 'sdw_delete_category_meta' ) ):
	function sdw_delete_category_meta( $term_id ) {
		delete_option( '_sdw_category_'.$term_id );
	}
endif;

add_action( 'delete_category', 'sdw_delete_category_meta' );


/* Change customize link to lead to theme options instead of live customizer */
if ( !function_exists( 'sdw_change_customize_link' ) ):
	function sdw_change_customize_link( $themes ) {
		if ( array_key_exists( 'sidewalk', $themes ) ) {
			$themes['sidewalk']['actions']['customize'] = admin_url( 'admin.php?page=sdw_options' );
		}
		return $themes;
	}
endif;

add_filter( 'wp_prepare_themes_for_js', 'sdw_change_customize_link' );

/* Print some stuff from options to head tag */
if ( !function_exists( 'sdw_wp_head' ) ):
	function sdw_wp_head() {

		//Add favicons
		if ( $favicon = sdw_get_option_media( 'favicon' ) ) {
			echo '<link rel="shortcut icon" href="'.esc_url( $favicon ).'" type="image/x-icon" />';
		}

		if ( $apple_touch_icon = sdw_get_option_media( 'apple_touch_icon' ) ) {
			echo '<link rel="apple-touch-icon" href="'.esc_url( $apple_touch_icon ).'" />';
		}

		if ( $metro_icon = sdw_get_option_media( 'metro_icon' ) ) {
			echo '<meta name="msapplication-TileColor" content="#ffffff">';
			echo '<meta name="msapplication-TileImage" content="'.esc_url( $metro_icon ).'" />';
		}

		//Additional CSS (if user adds his custom css inside theme options)
		$additional_css = trim( preg_replace( '/\s+/', ' ', sdw_get_option( 'additional_css' ) ) );
		if ( !empty( $additional_css ) ) {
			echo '<style type="text/css">'.$additional_css.'</style>';
		}

		//Google Analytics (tracking)
		if ( $ga = sdw_get_option( 'ga' ) ) {
			echo $ga;
		}

	}
endif;

add_action( 'wp_head', 'sdw_wp_head', 99 );

/* For advanced use - custom JS code into footer if specified in theme options */
if ( !function_exists( 'sdw_wp_footer' ) ):
	function sdw_wp_footer() {

		//Additional JS
		$additional_js = trim( preg_replace( '/\s+/', ' ', sdw_get_option( 'additional_js' ) ) );
		if ( !empty( $additional_js ) ) {
			echo '<script type="text/javascript">
				/* <![CDATA[ */
					'.$additional_js.'
				/* ]]> */
				</script>';
		}


	}
endif;

add_action( 'wp_footer', 'sdw_wp_footer', 99 );


/* Show welcome message and quick tips after theme activation */
if ( !function_exists( 'sdw_welcome_msg' ) ):
	function sdw_welcome_msg() {
		if ( !get_option( 'sdw_welcome_box_displayed' ) ) { update_option( 'sdw_theme_version', THEME_VERSION ); ?>
			<?php include_once THEME_DIR.'sections/welcome.php';?>
		<?php
		}
	}
endif;

/* Show message box after theme update */
if ( !function_exists( 'sdw_update_msg' ) ):
	function sdw_update_msg() {
		if ( get_option( 'sdw_welcome_box_displayed' ) ) {
			$prev_version = get_option( 'sdw_theme_version' );
			$cur_version = THEME_VERSION;
			if ( $prev_version === false ) { $prev_version = '0.0.0'; }
			if ( version_compare( $cur_version, $prev_version, '>' ) ) { ?>
					<?php include_once THEME_DIR.'sections/update-notify.php';?>
			<?php
			}
		}
	}
endif;

/* Show admin notices */
if ( !function_exists( 'sdw_check_installation' ) ):
	function sdw_check_installation() {
		add_action( 'admin_notices', 'sdw_welcome_msg', 1 );
		add_action( 'admin_notices', 'sdw_update_msg', 1 );
	}
endif;

add_action( 'admin_init', 'sdw_check_installation' );


/* Store registered sidebars so we can get them before wp_registered_sidebars is initialized to use them in theme options */
if ( !function_exists( 'sdw_check_sidebars' ) ):
	function sdw_check_sidebars() {
		global $wp_registered_sidebars;
		if ( !empty( $wp_registered_sidebars ) ) {
			update_option( 'sdw_registered_sidebars', $wp_registered_sidebars );
		}
	}
endif;

add_action( 'admin_init', 'sdw_check_sidebars' );

/* Function that outputs the contents of our dashboard widget */
if ( !function_exists( 'sdw_dashboard_widget_cb' ) ):
	function sdw_dashboard_widget_cb() {

		$hide = false;
		if ( $data = get_transient( 'sdw_mksaw' ) ) {
			if ( $data != 'error' ) {
				echo $data;
			} else {
				$hide = true;
			}
		} else {
			$protocol = is_ssl() ? 'https://' : 'http://';
			$url = $protocol.'demo.mekshq.com/mksaw.php';
			$args = array( 'body' => array( 'key' => md5( 'meks' ), 'theme' => 'sidewalk' ) );
			$response = wp_remote_post( $url, $args );
			if ( !is_wp_error( $response ) ) {
				$json = wp_remote_retrieve_body( $response );
				if ( !empty( $json ) ) {
					$json = ( json_decode( $json ) );
					if ( isset( $json->data ) ) {
						echo $json->data;
						set_transient( 'sdw_mksaw', $json->data, 86400 );
					} else {
						set_transient( 'sdw_mksaw', 'error', 86400 );
						$hide = true;
					}
				} else {
					set_transient( 'sdw_mksaw', 'error', 86400 );
					$hide = true;
				}

			} else {
				set_transient( 'sdw_mksaw', 'error', 86400 );
				$hide = true;
			}
		}

		if ( $hide ) {
			echo '<style>#sdw_dashboard_widget {display:none;}</style>'; //hide widget if data is not returned properly
		}

	}
endif;

/* Add dashboard widget */
if ( !function_exists( 'sdw_add_dashboard_widgets' ) ):
	function sdw_add_dashboard_widgets() {
		add_meta_box( 'sdw_dashboard_widget', 'Meks - WordPress Themes & Plugins', 'sdw_dashboard_widget_cb', 'dashboard', 'side', 'high' );
	}
endif;

add_action( 'wp_dashboard_setup', 'sdw_add_dashboard_widgets' );

/* Add media grabber features */
if ( !function_exists( 'sdw_add_media_grabber' ) ):
	function sdw_add_media_grabber() {
		if ( !class_exists( 'Hybrid_Media_Grabber' ) ) {
			include_once 'classes/class-hybrid-media-grabber.php';
		}
	}
endif;

add_action( 'init', 'sdw_add_media_grabber' );


/* Unregister Entry Views widget */
if ( !function_exists( 'sdw_unregister_widgets' ) ):
	function sdw_unregister_widgets() {

		$widgets = array( 'EV_Widget_Entry_Views' );

		//Allow child themes or plugins to add/remove widgets they want to unregister
		$widgets = apply_filters( 'sdw_modify_unregister_widgets', $widgets );

		if ( !empty( $widgets ) ) {
			foreach ( $widgets as $widget ) {
				unregister_widget( $widget );
			}
		}

	}
endif;


add_action( 'widgets_init', 'sdw_unregister_widgets', 99 );

/* Remove entry views support for other post types, we need post support only */
if ( !function_exists( 'sdw_remove_entry_views_support' ) ):
	function sdw_remove_entry_views_support() {

		$types = array( 'page', 'attachment', 'literature', 'portfolio_item', 'recipe', 'restaurant_item' );

		//Allow child themes or plugins to modify entry views support
		$widgets = apply_filters( 'sdw_modify_entry_views_support', $types );

		if ( !empty( $types ) ) {
			foreach ( $types as $type ) {
				remove_post_type_support( $type, 'entry-views' );
			}
		}

	}
endif;

add_action( 'init', 'sdw_remove_entry_views_support', 99 );


/* Change default arguments of flickr widget plugin */
if ( !function_exists( 'sdw_flickr_widget_defaults' ) ):
	function sdw_flickr_widget_defaults( $defaults ) {

		$defaults['t_width'] = 93;
		$defaults['t_height'] = 93;
		return $defaults;
	}
endif;

add_filter( 'mks_flickr_widget_modify_defaults', 'sdw_flickr_widget_defaults' );


/* Change default arguments of author widget plugin */
if ( !function_exists( 'sdw_author_widget_defaults' ) ):
	function sdw_author_widget_defaults( $defaults ) {
		$defaults['avatar_size'] = 90;
		return $defaults;
	}
endif;

add_filter( 'mks_author_widget_modify_defaults', 'sdw_author_widget_defaults' );

/* Change default arguments of social widget plugin */
if ( !function_exists( 'sdw_social_widget_defaults' ) ):
	function sdw_social_widget_defaults( $defaults ) {
		$defaults['size'] = 44;
		$defaults['style'] = 'circle';
		return $defaults;
	}
endif;

add_filter( 'mks_social_widget_modify_defaults', 'sdw_social_widget_defaults' );


/* Rrevent redirect issue that may brake home page pagination caused by some plugins */
function sdw_disable_redirect_canonical( $redirect_url ) {
	if ( is_page_template( 'template-home.php' ) && is_paged() ) {
		$redirect_url = false;
	}
	return $redirect_url;
}

add_filter( 'redirect_canonical', 'sdw_disable_redirect_canonical' );


/* Add class to gallery images to run our pop-up */
if ( !function_exists( 'sdw_gallery_atts' ) ):
	function sdw_gallery_atts( $output, $pairs, $atts ) {

		if ( isset( $atts['link'] ) && $atts['link'] == 'file' ) {
			add_filter( 'wp_get_attachment_link', 'sdw_add_class_attachment_link', 10, 1 );
		} else {
			remove_filter( 'wp_get_attachment_link', 'sdw_add_class_attachment_link' );
		}

		if ( !isset( $output['columns'] ) ) {
			$output['columns'] = 1;
		}

		if ( $output['columns'] == 1 ) {
			$output['size'] = 'sdw-lay-a';
		}

		return $output;
	}
endif;

if ( !function_exists( 'sdw_add_class_attachment_link' ) ):
	function sdw_add_class_attachment_link( $link ) {
		$link = str_replace( '<a', '<a class="sdw-popup"', $link );
		return $link;
	}
endif;

add_filter( 'shortcode_atts_gallery', 'sdw_gallery_atts', 10, 3 );


/* Add theme generated image sizes to media editor */

if ( !function_exists( 'sdw_add_sizes_media_editor' ) ):
	function sdw_add_sizes_media_editor( $sizes ) {

		$sdw_sizes = sdw_get_image_sizes();

		if ( !empty( $sdw_sizes ) ) {
			foreach ( $sdw_sizes as $id => $size ) {
				$sizes[$id] = $size['title'];
			}
		}

		return $sizes;
	}
endif;

add_filter( 'image_size_names_choose', 'sdw_add_sizes_media_editor' );

/* Overwrite posts per page value if user change it for specific layout */
if ( !function_exists( 'sdw_pre_get_posts' ) ):
	function sdw_pre_get_posts( $query ) {

		//Check for ppp value on specific archive layout
		if ( !is_admin() && $query->is_main_query() && $query->is_archive() ) {
			$current_layout = sdw_get_current_post_layout();
			if ( sdw_get_option( 'lay_'.$current_layout.'_ppp' ) == 'custom' ) {
				$ppp_custom = absint( sdw_get_option( 'lay_'.$current_layout.'_ppp_num' ) );
				$query->set( 'posts_per_page', $ppp_custom );
			}
		}

	}
endif;

add_action( 'pre_get_posts', 'sdw_pre_get_posts' );

/* Display first letter of a commenter name instead of default avatar */
if ( !function_exists( 'sdw_letter_avatar' ) ):
	function sdw_letter_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
		global $comment;

		if ( !is_admin() && is_singular() && !empty( $comment ) ) {


			if ( ! sdw_is_valid_gravatar( $id_or_email ) && strpos( $avatar, 'gravatar' ) ) {
				$avatar = '<span class="sdw-letter-avatar">'.substr( $comment->comment_author, 0, 1 ).'</span>';
			}
		}
		return $avatar;
	}
endif;

add_filter( 'get_avatar' , 'sdw_letter_avatar' , 99 , 5 );


?>