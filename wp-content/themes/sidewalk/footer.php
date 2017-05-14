
	<footer id="colophon" class="site-footer" role="contentinfo">
		
		<?php if(sdw_get_option('footer_display')) : ?>
			<div class="container sdw-site-widgets">
				<div class="sdw-col first">
					<?php dynamic_sidebar( 'sdw_footer_sidebar_1' ); ?>
				</div>
				<div class="sdw-col">
					<?php dynamic_sidebar( 'sdw_footer_sidebar_2' ); ?>
				</div>
				<div class="sdw-col">
					<?php dynamic_sidebar( 'sdw_footer_sidebar_3' ); ?>
				</div>
			<div class="sdw-post-separator sdw-post-separator-1"></div>
			</div>			
		<?php endif; ?>
		
		<div class="container">
		<?php $class = sdw_get_option('footer_display') ? '' : ' sdw-footer-off'; ?>

			<div class="site-info<?php echo $class; ?>">
			<?php if(sdw_get_option('enable_copyright')) : ?>
				<div class="sdw-left">
					<?php echo sdw_get_option('footer_copyright'); ?> Shared by <!-- Please Do Not Remove Shared Credits Link --><a href='http://www.themes24x7.com/' id="sd">Themes24x7</a><!-- Please Do Not Remove Shared Credits Link -->
				</div>	
			<?php endif; ?>
			<?php 
				if(has_nav_menu('sdw_footer_menu')) {
						wp_nav_menu( array( 'theme_location' => 'sdw_footer_menu', 'menu' => 'sdw_footer_menu', 'menu_class' => 'shl-footer-menu', 'menu_id' => 'sdw_footer_menu', 'container' => false , 'depth' => 1) );
				}
			?>
			</div>
			</div>
		
	</footer><!-- .site-footer -->

</div>

<?php wp_footer(); ?>

</body>
</html>