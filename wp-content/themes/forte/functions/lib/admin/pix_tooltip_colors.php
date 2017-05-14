<?php

function tooltips_colors(){
	global $options;
	if ($_GET['page']=='tooltips_colors') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Colors: <small>tooltips</small>
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

                <label for="pix_tooltips_bg">Background of the tooltips:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_tooltips_bg" type="text" value="<?php echo pix_esc_option('pix_tooltips_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>

                <label for="pix_tooltips_bg_opacity">Opacity of the background color:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap"><input type="text" name="pix_tooltips_bg_opacity" value="<?php echo pix_esc_option('pix_tooltips_bg_opacity'); ?>"></div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div --> 

                <label for="pix_tooltips_color">Text color of the tooltips:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_tooltips_color" type="text" value="<?php echo pix_esc_option('pix_tooltips_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>

                <label for="pix_colorbox_disable">Disable native ColorBox plugin:</label>
                <input type="hidden" name="pix_colorbox_disable" value="0">
                <input type="checkbox" name="pix_colorbox_disable" value="true" <?php if(pix_esc_option('pix_colorbox_disable')=='true') { echo 'checked="checked"'; } ?>>
                <div class="clear"></div>
            
            	<label for="pix_colorbox">ColorBox skin:</label>
                <div class="field_wrap">
                	<select name="pix_colorbox">
                    	<option value="cb_white" <?php selected( pix_esc_option('pix_colorbox'), 'cb_white' ); ?>>White</option>
                    	<option value="cb_whiteonblack" <?php selected( pix_esc_option('pix_colorbox'), 'cb_whiteonblack' ); ?>>White on Black</option>
                    	<option value="cb_black" <?php selected( pix_esc_option('pix_colorbox'), 'cb_black' ); ?>>Black</option>
                    	<option value="cb_blackonwhite" <?php selected( pix_esc_option('pix_colorbox'), 'cb_blackonwhite' ); ?>>Black on White</option>
                    	<option value="cb_gray" <?php selected( pix_esc_option('pix_colorbox'), 'cb_gray' ); ?>>Gray</option>
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