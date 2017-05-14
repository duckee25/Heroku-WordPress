<?php

function general_seo(){
	global $options;
	if ($_GET['page']=='general_seo') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	General: <small>search engine optimization</small>
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

            	<label for="pix_allow_seo">Use the Forte resident SEO feature:</label>
                <input type="hidden" name="pix_allow_seo" value="0">
                <input type="checkbox" name="pix_allow_seo" value="true" <?php if(pix_esc_option('pix_allow_seo')=='true') { echo 'checked="checked"'; } ?>>
                <div class="clear"></div>

            	<label for="pix_generalmetatitle">Meta title:</label>
                <div class="field_wrap"><input name="pix_generalmetatitle" type="text" class="pix_title_seo" value="<?php echo pix_esc_option('pix_generalmetatitle'); ?>"></div>

            	<label for="pix_generalmetadescription">Meta description:</label>
                <div class="field_wrap"><input name="pix_generalmetadescription" type="text" class="pix_desc_seo" value="<?php echo pix_esc_option('pix_generalmetadescription'); ?>"></div>
                           
             	<label for="pix_generalmetakeys">Meta keywords</label>
                <div class="field_wrap"><textarea name="pix_generalmetakeys"><?php echo pix_esc_option('pix_generalmetakeys'); ?></textarea></div>
           

        <input type="hidden" name="action" value="data_save" />
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>" />
        <input type="submit" class="hidden_div" value="" />
            </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>