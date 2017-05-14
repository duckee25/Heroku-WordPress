<?php

function section_colors(){
	global $options;
	if ($_GET['page']=='section_colors') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Colors: <small>elements of the main section</small>
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

                <label for="pix_secondary_bg">Secondary background color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_secondary_bg" type="text" value="<?php echo pix_esc_option('pix_secondary_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                	<small class="tip_info">This color will be used as a background for some particular elements, such as &lt;pre&gt;, &lt;code&gt;, some tables, etc. Use a color very similar to the primary color you selected on General -> Main section -> Background color</small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                    	<div class="open_info">info</div>
                    	<div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
            
                <label for="pix_secondary_bgcolor_opacity">Opacity of the background color:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap"><input type="text" name="pix_secondary_bgcolor_opacity" value="<?php echo pix_esc_option('pix_secondary_bgcolor_opacity'); ?>"></div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label for="pix_hr_color">HR elements:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_hr_color" type="text" value="<?php echo pix_esc_option('pix_hr_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_hover_icons_color">Color of the icons over the linked images:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_hover_icons_color" type="text" value="<?php echo pix_esc_option('pix_hover_icons_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_hover_icons_bg">Background color of the icons over the linked images:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_hover_icons_bg" type="text" value="<?php echo pix_esc_option('pix_hover_icons_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_hover_icons_bg_opacity">Background opacity of the icons over the linked images:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap">
                        <input type="text" name="pix_hover_icons_bg_opacity" value="<?php echo pix_esc_option('pix_hover_icons_bg_opacity'); ?>">
                    </div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label for="pix_hover_bg">Background color of the frame over the linked images:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_hover_bg" type="text" value="<?php echo pix_esc_option('pix_hover_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_hover_bg_border">Border color of the frame over the linked images:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_hover_bg_border" type="text" value="<?php echo pix_esc_option('pix_hover_bg_border'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_hover_bg_opacity">Background opacity of the frame over the linked images:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap">
                        <input type="text" name="pix_hover_bg_opacity" value="<?php echo pix_esc_option('pix_hover_bg_opacity'); ?>">
                    </div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label>Shadow (where required):</label>
                <div class="pix_groupped">
                    <div class="field_wrap pix_color_picker alignleft">
                        <em>Color of the shadow</em><br>
                        <input name="pix_main_shadow_color" type="text" value="<?php echo pix_esc_option('pix_main_shadow_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <div class="alignleft pix_block_of_styles_2">
                        <span class="alignleft code_wrapper"><code>x </code></span>
                        <div class="field_wrap">
                            <input type="text" name="pix_main_shadow_x" value="<?php echo pix_esc_option('pix_main_shadow_x'); ?>" class="pix_quite_mini_text">
                        </div>
                        <span class="alignleft code_wrapper"><code> px</code></span>
                    
                        <span class="alignleft code_wrapper_right"><code>y </code></span>
                        <div class="field_wrap">
                            <input type="text" name="pix_main_shadow_y" value="<?php echo pix_esc_option('pix_main_shadow_x'); ?>" class="pix_quite_mini_text">
                        </div>
                        <span class="alignleft code_wrapper"><code> px</code></span>
                    
                        <span class="alignleft code_wrapper_right"><code>blur </code></span>
                        <div class="field_wrap">
                            <input type="text" name="pix_main_shadow_blur" value="<?php echo pix_esc_option('pix_main_shadow_blur'); ?>" class="pix_quite_mini_text">
                        </div>
                        <span class="alignleft code_wrapper"><code> px</code></span>
                    
                        <span class="alignleft code_wrapper_right"><code>spread </code></span>
                        <div class="field_wrap">
                            <input type="text" name="pix_main_shadow_spread" value="<?php echo pix_esc_option('pix_main_shadow_spread'); ?>" class="pix_quite_mini_text">
                        </div>
                        <span class="alignleft code_wrapper"><code> px</code></span>
                    </div>
                    
                    <div class="clear less_space"></div>

                    <div class="slider_div opacity alignleft">
                        <div class="field_wrap">
                            <em>Shadow opacity</em><br>
                            <input type="text" name="pix_main_shadow_opacity" value="<?php echo pix_esc_option('pix_main_shadow_opacity'); ?>">
                        </div>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->
                </div><!-- .pix_groupped -->
                
                <label for="pix_scroll_button_bg">Scroll buttons background:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_scroll_button_bg" type="text" value="<?php echo pix_esc_option('pix_scroll_button_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_scroll_button_bg_opacity">Scroll buttons background opacity:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap"><input type="text" name="pix_scroll_button_bg_opacity" value="<?php echo pix_esc_option('pix_scroll_button_bg_opacity'); ?>"></div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label for="pix_scroll_button_color">Scroll buttons icon color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_scroll_button_color" type="text" value="<?php echo pix_esc_option('pix_scroll_button_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_like_color">Color of the &quot;Like&quot; (heart) button:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_like_color" type="text" value="<?php echo pix_esc_option('pix_like_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>