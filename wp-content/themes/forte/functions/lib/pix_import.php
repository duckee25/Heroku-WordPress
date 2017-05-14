<?php
function pix_import_export($file, $set) {
	$current_user = wp_get_current_user();
	$upload_dir = wp_upload_dir();
	
	$val_array = array(
		'pix_admin_page_title',
		'pix_login_logo',
		'pix_admin_panel_logo',
		'pix_admin_panel_logo_css',
		'pix_allow_changelog',
		'pix_allow_tweets',
		'pix_enable_google',
		'pix_allow_ajax',
		'pix_logoimage',
		'pix_logostyle',
		'pix_append_head_top',
		'pix_append_head_bottom',
		'pix_footer_credits',
		'pix_credits_left',
		'pix_credits_right',
		'pix_append_footer',
		'pix_allow_seo',
		'pix_generalmetatitle',
		'pix_generalmetadescription',
		'pix_generalmetakeys',
		'pix_404_title',
		'pix_404_subtitle',
		'pix_404_content',
		'pix_404_metatitle',
		'pix_404_metadescription',
		'pix_404_metakeys',
		'pix_archive_metatitle',
		'pix_archive_metadescription',
		'pix_archive_metakeys',
		'pix_search_content',
		'pix_portfolio_archive_metatitle',
		'pix_portfolio_archive_metadescription',
		'pix_portfolio_archive_metakeys',
		'pix_woo_metatitle',
		'pix_woo_metadescription',
		'pix_woo_metakeys',
		'pix_perm_panel',
		'pix_perm_permissions',
		'pix_perm_general',
		'pix_perm_admin_panel',
		'pix_perm_import_panel',
		'pix_perm_floatingicons_panel',
		'pix_perm_header_panel',
		'pix_perm_headertabs_panel',
		'pix_perm_nav_panel',
		'pix_perm_section_panel',
		'pix_perm_footer_panel',
		'pix_perm_sidebar_panel',
		'pix_perm_sliding_sidebar_panel',
		'pix_perm_scripts_panel',
		'pix_perm_seo_panel',
		'pix_perm_twitter_panel',
		'pix_perm_typo_panel',
		'pix_perm_google_panel',
		'pix_perm_general_typo_panel',
		'pix_perm_headings_panel',
		'pix_perm_colors_panel',
		'pix_perm_layout_colors_panel',
		'pix_perm_section_colors_panel',
		'pix_perm_buttons_panel',
		'pix_perm_form_colors_panel',
		'pix_perm_slider_colors_panel',
		'pix_perm_tooltips_panel',
		'pix_perm_pagenavi_panel',
		'pix_perm_sidebars_panel',
		'pix_perm_slideshows_panel',
		'pix_perm_slideshows_generator_panel',
		'pix_perm_create_slideshows_panel',
		'pix_perm_slideshow_colors_panel',
		'pix_perm_slideshows_created_panel',
		'pix_perm_contacts_panel',
		'pix_perm_create_forms_panel',
		'pix_perm_forms_created_panel',
		'pix_perm_tables_panel',
		'pix_perm_create_tables_panel',
		'pix_perm_table_colors_panel',
		'pix_perm_tables_created_panel',
		'pix_perm_blog_panel',
		'pix_perm_posts_panel',
		'pix_perm_pages_panel',
		'pix_perm_posts_page_panel',
		'pix_perm_404_panel',
		'pix_perm_archive_panel',
		'pix_perm_categories_panel',
		'pix_perm_image_panel',
		'pix_perm_search_panel',
		'pix_perm_post_related',
		'pix_perm_portfolio_panel',
		'pix_perm_items_panel',
		'pix_perm_galleries_panel',
		'pix_perm_portfolio_archive_panel',
		'pix_perm_portfolio_related',
		'pix_perm_woo_panel',
		'pix_perm_styles_panel',
		'pix_perm_hacks_panel',
		'pix_perm_cathacks_panel',
		'pix_perm_galhacks_panel',
		'pix_category_hack',
		'pix_gallery_hack'
	);
	

	$fcontents = file_get_contents ($file);
	$fcontents = str_replace("%pix_upload_dir%", $upload_dir['baseurl'], $fcontents);
	$fcontents = str_replace("%pix_theme_dir%", get_template_directory_uri(), $fcontents);
	$fcontents = explode('[pix_n]',$fcontents);
	
	for($i=1; $i< (sizeof ($fcontents)-1); $i++) {
		$arr = explode("[pix]", $fcontents[$i]);
		
		if ( $set == 'import_skin_style' ) {
			
			if ( !in_array( $arr[0], $val_array ) ) {
				if ( !preg_match("/pix_array/", $arr[0]) && $arr[0] != 'pix_customstyles' ) {
					pix_update_option($arr[0], maybe_unserialize(html_entity_decode($arr[1])));
				} elseif ( $arr[0] == 'pix_customstyles' ) {
					if ( pix_get_option ( 'pix_customstyles' ) != maybe_unserialize(html_entity_decode($arr[1])) && maybe_unserialize(html_entity_decode($arr[1])) != '' ) {
						$prev_customstyles = pix_get_option ( 'pix_customstyles' ).PHP_EOL.'/*Imported styles on '.date("Y-m-d").' (start)*/'.PHP_EOL.maybe_unserialize(html_entity_decode($arr[1]).PHP_EOL.'/*Imported styles on '.date("Y-m-d").' (end)*/');
						pix_update_option ( 'pix_customstyles',$prev_customstyles );
					}
				}
			}
				
		} elseif ( $set == 'import_skin_content' ) {
			
			if ( in_array( $arr[0], $val_array ) || preg_match("/pix_array/", $arr[0]) ) {
				if ( preg_match("/pix_array/", $arr[0]) ) {
					pix_delete_option($arr[0]);
					if(!pix_get_option($arr[0])) {
						pix_add_option($arr[0], maybe_unserialize(html_entity_decode($arr[1])), $arr[2]);
					} else {
						pix_update_option($arr[0], maybe_unserialize(html_entity_decode($arr[1])), $arr[2]);
					}
				} else {
					pix_update_option($arr[0], maybe_unserialize(html_entity_decode($arr[1])), $arr[2]);
				}
			}
				
		} else {
			
			return false;
			
		}
		$i+1;
	}
		
	}