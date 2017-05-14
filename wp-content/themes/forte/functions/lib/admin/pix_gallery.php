<?php

function portfolio_gallery(){
	global $options;
	if ($_GET['page']=='portfolio_gallery') { 
	
	$term_slug = $_GET['gallery'];
	$term = get_term_by( 'slug', $term_slug, 'gallery' );
	$termID = $term->term_id;
	$pix_array_gallery = pix_get_option('pix_array_gallery_'.$termID);
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Portofolio: <small>&quot;<?php echo $term->name; ?>&quot; gallery</small>
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

                <label for="pix_array_gallery_<?php echo $termID; ?>[layout]">Gallery page layout:</label>
                <div class="field_wrap">
                    <select name="pix_array_gallery_<?php echo $termID; ?>[layout]">
                        <option value="default" <?php if(isset($pix_array_gallery['layout'])) { selected( $pix_array_gallery['layout'], 'default' ); } ?>>Two columns wide thumb (16:9) + floating text</option>
                        <option value="first" <?php if(isset($pix_array_gallery['layout'])) { selected( $pix_array_gallery['layout'], 'first' ); } ?>>Two columns wide thumb (4:3) + floating text</option>
                        <option value="second" <?php if(isset($pix_array_gallery['layout'])) { selected( $pix_array_gallery['layout'], 'second' ); } ?>>One column wide thumb (16:9) + floating text</option>
                        <option value="third" <?php if(isset($pix_array_gallery['layout'])) { selected( $pix_array_gallery['layout'], 'third' ); } ?>>One column wide thumb (4:3) + floating text</option>
                        <option value="fourth" <?php if(isset($pix_array_gallery['layout'])) { selected( $pix_array_gallery['layout'], 'fourth' ); } ?>>Three columns wide thumb + floating text</option>
                        <option value="fifth" <?php if(isset($pix_array_gallery['layout'])) { selected( $pix_array_gallery['layout'], 'fifth' ); } ?>>Four columns wide thumb + floating text</option>
                        <option value="sixth" <?php if(isset($pix_array_gallery['layout'])) { selected( $pix_array_gallery['layout'], 'sixth' ); } elseif (!isset($pix_array_gallery['layout'])) { echo 'selected'; } ?>>Grid of one colum wide thumbs</option>
                        <option value="sixth_bis" <?php if(isset($pix_array_gallery['layout'])) { selected( $pix_array_gallery['layout'], 'sixth_bis' ); } ?>>Grid of one colum wide thumbs (masonry)</option>
                        <option value="seventh" <?php if(isset($pix_array_gallery['layout'])) { selected( $pix_array_gallery['layout'], 'seventh' ); } ?>>Grid of two columns wide thumbs (4:3)</option>
                        <option value="seventh_bis" <?php if(isset($pix_array_gallery['layout'])) { selected( $pix_array_gallery['layout'], 'seventh_bis' ); } ?>>Grid of two columns wide thumbs (4:3, masonry)</option>
                        <option value="eighth" <?php if(isset($pix_array_gallery['layout'])) { selected( $pix_array_gallery['layout'], 'eighth' ); } ?>>Grid of two columns wide thumbs (16:9)</option>
                        <option value="eighth_bis" <?php if(isset($pix_array_gallery['layout'])) { selected( $pix_array_gallery['layout'], 'eighth_bis' ); } ?>>Grid of two columns wide thumbs (16:9, masonry)</option>
                        <option value="ninth" <?php if(isset($pix_array_gallery['layout'])) { selected( $pix_array_gallery['layout'], 'ninth' ); } ?>>Wall of 4:3 thumbs</option>
                        <option value="tenth" <?php if(isset($pix_array_gallery['layout'])) { selected( $pix_array_gallery['layout'], 'tenth' ); } ?>>Wall of 16:9 thumbs</option>
                    </select>
                </div>

                <label for="pix_array_gallery_<?php echo $termID; ?>[template]">Gallery page template:</label>
                <div class="field_wrap">
                    <select name="pix_array_gallery_<?php echo $termID; ?>[template]">
                        <option value="widepage" <?php  if(isset($pix_array_gallery['template'])) { selected( $pix_array_gallery['template'], 'widepage' ); } ?>>Wide page</option>
                        <option value="default" <?php if(isset($pix_array_gallery['template'])) { selected( $pix_array_gallery['template'], 'default' ); } ?>>Default</option>
                    </select>
                </div>

                <label for="pix_array_gallery_<?php echo $termID; ?>[sidebar]">Gallery page sidebar:</label>
                <div class="field_wrap">
                    <select name="pix_array_gallery_<?php echo $termID; ?>[sidebar]">
                        <option value="forte_default_sidebar" <?php if(isset($pix_array_gallery['sidebar'])) { selected( $pix_array_gallery['sidebar'], 'forte_default_sidebar' ); } ?>>Forte default sidebar</option>
						<?php
                        $get_sidebar_options = sidebar_generator_pix::get_sidebars();
                        if($get_sidebar_options != "") {
                        $i=1;
							foreach ($get_sidebar_options as $sidebar_gen) { ?>                        
									<option value="<?php echo $sidebar_gen; ?>" <?php if(isset($pix_array_gallery['sidebar'])) { selected( $pix_array_gallery['sidebar'], $sidebar_gen ); } ?>><?php echo $sidebar_gen; ?></option>
							<?php $i++;  
							}
                        }
                        ?>
                    </select>
                </div>

                <label for="pix_array_gallery_<?php echo $termID; ?>[filter]">Display the sorting bar on the gallery pages:</label>
                <input type="hidden" name="pix_array_gallery_<?php echo $termID; ?>[filter]" value="0">
                <input type="checkbox" name="pix_array_gallery_<?php echo $termID; ?>[filter]" value="true" <?php if(!isset($pix_array_gallery['filter']) || $pix_array_gallery['filter'] == '' || $pix_array_gallery['filter']=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_array_gallery_<?php echo $termID; ?>[order]">Display the &quot;Order&quot; filter on the gallery pages:</label>
                <input type="hidden" name="pix_array_gallery_<?php echo $termID; ?>[order]" value="0">
                <input type="checkbox" name="pix_array_gallery_<?php echo $termID; ?>[order]" value="true" <?php if(!isset($pix_array_gallery['order']) || $pix_array_gallery['order'] == '' || $pix_array_gallery['order']=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_array_gallery_<?php echo $termID; ?>[sort]">Display the &quot;Sort by tag&quot; filter on the gallery pages:</label>
                <input type="hidden" name="pix_array_gallery_<?php echo $termID; ?>[sort]" value="0">
                <input type="checkbox" name="pix_array_gallery_<?php echo $termID; ?>[sort]" value="true" <?php if(!isset($pix_array_gallery['sort']) || $pix_array_gallery['sort'] == '' || $pix_array_gallery['sort']=='true') { echo 'checked="checked"'; } ?>>


                <div class="slider_div">
                    <label for="pix_array_gallery_<?php echo $termID; ?>[ppp]">How many portfolio items per page</label>
                    <div class="field_wrap">
                        <input type="text" name="pix_array_gallery_<?php echo $termID; ?>[ppp]" value="<?php if(!isset($pix_array_gallery['ppp']) || $pix_array_gallery['ppp'] == '' ) { echo '12'; } else { echo $pix_array_gallery['ppp']; } ?>">
                    </div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label for="pix_array_gallery_<?php echo $termID; ?>[title]">Display the titles of the items:</label>
                <input type="hidden" name="pix_array_gallery_<?php echo $termID; ?>[title]" value="0">
                <input type="checkbox" name="pix_array_gallery_<?php echo $termID; ?>[title]" value="true" <?php if(!isset($pix_array_gallery['title']) || $pix_array_gallery['title'] == '' || $pix_array_gallery['title']=='true') { echo 'checked="checked"'; } ?>>

                <div class="slider_div">
                    <label for="pix_array_gallery_<?php echo $termID; ?>[length]">Amount of lines for the items excerpts:</label>
                    <div class="field_wrap">
                        <input type="text" name="pix_array_gallery_<?php echo $termID; ?>[length]" value="<?php if(!isset($pix_array_gallery['length']) || $pix_array_gallery['length'] == '' ) { echo '30'; } else { echo $pix_array_gallery['length']; } ?>">
                    </div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label for="pix_array_gallery_<?php echo $termID; ?>[more]">Display the &quot;Read more&quot; link:</label>
                <input type="hidden" name="pix_array_gallery_<?php echo $termID; ?>[more]" value="0">
                <input type="checkbox" name="pix_array_gallery_<?php echo $termID; ?>[more]" value="true" <?php if(!isset($pix_array_gallery['more']) || $pix_array_gallery['more'] == '' || $pix_array_gallery['more']=='true') { echo 'checked="checked"'; } ?>>
                
                <div class="clear"></div>
                
                <label for="pix_array_gallery_<?php echo $termID; ?>[like]">Display the &quot;Like&quot; button:</label>
                <div class="field_wrap">
                    <select name="pix_array_gallery_<?php echo $termID; ?>[like]">
                        <option value=""  <?php if (isset($pix_array_gallery['like'])) selected( $pix_array_gallery['like'], '' ); ?>>Inherit</option>
                        <option value="true"  <?php if (isset($pix_array_gallery['like'])) selected( $pix_array_gallery['like'], 'true' ); ?>>Yes</option>
                        <option value="false"  <?php if (isset($pix_array_gallery['like'])) selected( $pix_array_gallery['like'], 'false' ); ?>>No</option>
                    </select>
                </div>

                <div class="clear"></div>
                
                <label for="pix_array_gallery_<?php echo $termID; ?>[comments]">Display the amount of comments:</label>
                <input type="hidden" name="pix_array_gallery_<?php echo $termID; ?>[comments]" value="0">
                <input type="checkbox" name="pix_array_gallery_<?php echo $termID; ?>[comments]" value="true" <?php if(!isset($pix_array_gallery['comments']) || $pix_array_gallery['comments'] == '' || $pix_array_gallery['comments']=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_array_gallery_<?php echo $termID; ?>[linkto]">Link the pictures to the item pages or open in a ColorBox:</label>
                <div class="field_wrap">
                    <select name="pix_array_gallery_<?php echo $termID; ?>[linkto]">
                        <option value="colorbox" <?php if (isset($pix_array_gallery['linkto'])) selected( $pix_array_gallery['linkto'], 'colorbox' ); ?>>ColorBox</option>
                        <option value="page" <?php if (isset($pix_array_gallery['linkto'])) selected( $pix_array_gallery['linkto'], 'page' ); ?>>Page items</option>
                        <option value="none" <?php if (isset($pix_array_gallery['linkto'])) selected( $pix_array_gallery['linkto'], 'none' ); ?>>None</option>
                    </select>
                </div>
                
                <div class="clear"></div>
                
                <label for="pix_array_gallery_<?php echo $termID; ?>[pagenavi]">Display the navigation numbers or the infinite scroll button:</label>
                <div class="field_wrap">
                    <select name="pix_array_gallery_<?php echo $termID; ?>[pagenavi]">
                        <option value="infinite" <?php if (isset($pix_array_gallery['pagenavi'])) selected( $pix_array_gallery['pagenavi'], 'infinite' ); ?>>Infinite scroll button</option>
                        <option value="" <?php if (isset($pix_array_gallery['pagenavi'])) selected( $pix_array_gallery['pagenavi'], '' ); ?>>Page navigation numbers</option>
                    </select>
                </div>

            	<label for="pix_array_gallery_<?php echo $termID; ?>[metatitle]">Meta title:</label>
                <div class="field_wrap"><input name="pix_array_gallery_<?php echo $termID; ?>[metatitle]" type="text" class="pix_title_seo" value="<?php if (isset($pix_array_gallery['metatitle'])) echo $pix_array_gallery['metatitle']; ?>"></div>

            	<label for="pix_array_gallery_<?php echo $termID; ?>[metadescription]">Meta description:</label>
                <div class="field_wrap"><input name="pix_array_gallery_<?php echo $termID; ?>[metadescription]" type="text" class="pix_desc_seo" value="<?php if (isset($pix_array_gallery['metadescription'])) echo $pix_array_gallery['metadescription']; ?>"></div>
                           
             	<label for="pix_array_gallery_<?php echo $termID; ?>[metakeywords]">Meta keywords</label>
                <div class="field_wrap"><textarea name="pix_array_gallery_<?php echo $termID; ?>[metakeywords]"><?php if (isset($pix_array_gallery['metakeywords'])) echo $pix_array_gallery['metakeywords']; ?></textarea></div>
           
        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>