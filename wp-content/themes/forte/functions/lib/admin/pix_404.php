<?php

function blog_404(){
	global $options;
	if ($_GET['page']=='blog_404') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Blog: <small>404 page</small>
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

                <label for="pix_404_title">404 page title:</label>
                <div class="field_wrap">
                    <input name="pix_404_title" type="text" value="<?php echo pix_esc_option('pix_404_title'); ?>">
                </div>

                <label for="pix_404_subtitle">404 page subtitle:</label>
                <div class="field_wrap">
                    <input name="pix_404_subtitle" type="text" value="<?php echo pix_esc_option('pix_404_subtitle'); ?>">
                </div>

                <label for="pix_404_content">404 page content:</label>
                <div class="field_wrap">
                    <textarea name="pix_404_content" class="wide_content"><?php echo pix_esc_option('pix_404_content'); ?></textarea>
                </div>
                <div class="clear"></div>

                <label for="pix_404_template">404 page template:</label>
                <div class="field_wrap">
                    <select name="pix_404_template">
                        <option value="default" <?php selected( pix_esc_option('pix_404_template'), 'default' ); ?>>Default</option>
                        <option value="widepage" <?php selected( pix_esc_option('pix_404_template'), 'widepage' ); ?>>Wide page</option>
                    </select>
                </div>
                <div class="clear"></div>

               <label for="pix_404_sidebar">404 page sidebar:</label>
                <div class="field_wrap">
                    <select name="pix_404_sidebar">
                        <option value="" <?php selected( pix_esc_option('pix_404_sidebar'), '' ); ?>>None</option>
                        <option value="forte_default_sidebar" <?php selected( pix_esc_option('pix_404_sidebar'), 'forte_default_sidebar' ); ?>>Forte default sidebar</option>
						<?php
                        $get_sidebar_options = sidebar_generator_pix::get_sidebars();
                        if($get_sidebar_options != "") {
                        $i=1;
							foreach ($get_sidebar_options as $sidebar_gen) { ?>                        
									<option value="<?php echo $sidebar_gen; ?>" <?php selected( pix_esc_option('pix_404_sidebar'), $sidebar_gen ); ?>><?php echo $sidebar_gen; ?></option>
							<?php $i++;  
							}
                        }
                        ?>
                    </select>
                </div>
                    
                <div class="clear"></div>
                
            	<label for="pix_404_metatitle">Meta title:</label>
                <div class="field_wrap"><input name="pix_404_metatitle" type="text" class="pix_title_seo" value="<?php echo pix_esc_option('pix_404_metatitle'); ?>"></div>

            	<label for="pix_404_metadescription">Meta description:</label>
                <div class="field_wrap"><input name="pix_404_metadescription" type="text" class="pix_desc_seo" value="<?php echo pix_esc_option('pix_404_metadescription'); ?>"></div>
                           
             	<label for="pix_404_metakeys">Meta keywords</label>
                <div class="field_wrap"><textarea name="pix_404_metakeys"><?php echo pix_esc_option('pix_404_metakeys'); ?></textarea></div>
           
        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>