<?php
/**
 * Grouped product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.7
 * @version     2.1.0
 * @version     1.6.4
 */

global $product, $post;

$parent_product_post = $post;

// Put grouped products into an array
$grouped_products = array();
$quantites_required = false;

foreach ( $product->get_children() as $child_id ) {
	$child_product = $product->get_child( $child_id );

	if ( ! $child_product->is_sold_individually() && ! $child_product->is_type('external') )
		$quantites_required = true;

	$grouped_products[] = array(
		'product' => $child_product,
		'availability' => $child_product->get_availability()
	);
}
?>

<?php do_action('woocommerce_before_add_to_cart_form'); ?>

<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>
	<table cellspacing="0" class="group_table">
		<tbody>
				<tr>
					<td>
						<hr>
					</td>
				</tr>
			<?php $i = 1; foreach ( $grouped_products as $child_product ) : ?>
				<tr>

					<td class="label"><label for="product-<?php echo $child_product['product']->id; ?>"><?php

						if ($child_product['product']->is_visible())
							echo '<h5><a href="' . get_permalink( $child_product['product']->id ) . '">' . $child_product['product']->post->post_title . '</a></h5>';
						else
							echo $child_product['product']->post->post_title;

					?></label></td>

				</tr>

				<tr>

					<td class="price">
						<?php if ( has_post_thumbnail() ) {
							echo get_the_post_thumbnail($child_product['product']->id, 'mid_th' ); 
						} ?>
						<span class="amount"><?php echo $child_product['product']->get_price_html(); ?></span>
					<?php echo apply_filters( 'woocommerce_stock_html', '<small class="stock '.$child_product['availability']['class'].'">'.$child_product['availability']['availability'].'</small>', $child_product['availability']['availability'] ); ?>
					</td>
				</tr>

				<tr>
					<td>
						<?php if ( $child_product['product']->is_type('external') ) :

							$product_url = get_post_meta( $child_product['product']->id, '_product_url', true );
							$button_text = get_post_meta( $child_product['product']->id, '_button_text', true );
							?>

							<a href="<?php echo $product_url; ?>" rel="nofollow" class="button alt"><?php echo apply_filters('single_add_to_cart_text', $button_text, 'external'); ?></a>

						<?php elseif ( ! $quantites_required ) : ?>

							<button type="submit" name="quantity[<?php echo $child_product['product']->id; ?>]" value="1" class="single_add_to_cart_button button pix_button third_color alt"><?php _e('Add to cart', 'forte'); ?></button>

						<?php else : ?>

							<?php woocommerce_quantity_input( array( 'input_name' => 'quantity['.$child_product['product']->id.']', 'input_value' => '0' ) ); ?>

						<?php endif; ?>
					</td>
				</tr>

			<?php $i++; endforeach;

				// Reset to parent grouped product
				$post    = $parent_product_post;
				$product = get_product( $parent_product_post->ID );
				setup_postdata( $parent_product_post );
			 ?>
				<tr>
					<td>
						<hr>
					</td>
				</tr>
		</tbody>
	</table>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

	<?php if ( $quantites_required ) : ?>

		<?php do_action('woocommerce_before_add_to_cart_button'); ?>

		<button type="submit" class="single_add_to_cart_button button pix_button third_color alt"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'forte'), $product->product_type); ?></button>

		<?php do_action('woocommerce_after_add_to_cart_button'); ?>

	<?php endif; ?>

</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>