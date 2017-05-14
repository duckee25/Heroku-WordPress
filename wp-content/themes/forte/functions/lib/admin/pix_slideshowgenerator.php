<?php

function slideshow_generator(){
	global $options, $current_user;
	if ($_GET['page']=='slideshow_generator') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Slideshows: <small>create or delete a slideshow</small>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
            <form method="post" class="dynamic_form check_slideshows" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">

 <?php
	$get_slideshows = pix_get_option('pix_array_your_slideshows_');
	if($get_slideshows != "") {
    
		foreach ($get_slideshows as $slideshow_gen) { ?>
                 <input type="hidden" name="<?php echo 'pix_array_your_slideshows_['.$slideshow_gen.']'; ?>" value="<?php echo $slideshow_gen; ?>">
	   <?php
		}
    }
?>               <label for="pix_array_your_slideshows_[<?php echo $slideshow_gen; ?>]">Add a slideshow:</label>
                <div class="field_wrap">
                    <input name="pix_array_your_slideshows_[<?php echo $slideshow_gen; ?>]" id="pix_array_your_slideshows_" type="text"value="">
                    <div class="grey_button alignleft pix_add_field">
                        <div class="button_left"></div>
                        <div class="button_right"></div>
                        <div class="button_body"></div>
                        <a href="#" class="create_slideshow">create the slideshow</a>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                	<small class="tip_info">Type here above an identificative name for your slideshow, use latin characters only</small>
                </div><!-- .tip_info_wrap -->

                <input type="hidden" name="action" value="data_save">
                <input type="hidden" name="slideshow_action" value="add_a_slideshow">
                <input type="hidden" name="slideshow_cloned" value="">
                <input type="hidden" name="slideshow_clone" value="">
                <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
                <input type="submit" class="hidden_div" value="">
            </form><!-- .dynamic_form -->


                
            <form method="post" class="dynamic_form" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">

                     	<label>Your slideshows</label>
            <input type="hidden" class="pix_slideshow_check" name="pix_array_your_slideshows_" value="">
    <?php
    $get_slideshow_options = pix_get_option('pix_array_your_slideshows_');
    if($get_slideshow_options != "") {
    $i=1;
    
    foreach ($get_slideshow_options as $slideshow_gen) { ?>
        <div id="slideshow_row_<?php echo $i; ?>" class="field_wrap pix_slideshow_row">
        	<span class="serif-with-grace"><?php echo $i.'. '; ?></span>
            <input type="hidden" class="pix_slideshow_check" name="pix_array_your_slideshows_[<?php echo $slideshow_gen; ?>]" value="<?php echo $slideshow_gen; ?>">
            <strong><?php echo $slideshow_gen; ?></strong>

            <div class="pix_remove_slideshow">
                <a href="#" data-remove="<?php echo 'pix_array_your_slideshows_'.$slideshow_gen; ?>">&nbsp;</a>
            </div>

            <div class="pix_clone_slideshow">
                <a href="#" data-clone="<?php echo $slideshow_gen; ?>">&nbsp;</a>
            </div>
        </div>
    <?php $i++;  
    }
    } else {
		echo 'You still have no slideshows';
	}
    ?>

                <input type="hidden" class="pix_slideshow_input" name="" value="remove_a_slideshow"> 
                <input type="hidden" name="action" value="data_save">
                <input type="hidden" name="slideshow_removed" value="">
                <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
                <input type="submit" class="hidden_div" value="">
            </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>