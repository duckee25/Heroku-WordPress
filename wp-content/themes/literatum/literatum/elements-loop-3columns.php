<?php
/**
 * Default design to show a list of posts
 */

// customize --------------------------------------------------------------------------------
$general_option_meta_fields = get_option(ktt_var_name('cateogry_3columns_loop_meta_info_display'));
// ------------------------------------------------------------------------------------------

?>
		<div class="default-content-width">
		<ul class="loop_3columns-posts-list ">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?><li class="loop_3columns-post-item">
						

						<?php
						$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium');
						$featured_image = $featured_image[0];
						?>
						<a class="featured_image ajaxlink" href="<?php echo get_the_permalink();?>" style="background-image:url('<?php echo $featured_image;?>');">

						</a>
						
						<a class="title ajaxlink" href="<?php echo get_the_permalink();?>">
							<?php echo get_the_title($post->ID);?>
						</a>

						<div class="excerpt">
							<?php the_excerpt();?>
						</div>


						<?php if (isset($general_option_meta_fields) && $general_option_meta_fields) { ?>
						<span class="meta">

							<?php if (isset($general_option_meta_fields['author']) && $general_option_meta_fields['author']) {?>
							<?php if (!is_author()) {?>
							<a href="<?php echo get_author_posts_url($post->post_author);?>" class="author ajaxlink">
								<?php echo get_the_author_meta('display_name', $post->post_author);?>
							</a>
							<?php } ?>
							<?php } ?>


							<?php if (isset($general_option_meta_fields['comments']) && $general_option_meta_fields['comments']) {?>
							<?php if ( function_exists('KTT_display_comments_count') ) {?>
								<?php KTT_display_comments_count();?>
							<?php } else { ?>
								<a class="comments comments_count" href="<?php echo get_permalink();?>#comments"><?php comments_number( __('No responses', THEME_TEXTDOMAIN) , __('One response',THEME_TEXTDOMAIN), __('% responses',THEME_TEXTDOMAIN) );?></a>
							<?php } ?>
							<?php } ?>


							<?php if (isset($general_option_meta_fields['read_time']) && $general_option_meta_fields['read_time']) {?>
							<?php if (function_exists('KTT_show_post_read_time_is_active') && KTT_show_post_read_time_is_active()) { ?>
							<a href="<?php echo get_permalink();?>" class="read_time ajaxlink">
								<?php echo KTT_display_post_read_time();?>
							</a>
							<?php } ?>
							<?php } ?>


							<?php if (isset($general_option_meta_fields['date']) && $general_option_meta_fields['date']) {?>
							<a href="<?php echo get_permalink();?>" class="date ajaxlink">
								<?php the_time( get_option( 'date_format' ) );?>
							</a>
							<?php } ?>

						</span>
						<?php } ?>


				</li><?php endwhile; ?>
		</ul>

		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;;?>
		<div class="navigation"><p><?php posts_nav_link(' · ' . __('Page ', THEME_TEXTDOMAIN) . $paged . ' · ','<i>&#xe898;</i> ' . __('Previous Page', THEME_TEXTDOMAIN)  , __('Next Page', THEME_TEXTDOMAIN) . ' <i>&#xe899;</i>'); ?></p></div>


		</div>


