<?php

function front_header(){
	global $options;
	if ($_GET['page']=='front_header') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	General: <small>header</small>
                <div class="yellow_button button_floating">
                	<div class="button_left"></div>
                	<div class="button_right"></div>
                	<div class="button_body"></div>
                	<a href="#" class="save_changes">save changes</a>
                </div>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
            <?php if (pix_esc_option('pix_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form">
            <?php } else { ?>
            <form method="post" class="dynamic_form" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>

                <div class="tip_info_wrap visible_tip">
                    <small class="tip_info">What's that? <a href="http://www.pixedelic.com/forte_support_images/header.jpg" class="colorbox">Click here</a></small>
                </div>
                <div class="clear"></div>

                <label for="pix_header_effect">Animation on loading:</label>
                <input type="hidden" name="pix_header_effect" value="0">
                <input type="checkbox" name="pix_header_effect" value="true" <?php if(pix_esc_option('pix_header_effect')=='true') { echo 'checked="checked"'; } ?>>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                    <small class="tip_info">
                        When you visit a page of the site, if you come from another site, the menu and the logo descend from the top of the screen with a short animation. If you come from another page of your site, there insn't any animation.
                    </small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
            
                <label for="pix_header_resize">Resize the header on scroll event:</label>
                <input type="hidden" name="pix_header_resize" value="0">
                <input type="checkbox" name="pix_header_resize" value="true" <?php if(pix_esc_option('pix_header_resize')=='true') { echo 'checked="checked"'; } ?>>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                    <small class="tip_info">
                        When you scroll the page you can decide to reduce the height of the header.
                    </small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
            
                <label for="pix_header_position">Position of the header</label>
                <div class="field_wrap">
                    <select name="pix_header_position">
                        <option value="" <?php selected( pix_esc_option('pix_header_position'), '' ); ?>>fixed (floating)</option>
                        <option value="header_scroll" <?php selected( pix_esc_option('pix_header_position'), 'header_scroll' ); ?>>absolute (scrolling)</option>
                    </select>
                </div>
                <div class="clear"></div>


                <label for="pix_header_bgcolor">Background color of the header:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_header_bgcolor" type="text" value="<?php echo pix_esc_option('pix_header_bgcolor'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_header_bgcolor_opacity">Opacity of the background color:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap"><input type="text" name="pix_header_bgcolor_opacity" value="<?php echo pix_esc_option('pix_header_bgcolor_opacity'); ?>"></div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

            	<label for="pix_header_bgimage">Background image of the header:</label>
                <span class="alignleft code_wrapper"><code>url( </code></span>
                <div class="field_wrap alignleft">
                    <div class="pix_upload_image">
                        <div class="pix_image_thumb"><img alt="Preview" src="<?php if(pix_esc_option('pix_header_bgimage')!=''){ echo get_pix_thumb(pix_esc_option('pix_header_bgimage'), 'mini_preview'); } else { echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; } ?>"></div>
                        <input name="pix_header_bgimage" type="text" value="<?php echo pix_esc_option('pix_header_bgimage'); ?>">
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
                	<input type="text" name="pix_header_bgimage_css" value="<?php echo pix_esc_option('pix_header_bgimage_css'); ?>" class="pix_bgimage_css">
                </div>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                	<small class="tip_info">The image will be written as value of the background property, and you can add other values in the field on the right. You need a basic knowledge of CSS</small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                    	<div class="open_info">info</div>
                    	<div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
            
                <label for="pix_header_bordertop">Color of the border top:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_header_bordertop" type="text" value="<?php echo pix_esc_option('pix_header_bordertop'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_header_borderbottom">Color of the border bottom:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_header_borderbottom" type="text" value="<?php echo pix_esc_option('pix_header_borderbottom'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label>Shadow of the header</label>
                <div class="pix_groupped">
                    <div class="field_wrap pix_color_picker alignleft">
                        <em>Color of the shadow</em><br>
                        <input name="pix_header_shadow_color" type="text" value="<?php echo pix_esc_option('pix_header_shadow_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <div class="alignleft pix_block_of_styles_2">
                        <span class="alignleft code_wrapper"><code>x </code></span>
                        <div class="field_wrap">
                            <input type="text" name="pix_header_shadow_x" value="<?php echo pix_esc_option('pix_header_shadow_x'); ?>" class="pix_quite_mini_text">
                        </div>
                        <span class="alignleft code_wrapper"><code> px</code></span>
                    
                        <span class="alignleft code_wrapper_right"><code>y </code></span>
                        <div class="field_wrap">
                            <input type="text" name="pix_header_shadow_y" value="<?php echo pix_esc_option('pix_header_shadow_x'); ?>" class="pix_quite_mini_text">
                        </div>
                        <span class="alignleft code_wrapper"><code> px</code></span>
                    
                        <span class="alignleft code_wrapper_right"><code>blur </code></span>
                        <div class="field_wrap">
                            <input type="text" name="pix_header_shadow_blur" value="<?php echo pix_esc_option('pix_header_shadow_blur'); ?>" class="pix_quite_mini_text">
                        </div>
                        <span class="alignleft code_wrapper"><code> px</code></span>
                    
                        <span class="alignleft code_wrapper_right"><code>spread </code></span>
                        <div class="field_wrap">
                            <input type="text" name="pix_header_shadow_spread" value="<?php echo pix_esc_option('pix_header_shadow_spread'); ?>" class="pix_quite_mini_text">
                        </div>
                        <span class="alignleft code_wrapper"><code> px</code></span>
                    </div>
                    
                    <div class="clear less_space"></div>

                    <div class="slider_div opacity alignleft">
                        <div class="field_wrap">
                            <em>Shadow opacity</em><br>
                            <input type="text" name="pix_header_shadow_opacity" value="<?php echo pix_esc_option('pix_header_shadow_opacity'); ?>">
                        </div>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->
                </div><!-- .pix_groupped -->

                <label for="pix_logo_bgcolor">Background color of the logo:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_logo_bgcolor" type="text" value="<?php echo pix_esc_option('pix_logo_bgcolor'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_logo_color">Text color of the logo:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_logo_color" type="text" value="<?php echo pix_esc_option('pix_logo_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_logoimage">Upload your own logo image:</label>
                <div class="field_wrap">
                    <div class="pix_upload_image">
                        <div class="pix_image_thumb"><img alt="Preview" src="<?php if(pix_esc_option('pix_logoimage')!=''){ echo get_pix_thumb(pix_esc_option('pix_logoimage'), 'mini_preview'); } else { echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; } ?>"></div>
                        <input name="pix_logoimage" type="text" value="<?php echo pix_esc_option('pix_logoimage'); ?>">
                        <div class="grey_button pix_upload_image_button">
                            <div class="button_left"></div>
                            <div class="button_right"></div>
                            <div class="button_body"></div>
                            <a href="#">upload</a>
                        </div>
                    </div><!-- .pix_upload_image -->
                </div><!-- .field_wrap -->

            	<label for="pix_logostyle">Logo image additional styles:</label>
                <div class="field_wrap"><textarea name="pix_logostyle" id="pix_logostyle"><?php echo pix_esc_option('pix_logostyle'); ?></textarea></div>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                    <small class="tip_info">
                    	For instance: <strong>margin-right: 5px;</strong>
                    </small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->

                <label class="title_label">Site title</label>
                
                <label for="pix_sitetitle_fontfamily">Selector: <code>#logo</code></label>
                <div class="pix_groupped">
                    <?php if (pix_get_option('pix_enable_google')=='true') { ?>
                    <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_sitetitle_fontfamily&variants=pix_sitetitle_fontvariants&subsets=pix_sitetitle_fontsubsets">
                        <div class="for_the_loader">
                        	<a href="#" class="load_fonts_button">Load the Google fonts</a>
                            <div class="field_wrap dynamic_box">
                                <div class="alignleft">
                                    <em>Font family</em><br>
                                    <select name="pix_sitetitle_fontfamily" class="main_list">
                                        <option value="<?php echo pix_esc_option('pix_sitetitle_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_sitetitle_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_sitetitle_fontfamily')); ?></option>
                                    </select>
                                </div>
                                <div class="alignleft block_small">
                                    <em>Font variant</em><br>
                                    <input type="hidden" name="pix_sitetitle_fontvariants" value="<?php echo pix_esc_option('pix_sitetitle_fontvariants'); ?>" class="select_variants_fake">
                                    <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_sitetitle_fontfamily')); ?>">
                                        <option><?php echo pix_esc_option('pix_sitetitle_fontvariants'); ?></option>
                                    </select>
                                </div>
                                <div class="clear more_space"></div>
                                <em>Font subset</em><br>
                                <input type="hidden" name="pix_sitetitle_fontsubsets" value="<?php echo pix_esc_option('pix_sitetitle_fontsubsets'); ?>" class="select_subsets_fake">
                                <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_sitetitle_fontfamily')); ?>">
                                    <?php $subsets = explode(',',pix_esc_option('pix_sitetitle_fontsubsets'));
                                    foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                    <option><?php echo $subset; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                        <div class="clear less_space"></div>
                    </div>
                    <?php } ?>
                    <div class="slider_div">
                        <div class="field_wrap">
                        	<em>Font size</em><br>
                        	<input type="text" name="pix_sitetitle_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_sitetitle_fontsize'); ?>">
                        </div>
                        <span class="alignleft code_wrapper_lg"><code>px</code></span>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->

                    <div class="font_preview_wrap">
                        <div class="select_font_preview">Site title</div>
                        <div class="select_font_info"></div>
                    </div>

                </div>

                <label class="title_label">Site description</label>

                <label for="pix_sitedescription_fontfamily">Selector: <code>#logo_subtitle</code></label>
                <div class="pix_groupped">
                    <?php if (pix_get_option('pix_enable_google')=='true') { ?>
                    <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_sitedescription_fontfamily&variants=pix_sitedescription_fontvariants&subsets=pix_sitedescription_fontsubsets">
                        <div class="for_the_loader">
                        	<a href="#" class="load_fonts_button">Load the Google fonts</a>
                            <div class="field_wrap dynamic_box">
                                <div class="alignleft">
                                    <em>Font family</em><br>
                                    <select name="pix_sitedescription_fontfamily" class="main_list">
                                        <option value="<?php echo pix_esc_option('pix_sitedescription_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_sitedescription_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_sitedescription_fontfamily')); ?></option>
                                    </select>
                                </div>
                                <div class="alignleft block_small">
                                    <em>Font variant</em><br>
                                    <input type="hidden" name="pix_sitedescription_fontvariants" value="<?php echo pix_esc_option('pix_sitedescription_fontvariants'); ?>" class="select_variants_fake">
                                    <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_sitedescription_fontfamily')); ?>">
                                        <option><?php echo pix_esc_option('pix_sitedescription_fontvariants'); ?></option>
                                    </select>
                                </div>
                                <div class="clear more_space"></div>
                                <em>Font subset</em><br>
                                <input type="hidden" name="pix_sitedescription_fontsubsets" value="<?php echo pix_esc_option('pix_sitedescription_fontsubsets'); ?>" class="select_subsets_fake">
                                <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_sitedescription_fontfamily')); ?>">
                                    <?php $subsets = explode(',',pix_esc_option('pix_sitedescription_fontsubsets'));
                                    foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                    <option><?php echo $subset; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                        <div class="clear less_space"></div>
                    </div>
                    <?php } ?>
                    <div class="slider_div">
                        <div class="field_wrap">
                        	<em>Font size</em><br>
                        	<input type="text" name="pix_sitedescription_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_sitedescription_fontsize'); ?>">
                        </div>
                        <span class="alignleft code_wrapper_lg"><code>px</code></span>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->

                    <div class="font_preview_wrap">
                        <div class="select_font_preview">Site description</div>
                        <div class="select_font_info"></div>
                    </div>
                </div>

                <label for="pix_append_head_top">Prepend something to the head (TypeKit script or anything else):</label>
                <div class="field_wrap"><textarea name="pix_append_head_top" id="pix_append_head_top"><?php echo esc_attr(pix_esc_option('pix_append_head_top')); ?></textarea></div>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                    <small class="tip_info">
                        Here you can paste scripts or whatever you want to prepend to the beginning of the head
                    </small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->


                <label for="pix_append_head_bottom">Append something to the head (TypeKit script or anything else):</label>
                <div class="field_wrap"><textarea name="pix_append_head_bottom" id="pix_append_head_bottom"><?php echo esc_attr(pix_esc_option('pix_append_head_bottom')); ?></textarea></div>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                    <small class="tip_info">
                        Here you can paste scripts or whatever you want to append to end of the head
                    </small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->

        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>