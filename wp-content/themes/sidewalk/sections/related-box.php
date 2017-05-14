<?php $related_posts = sdw_get_related_posts(); ?>

<?php if ( $related_posts->have_posts() ): ?>

	<div class="sdw-box">

	<h3 class="sdw-box-title"><span><?php echo __sdw( 'related_title' ); ?></span></h3>

	<div class="sdw-box-inside">

		<?php while ( $related_posts->have_posts() ): $related_posts->the_post(); ?>
			<?php get_template_part( 'sections/loops/layout-c'); ?>
		<?php endwhile; ?>

	</div>

	</div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>