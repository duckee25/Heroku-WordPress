<?php

function admin_panel(){
	global $options;
	if ($_GET['page']=='admin_panel') { 
	
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	General: <small>admin panel</small>
                <div class="yellow_button button_floating">
                	<div class="button_left"></div>
                	<div class="button_right"></div>
                	<div class="button_body"></div>
                	<a href="#" class="save_changes">save changes</a>
                </div>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
            <form method="post" class="dynamic_form" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            
            	<label for="pix_admin_page_title">Theme name on admin menu label</label>
                <div class="field_wrap">
                    <input name="pix_admin_page_title" type="text" value="<?php echo pix_esc_option('pix_admin_page_title'); ?>">
                </div>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                	<small class="tip_info">The name on the label of the main Wordpress navigation menu on the sidebar (maybe you need to refresh twice before seeing the label changed)</small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                    	<div class="open_info">info</div>
                    	<div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
            

            	<label for="pix_admin_panel_logo">Login logo:</label>
                <div class="field_wrap">
                    <div class="pix_upload_image">
                        <div class="pix_image_thumb"><img alt="Preview" src="<?php if(pix_esc_option('pix_login_logo')!=''){ echo get_pix_thumb(pix_esc_option('pix_login_logo'), 'mini_preview'); } else { echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; } ?>"></div>
                        <input name="pix_login_logo" type="text" value="<?php echo pix_esc_option('pix_login_logo'); ?>">
                        <div class="grey_button pix_upload_image_button">
                            <div class="button_left"></div>
                            <div class="button_right"></div>
                            <div class="button_body"></div>
                            <a href="#">upload</a>
                        </div>
                    </div><!-- .pix_upload_image -->
                </div><!-- .field_wrap -->
                <div class="clear"></div>
                <div class="tip_info_wrap">
                    <small class="tip_info">It must be 326 x 110 pixels</small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
            
            	<label for="pix_admin_panel_logo">Admin header logo:</label>
                <span class="alignleft code_wrapper"><code>url( </code></span>
                <div class="field_wrap alignleft">
                    <div class="pix_upload_image">
                        <div class="pix_image_thumb"><img alt="Preview" src="<?php if(pix_esc_option('pix_admin_panel_logo')!=''){ echo get_pix_thumb(pix_esc_option('pix_admin_panel_logo'), 'mini_preview'); } else { echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; } ?>"></div>
                        <input name="pix_admin_panel_logo" type="text" value="<?php echo pix_esc_option('pix_admin_panel_logo'); ?>">
                        <div class="grey_button pix_upload_image_button">
                            <div class="button_left"></div>
                            <div class="button_right"></div>
                            <div class="button_body"></div>
                            <a href="#">upload</a>
                        </div>
                    </div><!-- .pix_upload_image -->
                </div><!-- .field_wrap -->
                <span class="alignleft code_wrapper"><code> ) </code></span>
                <div class="field_wrap">
                	<input type="text" name="pix_admin_panel_logo_css" value="<?php echo pix_esc_option('pix_admin_panel_logo_css'); ?>" class="pix_bgimage_css">
                </div>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                	<small class="tip_info">The image will be written as value of the background property, and you can add other values in the field on the right.<br>
                    <strong>N.B.:</strong> the image can't be taller than 56 pixels</small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                    	<div class="open_info">info</div>
                    	<div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
            
            	<label for="pix_allow_changelog">Show the changelog button:</label>
                <input type="hidden" name="pix_allow_changelog" value="0">
                <input type="checkbox" name="pix_allow_changelog" value="true" <?php if(pix_esc_option('pix_allow_changelog')=='true') { echo 'checked="checked"'; } ?>>
                <div class="clear"></div>
            
            	<label for="pix_allow_ajax">Enable ajax to save data:</label>
                <input type="hidden" name="pix_allow_ajax" value="0">
                <input type="checkbox" name="pix_allow_ajax" value="true" <?php if(pix_esc_option('pix_allow_ajax')=='true') { echo 'checked="checked"'; } ?>>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                	<small class="tip_info">Where available (not for this form) your options will be saved without refreshing the page. If you encounter some problem switch this field off</small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                    	<div class="open_info">info</div>
                    	<div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
            
                <label for="pix_css_inline">Put your custom CSS inline:</label>
                <input type="hidden" name="pix_css_inline" value="0">
                <input type="checkbox" name="pix_css_inline" value="true" <?php if(pix_esc_option('pix_css_inline')=='true') { echo 'checked="checked"'; } ?>>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                    <small class="tip_info">If you switch it on, the options you saved in this admin panel will be written directly in the head of your pages. In this case the performance of your site could be a little slower, so I recommend to leave this button off if you don't have more important reasons to switch it on</small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->

        <input type="hidden" name="action" value="data_save" />
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>" />
        <input type="submit" class="hidden_div" value="" />
            </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>