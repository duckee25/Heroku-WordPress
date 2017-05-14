<?php

function pagenavi_colors(){
	global $options;
	if ($_GET['page']=='pagenavi_colors') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Colors: <small>pagenavi</small>
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

            	<label class="title_label">Page navigation font family</label>
                
                <label for="pix_pagenavi_fontfamily">Selector: <code>.pagenavi</code></label>
                <div class="pix_groupped">
                    <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_pagenavi_fontfamily&variants=pix_pagenavi_fontvariants&subsets=pix_pagenavi_fontsubsets">
                        <div class="for_the_loader">
                        	<a href="#" class="load_fonts_button">Load the Google fonts</a>
                            <div class="field_wrap dynamic_box">
                                <div class="alignleft">
                                    <em>Font family</em><br>
                                    <select name="pix_pagenavi_fontfamily" class="main_list">
                                        <option value="<?php echo pix_esc_option('pix_pagenavi_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_pagenavi_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_pagenavi_fontfamily')); ?></option>
                                    </select>
                                </div>
                                <div class="alignleft block_small">
                                    <em>Font variant</em><br>
                                    <input type="hidden" name="pix_pagenavi_fontvariants" value="<?php echo pix_esc_option('pix_pagenavi_fontvariants'); ?>" class="select_variants_fake">
                                    <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_pagenavi_fontfamily')); ?>">
                                        <option><?php echo pix_esc_option('pix_pagenavi_fontvariants'); ?></option>
                                    </select>
                                </div>
                                <div class="clear more_space"></div>
                                <em>Font subset</em><br>
                                <input type="hidden" name="pix_pagenavi_fontsubsets" value="<?php echo pix_esc_option('pix_pagenavi_fontsubsets'); ?>" class="select_subsets_fake">
                                <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_pagenavi_fontfamily')); ?>">
                                    <?php $subsets = explode(',',pix_esc_option('pix_pagenavi_fontsubsets'));
                                    foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                    <option><?php echo $subset; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                        <div class="clear less_space"></div>
                        <div class="slider_div">
                            <div class="field_wrap">
                            	<em>Font size</em><br>
                            	<input type="text" name="pix_pagenavi_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_pagenavi_fontsize'); ?>">
                            </div>
                            <span class="alignleft code_wrapper_lg"><code>px</code></span>
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->

                        <div class="font_preview_wrap">
                            <div class="select_font_preview">1&nbsp;&nbsp;2&nbsp;&nbsp;3&nbsp;&nbsp;4&nbsp;&nbsp;5&nbsp;&nbsp;6&nbsp;&nbsp;7&nbsp;&nbsp;8&nbsp;&nbsp;9&nbsp;&nbsp;</div>
                            <div class="select_font_info"></div>
                        </div>
                    </div>
                </div>

                <label for="pix_pagenavi_current_color">Text color of the current page number:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_pagenavi_current_color" type="text" value="<?php echo pix_esc_option('pix_pagenavi_current_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>

                <label for="pix_pagenavi_current_bg">Background color of the current page number:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_pagenavi_current_bg" type="text" value="<?php echo pix_esc_option('pix_pagenavi_current_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>

                <label for="pix_pagenavi_link_color">Text color of the other page numbers:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_pagenavi_link_color" type="text" value="<?php echo pix_esc_option('pix_pagenavi_link_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>


        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>