<?php

function blog_posts_page(){
	global $options;
	if ($_GET['page']=='blog_posts_page') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Blog: <small>latest posts page</small>
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


               <label for="pix_posts_page_id">Select your blog page:</label>
                <div class="field_wrap">
                    <select name="pix_posts_page_id">
                        <option value="">Select a page</option>
                        <?php 
                        $pages = get_pages(); 
                        $pp_space = '';
                        foreach ( $pages as $page ) {
                            if ( $page->post_parent != '0' ) {
                                $pp_space = $pp_space.'&nbsp&nbsp';
                            } else {
                                $pp_space = '';
                            }
                            $option = '<option '.selected( pix_esc_option('pix_posts_page_id'),  $page->ID, false ). 'value="' .  $page->ID . '">';
                            $option .= $pp_space.$page->post_title;
                            $option .= '</option>';
                            echo $option;
                        }
                        ?>
                    </select>
                </div>

                <div class="clear"></div>
                
                <label for="pix_posts_page_layout">Posts page layout:</label>
                <div class="field_wrap">
                    <select name="pix_posts_page_layout">
                        <option value="default" <?php selected( pix_esc_option('pix_posts_page_layout'), 'default' ); ?>>Two columns wide thumb (16:9) + floating text</option>
                        <option value="first" <?php selected( pix_esc_option('pix_posts_page_layout'), 'first' ); ?>>Two columns wide thumb (4:3) + floating text</option>
                        <option value="second" <?php selected( pix_esc_option('pix_posts_page_layout'), 'second' ); ?>>One column wide thumb (16:9) + floating text</option>
                        <option value="third" <?php selected( pix_esc_option('pix_posts_page_layout'), 'third' ); ?>>One column wide thumb (4:3) + floating text</option>
                        <option value="fourth" <?php selected( pix_esc_option('pix_posts_page_layout'), 'fourth' ); ?>>Three columns wide thumb + floating text</option>
                        <option value="fifth" <?php selected( pix_esc_option('pix_posts_page_layout'), 'fifth' ); ?>>Four columns wide thumb + floating text</option>
                        <option value="sixth" <?php selected( pix_esc_option('pix_posts_page_layout'), 'sixth' ); ?>>Grid of one colum wide thumbs</option>
                        <option value="sixth_bis" <?php selected( pix_esc_option('pix_posts_page_layout'), 'sixth_bis' ); ?>>Grid of one colum wide thumbs (masonry)</option>
                        <option value="seventh" <?php selected( pix_esc_option('pix_posts_page_layout'), 'seventh' ); ?>>Grid of two columns wide thumbs (4:3)</option>
                        <option value="seventh_bis" <?php selected( pix_esc_option('pix_posts_page_layout'), 'seventh_bis' ); ?>>Grid of two columns wide thumbs (4:3, masonry)</option>
                        <option value="eighth" <?php selected( pix_esc_option('pix_posts_page_layout'), 'eighth' ); ?>>Grid of two columns wide thumbs (16:9)</option>
                        <option value="eighth_bis" <?php selected( pix_esc_option('pix_posts_page_layout'), 'eighth_bis' ); ?>>Grid of two columns wide thumbs (16:9, masonry)</option>
                        <option value="ninth" <?php selected( pix_esc_option('pix_posts_page_layout'), 'ninth' ); ?>>Wall of 4:3 thumbs</option>
                        <option value="tenth" <?php selected( pix_esc_option('pix_posts_page_layout'), 'tenth' ); ?>>Wall of 16:9 thumbs</option>
                    </select>
                </div>

                <label for="pix_posts_page_filter">Display the sorting bar on the posts page:</label>
                <input type="hidden" name="pix_posts_page_filter" value="0">
                <input type="checkbox" name="pix_posts_page_filter" value="true" <?php if(pix_esc_option('pix_posts_page_filter')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_posts_page_order">Display the &quot;Order&quot; filter on the posts page:</label>
                <input type="hidden" name="pix_posts_page_order" value="0">
                <input type="checkbox" name="pix_posts_page_order" value="true" <?php if(pix_esc_option('pix_posts_page_order')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_posts_page_sort">Display the &quot;Sort by tag&quot; filter on the posts pages:</label>
                <input type="hidden" name="pix_posts_page_sort" value="0">
                <input type="checkbox" name="pix_posts_page_sort" value="true" <?php if(pix_esc_option('pix_posts_page_sort')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_posts_page_titles">Display the titles of the items:</label>
                <input type="hidden" name="pix_posts_page_titles" value="0">
                <input type="checkbox" name="pix_posts_page_titles" value="true" <?php if(pix_esc_option('pix_posts_page_titles')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <div class="slider_div border">
                                        
                    <label for="pix_posts_page_excerpt_length">Amount of lines for the excerpts:</label>
                    <div class="field_wrap">
                        <input type="text" name="pix_posts_page_excerpt_length" value="<?php echo pix_get_option('pix_posts_page_excerpt_length'); ?>">
                    </div>
                    <div class="slider_cursor"></div>
                
                </div><!-- .slider_div -->    

                <div class="clear"></div>
                
                <label for="pix_posts_page_more">Display the &quot;Read more&quot; link:</label>
                <input type="hidden" name="pix_posts_page_more" value="0">
                <input type="checkbox" name="pix_posts_page_more" value="true" <?php if(pix_esc_option('pix_posts_page_more')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_posts_page_like">Display the &quot;Like&quot; button:</label>
                <div class="field_wrap">
                    <select name="pix_posts_page_like">
                        <option value="" <?php selected( pix_esc_option('pix_posts_page_like'), '' ); ?>>Inherit</option>
                        <option value="true" <?php selected( pix_esc_option('pix_posts_page_like'), 'true' ); ?>>Yes</option>
                        <option value="false" <?php selected( pix_esc_option('pix_posts_page_like'), 'false' ); ?>>No</option>
                    </select>
                </div>

                <div class="clear"></div>
                
                <label for="pix_posts_page_meta">Display the meta info (categories, author):</label>
                <input type="hidden" name="pix_posts_page_meta" value="0">
                <input type="checkbox" name="pix_posts_page_meta" value="true" <?php if(pix_esc_option('pix_posts_page_meta')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_posts_page_comments">Display the amount of comments:</label>
                <input type="hidden" name="pix_posts_page_comments" value="0">
                <input type="checkbox" name="pix_posts_page_comments" value="true" <?php if(pix_esc_option('pix_posts_page_comments')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_posts_page_linkto">Link the pictures to the posts or open in a ColorBox:</label>
                <div class="field_wrap">
                    <select name="pix_posts_page_linkto">
                        <option value="colorbox" <?php selected( pix_esc_option('pix_posts_page_linkto'), 'colorbox' ); ?>>ColorBox</option>
                        <option value="page" <?php selected( pix_esc_option('pix_posts_page_linkto'), 'page' ); ?>>Posts</option>
                        <option value="none" <?php selected( pix_esc_option('pix_posts_page_linkto'), 'none' ); ?>>None</option>
                    </select>
                </div>
                
                <div class="clear"></div>
                
                <label for="pix_posts_page_pagenavi">Page navigation:</label>
                <div class="field_wrap">
                    <select name="pix_posts_page_pagenavi">
                        <option value="" <?php selected( pix_esc_option('pix_posts_page_pagenavi'), '' ); ?>>Page numbers</option>
                        <option value="infinite" <?php selected( pix_esc_option('pix_posts_page_pagenavi'), 'infinite' ); ?>>Infinite scroll button</option>
                    </select>
                </div>
           
        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>