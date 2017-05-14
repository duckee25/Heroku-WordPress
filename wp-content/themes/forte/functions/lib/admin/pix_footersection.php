<?php

function footer_section(){
	global $options;
	if ($_GET['page']=='footer_section') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	General: <small>footer section</small>
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

                <label for="pix_footer_bgcolor">Background color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_footer_bgcolor" type="text" value="<?php echo pix_esc_option('pix_footer_bgcolor'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_footer_border">Border top color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_footer_border" type="text" value="<?php echo pix_esc_option('pix_footer_border'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

            	<label for="pix_footer_bgimage">Background image:</label>
                <span class="alignleft code_wrapper"><code>url( </code></span>
                <div class="field_wrap alignleft">
                    <div class="pix_upload_image">
                        <div class="pix_image_thumb"><img alt="Preview" src="<?php if(pix_esc_option('pix_footer_bgimage')!=''){ echo get_pix_thumb(pix_esc_option('pix_footer_bgimage'), 'mini_preview'); } else { echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; } ?>"></div>
                        <input name="pix_footer_bgimage" type="text" value="<?php echo pix_esc_option('pix_footer_bgimage'); ?>">
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
                	<input type="text" name="pix_footer_bgimage_css" value="<?php echo pix_esc_option('pix_footer_bgimage_css'); ?>" class="pix_bgimage_css">
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
                
                <label for="pix_footer_color">Text color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_footer_color" type="text" value="<?php echo pix_esc_option('pix_footer_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_footer_title">Color of the headings:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_footer_title" type="text" value="<?php echo pix_esc_option('pix_footer_title'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_footer_link">Color of the links:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_footer_link" type="text" value="<?php echo pix_esc_option('pix_footer_link'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_footer_highlighted_color">Highlighted text color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_footer_highlighted_color" type="text" value="<?php echo pix_esc_option('pix_footer_highlighted_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <label for="pix_footer_separator_color">Background color of the horizontal separator lines (where available):</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_footer_separator_color" type="text" value="<?php echo pix_esc_option('pix_footer_separator_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_footer_list_sign">List sign color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_footer_list_sign" type="text" value="<?php echo pix_esc_option('pix_footer_list_sign'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_footer_soft_bg">Soft background color (secondary color):</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_footer_soft_bg" type="text" value="<?php echo pix_esc_option('pix_footer_soft_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_footer_widgets">Display the widget area on the footer</label>
                <input type="hidden" name="pix_footer_widgets" value="0">
                <input type="checkbox" name="pix_footer_widgets" value="true" <?php if(pix_esc_option('pix_footer_widgets')=='true') { echo 'checked="checked"'; } ?>>

                <div class="tip_info_wrap">
                    <small class="tip_info">What's that? <a href="http://www.pixedelic.com/forte_support_images/widget_area.jpg" class="colorbox">Click here</a></small>
                </div>


<?php
	$get_sidebar_options = sidebar_generator_pix::get_sidebars();
?>

                <div class="clear"></div>
                
                <label>Widgets on the footer</label>
                <div class="pix_builder">
                    <label for="pix_first_footer">First widget area</label>
                    <div class="field_wrap">
                        <select name="pix_first_footer">
                            <option value="" <?php selected( pix_esc_option('pix_first_footer'), '' ); ?>>empty</option>
                            <?php
                                foreach ($get_sidebar_options as $sidebar) {
                                    echo '<option value="'.$sidebar.'" '.selected( pix_esc_option('pix_first_footer'), $sidebar, false ).'>'.$sidebar.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    
                    <label for="pix_second_footer">Second widget area</label>
                    <div class="field_wrap">
                        <select name="pix_second_footer">
                            <option value="" <?php selected( pix_esc_option('pix_second_footer'), '' ); ?>>empty</option>
                            <?php
                                foreach ($get_sidebar_options as $sidebar) {
                                    echo '<option value="'.$sidebar.'" '.selected( pix_esc_option('pix_second_footer'), $sidebar, false ).'>'.$sidebar.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    
                    <label for="pix_third_footer">Third widget area</label>
                    <div class="field_wrap">
                        <select name="pix_third_footer">
                            <option value="" <?php selected( pix_esc_option('pix_third_footer'), '' ); ?>>empty</option>
                            <?php
                                foreach ($get_sidebar_options as $sidebar) {
                                    echo '<option value="'.$sidebar.'" '.selected( pix_esc_option('pix_third_footer'), $sidebar, false ).'>'.$sidebar.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    
                    <label for="pix_fourth_footer">Fourth widget area</label>
                    <div class="field_wrap">
                        <select name="pix_fourth_footer">
                            <option value="" <?php selected( pix_esc_option('pix_fourth_footer'), '' ); ?>>empty</option>
                            <?php
                                foreach ($get_sidebar_options as $sidebar) {
                                    echo '<option value="'.$sidebar.'" '.selected( pix_esc_option('pix_fourth_footer'), $sidebar, false ).'>'.$sidebar.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="clear"></div>
                </div><!-- .pix_builder -->
                
                <div class="clear"></div>
                <div class="tip_info_wrap">
                	<small class="tip_info">If you leave one of these areas empty, the area before that will fit the space left without content</small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                    	<div class="open_info">info</div>
                    	<div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
                
                <div class="clear"></div>
                
                    <label for="pix_footer_credits">Display the credits area on the footer</label>
                <input type="hidden" name="pix_footer_credits" value="0">
                <input type="checkbox" name="pix_footer_credits" value="true" <?php if(pix_esc_option('pix_footer_credits')=='true') { echo 'checked="checked"'; } ?>>

                <div class="tip_info_wrap">
                    <small class="tip_info">What's that? <a href="http://www.pixedelic.com/forte_support_images/credits.jpg" class="colorbox">Click here</a></small>
                </div>

            	<label for="pix_credits_left">Text on the left credits area:</label>
                <div class="field_wrap"><textarea name="pix_credits_left"><?php echo pix_esc_option('pix_credits_left'); ?></textarea></div>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                    <small class="tip_info">
                    	It accepts html too
                    </small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->

            	<label for="pix_credits_right">Text on the right credits area:</label>
                <div class="field_wrap"><textarea name="pix_credits_right"><?php echo pix_esc_option('pix_credits_right'); ?></textarea></div>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                    <small class="tip_info">
                    	It accepts html too
                    </small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->

                <label for="pix_credits_color">Text color of the credits area:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_credits_color" type="text" value="<?php echo pix_esc_option('pix_credits_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_credits_bgcolor">Background color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_credits_bgcolor" type="text" value="<?php echo pix_esc_option('pix_credits_bgcolor'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_credits_border">Border top color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_credits_border" type="text" value="<?php echo pix_esc_option('pix_credits_border'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

            	<label for="pix_credits_bgimage">Background image:</label>
                <span class="alignleft code_wrapper"><code>url( </code></span>
                <div class="field_wrap alignleft">
                    <div class="pix_upload_image">
                        <div class="pix_image_thumb"><img alt="Preview" src="<?php if(pix_esc_option('pix_credits_bgimage')!=''){ echo get_pix_thumb(pix_esc_option('pix_credits_bgimage'), 'mini_preview'); } else { echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; } ?>"></div>
                        <input name="pix_credits_bgimage" type="text" value="<?php echo pix_esc_option('pix_credits_bgimage'); ?>">
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
                	<input type="text" name="pix_credits_bgimage_css" value="<?php echo pix_esc_option('pix_credits_bgimage_css'); ?>" class="pix_bgimage_css">
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
            
            	<label for="pix_append_footer">Append something to the footer (Google Analytics script or anything else):</label>
                <div class="field_wrap"><textarea name="pix_append_footer" id="pix_append_footer"><?php echo esc_attr(pix_esc_option('pix_append_footer')); ?></textarea></div>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                    <small class="tip_info">
                    	Here you can paste scripts or whatever you want to append to the footer or display at the end of the page code
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