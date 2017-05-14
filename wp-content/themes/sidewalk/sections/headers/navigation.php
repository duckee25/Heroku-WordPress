<?php if ( sdw_get_option( 'header_search' ) || sdw_get_option( 'header_social' ) ) : ?>
	<ul class="sdw-nav-actions">
		<?php if ( sdw_get_option( 'header_search' ) ) : ?>
				<li class="sdw-nav-search"><a href="javascript:void(0)"><i class="fa fa-search" data-wrap="sdw-nav-search-wrap" data-icon-class="fa-search"></i></a></li>
		<?php endif; ?>

		<?php if ( sdw_get_option( 'header_social' ) ) : ?>
			<li class="sdw-nav-social"><a href="javascript:void(0)"><i class="fa fa-share-alt" data-wrap="sdw-nav-social-wrap" data-icon-class="fa-share-alt"></i></a></li>
		<?php endif; ?>
	</ul>

	<?php if ( sdw_get_option( 'header_search' ) ): ?>
		<div class="sdw-nav-search-wrap"><?php get_template_part( 'searchform' ); ?></div>
	<?php endif; ?>

	<?php if ( sdw_get_option( 'header_social' ) ): ?>
			<?php get_template_part( 'sections/headers/social' ); ?>
	<?php endif; ?>

<?php endif; ?>

<nav id="site-navigation" class="main-navigation" role="navigation">
	<?php if ( has_nav_menu( 'sdw_main_navigation_menu' ) ) : ?>
			<?php wp_nav_menu( array( 'theme_location' => 'sdw_main_navigation_menu', 'menu' => 'sdw_main_navigation_menu', 'menu_class' => 'nav-menu', 'menu_id' => 'sdw_main_navigation_menu', 'container' => false ) ); ?>
	<?php else: ?>
		<?php if ( current_user_can( 'manage_options' ) ): ?>
			<ul id="sdw_header_nav" class="nav-menu">
				<li><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>"><?php _e( 'Click here to add navigation menu', THEME_SLUG ); ?></a></li>
			</ul>
		<?php endif; ?>
	<?php endif; ?>
</nav>

<div class="sdw-res-nav">
	<a class="sdw-responsive-nav" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
</div>
<div class="sdw-res-sid-nav">
	<a href="#sidr-sidebar" class="sdw-sidebar-toggle"><i class="fa fa-th-large"></i></a>
</div>
