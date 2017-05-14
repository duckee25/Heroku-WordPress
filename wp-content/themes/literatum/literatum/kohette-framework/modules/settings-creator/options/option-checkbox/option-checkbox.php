<?php
/**
 * settings option
 *
 *
 */



/**
* option field
*/
function KTT_checkbox_field($option, $current_value) {
  
  if ($option->option_type != 'checkbox') return;

  ?>

                    <input 
                    type="checkbox" 
                    style="<?php echo $option->option_style ;?>"  
                    id="<?php echo $option->option_id ;?>" 
                    name="<?php echo $option->option_id ;?>" 
                    <?php if ($current_value) { ?> checked <?php } ?>
                    value="1">

                    <?php echo $option->option_label;?>

                    <?php if ($option->option_description) {?> <p class="description"><?php echo $option->option_description;?></p> <?php } ?>
                    
<?php


}
add_action('KTT_settings_option_field', 'KTT_checkbox_field', 2, 2);

