<?php

function admin_tweets(){
	if ($_GET['page']=='admin_tweets') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	General: <small>header</small>
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

                <div class="tip_info_wrap visible_tip">
                    <small class="tip_info">If you have any issue to display the tweets on your site, maybe you need to use a OAuth Request Token to request user authorization. It is very simple, just follow this steps:
                    	<ol>
                    		<li>
                    			Register a new app at <a href="https://dev.twitter.com/apps/new" target="_blank">dev.twitter.com/apps/</a> (log in with your user account)
                    		</li>
                    		<li>
                    			Fill the required fields (and agree the terms and conditions and type the captcha, of course) as described here: <a href="https://www.diigo.com/item/image/1fza7/kesv?size=o" target="_blank">look at the screenshot</a>
                    		</li>
                    		<li>
                    			After creating the app, create the access token as described here: <a href="https://www.diigo.com/item/image/1fza7/y513?size=o" target="_blank">look at the screenshot</a> 
                    		</li>
                    		<li>
                    			Now you should see the tokens instead of the blue button (maybe this could take some seconds): <a href="https://www.diigo.com/item/image/1fza7/6e3d?size=o" target="_blank">look at the screenshot</a>. Copy the value of the fields with the red arrows here below.
                    		</li>
                    	</ol>
                    </small>
                </div>
                <div class="clear"></div>

                <label for="pix_consumer_key">Consumer key:</label>
                <div class="field_wrap">
                    <input name="pix_consumer_key" type="text" value="<?php echo pix_esc_option('pix_consumer_key'); ?>">
                </div>

                <label for="pix_consumer_secret">Consumer secret:</label>
                <div class="field_wrap">
                    <input name="pix_consumer_secret" type="text" value="<?php echo pix_esc_option('pix_consumer_secret'); ?>">
                </div>

                <label for="pix_access_token">Access token:</label>
                <div class="field_wrap">
                    <input name="pix_access_token" type="text" value="<?php echo pix_esc_option('pix_access_token'); ?>">
                </div>

                <label for="pix_access_token_secret">Access token secret:</label>
                <div class="field_wrap">
                    <input name="pix_access_token_secret" type="text" value="<?php echo pix_esc_option('pix_access_token_secret'); ?>">
                </div>

        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>

<?php }
} ?>