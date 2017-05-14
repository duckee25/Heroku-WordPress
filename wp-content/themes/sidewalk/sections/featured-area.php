<?php if(sdw_get_option('home_fa')): ?>

	<?php $fa = sdw_fa_query(); ?>

	<?php if($fa->have_posts()) : ?>

		<div id="featured-area" class="container">
			<div class="sdw-featured-area">
				
				<?php while($fa->have_posts()): $fa->the_post(); ?>

					<?php get_template_part('sections/loops/layout-fa'); ?>

				<?php endwhile; ?>

			</div>
		<div class="sdw-post-separator sdw-post-separator-1"></div>
		</div>

	<?php endif; ?>

	<?php wp_reset_postdata(); ?>
	
<?php endif; ?>