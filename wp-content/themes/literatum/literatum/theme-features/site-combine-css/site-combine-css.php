<?php
/**
 * Combine all the css files in queue
 * v1.1
 *
 */



/**
* check if the css combine feature is enabled
*/
function KTT_css_combine_is_enabled() {
	return get_option(ktt_var_name('active_css_combine'));
}


/**
* Remove dots in string directory
* http://nadeausoftware.com/articles/2008/05/php_tip_how_convert_relative_url_absolute_url
*/
function KTT_url_remove_dot_segments( $path )
{
    // multi-byte character explode
    $inSegs  = preg_split( '!/!u', $path );
    $outSegs = array( );
    foreach ( $inSegs as $seg )
    {
        if ( $seg == '' || $seg == '.')
            continue;
        if ( $seg == '..' )
            array_pop( $outSegs );
        else
            array_push( $outSegs, $seg );
    }
    $outPath = implode( '/', $outSegs );
    if ( $path[0] == '/' )
        $outPath = '/' . $outPath;
    // compare last multi-byte character against '/'
    if ( $outPath != '/' &&
        (mb_strlen($path)-1) == mb_strrpos( $path, '/', 'UTF-8' ) )
        $outPath .= '/';
    return $outPath;
}




/**
* function to fix the urls in the content of a file
*/
function KTT_fix_content_urls($file_path) {

			/**
			* We load the required funcionts to manage files
			*/
			require_once(ABSPATH . 'wp-admin/includes/file.php');
			WP_Filesystem();
			global $wp_filesystem;

			/**
			* We fix the file path from double dots and str_shuffle
			*/
			$file_path = KTT_url_remove_dot_segments($file_path);

			/**
			* Get the file content
			*/
			$file_content = $wp_filesystem->get_contents($file_path);

			/**
			* replace the urls
			*/
			$file_content = str_replace('../', KTT_path_to_url(dirname($file_path) . '/../'), $file_content );

			/**
			* We return the content
			*/
			return $file_content;

}




/**
* Esta funcion se encarga de arreglar urls src de las librerias js
*/
function KTT_fix_css_src_url($src) {

			global $wp_styles;

			/**
			 * Si la url no contiene un http le ponemos delante
			 * la url de nuestro sitio
			 */
			if(strpos($src, '://') === false) $src = trailingslashit( $wp_styles->base_url ) . $src;

			/**
			* Eliminamos dobles stripslashes
			*/
			$src = str_replace(trailingslashit($wp_styles->base_url) . '/', trailingslashit($wp_styles->base_url), $src);

			/**
			* Devolvemos la string
			*/
			return $src;

}



/**
* Esta funcion es la encargada de combinar el CSS de las librerias registradas
* cada vez que se ejecuta crea dos transients, uno contiene el contenido y otro
* la lista de archivos css que se han combinado.
*/
function KTT_combine_css_files() {

		/**
		* Cargamos el objeto wp_styles que ocntiene la informacion de las librerias
		* registradas en el sitio
		*/
		global $wp_styles;
		if ( !is_a($wp_styles, 'WP_Styles') ) $wp_styles = new WP_Styles();

		/**
		* Definimos un tiempo de cache. este va a ser el tiempo de nuestros transients
		*/
		$cache_time = 12 * HOUR_IN_SECONDS;

		/**
		* Cogemos solo las librerias que esten pendientes de cargarse en el sitio
		*/
		$wp_styles->all_deps(array_keys($wp_styles->queue));

		/**
		* En la variable content vamos a ir combinando las librerias
		*/
		$content = '';

		/*+
		* en la variable combined_files vamos a ir añadiendo cada file que modifiquemos
		*/
		$combined_files = array();

		/**
		* Itineramos por cada una de las librerias y vamos accediendo a su contenido
		* y combinandolo en la variable content solo en caso de que sea una libreria local
		*/
		foreach ( $wp_styles->queue as $stle ) {

					/**
					* Cogemos el estilo
					*/
					$style = $wp_styles->registered[$stle];

					/**
					* Obtenemos la url
					*/
					$style_url = $style->src;

					/**
					 * Si la url no contiene un http le ponemos delante
					 * la url de nuestro sitio
					 */
					$style_url = KTT_fix_css_src_url($style_url); //if(strpos($style_url, '://') === false) $style_url = trailingslashit(home_url()) . $style_url;




					/**
					* intentamos obtener la local path del archivo
					*/
					$style_src ='';
					if(strpos($style_url, home_url()) !== false) $style_src = KTT_url_to_path($style_url);

					/**
					* Si despues de intentar sacar la local_path comprobamos que no hemos podido
					* y que sigue siendo una url entonces pasamos a sacar el contenido del css con curl
					*/
					if ($style_src && $style_url && $style_src != $style_url) {

									$style_src = KTT_url_to_path($style_url);
									//if (strpos($style_src, get_template_directory()) === false) continue;

									/**
									* comprobamos si el archivo realmente existe
									*/
									if ( file_exists($style_src) ) {

											/**
											* Corregimos las urls que pudieran haber dentro de el
											*/
											$style_content = KTT_fix_content_urls($style_src);

									};

					/**
					* Si no es una libreria local pasamos
					*/
					} else {


									$ch = curl_init();
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
									curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
									curl_setopt($ch, CURLOPT_URL, $style_url);
									$style_content = curl_exec($ch);
									curl_close($ch);

									if (!$style_content) continue;

					}


					/**
					* Una vez corregido sumamos el contenido a la variable content
					*/
					$content .= $style_content;

					/**
					* añadimos el file a la lista
					*/
					$combined_files[] = $stle;


					/**
					* Añadimos un salto de linea
					*/
					$content .= "\n\n";

					/**
					* Borramos la libreria de la lista de queue
					*/
					//wp_dequeue_style($stle);
					//wp_deregister_style($stle);

		}






		/**
		* Capturamos todas las font-face
		*/
		$regex = '/@font-face\s*\{[^}]+}/';
		preg_match_all($regex ,$content, $font_faces);

		/**
		* Cogemos solo el primer grupo
		*/
		$font_faces = $font_faces[0];

		/**
		* Borramos los font_faces del content
		*/
		$content = preg_replace($regex, '', $content);

		/**
		* Ahora cogemos los font_faces que hemos capturado y los colocamos al principio
		* del content
		*/
		$content = implode(' ', $font_faces) . $content;



		/**
		* Capturamos todas las font-face
		*/
		$regex = '/@import url\(([^)]+)\);/';
		preg_match_all($regex ,$content, $imports);

		/**
		* Cogemos solo el primer grupo
		*/
		$imports = $imports[0];

		/**
		* Borramos los font_faces del content
		*/
		$content = preg_replace($regex, '', $content);

		/**
		* Ahora cogemos los font_faces que hemos capturado y los colocamos al principio
		* del content
		*/
		$content =  implode(' ', $imports) . $content;




		/**
		* Antes de finalizar corregimos los posibles errores comunes que pudiera haber
		* en el contenido, eliminamos saltos de linea y comentarios
		*/
		$content = preg_replace('/^\s+|\n|\r|\s+$/m', '', $content);
		$content = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $content);


		/**
		* Generamos un nombre de transient, este nombre va a ser importante porque
		* sera el que identifique el content que hemos obtenido
		*/
		$transient_name = KTT_get_combine_css_transient_name();

		/**
		* Creamos las transients
		*/
		set_transient( $transient_name, $content, $cache_time );

		/**
		* Tambien creamos un transiente con la lista de css que hemos combinados
		*/
		set_transient( $transient_name. '_files', $combined_files, $cache_time );

		/**
		* devolvemos el contenido con todas las librerias combinadas
		*/
		return $content;

}


/**
* Esta funcion se encarga de obtener el codigo con todos los css combinados
*/
function KTT_get_css_combined_content() {

		$content = '';

		/**
		* Obtenemos el nombre del transient
		*/
		$transient_name = KTT_get_combine_css_transient_name();

		/**
		* Obtenemos el transient
		*/
		if (get_option(ktt_var_name('css_combine_enable_cache'))) $content = get_transient($transient_name);

		/**
		* Si no hemos obtenido el contenido entonces lo generamos
		*/
		if (!$content) $content = KTT_combine_css_files();

		/**
		* Obtenemos la lista de archivos csss que se han combinados
		*/
		$combined_files = get_transient($transient_name . '_files');

		/**
		* Comprobamos si efectivamente hay algun archivo combinados
		*/
		if ($combined_files) {

					/**
					* Itineramos por cada uno de los archivos modificados y los quitamos
					* de la lista de archivos en cola
					*/
					foreach ($combined_files as $file) {

							/**
							* Lo quitamos de la cola
							*/
							wp_dequeue_style($file);
							wp_deregister_style($file);

					}

		}

		/**
		* Devolvemos el contenido
		*/
		return $content;

}




/**
* Esta función es una función importante que se encarga de generar un nombre de transient a partir
* de las dependencias de una página, gracias a este nombre generado por esta funcion podemos
* guardar en cache diferentes combinaciones de librerias. lo cual nos permite tener librerias
* personalizadas para cada pagina combinadas.
*/
function KTT_get_combine_css_transient_name($handles = '') {

	/**
	* Si no tenemos handles vamos a ver si existe la función que se encarga
	* de obtener una lista de handles de la página actual
	*/
	if (!$handles) {
		if (function_exists('KTT_get_page_style_handles')) $handles = KTT_get_page_style_handles();
	}

	/**
	* Si no tenemos handles devolvemos un nombre default
	*/
	if (!$handles) return 'combinedjs';

	/**
	* Aqui vamos a guardar el nombre completo
	*/
	$result = '';

	/**
	* Itineramos por cada handle y vamos creando el nombre
	*/
	foreach($handles as $handle) {

			/**
			* Primero sanitizamos el nombre para evitar caracteres extraños
			*/
			$sanitize_handle = sanitize_user( $handle, true);

			/**
			* Sumamos el handle al nombre resultante
			*/
			$result .= $sanitize_handle;
	}

	/**
	* Creamos un identificador md5, esto nos permite no superar el limite de caracteres
	* para el nombre de una transient
	*/
	$result = md5($result);

	/**
	* Devolvemos el resultado
	*/
	return $result;

}


/**
* Combine the css files of the theme
*/
function KTT_combine_css() {

	/**
	* Obtenemos un transient name
	*/
	$transient_name = KTT_get_combine_css_transient_name();

	/**
	* En result vamos a guardar el resultado de la funcion
	*/
	$result = '';

	/**
	* Obtenemos el contenido de todos los CSS combinados
	*/
	$content = KTT_get_css_combined_content();

	/**
	* Obtenemos la opcion que indica como debemos mostrar el css combinado
	*/
	$display_mode = get_option(ktt_var_name('css_combine_display_mode'));

	/**
	* Si debemos mostrarlo como una libreria externa creamos la url
	*/
	if ($display_mode == 'external') $result = '<link rel="stylesheet" type="text/css" href="' . home_url() . '/kttawesomefeatures/combinedcss/' . $transient_name . '.css" media="screen">';

	/**
	* Si debemos mostrarlo inline...
	*/
	if ($display_mode == 'inline') $result = '<style>' . $content . '</style>';

	/**
	* Devolvemos el resultado
	*/
	echo $result;
	return;

}
// trigger the css combine feature
if (KTT_css_combine_is_enabled()) add_action('wp_print_styles', 'KTT_combine_css');




/**
* Creamos la url que mostrará todo el css combinado
**/
function KTT_combine_css_url($url, $request = '') {

	if (
		(isset($url[0]) && $url[0] == 'kttawesomefeatures')
		&& (isset($url[1]) && $url[1] == 'combinedcss')
		&& (isset($url[2]))
		) {

			/**
			* Nos hacemos con el nombre del archivo
			*/
			$css_file = $url[2];

			/**
			* A partir del nombre de archivo obtenemos el nombre del transient
			*/
			$transient_name = str_replace('.css', '', $css_file);

			/**
			* Header to indicade a CSS file
			*/
			header('content-type: text/css; charset: UTF-8');

			/**
			* We get the trasient with all the css combinedcss
			*/
			$content = get_transient( $transient_name );

			/**
			* Al content le añadimos el custom css del sitio
			*/
			$content .= KTT_get_site_custom_css();

			/**
			* we echo the content-type
			*/
			ob_start("ob_gzhandler");
			echo $content;
			ob_end_flush();

			/**
			* exit the url
			*/
			exit;

		}

}
add_action('KTT_catch_url', 'KTT_combine_css_url', 9 , 2);


/**
* Con esta funcion evitamos que ktt_framework muestre el custom css del sitio en el header
*/
function KTT_remove_print_site_custom_css($current) {
	return '';
}
if (KTT_css_combine_is_enabled()) add_action( 'KTT_print_site_custom_css', 'KTT_remove_print_site_custom_css', 99999, 1);


/**
* Esta funcion nos permite capturar todo el custom css del sitio antes de que vaya a ser
* mostrado en el header, aprovchamos esta circunstancia para atraparlo y añadirlo al
* contenido de los css files combinados, a su misma vez retornamos un false y de
* esta manera estamos evitando que el custom css se muestre en el header
*/
//function KTT_add_custom_site_css_to_combined_css($current) {

		/**
		* Si no hay codigo salimos de aqui
		*/
		//if (!$current) return;

		/**
		* Obtenemos el transient_name del arcihvo
		*/
		//$transient_name = KTT_get_combine_css_transient_name();


//}
//if (KTT_css_combine_is_enabled()) add_action( 'KTT_print_site_custom_css', 'KTT_add_custom_site_css_to_combined_css', 99990, 1);



// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


			// add page to theme options

			$args = array();
			$args['id'] = ktt_var_name('ajax-css_combine-page');
			$args['page_title'] = __('CSS Combine',THEME_TEXTDOMAIN);
			$args['page_description'] = __('The CSS Combine feature can be activated with just one click to accelerate and approach the pages load in the website.', THEME_TEXTDOMAIN);
			$args['menu_title'] = 'CSS Combine';
			$args['menu_order'] = 15;
			$args['parent'] = 'theme-options';

			$new_admin_submenu = new KTT_admin_submenu($args);




			// add option to admin panel

			$args                           = array();
			$args['option_id']              = ktt_var_name('active_css_combine');
			$args['option_name']            = __('CSS Combine', THEME_TEXTDOMAIN);
			$args['option_label']           = __('Active the CSS Combine feature.', THEME_TEXTDOMAIN);
			$args['option_description']     = __('This combine all the CSS files used in the site accelerating the page load time.', THEME_TEXTDOMAIN);
			$args['option_type']            = 'checkbox';
			$args['option_default'] 				= 1;
			$args['option_order'] 					= 1;
			$args['option_page']            = ktt_var_name('ajax-css_combine-page');

			$KTT_new_setting = new KTT_new_setting($args);


			// add option to admin panel

			$args                           = array();
			$args['option_id']              = ktt_var_name('css_combine_display_mode');
			$args['option_name']            = __('Display mode', THEME_TEXTDOMAIN);
			$args['option_label']           = __('', THEME_TEXTDOMAIN);
			$args['option_description']     = __('Select how the site have to display the content of the combined CSS files.', THEME_TEXTDOMAIN);
			$args['option_type']            = 'select';
			$args['option_type_vars']				= array(
																					'inline' => __('Inlined in the source code', THEME_TEXTDOMAIN),
																					'external' => __('As external file', THEME_TEXTDOMAIN)
																			);
			$args['option_default'] 				= 'inline';
			$args['option_order'] 					= 2;
			$args['option_page']            = ktt_var_name('ajax-css_combine-page');

			$KTT_new_setting = new KTT_new_setting($args);




			// add option to admin panel

			$args                           = array();
			$args['option_id']              = ktt_var_name('css_combine_enable_cache');
			$args['option_name']            = __('Enable cache', THEME_TEXTDOMAIN);
			$args['option_label']           = __('Active the cache for the combined CSS files.', THEME_TEXTDOMAIN);
			$args['option_description']     = __("This enable the cache for the files combined in the site. This can make the site load faster but the CSS don't reflect the recent changes. Disable this option temporary if you are doing changes in the CSS files.", THEME_TEXTDOMAIN);
			$args['option_type']            = 'checkbox';
			$args['option_default'] 				= 1;
			$args['option_order'] 					= 3;
			$args['option_page']            = ktt_var_name('ajax-css_combine-page');

			$KTT_new_setting = new KTT_new_setting($args);






}
