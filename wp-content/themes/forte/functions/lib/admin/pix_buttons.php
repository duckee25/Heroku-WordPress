<?php

function buttons_colors(){
	global $options;
	if ($_GET['page']=='buttons_colors') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Colors: <small>buttons</small>
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

                <label for="pix_tiny_button">Tiny button <code>.comment-reply-link, .comment-edit-link, #cancel-comment-reply-link, .pix_widget_follow_link, .pix_button.tiny_button</code></label>
                <div class="pix_groupped">
                    <div class="pix_create_button">
                        <div class="field_wrap pix_color_picker alignleft">
                            <em>Background color</em><br>
                            <input name="pix_tiny_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_tiny_button_bg'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>

                        <div class="field_wrap pix_color_picker alignleft block_small">
                            <em>Text color</em><br>
                            <input name="pix_tiny_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_tiny_button_textcolor'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>
                        
                        <div class="clear less_space"></div>

                        <div class="field_wrap pix_color_picker alignleft">
                            <em>Border bottom color</em><br>
                            <input name="pix_tiny_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_tiny_button_border'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>
                        
                        <div class="slider_div alignleft em">
                            <div class="field_wrap alignleft block_small">
                                <em>Font size</em><br>
                                <input type="text" name="pix_tiny_button_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_tiny_button_fontsize'); ?>">
                                <div class="slider_cursor"></div>
                            </div>
                            <span class="alignleft code_wrapper_lg"><code>em</code></span>
                        </div><!-- .slider_div -->

                        <div class="clear less_space"></div>

                        <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_tiny_button_fontfamily&variants=pix_tiny_button_fontvariants&subsets=pix_tiny_button_fontsubsets">
                            <div class="for_the_loader">
                                <a href="#" class="load_fonts_button">Load the Google fonts</a>
                                <div class="field_wrap dynamic_box">
                                    <div class="alignleft">
                                        <em>Font family</em><br>
                                        <select name="pix_tiny_button_fontfamily" class="main_list">
                                            <option value="<?php echo pix_esc_option('pix_tiny_button_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_tiny_button_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_tiny_button_fontfamily')); ?></option>
                                        </select>
                                    </div>
                                    <div class="alignleft block_small">
                                        <em>Font variant</em><br>
                                        <input type="hidden" name="pix_tiny_button_fontvariants" value="<?php echo pix_esc_option('pix_tiny_button_fontvariants'); ?>" class="select_variants_fake">
                                        <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_tiny_button_fontvariants')); ?>">
                                            <option><?php echo pix_esc_option('pix_tiny_button_fontvariants'); ?></option>
                                        </select>
                                    </div>
                                    <div class="clear more_space"></div>
                                    <em>Font subset</em><br>
                                    <input type="hidden" name="pix_tiny_button_fontsubsets" value="<?php echo pix_esc_option('pix_tiny_button_fontsubsets'); ?>" class="select_subsets_fake">
                                    <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_tiny_button_fontfamily')); ?>">
                                        <?php $subsets = explode(',',pix_esc_option('pix_tiny_button_fontsubsets'));
                                        foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                        <option><?php echo $subset; ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="clear less_space"></div>

                        <div class="alignleft wrap_button_preview">
                            <div class="button_preview tiny"><div class="select_font_preview">Button preview</div></div>
                            <div class="clear more_space"></div>
                            <small><em><strong>N.B.</strong>The size of the button could not reflect the real size on the front-end</em></small>
                        </div>
                        
                        
                    </div><!-- .pix_create_button -->
                </div><!-- .pix_groupped -->
                
                <label for="pix_simple_button">Simple button <code>.pix_button.simple_button, .products .add_to_cart_button</code></label>
                <div class="pix_groupped">
                    <div class="pix_create_button">
                        <div class="field_wrap pix_color_picker alignleft">
                            <em>Background color</em><br>
                            <input name="pix_simple_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_simple_button_bg'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>

                        <div class="field_wrap pix_color_picker alignleft block_small">
                            <em>Text color</em><br>
                            <input name="pix_simple_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_simple_button_textcolor'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>
                        
                        <div class="clear less_space"></div>

                        <div class="field_wrap pix_color_picker alignleft">
                            <em>Border bottom color</em><br>
                            <input name="pix_simple_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_simple_button_border'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>
                        
                        <div class="slider_div alignleft em">
                            <div class="field_wrap alignleft block_small">
                                <em>Font size (default)</em><br>
                                <input type="text" name="pix_simple_button_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_simple_button_fontsize'); ?>">
                                <div class="slider_cursor"></div>
                            </div>
                            <span class="alignleft code_wrapper_lg"><code>em</code></span>
                        </div><!-- .slider_div -->

                        <div class="clear less_space"></div>

                        <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_simple_button_fontfamily&variants=pix_simple_button_fontvariants&subsets=pix_simple_button_fontsubsets">
                            <div class="for_the_loader">
                                <a href="#" class="load_fonts_button">Load the Google fonts</a>
                                <div class="field_wrap dynamic_box">
                                    <div class="alignleft">
                                        <em>Font family</em><br>
                                        <select name="pix_simple_button_fontfamily" class="main_list">
                                            <option value="<?php echo pix_esc_option('pix_simple_button_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_simple_button_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_simple_button_fontfamily')); ?></option>
                                        </select>
                                    </div>
                                    <div class="alignleft block_small">
                                        <em>Font variant</em><br>
                                        <input type="hidden" name="pix_simple_button_fontvariants" value="<?php echo pix_esc_option('pix_simple_button_fontvariants'); ?>" class="select_variants_fake">
                                        <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_simple_button_fontvariants')); ?>">
                                            <option><?php echo pix_esc_option('pix_simple_button_fontvariants'); ?></option>
                                        </select>
                                    </div>
                                    <div class="clear more_space"></div>
                                    <em>Font subset</em><br>
                                    <input type="hidden" name="pix_simple_button_fontsubsets" value="<?php echo pix_esc_option('pix_simple_button_fontsubsets'); ?>" class="select_subsets_fake">
                                    <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_simple_button_fontfamily')); ?>">
                                        <?php $subsets = explode(',',pix_esc_option('pix_simple_button_fontsubsets'));
                                        foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                        <option><?php echo $subset; ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="clear less_space"></div>

                        <div class="alignleft wrap_button_preview">
                            <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                            <div class="clear more_space"></div>
                            <small><em><strong>N.B.</strong>The size of the button could not reflect the real size on the front-end</em></small>
                        </div>
                        
                        
                    </div><!-- .pix_create_button -->
                </div><!-- .pix_groupped -->
                
                <label for="pix_first_color_button">First color button <code>.pix_button.first_color, input[type="submit"], button</code></label>
                <div class="pix_groupped">
                    <div class="pix_create_button">
                        <div class="field_wrap pix_color_picker alignleft">
                            <em>Background color</em><br>
                            <input name="pix_first_color_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_first_color_button_bg'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>

                        <div class="field_wrap pix_color_picker alignleft block_small">
                            <em>Text color</em><br>
                            <input name="pix_first_color_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_first_color_button_textcolor'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>
                        
                        <div class="clear less_space"></div>

                        <div class="field_wrap pix_color_picker alignleft">
                            <em>Border bottom color</em><br>
                            <input name="pix_first_color_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_first_color_button_border'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>
                        
                        <div class="slider_div alignleft em">
                            <div class="field_wrap alignleft block_small">
                                <em>Font size (default)</em><br>
                                <input type="text" name="pix_first_color_button_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_first_color_button_fontsize'); ?>">
                                <div class="slider_cursor"></div>
                            </div>
                            <span class="alignleft code_wrapper_lg"><code>em</code></span>
                        </div><!-- .slider_div -->

                        <div class="clear less_space"></div>

                        <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_first_color_button_fontfamily&variants=pix_first_color_button_fontvariants&subsets=pix_first_color_button_fontsubsets">
                            <div class="for_the_loader">
                                <a href="#" class="load_fonts_button">Load the Google fonts</a>
                                <div class="field_wrap dynamic_box">
                                    <div class="alignleft">
                                        <em>Font family</em><br>
                                        <select name="pix_first_color_button_fontfamily" class="main_list">
                                            <option value="<?php echo pix_esc_option('pix_first_color_button_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_first_color_button_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_first_color_button_fontfamily')); ?></option>
                                        </select>
                                    </div>
                                    <div class="alignleft block_small">
                                        <em>Font variant</em><br>
                                        <input type="hidden" name="pix_first_color_button_fontvariants" value="<?php echo pix_esc_option('pix_first_color_button_fontvariants'); ?>" class="select_variants_fake">
                                        <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_first_color_button_fontvariants')); ?>">
                                            <option><?php echo pix_esc_option('pix_first_color_button_fontvariants'); ?></option>
                                        </select>
                                    </div>
                                    <div class="clear more_space"></div>
                                    <em>Font subset</em><br>
                                    <input type="hidden" name="pix_first_color_button_fontsubsets" value="<?php echo pix_esc_option('pix_first_color_button_fontsubsets'); ?>" class="select_subsets_fake">
                                    <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_first_color_button_fontfamily')); ?>">
                                        <?php $subsets = explode(',',pix_esc_option('pix_first_color_button_fontsubsets'));
                                        foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                        <option><?php echo $subset; ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="clear less_space"></div>

                        <div class="alignleft wrap_button_preview">
                            <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                            <div class="clear more_space"></div>
                            <small><em><strong>N.B.</strong>The size of the button could not reflect the real size on the front-end</em></small>
                        </div>
                        
                        
                    </div><!-- .pix_create_button -->
                </div><!-- .pix_groupped -->
                
                <label for="pix_second_color_button">Second color button <code>.second_color, input[type="submit"].second_color, button.second_color, .button.cancel, .submitbutton#wp-submit</code></label>
                <div class="pix_groupped">
                    <div class="pix_create_button">
                        <div class="field_wrap pix_color_picker alignleft">
                            <em>Background color</em><br>
                            <input name="pix_second_color_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_second_color_button_bg'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>

                        <div class="field_wrap pix_color_picker alignleft block_small">
                            <em>Text color</em><br>
                            <input name="pix_second_color_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_second_color_button_textcolor'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>
                        
                        <div class="clear less_space"></div>

                        <div class="field_wrap pix_color_picker alignleft">
                            <em>Border bottom color</em><br>
                            <input name="pix_second_color_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_second_color_button_border'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>
                        
                        <div class="slider_div alignleft em">
                            <div class="field_wrap alignleft block_small">
                                <em>Font size (default)</em><br>
                                <input type="text" name="pix_second_color_button_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_second_color_button_fontsize'); ?>">
                                <div class="slider_cursor"></div>
                            </div>
                            <span class="alignleft code_wrapper_lg"><code>em</code></span>
                        </div><!-- .slider_div -->

                        <div class="clear less_space"></div>

                        <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_second_color_button_fontfamily&variants=pix_second_color_button_fontvariants&subsets=pix_second_color_button_fontsubsets">
                            <div class="for_the_loader">
                                <a href="#" class="load_fonts_button">Load the Google fonts</a>
                                <div class="field_wrap dynamic_box">
                                    <div class="alignleft">
                                        <em>Font family</em><br>
                                        <select name="pix_second_color_button_fontfamily" class="main_list">
                                            <option value="<?php echo pix_esc_option('pix_second_color_button_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_second_color_button_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_second_color_button_fontfamily')); ?></option>
                                        </select>
                                    </div>
                                    <div class="alignleft block_small">
                                        <em>Font variant</em><br>
                                        <input type="hidden" name="pix_second_color_button_fontvariants" value="<?php echo pix_esc_option('pix_second_color_button_fontvariants'); ?>" class="select_variants_fake">
                                        <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_second_color_button_fontvariants')); ?>">
                                            <option><?php echo pix_esc_option('pix_second_color_button_fontvariants'); ?></option>
                                        </select>
                                    </div>
                                    <div class="clear more_space"></div>
                                    <em>Font subset</em><br>
                                    <input type="hidden" name="pix_second_color_button_fontsubsets" value="<?php echo pix_esc_option('pix_second_color_button_fontsubsets'); ?>" class="select_subsets_fake">
                                    <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_second_color_button_fontfamily')); ?>">
                                        <?php $subsets = explode(',',pix_esc_option('pix_second_color_button_fontsubsets'));
                                        foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                        <option><?php echo $subset; ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="clear less_space"></div>

                        <div class="alignleft wrap_button_preview">
                            <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                            <div class="clear more_space"></div>
                            <small><em><strong>N.B.</strong>The size of the button could not reflect the real size on the front-end</em></small>
                        </div>
                        
                        
                    </div><!-- .pix_create_button -->
                </div><!-- .pix_groupped -->
                
                <label for="pix_third_color_button">Third color button <code>.third_color, input[type="submit"].third_color, button.third_color</code></label>
                <div class="pix_groupped">
                    <div class="pix_create_button">
                        <div class="field_wrap pix_color_picker alignleft">
                            <em>Background color</em><br>
                            <input name="pix_third_color_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_third_color_button_bg'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>

                        <div class="field_wrap pix_color_picker alignleft block_small">
                            <em>Text color</em><br>
                            <input name="pix_third_color_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_third_color_button_textcolor'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>
                        
                        <div class="clear less_space"></div>

                        <div class="field_wrap pix_color_picker alignleft">
                            <em>Border bottom color</em><br>
                            <input name="pix_third_color_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_third_color_button_border'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>
                        
                        <div class="slider_div alignleft em">
                            <div class="field_wrap alignleft block_small">
                                <em>Font size (default)</em><br>
                                <input type="text" name="pix_third_color_button_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_third_color_button_fontsize'); ?>">
                                <div class="slider_cursor"></div>
                            </div>
                            <span class="alignleft code_wrapper_lg"><code>em</code></span>
                        </div><!-- .slider_div -->

                        <div class="clear less_space"></div>

                        <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_third_color_button_fontfamily&variants=pix_third_color_button_fontvariants&subsets=pix_third_color_button_fontsubsets">
                            <div class="for_the_loader">
                                <a href="#" class="load_fonts_button">Load the Google fonts</a>
                                <div class="field_wrap dynamic_box">
                                    <div class="alignleft">
                                        <em>Font family</em><br>
                                        <select name="pix_third_color_button_fontfamily" class="main_list">
                                            <option value="<?php echo pix_esc_option('pix_third_color_button_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_third_color_button_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_third_color_button_fontfamily')); ?></option>
                                        </select>
                                    </div>
                                    <div class="alignleft block_small">
                                        <em>Font variant</em><br>
                                        <input type="hidden" name="pix_third_color_button_fontvariants" value="<?php echo pix_esc_option('pix_third_color_button_fontvariants'); ?>" class="select_variants_fake">
                                        <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_third_color_button_fontvariants')); ?>">
                                            <option><?php echo pix_esc_option('pix_third_color_button_fontvariants'); ?></option>
                                        </select>
                                    </div>
                                    <div class="clear more_space"></div>
                                    <em>Font subset</em><br>
                                    <input type="hidden" name="pix_third_color_button_fontsubsets" value="<?php echo pix_esc_option('pix_third_color_button_fontsubsets'); ?>" class="select_subsets_fake">
                                    <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_third_color_button_fontfamily')); ?>">
                                        <?php $subsets = explode(',',pix_esc_option('pix_third_color_button_fontsubsets'));
                                        foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                        <option><?php echo $subset; ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="clear less_space"></div>

                        <div class="alignleft wrap_button_preview">
                            <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                            <div class="clear more_space"></div>
                            <small><em><strong>N.B.</strong>The size of the button could not reflect the real size on the front-end</em></small>
                        </div>
                        
                        
                    </div><!-- .pix_create_button -->
                </div><!-- .pix_groupped -->
                
                <div class="clear less_space"></div>

                <label for="pix_large_button_fontsize">Large button font size</label>
                <div class="slider_div em">
                    <div class="field_wrap">
                        <input type="text" name="pix_large_button_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_large_button_fontsize'); ?>">
                        <div class="slider_cursor"></div>
                    </div>
                    <span class="alignleft code_wrapper_lg"><code>em</code></span>
                </div><!-- .slider_div -->

                <div class="clear less_space"></div>

                <label for="pix_extra_button_fontsize">Extra large button font size</label>
                <div class="slider_div em">
                    <div class="field_wrap">
                        <input type="text" name="pix_extra_button_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_extra_button_fontsize'); ?>">
                        <div class="slider_cursor"></div>
                    </div>
                    <span class="alignleft code_wrapper_lg"><code>em</code></span>
                </div><!-- .slider_div -->

                <div class="clear less_space"></div>

                <div class="tip_info_wrap"></div>

                <div class="clear less_space"></div>

                <label for="pix_button_footer">Use the same colors for the footer</label>
                <input type="hidden" name="pix_button_footer" value="0">
                <input type="checkbox" name="pix_button_footer" data-panel="footer" value="true" <?php checked(pix_esc_option('pix_button_footer'),'true'); ?>>

                <div class="clear less_space"></div>

                <div class="button_other_colors pix_groupped hidden_div" data-panel="target_footer">

                    <div class="clear more_space"></div>
                    <label for="pix_tiny_footer_button">Tiny button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_footer_tiny_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_footer_tiny_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_footer_tiny_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_footer_tiny_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_footer_tiny_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_footer_tiny_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview tiny"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear more_space"></div>
                    <label for="pix_footer_simple_button">Simple button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_footer_simple_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_footer_simple_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_footer_simple_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_footer_simple_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_footer_simple_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_footer_simple_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear more_space"></div>
                    <label for="pix_footer_first_color_button">First color button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_footer_first_color_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_footer_first_color_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_footer_first_color_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_footer_first_color_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_footer_first_color_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_footer_first_color_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear more_space"></div>
                    <label for="pix_footer_second_color_button">Second color button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_footer_second_color_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_footer_second_color_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_footer_second_color_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_footer_second_color_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_footer_second_color_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_footer_second_color_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear more_space"></div>
                    <label for="pix_footer_third_color_button">Third color button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_footer_third_color_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_footer_third_color_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_footer_third_color_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_footer_third_color_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_footer_third_color_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_footer_third_color_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear less_space"></div>

                </div>

                <div class="clear less_space"></div>

                <div class="tip_info_wrap"></div>

                <div class="clear less_space"></div>

                <label for="pix_button_aside">Use the same colors for the sidebars</label>
                <input type="hidden" name="pix_button_aside" value="0">
                <input type="checkbox" name="pix_button_aside" data-panel="aside" value="true" <?php checked(pix_esc_option('pix_button_aside'),'true'); ?>>

                <div class="clear less_space"></div>

                <div class="button_other_colors pix_groupped hidden_div" data-panel="target_aside">

                    <div class="clear more_space"></div>
                    <label for="pix_tiny_footer_button">Tiny button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_aside_tiny_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_aside_tiny_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_aside_tiny_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_aside_tiny_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_aside_tiny_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_aside_tiny_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview tiny"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear more_space"></div>
                    <label for="pix_aside_simple_button">Simple button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_aside_simple_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_aside_simple_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_aside_simple_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_aside_simple_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_aside_simple_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_aside_simple_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear more_space"></div>
                    <label for="pix_aside_first_color_button">First color button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_aside_first_color_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_aside_first_color_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_aside_first_color_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_aside_first_color_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_aside_first_color_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_aside_first_color_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear more_space"></div>
                    <label for="pix_aside_second_color_button">Second color button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_aside_second_color_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_aside_second_color_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_aside_second_color_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_aside_second_color_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_aside_second_color_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_aside_second_color_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear more_space"></div>
                    <label for="pix_aside_third_color_button">Third color button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_aside_third_color_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_aside_third_color_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_aside_third_color_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_aside_third_color_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_aside_third_color_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_aside_third_color_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear less_space"></div>
                </div>

                <div class="clear less_space"></div>

                <div class="tip_info_wrap"></div>

                <div class="clear less_space"></div>

                <label for="pix_button_slidaside">Use the same colors for the sliding sidebars</label>
                <input type="hidden" name="pix_button_slidaside" value="0">
                <input type="checkbox" name="pix_button_slidaside" data-panel="slidaside" value="true" <?php checked(pix_esc_option('pix_button_slidaside'),'true'); ?>>

                <div class="clear less_space"></div>

                <div class="button_other_colors pix_groupped hidden_div" data-panel="target_slidaside">

                    <div class="clear more_space"></div>
                    <label for="pix_tiny_footer_button">Tiny button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_slidaside_tiny_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_slidaside_tiny_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_slidaside_tiny_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_slidaside_tiny_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_slidaside_tiny_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_slidaside_tiny_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview tiny"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear more_space"></div>
                    <label for="pix_slidaside_simple_button">Simple button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_slidaside_simple_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_slidaside_simple_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_slidaside_simple_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_slidaside_simple_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_slidaside_simple_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_slidaside_simple_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear more_space"></div>
                    <label for="pix_slidaside_first_color_button">First color button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_slidaside_first_color_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_slidaside_first_color_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_slidaside_first_color_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_slidaside_first_color_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_slidaside_first_color_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_slidaside_first_color_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear more_space"></div>
                    <label for="pix_slidaside_second_color_button">Second color button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_slidaside_second_color_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_slidaside_second_color_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_slidaside_second_color_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_slidaside_second_color_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_slidaside_second_color_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_slidaside_second_color_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear more_space"></div>
                    <label for="pix_slidaside_third_color_button">Third color button</label>
                        <div class="pix_create_button">
                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Background color</em><br>
                                <input name="pix_slidaside_third_color_button_bg" class="pix_buttons_bg" type="text" value="<?php echo pix_esc_option('pix_slidaside_third_color_button_bg'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="field_wrap pix_color_picker alignleft block_small">
                                <em>Text color</em><br>
                                <input name="pix_slidaside_third_color_button_textcolor" class="pix_buttons_textcolor" type="text" value="<?php echo pix_esc_option('pix_slidaside_third_color_button_textcolor'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="field_wrap pix_color_picker alignleft">
                                <em>Border bottom color</em><br>
                                <input name="pix_slidaside_third_color_button_border" class="pix_buttons_border" type="text" value="<?php echo pix_esc_option('pix_slidaside_third_color_button_border'); ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>
                            
                            <div class="clear less_space"></div>

                            <div class="alignleft wrap_button_preview">
                                <div class="button_preview"><div class="select_font_preview">Button preview</div></div>
                                <div class="clear more_space"></div>
                                <small><em><strong>N.B.</strong>The size of the button and the font family could not reflect the real size on the front-end</em></small>
                            </div>
                            
                            
                        </div><!-- .pix_create_button -->
                    
                    <div class="clear less_space"></div>

                </div>


        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>