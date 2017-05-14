<?php

/* Font styles */
$main_font = sdw_get_font_option( 'main_font' );
$h_font = sdw_get_font_option( 'h_font' );
$nav_font = sdw_get_font_option( 'nav_font' );

/* Header styling */
$header_height = absint( sdw_get_option( 'header_height' ) );
$logo_position = sdw_get_option( 'logo_position' );
$logo_top = isset( $logo_position['padding-bottom'] ) ?  $logo_position['padding-bottom']  : 0;
$logo_left = isset( $logo_position['padding-right'] ) ? 	$logo_position['padding-right']  : 0;
$logo_left = sdw_get_option('header_orientation') == 'wide' ? ($logo_left + 30) : $logo_left;
$color_website_title = sdw_get_option( 'color_website_title' );
$color_header_bg = sdw_get_option( 'color_header_bg' );
$color_header_txt = sdw_get_option( 'color_header_txt' );
$color_header_acc = sdw_get_option( 'color_header_acc' );

$color_cover_opc = sdw_get_option( 'color_cover_opc' );

$color_header_opc = sdw_get_option( 'color_header_opc' );
$img_size_cover_height = absint( sdw_get_option( 'img_size_cover_height' ) );

$color_content_bg = sdw_get_option( 'color_content_bg' );
$color_content_title  = sdw_get_option( 'color_content_title' );
$color_content_txt  = sdw_get_option( 'color_content_txt' );
$color_content_acc = sdw_get_option( 'color_content_acc' );
$color_content_meta = sdw_get_option( 'color_content_meta' );

$color_highlight_bg = sdw_get_option( 'color_highlight_bg' );
$color_highlight_txt = sdw_get_option( 'color_highlight_txt' );

/*Footer styling */
$color_footer_bg = sdw_get_option( 'color_footer_bg' );
$color_footer_title = sdw_get_option( 'color_footer_title' );
$color_footer_txt = sdw_get_option( 'color_footer_txt' );
$color_footer_acc = sdw_get_option( 'color_footer_acc' );
$color_footer_meta = sdw_get_option( 'color_footer_meta' );

$body_style = sdw_get_bg_styles( 'body_style' );
?>

<?php if(sdw_get_option('body_layout') == 'boxed') : ?>
	body{
		<?php echo $body_style; ?>;
		color: <?php echo $color_content_txt; ?>
	}
	.sdw-boxed .sdw-main-page{
		background: <?php echo $color_content_bg; ?>;
	}
<?php else: ?>
	body{
		background: <?php echo $color_content_bg; ?>;
		color: <?php echo $color_content_txt; ?>
	}
<?php endif; ?>

body,
.post-date,
select,
.submit, 
input[type="submit"],
.sdw_posts_widget .meta-item a,
#comment,
textarea{
	font-family: <?php echo $main_font['font-family']; ?>;
	font-weight: <?php echo $main_font['font-weight']; ?>;
	<?php if ( isset( $main_font['font-style'] ) && !empty( $main_font['font-style'] ) ):?>
	font-style: <?php echo $main_font['font-style']; ?>;
	<?php endif; ?>
}
h1,h2,h3,h4,h5,h6,
.sdw-prev-next-link,
.sdw-prev-next-link,
.comment-meta .fn,
.mks_pullquote,
blockquote p,
.sdw-has-cover .sdw-cover-area h1, 
.sdw-has-cover .sdw-cover-content h1,
.sdw-description p,
blockquote:before, q:before,
.site-title {
	font-family: <?php echo $h_font['font-family']; ?>;
	font-weight: <?php echo $h_font['font-weight']; ?>;
	<?php if ( isset( $h_font['font-style'] ) && !empty( $h_font['font-style'] ) ):?>
	font-style: <?php echo $h_font['font-style']; ?>;
	<?php endif; ?>
}
.site-header .nav-menu a{
	font-family: <?php echo $nav_font['font-family']; ?>;
	font-weight: <?php echo $nav_font['font-weight']; ?>;
	<?php if ( isset( $nav_font['font-style'] ) && !empty( $nav_font['font-style'] ) ):?>
		font-style: <?php echo $nav_font['font-style']; ?>;
	<?php endif; ?>
}
.sidr{
	background: <?php echo $color_content_bg; ?>;
}

a,
.entry-categories .post-categories li,
.sidebar .sdw_posts_widget .meta-item a{
	color: <?php echo $color_content_acc; ?>;	
}

a:hover,
.entry-categories .post-categories li a:hover,
.sidebar .sdw_posts_widget .meta-item a:hover{
	color: <?php echo sdw_hex2rgba($color_content_acc, 0.7); ?>;	
}
.site-title a{
	color: <?php echo $color_website_title; ?>;
}
.site-header{
	background: <?php echo $color_header_bg; ?>;
}
.sdw-has-cover.sdw-cover-indent .site-header{
	background: <?php echo sdw_hex2rgba($color_header_bg, $color_header_opc); ?>;
}
.site-branding{
	top:  <?php echo $logo_top; ?>px;
	left:  <?php echo $logo_left; ?>px;
}
.site-header{
	height: <?php echo $header_height; ?>px;
}
.sdw-cover-indent .sdw-cover-area{
	margin-top: -<?php echo $header_height; ?>px;
}
.site-header .nav-menu > li > a,
.site-header .sdw-nav-actions li a{
	padding: <?php echo ($header_height-18)/2; ?>px 0;
}
.site-header .sdw-nav-search-wrap{
	margin: <?php echo ($header_height-38)/2; ?>px 0;
}
.site-header .social-menu{
	margin: <?php echo ($header_height-40)/2; ?>px 0;
}
.site-header .nav-menu ul,
.sdw-sticky-clone,
.sdw-has-cover.sdw-cover-indent .site-header.sdw-sticky-clone{
	background: <?php echo sdw_hex2rgba($color_header_bg, 0.9); ?>;
}
#sidr-main{
	background: <?php echo $color_header_bg; ?>;
}
.site-header .nav-menu a,
.site-header .search-input,
#sidr-main a,
#sidr-main ul li span,
.sidr-class-search-input,
.site-header .sdw-nav-search-wrap .sdw-search-input,
.site-header .sdw-nav-search-wrap .sdw-search-input:focus,
.site-header .social-menu li a,
.site-header .social-menu li a:hover,
.sdw-nav-actions li a,
.sidr .sdw-nav-search-wrap .sdw-search-input{
	color: <?php echo $color_header_txt; ?>;
}
.sidr .sdw-nav-search-wrap .sdw-search-input{
	background: <?php echo sdw_hex2rgba( $color_content_meta, 0.2 ); ?>;
	border-color: <?php echo sdw_hex2rgba( $color_content_meta, 0.2 ); ?>;
}
.sdw-responsive-nav, 
.sdw-sidebar-toggle{
	color: <?php echo sdw_hex2rgba($color_header_txt, 0.8); ?>; 
}
.site-header .nav-menu li:hover > a,
.sdw-responsive-nav:hover, 
.sdw-sidebar-toggle:hover,
.sdw-nav-actions li a:hover{
	color: <?php echo $color_header_acc; ?>;
}
#sidr-main a:hover,
#sidr-main a:active,
.sidr-class-current-menu-item > a,
.sidr-class-current_page_item > a {
  box-shadow: 3px 0 0 <?php echo $color_header_acc; ?> inset;
}
.site-header .nav-menu > .current-menu-item{
	box-shadow: 0 3px 0 <?php echo $color_header_acc; ?> inset;
}
.sdw-cover-area{
  max-height: <?php echo $img_size_cover_height; ?>px;
  min-height: <?php echo $img_size_cover_height; ?>px;	
}
.sdw-cover-overlay{
	background: <?php echo sdw_hex2rgba( '#000', $color_cover_opc ); ?>;
}
h1, h2, h3, h4, h5, h6, 
.prev-next-nav a span,
.entry-title a,
.sdw-box-title, 
.comment-reply-title,
.comment-meta .fn{
	color: <?php echo $color_content_title; ?>;
}
.widget-title span,
.sdw-box-title span,
.comment-reply-title span,
.sdw-featured-area .owl-controls .owl-nav > div,
.mks_tab_nav_item.active{
	background: <?php echo $color_content_bg; ?>;
}
.mks_tabs.vertical .mks_tab_nav_item.active{
	border-right: 1px solid <?php echo $color_content_bg; ?> !important;
}

.sidebar .sdw_posts_widget a,
.sidebar .widget_recent_entries a,
.sidebar .widget_categories li a,
.sidebar .widget_archive li a,
.sidebar .widget_pages li a,
.sidebar .widget_nav_menu li a,
.sidebar .widget_meta li a,
.sidebar .widget_recent_comments li a,
.sidebar .widget_rss li a{
	color: <?php echo $color_content_txt; ?>;
}
.sidebar .sdw_posts_widget a:hover,
.sidebar .widget_recent_entries a:hover,
.sidebar .widget_categories li a:hover,
.sidebar .widget_archive li a:hover,
.sidebar .widget_pages li a:hover,
.sidebar .widget_nav_menu li a:hover,
.sidebar .widget_meta li a:hover,
.sidebar .widget_rss li a:hover,
.sidebar .widget_recent_comments li a:hover,
blockquote:before, q:before{
	color: <?php echo $color_content_acc; ?>;
}
.entry-meta > div,
.sdw-pn-label,
.comment-metadata a,
.sidebar .sdw-search-submit,
.post-date,
.meta-tags,
.widget > select,
.rss-date,
.sdw-paginated-num{
	color: <?php echo $color_content_meta; ?>;
}
input[type="text"], 
input[type="email"], 
input[type="url"], 
input[type="tel"], 
input[type="number"], 
input[type="date"], 
input[type="password"], 
select, 
#comment, 
textarea{
	border-color: <?php echo sdw_hex2rgba( $color_content_meta, 0.7 ); ?>;
}
#sidr-sidebar{
	box-shadow: 1px 0 0 <?php echo sdw_hex2rgba( $color_content_meta, 0.7 ); ?> inset;
}
.entry-title a:hover,
.nav-menu a:hover,
.prev-next-nav a:hover,
.meta-action a,
.sdw-share,
.entry-categories .post-categories li a,
.prev-next-nav a:hover span,
.comment-reply-link,
.comment-metadata .comment-edit-link,
.sidebar .sdw-search-submit:hover,
#wp-calendar tbody td a,
.sdw-featured-area .owl-controls .owl-nav > div{
	color: <?php echo $color_content_acc; ?>;
}
.meta-action a,
.sdw-share,
#sdw-pagination a,
.comment-reply-link,
.wpcf7-submit,
.submit{
	border-color: <?php echo sdw_hex2rgba( $color_content_acc, 0.7 ); ?>;
}
.sdw-rm a,
.sdw-button-primary,
.wpcf7-submit,
.submit,
input[type="submit"],
.sdw-featured-area .owl-controls .owl-nav > div:hover,
.sdw-pagination .current{
	background: <?php echo $color_content_acc; ?>;	
	color: <?php echo $color_content_bg; ?>;
	border-color: <?php echo $color_content_acc; ?>;
}
.sdw-rm a:hover,
.entry-footer .sdw-comments a:hover,
.sdw-share:hover,
#sdw-pagination a:hover,
.comment-reply-link:hover,
.submit:hover,
.sdw-button-primary:hover,
.sdw-button-secondary:hover,
.sdw-author-links a:hover,
.mks_read_more a:hover,
.mks_autor_link_wrap a:hover,
.wpcf7-submit:hover,
input[type="submit"]:hover,
.tagcloud a:hover,
.sdw-link-pages a:hover,
.wpcf7-submit:hover,
.submit:hover,
input[type="submit"]:hover,
.sdw-404-menu li a:hover{
	background: <?php echo sdw_hex2rgba($color_content_acc, 0.7); ?>;
	border-color: <?php echo sdw_hex2rgba($color_content_acc, 0.1); ?>;
	color: <?php echo $color_content_bg; ?>;
}
.site-main .mejs-container,
.site-main .mejs-embed, 
.site-main .mejs-embed body, 
.sdw-post .site-main .mejs-container .mejs-controls,
pre,
.sdw-loader,
.sdw-loader:before,
.sdw-loader:after,
.sdw-letter-avatar,
.site-main .mejs-container, 
.site-main .mejs-embed, 
.site-main .mejs-embed body, 
.site-main .mejs-container .mejs-controls{
	background: <?php echo $color_content_acc; ?>;
}
.sdw-fa-overlay-hover{
	background: <?php echo sdw_hex2rgba( $color_content_acc, 1) ; ?>;
}
.sdw-highlight .entry-wrapper,
.sdw-layout-a.sdw-highlight .post-thumbnail:before,
.sdw-layout-b.sdw-highlight .sdw-post-inside,
.sdw-layout-c.sdw-highlight .sdw-post-inside{
	background: <?php echo $color_highlight_bg; ?>;
}
.sdw-highlight .sdw-rm a{
	background-color: <?php echo $color_highlight_txt; ?>;
	color: <?php echo $color_highlight_bg; ?>;
}

.sdw-highlight .entry-footer .sdw-comments a:hover,
.sdw-highlight .entry-footer .sdw-share:hover,
.sdw-highlight .sdw-rm a:hover {
	background: <?php echo sdw_hex2rgba($color_highlight_txt, 0.9) ; ?>;
	border-color: <?php echo sdw_hex2rgba($color_highlight_bg, 0.1); ?>;
	color: <?php echo $color_highlight_bg; ?>;	
}
.sdw-highlight,
.sdw-highlight a,
.sdw-highlight .entry-title a,
.sdw-highlight .entry-meta > div,
.sdw-highlight .entry-footer .meta-action,
.sdw-highlight .entry-categories .post-categories li a,
.sdw-highlight.sdw-post.sticky .entry-title:before,
.sdw-highlight .entry-categories .post-categories li:before{
	color: <?php echo $color_highlight_txt; ?>;
}

.sdw-highlight .meta-action a, 
.sdw-highlight .sdw-share{
	border-color: <?php echo sdw_hex2rgba($color_highlight_txt, 0.7) ; ?>;
}
.sdw-highlight .entry-title a:hover,
.sdw-highlight .entry-categories .post-categories li a:hover,
.sdw-highlight .author a:hover,
.sdw-highlight .sdw-comments a:hover,
.sdw-highlight .entry-content a:hover{
	color: <?php echo sdw_hex2rgba($color_highlight_txt, 0.7); ?>;
}

.widget-title::after, 
.sdw-box-title:after,
.comment-reply-title:after,
.widget_recent_entries li:before,
.widget_recent_comments li:before,
.widget_categories li:before,
.widget_archive li:before,
.widget_pages li:before,
.widget_nav_menu li:before,
.widget_meta li:before,
.widget_rss li:before{
	border-bottom: 1px solid <?php echo sdw_hex2rgba($color_content_meta, 0.4); ?>;
}
.entry-content table,
tr,
td, th,
#wp-calendar tbody td,
#wp-calendar,
.mks_tab_nav_item,
.mks_tab_item, 
.mks_toggle,
.mks_tabs.vertical .mks_tab_nav_item,
.mks_accordion, 
.mks_toggle,
.mks_tabs.vertical .mks_tab_nav_item.active,
.mks_tabs.vertical .mks_tab_item,
.mks_accordion_content, 
.mks_toggle_content,
.mks_accordion_item{
	border-color: <?php echo sdw_hex2rgba($color_content_meta, 0.6); ?>;
}
thead tr,
.mks_tab_nav_item,
.mks_accordion_heading, 
.mks_toggle_heading{
	background: <?php echo sdw_hex2rgba($color_content_meta, 0.2); ?>;
}

.comment .comment-respond{
	background: <?php echo $color_content_bg; ?>;
}
.mejs-container *{
	font-family: <?php echo $main_font['font-family']; ?> !important;
}

.site-footer,
.site-footer .widget-title span{
	background: <?php echo $color_footer_bg; ?>;
}
.site-footer .widget-title::after,
.site-footer .widget li:before,
.shl-footer-menu:before{
	border-bottom: 1px solid <?php echo sdw_hex2rgba($color_footer_meta, 0.4); ?>;
}
.site-footer #wp-calendar tbody td{
	border-color: <?php echo sdw_hex2rgba($color_footer_meta, 0.4); ?>;
}

.site-footer{
	color: <?php echo $color_footer_txt; ?>; 
}
.site-footer a{
	color: <?php echo $color_footer_acc; ?>; 
}
.site-footer a:hover,
.site-footer .widget li > a:hover,
.site-footer .widget li > div > a:hover{
	color: <?php echo sdw_hex2rgba($color_footer_acc, 0.7); ?>; 
}

.site-footer .widget-title,
.site-footer .widget li > a,
.site-footer .widget li > div > a,
.site-footer .widget h1,
.site-footer .widget h2,
.site-footer .widget h3,
.site-footer .widget h4,
.site-footer .widget h5,
.site-footer .widget h6 {
	color: <?php echo $color_footer_title; ?>;
}

.site-footer .mks_read_more a:hover, 
.site-footer .mks_autor_link_wrap a:hover{
   	background: <?php echo sdw_hex2rgba( $color_footer_acc, 0.7); ?>;
  	border-color: <?php echo sdw_hex2rgba( $color_footer_acc, 0.1); ?>;
  	color: <?php echo $color_footer_txt; ?>;
 }
.site-footer .entry-meta > div,
.site-footer .sdw-search-submit,
.site-footer .post-date,
.site-footer .meta-tags,
.site-footer .widget > select,
.site-footer .rss-date,
.site-footer .widget_search{
	color: <?php echo $color_footer_meta; ?>; 
}

@-webkit-keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0 <?php echo $color_content_acc; ?>;
    height: 2em;
  }
  40% {
    box-shadow: 0 -0.3em <?php echo $color_content_acc; ?>;
    height: 3em;
  }
}
@keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0 <?php echo $color_content_acc; ?>;
    height: 2em;
  }
  40% {
    box-shadow: 0 -0.3em <?php echo $color_content_acc; ?>;
    height: 3em;
  }
}

.site-header .sdw-search-input::-webkit-input-placeholder { /* WebKit browsers */
    color: <?php echo $color_header_txt; ?>;
}
.site-header .sdw-search-input:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
	color: <?php echo $color_header_txt; ?>;
}
.site-header .sdw-search-input::-moz-placeholder { /* Mozilla Firefox 19+ */
	color: <?php echo $color_header_txt; ?>;
}
.site-header .sdw-search-input:-ms-input-placeholder { /* Internet Explorer 10+ */
	color: <?php echo $color_header_txt; ?>;
}

<?php
	/* Apply uppercase options */
	$text_upper = sdw_get_option( 'text_upper' );
	if ( !empty( $text_upper ) ) {
		foreach ( $text_upper as $text_class => $val ) {
			if ( $val )
				echo '.'.$text_class.'{text-transform: uppercase;}';
		}
	}
?>