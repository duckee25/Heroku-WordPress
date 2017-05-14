<?php
/**
 * The Template for displaying all single posts.
 *
 */



if ( function_exists('KTT_ajax_show_header') ) {  KTT_ajax_show_header(); } else { get_header(); }; 
?>


	<?php get_template_part('elements','bigcard');?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		

			<?php get_template_part( 'content', 'single' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		

		</main><!-- #main -->
	</div><!-- #primary -->


	<?php get_template_part('elements','nextpost');?>


<?php 
if ( function_exists('KTT_ajax_show_footer') ) {  KTT_ajax_show_footer(); } else { get_footer(); }; 
?>


