<?php
/**
 */

global $post;


// customize --------------------------------------------------------------------------------
$general_option_share_links = get_option(ktt_var_name('post_content_social_share_display'));
$bottom_info = get_option(ktt_var_name('post_content_bottom_info_display'));
// ------------------------------------------------------------------------------------------


do_action('aesop_inside_body_top');
?>





<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="entry-content">

		
		<?php echo apply_filters('the_content', $post->post_content); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', THEME_TEXTDOMAIN ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->



	<?php if (isset($bottom_info) && $bottom_info) {?>
	<footer class="entry-footer article-default-width">
		<?php

		$meta_text = '';
		$category_list = '';
		$tag_list = '';

		if (isset($bottom_info['categories']) && $bottom_info['categories']) {
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( ', ' );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', ', ' );

			
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'Archived in %1$s and tagged %2$s.', THEME_TEXTDOMAIN );
				} else {
					$meta_text = __( 'Archived in %1$s.', THEME_TEXTDOMAIN );
				}

		}

		if (isset($bottom_info['permalink']) && $bottom_info['permalink']) {

				$meta_text .= ' ' . __('Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.',THEME_TEXTDOMAIN);

		}
				
			$meta_text = '<i style="margin-right:5px;">&#xe85b;</i> ' . $meta_text;

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>




		<?php edit_post_link( __( 'Edit', THEME_TEXTDOMAIN ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
	<?php } ?>





	<?php if (isset($general_option_share_links) && $general_option_share_links) {?>
	<?php if ($post->share) {?>
	<div class="entry-footer article-default-width">
		
		<i>&#xe87b;</i> <?php _e('Share this article',THEME_TEXTDOMAIN);?>:

		<span class="sharespan">
			<?php if (isset($general_option_share_links['facebook']) && $general_option_share_links['facebook']) {?>
			<a onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo $post->share['url'];?>','','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=450,height=350, top='+ tops +', left='+ lefts)"><i>&#xe90a;</i> Facebook</a>
			<?php } ?>

			<?php if (isset($general_option_share_links['twitter']) && $general_option_share_links['twitter']) {?>
			<a onclick="window.open('https://twitter.com/share?url=<?php echo $post->share['url']; ?>&amp;text=<?php echo $post->share['text'];?>&amp;via=<?php echo $post->share['twitter']['via'];?>&amp;related=<?php echo $post->share['twitter']['related'];?>&amp;hashtags=<?php echo $post->share['twitter']['hashtags'];?>','','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=450,height=350, top='+ tops +', left='+ lefts)" ><i>&#xe908;</i> Twitter</a>
			<?php } ?>
		</span>


	</div>
	<?php } ?>
	<?php } ?>


</article><!-- #post-## -->




<div class="widget-area widget-area-post-content-bottom article-default-width">
<?php dynamic_sidebar( 'post-content-bottom' ); ?>
</div>




