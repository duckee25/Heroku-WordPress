<?php

function blog_posts(){
	global $options;
	if ($_GET['page']=='blog_posts') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Blog: <small>posts (general)</small>
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

                <label for="pix_posts_featured_image">Hide the featured image on single posts (if switch it on, this option will override the settings on the single posts):</label>
                <input type="hidden" name="pix_posts_featured_image" value="0">
                <input type="checkbox" name="pix_posts_featured_image" value="true" <?php if(pix_esc_option('pix_posts_featured_image')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_date_posts">Display the date below the post titles:</label>
                <input type="hidden" name="pix_date_posts" value="0">
                <input type="checkbox" name="pix_date_posts" value="true" <?php if(pix_esc_option('pix_date_posts')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_like_posts">Enable "Like" buttons:</label>
                <input type="hidden" name="pix_like_posts" value="0">
                <input type="checkbox" name="pix_like_posts" value="true" <?php if(pix_esc_option('pix_like_posts')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_endmeta_posts">Display the meta-info below the posts (categories, tags):</label>
                <input type="hidden" name="pix_endmeta_posts" value="0">
                <input type="checkbox" name="pix_endmeta_posts" value="true" <?php if(pix_esc_option('pix_endmeta_posts')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_author_posts">Display the author of the posts:</label>
                <input type="hidden" name="pix_author_posts" value="0">
                <input type="checkbox" name="pix_author_posts" value="true" <?php if(pix_esc_option('pix_author_posts')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_share_posts">Display the share buttons below the posts:</label>
                <input type="hidden" name="pix_share_posts" value="0">
                <input type="checkbox" name="pix_share_posts" value="true" <?php if(pix_esc_option('pix_share_posts')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_prevnext_posts">Display prev/next posts links:</label>
                <input type="hidden" name="pix_prevnext_posts" value="0">
                <input type="checkbox" name="pix_prevnext_posts" value="true" <?php if(pix_esc_option('pix_prevnext_posts')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_posts_sidebar">Default sidebar:</label>
                <div class="field_wrap">
                    <select name="pix_posts_sidebar">
                        <option value="forte_default_sidebar" <?php selected( pix_esc_option('pix_posts_sidebar'), 'forte_default_sidebar' ); ?>>Forte default sidebar</option>
						<?php
                        $get_sidebar_options = sidebar_generator_pix::get_sidebars();
                        if($get_sidebar_options != "") {
                        $i=1;
							foreach ($get_sidebar_options as $sidebar_gen) { ?>                        
									<option value="<?php echo $sidebar_gen; ?>" <?php selected( pix_esc_option('pix_posts_sidebar'), $sidebar_gen ); ?>><?php echo $sidebar_gen; ?></option>
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