<?php

function blog_search(){
	global $options;
	if ($_GET['page']=='blog_search') { 
?>

<div id="forte_dynamic_tab">
            <div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
            <div id="forte_content_title">
                Blog: <small>Search page</small>
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

                <label for="pix_search_content">Search page content (if nothing has been found):</label>
                <div class="field_wrap">
                    <textarea name="pix_search_content" class="wide_content"><?php echo pix_esc_option('pix_search_content'); ?></textarea>
                </div>
                <div class="clear"></div>

                <label for="pix_search_template">Search page template:</label>
                <div class="field_wrap">
                    <select name="pix_search_template">
                        <option value="default" <?php selected( pix_esc_option('pix_search_template'), 'default' ); ?>>Default</option>
                        <option value="widepage" <?php selected( pix_esc_option('pix_search_template'), 'widepage' ); ?>>Wide page</option>
                    </select>
                </div>
                <div class="clear"></div>

               <label for="pix_search_sidebar">Search page sidebar:</label>
                <div class="field_wrap">
                    <select name="pix_search_sidebar">
                        <option value="" <?php selected( pix_esc_option('pix_search_sidebar'), '' ); ?>>None</option>
                        <option value="forte_default_sidebar" <?php selected( pix_esc_option('pix_search_sidebar'), 'forte_default_sidebar' ); ?>>Forte default sidebar</option>
                        <?php
                        $get_sidebar_options = sidebar_generator_pix::get_sidebars();
                        if($get_sidebar_options != "") {
                        $i=1;
                            foreach ($get_sidebar_options as $sidebar_gen) { ?>                        
                                    <option value="<?php echo $sidebar_gen; ?>" <?php selected( pix_esc_option('pix_search_sidebar'), $sidebar_gen ); ?>><?php echo $sidebar_gen; ?></option>
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