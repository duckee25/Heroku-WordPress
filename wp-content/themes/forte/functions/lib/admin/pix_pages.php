<?php

function blog_pages(){
	global $options;
	if ($_GET['page']=='blog_pages') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Blog: <small>pages (general)</small>
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

                <label for="pix_comments_on_page">Display the discussion section on the pages:</label>
                <input type="hidden" name="pix_comments_on_page" value="0">
                <input type="checkbox" name="pix_comments_on_page" value="true" <?php if(pix_esc_option('pix_comments_on_page')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_share_pages">Display the share buttons below the pages:</label>
                <input type="hidden" name="pix_share_pages" value="0">
                <input type="checkbox" name="pix_share_pages" value="true" <?php if(pix_esc_option('pix_share_pages')=='true') { echo 'checked="checked"'; } ?>>

                <label for="pix_pages_sidebar">Default sidebar:</label>
                <div class="field_wrap">
                    <select name="pix_pages_sidebar">
                        <option value="forte_default_sidebar" <?php selected( pix_esc_option('pix_pages_sidebar'), 'forte_default_sidebar' ); ?>>Forte default sidebar</option>
						<?php
                        $get_sidebar_options = sidebar_generator_pix::get_sidebars();
                        if($get_sidebar_options != "") {
                        $i=1;
							foreach ($get_sidebar_options as $sidebar_gen) { ?>                        
									<option value="<?php echo $sidebar_gen; ?>" <?php selected( pix_esc_option('pix_pages_sidebar'), $sidebar_gen ); ?>><?php echo $sidebar_gen; ?></option>
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