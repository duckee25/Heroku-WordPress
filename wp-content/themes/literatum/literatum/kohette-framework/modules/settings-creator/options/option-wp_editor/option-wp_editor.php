<?php
/**
 * settings option
 *
 *
 */



/**
* option field
*/
function KTT_wp_editor_field($option, $current_value) {
  
  if ($option->option_type != 'wp_editor') return;


                    wp_editor(
                        $current_value,
                        $option->option_id,
                        $option->option_type_vars
                    );


                    if ($option->option_description) {?> <p class="description"><?php echo $option->option_description;?></p> <?php }
             

}
add_action('KTT_settings_option_field', 'KTT_wp_editor_field', 2, 2);

