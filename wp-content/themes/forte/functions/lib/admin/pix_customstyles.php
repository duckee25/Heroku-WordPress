<?php

function custom_styles(){
	global $options;
	if ($_GET['page']=='custom_styles') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Custom styles <small></small>
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

            <div class="field_wrap"><textarea name="pix_customstyles" id="pix_customstyles"><?php echo pix_esc_option('pix_customstyles'); ?></textarea></div>
                           

            

        <input type="hidden" name="action" value="data_save" />
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>" />
        <input type="submit" class="hidden_div" value="" />
            </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>