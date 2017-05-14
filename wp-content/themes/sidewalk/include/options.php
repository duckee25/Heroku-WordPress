<?php

/* Load the embedded Redux Framework */

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/options/ReduxCore/framework.php' ) ) {
    require_once dirname( __FILE__ ) . '/options/ReduxCore/framework.php';
}

if ( ! class_exists( 'Redux' ) ) {
    return;
}

/* Option name in DB */
$opt_name = 'sdw_settings';

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => sprintf( __('Sidewalk Options%sTheme Documentation%s', THEME_SLUG),'<a href="http://demo.mekshq.com/sidewalk/documentation" target="_blank">','</a>'),
    // Name that appears at the top of your panel
    'display_version'      => sdw_get_update_notification(),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => __( 'Theme Options', THEME_SLUG ),
    'page_title'           => __( 'Sidewalk Options', THEME_SLUG ),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-admin-generic',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => '100',
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    // Show the time the page took to load, etc
    'update_notice'        => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => false,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    'allow_tracking' => false,
    'ajax_save' => false,
    // OPTIONAL -> Give you extra features
    'page_priority'        => '27.11',
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAzMDAgMzAwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMDAgMzAwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PGc+PGc+PHBhdGggZD0iTTkxLjcsMzAuN2MtMTguNiwwLTM3LjEsMC01NS43LDBjLTIuOSwwLjEtNS4zLDIuNy01LjMsNS44YzAsNDQuMywwLDg4LjcsMCwxMzNjMCwzLjIsNS41LDcuOSwxMS44LDkuOWMzOS45LDEzLjMsNjUuNSwxNC4yLDgzLjMsOS40YzIuOC0wLjgsNC4xLTIuOSwzLTQuNmMtMTUuNS0yMy01MS45LTQ1LTM0LjQtMTQwLjZDOTUuNywzNi44LDk0LjcsMzAuNyw5MS43LDMwLjd6Ii8+PHBhdGggZD0iTTE3Ny44LDMwLjdjLTE4LjYsMC0zNy4xLDAtNTUuNywwYy0zLDAtNy40LDYuMy05LjQsMTMuNGMtNDYuMiwxNjMuMSw5OC45LDkzLjUsMTEuNywyMTQuOWMtMy44LDUuMi01LDkuOS0yLjEsMTBjMTguNSwwLDM3LjEtMC4xLDU1LjYtMC4xYzIuOSwwLDcuNC02LjMsOS4zLTEzLjNjNDUuOS0xNjIuNy05OS4yLTkzLjEtMTEuNi0yMTQuOEMxNzkuNSwzNS41LDE4MC44LDMwLjgsMTc3LjgsMzAuN3oiLz48cGF0aCBkPSJNMjY0LDMwLjdjLTE4LjYsMC0zNy4xLDAtNTUuNywwYy0yLjksMC04LjcsMy45LTEyLjQsOC40Yy0yMy4zLDI4LjEtMzEuNCw0NS4xLTMxLjMsNTcuOWMwLDIsMi42LDIuNyw1LjYsMS44YzE5LjUtNS45LDQ2LjYtNy40LDg3LjEsMS4zYzYuNCwxLjQsMTIsMC4yLDExLjktM2MwLTIwLjIsMC00MC40LDAtNjAuNUMyNjkuMSwzMy4zLDI2Ni44LDMwLjcsMjY0LDMwLjd6Ii8+PHBhdGggZD0iTTI1Ny41LDEyMC42Yy0zOS45LTEzLjMtNjUuNS0xNC4yLTgzLjMtOS40Yy0yLjgsMC44LTQuMSwyLjktMyw0LjZjMTUuNSwyMyw1MS45LDQ1LDM0LjQsMTQwLjZjLTEuMyw2LjktMC4yLDEyLjksMi43LDEyLjljMTguNiwwLDM3LjEsMCw1NS43LDBjMi45LTAuMSw1LjMtMi43LDUuMy01LjhjMC00NC4zLDAtODguNywwLTEzM0MyNjkuMywxMjcuMywyNjMuNywxMjIuNiwyNTcuNSwxMjAuNnoiLz48cGF0aCBkPSJNMTI5LjgsMjAxLjFjLTE5LjUsNS45LTQ2LjYsNy40LTg3LjEtMS4zYy02LjQtMS40LTEyLTAuMi0xMS45LDNjMCwyMC4yLDAsNDAuNCwwLDYwLjVjMC4xLDMuMiwyLjUsNS44LDUuMyw1LjhjMTguNywwLDM3LjMsMCw1NS44LTAuMWMyLjksMCw4LjctMy45LDEyLjQtOC40YzIzLjItMjgsMzEuMy00NSwzMS4xLTU3LjhDMTM1LjQsMjAwLjgsMTMyLjgsMjAwLjIsMTI5LjgsMjAxLjF6Ii8+PC9nPjwvZz48L3N2Zz4=',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => 'sdw_options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => false,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'system_info'          => false,
    // REMOVE

    //'compiler'             => true,

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    )
);

/* Documentation link */
$args['admin_bar_links'][] = array(
    'id'    => 'sdw-docs',
    'href'  => 'http://demo.mekshq.com/sidewalk/documentation',
    'title' => __( 'Documentation', THEME_SLUG ),
);


/* Footer social icons */
$args['share_icons'][] = array(
    'url'   => 'https://www.facebook.com/mekshq',
    'title' => 'Like us on Facebook',
    'icon'  => 'el-icon-facebook'
);
$args['share_icons'][] = array(
    'url'   => 'http://twitter.com/mekshq',
    'title' => 'Follow us on Twitter',
    'icon'  => 'el-icon-twitter'
);


$args['intro_text'] = '';
$args['footer_text'] = '';

Redux::setArgs( $opt_name, $args );


/* Initialize options/sections */
include_once 'sections.php';


/* Append custom css to redux framework */
if ( !function_exists( 'sdw_redux_custom_css' ) ):
    function sdw_redux_custom_css() {
        wp_register_style( 'sdw-redux-custom-css', CSS_URI.'theme-options-custom.css', array( 'redux-admin-css' ), THEME_VERSION, 'all' );
        wp_enqueue_style( 'sdw-redux-custom-css' );
    }
endif;

add_action( 'redux/page/sdw_settings/enqueue', 'sdw_redux_custom_css' );



/* Filter demo importer description text */
if ( !function_exists( 'sdw_wbc_filter_desc' ) ):
    function sdw_wbc_filter_desc( $description ) {

        $message = __( 'Use this section to import content from Sidewalk demo website. Note: Images on demo website can be only used for demo purposes and they are not included in demo package.', THEME_SLUG );
        return $message;
    }
endif;

add_filter( 'wbc_importer_description', 'sdw_wbc_filter_desc' );


/* Filter title of demo importer preview */
if ( !function_exists( 'sdw_wbc_filter_demo_title' ) ):
    function sdw_wbc_filter_demo_title( $title ) {
        return __( 'Sidewalk Demo Content', THEME_SLUG );
    }
endif;

add_filter( 'wbc_importer_directory_title', 'sdw_wbc_filter_demo_title' );


/* Change demo directory path */
if ( !function_exists( 'sdw_wbc_change_demo_directory_path' ) ):
    function sdw_wbc_change_demo_directory_path( $demo_directory_path ) {

        $demo_directory_path = str_replace( '\\', '/', THEME_DIR.'demo/');

        return $demo_directory_path;

    }
endif;

add_filter( 'wbc_importer_dir_path', 'sdw_wbc_change_demo_directory_path' );

/* Assign menus and home page after demo import */
if ( !function_exists( 'sdw_wbc_after_import' ) ) :
    function sdw_wbc_after_import( $demo_active_import , $demo_directory_path ) {

        /* Set Menus */

        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $social_menu = get_term_by( 'name', 'Social Menu', 'nav_menu' );
        $fourofour_menu = get_term_by( 'name', '404 Menu', 'nav_menu' );
        $menus = array();

        if ( isset( $main_menu->term_id ) ) {
            $menus['sdw_main_navigation_menu'] = $main_menu->term_id;
        }

        if ( isset( $footer_menu->term_id ) ) {
            $menus['sdw_footer_menu'] = $footer_menu->term_id;
        }

        if ( isset( $social_menu->term_id ) ) {
            $menus['sdw_social_menu'] = $social_menu->term_id;
        }

        if ( isset( $fourofour_menu->term_id ) ) {
            $menus['sdw_404_menu'] = $fourofour_menu->term_id;
        }

        if ( !empty( $menus ) ) {
            set_theme_mod( 'nav_menu_locations', $menus );
        }


        /* Home Page */

        $home_page_title = 'Home';

        $page = get_page_by_title( $home_page_title );

        if ( isset( $page->ID ) ) {
            update_option( 'page_on_front', $page->ID );
            update_option( 'show_on_front', 'page' );
        }
    }

endif;


add_action( 'wbc_importer_after_content_import', 'sdw_wbc_after_import', 10, 2 );

/* Remove redux framework admin page to avoid confusion of our users and unnecesarry support questions */
if ( !function_exists( 'sdw_remove_redux_page' ) ):
    function sdw_remove_redux_page() {
        remove_submenu_page( 'tools.php', 'redux-about' );
    }
endif;

add_action( 'admin_menu', 'sdw_remove_redux_page', 99 );

?>
