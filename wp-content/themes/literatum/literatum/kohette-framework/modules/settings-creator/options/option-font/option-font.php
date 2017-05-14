<?php
/**
 * settings option
 *
 *
 */



// load font manager functions
include('font-manager/font-manager.php');



/**
* option field
*/
function KTT_font_field($option, $current_value) {
  
  if ($option->option_type != 'font') return;

  if(!isset($option->option_type_vars['selector'])) return;

                    $selector = $option->option_type_vars['selector'];
                    $google_fonts = KTT_get_available_google_fonts();
                    $default_fonts = KTT_get_available_default_fonts();
                    $sizes = range(10, 98);
                    $line_heights = range(0.5, 3, 0.1);
                    $size_units = array('px','pt','%');
                    $font_styles = array(
                                    'normal' => __('Normal',THEME_TEXTDOMAIN),
                                    'italic' => __('Italic', THEME_TEXTDOMAIN),
                                    'oblique' => __('Oblique', THEME_TEXTDOMAIN)
                                    );

                    $current = $current_value;

                    if (!isset($current)) $current = $option->option_default;

                    $current['selector'] = $selector;
                    if (!isset($current['size'])) $current['size'] = '';
                    if (!isset($current['size_unit'])) $current['size_unit'] = '';
                    if (!isset($current['code'])) $current['code'] = '';
                    if (!isset($current['color'])) $current['color'] = '';
                    if (!isset($current['variant'])) $current['variant'] = '';
                    if (!isset($current['font_style'])) $current['font_style'] = '';
                    if (!isset($current['line_height'])) $current['line_height'] = '';


                    ?>


                    <script>
                        var fonts_<?php echo $option->option_id;?> = {

                            <?php foreach ($default_fonts as $code => $font) {?>
                                '<?php echo $code;?>': ['<?php echo implode("','", $font['variants']);?>'],
                            <?php } ?>
                            <?php foreach ($google_fonts as $code => $font) {?>
                                '<?php echo $code;?>': ['<?php echo implode("','", $font['variants']);?>'],
                            <?php } ?>
                        }

                        function load_variants<?php echo $option->option_id;?>(code) {

                            variants = fonts_<?php echo $option->option_id;?>[code];
                            //variant_current = 200;

                            // variants select
                            $variants_select = jQuery('#variants_<?php echo $option->option_id;?>');

                            //remove variants select options
                            $variants_select.find('option').remove().end();

                            if (variants) {
                                for (variant in variants) {
                                    $variants_select.append(new Option( variants[variant].charAt(0).toUpperCase() + variants[variant].slice(1) , variants[variant] ));
                                }
                            } else {
                                $variants_select.append(new Option( 'Regular' , '' ));
                            }


                            //$variants_select.val(variant_current);

                        }
                    </script>

                    <input type="hidden" name="<?php echo $option->option_id;?>[option_id]" value="<?php echo $option->option_id;?>">
                    <input type="hidden" name="<?php echo $option->option_id;?>[selector]" value="<?php echo $current['selector'];?>">

                    <?php if(isset($option->option_type_vars['load_all_variants']) && $option->option_type_vars['load_all_variants']) {?>
                        <input type="hidden" name="<?php echo $option->option_id;?>[load_all_variants]" value="1">
                    <?php } ?>




                    <?php if (isset($option->option_type_vars['size']) && $option->option_type_vars['size']) {?>

                    <select
                    style="height:30px;"
                    name="<?php echo $option->option_id;?>[size]"
                    >
                        <option value=""><?php _e('Size',THEME_TEXTDOMAIN);?></option>
                        <?php foreach ($sizes as $size) {?>
                        <option <?php if ($current['size'] == $size) {?> selected <?php } ?> value="<?php echo $size;?>"><?php echo $size;?></option>
                        <?php } ?>
                    </select>

                    <select
                    style="height:30px;"
                    name="<?php echo $option->option_id;?>[size_unit]"
                    >
                        <option value=""><?php _e('Unit',THEME_TEXTDOMAIN);?></option>
                        <?php foreach ($size_units as $unit) {?>
                        <option <?php if ($current['size_unit'] == $unit) {?> selected <?php } ?> value="<?php echo $unit;?>"><?php echo $unit;?></option>
                        <?php } ?>
                    </select>

                    ·

                    <?php } ?>

                    <select
                    style="height:30px;"
                    name="<?php echo $option->option_id;?>[code]"
                    onchange="load_variants<?php echo $option->option_id;?>(this.value)"
                    >
                        <option value=""><?php _e('Default',THEME_TEXTDOMAIN);?></option>

                        <optgroup label="<?php _e('Basic fonts',THEME_TEXTDOMAIN);?>">
                        <?php foreach($default_fonts as $code => $font) {?>
                        <option <?php if ($current['code'] == $code) {?> selected <?php } ?> value="<?php echo $code;?>"><?php echo $font['name'];?></option>
                        <?php } ?>
                        </optgroup>

                        <optgroup label="<?php _e('Google fonts',THEME_TEXTDOMAIN);?>">
                        <?php foreach($google_fonts as $code => $font) {?>
                        <option <?php if ($current['code'] == $code) {?> selected <?php } ?> value="<?php echo $code;?>"><?php echo $font['name'];?></option>
                        <?php } ?>
                        </optgroup>


                    </select>
                    
                    <select
                    id="variants_<?php echo $option->option_id;?>"
                    style="height:30px;"
                    name="<?php echo $option->option_id;?>[variant]"
                    >
                        <option value=""><?php _e('Regular', THEME_TEXTDOMAIN);?></option>
                    </select>

                    <script>

                    load_variants<?php echo $option->option_id;?>('<?php echo $current['code'];?>');
                    jQuery('#variants_<?php echo $option->option_id;?>').val('<?php echo $current['variant'];?>');

                    </script>




                    <?php if (isset($option->option_type_vars['font_style']) && $option->option_type_vars['font_style']) {?>

                    <select
                    style="height:30px;"
                    name="<?php echo $option->option_id;?>[font_style]"
                    >
                        <option value=""><?php _e('Font style',THEME_TEXTDOMAIN);?></option>
                        <?php foreach ($font_styles as $code => $name) {?>
                        <option <?php if ($current['font_style'] == $code) {?> selected <?php } ?> value="<?php echo $code;?>"><?php echo $name;?></option>
                        <?php } ?>
                    </select>

                    <?php } ?>


                    <?php if (isset($option->option_type_vars['line_height']) && $option->option_type_vars['line_height']) {?>

                    <select
                    style="height:30px;"
                    name="<?php echo $option->option_id;?>[line_height]"
                    >
                        <option value=""><?php _e('Line height',THEME_TEXTDOMAIN);?></option>
                        <?php foreach ($line_heights as $line) {?>
                        <?php echo $line . '<br>';?>
                        <option <?php if ((string)$current['line_height'] == (string)$line) {?> selected <?php } ?> value="<?php echo $line;?>"><?php echo $line;?>em</option>
                        <?php } ?>
                    </select>

                    <?php } ?>






                    <?php if (isset($option->option_type_vars['color']) && $option->option_type_vars['color']) {?>
                    ·

                    <input 
                    name="<?php echo $option->option_id;?>[color]"
                    style="border-radius:2px;height:28px;margin-top:1px;"
                    type="color"
                    value="<?php echo $current['color']; ?>"
                    >
                    <?php } ?>


                    <?php if ($option->option_description) {?> <p class="description"><?php echo $option->option_description;?></p> <?php } ?>
                    

                    <?php


}
add_action('KTT_settings_option_field', 'KTT_font_field', 2, 2);

