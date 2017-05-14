<?php

function blog_category(){
	global $options;
	if ($_GET['page']=='blog_category') { 
	
	$catID = $_GET['cat'];
	$pix_array_category = pix_get_option('pix_array_category_'.$catID);
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Blog: <small>&quot;<?php echo get_cat_name($catID); ?>&quot; category</small>
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

                <label for="pix_array_category_<?php echo $catID; ?>[layout]">Category page layout:</label>
                <div class="field_wrap">
                    <select name="pix_array_category_<?php echo $catID; ?>[layout]">
                        <option value="default" <?php if(isset($pix_array_category['layout'])) { selected( $pix_array_category['layout'], 'default' ); } ?>>Two columns wide thumb (16:9) + floating text</option>
                        <option value="first" <?php if(isset($pix_array_category['layout'])) { selected( $pix_array_category['layout'], 'first' ); } ?>>Two columns wide thumb (4:3) + floating text</option>
                        <option value="second" <?php if(isset($pix_array_category['layout'])) { selected( $pix_array_category['layout'], 'second' ); } ?>>One column wide thumb (16:9) + floating text</option>
                        <option value="third" <?php if(isset($pix_array_category['layout'])) { selected( $pix_array_category['layout'], 'third' ); } ?>>One column wide thumb (4:3) + floating text</option>
                        <option value="fourth" <?php if(isset($pix_array_category['layout'])) { selected( $pix_array_category['layout'], 'fourth' ); } ?>>Three columns wide thumb + floating text</option>
                        <option value="fifth" <?php if(isset($pix_array_category['layout'])) { selected( $pix_array_category['layout'], 'fifth' ); } ?>>Four columns wide thumb + floating text</option>
                        <option value="sixth" <?php if(isset($pix_array_category['layout'])) { selected( $pix_array_category['layout'], 'sixth' ); } ?>>Grid of one colum wide thumbs</option>
                        <option value="sixth_bis" <?php if(isset($pix_array_category['layout'])) { selected( $pix_array_category['layout'], 'sixth_bis' ); } ?>>Grid of one colum wide thumbs (masonry)</option>
                        <option value="seventh" <?php if(isset($pix_array_category['layout'])) { selected( $pix_array_category['layout'], 'seventh' ); } ?>>Grid of two columns wide thumbs (4:3)</option>
                        <option value="seventh_bis" <?php if(isset($pix_array_category['layout'])) { selected( $pix_array_category['layout'], 'seventh_bis' ); } ?>>Grid of two columns wide thumbs (4:3, masonry)</option>
                        <option value="eighth" <?php if(isset($pix_array_category['layout'])) { selected( $pix_array_category['layout'], 'eighth' ); } ?>>Grid of two columns wide thumbs (16:9)</option>
                        <option value="eighth_bis" <?php if(isset($pix_array_category['layout'])) { selected( $pix_array_category['layout'], 'eighth_bis' ); } ?>>Grid of two columns wide thumbs (16:9, masonry)</option>
                        <option value="ninth" <?php if(isset($pix_array_category['layout'])) { selected( $pix_array_category['layout'], 'ninth' ); } ?>>Wall of 4:3 thumbs</option>
                        <option value="tenth" <?php if(isset($pix_array_category['layout'])) { selected( $pix_array_category['layout'], 'tenth' ); } ?>>Wall of 16:9 thumbs</option>
                    </select>
                </div>

                <label for="pix_array_category_<?php echo $catID; ?>[template]">Category page template:</label>
                <div class="field_wrap">
                    <select name="pix_array_category_<?php echo $catID; ?>[template]">
                        <option value="default" <?php if(isset($pix_array_category['template'])) { selected( $pix_array_category['template'], 'default' ); } ?>>Default</option>
                        <option value="widepage" <?php if(isset($pix_array_category['template'])) { selected( $pix_array_category['template'], 'widepage' ); } ?>>Wide page</option>
                    </select>
                </div>

                <label for="pix_array_category_<?php echo $catID; ?>[sidebar]">Category page sidebar:</label>
                <div class="field_wrap">
                    <select name="pix_array_category_<?php echo $catID; ?>[sidebar]">
                        <option value="forte_default_sidebar" <?php if(!isset($pix_array_category['sidebar'])) { selected( $pix_array_category['sidebar'], 'forte_default_sidebar' ); } ?>>Forte default sidebar</option>
						<?php
                        $get_sidebar_options = sidebar_generator_pix::get_sidebars();
                        if($get_sidebar_options != "") {
                        $i=1;
							foreach ($get_sidebar_options as $sidebar_gen) { ?>                        
									<option value="<?php echo $sidebar_gen; ?>" <?php if(isset($pix_array_category['sidebar'])) { selected( $pix_array_category['sidebar'], $sidebar_gen ); } ?>><?php echo $sidebar_gen; ?></option>
							<?php $i++;  
							}
                        }
                        ?>
                    </select>
                </div>

                <label for="pix_array_category_<?php echo $catID; ?>[filter]">Display the sorting bar on the category pages:</label>
                <input type="hidden" name="pix_array_category_<?php echo $catID; ?>[filter]" value="0">
                <input type="checkbox" name="pix_array_category_<?php echo $catID; ?>[filter]" value="true" <?php if(!isset($pix_array_category['filter']) || $pix_array_category['filter'] == '' || $pix_array_category['filter']=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_array_category_<?php echo $catID; ?>[order]">Display the &quot;Order&quot; filter on the category pages:</label>
                <input type="hidden" name="pix_array_category_<?php echo $catID; ?>[order]" value="0">
                <input type="checkbox" name="pix_array_category_<?php echo $catID; ?>[order]" value="true" <?php if(!isset($pix_array_category['order']) || $pix_array_category['order'] == '' || $pix_array_category['order']=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_array_category_<?php echo $catID; ?>[sort]">Display the &quot;Sort by tag&quot; filter on the category pages:</label>
                <input type="hidden" name="pix_array_category_<?php echo $catID; ?>[sort]" value="0">
                <input type="checkbox" name="pix_array_category_<?php echo $catID; ?>[sort]" value="true" <?php if(!isset($pix_array_category['sort']) || $pix_array_category['sort'] == '' || $pix_array_category['sort']=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <div class="slider_div">
                    <label for="pix_array_category_<?php echo $catID; ?>[ppp]">How many posts per page</label>
                    <div class="field_wrap">
                        <input type="text" name="pix_array_category_<?php echo $catID; ?>[ppp]" value="<?php if(!isset($pix_array_category['ppp']) || $pix_array_category['ppp'] == '' ) { echo '10'; } else { echo $pix_array_category['ppp']; } ?>">
                    </div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label for="pix_array_category_<?php echo $catID; ?>[titles]">Display the titles of the posts:</label>
                <input type="hidden" name="pix_array_category_<?php echo $catID; ?>[titles]" value="0">
                <input type="checkbox" name="pix_array_category_<?php echo $catID; ?>[titles]" value="true" <?php if(!isset($pix_array_category['titles']) || $pix_array_category['titles'] == '' || $pix_array_category['titles']=='true') { echo 'checked="checked"'; } ?>>

                <div class="slider_div">
                    <label for="pix_array_category_<?php echo $catID; ?>[length]">Amount of lines for the excerpts:</label>
                    <div class="field_wrap">
                        <input type="text" name="pix_array_category_<?php echo $catID; ?>[length]" value="<?php echo (!isset($pix_array_category['length'])||$pix_array_category['length']=='') ? '10' : $pix_array_category['length'] ; ?>">
                    </div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
    
                <div class="clear"></div>

                <label for="pix_array_category_<?php echo $catID; ?>[more]">Display the &quot;Read more&quot; link:</label>
                <input type="hidden" name="pix_array_category_<?php echo $catID; ?>[more]" value="0">
                <input type="checkbox" name="pix_array_category_<?php echo $catID; ?>[more]" value="true" <?php if(!isset($pix_array_category['more']) || $pix_array_category['more'] == '' || $pix_array_category['more']=='true') { echo 'checked="checked"'; } ?>>
                
                <div class="clear"></div>
                
                <label for="pix_array_category_<?php echo $catID; ?>[like]">Display the &quot;Like&quot; button:</label>
                <div class="field_wrap">
                    <select name="pix_array_category_<?php echo $catID; ?>[like]">
                        <option value=""  <?php if (isset($pix_array_category['like'])) selected( $pix_array_category['like'], '' ); ?>>Inherit</option>
                        <option value="true"  <?php if (isset($pix_array_category['like'])) selected( $pix_array_category['like'], 'true' ); ?>>Yes</option>
                        <option value="false"  <?php if (isset($pix_array_category['like'])) selected( $pix_array_category['like'], 'false' ); ?>>No</option>
                    </select>
                </div>

                <div class="clear"></div>
                
                <label for="pix_array_category_<?php echo $catID; ?>[meta]">Display the meta info (categories, author):</label>
                <input type="hidden" name="pix_array_category_<?php echo $catID; ?>[meta]" value="0">
                <input type="checkbox" name="pix_array_category_<?php echo $catID; ?>[meta]" value="true" <?php if(!isset($pix_array_category['meta']) || $pix_array_category['meta'] == '' || $pix_array_category['meta']=='true') { echo 'checked="checked"'; } ?>>
                
                <div class="clear"></div>
                
                <label for="pix_array_category_<?php echo $catID; ?>[comments]">Display the amount of comments:</label>
                <input type="hidden" name="pix_array_category_<?php echo $catID; ?>[comments]" value="0">
                <input type="checkbox" name="pix_array_category_<?php echo $catID; ?>[comments]" value="true" <?php if(!isset($pix_array_category['comments']) || $pix_array_category['comments'] == '' || $pix_array_category['comments']=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_array_category_<?php echo $catID; ?>[linkto]">Link the pictures to the item pages or open in a ColorBox:</label>
                <div class="field_wrap">
                    <select name="pix_array_category_<?php echo $catID; ?>[linkto]">
                        <option value="colorbox" <?php if (isset($pix_array_category['linkto'])) selected( $pix_array_category['linkto'], 'colorbox' ); ?>>ColorBox</option>
                        <option value="page" <?php if (isset($pix_array_category['linkto'])) selected( $pix_array_category['linkto'], 'page' ); ?>>Page items</option>
                        <option value="none" <?php if (isset($pix_array_category['linkto'])) selected( $pix_array_category['linkto'], 'none' ); ?>>None</option>
                    </select>
                </div>
                
                <div class="clear"></div>
                
                <label for="pix_array_category_<?php echo $catID; ?>[pagenavi]">Page navigation:</label>
                <div class="field_wrap">
                    <select name="pix_array_category_<?php echo $catID; ?>[pagenavi]">
                        <option value="" <?php if (isset($pix_array_category['pagenavi'])) selected( $pix_array_category['pagenavi'], '' ); ?>>Page numbers</option>
                        <option value="infinite" <?php if (isset($pix_array_category['pagenavi'])) selected( $pix_array_category['pagenavi'], 'infinite' ); ?>>Infinite scroll button</option>
                    </select>
                </div>
                                        
            	<label for="pix_array_category_<?php echo $catID; ?>[metatitle]">Meta title:</label>
                <div class="field_wrap"><input name="pix_array_category_<?php echo $catID; ?>[metatitle]" type="text" class="pix_title_seo" value="<?php if(isset($pix_array_category['metatitle'])) { echo $pix_array_category['metatitle']; } ?>"></div>

            	<label for="pix_array_category_<?php echo $catID; ?>[metadescription]">Meta description:</label>
                <div class="field_wrap"><input name="pix_array_category_<?php echo $catID; ?>[metadescription]" type="text" class="pix_desc_seo" value="<?php if(isset($pix_array_category['metadescription'])) { echo $pix_array_category['metadescription']; } ?>"></div>
                           
             	<label for="pix_array_category_<?php echo $catID; ?>[metakeywords]">Meta keywords</label>
                <div class="field_wrap"><textarea name="pix_array_category_<?php echo $catID; ?>[metakeywords]"><?php if(isset($pix_array_category['metakeywords'])) { echo $pix_array_category['metakeywords']; } ?></textarea></div>
           
        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>