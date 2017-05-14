<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop, $woocommerce, $product,
	$layout,
    $pix_titles,
    $excerpt_lines,
    $pix_more,
    $query_related;

$layout = pix_get_option('pix_woo_related_layout');
$pix_titles = pix_get_option('pix_woo_related_titles');
$excerpt_lines = pix_get_option('pix_woo_related_excerpt_length');
$pix_more = pix_get_option('pix_woo_related_more');

$crosssells = $woocommerce->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$meta_query = $woocommerce->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', 2 ),
	'no_found_rows'       => 1,
	'orderby'             => 'rand',
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= apply_filters( 'woocommerce_cross_sells_columns', 2 );

if ( $products->have_posts() ) : ?>

	<hr class="double"><div class="cross-sells products">

		<h4><?php _e( 'You may be interested in&hellip;', 'forte' ) ?></h4>

		<?php //woocommerce_product_loop_start(); ?>

            <?php echo '<div class="related_wrapper">';

                $query_related = new wp_query( $args );
                if ( locate_template( 'loop-related.php' ) )
                   locate_template( 'loop-related.php', true, false );

            echo '
            </div><!-- #related_wrapper -->'; ?>

		<?php //woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_query();