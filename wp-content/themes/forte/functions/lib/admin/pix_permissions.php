<?php

function admin_permissions(){
	global $options, $woocommerce_en;
	if ($_GET['page']=='admin_permissions') { 
	
	function pix_perm_select_gen($name) { ?>
        <select name="<?php echo $name; ?>">
            <option value="manage_network" <?php selected( pix_get_option($name), 'manage_network' ); ?>>Super admin</option>
            <option value="activate_plugins" <?php selected( pix_get_option($name), 'activate_plugins' ); ?>>Admin +</option>
            <option value="moderate_comments" <?php selected( pix_get_option($name), 'moderate_comments' ); ?>>Editor +</option>
            <option value="edit_published_posts" <?php selected( pix_get_option($name), 'edit_published_posts' ); ?>>Author +</option>
            <option value="edit_posts" <?php selected( pix_get_option($name), 'edit_posts' ); ?>>Contributor +</option>
            <option value="read" <?php selected( pix_get_option($name), 'read' ); ?>>Subscriber +</option>
        </select>
	<?php }
	
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Permissions
                <div class="yellow_button button_floating">
                	<div class="button_left"></div>
                	<div class="button_right"></div>
                	<div class="button_body"></div>
                	<a href="#" class="save_changes">save changes</a>
                </div>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content" class="forte_permission_tab">
            <form method="post" class="dynamic_form ajax_fake">

            	<label for="pix_perm_panel">Entire Forte panel:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_panel'); ?>
                </div><!-- .field_wrap -->
                        
            	<label for="pix_perm_permissions">&quot;Permissions&quot; tab:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_permissions'); ?>
                </div><!-- .field_wrap -->
                        
            	<label for="pix_perm_general">&quot;General&quot; tab:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_general'); ?>
                </div><!-- .field_wrap -->
                        
            	<blockquote>
                    <label for="pix_perm_admin_panel">&quot;Very general&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_admin_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_import_panel">&quot;Import/export&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_import_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_topbar_panel">&quot;Tob bar&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_topbar_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_header_panel">&quot;Header&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_header_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_nav_panel">&quot;Navigation menu&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_nav_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_section_panel">&quot;Main section&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_section_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_footer_panel">&quot;Footer&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_footer_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_sidebar_panel">&quot;Sidebar section&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_sidebar_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_sliding_sidebar_panel">&quot;Sliding sidebars&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_sliding_sidebar_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_seo_panel">&quot;SEO&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_seo_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                </blockquote>
                        
                <label for="pix_perm_twitter_panel">&quot;Twitter&quot; tab:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_twitter_panel'); ?>
                </div><!-- .field_wrap -->
                
                <label for="pix_perm_typo_panel">&quot;Typography&quot; tab:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_typo_panel'); ?>
                </div><!-- .field_wrap -->
                
            	<blockquote>
                    <label for="pix_perm_google_panel">&quot;Google fonts&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_google_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_general_typo_panel">&quot;General typography&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_general_typo_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_headings_panel">&quot;Headings&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_headings_panel'); ?>
                    </div><!-- .field_wrap -->
                
                </blockquote>
                    
                <label for="pix_perm_colors_panel">&quot;Colors advanced&quot; tab:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_colors_panel'); ?>
                </div><!-- .field_wrap -->
                
            	<blockquote>
                    <label for="pix_perm_layout_colors_panel">&quot;Layout colors &amp; images&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_layout_colors_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_section_colors_panel">&quot;Main elements&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_section_colors_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_buttons_panel">&quot;Buttons&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_buttons_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_buttons_panel">&quot;Buttons&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_buttons_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_form_colors_panel">&quot;Forms&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_form_colors_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_tooltips_panel">&quot;Tooltips &amp; ColorBox&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_tooltips_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_pagenavi_panel">&quot;Pagenavi&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_pagenavi_panel'); ?>
                    </div><!-- .field_wrap -->
                
                </blockquote>
                
                <label for="pix_perm_sidebars_panel">&quot;Sidebars&quot; tab:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_sidebars_panel'); ?>
                </div><!-- .field_wrap -->
                
                <label for="pix_perm_slideshows_panel">&quot;Slideshows&quot; tab:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_slideshows_panel'); ?>
                </div><!-- .field_wrap -->
                
            	<blockquote>
                    <label for="pix_perm_create_slideshows_panel">&quot;Create your slideshows&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_create_slideshows_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_slideshow_colors_panel">&quot;Slideshow colors&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_slideshow_colors_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_slideshows_created_panel">Tabs of the generated slideshows:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_slideshows_created_panel'); ?>
                    </div><!-- .field_wrap -->
                
                </blockquote>

                <label for="pix_perm_contacts_panel">&quot;Contact forms&quot; tab:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_contacts_panel'); ?>
                </div><!-- .field_wrap -->
                
            	<blockquote>
                    <label for="pix_perm_create_forms_panel">&quot;Create your forms&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_create_forms_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_forms_created_panel">Tabs of the generated forms:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_forms_created_panel'); ?>
                    </div><!-- .field_wrap -->
                
                </blockquote>
                
                <label for="pix_perm_tables_panel">&quot;Price tables&quot; tab:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_tables_panel'); ?>
                </div><!-- .field_wrap -->
                
            	<blockquote>
                    <label for="pix_perm_create_tables_panel">&quot;Create your tables&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_create_tables_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_table_colors_panel">&quot;Table colors&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_table_colors_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_tables_created_panel">Tabs of the generated tables:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_tables_created_panel'); ?>
                    </div><!-- .field_wrap -->
                
                </blockquote>
                
                <label for="pix_perm_blog_panel">&quot;Blog&quot; tab:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_blog_panel'); ?>
                </div><!-- .field_wrap -->
                
            	<blockquote>
                    <label for="pix_perm_captcha_panel">&quot;Captcha in comments&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_captcha_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_posts_panel">&quot;Posts (general)&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_posts_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_pages_panel">&quot;Pages (general)&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_pages_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_posts_page_panel">&quot;Latest posts page&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_posts_page_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_404_panel">&quot;404 page&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_404_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_archive_panel">&quot;Archive pages&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_archive_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_categories_panel">&quot;Category pages&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_categories_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_image_panel">&quot;Image attachment pages&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_image_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_search_panel">&quot;Search results pages&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_search_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                    <label for="pix_perm_post_related">&quot;Related posts loop&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_post_related'); ?>
                    </div><!-- .field_wrap -->
                    
                </blockquote>
                
                <label for="pix_perm_portfolio_panel">&quot;Portfolio&quot; tab:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_portfolio_panel'); ?>
                </div><!-- .field_wrap -->
                
            	<blockquote>
                    <label for="pix_perm_items_panel">&quot;Portfolio items&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_items_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_galleries_panel">&quot;Gallery pages&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_galleries_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_portfolio_archive_panel">&quot;Portfolio archives&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_portfolio_archive_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_portfolio_related">&quot;Related items loop&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_portfolio_related'); ?>
                    </div><!-- .field_wrap -->
                
                </blockquote>
                    
			<?php if ( $woocommerce_en == 'active' ) { ?>
                <label for="pix_perm_woo_panel">&quot;WooCommerce&quot; tab:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_woo_panel'); ?>
                </div><!-- .field_wrap -->

                </blockquote>

                    <label for="pix_perm_woo_general_panel">&quot;WooCommerce general&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_woo_general_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_slider_colors_panel">&quot;WooCommerce colors&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_slider_colors_panel'); ?>
                    </div><!-- .field_wrap -->
                
                </blockquote>
            <?php } ?>
                
                <label for="pix_perm_styles_panel">&quot;Custom styles&quot; tab:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_styles_panel'); ?>
                </div><!-- .field_wrap -->
                
                <label for="pix_perm_hacks_panel">&quot;Hacks &amp; tips&quot; tab:</label>
                <div class="field_wrap">
                    <?php pix_perm_select_gen('pix_perm_hacks_panel'); ?>
                </div><!-- .field_wrap -->
                
            	<blockquote>
                    <label for="pix_perm_cathacks_panel">&quot;Category hacks&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_cathacks_panel'); ?>
                    </div><!-- .field_wrap -->
                
                    <label for="pix_perm_galhacks_panel">&quot;Gallery hacks&quot; tab:</label>
                    <div class="field_wrap">
                        <?php pix_perm_select_gen('pix_perm_galhacks_panel'); ?>
                    </div><!-- .field_wrap -->
                    
                </blockquote>
                
       <input type="hidden" name="action" value="data_save" />
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>" />
        <input type="submit" class="hidden_div" value="" />
            </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>