<?php

function table_colors(){
	global $options;
	if ($_GET['page']=='table_colors') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Price tables: <small>colors</small>
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

                <label for="pix_table_border">Border color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_table_border" type="text" value="<?php echo pix_esc_option('pix_table_border'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>
                
                <label for="pix_table_border_highlighted">Border color (highlighted column):</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_table_border_highlighted" type="text" value="<?php echo pix_esc_option('pix_table_border_highlighted'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>
                
                <label for="pix_table_check_sign">&quot;Checked&quot; sign color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_table_check_sign" type="text" value="<?php echo pix_esc_option('pix_table_check_sign'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>
                
                <label for="pix_table_uncheck_sign">&quot;Not-checked&quot; sign color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_table_uncheck_sign" type="text" value="<?php echo pix_esc_option('pix_table_uncheck_sign'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>
                
                <label for="pix_header_table_bg">Background of the header of the tables:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_header_table_bg" type="text" value="<?php echo pix_esc_option('pix_header_table_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>
                
                <label for="pix_header_text_color">Color of the text on the header:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_header_text_color" type="text" value="<?php echo pix_esc_option('pix_header_text_color'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>
                
                <label for="pix_table_2nd_bg">Secondary background color:</label>
                <div class="field_wrap pix_color_picker">
                    <input name="pix_table_2nd_bg" type="text" value="<?php echo pix_esc_option('pix_table_2nd_bg'); ?>">
                    <div class="pix_palette"></div>
                    <div class="colorpicker"></div>
                </div>
                <div class="clear"></div>
                
                <label for="pix_table_button">Button type for the price table</label>
                <div class="field_wrap">
                    <select name="pix_table_button">
                        <option value="simple_button" <?php selected( pix_esc_option('pix_table_button'), 'simple_button', true ); ?>>Simple type</option>
                        <option value="first_color" <?php selected( pix_esc_option('pix_table_button'), 'first_color', true ); ?>>First color</option>
                        <option value="second_color" <?php selected( pix_esc_option('pix_table_button'), 'second_color', true ); ?>>Second color</option>
                        <option value="third_color" <?php selected( pix_esc_option('pix_table_button'), 'third_color', true ); ?>>Third color</option>
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