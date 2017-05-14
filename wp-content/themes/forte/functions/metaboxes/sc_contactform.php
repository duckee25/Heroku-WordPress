<div class="pix_meta_shortcode" id="contactform_generator">

	<div>
    
        <label>Select a form:</label>
        
        <select>
            <?php 
                $get_contact_form_options = pix_get_option('pix_array_your_forms_');
                if($get_contact_form_options != "") {
                    foreach ($get_contact_form_options as $contact_form_gen) { ?>
                        <option value="<?php echo $contact_form_gen; ?>"><?php echo $contact_form_gen; ?></option>
                    <?php } 
                }
            ?>

        </select>
        <small>To create a form go to Forte admin panel &rarr; Contact forms &rarr; Create your forms</small>
        
        <input type="button" class="button alignright" value="Insert shortcode">
    
    </div>

</div><!-- .pix_meta_shortcode -->
