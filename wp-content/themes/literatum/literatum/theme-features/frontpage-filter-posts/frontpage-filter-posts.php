<?php


                

/*
** Filter the frontpage posts by category
*/
function KTT_frontpage_filter_by_category( $query ){
    // the main query
    global $wp_query;
    $category_to_filter = get_option(ktt_var_name('frontpage_filter_by_category'));
    

    // filter by category
    if ($category_to_filter && is_home()) {
        $wp_query->query_vars['cat'] = $category_to_filter;
    }
        
};
add_filter( 'pre_get_posts', 'KTT_frontpage_filter_by_category' );






// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {



            /*
                // add page to theme options

                $args = array();
                $args['id'] = ktt_var_name('customize-frontpage');
                $args['page_title'] = __('Frontpage',THEME_TEXTDOMAIN);
                $args['page_description'] = __('Customize the frontpage of the site.', THEME_TEXTDOMAIN);
                $args['menu_title'] = __('Frontpage',THEME_TEXTDOMAIN);
                $args['menu_order'] = 2;
                $args['parent'] = ktt_var_name('customize-page');

                $new_admin_submenu = new KTT_admin_submenu($args);







                // add section 

                $args                               = array();
                $args['section_id']                 = ktt_var_name('site_frontpage_config-section');
                $args['section_name']               = __('Frontpage configuration', THEME_TEXTDOMAIN);
                $args['section_description']        = __('Configure the display of the frontpage. These options are required for al the frontpage styles except the "Mosaic grid"', THEME_TEXTDOMAIN);
                $args['section_page']               = ktt_var_name('customize-frontpage');

                $KTT_new_section = new KTT_new_section($args);

            */






                $args = array(
                    'type'                     => 'post',
                    'child_of'                 => 0,
                    'parent'                   => '',
                    'orderby'                  => 'name',
                    'order'                    => 'ASC',
                    'hide_empty'               => 1,
                    'hierarchical'             => 1,
                    'exclude'                  => '',
                    'include'                  => '',
                    'number'                   => '',
                    'taxonomy'                 => 'category',
                    'pad_counts'               => false 

                );

                $cats = get_categories( $args );
                $cats_array = array('' => __('All the categories', THEME_TEXTDOMAIN));

                foreach ($cats as $cat) {
                    $cats_array[$cat->term_id] = $cat->name . ' (' . $cat->count . ')';
                }



                // add option to admin panel

                $args                           = array();
                $args['option_id']              = ktt_var_name('frontpage_filter_by_category');
                $args['option_name']            = __('Filter posts by category', THEME_TEXTDOMAIN);
                $args['option_label']           = __('', THEME_TEXTDOMAIN);
                $args['option_description']     = __("Select a category to display in the frontpage only the posts of the selected category.",THEME_TEXTDOMAIN);
                $args['option_type']            = 'select';
                $args['option_type_vars']       = $cats_array;
                $args['option_order']           = 18;
                $args['option_page']            = ktt_var_name('customize-frontpage');
                $args['option_page_section']    = ktt_var_name('site_frontpage_config-section');
                $args['option_default']         = '';

                $KTT_new_setting = new KTT_new_setting($args);


}


