<?php

function tables_generator(){
	global $options, $current_user;
	if ($_GET['page']=='tables_generator') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Price tables: <small>create or delete a table</small>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
            <form method="post" class="dynamic_form check_tables" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">

 <?php
	$get_price_tables = pix_get_option('pix_array_your_tables_');
	if($get_price_tables != "") {
    
		foreach ($get_price_tables as $price_table_gen) { ?>
                 <input type="hidden" name="<?php echo 'pix_array_your_tables_['.$price_table_gen.']'; ?>" value="<?php echo $price_table_gen; ?>">
	   <?php
		}
    }
?>               <label for="pix_array_your_tables_[<?php echo $price_table_gen; ?>]">Add a price table:</label>
                <div class="field_wrap">
                    <input name="pix_array_your_tables_[<?php echo $price_table_gen; ?>]" id="pix_array_your_tables_" type="text" value="">
                    <div class="grey_button alignleft pix_add_field">
                        <div class="button_left"></div>
                        <div class="button_right"></div>
                        <div class="button_body"></div>
                        <a href="#" class="create_price_table">create the table</a>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="tip_info_wrap">
                	<small class="tip_info">Type here above an identificative name for your price table, use latin characters only</small>
                </div><!-- .tip_info_wrap -->

                <input type="hidden" name="action" value="data_save">
                <input type="hidden" name="price_table_action" value="add_a_price_table">
                <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
                <input type="submit" class="hidden_div" value="">
            </form><!-- .dynamic_form -->


                
            <form method="post" class="dynamic_form" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">

                     	<label>Your price tables</label>
            <input type="hidden" class="pix_price_table_check" name="pix_array_your_tables_" value="">
    <?php
    $get_price_table_options = pix_get_option('pix_array_your_tables_');
    if($get_price_table_options != "") {
    $i=1;
    
    foreach ($get_price_table_options as $price_table_gen) { ?>
        <div id="price_table_row_<?php echo $i; ?>" class="field_wrap pix_price_table_row">
        	<span class="serif-with-grace"><?php echo $i.'. '; ?></span>
            <input type="hidden" class="pix_price_table_check" name="pix_array_your_tables_[<?php echo $price_table_gen; ?>]" value="<?php echo $price_table_gen; ?>">
            <strong><?php echo $price_table_gen; ?></strong>

            <div class="pix_remove_price_table">
                <a href="#" data-remove="<?php echo 'pix_array_your_tables_'.$price_table_gen; ?>">&nbsp;</a>
            </div>
        </div>
    <?php $i++;  
    }
    } else {
		echo 'You still have no price tables';
	}
    ?>

                <input type="hidden" class="pix_price_tables_input" name="" value="remove_a_price_table">
                <input type="hidden" name="action" value="data_save">
                <input type="hidden" name="price_table_removed" value="">
                <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
                <input type="submit" class="hidden_div" value="">
            </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>