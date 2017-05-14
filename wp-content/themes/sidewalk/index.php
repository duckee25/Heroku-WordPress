<?php get_header(); ?>

<?php get_template_part('sections/cover-area'); ?>

<div id="content" class="site-content">

<?php $sid = sdw_get_current_sidebar(); if($sid['use_sidebar'] == 'left') : ?>
	<?php get_sidebar(); ?>
<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php $i = 0; while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'sections/loops/layout-' . sdw_get_current_post_layout( $i ) ); ?>

			<?php $i++; endwhile; ?>

		<?php else: ?>
				
				<?php get_template_part( 'sections/content-none'); ?>

		<?php endif; ?>

		</main>
		<?php get_template_part( 'sections/pagination/'. sdw_get_current_pagination() ); ?>
	</div>

<?php if($sid['use_sidebar'] == 'right') : ?>
	<?php get_sidebar(); ?>
<?php endif; ?>

</div>

<?php get_footer(); ?>