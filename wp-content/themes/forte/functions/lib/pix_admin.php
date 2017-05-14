<?php
$forte_theme = wp_get_theme();
$version = $forte_theme->get( 'Version' );
if ( is_admin() && $version != get_option('pix_last_version') ){
	update_option('pix_last_version',$version);
	forteInstall();
	pix_add_default_content();
}
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ){
	
	forteInstall();
	pix_add_default_content();
	
	wp_redirect(admin_url("admin.php?page=admin_interface&activated=true"));
	$fonts = array(
		'Satisfy',
		'Open Sans'
	);
	if ( pix_get_option('pix_font_families') == '' ) {
		pix_google_arrays( $fonts );
	}
}

function forteInstall() {
	global $wpdb;
	$table_name = $wpdb->prefix . "forte";
	$charset_collate = '';
	
	if ( ! empty($wpdb->charset) )
		$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
	if ( ! empty($wpdb->collate) )
		$charset_collate .= " COLLATE $wpdb->collate";

	if( !$wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) ) {
	  
		$sql = "CREATE TABLE " . $table_name . " (
		name VARCHAR(255) NOT NULL,
		value LONGTEXT,
		icl VARCHAR(255),
		id int(10) NOT NULL AUTO_INCREMENT,
		PRIMARY KEY (id)
		) $charset_collate;";
	
	   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	   dbDelta($sql);
	} else {
		$col_id = $wpdb->get_col("SELECT id FROM $table_name");	  
		if ( !$col_id || empty($col_id) ) {
            $wpdb->query($wpdb->prepare("ALTER TABLE %s ADD %s int(10) unsigned primary KEY AUTO_INCREMENT", $table_name, 'id'));
		}
		pix_add_general();
	}
	
}

function pix_add_general() {
	global $options;
	add_options();
	foreach ($options as $value) :
		if(isset($value['icl']) && $value['icl']=='true'){
			if(!pix_get_option($value['id'])){
				pix_add_option($value['id'], $value['std'], $value['icl']);
			}
			if (function_exists('icl_register_string') && $value['id']!='' && $value['id']!='page' ) {
				icl_register_string('Forte', $value['id'], $value['std']);
			}
		} else {
			if(!pix_get_option($value['id'])){
				pix_add_option($value['id'], $value['std'], 'NULL');
			}
		}
	endforeach;
}

function pix_add_default_content() {
	global $current_user, $wpdb;
	get_currentuserinfo();
	
	$post_content = '<section class="pix_slideshow_wrap firstSlideShow pix_fullheight">
<div class="pix_column">
<div class="pix_column" data-class="pix_column pix_fullheight pix_column_990" data-full="true" data-slideshow="true">

[pix_slideshow data_slideshow=\'forte_temp_slide\']

</div>
</div>
</section><section>
<div class="pix_column pix_column_990">
<div class="pix_column pix_column_210 alignleft" data-class="pix_column alignleft pix_column_210">
<p class="home_featured_icon icon-cogs">Admin panel</p>
<p style="text-align: center;"><strong>EXTENDED ADMIN PANEL</strong></p>
<em>To customize almost everything,</em> colors, fonts, positions, opacities, styles. <strong>All the colors of this skin are editable</strong> on the custom admin panel thanks to color pickers very easy to use. And many <em>composers</em> are available: <strong>ajax contact form</strong> builder with captcha, <strong>layer slideshow</strong> builder, <strong>price table</strong> builder.

</div>
<div class="pix_column pix_column_210 alignleft" data-class="pix_column alignleft pix_column_210">
<p class="home_featured_icon icon-shopping-cart">shopping cart</p>
<p style="text-align: center;"><strong>ECOMMERCE READY</strong></p>
Forte supports <strong><a href="http://wordpress.org/extend/plugins/woocommerce/" target="_blank">Woo-Commerce</a></strong>, in facts, and adds to it the zoom effect for the products and the ability to select until 12 layouts for the product list pages and the shortcodes. Forte is also compatible with <strong>WPML </strong>and <strong>WP Super Cache</strong>, and it has a <strong>mega menu</strong>, a layered slideshow and other plugins integrated.

</div>
<div class="pix_column pix_column_210 alignleft" data-class="pix_column alignleft pix_column_210">
<p class="home_featured_icon icon-camera">portfolio Wordpress theme</p>
<p style="text-align: center;"><strong>PORTFOLIO LAYOUTS</strong></p>
<em>With a like button integrated, </em> <strong>Forte</strong> could be used as a portfolio, with a plenty of layouts, masonry effect (post formats are allowed here too). Each gallery can have its own settings: <strong>layout</strong>, sidebar, posts per page, page navigation or  <strong>infinite scroll button</strong>, layout of the <strong>related items</strong>, set everything from the admin panel.

</div>
<div class="pix_column pix_column_210 alignright" data-class="pix_column alignright pix_column_210">
<p class="home_featured_icon icon-magic">page builder</p>
<p style="text-align: center;"><strong>MAGIC PAGE BUILDER</strong></p>
<em>To turn into reality your creative ideas,</em> a very intuitive <strong>page composer</strong> with a simple drag and drop system and many shortcode buttons. You can set from there a <strong>full screen slideshow</strong>, or a section divider with a <strong>full width background </strong>and featured text inside, <strong>create grids</strong>... a very comprehensive tool.

</div>
</div>
</section><section>
<div class="pix_column pix_column_990">
<div class="pix_column pix_column_990 alignleft" data-class="pix_column alignleft pix_column_990">

  [hr]
<h3 style="text-align: center;">The back end</h3>
</div>
</div>
</section><section>
<div class="pix_column pix_column_990">
<div class="pix_column pix_column_470 alignleft" data-class="pix_column alignleft pix_column_470">
<h5>Page composer</h5>
<img class="alignnone size-full wp-image-2513" style="border: 1px solid #eaeaea;" alt="page_composer" src="'.get_template_directory_uri().'/images/assets/page_composer.jpg" width="470" height="206" />

This home page is a simple static page built thanks to the very simple, intuitive <strong>page composer</strong> available for static pages, blog posts and portfolio items. With the useful drag &amp; drop system you\'ll be able to compose your grids, add sections, full screen slideshows, tabs, accordions etc.

</div>
<div class="pix_column pix_column_470 alignright" data-class="pix_column alignright pix_column_470">
<h5>Visual preview</h5>
<img class="alignnone size-full wp-image-2515" style="border: 1px solid #eaeaea;" alt="visual_preview" src="'.get_template_directory_uri().'/images/assets/visual_preview.jpg" width="460" height="206" />

If you switch from the "builder" mode to the "visual" mode (and however all the times you add some content by using the visual editor), the style of the editor reflects the style of the front-end: Google fonts, adaptiveness, colors, spaces, alignments.

</div>
</div>
</section><section>
<div class="pix_column pix_column_990">
<div class="pix_column pix_column_990 alignleft" data-class="pix_column alignleft pix_column_990">[hr]</div>
</div>
</section><section class="pix_divider pix_cover" style="background-image: url(\''.get_template_directory_uri().'/images/assets/slide_1_bg_blur.jpg\');">
<div class="pix_column pix_column_990">
<div class="pix_column pix_column_990 alignleft" data-class="pix_column alignleft pix_cover pix_column_990" data-full="true">
<h2 style="text-align: center;"><span class="pix_edited_text" style="color: #424242; background-color: rgba(255,255,255,0.8); line-height: 1.35em;" data-style="rgba(255,255,255,0.8)">Plenty of delicious features inside, shortcodes, intuitive page builder, AJAX admin panel</span></h2>
<h6 style="text-align: center;"><span class="pix_edited_text" style="color: #454545; background-color: rgba(255,255,255,0.8); line-height: 1.45em;">And video tutorials available, sample content (xml file), simple skin importer and exporter, mega menu, WooCommerce ready, widget ready, WPML ready, WPMU ready, WP Super Cache ready, 10+ portfolio layouts, so many possibilities...</span></h6>
</div>
</div>
</section><section>
<div class="pix_column pix_column_990">
<div class="pix_column pix_column_990 alignleft" data-class="pix_column alignleft pix_column_990">Some video tutorials are available to explain how to use the <strong>page builder</strong>, the <strong>custom admin panel</strong>, to explain how to set a <strong>mega-menu</strong>, how to create a <strong>portfolio gallery</strong>. Visit the demo site <a href="http://www.pixedelic.com/themes/forte/" target="_blank">http://www.pixedelic.com/themes/forte/</a> for the whole list.</div>
</div>
</section>';
	
	$post = array(
	  'comment_status' => 'closed',
	  'post_author' => $current_user->ID,
	  'post_name' => 'forte-temporary-home',
	  'post_status' => 'publish',
	  'post_title' => 'Forte temporary home',
	  'post_type' => 'page',
	  'post_content' => $post_content
	);
	
	$post2 = array(
	  'comment_status' => 'closed',
	  'post_author' => $current_user->ID,
	  'post_name' => 'forte-temporary-blog',
	  'post_status' => 'publish',
	  'post_title' => 'Forte temporary blog',
	  'post_type' => 'page'
	);
	
	if(!get_page_by_title('Forte temporary home') && !get_page_by_title('Forte temporary blog') && !pix_get_option('pix_admin_page_title') ) {

		$slideshows = pix_get_option('pix_array_your_slideshows_');
		$slideshow = pix_get_option('pix_array_your_slideshows_forte_temp_slide');

		if ( empty($slideshow) || !isset($slideshow) ) {
			if ( empty($slideshows) || !isset($slideshows) ) { 
				pix_delete_option('pix_array_your_slideshows_');
				$slideshows = array('forte_temp_slide'=>'forte_temp_slide');
				pix_add_option('pix_array_your_slideshows_',$slideshows,NULL);
			} else {
				$slideshows['forte_temp_slide'] = 'forte_temp_slide';
				pix_update_option('pix_array_your_slideshows_',$slideshows);
			}
			$img1 = get_template_directory_uri().'/images/assets/slide_1_bg_blur.jpg';
			$img2 = get_template_directory_uri().'/images/assets/imac.png';
			$img3 = get_template_directory_uri().'/images/assets/ipad.png';
			$img4 = get_template_directory_uri().'/images/assets/macbook.png';
			$img5 = get_template_directory_uri().'/images/assets/slide_2_bg_blur.jpg';
			$img6 = get_template_directory_uri().'/images/assets/tomato_ketchup.png';
			$img7 = get_template_directory_uri().'/images/assets/buy_tomato_ketchup.png';
			$img8 = get_template_directory_uri().'/images/assets/slide_3_bg_blur.jpg';
			$img9 = get_template_directory_uri().'/images/assets/dashed_frame.png';
			$slide_cont = maybe_unserialize('a:14:{s:5:"width";s:2:"16";s:6:"height";s:1:"9";s:4:"time";s:4:"7000";s:11:"transperiod";s:3:"600";s:5:"until";s:0:"";s:5:"under";s:0:"";s:5:"image";s:0:"";s:9:"playpause";s:4:"true";s:8:"prevnext";s:4:"true";s:10:"pagination";s:4:"true";s:3:"pie";s:4:"true";s:11:"autoadvance";s:4:"true";s:5:"hover";s:1:"0";s:5:"slide";a:3:{i:0;a:1:{s:7:"element";a:9:{i:0;a:27:{s:4:"type";s:10:"background";s:13:"backgroundimg";s:'.strlen($img1).':"'.$img1.'";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:0:"";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:0:"";s:4:"html";s:0:"";s:8:"position";s:0:"";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:0:"";s:6:"height";s:0:"";s:8:"fontsize";s:0:"";s:5:"delay";s:0:"";s:4:"time";s:0:"";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:4:"none";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:4:"none";s:10:"rotate_out";s:1:"0";s:6:"easein";s:6:"linear";s:7:"easeout";s:6:"linear";}i:1;a:27:{s:4:"type";s:5:"image";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:'.strlen($img2).':"'.$img2.'";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:0:"";s:4:"html";s:0:"";s:8:"position";s:15:"left:134,top:69";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:3:"100";s:6:"height";s:3:"100";s:8:"fontsize";s:2:"13";s:5:"delay";s:1:"0";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:8:"fromleft";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:6:"toleft";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}i:2;a:27:{s:4:"type";s:7:"caption";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:0:"";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:23:"An elegant and flexible";s:4:"html";s:0:"";s:8:"position";s:15:"left:614,top:49";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:4:"auto";s:6:"height";s:4:"auto";s:8:"fontsize";s:2:"32";s:5:"delay";s:3:"900";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:9:"fromright";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:7:"toright";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}i:3;a:27:{s:4:"type";s:7:"caption";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:0:"";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:28:"multipurpose Wordpress theme";s:4:"html";s:0:"";s:8:"position";s:16:"left:476,top:106";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:4:"auto";s:6:"height";s:4:"auto";s:8:"fontsize";s:2:"32";s:5:"delay";s:4:"1200";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:9:"fromright";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:7:"toright";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}i:4;a:27:{s:4:"type";s:7:"caption";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:0:"";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:23:"with an adaptive layout";s:4:"html";s:0:"";s:8:"position";s:16:"left:604,top:163";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:4:"auto";s:6:"height";s:4:"auto";s:8:"fontsize";s:2:"32";s:5:"delay";s:4:"1500";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:9:"fromright";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:7:"toright";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}i:5;a:27:{s:4:"type";s:7:"caption";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:0:"";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:30:"and incredible features inside";s:4:"html";s:0:"";s:8:"position";s:16:"left:507,top:220";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:4:"auto";s:6:"height";s:4:"auto";s:8:"fontsize";s:2:"32";s:5:"delay";s:4:"1800";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:9:"fromright";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:7:"toright";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}i:6;a:27:{s:4:"type";s:4:"html";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:0:"";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:0:"";s:4:"html";s:103:"<a href=\"#\"><span class=\"pix_button second_color large\" data-fontsize=\"15\">have a look</span></a>";s:8:"position";s:16:"left:841,top:277";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:4:"auto";s:6:"height";s:4:"auto";s:8:"fontsize";s:2:"13";s:5:"delay";s:4:"2100";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:9:"fromright";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:7:"toright";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}i:7;a:27:{s:4:"type";s:5:"image";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:'.strlen($img3).':"'.$img3.'";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:0:"";s:4:"html";s:0:"";s:8:"position";s:16:"left:581,top:320";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:3:"100";s:6:"height";s:3:"100";s:8:"fontsize";s:2:"13";s:5:"delay";s:3:"900";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:9:"fromright";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:7:"toright";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}i:8;a:27:{s:4:"type";s:5:"image";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:'.strlen($img4).':"'.$img4.'";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:0:"";s:4:"html";s:0:"";s:8:"position";s:15:"left:-3,top:274";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:3:"100";s:6:"height";s:3:"100";s:8:"fontsize";s:2:"13";s:5:"delay";s:3:"450";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:8:"fromleft";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:6:"toleft";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}}}i:1;a:1:{s:7:"element";a:5:{i:0;a:27:{s:4:"type";s:10:"background";s:13:"backgroundimg";s:'.strlen($img5).':"'.$img5.'";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:0:"";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:0:"";s:4:"html";s:0:"";s:8:"position";s:0:"";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:0:"";s:6:"height";s:0:"";s:8:"fontsize";s:0:"";s:5:"delay";s:0:"";s:4:"time";s:0:"";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:4:"none";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:4:"none";s:10:"rotate_out";s:1:"0";s:6:"easein";s:6:"linear";s:7:"easeout";s:6:"linear";}i:1;a:27:{s:4:"type";s:7:"caption";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:0:"";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:21:"Perfect as e-commerce";s:4:"html";s:0:"";s:8:"position";s:15:"left:621,top:41";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:4:"auto";s:6:"height";s:4:"auto";s:8:"fontsize";s:2:"32";s:5:"delay";s:1:"0";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:9:"fromright";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:7:"toright";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}i:2;a:27:{s:4:"type";s:7:"caption";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:0:"";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:20:"by using WooCommerce";s:4:"html";s:0:"";s:8:"position";s:15:"left:566,top:97";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:4:"auto";s:6:"height";s:4:"auto";s:8:"fontsize";s:2:"32";s:5:"delay";s:3:"450";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:9:"fromright";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:7:"toright";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}i:3;a:27:{s:4:"type";s:5:"image";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:'.strlen($img6).':"'.$img6.'";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:0:"";s:4:"html";s:0:"";s:8:"position";s:15:"left:89,top:341";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:3:"100";s:6:"height";s:3:"100";s:8:"fontsize";s:2:"13";s:5:"delay";s:4:"1000";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:8:"fromleft";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:6:"toleft";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}i:4;a:27:{s:4:"type";s:5:"image";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:'.strlen($img7).':"'.$img7.'";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:0:"";s:4:"html";s:0:"";s:8:"position";s:16:"left:329,top:387";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:3:"100";s:6:"height";s:3:"100";s:8:"fontsize";s:2:"13";s:5:"delay";s:4:"1300";s:4:"time";s:3:"800";s:4:"link";s:47:"http://themeforest.net/user/pixedelic/statement";s:6:"target";s:1:"0";s:4:"fxin";s:8:"fromleft";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:6:"toleft";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}}}i:2;a:1:{s:7:"element";a:6:{i:0;a:27:{s:4:"type";s:10:"background";s:13:"backgroundimg";s:'.strlen($img8).':"'.$img8.'";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:0:"";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:0:"";s:4:"html";s:0:"";s:8:"position";s:0:"";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:0:"";s:6:"height";s:0:"";s:8:"fontsize";s:0:"";s:5:"delay";s:0:"";s:4:"time";s:0:"";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:4:"none";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:4:"none";s:10:"rotate_out";s:1:"0";s:6:"easein";s:6:"linear";s:7:"easeout";s:6:"linear";}i:1;a:27:{s:4:"type";s:5:"image";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:'.strlen($img9).':"'.$img9.'";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:0:"";s:4:"html";s:0:"";s:8:"position";s:16:"left:262,top:-39";s:6:"fadein";s:4:"true";s:7:"fadeout";s:4:"true";s:5:"width";s:3:"100";s:6:"height";s:3:"100";s:8:"fontsize";s:2:"13";s:5:"delay";s:4:"2000";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:7:"fromtop";s:9:"rotate_in";s:4:"true";s:5:"fxout";s:5:"totop";s:10:"rotate_out";s:4:"true";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}i:2;a:27:{s:4:"type";s:7:"caption";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:0:"";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:12:"Many layouts";s:4:"html";s:0:"";s:8:"position";s:14:"left:0,top:218";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:4:"auto";s:6:"height";s:4:"auto";s:8:"fontsize";s:2:"32";s:5:"delay";s:1:"0";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:8:"fromleft";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:6:"toleft";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}i:3;a:27:{s:4:"type";s:7:"caption";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:0:"";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:21:"to create outstanding";s:4:"html";s:0:"";s:8:"position";s:14:"left:0,top:275";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:4:"auto";s:6:"height";s:4:"auto";s:8:"fontsize";s:2:"32";s:5:"delay";s:3:"400";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:8:"fromleft";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:6:"toleft";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}i:4;a:27:{s:4:"type";s:7:"caption";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:0:"";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:19:"portfolio galleries";s:4:"html";s:0:"";s:8:"position";s:14:"left:0,top:332";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:4:"auto";s:6:"height";s:4:"auto";s:8:"fontsize";s:2:"32";s:5:"delay";s:3:"800";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:8:"fromleft";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:6:"toleft";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}i:5;a:27:{s:4:"type";s:4:"html";s:13:"backgroundimg";s:0:"";s:7:"bgcolor";s:11:"transparent";s:8:"link_100";s:0:"";s:10:"target_100";s:1:"0";s:9:"simpleimg";s:0:"";s:5:"video";s:0:"";s:9:"videostop";s:1:"0";s:8:"autoplay";s:1:"0";s:7:"caption";s:0:"";s:4:"html";s:103:"<a href=\"#\"><span class=\"pix_button second_color large\" data-fontsize=\"15\">have a look</span></a>";s:8:"position";s:14:"left:0,top:389";s:6:"fadein";s:1:"0";s:7:"fadeout";s:1:"0";s:5:"width";s:4:"auto";s:6:"height";s:4:"auto";s:8:"fontsize";s:2:"13";s:5:"delay";s:4:"1200";s:4:"time";s:3:"800";s:4:"link";s:0:"";s:6:"target";s:1:"0";s:4:"fxin";s:8:"fromleft";s:9:"rotate_in";s:1:"0";s:5:"fxout";s:6:"toleft";s:10:"rotate_out";s:1:"0";s:6:"easein";s:11:"easeOutQuad";s:7:"easeout";s:10:"easeInQuad";}}}}}');
			pix_add_option('pix_array_your_slideshows_forte_temp_slide',$slide_cont,NULL);
		}

		wp_insert_post($post);
		$page = get_page_by_title( 'Forte temporary home' );
		update_post_meta($page->ID, 'pix_pag_opts_hidetitle', 'on');
		update_post_meta($page->ID, '_wp_page_template', 'widepage.php');
		update_post_meta($page->ID, 'pix_pag_opts_share', 'hide');
		
		wp_insert_post($post2);
		$page2 = get_page_by_title( 'Forte temporary blog' );
		
		update_option('show_on_front','page');
		update_option('page_on_front',$page->ID);
		update_option('page_for_posts',$page2->ID);

		$pix_array_your_slideshows = pix_get_option('pix_array_your_slideshows_');
		

		pix_add_general();
	} else {
		pix_add_general();
	}
}

function add_options()
{
	$forte_theme = wp_get_theme();
	$version = $forte_theme->get( 'Version' );
	global $options, $woocommerce_en;
	
	if ( $woocommerce_en == 'active' ) {
		$stand_cart = 'true';
	} else {
		$stand_cart = '0';
	}

	$options = array (

		array( "id" => "pix_last_version",
			"std" => $version,
			"icl" => "NULL"),

		array( "id" => "pix_last_tweet",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_tweets_message",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_chmod_message",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_documentation_message",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_admin_page_title",
			"std" => "Forte",
			"icl" => "NULL"),
			
		array( "id" => "pix_login_logo",
			"std" => get_template_directory_uri()."/functions/images/forte_logo_login.png",
			"icl" => "NULL"),
			
		array( "id" => "pix_admin_panel_logo",
			"std" => get_template_directory_uri()."/functions/images/forte_sprite_admin.png",
			"icl" => "NULL"),
			
		array( "id" => "pix_admin_panel_logo_css",
			"std" => "no-repeat 0 -819px",
			"icl" => "NULL"),
			
		array( "id" => "pix_allow_changelog",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_allow_tweets",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_enable_google",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_select_fonts",
			"std" => array(
				'Satisfy',
				'Josefin Slab',
				'Open Sans'
				),
			"icl" => "NULL"),
			
		array( "id" => "pix_font_families",
			"std" => array(
				'Satisfy',
				'Josefin Slab',
				'Open Sans'
				),
			"icl" => "NULL"),
			
		array( "id" => "pix_font_variants",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_font_subsets",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_allow_ajax",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_floatingicons_position_bgcolor_opacity",
			"std" => "0.97",
			"icl" => "NULL"),
			
		array( "id" => "pix_floatingicons_woocommerce_amount_bg",
			"std" => "#ffd700",
			"icl" => "NULL"),
			
		array( "id" => "pix_floatingicons_woocommerce_amount_color",
			"std" => "#222222",
			"icl" => "NULL"),
			
		array( "id" => "pix_filter_price_bg",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_filter_price_light_border",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_filter_price_dark_border",
			"std" => "#000000",
			"icl" => "NULL"),
			
		array( "id" => "pix_filter_price_track",
			"std" => "#5b5b5b",
			"icl" => "NULL"),
			
		array( "id" => "pix_filter_price_range",
			"std" => "#f83f3f",
			"icl" => "NULL"),
			
		array( "id" => "pix_filter_price_dragger",
			"std" => "#ebebeb",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_resize",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_effect",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_position",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_bgcolor",
			"std" => "#fafafa",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_borderbottom",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_bordertop",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_bgcolor_opacity",
			"std" => "0.97",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_bgimage",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_bgimage_css",
			"std" => "repeat",
			"icl" => "NULL"),
			
		array( "id" => "pix_logo_bgcolor",
			"std" => "transparent",
			"icl" => "NULL"),
			
		array( "id" => "pix_logo_color",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_logoimage",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_logostyle",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_sitetitle_fontfamily",
			"std" => "Open+Sans",
			"icl" => "NULL"),
			
		array( "id" => "pix_sitetitle_fontvariants",
			"std" => "600",
			"icl" => "NULL"),
			
		array( "id" => "pix_sitetitle_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_sitetitle_fontsize",
			"std" => "25",
			"icl" => "NULL"),
			
		array( "id" => "pix_sitedescription_fontfamily",
			"std" => "Open+Sans",
			"icl" => "NULL"),
			
		array( "id" => "pix_sitedescription_fontvariants",
			"std" => "400",
			"icl" => "NULL"),
			
		array( "id" => "pix_sitedescription_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_sitedescription_fontsize",
			"std" => "12",
			"icl" => "NULL"),
			
		array( "id" => "pix_append_head_top",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_append_head_bottom",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_1stlevel_fontfamily",
			"std" => "Open+Sans",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_1stlevel_fontvariants",
			"std" => "regular",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_1stlevel_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_1stlevel_fontsize",
			"std" => "12",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_1stcolor",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_1sthover",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_1sthover_bg",
			"std" => "#000000",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_1sthover_bg_opacity",
			"std" => "0.06",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_1sthover_indicator",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_1scurrent",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_current_bg",
			"std" => "#000000",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_current_bg_opacity",
			"std" => "0.06",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_current_indicator",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_button",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_button_bg",
			"std" => "#eeeeee",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_button_border",
			"std" => "#cccccc",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_2ndlevel_fontfamily",
			"std" => "Open+Sans",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_2ndlevel_fontvariants",
			"std" => "regular",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_2ndlevel_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_2ndlevel_fontsize",
			"std" => "13",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_2ndcolor",
			"std" => "#eaeaea",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_megatitles",
			"std" => "#f35959",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_2ndbg",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_2ndhover",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_2ndhover_bg",
			"std" => "#252525",
			"icl" => "NULL"),
			
		array( "id" => "pix_nav_2ndhover_border",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_dropdown_2ndbgopacity",
			"std" => "0.97",
			"icl" => "NULL"),
			
		array( "id" => "pix_mega_separator_color",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_mega_separator_opacity",
			"std" => "0.5",
			"icl" => "NULL"),
			
		array( "id" => "pix_enable_breadcrumbs",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_enable_titlesection",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_bgcolor",
			"std" => "#353535",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_border",
			"std" => "#151515",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_bgimage",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_bgimage_css",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_separator_color",
			"std" => "#5b5b5b",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_color",
			"std" => "#999999",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_title",
			"std" => "#eaeaea",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_link",
			"std" => "#bbbbbb",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_list_sign",
			"std" => "#f35959",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_soft_bg",
			"std" => "#e7e7e7",
			"icl" => "NULL"),
			
		array( "id" => "pix_first_footer",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_second_footer",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_third_footer",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_fourth_footer",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_tiny_button_bg",
			"std" => "#555555",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_tiny_button_textcolor",
			"std" => "#eaeaea",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_tiny_button_border",
			"std" => "#252525",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_simple_button_bg",
			"std" => "#e0e0e0",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_simple_button_textcolor",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_simple_button_border",
			"std" => "transparent",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_first_color_button_bg",
			"std" => "#555555",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_first_color_button_textcolor",
			"std" => "#eaeaea",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_first_color_button_border",
			"std" => "#252525",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_second_color_button_bg",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_second_color_button_textcolor",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_second_color_button_border",
			"std" => "#9d1b1b",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_third_color_button_bg",
			"std" => "#2fd4cb",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_third_color_button_textcolor",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_third_color_button_border",
			"std" => "#1b8882",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_credits",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_credits_left",
			"std" => get_bloginfo('name')." | ".get_bloginfo('description'),
			"icl" => "true"),
			
		array( "id" => "pix_credits_right",
			"std" => "©2013",
			"icl" => "true"),
			
		array( "id" => "pix_credits_color",
			"std" => "#999999",
			"icl" => "NULL"),
			
		array( "id" => "pix_credits_bgcolor",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_credits_bgimage",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_credits_bgimage_css",
			"std" => "repeat",
			"icl" => "NULL"),
			
		array( "id" => "pix_append_footer",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_position",
			"std" => "right",
			"icl" => "NULL"),
			
		array( "id" => "pix_sidebar_text_color",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_separators_color",
			"std" => "#dadada",
			"icl" => "NULL"),
			
		array( "id" => "pix_sidebar_link_color",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_sidebar_list_sign",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_soft_bg",
			"std" => "#e7e7e7",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_bgcolor",
			"std" => "#eeeeee",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_bgcolor_opacity",
			"std" => "1",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_bgimage",
			"std" => get_template_directory_uri()."/images/assets/bg_pattern_0.png",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_bgimage_css",
			"std" => "repeat",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_accordion_bgcolor",
			"std" => "#fafafa",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_tiny_button_bg",
			"std" => "#aaaaaa",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_tiny_button_textcolor",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_tiny_button_border",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_simple_button_bg",
			"std" => "#e0e0e0",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_simple_button_textcolor",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_simple_button_border",
			"std" => "transparent",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_first_color_button_bg",
			"std" => "#a3a3a3",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_first_color_button_textcolor",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_first_color_button_border",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_second_color_button_bg",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_second_color_button_textcolor",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_second_color_button_border",
			"std" => "#9d1b1b",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_third_color_button_bg",
			"std" => "#2fd4cb",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_third_color_button_textcolor",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_third_color_button_border",
			"std" => "#1b8882",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_text_color",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_separators_color",
			"std" => "#dadada",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_link_color",
			"std" => "#999999",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_list_sign",
			"std" => "#f83f3f",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_soft_bg",
			"std" => "#e7e7e7",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_bgcolor",
			"std" => "#eeeeee",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_bgcolor_opacity",
			"std" => "0.95",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_bgimage",
			"std" => get_template_directory_uri()."/images/assets/bg_pattern_0.png",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_bgimage_css",
			"std" => "repeat",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_accordion_bgcolor",
			"std" => "#fafafa",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_drag_cont_bgcolor",
			"std" => "#000000",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_drag_cont_opacity",
			"std" => "0.2",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_drag_bgcolor",
			"std" => "#eaeaea",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_drag_opacity",
			"std" => "0.9",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_close_color",
			"std" => "#fafafa",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_close_bg",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_tiny_button_bg",
			"std" => "#aaaaaa",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_tiny_button_textcolor",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_tiny_button_border",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_simple_button_bg",
			"std" => "#e0e0e0",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_simple_button_textcolor",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_simple_button_border",
			"std" => "transparent",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_first_color_button_bg",
			"std" => "#a3a3a3",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_first_color_button_textcolor",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_first_color_button_border",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_second_color_button_bg",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_second_color_button_textcolor",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_second_color_button_border",
			"std" => "#bd4b4b",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_third_color_button_bg",
			"std" => "#2fd4cb",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_third_color_button_textcolor",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_third_color_button_border",
			"std" => "#1b8882",
			"icl" => "NULL"),
			
		array( "id" => "pix_allow_seo",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_generalmetatitle",
			"std" => "Forte",
			"icl" => "true"),
			
		array( "id" => "pix_generalmetadescription",
			"std" => get_bloginfo('description'),
			"icl" => "true"),
			
		array( "id" => "pix_generalmetakeys",
			"std" => "",
			"icl" => "true"),
			
		array( "id" => "pix_favicon",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_body_bgcolor",
			"std" => "#fafafa",
			"icl" => "NULL"),
			
		array( "id" => "pix_title_section_bg_color",
			"std" => "#eeeeee",
			"icl" => "NULL"),
			
		array( "id" => "pix_title_section_bgimage",
			"std" => get_template_directory_uri()."/images/assets/bg_pattern_0.png",
			"icl" => "NULL"),
			
		array( "id" => "pix_title_section_widebg",
			"std" => "scroll",
			"icl" => "NULL"),
			
		array( "id" => "pix_title_section_bgprepeat",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_title_section_full_alignment",
			"std" => "center",
			"icl" => "NULL"),
			
		array( "id" => "pix_title_section_attachment",
			"std" => "scroll",
			"icl" => "NULL"),
			
		array( "id" => "pix_title_section_color",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_title_lines_bgcolor",
			"std" => "transparent",
			"icl" => "NULL"),
			
		array( "id" => "pix_title_lines_opacity",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_divider_border",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_general_fontfamily",
			"std" => "Open+Sans",
			"icl" => "NULL"),
			
		array( "id" => "pix_general_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_general_fontsize",
			"std" => "13",
			"icl" => "NULL"),
			
		array( "id" => "pix_general_text_color",
			"std" => "#333333",
			"icl" => "NULL"),
			
		array( "id" => "pix_general_link_color",
			"std" => "#999999",
			"icl" => "NULL"),
			
		array( "id" => "pix_general_highlighted_color",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_aside_highlighted_color",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_slidaside_highlighted_color",
			"std" => "#f83f3f",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_highlighted_color",
			"std" => "#f35959",
			"icl" => "NULL"),
			
		array( "id" => "pix_secondary_fontfamily",
			"std" => "Bitter",
			"icl" => "NULL"),
			
		array( "id" => "pix_secondary_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_secondary_bg",
			"std" => "#eeeeee",
			"icl" => "NULL"),
			
		array( "id" => "pix_secondary_bgcolor_opacity",
			"std" => "0.99",
			"icl" => "NULL"),
			
		array( "id" => "pix_hr_color",
			"std" => "#eaeaea",
			"icl" => "NULL"),
			
		array( "id" => "pix_hover_icons_color",
			"std" => "#dddddd",
			"icl" => "NULL"),
			
		array( "id" => "pix_hover_icons_bg",
			"std" => "#252525",
			"icl" => "NULL"),
			
		array( "id" => "pix_hover_icons_bg_opacity",
			"std" => "0.8",
			"icl" => "NULL"),
			
		array( "id" => "pix_hover_bg",
			"std" => "#eaeaea",
			"icl" => "NULL"),
			
		array( "id" => "pix_hover_bg_opacity",
			"std" => "0.5",
			"icl" => "NULL"),
			
		array( "id" => "pix_hover_bg_border",
			"std" => "#eaeaea",
			"icl" => "NULL"),
			
		array( "id" => "pix_main_shadow_color",
			"std" => "#000000",
			"icl" => "NULL"),
			
		array( "id" => "pix_main_shadow_x",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_main_shadow_y",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_main_shadow_blur",
			"std" => "18",
			"icl" => "NULL"),
			
		array( "id" => "pix_main_shadow_spread",
			"std" => "8",
			"icl" => "NULL"),
			
		array( "id" => "pix_main_shadow_opacity",
			"std" => "0.1",
			"icl" => "NULL"),
			
		array( "id" => "pix_scroll_button_bg",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_scroll_button_bg_opacity",
			"std" => "0.92",
			"icl" => "NULL"),
			
		array( "id" => "pix_scroll_button_color",
			"std" => "#eaeaea",
			"icl" => "NULL"),
			
		array( "id" => "pix_like_color",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_tiny_button_bg",
			"std" => "#aaaaaa",
			"icl" => "NULL"),
			
		array( "id" => "pix_tiny_button_textcolor",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_tiny_button_border",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_tiny_button_fontsize",
			"std" => "0.769",
			"icl" => "NULL"),
			
		array( "id" => "pix_tiny_button_fontfamily",
			"std" => "Open+Sans",
			"icl" => "NULL"),
			
		array( "id" => "pix_tiny_button_fontvariants",
			"std" => "600",
			"icl" => "NULL"),
			
		array( "id" => "pix_tiny_button_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_simple_button_bg",
			"std" => "#eaeaea",
			"icl" => "NULL"),
			
		array( "id" => "pix_simple_button_textcolor",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_simple_button_border",
			"std" => "transparent",
			"icl" => "NULL"),
			
		array( "id" => "pix_simple_button_fontsize",
			"std" => "0.9",
			"icl" => "NULL"),
			
		array( "id" => "pix_simple_button_fontfamily",
			"std" => "Open+Sans",
			"icl" => "NULL"),
			
		array( "id" => "pix_simple_button_fontvariants",
			"std" => "400",
			"icl" => "NULL"),
			
		array( "id" => "pix_simple_button_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_first_color_button_bg",
			"std" => "#a3a3a3",
			"icl" => "NULL"),
			
		array( "id" => "pix_first_color_button_textcolor",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_first_color_button_border",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_first_color_button_fontsize",
			"std" => "1",
			"icl" => "NULL"),
			
		array( "id" => "pix_first_color_button_fontfamily",
			"std" => "Open+Sans",
			"icl" => "NULL"),
			
		array( "id" => "pix_first_color_button_fontvariants",
			"std" => "400",
			"icl" => "NULL"),
			
		array( "id" => "pix_first_color_button_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_second_color_button_bg",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_second_color_button_textcolor",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_second_color_button_border",
			"std" => "#9d1b1b",
			"icl" => "NULL"),
			
		array( "id" => "pix_second_color_button_fontsize",
			"std" => "1",
			"icl" => "NULL"),
			
		array( "id" => "pix_second_color_button_fontfamily",
			"std" => "Open+Sans",
			"icl" => "NULL"),
			
		array( "id" => "pix_second_color_button_fontvariants",
			"std" => "400",
			"icl" => "NULL"),
			
		array( "id" => "pix_second_color_button_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_third_color_button_bg",
			"std" => "#2fd4cb",
			"icl" => "NULL"),
			
		array( "id" => "pix_third_color_button_textcolor",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_third_color_button_border",
			"std" => "#1b8882",
			"icl" => "NULL"),
			
		array( "id" => "pix_third_color_button_fontsize",
			"std" => "1",
			"icl" => "NULL"),
			
		array( "id" => "pix_third_color_button_fontfamily",
			"std" => "Open+Sans",
			"icl" => "NULL"),
			
		array( "id" => "pix_third_color_button_fontvariants",
			"std" => "400",
			"icl" => "NULL"),
			
		array( "id" => "pix_third_color_button_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_large_button_fontsize",
			"std" => "1.125",
			"icl" => "NULL"),
			
		array( "id" => "pix_extra_button_fontsize",
			"std" => "1.25",
			"icl" => "NULL"),
			
		array( "id" => "pix_button_footer",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_button_aside",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_button_slidaside",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_h1_fontfamily",
			"std" => "Bitter",
			"icl" => "NULL"),
			
		array( "id" => "pix_h1_fontvariants",
			"std" => "400",
			"icl" => "NULL"),
			
		array( "id" => "pix_h1_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_h1_fontsize",
			"std" => "3.5",
			"icl" => "NULL"),
			
		array( "id" => "pix_h1_color",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_h2_fontfamily",
			"std" => "Bitter",
			"icl" => "NULL"),
			
		array( "id" => "pix_h2_fontvariants",
			"std" => "400",
			"icl" => "NULL"),
			
		array( "id" => "pix_h2_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_h2_fontsize",
			"std" => "3",
			"icl" => "NULL"),
			
		array( "id" => "pix_h2_color",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_h3_fontfamily",
			"std" => "Bitter",
			"icl" => "NULL"),
			
		array( "id" => "pix_h3_fontvariants",
			"std" => "400",
			"icl" => "NULL"),
			
		array( "id" => "pix_h3_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_h3_fontsize",
			"std" => "2.5",
			"icl" => "NULL"),
			
		array( "id" => "pix_h3_color",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_h4_fontfamily",
			"std" => "Bitter",
			"icl" => "NULL"),
			
		array( "id" => "pix_h4_fontvariants",
			"std" => "400",
			"icl" => "NULL"),
			
		array( "id" => "pix_h4_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_h4_fontsize",
			"std" => "2",
			"icl" => "NULL"),
			
		array( "id" => "pix_h4_color",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_h5_fontfamily",
			"std" => "Bitter",
			"icl" => "NULL"),
			
		array( "id" => "pix_h5_fontvariants",
			"std" => "400",
			"icl" => "NULL"),
			
		array( "id" => "pix_h5_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_h5_fontsize",
			"std" => "1.35",
			"icl" => "NULL"),
			
		array( "id" => "pix_h5_color",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_h6_fontfamily",
			"std" => "Bitter",
			"icl" => "NULL"),
			
		array( "id" => "pix_h6_fontvariants",
			"std" => "400",
			"icl" => "NULL"),
			
		array( "id" => "pix_h6_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_h6_fontsize",
			"std" => "1.1",
			"icl" => "NULL"),
			
		array( "id" => "pix_h6_color",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_headinghover_bg",
			"std" => "#eaeaea",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_bg",
			"std" => "#eeeeee",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_border_top",
			"std" => "#dbdbdb",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_border_bottom",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_color",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_captcha_color",
			"std" => "#eeeeee",
			"icl" => "NULL"),
			
		array( "id" => "pix_captcha_bg",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_simple_error_color",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_success_bg",
			"std" => "#d8f9bc",
			"icl" => "NULL"),
			
		array( "id" => "pix_success_color",
			"std" => "#4f7730",
			"icl" => "NULL"),
			
		array( "id" => "pix_error_bg",
			"std" => "#febfbf",
			"icl" => "NULL"),
			
		array( "id" => "pix_error_color",
			"std" => "#6c2626",
			"icl" => "NULL"),
			
		array( "id" => "pix_info_bg",
			"std" => "#f8e8cc",
			"icl" => "NULL"),
			
		array( "id" => "pix_info_color",
			"std" => "#68593e",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_footer",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_footer_bg",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_footer_border_top",
			"std" => "#222222",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_footer_border_bottom",
			"std" => "#5b5b5b",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_footer_color",
			"std" => "#eaeaea",
			"icl" => "NULL"),
			
		array( "id" => "pix_simple_footer_error_color",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_success_footer_bg",
			"std" => "#d8f9bc",
			"icl" => "NULL"),
			
		array( "id" => "pix_success_footer_color",
			"std" => "#4f7730",
			"icl" => "NULL"),
			
		array( "id" => "pix_error_footer_bg",
			"std" => "#febfbf",
			"icl" => "NULL"),
			
		array( "id" => "pix_error_footer_color",
			"std" => "#6c2626",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_aside",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_aside_bg",
			"std" => "#e0e0e0",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_aside_border_top",
			"std" => "#d0d0d0",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_aside_border_bottom",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_aside_color",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_simple_aside_error_color",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_success_aside_bg",
			"std" => "#d8f9bc",
			"icl" => "NULL"),
			
		array( "id" => "pix_success_aside_color",
			"std" => "#4f7730",
			"icl" => "NULL"),
			
		array( "id" => "pix_error_aside_bg",
			"std" => "#febfbf",
			"icl" => "NULL"),
			
		array( "id" => "pix_error_aside_color",
			"std" => "#6c2626",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_slidaside",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_slidaside_bg",
			"std" => "#e0e0e0",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_slidaside_border_top",
			"std" => "#d0d0d0",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_slidaside_border_bottom",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_form_slidaside_color",
			"std" => "#666666",
			"icl" => "NULL"),
			
		array( "id" => "pix_simple_slidaside_error_color",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_success_slidaside_bg",
			"std" => "#d8f9bc",
			"icl" => "NULL"),
			
		array( "id" => "pix_success_slidaside_color",
			"std" => "#4f7730",
			"icl" => "NULL"),
			
		array( "id" => "pix_error_slidaside_bg",
			"std" => "#febfbf",
			"icl" => "NULL"),
			
		array( "id" => "pix_error_slidaside_color",
			"std" => "#6c2626",
			"icl" => "NULL"),
			
		array( "id" => "pix_tooltips_bg",
			"std" => "#ffd700",
			"icl" => "NULL"),
			
		array( "id" => "pix_tooltips_bg_opacity",
			"std" => "0.9",
			"icl" => "NULL"),
			
		array( "id" => "pix_tooltips_color",
			"std" => "#222222",
			"icl" => "NULL"),
			
		array( "id" => "pix_colorbox_disable",
			"std" => "false",
			"icl" => "NULL"),
			
		array( "id" => "pix_colorbox",
			"std" => "cb_white",
			"icl" => "NULL"),
			
		array( "id" => "pix_pagenavi_current_color",
			"std" => "#fafafa",
			"icl" => "NULL"),
			
		array( "id" => "pix_pagenavi_current_bg",
			"std" => "#a3a3a3",
			"icl" => "NULL"),
			
		array( "id" => "pix_pagenavi_link_color",
			"std" => "#939393",
			"icl" => "NULL"),
			
		array( "id" => "pix_pagenavi_fontfamily",
			"std" => "Open+Sans",
			"icl" => "NULL"),
			
		array( "id" => "pix_pagenavi_fontvariants",
			"std" => "400",
			"icl" => "NULL"),
			
		array( "id" => "pix_pagenavi_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_pagenavi_fontsize",
			"std" => "13",
			"icl" => "NULL"),
			
		array( "id" => "pix_slideshow_commands_color",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_slideshow_pie_bg",
			"std" => "#eaeaea",
			"icl" => "NULL"),
			
		array( "id" => "pix_slideshow_pie_stroke",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_slideshow_caption_bg",
			"std" => "#252525",
			"icl" => "NULL"),
			
		array( "id" => "pix_slideshow_caption_bg_opacity",
			"std" => "0.85",
			"icl" => "NULL"),
			
		array( "id" => "pix_slideshow_caption_color",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_slideshow_caption_fontfamily",
			"std" => "Bitter",
			"icl" => "NULL"),
			
		array( "id" => "pix_slideshow_caption_fontsubsets",
			"std" => "latin",
			"icl" => "NULL"),
			
		array( "id" => "pix_table_border",
			"std" => "#cccccc",
			"icl" => "NULL"),
			
		array( "id" => "pix_table_border_highlighted",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_table_check_sign",
			"std" => "#228b22",
			"icl" => "NULL"),
			
		array( "id" => "pix_table_uncheck_sign",
			"std" => "#e63d3d",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_table_bg",
			"std" => "#424242",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_text_color",
			"std" => "#ffffff",
			"icl" => "NULL"),
			
		array( "id" => "pix_table_2nd_bg",
			"std" => "#eeeeee",
			"icl" => "NULL"),
			
		array( "id" => "pix_table_button",
			"std" => "second_color",
			"icl" => "NULL"),
			
		array( "id" => "pix_comments_on_page",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_blog_captcha",
			"std" => "true",
			"icl" => "NULL"),

		array( "id" => "pix_share_pages",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_pages_sidebar",
			"std" => "forte_default_sidebar",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_featured_image",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_date_posts",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_like_posts",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_endmeta_posts",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_author_posts",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_share_posts",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_prevnext_posts",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_sidebar",
			"std" => "forte_default_sidebar",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_page_id",
			"std" => "5",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_page_layout",
			"std" => "default",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_page_excerpt_length",
			"std" => "12",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_page_filter",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_page_order",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_page_sort",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_page_titles",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_page_more",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_page_linkto",
			"std" => "colorbox",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_page_like",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_page_meta",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_page_comments",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_posts_page_pagenavi",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_404_title",
			"std" => "This is somewhat embarrassing, isn't it?",
			"icl" => "true"),
			
		array( "id" => "pix_404_subtitle",
			"std" => "It seems we can't find what you're looking for. Perhaps searching can help.",
			"icl" => "true"),
			
		array( "id" => "pix_404_content",
			"std" => "It seems we can't find what you're looking for. Perhaps searching can help.",
			"icl" => "true"),
			
		array( "id" => "pix_404_sidebar",
			"std" => "forte_default_sidebar",
			"icl" => "NULL"),
			
		array( "id" => "pix_404_template",
			"std" => "default",
			"icl" => "NULL"),
			
		array( "id" => "pix_404_metatitle",
			"std" => "",
			"icl" => "true"),
			
		array( "id" => "pix_404_metadescription",
			"std" => "",
			"icl" => "true"),
			
		array( "id" => "pix_404_metakeys",
			"std" => "",
			"icl" => "true"),
			
		array( "id" => "pix_archive_template",
			"std" => "default",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_layout",
			"std" => "default",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_sidebar",
			"std" => "forte_default_sidebar",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_filter",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_order",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_sort",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_linkto",
			"std" => "colorbox",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_pagenavi",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_excerpt_length",
			"std" => "10",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_ppp",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_titles",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_more",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_like",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_comments",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_meta",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_archive_metatitle",
			"std" => "",
			"icl" => "true"),
			
		array( "id" => "pix_archive_metadescription",
			"std" => "",
			"icl" => "true"),
			
		array( "id" => "pix_archive_metakeys",
			"std" => "",
			"icl" => "true"),
			
		array( "id" => "pix_search_content",
			"std" => "Apologies, but no results were found. Perhaps searching will help.",
			"icl" => "true"),
			
		array( "id" => "pix_search_template",
			"std" => "default",
			"icl" => "NULL"),
			
		array( "id" => "pix_search_sidebar",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_post_related_layout",
			"std" => "sixth",
			"icl" => "NULL"),
			
		array( "id" => "pix_post_related_ppp",
			"std" => "3",
			"icl" => "NULL"),
			
		array( "id" => "pix_post_related_titles",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_post_related_excerpt_length",
			"std" => "3",
			"icl" => "NULL"),
			
		array( "id" => "pix_post_related_more",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_featured_image",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_date_portfolio",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_like_portfolio",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_endmeta_portfolio",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_author_portfolio",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_share_portfolio",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_prevnext_portfolio",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_sidebar",
			"std" => "forte_default_sidebar",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_template",
			"std" => "default",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_layout",
			"std" => "ninth",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_sidebar",
			"std" => "forte_default_sidebar",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_filter",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_order",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_sort",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_ppp",
			"std" => "10",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_title",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_pagenavi",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_titles",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_excerpt_length",
			"std" => "10",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_more",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_like",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_comments",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_linkto",
			"std" => "colorbox",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_archive_metatitle",
			"std" => "",
			"icl" => "true"),
			
		array( "id" => "pix_portfolio_archive_metadescription",
			"std" => "",
			"icl" => "true"),
			
		array( "id" => "pix_portfolio_archive_metakeys",
			"std" => "",
			"icl" => "true"),
			
		array( "id" => "pix_portfolio_related_layout",
			"std" => "sixth_bis",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_related_ppp",
			"std" => "3",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_related_titles",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_related_excerpt_length",
			"std" => "3",
			"icl" => "NULL"),
			
		array( "id" => "pix_portfolio_related_more",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_woocommerce_ppp",
			"std" => "12",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_length",
			"std" => "30",
			"icl" => "NULL"),
			
		array( "id" => "pix_shop_filter",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_shop_order",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_shop_sort",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_shop_price",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_shopcategory_filter",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_shopcategory_order",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_shopcategory_sort",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_shopcategory_price",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_filter",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_order",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_sort",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_price",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_related",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_related_ppp",
			"std" => "3",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_related_layout",
			"std" => "sixth",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_related_titles",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_related_excerpt_length",
			"std" => "3",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_related_more",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_shop_pagenavi",
			"std" => "infinite",
			"icl" => "NULL"),
			
		array( "id" => "pix_shop_layout",
			"std" => "sixth",
			"icl" => "NULL"),
			
		array( "id" => "pix_shopcategory_layout",
			"std" => "sixth_bis",
			"icl" => "NULL"),
			
		array( "id" => "pix_shopcategory_template",
			"std" => "default",
			"icl" => "NULL"),
			
		array( "id" => "pix_shopcategory_sidebar",
			"std" => "woocommerce_default_sidebar",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_layout",
			"std" => "sixth_bis",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_template",
			"std" => "default",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_sidebar",
			"std" => "woocommerce_default_sidebar",
			"icl" => "NULL"),
			
		array( "id" => "pix_zoom_woo",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_share_woo",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_woo_metatitle",
			"std" => "",
			"icl" => "true"),
			
		array( "id" => "pix_woo_metadescription",
			"std" => "",
			"icl" => "true"),
			
		array( "id" => "pix_woo_metakeys",
			"std" => "",
			"icl" => "true"),
			
		array( "id" => "pix_customstyles",
			"std" => "/*Forte default installation styles*/
#logo > a {
  padding: 0!important;
  text-transform: uppercase;
}
.home_featured_icon {
  background: #424242;
  border-radius: 50px;
  color: #eaeaea;
  font-size: 40px;
  height: 80px;
  line-height: 80px;
  margin: 20px auto 0;
  overflow: hidden;
  text-align: center;
  width: 80px;
}",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_permissions",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_general",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_admin_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_import_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_topbar_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_floatingicons_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_header_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_headertabs_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_nav_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_section_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_footer_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_sidebar_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_sliding_sidebar_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_scripts_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_seo_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_twitter_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_typo_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_google_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_general_typo_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_headings_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_colors_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_layout_colors_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_section_colors_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_buttons_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_form_colors_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_slider_colors_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_tooltips_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_pagenavi_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_sidebars_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_slideshows_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_slideshows_generator_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_create_slideshows_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_slideshow_colors_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_slideshows_created_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_contacts_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_create_forms_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_forms_created_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_tables_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_create_tables_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_table_colors_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_tables_created_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_blog_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_captcha_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),

		array( "id" => "pix_perm_posts_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_pages_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_posts_page_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_404_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_archive_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_categories_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_image_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_search_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_post_related",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_portfolio_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_items_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_galleries_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_portfolio_archive_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_portfolio_related",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_woo_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_woo_general_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_styles_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_hacks_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_cathacks_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_perm_galhacks_panel",
			"std" => "activate_plugins",
			"icl" => "NULL"),
			
		array( "id" => "pix_category_hack",
			"std" => "all",
			"icl" => "NULL"),
			
		array( "id" => "pix_gallery_hack",
			"std" => "all",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_shadow_color",
			"std" => "#000000",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_shadow_x",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_shadow_y",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_shadow_blur",
			"std" => "10",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_shadow_spread",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_header_shadow_opacity",
			"std" => "0.1",
			"icl" => "NULL"),
			
		array( "id" => "pix_divider_shadow_color",
			"std" => "#000000",
			"icl" => "NULL"),
			
		array( "id" => "pix_divider_shadow_x",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_divider_shadow_y",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_divider_shadow_blur",
			"std" => "10",
			"icl" => "NULL"),
			
		array( "id" => "pix_divider_shadow_spread",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_divider_shadow_opacity",
			"std" => "0.3",
			"icl" => "NULL"),
			
		array( "id" => "pix_css_inline",
			"std" => "true",
			"icl" => "NULL"),
			
		array( "id" => "pix_footer_widgets",
			"std" => "0",
			"icl" => "NULL"),
			
		array( "id" => "pix_credits_border",
			"std" => "#5b5b5b",
			"icl" => "NULL"),
			
		array( "id" => "pix_consumer_key",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_consumer_secret",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_access_token",
			"std" => "",
			"icl" => "NULL"),
			
		array( "id" => "pix_access_token_secret",
			"std" => "",
			"icl" => "NULL"),

		array( "id" => "pix_post_related_linkto",
			"std" => "colorbox",
			"icl" => "NULL"),

		array( "id" => "pix_portfolio_related_linkto",
			"std" => "colorbox",
			"icl" => "NULL"),

	);
	
	if (function_exists('google_font_list')){
		google_font_list('add_options');
	}
	if (function_exists('admin_interface')){
		admin_interface('add_options');
	}
	if (function_exists('admin_panel')){
		admin_panel('add_options');
	}
	if (function_exists('front_header')){
		front_header('add_options');
	}
	if (function_exists('header_tabs')){
		header_tabs('add_options');
	}
	if (function_exists('nav_section')){
		nav_section('add_options');
	}
	if (function_exists('main_section')){
		main_section('add_options');
	}
	if (function_exists('footer_section')){
		footer_section('add_options');
	}
	if (function_exists('aside_section')){
		aside_section('add_options');
	}
	if (function_exists('sliding_sidebar')){
		sliding_sidebar('add_options');
	}
	if (function_exists('front_floatingicons')){
		front_floatingicons('add_options');
	}
	if (function_exists('general_seo')){
		general_seo('add_options');
	}
	if (function_exists('import_export')){
		import_export('add_options');
	}
	if (function_exists('general_typo')){
		general_typo('add_options');
	}
	if (function_exists('headings_typo')){
		headings_typo('add_options');
	}
	if (function_exists('layout_colors')){
		layout_colors('add_options');
	}
	if (function_exists('section_colors')){
		section_colors('add_options');
	}
	if (function_exists('buttons_colors')){
		buttons_colors('add_options');
	}
	if (function_exists('other_colors')){
		other_colors('add_options');
	}
	if (function_exists('slider_colors')){
		slider_colors('add_options');
	}
	if (function_exists('tooltips_colors')){
		tooltips_colors('add_options');
	}
	if (function_exists('pagenavi_colors')){
		pagenavi_colors('add_options');
	}
	if (function_exists('sidebar_generator')){
		sidebar_generator('add_options');
	}
	if (function_exists('slideshow_generator')){
		slideshow_generator('add_options');
	}
	if (function_exists('slideshow_colors')){
		slideshow_colors('add_options');
	}
	if (function_exists('slideshow_manage')){
		slideshow_manage('add_options');
	}
	if (function_exists('contact_form_generator')){
		contact_form_generator('add_options');
	}
	if (function_exists('contact_form_manage')){
		contact_form_manage('add_options');
	}
	if (function_exists('tables_generator')){
		tables_generator('add_options');
	}
	if (function_exists('table_colors')){
		table_colors('add_options');
	}
	if (function_exists('price_table_manage')){
		price_table_manage('add_options');
	}
	if (function_exists('select_fonts')){
		select_fonts('add_options');
	}
	if (function_exists('admin_tweets')){
		admin_tweets('add_options');
	}
	if (function_exists('blog_posts')){
		blog_posts('add_options');
	}
	if (function_exists('blog_captcha')){
		blog_captcha('add_options');
	}
	if (function_exists('blog_pages')){
		blog_pages('add_options');
	}
	if (function_exists('blog_posts_page')){
		blog_posts_page('add_options');
	}
	if (function_exists('blog_404')){
		blog_404('add_options');
	}
	if (function_exists('blog_archive')){
		blog_archive('add_options');
	}
	if (function_exists('blog_category')){
		blog_category('add_options');
	}
	if (function_exists('blog_search')){
		blog_search('add_options');
	}
	if (function_exists('post_related')){
		post_related('add_options');
	}
	if (function_exists('portfolio_items')){
		portfolio_items('add_options');
	}
	if (function_exists('portfolio_gallery')){
		portfolio_gallery('add_options');
	}
	if (function_exists('portfolio_archive')){
		portfolio_archive('add_options');
	}
	if (function_exists('portfolio_related')){
		portfolio_related('add_options');
	}
	if (function_exists('woo_options')){
		woo_options('add_options');
	}
	if (function_exists('admin_permissions')){
		admin_permissions('add_options');
	}
	if (function_exists('custom_styles')){
		custom_styles('add_options');
	}
	if (function_exists('category_hack')){
		category_hack('add_options');
	}
	if (function_exists('gallery_hack')){
		gallery_hack('add_options');
	}
	
	return $options;
}

function forte_save_ajax() {
	global $options, $current_user;;
	check_ajax_referer('forte_data', 'forte_security');

	$data = $_POST;
	unset($data['forte_security'], $data['action']);


	foreach ($_REQUEST as $key => $value) {
		if ( preg_match("/pix_array/", $key) ) {
			pix_delete_option($key);
			if(!pix_get_option($key)) {
				pix_add_option($key, $value);
			} else {
				pix_update_option($key, $value);
			}
		}
	}
	
	foreach ($_REQUEST as $key => $value) {
		if(isset($_REQUEST[$key])) {
			pix_update_option($key, $value);
		}
	}
			
}

?>