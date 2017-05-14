<?php

function portfolio_items(){
	global $options;
	if ($_GET['page']=='portfolio_items') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Portfolio: <small>portfolio items (general)</small>
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

                <label for="pix_portfolio_featured_image">Hide the featured image on single portfolio items (if switch it on, this option will override the settings on the single portfolio item):</label>
                <input type="hidden" name="pix_portfolio_featured_image" value="0">
                <input type="checkbox" name="pix_portfolio_featured_image" value="true" <?php if(pix_esc_option('pix_portfolio_featured_image')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_date_portfolio">Display the date below the post titles:</label>
                <input type="hidden" name="pix_date_portfolio" value="0">
                <input type="checkbox" name="pix_date_portfolio" value="true" <?php if(pix_esc_option('pix_date_portfolio')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_like_portfolio">Enable "Like" buttons:</label>
                <input type="hidden" name="pix_like_portfolio" value="0">
                <input type="checkbox" name="pix_like_portfolio" value="true" <?php if(pix_esc_option('pix_like_portfolio')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_endmeta_portfolio">Display the meta-info below the post (categories, tags):</label>
                <input type="hidden" name="pix_endmeta_portfolio" value="0">
                <input type="checkbox" name="pix_endmeta_portfolio" value="true" <?php if(pix_esc_option('pix_endmeta_portfolio')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_author_portfolio">Display the author of the posts:</label>
                <input type="hidden" name="pix_author_portfolio" value="0">
                <input type="checkbox" name="pix_author_portfolio" value="true" <?php if(pix_esc_option('pix_author_portfolio')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_share_portfolio">Display the share buttons below the posts:</label>
                <input type="hidden" name="pix_share_portfolio" value="0">
                <input type="checkbox" name="pix_share_portfolio" value="true" <?php if(pix_esc_option('pix_share_portfolio')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_prevnext_portfolio">Display prev/next posts links:</label>
                <input type="hidden" name="pix_prevnext_portfolio" value="0">
                <input type="checkbox" name="pix_prevnext_portfolio" value="true" <?php if(pix_esc_option('pix_prevnext_portfolio')=='true') { echo 'checked="checked"'; } ?>>
              
                <label for="pix_portfolio_sidebar">Default sidebar:</label>
                <div class="field_wrap">
                    <select name="pix_portfolio_sidebar">
                        <option value="forte_default_sidebar" <?php selected( pix_esc_option('pix_portfolio_sidebar'), 'forte_default_sidebar' ); ?>>Forte default sidebar</option>
						<?php
                        $get_sidebar_options = sidebar_generator_pix::get_sidebars();
                        if($get_sidebar_options != "") {
                        $i=1;
							foreach ($get_sidebar_options as $sidebar_gen) { ?>                        
									<option value="<?php echo $sidebar_gen; ?>" <?php selected( pix_esc_option('pix_portfolio_sidebar'), $sidebar_gen ); ?>><?php echo $sidebar_gen; ?></option>
							<?php $i++;  
							}
                        }
                        ?>
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