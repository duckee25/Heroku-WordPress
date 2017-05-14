<?php
/**
 * settings option
 *
 *
 */



/**
* option field
*/
function KTT_checkboxes_field($option, $current_value) {
  
  if ($option->option_type != 'checkboxes') return;

  ?>

                        <?php foreach ($option->option_type_vars as $key => $val) {

                            ?>
                            <label>
                            <input 
                            type="checkbox" 
                            style="<?php echo $option->option_style ;?>"  
                            id="<?php echo $option->option_id . $key;?>" 
                            name="<?php echo $option->option_id ;?>[<?php echo $key;?>]" 
                            <?php if (isset($current_value[$key]) && $current_value[$key]) { ?> checked <?php } ?>
                            value="<?php echo $val;?>">
                            <?php echo $val;?>
                            </label><br>

                        <?php } ?>


                    <?php


                    if ($option->option_description) {?> <p class="description"><?php echo $option->option_description;?></p> <?php }




}
add_action('KTT_settings_option_field', 'KTT_checkboxes_field', 2, 2);