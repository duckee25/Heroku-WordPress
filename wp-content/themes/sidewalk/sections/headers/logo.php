<div class="site-branding">
	<?php 
		$logo_url = sdw_get_option('logo_custom_url') ? esc_url(sdw_get_option('logo_custom_url')) : esc_url(home_url( '/' )); 
		$logo = sdw_get_option('logo')
	?>
	
	<?php 
		$title_tag = is_front_page() ? 'h1' : 'span';
		$class = !empty($logo['url']) ? 'class="has-logo"' : '';
	?>

	<<?php echo $title_tag;?> class="site-title">
		<a href="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" <?php echo $class; ?>><?php if(!empty($logo['url'])) : ?><img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr(get_bloginfo( 'name' )); ?>" /><?php else: ?><?php bloginfo( 'name' ); ?><?php endif; ?></a>
	</<?php echo $title_tag;?>>

</div>