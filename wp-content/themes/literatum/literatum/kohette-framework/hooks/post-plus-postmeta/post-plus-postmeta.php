<?php
/**
 *	Funcion encargada de completar la informacion de un termino con los taxmetas vinculados a el
 *
 *
 * @package printcore
 */



add_action( 'pre_get_posts', 'post_plus_postmeta' );

function post_plus_postmeta($query) {

    global $post;

    if(!$post) return;


    global $wpdb;
	$postmetas = $wpdb->get_results('SELECT meta_key, meta_value FROM '  . $wpdb->postmeta . ' WHERE post_id = ' . $post->ID);

	foreach($postmetas as $nodo => $meta ) {
		$key = ktt_remove_prefix($meta->meta_key);
		$value = maybe_unserialize($meta->meta_value);

		$post->$key = $value;
	}


}






/**
* hacemos que cada uno de los posts extraidos por una wp_query lleve incluidos los postmeta del theme
*/
add_action( 'posts_results', 'KTT_set_custom_isvars' );

function KTT_set_custom_isvars($posts) {
	global $wpdb;
	$posts_ids = array();

	// cogemos solo las ids de los posts extraidos
	foreach ($posts as $key => $post) {
		$posts_ids[] = $post->ID;
		$posts[$post->ID] = $post;
		unset($posts[$key]);
	}

	// pasamos las ids a formato string para despues utilizarlas en una llamada sql
	$posts_ids_string = implode (", ", $posts_ids);

  $postmetas = '';
	// extraemos la lista de postmetas ordenadas con su post_id
	if ($posts_ids_string) $postmetas = $wpdb->get_results("SELECT
										post_id, meta_key, meta_value
									FROM
										"  . $wpdb->postmeta . "
									WHERE
										post_id IN ($posts_ids_string)
									AND
										meta_key LIKE '" . THEME_PREFIX . "%'
									");

	// incluimos los postmetas en los posts
	if ($postmetas) foreach ($postmetas as $key => $values) @$posts[$values->post_id]->{ktt_remove_prefix($values->meta_key)} = maybe_unserialize($values->meta_value);

	// fix
	$yeah = array();
	foreach ($posts as $post) $yeah[] = $post;

	return $yeah;

}
