<?php get_header(); ?>

<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>

<!-- layout-container -->
<div id="layout" class="clearfix pagewidth">
			
	<!-- contentwrap -->
	<div id="contentwrap">
    
    	<?php themify_content_before(); //hook ?>
		<!-- content -->
		<div id="content" class="clearfix">
        	<?php themify_content_start(); //hook ?>
			

		<?php 
			/////////////////////////////////////////////
			// Category Title	 							
			/////////////////////////////////////////////
			?>

                        <h1 class="page-title"><?php single_cat_title(); ?></h1>
                        <?php echo $themify->get_category_description(); ?>

	
			<?php 
			/////////////////////////////////////////////
			// Loop	 							
			/////////////////////////////////////////////
			?>
			<?php if (have_posts()) : ?>
			
				<!-- loops-wrapper -->
				<div id="loops-wrapper" class="loops-wrapper <?php echo $themify->layout . ' ' . $themify->post_layout; ?>">
	
					<?php while (have_posts()) : the_post(); ?>
			
						<?php if(is_search()): ?>
							<?php get_template_part( 'includes/loop','search'); ?>
						<?php else: ?>
							<?php get_template_part( 'includes/loop','index'); ?>
						<?php endif; ?>
			
					<?php endwhile; ?>
								
				</div>
				<!-- /loops-wrapper -->
	
				<?php get_template_part( 'includes/pagination'); ?>
			
			<?php 
			/////////////////////////////////////////////
			// Error - No Page Found	 							
			/////////////////////////////////////////////
			?>
	
			<?php else : ?>
		
				<p><?php _e( 'Sorry, nothing found.', 'themify' ); ?></p>
		
			<?php endif; ?>			

			<?php themify_content_end(); //hook ?>
		</div>
		<!--/content -->
        <?php themify_content_after() //hook; ?>

	</div>
	<!-- /contentwrap -->
	
	<?php 
	/////////////////////////////////////////////
	// Sidebar							
	/////////////////////////////////////////////
	if ($themify->layout != "sidebar-none"): get_sidebar(); endif; ?>
	
</div>
<!-- layout-container -->

<?php get_footer(); ?>