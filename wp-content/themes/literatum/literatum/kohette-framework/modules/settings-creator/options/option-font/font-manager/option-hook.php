<?php



/**
* get current google fonts required by the theme
*/
function KTT_get_current_google_fonts() {
    return (array)get_option(ktt_var_name('current_google_fonts'));
}

/**
* clean the  current_google_fonts
*/
function KTT_clean_current_google_fonts() {
    global $KTT_custom_theme_settings;
    $options = array_keys($KTT_custom_theme_settings);
    $current_google_fonts = KTT_get_current_google_fonts();

    foreach ($current_google_fonts as $key => $value) {
        if(!array_key_exists($key, $KTT_custom_theme_settings)) unset($current_google_fonts[$key]);
    }

    update_option(ktt_var_name('current_google_fonts'), $current_google_fonts);

}



/**
* override custom font styles option before save a font setting option
*
*/
function KTT_save_custom_font_styles( $new_value, $old_value ) {

    //KTT_clean_custom_font_styles_var();
   
    if (is_array($new_value)) {




        //$custom_font_styles = KTT_get_custom_font_styles();

        $option_id = $new_value['option_id'];
        $selector = $new_value['selector'];

        if ($option_id && $selector) {


            // save font family ------------------------------------------------
            if (isset($new_value['code'])) {
                $fonts = KTT_get_available_fonts();

                //$style_array[$option_id][$selector]['selector'] = $selector;
                $style_array[$option_id][$selector]['font-family']['property'] = 'font-family';
                $style_array[$option_id][$selector]['font-family']['value'] = @$fonts[$new_value['code']]['css_code'];
                //$style_array[$option_id][$selector]['extra']['font'] = $fonts[$new_value['code']];
                KTT_add_custom_style($style_array);

                // guardamos el objeto fuente para despues poder sacarlo por css
                if(@$fonts[$new_value['code']]['type'] == 'google') {

                    KTT_clean_current_google_fonts();
                    $current_google_fonts = KTT_get_current_google_fonts();
                    $new_value['font'] = $fonts[$new_value['code']];
                    $current_google_fonts[$option_id] = $new_value;
                    update_option(ktt_var_name('current_google_fonts'), $current_google_fonts);

                }
                


            }
            // -----------------------------------------------------------------



            // save font weight ------------------------------------------------
            if (isset($new_value['variant']) && $new_value['variant']) {

                //$style_array[$option_id][$selector]['selector'] = $selector;
                $style_array[$option_id][$selector]['font-weight']['property'] = 'font-weight';
                $style_array[$option_id][$selector]['font-weight']['value'] = $new_value['variant'];
                KTT_add_custom_style($style_array);

            }
            // -----------------------------------------------------------------


            // save font size ------------------------------------------------
            if (isset($new_value['size']) && isset($new_value['size_unit']) && $new_value['size']) {

                //$style_array[$option_id][$selector]['selector'] = $selector;
                $style_array[$option_id][$selector]['font-size']['property'] = 'font-size';
                $style_array[$option_id][$selector]['font-size']['value'] = $new_value['size'] . $new_value['size_unit'];
                KTT_add_custom_style($style_array);

            }
            // -----------------------------------------------------------------


            // save font color ------------------------------------------------
            if (isset($new_value['color']) && $new_value['color']) {

                //$style_array[$option_id][$selector]['selector'] = $selector;
                $style_array[$option_id][$selector]['color']['property'] = 'color';
                $style_array[$option_id][$selector]['color']['value'] = $new_value['color'];
                KTT_add_custom_style($style_array);

            }
            // -----------------------------------------------------------------


            // save font style ------------------------------------------------
            if (isset($new_value['font_style']) && $new_value['font_style']) {

                //$style_array[$option_id][$selector]['selector'] = $selector;
                $style_array[$option_id][$selector]['font-style']['property'] = 'font-style';
                $style_array[$option_id][$selector]['font-style']['value'] = $new_value['font_style'];
                KTT_add_custom_style($style_array);

            }
            // -----------------------------------------------------------------


            // save font style ------------------------------------------------
            if (isset($new_value['line_height']) && $new_value['line_height']) {

                //$style_array[$option_id][$selector]['selector'] = $selector;
                $style_array[$option_id][$selector]['line-height']['property'] = 'line-height';
                $style_array[$option_id][$selector]['line-height']['value'] = $new_value['line_height'] . 'em';
                KTT_add_custom_style($style_array);

            }
            // -----------------------------------------------------------------


        }



        // we save the font data in the option --------------------------------------------------
        if (isset($new_value['code']) && $new_value['code']) {
            $new_value['font'] = $fonts[$new_value['code']];
        }
        // --------------------------------------------------------------------------------------
       


    }

    return $new_value;

}


    



// !! register hook, used to save the font settings in the custom style variable
function KTT_font_option_register_hook($option) {
    if ($option->option_type == 'font') add_filter( 'pre_update_option_' . $option->option_id, 'KTT_save_custom_font_styles', 10, 2 );
}

add_action('KTT_settings_option_register', 'KTT_font_option_register_hook', 2, 1);











