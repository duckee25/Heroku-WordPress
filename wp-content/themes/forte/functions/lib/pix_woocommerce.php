<?php
add_theme_support( 'woocommerce' );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action( 'woocommerce_before_single_product', 'woocommerce_show_messages', 10 );
remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if ( version_compare( WOOCOMMERCE_VERSION, '2.0.1000', '>=' ) ) {
	add_action( 'woocommerce_single_product_summary', 'wc_print_notices', 5 );
} else {
	add_action( 'woocommerce_single_product_summary', 'woocommerce_show_messages', 5 );
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_after_single_title', 7 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_after_single_summary', 100 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_images', 6 );

add_filter( 'woocommerce_enqueue_styles', '__return_false' );
//define('WOOCOMMERCE_USE_CSS', false);

add_action( 'wp_enqueue_scripts', 'pix_remove_fbox', 99 );
add_action( 'wp_enqueue_scripts', 'pix_remove_fbox', 99 );
function pix_remove_fbox() {
	wp_dequeue_style( 'woocommerce_fancybox_styles' );
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	wp_dequeue_script( 'fancybox' ); 
	wp_dequeue_script( 'prettyPhoto' ); 
	wp_dequeue_script( 'prettyPhoto-init' ); 
}

/*=========================================================================================*/

function woocommerce_content() {
	pix_woocommerce_content();
}

if (!function_exists('pix_woocommerce_content')) {
function pix_woocommerce_content() {
	
	global $post, 
		$layout, 
		$posts_per_page, 
		$pagenavi, 
		$pix_sort, 
		$page_template, 
		$excerpt_lines, 
		$the_post_type,
		$pix_order,
		$pix_sort_by_tag,
		$pix_price,
		$product,
		$woocommerce;


	$id_shop = woocommerce_get_page_id('shop');

	$posts_per_page = pix_get_option('pix_woocommerce_ppp');

	$pagenavi = pix_get_option('pix_shop_pagenavi');

	$excerpt_lines = pix_get_option('pix_woo_length');

	$the_post_type = 'product';

	if ( is_search() ) { 
	    $layout = have_posts() ? pix_get_option('pix_woo_layout') : 'first';
	    $page_template = have_posts() ? pix_get_option('pix_woo_template') : pix_get_option('pix_search_template');
	    $pix_sort = have_posts() ? pix_get_option('pix_woo_filter') : '0';
	    $pix_order = have_posts() ? pix_get_option('pix_woo_order') : '0';
	    $pix_sort_by_tag = '0';
		$pix_price = '0';
	} elseif ( is_tax('product_cat') ) {  
		$layout = pix_get_option('pix_shopcategory_layout');  
		$pix_sort = pix_get_option('pix_shopcategory_filter');
		$page_template = pix_get_option('pix_shopcategory_template');
		$pix_order = pix_get_option('pix_shopcategory_order');
		$pix_sort_by_tag = pix_get_option('pix_shopcategory_sort');
		$pix_price = pix_get_option('pix_shopcategory_price');
	} elseif ( is_tax('product_tag') ) { 
		$layout = pix_get_option('pix_woo_layout'); 
		$page_template = pix_get_option('pix_woo_template');
		$pix_sort = pix_get_option('pix_woo_filter');
		$pix_order = pix_get_option('pix_woo_order');
		$pix_sort_by_tag = pix_get_option('pix_woo_sort');
		$pix_price = pix_get_option('pix_woo_price');
	} elseif ( pix_is_shop() ) { 
		$layout = pix_get_option('pix_shop_layout');
		$page_template = get_post_meta( $id_shop, '_wp_page_template', true );
		$pix_sort = pix_get_option('pix_shop_filter');
		$pix_order = pix_get_option('pix_shop_order');
		$pix_sort_by_tag = pix_get_option('pix_shop_sort');
		$pix_price = pix_get_option('pix_shop_price');
	} else {
		$layout = pix_get_option('pix_woo_layout'); 
		$page_template = pix_get_option('pix_woo_template');
		$pix_sort = pix_get_option('pix_woo_filter');
		$pix_order = pix_get_option('pix_woo_order');
		$pix_sort_by_tag = pix_get_option('pix_woo_sort');
		$pix_price = pix_get_option('pix_woo_price');
	}


	if ( is_singular( 'product' ) ) {

		while ( have_posts() ) : the_post();

			woocommerce_get_template_part( 'content', 'single-product' );

		endwhile;

	} else {

		?>

                <?php if ( !isset($hide_title) || $hide_title != 'on' ) { ?>
                    <section class="pix_divider firstDivider">
                        <div class="pix_column pix_column_990">
    						
                                <h1><span>
									<?php if ( is_search() ) : ?>
										<?php printf( __( 'Search Results: &ldquo;%s&rdquo;', 'forte' ), get_search_query() ); ?>
									<?php elseif ( is_tax() ) : ?>
										<?php
											global $wp_query;
											$term = get_term_by( 'slug', get_query_var($wp_query->query_vars['taxonomy']), $wp_query->query_vars['taxonomy']);
											$thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
											$image = wp_get_attachment_image_src( $thumbnail_id, 'mini_th' );
											$image = $image[0];
										?>
										<?php if ($image!='') { ?><img src="<?php echo $image; ?>" alt="<?php echo single_term_title( "", false ); ?>" class="wrap_image alignleft pix_tax_image"><?php } ?>
										<?php echo single_term_title( "", false ); ?>
									<?php else : ?>
										<?php
											$shop_page = get_post( woocommerce_get_page_id( 'shop' ) );

											echo $shop_page->post_title;
										?>
									<?php endif; ?>

									<?php if ( get_query_var( 'paged' ) ) : ?>
										<?php printf( __( '&nbsp;&ndash; Page %s', 'forte' ), get_query_var( 'paged' ) ); ?>
									<?php endif; ?>
                                </span></h1>
								<?php if ( is_tax() ) : ?>
									<p class="h1_subtitle"><span><?php echo $term->description; ?></span></p>
								<?php elseif ( ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
									<?php $pix_pag_opts_subtitle = get_post_meta( $id_shop, 'pix_pag_opts_subtitle', true );
				                        if ( $pix_pag_opts_subtitle != '' ) { ?>
				                            <p class="h1_subtitle"><?php echo $pix_pag_opts_subtitle; ?></p>
				                    <?php } ?>
				                <?php endif; ?>
                        </div><!-- .pix_column_990 -->
                    </section>
                    
                    <section id="pix_breadcrumbs">
                        <div class="pix_column pix_column_990">
                                <?php pix_breadcrumbs(); ?>                        

                        </div><!-- .pix_column_990 -->
                    </section>
                    
                    <div class="clearone"></div>
                <?php } ?>

				<div class="products">

				<?php
				    switch ( $layout ) {
				        case 'sixth':
				        case 'sixth_bis':
				        case 'seventh':
				        case 'seventh_bis':
				        case 'eighth':
				        case 'eighth_bis':
				            if ( locate_template( 'loop-first.php' ) )
				               locate_template( 'loop-first.php', true, false );
				            break;
				        case 'ninth':
				        case 'tenth':
				            if ( locate_template( 'loop-second.php' ) )
				               locate_template( 'loop-second.php', true, false );
				            break;
				        default:
				            if ( locate_template( 'loop-third.php' ) )
				               locate_template( 'loop-third.php', true, false );
				    }
				?>

		<div class="clear"></div>

		<?php 
	}
}
}

/*=========================================================================================*/

add_action( 'init', 'pix_replace_WC_2_0_shortcodes' );
function pix_replace_WC_2_0_shortcodes(){
	if ( version_compare( WOOCOMMERCE_VERSION, '2.0', '>=' ) ) {
		$wc_shortcodes = new WC_Shortcodes();
		/*FEATURED PRODUCTS*/
		remove_shortcode( 'featured_products', array( $wc_shortcodes, 'featured_products' ) );
		add_shortcode('featured_products', 'pix_woocommerce_featured_products');
		/*RECENT PRODUCTS*/
		remove_shortcode( 'recent_products', array( $wc_shortcodes, 'recent_products' ) );
		add_shortcode('recent_products', 'pix_woocommerce_recent_products');
		/*PRODUCT CATEGORY*/
		remove_shortcode( 'product_category', array( $wc_shortcodes, 'product_category' ) );
		add_shortcode('product_category', 'pix_woocommerce_product_category');
		/*PRODUCT CATEGORIES*/
		remove_shortcode( 'product_categories', array( $wc_shortcodes, 'product_categories' ) );
		add_shortcode('product_categories', 'pix_woocommerce_product_categories');
		/*PRODUCTS*/
		remove_shortcode( 'products', array( $wc_shortcodes, 'products' ) );
		add_shortcode('products', 'pix_woocommerce_products');
		/*PRODUCT*/
		remove_shortcode( 'product', array( $wc_shortcodes, 'product' ) );
		add_shortcode('product', 'pix_woocommerce_product');
		/*SALE PRODUCTS*/
		remove_shortcode( 'sale_products', array( $wc_shortcodes, 'sale_products' ) );
		add_shortcode('sale_products', 'pix_woocommerce_sale_products');
		/*BEST SELLING PRODUCTS*/
		remove_shortcode( 'best_selling_products', array( $wc_shortcodes, 'best_selling_products' ) );
		add_shortcode('best_selling_products', 'pix_woocommerce_best_selling_products');
		/*TOP RATED PRODUCTS*/
		remove_shortcode( 'top_rated_products', array( $wc_shortcodes, 'top_rated_products' ) );
		add_shortcode('top_rated_products', 'pix_woocommerce_top_rated_products');
	}
}
remove_shortcode('featured_products', 'woocommerce_featured_products');
add_shortcode('featured_products', 'pix_woocommerce_featured_products');
function pix_woocommerce_featured_products( $atts ) {

	global $woocommerce_loop,
		$layout,
		$args_shortcode_found,
		$woo_shortcode,
		$args,
		$pix_sort,
		$pix_price,
		$pix_order,
		$pix_sort_by_tag;

	extract(shortcode_atts(array(
		'per_page' 	=> '12',
		'columns' 	=> '4',
		'orderby' => 'date',
		'order' => 'desc',
		'layout' => 'sixth_bis',
		'sort' => 'false'
	), $atts));

	$pix_sort_by_tag = $sort;
	$pix_order = 'false';
	$pix_price = 'false';
	$pix_sort = $pix_sort_by_tag == 'true' ? 'true' : 'false';

	$args_shortcode_found = true;
	$woo_shortcode = true;

	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' => $per_page,
		'orderby' => $orderby,
		'order' => $order,
		'meta_query' => array(
			array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
			),
			array(
				'key' => '_featured',
				'value' => 'yes'
			)
		)
	);
	ob_start();  ?>

		<div class="products">

		<?php
			switch ( $layout ) {
                case 'default':
                case 'first':
                case 'second':
                case 'third':
                case 'fourth':
                case 'fifth':
		            if ( locate_template( 'loop-third.php' ) )
		               locate_template( 'loop-third.php', true, false );
					break;
				case 'ninth':
				case 'tenth':
		            if ( locate_template( 'loop-second.php' ) )
		               locate_template( 'loop-second.php', true, false );
					break;
				default:
		            if ( locate_template( 'loop-first.php' ) )
		               locate_template( 'loop-first.php', true, false );
			}
		?>

	<?php

	wp_reset_postdata();

	$args = '';

	$woo_shortcode = false;
	return ob_get_clean();
}

/*=========================================================================================*/

remove_shortcode('recent_products', 'woocommerce_recent_products');
add_shortcode('recent_products', 'pix_woocommerce_recent_products');

function pix_woocommerce_recent_products( $atts ) {

	global $woocommerce_loop,
		$layout,
		$args_shortcode_found,
		$woo_shortcode,
		$args,
		$pix_sort,
		$pix_price,
		$pix_order,
		$pix_sort_by_tag,
		$pagenavi;

	extract(shortcode_atts(array(
		'per_page' 	=> '12',
		'columns' 	=> '4',
		'orderby' => 'date',
		'order' => 'desc',
		'layout' => '',
		'sort' => 'false'
	), $atts));

	$pix_sort_by_tag = $sort;
	$pix_order = 'false';
	$pix_price = 'false';
	$pix_sort = $pix_sort_by_tag == 'true' ? 'true' : 'false';
	$pagenavi = 'false';

	$args_shortcode_found = true;
	$woo_shortcode = true;

	$layout = $layout == '' ? 'sixth_bis' : $layout;

	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' => $per_page,
		'orderby' => $orderby,
		'order' => $order,
		'meta_query' => array(
			array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
			)
		)
	);

	ob_start(); ?>

		<div class="products">

		<?php
			switch ( $layout ) {
                case 'default':
                case 'first':
                case 'second':
                case 'third':
                case 'fourth':
                case 'fifth':
		            if ( locate_template( 'loop-third.php' ) )
		               locate_template( 'loop-third.php', true, false );
					break;
				case 'ninth':
				case 'tenth':
		            if ( locate_template( 'loop-second.php' ) )
		               locate_template( 'loop-second.php', true, false );
					break;
				default:
		            if ( locate_template( 'loop-first.php' ) )
		               locate_template( 'loop-first.php', true, false );
			}
		?>

	<?php wp_reset_postdata();

	$args = '';

	$woo_shortcode = false;
	return ob_get_clean();
}

/*=========================================================================================*/

remove_shortcode('product_category', 'woocommerce_product_category');
add_shortcode('product_category', 'pix_woocommerce_product_category');

function pix_woocommerce_product_category( $atts ) {

	global $woocommerce_loop,
		$layout,
		$args_shortcode_found,
		$woo_shortcode,
		$args,
		$pix_sort,
		$pix_price,
		$pix_order,
		$pix_sort_by_tag;

	extract(shortcode_atts(array(
		'per_page' 		=> '12',
		'columns' 		=> '4',
	  	'orderby'   	=> 'title',
	  	'order'     	=> 'asc',
	  	'category'		=> '',
		'layout' => '',
		'sort' => 'false'
	), $atts));

	$pix_sort_by_tag = $sort;
	$pix_order = 'false';
	$pix_price = 'false';
	$pix_sort = $pix_sort_by_tag == 'true' ? 'true' : 'false';

	$args_shortcode_found = true;
	$woo_shortcode = true;


	if ( ! $category ) return;

	$layout = $layout == '' ? 'sixth_bis' : $layout;

  	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'orderby' => $orderby,
		'order' => $order,
		'posts_per_page' => $per_page,
		'meta_query' => array(
			array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
			)
		),
		'tax_query' => array(
	    	array(
		    	'taxonomy' => 'product_cat',
				'terms' => array( esc_attr($category) ),
				'field' => 'slug',
				'operator' => 'IN'
			)
	    )
	);

	ob_start(); ?>

		<div class="products">

		<?php
			switch ( $layout ) {
                case 'default':
                case 'first':
                case 'second':
                case 'third':
                case 'fourth':
                case 'fifth':
		            if ( locate_template( 'loop-third.php' ) )
		               locate_template( 'loop-third.php', true, false );
					break;
				case 'ninth':
				case 'tenth':
		            if ( locate_template( 'loop-second.php' ) )
		               locate_template( 'loop-second.php', true, false );
					break;
				default:
		            if ( locate_template( 'loop-first.php' ) )
		               locate_template( 'loop-first.php', true, false );
			}
		?>

	<?php wp_reset_postdata();

	$args = '';

	$woo_shortcode = false;
	return ob_get_clean();
}

/*=========================================================================================*/

remove_shortcode('product_categories', 'woocommerce_product_categories');
add_shortcode('product_categories', 'pix_woocommerce_product_categories');

function pix_woocommerce_product_categories( $atts ) {

	global $woocommerce_loop,
		$layout,
		$query_shortcode_found,
		$woo_shortcode,
		$query_string,
		$pix_sort,
		$pix_price,
		$pix_order,
		$pix_sort_by_tag,
		$product_categories;

	extract( shortcode_atts( array (
		'number'     => null,
		'orderby'    => 'name',
		'order'      => 'ASC',
		'columns' 	 => '4',
		'hide_empty' => 1,
		'parent'     => '',
		'layout' => '',
		'sort' => 'false'
	), $atts));

	$pix_sort_by_tag = $sort;
	$pix_order = 'false';
	$pix_price = 'false';
	$pix_sort = $pix_sort_by_tag == 'true' ? 'true' : 'false';

	$query_shortcode_found = true;
	$woo_shortcode = true;

	$layout = $layout == '' ? 'sixth_bis' : $layout;

	if ( isset( $atts[ 'ids' ] ) ) {
		$ids = explode( ',', $atts[ 'ids' ] );
		$ids = array_map( 'trim', $ids );
	} else {
		$ids = array();
	}

	$hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

  	$args = array(
		'orderby'    => $orderby,
		'order'      => $order,
		'include'    => $ids,
		'pad_counts' => true,
		'child_of'   => $parent,
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'hide_empty' => $hide_empty
	);

	$product_categories = get_terms( 'product_cat', $args );

	if ( $parent !== "" ) {
		$product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );
	}

	if ( $hide_empty ) {
		foreach ( $product_categories as $key => $category ) {
			if ( $category->count == 0 ) {
				unset( $product_categories[ $key ] );
			}
		}
	}

	if ( $number ) {
		$product_categories = array_slice( $product_categories, 0, $number );
	}

	ob_start(); ?>

		<div class="products">

		<?php
			switch ( $layout ) {
                case 'default':
                case 'first':
                case 'second':
                case 'third':
                case 'fourth':
                case 'fifth':
		            if ( locate_template( 'loop-third.php' ) )
		               locate_template( 'loop-third.php', true, false );
					break;
				case 'ninth':
				case 'tenth':
		            if ( locate_template( 'loop-second.php' ) )
		               locate_template( 'loop-second.php', true, false );
					break;
				default:
		            if ( locate_template( 'loop-first.php' ) )
		               locate_template( 'loop-first.php', true, false );
			}
		?>

	<?php  wp_reset_postdata();

	$args = '';

	$woo_shortcode = false;
	$product_categories = '';
	return ob_get_clean();
}

/*=========================================================================================*/

remove_shortcode('products', 'woocommerce_products');
add_shortcode('products', 'pix_woocommerce_products');

function pix_woocommerce_products( $atts ) {

	global $woocommerce_loop,
		$layout,
		$args_shortcode_found,
		$woo_shortcode,
		$args,
		$pix_sort,
		$pix_price,
		$pix_order,
		$pix_sort_by_tag;

  	if (empty($atts)) return;

	extract(shortcode_atts(array(
		'columns' 	=> '4',
	  	'orderby'   => 'title',
	  	'order'     => 'asc',
		'layout' => '',
		'sort' => 'false'
	), $atts));

	$pix_sort_by_tag = $sort;
	$pix_order = 'false';
	$pix_price = 'false';
	$pix_sort = $pix_sort_by_tag == 'true' ? 'true' : 'false';

	$args_shortcode_found = true;
	$woo_shortcode = true;

	$layout = $layout == '' ? 'sixth_bis' : $layout;

  	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'orderby' => $orderby,
		'order' => $order,
		'posts_per_page' => -1,
		'meta_query' => array(
			array(
				'key' 		=> '_visibility',
				'value' 	=> array('catalog', 'visible'),
				'compare' 	=> 'IN'
			)
		)
	);

	if(isset($atts['skus'])){
		$skus = explode(',', $atts['skus']);
	  	$skus = array_map('trim', $skus);
    	$args['meta_query'][] = array(
      		'key' 		=> '_sku',
      		'value' 	=> $skus,
      		'compare' 	=> 'IN'
    	);
  	}

	if(isset($atts['ids'])){
		$ids = explode(',', $atts['ids']);
	  	$ids = array_map('trim', $ids);
    	$args['post__in'] = $ids;
	}

	ob_start(); ?>

		<div class="products">

		<?php
			switch ( $layout ) {
                case 'default':
                case 'first':
                case 'second':
                case 'third':
                case 'fourth':
                case 'fifth':
		            if ( locate_template( 'loop-third.php' ) )
		               locate_template( 'loop-third.php', true, false );
					break;
				case 'ninth':
				case 'tenth':
		            if ( locate_template( 'loop-second.php' ) )
		               locate_template( 'loop-second.php', true, false );
					break;
				default:
		            if ( locate_template( 'loop-first.php' ) )
		               locate_template( 'loop-first.php', true, false );
			}
		?>

	<?php  wp_reset_postdata();

	$args = '';

	$woo_shortcode = false;
	return ob_get_clean();
}

/*=========================================================================================*/

function pix_woocommerce_product( $atts ) {
	global $woocommerce_loop,
		$layout,
		$args_shortcode_found,
		$woo_shortcode,
		$args,
		$pix_sort,
		$pix_price,
		$pix_order,
		$pix_sort_by_tag;
  	if (empty($atts)) return;

	$pix_sort_by_tag = $sort;
	$pix_order = 'false';
	$pix_price = 'false';
	$pix_sort = $pix_sort_by_tag == 'true' ? 'true' : 'false';

	$args_shortcode_found = true;
	$woo_shortcode = true;

	$layout = $layout == '' ? 'sixth_bis' : $layout;

  	$args = array(
    	'post_type' => 'product',
    	'posts_per_page' => 1,
    	'no_found_rows' => 1,
    	'post_status' => 'publish',
    	'meta_query' => array(
			array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
			)
		)
  	);

  	if(isset($atts['sku'])){
    	$args['meta_query'][] = array(
      		'key' => '_sku',
      		'value' => $atts['sku'],
      		'compare' => '='
    	);
  	}

  	if(isset($atts['id'])){
    	$args['p'] = $atts['id'];
  	}

	ob_start(); ?>

		<?php
			switch ( $layout ) {
                case 'default':
                case 'first':
                case 'second':
                case 'third':
                case 'fourth':
                case 'fifth':
		            if ( locate_template( 'loop-third.php' ) )
		               locate_template( 'loop-third.php', true, false );
					break;
				case 'ninth':
				case 'tenth':
		            if ( locate_template( 'loop-second.php' ) )
		               locate_template( 'loop-second.php', true, false );
					break;
				default:
		            if ( locate_template( 'loop-first.php' ) )
		               locate_template( 'loop-first.php', true, false );
			}
		?>

	<?php  wp_reset_postdata();

	$args = '';

	$woo_shortcode = false;
	return ob_get_clean();
}

/*=========================================================================================*/

function pix_woocommerce_sale_products($atts) {
    global $woocommerce_loop,
    $woocommerce,
	$layout,
	$args_shortcode_found,
	$woo_shortcode,
	$args,
	$pix_sort,
	$pix_price,
	$pix_order,
	$pix_sort_by_tag;

    extract( shortcode_atts( array(
        'per_page'      => '12',
        'columns'       => '4',
        'orderby'       => 'title',
        'order'         => 'asc'
        ), $atts ) );

	// Get products on sale
	$product_ids_on_sale = woocommerce_get_product_ids_on_sale();

	$meta_query = array();
	$meta_query[] = $woocommerce->query->visibility_meta_query();
    $meta_query[] = $woocommerce->query->stock_status_meta_query();

	$pix_sort_by_tag = $sort;
	$pix_order = 'false';
	$pix_price = 'false';
	$pix_sort = $pix_sort_by_tag == 'true' ? 'true' : 'false';

	$args_shortcode_found = true;
	$woo_shortcode = true;

	$layout = $layout == '' ? 'sixth_bis' : $layout;

	$args = array(
		'posts_per_page'=> $per_page,
		'orderby' 		=> $orderby,
        'order' 		=> $order,
		'no_found_rows' => 1,
		'post_status' 	=> 'publish',
		'post_type' 	=> 'product',
		'orderby' 		=> 'date',
		'order' 		=> 'ASC',
		'meta_query' 	=> $meta_query,
		'post__in'		=> $product_ids_on_sale
	);

	ob_start(); ?>

		<div class="products">

		<?php
			switch ( $layout ) {
                case 'default':
                case 'first':
                case 'second':
                case 'third':
                case 'fourth':
                case 'fifth':
		            if ( locate_template( 'loop-third.php' ) )
		               locate_template( 'loop-third.php', true, false );
					break;
				case 'ninth':
				case 'tenth':
		            if ( locate_template( 'loop-second.php' ) )
		               locate_template( 'loop-second.php', true, false );
					break;
				default:
		            if ( locate_template( 'loop-first.php' ) )
		               locate_template( 'loop-first.php', true, false );
			}
		?>

	<?php  wp_reset_postdata();

	$args = '';

	$woo_shortcode = false;
	return ob_get_clean();
}

/*=========================================================================================*/

function pix_woocommerce_best_selling_products( $atts ){
    global $woocommerce_loop,
    $woocommerce,
	$layout,
	$args_shortcode_found,
	$woo_shortcode,
	$args,
	$pix_sort,
	$pix_price,
	$pix_order,
	$pix_sort_by_tag;

    extract( shortcode_atts( array(
        'per_page'      => '12',
        'columns'       => '4'
        ), $atts ) );

	$pix_sort_by_tag = $sort;
	$pix_order = 'false';
	$pix_price = 'false';
	$pix_sort = $pix_sort_by_tag == 'true' ? 'true' : 'false';

	$args_shortcode_found = true;
	$woo_shortcode = true;

	$layout = $layout == '' ? 'sixth_bis' : $layout;

    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page' => $per_page,
        'meta_key' 		 => 'total_sales',
    	'orderby' 		 => 'meta_value',
        'meta_query' => array(
            array(
                'key' => '_visibility',
                'value' => array( 'catalog', 'visible' ),
                'compare' => 'IN'
            )
        )
    );

	ob_start(); ?>

		<div class="products">

		<?php
			switch ( $layout ) {
                case 'default':
                case 'first':
                case 'second':
                case 'third':
                case 'fourth':
                case 'fifth':
		            if ( locate_template( 'loop-third.php' ) )
		               locate_template( 'loop-third.php', true, false );
					break;
				case 'ninth':
				case 'tenth':
		            if ( locate_template( 'loop-second.php' ) )
		               locate_template( 'loop-second.php', true, false );
					break;
				default:
		            if ( locate_template( 'loop-first.php' ) )
		               locate_template( 'loop-first.php', true, false );
			}
		?>

	<?php  wp_reset_postdata();

	$args = '';

	$woo_shortcode = false;
	return ob_get_clean();
}

/*=========================================================================================*/

function pix_woocommerce_top_rated_products( $atts ){
    global $woocommerce_loop,
    $woocommerce,
	$layout,
	$args_shortcode_found,
	$woo_shortcode,
	$args,
	$pix_sort,
	$pix_price,
	$pix_order,
	$pix_sort_by_tag;

    extract( shortcode_atts( array(
        'per_page'      => '12',
        'columns'       => '4',
        'orderby'       => 'title',
        'order'         => 'desc'
        ), $atts ) );

	$pix_sort_by_tag = $sort;
	$pix_order = 'false';
	$pix_price = 'false';
	$pix_sort = $pix_sort_by_tag == 'true' ? 'true' : 'false';

	$args_shortcode_found = true;
	$woo_shortcode = true;

	$layout = $layout == '' ? 'sixth_bis' : $layout;

    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts'   => 1,
        'orderby' => $orderby,
        'order' => $order,
        'posts_per_page' => $per_page,
        'meta_query' => array(
            array(
                'key' => '_visibility',
                'value' => array('catalog', 'visible'),
                'compare' => 'IN'
            )
        )
    );

	ob_start();

	$wc_shortcodes = new WC_Query();

  	add_filter( 'posts_clauses', array( $wc_shortcodes, 'order_by_rating_post_clauses' ) );

	?>

		<div class="products">

		<?php
			switch ( $layout ) {
                case 'default':
                case 'first':
                case 'second':
                case 'third':
                case 'fourth':
                case 'fifth':
		            if ( locate_template( 'loop-third.php' ) )
		               locate_template( 'loop-third.php', true, false );
					break;
				case 'ninth':
				case 'tenth':
		            if ( locate_template( 'loop-second.php' ) )
		               locate_template( 'loop-second.php', true, false );
					break;
				default:
		            if ( locate_template( 'loop-first.php' ) )
		               locate_template( 'loop-first.php', true, false );
			}
		?>

	<?php  wp_reset_postdata();

	$args = '';

	$woo_shortcode = false;
	return ob_get_clean();
}

/*=========================================================================================*/

function woocommerce_template_after_single_title() {
	echo '<div class="summary alignright pix_column_210">';
}

/*=========================================================================================*/

function woocommerce_template_after_single_summary() {
	echo '</div><!-- .summary -->
	<div class="clear"></div>';
}

/*=========================================================================================*/

add_filter( 'single_product_large_thumbnail_size', 'pix_woo_var_img' );

function pix_woo_var_img() {
	
	global $post;

	$page_template = get_post_meta( $post->ID, 'pix_page_template_select', true );

	if ( !isset($page_template) || $page_template=='default' ) {
		return 'two_columns';
	} else {
		return 'three_columns';
	}
}

/*=========================================================================================*/

function woocommerce_subcategory_thumbnail( $category ) {
	global $woocommerce, $layout, $thumb_size;

	$small_thumbnail_size  	= apply_filters( 'single_product_small_thumbnail_size', $thumb_size );
	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
		$image = $image[0];
	} else {
		$image = woocommerce_placeholder_img_src();
	}

	if ( $image )
		echo '<img src="' . $image . '" alt="' . $category->name . '" width="" height="">';
}

/*=========================================================================================*/

if ( ! function_exists( 'pix_woocommerce_order_review' ) ) {

	function pix_woocommerce_order_review() {
		if ( version_compare( WOOCOMMERCE_VERSION, '2.1', '>=' ) ) { 
			woocommerce_get_template( 'checkout/review-order.php', array( 'checkout' => WC()->checkout() ) );
		} else {
			woocommerce_get_template( 'checkout/forte-review-order.php' );
		}
	}
}

function woocommerce_order_review() {
	pix_woocommerce_order_review();
}

/*=========================================================================================*/

/*function pix_related_products_limit() {
  global $product;
	
	$args = array(
		'post_type'        		=> 'product',
		'no_found_rows'    		=> 1,
		'posts_per_page'   		=> pix_get_option('pix_woo_related_ppp'),
		'ignore_sticky_posts' 	=> 1,
		'orderby'             	=> $orderby,
		'post__in'            	=> $related,
		'post__not_in'        	=> array($product->id)
	);
	return $args;
}
add_filter( 'woocommerce_related_products_args', 'pix_related_products_limit' );*/

/*=========================================================================================*/

function woocommerce_pagination() {
	return false;
}
function woocommerce_catalog_ordering() {
	return false;
}
function woocommerce_result_count() {
	return false;
}

/*=========================================================================================*/

	add_action( 'woocommerce_settings_page_options', 'service_agreement' );
	add_filter( 'woocommerce_inventory_settings', 'service_agreement' );
	add_action( 'woocommerce_update_options_pages', 'save_service_agreement' );

	function service_agreement($arr) {

		$arr[] = 
			array(  
				'title' 		=> __( 'Service Agreement Page ID', 'forte' ),
				'desc' 		=> __( 'If you define a \'Service Agreement\' page the customer will be asked if they agree to it when checking out.', 'forte' ),
				'id' 		=> 'woocommerce_service_agreement_page_id',
				'css' 		=> 'min-width:300px;',
				'type' 		=> 'single_select_page',
				'desc_tip'	=>  true,
			//),
		
		);

		return $arr;
	
	}
	
	function save_service_agreement() {
		
		if ( isset($_POST['woocommerce_service_agreement_page_id']) ) :
            update_option( 'woocommerce_service_agreement_page_id', woocommerce_clean( $_POST['woocommerce_service_agreement_page_id']) );
		else :
			delete_option('woocommerce_service_agreement_page_id');
		endif;
	
	}
	
	//FRONTEND
	

	add_action( 'woocommerce_review_order_after_submit' , 'add_service_agreement_checkbox' );
	add_action( 'woocommerce_checkout_process' , 'check_service_agreement' );
	
	function add_service_agreement_checkbox() {
		
		global $woocommerce;
		if (woocommerce_get_page_id('service_agreement')>0) : ?>
			<p class="form-row service_agreement">
				<input type="checkbox" class="input-checkbox" name="service_agreement" <?php if (isset($_POST['service_agreement'])) echo 'checked="checked"'; ?> id="service_agreement" />
                <label for="service_agreement" class="checkbox"><?php echo sprintf(__('I agree to the %sservice agreement%s', 'forte'), '<a href="'.esc_url( get_permalink(woocommerce_get_page_id('service_agreement')) ).'" target="_blank">','</a>'); ?></label>
			</p>
		<?php endif;
		
	}
	
	
	function check_service_agreement() {
		
		global $woocommerce;
		if (!isset($_POST['woocommerce_checkout_update_totals']) && empty($_POST['service_agreement']) && woocommerce_get_page_id('service_agreement')>0 ) :
			
			if ( function_exists('wc_add_notice'))
				wc_add_notice( __('You must review and agree to our service agreement.', 'forte') );
			else
				$woocommerce->wc_add_notice( __('You must review and agree to our service agreement.', 'forte') );
			
		endif;
		
	}