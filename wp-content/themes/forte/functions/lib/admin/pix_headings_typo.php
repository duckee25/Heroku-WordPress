<?php

function headings_typo(){
	global $options;
	if ($_GET['page']=='headings_typo') { 
	
	echo $_SESSION['pix_h1_color'];
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Typography: <small>headings</small>
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
                      
                <label class="title_label">Heading 1</label>
                <label for="pix_h1_fontfamily">Selector: <code>h1</code></label>
                <div class="pix_groupped">
                    <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_h1_fontfamily&variants=pix_h1_fontvariants&subsets=pix_h1_fontsubsets">
                        <div class="for_the_loader">
                        	<a href="#" class="load_fonts_button">Load the Google fonts</a>
                            <div class="field_wrap dynamic_box">
                                <div class="alignleft">
                                    <em>Font family</em><br>
                                    <select name="pix_h1_fontfamily" class="main_list">
                                        <option value="<?php echo pix_esc_option('pix_h1_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_h1_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_h1_fontfamily')); ?></option>
                                    </select>
                                </div>
                                <div class="alignleft block_small">
                                    <em>Font variant</em><br>
                                    <input type="hidden" name="pix_h1_fontvariants" value="<?php echo pix_esc_option('pix_h1_fontvariants'); ?>" class="select_variants_fake">
                                    <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_h1_fontfamily')); ?>">
                                        <option><?php echo pix_esc_option('pix_h1_fontvariants'); ?></option>
                                    </select>
                                </div>
                                <div class="clear more_space"></div>
                                <em>Font subset</em><br>
                                <input type="hidden" name="pix_h1_fontsubsets" value="<?php echo pix_esc_option('pix_h1_fontsubsets'); ?>" class="select_subsets_fake">
                                <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_h1_fontfamily')); ?>">
                                    <?php $subsets = explode(',',pix_esc_option('pix_h1_fontsubsets'));
                                    foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                    <option><?php echo $subset; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clear less_space"></div>
                    <div class="slider_div em">
                        <div class="field_wrap">
                        	<em>Font size</em><br>
                        	<input type="text" name="pix_h1_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_h1_fontsize'); ?>">
                        </div>
                        <span class="alignleft code_wrapper_lg"><code>em</code></span>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->

                    <div class="font_preview_wrap">
                        <div class="select_font_preview em">Heading 1</div>
                        <div class="select_font_info"></div>
                    </div>
                </div>

                <label for="pix_h1_color">Heading 1 text color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_h1_color" type="text" value="<?php echo pix_esc_option('pix_h1_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label class="title_label">Heading 2</label>
                <label for="pix_h2_fontfamily">Selector: <code>h2</code></label>
                <div class="pix_groupped">
                    <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_h2_fontfamily&variants=pix_h2_fontvariants&subsets=pix_h2_fontsubsets">
                        <div class="for_the_loader">
                        	<a href="#" class="load_fonts_button">Load the Google fonts</a>
                            <div class="field_wrap dynamic_box">
                                <div class="alignleft">
                                    <em>Font family</em><br>
                                    <select name="pix_h2_fontfamily" class="main_list">
                                        <option value="<?php echo pix_esc_option('pix_h2_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_h2_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_h2_fontfamily')); ?></option>
                                    </select>
                                </div>
                                <div class="alignleft block_small">
                                    <em>Font variant</em><br>
                                    <input type="hidden" name="pix_h2_fontvariants" value="<?php echo pix_esc_option('pix_h2_fontvariants'); ?>" class="select_variants_fake">
                                    <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_h2_fontfamily')); ?>">
                                        <option><?php echo pix_esc_option('pix_h2_fontvariants'); ?></option>
                                    </select>
                                </div>
                                <div class="clear more_space"></div>
                                <em>Font subset</em><br>
                                <input type="hidden" name="pix_h2_fontsubsets" value="<?php echo pix_esc_option('pix_h2_fontsubsets'); ?>" class="select_subsets_fake">
                                <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_h2_fontfamily')); ?>">
                                    <?php $subsets = explode(',',pix_esc_option('pix_h2_fontsubsets'));
                                    foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                    <option><?php echo $subset; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clear less_space"></div>
                    <div class="slider_div em">
                        <div class="field_wrap">
                        	<em>Font size</em><br>
                        	<input type="text" name="pix_h2_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_h2_fontsize'); ?>">
                        </div>
                        <span class="alignleft code_wrapper_lg"><code>em</code></span>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->

                    <div class="font_preview_wrap">
                        <div class="select_font_preview em">Heading 2</div>
                        <div class="select_font_info"></div>
                    </div>
                </div>

                <label for="pix_h2_color">Heading 2 text color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_h2_color" type="text" value="<?php echo pix_esc_option('pix_h2_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label class="title_label">Heading 3</label>
                <label for="pix_h3_fontfamily">Selector: <code>h3</code></label>
                <div class="pix_groupped">
                    <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_h3_fontfamily&variants=pix_h3_fontvariants&subsets=pix_h3_fontsubsets">
                        <div class="for_the_loader">
                        	<a href="#" class="load_fonts_button">Load the Google fonts</a>
                            <div class="field_wrap dynamic_box">
                                <div class="alignleft">
                                    <em>Font family</em><br>
                                    <select name="pix_h3_fontfamily" class="main_list">
                                        <option value="<?php echo pix_esc_option('pix_h3_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_h3_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_h3_fontfamily')); ?></option>
                                    </select>
                                </div>
                                <div class="alignleft block_small">
                                    <em>Font variant</em><br>
                                    <input type="hidden" name="pix_h3_fontvariants" value="<?php echo pix_esc_option('pix_h3_fontvariants'); ?>" class="select_variants_fake">
                                    <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_h3_fontfamily')); ?>">
                                        <option><?php echo pix_esc_option('pix_h3_fontvariants'); ?></option>
                                    </select>
                                </div>
                                <div class="clear more_space"></div>
                                <em>Font subset</em><br>
                                <input type="hidden" name="pix_h3_fontsubsets" value="<?php echo pix_esc_option('pix_h3_fontsubsets'); ?>" class="select_subsets_fake">
                                <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_h3_fontfamily')); ?>">
                                    <?php $subsets = explode(',',pix_esc_option('pix_h3_fontsubsets'));
                                    foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                    <option><?php echo $subset; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                        <div class="clear less_space"></div>
                    </div>
                    <div class="slider_div em">
                        <div class="field_wrap">
                        	<em>Font size</em><br>
                        	<input type="text" name="pix_h3_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_h3_fontsize'); ?>">
                        </div>
                        <span class="alignleft code_wrapper_lg"><code>em</code></span>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->

                    <div class="font_preview_wrap">
                        <div class="select_font_preview em">Heading 3</div>
                        <div class="select_font_info"></div>
                    </div>
                </div>

                <label for="pix_h3_color">Heading 3 text color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_h3_color" type="text" value="<?php echo pix_esc_option('pix_h3_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label class="title_label">Heading 4</label>
                <label for="pix_h4_fontfamily">Selector: <code>h4</code></label>
                <div class="pix_groupped">
                    <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_h4_fontfamily&variants=pix_h4_fontvariants&subsets=pix_h4_fontsubsets">
                        <div class="for_the_loader">
                        	<a href="#" class="load_fonts_button">Load the Google fonts</a>
                            <div class="field_wrap dynamic_box">
                                <div class="alignleft">
                                    <em>Font family</em><br>
                                    <select name="pix_h4_fontfamily" class="main_list">
                                        <option value="<?php echo pix_esc_option('pix_h4_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_h4_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_h4_fontfamily')); ?></option>
                                    </select>
                                </div>
                                <div class="alignleft block_small">
                                    <em>Font variant</em><br>
                                    <input type="hidden" name="pix_h4_fontvariants" value="<?php echo pix_esc_option('pix_h4_fontvariants'); ?>" class="select_variants_fake">
                                    <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_h4_fontfamily')); ?>">
                                        <option><?php echo pix_esc_option('pix_h4_fontvariants'); ?></option>
                                    </select>
                                </div>
                                <div class="clear more_space"></div>
                                <em>Font subset</em><br>
                                <input type="hidden" name="pix_h4_fontsubsets" value="<?php echo pix_esc_option('pix_h4_fontsubsets'); ?>" class="select_subsets_fake">
                                <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_h4_fontfamily')); ?>">
                                    <?php $subsets = explode(',',pix_esc_option('pix_h4_fontsubsets'));
                                    foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                    <option><?php echo $subset; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clear less_space"></div>
                    <div class="slider_div em">
                        <div class="field_wrap">
                        	<em>Font size</em><br>
                        	<input type="text" name="pix_h4_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_h4_fontsize'); ?>">
                        </div>
                        <span class="alignleft code_wrapper_lg"><code>em</code></span>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->

                    <div class="font_preview_wrap">
                        <div class="select_font_preview em">Heading 4</div>
                        <div class="select_font_info"></div>
                    </div>
                </div>

                <label for="pix_h4_color">Heading 4 text color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_h4_color" type="text" value="<?php echo pix_esc_option('pix_h4_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label class="title_label">Heading 5</label>
                <label for="pix_h5_fontfamily">Selector: <code>h5</code></label>
                <div class="pix_groupped">
                    <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_h5_fontfamily&variants=pix_h5_fontvariants&subsets=pix_h5_fontsubsets">
                        <div class="for_the_loader">
                        	<a href="#" class="load_fonts_button">Load the Google fonts</a>
                            <div class="field_wrap dynamic_box">
                                <div class="alignleft">
                                    <em>Font family</em><br>
                                    <select name="pix_h5_fontfamily" class="main_list">
                                        <option value="<?php echo pix_esc_option('pix_h5_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_h5_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_h5_fontfamily')); ?></option>
                                    </select>
                                </div>
                                <div class="alignleft block_small">
                                    <em>Font variant</em><br>
                                    <input type="hidden" name="pix_h5_fontvariants" value="<?php echo pix_esc_option('pix_h5_fontvariants'); ?>" class="select_variants_fake">
                                    <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_h5_fontfamily')); ?>">
                                        <option><?php echo pix_esc_option('pix_h5_fontvariants'); ?></option>
                                    </select>
                                </div>
                                <div class="clear more_space"></div>
                                <em>Font subset</em><br>
                                <input type="hidden" name="pix_h5_fontsubsets" value="<?php echo pix_esc_option('pix_h5_fontsubsets'); ?>" class="select_subsets_fake">
                                <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_h5_fontfamily')); ?>">
                                    <?php $subsets = explode(',',pix_esc_option('pix_h5_fontsubsets'));
                                    foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                    <option><?php echo $subset; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clear less_space"></div>
                    <div class="slider_div em">
                        <div class="field_wrap">
                        	<em>Font size</em><br>
                        	<input type="text" name="pix_h5_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_h5_fontsize'); ?>">
                        </div>
                        <span class="alignleft code_wrapper_lg"><code>em</code></span>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->

                    <div class="font_preview_wrap">
                        <div class="select_font_preview em">Heading 5</div>
                        <div class="select_font_info"></div>
                    </div>
                </div>

                <label for="pix_h5_color">Heading 5 text color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_h5_color" type="text" value="<?php echo pix_esc_option('pix_h5_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>

                <label class="title_label">Heading 6</label>
                <label for="pix_h6_fontfamily">Selector: <code>h6</code></label>
                <div class="pix_groupped">
                    <div class="pix_font_select" data-select="<?php echo get_admin_url(); ?>/admin.php?page=google_font_list&name=pix_h6_fontfamily&variants=pix_h6_fontvariants&subsets=pix_h6_fontsubsets">
                        <div class="for_the_loader">
                        	<a href="#" class="load_fonts_button">Load the Google fonts</a>
                            <div class="field_wrap dynamic_box">
                                <div class="alignleft">
                                    <em>Font family</em><br>
                                    <select name="pix_h6_fontfamily" class="main_list">
                                        <option value="<?php echo pix_esc_option('pix_h6_fontfamily'); ?>" data-value="<?php echo sanitize_title(pix_esc_option('pix_h6_fontfamily')); ?>"><?php echo str_replace("+", " ", pix_esc_option('pix_h6_fontfamily')); ?></option>
                                    </select>
                                </div>
                                <div class="alignleft block_small">
                                    <em>Font variant</em><br>
                                    <input type="hidden" name="pix_h6_fontvariants" value="<?php echo pix_esc_option('pix_h6_fontvariants'); ?>" class="select_variants_fake">
                                    <select class="select_variants_fake" data-variant="<?php echo sanitize_title(pix_esc_option('pix_h6_fontfamily')); ?>">
                                        <option><?php echo pix_esc_option('pix_h6_fontvariants'); ?></option>
                                    </select>
                                </div>
                                <div class="clear more_space"></div>
                                <em>Font subset</em><br>
                                <input type="hidden" name="pix_h6_fontsubsets" value="<?php echo pix_esc_option('pix_h6_fontsubsets'); ?>" class="select_subsets_fake">
                                <select class="select_subsets_fake" multiple data-variant="<?php echo sanitize_title(pix_esc_option('pix_h6_fontfamily')); ?>">
                                    <?php $subsets = explode(',',pix_esc_option('pix_h6_fontsubsets'));
                                    foreach ( $subsets as $subset ) { if ($subset!='') { ?>
                                    <option><?php echo $subset; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clear less_space"></div>
                    <div class="slider_div em">
                        <div class="field_wrap">
                        	<em>Font size</em><br>
                        	<input type="text" name="pix_h6_fontsize" class="font_size" value="<?php echo pix_esc_option('pix_h6_fontsize'); ?>">
                        </div>
                        <span class="alignleft code_wrapper_lg"><code>em</code></span>
                        <div class="slider_cursor"></div>
                    </div><!-- .slider_div -->

                    <div class="font_preview_wrap">
                        <div class="select_font_preview em">Heading 6</div>
                        <div class="select_font_info"></div>
                    </div>
                </div>

                <label for="pix_h6_color">Heading 6 text color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_h6_color" type="text" value="<?php echo pix_esc_option('pix_h6_color'); ?>">
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