<?php

add_action( 'wp_enqueue_scripts', 'pix_enqueue_scripts' );   
function pix_enqueue_scripts(){
	global $wp_version;
	if(pix_get_option('pix_enable_google')=='true') {
	    wp_enqueue_script("google-font", "https://www.google.com/jsapi", array(), false, false);
	}
	wp_enqueue_script('modernizr', get_template_directory_uri()."/scripts/modernizr.pix.js");
	wp_enqueue_script("jquery");
	wp_enqueue_script("jquery-ui-core");
	wp_enqueue_script("jquery-ui-accordion");
	wp_enqueue_script("jquery-ui-tabs");
	wp_enqueue_script('swfobject');
	wp_enqueue_script("forte-plugins", get_template_directory_uri()."/scripts/forte.plugins.js", array('jquery'), "0.1");
	wp_enqueue_script("jquery-ui-touch-punch", get_template_directory_uri()."/scripts/jquery.ui.touch-punch.min.js", array('jquery-ui-mouse'), "1.0");
	wp_enqueue_script("jquery-mousewheel-jscrollpane", get_template_directory_uri()."/scripts/jquery.mousewheel.jscrollpanemin.js", array('jquery-ui-core','jquery-ui-draggable'), "1.0");
	if(pix_detectMobile()) {
	    wp_enqueue_script("jquery-mobile-events", get_template_directory_uri()."/scripts/jquery.mobile.custom.min.js", array('jquery'), "1.0");
	}

	if ( version_compare($wp_version, '3.5.9', '>=') ) {
		wp_enqueue_script("wp-mediaelement");
		wp_enqueue_script("forte", get_template_directory_uri()."/scripts/forte.js", array('modernizr', 'forte-plugins', 'jquery-mousewheel-jscrollpane', 'wp-mediaelement'), "1.0");		
	} else {
		if ( detectIE8() ) {
			wp_enqueue_script("flowplayer", get_template_directory_uri()."/scripts/flowplayer-3.2.11.min.js");
		} else {
			wp_enqueue_script("flowplayer", get_template_directory_uri()."/scripts/flowplayer.min.js");
		}
		wp_enqueue_script("forte", get_template_directory_uri()."/scripts/forte.js", array('modernizr', 'forte-plugins', 'jquery-mousewheel-jscrollpane', 'flowplayer'), "1.0");		
	}
}

add_action('wp_enqueue_scripts', 'pix_enqueue_styles',10);
function pix_enqueue_styles(){
	wp_enqueue_style("style", get_stylesheet_uri(), false, "1.0", "all");
}

/*=========================================================================================*/

if ( ! isset( $content_width ) )
	$content_width = 990;

/*=========================================================================================*/

load_theme_textdomain( 'forte', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

/*=========================================================================================*/

add_action('wp_head', 'pix_google_adaptive_head');

function pix_google_adaptive_head() { ?>

	<?php if(pix_get_option('pix_enable_google')=='true') { ?>
	<script type='text/javascript' src='https://www.google.com/jsapi'></script>
	<?php } ?>
	<script>
	<?php if(pix_get_option('pix_enable_google')=='true') {
	?>
	/********************************
	*
	*	Google fonts
	*
	********************************/
	google.load("webfont", "1");

	<?php $fonts = array(
		pix_get_option('pix_general_fontfamily').':200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic:'.pix_get_option('pix_general_fontsubsets'),
		pix_get_option('pix_secondary_fontfamily').':200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic:'.pix_get_option('pix_secondary_fontsubsets'),
		pix_get_option('pix_slideshow_caption_fontfamily').':200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic:'.pix_get_option('pix_slideshow_caption_fontsubsets'),
		pix_get_option('pix_sitetitle_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_sitetitle_fontvariants')).':'.pix_get_option('pix_sitetitle_fontsubsets'),
		pix_get_option('pix_sitedescription_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_sitedescription_fontvariants')).':'.pix_get_option('pix_sitedescription_fontsubsets'),
		pix_get_option('pix_nav_1stlevel_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_nav_1stlevel_fontvariants')).':'.pix_get_option('pix_nav_1stlevel_fontsubsets'),
		pix_get_option('pix_nav_2ndlevel_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_nav_2ndlevel_fontvariants')).':'.pix_get_option('pix_nav_2ndlevel_fontsubsets'),
		pix_get_option('pix_firsttype_button_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_firsttype_button_fontvariants')).':'.pix_get_option('pix_firsttype_button_fontsubsets'),
		pix_get_option('pix_h1_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_h1_fontvariants')).':'.pix_get_option('pix_h1_fontsubsets'),
		pix_get_option('pix_h2_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_h2_fontvariants')).':'.pix_get_option('pix_h2_fontsubsets'),
		pix_get_option('pix_h3_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_h3_fontvariants')).':'.pix_get_option('pix_h3_fontsubsets'),
		pix_get_option('pix_h4_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_h4_fontvariants')).':'.pix_get_option('pix_h4_fontsubsets'),
		pix_get_option('pix_h5_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_h5_fontvariants')).':'.pix_get_option('pix_h5_fontsubsets'),
		pix_get_option('pix_h6_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_h6_fontvariants')).':'.pix_get_option('pix_h6_fontsubsets'),
		pix_get_option('pix_pagenavi_fontfamily').':'.pix_font_variant_hack(pix_get_option('pixpagenavi_fontvariants')).':'.pix_get_option('pix_pagenavi_fontsubsets')
	);
	$fonts=array_unique($fonts); 
	$font = '';
	$i=0;
	foreach ($fonts as $key => $value) {
			if($value!='::' && $value[0]!=':'){
				if($i==0){
					$font .= '\''.$value.'\'';
				} else {
					$font .= ', \''.$value.'\'';
				}
				$i++;
			}
	}

	if (count($font)>0) { ?>

	WebFontConfig = {
	    google: { 
			families: [ <?php echo $font; ?> ]
		 }
	};

	<?php } ?>

	<?php } ?>

	jQuery(function(){
		jQuery('section img').each(function(){
			jQuery(this).removeAttr('width').removeAttr('height');
		});
	});

	</script>
<?php 
}

/*=========================================================================================*/

add_action('admin_head', 'pix_tinymce_google_fonts');
function pix_tinymce_google_fonts() {
	if(pix_get_option('pix_enable_google')=='true') {
		$fonts = array(
			pix_get_option('pix_general_fontfamily').':200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic:'.pix_get_option('pix_general_fontsubsets'),
			pix_get_option('pix_secondary_fontfamily').':200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic:'.pix_get_option('pix_secondary_fontsubsets'),
			pix_get_option('pix_h1_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_h1_fontvariants')).':'.pix_get_option('pix_h1_fontsubsets'),
			pix_get_option('pix_h2_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_h2_fontvariants')).':'.pix_get_option('pix_h2_fontsubsets'),
			pix_get_option('pix_h3_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_h3_fontvariants')).':'.pix_get_option('pix_h3_fontsubsets'),
			pix_get_option('pix_h4_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_h4_fontvariants')).':'.pix_get_option('pix_h4_fontsubsets'),
			pix_get_option('pix_h5_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_h5_fontvariants')).':'.pix_get_option('pix_h5_fontsubsets'),
			pix_get_option('pix_h6_fontfamily').':'.pix_font_variant_hack(pix_get_option('pix_h6_fontvariants')).':'.pix_get_option('pix_h6_fontsubsets'),
		);
		$fonts=array_unique($fonts); 
		$font = '
		<script>var import_google_font = new Array();';
		$i=0;
		foreach ($fonts as $key => $value) {
			if($value!='::' && $value[0]!=':'){
				$font .= 'import_google_font['.$i.']="http://fonts.googleapis.com/css?family='.$value.'";';
			}
			$i++;
		}
		$font .= '</script>';
	}
    echo $font;
  }

/*=========================================================================================*/

function pix_admin_styles() {
	global $pagenow;
	if ( 'nav-menus.php' == basename($_SERVER['SCRIPT_NAME']) ) {
		wp_enqueue_style('thickbox');
		wp_enqueue_style ('wp-jquery-ui-dialog');
		wp_enqueue_style("forte_meta", get_template_directory_uri()."/functions/css/forte_meta.css", false, "1.0", "all");
	}
	if ('admin.php' == basename($_SERVER['SCRIPT_NAME']) && isset($_GET['page']) && $_GET['page']=='admin_interface') {
		wp_enqueue_style('thickbox');
		wp_enqueue_style ('wp-jquery-ui-dialog');
		wp_enqueue_style("codemirror-main", get_template_directory_uri()."/functions/css/codemirror.css", false, "1.0", "all");
		wp_enqueue_style("codemirror-skin", get_template_directory_uri()."/functions/css/default.css", false, "1.0", "all");
		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_style("forte_admin", get_template_directory_uri()."/functions/css/forte_admin.css", false, "1.0", "all");
	}
	wp_deregister_style('jquery-ui-style');
	if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
		wp_enqueue_style ('wp-jquery-ui-dialog');
		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_style("forte_meta", get_template_directory_uri()."/functions/css/forte_meta.css", false, "1.0", "all");
	}
}
add_action('admin_print_styles', 'pix_admin_styles');

/*=========================================================================================*/

function pix_admin_enqueue_scripts() {
	global $pagenow;
	if ( 'nav-menus.php' == basename($_SERVER['SCRIPT_NAME']) ) {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script( 'pix-tb', get_template_directory_uri()."/functions/scripts/pix_thickbox.js", array('thickbox') );
		wp_enqueue_script( 'pix-tb' );
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('pix-scripts', get_template_directory_uri()."/functions/scripts/pix_scripts.js", array('jquery','jquery-ui-dialog','jquery-ui-sortable','jquery-ui-draggable','jquery-ui-droppable'));
	}
	if(isset($_GET['page']) && $_GET['page']=='admin_interface'){
		if(pix_get_option('pix_enable_google')=='true') {
			wp_enqueue_script('google-font', "https://www.google.com/jsapi");
		}
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script( 'pix-tb', get_template_directory_uri()."/functions/scripts/pix_thickbox.js", array('thickbox') );
		wp_enqueue_script( 'pix-tb' );
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script("jquery-ui-touch-punch", get_template_directory_uri()."/scripts/jquery.ui.touch-punch.min.js", array('jquery-ui-mouse'), "1.0", false);
		wp_enqueue_script('codemirror', get_template_directory_uri()."/functions/scripts/codemirror.js", array('jquery'));
		wp_enqueue_script('codemirror-css', get_template_directory_uri()."/functions/scripts//css.js", array('jquery'));
		wp_enqueue_script('modernizr', get_template_directory_uri()."/scripts/modernizr.pix.js");
		wp_enqueue_script("jquery-colorbox", get_template_directory_uri()."/functions/scripts/jquery.colorbox-min.js", array('jquery'), "1.0", false);
		wp_enqueue_script( 'farbtastic' );
		wp_enqueue_script('jquery-ui-slider', get_template_directory_uri()."/functions/scripts/jquery.ui.slider.js", array('jquery-ui-core','jquery-ui-mouse','jquery-ui-widget'));
		wp_enqueue_script('pix-page-builder', get_template_directory_uri()."/functions/scripts/pix_page_builder.js", array('jquery-ui-sortable'));
		wp_enqueue_script('pix-scripts', get_template_directory_uri()."/functions/scripts/pix_scripts.js", array('jquery','jquery-ui-sortable','jquery-ui-draggable','jquery-ui-droppable'));
	}
	if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
		wp_enqueue_script("jquery-ui-touch-punch", get_template_directory_uri()."/scripts/jquery.ui.touch-punch.min.js", array('jquery-ui-mouse'), "1.0", false);
		wp_enqueue_script( 'farbtastic' );
		wp_enqueue_script('jquery-ui-slider', get_template_directory_uri()."/functions/scripts/jquery.ui.slider.js", array('jquery-ui-core','jquery-ui-mouse','jquery-ui-widget'));
		wp_enqueue_script('pix-page-builder', get_template_directory_uri()."/functions/scripts/pix_page_builder.js", array('jquery-ui-sortable','jquery-ui-dialog'));
		wp_enqueue_script('pix-scripts', get_template_directory_uri()."/functions/scripts/pix_scripts.js", array('jquery','jquery-ui-sortable','jquery-ui-draggable','jquery-ui-droppable'));
	}

	wp_enqueue_script('pix-global', get_template_directory_uri()."/functions/scripts/pix_global.js", array('jquery'));
}
add_action('admin_enqueue_scripts', 'pix_admin_enqueue_scripts');

/*=========================================================================================*/

function forte_wrap_class( $classes ) {
	if ('admin.php' == basename($_SERVER['SCRIPT_NAME']) && isset($_GET['page']) && $_GET['page']=='admin_interface') {
        $classes .= 'forte_body';
	}
	return $classes;
}

add_filter('admin_body_class', 'forte_wrap_class', 1);

/*=========================================================================================*/

add_theme_support( 'automatic-feed-links' );

/*=========================================================================================*/

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 75, 75, true );

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size('mini_preview', 33, 33, true);
	add_image_size('mini_th', 45, 45, true);
	add_image_size('mid_th', 100, 100, true);
	add_image_size('one_column', 210, 0, true);
	add_image_size('one_column_thumb', 210, 132, true);
	add_image_size('one_column_4_3', 210, 157, true);
	add_image_size('two_columns', 470, 0, true);
	add_image_size('two_columns_thumb', 470, 264, true);
	add_image_size('two_columns_4_3', 470, 352, true);
	add_image_size('three_columns', 730, 0, true);
	add_image_size('three_columns_thumb', 730, 410, true);
	add_image_size('four_columns', 990, 0, true);
}

/*=========================================================================================*/

add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );

/*add_theme_support( 'structured-post-formats', array(
    'gallery', 'video', 'audio' 
) );*/

function pix_post_format_compat_args( $args ) {
	global $post;
	$page_template = get_post_meta( $post->ID, 'pix_page_template_select', true );
	if ( isset($page_template) && $page_template=='widepage.php' && file_exists(get_template_directory() . '/single-wide.php')) {
	    $args['class'] = get_post_format_content_class( $format ). ' ' . $post->ID .' pix_column pix_column_990';
	}
    $args['position'] = 'before';
    return $args;
}
add_filter( 'post_format_compat', 'pix_post_format_compat_args' );

/*=========================================================================================*/

if ( !function_exists('pix_AddThumbColumn') && function_exists('add_theme_support') ) {
 
	function pix_AddThumbColumn($cols) { 

		global $typenow;
		if ( empty( $typenow ) && !empty( $_GET['post'] ) ) {
			$post = get_post( $_GET['post'] );
			$typenow = $post->post_type;
		} elseif ( empty( $typenow ) && !empty( $_GET['post_type'] ) ) {
			$typenow = $_GET['post_type'];
		}
		
		$cols['thumbnail'] = __('Thumbnail'); 
		if ( $typenow != 'testimonial' ) {
			$cols['template'] = __('Template'); 
		}
		if ( $typenow == 'portfolio' ) {
			$cols['galleries'] = __('Galleries'); 
			$cols['portfolio_tag'] = __('Tags'); 
		}
		return $cols;
	}
 
	function pix_AddThumbValue($column_name) {
		global $post;
		
		$post_id = $post->ID;
		
		$width = (int) 75;
		$height = (int) 75;
		

		global $typenow;
		if ( empty( $typenow ) && !empty( $_GET['post'] ) ) {
			$post = get_post( $_GET['post'] );
			$typenow = $post->post_type;
		} elseif ( empty( $typenow ) && !empty( $_GET['post_type'] ) ) {
			$typenow = $_GET['post_type'];
		}

		switch ( $column_name ) {
			case 'thumbnail':
				$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
				$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
				if ($thumbnail_id)
					$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
				elseif ($attachments) {
					foreach ( $attachments as $attachment_id => $attachment ) {
						$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
					}
				}
					if ( isset($thumb) && $thumb ) {
						echo $thumb;
					} else {
						echo __('None');
					}
				break;
		
			case 'template':
				if ( $typenow == 'page' ) {
					$templ_type = get_post_meta( $post_id, '_wp_page_template', true );
				} else {
					$templ_type = get_post_meta( $post_id, 'pix_page_template_select', true );
				}
				
				$columns = get_post_meta( $post_id, 'pix_hidden_field', true );
				
				switch ( $templ_type ) {
					case 'widepage.php':
						$templ_size = 4;
						$class_icon = 'pix_template_widepage_icon';
						break;
					default:
						$templ_size = 3;
						$class_icon = 'pix_template_defaultpage_icon';
						break;
				}
						
				$columns = isset($columns) ? $columns : $templ_size;
				
				if ( $columns > $templ_size ) {
					echo '<a href="'.get_edit_post_link().'" class="pix_template_alert" data-tip="Too many columns!<br>Please, edit"></a>';
				} else {
					echo '<span class="'.$class_icon.'"></span>';
				}
				
				
				break;
	
			case 'description':
				echo pix_get_the_excerpt($length=15);
				break;

			case 'galleries':
				$_taxonomy = 'gallery';
				$categories = get_the_terms( $post_id, $_taxonomy );
				if ( !empty( $categories ) ) {
					$out = array();
					foreach ( $categories as $c )
						$out[] = "<a href='edit.php?gallery=$c->term_id&post_type=portfolio'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
					echo join( ', ', $out );
				}
				else {
					_e('Uncategorized');
				}
				break;

			case 'portfolio_tag':
				$_taxonomy = 'portfolio_tag';
				$categories = get_the_terms( $post_id, $_taxonomy );
				if ( !empty( $categories ) ) {
					$out = array();
					foreach ( $categories as $c )
						$out[] = "<a href='edit.php?gallery=$c->term_id&post_type=portfolio'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
					echo join( ', ', $out );
				}
				else {
					_e('No tags');
				}
				break;
		}
	}
 
	add_filter( 'manage_posts_columns', 'pix_AddThumbColumn' );
	add_action( 'manage_posts_custom_column', 'pix_AddThumbValue', 100, 2 );
	add_filter( 'manage_page_posts_columns', 'pix_AddThumbColumn' );
	add_action( 'manage_page_posts_custom_column', 'pix_AddThumbValue', 100, 2 );
 
}

/*=========================================================================================*/

function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
	if($hexStr!='transparent'&&$hexStr!='') {
		$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr);
		$rgbArray = array();
		if (strlen($hexStr) == 6) {
			$colorVal = hexdec($hexStr);
			$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
			$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
			$rgbArray['blue'] = 0xFF & $colorVal;
			return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; 
		} elseif (strlen($hexStr) == 3) {
			$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
			$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
			$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
			return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; 
		} else {
			return false;
		}
	} else {
		return $hexStr;
	}
	
}

/*=========================================================================================*/

function pix_search_form($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . ( home_url( '/' ) ) . '" >
	<input type="text" value="' . __('Search...','forte') . '" name="s" id="s">
	<input type="hidden" name="post_type" value="">
	<a href="#" id="pix_search_toggle"><span>'.__('Show more options','forte').'</span><span class="hidden_div">'.__('Hide options','forte').'</span></a>
	<div class="clear"></div>
	<div class="hidden_div" id="pix_search_options">'.__('Search among...','forte').'<br>';
	$post_types = get_post_types(array( 'public' => true ));
    foreach ( $post_types as $post_type ) {
		if ( $post_type == 'post' || $post_type == 'page' || $post_type == 'product' || $post_type == 'portfolio') {
			$object = get_post_type_object($post_type);
			$label = $object->labels->name;
			$form .= '<label>'.$label.'<input type="checkbox" checked data-value="'.$post_type.'" class="letmebe"></label>';
		}
	}
	$form .= '<div class="clear"></div>
	<a href="#" id="pix_check_toggle"><span class="uncheck_all">'.__('Uncheck all','forte').'</span><span class="check_all hidden_div">'.__('Check all','forte').'</span></a>
	</div>
	</form>';

	return $form;
}
add_filter('get_search_form', 'pix_search_form');

/*=========================================================================================*/

function pix_get_content($url)
{
    $ch = curl_init();

    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_HEADER, 0);

    ob_start();

    curl_exec ($ch);
    curl_close ($ch);
    $string = ob_get_contents();

    ob_end_clean();
   
    return $string;    
}
			
/*=========================================================================================*/

function pix_url_2_link($text) { 
	$text = ereg_replace('[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]', '<a href="\\0" target="_blank" rel="nofollow">\\0</a>', $text);
	return $text;
}
			
/*=========================================================================================*/

function pix_compare_dates($date) { 
	$date = new DateTime($date);
	$date = $date->format('U');
	$date2 = time();
    $blocks = array( 
        array('name'=>__('year','forte'),'plural'=>__('years','forte'),'amount'=>60*60*24*365), 
        array('name'=>__('month','forte'),'plural'=>__('months','forte'),'amount'=>60*60*24*31), 
        array('name'=>__('week','forte'),'plural'=>__('weeks','forte'),'amount'=>60*60*24*7), 
        array('name'=>__('day','forte'),'plural'=>__('days','forte'),'amount'=>60*60*24), 
        array('name'=>__('hour','forte'),'plural'=>__('hours','forte'),'amount'=>60*60), 
        array('name'=>__('minute','forte'),'plural'=>__('minutes','forte'),'amount'=>60), 
        array('name'=>__('second','forte'),'plural'=>__('seconds','forte'),'amount'=>1) 
        ); 
    
    $diff = abs($date-$date2); 
    
    $levels = 1; 
    $current_level = 1; 
    $result = array(); 
    foreach($blocks as $block) 
        { 
        if ($current_level > $levels) {break;} 
        if ($diff/$block['amount'] >= 1) 
            { 
            $amount = floor($diff/$block['amount']); 
            if ($amount>1) {$name=$block['plural'];} else {$name=$block['name'];} 
            $result[] = $amount.' '.$name; 
            $diff -= $amount*$block['amount']; 
            $current_level++; 
            } 
        } 
	return implode(' ',$result).' '.__('ago','forte'); 
} 
			
/*=========================================================================================*/

function print_forte_var() {
	global $current_user, $display_name, $pagenow;
	get_currentuserinfo();
	$upload_dir = wp_upload_dir();

	$out = '<script type="text/javascript">var themedir = "'.get_template_directory_uri().'"; var upload_dir = "'.$upload_dir['baseurl'].'"; ';

	$nonce = wp_create_nonce( 'pix_sidebar' );
		
	$out .= 'var pix_sidebar_nonce = "' .$nonce. '";';
	
	$out .= 'var pix_caption_font_family = "'.pix_get_option('pix_slideshow_caption_fontfamily').'";'; 

	$out .= 'var pix_css_inline = "' .pix_get_option('pix_css_inline'). '";';

	$out .= '</script>';

	echo $out;
}
add_action('admin_head', 'print_forte_var');

/*=========================================================================================*/

function get_attachment_id_from_src($image_src) {
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
    $id = $wpdb->get_var($query);
 
    if($id == null){
        $image_src = basename ( $image_src );
        $q2 = "SELECT post_id FROM {$wpdb->postmeta}  WHERE meta_key = '_wp_attachment_metadata' AND meta_value LIKE '%$image_src%'";
        $id = $wpdb->get_var($q2);
    }
    return $id;
}

function get_pix_thumb($image_src, $thumb_size) {
	$upload_dir = wp_upload_dir();
	$image_id = get_attachment_id_from_src(str_replace($upload_dir['baseurl'].'/','',$image_src));  
	$url_thumb = wp_get_attachment_image_src($image_id,$thumb_size);  
	$url_thumb2 = $url_thumb[0];
	if($url_thumb2==''){
		$url_thumb2=$image_src;
	}
	return $url_thumb2;
}

/*=========================================================================================*/

function pix_current_page() {
	$pageURL = 'http';
	
	if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	
	$pageURL .= "://";
	
	if (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	
	return $pageURL;
}

/*=========================================================================================*/

function printMobile(){
	if (preg_match_all('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|pad|pod)/i', strtolower($_SERVER['HTTP_USER_AGENT']), $match)) {
		$match = implode('', array_unique($match[0]));
		return 'mobile '.$match;
	}
}

/*=========================================================================================*/

function detectIOS(){
	$ios5 = '0';
	if (preg_match('/(os 5_0)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$ios5++;
	}
	 
	if ($ios5 > 0) {
	   return true;
	}
}

/*=========================================================================================*/

function detectIE8(){
	$ie8 = '0';
	if (preg_match('/(?i)msie 8/', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$ie8++;
	}
	 
	if ($ie8 > 0) {
	   return true;
	}
}

/*=========================================================================================*/

add_filter('body_class','pix_class_names');
function pix_class_names($classes) {
	$classes[] = printMobile();
	$classes[] =  pix_get_option('pix_colorbox');
	$header_effect = pix_get_option('pix_header_effect')=='true' ? 'pix_header_effect' : '';
	$classes[] =  $header_effect;
	$title_section = pix_get_option('pix_enable_titlesection')=='0' ? 'pix_disable_titlesection' : '';
	$classes[] =  $title_section;
	$header_position = pix_get_option('pix_header_position')!='' ? pix_get_option('pix_header_position') : '';
	$classes[] =  $header_position;
	$header_resize = pix_get_option('pix_header_resize')=='true' ? 'header_resize' : '';
	$classes[] =  $header_resize;
	$colorbox_disabled = pix_get_option('pix_colorbox_disable')=='true' ? ' colorbox_disabled' : '';
	$classes[] =  $colorbox_disabled;
	$classes[] =  pix_addBodyClassMobile();

	return $classes;
}

/*=========================================================================================*/

function pix_breadcrumbs($current='') {
 
	global $post, $wp_query, $woocommerce_en;
	
	if ( pix_get_option('pix_enable_breadcrumbs') == 'true' ) {
	
		$home = home_url();
		$delimiter = '<li class="bread_separator"><i class="icon-next-slide"></i></li>';
		$wrap_before = '<ul id="breadcrumbs">';
		$wrap_after = '</ul>';
		$before = '<li>';
		$after = '</li>';
		$home_link = home_url();
		
		$prepend = '';

		echo $wrap_before;
		
		if ( $woocommerce_en == 'active' && woocommerce_get_page_id('shop') && get_option('page_on_front') !== woocommerce_get_page_id('shop') )
			$prepend =  $before . '<a href="' . get_permalink( woocommerce_get_page_id('shop') ) . '">' . get_the_title( woocommerce_get_page_id('shop') ) . '</a> ' . $after . $delimiter;
		
		if ( (!is_front_page() && !($woocommerce_en == 'active' && is_post_type_archive() && get_option('page_on_front')==woocommerce_get_page_id('shop'))) || is_paged() ) :
		
			
			echo $before  . '<a class="home" href="' . $home_link . '"><i class="icon-home"></i></a> '  . $after . $delimiter ;
			
			if ( $current != '' ) :
				echo $before . $current . $after;

			
			elseif ( is_category() ) :
			
				$cat_obj = $wp_query->get_queried_object();
				$this_category = $cat_obj->term_id;
				$this_category = get_category( $this_category );
				if ($this_category->parent != 0) :
					$parent_category = get_category( $this_category->parent );
					echo get_category_parents($parent_category, TRUE, $delimiter );
				endif;
				echo $before . single_cat_title('', false) . $after;
			
			elseif ( is_tax('product_cat') ) :
				
				echo $prepend;
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			
				$parents = array();
				$parent = $term->parent;
				while ($parent):
					$parents[] = $parent;
					$new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
					$parent = $new_parent->parent;
				endwhile;
				
				if(!empty($parents)):
					$parents = array_reverse($parents);
					foreach ($parents as $parent):
						$item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
						echo $before .  '<a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a>' . $after . $delimiter;
					endforeach;
				endif;
			
				$queried_object = $wp_query->get_queried_object();
				echo $before . $queried_object->name . $after;
			
			elseif ( is_tax('product_tag') ) :
			
				$queried_object = $wp_query->get_queried_object();
				echo $prepend . $before . __('Products tagged &ldquo;', 'forte') . $queried_object->name . '&rdquo;' . $after;
			
			elseif ( is_tax('portfolio_tag') ) :
			
				$queried_object = $wp_query->get_queried_object();
				echo $prepend . $before . __('Items tagged &ldquo;', 'forte') . $queried_object->name . '&rdquo;' . $after;
			
			elseif ( is_tax('gallery') ) :
			
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				$current_term = $term->term_id; $taxonomy = $term->taxonomy;
				$cus_terms = get_ancestors( $current_term, $taxonomy );
				foreach ( $cus_terms as $cus_term ) {
					$the_term = get_term_by( 'id', $cus_term, $taxonomy );
					echo $before . "<a href='".get_term_link( $the_term->slug, $taxonomy )."'>".$the_term->name."</a>" . $after . $delimiter;
				}
				echo $before . $term->name . $after;
				
			elseif ( is_day() ) :
			
				echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after . $delimiter;
				echo $before . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $after . $delimiter;
				echo $before . get_the_time('d') . $after;
			
			elseif ( is_month() ) :
			
				echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after . $delimiter;
				echo $before . get_the_time('F') . $after;
			
			elseif ( is_year() ) :
			
				echo $before . get_the_time('Y') . $after;
			
			elseif ( is_post_type_archive('product') && get_option('page_on_front') !== woocommerce_get_page_id('shop') ) :
			
				$_name = woocommerce_get_page_id( 'shop' ) ? get_the_title( woocommerce_get_page_id( 'shop' ) ) : ucwords( get_option( 'woocommerce_shop_slug' ) );
			
				if (is_search()) :
			
					echo $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $delimiter . __('Search results for &ldquo;', 'forte') . get_search_query() . '&rdquo;' . $after;
			
				else :
			
					echo $before . '' . $_name . '' . $after;
			
				endif;
			
			elseif ( is_single() && !is_attachment() ) :
			
				if ( get_post_type() == 'product' ) :
				
						echo $prepend;
				
						if ($terms = wp_get_object_terms( $post->ID, 'product_cat' )) :
						$term = current($terms);
						$parents = array();
						$parent = $term->parent;
						while ($parent):
							$parents[] = $parent;
							$new_parent = get_term_by( 'id', $parent, 'product_cat');
							$parent = $new_parent->parent;
						endwhile;
						if(!empty($parents)):
							$parents = array_reverse($parents);
							foreach ($parents as $parent):
								$item = get_term_by( 'id', $parent, 'product_cat');
								echo $before . '<a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a>' . $after . $delimiter;
							endforeach;
						endif;
						echo $before . '<a href="' . get_term_link( $term->slug, 'product_cat' ) . '">' . $term->name . '</a>' . $after . $delimiter;
					endif;
				
					echo $before . get_the_title() . $after;
				
				elseif ( get_post_type() == 'portfolio' ) :
				
						if ($terms = wp_get_object_terms( $post->ID, 'gallery' )) :
						$term = current($terms);
						$parents = array();
						$parent = $term->parent;
						while ($parent):
							$parents[] = $parent;
							$new_parent = get_term_by( 'id', $parent, 'gallery');
							$parent = $new_parent->parent;
						endwhile;
						if(!empty($parents)):
							$parents = array_reverse($parents);
							foreach ($parents as $parent):
								$item = get_term_by( 'id', $parent, 'gallery');
								echo $before . '<a href="' . get_term_link( $item->slug, 'gallery' ) . '">' . $item->name . '</a>' . $after . $delimiter;
							endforeach;
						endif;
						echo $before . '<a href="' . get_term_link( $term->slug, 'gallery' ) . '">' . $term->name . '</a>' . $after . $delimiter;
					endif;
				
					echo $before . get_the_title() . $after;
				
				elseif ( get_post_type() != 'post' ) :
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
						echo $before . '<a href="' . get_post_type_archive_link(get_post_type()) . '">' . $post_type->labels->singular_name . '</a>' . $after . $delimiter;
					echo $before . get_the_title() . $after;
				else :
					$cat = current(get_the_category());
					echo '<li>'.get_category_parents($cat, TRUE, $after . '</li><li>'. $delimiter . '</li><li>');
					echo $before . get_the_title() . $after;
				endif;
			
			elseif ( is_404() ) :
			
				echo $before . __('Error 404', 'forte') . $after;
			
			/*elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) :
			
				$post_type = get_post_type_object(get_post_type());
				if ($post_type) : echo $before . $post_type->labels->singular_name . $after; endif;*/
			
			elseif ( is_attachment() ) :
			
				echo $before . get_the_title() . $after;
			
			elseif ( is_home() ) :
			
				echo $before . get_the_title(get_option('page_for_posts')) . $after;
			
			elseif ( is_page() && !$post->post_parent ) :
			
				echo $before . get_the_title() . $after;
			
			elseif ( is_page() && $post->post_parent ) :
			
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = $before.'<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>'.$after;
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) :
					echo $crumb . '' . $delimiter;
				endforeach;
				echo $before . get_the_title() . $after;
			
			elseif ( is_search() ) :
			
				echo $before . __('Search results for &ldquo;', 'forte') . get_search_query() . '&rdquo;' . $after;
			
			elseif ( is_tag() ) :
			
					echo $before . __('Posts tagged &ldquo;', 'forte') . single_tag_title('', false) . '&rdquo;' . $after;
			
			elseif ( is_author() ) :
			
				$userdata = get_userdata(get_the_author_meta('ID'));
				echo $before . __('Author:', 'forte') . ' ' . $userdata->display_name . $after;
			
			endif;
			
			if ( get_query_var('paged') ) :
			
				echo '<li>&nbsp;(' . __('Page', 'forte') . ' ' . get_query_var('paged') .')</li>';
			
			endif;
			
			echo $wrap_after;
		
		endif;
	}
}

/*=========================================================================================*/

add_filter('attachment_fields_to_edit', 'pix_image_attachment_fields_to_edit', 11, 2);

function pix_image_attachment_fields_to_edit($form_fields, $post) {
	if ( substr($post->post_mime_type, 0, 5) == 'image' ) {
		$alt = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
		if ( empty($alt) )
		$alt = '';

		$form_fields['post_title']['required'] = true;
		
		$form_fields['image_alt'] = array(
			'value' => $alt,
			'label' => __('Alternate text'),
			'helps' => __('Alt text for the image, e.g. &#8220;The Mona Lisa&#8221;')
		);
		
		$form_fields['align'] = array(
			'label' => __('Alignment'),
			'input' => 'html',
			'html'  => image_align_input_fields($post, get_option('image_default_align')),
		);
		
		$form_fields['image-size'] = pix_image_size_input_fields( $post, get_option('image_default_size', 'medium') );


	} else {
		unset( $form_fields['image_alt'] );
	}
	
	return $form_fields;
}

	add_image_size('mini_preview', 33, 33, true);
	add_image_size('mini_th', 45, 45, true);
	add_image_size('mid_th', 100, 100, true);


function pix_image_size_input_fields( $post, $check = '' ) {

	// get a list of the actual pixel dimensions of each possible intermediate version of this image
	$size_names = array('mini_preview' => __('Mini'), 'mini_th' => __('Thumbnail'), 'mid_th' => __('Medium thumbnail'), 'one_column' => __('One column size'), 'one_column_thumb' => __('One column th. size'), 'two_columns' => __('Two column size'), 'three_columns' => __('Three column size'), 'four_columns' => __('Four columns size'), 'full' => __('Full size'));

	if ( empty($check) )
		$check = get_user_setting('imgsize', 'three_columns');

	foreach ( $size_names as $size => $label ) {
		$downsize = image_downsize($post->ID, $size);
		$checked = '';

		// is this size selectable?
		$enabled = ( $downsize[3] || 'full' == $size );
		$css_id = "image-size-{$size}-{$post->ID}";
		// if this size is the default but that's not available, don't select it
		if ( $size == $check ) {
			if ( $enabled )
				$checked = " checked='checked'";
			else
				$check = '';
		} elseif ( !$check && $enabled && 'three_columns' != $size ) {
			// if $check is not enabled, default to the first available size that's bigger than a thumbnail
			$check = $size;
			$checked = " checked='checked'";
		}

		$html = "<div class='image-size-item'><input type='radio' " . disabled( $enabled, false, false ) . "name='attachments[$post->ID][image-size]' id='{$css_id}' value='{$size}'{$checked} />";

		$html .= "<label for='{$css_id}'>$label</label>";
		// only show the dimensions if that choice is available
		if ( $enabled )
			$html .= " <label for='{$css_id}' class='help'>" . sprintf( "(%d&nbsp;&times;&nbsp;%d)", $downsize[1], $downsize[2] ). "</label>";

		$html .= '</div>';

		$out[] = $html;
	}

	return array(
		'label' => __('Size'),
		'input' => 'html',
		'html'  => join("\n", $out),
	);
}

add_filter('image_size_input_fields','pix_image_size_input_fields',10);

/*=========================================================================================*/

function pix_front_javascript_var() {
	global $wp_query, $posts_per_page, $post, $pix_pages, $content_width, $my_query_2;
	if(!isset($posts_per_page) || $posts_per_page=='') {
		$posts_per_page = get_option('posts_per_page');
	}
	$post_type = get_post_type();
	$out = '<script type="text/javascript">';
	$out .= 'var forte_theme_dir = "'.get_template_directory_uri().'";';
	$out .= 'var forte_content_width = "'.$content_width.'";';
	$out .= 'var forte_icon_color = "'.pix_get_option('pix_icons_color').'";';
	if ( is_home() ) {
		$pages = $wp_query->max_num_pages;
	} else {
		if ( $my_query_2 ) {
			$pages = $my_query_2->post_count / $posts_per_page;
		}
	}
	if(isset($pages) && !$pages) {
		$pages = 1;
	} elseif(!isset($pages)) {
		$pages = 'null';
	}
	if ( $pix_pages ) {
		$pages = $pix_pages;
	}
	$out .= 'var forte_theme_pages = "'.round($pages).'";'; 
	$out .= 'var forte_home = "'.home_url().'";'; 
	$out .= 'var pix_CB_close = "'.__('close','forte').'";'; 
	$out .= 'var pix_CB_next = "'.__('next','forte').'";'; 
	$out .= 'var pix_CB_prev = "'.__('previous','forte').'";'; 
	$out .= 'var pix_pie_bg = "'.pix_get_option('pix_slideshow_pie_bg').'";'; 
	$out .= 'var pix_pie_stroke = "'.pix_get_option('pix_slideshow_pie_stroke').'";'; 
	$out .= 'var pix_canvas_color = "'.pix_get_option('pix_general_text_color').'";';
	$out .= '</script>';

	return $out;

}

/*=========================================================================================*/

function pixRefererHeader() {
	if(isset( $_SERVER["HTTP_REFERER"] ) && $_SERVER["HTTP_REFERER"] != "") {
		$refer = $_SERVER['HTTP_REFERER'];
	} else {
		$refer = '';
	}
	return '<header data-height="101" data-referer="'.$refer.'">';
}

/*=========================================================================================*/

add_filter('show_admin_bar', '__return_false');

/*=========================================================================================*/

function pix_the_excerpt($length=-1, $start='', $more='', $end_char = '[&#8230;]'){
    
	echo pix_get_the_excerpt($length, $start, $more, $end_char);
	
} 

/*=========================================================================================*/

function pix_get_the_excerpt($length=-1, $start='', $more='', $end_char = '[&#8230;]'){
    global $post;
	if (function_exists('has_excerpt') && has_excerpt()) {
		$match = '(pix_dropcap|againb)';
		$out = html5autop(get_the_excerpt()); 
		$out = preg_replace('!\['.$match.'\]([^<]+)\[/'.$match.'\]!', "$2", $out);  
		$out = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $out);
	} else {
		if ( $length == 0 ) {
			$out = '';
		} else {
			$content = strip_tags($post->post_content);
			$match = '(pix_dropcap|againb)';
			$content = preg_replace('!\['.$match.'\]([^<]+)\[/'.$match.'\]!', "$2", $content);  
			$content = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $content);
			preg_match('/^\s*+(?:\S++\s*+){1,' .$length . '}/', $content, $matches);
			$no = count(explode(" ",$content));
			if ( count($matches) ) {
				$no2 = count(explode(" ",$matches[0]));
			} else {
				$no2 = 0;
			}
			if ( $length < 0 ) {
				$excerpt = preg_replace("/\n/", " ", $content);
				$end_char = '';
			} else {
				if ( count($matches) ) {
					$excerpt = preg_replace("/\n/", " ", $matches[0]);
				} else {
					$excerpt = '';
				}
			}
			if($no>$no2) {
				$out = '<p>'. $start . $excerpt . $end_char .'</p>';
			} else {
				$out = '<p>'. $start . $excerpt .'</p>';
			}
		}
	}
	if($more!=''){
		$out .= '<div class="end_meta"><a class="alignleft" href="'. get_permalink($post->ID) .'">'. $more .'</a></div>';
	}
	
	return $out;
	
} 

/*=========================================================================================*/

function pix_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $post;
	
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

		<?php 
			$authID = get_comment(get_comment_ID())->user_id;
			$user_info = get_userdata($authID);
			$class_container = '';
			$label_container = '';
			if($user_info!='0' && $user_info->user_level=='10') { 
				$class_container = ' highlighted'; 
				$admin_level = get_the_author_meta( 'forte_role', $authID  ) != '' ? get_the_author_meta( 'forte_role', $authID  ) : __('Administrator','forte');
            	$label_container = '<span class="pix_label_tag label_red">'.$admin_level.'<span class="label_flag_top"></span><span class="label_flag_bottom"></span><span class="label_shadow"></span></span>';
			} else if ( get_the_author_meta( 'forte_role', $authID  ) != '' ) {
				$class_container = ' highlighted'; 
            	$label_container = '<span class="pix_label_tag label_green">'.get_the_author_meta( 'forte_role', $authID ).'<span class="label_flag_top"></span><span class="label_flag_bottom"></span><span class="label_shadow"></span></span>';
			}
		?>
        
	<div class="comment_container_wrap">
        
	<?php if ( $depth != 1 ) { ?>
        <div class="comment_indent"></div>
    <?php } ?>
        <div id="comment-<?php comment_ID(); ?>" class="comment_container<?php echo $class_container; ?>">
    
            <div class="alignleft comment_avatar">
                <?php echo get_avatar( $GLOBALS['comment'], $size='50' ); ?>
            </div>
            
            <div class="comment-text">
            
            
                <p class="meta">
	                <?php if ($GLOBALS['comment']->comment_approved == '0') { ?>
                        <em><?php _e('Your comment is awaiting approval', 'forte'); ?></em>
                        <br>
	                <?php } ?>
	                <?php
						$author_url = get_comment_author_url();
						if ( 'http://' == $author_url )
							$author_url = '';
						if ( strlen( $author_url_display ) > 50 )
							$author_url_display = substr( $author_url_display, 0, 49 ) . '&hellip;';

						if ( !empty( $author_url ) )
							$comment_author = "<a title='$author_url' href='$author_url'>". get_comment_author() ."</a>";
						else
							$comment_author = get_comment_author() ;
						?>
                        <strong itemprop="author"><?php echo $comment_author; ?></strong><?php if ( $label_container!= '' ) { ?> <small><em>(<?php echo $label_container; ?>)</em></small><?php } ?>
                        <br>
                        <time itemprop="datePublished" datetime="<?php echo get_comment_date('c'); ?>"><?php echo get_comment_date(__('M jS Y', 'forte')); ?></time>
						<?php comment_reply_link( array_merge( array( 'reply_text' => __('Reply','forte')), array( 'depth' => $depth, 'max_depth' => 4 ) ) ); ?>
                    </p>
    
                    <div class="clear"></div>
                    
                    <div class="dotted_horiz"></div>
                
                    <div itemprop="description" class="description"><?php comment_text(); ?></div>
                    <div class="clear"></div>
                </div>
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><?php _e('Your comment is awaiting moderation','forte'); ?></em>
                    <?php endif; ?>
            
            		<div class="clear"></div>
            
                    <span class="alignright"><?php edit_comment_link( __( 'Edit', 'forte' ), ' ' ); ?></span>

        </div><!-- .comment_container -->
         <hr>			
        <div class="clear"></div>			
   </div><!-- .comment_cotainer_wrap -->
<?php
}

/*=========================================================================================*/

function pix_pagenavi($numposts='') {
	echo pix_get_pagenavi($numposts);
}

/*=========================================================================================*/

function pix_get_pagenavi($numposts='') {
	global $posts_per_page, $paged, $post, $wp_query;
	if(!isset($posts_per_page) || $posts_per_page=='') {
		$posts_per_page = get_option('posts_per_page');
	}

	$post_type = get_post_type();
	$out = '';
	
	if ( $numposts != '' ) {
		$max_page = ceil($numposts / $posts_per_page);
	} else {
		$max_page = $wp_query->max_num_pages;
	}

	$paglinks = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
		'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		'format' 		=> '',
		'current' 		=> max( 1, get_query_var('paged') ),
		'total' 		=> $max_page,
		'prev_text' 	=> '&larr;',
		'next_text' 	=> '&rarr;',
		'type'			=> 'plain',
		'end_size'		=> 3,
		'mid_size'		=> 3
	) ) );

	if ( $paglinks != '' ) {

		$out .=  "<div class='clear'></div>";
		$out .=  "<div class='pagenavi'>";
		$out .= $paglinks;
		$out .=  "</div>";

	}

	return $out;
}

add_filter ('loop_shop_per_page','pix_products_per_page');
function pix_products_per_page() {
	return pix_get_option('pix_woocommerce_ppp');
}

/*=========================================================================================*/

function pix_comments_pagenavi() {
   $pages = '';
   $max = get_comment_pages_count();
   $page = get_query_var('cpage');
   if (!$page) $page = 1;
   $a['current'] = $page;
   $a['echo'] = false;
 
   $total = 0; //1 - display the text "Page N of N", 0 - not display
   $a['mid_size'] = 3; //how many links to show on the left and right of the current
   $a['end_size'] = 1; //how many links to show in the beginning and end
   $a['prev_text'] = ''; //text of the "Previous page" link
   $a['next_text'] = ''; //text of the "Next page" link
 
   if ($max > 1) echo '<div class="pagenavi">';
   if ($total == 1 && $max > 1) $pages = '<span class="pages">Page ' . $page . ' of ' . $max . '</span>'."\r\n";
   echo $pages . paginate_comments_links($a);
   if ($max > 1) echo '</div><div class="clear"></div>';
}

/*=========================================================================================*/

add_filter('next_posts_link_attributes', 'pix_link_attributes');

function pix_link_attributes() {
    return 'class="pix_button first_color"';
}

/*=========================================================================================*/

function forte_posted_on() {
	printf( __( '<span>|&nbsp;Posted by %1$s in %2$s</span><span>|&nbsp;%3$s</span>', 'forte' ),
		sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'forte' ), get_the_author() ),
			get_the_author()
		),
		pix_category_list( ', ' ),
		sprintf( _n( '1 comment', '%1$s comments', get_comments_number(), 'forte' ), number_format_i18n( get_comments_number() ) )
	);
}

/*=========================================================================================*/

function pix_category_list( $separator = '', $parents='', $post_id = false ) {

	global $wp_rewrite;

	$categories = get_the_category( $post_id );

	if ( !is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) )

		return apply_filters( 'the_category', '', $separator, $parents );

	if ( empty( $categories ) )

		return apply_filters( 'the_category', __( 'Uncategorized' ), $separator, $parents );

	$rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'data-rel="category tag"' : 'data-rel="category"';

	$thelist = '';

	if ( '' == $separator ) {

		$thelist .= '<ul class="post-categories">';

		foreach ( $categories as $category ) {

			$thelist .= "\n\t<li>";

			switch ( strtolower( $parents ) ) {

				case 'multiple':

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, true, $separator );

					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';

					break;

				case 'single':

					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, false, $separator );

					$thelist .= $category->name.'</a></li>';

					break;

				case '':

				default:

					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';

			}

		}

		$thelist .= '</ul>';

	} else {

		$i = 0;

		foreach ( $categories as $category ) {

			if ( 0 < $i )

				$thelist .= $separator;

			switch ( strtolower( $parents ) ) {

				case 'multiple':

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, true, $separator );

					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a>';

					break;

				case 'single':

					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, false, $separator );

					$thelist .= "$category->name</a>";

					break;

				case '':

				default:

					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a>';

			}

			++$i;

		}

	}

	return apply_filters( 'the_category', $thelist, $separator, $parents );

}

/*=========================================================================================*/

function pix_get_plusones($url) {
 
    $args = array(
            'method' => 'POST',
            'headers' => array(
                // setup content type to JSON
                'Content-Type' => 'application/json'
            ),
            // setup POST options to Google API
            'body' => json_encode(array(
                'method' => 'pos.plusones.get',
                'id' => 'p',
                'method' => 'pos.plusones.get',
                'jsonrpc' => '2.0',
                'key' => 'p',
                'apiVersion' => 'v1',
                'params' => array(
                    'nolog'=>true,
                    'id'=> $url,
                    'source'=>'widget',
                    'userId'=>'@viewer',
                    'groupId'=>'@self'
                )
             )),
             // disable checking SSL sertificates
            'sslverify'=>false
        );
 
    // retrieves JSON with HTTP POST method for current URL
    $json_string = wp_remote_post("https://clients6.google.com/rpc", $args);
 
    if (is_wp_error($json_string)){
        // return zero if response is error
        return "0";
    } else {
        $json = json_decode($json_string['body'], true);
        // return count of Google +1 for requsted URL
        return intval( $json['result']['metadata']['globalCounts']['count'] );
    }
}

/*=========================================================================================*/

function pix_get_tweets($url) { 
 
    // retrieves data with HTTP GET method for current URL
    $json_string = wp_remote_get(
        'https://urls.api.twitter.com/1/urls/count.json?url='.$url,
        array(
            // disable checking SSL sertificates
            'sslverify'=>false
        )
    ); 
 
    // retrives only body from previous HTTP GET request
    $json_string = wp_remote_retrieve_body($json_string);
 
    // convert body data to JSON format
    $json = json_decode($json_string, true);
 
    // return count of Tweets for requested URL
    return intval( $json['count'] );
}

/*=========================================================================================*/

function pix_get_shares($url) { 
 
    // retrieves data with HTTP GET method for current URL
    $json_string = wp_remote_get(
        'https://graph.facebook.com/'.$url,
        array(
            // disable checking SSL sertificates
            'sslverify'=>false
        )
    );  
 
    // retrives only body from previous HTTP GET request
    $json_string = wp_remote_retrieve_body($json_string);
 
    // convert body data to JSON format
    $json = json_decode($json_string, true);    
 
    if (isset($json['shares'])) {
        // return count of Facebook shares for requested URL
        return intval( $json['shares'] );
    } else {
        // return zero if response is error or current URL not shared yet
        return "0";
    }
}

/*=========================================================================================*/

/*
Plugin Name: Like This
Plugin URI: http://lifeasrose.ca/2011/03/wordpress-plugin-i-like-this/
Description: Integrates a "Like This" option for posts, similar to the facebook Like button.  For visitors who want to let the author know that they enjoyed the post, but don't want to go to the effort of commenting.
Version: 1.3
Author: Rose Pritchard
Author URI: http://lifeasrose.ca
License: GPL2

Copyright 2011  Rose Pritchard  (email : rose@r.osey.me)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if (!function_exists('likeThis')) {
	function likeThis($post_id,$action = 'get') {
	
		if(!is_numeric($post_id)) {
			error_log("Error: Value submitted for post_id was not numeric");
			return;
		} //if
	
		switch($action) {
		
		case 'get':
			$data = get_post_meta($post_id, '_likes');
			
			if(!isset($data[0]) || !is_numeric($data[0])) {
					$data[0] = 0;
					add_post_meta($post_id, '_likes', '0', true);
				} //if
				
			
			return $data[0];
		break;
		
		
		case 'update':
			if(isset($_COOKIE["like_" . $post_id])) {
				return;
			} //if
			
			$currentValue = get_post_meta($post_id, '_likes');
			
			if(!is_numeric($currentValue[0])) {
				$currentValue[0] = 0;
				add_post_meta($post_id, '_likes', '1', true);
			} //if
			
			$currentValue[0]++;
			update_post_meta($post_id, '_likes', $currentValue[0]);
			
			setcookie("like_" . $post_id, $post_id,time()+(60*60*24*365));
		break;
	
		} //switch
	
	} //likeThis
}

if (!function_exists('printLikes')) {
	function printLikes($post_id) {
		
		echo printGetLikes($post_id);
		
	} 
	
}

function printGetLikes($post_id) {
	$likes = likeThis($post_id);
	$out = '';
	
	if(isset($_COOKIE["like_" . $post_id])) {
		$out .= '<a href="#" class="likeThis done"><i class="icon-heart"></i> <span class="likes-amount" id="like-'.$post_id.'">'.$likes.'</span></a>';
	} else {
		$out .= '<a href="#" class="likeThis"><i class="icon-heart"></i> <span class="likes-amount" id="like-'.$post_id.'">'.$likes.'</span></a>';
	}

	return $out;
} 



if (!function_exists('setUpPostLikes')) {
	function setUpPostLikes($post_id) {
		if(!is_numeric($post_id)) {
			error_log("Error: Value submitted for post_id was not numeric");
			return;
		} //if
		
		
		add_post_meta($post_id, '_likes', '0', true);
	
	} //setUpPost
}


if (!function_exists('checkHeaders')) {
	function checkHeaders() {
		if(isset($_POST["likepost"])) {
			likeThis($_POST["likepost"],'update');
		} //if
	
	} //checkHeaders
}


if (!function_exists('jsIncludes')) {
	function jsIncludes() {
		wp_register_script('likesScript', get_template_directory_uri(). '/scripts/likesScript.js',array('jquery') );
		wp_enqueue_script('likesScript');
	
	} //jsIncludes
}

add_action ('publish_post', 'setUpPostLikes');
add_action ('init', 'checkHeaders');
add_action ('get_header', 'jsIncludes');



/**
 * Popular Post Widget Class
 */
if(!class_exists('MostLikedPosts')) {
	class MostLikedPosts extends WP_Widget {
		// constructor 
			function __construct()
			{
			 parent::__construct( 'mostlikedposts', 'Most Liked Posts' );
		   }
	
		// @see WP_Widget::widget 
		function widget( $args, $instance ) {
			extract( $args );
			$title = apply_filters( 'widget_title', $instance['title'] );
			$source = apply_filters( 'widget_source', $instance['source'] );
			$numberOfPostsToShow = apply_filters('widget_numberOfPostsToShow',$instance['numberOfPostsToShow']);
			print $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title; 
				
				
			$querystr = new WP_Query(array(
                'post_type'=> $source,
                'post_status' => 'publish',
                'meta_key' => '_likes',
                'order' => 'DESC',
                'orderby' => 'meta_value',
                'posts_per_page' => $numberOfPostsToShow
            ));

			if($querystr->have_posts()):
				if ( $source=='post' ) {
					echo "<ul>";
				    while($querystr->have_posts()):$querystr->the_post();
						?>
						<li class="likes-list">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
							<?php the_title(); ?></a> <span class="likes-report">(<i class="icon-heart"></i><?php echo get_post_meta(get_the_id(),"_likes",1);  ?>)</span>
						</li>
				    <?php endwhile;
					echo "</ul>"; 
				} else {
					echo '<div class="pix_thumbs">';
				    while($querystr->have_posts()):$querystr->the_post();
						if(has_post_thumbnail()) {
							$attachment_id = get_post_thumbnail_id(get_the_id());
							$image_id = get_post_thumbnail_id();  
							$image_url = wp_get_attachment_image_src($image_id,'mid_th');  
							$image_url = $image_url[0]; 
							$image_full = wp_get_attachment_image_src($image_id,'full');  
							$image_full = $image_full[0]; 
						?>
						<a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url; ?>" alt="<?php echo the_title_attribute(); ?>"></a>
						<?php }  
				    endwhile;
					echo '</div>';
				}
			endif;
			
			wp_reset_postdata();



		print $after_widget;

		}
	
		// @see WP_Widget::update 
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['source'] = strip_tags($new_instance['source']);
			
			if(is_numeric($new_instance['numberOfPostsToShow'])) { 
			 $instance['numberOfPostsToShow'] = strip_tags($new_instance['numberOfPostsToShow']);
			} else {
			 
			 $instance['numberOfPostsToShow'] = strip_tags("5");
			}
			return $instance;
		}
	
		// @see WP_Widget::form 
		function form( $instance ) {
			if ( $instance ) {
				$title = esc_attr( $instance[ 'title' ] );
				$source = esc_attr( $instance[ 'source' ] );
				$numberOfPostsToShow = esc_attr( $instance[ 'numberOfPostsToShow' ] );
			}
			else {
				$title = __( 'Most Liked Posts', 'forte' );
				$source = __( 'post', 'forte' );
				$numberOfPostsToShow = __( '5', 'forte' );
			}
			?>
			<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('source'); ?>">Posts or portfolio items</label>
	            	<select id="<?php echo $this->get_field_id('source'); ?>" name="<?php echo $this->get_field_name('source'); ?>" class="widefat">
	                	<option value="post"<?php $instance['source'] = isset($instance['source']) ? $instance['source'] : 'post'; selected( $instance['source'], 'post' ); ?>>Posts</option>
	                	<option value="portfolio"<?php selected( $instance['source'], 'portfolio' ); ?>>Portfolio items</option>
	                </select>
			</p>
			
			<p>
			<label for="<?php echo $this->get_field_id('numberOfPostsToShow'); ?>"><?php _e('Number of Posts to Show:'); ?></label> 
			<input class="shortfat" id="<?php echo $this->get_field_id('numberOfPostsToShow'); ?>" name="<?php echo $this->get_field_name('numberOfPostsToShow'); ?>" width="3" type="text" value="<?php echo $numberOfPostsToShow; ?>" />
			</p>
			<?php 
		}
	
	} // class MostLikedPosts
}

add_action( 'widgets_init', create_function( '', 'return register_widget("MostLikedPosts");' ) );

/*=========================================================================================*/

function pix_detectMobile(){
	$mobile_browser = '0';
	 
	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|pad)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$mobile_browser++;
	}
	 
	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
		$mobile_browser++;
	}    
	 
	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = array(
		'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
		'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
		'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
		'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
		'newt','noki','palm','pana','pant','phil','play','port','prox',
		'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
		'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
		'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
		'wapr','webc','winw','winw','xda ','xda-');
	 
	if (in_array($mobile_ua,$mobile_agents)) {
		$mobile_browser++;
	}
	 
	/*if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) {
		$mobile_browser++;
	}*/
	 
	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
		$mobile_browser = 0;
	}
	 
	if ($mobile_browser > 0) {
	   return true;
	}
}

/*=========================================================================================*/

add_action( 'restrict_manage_posts', 'pix_restrict_manage_posts' );
add_filter('parse_query','pix_convert_restrict');
function pix_restrict_manage_posts() {
    global $typenow;
    $args = array( 'public' => true, '_builtin' => false );
    $post_types = get_post_types($args);
    if ( $typenow == 'portfolio' ) {
        $filter = get_object_taxonomies($typenow);
        foreach ($filter as $tax_slug) {
                $tax_obj = get_taxonomy($tax_slug);
                wp_dropdown_categories(array(
                    'show_option_all' => __('Show All '.$tax_obj->label ),
                    'taxonomy' => $tax_slug,
                    'name' => $tax_obj->name,
                    'orderby' => 'name',
                    'selected' => isset($_GET[$tax_obj->query_var]) ? $_GET[$tax_obj->query_var] : '',
                    'hierarchical' => $tax_obj->hierarchical,
                    'show_count' => true,
                    'hide_empty' => false
                ));
        }
    }
}
function pix_convert_restrict($query) {
    global $pagenow, $typenow;
    if ($pagenow=='edit.php' && $typenow=='portfolio') {
        $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
            $var = &$query->query_vars[$tax_slug];
            if ( isset($var) ) {
                $term = get_term_by('id',$var,$tax_slug);
                $var = $term->slug;
            }
        }
    }
}
function pix_override_is_tax_on_post_search($query) {
    global $pagenow, $typenow;
    $qv = &$query->query_vars;
    if ($pagenow == 'edit.php' && $typenow=='portfolio' && isset($qv['taxonomy']) && isset($qv['s'])) {
        $query->is_tax = true;
    }
}
add_filter('parse_query','pix_override_is_tax_on_post_search');

/*=========================================================================================*/

function pix_get_seo() {
	global $post;

	if ( pix_get_option('pix_allow_seo')=='true' ) {

		$body_class = get_body_class();
		$body_class = implode($body_class,' ');
		$catID = get_query_var('cat');
		$pix_array_category = pix_get_option('pix_array_category_'.$catID);
		if(is_tax('gallery')){
			$term = get_term_by( 'slug',  get_query_var( 'term' ), 'gallery' );
			$termID = $term->term_id;
			$pix_array_gallery = pix_get_option('pix_array_gallery_'.$termID);
		}
		
		if ( pix_is_shop() ) {
			$id = woocommerce_get_page_id('shop');
		} elseif ( is_home() ) {
			$id = get_option('page_for_posts');
		} else {
			$id = get_the_ID();
		}

		$out = '';
		
		if(is_404() && pix_get_option('pix_404_metatitle' ) != '') {
			$out .= '<title>' . pix_get_option('pix_404_metatitle') .'</title>'.PHP_EOL;
		} elseif(is_search() && pix_get_option('pix_search_metatitle' ) != '') {
			$out .= '<title>' . pix_get_option('pix_search_metatitle') .'</title>'.PHP_EOL;
		} elseif ( is_category() && $pix_array_category['metatitle']!='' ) {
			$out .= '<title>' . $pix_array_category['metatitle'] .'</title>'.PHP_EOL;
		} elseif( is_archive() && pix_get_option('pix_archive_metatitle' ) != '' ) {
			$out .= '<title>' . pix_get_option('pix_archive_metatitle') .'</title>'.PHP_EOL;
		} elseif ( is_tax('gallery') && $pix_array_gallery['metatitle']!='' ) {
			$out .= '<title>' . $pix_array_gallery['metatitle'] .'</title>'.PHP_EOL;
		} elseif(is_attachment() && pix_get_option('pix_image_metatitle' ) != '') {
			$out .= '<title>' . pix_get_option('pix_image_metatitle') .'</title>'.PHP_EOL;
		} elseif ( get_post_meta($id, 'pix_pag_opts_metatitle', TRUE) != '' && !is_archive() ) {
			$out .= '<title>' . get_post_meta($id, 'pix_pag_opts_metatitle', TRUE) .'</title>'.PHP_EOL;
		} elseif ( pix_is_woocommerce() && pix_get_option('pix_woo_metatitle') != '' ) {
			$out .= '<title>' . pix_get_option('pix_woo_metatitle') .'</title>'.PHP_EOL;
		} else {
			$out .= pix_get_option('pix_generalmetatitle' ) != '' ? '<title>' . pix_get_option('pix_generalmetatitle') .'</title>'.PHP_EOL : '';
		}
		
		if(is_home() && pix_get_option('pix_posts_page_metadescription' ) != '') {
			$out .= '<meta name="description" content="' . pix_get_option('pix_posts_page_metadescription') .'">'.PHP_EOL;
		} elseif(is_404() && pix_get_option('pix_404_metadescription' ) != '') {
			$out .= '<meta name="description" content="' . pix_get_option('pix_404_metadescription') .'">'.PHP_EOL;
		} elseif(is_search() && pix_get_option('pix_search_metadescription' ) != '') {
			$out .= '<meta name="description" content="' . pix_get_option('pix_search_metadescription') .'">'.PHP_EOL;
		} elseif ( is_category() && $pix_array_category['metadescription']!='' ) {
			$out .= '<meta name="description" content="' .  $pix_array_category['metadescription'] .'">'.PHP_EOL;
		} elseif(is_archive() && pix_get_option('pix_archive_metadescription' ) != '') {
			$out .= '<meta name="description" content="' . pix_get_option('pix_archive_metadescription') .'">'.PHP_EOL;
		} elseif ( is_tax('gallery') && $pix_array_gallery['metadescription']!='' ) {
			$out .= '<meta name="description" content="' .  $pix_array_gallery['metadescription'] .'">'.PHP_EOL;
		} elseif(is_attachment() && pix_get_option('pix_image_metadescription' ) != '') {
			$out .= '<meta name="description" content="' . pix_get_option('pix_image_metadescription') .'">'.PHP_EOL;
		} elseif ( get_post_meta($id, 'pix_pag_opts_metadescription', TRUE) != '' && !is_archive() ) {
			$out .= '<meta name="description" content="' . get_post_meta($id, 'pix_pag_opts_metadescription', TRUE) .'">'.PHP_EOL;
		} elseif ( pix_is_woocommerce() && pix_get_option('pix_woo_metadescription') != '' ) {
			$out .= '<meta name="description" content="' . pix_get_option('pix_woo_metadescription') .'">'.PHP_EOL;
		} else {
			$out .= pix_get_option('pix_generalmetadescription' ) != '' ? '<meta name="description" content="' . pix_get_option('pix_generalmetadescription') .'">'.PHP_EOL : '';
		}
		
		if(is_home() && pix_get_option('pix_posts_page_metakeys' ) != '') {
			$out .= '<meta name="keywords" content="' . pix_get_option('pix_posts_page_metakeys') .'">'.PHP_EOL;
		} elseif(is_404() && pix_get_option('pix_404_metakeys' ) != '') {
			$out .= '<meta name="keywords" content="' . pix_get_option('pix_404_metakeys') .'">'.PHP_EOL;
		} elseif(is_search() && pix_get_option('pix_search_metakeys' ) != '') {
			$out .= '<meta name="keywords" content="' . pix_get_option('pix_search_metakeys') .'">'.PHP_EOL;
		} elseif ( is_category() && $pix_array_category['metakeywords']!='' ) {
			$out .= '<meta name="keywords" content="' . $pix_array_category['metakeywords'] .'">'.PHP_EOL;
		} elseif(is_archive() && pix_get_option('pix_archive_metakeys' ) != '') {
			$out .= '<meta name="keywords" content="' . pix_get_option('pix_archive_metakeys') .'">'.PHP_EOL;
		} elseif ( is_tax('gallery') && $pix_array_gallery['metakeywords']!='' ) {
			$out .= '<meta name="keywords" content="' . $pix_array_gallery['metakeywords'] .'">'.PHP_EOL;
		} elseif(is_attachment() && pix_get_option('pix_image_metakeys' ) != '') {
			$out .= '<meta name="keywords" content="' . pix_get_option('pix_image_metakeys') .'">'.PHP_EOL;
		} elseif ( get_post_meta($id, 'pix_pag_opts_metakeys', TRUE) != '' && !is_archive() ) {
			$out .= '<meta name="keywords" content="' . get_post_meta($id, 'pix_pag_opts_metakeys', TRUE) .'">'.PHP_EOL;
		} elseif ( pix_is_woocommerce() && pix_get_option('pix_woo_metakeys') != '' ) {
			$out .= '<meta name="keywords" content="' . pix_get_option('pix_woo_metakeys') .'">'.PHP_EOL;
		} else {
			$out .= pix_get_option('pix_generalmetakeys' ) != '' ? '<meta name="keywords" content="' . pix_get_option('pix_generalmetakeys') .'">'.PHP_EOL : '';
		}
		
		echo $out;
    } else { ?>
    	<title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php }
}

/*=========================================================================================*/

function pix_selected_sidebar($page_sidebar) {

	global $post, $woocommerce;

	$body_class = get_body_class();
	$body_class = implode($body_class,' ');
	$catID = get_query_var('cat');
	$pix_array_category = pix_get_option('pix_array_category_'.$catID);
	$post_type = get_post_type();
	if (is_tax('gallery')) {
		$term = get_term_by( 'slug',  get_query_var( 'term' ), 'gallery' );
		$termID = $term->term_id;
		$pix_array_gallery = pix_get_option('pix_array_gallery_'.$termID);
	}
	if(pix_is_shop()) {
		$id_shop = woocommerce_get_page_id('shop');
	}
	
	if ( $page_sidebar=='' ) {	
		if (is_404()) {
			return pix_get_option('pix_404_sidebar');
		} elseif (is_search()) {
			return pix_get_option('pix_search_sidebar');
		} elseif( !pix_is_shop() && !is_single() && strpos($body_class,'woocommerce') ) {
			return pix_get_option('pix_woo_sidebar');
		} elseif (is_category() && $pix_array_category['sidebar']!='' && isset($pix_array_category['sidebar'])) {
			return $pix_array_category['sidebar'];
		} elseif ( is_tax('gallery') && $pix_array_gallery['sidebar'] != '' && isset($pix_array_gallery['sidebar'])) {
			return $pix_array_gallery['sidebar'];
		} elseif (!pix_is_shop() && is_archive()) {
			return pix_get_option('pix_archive_sidebar');
		} elseif ( is_attachment() ) {
			return pix_get_option('pix_image_sidebar');
		} elseif ( pix_is_shop() ) {
			if ( get_post_meta($id_shop, 'pix_sidebar_select', TRUE) == '' ) {
				return pix_get_option('pix_woo_sidebar');
			} else {
				return get_post_meta($id_shop, 'pix_sidebar_select', TRUE);
			}
		} elseif ( get_post_meta($post->ID, 'pix_sidebar_select', TRUE) != '' ) {
			return get_post_meta($post->ID, 'pix_sidebar_select', TRUE);
		} elseif( $post_type == 'post' ) {
			return pix_get_option('pix_posts_sidebar');
		} elseif( $post_type == 'page' ) {
			return pix_get_option('pix_pages_sidebar');
		} elseif( $post_type == 'portfolio' ) {
			return pix_get_option('pix_portfolio_sidebar');
		} elseif( $post_type == 'product' ) {
			return pix_get_option('pix_woo_sidebar');
		}
	} else {
		return $page_sidebar;
	}
}

/*=========================================================================================*/

function pix_wide_bg() {
	global $post;
	
	if ( pix_is_shop() ) {
		$id = woocommerce_get_page_id('shop');
	} elseif ( is_home() ) {
		$id = get_option('page_for_posts');
	} else {
		$id = get_the_ID();
	}

	$out = '';
		
	if ( get_post_meta($id, 'pix_meta_bg', TRUE) == 'on' ) {
		$out .= 'background-attachment:'.get_post_meta($id, 'pix_meta_attachment', TRUE).';';
		$out .= 'background-color:'.get_post_meta($id, 'pix_bg_title', TRUE).';';
		$out .= 'background-image:url('.pix_remove_protocol(get_post_meta($id, 'pix_meta_widebg', TRUE)).');';
		$out .= 'background-position:'.get_post_meta($id, 'pix_meta_alignment', TRUE).';';
			$bgrepeat = get_post_meta($id, 'pix_meta_repeat', TRUE) == 'off' ? 'no-repeat' : 'repeat';
		$out .= 'background-repeat:'.$bgrepeat.';';
		$out .= 'background-size:'.get_post_meta($id, 'pix_meta_portrait', TRUE).';';
		$out .= 'color:'.get_post_meta($id, 'pix_color_title', TRUE).';';

		$bgrepeat = get_post_meta($id, 'pix_meta_repeat', TRUE) == 'off' ? 'no-repeat' : 'repeat';

		$style = 'style="'.$out.'"';

		return $style;
	}
}

/*=========================================================================================*/

function pix_title_lines_bg() {
	global $post;
	
	if ( pix_is_shop() ) {
		$id = woocommerce_get_page_id('shop');
	} elseif ( is_home() ) {
		$id = get_option('page_for_posts');
	} else {
		$id = get_the_ID();
	}

	$out = '';
		
	if ( get_post_meta($id, 'pix_meta_bg', TRUE) == 'on' ) {
		$out .= 'background-color:rgba('.hex2RGB ( get_post_meta($id, 'pix_bg_title_lines', TRUE), true ) .','. get_post_meta($id, 'pix_opacity_title_lines', TRUE) .');';

		$style = 'style="'.$out.'"';

		return $style;
	}
}

/*=========================================================================================*/

function pix_change_alignment_str($str) {
	$str = pix_get_option($str);
	$str = preg_replace('/[A-Z]/', ' '.strtolower('$0'), $str);
	return $str;
}


/*=========================================================================================*/

add_action( 'login_enqueue_scripts', 'pix_login_enqueue_scripts' );
function pix_login_enqueue_scripts(){
	echo '<style type="text/css" media="screen">';
	echo '#login h1 a{background: url('.pix_get_option('pix_login_logo').') top center no-repeat!important; background-size: 326px 110px!important; width:326px!important; height:110px!important; background-position:center!important;';
	echo '</style>';
}

/*=========================================================================================*/

function pix_color_darken($color, $dif=30){
 
	if($color=='' || $color=='transparent') {
		return 'transparent';        
	} else {
		$hex = str_replace('#', '', $color);
		$new_hex = '';
		
		$base['R'] = hexdec($hex{0}.$hex{1});
		$base['G'] = hexdec($hex{2}.$hex{3});
		$base['B'] = hexdec($hex{4}.$hex{5});
		
		foreach ($base as $k => $v)
				{
				$amount = $v / 100;
				$amount = round($amount * $dif);
				$new_decimal = $v - $amount;
		
				$new_hex_component = dechex($new_decimal);
				if(strlen($new_hex_component) < 2)
						{ $new_hex_component = "0".$new_hex_component; }
				$new_hex .= $new_hex_component;
				}
				if (strlen($new_hex) > 6){ $new_hex = '000000'; }
				
		return '#'.$new_hex;    
	}
}

/*=========================================================================================*/

function pix_color_lighten($color, $dif=30){
 
	if($color=='' || $color=='transparent') {
		return 'transparent';        
	} else {
		$hex = str_replace('#', '', $color);
		$new_hex = '';
		
		$base['R'] = hexdec($hex{0}.$hex{1});
		$base['G'] = hexdec($hex{2}.$hex{3});
		$base['B'] = hexdec($hex{4}.$hex{5});
		
		foreach ($base as $k => $v)
				{
				$amount = 255 - $v;
				$amount = $amount / 100;
				$amount = round($amount * $dif);
				$new_decimal = $v + $amount;
		
				$new_hex_component = dechex($new_decimal);
				if(strlen($new_hex_component) < 2)
						{ $new_hex_component = "0".$new_hex_component; }
				$new_hex .= $new_hex_component;
				}
				if (strlen($new_hex) > 6){ $new_hex = 'ffffff'; }
				
		return '#'.$new_hex;  
	}
}

/*=========================================================================================*/

function pix_font_variant_hack($value) {
	if (strlen(strstr($value,'regular'))>0) {
		$value = str_replace('regular','400',$value);	
	} elseif (strlen(strstr($value,'bold'))>0) {
		$value = str_replace('bold','700',$value);	
	} elseif ( $value == 'italic' ) {
		$value = '400italic';	
	}
	return $value;
}

/*=========================================================================================*/

function pix_sampleCaption_style(){
	if(isset($_GET['page']) && $_GET['page']=='admin_interface'){
		echo '<style>#pix_slideshow_composer_inner .sampleCaption {
			background-color: '.pix_get_option('pix_slideshow_caption_bg').';
			background-color: rgba('.hex2RGB ( pix_get_option('pix_slideshow_caption_bg'), true ) .','. pix_get_option('pix_slideshow_caption_bg_opacity') .');
			color: '. pix_get_option('pix_slideshow_caption_color') .';
			font-size: '. pix_get_option('pix_slideshow_caption_fontsize') .'px;
			font-style: normal;
			line-height: 1.6em;
			max-width: 100%;
			padding: 0 10px;
		}</style>';
	}
}

add_action('admin_head', 'pix_sampleCaption_style');

/*=========================================================================================*/

function pix_include_css() {
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	global $wp_filesystem;

	if ( ! WP_Filesystem($wp_filesystem) ) {
		request_filesystem_credentials($url, '', true, false, null);
		return;
	}		

	$upload_dir = wp_upload_dir();
	$css_file = $upload_dir['basedir'].'/css_include.css';

	$target_dir = $wp_filesystem->find_folder(get_template_directory_uri() . '/functions/includes');
	$target_file = trailingslashit($target_dir).'css_include.php';

	$css = wp_remote_post( $target_file );

	if (!is_wp_error($css) && ($css['response']['code'] == 200)) {
		$css = $css['body'];
		$wp_filesystem->put_contents( $css_file, $css, FS_CHMOD_FILE );
	}

}
/***/
add_action('wp_ajax_pix_wpdb', 'pix_include_css_ajax');
function pix_include_css_ajax() {
	WP_Filesystem();
	global $wp_filesystem;

	/*if ( ! WP_Filesystem($wp_filesystem) ) {
		request_filesystem_credentials($url, '', true, false, null);
		return;
	}	*/	

	$upload_dir = wp_upload_dir();
	$css_file = $upload_dir['basedir'].'/css_include.css';

	$target_dir = $wp_filesystem->find_folder(get_template_directory_uri() . '/functions/includes/');
	$target_file = trailingslashit($target_dir).'css_include.php';

	$css = wp_remote_post( $target_file );

	if (!is_wp_error($css) && ($css['response']['code'] == 200)) {
		$css = $css['body'];
		$wp_filesystem->put_contents( $css_file, $css, FS_CHMOD_FILE );
	}

    die();
}
/***/
function pix_pixinline_css() {
	echo '<style>';
	if ( pix_get_option('pix_css_inline') == 'true' ) {
		require(get_template_directory() . '/functions/includes/css_inline.php'); 
	}
	echo '</style>';
}
add_action ( 'wp_head', 'pix_pixinline_css', 99 );
/***/
function pix_enqueue_cssinclude() {
	global $current_user, $blog_id;
	
	$upload_dir = wp_upload_dir();

	$css_dir = $upload_dir['basedir'].'/';
	$css_dir2 = pix_remove_protocol($upload_dir['baseurl'].'/');
	/*if ( !isset($blog_id) || $blog_id == 1 ) {
		//$css_dir = get_template_directory() . '/functions/includes/';
		$css_dir = $upload_dir['basedir'].'/';
		$css_dir2 = $upload_dir['baseurl'].'/';
	} else {
		$css_dir = ABSPATH.'/wp-content/blogs.dir/' . $blog_id . '/files/';
		$css_dir2 = content_url().'/blogs.dir/' . $blog_id . '/files/';
	}*/
	if( pix_get_option('pix_css_inline') != 'true' ) {
		wp_register_style('css-include', $css_dir2.'css_include.css', 'style');
		wp_enqueue_style( 'css-include');
	}
}
add_action('wp_enqueue_scripts', 'pix_enqueue_cssinclude',11);
/***/
function pix_delete_session_files() {
	$css_dir = get_template_directory_uri() . '/functions/includes/sessions/';
	$count = count(glob($css_dir . "*"));
	$sid = session_id();
	
	if($count > 200){
		$files = glob($css_dir . "*");
		foreach($files as $file){
			if(is_file($file) && !strpos($file, $sid)){
				unlink($file);
			}
		}
	}
}

/*=========================================================================================*/

function pix_curPageURL() {
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

/*=========================================================================================*/

add_action('wp_ajax_pix_sanitize', 'pix_sanitize_ajax');
function pix_sanitize_ajax() {
	$title = sanitize_title($_POST['title']);
	echo $title;
	die();
}

/*=========================================================================================*/

function pix_space_brackets($pattern) 
{
	$str = str_replace('][', '] [', $pattern);

    return $str;
}
 
/*=========================================================================================*/

add_action( 'show_user_profile', 'pix_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'pix_extra_user_profile_fields' );
 
function pix_extra_user_profile_fields( $user ) { ?>
    <h3>Forte extra fields</h3>
 
    <table class="form-table">
        <tr>
            <th><label for="forte_role"><?php _e('Label role','forte'); ?></label></th>
            <td>
                <input type="text" name="forte_role" id="forte_role" value="<?php echo esc_attr( get_the_author_meta( 'forte_role', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Type here something if you want to display the role of the user in the comments</span>
            </td>
        </tr>
    </table>
<?php }
 
add_action( 'personal_options_update', 'pix_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'pix_save_extra_user_profile_fields' );
 
function pix_save_extra_user_profile_fields( $user_id ) {
	if ( current_user_can( 'edit_user', $user_id ) ) {
		update_user_meta( $user_id, 'forte_role', $_POST['forte_role'] );
	}
}
 
/*=========================================================================================*/

function pix_label_meta(){
	
	global $post, $product;
	
	$pix_pag_opts_flag_color = get_post_meta($post->ID, 'pix_pag_opts_flag_color', true);
	$pix_pag_opts_flag_bg = get_post_meta($post->ID, 'pix_pag_opts_flag_bg', true);
	$pix_pag_opts_flag = get_post_meta($post->ID, 'pix_pag_opts_flag', true);
	if(isset($pix_pag_opts_flag_color) && $pix_pag_opts_flag_color != '' && $pix_pag_opts_flag != ''){
		$label_meta = '<span class="pix_label_tag" style="background:'.$pix_pag_opts_flag_bg.';color:'.$pix_pag_opts_flag_color .'">'.$pix_pag_opts_flag.'<span class="label_flag_top" style="border-top-color: '. $pix_pag_opts_flag_bg .'"></span><span class="label_flag_bottom" style="border-bottom-color: '. $pix_pag_opts_flag_bg .'"></span><span class="label_shadow" style="border-top-color: '. pix_color_darken($pix_pag_opts_flag_bg) .';"></span></span>';
	} elseif (isset($product) && $product->is_on_sale()) {
		$label_meta = '<span class="pix_label_tag label_red">'.__('Sale!', 'forte').'<span class="label_flag_top"></span><span class="label_flag_bottom"></span><span class="label_shadow"></span></span>';
	} else {
		$label_meta = '';
	}
	
	return $label_meta;
}
 
/*=========================================================================================*/

add_action('init', 'register_pix_liquislider');
function register_pix_liquislider() {
	wp_register_script("jquery-cycle", get_template_directory_uri()."/scripts/jquery.cycle2.min.js", array('jquery'));
}

add_filter('the_posts', 'pix_enq_liquislider');
function pix_enq_liquislider($posts){
	if ( empty($posts) ) return $posts;

	$shortcode_found = false;
	foreach ( $posts as $post ){
		if ( stripos($post->post_content, 'pix_testimonial') || stripos($post->post_content, 'pix_tweet') ){
			$shortcode_found = true;
			break;
		}
	}

	if ( $shortcode_found ){
		wp_enqueue_script("jquery-cycle");
	}

	return $posts;
}

/*=========================================================================================*/

add_filter('the_content', 'pix_switch_audio');
function pix_switch_audio($content){
	global $wp_version, $mediaelement_en;
	if ( version_compare($wp_version, '3.5.9', '>=') || $mediaelement_en == 'active' ) {
		$content = preg_replace('|\[pix_audio data_src=[\'"](.*?)[\'"](.*?)\]|', '[audio src=\'$1\']', $content);
		$content = preg_replace('|\[pix_audio(.*?)data_src=[\'"](.*?)[\'"](.*?)\]|', '[audio src=\'$2\']', $content);
	}
	return $content;
}

/*=========================================================================================*/

add_filter('the_content', 'pix_switch_video');
function pix_switch_video($content){
	global $wp_version, $mediaelement_en;
	if ( version_compare($wp_version, '3.5.9', '>=') || $mediaelement_en == 'active' ) {
		$content = preg_replace('|\[pix_video(.*?)data_height=\'(.*?)\'(.*?)\]|', '[pix_video$1height=\'$2\'$3]', $content);
		$content = preg_replace('|\[pix_video(.*?)data_height="(.*?)"(.*?)\]|', '[pix_video$1height=\'$2\'$3]', $content);
		$content = preg_replace('|\[pix_video(.*?)data_width=\'(.*?)\'(.*?)\]|', '[pix_video$1width=\'$2\'$3]', $content);
		$content = preg_replace('|\[pix_video(.*?)data_width="(.*?)"(.*?)\]|', '[pix_video$1width=\'$2\'$3]', $content);
		$content = preg_replace('|\[pix_video(.*?)data_ogv=\'(.*?)\'(.*?)\]|', '[pix_video$1ogg=\'$2\'$3]', $content);
		$content = preg_replace('|\[pix_video(.*?)data_ogv="(.*?)"(.*?)\]|', '[pix_video$1ogg=\'$2\'$3]', $content);
		$content = preg_replace('|\[pix_video(.*?)data_poster=\'(.*?)\'(.*?)\]|', '[pix_video$1poster=\'$2\'$3]', $content);
		$content = preg_replace('|\[pix_video(.*?)data_poster="(.*?)"(.*?)\]|', '[pix_video$1poster=\'$2\'$3]', $content);
		$content = preg_replace('|\[pix_video(.*?)data_mp4="(.*?)"(.*?)\]|', '<div class="video-embedded">[video$1mp4=\'$2\'$3][/video]</div>', $content);
		$content = preg_replace('|\[pix_video(.*?)data_mp4=\'(.*?)\'(.*?)\]|', '<div class="video-embedded">[video$1mp4=\'$2\'$3][/video]</div>', $content);
	}
	return $content;
}

/*=========================================================================================*/

add_filter('the_posts', 'pix_enq_datePicker');
function pix_enq_datePicker($posts){
	global $print_datepicker;
	if ( empty($posts) ) return $posts;

	foreach ( $posts as $post ){
		if ( stripos($post->post_content, 'pix_period') ){
			$print_datepicker = true;
			break;
		}
	}

	return $posts;
}

/*=========================================================================================*/

add_action('init', 'register_pix_datepciker');
add_action('wp_footer', 'print_pix_datepicker');

function register_pix_datepciker() {
	wp_register_script("jquery-ui-datepicker", get_template_directory_uri()."/scripts/jquery.ui.datepicker.js", array('jquery-ui-widget'));
	if (defined('WPLANG')) {
		$file = get_template_directory().'/scripts/datePicker/jquery.ui.datepicker-'.WPLANG.'.php';
		$file2 = get_template_directory_uri().'/scripts/datePicker/jquery.ui.datepicker-'.WPLANG.'.php';
		if (file_exists($file)) {
			wp_register_script("jquery-ui-datepicker-locale", get_template_directory_uri().'/scripts/datePicker/jquery.ui.datepicker-'.WPLANG.'.php', array('jquery-ui-datepicker'));
		}
	}
}

function print_pix_datepicker() {
    global $print_datepicker;
    if (!$print_datepicker) return;
		wp_print_scripts("jquery-ui-core");
		wp_print_scripts("jquery-ui-widget");
		wp_print_scripts("jquery-ui-datepicker");
	if (defined('WPLANG')) {
		$file = get_template_directory().'/scripts/datePicker/jquery.ui.datepicker-'.WPLANG.'.php';
		if (file_exists($file)) {
			wp_print_scripts("jquery-ui-datepicker-locale");
		}
	}
}
/*=========================================================================================*/

add_action('wp_footer', 'pix_datepicker_lang');

function pix_datepicker_lang() {
	if (defined('WPLANG')) {
		$lang = substr(WPLANG, 0, 2);
		$file = get_template_directory().'/scripts/datePicker/jquery.ui.datepicker-'.$lang.'.php';
		if (file_exists($file)) {
		    echo '<script>jQuery(function() {
		        if(jQuery.isFunction(jQuery.fn.datepicker)){      
		            jQuery.datepicker.setDefaults( $.datepicker.regional[ "'.$lang.'" ] );
		        }	
		    });</script>';
		}
	}
}

/*=========================================================================================*/

// remove the original wpautop function
remove_filter('the_excerpt', 'wpautop');
remove_filter('the_content', 'wpautop');

// add our new html5autop function
add_filter('the_excerpt', 'html5autop');
add_filter('the_content', 'html5autop');

function html5autop($content, $br = 1) {
   if ( trim($content) === '' )
      return '';
   $content = $content . "\n"; // just to make things a little easier, pad the end
   $content = preg_replace('|<br />\s*<br />|', "\n\n", $content);
   // Space things out a little
// *insertion* of section|article|aside|header|footer|hgroup|figure|details|figcaption|summary
   $allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|map|area|blockquote|address|math|style|input|p|h[1-6]|hr|fieldset|legend|section|article|aside|header|footer|hgroup|figure|details|figcaption|summary)';
   $content = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $content);
   $content = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $content);
   $content = str_replace(array("\r\n", "\r"), "\n", $content); // cross-platform newlines
   if ( strpos($content, '<object') !== false ) {
      $content = preg_replace('|\s*<param([^>]*)>\s*|', "<param$1>", $content); // no pee inside object/embed
      $content = preg_replace('|\s*</embed>\s*|', '</embed>', $content);
   }
   $content = preg_replace("/\n\n+/", "\n\n", $content); // take care of duplicates
   // make paragraphs, including one at the end
   $contents = preg_split('/\n\s*\n/', $content, -1, PREG_SPLIT_NO_EMPTY);
   $content = '';
   $autop = true;
   foreach ( $contents as $tinkle ) {
   		if ( strpos($content, '<script') !== false ) {
			$autop = false;
		}
   		if ( strpos($content, '</script>') !== false ) {
			$autop = true;
		}
		if ( $autop == true ) {
		  $content .= '<p>' . trim($tinkle, "\n") . "</p>\n";
		} else {
		  $content .= trim($tinkle, "\n") . "\n";
		}
	  
   }
	  
   $content = preg_replace('|\/>|', '>', $content); // under certain strange conditions it could create a P of entirely whitespace
   $content = preg_replace('|<p>\s*</p>|', '', $content); // under certain strange conditions it could create a P of entirely whitespace
// *insertion* of section|article|aside
   $content = preg_replace('!<p>([^<]+)</(div|address|form|section|article|aside)>!', "<p>$1</p></$2>", $content);
   $content = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $content); // don't pee all over a tag
   $content = preg_replace("|<p>(<li.+?)</p>|", "$1", $content); // problem with nested lists
   $content = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $content);
   $content = str_replace('</blockquote></p>', '</p></blockquote>', $content);
   $content = preg_replace('|<p><script([^>]*)>|i', "<script$1>", $content);
   $content = preg_replace('|<script([^>]*)></p>|i', "<script$1>", $content);
   $content = str_replace('</script></p>', '</script>', $content);
   $content = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $content);
   $content = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $content);
   $content = preg_replace('|<iframe(.*?)width=[\'"](.*?)%[\'"](.*?)></iframe>|', '<iframe$1 data-size="percent" width="$2"$3></iframe>', $content);
   $content = preg_replace('|<iframe(.*?)height=[\'"](.*?)%[\'"](.*?)></iframe>|', '<iframe$1 height="$2"$3></iframe>', $content);
   $content = preg_replace('|<iframe(.*?)frameborder=[\'"](.*?)[\'"](.*?)></iframe>|', '<iframe$1$3></iframe>', $content);
   if ($br) {
      $content = preg_replace_callback('/<(script|style).*?<\/\\1>/s', create_function('$matches', 'return str_replace("\n", "<WPPreserveNewline />", $matches[0]);'), $content);
      $content = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $content); // optionally make line breaks
      $content = str_replace('<WPPreserveNewline />', "\n", $content);
   }
   $content = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $content);
// *insertion* of img|figcaption|summary
   $content = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol|img|figcaption|summary)[^>]*>)!', '$1', $content);
   if (strpos($content, '<pre') !== false)
      $content = preg_replace_callback('!(<pre[^>]*>)(.*?)</pre>!is', 'clean_pre', $content );
   $content = preg_replace( "|\n</p>$|", '</p>', $content );
   $content = preg_replace( "|\]\[|", '] [', $content );
   $content = preg_replace( "!<p>\s*\[pix_slideshow(.*?)\]\s*</p>!", '[pix_slideshow$1]', $content );

   return $content;
}


add_filter('the_content', 'pix_shortcode', 20);
function pix_shortcode($content) {

   $allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|map|area|blockquote|address|math|style|input|p|h[1-6]|hr|fieldset|legend|section|article|aside|header|footer|hgroup|figure|details|figcaption|summary|span)';

	$content = preg_replace( "| />|", '>', $content );
	$content = preg_replace( "|/>|", '>', $content );
	$content = preg_replace( "|<p><div|", '<div', $content );
	$content = preg_replace( "|<p><hr|", '<hr', $content );
	$content = preg_replace( "|div></p>|", 'div>', $content );
	$content = preg_replace( "|--></p>|", '-->', $content );
	$content = preg_replace( "|/li><br>|", '/li>', $content );
	$content = preg_replace( "|ul><br>|", 'ul>', $content );
	$content = preg_replace( "|</div><br>|", '</div>', $content );
	$content = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $content);
	$content = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $content);
	$content = preg_replace( "|--><br>|", '-->', $content );
	
	return $content;	
}


/*=========================================================================================*/

function pix_array_combine($arr1, $arr2) {
    $count = min(count($arr1), count($arr2));
    return array_combine(array_slice($arr1, 0, $count), array_slice($arr2, 0, $count));
}

/*=========================================================================================*/

function pix_tag_cloud_filter($args = array()) {
   $args['smallest'] = 0.85;
   $args['largest'] = 1.7;
   $args['unit'] = 'em';
   return $args;
}

add_filter('widget_tag_cloud_args', 'pix_tag_cloud_filter', 90);

/*=========================================================================================*/

remove_filter('term_description','wpautop');

/*=========================================================================================*/

function pix_remove_more_link($more_link_text) { 

	$more_link_text = preg_replace('#(?:<a.*?>)?(?:</a>)?#i','',$more_link_text);
	
	return $more_link_text;
}
add_filter('the_content_more_link', 'pix_remove_more_link');

/*=========================================================================================*/

function pix_addBodyClassMobile() {
	if (pix_detectMobile()) {
		return ' is_mobile';
	} else {
		return ' is_not_mobile';
	}
}

			
/*=========================================================================================*/

function pix_display_by_role($capab) {
	global $current_user;
	get_currentuserinfo();

	if ( (!function_exists('is_multisite') || !is_multisite()) &&  pix_get_option($capab) == 'manage_network') {
		$role = 'activate_plugins';
	} else {
		$role = pix_get_option($capab);
	}

 	if ( current_user_can ( $role ) ) {
		echo ' style="display:block"';
	} else {
		echo ' style="display:none"';
	}
}
			
/*=========================================================================================*/

function pix_select_role($role) {
	
	global $current_user;
	get_currentuserinfo();

	if ( (!function_exists('is_multisite') || !is_multisite()) && $role=='manage_network') {
		return 'activate_plugins';
	} else {
		return $role;
	}
}
		
/*=========================================================================================*/

function pix_before_signup_form() { ?>
	<section class="pix_content_990">
    	<div class="pix_content_960">
            <div class="content_title pix_content_930">
				<?php if ( get_post_meta( get_the_id(), 'pix_pag_opts_hidetitle', true ) != 'on' ) { ?>
                    <h1><?php the_title(); ?></h1>
					<?php $pix_pag_opts_subtitle = get_post_meta( get_the_id(), 'pix_pag_opts_subtitle', true );
                        if ( $pix_pag_opts_subtitle != '' ) { ?>
                            <p class="h1_subtitle"><?php echo $pix_pag_opts_subtitle; ?></p>
                    <?php } ?>
                    <div class="clear"></div>
                    <hr>
                    <?php pix_breadcrumbs(); ?>
                    
				<?php } ?>

				<?php
					do_shortcode(get_the_content()); 
					
					global $pix_filter_section, $pix_loop_in_page, $posts_per_page; 
					
					echo $pix_filter_section; 					

                ?>
                
                
            </div><!-- .pix_content.pix_content_930 -->
    
            <div class="main_content">

                <article class="pix_content_930">

<?php }
add_action('before_signup_form','pix_before_signup_form');


function pix_after_signup_form() { ?>
                </article><!-- .pix_content_930 -->
    
    
            </div><!-- .main_content -->
            
        </div>

    </section>


<?php }
add_action('after_signup_form','pix_after_signup_form');
	
/*=========================================================================================*/

function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}

function pix_cache_tweets($user, $count) {
	global $current_user, $blog_id;
	
	$upload_dir = wp_upload_dir();
	
	$up_dir = $upload_dir['basedir'].'/';
	/*if ( !isset($blog_id) || $blog_id == 1 ) {
		$up_dir = $upload_dir['basedir'].'/';
	} else {
		$up_dir = ABSPATH.'/wp-content/blogs.dir/' . $blog_id . '/files/';
	}*/
	$cPath = $up_dir . 'file.cache.'.$user.'.'.$count;
	$cache = FALSE; //Assume the cache is empty
	if(file_exists($cPath)) {
		
		$test_content = file_get_contents($cPath);
		
		if ( file_get_contents($cPath) != '' ) {

			$modtime = filemtime($cPath);
			$timeago = time() - 300; //30 minutes ago in Unix timestamp format (no. seconds since 1st Jan 1970) 
			if($modtime < $timeago) {
				$cache = FALSE; //Set to false just in case as the cache needs to be renewed
			} else {
				$cache = TRUE; //The cache is not too old so the cache can be used.
			}
			
		}
	}
	
	if($cache == FALSE) {
		if(	pix_get_option('pix_consumer_key') != ''
				&&
			pix_get_option('pix_consumer_secret') != ''
				&&
			pix_get_option('pix_access_token') != ''
				&&
			pix_get_option('pix_access_token_secret') != ''
		) {
			require_once('twitteroauth/twitteroauth.php');
			$consumerkey = pix_get_option('pix_consumer_key');
			$consumersecret = pix_get_option('pix_consumer_secret');
			$accesstoken = pix_get_option('pix_access_token');
			$accesstokensecret = pix_get_option('pix_access_token_secret');

			$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
			$content = json_encode($connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$user."&count=".$count));
		} else {
			$content = pix_get_content('http://api.twitter.com/1/statuses/user_timeline/'.$user.'.json?count='.$count.'&include_rts=false');
		}
					
		//Let's save our data into the cache
		//file_put_contents($cPath, utf8_encode($content), LOCK_EX);
		file_put_contents($cPath, $content, LOCK_EX);
	
	} else {
		//cache is TRUE let's load the data from the cache.
		$content = file_get_contents($cPath);
	}
	
	return $content;
}
	
/*=========================================================================================*/

if ( !function_exists( 'br2nl' ) ) { 
	function br2nl($string)
	{
		return preg_replace('/\&lt;br(\s*)?\/?\&gt;/i', "\n", $string);
	}
}
	
/*=========================================================================================*/

add_action( 'wp_head', 'pix_like_thumbnails' );

function pix_like_thumbnails()
{
	global $posts;
	
	if( pix_is_facebook() ){ 		
		if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( $posts[0]->ID ) ) {
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $posts[0]->ID), 'large' );
			$thumb = $thumb[0]; // take the URL from the array
			$thumb_set = true;
		} else {
			$thumb = '';
		}

		$excerpt = preg_replace('|<p(.*?)>(.*?)</p>|', "$2\n", pix_get_the_excerpt());

		echo '<meta property="og:title" content="'.get_the_title().'">
	    <meta property="og:type" content="website">
	    <meta property="og:url" content="'.pix_current_page().'">
	    <meta property="og:image" content="'.$thumb.'">
	    <meta property="og:site_name" content="'.get_bloginfo('name').'">
	    <meta name="description" name="og:description" 
	          content="'.esc_attr($excerpt).'">';
	}	
}

/*=========================================================================================*/

function pix_is_shop() {
	if ( function_exists('is_shop') ) {
		if (is_shop()) {
			return true;
		}
	} else {
		return false;
	}
}

function pix_is_woocommerce() {
	global $woo_shortcode;
	if ( function_exists('is_woocommerce') ) {
		if (is_woocommerce() || $woo_shortcode) {
			return true;
		}
	} else {
		return false;
	}
}
function pix_is_cart() {
	if ( function_exists('is_cart') ) {
		if (is_cart()) {
			return true;
		}
	} else {
		return false;
	}
}
function pix_is_account_page() {
	if ( function_exists('is_account_page') ) {
		if (is_account_page()) {
			return true;
		}
	} else {
		return false;
	}
}
function pix_is_checkout() {
	if ( function_exists('is_checkout') ) {
		if (is_checkout()) {
			return true;
		}
	} else {
		return false;
	}
}

function pix_is_product_category() {
	if ( function_exists('is_product_category') ) {
		if (is_product_category()) {
			return true;
		}
	} else {
		return false;
	}
}

function pix_is_filtered() {
	if ( function_exists('is_filtered') ) {
		if (is_filtered()) {
			return true;
		}
	} else {
		return false;
	}
}

/*=========================================================================================*/

function pix_admin_footer(){

	if ( 'nav-menus.php' == basename($_SERVER['SCRIPT_NAME']) || ('admin.php' == basename($_SERVER['SCRIPT_NAME']) && isset($_GET['page']) && $_GET['page']=='admin_interface') ) {
		
		$icons = array (
			'icon-glass',
			'icon-music',
			'icon-search',
			'icon-envelope',
			'icon-heart',
			'icon-star',
			'icon-star-o',
			'icon-user',
			'icon-film',
			'icon-th-large',
			'icon-th',
			'icon-th-list',
			'icon-check',
			'icon-times',
			'icon-search-plus',
			'icon-search-minus',
			'icon-power-off',
			'icon-signal',
			'icon-cog',
			'icon-trash-o',
			'icon-home',
			'icon-file-o',
			'icon-clock-o',
			'icon-road',
			'icon-download',
			'icon-arrow-circle-o-down',
			'icon-arrow-circle-o-up',
			'icon-inbox',
			'icon-play-circle-o',
			'icon-repeat',
			'icon-refresh',
			'icon-list-alt',
			'icon-lock',
			'icon-flag',
			'icon-headphones',
			'icon-volume-off',
			'icon-volume-down',
			'icon-volume-up',
			'icon-qrcode',
			'icon-barcode',
			'icon-tag',
			'icon-tags',
			'icon-book',
			'icon-bookmark',
			'icon-print',
			'icon-camera',
			'icon-font',
			'icon-bold',
			'icon-italic',
			'icon-text-height',
			'icon-text-width',
			'icon-align-left',
			'icon-align-center',
			'icon-align-right',
			'icon-align-justify',
			'icon-list',
			'icon-outdent',
			'icon-indent',
			'icon-video-camera',
			'icon-picture-o',
			'icon-pencil',
			'icon-map-marker',
			'icon-adjust',
			'icon-tint',
			'icon-pencil-square-o',
			'icon-share-square-o',
			'icon-check-square-o',
			'icon-arrows',
			'icon-step-backward',
			'icon-fast-backward',
			'icon-backward',
			'icon-play',
			'icon-pause',
			'icon-stop',
			'icon-forward',
			'icon-fast-forward',
			'icon-step-forward',
			'icon-eject',
			'icon-chevron-left',
			'icon-chevron-right',
			'icon-plus-circle',
			'icon-minus-circle',
			'icon-times-circle',
			'icon-check-circle',
			'icon-question-circle',
			'icon-info-circle',
			'icon-crosshairs',
			'icon-times-circle-o',
			'icon-check-circle-o',
			'icon-ban',
			'icon-arrow-left',
			'icon-arrow-right',
			'icon-arrow-up',
			'icon-arrow-down',
			'icon-share',
			'icon-expand',
			'icon-compress',
			'icon-plus',
			'icon-minus',
			'icon-asterisk',
			'icon-exclamation-circle',
			'icon-gift',
			'icon-leaf',
			'icon-fire',
			'icon-eye',
			'icon-eye-slash',
			'icon-exclamation-triangle',
			'icon-plane',
			'icon-calendar',
			'icon-random',
			'icon-comment',
			'icon-magnet',
			'icon-chevron-up',
			'icon-chevron-down',
			'icon-retweet',
			'icon-shopping-cart',
			'icon-folder',
			'icon-folder-open',
			'icon-arrows-v',
			'icon-arrows-h',
			'icon-bar-chart',
			'icon-twitter-square',
			'icon-facebook-square',
			'icon-camera-retro',
			'icon-key',
			'icon-cogs',
			'icon-comments',
			'icon-thumbs-o-up',
			'icon-thumbs-o-down',
			'icon-star-half',
			'icon-heart-o',
			'icon-sign-out',
			'icon-linkedin-square',
			'icon-thumb-tack',
			'icon-external-link',
			'icon-sign-in',
			'icon-trophy',
			'icon-github-square',
			'icon-upload',
			'icon-lemon-o',
			'icon-phone',
			'icon-square-o',
			'icon-bookmark-o',
			'icon-phone-square',
			'icon-twitter',
			'icon-facebook',
			'icon-github',
			'icon-unlock',
			'icon-credit-card',
			'icon-rss',
			'icon-hdd-o',
			'icon-bullhorn',
			'icon-bell',
			'icon-certificate',
			'icon-hand-o-right',
			'icon-hand-o-left',
			'icon-hand-o-up',
			'icon-hand-o-down',
			'icon-arrow-circle-left',
			'icon-arrow-circle-right',
			'icon-arrow-circle-up',
			'icon-arrow-circle-down',
			'icon-globe',
			'icon-wrench',
			'icon-tasks',
			'icon-filter',
			'icon-briefcase',
			'icon-arrows-alt',
			'icon-users',
			'icon-link',
			'icon-cloud',
			'icon-flask',
			'icon-scissors',
			'icon-files-o',
			'icon-paperclip',
			'icon-floppy-o',
			'icon-square',
			'icon-bars',
			'icon-list-ul',
			'icon-list-ol',
			'icon-strikethrough',
			'icon-underline',
			'icon-table',
			'icon-magic',
			'icon-truck',
			'icon-pinterest',
			'icon-pinterest-square',
			'icon-google-plus-square',
			'icon-google-plus',
			'icon-money',
			'icon-caret-down',
			'icon-caret-up',
			'icon-caret-left',
			'icon-caret-right',
			'icon-columns',
			'icon-sort',
			'icon-sort-desc',
			'icon-sort-asc',
			'icon-envelope-alt',
			'icon-linkedin',
			'icon-undo',
			'icon-gavel',
			'icon-tachometer',
			'icon-comment-o',
			'icon-comments-o',
			'icon-bolt',
			'icon-sitemap',
			'icon-umbrella',
			'icon-clipboard',
			'icon-lightbulb-o',
			'icon-exchange',
			'icon-cloud-download',
			'icon-cloud-upload',
			'icon-user-md',
			'icon-stethoscope',
			'icon-suitcase',
			'icon-bell-o',
			'icon-coffee',
			'icon-cutlery',
			'icon-file-text-o',
			'icon-building-o',
			'icon-hospital-o',
			'icon-ambulance',
			'icon-medkit',
			'icon-fighter-jet',
			'icon-beer',
			'icon-h-square',
			'icon-plus-square',
			'icon-angle-double-left',
			'icon-angle-double-right',
			'icon-angle-double-up',
			'icon-angle-double-down',
			'icon-angle-left',
			'icon-angle-right',
			'icon-angle-up',
			'icon-angle-down',
			'icon-desktop',
			'icon-laptop',
			'icon-tablet',
			'icon-mobile',
			'icon-circle-o',
			'icon-quote-left',
			'icon-quote-right',
			'icon-spinner',
			'icon-circle',
			'icon-reply',
			'icon-github-alt',
			'icon-folder-o',
			'icon-folder-open-o',
			'icon-smile-o',
			'icon-frown-o',
			'icon-meh-o',
			'icon-gamepad',
			'icon-keyboard-o',
			'icon-flag-o',
			'icon-flag-checkered',
			'icon-terminal',
			'icon-code',
			'icon-reply-all',
			'icon-star-half-o',
			'icon-location-arrow',
			'icon-crop',
			'icon-code-fork',
			'icon-chain-broken',
			'icon-question',
			'icon-info',
			'icon-exclamation',
			'icon-superscript',
			'icon-subscript',
			'icon-eraser',
			'icon-puzzle-piece',
			'icon-microphone',
			'icon-microphone-slash',
			'icon-shield',
			'icon-calendar-o',
			'icon-fire-extinguisher',
			'icon-rocket',
			'icon-maxcdn',
			'icon-chevron-circle-left',
			'icon-chevron-circle-right',
			'icon-chevron-circle-up',
			'icon-chevron-circle-down',
			'icon-html5',
			'icon-css3',
			'icon-anchor',
			'icon-unlock-alt',
			'icon-bullseye',
			'icon-ellipsis-h',
			'icon-ellipsis-v',
			'icon-rss-square',
			'icon-play-circle',
			'icon-ticket',
			'icon-minus-square',
			'icon-minus-square-o',
			'icon-level-up',
			'icon-level-down',
			'icon-check-square',
			'icon-pencil-square',
			'icon-external-link-square',
			'icon-share-square',
			'icon-compass',
			'icon-caret-square-o-down',
			'icon-caret-square-o-up',
			'icon-caret-square-o-right',
			'icon-eur',
			'icon-gbp',
			'icon-usd',
			'icon-inr',
			'icon-jpy',
			'icon-rub',
			'icon-krw',
			'icon-btc',
			'icon-file',
			'icon-file-text',
			'icon-sort-alpha-asc',
			'icon-sort-alpha-desc',
			'icon-sort-amount-asc',
			'icon-sort-amount-desc',
			'icon-sort-numeric-asc',
			'icon-sort-numeric-desc',
			'icon-thumbs-up',
			'icon-thumbs-down',
			'icon-youtube-square',
			'icon-youtube',
			'icon-xing',
			'icon-xing-square',
			'icon-youtube-play',
			'icon-dropbox',
			'icon-stack-overflow',
			'icon-instagram',
			'icon-flickr',
			'icon-adn',
			'icon-bitbucket',
			'icon-bitbucket-square',
			'icon-tumblr',
			'icon-tumblr-square',
			'icon-long-arrow-down',
			'icon-long-arrow-up',
			'icon-long-arrow-left',
			'icon-long-arrow-right',
			'icon-apple',
			'icon-windows',
			'icon-android',
			'icon-linux',
			'icon-dribbble',
			'icon-skype',
			'icon-foursquare',
			'icon-trello',
			'icon-female',
			'icon-male',
			'icon-gratipay',
			'icon-sun-o',
			'icon-moon-o',
			'icon-archive',
			'icon-bug',
			'icon-vk',
			'icon-weibo',
			'icon-renren',
			'icon-pagelines',
			'icon-stack-exchange',
			'icon-arrow-circle-o-right',
			'icon-arrow-circle-o-left',
			'icon-caret-square-o-left',
			'icon-dot-circle-o',
			'icon-wheelchair',
			'icon-vimeo-square',
			'icon-try',
			'icon-plus-square-o',
			'icon-space-shuttle',
			'icon-slack',
			'icon-envelope-square',
			'icon-wordpress',
			'icon-openid',
			'icon-university',
			'icon-graduation-cap',
			'icon-yahoo',
			'icon-google',
			'icon-reddit',
			'icon-reddit-square',
			'icon-stumbleupon-circle',
			'icon-stumbleupon',
			'icon-delicious',
			'icon-digg',
			'icon-pied-piper',
			'icon-pied-piper-alt',
			'icon-drupal',
			'icon-joomla',
			'icon-language',
			'icon-fax',
			'icon-building',
			'icon-child',
			'icon-paw',
			'icon-spoon',
			'icon-cube',
			'icon-cubes',
			'icon-behance',
			'icon-behance-square',
			'icon-steam',
			'icon-steam-square',
			'icon-recycle',
			'icon-car',
			'icon-taxi',
			'icon-tree',
			'icon-spotify',
			'icon-deviantart',
			'icon-soundcloud',
			'icon-database',
			'icon-file-pdf-o',
			'icon-file-word-o',
			'icon-file-excel-o',
			'icon-file-powerpoint-o',
			'icon-file-image-o',
			'icon-file-archive-o',
			'icon-file-audio-o',
			'icon-file-video-o',
			'icon-file-code-o',
			'icon-vine',
			'icon-codepen',
			'icon-jsfiddle',
			'icon-life-ring',
			'icon-circle-o-notch',
			'icon-rebel',
			'icon-empire',
			'icon-git-square',
			'icon-git',
			'icon-hacker-news',
			'icon-tencent-weibo',
			'icon-qq',
			'icon-weixin',
			'icon-paper-plane',
			'icon-paper-plane-o',
			'icon-history',
			'icon-circle-thin',
			'icon-header',
			'icon-paragraph',
			'icon-sliders',
			'icon-share-alt',
			'icon-share-alt-square',
			'icon-bomb',
			'icon-futbol-o',
			'icon-tty',
			'icon-binoculars',
			'icon-plug',
			'icon-slideshare',
			'icon-twitch',
			'icon-yelp',
			'icon-newspaper-o',
			'icon-wifi',
			'icon-calculator',
			'icon-paypal',
			'icon-google-wallet',
			'icon-cc-visa',
			'icon-cc-mastercard',
			'icon-cc-discover',
			'icon-cc-amex',
			'icon-cc-paypal',
			'icon-cc-stripe',
			'icon-bell-slash',
			'icon-bell-slash-o',
			'icon-trash',
			'icon-copyright',
			'icon-at',
			'icon-eyedropper',
			'icon-paint-brush',
			'icon-birthday-cake',
			'icon-area-chart',
			'icon-pie-chart',
			'icon-line-chart',
			'icon-lastfm',
			'icon-lastfm-square',
			'icon-toggle-off',
			'icon-toggle-on',
			'icon-bicycle',
			'icon-bus',
			'icon-ioxhost',
			'icon-angellist',
			'icon-cc',
			'icon-ils',
			'icon-meanpath',
			'icon-buysellads',
			'icon-connectdevelop',
			'icon-dashcube',
			'icon-forumbee',
			'icon-leanpub',
			'icon-sellsy',
			'icon-shirtsinbulk',
			'icon-simplybuilt',
			'icon-skyatlas',
			'icon-cart-plus',
			'icon-cart-arrow-down',
			'icon-diamond',
			'icon-ship',
			'icon-user-secret',
			'icon-motorcycle',
			'icon-street-view',
			'icon-heartbeat',
			'icon-venus',
			'icon-mars',
			'icon-mercury',
			'icon-transgender',
			'icon-transgender-alt',
			'icon-venus-double',
			'icon-mars-double',
			'icon-venus-mars',
			'icon-mars-stroke',
			'icon-mars-stroke-v',
			'icon-mars-stroke-h',
			'icon-neuter',
			'icon-facebook-official',
			'icon-pinterest-p',
			'icon-whatsapp',
			'icon-server',
			'icon-user-plus',
			'icon-user-times',
			'icon-bed',
			'icon-viacoin',
			'icon-train',
			'icon-subway',
			'icon-medium'
);

		echo '<div id="pix_list_icons">';
			echo '<div class="clear"><p><a href="http://fortawesome.github.com/Font-Awesome">Font Awesome - http://fortawesome.github.com/Font-Awesome</a> + some customizations</p></div>'; 
			echo '<div class="menu_icon_preview"><i class=""></i></div>';
			foreach ( $icons as $icon ) {
				echo '<div class="menu_icon_preview"><i class="'.$icon.'"></i></div>';
			}
		echo '</div><!-- #pix_list_icons -->';

		
	}
}
add_action('admin_footer','pix_admin_footer',100);
	
/*=========================================================================================*/

//add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );

function pix_default_editor(){
	global $post;

	$typenow = get_post_type();
	
	$editor = get_post_meta( $post->ID, 'pix_editor_field', true );
	
	if ( isset($editor) && $editor=='on' && $typenow == 'post' && $typenow == 'page' && $typenow == 'portfolio' ) {
		return "html";
	} else {
		return "tinymce";
	}
	
}
add_filter( 'wp_default_editor', 'pix_default_editor' );

function pix_tinymce_settings($settings) {
	global $post;

	$typenow = get_post_type();
	
	$editor = get_post_meta( $post->ID, 'pix_editor_field', true );

	if ( !isset($editor) || $editor!='on' && ($typenow == 'post' || $typenow == 'page' || $typenow == 'portfolio') ) {
	    $settings['theme_advanced_resizing'] = false;
	    $settings['wp_autoresize_on'] = false;
	}
    return $settings;
}
add_filter('tiny_mce_before_init','pix_tinymce_settings');

function pix_admin_class_by_editor( $classes ) {
	global $post;

	if ( 'post.php' == basename($_SERVER['SCRIPT_NAME']) || 'post-new.php' == basename($_SERVER['SCRIPT_NAME']) ) {

		$typenow = get_post_type();

		$editor = get_post_meta( $post->ID, 'pix_editor_field', true );
		
		if ( (!isset($editor) || $editor=='' || $editor=='off') && ($typenow == 'post' || $typenow == 'page' || $typenow == 'portfolio') ) {
			$classes .= ' pix_body_builder';
		}

		return $classes;
	}

}
add_filter( 'admin_body_class', 'pix_admin_class_by_editor' );
	
/*=========================================================================================*/

function pix_single_template($single_template) {
	global $post;

	if ( $post->post_type == 'post' || $post->post_type == 'portfolio' ) {

		$typenow = $post->post_type == 'post' ? '' : '-'.$post->post_type;
		
		$page_template = get_post_meta( $post->ID, 'pix_page_template_select', true );

		if ( isset($page_template) && $page_template=='widepage.php' && ( file_exists(get_stylesheet_directory() . '/single-wide'.$typenow.'.php') || file_exists(get_template_directory() . '/single-wide'.$typenow.'.php') )) {
			if ( file_exists(get_stylesheet_directory() . '/single-wide'.$typenow.'.php') ) {
				$single_template = get_stylesheet_directory() . "/single-wide".$typenow.".php";
			} else {
				$single_template = get_template_directory() . "/single-wide".$typenow.".php";
			}
		} else {
			if ( file_exists(get_stylesheet_directory() . '/single'.$typenow.'.php') ) {
				$single_template = get_stylesheet_directory() . "/single".$typenow.".php";
			} else {
				$single_template = get_template_directory() . "/single".$typenow.".php";
			}
		}
	}

	return $single_template;
	
}

add_filter('single_template', 'pix_single_template');
	
/*=========================================================================================*/

remove_shortcode( 'gallery', 'gallery_shortcode' );
add_shortcode( 'gallery', 'pix_post_gallery' );
function pix_post_gallery($attr) {

	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}


	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'include'    => '',
		'exclude'    => '',
		'slideshow'  => '',
		'archive'	 => '',
		'thumb'		 => '',
		'crop'		=> '',
		'linkto'		=> '',
		'caption'		=> '',
		'content'	 => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( $archive=='true' ) {
		$slideshow = 'true';
		$page_template = 'archive';
	} else {
		$slideshow = $slideshow=='' ? 'true' : $slideshow;
		$page_template = get_post_meta( $post->ID, 'pix_page_template_select', true );
	}

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	$selector = "gallery-{$instance}";

	if ( isset($page_template) && $page_template=='widepage.php' && file_exists(get_template_directory() . '/single-wide.php')) {
		$thumb_size = 'four_columns';
	} else if ( $page_template=='archive' ) {
		$thumb_size = $thumb;
	} else {
		$thumb_size = 'three_columns';
	}

	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id}'>";
	$datarel = "galleryid-$id";
	$gallery_style = '';
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

    foreach ( $attachments as $id => $attachment ) {
		
		$attAttr = wp_get_attachment_image_src($id,$thumb_size);
		
		if ( !isset($max_height) || $max_height > $attAttr[2] ) {
			$max_width = $attAttr[1];
			$max_height = $attAttr[2];
		}
	}


		if ( $slideshow != 'false' ) {

			$output = "<div id='$selector' class='gallery galleryid-{$id} pix_slideshow pix_slideshow_preloading'>
				".$content."
							<div class='pix_canvasloader-container'></div>
							<div class='pix_slideshow_until_image'></div>
							<div
		                    class='pix_slideshow_target pix_slideshow_preloading'
		                    style='height: ".$max_height."px;
		                        width: ".$max_width."px;'>";

		    foreach ( $attachments as $id => $attachment ) {
				
				$link = isset($attr['link']) && 'post' == $attr['link'] ? get_attachment_link($id) : wp_get_attachment_url($id);
				$colorbox = isset($attr['link']) && 'post' == $attr['link'] ? '' : ' colorbox';
				$data_title = wptexturize($attachment->post_excerpt) != '' ? wptexturize($attachment->post_excerpt) : the_title_attribute( 'echo=0' );
				$img_url = wp_get_attachment_image_src($id, $thumb_size);
				
		        $output .= "<div>";
		        $output .= "
		            <div style='background-color:transparent'
		                            data-src='".$img_url[0]."'
		                            data-use='background'>
		            </div>";

		        if ( $caption=='true' ) {

					$output .= "<div class='pix_slideshow_target_inner'>
						<div class='filmore_caption'
								style='width:100%; height:auto; font-size:13px'
								data-fontsize='13px' data-use='caption' data-style='left:0,bottom:0' data-delay='0' data-time='800' data-easein='easeOutQuad' data-easeout='easeInQuad' data-fxin='none' data-fxout='none' data-fadein='true' data-fadeout='true' data-rotatein='false' data-rotateout='false'>
							".html5autop($attachment->post_excerpt)."
						</div>
					</div>";
				}
				if ( $linkto == 'colorbox' ) {
						$link = wp_get_attachment_url($id);
						$output .= "<a href='".$link."' class='filmore_link_100".$colorbox."' data-title='". $data_title ."' data-rel='$datarel'>&nbsp;</a></div>";
					} elseif ( $linkto == 'page' ) {
						$link = get_permalink($post->ID);
						$output .= "<a href='".$link."' class='filmore_link_100' data-title='". $data_title ."'>&nbsp;</a></div>";
					} else {
						$output .= "<a href='".$link."' class='filmore_link_100".$colorbox."' data-title='". $data_title ."' data-rel='$datarel'>&nbsp;</a></div>";
					}					
				
		    }

		    $output .= '</div>
					    <div class="filmore_commands">
							<div class="filmore_prev filmore_command"><i class="icon-prev-slide"></i></div>
							<div class="filmore_next filmore_command"><i class="icon-next-slide"></i></div>
							<div class="filmore_loader hidden_div"></div>
						</div>

					</div>';

		} else {

			$output .= "<div class='clear'></div>";
			$output .= '<div class="pix_simple_grid pix_load_content masonry">';
			foreach ( $attachments as $id => $attachment ) {

				$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_url($id) : get_attachment_link($id);
				$data_title = wptexturize($attachment->post_excerpt) != '' ? wptexturize($attachment->post_excerpt) : the_title_attribute( 'echo=0' );
				$thumb_size = (!$crop || $crop=='true' ) ? 'one_column_thumb' : 'one_column';
				$img_url = wp_get_attachment_image_src($id, $thumb_size);

				$wpcaption = $caption=='true' ? ' wp-caption' : '';
				$output .= "<div class='entry alignleft$wpcaption'>";
				$output .= '<div class="pix_column pix_column_thumb pix_column_210 alignleft gallery-item">';
				$output .= '<a href="'.$link.'" data-title="'. $data_title .'" data-rel="pix_featured_image">';
				$output .= '<img data-size="'.$thumb_size.'" src="'.$img_url[0].'">';
				$output .= '</a>';
		        if ( $caption=='true' ) {
					$output .= "<p class='wp-caption-text'>
						".wptexturize($attachment->post_excerpt)."
					</p>";
				}
				$output .= "</div>";
				$output .= "</div>";
			}
			$output .= "</div>";
			$output .= "</div>";

		}

		$output .= "<div class='clear'></div>";


	return $output;
}
	
/*=========================================================================================*/

function pixGetReferer() {
	echo $_SERVER["HTTP_REFERER"];
}
	
/*=========================================================================================*/

add_filter( 'pre_get_posts', 'pix_number_of_posts' );
function pix_number_of_posts( $query = '' ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

		if ( $query->is_tax('gallery') ) {
			$query_obj = $query->get_queried_object();
			$termID = $query_obj->term_id;
			$pix_array_gallery = pix_get_option('pix_array_gallery_'.$termID);
			$ppp = ( isset($pix_array_gallery['ppp']) && $pix_array_gallery['ppp']!='' ) ? $pix_array_gallery['ppp'] : get_option('posts_per_page');
			return;
		}

		if ( $query->is_tax('portfolio_tag') ) {
			$ppp = ( pix_get_option('pix_portfolio_archive_ppp')!='' ) ? pix_get_option('pix_portfolio_archive_ppp') : get_option('posts_per_page');
			$query->set( 'posts_per_page', $ppp );
			return;
		}

		if ( $query->is_category && !pix_is_woocommerce() ) {
			$query_obj = $query->get_queried_object();
			$termID = $query_obj->term_id;
			$pix_array_category = pix_get_option('pix_array_category_'.$termID);
			$ppp = ( isset($pix_array_category['ppp']) && $pix_array_category['ppp']!='' ) ? $pix_array_category['ppp'] : get_option('posts_per_page');
			$query->set( 'posts_per_page', $ppp );
			return;
		}

		if ( $query->is_archive && !pix_is_woocommerce() ) {
			$ppp = ( pix_get_option('pix_archive_ppp')!='' ) ? pix_get_option('pix_archive_ppp') : get_option('posts_per_page');
			$query->set( 'posts_per_page', $ppp );
			return;
		}

		if ( pix_is_woocommerce() ) {
			$ppp = ( pix_get_option('pix_woocommerce_ppp')!='' ) ? pix_get_option('pix_woocommerce_ppp') : get_option('posts_per_page');
			$query->set( 'posts_per_page', $ppp );
			return;
		}
}

/*=========================================================================================*/

function pix_remove_something($something,$content) 
{
	$str = str_replace($something, '', $content);

    return $str;
}
 
/*=========================================================================================*/

function pix_hex_opacity($str) {
	$str = round ( $str, 1 );
	$str = dechex( $str * 255 );
	return $str;
}
 
/*=========================================================================================*/

add_action( 'parse_query', 'pix_parse_query' );
function pix_parse_query( $wp_query )
{
    if ( $wp_query->is_post_type_archive && $wp_query->is_tax )
        $wp_query->is_post_type_archive = false;
}

/*=========================================================================================*/

function pix_is_facebook() {
	if(!(stristr($_SERVER["HTTP_USER_AGENT"],'facebook') === FALSE)) {
		return true;
	}
}

/*=========================================================================================*/

function pix_embed_filter( $html, $data, $url ){
    $html = preg_replace('!(<object[^>]*>)(.*?)</object>!is', "$1$2<param name=\"wmode\" value=\"opaque\"></object>", $html);
    $html = preg_replace('!(<embed[^>](.*?)>)(.*?)</embed>!is', "<embed $2 wmode=\"opaque\">$3</embed>", $html);
    return $html;
}
add_filter('oembed_dataparse', 'pix_embed_filter', 90, 3 );

/*=========================================================================================*/

add_action( 'comment_duplicate_trigger', 'pix_duplicate_comment' );
function pix_duplicate_comment(){
	echo 'pix_duplicate';
}

/*=========================================================================================*/

function pix_remove_protocol($url){
	$disallowed = array('http:', 'https:');
	foreach($disallowed as $d) {
		if(strpos($url, $d) === 0) {
			return str_replace($d, '', $url);
		}
	}
	return $url;
}