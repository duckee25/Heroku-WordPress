<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.2
 * @version     2.5.0
 * @version     2.4.0
 */

	global $layout, $thumb_size, $excerpt_lines, $woocommerce_loop;

	switch ($layout) {
		case 'default' :
			$thumb_size = 'two_columns_thumb';
			$column_size = 'pix_column_470';
			$thumb_width = 470;
			$thumb_height = 264;
			$clear = '';
			break;
		case 'first' :
			$thumb_size = 'two_columns_4_3';
			$column_size = 'pix_column_470';
			$thumb_width = 470;
			$thumb_height = 352;
			$clear = '';
			break;
		case 'second' :
			$thumb_size = 'one_column_thumb';
			$column_size = 'pix_column_210';
			$thumb_width = 210;
			$thumb_height = 132;
			$clear = '';
			break;
		case 'third' :
			$thumb_size = 'one_column_4_3';
			$column_size = 'pix_column_210';
			$thumb_width = 210;
			$thumb_height = 157;
			$clear = '';
			break;
		case 'fourth' :
			$thumb_size = ($page_template != 'default') ? 'three_columns_thumb' : 'three_columns';
			$column_size = 'pix_column_730';
			$thumb_width = 730;
			$thumb_height = 410;
			$clear = ($page_template != 'default') ? '' : 'clear';
			break;
		case 'fifth' :
			$thumb_size = ($page_template != 'default') ? 'four_columns' : 'three_columns';
			$column_size = ($page_template != 'default') ? 'pix_column_990' : 'pix_column_730';
			$thumb_width = ($page_template != 'default') ? 990 : 730;;
			$thumb_height = 'auto';
			$clear = 'clear';
			break;
		case 'sixth':
		case 'sixth_bis' :
			$thumb_size = 'one_column_4_3';
			$column_size = 'pix_column_210';
			$thumb_width = 210;
			$thumb_height = 157;
			$sidebar_print = 'true';
			$data_cols = ( !isset($page_template) || $page_template == 'default' ) ? '3' : '4';
			break;
		case 'seventh' :
		case 'seventh_bis' :
			$thumb_size = 'two_columns_4_3';
			$column_size = 'pix_column_470 pix_column_4_3';
			$thumb_width = 470;
			$thumb_height = 352;
			$sidebar_print = 'false';
			$data_cols = '2';
			break;
		case 'eighth' :
		case 'eighth_bis' :
			$thumb_size = 'two_columns_thumb';
			$column_size = 'pix_column_470';
			$thumb_width = 470;
			$thumb_height = 264;
			$sidebar_print = 'false';
			$data_cols = '2';
			break;
		case 'ninth' :
			$thumb_size = 'two_columns_4_3';
			$column_size = 'pix_column_470 pix_column_4_3';
			$thumb_width = 470;
			$thumb_height = 352;
			$clear = '';
			break;
		case 'tenth' :
			$thumb_size = 'two_columns_thumb';
			$column_size = 'pix_column_470';
			$thumb_width = 470;
			$thumb_height = 264;
			$clear = '';
			break;
		default:
			$thumb_size = 'one_column';
			$column_size = 'pix_column_210';
			$thumb_width = 210;
			$thumb_height = 'auto';
			$sidebar_print = 'true';
			$data_cols = ( !isset($page_template) || $page_template == 'default' ) ? '3' : '4';
			break;
	}

	$classes = array('entry','alignleft','category-id-' .$category->name);
	$woocommerce_loop['columns'] = $data_cols;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>

<div <?php wc_product_cat_class( $classes, $category ); ?> data-sort="all <?php echo $category->slug; ?> ">
<?php 
	switch ( $layout ) {
        case 'sixth':
        case 'sixth_bis':
        case 'seventh':
        case 'seventh_bis':
        case 'eighth':
        case 'eighth_bis':
?>

	<div class="pix_column pix_column_thumb <?php echo $column_size; ?> alignleft">

		<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

			<?php
				/**
				 * woocommerce_before_subcategory_title hook
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );
			?>
		</a>

		<div class="entry-content">
			<h5>
				<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
					<?php
					echo $category->name;

					if ( $category->count > 0 )
						echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
				?>
				</a>
			</h5>

				<?php
					/**
					 * woocommerce_after_subcategory_title hook
					 */
					do_action( 'woocommerce_after_subcategory_title', $category );
				?>


			<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
		</div><!-- .entry-content -->

	</div><!-- .pix_column_thumb -->

<?php
		break;
		case 'ninth':
		case 'tenth':
?>

	<div class="pix_column pix_column_thumb <?php echo $column_size; ?> alignleft">

		<div class="entry-sliding-content">
			<h5>
				<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
					<?php
					echo $category->name;

					if ( $category->count > 0 )
						echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
				?>
				</a>
			</h5>
				<?php
					/**
					 * woocommerce_after_subcategory_title hook
					 */
					do_action( 'woocommerce_after_subcategory_title', $category );
				?>


			<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
		</div><!-- .entry-sliding-content -->

		<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

			<?php
				/**
				 * woocommerce_before_subcategory_title hook
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );
			?>
		</a>

	</div><!-- .pix_column_thumb -->

<?php
		break;
		default:
?>

	<h4>
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
			<?php
			echo $category->name;

			if ( $category->count > 0 )
				echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
		?>
		</a>
	</h4>
				<?php
					/**
					 * woocommerce_after_subcategory_title hook
					 */
					do_action( 'woocommerce_after_subcategory_title', $category );
				?>

		<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<div class="pix_column pix_column_thumb pix_column_featured <?php echo $column_size; ?> alignleft">
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

			<?php
				/**
				 * woocommerce_before_subcategory_title hook
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );
			?>
		</a>
	</div><!-- .pix_column_thumb -->

	<span class="<?php echo $clear; ?>"></span><div class="entry-summary" data-lines="<?php echo $excerpt_lines; ?>"><?php echo html5autop($category->description); ?></div>

			<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
<?php
	}
?>
</div><!-- .entry -->
