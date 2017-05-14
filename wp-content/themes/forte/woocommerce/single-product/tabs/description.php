<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 * @version     1.6.4
 */

global $woocommerce, $post;

if ( $post->post_content ) : ?>
	<div class="panel entry-content" id="tab-description">

		<?php $heading = apply_filters('woocommerce_product_description_heading', __('Product Description', 'forte')); ?>

		<h4><?php echo $heading; ?></h4>

		<?php the_content(); ?>

	</div>
<?php endif; ?>