<?php

function layout_colors(){
	global $options;
	if ($_GET['page']=='layout_colors') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Colors: <small>layout colors and images</small>
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

            	<label for="pix_favicon">Favicon:</label>
                <div class="field_wrap">
                    <div class="pix_upload_image">
                        <div class="pix_image_thumb"><img alt="Preview" src="<?php if(pix_esc_option('pix_favicon')!=''){ echo get_pix_thumb(pix_esc_option('pix_favicon'), 'mini_preview'); } else { echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; } ?>"></div>
                        <input name="pix_favicon" type="text" value="<?php echo pix_esc_option('pix_favicon'); ?>">
                        <div class="grey_button pix_upload_image_button">
                            <div class="button_left"></div>
                            <div class="button_right"></div>
                            <div class="button_body"></div>
                            <a href="#">upload</a>
                        </div>
                    </div><!-- .pix_upload_image -->
                </div><!-- .field_wrap -->
                <div class="clear"></div>

                <label for="pix_body_bgcolor">Background color of the body:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_body_bgcolor" type="text" value="<?php echo pix_esc_option('pix_body_bgcolor'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <div class="clear less_space"></div>
                <div class="tip_info_wrap"></div>

                <label for="pix_title_section_bg_color">Background color of the title section:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_title_section_bg_color" type="text" value="<?php echo pix_esc_option('pix_title_section_bg_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>

            	<label for="pix_title_section_bgimage">Background image of the title section:</label>
                <div class="field_wrap alignleft">
                    <div class="pix_upload_image">
                        <div class="pix_image_thumb"><img alt="Preview" src="<?php if(pix_esc_option('pix_title_section_bgimage')!=''){ echo get_pix_thumb(pix_esc_option('pix_title_section_bgimage'), 'mini_preview'); } else { echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; } ?>"></div>
                        <input name="pix_title_section_bgimage" type="text" value="<?php echo pix_esc_option('pix_title_section_bgimage'); ?>">
                        <div class="grey_button pix_upload_image_button">
                            <div class="button_left"></div>
                            <div class="button_right"></div>
                            <div class="button_body"></div>
                            <a href="#">upload</a>
                        </div>
                    </div><!-- .pix_upload_image -->
                </div><!-- .field_wrap -->
                <div class="clear"></div>
            
            	<label for="pix_title_section_widebg">Background of the title section size:</label>
                <div class="field_wrap">
                    <select name="pix_title_section_widebg">
                        <option value="auto" <?php selected( pix_esc_option('pix_title_section_widebg'), 'auto' ); ?>>normal</option>
                        <option value="cover" <?php selected( pix_esc_option('pix_title_section_widebg'), 'cover' ); ?>>fullscreen</option>
                        <option value="contain" <?php selected( pix_esc_option('pix_title_section_widebg'), 'contain' ); ?>>portrait</option>
                    </select>
                </div><!-- .field_wrap -->
                <div class="clear"></div>

                <label for="pix_title_section_bgprepeat">Repeat the background image</label>
                <input type="hidden" name="pix_title_section_bgprepeat" value="0">
                <input type="checkbox" name="pix_title_section_bgprepeat" value="true" <?php checked( pix_get_option('pix_title_section_bgprepeat'), 'true' ) ?>>
                <div class="clear"></div>

                <label for="pix_title_section_full_alignment">Background image alignment</label>
                <div class="field_wrap">
                    <div class="fullscreen_alignment">
                        <input type="hidden" name="pix_title_section_full_alignment" value="<?php echo pix_esc_option('pix_title_section_full_alignment'); ?>">
                        <div data-align="top left"></div>
                        <div data-align="top center"></div>
                        <div data-align="top right"></div>
                        <div data-align="center left"></div>
                        <div data-align="center"></div>
                        <div data-align="center right"></div>
                        <div data-align="bottom left"></div>
                        <div data-align="bottom center"></div>
                        <div data-align="bottom right"></div>
                    </div><!-- .fullscreen_alignment -->
                </div>
            
                <label for="pix_title_section_attachment">Background attachment:</label>
                <div class="field_wrap">
                    <select name="pix_title_section_widebg">
                        <option value="fixed" <?php selected( pix_esc_option('pix_title_section_attachment'), 'fixed' ); ?>>fixed</option>
                        <option value="scroll" <?php selected( pix_esc_option('pix_title_section_attachment'), 'scroll' ); ?>>scroll</option>
                    </select>
                </div><!-- .field_wrap -->
                <div class="clear"></div>

                <label for="pix_title_section_color">Text color of the title and featured text section:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_title_section_color" type="text" value="<?php echo pix_esc_option('pix_title_section_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>

                <label for="pix_title_lines_bgcolor">Background color of the title and featured text lines:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_title_lines_bgcolor" type="text" value="<?php echo pix_esc_option('pix_title_lines_bgcolor'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>

                <label for="pix_title_lines_opacity">Opacity of the title and featured text lines background color:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap"><input type="text" name="pix_title_lines_opacity" value="<?php echo pix_esc_option('pix_title_lines_opacity'); ?>"></div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label for="pix_divider_border">Border color of the featured text section:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_divider_border" type="text" value="<?php echo pix_esc_option('pix_divider_border'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>

                <label>Shadow of the featured text section</label>
                <div class="pix_groupped">
                    <div class="field_wrap pix_color_picker alignleft">
                        <em>Color of the shadow</em><br>
                        <input name="pix_divider_shadow_color" type="text" value="<?php echo pix_esc_option('pix_divider_shadow_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <div class="alignleft pix_block_of_styles_2">
                        <span class="alignleft code_wrapper"><code>x </code></span>
                        <div class="field_wrap">
                            <input type="text" name="pix_divider_shadow_x" value="<?php echo pix_esc_option('pix_divider_shadow_x'); ?>" class="pix_quite_mini_text">
                        </div>
                        <span class="alignleft code_wrapper"><code> px</code></span>
                    
                        <span class="alignleft code_wrapper_right"><code>y </code></span>
                        <div class="field_wrap">
                            <input type="text" name="pix_divider_shadow_y" value="<?php echo pix_esc_option('pix_divider_shadow_x'); ?>" class="pix_quite_mini_text">
                        </div>
                        <span class="alignleft code_wrapper"><code> px</code></span>
                    
                        <span class="alignleft code_wrapper_right"><code>blur </code></span>
                        <div class="field_wrap">
                            <input type="text" name="pix_divider_shadow_blur" value="<?php echo pix_esc_option('pix_divider_shadow_blur'); ?>" class="pix_quite_mini_text">
                        </div>
                        <span class="alignleft code_wrapper"><code> px</code></span>
                    
                        <span class="alignleft code_wrapper_right"><code>spread </code></span>
                        <div class="field_wrap">
                            <input type="text" name="pix_divider_shadow_spread" value="<?php echo pix_esc_option('pix_divider_shadow_spread'); ?>" class="pix_quite_mini_text">
                        </div>
                        <span class="alignleft code_wrapper"><code> px</code></span>
                    </div>
                    
                    <div class="clear less_space"></div>

                    <div class="slider_div opacity alignleft">
                        <div class="field_wrap">
                            <em>Shadow opacity</em><br>
                            <input type="text" name="pix_divider_shadow_opacity" value="<?php echo pix_esc_option('pix_divider_shadow_opacity'); ?>">
                        </div>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->
                </div><!-- .pix_groupped -->

        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>