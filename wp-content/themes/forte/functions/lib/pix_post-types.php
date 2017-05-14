<?php
add_action('init', 'register_testimonial');

function register_testimonial() {
  $args = array(
    'labels' => array(
      'name' => __( 'Testimonials' ), 
      'singular_name' => __( 'Testimonial' ),
      'add_new' => _x('Add new', 'testimonial'),
      'add_new_item' => __('Add a new testimonial'), 
      'edit_item' => __('Edit testimonial'),
      'new_item' => __('New testimonial'),
      'view_item' => __('View testimonial'),
      ),
    'capability_type' => 'page',
    'has_archive' => false,
    'hierarchical' => false,
    'menu_position' => 22,
    'public' => false,
    'singular_label' => __('Testimonial'),
    'show_ui' => true,
    'supports' => array(
      'title',
      'thumbnail',
      'editor',
      'custom-fields',
      'revisions')
  );

  register_post_type( 'testimonial' , $args );
}

add_action('init', 'register_portfolio');

function register_portfolio() {
  $args = array(
    'labels' => array(
      'name' => __( 'Portfolio' ), 
      'singular_name' => __( 'Portfolio' ),
      'add_new' => _x('Add new', 'portfolio'),
      'add_new_item' => __('Add a new item'), 
      'edit_item' => __('Edit item'),
      'new_item' => __('New item'),
      'view_item' => __('View item'),
      ),
    'capability_type' => 'page',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 20,
    'public' => true,
    'rewrite' => true,
    'singular_label' => __('Portfolio'),
    'show_ui' => true,
    'supports' => array(
      'title',
      'thumbnail',
      'editor',
      'excerpt',
      'trackbacks',
      'custom-fields',
      'comments',
      'revisions')
  );

  register_post_type( 'portfolio' , $args );
}

add_action( 'init', 'create_portfolio_taxonomies', 0 );

//create two taxonomies, genres and writers for the post type "book"
function create_portfolio_taxonomies() 
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Galleries', 'taxonomy general name' ),
    'singular_name' => _x( 'Gallery', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Gallery' ),
    'all_items' => __( 'All Galleries' ),
    'parent_item' => __( 'Parent Gallery' ),
    'parent_item_colon' => __( 'Parent Gallery:' ),
    'edit_item' => __( 'Edit Gallery' ), 
    'update_item' => __( 'Update Gallery' ),
    'add_new_item' => __( 'Add New Gallery' ),
    'new_item_name' => __( 'New Gallery Name' ),
    'menu_name' => __( 'Galleries' ),
  ); 	

  register_taxonomy('gallery',array('portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
	'rewrite' => array('hierarchical' => true )
  ));

  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Tags', 'taxonomy general name' ),
    'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search tags' ),
    'popular_items' => __( 'Popular tags' ),
    'all_items' => __( 'All tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit tag' ), 
    'update_item' => __( 'Update tag' ),
    'add_new_item' => __( 'Add New tag' ),
    'new_item_name' => __( 'New tag name' ),
    'separate_items_with_commas' => __( 'Separate tags with commas. They will be used for filtering portfolio items' ),
    'add_or_remove_items' => __( 'Add or remove tags' ),
    'choose_from_most_used' => __( 'Choose from the most used tags' ),
    'menu_name' => __( 'Tags' ),
  ); 

  register_taxonomy('portfolio_tag','portfolio',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'portfolio_tag' ),
  ));

}

/*=========================================================================================*/

?>