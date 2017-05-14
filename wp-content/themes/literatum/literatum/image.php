<?php

require_once(ABSPATH . 'wp-admin/includes/file.php');
WP_Filesystem();
global $wp_filesystem;



if ( wp_attachment_is_image( $post->id ) ) { 

	$att_image = wp_get_attachment_image_src( $post->id, "full");

	$filename = basename($att_image[0]);
	$file_extension = strtolower(substr(strrchr($filename,"."),1));

	switch( $file_extension ) {
	    case "gif": $ctype="image/gif"; break;
	    case "png": $ctype="image/png"; break;
	    case "jpeg":
	    case "jpg": $ctype="image/jpg"; break;
	    default:
	}

	header('Content-type: ' . $ctype);
	echo $wp_filesystem->get_contents($att_image[0]);

} ?>
                       