<?php
/**
 * Featured images for categories
 *
 */

require_once(ABSPATH . 'wp-admin/includes/file.php');
WP_Filesystem();
global $wp_filesystem;



// we get the list of templates availables for categories in an array
$taxmenta_type_vars = array();
foreach (glob(get_template_directory() . "/category-template-*") as $filename) {

	$source = $wp_filesystem->get_contents( $filename );

    $tokens = token_get_all( $source );
   
   	$option_name =  @$tokens[1][1];

   	if (!$option_name) $option_name = basename($filename);

   	$option_name = str_replace('/', '', $option_name);
   	$option_name = str_replace('*', '', $option_name);

	$taxmenta_type_vars[basename($filename)]['name'] = $option_name;
	$taxmenta_type_vars[basename($filename)]['value'] = basename($filename);


};







// add featured image option to category admin pages

$args                          	 = array();
$args['taxmeta_taxonomy']        = 'category';
$args['taxmeta_id']              = ktt_var_name('category_template');
$args['taxmeta_name']            = __('Template', THEME_TEXTDOMAIN);
$args['taxmeta_description']     = __('Select a template style to show the articles.', THEME_TEXTDOMAIN);
$args['taxmeta_type']            = 'select';
$args['taxmeta_type_vars'] 		 = $taxmenta_type_vars;

$KTT_new_taxonomy_meta = new KTT_new_taxonomy_meta($args);










