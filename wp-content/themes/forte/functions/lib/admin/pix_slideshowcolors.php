<?php

function slideshow_colors(){
	global $options;
	if ($_GET['page']=='slideshow_colors') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Slideshows: <small>colors</small>
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

                <label for="pix_slideshow_commands_color">Color of the commands:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slideshow_commands_color" type="text" value="<?php echo pix_esc_option('pix_slideshow_commands_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>
                
                <label for="pix_slideshow_pie_bg">Pie loader background color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slideshow_pie_bg" type="text" value="<?php echo pix_esc_option('pix_slideshow_pie_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>
                
                <label for="pix_slideshow_pie_stroke">Pie loader stroke color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_slideshow_pie_stroke" type="text" value="<?php echo pix_esc_option('pix_slideshow_pie_stroke'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>
                
                <label>Caption:</label>
				<div class="pix_groupped">
                	<div class="alignleft">
                        <div class="field_wrap pix_color_picker">
                            <em>Background color:</em><br>
                            <input name="pix_slideshow_caption_bg" type="text" value="<?php echo pix_esc_option('pix_slideshow_caption_bg'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>
                    </div>
                    
                    <div class="alignleft vert_separator"></div>

                    <div class="slider_div opacity alignleft">
                        <div class="field_wrap">
                            <em>Background opacity:</em><br>
                            <input type="text" name="pix_slideshow_caption_bg_opacity" value="<?php echo pix_esc_option('pix_slideshow_caption_bg_opacity'); ?>">
                        </div>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->
                                        
                    <div class="clear more_space"></div>
                    
                	<div class="alignleft">
                        <div class="field_wrap pix_color_picker">
                            <em>Text color:</em><br>
                            <input name="pix_slideshow_caption_color" type="text" value="<?php echo pix_esc_option('pix_slideshow_caption_color'); ?>">
                            <div class="pix_palette"></div>
                            <div class="colorpicker"></div>
                        </div>
                    </div>
                                                            
                    <div class="clear more_space"></div>

                    <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_slideshow_caption_fontfamily&subsets=pix_slideshow_caption_fontsubsets">
                        <div class="for_the_loader">
                            <a href="#" class="load_fonts_button">Load the Google fonts</a>
                            <div class="field_wrap dynamic_box">
                                <div class="alignleft">
                                    <em>Font family</em><br>
                                    <select name="pix_slideshow_caption_fontfamily" class="main_list">
                                        <option value="<?php echo pix_esc_option('pix_slideshow_caption_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_slideshow_caption_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_slideshow_caption_fontfamily')); ?></option>
                                    </select>
                                </div>
                                
                                <div class="clear less_space"></div>
                                
                                <em>Font subset</em><br>
                                <input type="hidden" name="pix_slideshow_caption_fontsubsets" value="<?php echo pix_esc_option('pix_slideshow_caption_fontsubsets'); ?>" class="select_subsets_fake">
                                <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_slideshow_caption_fontfamily')); ?>">
                                    <?php $subsets = explode(',',pix_esc_option('pix_slideshow_caption_fontsubsets'));
                                    foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                    <option><?php echo $subset; ?></option>
                                    <?php }} ?>
                                </select>

                            </div>
                        </div>
    
                        <div class="font_preview_wrap">
                            <div class="select_font_preview">Caption text</div>
                            <div class="select_font_info"></div>
                        </div>
                    </div>
                </div><!-- .pix_groupped -->
                                
                
        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>