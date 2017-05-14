<?php

function main_section(){
	global $options;
	if ($_GET['page']=='main_section') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	General: <small>main section</small>
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

                <label for="pix_enable_breadcrumbs">Display the breadcrumbs (where available):</label>
                <input type="hidden" name="pix_enable_breadcrumbs" value="0">
                <input type="checkbox" name="pix_enable_breadcrumbs" value="true" <?php if(pix_esc_option('pix_enable_breadcrumbs')=='true') { echo 'checked="checked"'; } ?>>            
                <div class="clear"></div>
                <div class="tip_info_wrap visible_tip">
                    <small class="tip_info">What are they? <a href="http://www.pixedelic.com/forte_support_images/breadcrumbs.jpg" class="colorbox">Click here</a></small>
                </div>
                <div class="clear"></div>

                <label for="pix_enable_titlesection">Display the title section:</label>
                <input type="hidden" name="pix_enable_titlesection" value="0">
                <input type="checkbox" name="pix_enable_titlesection" value="true" <?php if(pix_esc_option('pix_enable_titlesection')=='true') { echo 'checked="checked"'; } ?>>            
                <div class="clear"></div>
                <div class="tip_info_wrap visible_tip">
                    <small class="tip_info">What's that? <a href="http://www.pixedelic.com/forte_support_images/title_section.jpg" class="colorbox">Click here</a>. <strong>N.B.:</strong> if switched off, this setting can't be overwrite with the checkbox available on the page/post back-ends.</small>
                </div>

        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>