<?php
/**
 *
 *
 */


function roundUp($n,$x=3) {

    return round(($n+$x/2)/$x)*$x;
}



//add +1 post to the first loop of the home
function KTT_custom_wpquery( $query ){
    // the main query
    global $wp_query;
    $frontpage_style = get_option(ktt_var_name('frontpage_style'));
    if (is_home() && $frontpage_style == 'grid') {

    	$per_page = get_option('posts_per_page');
    	if($wp_query->query_vars['paged'] < 1) {
            $wp_query->query_vars['posts_per_page'] =  $per_page + 1;
        } else {
            $wp_query->query_vars['posts_per_page'] =  $per_page;
            $wp_query->query_vars['offset'] = (round($wp_query->query_vars['paged'] - 1) * $per_page) + 1;
        }

	}



};
add_filter( 'pre_get_posts', 'KTT_custom_wpquery' );








// save a multiply of 3 for posts per page setting
/*
function KTT_fix_posts_per_page($new_value, $old_value) {
    return roundUp($new_value);
}
add_filter( 'pre_update_option_posts_per_page', 'KTT_fix_posts_per_page', 10, 2 );
*/




// set the ideal posts per page option for the theme
/*
function KTT_set_posts_per_page() {
	update_option('posts_per_page', 9);
}

add_action( 'after_setup_theme', 'KTT_set_posts_per_page' );
*/
