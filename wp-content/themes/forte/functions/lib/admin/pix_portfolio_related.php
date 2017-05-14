<?php

function portfolio_related(){
	global $options;
	if ($_GET['page']=='portfolio_related') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Portfolio: <small>related items</small>
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

                <label for="pix_portfolio_related_layout">Related posts layout:</label>
                <div class="field_wrap">
                    <select name="pix_portfolio_related_layout">
                        <option value="second" <?php selected( pix_esc_option('pix_portfolio_related_layout'), 'second' ); ?>>One column wide thumb (16:9) + floating text</option>
                        <option value="third" <?php selected( pix_esc_option('pix_portfolio_related_layout'), 'third' ); ?>>One column wide thumb (4:3) + floating text</option>
                        <option value="sixth" <?php selected( pix_esc_option('pix_portfolio_related_layout'), 'sixth' ); ?>>Grid thumbs</option>
                        <option value="sixth_bis" <?php selected( pix_esc_option('pix_portfolio_related_layout'), 'sixth_bis' ); ?>>Gridthumbs (masonry)</option>
                    </select>
                </div>
                
                <div class="slider_div border">
                                        
                    <label for="pix_portfolio_related_ppp">Amount of posts:</label>
                    <div class="field_wrap">
                        <input type="text" name="pix_portfolio_related_ppp" value="<?php echo pix_get_option('pix_portfolio_related_ppp'); ?>">
                    </div>
                    <div class="slider_cursor"></div>
                
                </div><!-- .slider_div -->    
           
                <div class="clear"></div>
                
                <label for="pix_portfolio_related_titles">Display the titles of the posts:</label>
                <input type="hidden" name="pix_portfolio_related_titles" value="0">
                <input type="checkbox" name="pix_portfolio_related_titles" value="true" <?php if(pix_esc_option('pix_portfolio_related_titles')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <div class="slider_div border">
                                        
                    <label for="pix_portfolio_related_excerpt_length">Amount of lines for the excerpts:</label>
                    <div class="field_wrap">
                        <input type="text" name="pix_portfolio_related_excerpt_length" value="<?php echo pix_get_option('pix_portfolio_related_excerpt_length'); ?>">
                    </div>
                    <div class="slider_cursor"></div>
                
                </div><!-- .slider_div -->    
    
                <label for="pix_portfolio_related_more">Display the &quot;Read more&quot; link:</label>
                <input type="hidden" name="pix_portfolio_related_more" value="0">
                <input type="checkbox" name="pix_portfolio_related_more" value="true" <?php if(pix_esc_option('pix_portfolio_related_more')=='true') { echo 'checked="checked"'; } ?>>

                <div class="clear"></div>
                
                <label for="pix_portfolio_related_linkto">Link the pictures to the item pages or open in a ColorBox:</label>
                <div class="field_wrap">
                    <select name="pix_portfolio_related_linkto" id="pix_portfolio_related_linkto">
                        <option value="colorbox" <?php selected( pix_esc_option('pix_portfolio_related_linkto'), 'colorbox' ); ?>>ColorBox</option>
                        <option value="page" <?php selected( pix_esc_option('pix_portfolio_related_linkto'), 'page' ); ?>>Page items</option>
                        <option value="none" <?php selected( pix_esc_option('pix_portfolio_related_linkto'), 'none' ); ?>>None</option>
                    </select>
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