<?php
/**
 * Custom functions by Kohette Framework.
 *
 */



/**
* return the correct name for a option (postmeta, usermeta, etc) adding the theme prefix
*/
function ktt_var_name($string) {
    return THEME_PREFIX . $string;
}


/**
* Get a theme global variable
*/
function KTT_get_global($variable_name) {
	return $GLOBALS[ktt_var_name($variable_name)];
}


/**
* set a theme global variable
*/
function KTT_set_global($variable_name, $value) {
	$GLOBALS[ktt_var_name($variable_name)] = $value;
}





/**
* remove the theme prefix from string
*/
function ktt_remove_prefix($string) {
    return str_replace(THEME_PREFIX, '', $string);
}




/**
* Transform a local path in a direct url
*/
function KTT_path_to_url($string) {
  $correct_wp_content_url = str_replace(parse_url(WP_CONTENT_URL, PHP_URL_HOST), parse_url(home_url(), PHP_URL_HOST), WP_CONTENT_URL);
	$result = str_replace( WP_CONTENT_DIR, $correct_wp_content_url, $string );
  $result = apply_filters('KTT_path_to_url_filter', $result);
  return $result;
}

/**
* transform a direct url in a local path
*/
function KTT_url_to_path($string) {
  $correct_wp_content_url = str_replace(parse_url(WP_CONTENT_URL, PHP_URL_HOST), parse_url(home_url(), PHP_URL_HOST), WP_CONTENT_URL);
	$result = str_replace(  $correct_wp_content_url, WP_CONTENT_DIR, $string );
  $result = apply_filters('KTT_url_to_path_filter', $result);
  return $result;
}


/**
* change the status of a post
*/
function KTT_change_post_status($post_id, $new_status) {

	$args = array(
      'ID'           => $post_id,
      'post_status' => $new_status,
  	);

	return wp_update_post( $args );
}



/**
* Update the post to change the field indicated
*/
function KTT_change_post_field($post_id, $post_field, $field_value) {

	$args = array(
      'ID'           => $post_id,
      $post_field => $field_value,
  	);

	return wp_update_post( $args );
}




/**
* This returns a post object with all their postmetas
*/
function KTT_get_post($post_id) {
	$post = get_post($post_id);

	if (!$post) return;

	global $wpdb;
	$postmetas = $wpdb->get_results("SELECT meta_key, meta_value FROM {$wpdb->postmeta} WHERE post_id = {$post->ID}");

	foreach($postmetas as $nodo => $meta ) {
		$key = ktt_remove_prefix($meta->meta_key);
		$value = maybe_unserialize($meta->meta_value);

		$post->$key = $value;
	}

	return $post;

}



/**
* This returns a wp_user object with all their postmetas (related to the theme) added
*/
function KTT_get_user_by($field, $value) {
    /**
    * First we get the common user object
    */
    $user = get_user_by($field, $value);

    /**
    * If not user then get out
    */
    if (!$user) return;

    /**
    * We use the wpdb object to make a request and get all the postmetas
    * related with the user and the theme
    */
    global $wpdb;
    $theme_prefix = THEME_PREFIX;
  	$usermetas = $wpdb->get_results("SELECT meta_key, meta_value FROM {$wpdb->usermeta} WHERE user_id = {$user->data->ID} AND meta_key like '{$theme_prefix}%'");

  	foreach($usermetas as $nodo => $meta ) {
  		$key = ktt_remove_prefix($meta->meta_key);
  		$value = maybe_unserialize($meta->meta_value);

  		$user->data->$key = $value;
  	}

  	return $user;
}


/**
* Alias from KTT_get_user_by
*/
function KTT_get_user($user_id = '') {

    /**
    * If not exists a user_id, we try to get the global id of the current user
    */
    if (!$user_id) {
      global $user_ID;
      $user_id = $user_ID;
    }

    if (!$user_id) return;

    return KTT_get_user_by('id', $user_id);
}


/**
* Check if the user has the required permission to edit an object
*/
function KTT_current_user_can_edit_object($object) {

	if (is_int($object) || is_string($object)) $object = KTT_get_post($object);

  $result = false;

	/**
	* We get the id of the logged user if exists
	*/
	global $user_ID;

  /**
  * Si hay una id de usuario y esta es la autora del objeto entonces puede pasar
  */
	if ($user_ID && ($user_ID == $object->post_author) ) $result = true;

  /**
  * Creamos un filtro para que la salida de esta funcion pueda ser editada
  * desde otra funcion
  */
  $result = apply_filters('KTT_current_user_can_edit_object', $object, $user_ID, $result );

  /**
  * Devolvemos false si hemos llegado hasta aqui
  */
	return $result;
}



/**
* This function allows to add all the custom css of the site in one preg_replace
*/
function KTT_get_site_custom_css() {

    /**
    * result of the function
    */
    $result = '';

    /**
    * We add a filter to add css from other exterior functions
    */
    $result = apply_filters('KTT_add_site_custom_css', $result);

    /**
    * We return the resultado
    */
    return $result;

}


/**
* This function allows to add all the custom js code of the footer site in one place
*/
function KTT_get_site_custom_js_footer() {

    /**
    * result of the function
    */
    $result = '';

    /**
    * We add a filter to add css from other exterior functions
    */
    $result = apply_filters('KTT_add_site_custom_js_footer', $result);

    /**
    * We return the resultado
    */
    return $result;

}

/**
* This function allows to add all the custom js code of the header site in one place
*/
function KTT_get_site_custom_js_header() {

    /**
    * result of the function
    */
    $result = '';

    /**
    * We add a filter to add css from other exterior functions
    */
    $result = apply_filters('KTT_add_site_custom_js_header', $result);

    /**
    * We return the resultado
    */
    return $result;

}

/**
* Obtain a term object
*/
function KTT_get_taxonomy_term($taxonomy, $term_id_or_slug) {

      $result = '';

      /**
      * Comprobamos primero si es un integer, si es asi lo vamos
      * a intentar obtener a partir del term_id
      */
      if (is_numeric($term_id_or_slug)) $result = @get_term_by('id', $term_id_or_slug, $taxonomy);

      /**
      * Si se ha obtenido un term lo devolvemos
      */
      if ($result) return $result;

      /**
      * Si a estas alturas no hemos obtenido aun un term vamos a intentar buscarlo
      * a traves del slug
      */
      $result = @get_term_by('slug', $term_id_or_slug, $taxonomy);

      /**
      * Devolvemos el resultado
      */
      return $result;

}


/**
* Create a taxonomy's term in a easy way
* argumentos: taxonomy and args
* args = array('taxonomy', 'name', 'slug', 'description', 'parent');
* return new term id or wp_error
*/
function KTT_create_taxonomy_term( $term_args) {

      /**
      * Si entre la lista de argumentos no encontramos el slug entonces salimos de aquí
      * devolviendo un wp_error
      */
      if (!isset($term_args['slug']) || !isset($term_args['taxonomy'])) return new WP_Error( 'invalid_args', __('Invalid arguments.', THEME_TEXTDOMAIN) );

      /**
      * En primer lugar vamos a comprobar si el termino ya existe, de ser asi devolvemos el termino
      * existente en la funcion
      */
      $term = KTT_get_taxonomy_term($term_args['taxonomy'], $term_args['slug']);
      if ($term) return $term;

      /**
      * Si en los argumentos se ha indicado un parent vamos a corregirlo para obtener
      * el termino correcto si se ha pasado su term_id o su slug
      */
      if (isset($term_args['parent']) && $term_args['parent']) {
          $parent = KTT_get_taxonomy_term($term_args['taxonomy'], $term_args['parent']);
          if ($parent) $term_args['parent'] = $parent->term_id;
      }

      /**
      * Insertamos el término nuevo
      */
      $term = wp_insert_term(
          $term_args['name'],
          $term_args['taxonomy'], // the taxonomy
          array(
            'description'=> @$term_args['description'],
            'slug' => @$term_args['slug'],
            'parent'=> @$term_args['parent']
          )
      );

      /**
      * Si ha ocurrido un error devolvemos dicho error
      */
      if (is_wp_error($term)) return $term;

      /**
      * Devolvemos el objeto term creado
      */
      return KTT_get_taxonomy_term($term_args['taxonomy'], $term['term_id']);

}







/**
* get the greatest common divisor of two numbers
*/
function KTT_greatest_common_divisor( $a, $b ){
    return ($a % $b) ? KTT_greatest_common_divisor($b,$a % $b) : $b;
}

/**
* return the aspect ratio
*/
function KTT_ratio( $x, $y ){
    $gcd = KTT_greatest_common_divisor($x, $y);
    return ($x/$gcd).':'.($y/$gcd);
}




/**
 * Get human readable time difference between 2 dates
 *
 * Return difference between 2 dates in year, month, hour, minute or second
 * The $precision caps the number of time units used: for instance if
 * $time1 - $time2 = 3 days, 4 hours, 12 minutes, 5 seconds
 * - with precision = 1 : 3 days
 * - with precision = 2 : 3 days, 4 hours
 * - with precision = 3 : 3 days, 4 hours, 12 minutes
 *
 * From: http://www.if-not-true-then-false.com/2010/php-calculate-real-differences-between-two-dates-or-timestamps/
 *
 * @param mixed $time1 a time (string or timestamp)
 * @param mixed $time2 a time (string or timestamp)
 * @param integer $precision Optional precision
 * @return string time difference
 */
function KTT_get_date_diff( $time1, $time2, $precision = 2 ) {
	// If not numeric then convert timestamps
	if( !is_int( $time1 ) ) {
		$time1 = strtotime( $time1 );
	}
	if( !is_int( $time2 ) ) {
		$time2 = strtotime( $time2 );
	}

	// If time1 > time2 then swap the 2 values
	if( $time1 > $time2 ) {
		list( $time1, $time2 ) = array( $time2, $time1 );
	}

	// Set up intervals and diffs arrays
	$intervals = array( 'year', 'month', 'day', 'hour', 'minute', 'second' );
	$diffs = array();

	foreach( $intervals as $interval ) {
		// Create temp time from time1 and interval
		$ttime = strtotime( '+1 ' . $interval, $time1 );
		// Set initial values
		$add = 1;
		$looped = 0;
		// Loop until temp time is smaller than time2
		while ( $time2 >= $ttime ) {
			// Create new temp time from time1 and interval
			$add++;
			$ttime = strtotime( "+" . $add . " " . $interval, $time1 );
			$looped++;
		}

		$time1 = strtotime( "+" . $looped . " " . $interval, $time1 );
		$diffs[ $interval ] = $looped;
	}

	$count = 0;
	$times = array();
	foreach( $diffs as $interval => $value ) {
		// Break if we have needed precission
		if( $count >= $precision ) {
			break;
		}
		// Add value and interval if value is bigger than 0
		if( $value > 0 ) {
			if( $value != 1 ){
				$interval .= "s";
			}
			// Add value and interval to times array
			$times[] = $value . " " . $interval;
			$count++;
		}
	}

	// Return string with times
	return implode( ", ", $times );
}







/**
* Return a date as product of the sum of a date plus working days, skipping the weekends and custom dates
* http://codereview.stackexchange.com/questions/51895/calculate-future-date-based-on-business-days
* @param DateTime   $startDate       Date to start calculations from
* @param DateTime[] $holidays        Array of holidays, holidays are no considered business days.
* @param int[]      $nonBusinessDays Array of days of the week which are not business days.
* USE:
$calculator = new KTT_business_days_calculator(
    new DateTime(), // Today
    [new DateTime("2014-06-01"), new DateTime("2014-06-02")],
    [KTT_business_days_calculator::SATURDAY, KTT_business_days_calculator::FRIDAY]
);

$calculator->add_business_days(3); // Add three business days

var_dump($calculator->get_timestamp());
*/
class KTT_business_days_calculator {

    const MONDAY    = 1;
    const TUESDAY   = 2;
    const WEDNESDAY = 3;
    const THURSDAY  = 4;
    const FRIDAY    = 5;
    const SATURDAY  = 6;
    const SUNDAY    = 7;


    public function __construct(DateTime $startDate, array $holidays, array $nonBusinessDays) {
        $this->date = $startDate;
        $this->holidays = $holidays;
        $this->nonBusinessDays = $nonBusinessDays;
    }

    public function add_business_days($howManyDays) {
        $i = 0;
        while ($i < $howManyDays) {
            $this->date->modify("+1 day");
            if ($this->is_business_day($this->date)) {
                $i++;
            }
        }
    }

    public function get_date() {
        return $this->date;
    }

    public function get_timestamp() {
    	return $this->date->getTimestamp();
    }

    private function is_business_day(DateTime $date) {
        if (in_array((int)$date->format('N'), $this->nonBusinessDays)) {
            return false; //Date is a nonBusinessDay.
        }
        foreach ($this->holidays as $day) {
            if ($date->format('Y-m-d') == $day->format('Y-m-d')) {
                return false; //Date is a holiday.
            }
        }
        return true; //Date is a business day.
    }
}
