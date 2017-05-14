<?php

function woo_options(){
	global $options;
	if ($_GET['page']=='woo_options') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	WooCommerce: <small>set the WooCommerce pages</small>
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
        
                <div class="slider_div border">
                    <label for="pix_woocommerce_ppp">How many products to display on your WooCommerce pages</label>
                    <div class="field_wrap">
                        <input type="text" name="pix_woocommerce_ppp" value="<?php echo pix_esc_option('pix_woocommerce_ppp'); ?>">
                    </div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                
                <div class="clear"></div>

                <div class="slider_div">
                    <label for="pix_woo_length">Amount of lines for the excerpts (where available):</label>
                    <div class="field_wrap">
                        <input type="text" name="pix_woo_length" value="<?php echo pix_get_option('pix_woo_length'); ?>">
                    </div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <label for="pix_shop_pagenavi">Display the navigation numbers or the infinite scroll button (where available):</label>
                <div class="field_wrap">
                    <select name="pix_shop_pagenavi">
                        <option value="infinite" <?php selected( pix_esc_option('pix_shop_pagenavi'), 'infinite' ); ?>>Infinite scroll button</option>
                        <option value="" <?php selected( pix_esc_option('pix_shop_pagenavi'), '' ); ?>>Page navigation numbers</option>
                    </select>
                </div>

                <div class="clear less_space"></div>
                <div class="tip_info_wrap"></div>

                <label for="pix_shop_layout">Main shop page layout:</label>
                <div class="field_wrap">
                    <select name="pix_shop_layout">
                        <option value="default" <?php selected( pix_esc_option('pix_shop_layout'), 'default' ); ?>>Two columns wide thumb (16:9) + floating text</option>
                        <option value="first" <?php selected( pix_esc_option('pix_shop_layout'), 'first' ); ?>>Two columns wide thumb (4:3) + floating text</option>
                        <option value="second" <?php selected( pix_esc_option('pix_shop_layout'), 'second' ); ?>>One column wide thumb (16:9) + floating text</option>
                        <option value="third" <?php selected( pix_esc_option('pix_shop_layout'), 'third' ); ?>>One column wide thumb (4:3) + floating text</option>
                        <option value="fourth" <?php selected( pix_esc_option('pix_shop_layout'), 'fourth' ); ?>>Three columns wide thumb + floating text</option>
                        <option value="fifth" <?php selected( pix_esc_option('pix_shop_layout'), 'fifth' ); ?>>Four columns wide thumb + floating text</option>
                        <option value="sixth" <?php selected( pix_esc_option('pix_shop_layout'), 'sixth' ); ?>>Grid of one colum wide thumbs</option>
                        <option value="sixth_bis" <?php selected( pix_esc_option('pix_shop_layout'), 'sixth_bis' ); ?>>Grid of one colum wide thumbs (masonry)</option>
                        <option value="seventh" <?php selected( pix_esc_option('pix_shop_layout'), 'seventh' ); ?>>Grid of two columns wide thumbs (4:3)</option>
                        <option value="seventh_bis" <?php selected( pix_esc_option('pix_shop_layout'), 'seventh_bis' ); ?>>Grid of two columns wide thumbs (4:3, masonry)</option>
                        <option value="eighth" <?php selected( pix_esc_option('pix_shop_layout'), 'eighth' ); ?>>Grid of two columns wide thumbs (16:9)</option>
                        <option value="eighth_bis" <?php selected( pix_esc_option('pix_shop_layout'), 'eighth_bis' ); ?>>Grid of two columns wide thumbs (16:9, masonry)</option>
                        <option value="ninth" <?php selected( pix_esc_option('pix_shop_layout'), 'ninth' ); ?>>Wall of 4:3 thumbs</option>
                        <option value="tenth" <?php selected( pix_esc_option('pix_shop_layout'), 'tenth' ); ?>>Wall of 16:9 thumbs</option>
                    </select>
                </div>

                <label for="pix_shop_filter">Display the sorting bar on the main shop page:</label>
                <input type="hidden" name="pix_shop_filter" value="0">
                <input type="checkbox" name="pix_shop_filter" value="true" <?php if(pix_esc_option('pix_shop_filter')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_shop_order">Display the &quot;Order&quot; filter on the main shop page:</label>
                <input type="hidden" name="pix_shop_order" value="0">
                <input type="checkbox" name="pix_shop_order" value="true" <?php if(pix_esc_option('pix_shop_order')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_shop_sort">Display the &quot;Sort&quot; filter on the main shop page:</label>
                <input type="hidden" name="pix_shop_sort" value="0">
                <input type="checkbox" name="pix_shop_sort" value="true" <?php if(pix_esc_option('pix_shop_sort')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_shop_price">Display the &quot;Price&quot; filter on the main shop page:</label>
                <input type="hidden" name="pix_shop_price" value="0">
                <input type="checkbox" name="pix_shop_price" value="true" <?php if(pix_esc_option('pix_shop_price')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <div class="clear less_space"></div>
                <div class="tip_info_wrap"></div>

                <label for="pix_shopcategory_layout">Category page layout:</label>
                <div class="field_wrap">
                    <select name="pix_shopcategory_layout">
                        <option value="default" <?php selected( pix_esc_option('pix_shopcategory_layout'), 'default' ); ?>>Two columns wide thumb (16:9) + floating text</option>
                        <option value="first" <?php selected( pix_esc_option('pix_shopcategory_layout'), 'first' ); ?>>Two columns wide thumb (4:3) + floating text</option>
                        <option value="second" <?php selected( pix_esc_option('pix_shopcategory_layout'), 'second' ); ?>>One column wide thumb (16:9) + floating text</option>
                        <option value="third" <?php selected( pix_esc_option('pix_shopcategory_layout'), 'third' ); ?>>One column wide thumb (4:3) + floating text</option>
                        <option value="fourth" <?php selected( pix_esc_option('pix_shopcategory_layout'), 'fourth' ); ?>>Three columns wide thumb + floating text</option>
                        <option value="fifth" <?php selected( pix_esc_option('pix_shopcategory_layout'), 'fifth' ); ?>>Four columns wide thumb + floating text</option>
                        <option value="sixth" <?php selected( pix_esc_option('pix_shopcategory_layout'), 'sixth' ); ?>>Grid of one colum wide thumbs</option>
                        <option value="sixth_bis" <?php selected( pix_esc_option('pix_shopcategory_layout'), 'sixth_bis' ); ?>>Grid of one colum wide thumbs (masonry)</option>
                        <option value="seventh" <?php selected( pix_esc_option('pix_shopcategory_layout'), 'seventh' ); ?>>Grid of two columns wide thumbs (4:3)</option>
                        <option value="seventh_bis" <?php selected( pix_esc_option('pix_shopcategory_layout'), 'seventh_bis' ); ?>>Grid of two columns wide thumbs (4:3, masonry)</option>
                        <option value="eighth" <?php selected( pix_esc_option('pix_shopcategory_layout'), 'eighth' ); ?>>Grid of two columns wide thumbs (16:9)</option>
                        <option value="eighth_bis" <?php selected( pix_esc_option('pix_shopcategory_layout'), 'eighth_bis' ); ?>>Grid of two columns wide thumbs (16:9, masonry)</option>
                        <option value="ninth" <?php selected( pix_esc_option('pix_shopcategory_layout'), 'ninth' ); ?>>Wall of 4:3 thumbs</option>
                        <option value="tenth" <?php selected( pix_esc_option('pix_shopcategory_layout'), 'tenth' ); ?>>Wall of 16:9 thumbs</option>
                    </select>
                </div>

                <label for="pix_shopcategory_template">WooCommerce category pages template:</label>
                <div class="field_wrap">
                    <select name="pix_shopcategory_template">
                        <option value="default" <?php selected( pix_esc_option('pix_shopcategory_template'), 'default' ); ?>>Default</option>
                        <option value="widepage" <?php selected( pix_esc_option('pix_shopcategory_template'), 'widepage' ); ?>>Wide page</option>
                    </select>
                </div>

                <label for="pix_shopcategory_sidebar">WooCommerce category pages sidebar:</label>
                <div class="field_wrap">
                    <select name="pix_shopcategory_sidebar">
                        <option value="woocommerce_default_sidebar" <?php selected( pix_esc_option('pix_shopcategory_sidebar'), 'woocommerce_default_sidebar' ); ?>>WooCommerce default sidebar</option>
                        <option value="forte_default_sidebar" <?php selected( pix_esc_option('pix_shopcategory_sidebar'), 'forte_default_sidebar' ); ?>>Forte default sidebar</option>
                        <?php
                        $get_sidebar_options = sidebar_generator_pix::get_sidebars();
                        if($get_sidebar_options != "") {
                        $i=1;
                            foreach ($get_sidebar_options as $sidebar_gen) { ?>                        
                                    <option value="<?php echo $sidebar_gen; ?>" <?php selected( pix_esc_option('pix_shopcategory_sidebar'), $sidebar_gen ); ?>><?php echo $sidebar_gen; ?></option>
                            <?php $i++;  
                            }
                        }
                        ?>
                    </select>
                </div>
                
                <label for="pix_shopcategory_filter">Display the sorting bar on the category pages:</label>
                <input type="hidden" name="pix_shopcategory_filter" value="0">
                <input type="checkbox" name="pix_shopcategory_filter" value="true" <?php if(pix_esc_option('pix_shopcategory_filter')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_shopcategory_order">Display the &quot;Order&quot; filter on the category pages:</label>
                <input type="hidden" name="pix_shopcategory_order" value="0">
                <input type="checkbox" name="pix_shopcategory_order" value="true" <?php if(pix_esc_option('pix_shopcategory_order')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_shopcategory_sort">Display the &quot;Sort&quot; filter on the category pages:</label>
                <input type="hidden" name="pix_shopcategory_sort" value="0">
                <input type="checkbox" name="pix_shopcategory_sort" value="true" <?php if(pix_esc_option('pix_shopcategory_sort')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_shopcategory_price">Display the &quot;Price&quot; filter on the category pages:</label>
                <input type="hidden" name="pix_shopcategory_price" value="0">
                <input type="checkbox" name="pix_shopcategory_price" value="true" <?php if(pix_esc_option('pix_shopcategory_price')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <div class="clear less_space"></div>
                <div class="tip_info_wrap"></div>

                <label for="pix_woo_layout">Archive page layout (tags etc.):</label>
                <div class="field_wrap">
                    <select name="pix_woo_layout">
                        <option value="default" <?php selected( pix_esc_option('pix_woo_layout'), 'default' ); ?>>Two columns wide thumb (16:9) + floating text</option>
                        <option value="first" <?php selected( pix_esc_option('pix_woo_layout'), 'first' ); ?>>Two columns wide thumb (4:3) + floating text</option>
                        <option value="second" <?php selected( pix_esc_option('pix_woo_layout'), 'second' ); ?>>One column wide thumb (16:9) + floating text</option>
                        <option value="third" <?php selected( pix_esc_option('pix_woo_layout'), 'third' ); ?>>One column wide thumb (4:3) + floating text</option>
                        <option value="fourth" <?php selected( pix_esc_option('pix_woo_layout'), 'fourth' ); ?>>Three columns wide thumb + floating text</option>
                        <option value="fifth" <?php selected( pix_esc_option('pix_woo_layout'), 'fifth' ); ?>>Four columns wide thumb + floating text</option>
                        <option value="sixth" <?php selected( pix_esc_option('pix_woo_layout'), 'sixth' ); ?>>Grid of one colum wide thumbs</option>
                        <option value="sixth_bis" <?php selected( pix_esc_option('pix_woo_layout'), 'sixth_bis' ); ?>>Grid of one colum wide thumbs (masonry)</option>
                        <option value="seventh" <?php selected( pix_esc_option('pix_woo_layout'), 'seventh' ); ?>>Grid of two columns wide thumbs (4:3)</option>
                        <option value="seventh_bis" <?php selected( pix_esc_option('pix_woo_layout'), 'seventh_bis' ); ?>>Grid of two columns wide thumbs (4:3, masonry)</option>
                        <option value="eighth" <?php selected( pix_esc_option('pix_woo_layout'), 'eighth' ); ?>>Grid of two columns wide thumbs (16:9)</option>
                        <option value="eighth_bis" <?php selected( pix_esc_option('pix_woo_layout'), 'eighth_bis' ); ?>>Grid of two columns wide thumbs (16:9, masonry)</option>
                        <option value="ninth" <?php selected( pix_esc_option('pix_woo_layout'), 'ninth' ); ?>>Wall of 4:3 thumbs</option>
                        <option value="tenth" <?php selected( pix_esc_option('pix_woo_layout'), 'tenth' ); ?>>Wall of 16:9 thumbs</option>
                    </select>
                </div>

                <label for="pix_woo_template">WooCommerce archive pages template:</label>
                <div class="field_wrap">
                    <select name="pix_woo_template">
                        <option value="default" <?php selected( pix_esc_option('pix_woo_template'), 'default' ); ?>>Default</option>
                        <option value="widepage" <?php selected( pix_esc_option('pix_woo_template'), 'widepage' ); ?>>Wide page</option>
                    </select>
                </div>

                <label for="pix_woo_sidebar">WooCommerce archive pages and product pages sidebar:</label>
                <div class="field_wrap">
                    <select name="pix_woo_sidebar">
                        <option value="woocommerce_default_sidebar" <?php selected( pix_esc_option('pix_woo_sidebar'), 'woocommerce_default_sidebar' ); ?>>WooCommerce default sidebar</option>
                        <option value="forte_default_sidebar" <?php selected( pix_esc_option('pix_woo_sidebar'), 'forte_default_sidebar' ); ?>>Forte default sidebar</option>
                        <?php
                        $get_sidebar_options = sidebar_generator_pix::get_sidebars();
                        if($get_sidebar_options != "") {
                        $i=1;
                            foreach ($get_sidebar_options as $sidebar_gen) { ?>                        
                                    <option value="<?php echo $sidebar_gen; ?>" <?php selected( pix_esc_option('pix_woo_sidebar'), $sidebar_gen ); ?>><?php echo $sidebar_gen; ?></option>
                            <?php $i++;  
                            }
                        }
                        ?>
                    </select>
                </div>
                
                <label for="pix_woo_filter">Display the sorting bar on the archive pages:</label>
                <input type="hidden" name="pix_woo_filter" value="0">
                <input type="checkbox" name="pix_woo_filter" value="true" <?php if(pix_esc_option('pix_woo_filter')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_woo_order">Display the &quot;Order&quot; filter on the archive pages:</label>
                <input type="hidden" name="pix_woo_order" value="0">
                <input type="checkbox" name="pix_woo_order" value="true" <?php if(pix_esc_option('pix_woo_order')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_woo_sort">Display the &quot;Sort&quot; filter on the archive pages:</label>
                <input type="hidden" name="pix_woo_sort" value="0">
                <input type="checkbox" name="pix_woo_sort" value="true" <?php if(pix_esc_option('pix_woo_sort')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_woo_price">Display the &quot;Price&quot; filter on the archive pages:</label>
                <input type="hidden" name="pix_woo_price" value="0">
                <input type="checkbox" name="pix_woo_price" value="true" <?php if(pix_esc_option('pix_woo_price')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <div class="clear less_space"></div>
                <div class="tip_info_wrap"></div>

                <label for="pix_woo_related">Display the related items on the product pages:</label>
                <input type="hidden" name="pix_woo_related" value="0">
                <input type="checkbox" name="pix_woo_related" value="true" <?php if(pix_esc_option('pix_woo_related')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <div class="slider_div border">
                    <label for="pix_woo_related_ppp">How many related products for page</label>
                    <div class="field_wrap">
                        <input type="text" name="pix_woo_related_ppp" value="<?php echo pix_esc_option('pix_woo_related_ppp'); ?>">
                    </div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                
                <div class="clear"></div>
                                
                <label for="pix_woo_related_layout">Related items layout (tags etc.):</label>
                <div class="field_wrap">
                    <select name="pix_woo_related_layout">
                        <option value="second" <?php selected( pix_esc_option('pix_woo_related_layout'), 'second' ); ?>>One column wide thumb (16:9) + floating text</option>
                        <option value="third" <?php selected( pix_esc_option('pix_woo_related_layout'), 'third' ); ?>>One column wide thumb (4:3) + floating text</option>
                        <option value="sixth" <?php selected( pix_esc_option('pix_woo_related_layout'), 'sixth' ); ?>>Grid thumbs</option>
                        <option value="sixth_bis" <?php selected( pix_esc_option('pix_woo_related_layout'), 'sixth_bis' ); ?>>Gridthumbs (masonry)</option>
                    </select>
                </div>

                <div class="clear"></div>

                <label for="pix_woo_related_titles">Display the titles of the products:</label>
                <input type="hidden" name="pix_woo_related_titles" value="0">
                <input type="checkbox" name="pix_woo_related_titles" value="true" <?php if(pix_esc_option('pix_woo_related_titles')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <div class="slider_div border">
                                        
                    <label for="pix_woo_related_excerpt_length">Amount of lines for the excerpts:</label>
                    <div class="field_wrap">
                        <input type="text" name="pix_woo_related_excerpt_length" value="<?php echo pix_get_option('pix_woo_related_excerpt_length'); ?>">
                    </div>
                    <div class="slider_cursor"></div>
                
                </div><!-- .slider_div -->    
    
                <label for="pix_woo_related_more">Display the &quot;Read more&quot; link:</label>
                <input type="hidden" name="pix_woo_related_more" value="0">
                <input type="checkbox" name="pix_woo_related_more" value="true" <?php if(pix_esc_option('pix_woo_related_more')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_zoom_woo">Enable the zoom for all the images on the product pages:</label>
                <input type="hidden" name="pix_zoom_woo" value="0">
                <input type="checkbox" name="pix_zoom_woo" value="true" <?php if(pix_esc_option('pix_zoom_woo')=='true') { echo 'checked="checked"'; } ?>>
                
                <div class="clear"></div>

                <label for="pix_share_woo">Display the share buttons on the product pages:</label>
                <input type="hidden" name="pix_share_woo" value="0">
                <input type="checkbox" name="pix_share_woo" value="true" <?php if(pix_esc_option('pix_share_woo')=='true') { echo 'checked="checked"'; } ?>>
                
                <div class="clear"></div>

                <label for="pix_woo_metatitle">Meta title (main shop page excluded*):</label>
                <div class="field_wrap"><input name="pix_woo_metatitle" type="text" class="pix_title_seo" value="<?php echo pix_esc_option('pix_woo_metatitle'); ?>"></div>

                <label for="pix_woo_metadescription">Meta description (main shop page excluded*):</label>
                <div class="field_wrap"><input name="pix_woo_metadescription" type="text" class="pix_desc_seo" value="<?php echo pix_esc_option('pix_woo_metadescription'); ?>"></div>
                           
                <label for="pix_woo_metakeys">Meta keywords (main shop page excluded*):</label>
                <div class="field_wrap"><textarea name="pix_woo_metakeys"><?php echo pix_esc_option('pix_woo_metakeys'); ?></textarea></div>
           
                <div class="clear"></div>
                <div class="tip_info_wrap">
                    <small class="tip_info">(*) You can set some options (such as the background of the title area, the meta tags etc.) for the main shop page, directly from the shop page backend</small>
                </div>
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
            
                <div class="clear"></div>

        <input type="hidden" name="action" value="data_save" />
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>" />
        <input type="submit" class="hidden_div" value="" />
            </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>