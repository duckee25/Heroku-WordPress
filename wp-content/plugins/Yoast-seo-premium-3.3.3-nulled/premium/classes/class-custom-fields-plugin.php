<?php
/**
 * @package WPSEO\Premium\Classes
 */

/**
 * Enqueues a JavaScript plugin for YoastSEO.js that adds custom fields to the content that were defined in the titles
 * and meta's section of the Yoast SEO settings when those fields are available.
 */
class WPSEO_Custom_Fields_Plugin {

	/**
	 * Initialize the AJAX hooks
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * Enqueues all the needed JS scripts.
	 */
	public function enqueue() {
		wp_enqueue_script( 'wp-seo-premium-custom-fields-plugin', plugin_dir_url( WPSEO_PREMIUM_FILE ) . 'assets/js/wp-seo-premium-custom-fields-plugin' . WPSEO_CSSJS_SUFFIX . '.js', array( 'jquery' ), WPSEO_VERSION );
		wp_localize_script( 'wp-seo-premium-custom-fields-plugin', 'YoastCustomFieldsPluginL10', $this->localize_script() );
	}

	/**
	 * Loads the custom fields translations
	 *
	 * @return array
	 */
	public function localize_script() {
		return array(
			'custom_field_names' => $this->get_custom_field_names(),
		);
	}

	/**
	 * Retrieve all custom field names set in SEO ->
	 *
	 * @return array
	 */
	private function get_custom_field_names() {
		$custom_field_names = array();

		$post          = $this->get_post();
		$options       = get_option( WPSEO_Options::get_option_instance( 'wpseo_titles' )->option_name, array() );

		if ( is_object( $post ) ) {
			$target_option = 'page-analyse-extra-' . $post->post_type;

			if ( array_key_exists( $target_option, $options ) ) {
				$custom_field_names = explode( ',', $options[ $target_option ] );
			}
		}

		return $custom_field_names;
	}

	/**
	 * Retrieves post data given a post ID or the global
	 *
	 * @return array|null|WP_Post Returns a post if found, otherwise returns an empty array.
	 */
	private function get_post() {
		if ( $post = filter_input( INPUT_GET, 'post' ) ) {
			$post_id = (int) WPSEO_Utils::validate_int( $post );

			return get_post( $post_id );
		}


		if ( isset( $GLOBALS['post'] ) ) {
			return $GLOBALS['post'];
		}

		return array();
	}
}
