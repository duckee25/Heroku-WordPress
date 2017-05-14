<?php







/**
* return the custom font styles array
*/
function KTT_get_custom_styles() {
    return (array)get_option(ktt_var_name('custom_styles'));
}


function KTT_get_custom_styles_simplified() {
    $custom_styles = KTT_get_custom_styles();
    $simplify = array();

    if ($custom_styles) {
    foreach ($custom_styles as $option_id => $style) {
        if ($style) {
        foreach($style as $selector => $values) {

            foreach ($values as $value) {

                $simplify[$selector][] = $value;

            }

        }
        }

    }
    }

    return $simplify;

}


/**
* add new custom style
*/
/*
EXAMPLE:

$new_custom_style = array(

                            'option_id' => array(
                                                    '.selector' => array(
                                                                            'selector' => 'body a',
                                                                            'property' => 'font-size',
                                                                            'value' => '12px',
                                                                            extra => array(),
                                                    )
                            )

)

*/
function KTT_add_custom_style($array) {

    KTT_clean_custom_styles_var();

    $custom_styles = KTT_get_custom_styles();
    foreach($array as $key => $value) {
        $custom_styles[$key] = $value;
    }

    update_option(ktt_var_name('custom_styles'), $custom_styles);

}







/**
* clean the global custom_styles
*/
function KTT_clean_custom_styles_var() {
    global $KTT_custom_theme_settings;
    $options = array_keys($KTT_custom_theme_settings);
    $custom_styles = KTT_get_custom_styles();

    foreach ($custom_styles as $key => $value) {
        if(!array_key_exists($key, $KTT_custom_theme_settings)) unset($custom_styles[$key]);
    }

    update_option(ktt_var_name('custom_styles'), $custom_styles);

}









/**
* display in the header the css necessary to load the custom  styles
*/
function KTT_display_custom_styles_css($current_css) {

    $custom_styles = KTT_get_custom_styles_simplified();

    $result = '';

    foreach ($custom_styles as $selector => $properties) {

        $result .= $selector . '{';

          foreach ($properties as $property) {
              if (!$property['value']) continue;
              $result .= $property['property'] . ':' . $property['value'] . ';';
          }

        $result .= '} ';

    }

    /**
    * we add the result to the current css code of the site
    */
    $current_css .= $result;

    /**
    * We return the modified current css of the site
    */
    return $current_css;

}
add_action( 'KTT_add_site_custom_css', 'KTT_display_custom_styles_css', 4, 1 );

















/*

function mytheme_customize_register( $wp_customize ) {

$wp_customize->add_section(
    'layout_section', # Section ID to use in Option Table
    array( # Arguments array
        'title' => __( 'Layout', 'narga' ), # Translatable text, change the text domain to your own
        'capability' => 'edit_theme_options', # Permission to change option date
        'description' => __( 'Allows you to edit your themes layout.', 'narga' )
    )
);



$wp_customize->add_setting('narga_options[use_custom_text]', array(
    'capability' => 'edit_theme_options',
    'type'       => 'option',
    'default'       => '1', # Default checked
));

$wp_customize->add_control('narga_options[use_custom_text]', array(
    'settings' => 'narga_options[use_custom_text]',
    'label'    => __('Display Custom Text', 'narga'),
    'section'  => 'layout_section', # Layout Section
    'type'     => 'checkbox', # Type of control: checkbox
));

# Add text input form to change custom text
$wp_customize->add_setting('narga_options[custom_text]', array(
    'capability' => 'edit_theme_options',
    'type'       => 'option',
    'default'       => 'Custom text', # Default custom text
));

$wp_customize->add_control('narga_options[custom_text]', array(
        'label' => 'Custom text', # Label of text form
        'section' => 'layout_section', # Layout Section
        'type' => 'text', # Type of control: text input
));


}
add_action( 'customize_register', 'mytheme_customize_register' );

*/
