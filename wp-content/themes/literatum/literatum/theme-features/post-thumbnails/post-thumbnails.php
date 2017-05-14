<?php
/**
 * Enable support for Post Thumbnails on posts and pages.
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
 *
 *
 * @package Amanda
 */
add_theme_support( 'post-thumbnails' ); 





// Additional Image Sizes

function KTT_setup_image_sizes() {

    if ( function_exists( 'add_image_size' ) ) {
        add_image_size( 'square500', 500, 500, true );
        add_image_size( 'small', 200, 200 );
    }

    function KTT_my_image_sizes($sizes){
        $custom_sizes = array(
            'small' => 'Small',
            'square500' => 'Square 500'
        );
        return array_merge( $sizes, $custom_sizes );
    }

    add_filter('image_size_names_choose', 'KTT_my_image_sizes');
}

add_action( 'after_setup_theme', 'KTT_setup_image_sizes' );




// change the default gallery image size to the new square500

function KTT_gallery_shortcode_defaults( $out, $pairs, $atts ) {

    if(!$out['size'] || $out['size'] == 'thumbnail') $out['size'] = 'square500';
    return $out;
}
add_filter( 'shortcode_atts_gallery', 'KTT_gallery_shortcode_defaults', 10, 3 );

?>