<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 * @version     1.6.4
 */

if ( version_compare( WOOCOMMERCE_VERSION, '2.0', '>=' ) ) {
	/**************************
	    WOOCOMMERCE >= 2.0.0
	**************************/

	global $post, $woocommerce, $product;
	$colorbox = (get_option('woocommerce_enable_lightbox')=='yes') ? 'colorbox' : '';
	
	$zoom_meta = get_post_meta( $post->ID, 'pix_zoom_featured_images', true );

	$thumb_id = get_post_thumbnail_id();

	$attachment_ids = $product->get_gallery_attachment_ids();

	if ( $attachment_ids ) {
		$fakeColorbox = 'fake-';
	} else {
		$fakeColorbox = 'fake ';
	}

	if ( (pix_get_option('pix_zoom_woo')=='true' && ($zoom_meta=='default' || $zoom_meta=='' || !isset($zoom_meta)) ) || $zoom_meta == 'enable' ) {
		$colorbox = 'cloud-zoom';
	} else {
		$colorbox = $fakeColorbox.'colorbox';
	}

	$page_template = get_post_meta( $post->ID, 'pix_page_template_select', true );
	
	if ( !isset($page_template) ) {
		$article_class = 'pix_column_470';
		$fix_class = 'pix_column_470';
		$thumb_size = 'two_columns';
	} else {
		switch ($page_template) {
			case 'default':
				$article_class = 'pix_column_470';
				$thumb_size = 'two_columns';
				$fix_class = 'pix_column_470';
				break;
			case 'widepage.php':
				$article_class = 'pix_column_730';
				$fix_class = 'pix_fixed_730';
				$thumb_size = 'three_columns';
				break;
			case '':
				$article_class = 'pix_column_470';
				$fix_class = 'pix_column_470';
				$thumb_size = 'two_columns';
				break;
			default:
				$article_class = 'pix_column_470';
				$thumb_size = 'two_columns';
				$fix_class = 'pix_column_470';
		}	
	}
?>
<div class="images alignleft <?php echo $article_class; ?>">

	<?php if (has_post_thumbnail()) : $thumb_id = get_post_thumbnail_id(); ?>

		<a itemprop="image" href="<?php echo wp_get_attachment_url($thumb_id); ?>" data-rel="thumbnails" class="<?php echo $fix_class; ?> alignleft margin_0 <?php echo $colorbox; ?> zoom" data-rel="thumbnails" data-title="<?php echo get_the_title( $thumb_id ); ?>" id="zoom1" rel="position: 'inside', showTitle: false, adjustX:1, adjustY:1"><?php echo get_the_post_thumbnail($post->ID, apply_filters('forte_product_image_size',$thumb_size)) ?></a>

	<?php else : ?>
	
		<img src="<?php echo $woocommerce->plugin_url() ?>/assets/images/placeholder.png" alt="Placeholder" />
	
	<?php endif; ?>
    
<?php
		$smallimg = wp_get_attachment_image_src($thumb_id, apply_filters('forte_product_image_size',$thumb_size));
		$smallimg = $smallimg[0];
		if ( $colorbox == 'cloud-zoom' ) {
			$colorbox2 = 'cloud-zoom-gallery';
		} else {
			$colorbox2 = 'letmebe';
		}

?>

    <?php if ( $colorbox == 'cloud-zoom' ) { ?>
    	<div class="clear above_10"></div>
    	<p class="textaligncenter"><a href="<?php echo wp_get_attachment_url($thumb_id); ?>" class="simple_button pix_button <?php echo $fakeColorbox; ?>colorbox" data-rel="thumbnails" data-title="<?php echo get_the_title( $thumb_id ); ?>"><?php _e('Click to enlarge','forte'); ?></a></p>
    <?php } ?>
    

<div class="thumbnails<?php if ( $colorbox != 'cloud-zoom' ) { ?> colorbox-gallery<?php } ?>">
	<?php
		if ($attachment_ids && count($attachment_ids)>0) :

			$out_attachm = '';

			if ( function_exists('get_available_variations') ) {

				$available_variations = $product->get_available_variations();

				foreach ( $available_variations as $var ) :
									
					$var_url = $var['image_src'];
					$var_title = $var['image_title'];
					$var_image = get_pix_thumb($var['image_src'], 'mini_th');
					$var_datasrc = get_pix_thumb($var['image_src'], apply_filters('forte_product_image_size',$thumb_size));
					$var_datahref = get_pix_thumb($var['image_src'], 'full');

					$out_attachm .= '<div data-href="'.$var_datahref.'" class="display_none"><a href="'.$var_datahref.'" data-title="'.$var_title.'" data-rel="thumbnails" class="hidden_div colorbox for_thumbnail"><img src="'.$var_image.'"></a>';
					$out_attachm .= '<a href="'.$var_datahref.'" data-title="'.$var_title.'" rel="useZoom: \'zoom1\', smallImage: \''. $var_datasrc. '\'" data-rel="thumbnails" class="pix_column_50 alignleft '.$colorbox2.' for_gallery"><img src="'.$var_image.'"></a></div>';

				endforeach;

			}

			$i = 0;

			foreach ( $attachment_ids as $id ) :

				$i++;
								
				$url = wp_get_attachment_url($id);
				$post_title = get_the_title( $id );
				$image = wp_get_attachment_image($id, 'mini_th');
				$datasrc = wp_get_attachment_image_src($id, apply_filters('forte_product_image_size',$thumb_size));
				$datasrc = $datasrc[0];
				$datahref = wp_get_attachment_image_src($id, 'full');
				$datahref = $datahref[0];

				$out_attachm .= '<a href="'.$url.'" data-title="'.$post_title.'" data-rel="thumbnails" class="hidden_div colorbox">'.$image.'</a>';
				$out_attachm .= '<a href="'.$url.'" data-title="'.$post_title.'" rel="useZoom: \'zoom1\', smallImage: \''. $datasrc. '\'" data-rel="thumbnails" class="pix_column_50 alignleft '.$colorbox2.'">'.$image.'</a>';

			endforeach;

			if ( $out_attachm != '' ) {
				echo '<div data-href="'.wp_get_attachment_url($thumb_id).'"><a href="'.wp_get_attachment_url($thumb_id).'" data-title="'.$post_title.'" data-rel="thumbnails" class="pix_column_50 alignleft zoomSelected '.$colorbox2.'" rel="useZoom: \'zoom1\', smallImage: \''. $smallimg . '\'">'. get_the_post_thumbnail($post->ID, 'mini_th') .'</a>
				<a href="'.wp_get_attachment_url($thumb_id).'" data-title="'.get_the_title($thumb_id).'" data-rel="thumbnails" class="hidden_div colorbox zoomSelected">'. get_the_post_thumbnail($post->ID, 'mini_th') .'</a></div>';
				echo $out_attachm;
			}
		endif;
		?>
	</div>
	<?php
} else {
		/**************************
		    WOOCOMMERCE < 2.0.0
		**************************/
	global $post, $woocommerce, $product;
		$colorbox = (get_option('woocommerce_enable_lightbox')=='yes') ? 'colorbox' : '';
		
		$zoom_meta = get_post_meta( $post->ID, 'pix_zoom_featured_images', true );

		$thumb_id = get_post_thumbnail_id();
		$args = array(
			'post_type' 	=> 'attachment',
			'numberposts' 	=> -1,
			'post_status' 	=> null,
			'post_parent' 	=> $post->ID,
			'post__not_in'	=> array($thumb_id),
			'post_mime_type'=> 'image',
			'orderby'		=> 'menu_order',
			'order'			=> 'ASC'
		);
		$attachments = get_posts($args);

		if ($attachments) {
			$fakeColorbox = 'fake-';
		} else {
			$fakeColorbox = 'fake ';
		}

		if ( (pix_get_option('pix_zoom_woo')=='true' && ($zoom_meta=='default' || $zoom_meta=='' || !isset($zoom_meta)) ) || $zoom_meta == 'enable' ) {
			$colorbox = 'cloud-zoom';
		} else {
			$colorbox = $fakeColorbox.'colorbox';
		}

		$page_template = get_post_meta( $post->ID, 'pix_page_template_select', true );
		
		if ( !isset($page_template) ) {
			$article_class = 'pix_column_470';
			$fix_class = 'pix_column_470';
			$thumb_size = 'two_columns';
		} else {
			switch ($page_template) {
				case 'default':
					$article_class = 'pix_column_470';
					$thumb_size = 'two_columns';
					$fix_class = 'pix_column_470';
					break;
				case 'widepage.php':
					$article_class = 'pix_column_730';
					$fix_class = 'pix_fixed_730';
					$thumb_size = 'three_columns';
					break;
				case '':
					$article_class = 'pix_column_470';
					$fix_class = 'pix_column_470';
					$thumb_size = 'two_columns';
					break;
				default:
					$article_class = 'pix_column_470';
					$thumb_size = 'two_columns';
					$fix_class = 'pix_column_470';
			}	
		}
	?>
	<div class="images alignleft <?php echo $article_class; ?>">

		<?php if (has_post_thumbnail()) : $thumb_id = get_post_thumbnail_id(); ?>

			<a itemprop="image" href="<?php echo wp_get_attachment_url($thumb_id); ?>" data-rel="thumbnails" class="<?php echo $fix_class; ?> alignleft margin_0 <?php echo $colorbox; ?> zoom" data-rel="thumbnails" data-title="<?php echo get_the_title( $thumb_id ); ?>" id="zoom1" rel="position: 'inside', showTitle: false, adjustX:1, adjustY:1"><?php echo get_the_post_thumbnail($post->ID, apply_filters('forte_product_image_size',$thumb_size)) ?></a>

		<?php else : ?>
		
			<img src="<?php echo $woocommerce->plugin_url() ?>/assets/images/placeholder.png" alt="Placeholder" />
		
		<?php endif; ?>
	    
	<?php
			$smallimg = wp_get_attachment_image_src($thumb_id, apply_filters('forte_product_image_size',$thumb_size));
			$smallimg = $smallimg[0];
			if ( $colorbox == 'cloud-zoom' ) {
				$colorbox2 = 'cloud-zoom-gallery';
			} else {
				$colorbox2 = 'letmebe';
			}

	?>

	    <?php if ( $colorbox == 'cloud-zoom' ) { ?>
	    	<div class="clear above_10"></div>
	    	<p class="textaligncenter"><a href="<?php echo wp_get_attachment_url($thumb_id); ?>" class="simple_button pix_button <?php echo $fakeColorbox; ?>colorbox" data-rel="thumbnails" data-title="<?php echo get_the_title( $thumb_id ); ?>"><?php _e('Click to enlarge','forte'); ?></a></p>
	    <?php } ?>
	    

	<div class="thumbnails<?php if ( $colorbox != 'cloud-zoom' ) { ?> colorbox-gallery<?php } ?>">
		<?php	
			if ($attachments) :

				$out_attachm = '';

				foreach ( $attachments as $attachment ) :
									
				if ( get_post_meta( $attachment->ID, '_woocommerce_exclude_image', true ) == 1 )
					continue;
					$_post = & get_post( $attachment->ID );
					$url = wp_get_attachment_url($_post->ID);
					$post_title = esc_attr($_post->post_title);
					$image = wp_get_attachment_image($attachment->ID, 'mini_th');
					$datasrc = wp_get_attachment_image_src($_post->ID, apply_filters('forte_product_image_size',$thumb_size));
					$datasrc = $datasrc[0];
					$datahref = wp_get_attachment_image_src($_post->ID, 'full');
					$datahref = $datahref[0];

					$out_attachm .= '<a href="'.$url.'" data-title="'.$post_title.'" data-rel="thumbnails" class="hidden_div colorbox">'.$image.'</a>';
					$out_attachm .= '<a href="'.$url.'" data-title="'.$post_title.'" rel="useZoom: \'zoom1\', smallImage: \''. $datasrc. '\'" data-rel="thumbnails" class="pix_column_50 alignleft '.$colorbox2.'">'.$image.'</a>';

				endforeach;

				if ( $out_attachm != '' ) {
					echo '<a href="'.wp_get_attachment_url($thumb_id).'" data-title="'.$post_title.'" data-rel="thumbnails" class="pix_column_50 alignleft zoomSelected '.$colorbox2.'" rel="useZoom: \'zoom1\', smallImage: \''. $smallimg . '\'">'. get_the_post_thumbnail($post->ID, 'mini_th') .'</a>
					<a href="'.wp_get_attachment_url($thumb_id).'" data-title="'.$post_title.'" data-rel="thumbnails" class="hidden_div colorbox zoomSelected">'. get_the_post_thumbnail($post->ID, 'mini_th') .'</a>';
					echo $out_attachm;
				}
			endif;
			
		?>
	</div>

<?php } ?>

        <div class="clear"></div>	

		<?php if ( ( pix_get_option('pix_share_woo') == 'true' && get_post_meta( $post->ID, 'pix_pag_opts_share', true ) == '' ) || get_post_meta( $post->ID, 'pix_pag_opts_share', true ) == 'display' ) { ?>
            <div id="pix_social_share">
                <div id="fb-root" class="alignleft"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/<?php $lang = WPLANG; if(!empty($lang)) { echo $lang; } else { echo 'en_US'; } ?>/all.js#xfbml=1";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-like alignleft" data-href="<?php echo pix_current_page(); ?>" data-send="true" data-layout="button_count" data-width="150" data-show-faces="true"></div>
                <div class="alignleft pix_gplus" id="gplus_sharing_icon">
                    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
                    <div class="g-plusone" data-size="medium" data-count="true"></div>
                </div>
                <div class="alignleft" id="twitter_sharing_icon">
                    <script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
                    <a href="//twitter.com/share" class="twitter-share-button">Tweet</a>
                </div>
                <div class="alignleft pix_linkedin" id="linkedin_sharing_icon">
                    <script src="//platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-counter="right"></script>
                </div>                                
                <?php if (has_post_thumbnail()) { ?>
                <div class="alignleft" id="pinterest_sharing_icon">
                    <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
                    <a href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo wp_get_attachment_url($thumb_id); ?>&description=<?php the_title(); ?>" class="pin-it-button letmebe pix_social_share" count-layout="horizontal" data-width="800"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
                </div>
                <?php } ?>
                
                
                <div class="clear"></div>	
                    
            </div><!-- #pix_social_share -->
        <?php } ?>
            
</div>