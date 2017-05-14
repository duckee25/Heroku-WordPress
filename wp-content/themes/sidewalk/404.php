<?php get_header(); ?>

<?php get_template_part('sections/cover-area'); ?>

<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<article <?php post_class( 'sdw-page' ); ?>>

			<div class="entry-content page-content">
				<blockquote><?php echo wpautop(__sdw( '404_quote')); ?></blockquote>
				<?php echo wpautop(__sdw( '404_text')); ?>

				<?php if(has_nav_menu('sdw_404_menu')) : ?>
							<?php wp_nav_menu( array( 'theme_location' => 'sdw_404_menu', 'menu' => 'sdw_404_menu', 'menu_class' => 'sdw-404-menu', 'menu_id' => 'sdw_404_menu', 'container' => false ) ); ?>
				<?php endif; ?>
				</div>
</article>
		</main>
	</div>
</div>
<?php get_footer(); ?>