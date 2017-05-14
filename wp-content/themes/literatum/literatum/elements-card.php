<?php
/**
* Show a square with the post title and image
 */

$post_featured_image = '';

if ( has_post_thumbnail() ) {
	$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
	$post_featured_image = $image_attributes[0];
}



// customize --------------------------------------------------------------------------------
$general_option_meta_fields = get_option(ktt_var_name('post_minicover_1_meta_info_display'));
$hover_effect = get_option(ktt_var_name('post_minicover_1_hover_effect'));
$mask_opacity = get_option(ktt_var_name('post_minicover_1_mask_opacity'));
// ------------------------------------------------------------------------------------------


$background_color = '';
$colors = array('#1abc9c', '#2ecc71', '#3498db', '#9b59b6', '#f1c40f', '#e67e22', '#e74c3c', '#95a5a6');
if(!$background_color) $background_color = $colors[array_rand($colors, 1)];


global $enlarge;

?><div class="article-card square <?php if ($enlarge) {?> double <?php } ?> <?php if($hover_effect) {?>hidehover<?php } ?>" >


			<div class="inner">

				<div class="image-background" style="<?php if ($background_color) {?>background-color:<?php echo $background_color;?>;<?php } ?><?php if (is_single()) {?>background-attachment:fixed;<?php } ?>background-image:url('<?php echo $post_featured_image;?>');">

				</div>

				<div class="image-cover" <?php if (isset($mask_opacity) && $mask_opacity) {?>style="background-color:rgba(0,0,0,<?php echo $mask_opacity;?>);"<?php } ?>>
					<div class="inner">


						<h3><a  href="<?php the_permalink();?>" title="<?php echo esc_attr(get_the_title());?>" class="title ajaxlink"><?php the_title();?></a></h3>



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
