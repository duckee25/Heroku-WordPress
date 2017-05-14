<?php
/**
 * Add a new field in the post editor to add photo credit for featured images.
 *
 */




// return true to enable the photo credit feature in the theme
function KTT_photo_credit_feature_enabled() {
	return true;
}






/**
 * Adds a meta box to the post editing screen
 */
function KTT_photo_credit_meta() {
    add_meta_box( 'KTT_photo_credit', __( 'Featured photo credit', THEME_TEXTDOMAIN ), 'KTT_photo_credit_meta_callback', 'post', 'side', 'low');
}

// META BOX FORM
function KTT_photo_credit_meta_callback( $post ) {

    $credit = get_post_meta($post->ID, ktt_var_name('photo_credit'), true);

    $settings = array(
    	'wpautop' => false,
    	'media_buttons' => false,
    	'textarea_name' => ktt_var_name('photo_credit'),
    	'textarea_rows' => 5,
    	//'teeny' 	=> true,
    	'quicktags' => false,
    	'tinymce' => array(
        				'toolbar1'=> 'bold,italic,underline,link,unlink,forecolor'
      	),

    );

    ?>

    <p><?php _e('Insert the photo credit of the featured image for this article.',THEME_TEXTDOMAIN);?></p>
    <?php
    wp_editor( $credit, ktt_var_name('photo_credit'), $settings );
}


// SAVE 
function KTT_photo_credit_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 

    $vars = array(
    		ktt_var_name('photo_credit'),
    	);


    // Checks for input and sanitizes/saves if needed
    foreach ($vars as $var) {
	    if( isset( $_POST[ $var ] ) ) {
	        update_post_meta( $post_id, $var, $_POST[ $var ] );
	    }
	}
 
}


if (KTT_photo_credit_feature_enabled()) add_action( 'add_meta_boxes', 'KTT_photo_credit_meta' );
if (KTT_photo_credit_feature_enabled()) add_action( 'save_post', 'KTT_photo_credit_meta_save' );


?>