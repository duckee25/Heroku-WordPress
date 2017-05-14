<?php

function gallery_hack(){
	global $options;
	if ($_GET['page']=='gallery_hack') { 
	
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Utilities: <small>galleries</small>
                <div class="yellow_button button_floating">
                	<div class="button_left"></div>
                	<div class="button_right"></div>
                	<div class="button_body"></div>
                	<a href="#" class="save_changes">save changes</a>
                </div>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
            <form method="post" class="dynamic_form ajax_fake">

            	<label for="pix_gallery_hack">How many categories do you need to set:</label>
                <div class="field_wrap">
                    <select name="pix_gallery_hack[]" multiple class="pix_multiple_hack">
                        <option value="all"<?php if ( (is_array(pix_get_option('pix_gallery_hack')) && in_array('all',pix_get_option('pix_gallery_hack')) || pix_get_option('pix_gallery_hack')=='all')) { echo ' selected="selected"'; } ?>>All the galleries</option>
						<?php 
						$terms = get_terms("gallery");
                        $count = count($terms);
                        if($count > 0){
                            foreach ($terms as $term) { ?>
                                <option value="<?php echo $term->slug; ?>"<?php if (is_array(pix_get_option('pix_gallery_hack')) && in_array($term->slug,pix_get_option('pix_gallery_hack'))) { echo ' selected="selected"'; } ?>><?php echo $term->name; ?></option>
                        
                            <?php }
                        }
						?>
                    </select>
                </div>
            
        <input type="hidden" name="action" value="data_save" />
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>" />
        <input type="submit" class="hidden_div" value="" />
            </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>