<?php

function sliding_sidebar(){
	global $options;
	if ($_GET['page']=='sliding_sidebar') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	General: <small>sliding sidebars</small>
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

                <div class="clear"></div>
                <div class="tip_info_wrap visible_tip">
                    <small class="tip_info">What are they? <a href="http://www.pixedelic.com/forte_support_images/sliding_sidebar.jpg" class="colorbox">Click here</a></small>
                </div>
                <div class="clear"></div>

                <label for="pix_slidaside_text_color">Text color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slidaside_text_color" type="text" value="<?php echo pix_esc_option('pix_slidaside_text_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_slidaside_link_color">Color of the links:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slidaside_link_color" type="text" value="<?php echo pix_esc_option('pix_slidaside_link_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_slidaside_highlighted_color">Highlighted text color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slidaside_highlighted_color" type="text" value="<?php echo pix_esc_option('pix_slidaside_highlighted_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <label for="pix_slidaside_list_sign">List signs color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slidaside_list_sign" type="text" value="<?php echo pix_esc_option('pix_slidaside_list_sign'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_slidaside_soft_bg">Soft background color (secondary color):</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slidaside_soft_bg" type="text" value="<?php echo pix_esc_option('pix_slidaside_soft_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_slidaside_separators_color">Horizontal separators color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slidaside_separators_color" type="text" value="<?php echo pix_esc_option('pix_slidaside_separators_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_slidaside_bgcolor">Background color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slidaside_bgcolor" type="text" value="<?php echo pix_esc_option('pix_slidaside_bgcolor'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_slidaside_bgcolor_opacity">Opacity of the  background color:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap"><input type="text" name="pix_slidaside_bgcolor_opacity" value="<?php echo pix_esc_option('pix_slidaside_bgcolor_opacity'); ?>"></div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label for="pix_slidaside_bgimage">Background image:</label>
                <span class="alignleft code_wrapper"><code>url( </code></span>
                <div class="field_wrap alignleft">
                    <div class="pix_upload_image">
                        <div class="pix_image_thumb"><img alt="Preview" src="<?php if(pix_esc_option('pix_slidaside_bgimage')!=''){ echo get_pix_thumb(pix_esc_option('pix_slidaside_bgimage'), 'mini_preview'); } else { echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; } ?>"></div>
                        <input name="pix_slidaside_bgimage" type="text" value="<?php echo pix_esc_option('pix_slidaside_bgimage'); ?>">
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
                    <input type="text" name="pix_slidaside_bgimage_css" value="<?php echo pix_esc_option('pix_slidaside_bgimage_css'); ?>" class="pix_bgimage_css">
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
                
                <div class="clear"></div>
                
                <label for="pix_slidaside_accordion_bgcolor">Background color of the accordion panels:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slidaside_accordion_bgcolor" type="text" value="<?php echo pix_esc_option('pix_slidaside_accordion_bgcolor'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
    
                <label for="pix_slidaside_drag_cont_bgcolor">Color of the scroll container:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slidaside_drag_cont_bgcolor" type="text" value="<?php echo pix_esc_option('pix_slidaside_drag_cont_bgcolor'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_slidaside_drag_cont_opacity">Opacity of the scroll container:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap"><input type="text" name="pix_slidaside_drag_cont_opacity" value="<?php echo pix_esc_option('pix_slidaside_drag_cont_opacity'); ?>"></div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label for="pix_slidaside_drag_bgcolor">Color of the scroll dragger:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slidaside_drag_bgcolor" type="text" value="<?php echo pix_esc_option('pix_slidaside_drag_bgcolor'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_slidaside_drag_opacity">Opacity of the scroll dragger:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap"><input type="text" name="pix_slidaside_drag_opacity" value="<?php echo pix_esc_option('pix_slidaside_drag_opacity'); ?>"></div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label for="pix_slidaside_close_color">Color of the &quot;close&quot; button:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slidaside_close_color" type="text" value="<?php echo pix_esc_option('pix_slidaside_close_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_slidaside_close_bg">Background of the &quot;close&quot; button:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slidaside_close_bg" type="text" value="<?php echo pix_esc_option('pix_slidaside_close_bg'); ?>">
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