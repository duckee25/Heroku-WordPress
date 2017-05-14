<?php

function blog_archive(){
	global $options;
	if ($_GET['page']=='blog_archive') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Blog: <small>archive pages</small>
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

                <label for="pix_archive_layout">Archive page layout:</label>
                <div class="field_wrap">
                    <select name="pix_archive_layout">
                        <option value="default" <?php selected( pix_esc_option('pix_archive_layout'), 'default' ); ?>>Two columns wide thumb (16:9) + floating text</option>
                        <option value="first" <?php selected( pix_esc_option('pix_archive_layout'), 'first' ); ?>>Two columns wide thumb (4:3) + floating text</option>
                        <option value="second" <?php selected( pix_esc_option('pix_archive_layout'), 'second' ); ?>>One column wide thumb (16:9) + floating text</option>
                        <option value="third" <?php selected( pix_esc_option('pix_archive_layout'), 'third' ); ?>>One column wide thumb (4:3) + floating text</option>
                        <option value="fourth" <?php selected( pix_esc_option('pix_archive_layout'), 'fourth' ); ?>>Three columns wide thumb + floating text</option>
                        <option value="fifth" <?php selected( pix_esc_option('pix_archive_layout'), 'fifth' ); ?>>Four columns wide thumb + floating text</option>
                        <option value="sixth" <?php selected( pix_esc_option('pix_archive_layout'), 'sixth' ); ?>>Grid of one colum wide thumbs</option>
                        <option value="sixth_bis" <?php selected( pix_esc_option('pix_archive_layout'), 'sixth_bis' ); ?>>Grid of one colum wide thumbs (masonry)</option>
                        <option value="seventh" <?php selected( pix_esc_option('pix_archive_layout'), 'seventh' ); ?>>Grid of two columns wide thumbs (4:3)</option>
                        <option value="seventh_bis" <?php selected( pix_esc_option('pix_archive_layout'), 'seventh_bis' ); ?>>Grid of two columns wide thumbs (4:3, masonry)</option>
                        <option value="eighth" <?php selected( pix_esc_option('pix_archive_layout'), 'eighth' ); ?>>Grid of two columns wide thumbs (16:9)</option>
                        <option value="eighth_bis" <?php selected( pix_esc_option('pix_archive_layout'), 'eighth_bis' ); ?>>Grid of two columns wide thumbs (16:9, masonry)</option>
                        <option value="ninth" <?php selected( pix_esc_option('pix_archive_layout'), 'ninth' ); ?>>Wall of 4:3 thumbs</option>
                        <option value="tenth" <?php selected( pix_esc_option('pix_archive_layout'), 'tenth' ); ?>>Wall of 16:9 thumbs</option>
                    </select>
                </div>

                <label for="pix_archive_template">Archive page template:</label>
                <div class="field_wrap">
                    <select name="pix_archive_template">
                        <option value="default" <?php selected( pix_esc_option('pix_archive_template'), 'default' ); ?>>Default</option>
                        <option value="widepage" <?php selected( pix_esc_option('pix_archive_template'), 'widepage' ); ?>>Wide page</option>
                    </select>
                </div>

                <label for="pix_archive_sidebar">Archive page sidebar:</label>
                <div class="field_wrap">
                    <select name="pix_archive_sidebar">
                        <option value="forte_default_sidebar" <?php selected( pix_esc_option('pix_archive_sidebar'), 'forte_default_sidebar' ); ?>>Forte default sidebar</option>
						<?php
                        $get_sidebar_options = sidebar_generator_pix::get_sidebars();
                        if($get_sidebar_options != "") {
                        $i=1;
							foreach ($get_sidebar_options as $sidebar_gen) { ?>                        
									<option value="<?php echo $sidebar_gen; ?>" <?php selected( pix_esc_option('pix_archive_sidebar'), $sidebar_gen ); ?>><?php echo $sidebar_gen; ?></option>
							<?php $i++;  
							}
                        }
                        ?>
                    </select>
                </div>

                <label for="pix_archive_filter">Display the sorting bar on the archive pages:</label>
                <input type="hidden" name="pix_archive_filter" value="0">
                <input type="checkbox" name="pix_archive_filter" value="true" <?php if(pix_esc_option('pix_archive_filter')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_archive_order">Display the &quot;Order&quot; filter on the archive pages:</label>
                <input type="hidden" name="pix_archive_order" value="0">
                <input type="checkbox" name="pix_archive_order" value="true" <?php if(pix_esc_option('pix_archive_order')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_archive_sort">Display the &quot;Sort by tag&quot; filter on the archive pages:</label>
                <input type="hidden" name="pix_archive_sort" value="0">
                <input type="checkbox" name="pix_archive_sort" value="true" <?php if(pix_esc_option('pix_archive_sort')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <div class="slider_div border">
                                        
                    <label for="pix_archive_ppp">Amount of posts per page:</label>
                    <div class="field_wrap">
                        <input type="text" name="pix_archive_ppp" value="<?php echo pix_get_option('pix_archive_ppp'); ?>">
                    </div>
                    <div class="slider_cursor"></div>
                
                </div><!-- .slider_div -->    
           
                <div class="clear"></div>
                
                <label for="pix_archive_titles">Display the titles of the posts:</label>
                <input type="hidden" name="pix_archive_titles" value="0">
                <input type="checkbox" name="pix_archive_titles" value="true" <?php if(pix_esc_option('pix_archive_titles')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <div class="slider_div border">
                                        
                    <label for="pix_archive_excerpt_length">Amount of lines for the excerpts:</label>
                    <div class="field_wrap">
                        <input type="text" name="pix_archive_excerpt_length" value="<?php echo pix_get_option('pix_archive_excerpt_length'); ?>">
                    </div>
                    <div class="slider_cursor"></div>
                
                </div><!-- .slider_div -->    
    
                <label for="pix_archive_more">Display the &quot;Read more&quot; link:</label>
                <input type="hidden" name="pix_archive_more" value="0">
                <input type="checkbox" name="pix_archive_more" value="true" <?php if(pix_esc_option('pix_archive_more')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_archive_like">Display the &quot;Like&quot; button:</label>
                <div class="field_wrap">
                    <select name="pix_archive_like">
                        <option value="" <?php selected( pix_esc_option('pix_archive_like'), '' ); ?>>Inherit</option>
                        <option value="true" <?php selected( pix_esc_option('pix_archive_like'), 'true' ); ?>>Yes</option>
                        <option value="false" <?php selected( pix_esc_option('pix_archive_like'), 'false' ); ?>>No</option>
                    </select>
                </div>

                <div class="clear"></div>
                
                <label for="pix_archive_meta">Display the meta info (categories, author):</label>
                <input type="hidden" name="pix_archive_meta" value="0">
                <input type="checkbox" name="pix_archive_meta" value="true" <?php if(pix_esc_option('pix_archive_meta')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_archive_comments">Display the amount of comments:</label>
                <input type="hidden" name="pix_archive_comments" value="0">
                <input type="checkbox" name="pix_archive_comments" value="true" <?php if(pix_esc_option('pix_archive_comments')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_archive_linkto">Link the pictures to the posts or open in a ColorBox:</label>
                <div class="field_wrap">
                    <select name="pix_archive_linkto">
                        <option value="colorbox" <?php selected( pix_esc_option('pix_archive_linkto'), 'colorbox' ); ?>>ColorBox</option>
                        <option value="page" <?php selected( pix_esc_option('pix_archive_linkto'), 'page' ); ?>>Posts</option>
                        <option value="none" <?php selected( pix_esc_option('pix_archive_linkto'), 'none' ); ?>>None</option>
                    </select>
                </div>
                
                <div class="clear"></div>
                
                <label for="pix_archive_pagenavi">Page navigation:</label>
                <div class="field_wrap">
                    <select name="pix_archive_pagenavi">
                        <option value="" <?php selected( pix_esc_option('pix_archive_pagenavi'), '' ); ?>>Page numbers</option>
                        <option value="infinite" <?php selected( pix_esc_option('pix_archive_pagenavi'), 'infinite' ); ?>>Infinite scroll button</option>
                    </select>
                </div>

            	<label for="pix_archive_metatitle">Meta title:</label>
                <div class="field_wrap"><input name="pix_archive_metatitle" type="text" class="pix_title_seo" value="<?php echo pix_esc_option('pix_archive_metatitle'); ?>"></div>

            	<label for="pix_archive_metadescription">Meta description:</label>
                <div class="field_wrap"><input name="pix_archive_metadescription" type="text" class="pix_desc_seo" value="<?php echo pix_esc_option('pix_archive_metadescription'); ?>"></div>
                           
             	<label for="pix_archive_metakeys">Meta keywords</label>
                <div class="field_wrap"><textarea name="pix_archive_metakeys"><?php echo pix_esc_option('pix_archive_metakeys'); ?></textarea></div>
           
        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>