<?php
/**
* Show a square with the post title and image
 */


// featured image -----------------------------------------------------------------------------
$post_featured_image_thumb = '';
$post_featured_image = '';


if ( has_post_thumbnail() ) {
	$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
	$post_featured_image = $image_attributes[0];

	$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'small' );
	$post_featured_image_thumb = $image_attributes[0];

}
// --------------------------------------------------------------------------------------------


// video cover -----------------------------------------------------------------------------
$video_cover = get_post_meta($post->ID, ktt_var_name('video_cover'), true);
// -----------------------------------------------------------------------------------------


// customize --------------------------------------------------------------------------------
$general_option_meta_fields = get_option(ktt_var_name('post_cover_1_meta_info_display'));
$general_option_share_links = get_option(ktt_var_name('post_cover_1_social_share_display'));
$display_subtitle = get_option(ktt_var_name('post_cover_1_display_subtitle'));
$text_align = get_option(ktt_var_name('post_cover_1_align'));
$mask_opacity = get_option(ktt_var_name('post_cover_1_mask_opacity'));
// ------------------------------------------------------------------------------------------


$background_color = '';
/*
$colors = array('#1abc9c', '#2ecc71', '#3498db', '#9b59b6', '#f1c40f', '#e67e22', '#e74c3c', '#95a5a6');
if(!$background_color) $background_color = $colors[array_rand($colors, 1)];
*/



?><div style="min-height:100%"><div id="card-<?php echo $post->ID;?>" class="article-card squarebig under-header <?php echo $text_align;?>">



			<div class="inner">




				<div class="image-background <?php if ($post_featured_image_thumb) {?>thumb<?php } ?>" style="<?php if ($background_color) {?>background-color:<?php echo $background_color;?>;<?php } ?>z-index:0;background-image:url('<?php echo $post_featured_image_thumb;?>');">

				</div>

				<div class="image-background image-final <?php if (is_single()) {?>image-in-single-page<?php } ?> hidden" style="<?php if ($background_color) {?>background-color:<?php echo $background_color;?>;<?php } ?>z-index:0;background-image:url('<?php echo $post_featured_image;?>');">

				</div>


					<?php


					if ($video_cover) {


						$video_src = $video_cover['src'];

						if ($video_src) {
						?>


							<div id="featured-video-<?php echo $post->ID;?>" class="video-cover-background-viewport">
							    <video id="video" autoplay muted preload loop>

							    </video>
							</div>


							<script>


					      jQuery(function() {




					      	// load video
							var video = document.getElementById('video');
							video.src = '<?php echo $video_src;?>';
							video.load();



							video.addEventListener('loadeddata', function() {

						      	$video = jQuery('video');
						        vid_w_orig = parseInt($video.width());
						    	vid_h_orig = parseInt($video.height());

						    	$video.addClass('loaded');


						        jQuery(window).resize(function () { resizeToCover(); });
						    	jQuery(window).trigger('resize');

						    	setTimeout(function() {
						    		jQuery(window).trigger('resize');
						    		jQuery('#featured-video-<?php echo $post->ID;?>').fadeTo('slow', 1);
						    		jQuery(window).trigger('resize');

						    	},1250);

					   		}, false);


					      });




					    function resizeToCover() {


					    		var vid_w_now = $video.width();
					    		var vid_h_now = $video.height();
							    // use largest scale factor of horizontal/vertical
							    var scale_h = vid_w_now / vid_w_orig;
							    var scale_v = vid_h_now / vid_h_orig;
							    var scale = scale_h > scale_v ? scale_h : scale_v;

							    // marco visible
							    marco = jQuery('#featured-video-<?php echo $post->ID;?>');


							    // ajustamos alto
							    if (marco.width() == vid_w_now) {


							    	$ajuste = (vid_h_now - marco.height()) / 2;
							    	$video.css('left', '0').css('top', '-' + $ajuste + 'px');



							    }

							    if (marco.height() == vid_h_now) {


							    	$ajuste = (vid_w_now - marco.width()) / 2;
							    	$video.css('top', '0').css('left', '-' + $ajuste + 'px');



							    }




						};



					    </script>




					<?php } }?>




					<?php if (is_single()) {?>
						<div class="readbottom animated bounce">
							<i onclick="scrollto('.entry-content', 750, -30)">&#xe821;</i>
						</div>
					<?php } ?>





				<div <?php if (isset($mask_opacity) && $mask_opacity) {?>style="background-color:rgba(0,0,0,<?php echo $mask_opacity;?>);"<?php } ?> class="image-cover">


					<?php if (function_exists('KTT_photo_credit_feature_enabled') && KTT_photo_credit_feature_enabled()) {

						$credit = get_post_meta($post->ID, ktt_var_name('photo_credit'), true);

						if ($credit) {
						?>
							<div class="photo-credit">
								 <?php echo $credit;?>
							</div>
						<?php } ?>

					<?php } ?>

					<div class="frame-inner">
					<div class="inner">



						<div class="on-top-title">




							<?php if (isset($general_option_share_links) && $general_option_share_links) { ?>
							<div class="sharediv">


								<?php
								// share params

								$url 		=  	$post->share['url'];
								$text 		= 	$post->share['text'];
								$via 		= 	$post->share['twitter']['via'];
								$related 	= 	$post->share['twitter']['related'];
								$hashtags 	= 	$post->share['twitter']['hashtags'];

								if ($via) $via = '&amp;via=' . $via;
								if ($related) $related = '&amp;related=' . $related;

								?>

								<script>
									var lefts = (screen.width/2)-(450/2);
	        				var tops = (screen.height/2)-(350/2);
	        			</script>


	        			<?php if (isset($general_option_share_links['twitter']) && $general_option_share_links['twitter']) {?>
								<span class="share-item" onclick="window.open('https://twitter.com/share?url=<?php echo $url; ?>&amp;text=<?php echo $text;?><?php echo $via;?><?php echo $related;?>&amp;hashtags=<?php echo $hashtags;?>','','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=450,height=350, top='+ tops +', left='+ lefts)">
									<i>&#xe908;</i> <span class="hide-on-mobile"><?php _e('Tweet this',THEME_TEXTDOMAIN);?></span>
								</span>
								<?php } ?>


	        					<?php if (isset($general_option_share_links['facebook']) && $general_option_share_links['facebook']) {?>
								<span class="share-item" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo $url;?>','','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=450,height=350, top='+ tops +', left='+ lefts)">
									<i>&#xe90c;</i> <span class="hide-on-mobile"><?php _e('Share',THEME_TEXTDOMAIN);?></span>
								</span>
								<?php } ?>


	        					<?php if (isset($general_option_share_links['read_later']) && $general_option_share_links['read_later']) {?>
								<span class="share-item" onclick="window.open('https://getpocket.com/edit?url=<?php echo $url;?>&amp;title=<?php echo $text;?>','','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=450,height=350, top='+ tops +', left='+ lefts)">
									<i>&#xe8be;</i> <span class="hide-on-mobile"><?php _e('Read later',THEME_TEXTDOMAIN);?> </span>
								</span>
								<?php } ?>

							</div>
							<?php } ?>

							<?php if (isset($general_option_meta_fields) && $general_option_meta_fields) { ?>
							<?php if (isset($general_option_meta_fields['categories']) && $general_option_meta_fields['categories']) {?>
							<div class="the-categories-div hide-on-mobile">
								<span><i>&#xe84b;</i> <?php _e('Posted on', THEME_TEXTDOMAIN);?></span> <?php the_category(', '); ?>
							</div>
							<?php } ?>
							<?php } ?>



						</div>





						<h1><a <?php if (is_single()) {?> onclick="scrollto('.entry-content', 750, -30)" <?php } else { ?> href="<?php the_permalink();?>" <?php } ?> title="<?php echo esc_attr(get_the_title());?>" class="title ajaxlink"><?php echo $post->post_title;?></a></h1>

						<?php if ($display_subtitle) {?>
						<?php if (isset($post->post_subtitle) && $post->post_subtitle) {?>

								<a <?php if (is_single()) {?> onclick="scrollto('.entry-content', 750, -30)" <?php } else { ?> href="<?php the_permalink();?>" <?php } ?> title="<?php echo esc_attr(get_the_title());?>" class="post-subtitle ajaxlink">
									<?php echo $post->post_subtitle;?>
								</a>

						<?php } ?>
						<?php } ?>

						<?php if (isset($general_option_meta_fields) && $general_option_meta_fields) { ?>
						<span class="meta">

							<?php if (isset($general_option_meta_fields['date']) && $general_option_meta_fields['date']) {?>
							<span class="date">
								<?php the_time( get_option( 'date_format' ) );?>
							</span>
							<?php } ?>


							<?php if (isset($general_option_meta_fields['author']) && $general_option_meta_fields['author']) {?>
							<span class="author">
							<?php echo sprintf(__('By %s', THEME_TEXTDOMAIN), '<a class="ajaxlink" href="' . get_author_posts_url($post->post_author) . '">' . get_the_author_meta('display_name', $post->post_author) . '</a>' ) ;?>
							</span>
							<?php } ?>


							<?php if (isset($general_option_meta_fields['comments']) && $general_option_meta_fields['comments']) {?>
							<span class="comments">
								<?php if ( function_exists('KTT_display_comments_count') ) {?>
									<?php KTT_display_comments_count();?>
								<?php } else { ?>
									<a href="<?php echo get_permalink();?>#comments"><?php comments_number( __('No responses', THEME_TEXTDOMAIN) , __('One response',THEME_TEXTDOMAIN), __('% responses',THEME_TEXTDOMAIN) );?></a>
								<?php } ?>
							</span>
							<?php } ?>


							<?php if (isset($general_option_meta_fields['read_time']) && $general_option_meta_fields['read_time']) {?>
							<?php if (function_exists('KTT_show_post_read_time_is_active') && KTT_show_post_read_time_is_active()) { ?>
							<span>
								<?php echo KTT_display_post_read_time();?>
							</span>
							<?php } ?>
							<?php } ?>


							<?php if (isset($general_option_meta_fields['views']) && $general_option_meta_fields['views']) {?>
							<?php if (function_exists('show_post_views') && show_post_views()) { ?>
							<span>
								<?php echo 328;?> <?php _e('views',THEME_TEXTDOMAIN);?>
							</span>
							<?php } ?>
							<?php } ?>


						</span>
						<?php } ?>




					</div>
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
			    $card = jQuery('#card-<?php echo $post->ID;?>.article-card.squarebig');

			    var is_iphone = /(iPhone|iPod)/g.test( navigator.userAgent );
			    var is_ipad = /(iPad)/g.test( navigator.userAgent );

			    if(is_iphone) {
				 $card.css("height", 600);
				 $card.find('.image-background').css("height", 600);
				 $card.find('.image-background').css("background-attachment", 'scroll');
				};

				if(is_ipad) {
				 $card.css("height", 800);
				 //$card.find('.image-background').css("height", 700);
				 $card.find('.image-background').css("background-attachment", 'scroll');
				};


			<?php if (!isset($_REQUEST['ajax'])) {?> }) <?php } ?>



			</script>


</div></div>
