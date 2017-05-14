<?php

function contact_form_manage(){
	global $options;
	if ($_GET['page']=='contact_form_manage') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Contact forms: <small>manage your form</small>
                <div class="yellow_button button_floating">
                	<div class="button_left"></div>
                	<div class="button_right"></div>
                	<div class="button_body"></div>
                	<a href="#" class="save_changes">save changes</a>
                </div>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
                <div class="pix_slide clone">
                    <div class="pix_slide_move"><span></span></div>
                    <div class="field_wrap">
                        <label class="inner_label">Type:</label>
                        <select name="<?php echo 'pix_array_your_forms_'.$_GET['form'].'[fields][Nvariable][type]'; ?>" class="clone_select">
                                    <option value="text" selected data-sc="pix_text">Text</option>
                                    <option value="alt_email" data-sc="pix_alt_email">Alternative email</option>
                                    <option value="textarea" data-sc="pix_textarea">Textarea</option>
                                    <option value="select" data-sc="pix_select">Select</option>
                                    <option value="multiple" data-sc="pix_select_mult">Multiple select</option>
                                    <option value="checkbox" data-sc="pix_checkbox">Checkbox</option>
                                    <option value="radio" data-sc="pix_radio">Radio button</option>
                                    <option value="from" data-sc="pix_period_from">Period (from)</option>
                                    <option value="to" data-sc="pix_period_to">Period (to)</option>
                                    <option value="captcha" data-sc="pix_captcha_input">Captcha</option>
                        </select>

                        <label class="inner_label margin_left">Required:</label>
                        <div class="alignleft wrap_check">
                            <input 
                                type="checkbox" 
                                name="<?php echo 'pix_array_your_forms_'.$_GET['form'].'[fields][Nvariable][required]'; ?>"
                                class="clone_check"
                                value="true">
                        </div>
                        
                        <div class="clear less_space"></div>

                        <label class="inner_label">Name attribute:</label>
                        <input 
                            type="text" 
                            name="<?php echo 'pix_array_your_forms_'.$_GET['form'].'[fields][Nvariable][name]'; ?>"
                            value="Field:">
                        
                        <div class="clear less_space"></div>

                        <label class="inner_label">Unlock the output from the name attribute:</label>
                        <div class="alignleft wrap_check">
                            <input 
                                type="checkbox" 
                                name="<?php echo 'pix_array_your_forms_'.$_GET['form'].'[fields][Nvariable][unlock]'; ?>"
                                class="clone_check lock"
                                value="true">
                        </div>
                        
                        <div class="clear less_space"></div>

                        <label class="inner_label">Output:</label>
                        <textarea name="<?php echo 'pix_array_your_forms_'.$_GET['form'].'[fields][Nvariable][output]'; ?>"><label>Field:</label>
[pix_text field="Field:" name="field"]</textarea>
                    </div>
                    
                    <div class="pix_remove_slide">
                        <a href="#">&nbsp;</a>
                    </div>
                </div><!-- .pix_slide.clone -->

				<?php if (pix_esc_option('pix_allow_ajax')=='true') { ?>
                <form action="/" class="dynamic_form ajax_form">
                <?php } else { ?>
                <form method="post" class="dynamic_form" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
                <?php } ?>   
 
<?php $pix_array_your_forms = pix_get_option('pix_array_your_forms_'.$_GET['form']); ?>         
                	<label for="pix_array_your_forms_<?php echo $_GET['form']; ?>[recipient]">Recipient address:</label>
                    <div class="field_wrap">
                    	<input type="text" name="pix_array_your_forms_<?php echo $_GET['form']; ?>[recipient]" value="<?php if($pix_array_your_forms['recipient']=='') { echo get_option('admin_email'); } else { echo stripslashes($pix_array_your_forms['recipient']); } ?>">
                    </div>   
                    
                    <div class="clear"></div>      
    
                	<label for="pix_array_your_forms_<?php echo $_GET['form']; ?>[subject]">Email subject:</label>
                    <div class="field_wrap">
                    	<input type="text" name="pix_array_your_forms_<?php echo $_GET['form']; ?>[subject]" value="<?php if($pix_array_your_forms['subject']=='') { echo 'Email from '.get_bloginfo( 'name' ); } else { echo stripslashes($pix_array_your_forms['subject']); } ?>">
                    </div>   
                    
                    <div class="clear"></div>      
    
                	<label for="pix_array_your_forms_<?php echo $_GET['form']; ?>[success]">Success message:</label>
                    <div class="field_wrap">
                    	<textarea name="pix_array_your_forms_<?php echo $_GET['form']; ?>[success]"><?php if($pix_array_your_forms['success']=='') { echo '<strong>Thank you!</strong> We received your message'; } else { echo stripslashes($pix_array_your_forms['success']); } ?></textarea>
                    </div>   
                    
                    <div class="clear"></div>      
    
                	<label for="pix_array_your_forms_<?php echo $_GET['form']; ?>[unsuccess]">Unsuccess message:</label>
                    <div class="field_wrap">
                    	<textarea name="pix_array_your_forms_<?php echo $_GET['form']; ?>[unsuccess]"><?php if($pix_array_your_forms['unsuccess']=='') { echo '<strong>Sorry, unexpected error.</strong> Please try again later'; } else { echo stripslashes($pix_array_your_forms['unsuccess']); } ?></textarea>
                    </div>   
                    
                    <div class="clear"></div>      
    
                	<label for="pix_array_your_forms_<?php echo $_GET['form']; ?>[button]">Send button:</label>
                    <div class="field_wrap">
                    	<input type="text" name="pix_array_your_forms_<?php echo $_GET['form']; ?>[button]" value="<?php if($pix_array_your_forms['button']=='') { echo 'Send'; } else { echo stripslashes($pix_array_your_forms['button']); } ?>">
                    </div>   
                    
                    <div class="clear"></div>      
    
                    <label>Check here below if you want to receive among the form fields the page where the contact form has been sended:</label>
                    <div class="wrap_check">
                        <input name="pix_array_your_forms_<?php echo $_GET['form']; ?>[pagefrom]" type="hidden" value="0">
                        <input name="pix_array_your_forms_<?php echo $_GET['form']; ?>[pagefrom]" type="checkbox" value="true" <?php if ( isset( $pix_array_your_forms['pagefrom'] ) && $pix_array_your_forms['pagefrom'] == 'true' ) { echo 'checked'; } ?>>
                    </div>

                    
                	<label>Your form fields:</label>

                    
                    <div class="pix_slides pix_contact_forms">
                    <div id="message" class="error compile_error">
                    	<p>You can't use the same <strong>name attribute</strong> twice in a form. Please check and fix</p>
                    </div>

<?php
	$get_contact_form_field = $pix_array_your_forms['fields'];
	$i = 0;
	$count = count($get_contact_form_field);
	if($count==0){
		$count = 1;
	}
	while ($i<$count) { ?>
					<div class="pix_slide">
						<div class="field_wrap">
							<div class="pix_slide_move"><span></span></div>
							<label for="pix_array_your_forms_<?php echo $_GET['form']; ?>[fields][<?php echo $i; ?>][type]" class="inner_label">Type:</label>
		<?php if ($get_contact_form_field[$i]['type']=='email' || $get_contact_form_field == "") { ?>
							<div class="alignleft">
								<select name="<?php echo 'pix_array_your_forms_'.$_GET['form'].'[fields]['.$i.'][type]'; ?>">
									<option value="email" selected>Email</option>
								</select>
                                &nbsp;&nbsp;
							</div>
							<span class="serif-with-grace">Each form must have the email address field. You can have only one email address field and it is &quot;required&quot; by default</span>
		<?php } else { ?>
							<select name="<?php echo 'pix_array_your_forms_'.$_GET['form'].'[fields]['.$i.'][type]'; ?>">
								<option value="text" <?php selected( $get_contact_form_field[$i]['type'], 'text'); ?> data-sc="pix_text">Text</option>
								<option value="alt_email" <?php selected( $get_contact_form_field[$i]['type'], 'alt_email'); ?> data-sc="pix_alt_email">Alternative email</option>
								<option value="textarea" <?php selected( $get_contact_form_field[$i]['type'], 'textarea'); ?> data-sc="pix_textarea">Textarea</option>
								<option value="select" <?php selected( $get_contact_form_field[$i]['type'], 'select'); ?> data-sc="pix_select">Select</option>
								<option value="multiple" <?php selected( $get_contact_form_field[$i]['type'], 'multiple'); ?> data-sc="pix_select_mult">Multiple select</option>
								<option value="checkbox" <?php selected( $get_contact_form_field[$i]['type'], 'checkbox'); ?> data-sc="pix_checkbox">Checkbox</option>
								<option value="radio" <?php selected( $get_contact_form_field[$i]['type'], 'radio'); ?> data-sc="pix_radio">Radio button</option>
								<option value="from" <?php selected( $get_contact_form_field[$i]['type'], 'from'); ?> data-sc="pix_period_from">Period (from)</option>
								<option value="to" <?php selected( $get_contact_form_field[$i]['type'], 'to'); ?> data-sc="pix_period_to">Period (to)</option>
								<option value="captcha" <?php selected( $get_contact_form_field[$i]['type'], 'captcha'); ?> data-sc="pix_captcha_input">Captcha</option>
							</select>
							
							<label for="pix_array_your_forms_<?php echo $_GET['form']; ?>[fields][<?php echo $i; ?>][required]" class="inner_label margin_left">Required:</label>
							<div class="alignleft wrap_check">
								<input 
									type="checkbox" 
									name="<?php echo 'pix_array_your_forms_'.$_GET['form'].'[fields]['.$i.'][required]'; ?>"
									value="true"
									<?php if ( isset($get_contact_form_field[$i]['required']) && $get_contact_form_field[$i]['required']=='true' ) echo ' checked'; ?>>
							</div>
		<?php } ?>            
							
							<div class="clear less_space"></div>

							<label for="pix_array_your_forms_<?php echo $_GET['form']; ?>[fields][<?php echo $i; ?>][name]" class="inner_label">Name attribute:</label>
							<input 
								type="text" 
								name="<?php echo 'pix_array_your_forms_'.$_GET['form'].'[fields]['.$i.'][name]'; ?>"
								value="<?php echo $get_contact_form_field[$i]['name']!='' ? $get_contact_form_field[$i]['name'] : 'Email address:'; ?>">
							
							<div class="clear less_space"></div>
							
							<label for="pix_array_your_forms_<?php echo $_GET['form']; ?>[fields][<?php echo $i; ?>][unlock]" class="inner_label">Unlock the output from the name attribute:</label>
							<div class="alignleft wrap_check">
								<input 
									type="checkbox" 
									name="<?php echo 'pix_array_your_forms_'.$_GET['form'].'[fields]['.$i.'][unlock]'; ?>"
									value="true"
                                    class="lock"
									<?php if ( isset($get_contact_form_field[$i]['unlock']) && $get_contact_form_field[$i]['unlock']=='true' ) echo ' checked'; ?>>
							</div>
                            
							<div class="clear less_space"></div>
							
							<label for="pix_array_your_forms_<?php echo $_GET['form']; ?>[fields][<?php echo $i; ?>][output]" class="inner_label">Output:</label>
							<textarea name="<?php echo 'pix_array_your_forms_'.$_GET['form'].'[fields]['.$i.'][output]'; ?>"><?php echo $get_contact_form_field[$i]['output']!='' ? stripslashes($get_contact_form_field[$i]['output']) : stripslashes('<label>Email address:</label>
[pix_email]'); ?></textarea>
						</div>
						
		<?php if ($get_contact_form_field[$i]['type']!='email' && $get_contact_form_field != "") { ?>
						<div class="pix_remove_slide">
							<a href="#">&nbsp;</a>
						</div>
		<?php } ?>  
				  
					</div><!-- .pix_slide -->
   <?php
	$i++; }
?>
<div data-stored="pix_text" class="hidden_div"><label>NvariableName</label>
[pix_text field="NvariableName" name="NvariableNameI"]</div><!-- pix_text -->

<div data-stored="pix_alt_email" class="hidden_div"><label>NvariableName</label>
[pix_alt_email field="NvariableName" name="NvariableNameI"]</div><!-- pix_alt_email -->

<div data-stored="pix_textarea" class="hidden_div"><label>NvariableName</label>
[pix_textarea field="NvariableName" name="NvariableNameI"]</div><!-- pix_textarea -->

<div data-stored="pix_select" class="hidden_div"><label>NvariableName</label>
[pix_select field="NvariableName" name="NvariableNameI"]
[pix_option value=""]Select an option[/pix_option]
[pix_option value="First"]First[/pix_option]
[pix_option value="Second"]Second[/pix_option]
[/pix_select]</div><!-- pix_select -->

<div data-stored="pix_select_mult" class="hidden_div"><label>NvariableName</label>
[pix_select field="NvariableName" name="NvariableNameI" multiple="multiple"]
[pix_option value="First"]First[/pix_option]
[pix_option value="Second"]Second[/pix_option]
[/pix_select]</div><!-- pix_select_mult -->

<div data-stored="pix_checkbox" class="hidden_div"><label>NvariableName</label>
[pix_checkbox field="NvariableName" name="NvariableNameI"]</div><!-- pix_checkbox -->

<div data-stored="pix_radio" class="hidden_div"><label>NvariableName</label>
[pix_radio field="NvariableName" name="NvariableNameI" value="First button"]
[pix_radio field="NvariableName" name="NvariableNameI" value="Second button"]</div><!-- pix_radio -->

<div data-stored="pix_period_from" class="hidden_div"><label>NvariableName</label>
[pix_period_from field="NvariableName" name="NvariableNameI"]</div><!-- pix_period_from -->

<div data-stored="pix_period_to" class="hidden_div"><label>NvariableName</label>
[pix_period_to field="NvariableName" name="NvariableNameI"]</div><!-- pix_period_to -->

<div data-stored="pix_captcha_input" class="hidden_div"><label>NvariableName</label>
<div class="captchaCont">[pix_captcha_img] [pix_captcha_input]</div></div><!-- pix_captcha_input -->

                    <div class="grey_button pix_add_contact_field">
                        <div class="button_left"></div>
                        <div class="button_right"></div>
                        <div class="button_body"></div>
                        <a href="#">add a contact field</a>
                    </div>
                </div>
                <input type="hidden" name="action" value="data_save">
                <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
                <input type="submit" class="hidden_div" value="">
            </form><!-- .dynamic_form -->


        </div><!-- #forte_content_content -->
</div>


<?php }
} ?>