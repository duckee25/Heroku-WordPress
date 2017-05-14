<?php

function admin_interface(){ 
	global $options, $current_user, $woocommerce_en, $blog_id;
	
	if (isset($_GET['page']) && $_GET['page']=='admin_interface') {
		
	if (isset($_GET['activated']) && $_GET['activated']=='true') {
		pix_include_css();
	}

	if (isset($_GET['demo']) && $_GET['demo']=='true') { ?>
	<script type="text/javascript">
		//<![CDATA[
			var forte_demo_mode = true;
		//]]>
	</script>
	<?php }

	$categories = get_categories();
	
	$category_ids = array();

	foreach ($categories as $category) { 
		array_push($category_ids, $category->cat_ID);
	}
	
	if( pix_get_option('pix_category_hack')=='all' || 
		pix_get_option('pix_category_hack')=='' || 
		(is_array(pix_get_option('pix_category_hack')) && in_array('all', pix_get_option('pix_category_hack')))) {
			
		$pix_category_hack = $category_ids;
		
	} else {
		
		$pix_category_hack = pix_get_option('pix_category_hack');
		
	}

	$galleries = get_terms('gallery');
	
	$gallery_slugs = array();

	foreach ($galleries as $gallery) { 
		array_push($gallery_slugs, $gallery->slug);
	}
	
	if( pix_get_option('pix_gallery_hack')=='all' || 
		pix_get_option('pix_gallery_hack')=='' || 
		(is_array(pix_get_option('pix_gallery_hack')) && in_array('all', pix_get_option('pix_gallery_hack')))) {
			
		$pix_gallery_hack = $gallery_slugs;
		
	} else {
		
		$pix_gallery_hack = pix_get_option('pix_gallery_hack');
		
	}


    if ( isset($_REQUEST['action']) && $_REQUEST['action']=='data_save' ) {
		echo '
	<script type="text/javascript">
		//<![CDATA[
		var forte_data_saved = "true";
		//]]>
	</script>
	';
	}
    if ( isset($_REQUEST['action']) && $_REQUEST['action']=='reset' ) echo '
		<script type="text/javascript">
		//<![CDATA[
		var forte_data_saved = "true";
		//]]>
	</script>
	';

	$upload_dir = wp_upload_dir();
	$upload_dir = $upload_dir['basedir'];
/*if ( is_multisite() && $blog_id > 1 ) {
	$upload_dir = ABSPATH . 'wp-content/blogs.dir/' . $blog_id . '/files/';
} else {
	$upload_dir = wp_upload_dir();
	$upload_dir = $upload_dir['basedir'];
}*/
		foreach($_FILES as $key => $file) {
			if ( $key == 'file' ) {
				move_uploaded_file($_FILES[$key]["tmp_name"],
				$upload_dir .'/'. $_FILES[$key]["name"]);
				pix_import_export($upload_dir .'/'. $_FILES[$key]["name"], $_POST['forte_set_import']);
			}
		}
		
		$get_widgets = wp_get_sidebars_widgets();
		$content_widget;
		
		$turn = 0;

		foreach ($_REQUEST as $key => $value) {
			if ( $key != 'export_panel' && $value != 'export_panel' ) {
				if ( $value=='remove_a_contact_form' || $value=='remove_a_price_table' || $value=='remove_a_slideshow' ) {
					pix_delete_option($key);
				} elseif ( preg_match("/pix_array/", $key) ) {
					pix_delete_option($key);
					if (function_exists('icl_register_string') ) {
						icl_register_string('Forte', $key, maybe_serialize($value), 'true');
					}
					if(!pix_esc_option($key)) {
						pix_add_option($key, $value, 'true');
					} else {
						pix_update_option($key, $value);
					}
				} elseif ( isset($_REQUEST['slideshow_action']) && $_REQUEST['slideshow_action']=='clone_a_slideshow' ) {
					pix_delete_option($key);
					if(!pix_esc_option($key)) {
						pix_add_option($key, $value, 'true');
					} else {
						pix_update_option($key, $value);
					}
					$slideshow = $_REQUEST['slideshow_cloned'];
					$clone = $_REQUEST['slideshow_clone'];
					$pix_array_your_slideshow = (pix_get_option('pix_array_your_slideshows_'.$slideshow));
					pix_add_option('pix_array_your_slideshows_'.$clone, $pix_array_your_slideshow, 'true');
				} elseif ( preg_match("/pix_sidebar_generator/", $key) && $_REQUEST['sidebar_action']=='add_a_sidebar' ) {
					$get_sidebar_options = sidebar_generator_pix::get_sidebars();
					$sidebar_name = str_replace(array("\n","\r","\t"),'',$value);
					$sidebar_id = sidebar_generator_pix::name_to_class($sidebar_name);
					if($sidebar_id == '' ){
						$options_sidebar = $get_sidebar_options;
					} else {
						if(isset($get_sidebar_options[$sidebar_id])){

						}
						if ( is_array($get_sidebar_options) ) {
							$new_sidebar_gen[$sidebar_id] = $sidebar_id;
							$options_sidebar = array_merge($get_sidebar_options, (array) $new_sidebar_gen);	
						} else{
							$options_sidebar[$sidebar_id] = $sidebar_id;
						}		
					}
					update_option( 'pix_sidebar_generator', $options_sidebar);
				} elseif ( preg_match("/sidebar_removed/", $key) ) {
					$sidebars_widgets = get_option('sidebars_widgets'); //all the widgets in the sidebars
					$get_sidebar_options = sidebar_generator_pix::get_sidebars(); //all the sidebar containes you created
					$count = count($get_sidebar_options); //count of the sidebars you created
					$widgets_arr = array(); //a new array for the sidebars you created that contain widgets
					$i = $value; //$i is the same of $value, $value is the number the loop starts from
					while ($i <= $count) {
						if(isset($sidebars_widgets['pix_sidebar-'.($i+1)])) {
							array_push($widgets_arr,$sidebars_widgets['pix_sidebar-'.($i+1)]);
						} else {
							array_push($widgets_arr,'');
						}
						$i++;
					}
					$i = $value; //$i is the same of $value, $value is the number the loop starts from
					$i2 = 0; //$i2 is 0 so I associate any old widget position to the new one, after removing a sidebar
					while ($i <= $count) {
						if($widgets_arr[$i2]!=''){
							$sidebars_widgets['pix_sidebar-'.$i] = $widgets_arr[$i2];
						}
						$i++;
						$i2++;
					}
					if($count==1){
						$count = 0;
					}
					unset($sidebars_widgets['pix_sidebar-'.($count+1)]); //I remove the last sidebar
					update_option('sidebars_widgets',$sidebars_widgets);
				} elseif ( preg_match("/pix_sidebar_generator/", $key) && $_REQUEST['sidebar_action']=='remove_a_sidebar' ) {
					if($value != '') {
						$options_sidebar[ $value ] = $value;
					}
					update_option( 'pix_sidebar_generator', $options_sidebar);
				} elseif ( preg_match("/pix_select_fonts/", $key ) ) {
					pix_update_option($key, $value);
					pix_google_arrays($value);
				} else {
					if(isset($_REQUEST[$key]) ) {
						pix_update_option($key, $value);
					}
				}
			}
			$turn++;
			$req = count($_POST);
			if($turn==$req && $req>'0'){
				pix_include_css();
			}
		}
?>

<?php 
		$css_dir = $upload_dir.'/';
	/*if ( !isset($blog_id) || $blog_id == 1 ) {
		//$css_dir = get_template_directory() . '/functions/includes/';
		$css_dir = $upload_dir.'/';
	} else {
		$css_dir = ABSPATH.'wp-content/blogs.dir/' . $blog_id . '/files/';
	}*/
	$css_file = $css_dir . 'css_include.css';
	if(!is_writeable($css_file) && pix_get_option('pix_chmod_message')=='true' && pix_get_option('pix_css_inline')!='true' ) { ?>
    <div class="updated pix_info_message">
        <p>
        	<strong>Forte</strong> can't create or edit a file because of the file permissions of your server. To make <strong>Forte</strong> work correctly, set to <strong>777</strong> the <strong>CHMOD</strong> of this directory:<br>
            <code><?php echo $css_dir; ?></code><br>
            and, if exists, of this file:<br>
            <code><?php echo $css_file; ?></code><br>
            <strong>Then refresh this page or deactivate and activate the theme again</strong>
            . If you don't know what CHMOD is or how to change it have a look to <a href="https://www.google.it/search?q=chmod" target="_blank">Google</a> or to the <a href="http://codex.wordpress.org/Changing_File_Permissions" target="_blank">official documentation</a>
        </p>
        <p>
        	If you can't or if you don't want change the CHMOD, you can use the other solution: putting your custom CSS inline (slower). Just go to <strong>Forte admin panel &rarr; General &rarr; Very general</strong> and switch on the button called <strong>Put your custom CSS inline</strong>
            <div class="clear"></div>
            <small class="alignright"><a href="#">don't show anymore</a></small>
            <div class="clear"></div>
        </p>
        <form action="/" class="dynamic_form ajax_form hidden_div">
        	<input type="text" name="pix_chmod_message" value="<?php echo pix_get_option('pix_chmod_message'); ?>">
            <input type="hidden" name="action" value="data_save">
            <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
            <input type="submit" class="hidden_div" value="">
        </form>
    </div>
<?php } ?>

<?php 
	if(pix_get_option('pix_tweets_message')=='true') { ?>
    <div class="updated pix_info_message">
        <p>
        	Since <strong>Forte 2.1.0</strong> has been added the automatic updater. However, to know when a new version of Forte has released or any news about Forte, it's recommended to subscribe the <strong>newsletter</strong> by filling the form you can find here on the footer (item purchase code is required)<br><br><a href="http://www.pixedelic.com/themes/forte/sign-up-for-updates/" target="_blank">CLICK HERE TO SUBSCRIBE THE NEWSLETTER</a>
            <div class="clear"></div>
            <small class="alignright"><a href="#" class="pix_dont_show">don't show anymore</a></small>
            <div class="clear"></div>
        </p>
        <form action="/" class="dynamic_form ajax_form hidden_div">
        	<input type="text" name="pix_tweets_message" value="<?php echo pix_get_option('pix_tweets_message'); ?>">
            <input type="hidden" name="action" value="data_save">
            <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
            <input type="submit" class="hidden_div" value="">
        </form>
    </div>
<?php } ?>

<div id="forte_wrap">
<?php 
	if(pix_get_option('pix_documentation_message')=='true') { ?>
    <div class="updated pix_info_message">
        <p>
        	Before using the support forum or writing an email to ask support, remember that at this link is available a <a href="http://www.pixedelic.com/envato-assets/documentation.htm" target="_blank">documentation</a>, and many video tutorials are available on the <a href="http://www.pixedelic.com/themes/forte/dark/install-forte/" target="_blank">demo site</a>
        </p>
        <p>
        	<strong>The documentation is also useful to find a particular tab or field on the admin panel itself, so it's highly recommended</strong>
            <div class="clear"></div>
            <small class="alignright"><a href="#" class="pix_dont_show">don't show anymore</a></small>
            <div class="clear"></div>
        </p>
        <form action="/" class="dynamic_form ajax_form hidden_div">
        	<input type="text" name="pix_documentation_message" value="<?php echo pix_get_option('pix_documentation_message'); ?>">
            <input type="hidden" name="action" value="data_save">
            <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
            <input type="submit" class="hidden_div" value="">
        </form>
    </div>
<?php } ?>

<div id="forte_wrap">
    <div id="forte_header">
        <div id="admin_panel_logo" style="background: url(<?php echo pix_remove_protocol(pix_esc_option('pix_admin_panel_logo')); ?>) <?php echo pix_esc_option('pix_admin_panel_logo_css'); ?>">&nbsp;
        </div>

        <?php if ( pix_get_option('pix_allow_changelog') == 'true' ) { ?>
            <a id="admin_changelog_link" href="http://www.pixedelic.com/forte_current_version_changelog.php" class="colorbox" data-iframe="true"></a>
        <?php } ?>
        
        <div id="forte_header_shadow"></div>
    </div><!-- #forte_header -->
    <div id="forte_admin_content">
    	<div id="forte_navsidebar">
        	<ul>
                <li <?php pix_display_by_role('pix_perm_general'); ?>>
                	<a href="#" id="nav_general" data-store="general_head"><span>General</span></a>
                    <ul>
                    	<li <?php pix_display_by_role('pix_perm_admin_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=admin_panel" data-store="admin_panel">Very general</a>
                        </li>
                    	<li <?php pix_display_by_role('pix_perm_import_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=import_export" data-store="import_export">Import/export</a>
                        </li>
                    	<li <?php pix_display_by_role('pix_perm_floatingicons_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=front_floatingicons" data-store="front_floatingicons">Side icons</a>
                        </li>
                    	<li <?php pix_display_by_role('pix_perm_header_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=front_header" data-store="front_header">Header</a>
                        </li>
                    	<li <?php pix_display_by_role('pix_perm_nav_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=nav_section" data-store="nav_section">Navigation menu</a>
                        </li>
                    	<li <?php pix_display_by_role('pix_perm_section_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=main_section" data-store="main_section">Main section</a>
                        </li>
                    	<li <?php pix_display_by_role('pix_perm_footer_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=footer_section" data-store="footer_section">Footer</a>
                        </li>
                    	<li <?php pix_display_by_role('pix_perm_sidebar_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=aside_section" data-store="aside_section">Sidebar section</a>
                        </li>
                    	<li <?php pix_display_by_role('pix_perm_sliding_sidebar_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=sliding_sidebar" data-store="sliding_sidebar">Sliding sidebars</a>
                        </li>
                    	<li <?php pix_display_by_role('pix_perm_seo_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=general_seo" data-store="general_seo">SEO</a>
                        </li>
                    </ul>
                </li>
                
                <li <?php pix_display_by_role('pix_perm_twitter_panel'); ?>>
                	<a href="<?php echo get_admin_url(); ?>admin.php?page=admin_tweets" id="nav_twitter" data-store="twitter_head"><span><span>Twitter</span></span></a>
                </li>

                <li <?php pix_display_by_role('pix_perm_typo_panel'); ?>>
                	<a href="#" id="nav_typo" data-store="typo_head"><span>Typography</span></a>
                    <ul>
                        <li <?php pix_display_by_role('pix_perm_google_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=select_fonts" data-store="select_fonts">Google fonts</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_general_typo_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=general_typo" data-store="general_typo">General</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_headings_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=headings_typo" data-store="headings_typo">Headings</a>
                        </li>
                    </ul>
                </li>
                
                <li <?php pix_display_by_role('pix_perm_colors_panel'); ?>>
                	<a href="#" id="nav_colors" data-store="colors_head"><span>Colors advanced</span></a>
                    <ul>
                        <li <?php pix_display_by_role('pix_perm_layout_colors_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=layout_colors" data-store="layout_colors">Layout colors & images</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_section_colors_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=section_colors" data-store="section_colors">Main elements</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_buttons_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=buttons_colors" data-store="buttons_colors">Buttons</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_form_colors_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=other_colors" data-store="other_colors">Forms</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_tooltips_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=tooltips_colors" data-store="tooltips_colors">Tooltips &amp; ColorBox</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_pagenavi_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=pagenavi_colors" data-store="pagenavi_colors">Page navi</a>
                        </li>
                    </ul>
                </li>
                
                <li <?php pix_display_by_role('pix_perm_sidebars_panel'); ?>>
                	<a href="<?php echo get_admin_url(); ?>admin.php?page=sidebar_generator" id="nav_sidebars" data-store="sidebars_head"><span>Sidebars</span></a>
                </li>
                
                <li <?php pix_display_by_role('pix_perm_slideshows_panel'); ?>>
                	<a href="#" id="nav_slideshow" data-store="slideshow_head"><span>Slideshows</span></a>
                    <ul>
                        <li <?php pix_display_by_role('pix_perm_create_slideshows_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=slideshow_generator" data-store="slideshow_generator">Create your slideshows</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_slideshow_colors_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=slideshow_colors" data-store="slideshow_colors">Slideshow colors</a>
                        </li>
<?php
$get_slideshow_options = pix_get_option('pix_array_your_slideshows_');
if($get_slideshow_options != "") {
$i=1;
foreach ($get_slideshow_options as $slideshow_manage) { ?>
                        <li <?php pix_display_by_role('pix_perm_slideshows_created_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=slideshow_manage&slideshow=<?php echo $slideshow_manage; ?>" data-store="slideshow_manage_<?php echo $i; ?>"><?php echo $slideshow_manage; ?></a>
                        </li>
<?php $i++; } 
}
?>
                    </ul>
                </li>
                
                
                <li <?php pix_display_by_role('pix_perm_contacts_panel'); ?>>
                	<a href="#" id="nav_contacts" data-store="contacts_head"><span>Contact forms</span></a>
                    <ul>
                        <li <?php pix_display_by_role('pix_perm_create_forms_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=contact_form_generator" data-store="contact_form_generator">Create your forms</a>
                        </li>
<?php
$get_contact_form_options = pix_get_option('pix_array_your_forms_');
if($get_contact_form_options != "") {
$i=1;
foreach ($get_contact_form_options as $contact_form_gen) { ?>
                        <li <?php pix_display_by_role('pix_perm_forms_created_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=contact_form_manage&form=<?php echo $contact_form_gen; ?>" data-store="contact_form_generator_<?php echo $i; ?>"><?php echo $contact_form_gen; ?></a>
                        </li>
<?php $i++; } 
}
?>
                    </ul>
                </li>
                
                <li <?php pix_display_by_role('pix_perm_tables_panel'); ?>>
                	<a href="#" id="nav_tables" data-store="tables_head"><span>Price tables</span></a>
                    <ul>
                        <li <?php pix_display_by_role('pix_perm_create_tables_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=tables_generator" data-store="tables_generator">Create your tables</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_table_colors_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=table_colors" data-store="table_colors">Table colors</a>
                        </li>
<?php
$get_price_table_options = pix_get_option('pix_array_your_tables_');
if($get_price_table_options != "") {
$i=1;
foreach ($get_price_table_options as $price_table_gen) { ?>
                        <li <?php pix_display_by_role('pix_perm_tables_created_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=price_table_manage&table=<?php echo $price_table_gen; ?>" data-store="price_table_manage_<?php echo $i; ?>"><?php echo $price_table_gen; ?></a>
                        </li>
<?php $i++; } 
}
?>
                    </ul>
                </li>
                
                <li <?php pix_display_by_role('pix_perm_blog_panel'); ?>>
                	<a href="#" id="nav_blog" data-store="blog_header"><span>Blog</span></a>
                    <ul>
                        <li <?php pix_display_by_role('pix_perm_captcha_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=blog_captcha" data-store="blog_captcha">Captcha in comments</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_posts_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=blog_posts" data-store="blog_posts">Posts (general)</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_pages_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=blog_pages" data-store="blog_pages">Pages (general)</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_posts_page_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=blog_posts_page" data-store="blog_posts_page">Latest posts page</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_404_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=blog_404" data-store="blog_404">404 page</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_archive_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=blog_archive" data-store="blog_archive">Archive pages</a>
                        </li>
						<?php 
							$categories =  get_categories(); 
                            foreach ($categories as $category) { 
								if (in_array($category->cat_ID, $pix_category_hack)) { ?>
                                <li <?php pix_display_by_role('pix_perm_categories_panel'); ?>>
                                    <a href="<?php echo get_admin_url(); ?>admin.php?page=blog_category&cat=<?php echo $category->term_id; ?>" data-store="blog_category_<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></a>
                                </li>
						<?php 	}
							}
						?>
                        <li <?php pix_display_by_role('pix_perm_search_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=blog_search" data-store="blog_search">Search results page</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_post_related'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=post_related" data-store="post_related">Related posts loop</a>
                        </li>
                    </ul>
                </li>
                
                <li <?php pix_display_by_role('pix_perm_portfolio_panel'); ?>>
                	<a href="#" id="nav_portfolio" data-store="portfolio_head"><span>Portfolio</span></a>
                    <ul>
                        <li <?php pix_display_by_role('pix_perm_items_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=portfolio_items" data-store="portfolio_items">Portfolio items</a>
                        </li>
						<?php 
						$terms = get_terms("gallery");
                        $count = count($terms);
                        if($count > 0){
                            foreach ($terms as $term) {
								if (in_array($term->slug, $pix_gallery_hack)) { ?>
                                <li <?php pix_display_by_role('pix_perm_galleries_panel'); ?>>
                                    <a href="<?php echo get_admin_url(); ?>admin.php?page=portfolio_gallery&gallery=<?php echo $term->slug; ?>" data-store="portfolio_gallery_<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
                                </li>
						<?php 	}
                            }
                        }
						?>
                        <li <?php pix_display_by_role('pix_perm_portfolio_archive_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=portfolio_archive" data-store="portfolio_archive">Portfolio archives</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_portfolio_related'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=portfolio_related" data-store="portfolio_related">Related items loop</a>
                        </li>
                    </ul>
                </li>

			<?php if ( $woocommerce_en == 'active' ) { ?>
                
                <li <?php pix_display_by_role('pix_perm_woo_panel'); ?>>
                	<a href="#" id="nav_woo" data-store="woo_header"><span>WooCommerce</span></a>
                	<ul>
                        <li <?php pix_display_by_role('pix_perm_form_colors_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=woo_options" data-store="woo_options"><span>General</span></a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_form_colors_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=slider_colors" data-store="slider_colors">Colors</a>
                        </li>
                    </ul>
                </li>
                
			<?php } ?>
                
                <li <?php pix_display_by_role('pix_perm_styles_panel'); ?>>
                	<a href="<?php echo get_admin_url(); ?>admin.php?page=custom_styles" id="nav_styles" data-store="custom_styles"><span>Styles</span></a>
                </li>
                
                <li <?php pix_display_by_role('pix_perm_permissions'); ?>>
                	<a href="<?php echo get_admin_url(); ?>admin.php?page=admin_permissions" id="nav_permissions" data-store="admin_permissions"><span>Permissions</span></a>
                </li>
                
                <li <?php pix_display_by_role('pix_perm_hacks_panel'); ?>>
                	<a href="#" id="nav_hacks" data-store="hacks_head"><span>Utilities</span></a>
                    <ul>
                        <li <?php pix_display_by_role('pix_perm_cathacks_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=category_hack" data-store="category_hack">Categories</a>
                        </li>
                        <li <?php pix_display_by_role('pix_perm_galhacks_panel'); ?>>
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=gallery_hack" data-store="gallery_hack">Galleries</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- #forte_navsidebar -->
        <div id="forte_wraploader">
        	<div id="pix_loader"></div><!-- #pix_loader -->
        	<div id="pix_success"></div><!-- #pix_success -->
                <div id="forte_contentbar">
        
                    <!-- dynamic content -->
        
                </div><!-- #forte_contentbar -->
        </div><!-- #forte_wraploader -->
    </div><!-- #forte_admin_content -->

</div><!-- #forte_wrap -->

<div id="pix_dialog_cant" class="pix_dialog">
Sorry, this operation is disabled for the preview mode
</div><!-- #pix_dialog_cant -->

<div id="pix_dialog_general" class="pix_dialog">
</div><!-- #pix_dialog_general -->

<div id="pix_demo_message" class="pix_dialog">
<h3>Hello and thank you for being here</h3> This is the admin panel of <strong>Forte</strong>. Since you are not the administrator, I created for you a particular role: you can change something, click the &quot;Save changes&quot; button and see the changes you made on the frontend. The changes will be stored in your web session, so you are the only one who can see them and, if you close the browser, they will expire. <strong>Have fun!</strong><br><br>
You can make some changes to <strong>Camera</strong> too, the open source plugin developed always by me that I recommend to use with <strong>Forte</strong><br><br> 
<strong>If you don't see any change on the front-end after clicking the &quot;save options&quot; button, try to empty the cache and refresh.</strong><br><br>
<small><strong>P.S.:</strong> some functions in the preview mode are disabled, such as the file uploading or the ability of changing options with complex arrays (contact forms, sidebars, the top icons...)</small>
<br><br>
</div><!-- #pix_demo_message -->

<div id="pix_slideshow_composer" class="pix_dialog">
	<div id="pix_slideshow_composer_inner"></div>
    <div class="test"></div>
</div><!-- #pix_slideshow_composer -->


<?php
	}

		
}

?>