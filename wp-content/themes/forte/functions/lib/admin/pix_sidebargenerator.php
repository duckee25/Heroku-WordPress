<?php

function sidebar_generator(){
	global $options, $current_user;
	if ($_GET['page']=='sidebar_generator') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Sidebars: <small>create your sidebars</small>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
            <form method="post" class="dynamic_form" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">

                <label for="pix_sidebar_generator_">Add a sidebar:</label>
                <div class="field_wrap">
                    <input name="pix_sidebar_generator_" id="pix_sidebar_generator_"type="text" value="">
                    <div class="grey_button alignleft pix_add_field">
                        <div class="button_left"></div>
                        <div class="button_right"></div>
                        <div class="button_body"></div>
                        <a href="#" class="create_sidebar">create the sidebar</a>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                	<small class="tip_info">Type here above an identificative name for your sidebar, use latin characters only</small>
                </div><!-- .tip_info_wrap -->

                <input type="hidden" name="action" value="data_save">
                <input type="hidden" name="sidebar_action" value="add_a_sidebar">
                <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
                <input type="submit" class="hidden_div" value="">
            </form><!-- .dynamic_form -->


                
            <form method="post" class="dynamic_form" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">

                     	<label>Your sidebars</label>
            <input type="hidden" class="pix_sidebar_input" name="pix_sidebar_generator_1" value="" />
    <?php
    $get_sidebar_options = sidebar_generator_pix::get_sidebars();
    if($get_sidebar_options != "") {
    $i=1;
    
    foreach ($get_sidebar_options as $sidebar_gen) { ?>
    <?php if($i == 1) { ?>
    
    <?php } ?>
    
        <div id="sidebar_row_<?php echo $i; ?>" class="field_wrap pix_sidebar_row">
        	<span class="serif-with-grace"><?php echo $i.'. '; ?></span>
            <strong><?php echo $sidebar_gen; ?></strong>

            <input type="hidden" class="pix_sidebar_input" name="<?php echo 'pix_sidebar_generator_'.$i ?>" value="<?php echo $sidebar_gen; ?>" />
            <div class="pix_remove_sidebar">
                <a href="#" data-remove="<?php echo $i; ?>">&nbsp;</a>
            </div>
        </div>
    <?php $i++;  
    }
    } else {
		echo 'You still have no sidebars';
	}
    

    ?>

                <input type="hidden" name="action" value="data_save">
                <input type="hidden" name="sidebar_action" value="remove_a_sidebar">
                <input type="hidden" name="sidebar_removed" value="">
                <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
                <input type="submit" class="hidden_div" value="">
            </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>