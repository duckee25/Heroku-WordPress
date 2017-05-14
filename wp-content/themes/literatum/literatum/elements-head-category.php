<?php

$post_featured_image = '';
$post_featured_image_thumb = '';

if ( function_exists('get_taxonomy_meta') ) {
	$featured_image_id = get_taxonomy_meta(get_cat_id(single_cat_title("",false)), ktt_var_name('category_featured_image'), true);
}

if (!$featured_image_id) $featured_image_id = get_post_thumbnail_id();



if ( $featured_image_id ) {

	$image_attributes = wp_get_attachment_image_src( $featured_image_id, 'full' );
	$post_featured_image = $image_attributes[0];

	$image_attributes = wp_get_attachment_image_src( $featured_image_id, 'small' );
	$post_featured_image_thumb = $image_attributes[0];

}
?><div id="card-<?php echo $post->ID;?>" class="article-card category-head pagehead under-header">


			<div class="inner">

				<div class="image-background thumb" style="z-index:0;background-image:url('<?php echo $post_featured_image_thumb;?>');">

				</div>

				<div class="image-background hidden" style="z-index:0;<?php if (is_single()) {?>background-attachment:fixed;<?php } ?>background-image:url('<?php echo $post_featured_image;?>');">

				</div>


				<div class="image-cover">

					<div class="inner">

						<br><br><br>

						<?php
						if ( is_category() ) :
							?>

							<a onclick="scrollto('.entry-content', 750, -30)"  class="title ajaxlink"><?php echo single_cat_title();?></a>
							<?php if (category_description()) {?>
							<div class="description">
								<?php echo category_description();?>
							</div>
							<?php } ?>

							<?php

						elseif ( is_tag() ) :
							?>
							<a onclick="scrollto('.entry-content', 750, -30)"  class="title ajaxlink"><?php echo single_tag_title();?></a>

							<?php
						elseif ( is_author() ) :
							?>
							<a onclick="scrollto('.entry-content', 750, -30)"  class="title ajaxlink">
							<?php printf( __( 'Author: %s', THEME_TEXTDOMAIN ), '<span class="vcard">' . get_the_author() . '</span>' );?>
							</a>
							<?php
						elseif ( is_day() ) :
							?>
							<a onclick="scrollto('.entry-content', 750, -30)"  class="title ajaxlink">
							<?php printf( __( 'Day: %s', THEME_TEXTDOMAIN ), '<span>' . get_the_date() . '</span>' ); ?>
							</a>
							<?php

						elseif ( is_month() ) :
							?>
							<a onclick="scrollto('.entry-content', 750, -30)"  class="title ajaxlink">
							<?php printf( __( 'Month: %s', THEME_TEXTDOMAIN ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', THEME_TEXTDOMAIN ) ) . '</span>' ); ?>
							</a>
							<?php

						elseif ( is_year() ) :
							?>
							<a onclick="scrollto('.entry-content', 750, -30)"  class="title ajaxlink">
							<?php printf( __( 'Year: %s', THEME_TEXTDOMAIN ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', THEME_TEXTDOMAIN ) ) . '</span>' ); ?>
							</a>
							<?php

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', THEME_TEXTDOMAIN );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', THEME_TEXTDOMAIN);

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', THEME_TEXTDOMAIN);

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', THEME_TEXTDOMAIN );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', THEME_TEXTDOMAIN );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', THEME_TEXTDOMAIN );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', THEME_TEXTDOMAIN );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', THEME_TEXTDOMAIN );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', THEME_TEXTDOMAIN );

						else :
							_e( 'Archives', THEME_TEXTDOMAIN );

						endif;
					?>


					</div>







				</div>





			</div>

			<script>


			var img = jQuery("<img />").attr('src', '<?php echo $post_featured_image;?>')
		    .load(function() {
		        if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {

		        } else {
		            jQuery('#card-<?php echo $post->ID;?> .image-background').animate({opacity: 1}, 540, function() {jQuery('.image-background.thumb').fadeOut()}  );
		        }
		    });



		    <?php if (!isset($_REQUEST['ajax'])) { ?>  jQuery(function() { <?php } ?>

			    // ios viewport height (vh) fix
			    $card = jQuery('#card-<?php echo $post->ID;?>.article-card');

			    var is_iphone = /(iPhone|iPod)/g.test( navigator.userAgent );
			    var is_ipad = /(iPad)/g.test( navigator.userAgent );

			    if(is_iphone || is_ipad) {
				 $card.css("height", 500);
				 $card.find('.image-background').css("height", 500);
				 $card.find('.image-background').css("background-attachment", 'scroll');
				};


			<?php if (!isset($_REQUEST['ajax'])) {?> }) <?php } ?>


			</script>


</div>
