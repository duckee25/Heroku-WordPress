<?php

function other_colors(){
	global $options;
	if ($_GET['page']=='other_colors') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Colors: <small>forms</small>
                <div class="yellow_button button_floating">
                	<div class="button_left"></div>
                	<div class="button_right"></div>
                	<div class="button_body"></div>
                	<a href="#" class="save_changes">save changes</a>
                </div>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
            <?php if (pix_esc_option('pix_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form" id="form_colors">
            <?php } else { ?>
            <form method="post" class="dynamic_form" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>" id="form_colors">
            <?php } ?>            

                <label for="pix_form_bg">Background of input fields and textareas:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_form_bg" type="text" value="<?php echo pix_esc_option('pix_form_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>

                <label for="pix_form_border_top">Border-top color of input fields and textareas:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_form_border_top" type="text" value="<?php echo pix_esc_option('pix_form_border_top'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>
            
                <label for="pix_form_border_bottom">Border-bottom color of input fields and textareas:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_form_border_bottom" type="text" value="<?php echo pix_esc_option('pix_form_border_bottom'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>
            
                <label for="pix_form_color">Text color of input fields and textareas:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_form_color" type="text" value="<?php echo pix_esc_option('pix_form_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>
            
                <label>Text color of the &quot;simple error&quot; messages (such as labels for the required inputs)</label>
                 <div class="field_wrap pix_color_picker">
                    <input name="pix_simple_error_color" type="text" value="<?php echo pix_esc_option('pix_simple_error_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <label>Text color of the &quot;success&quot; messages</label>
                 <div class="field_wrap pix_color_picker">
                    <input name="pix_success_color" type="text" value="<?php echo pix_esc_option('pix_success_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <label>Background color of the &quot;success&quot; messages</label>
                 <div class="field_wrap pix_color_picker">
                    <input name="pix_success_bg" type="text" value="<?php echo pix_esc_option('pix_success_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <label>Text color of the &quot;error&quot; messages</label>
                 <div class="field_wrap pix_color_picker">
                    <input name="pix_error_color" type="text" value="<?php echo pix_esc_option('pix_error_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <label>Background color of the &quot;error&quot; messages</label>
                 <div class="field_wrap pix_color_picker">
                    <input name="pix_error_bg" type="text" value="<?php echo pix_esc_option('pix_error_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <label>Text color of the &quot;info&quot; messages</label>
                 <div class="field_wrap pix_color_picker">
                    <input name="pix_info_color" type="text" value="<?php echo pix_esc_option('pix_info_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <label>Background color of the &quot;info&quot; messages</label>
                 <div class="field_wrap pix_color_picker">
                    <input name="pix_info_bg" type="text" value="<?php echo pix_esc_option('pix_info_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <label>Text color of the captcha code</label>
                 <div class="field_wrap pix_color_picker">
                    <input name="pix_captcha_color" type="text" value="<?php echo pix_esc_option('pix_captcha_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <label>Background color of the captcha code</label>
                 <div class="field_wrap pix_color_picker">
                    <input name="pix_captcha_bg" type="text" value="<?php echo pix_esc_option('pix_captcha_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <div class="clear less_space"></div>

                <div class="tip_info_wrap"></div>

                <div class="clear less_space"></div>

                <label for="pix_form_footer">Use the same colors for the footer</label>
                <input type="hidden" name="pix_form_footer" value="0">
                <input type="checkbox" name="pix_form_footer" data-panel="footer" value="true" <?php checked(pix_esc_option('pix_form_footer'),'true'); ?>> 

                <div class="clear less_space"></div>

                <div class="form_other_colors pix_groupped hidden_div" data-panel="target_footer">
                <label for="pix_form_footer_bg">Background of input fields and textareas:</label>
                    <div class="field_wrap pix_color_picker">
                        <input name="pix_form_footer_bg" type="text" value="<?php echo pix_esc_option('pix_form_footer_bg'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    <div class="clear"></div>

                    <label for="pix_form_footer_border_top">Border-top color of input fields and textareas:</label>
                    <div class="field_wrap pix_color_picker">
                        <input name="pix_form_footer_border_top" type="text" value="<?php echo pix_esc_option('pix_form_footer_border_top'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    <div class="clear"></div>
                
                    <label for="pix_form_footer_border_bottom">Border-bottom color of input fields and textareas:</label>
                    <div class="field_wrap pix_color_picker">
                        <input name="pix_form_footer_border_bottom" type="text" value="<?php echo pix_esc_option('pix_form_footer_border_bottom'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    <div class="clear"></div>
                
                    <label for="pix_form_footer_color">Text color of input fields and textareas:</label>
                    <div class="field_wrap pix_color_picker">
                        <input name="pix_form_footer_color" type="text" value="<?php echo pix_esc_option('pix_form_footer_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    <div class="clear"></div>
                
                    <label>Text color of the &quot;simple error&quot; messages (such as labels for the required inputs)</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_simple_footer_error_color" type="text" value="<?php echo pix_esc_option('pix_simple_footer_error_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <label>Text color of the &quot;success&quot; messages</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_success_footer_color" type="text" value="<?php echo pix_esc_option('pix_success_footer_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <label>Background color of the &quot;success&quot; messages</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_success_footer_bg" type="text" value="<?php echo pix_esc_option('pix_success_footer_bg'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <label>Text color of the &quot;error&quot; messages</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_error_footer_color" type="text" value="<?php echo pix_esc_option('pix_error_footer_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <label>Background color of the &quot;error&quot; messages</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_error_footer_bg" type="text" value="<?php echo pix_esc_option('pix_error_footer_bg'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                </div> 

                <div class="clear less_space"></div>

                <div class="tip_info_wrap"></div>

                <div class="clear less_space"></div>

                <label for="pix_form_aside">Use the same colors for the sidebars</label>
                <input type="hidden" name="pix_form_aside" value="0">
                <input type="checkbox" name="pix_form_aside" data-panel="aside" value="true" <?php checked(pix_esc_option('pix_form_aside'),'true'); ?>>

                <div class="clear less_space"></div>

                <div class="form_other_colors pix_groupped hidden_div" data-panel="target_aside">
                    <label for="pix_form_aside_bg">Background of input fields and textareas:</label>
                    <div class="field_wrap pix_color_picker">
                        <input name="pix_form_aside_bg" type="text" value="<?php echo pix_esc_option('pix_form_aside_bg'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    <div class="clear"></div>

                    <label for="pix_form_aside_border_top">Border-top color of input fields and textareas:</label>
                    <div class="field_wrap pix_color_picker">
                        <input name="pix_form_aside_border_top" type="text" value="<?php echo pix_esc_option('pix_form_aside_border_top'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    <div class="clear"></div>
                
                    <label for="pix_form_aside_border_bottom">Border-bottom color of input fields and textareas:</label>
                    <div class="field_wrap pix_color_picker">
                        <input name="pix_form_aside_border_bottom" type="text" value="<?php echo pix_esc_option('pix_form_aside_border_bottom'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    <div class="clear"></div>
                
                    <label for="pix_form_aside_color">Text color of input fields and textareas:</label>
                    <div class="field_wrap pix_color_picker">
                        <input name="pix_form_aside_color" type="text" value="<?php echo pix_esc_option('pix_form_aside_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    <div class="clear"></div>
                
                    <label>Text color of the &quot;simple error&quot; messages (such as labels for the required inputs)</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_simple_aside_error_color" type="text" value="<?php echo pix_esc_option('pix_simple_aside_error_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <label>Text color of the &quot;success&quot; messages</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_success_aside_color" type="text" value="<?php echo pix_esc_option('pix_success_aside_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <label>Background color of the &quot;success&quot; messages</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_success_aside_bg" type="text" value="<?php echo pix_esc_option('pix_success_aside_bg'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <label>Text color of the &quot;error&quot; messages</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_error_aside_color" type="text" value="<?php echo pix_esc_option('pix_error_aside_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <label>Background color of the &quot;error&quot; messages</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_error_aside_bg" type="text" value="<?php echo pix_esc_option('pix_error_aside_bg'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                </div> 

                <div class="clear less_space"></div>

                <div class="tip_info_wrap"></div>

                <div class="clear less_space"></div>

                <label for="pix_form_slidaside">Use the same colors for the sliding sidebars</label>
                <input type="hidden" name="pix_form_slidaside" value="0">
                <input type="checkbox" name="pix_form_slidaside" data-panel="slidaside" value="true" <?php checked(pix_esc_option('pix_form_slidaside'),'true'); ?>>

                <div class="clear less_space"></div>

                <div class="form_other_colors pix_groupped hidden_div" data-panel="target_slidaside">
                    <label for="pix_form_slidaside_bg">Background of input fields and textareas:</label>
                    <div class="field_wrap pix_color_picker">
                        <input name="pix_form_slidaside_bg" type="text" value="<?php echo pix_esc_option('pix_form_slidaside_bg'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    <div class="clear"></div>

                    <label for="pix_form_slidaside_border_top">Border-top color of input fields and textareas:</label>
                    <div class="field_wrap pix_color_picker">
                        <input name="pix_form_slidaside_border_top" type="text" value="<?php echo pix_esc_option('pix_form_slidaside_border_top'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    <div class="clear"></div>
                
                    <label for="pix_form_slidaside_border_bottom">Border-bottom color of input fields and textareas:</label>
                    <div class="field_wrap pix_color_picker">
                        <input name="pix_form_slidaside_border_bottom" type="text" value="<?php echo pix_esc_option('pix_form_slidaside_border_bottom'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    <div class="clear"></div>
                
                    <label for="pix_form_slidaside_color">Text color of input fields and textareas:</label>
                    <div class="field_wrap pix_color_picker">
                        <input name="pix_form_slidaside_color" type="text" value="<?php echo pix_esc_option('pix_form_slidaside_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    <div class="clear"></div>
                
                    <label>Text color of the &quot;simple error&quot; messages (such as labels for the required inputs)</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_simple_slidaside_error_color" type="text" value="<?php echo pix_esc_option('pix_simple_slidaside_error_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <label>Text color of the &quot;success&quot; messages</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_success_slidaside_color" type="text" value="<?php echo pix_esc_option('pix_success_slidaside_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <label>Background color of the &quot;success&quot; messages</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_success_slidaside_bg" type="text" value="<?php echo pix_esc_option('pix_success_slidaside_bg'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <label>Text color of the &quot;error&quot; messages</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_error_slidaside_color" type="text" value="<?php echo pix_esc_option('pix_error_slidaside_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                    <label>Background color of the &quot;error&quot; messages</label>
                     <div class="field_wrap pix_color_picker">
                        <input name="pix_error_slidaside_bg" type="text" value="<?php echo pix_esc_option('pix_error_slidaside_bg'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                    
                </div> 

                <div class="clear less_space"></div>

        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>