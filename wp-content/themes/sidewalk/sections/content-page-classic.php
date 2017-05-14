<article id="post-<?php the_ID(); ?>" <?php post_class( 'sdw-page' ); ?>>

	<?php $size = is_page_template('template-full-width.php') ? 'full' : 'sdw-lay-a'; ?>
	
	<?php if( sdw_get_option( 'page_show_fimg' ) && !get_post_format() && has_post_thumbnail() && $fimg = sdw_featured_image($size)  ): ?>
	 	<figure class="post-thumbnail">
			<?php echo $fimg; ?>
			<?php if( sdw_get_option( 'page_show_fimg_cap' ) && $caption = get_post(get_post_thumbnail_id())->post_excerpt) : ?>
				<figcaption><?php echo $caption;  ?></figcaption>
			<?php endif; ?>
		</figure>
	<?php endif; ?>

	<div class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</div>



	<div class="entry-content">
		<?php the_content(); ?>		
	</div>

	<?php if( sdw_get_option( 'page_show_share' ) ) :?>
		<div class="entry-footer">
			<div class="meta-action sdw-share"><?php get_template_part('sections/share'); ?></div>
		</div>
	<?php endif; ?>

</article>