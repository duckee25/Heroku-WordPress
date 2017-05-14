<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php echo esc_attr(get_bloginfo( 'charset' )); ?>">
	<meta name="viewport" content="user-scalable=yes, width=device-width, initial-scale=1.0, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo esc_url(get_bloginfo( 'pingback_url' )); ?>">
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="main-page" class="hfeed sdw-main-page">

<?php $sdw_header_class = sdw_get_option('header_orientation') == 'wide' ? ' sdw-header-wide' : ''; ?>
<header id="masthead" class="site-header<?php echo esc_attr($sdw_header_class); ?>" role="banner">
	<div class="container">
		<?php get_template_part( 'sections/headers/logo'); ?>
		<?php get_template_part( 'sections/headers/navigation'); ?>
	</div>
</header>