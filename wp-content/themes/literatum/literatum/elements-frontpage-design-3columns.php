<?php
/**
 * Frontpage Design 3 columns 
 */

if ( function_exists('KTT_ajax_show_header') ) {  KTT_ajax_show_header(); } else { get_header(); }; ?>


	
	<?php get_template_part('elements','head-frontpage');?>


	<section id="primary" class="content-area entry-content">
		
		
		<?php if ( have_posts() ) : ?>
			
			<?php get_template_part('elements', 'loop-3columns');?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		

		
	</section><!-- #primary -->

<?php if ( function_exists('KTT_ajax_show_footer') ) {  KTT_ajax_show_footer(); } else { get_footer(); };  ?>