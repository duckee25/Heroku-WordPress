<?php
/**
 * Add a new field in the post editor to add photo credit for featured images.
 *
 */




// return true to enable the photo credit feature in the theme
function KTT_sharecontent_is_enabled() {
	return get_option(ktt_var_name('post_sharecontent_active'));
}







/**
 * Enqueue scripts for contenshare
 */
function KTT_sharecontent_scripts() {

    if (KTT_ajax_is_enabled()) {
        wp_enqueue_script( 'tooltipster+sharecontent', KTT_path_to_url(dirname(__FILE__)) . '/js/combined.js', array(), '20130115', 'jquery' );
    } else { 

        if (is_single()) {
            wp_enqueue_script( 'tooltipster+sharecontent', KTT_path_to_url(dirname(__FILE__)) . '/js/combined.js', array(), '20130115', 'jquery' );
        }
   } 

}
if (KTT_sharecontent_is_enabled()) add_action( 'wp_enqueue_scripts', 'KTT_sharecontent_scripts' );






/**
 * Enqueue sharecontent styles.
 */
function KTT_sharecontent_styles() {
    wp_enqueue_style( 'sharecontent-style', KTT_path_to_url(dirname(__FILE__)) . '/css/tooltipster.min.css' );
}
if (KTT_sharecontent_is_enabled())  add_action( 'wp_enqueue_scripts', 'KTT_sharecontent_styles' );







/** 
* reload sharecontent after ajax call
*/
if (KTT_ajax_is_enabled() && KTT_sharecontent_is_enabled()) add_action('KTT_after_ajax_link_load', 'KTT_sharecontent_reload');
function KTT_sharecontent_reload() {

    // this is javascript code
    ?>
    jQuery("article p, article blockquote").contentshare({
            shareLinks : ["http://www.facebook.com/sharer/sharer.php?s=100&u="+document.URL+"&title="+document.title+"&summary=" , "http://twitter.com/intent/tweet?url="+document.URL+"&text="],
    });
    jQuery.fn.contentshare.defaults.shareable.on('mouseup',function(){
        jQuery.fn.contentshare.showTooltip();
    });          
    <?php
}








// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


            // add page to theme options

                $args = array();
                $args['id'] = ktt_var_name('customize-content-page');
                $args['page_title'] = __('Post content',THEME_TEXTDOMAIN);
                $args['page_description'] = __('Customize settings for the post content.', THEME_TEXTDOMAIN);
                $args['menu_title'] = __('Post content',THEME_TEXTDOMAIN);
                $args['menu_order'] = 4;
                $args['parent'] = ktt_var_name('customize-page');

                $new_admin_submenu = new KTT_admin_submenu($args);




                // add section 

                $args                               = array();
                $args['section_id']                 = ktt_var_name('post_content-section');
                $args['section_name']               = __('Post/Page content', THEME_TEXTDOMAIN);
                $args['section_description']        = __('Configure the single post/page content style.', THEME_TEXTDOMAIN);
                $args['section_page']               = ktt_var_name('customize-content-page');

                $KTT_new_section = new KTT_new_section($args);



                // add option to admin panel

                $args                           = array();
                $args['option_id']              = ktt_var_name('post_sharecontent_active');
                $args['option_name']            = __('Active share content tooltip', THEME_TEXTDOMAIN);
                $args['option_label']           = __("Display a tooltip with share links when the user selects an extract of the article's content.", THEME_TEXTDOMAIN);
                $args['option_description']     = __("Check this option to active the share tooltip",THEME_TEXTDOMAIN);
                $args['option_type']            = 'checkbox';
                $args['option_default']         = '1';
                $args['option_order']           = 12;
                $args['option_page']            = ktt_var_name('customize-content-page');
                $args['option_page_section']    = ktt_var_name('post_content-section');;

                $KTT_new_setting = new KTT_new_setting($args);




            

}


?>