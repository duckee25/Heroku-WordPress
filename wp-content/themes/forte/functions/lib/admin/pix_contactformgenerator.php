<?php

function contact_form_generator(){
	global $options, $current_user;
	if ($_GET['page']=='contact_form_generator') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Contact forms: <small>create or delete a form</small>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
            <form method="post" class="dynamic_form check_forms" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">

 <?php
	$get_contact_forms = pix_get_option('pix_array_your_forms_');
	if($get_contact_forms != "") {
    
		foreach ($get_contact_forms as $contact_form_gen) { ?>
                 <input type="hidden" name="<?php echo 'pix_array_your_forms_['.$contact_form_gen.']'; ?>" value="<?php echo $contact_form_gen; ?>">
	   <?php
		}
    }
?>               <label for="pix_array_your_forms_[<?php echo $contact_form_gen; ?>]">Add a form:</label>
                <div class="field_wrap">
                    <input name="pix_array_your_forms_[<?php echo $contact_form_gen; ?>]" id="pix_array_your_forms_" type="text" value="">
                    <div class="grey_button alignleft pix_add_field">
                        <div class="button_left"></div>
                        <div class="button_right"></div>
                        <div class="button_body"></div>
                        <a href="#" class="create_contact_form">create the form</a>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                	<small class="tip_info">Type here above an identificative name for your contact form, use latin characters only</small>
                </div><!-- .tip_info_wrap -->

                <input type="hidden" name="action" value="data_save">
                <input type="hidden" name="contact_form_action" value="add_a_contact_form">
                <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
                <input type="submit" class="hidden_div" value="">
            </form><!-- .dynamic_form -->


                
            <form method="post" class="dynamic_form" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">

                     	<label>Your contact forms</label>
            <input type="hidden" class="pix_contact_form_check" name="pix_array_your_forms_" value="">
    <?php
    $get_contact_form_options = pix_get_option('pix_array_your_forms_');
    if($get_contact_form_options != "") {
    $i=1;
    
    foreach ($get_contact_form_options as $contact_form_gen) { ?>
        <div id="contact_form_row_<?php echo $i; ?>" class="field_wrap pix_contact_form_row">
        	<span class="serif-with-grace"><?php echo $i.'. '; ?></span>
            <input type="hidden" class="pix_contact_form_check" name="pix_array_your_forms_[<?php echo $contact_form_gen; ?>]" value="<?php echo $contact_form_gen; ?>">
            <strong><?php echo $contact_form_gen; ?></strong>

            <div class="pix_remove_contact_form">
                <a href="#" data-remove="<?php echo 'pix_array_your_forms_'.$contact_form_gen; ?>">&nbsp;</a>
            </div>
        </div>
    <?php $i++;  
    }
    } else {
		echo 'You still have no contact forms';
	}
    ?>

                <input type="hidden" class="pix_contact_form_input" name="" value="remove_a_contact_form">
                <input type="hidden" name="action" value="data_save">
                <input type="hidden" name="contact_form_removed" value="">
                <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
                <input type="submit" class="hidden_div" value="">
            </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>