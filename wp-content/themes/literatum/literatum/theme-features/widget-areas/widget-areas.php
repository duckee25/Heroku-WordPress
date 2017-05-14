<?php
/**
 * Register widgetized areas
 *
 */


function KTT_widgets_init() {

	register_sidebar( array(
		'id' 					=> 'sidebar-common-area-top',
		'name' 					=> 'Sidebar Common Area (Top)',
		'description'   		=> __('The widgets introduced in this área appear on the top of the sidebar in every page. Use this area to display the most popular widgets of the site such as the search widget or the main navigation menu widget.', THEME_TEXTDOMAIN),
		'before_widget' 		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 			=> '</div>',
		'before_title' 			=> '<h2 class="widget-title rounded">',
		'after_title' 			=> '</h2>',
	) );

	register_sidebar( array(
		'id' 					=> 'sidebar-frontpage-area',
		'name' 					=> 'Sidebar Frontpage (Middle)',
		'description'   		=> __('The widgets introduced in this area only appear on the home page. Put here the widgets you want to display in the sidebar when the visitor is at the home page site.', THEME_TEXTDOMAIN),
		'before_widget' 		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 			=> '</div>',
		'before_title' 			=> '<h2 class="widget-title rounded">',
		'after_title' 			=> '</h2>',
	) );

	register_sidebar( array(
		'id' 					=> 'sidebar-post-area',
		'name' 					=> 'Sidebar Post Pages (Middle)',
		'description'   		=> __('The widgets introduced in this area only appear on the post template.', THEME_TEXTDOMAIN),
		'before_widget' 		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 			=> '</div>',
		'before_title' 			=> '<h2 class="widget-title rounded">',
		'after_title' 			=> '</h2>',
	) );

	register_sidebar( array(
		'id' 					=> 'sidebar-page-area',
		'name' 					=> 'Sidebar Page Pages (Middle)',
		'description'   		=> __('The widgets introduced in this area only appear on the pages template.', THEME_TEXTDOMAIN),
		'before_widget' 		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 			=> '</div>',
		'before_title' 			=> '<h2 class="widget-title rounded">',
		'after_title' 			=> '</h2>',
	) );

	register_sidebar( array(
		'id' 					=> 'sidebar-category-area',
		'name' 					=> 'Sidebar Category Pages (Middle)',
		'description'   		=> __('The widgets introduced in this area only appear on the category and tag templates.', THEME_TEXTDOMAIN),
		'before_widget' 		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 			=> '</div>',
		'before_title' 			=> '<h2 class="widget-title rounded">',
		'after_title' 			=> '</h2>',
	) );

	register_sidebar( array(
		'id' 					=> 'sidebar-author-area',
		'name' 					=> 'Sidebar Author Pages (Middle)',
		'description'   		=> __('The widgets introduced in this area only appear on the personal profile site.', THEME_TEXTDOMAIN),
		'before_widget' 		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 			=> '</div>',
		'before_title' 			=> '<h2 class="widget-title rounded">',
		'after_title' 			=> '</h2>',
	) );

	register_sidebar( array(
		'id' 					=> 'sidebar-others-area',
		'name' 					=> 'Sidebar Others Pages (Middle)',
		'description'   		=> __('The widgets in this area are only introduced on the templates that do not belong to any of the types above.', THEME_TEXTDOMAIN),
		'before_widget' 		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 			=> '</div>',
		'before_title' 			=> '<h2 class="widget-title rounded">',
		'after_title' 			=> '</h2>',
	) );

	register_sidebar( array(
		'id' 					=> 'sidebar-common-area-bottom',
		'name' 					=> 'Sidebar Common Area (Bottom)',
		'description'   		=> __('The widgets introduced in this area appear on every page of the website, on the bottom of the sidebar, below the widgets from other areas.', THEME_TEXTDOMAIN),
		'before_widget' 		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 			=> '</div>',
		'before_title' 			=> '<h2 class="widget-title rounded">',
		'after_title' 			=> '</h2>',
	) );

	register_sidebar( array(
		'id' 					=> 'post-content-bottom',
		'name' 					=> 'Post Content (Bottom)',
		'description'   		=> __('The widgets introduced in this area appear in the single posts pages on the bottom of every post content.', THEME_TEXTDOMAIN),
		'before_widget' 		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 			=> '</div>',
		'before_title' 			=> '<h2 class="widget-title rounded">',
		'after_title' 			=> '</h2>',
	) );
}
add_action( 'widgets_init', 'KTT_widgets_init' );




?>