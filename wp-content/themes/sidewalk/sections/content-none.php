<article id="post-0" <?php post_class('sdw-post sdw-single'); ?> >
	<div class="entry-content">
		<?php if ( current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( __( 'No posts can be found on this page. Go and <a href="%1$s">add some new posts</a>.', THEME_SLUG ), admin_url( 'post-new.php' ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

		<p><?php echo __sdw( 'nothing_found_search'); ?></p>
		<?php get_search_form(); ?>

		<?php else : ?>

		<p><?php echo __sdw( 'nothing_found_text'); ?></p>
		<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</article>