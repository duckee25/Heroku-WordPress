<?php

function nav_section(){
	global $options;
	if ($_GET['page']=='nav_section') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	General: <small>navigation menu</small>
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
                    <small class="tip_info">What's that? <a href="http://www.pixedelic.com/forte_support_images/navigation.jpg" class="colorbox">Click here</a></small>
                </div>
                <div class="clear"></div>

                <label for="pix_nav_1stlevel">Selector: <code>nav > div > ul > li</code></label>
                <div class="pix_groupped">
                    <?php if (pix_get_option('pix_enable_google')=='true') { ?>
                    <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_nav_1stlevel_fontfamily&variants=pix_nav_1stlevel_fontvariants&subsets=pix_nav_1stlevel_fontsubsets">
                        <div class="for_the_loader">
                        	<a href="#" class="load_fonts_button">Load the Google fonts</a>
                            <div class="field_wrap dynamic_box">
                                <div class="alignleft">
                                    <em>Font family</em><br>
                                    <select name="pix_nav_1stlevel_fontfamily" class="main_list">
                                        <option value="<?php echo pix_esc_option('pix_nav_1stlevel_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_nav_1stlevel_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_nav_1stlevel_fontfamily')); ?></option>
                                    </select>
                                </div>
                                <div class="alignleft block_small">
                                    <em>Font variant</em><br>
                                    <input type="hidden" name="pix_nav_1stlevel_fontvariants" value="<?php echo pix_esc_option('pix_nav_1stlevel_fontvariants'); ?>" class="select_variants_fake">
                                    <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_nav_1stlevel_fontfamily')); ?>">
                                        <option><?php echo pix_esc_option('pix_nav_1stlevel_fontvariants'); ?></option>
                                    </select>
                                </div>
                                <div class="clear more_space"></div>
                                <em>Font subset</em><br>
                                <input type="hidden" name="pix_nav_1stlevel_fontsubsets" value="<?php echo pix_esc_option('pix_nav_1stlevel_fontsubsets'); ?>" class="select_subsets_fake">
                                <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_nav_1stlevel_fontfamily')); ?>">
                                    <?php $subsets = explode(',',pix_esc_option('pix_nav_1stlevel_fontsubsets'));
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
                        	<input type="text" name="pix_nav_1stlevel_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_nav_1stlevel_fontsize'); ?>">
                        </div>
                        <span class="alignleft code_wrapper_lg"><code>px</code></span>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->

                    <div class="font_preview_wrap">
                        <div class="select_font_preview">First level menu</div>
                        <div class="select_font_info"></div>
                    </div>
                </div>


                <label for="pix_nav_1stcolor">Text color of the first level menu:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_1stcolor" type="text" value="<?php echo pix_esc_option('pix_nav_1stcolor'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_nav_1sthover">Text color of the first level menu (hover state):</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_1sthover" type="text" value="<?php echo pix_esc_option('pix_nav_1sthover'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_nav_1sthover_bg">Background color of the first level menu (hover state):</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_1sthover_bg" type="text" value="<?php echo pix_esc_option('pix_nav_1sthover_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_nav_1sthover_bg_opacity">Opacity of the background color:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap"><input type="text" name="pix_nav_1sthover_bg_opacity" value="<?php echo pix_esc_option('pix_nav_1sthover_bg_opacity'); ?>"></div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label for="pix_nav_1sthover_indicator">Color of the first level menu border bottom (hover state):</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_1sthover_indicator" type="text" value="<?php echo pix_esc_option('pix_nav_1sthover_indicator'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_nav_1scurrent">Color of the current-page item:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_1scurrent" type="text" value="<?php echo pix_esc_option('pix_nav_1scurrent'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_nav_current_bg">Background color of the current-page item:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_current_bg" type="text" value="<?php echo pix_esc_option('pix_nav_current_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_nav_current_bg_opacity">Opacity of the background color:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap"><input type="text" name="pix_nav_current_bg_opacity" value="<?php echo pix_esc_option('pix_nav_current_bg_opacity'); ?>"></div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label for="pix_nav_current_indicator">Color of the current-page indicator and border bottom:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_current_indicator" type="text" value="<?php echo pix_esc_option('pix_nav_current_indicator'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <div class="clear less_space"></div>

                <label for="pix_nav_button">Drop/down button text color (responsive menu)</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_button" type="text" value="<?php echo pix_esc_option('pix_nav_button'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <label for="pix_nav_button_bg">Drop/down button background color (responsive menu)</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_button_bg" type="text" value="<?php echo pix_esc_option('pix_nav_button_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <label for="pix_nav_button_border">Drop/down button border color (responsive menu)</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_button_border" type="text" value="<?php echo pix_esc_option('pix_nav_button_border'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                                
                <label for="pix_nav_2ndlevel">Second level menu font. Selector: <code>nav > div > ul > li > ul, nav > div > ul > li li > ul, nav > div > ul > li > div</code></label>
                <div class="pix_groupped">
                    <?php if (pix_get_option('pix_enable_google')=='true') { ?>
                    <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_nav_2ndlevel_fontfamily&variants=pix_nav_2ndlevel_fontvariants&subsets=pix_nav_2ndlevel_fontsubsets">
                        <div class="for_the_loader">
                        	<a href="#" class="load_fonts_button">Load the Google fonts</a>
                            <div class="field_wrap dynamic_box">
                                <div class="alignleft">
                                    <em>Font family</em><br>
                                    <select name="pix_nav_2ndlevel_fontfamily" class="main_list">
                                        <option value="<?php echo pix_esc_option('pix_nav_2ndlevel_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_nav_2ndlevel_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_nav_2ndlevel_fontfamily')); ?></option>
                                    </select>
                                </div>
                                <div class="alignleft block_small">
                                    <em>Font variant</em><br>
                                    <input type="hidden" name="pix_nav_2ndlevel_fontvariants" value="<?php echo pix_esc_option('pix_nav_2ndlevel_fontvariants'); ?>" class="select_variants_fake">
                                    <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_nav_2ndlevel_fontfamily')); ?>">
                                        <option><?php echo pix_esc_option('pix_nav_2ndlevel_fontvariants'); ?></option>
                                    </select>
                                </div>
                                <div class="clear more_space"></div>
                                <em>Font subset</em><br>
                                <input type="hidden" name="pix_nav_2ndlevel_fontsubsets" value="<?php echo pix_esc_option('pix_nav_2ndlevel_fontsubsets'); ?>" class="select_subsets_fake">
                                <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_nav_2ndlevel_fontfamily')); ?>">
                                    <?php $subsets = explode(',',pix_esc_option('pix_nav_2ndlevel_fontsubsets'));
                                    foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                    <option><?php echo $subset; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clear less_space"></div>
                    <?php } ?>
                    <div class="slider_div">
                        <div class="field_wrap">
                        	<em>Font size</em><br>
                        	<input type="text" name="pix_nav_2ndlevel_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_nav_2ndlevel_fontsize'); ?>">
                        </div>
                        <span class="alignleft code_wrapper_lg"><code>px</code></span>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->

                    <div class="font_preview_wrap">
                        <div class="select_font_preview">First level menu</div>
                        <div class="select_font_info"></div>
                    </div>
                </div>

                <label for="pix_nav_2ndcolor">Text color of the second level menu:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_2ndcolor" type="text" value="<?php echo pix_esc_option('pix_nav_2ndcolor'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_nav_megatitles">Text color of the megamenu titles:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_megatitles" type="text" value="<?php echo pix_esc_option('pix_nav_megatitles'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_nav_2ndbg">Background of the second level menu:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_2ndbg" type="text" value="<?php echo pix_esc_option('pix_nav_2ndbg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_dropdown_2ndbgopacity">Opacity of the background color:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap"><input type="text" name="pix_dropdown_2ndbgopacity" value="<?php echo pix_esc_option('pix_dropdown_2ndbgopacity'); ?>"></div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label for="pix_nav_2ndhover">Text color of the second level links (hover state):</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_2ndhover" type="text" value="<?php echo pix_esc_option('pix_nav_2ndhover'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_nav_2ndhover_bg">Background color of the second level links (hover state):</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_2ndhover_bg" type="text" value="<?php echo pix_esc_option('pix_nav_2ndhover_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_nav_2ndhover_border">Border color of the second level links (hover state):</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_nav_2ndhover_border" type="text" value="<?php echo pix_esc_option('pix_nav_2ndhover_border'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_mega_separator_color">Separator background color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_mega_separator_color" type="text" value="<?php echo pix_esc_option('pix_mega_separator_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label for="pix_mega_separator_opacity">Separator opacity:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap">
                        <input type="text" name="pix_mega_separator_opacity" value="<?php echo pix_esc_option('pix_mega_separator_opacity'); ?>">
                    </div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->


        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>