<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop,
	$layout,
    $pix_titles,
    $excerpt_lines,
    $pix_more,
    $query_related;

$layout = pix_get_option('pix_woo_related_layout');
$pix_titles = pix_get_option('pix_woo_related_titles');
$excerpt_lines = pix_get_option('pix_woo_related_excerpt_length');
$pix_more = pix_get_option('pix_woo_related_more');

global $product, $woocommerce_loop;

$related = $product->get_related($limit = pix_get_option('pix_woo_related_ppp'));

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
    'post_type'             => 'product',
    'ignore_sticky_posts'   => 1,
    'no_found_rows'         => 1,
    'posts_per_page'        => $limit,
    'orderby'               => $orderby,
    'post__in'              => $related,
    'post__not_in'          => array($product->id)
) );

                        if ( pix_get_option('pix_woo_related_ppp') != '0' && pix_get_option('pix_woo_related')=='true' ) { ?>
                            <?php

                            $query_related = new wp_query( $args );
                            if( $query_related->have_posts() ) {
                            echo '<hr class="double"><div id="related_posts" class="products">                        
                            <h4>'.__('Related items','forte').'</h4><div class="related_wrapper">';

                                if ( locate_template( 'loop-related.php' ) )
                                   locate_template( 'loop-related.php', true, false );

                            echo '
                            </div><!-- #related_wrapper -->
                            </div><!-- #related_posts -->';
                            }
                        }
                            


wp_reset_postdata();
