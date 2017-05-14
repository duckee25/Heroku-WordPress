<?php


/**
* Este hook se encarga de modificar el array de plugins del framework
* para añadir los archivos php necesarios para el funcionamiento del theme
* Es util para añadir funcionalidades que son unicas de este theme
*/
function KTT_custom_theme_plugins( $plugins ) {

	/**
	* Itineramos por cada una de las taxonomias definidas en la carpeta taxonomies y las añadimos
	*/
	foreach (glob(get_stylesheet_directory(). "/taxonomies/*", GLOB_ONLYDIR) as $filename) {

	    $plugins[] = array(
			'name' => basename($filename),
			'source' => $filename . '/' . basename($filename) . '.php',
		);

	};

	/**
	* Itineramos por cada una de las features unicas del theme y las añadimos al array
	*/
	foreach (glob(get_stylesheet_directory() . "/theme-features/*", GLOB_ONLYDIR) as $filename) {

	    $plugins[] = array(
			'name' => basename($filename),
			'source' => $filename . '/' . basename($filename) . '.php',
		);

	};

    /**
    * Devolvemos el array de configuración
    */
    return $plugins;

}
add_filter( 'pbeasts_theme_plugins', 'KTT_custom_theme_plugins' );
