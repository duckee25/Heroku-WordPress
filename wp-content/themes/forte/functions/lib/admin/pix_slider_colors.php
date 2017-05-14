<?php

function slider_colors(){
	global $options;
	if ($_GET['page']=='slider_colors') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Colors: <small>sliders</small>
                <div class="yellow_button button_floating">
                	<div class="button_left"></div>
                	<div class="button_right"></div>
                	<div class="button_body"></div>
                	<a href="#" class="save_changes">save changes</a>
                </div>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
            <?php if (pix_esc_option('pix_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form" id="form_colors">
            <?php } else { ?>
            <form method="post" class="dynamic_form" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>" id="form_colors">
            <?php } ?>            

                <label for="pix_floatingicons_woocommerce_amount_bg">Background color of the amount of products and &quot;Sale&quot; flags:</label>
                <div class="field_wrap">
                    <div class="pix_color_picker">
                        <input name="pix_floatingicons_woocommerce_amount_bg" type="text" value="<?php echo pix_get_option('pix_floatingicons_woocommerce_amount_bg'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                </div>

                <div class="clear"></div>

                <label for="pix_floatingicons_woocommerce_amount_color">Text color of the amount of products and &quot;Sale&quot; flags:</label>
                <div class="field_wrap">
                    <div class="pix_color_picker">
                        <input name="pix_floatingicons_woocommerce_amount_color" type="text" value="<?php echo pix_get_option('pix_floatingicons_woocommerce_amount_color'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                </div>

                <div class="clear"></div>
                
                <label for="pix_filter_price_bg">Background color of the price filter on the bar above the products:</label>
                <div class="field_wrap">
                    <div class="pix_color_picker">
                        <input name="pix_filter_price_bg" type="text" value="<?php echo pix_get_option('pix_filter_price_bg'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                </div>

                <div class="clear"></div>
                
                <label for="pix_filter_price_light_border">Light border of the price filter:</label>
                <div class="field_wrap">
                    <div class="pix_color_picker">
                        <input name="pix_filter_price_light_border" type="text" value="<?php echo pix_get_option('pix_filter_price_light_border'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                </div>

                <div class="clear"></div>
                
                <label for="pix_filter_price_dark_border">Dark border of the price filter:</label>
                <div class="field_wrap">
                    <div class="pix_color_picker">
                        <input name="pix_filter_price_dark_border" type="text" value="<?php echo pix_get_option('pix_filter_price_dark_border'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                </div>

                <div class="clear"></div>
                
                <label for="pix_filter_price_track">Track background color:</label>
                <div class="field_wrap">
                    <div class="pix_color_picker">
                        <input name="pix_filter_price_track" type="text" value="<?php echo pix_get_option('pix_filter_price_track'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                </div>

                <div class="clear"></div>
                
                <label for="pix_filter_price_range">Color of the range:</label>
                <div class="field_wrap">
                    <div class="pix_color_picker">
                        <input name="pix_filter_price_range" type="text" value="<?php echo pix_get_option('pix_filter_price_range'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                </div>

                <div class="clear"></div>
                
                <label for="pix_filter_price_dragger">Main color of the draggers:</label>
                <div class="field_wrap">
                    <div class="pix_color_picker">
                        <input name="pix_filter_price_dragger" type="text" value="<?php echo pix_get_option('pix_filter_price_dragger'); ?>">
                        <div class="pix_palette"></div>
                        <div class="colorpicker"></div>
                    </div>
                </div>

                <div class="clear"></div>
                
        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
         <input type="submit" class="hidden_div" value="">
           </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>