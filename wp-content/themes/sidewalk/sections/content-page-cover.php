<article id="post-<?php the_ID(); ?>" <?php post_class( 'sdw-page sdw-page-cover' ); ?>>

	<div class="entry-content">
		<?php the_content(); ?>		
	</div>

	<?php if( sdw_get_option( 'page_show_share' ) ) :?>
		<div class="entry-footer">
			<div class="meta-action sdw-share"><?php get_template_part('sections/share'); ?></div>
		</div>
	<?php endif; ?>

</article>