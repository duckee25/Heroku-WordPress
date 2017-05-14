<?php

function category_hack(){
	global $options;
	if ($_GET['page']=='category_hack') { 
	
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Utilities: <small>categories</small>
                <div class="yellow_button button_floating">
                	<div class="button_left"></div>
                	<div class="button_right"></div>
                	<div class="button_body"></div>
                	<a href="#" class="save_changes">save changes</a>
                </div>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
            <form method="post" class="dynamic_form ajax_fake">

            	<label for="pix_category_hack">How many categories do you need to set:</label>
                <div class="field_wrap">
                    <select name="pix_category_hack[]" multiple class="pix_multiple_hack">
                        <option value="all"<?php if ( (is_array(pix_get_option('pix_category_hack')) && in_array('all',pix_get_option('pix_category_hack')) || pix_get_option('pix_category_hack')=='all')) { echo ' selected="selected"'; } ?>>All the categories</option>
                        <?php 
                        $categories =  get_categories(); 
                        foreach ($categories as $category) { ?>
                            <option value="<?php echo $category->term_id; ?>"<?php if ( (is_array(pix_get_option('pix_category_hack')) && in_array($category->term_id,pix_get_option('pix_category_hack')) || pix_get_option('pix_category_hack')==$category->term_id)) { echo ' selected="selected"'; } ?>><?php echo $category->cat_name; ?></option>
                        <?php } ?>
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