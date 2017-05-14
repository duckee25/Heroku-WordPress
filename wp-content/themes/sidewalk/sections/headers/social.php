
	<?php if(has_nav_menu('sdw_social_menu')) : ?>
			<div class="sdw-nav-social-wrap"><?php wp_nav_menu( array( 'theme_location' => 'sdw_social_menu', 'menu' => 'sdw_social_menu', 'menu_class' => 'social-menu', 'menu_id' => 'sdw_social_menu', 'container' => false, 'link_before'=> '<span class="sdw-social-name">', 'link_after' => '</span>', ) ); ?></div>
	<?php else: ?>
		<?php if(current_user_can('manage_options')): ?>
			<div class="sdw-nav-social-wrap">
				<ul id="sdw_social_menu" class="social-menu">
					<li><a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>"><?php _e('Click here to add social menu', THEME_SLUG); ?></a></li>
				</ul>
			</div>
		<?php endif; ?>
	<?php endif; ?>
