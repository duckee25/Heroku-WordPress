<?php get_header(); ?>

<?php get_template_part('sections/cover-area'); ?>

<div id="content" class="site-content">

<?php $sid = sdw_get_current_sidebar(); if($sid['use_sidebar'] == 'left') : ?>
	<?php get_sidebar(); ?>
<?php endif; ?>

	<div id="primary" class="content-area">
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

<?php if($sid['use_sidebar'] == 'right') : ?>
	<?php get_sidebar(); ?>
<?php endif; ?>

</div>

<?php get_footer(); ?>