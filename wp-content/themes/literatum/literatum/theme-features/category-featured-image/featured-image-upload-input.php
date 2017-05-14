<?php
/**
 * Featured images for categories
 *
 */




// add featured image option to category admin pages

$args                          	 = array();
$args['taxmeta_taxonomy']        = 'category';
$args['taxmeta_id']              = ktt_var_name('category_featured_image');
$args['taxmeta_name']            = __('Featured Image', THEME_TEXTDOMAIN);
$args['taxmeta_description']     = __('Upload an image to illustrate this category.', THEME_TEXTDOMAIN);
$args['taxmeta_type']            = 'image';

$KTT_new_taxonomy_meta = new KTT_new_taxonomy_meta($args);






// show the featured image in the categories list

function KTT_manage_my_category_columns($columns)
{
 // add 'My Column'
 $columns['featured_image'] = 'Image';

 return $columns;
}
add_filter('manage_edit-category_columns','KTT_manage_my_category_columns');



function KTT_manage_category_custom_fields($deprecated,$column_name,$term_id)
{
 if ($column_name == 'featured_image') {
 	$featured_image_id = get_taxonomy_meta($term_id, ktt_var_name('category_featured_image'), true);
 	$image_attributes = wp_get_attachment_image_src( $featured_image_id, 'thumbnail' );
	$post_featured_image_thumb = $image_attributes[0];

   	echo '<img style="border-radius:2px;max-width:100px;max-height:150px" src="' . $post_featured_image_thumb . '">';
 }
}
add_filter ('manage_category_custom_column', 'KTT_manage_category_custom_fields', 10,3);










