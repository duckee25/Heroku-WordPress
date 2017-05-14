<?php


add_filter( 'KTT_load_theme_google_fonts', 'KTT_load_default_google_fonts' );
function  KTT_load_default_google_fonts() {
    global $list;

    $default = array(

        'Gentium Book Basic'    => array('400', '400italic', '700', '700italic'),
        'Domine'                => array('400', '700'),
        'PT Serif'              => array('400', '400italic', '700', '700italic'),

    );

    foreach ($default as $font => $variants) {

        foreach ($variants as $variant) {

            $list[$font][] = $variant;

        }

    }

    
}



