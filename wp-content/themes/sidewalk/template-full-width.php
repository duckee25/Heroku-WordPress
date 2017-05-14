<?php
/**
 * Template Name: Full Width
 */
?>

<?php get_header(); ?>

<?php get_template_part('sections/cover-area'); ?>

<div id="content" class="site-content">

	<div id="primary" class="content-area sdw-full-width">
		<main id="main" class="site-main" role="main">
		
		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php 
				$layout = sdw_get_page_meta(get_the_ID(), 'layout');
				$layout = $layout == 'inherit' ? sdw_get_option('page_layout') : $layout; 
			?>

			<?php get_template_part( 'sections/content-page-'.$layout); ?>

		<?php endwhile; ?>

		</main>

		<?php if ( sdw_get_option( 'page_show_comments' ) ) : ?>
			<?php comments_template(); ?>
		<?php endif; ?>

	</div>

</div>

<?php get_footer(); ?>