<?php
if ( version_compare( WOOCOMMERCE_VERSION, '2.0.1000', '>=' ) ) {
/**
 * Order details
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$order = new WC_Order( $order_id );
?>
<h2><?php _e( 'Order Details', 'woocommerce' ); ?></h2>
<table class="shop_table order_details">
	<thead>
		<tr>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tfoot>
	<?php
		if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) :
			?>
			<tr>
				<th scope="row"><?php echo $total['label']; ?></th>
				<td><?php echo $total['value']; ?></td>
			</tr>
			<?php
		endforeach;
	?>
	</tfoot>
	<tbody>
		<?php
		if ( sizeof( $order->get_items() ) > 0 ) {

			foreach( $order->get_items() as $item ) {
				$_product     = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
				$item_meta    = new WC_Order_Item_Meta( $item['item_meta'] );

				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
					<td class="product-name">
						<?php
							if ( $_product && ! $_product->is_visible() )
								echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
							else
								echo apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item );

							echo apply_filters( 'woocommerce_order_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item );

							$item_meta->display();

							if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {

								$download_files = $order->get_item_downloads( $item );
								$i              = 0;
								$links          = array();

								foreach ( $download_files as $download_id => $file ) {
									$i++;

									$links[] = '<small><a href="' . esc_url( $file['download_url'] ) . '">' . sprintf( __( 'Download file%s', 'woocommerce' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file['name'] ) . '</a></small>';
								}

								echo '<br/>' . implode( '<br/>', $links );
							}
						?>
					</td>
					<td class="product-total">
						<?php echo $order->get_formatted_line_subtotal( $item ); ?>
					</td>
				</tr>
				<?php

				if ( in_array( $order->status, array( 'processing', 'completed' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
					?>
					<tr class="product-purchase-note">
						<td colspan="3"><?php echo apply_filters( 'the_content', $purchase_note ); ?></td>
					</tr>
					<?php
				}
			}
		}

		do_action( 'woocommerce_order_items_table', $order );
		?>
	</tbody>
</table>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<header>
	<h2><?php _e( 'Customer details', 'woocommerce' ); ?></h2>
</header>
<dl class="customer_details">
<?php
	if ($order->billing_email) echo '<dt>'.__( 'Email:', 'woocommerce' ).'</dt><dd>'.$order->billing_email.'</dd>';
	if ($order->billing_phone) echo '<dt>'.__( 'Telephone:', 'woocommerce' ).'</dt><dd>'.$order->billing_phone.'</dd>';

	// Additional customer details hook
	do_action( 'woocommerce_order_details_after_customer_details', $order );
?>
</dl>

<?php if (get_option('woocommerce_ship_to_billing_address_only')=='no' && get_option('woocommerce_calc_shipping') !== 'no' ) : ?>

<div class="col2-set addresses">

	<div class="col-1">

<?php endif; ?>

		<header class="title">
			<h3><?php _e( 'Billing Address', 'woocommerce' ); ?></h3>
		</header>
		<address><p>
			<?php
				if (!$order->get_formatted_billing_address()) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_billing_address();
			?>
		</p></address>

<?php if (get_option('woocommerce_ship_to_billing_address_only')=='no' && get_option('woocommerce_calc_shipping') !== 'no' ) : ?>

	</div><!-- /.col-1 -->

	<div class="col-2">

		<header class="title">
			<h3><?php _e( 'Shipping Address', 'woocommerce' ); ?></h3>
		</header>
		<address><p>
			<?php
				if (!$order->get_formatted_shipping_address()) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_shipping_address();
			?>
		</p></address>

	</div><!-- /.col-2 -->

</div><!-- /.col2-set -->

<?php endif; ?>

<div class="clear"></div>
<?php
/**
 * Review order form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

} elseif ( version_compare( WOOCOMMERCE_VERSION, '2.0', '>=' ) && version_compare( WOOCOMMERCE_VERSION, '2.1', '<' ) ) {
	/**************************
	    WOOCOMMERCE >= 2.0.0
	**************************/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$available_methods = $woocommerce->shipping->get_available_shipping_methods();
?>
<div id="order_review">

	<table class="shop_table">
		<thead>
			<tr>
				<th class="product-name"><?php _e( 'Product', 'forte' ); ?></th>
				<th class="product-total"><?php _e( 'Total', 'forte' ); ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr class="cart-subtotal">
				<th><?php _e( 'Cart Subtotal', 'forte' ); ?></th>
				<td><?php echo $woocommerce->cart->get_cart_subtotal(); ?></td>
			</tr>

			<?php if ( $woocommerce->cart->get_discounts_before_tax() ) : ?>

			<tr class="discount">
				<th><?php _e( 'Cart Discount', 'forte' ); ?></th>
				<td>-<?php echo $woocommerce->cart->get_discounts_before_tax(); ?></td>
			</tr>

			<?php endif; ?>

			<?php if ( $woocommerce->cart->needs_shipping() && $woocommerce->cart->show_shipping() ) : ?>

				<?php do_action('woocommerce_review_order_before_shipping'); ?>

				<tr class="shipping">
					<th><?php _e( 'Shipping', 'forte' ); ?></th>
					<td><?php woocommerce_get_template( 'cart/shipping-methods.php', array( 'available_methods' => $available_methods ) ); ?></td>
				</tr>

				<?php do_action('woocommerce_review_order_after_shipping'); ?>

			<?php endif; ?>

			<?php foreach ( $woocommerce->cart->get_fees() as $fee ) : ?>

				<tr class="fee fee-<?php echo $fee->id ?>">
					<th><?php echo $fee->name ?></th>
					<td><?php
						if ( $woocommerce->cart->tax_display_cart == 'excl' )
							echo woocommerce_price( $fee->amount );
						else
							echo woocommerce_price( $fee->amount + $fee->tax );
					?></td>
				</tr>

			<?php endforeach; ?>

			<?php
				// Show the tax row if showing prices exlcusive of tax only
				if ( $woocommerce->cart->tax_display_cart == 'excl' ) {

					$taxes = $woocommerce->cart->get_formatted_taxes();

					if ( sizeof( $taxes ) > 0 ) {

						$has_compound_tax = false;

						foreach ( $taxes as $key => $tax ) {
							if ( $woocommerce->cart->tax->is_compound( $key ) ) {
								$has_compound_tax = true;
								continue;
							}
							?>
							<tr class="tax-rate tax-rate-<?php echo $key; ?>">
								<th><?php echo $woocommerce->cart->tax->get_rate_label( $key ); ?></th>
								<td><?php echo $tax; ?></td>
							</tr>
							<?php
						}

						if ( $has_compound_tax ) {
							?>
							<tr class="order-subtotal">
								<th><?php _e( 'Subtotal', 'forte' ); ?></th>
								<td><?php echo $woocommerce->cart->get_cart_subtotal( true ); ?></td>
							</tr>
							<?php
						}

						foreach ( $taxes as $key => $tax ) {
							if ( ! $woocommerce->cart->tax->is_compound( $key ) )
								continue;
							?>
							<tr class="tax-rate tax-rate-<?php echo $key; ?>">
								<th><?php echo $woocommerce->cart->tax->get_rate_label( $key ); ?></th>
								<td><?php echo $tax; ?></td>
							</tr>
							<?php
						}

					} elseif ( $woocommerce->cart->get_cart_tax() ) {
						?>
						<tr class="tax">
							<th><?php _e( 'Tax', 'forte' ); ?></th>
							<td><?php echo $woocommerce->cart->get_cart_tax(); ?></td>
						</tr>
						<?php
					}
				}
			?>

			<?php if ($woocommerce->cart->get_discounts_after_tax()) : ?>

			<tr class="discount">
				<th><?php _e( 'Order Discount', 'forte' ); ?></th>
				<td>-<?php echo $woocommerce->cart->get_discounts_after_tax(); ?></td>
			</tr>

			<?php endif; ?>

			<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

			<tr class="total">
				<th><strong><?php _e( 'Order Total', 'forte' ); ?></strong></th>
				<td>
					<strong><?php echo $woocommerce->cart->get_total(); ?></strong>
					<?php
						// If prices are tax inclusive, show taxes here
						if ( $woocommerce->cart->tax_display_cart == 'incl' ) {
							$tax_string_array = array();
							$taxes = $woocommerce->cart->get_formatted_taxes();

							if ( sizeof( $taxes ) > 0 ) {
								foreach ( $taxes as $key => $tax ) {
									$tax_string_array[] = sprintf( '%s %s', $tax, $woocommerce->cart->tax->get_rate_label( $key ) );
								}
							} elseif ( $woocommerce->cart->get_cart_tax() ) {
								$tax_string_array[] = sprintf( '%s tax', $tax );
							}

							if ( ! empty( $tax_string_array ) ) {
								?><small class="includes_tax"><?php printf( __( '(Includes %s)', 'forte' ), implode( ', ', $tax_string_array ) ); ?></small><?php
							}
						}
					?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

		</tfoot>
		<tbody>
			<?php
				do_action( 'woocommerce_review_order_before_cart_contents' );

				if (sizeof($woocommerce->cart->get_cart())>0) :
					foreach ($woocommerce->cart->get_cart() as $item_id => $values) :
						$_product = $values['data'];
						if ($_product->exists() && $values['quantity']>0) :
							echo '
								<tr class="' . esc_attr( apply_filters('woocommerce_checkout_table_item_class', 'checkout_table_item', $values, $item_id ) ) . '">
									<td class="product-name">' . $_product->get_title().$woocommerce->cart->get_item_data( $values ) . ' <strong class="product-quantity">&times; ' . $values['quantity'] . '</strong></td>
									<td class="product-total">' . apply_filters( 'woocommerce_checkout_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $item_id ) . '</td>
								</tr>';
						endif;
					endforeach;
				endif;

				do_action( 'woocommerce_review_order_after_cart_contents' );
			?>
		</tbody>
	</table>

	<div id="payment">
		<?php if ($woocommerce->cart->needs_payment()) : ?>
		<ul class="payment_methods methods">
			<?php
				$available_gateways = $woocommerce->payment_gateways->get_available_payment_gateways();
				if ( ! empty( $available_gateways ) ) {

					// Chosen Method
					if ( isset( $woocommerce->session->chosen_payment_method ) && isset( $available_gateways[ $woocommerce->session->chosen_payment_method ] ) ) {
						$available_gateways[ $woocommerce->session->chosen_payment_method ]->set_current();
					} elseif ( isset( $available_gateways[ get_option( 'woocommerce_default_gateway' ) ] ) ) {
						$available_gateways[ get_option( 'woocommerce_default_gateway' ) ]->set_current();
					} else {
						current( $available_gateways )->set_current();
					}

					foreach ( $available_gateways as $gateway ) {
						?>
						<li>
							<input type="radio" id="payment_method_<?php echo $gateway->id; ?>" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> />
							<label for="payment_method_<?php echo $gateway->id; ?>"><?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?></label>
							<?php
								if ( $gateway->has_fields() || $gateway->get_description() ) :
									echo '<div class="payment_box payment_method_' . $gateway->id . '" ' . ( $gateway->chosen ? '' : 'style="display:none;"' ) . '>';
									$gateway->payment_fields();
									echo '</div>';
								endif;
							?>
						</li>
						<?php
					}
				} else {

					if ( ! $woocommerce->customer->get_country() )
						echo '<p>' . __( 'Please fill in your details above to see available payment methods.', 'forte' ) . '</p>';
					else
						echo '<p>' . __( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'forte' ) . '</p>';

				}
			?>
		</ul>
		<?php endif; ?>

		<div class="form-row place-order">

			<noscript><?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'forte' ); ?><br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php _e( 'Update totals', 'forte' ); ?>" /></noscript>

			<?php wp_nonce_field('process_checkout')?>

			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

			<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="<?php echo apply_filters('woocommerce_order_button_text', __( 'Place order', 'forte' )); ?>" />

			<?php if (woocommerce_get_page_id('terms')>0) : ?>
			<p class="form-row terms">
				<input type="checkbox" class="input-checkbox" name="terms" <?php checked( isset( $_POST['terms'] ), true ); ?> id="terms" />
				<label for="terms" class="checkbox"><?php _e( 'I have read and accept the', 'forte' ); ?> <a href="<?php echo esc_url( get_permalink(woocommerce_get_page_id('terms')) ); ?>" target="_blank"><?php _e( 'terms &amp; conditions', 'forte' ); ?></a></label>
			</p>
			<?php endif; ?>

			<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		</div>

		<div class="clear"></div>

	</div>

</div>

<?php } else {
global $woocommerce;

$available_methods = $woocommerce->shipping->get_available_shipping_methods();
?>
<div id="order_review">

	<table class="shop_table">
		<thead>
			<tr>
				<th class="product-name"><?php _e('Product', 'forte'); ?></th>
				<th class="product-quantity"><?php _e('Qty', 'forte'); ?></th>
				<th class="product-total"><?php _e('Totals', 'forte'); ?></th>
			</tr>
		</thead>
		<tfoot>

			<tr class="cart-subtotal">
				<th colspan="2"><strong><?php _e('Cart Subtotal', 'forte'); ?></strong></th>
				<td><?php echo $woocommerce->cart->get_cart_subtotal(); ?></td>
			</tr>

			<?php if ($woocommerce->cart->get_discounts_before_tax()) : ?>

			<tr class="discount">
				<th colspan="2"><?php _e('Cart Discount', 'forte'); ?></th>
				<td>-<?php echo $woocommerce->cart->get_discounts_before_tax(); ?></td>
			</tr>

			<?php endif; ?>

			<?php if ( $woocommerce->cart->needs_shipping() && $woocommerce->cart->show_shipping() ) : ?>

			<?php do_action('woocommerce_review_order_before_shipping'); ?>

			<tr class="shipping">
				<th colspan="2"><?php _e('Shipping', 'forte'); ?></th>
				<td>
				<?php
					// If at least one shipping method is available
					if ( $available_methods ) {

						// Prepare text labels with price for each shipping method
						foreach ( $available_methods as $method ) {
							$method->full_label = esc_html( $method->label );

							if ( $method->cost > 0 ) {
								$method->full_label .= ': ';

								// Append price to label using the correct tax settings
								if ( $woocommerce->cart->display_totals_ex_tax || ! $woocommerce->cart->prices_include_tax ) {
									$method->full_label .= woocommerce_price( $method->cost );
									if ( $method->get_shipping_tax() > 0 && $woocommerce->cart->prices_include_tax ) {
										$method->full_label .= ' '.$woocommerce->countries->ex_tax_or_vat();
									}
								} else {
									$method->full_label .= woocommerce_price( $method->cost + $method->get_shipping_tax() );
									if ( $method->get_shipping_tax() > 0 && ! $woocommerce->cart->prices_include_tax ) {
										$method->full_label .= ' '.$woocommerce->countries->inc_tax_or_vat();
									}
								}
							}
						}

						// Print a single available shipping method as plain text
						if ( 1 === count( $available_methods ) ) {

							echo $method->full_label;
							echo '<input type="hidden" name="shipping_method" id="shipping_method" value="'.esc_attr( $method->id ).'">';

						// Show multiple shipping methods
						} else {

							if ( get_option('woocommerce_shipping_method_format') == 'select' ) {

								echo '<select name="shipping_method" id="shipping_method">';

								foreach ( $available_methods as $method )
									echo '<option value="' . esc_attr( $method->id ) . '" ' . selected( $method->id, $_SESSION['_chosen_shipping_method'], false ) . '>' . strip_tags( $method->full_label ) . '</option>';

								echo '</select>';

							} else {


								echo '<ul id="shipping_method">';

								foreach ( $available_methods as $method )
									echo '<li><input type="radio" name="shipping_method" id="shipping_method_' . sanitize_title( $method->id ) . '" value="' . esc_attr( $method->id ) . '" ' . checked( $method->id, $_SESSION['_chosen_shipping_method'], false) . ' /> <label for="shipping_method_' . sanitize_title( $method->id ) . '">' . $method->full_label . '</label></li>';

								echo '</ul>';

							}

						}

					// No shipping methods are available
					} else {

						if ( ! $woocommerce->customer->get_shipping_country() || ! $woocommerce->customer->get_shipping_state() || ! $woocommerce->customer->get_shipping_postcode() ) {
							echo '<p>'.__('Please fill in your details above to see available shipping methods.', 'forte').'</p>';
						} else {
							echo '<p>'.__('Sorry, it seems that there are no available shipping methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'forte').'</p>';
						}

					}
				?></td>

			</tr>

			<?php do_action('woocommerce_review_order_after_shipping'); ?>

			<?php endif; ?>

			<?php
				if ($woocommerce->cart->get_cart_tax()) :

					$taxes = $woocommerce->cart->get_formatted_taxes();

					if (sizeof($taxes)>0) :

						$has_compound_tax = false;

						foreach ($taxes as $key => $tax) : if ($woocommerce->cart->tax->is_compound( $key )) : $has_compound_tax = true; continue; endif;

							?>
							<tr class="tax-rate tax-rate-<?php echo $key; ?>">
								<th colspan="2"><?php
									if ( get_option('woocommerce_prices_include_tax') == 'yes' )
										_e('incl.&nbsp;', 'forte');
									echo $woocommerce->cart->tax->get_rate_label( $key );
								?></th>
								<td><?php echo $tax; ?></td>
							</tr>
							<?php

						endforeach;

						if ($has_compound_tax && !$woocommerce->cart->prices_include_tax) :
							?>
							<tr class="order-subtotal">
								<th colspan="2"><strong><?php _e('Order Subtotal', 'forte'); ?></strong></th>
								<td><?php echo $woocommerce->cart->get_cart_subtotal( true ); ?></td>
							</tr>
							<?php
						endif;

						foreach ($taxes as $key => $tax) : if (!$woocommerce->cart->tax->is_compound( $key )) continue;

							?>
							<tr class="tax-rate tax-rate-<?php echo $key; ?>">
								<th colspan="2"><?php
									if ( get_option('woocommerce_prices_include_tax') == 'yes' )
										_e('incl.&nbsp;', 'forte');
									echo $woocommerce->cart->tax->get_rate_label( $key );
								?></th>
								<td><?php echo $tax; ?></td>
							</tr>
							<?php

						endforeach;

					else :

						?>
						<tr class="tax">
							<th colspan="2"><?php echo $woocommerce->countries->tax_or_vat(); ?></th>
							<td><?php echo $woocommerce->cart->get_cart_tax(); ?></td>
						</tr>
						<?php

					endif;
				elseif ( get_option( 'woocommerce_display_cart_taxes_if_zero' ) == 'yes' ) :
				?>

					<tr class="tax">
						<th colspan="2"><?php echo $woocommerce->countries->tax_or_vat(); ?></th>
						<td><?php _ex( 'N/A', 'Relating to tax', 'forte' ); ?></td>
					</tr>

				<?php
				endif;
			?>

			<?php if ($woocommerce->cart->get_discounts_after_tax()) : ?>

			<tr class="discount">
				<th colspan="2"><?php _e('Order Discount', 'forte'); ?></th>
				<td>-<?php echo $woocommerce->cart->get_discounts_after_tax(); ?></td>
			</tr>

			<?php endif; ?>

			<?php do_action('woocommerce_before_order_total'); ?>

			<tr class="total">
				<th colspan="2"><strong><?php _e('Order Total', 'forte'); ?></strong></th>
				<td><strong><?php echo $woocommerce->cart->get_total(); ?></strong></td>
			</tr>

			<?php do_action('woocommerce_after_order_total'); ?>

		</tfoot>
		<tbody>
			<?php
				if (sizeof($woocommerce->cart->get_cart())>0) :
					foreach ($woocommerce->cart->get_cart() as $item_id => $values) :
						$_product = $values['data'];
						if ($_product->exists() && $values['quantity']>0) :
							echo '
								<tr class = "' . esc_attr( apply_filters('woocommerce_checkout_table_item_class', 'checkout_table_item', $values, $item_id ) ) . '">
									<td class="product-name">'.$_product->get_title().$woocommerce->cart->get_item_data( $values ).'</td>
									<td class="product-quantity">'.$values['quantity'].'</td>
									<td class="product-total">' . apply_filters( 'woocommerce_checkout_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $item_id ) . '</td>
								</tr>';
						endif;
					endforeach;
				endif;

				do_action( 'woocommerce_cart_contents_review_order' );
			?>
		</tbody>
	</table>

	<div id="payment">
		<?php if ($woocommerce->cart->needs_payment()) : ?>
		<ul class="payment_methods methods">
			<?php
				$available_gateways = $woocommerce->payment_gateways->get_available_payment_gateways();
				if ($available_gateways) :
					// Chosen Method
					if (sizeof($available_gateways)) :
						$default_gateway = get_option('woocommerce_default_gateway');
						if (isset($_SESSION['_chosen_payment_method']) && isset($available_gateways[$_SESSION['_chosen_payment_method']])) :
							$available_gateways[$_SESSION['_chosen_payment_method']]->set_current();
						elseif (isset($available_gateways[$default_gateway])) :
							$available_gateways[$default_gateway]->set_current();
						else :
							current($available_gateways)->set_current();
						endif;
					endif;
					foreach ($available_gateways as $gateway ) :
						?>
						<li>
						<input type="radio" id="payment_method_<?php echo $gateway->id; ?>" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php if ($gateway->chosen) echo 'checked="checked"'; ?> />
						<label for="payment_method_<?php echo $gateway->id; ?>"><?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?></label>
							<?php
								if ( $gateway->has_fields() || $gateway->get_description() ) :
									echo '<div class="payment_box payment_method_'.$gateway->id.'" style="display:none;">';
									$gateway->payment_fields();
									echo '</div>';
								endif;
							?>
						</li>
						<?php
					endforeach;
				else :

					if ( !$woocommerce->customer->get_country() ) :
						echo '<p>'.__('Please fill in your details above to see available payment methods.', 'forte').'</p>';
					else :
						echo '<p>'.__('Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'forte').'</p>';
					endif;

				endif;
			?>
		</ul>
		<?php endif; ?>

		<div class="form-row place-order">

			<noscript><?php _e('Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'forte'); ?><br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php _e('Update totals', 'forte'); ?>" /></noscript>

			<?php wp_nonce_field('process_checkout')?>

			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

			<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="<?php echo apply_filters('woocommerce_order_button_text', __('Place order', 'forte')); ?>" />

			<?php if (woocommerce_get_page_id('terms')>0) : ?>
			<p class="form-row terms">
				<label for="terms" class="checkbox"><?php _e('I accept the', 'forte'); ?> <a href="<?php echo esc_url( get_permalink(woocommerce_get_page_id('terms')) ); ?>" target="_blank"><?php _e('terms &amp; conditions', 'forte'); ?></a></label>
				<input type="checkbox" class="input-checkbox" name="terms" <?php if (isset($_POST['terms'])) echo 'checked="checked"'; ?> id="terms" />
			</p>
			<?php endif; ?>

			<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		</div>

		<div class="clear"></div>

	</div>

</div><?php } ?>
