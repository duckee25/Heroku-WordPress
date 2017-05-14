<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce, $woocommerce_loop,
	$layout,
    $pix_titles,
    $excerpt_lines,
    $pix_more,
    $query_related;

$layout = pix_get_option('pix_woo_related_layout');
$pix_titles = pix_get_option('pix_woo_related_titles');
$excerpt_lines = pix_get_option('pix_woo_related_excerpt_length');
$pix_more = pix_get_option('pix_woo_related_more');


$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = $woocommerce->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$woocommerce_loop['columns'] 	= $columns;


    $query_related = new wp_query( $args );
    if( $query_related->have_posts() ) {
    echo '<hr class="double"><div id="related_posts" class="products">                        
    <h4>'.__('You may also like&hellip;','forte').'</h4><div class="related_wrapper">';

        if ( locate_template( 'loop-related.php' ) )
           locate_template( 'loop-related.php', true, false );

    echo '
    </div><!-- #related_wrapper -->
    </div><!-- #related_posts -->';
    }
                            

wp_reset_postdata();
