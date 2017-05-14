<?php
/**
 * Special options to style things!
 *
 *
 */








// hook to save custom styles
/**
* override custom styles option before save a font setting option
*
*/
function KTT_save_css_option( $new_value, $old_value ) {

    
   
    if (is_array($new_value)) {

        foreach ($new_value as $key => $option) {

            /*
            echo '<pre>';
            print_r($option);
            echo '</pre>';
            */

                $option_id = $option['option_id'];
                $selector = $option['selector'];

                $style_array[$option_id][$selector][$key]['property'] = $option['property'];
                $style_array[$option_id][$selector][$key]['value'] = $option['value'];
                KTT_add_custom_style($style_array);
                


        }

    }


    return $new_value;

}


// load css option fields
foreach (glob(dirname(__FILE__). "/options/*", GLOB_ONLYDIR) as $filename) {
            include('options/' . basename($filename) . '/' . basename($filename) . '.php') ;
};