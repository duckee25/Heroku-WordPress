<?php
/**
* Show the next post
*/


 global $post;

 $post_save = $post;

/* we get the next post data */

$next_post = get_adjacent_post( false, '', false);

$next_post_featured_image = '';
$next_post_featured_image_thumb = '';

if ($next_post ) {
if ( has_post_thumbnail($next_post->ID) ) {
	$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($next_post->ID), 'full' );
	$next_post_featured_image = $image_attributes[0];

	$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($next_post->ID), 'small' );
	$next_post_featured_image_thumb = $image_attributes[0];

}
}

/* ------------------- */






/* we get the previous post data */

$prev_post = get_adjacent_post( false, '', true);

$prev_post_featured_image = '';
$prev_post_featured_image_thumb = '';

if($prev_post) {
if ( has_post_thumbnail($prev_post->ID) ) {
	$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($prev_post->ID), 'full' );
	$prev_post_featured_image = $image_attributes[0];

	$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($prev_post->ID), 'small' );
	$prev_post_featured_image_thumb = $image_attributes[0];

}
}


/* ------------------- */




// customize --------------------------------------------------------------------------------
$general_option_meta_fields = get_option(ktt_var_name('post_cover_1_meta_info_display'));
// ------------------------------------------------------------------------------------------



if ($prev_post && $next_post) {
	?><style> .article-card .next-post-element {display:none;} </style> <?php 
} elseif (!$prev_post && $next_post) {
	?><style> .article-card .prev-post-element {display:none;} </style> <?php 
} else {

} 


?><div id="card-nextpost" class="article-card pagehead under-header">


			<div class="inner">
				
				


				<?php if ($next_post) {?>

				<div class="next-post-element image-background thumb" style="z-index:0;background-image:url('<?php echo $next_post_featured_image_thumb;?>');">

				</div>

				<div class="next-post-element image-background " style="z-index:0;background-image:url('<?php echo $next_post_featured_image;?>');">

				</div>

				<?php } ?>


				



				<?php if ($prev_post) {?>

				<div class="prev-post-element image-background thumb" style="z-index:0;background-image:url('<?php echo $prev_post_featured_image_thumb;?>');">

				</div>

				<div class="prev-post-element image-background " style="z-index:0;background-image:url('<?php echo $prev_post_featured_image;?>');">

				</div>

				<?php } ?>







				<div class="image-cover">

					<div class="inner">



						<div class="next-post-label">

							<ul>



								<?php if ($next_post) { ?>
								<li 
								onclick="
								jQuery(this).parent('ul').find('li').removeClass('active');
								jQuery(this).addClass('active');
								jQuery('.prev-post-element').hide();
								jQuery('.next-post-element').fadeIn(500);
								"
								
								>
									<i>&#xe872;</i> <?php _e('Next article',THEME_TEXTDOMAIN);?>
								</li>
								<?php } ?>

								


								<?php if ($prev_post) { ?>
								<li
								onclick="
								jQuery(this).parent('ul').find('li').removeClass('active');
								jQuery(this).addClass('active');
								jQuery('.next-post-element').hide();
								jQuery('.prev-post-element').fadeIn(500);
								"
								class="active"
								>
									<i>&#xe872;</i> <?php _e('Previous article',THEME_TEXTDOMAIN);?>
								</li>
								<?php } ?>



								



							</ul>


						</div>









						<?php if ($next_post) {
							$post = $next_post;
							?>

						<div class="next-post-element">
						<div class="elements-content ">
						<div>

						<a  onclick="scrollto('.entry-content', 750, -30)" href="<?php echo get_the_permalink($next_post->ID);?>"  title="<?php echo esc_attr($next_post->post_title);?>" class="title ajaxlink"><?php echo $next_post->post_title;?></a>
						

						
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

						<?php } ?>








						<?php if ($prev_post) {
							$post = $prev_post;
							?>

						<div class="prev-post-element">
						<div class="elements-content">
						<div>

						<a  onclick="scrollto('.entry-content', 750, -30)" href="<?php echo get_the_permalink($prev_post->ID);?>"  title="<?php echo esc_attr($prev_post->post_title);?>" class="title ajaxlink"><?php echo $prev_post->post_title;?></a>
						

						
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

						<?php } ?>








						<script>

						<?php if (!isset($_REQUEST['ajax'])) { ?>  jQuery(function() { <?php } ?>

						    // ios viewport height (vh) fix
						    $card = jQuery('#card-nextpost.article-card');

						    var is_iphone = /(iPhone|iPod)/g.test( navigator.userAgent );
						    var is_ipad = /(iPad)/g.test( navigator.userAgent );

						    if(is_iphone || is_ipad) {
							 $card.css("height", 420);
							 $card.find('.image-background').css("height", 420);
							 $card.find('.image-background').css("background-attachment", 'scroll');
							};


						<?php if (!isset($_REQUEST['ajax'])) {?> }) <?php } ?>

						</script>







					</div>


					




				</div>





			</div>

			


</div>

<?php $post = $post_save;?>



