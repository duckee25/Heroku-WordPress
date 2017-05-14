<?php
add_action( 'init', 'forte_update_globals' );
if ( ! function_exists( 'forte_update_globals' ) ) :
/**
 * Globals.
 */
function forte_update_globals() {

	$GLOBALS['forte_theme_data'] = wp_get_theme(get_option('template'));
	$GLOBALS['forte_theme_version'] = $GLOBALS['forte_theme_data']->Version;
	$GLOBALS['forte_theme_base'] = get_option('template');
	$GLOBALS['forte_api_url'] = 'http://www.pixedelic.com/api/api.php';

}
endif;

add_action('admin_menu', 'forte_registration_page');
if ( !function_exists( 'forte_registration_page' ) ) : 
/**
 * Set pages to enter registration data.
 */
function forte_registration_page(){
	$page_title = $menu_title = esc_html__('Theme updates', 'forte');
	add_theme_page( $page_title, $menu_title, 'manage_options', 'forte_updates', 'forte_registration_page_output' );
}
endif;


if ( ! function_exists( 'forte_check_license' ) ) :
/**
 * Check ThemeForest license
 */
function forte_check_license($context) {

	$request_url = 'http://www.pixedelic.com/api/products/forte.php';

	$request_string = array(
		'body' => array(
			'action' => 'check_forte_license', 
			'id' => '3888979',
			'username' => $context['pix_content_forte_user_name'],
			'license' => $context['pix_content_forte_license_key'],
			'remove_license' => $context['remove_license']
		)
	);
	
	$raw_response = wp_remote_post($request_url, $request_string);

	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)) {
		$body = addslashes($raw_response['body']);
		if( stripos($body,'check_ok')!=false ) { ?>
<script type="text/javascript">
/* <![CDATA[ */
var forte_check_license = 'true',
forte_show_message = 'true',
forte_check_message = '<div class="updated"><?php echo wp_kses_post($body); ?></div>';

	<?php if( stripos($body,'delete_registration')!=false ) { ?>

jQuery(document).ready(function(){
	jQuery('#pix_content_forte_user_name, #pix_content_forte_license_key').val('');

	var data = {
		action: 'pixedelic_remove_license_data'
	};

	jQuery.post(ajaxurl, data);
});

	<?php } ?>

/* ]]> */
</script>
		<?php } else { ?>
<script type="text/javascript">
/* <![CDATA[ */
var forte_check_license = 'false',
forte_show_message = 'false',
forte_check_message = '<div class="error"><?php echo wp_kses_post($body); ?></div>';
/* ]]> */
</script>
		<?php } ?>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function(){
	jQuery('input.remove-license').on('click', function(e){
		e.preventDefault();
		var $form = jQuery('form#manage_theme_license'),
			$remove = jQuery('input[name="remove_license"]', $form).val('yes');

		$form.submit();

	});
});
/* ]]> */
</script>
		<?php 
	}
	
}
endif;

add_action( 'wp_ajax_pixedelic_remove_license_data', 'pixedelic_remove_license_data' );
if ( !function_exists( 'pixedelic_remove_license_data' ) ) :
/**
* Emtpy license code 
*/
function pixedelic_remove_license_data() {

    update_option( 'pix_content_forte_user_name', '' );
    update_option( 'pix_content_forte_license_key', '' );

	die();
}
endif; //pixedelic_remove_license_data

if ( ! function_exists( 'forte_check_for_update' ) ) :
/**
 * Check for updates
 */
add_filter('pre_set_site_transient_update_themes', 'forte_check_for_update');
function forte_check_for_update($checked_data) {
	global $wp_version, $forte_theme_version, $forte_theme_base, $forte_api_url;

	$args = array(
		'dir' => $forte_theme_base,
		'slug' => $forte_theme_base,
		'version' => $forte_theme_version,
		'id' => '3888979',
		'user' => get_option('pix_content_forte_user_name'),
		'license' => get_option('pix_content_forte_license_key')
	);
	// Start checking for an update
	$send_for_check = array(
		'body' => array(
			'action' => 'theme_update', 
			'request' => serialize($args),
			'api-key' => md5(home_url())
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
	);
	$raw_response = wp_remote_post($forte_api_url, $send_for_check);

	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
		$response = unserialize($raw_response['body']);

	// Feed the update data into WP updater
	if (!empty($response)) 
		$checked_data->response[$forte_theme_base] = $response;

	return $checked_data;
}
endif;

if ( ! function_exists( 'forte_api_call' ) ) :
/**
 * Update if update is available
 */
add_filter('themes_api', 'forte_api_call', 10, 3);
function forte_api_call($res, $action, $args) {

		/*if ( isset($args->browse) ) {
            $browse = $args->browse;
            if ( in_array( $browse, $this->theme_repo ) ) {
                //Uniquely validated for our Themes
                if ( 'query_themes' == $action ) {
                    //User is querying or asking information about our themes, let's override
                    $api_boolean = true;
                }
            }
        } elseif ( isset($args->slug) ) {
            //We are installing our themes
            $theme_to_install = $args->slug;
            //Lets uniquely validate if this belongs to us
            //Check if this is OTGS theme
            $validate_check = $this->installer_themes_belong_to_us( $theme_to_install );
            if ( $validate_check ) {
                //Belongs to us
                if ( !(empty($theme_to_install)) ) {
                    $api_boolean = true;
                }
            }
        }*/

    global $forte_theme_base, $forte_theme_version, $forte_api_url;

	if (isset($args->slug) && $args->slug != $forte_theme_base) {

		// Get the current version

		$args->version = $forte_theme_version;
		$request_string = pixedelic_prepare_request($action, $args);
		$request = wp_remote_post($forte_api_url, $request_string);

		if (is_wp_error($request)) {
			$res = new WP_Error('themes_api_failed', esc_html__('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>', 'forte'), $request->get_error_message());
		} else {
			$res = unserialize($request['body']);

			if ($res === false)
				$res = new WP_Error('themes_api_failed', esc_html__('An unknown error occurred', 'forte'), $request['body']);
		}

	}

	return $res;
}
endif;

if ( !function_exists('pixedelic_prepare_request') ) :
	function pixedelic_prepare_request( $action, $args ) {
		global $wp_version;

		return array(
			'body' => array(
				'action' => $action,
				'request' => json_encode($args),
				'api-key' => md5(home_url())
			),
			'user-agent' => 'WordPress/'. $wp_version .'; '. home_url()
		);
	}
endif;

if (is_admin())
	$current = get_transient('update_themes');

if ( !function_exists( 'forte_registration_page_output' ) ) : 
function forte_registration_page_output(){

	$pix_content_forte_user_name = isset($_REQUEST['pix_content_forte_user_name']) ? $_REQUEST['pix_content_forte_user_name'] : get_option('pix_content_forte_user_name');
	$pix_content_forte_license_key = isset($_REQUEST['pix_content_forte_license_key']) ? $_REQUEST['pix_content_forte_license_key'] : get_option('pix_content_forte_license_key');
	$remove_license = isset($_REQUEST['remove_license']) ? $_REQUEST['remove_license'] : 'no';

	$context = array(
		'pix_content_forte_user_name' => $pix_content_forte_user_name,
		'pix_content_forte_license_key' => $pix_content_forte_license_key,
		'remove_license' => $remove_license
	);
    forte_check_license($context);

	foreach ($_REQUEST as $key => $value) {
		if ( $key=='pix_content_forte_user_name' || $key=="pix_content_forte_license_key" ) {
			update_option($key, $value);
		}
		
	}

	?>
        <div class="wrap" id="automatic-updates-wrap">
            <h2><?php esc_html_e('Automatic theme updates','forte'); ?></h2>

                <div id="check_license_message" class="hidden"></div>

				<form method="post" id="manage_theme_license" enctype="multipart/form-data" action="themes.php?page=forte_updates">

					<table class="form-table">
						<tbody>

						<tr class="forte-envato-user-name">
							<th>
								<label for="pix_content_forte_user_name"><?php esc_html_e( 'Your Envato user name', 'forte' ); ?>
									<br>
									<span class="description"><a href="http://www.pixedelic.com/envato-assets/pixgridder/username.jpg" target="_blank"><?php esc_html_e('what\'s that','forte'); ?></a></span>
								</label>
							</th>
							<td><input type="text" name="pix_content_forte_user_name" id="pix_content_forte_user_name" value="<?php echo stripslashes(esc_attr(get_option('pix_content_forte_user_name'))); ?>" class="regular-text"></td>
						</tr>

						<tr class="forte-envato-license-code">
							<th>
								<label for="pix_content_forte_license_key">
									<?php esc_html_e( 'Your Item Purchase Code', 'forte' ); ?>
									<br>
									<span class="description"><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-can-I-find-my-Purchase-Code-" target="_blank"><?php esc_html_e('where to find it','forte'); ?></a></span>
								</label>
							</th>
							<td><input type="text" name="pix_content_forte_license_key" id="pix_content_forte_license_key" value="<?php echo stripslashes(esc_attr(get_option('pix_content_forte_license_key'))); ?>" class="regular-text"></td>
						</tr>

					</tbody></table>

                <input type="hidden" name="register_license_details" value="register_license_details" />
                <input type="hidden" name="action" value="data_save" />
                <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>" />
                <input type="submit" class="button-primary" value="<?php esc_html_e('Check license', 'forte') ?>" />  
                <input type="hidden" name="remove_license" value="" />
                <input type="button" class="button-primary remove-license" value="<?php esc_html_e('Remove license', 'forte') ?>" />  

            </form>

        </div><!-- .wrap -->

        <script>
        jQuery(window).on('load', function(){
			if ( typeof forte_check_license != 'undefined' && forte_check_license != false && forte_check_license != null) {
				if ( ( jQuery('input[name="pix_content_forte_user_name"]').val()!='' && jQuery('input[name="pix_content_forte_license_key"]').val()!='' ) || forte_show_message == 'true' )
					jQuery('#check_license_message').html(forte_check_message).slideDown();
			}

			forte_check_license = undefined;
		});
        </script>
	<?php
}
endif;

if( get_option( 'pix_forte_update_new_notices_558' )=='' ) {
	add_action( 'admin_notices', 'forte_update_new_notices_558' );
}

if( !function_exists( 'forte_update_new_notices_558' ) ) :
function forte_update_new_notices_558() { ?>
    <div class="notice updated forte-notice is-dismissible" id="forte_dismiss_notice_updates">
        <p><?php printf( wp_kses_post( __( 'Since Forte 3.0.1 you have to enter your Envato username and product purchase code <a href="%s">on this page</a> to receive automatic updates (more details on the page itself)', 'forte' ) ), esc_url( admin_url( 'themes.php?page=forte_updates' ) ) ); ?></p>
    </div>
    <?php
}
endif;

add_action( 'wp_ajax_forte_dismiss_notice_updates', 'forte_dismiss_notice_updates' );
if ( !function_exists( 'forte_dismiss_notice_updates' ) ) :
/**
* Emtpy license code 
*/
function forte_dismiss_notice_updates() {

	update_option( 'pix_forte_update_new_notices_558', 'checked' );

	die();
}
endif; //pixedelic_remove_license_data