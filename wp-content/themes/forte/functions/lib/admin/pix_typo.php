<?php

function general_typo(){
	global $options;
	if ($_GET['page']=='general_typo') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Typography: <small>general typography</small>
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
                      
                <label class="title_label">Primary font</label>
                <label for="pix_general_fontfamily">Selector: <code>body</code></label>
                <div class="pix_groupped">
                    <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_general_fontfamily&subsets=pix_general_fontsubsets">
                        <div class="for_the_loader">
                        	<a href="#" class="load_fonts_button">Load the Google fonts</a>
                            <div class="field_wrap dynamic_box">
                                <div class="alignleft">
                                    <em>Font family</em><br>
                                    <select name="pix_general_fontfamily" class="main_list select_family_only">
                                        <option value="<?php echo pix_esc_option('pix_general_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_general_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_general_fontfamily')); ?></option>
                                    </select>
                                </div>
                                <div class="clear more_space"></div>
                                <em>Font subset</em><br>
                                <input type="hidden" name="pix_general_fontsubsets" value="<?php echo pix_esc_option('pix_general_fontsubsets'); ?>" class="select_subsets_fake">
                                <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_general_fontfamily')); ?>">
                                    <?php $subsets = explode(',',pix_esc_option('pix_general_fontsubsets'));
                                    foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                    <option><?php echo $subset; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clear less_space"></div>
                    <div class="slider_div">
                        <div class="field_wrap">
                        	<em>Font size</em><br>
                        	<input type="text" name="pix_general_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_general_fontsize'); ?>">
                        </div>
                        <span class="alignleft code_wrapper_lg"><code>px</code></span>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->

                    <div class="font_preview_wrap">
                        <div class="select_font_preview">Regular <strong>Bold</strong> <em>Italic</em> <strong><em>BoldItalic</em></strong></div>
                        <div class="select_font_info"></div>
                    </div>
                </div>

                <div class="clear"></div>
                <div class="tip_info_wrap">
                	<small class="tip_info">Try to use a font that looks fine with all the variants: normal and bold weight, regular and italic style</small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                    	<div class="open_info">info</div>
                    	<div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
            
                <label for="pix_general_text_color">Text color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_general_text_color" type="text" value="<?php echo pix_esc_option('pix_general_text_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                                      
                <label for="pix_general_link_color">Color of the links:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_general_link_color" type="text" value="<?php echo pix_esc_option('pix_general_link_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <label for="pix_general_highlighted_color">Highlighted text color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_general_highlighted_color" type="text" value="<?php echo pix_esc_option('pix_general_highlighted_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                
                <label class="title_label">Secondary font</label>
                <label for="pix_secondary_fontfamily">Selector: <code>.pix_tweet_sc .screen_name, .pix_tweet_sc .name, .pix_price_price, .pix_price_small</code></label>
                <div class="pix_groupped">
                    <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_secondary_fontfamily&subsets=pix_secondary_fontsubsets">
                        <div class="for_the_loader">
                        	<a href="#" class="load_fonts_button">Load the Google fonts</a>
                            <div class="field_wrap dynamic_box">
                                <div class="alignleft">
                                    <em>Font family</em><br>
                                    <select name="pix_secondary_fontfamily" class="main_list select_family_only">
                                        <option value="<?php echo pix_esc_option('pix_secondary_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_secondary_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_secondary_fontfamily')); ?></option>
                                    </select>
                                </div>
                                <div class="clear more_space"></div>
                                <em>Font subset</em><br>
                                <input type="hidden" name="pix_secondary_fontsubsets" value="<?php echo pix_esc_option('pix_secondary_fontsubsets'); ?>" class="select_subsets_fake">
                                <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_secondary_fontfamily')); ?>">
                                    <?php $subsets = explode(',',pix_esc_option('pix_secondary_fontsubsets'));
                                    foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                    <option><?php echo $subset; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="" class="font_size" value="<?php echo pix_esc_option('pix_general_fontsize'); ?>">

                    <div class="font_preview_wrap">
                        <div class="select_font_preview">Regular <strong>Bold</strong> <em>Italic</em> <strong><em>BoldItalic</em></strong></div>
                        <div class="select_font_info"></div>
                    </div>
                </div>

                <div class="clear"></div>
                <div class="tip_info_wrap">
                	<small class="tip_info">Try to use a font that looks fine with all the variants: normal and bold weight, regular and italic style</small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                    	<div class="open_info">info</div>
                    	<div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
            
                <label for="pix_headinghover_bg">Background color for the headings that contain a link:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_headinghover_bg" type="text" value="<?php echo pix_esc_option('pix_headinghover_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

        <input type="hidden" name="action" value="data_save" />
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>" />
        <input type="submit" class="hidden_div" value="" />
            </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>