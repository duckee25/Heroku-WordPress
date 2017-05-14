<?php
function pix_add_menu()
{
	global $current_user;
	get_currentuserinfo();
		
		if (function_exists('add_options_page')) {
			add_menu_page(pix_esc_option('pix_admin_page_title'), pix_esc_option('pix_admin_page_title'), pix_select_role(pix_get_option('pix_perm_panel')), 'admin_interface', 'add_options', get_template_directory_uri().'/functions/images/blank.gif');
			add_submenu_page('admin_interface', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_panel')), 'admin_interface','add_options');
			add_submenu_page('admin_panel', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_admin_panel')), 'admin_panel','add_options');
			add_submenu_page('front_header', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_header_panel')), 'front_header','add_options');
			add_submenu_page('nav_section', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_nav_panel')), 'nav_section','add_options');
			add_submenu_page('main_section', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_section_panel')), 'main_section','add_options');
			add_submenu_page('footer_section', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_footer_panel')), 'footer_section','add_options');
			add_submenu_page('aside_section', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_sidebar_panel')), 'aside_section','add_options');
			add_submenu_page('sliding_sidebar', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_sliding_sidebar_panel')), 'sliding_sidebar','add_options');
			add_submenu_page('google_font_list', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_panel')), 'google_font_list','add_options');
			add_submenu_page('front_floatingicons', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_floatingicons_panel')), 'front_floatingicons','add_options');
			add_submenu_page('general_seo', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_seo_panel')), 'general_seo','add_options');
			add_submenu_page('import_export', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_import_panel')), 'import_export','add_options');
			add_submenu_page('admin_tweets', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_twitter_panel')), 'admin_tweets','add_options');
			add_submenu_page('select_fonts', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_google_panel')), 'select_fonts','add_options');
			add_submenu_page('general_typo', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_general_typo_panel')), 'general_typo','add_options');
			add_submenu_page('headings_typo', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_headings_panel')), 'headings_typo','add_options');
			add_submenu_page('layout_colors', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_layout_colors_panel')), 'layout_colors','add_options');
			add_submenu_page('section_colors', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_section_colors_panel')), 'section_colors','add_options');
			add_submenu_page('buttons_colors', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_buttons_panel')), 'buttons_colors','add_options');
			add_submenu_page('other_colors', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_form_colors_panel')), 'other_colors','add_options');
			add_submenu_page('slider_colors', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_slider_colors_panel')), 'slider_colors','add_options');
			add_submenu_page('tooltips_colors', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_tooltips_panel')), 'tooltips_colors','add_options');
			add_submenu_page('pagenavi_colors', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_pagenavi_panel')), 'pagenavi_colors','add_options');
			add_submenu_page('sidebar_generator', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_sidebars_panel')), 'sidebar_generator','add_options');
			add_submenu_page('slideshow_generator', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_create_slideshows_panel')), 'slideshow_generator','add_options');
			add_submenu_page('slideshow_colors', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_slideshow_colors_panel')), 'slideshow_colors','add_options');
			add_submenu_page('slideshow_manage', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_slideshows_created_panel')), 'slideshow_manage','add_options');
			add_submenu_page('contact_form_generator', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_create_forms_panel')), 'contact_form_generator','add_options');
			add_submenu_page('contact_form_manage', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_forms_created_panel')), 'contact_form_manage','add_options');
			add_submenu_page('tables_generator', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_create_tables_panel')), 'tables_generator','add_options');
			add_submenu_page('table_colors', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_table_colors_panel')), 'table_colors','add_options');
			add_submenu_page('price_table_manage', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_tables_created_panel')), 'price_table_manage','add_options');
			add_submenu_page('blog_posts', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_posts_panel')), 'blog_posts','add_options');
			add_submenu_page('blog_captcha', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_captcha_panel')), 'blog_captcha','add_options');
			add_submenu_page('blog_pages', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_pages_panel')), 'blog_pages','add_options');
			add_submenu_page('blog_posts_page', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_posts_page_panel')), 'blog_posts_page','add_options');
			add_submenu_page('blog_404', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_404_panel')), 'blog_404','add_options');
			add_submenu_page('blog_archive', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_archive_panel')), 'blog_archive','add_options');
			add_submenu_page('blog_category', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_categories_panel')), 'blog_category','add_options');
			add_submenu_page('blog_search', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_search_panel')), 'blog_search','add_options');
			add_submenu_page('post_related', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_post_related')), 'post_related','add_options');
			add_submenu_page('portfolio_items', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_items_panel')), 'portfolio_items','add_options');
			add_submenu_page('portfolio_gallery', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_galleries_panel')), 'portfolio_gallery','add_options');
			add_submenu_page('portfolio_archive', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_portfolio_archive_panel')), 'portfolio_archive','add_options');
			add_submenu_page('portfolio_related', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_portfolio_related')), 'portfolio_related','add_options');
			add_submenu_page('woo_options', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_woo_panel')), 'woo_options','add_options');
			add_submenu_page('custom_styles', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_styles_panel')), 'custom_styles','add_options');
			add_submenu_page('admin_permissions', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_permissions')), 'admin_permissions','add_options');
			add_submenu_page('category_hack', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_cathacks_panel')), 'category_hack','add_options');
			add_submenu_page('gallery_hack', 'Settings', 'Settings', pix_select_role(pix_get_option('pix_perm_galhacks_panel')), 'gallery_hack','add_options');
		}
}

add_action('admin_menu', 'pix_add_menu');



add_action( 'admin_head', 'pix_icons' );
function pix_icons() {
	global $wp_version;
	if ( version_compare( $wp_version, '3.7.1000', '<' ) ) {
    ?>
    <style type="text/css" media="screen">	
		
        #menu-posts-portfolio .wp-menu-image {
            background: url(<?php echo get_template_directory_uri(); ?>/functions/images/images-stack.png) no-repeat 6px -17px !important;
        }
		#menu-posts-portfolio:hover .wp-menu-image, #menu-posts-portfolio.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
        #menu-posts-portfolio .wp-menu-image:before {
        	content: ''!important;
        	display: none;
        }
		
		/*****************************/
		
        #menu-posts-testimonial .wp-menu-image {
            background: url(<?php echo get_template_directory_uri(); ?>/functions/images/balloon-quotation.png) no-repeat 6px -17px !important;
        }
		#menu-posts-testimonial:hover .wp-menu-image, #menu-posts-testimonial.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
        #menu-posts-testimonial .wp-menu-image:before {
        	content: ''!important;
        	display: none;
        }
		
		/*****************************/
		
        #toplevel_page_admin_interface .wp-menu-image {
            background: url(<?php echo get_template_directory_uri(); ?>/images/forte-icon.svg) no-repeat 8px 6px !important;
        }
		#toplevel_page_admin_interface:hover .wp-menu-image, #toplevel_page_admin_interface.current .wp-menu-image {
            background-position:8px 6px!important;
        }
    </style>
<?php }
}
?>