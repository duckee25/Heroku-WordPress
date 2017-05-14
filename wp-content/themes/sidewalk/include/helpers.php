<?php
/*-----------------------------------------------------------------------------------*/
/*	Helpers and utils functions for theme use
/*-----------------------------------------------------------------------------------*/

/* 	Debug (log) function */
if ( !function_exists( 'sdw_log' ) ):
	function sdw_log( $mixed ) {

		if ( is_array( $mixed ) ) {
			$mixed = print_r( $mixed, 1 );
		} else if ( is_object( $mixed ) ) {
				ob_start();
				var_dump( $mixed );
				$mixed = ob_get_clean();
			}

		$handle = fopen( THEME_DIR . '/log', 'a' );
		fwrite( $handle, $mixed . PHP_EOL );
		fclose( $handle );
	}
endif;

/* 	Get theme option function */
if ( !function_exists( 'sdw_get_option' ) ):
	function sdw_get_option( $option ) {

		global $sdw_settings;

		if ( empty( $sdw_settings ) ) {
			$sdw_settings = get_option( 'sdw_settings' );
		}

		if ( isset( $sdw_settings[$option] ) ) {
			return $sdw_settings[$option];
		} else {
			return false;
		}

	}
endif;

/* 	Check if current post should be highlighted based on theme options */
if ( !function_exists( 'sdw_highlight_post_class' ) ):
	function sdw_highlight_post_class() {

		if ( sdw_get_option( 'use_highlight' ) ) {

			$highlight_class = 'sdw-highlight';

			//Category

			$highlight_cats = sdw_get_option( 'highlight_cat' );

			if ( !empty( $highlight_cats ) ) {
				$cats = get_the_category();
				if ( !empty( $cats ) ) {
					foreach ( $cats as $k => $cat ) {
						if ( in_array( $cat->term_id, $highlight_cats ) ) {

							if ( is_category() ) {
								$obj = get_queried_object();

								if ( $cat->term_id == $obj->term_id ) {
									continue; //skip
								}
							}

							return $highlight_class;
						}
					}
				}
			}

			//Tag

			$highlight_tags = sdw_get_option( 'highlight_tag' );

			if ( !empty( $highlight_tags ) ) {
				$tags = get_the_tags();
				if ( !empty( $tags ) ) {
					foreach ( $tags as $k => $tag ) {
						if ( in_array( $tag->term_id, $highlight_tags ) ) {

							if ( is_tag() ) {
								$obj = get_queried_object();

								if ( $tag->term_id == $obj->term_id ) {
									continue; //skip
								}
							}

							return $highlight_class;
						}
					}
				}
			}

			//Comments

			$highlight_comments = sdw_get_option( 'highlight_comments' );

			if ( !empty( $highlight_comments ) ) {
				if ( get_comments_number() >= $highlight_comments ) {
					return $highlight_class;
				}
			}

			//Views

			$highlight_views = sdw_get_option( 'highlight_views' );

			if ( !empty( $highlight_views ) ) {

				if ( function_exists( 'ev_get_post_view_count' ) ) {
					global $wp_locale;
					$thousands_sep = isset( $wp_locale->number_format['thousands_sep'] ) ? $wp_locale->number_format['thousands_sep'] : ',';
					$views = absint( str_replace( $thousands_sep, '', ev_get_post_view_count( get_the_ID() ) ) );

					if ( $views >= $highlight_views ) {
						return $highlight_class;
					}
				}

			}

			//Manual

			if ( $manual_posts = sdw_get_option( 'highlight_manual_ids' ) ) {
				$manual_posts = explode( ",", $manual_posts );
				if ( in_array( get_the_ID(), $manual_posts ) ) {
					return $highlight_class;
				}

			} elseif ( $manual_posts = sdw_get_option( 'highlight_manual' ) ) {
				if ( in_array( get_the_ID(), $manual_posts ) ) {
					return $highlight_class;
				}
			}


		}

		return false;
	}
endif;

/* Check if RTL is enabled */
if ( !function_exists( 'sdw_is_rtl' ) ):
	function sdw_is_rtl() {

		if ( sdw_get_option( 'rtl_mode' ) ) {
			$rtl = true;
			//Check if current language is excluded from RTL
			$rtl_lang_skip = explode( ",", sdw_get_option( 'rtl_lang_skip' ) );
			if ( !empty( $rtl_lang_skip )  ) {
				$locale = get_locale();
				if ( in_array( $locale, $rtl_lang_skip ) ) {
					$rtl = false;
				}
			}
		} else {
			$rtl = false;
		}

		return $rtl;
	}
endif;

/* Get list of image sizes to generate for theme use */
if ( !function_exists( 'sdw_get_image_sizes' ) ):
	function sdw_get_image_sizes() {

		$sizes = array();

		//Cover
		if ( sdw_get_option( 'img_size_cover' ) ) {
			$sizes['sdw-cover'] = array( 'title' => __( 'Cover size', THEME_SLUG ), 'args' => array( 'w' => 9999, 'h' => absint( sdw_get_option( 'img_size_cover_height' ) ), 'crop' => true ) );
		}


		//Layout A
		if ( sdw_get_option( 'img_size_lay_a' ) ) {
			$width = 800;
			$crop = true;
			$ratio = sdw_get_option( 'img_size_lay_a_ratio' );
			if ( $ratio == 'original' ) {
				$height = 9999;
				$crop = false;
			} else if ( $ratio == 'custom' ) {
					$ratio = sdw_get_option( 'img_size_lay_a_custom' );
					$ratio_opts = explode( ":", $ratio );
					$height = absint( $width * absint( $ratio_opts[1] ) / absint( $ratio_opts[0] ) );
				} else {
				$ratio_opts = explode( "_", $ratio );
				$height = absint( $width * $ratio_opts[1] / $ratio_opts[0] );
			}
			$sizes['sdw-lay-a'] = array( 'title' => __( 'A size', THEME_SLUG ), 'args' => array( 'w' => $width, 'h' => $height, 'crop' => $crop ) );
		}

		//Layout B
		if ( sdw_get_option( 'img_size_lay_b' ) ) {
			$width = 310;
			$crop = true;
			$ratio = sdw_get_option( 'img_size_lay_b_ratio' );
			if ( $ratio == 'original' ) {
				$height = 9999;
				$crop = false;
			} else if ( $ratio == 'custom' ) {
					$ratio = sdw_get_option( 'img_size_lay_b_custom' );
					$ratio_opts = explode( ":", $ratio );
					$height = absint( $width * absint( $ratio_opts[1] ) / absint( $ratio_opts[0] ) );
				} else {
				$ratio_opts = explode( "_", $ratio );
				$height = absint( $width * $ratio_opts[1] / $ratio_opts[0] );
			}
			$sizes['sdw-lay-b'] = array( 'title' => __( 'B size', THEME_SLUG ), 'args' => array( 'w' => $width, 'h' => $height, 'crop' => $crop ) );
		}

		//Layout C
		if ( sdw_get_option( 'img_size_lay_c' ) ) {
			$width = 140;
			$crop = true;
			$ratio = sdw_get_option( 'img_size_lay_c_ratio' );
			if ( $ratio == 'original' ) {
				$height = 9999;
				$crop = false;
			} else if ( $ratio == 'custom' ) {
					$ratio = sdw_get_option( 'img_size_lay_c_custom' );
					$ratio_opts = explode( ":", $ratio );
					$height = absint( $width * absint( $ratio_opts[1] ) / absint( $ratio_opts[0] ) );
				} else {
				$ratio_opts = explode( "_", $ratio );
				$height = absint( $width * $ratio_opts[1] / $ratio_opts[0] );
			}
			$sizes['sdw-lay-c'] = array( 'title' => __( 'C size', THEME_SLUG ), 'args' => array( 'w' => $width, 'h' => $height, 'crop' => $crop ) );
		}

		$sizes = apply_filters( 'sdw_modify_image_sizes', $sizes );

		return $sizes;
	}
endif;


/* Get all sidebars */
if ( !function_exists( 'sdw_get_sidebars_list' ) ):
	function sdw_get_sidebars_list( $inherit = false ) {

		$sidebars = array();

		if ( $inherit ) {
			$sidebars['inherit'] = __( 'Inherit', THEME_SLUG );
		}

		$sidebars['0'] = __( 'None', THEME_SLUG );

		global $wp_registered_sidebars;

		if ( !empty( $wp_registered_sidebars ) ) {

			foreach ( $wp_registered_sidebars as $sidebar ) {
				$sidebars[$sidebar['id']] = $sidebar['name'];
			}

		}
		//Get sidebars from wp_options if global var is not loaded yet
		$fallback_sidebars = get_option( 'sdw_registered_sidebars' );
		if ( !empty( $fallback_sidebars ) ) {
			foreach ( $fallback_sidebars as $sidebar ) {
				if ( !array_key_exists( $sidebar['id'], $sidebars ) ) {
					$sidebars[$sidebar['id']] = $sidebar['name'];
				}
			}
		}

		//Check for theme additional sidebars
		$custom_sidebars = sdw_get_option( 'add_sidebars' );

		if ( $custom_sidebars ) {
			for ( $i = 1; $i <= $custom_sidebars; $i++ ) {
				if ( !array_key_exists( 'sdw_sidebar_'.$i, $sidebars ) ) {
					$sidebars['sdw_sidebar_'.$i] = __( 'Sidebar', THEME_SLUG ).' '.$i;
				}
			}
		}

		//Do not display footer sidebars for selection
		unset( $sidebars['sdw_footer_sidebar_1'] );
		unset( $sidebars['sdw_footer_sidebar_2'] );
		unset( $sidebars['sdw_footer_sidebar_3'] );

		return $sidebars;
	}
endif;

/* Get cover layouts */
if ( !function_exists( 'sdw_get_single_layouts' ) ):
	function sdw_get_single_layouts( $inherit = false ) {

		$layouts = array();

		if ( $inherit ) {
			$layouts['inherit'] = array( 'title' => __( 'Inherit', THEME_SLUG ), 'img' => IMG_URI . 'admin/inherit.png' );
		}

		$layouts['classic'] = array( 'title' => __( 'Classic', THEME_SLUG ), 'img' => IMG_URI . 'admin/single_classic.png' );
		$layouts['cover'] = array( 'title' => __( 'With cover image', THEME_SLUG ), 'img' => IMG_URI . 'admin/single_cover.png' );

		return $layouts;
	}
endif;

/* Get sidebar layouts */
if ( !function_exists( 'sdw_get_sidebar_layouts' ) ):
	function sdw_get_sidebar_layouts( $inherit = false ) {

		$layouts = array();

		if ( $inherit ) {
			$layouts['inherit'] = array( 'title' => __( 'Inherit', THEME_SLUG ), 'img' => IMG_URI . 'admin/inherit.png' );
		}

		$layouts['none'] = array( 'title' => __( 'No sidebar', THEME_SLUG ), 'img' => IMG_URI . 'admin/content_no_sid.png' );
		$layouts['left'] = array( 'title' => __( 'Left sidebar', THEME_SLUG ), 'img' => IMG_URI . 'admin/content_sid_left.png' );
		$layouts['right'] = array( 'title' => __( 'Right sidebar', THEME_SLUG ), 'img' => IMG_URI . 'admin/content_sid_right.png' );

		return $layouts;
	}
endif;

/* Get current sidebar options */
if ( !function_exists( 'sdw_get_current_sidebar' ) ):
	function sdw_get_current_sidebar() {

		global $sdw_current_sidebar;

		if ( !empty( $sdw_current_sidebar ) ) {
			return $sdw_current_sidebar;
		}

		//Default
		$use_sidebar = 'none';
		$sidebar = 'sdw_default_sidebar';
		$sticky_sidebar = 'sdw_default_sticky_sidebar';


		$sdw_template = sdw_detect_template();

		if ( in_array( $sdw_template, array( 'search', 'tag', 'author', 'archive', 'home' ) ) ) {

			$use_sidebar = sdw_get_option( $sdw_template.'_use_sidebar' );
			if ( $use_sidebar != 'none' ) {
				$sidebar = sdw_get_option( $sdw_template.'_sidebar' );
				$sticky_sidebar = sdw_get_option( $sdw_template.'_sticky_sidebar' );
			}

		} else if ( $sdw_template == 'category' ) {

				$obj = get_queried_object();
				if ( isset( $obj->term_id ) ) {
					$meta = sdw_get_category_meta( $obj->term_id );
				}

				if ( $meta['use_sidebar'] != 'none' ) {
					$use_sidebar = ( $meta['use_sidebar'] == 'inherit' ) ? sdw_get_option( $sdw_template.'_use_sidebar' ) : $meta['use_sidebar'];
					if ( $use_sidebar ) {
						$sidebar = ( $meta['sidebar'] == 'inherit' ) ?  sdw_get_option( $sdw_template.'_sidebar' ) : $meta['sidebar'];
						$sticky_sidebar = ( $meta['sticky_sidebar'] == 'inherit' ) ?  sdw_get_option( $sdw_template.'_sticky_sidebar' ) : $meta['sticky_sidebar'];
					}
				}


			} else if ( $sdw_template == 'single' ) {

				$meta = sdw_get_post_meta( get_the_ID() );
				$use_sidebar = ( $meta['use_sidebar'] == 'inherit' ) ? sdw_get_option( $sdw_template.'_use_sidebar' ) : $meta['use_sidebar'];
				if ( $use_sidebar != 'none' ) {
					$sidebar = ( $meta['sidebar'] == 'inherit' ) ?  sdw_get_option( $sdw_template.'_sidebar' ) : $meta['sidebar'];
					$sticky_sidebar = ( $meta['sticky_sidebar'] == 'inherit' ) ?  sdw_get_option( $sdw_template.'_sticky_sidebar' ) : $meta['sticky_sidebar'];
				}

			} else if ( 'page' ) {

				if ( !is_page_template( 'template-full-width.php' ) ) {

					$meta = sdw_get_page_meta( get_the_ID() );

					$use_sidebar = ( $meta['use_sidebar'] == 'inherit' ) ? sdw_get_option( 'page_use_sidebar' ) : $meta['use_sidebar'];
					if ( $use_sidebar != 'none' ) {
						$sidebar = ( $meta['sidebar'] == 'inherit' ) ?  sdw_get_option( 'page_sidebar' ) : $meta['sidebar'];
						$sticky_sidebar = ( $meta['sticky_sidebar'] == 'inherit' ) ?  sdw_get_option( 'page_sticky_sidebar' ) : $meta['sticky_sidebar'];
					}
				}

			}

		$args = array(
			'use_sidebar' => $use_sidebar,
			'sidebar' => $sidebar,
			'sticky_sidebar' => $sticky_sidebar
		);

		$sdw_current_sidebar = $args;

		return $args;
	}
endif;

/* Get current pagination layout */
if ( !function_exists( 'sdw_get_current_pagination' ) ):
	function sdw_get_current_pagination() {
		$layout = sdw_get_current_post_layout();
		return sdw_get_option( 'lay_'.$layout.'_pag' );
	}
endif;

/* Get current post layout */
if ( !function_exists( 'sdw_get_current_post_layout' ) ):
	function sdw_get_current_post_layout( $i = false ) {


		$sdw_template = sdw_detect_template();
		if ( in_array( $sdw_template, array( 'search', 'tag', 'author', 'archive', 'home' ) ) ) {

			$layout = sdw_get_option( $sdw_template.'_layout' );

		} else if ( $sdw_template == 'category' ) {

				$obj = get_queried_object();
				if ( isset( $obj->term_id ) ) {
					$meta = sdw_get_category_meta( $obj->term_id );
				}

				$layout = $meta['layout'] == 'inherit' ? sdw_get_option( $sdw_template.'_layout' ) : $meta['layout'];

			}

		//Check for combined layout
		if ( $i !== false ) {
			$combined = explode( '_', $layout );
			if ( count( $combined ) > 1 ) {
				if ( is_paged() ) {
					return $combined[1]; //always return second layout if combined
				}

				$num = absint( sdw_get_option( 'lay_a_comb_num' ) );
				return ( $i + 1 ) > $num ? $combined[1] : $combined[0];
			}
		} else {
			$combined = explode( '_', $layout );
			if ( count( $combined ) > 1 ) {
				return $combined[1];
			}
		}

		if ( empty( $layout ) ) {
			$layout = 'a'; //layout a as default
		}

		return $layout;
	}
endif;



/* Get main post layout options */
if ( !function_exists( 'sdw_get_main_layouts' ) ):
	function sdw_get_main_layouts( $inherit = false, $none = false ) {

		if ( $inherit ) {
			$layouts['inherit'] = array( 'title' => __( 'Inherit', THEME_SLUG ), 'img' => IMG_URI . 'admin/inherit.png' );
		}

		if ( $none ) {
			$layouts['0'] = array( 'title' => __( 'None', THEME_SLUG ), 'img' => IMG_URI . 'admin/none.png' );
		}

		$layouts['a'] = array( 'title' => __( 'Layout A', THEME_SLUG ), 'img' => IMG_URI . 'admin/layout_a.png' );
		$layouts['b'] = array( 'title' => __( 'Layout B', THEME_SLUG ), 'img' => IMG_URI . 'admin/layout_b.png' );
		$layouts['c'] = array( 'title' => __( 'Layout C', THEME_SLUG ), 'img' => IMG_URI . 'admin/layout_c.png' );
		$layouts['a_b'] = array( 'title' => __( 'Layout A + B', THEME_SLUG ), 'img' => IMG_URI . 'admin/layout_ab.png' );
		$layouts['a_c'] = array( 'title' => __( 'Layout A + C', THEME_SLUG ), 'img' => IMG_URI . 'admin/layout_ac.png' );

		return $layouts;
	}
endif;

/* Get pagination options */
if ( !function_exists( 'sdw_get_pagination_layouts' ) ):
	function sdw_get_pagination_layouts() {
		$layouts = array(
			'prev-next' => array( 'title' => __( 'Prev/Next page links', THEME_SLUG ), 'img' => IMG_URI . 'admin/pag_prev_next.png' ),
			'numeric' => array( 'title' => __( 'Numeric pagination links', THEME_SLUG ), 'img' => IMG_URI . 'admin/pag_numeric.png' ),
			'load-more' => array( 'title' => __( 'Load more button', THEME_SLUG ), 'img' => IMG_URI . 'admin/pag_load_more.png' ),
			'infinite-scroll' => array( 'title' => __( 'Infinite scroll', THEME_SLUG ), 'img' => IMG_URI . 'admin/pag_infinite.png' ),
		);

		return $layouts;
	}
endif;

/* Get archive title options */
if ( !function_exists( 'sdw_get_archive_title_layouts' ) ):
	function sdw_get_archive_title_layouts() {
		$layouts = array(
			'cover' => array( 'title' => __( 'With cover image', THEME_SLUG ), 'img' => IMG_URI . 'admin/pag_prev_next.png' ),
			'classic' => array( 'title' => __( 'Classic (no image)', THEME_SLUG ), 'img' => IMG_URI . 'admin/pag_numeric.png' ),
			'none' => array( 'title' => __( 'None', THEME_SLUG ), 'img' => IMG_URI . 'admin/none.png' ),
		);

		return $layouts;
	}
endif;

/* Include simple numeric pagination */
if ( !function_exists( 'sdw_pagination' ) ):
	function sdw_pagination( $prev = '&lsaquo;', $next = '&rsaquo;' ) {
		global $wp_query, $wp_rewrite;
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
		$pagination = array(
			'base' => @add_query_arg( 'paged', '%#%' ),
			'format' => '',
			'total' => $wp_query->max_num_pages,
			'current' => $current,
			'prev_text' => $prev,
			'next_text' => $next,
			'type' => 'plain'
		);
		if ( $wp_rewrite->using_permalinks() )
			$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

		if ( !empty( $wp_query->query_vars['s'] ) )
			$pagination['add_args'] = array( 's' => str_replace( ' ', '+', get_query_var( 's' ) ) );

		$links = paginate_links( $pagination );

		if ( $links ) {
			return $links;
		}
	}
endif;

/* Get frist paragraph of text */
if ( !function_exists( 'sdw_get_first_p' ) ):
	function sdw_get_first_p( $string ) {
		preg_match( "/<p>(.*)<\/p>/i", $string, $matches );
		$p = isset( $matches[0] ) && !empty( $matches[0] ) ? $matches[0] : '';
		return $p;
	}
endif;


/* Convert hexdec color string to rgba */
if ( !function_exists( 'sdw_hex2rgba' ) ):
	function sdw_hex2rgba( $color, $opacity = false ) {
		$default = 'rgb(0,0,0)';

		//Return default if no color provided
		if ( empty( $color ) )
			return $default;

		//Sanitize $color if "#" is provided
		if ( $color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		//Check if color has 6 or 3 characters and get values
		if ( strlen( $color ) == 6 ) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}

		//Convert hexadec to rgb
		$rgb =  array_map( 'hexdec', $hex );

		//Check if opacity is set(rgba or rgb)
		if ( $opacity ) {
			if ( abs( $opacity ) > 1 ) { $opacity = 1.0; }
			$output = 'rgba('.implode( ",", $rgb ).','.$opacity.')';
		} else {
			$output = 'rgb('.implode( ",", $rgb ).')';
		}

		//Return rgb(a) color string
		return $output;
	}
endif;

/* Get array of social options  */
if ( !function_exists( 'sdw_get_social' ) ) :
	function sdw_get_social( $existing = false ) {
		$social = array(
			'0' => 'None',
			'apple' => 'Apple',
			'behance' => 'Behance',
			'delicious' => 'Delicious',
			'deviantart' => 'DeviantArt',
			'digg' => 'Digg',
			'dribbble' => 'Dribbble',
			'facebook' => 'Facebook',
			'flickr' => 'Flickr',
			'github' => 'Github',
			'google' => 'GooglePlus',
			'instagram' => 'Instagram',
			'linkedin' => 'LinkedIN',
			'pinterest' => 'Pinterest',
			'reddit' => 'ReddIT',
			'rss' => 'Rss',
			'skype' => 'Skype',
			'stumbleupon' => 'StumbleUpon',
			'soundcloud' => 'SoundCloud',
			'spotify' => 'Spotify',
			'tumblr' => 'Tumblr',
			'twitter' => 'Twitter',
			'vimeo-square' => 'Vimeo',
			'vine' => 'Vine',
			'wordpress' => 'WordPress',
			'xing' => 'Xing' ,
			'yahoo' => 'Yahoo',
			'youtube' => 'Youtube'
		);

		if ( $existing ) {
			$new_social = array();
			foreach ( $social as $key => $soc ) {
				if ( $key && sdw_get_option( 'soc_'.$key.'_url' ) ) {
					$new_social[$key] = $soc;
				}
			}
			$social = $new_social;
		}

		return $social;
	}
endif;


/* Get theme translated string */
if ( !function_exists( '__sdw' ) ):
	function __sdw( $string_key ) {
		if ( ( $translated_string = sdw_get_option( 'tr_'.$string_key ) ) && sdw_get_option( 'enable_translate' ) ) {

			if ( $translated_string == '-1' ) {
				return "";
			}

			return $translated_string;

		} else {

			$translate = sdw_get_translate_options();
			return $translate[$string_key]['translated'];
		}
	}
endif;

/* Get All Translation Strings */
if ( !function_exists( 'sdw_get_translate_options' ) ):
	function sdw_get_translate_options() {
		global $sdw_translate;
		get_template_part( 'include/translate' );
		$translate = apply_filters( 'sdw_modify_translate_options', $sdw_translate );
		return $translate;
	}
endif;

/* Compress CSS Code  */
if ( !function_exists( 'sdw_compress_css_code' ) ) :
	function sdw_compress_css_code( $code ) {

		// Remove Comments
		$code = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code );

		// Remove tabs, spaces, newlines, etc.
		$code = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $code );

		return $code;
	}
endif;

/* Trim chars of string */
if ( !function_exists( 'sdw_trim_chars' ) ):
	function sdw_trim_chars( $string, $limit, $more = '...' ) {

		if ( !empty( $limit ) && strlen( $string ) > $limit ) {
			$last_space = strrpos( substr( $string, 0, $limit ), ' ' );
			$string = substr( $string, 0, $last_space );
			$string = rtrim( $string, ".,-?!" );
			$string.= $more;
		}

		return $string;
	}
endif;

/* Get image option url */
if ( !function_exists( 'sdw_get_option_media' ) ):
	function sdw_get_option_media( $option ) {
		$media = sdw_get_option( $option );
		if ( isset( $media['url'] ) && !empty( $media['url'] ) ) {
			return $media['url'];
		}
		return false;
	}
endif;

/* Generate font links */
if ( !function_exists( 'sdw_generate_font_links' ) ):
	function sdw_generate_font_links() {

		$output = array();
		$fonts = array();
		$fonts[] = sdw_get_option( 'main_font' );
		$fonts[] = sdw_get_option( 'h_font' );
		$fonts[] = sdw_get_option( 'nav_font' );
		$unique = array(); //do not add same font links
		$native = sdw_get_native_fonts();
		$protocol = is_ssl() ? 'https://' : 'http://';

		foreach ( $fonts as $font ) {
			if ( !in_array( $font['font-family'], $native ) ) {
				$temp = array();
				if ( isset( $font['font-style'] ) ) {
					$temp['font-style'] = $font['font-style'];
				}
				if ( isset( $font['subsets'] ) ) {
					$temp['subsets'] = $font['subsets'];
				}
				if ( isset( $font['font-weight'] ) ) {
					$temp['font-weight'] = $font['font-weight'];
				}
				$unique[$font['font-family']][] = $temp;
			}
		}

		foreach ( $unique as $family => $items ) {

			$link = $protocol.'fonts.googleapis.com/css?family='.str_replace( ' ', '%20', $family ); //valid

			$weight = array( '400' );
			$subsets = array( 'latin' );

			foreach ( $items as $item ) {

				//Check weight and style
				if ( isset( $item['font-weight'] ) && !empty( $item['font-weight'] ) ) {
					$temp = $item['font-weight'];
					if ( isset( $item['font-style'] ) && empty( $item['font-style'] ) ) {
						$temp .= $item['font-style'];
					}

					if ( !in_array( $temp, $weight ) ) {
						$weight[] = $temp;
					}
				}

				//Check subsets
				if ( isset( $item['subsets'] ) && !empty( $item['subsets'] ) ) {
					if ( !in_array( $item['subsets'], $subsets ) ) {
						$subsets[] = $item['subsets'];
					}
				}
			}

			$link .= ':'.implode( ",", $weight );
			$link .= '&subset='.implode( ",", $subsets );

			$output[] = str_replace( '&', '&amp;', $link ); //valid
		}

		return $output;
	}
endif;

/* Generate dynamic CSS */
if ( !function_exists( 'sdw_generate_dynamic_css' ) ):
	function sdw_generate_dynamic_css() {
		ob_start();
		get_template_part( 'css/dynamic-css' );
		$output = ob_get_contents();
		ob_end_clean();
		return sdw_compress_css_code( $output );
		//return  $output ;
	}
endif;


/* Get list of native fonts */
if ( !function_exists( 'sdw_get_native_fonts' ) ):
	function sdw_get_native_fonts() {

		$fonts = array(
			"Arial, Helvetica, sans-serif",
			"'Arial Black', Gadget, sans-serif",
			"'Bookman Old Style', serif",
			"'Comic Sans MS', cursive",
			"Courier, monospace",
			"Garamond, serif",
			"Georgia, serif",
			"Impact, Charcoal, sans-serif",
			"'Lucida Console', Monaco, monospace",
			"'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
			"'MS Sans Serif', Geneva, sans-serif",
			"'MS Serif', 'New York', sans-serif",
			"'Palatino Linotype', 'Book Antiqua', Palatino, serif",
			"Tahoma,Geneva, sans-serif",
			"'Times New Roman', Times,serif",
			"'Trebuchet MS', Helvetica, sans-serif",
			"Verdana, Geneva, sans-serif"
		);

		return $fonts;
	}
endif;


/* Custom function to limit post content words */
if ( !function_exists( 'sdw_get_excerpt' ) ):
	function sdw_get_excerpt( $layout = 'lay_a' ) {

		$manual_excerpt = false;

		if ( has_excerpt() ) {
			$content =  get_the_excerpt();
			$manual_excerpt = true;
		} else {
			//$content = apply_filters('the_content',get_the_content(''));
			$text = get_the_content( '' );
			$text = strip_shortcodes( $text );
			$text = apply_filters( 'the_content', $text );
			$content = str_replace( ']]>', ']]&gt;', $text );
		}

		//print_r($content);


		if ( !empty( $content ) ) {
			$limit = sdw_get_option( $layout.'_excerpt_limit' );
			if ( !empty( $limit ) || !$manual_excerpt ) {
				$more = sdw_get_option( 'more_string' );
				$content = wp_strip_all_tags( $content );
				$content = preg_replace( '/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $content );
				$content = sdw_trim_chars( $content, $limit, $more );
			}
			return $content;
		}

		return '';

	}
endif;

/* Custom function to get meta data for specific layout */
if ( !function_exists( 'sdw_get_meta_data' ) ):
	function sdw_get_meta_data( $layout = 'lay_a', $force_meta = false ) {

		if ( !$force_meta ) {
			//Layouts theme options
			$layout_metas = array_filter( sdw_get_option( $layout .'_meta' ) );
		} else {
			//From widget or anywhere you want
			$layout_metas = array( $force_meta => '1' );
		}

		$output = '';

		if ( !empty( $layout_metas ) ) {

			foreach ( $layout_metas as $mkey => $active ) {


				$meta = '';

				switch ( $mkey ) {

				case 'date':
					$meta = '<span class="updated">'.sdw_get_date().'</span>';
					break;
				case 'author':
					$author_id = get_post_field( 'post_author', get_the_ID() );
					$meta = '<span class="vcard author"><span class="fn">'.__sdw( 'by_author' ).' <a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ).'">'.get_the_author_meta( 'display_name', $author_id ).'</a></span></span>';
					break;

				case 'views':
					global $wp_locale;
					$thousands_sep = isset( $wp_locale->number_format['thousands_sep'] ) ? $wp_locale->number_format['thousands_sep'] : ',';
					$meta = function_exists( 'ev_get_post_view_count' ) ?  number_format( absint( str_replace( $thousands_sep, '', ev_get_post_view_count( get_the_ID() ) ) + sdw_get_option( 'views_forgery' ) ), 0, '', ',' )  . ' '.__sdw( 'views' ) : '';
					break;

				case 'rtime':
					$meta = sdw_read_time( get_post_field( 'post_content', get_the_ID() ) );
					if ( !empty( $meta ) ) {
						$meta .= ' '.__sdw( 'min_read' );
					}
					break;

				case 'comments':
					if ( comments_open() || get_comments_number() ) {
						ob_start();
						comments_popup_link( __sdw( 'no_comments' ), __sdw( 'one_comment' ), __sdw( 'multiple_comments' ) );
						$meta = ob_get_contents();
						ob_end_clean();
					} else {
						$meta = '';
					}
					break;

				default:
					break;
				}

				if ( !empty( $meta ) ) {
					$output .= '<div class="meta-item sdw-'.$mkey.'">'.$meta.'</div>';
				}
			}
		}


		return $output;

	}
endif;

/* Custom function to get actions for specific layout */
if ( !function_exists( 'sdw_get_action_buttons' ) ):
	function sdw_get_action_buttons( $layout = 'lay_a', $force_meta = false ) {

		if ( !$force_meta ) {
			//Layouts theme options
			$layout_metas = array_filter( sdw_get_option( $layout.'_actions' ) );

		} else {
			//From widget or anywhere you want
			$layout_metas = array( $force_meta => '1' );
		}

		$output = '';

		if ( !empty( $layout_metas ) ) {

			foreach ( $layout_metas as $mkey => $active ) {


				$meta = '';

				switch ( $mkey ) {

				case 'rm':
					$meta = '<a href="'.esc_url( get_permalink() ).'" title="'.esc_attr( get_the_title(  ) ).'">'.__sdw( 'continue_reading' ).'</a>';
					break;

				case 'comments':
					if ( comments_open() || get_comments_number() ) {
						ob_start();
						comments_popup_link( __sdw( 'no_comments' ), __sdw( 'one_comment' ), __sdw( 'multiple_comments' ) );
						$meta = ob_get_contents();
						ob_end_clean();
					} else {
						$meta = '';
					}
					break;

				case 'share':
					ob_start();
					get_template_part( 'sections/share' );
					$meta = trim( ob_get_contents() );
					ob_end_clean();
					break;

				default:
					break;
				}

				if ( !empty( $meta ) ) {
					$output .= '<div class="meta-action sdw-'.$mkey.'">'.$meta.'</div>';
				}
			}
		}


		return $output;

	}
endif;

/* Display featured image, and more :) */
if ( !function_exists( 'sdw_featured_image' ) ):
	function sdw_featured_image( $size = 'large', $post_id = false ) {


		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		if ( has_post_thumbnail( $post_id ) ) {
			return get_the_post_thumbnail( $post_id, $size );

		} else if ( $placeholder = sdw_get_option_media( 'default_fimg' ) ) {

				global $placeholder_img, $placeholder_imgs;

				if ( empty( $placeholder_img ) ) {
					$img_id = sdw_get_image_id_by_url( $placeholder );
				} else {
					$img_id = $placeholder_img;
				}

				if ( !empty( $img_id ) ) {
					if ( !isset( $placeholder_imgs[$size] ) ) {
						$def_img = wp_get_attachment_image( $img_id, $size );
					} else {
						$def_img = $placeholder_imgs[$size];
					}

					if ( !empty( $def_img ) ) {
						$placeholder_imgs[$size] = $def_img;
						return $def_img;
					}
				}

				return '<img src="'.esc_url( $placeholder ).'" />';
			}

		return false;
	}
endif;

/* Get image id by url */
if ( !function_exists( 'sdw_get_image_id_by_url' ) ):
	function sdw_get_image_id_by_url( $image_url ) {
		global $wpdb;

		$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );

		if ( isset( $attachment[0] ) ) {
			return $attachment[0];
		}

		return false;
	}
endif;

/* Check wheter to display date in standard or "time ago" format */
if ( !function_exists( 'sdw_get_date' ) ):
	function sdw_get_date() {

		if ( sdw_get_option( 'time_ago' ) ) {

			$limits = array(
				'-1 day' => 86400,
				'-3 days' => 259200,
				'-1 week' => 604800,
				'-1 month' => 2592000,
				'-3 months' => 7776000,
				'-6 months' => 15552000,
				'-1 year' => 31104000,
				'0' => 0
			);

			$ago_limit = sdw_get_option( 'time_ago_limit' );

			if ( array_key_exists( $ago_limit, $limits ) ) {

				if ( ( current_time( 'timestamp' ) - get_the_time( 'U' ) <= $limits[$ago_limit] ) || empty( $ago_limit ) ) {
					if ( sdw_get_option( 'ago_before' ) ) {
						return __sdw( 'ago' ).' '.human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) );
					} else {
						return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.__sdw( 'ago' );
					}
				} else {
					return get_the_date();
				}
			} else {
				return get_the_date();
			}
		} else {
			return get_the_date();
		}
	}
endif;

/* Get post meta with default values */
if ( !function_exists( 'sdw_get_post_meta' ) ):
	function sdw_get_post_meta( $post_id, $field = false ) {

		$defaults = array(
			'use_sidebar' => 'inherit',
			'sidebar' => 'inherit',
			'sticky_sidebar' => 'inherit',
			'layout' => 'inherit'
		);

		$meta = get_post_meta( $post_id, '_sdw_meta', true );
		$meta = wp_parse_args( $meta, $defaults );


		if ( $field ) {
			if ( isset( $meta[$field] ) ) {
				return $meta[$field];
			} else {
				return false;
			}
		}

		return $meta;
	}
endif;

/* Get page meta with default values */
if ( !function_exists( 'sdw_get_page_meta' ) ):
	function sdw_get_page_meta( $post_id, $field = false ) {

		$defaults = array(
			'use_sidebar' => 'inherit',
			'sidebar' => 'inherit',
			'sticky_sidebar' => 'inherit',
			'layout' => 'inherit'
		);

		$meta = get_post_meta( $post_id, '_sdw_meta', true );
		$meta = wp_parse_args( (array) $meta, $defaults );

		if ( $field ) {
			if ( isset( $meta[$field] ) ) {
				return $meta[$field];
			} else {
				return false;
			}
		}

		return $meta;
	}
endif;

/* Get category meta with default values */
if ( !function_exists( 'sdw_get_category_meta' ) ):
	function sdw_get_category_meta( $cat_id = false, $field = false ) {

		$defaults = array(
			'use_sidebar' => 'inherit',
			'sidebar' => 'inherit',
			'sticky_sidebar' => 'inherit',
			'layout' => 'inherit',
			'cover' => ''
		);

		if ( $cat_id ) {
			$meta = get_option( '_sdw_category_'.$cat_id );
			$meta = wp_parse_args( (array) $meta, $defaults );
		} else {
			$meta = $defaults;
		}

		if ( $field ) {
			if ( isset( $meta[$field] ) ) {
				return $meta[$field];
			} else {
				return false;
			}
		}

		return $meta;
	}
endif;


/* Detect WordPress template */
if ( !function_exists( 'sdw_detect_template' ) ):
	function sdw_detect_template() {

		global $sdw_current_template;

		if ( !empty( $sdw_current_template ) ) {
			return $sdw_current_template;
		}

		if ( is_single() ) {
			$template = 'single';
		} else if ( is_page_template( 'template-home.php' ) ) {
				$template = 'home';
			} else if ( is_page() ) {
				$template = 'page';
			} else if ( is_category() ) {
				$template = 'category';
			} else if ( is_tag() ) {
				$template = 'tag';
			} else if ( is_search() ) {
				$template = 'search';
			} else if ( is_author() ) {
				$template = 'author';
			} else if ( is_archive() ) {
				$template = 'archive';
			} else {
			$template = 'archive';
		}

		$sdw_current_template = $template;

		return $template;
	}
endif;


/* Get post format icon */
if ( !function_exists( 'sdw_post_format_icon' ) ):
	function sdw_post_format_icon( $layout = false ) {

		if ( !$layout || sdw_get_option( $layout.'_icon' ) ) {
			$format = get_post_format();

			$icons = array(
				'video' => 'fa-play',
				'audio' => 'fa-music',
				'image' => 'fa-camera',
				'gallery' => 'fa-picture-o'
			);

			//Allow plugins or child themes to modify icons
			$icons = apply_filters( 'sdw_post_format_icons', $icons );

			if ( $format && array_key_exists( $format, $icons ) ) {
				return $icons[$format];
			}
		}

		return false;
	}
endif;

/* Get current cover image and data */
if ( !function_exists( 'sdw_get_default_cover_image' ) ):
	function sdw_get_default_cover_image() {

		$cover_img = sdw_get_option_media( 'cover_image' );
		if ( !empty( $cover_img ) ) {
			$cover_img_id = sdw_get_image_id_by_url( $cover_img );
			if ( !empty( $cover_img_id ) ) {
				$cover_img = wp_get_attachment_image( $cover_img_id, 'sdw-cover' );
			} else {
				$cover_img = '<img src="'.esc_url( $cover_img ).'"/>';
			}
		}

		return $cover_img;

	}
endif;

/* Get current cover image and data */
if ( !function_exists( 'sdw_get_cover_data' ) ):
	function sdw_get_cover_data() {

		global $sdw_cover_data;

		if ( !empty( $sdw_cover_data ) ) {
			return $sdw_cover_data;
		}


		$data = array(
			'img' => '',
			'title' => '',
			'content' => ''
		);

		if ( is_page_template( 'template-home.php' ) ) {

			global $post;
			$page_content = get_post_field( 'post_content', $post->ID );
			if ( !empty( $page_content ) ) {
				$data['content'] = wpautop( do_shortcode( $page_content ) );
			}

			if ( sdw_get_option( 'home_cover' ) ) {
				if ( has_post_thumbnail( get_the_ID() ) ) {
					$data['img'] = get_the_post_thumbnail( get_the_ID(), 'sdw-cover' );
				} else {
					$data['img'] = sdw_get_default_cover_image();
				}
			}

		} else if ( is_single() ) {
				$layout = sdw_get_post_meta( get_the_ID(), 'layout' );
				$layout = $layout == 'inherit' ? sdw_get_option( 'single_layout' ) : $layout;

				if ( $layout == 'cover' ) {

					if ( has_post_thumbnail() ) {
						$data['img'] = get_the_post_thumbnail( get_the_id(), 'sdw-cover' );
					} else {
						$data['img'] = sdw_get_default_cover_image();
					}

					if ( sdw_get_option( 'show_cat' ) ) {
						$data['content'] .= '<div class="entry-categories">'. get_the_category_list(). '</div>';
					}

					$data['content'].= '<h1 class="entry-title">'.get_the_title().'</h1>';

					if ( $meta = sdw_get_meta_data( 'single' ) ) {
						$data['content'].= '<div class="entry-meta">'.$meta.'</div>';
					}

					if ( sdw_get_option( 'show_cover_excerpt' ) && has_excerpt() ) {
						$data['content'] .= wpautop( get_the_excerpt() );
					}
				}

			} else if ( is_page() ) {
				$layout = sdw_get_page_meta( get_the_ID(), 'layout' );
				$layout = $layout == 'inherit' ? sdw_get_option( 'page_layout' ) : $layout;
				if ( $layout == 'cover' ) {
					if ( has_post_thumbnail() ) {
						$data['img'] = get_the_post_thumbnail( get_the_id(), 'sdw-cover' );
					} else {
						$data['img'] = sdw_get_default_cover_image();
					}

					$data['content'].= '<h1 class="entry-title">'.get_the_title().'</h1>';

					if ( sdw_get_option( 'page_first_p' ) ) {

						$page_content = get_post_field( 'post_content', get_the_ID() );
						if ( !empty( $page_content ) ) {
							$page_content = wpautop( do_shortcode( $page_content ) );
							$page_content = sdw_get_first_p( $page_content );
							if ( !empty( $page_content ) ) {
								$data['content'].= $page_content;
								add_filter( 'the_content', 'sdw_strip_first_p', 99, 1 );
							}
						}
					}
				}

			} else if ( is_front_page() ) {
				// skip
			} else if ( is_category() ) {
				$data['title'] = __sdw( 'category' ).single_cat_title( '', false );
				$data['content'] = category_description();
				if ( sdw_get_option( 'category_cover' ) ) {
					$obj = get_queried_object();
					$cat_cover = sdw_get_category_meta( $obj->term_id, 'cover' );
					if ( !empty( $cat_cover ) ) {
						$cover_img_id = sdw_get_image_id_by_url( $cat_cover );
						if ( !empty( $cover_img_id ) ) {
							$data['img'] = wp_get_attachment_image( $cover_img_id, 'sdw-cover' );
						} else {
							$data['img'] = '<img src="'.esc_url( $cat_cover ).'" />';
						}
					} else {
						$data['img'] = sdw_get_default_cover_image();
					}
				}
			} else if ( is_author() ) {
				$obj = get_queried_object();
				if ( sdw_get_option( 'author_avatar' ) ) {
					$data['content'] = '<div class="sdw-avatar">'.get_avatar( get_the_author_meta( 'ID', $obj->ID ), 90 ).'</div>';
				}
				$data['content'] .= '<h1>'.__sdw( 'author' ).$obj->display_name.'</h1>';
				if ( sdw_get_option( 'author_cover' ) ) {
					$data['img'] = sdw_get_default_cover_image();
				}
				if ( sdw_get_option( 'author_desc' ) ) {
					$data['content'] .= wpautop( get_the_author_meta( 'description', $obj->ID ) );
				}


			} else if ( is_tax() ) {
				$data['title'] = single_term_title( '', false );
				if ( sdw_get_option( 'archive_cover' ) ) {
					$data['img'] = sdw_get_default_cover_image();
				}
			} else if ( is_tag() ) {
				$data['title'] = __sdw( 'tag' ).single_tag_title( '', false );
				$data['content'] = tag_description();
				if ( sdw_get_option( 'tag_cover' ) ) {
					$data['img'] = sdw_get_default_cover_image();
				}
			} else if ( is_search() ) {
				$data['title'] = __sdw( 'search_results_for' ).get_search_query();
				if ( sdw_get_option( 'search_cover' ) ) {
					$data['img'] = sdw_get_default_cover_image();
				}
			} else if ( is_home() && ( $posts_page = get_option( 'page_for_posts' ) ) ) {
				$data['title'] = get_the_title( $posts_page );

				$layout = sdw_get_page_meta( $posts_page, 'layout' );
				$layout = $layout == 'inherit' ? sdw_get_option( 'page_layout' ) : $layout;
				if ( $layout == 'cover' ) {

					if ( has_post_thumbnail( $posts_page ) ) {
						$data['img'] = get_the_post_thumbnail( $posts_page, 'sdw-cover' );
					} else {
						$data['img'] = sdw_get_default_cover_image();
					}

					$page_content = get_post_field( 'post_content', $posts_page );
					if ( !empty( $page_content ) ) {
						$page_content = wpautop( do_shortcode( $page_content ) );
						$page_content = sdw_get_first_p( $page_content );
						if ( !empty( $page_content ) ) {
							$data['content'] = $page_content;
						}
					}
				}

			} else if ( is_day() ) {
				$data['title'] = __sdw( 'archive' ).get_the_date();
				if ( sdw_get_option( 'archive_cover' ) ) {
					$data['img'] = sdw_get_default_cover_image();
				}
			} else if ( is_month() ) {
				$data['title'] = __sdw( 'archive' ).get_the_date( 'F Y' );
				if ( sdw_get_option( 'archive_cover' ) ) {
					$data['img'] = sdw_get_default_cover_image();
				}
			} else if ( is_year() ) {
				$data['title'] = __sdw( 'archive' ).get_the_date( 'Y' );
				if ( sdw_get_option( 'archive_cover' ) ) {
					$data['img'] = sdw_get_default_cover_image();
				}
			} else if ( is_404() ) {
				$data['title'] = __sdw( '404_title' );
				$data['content'] = wpautop( __sdw( '404_subtitle' ) );

				if ( $cover_img = sdw_get_option_media( '404_img' ) ) {
					$cover_img_id = sdw_get_image_id_by_url( $cover_img );
					if ( !empty( $cover_img_id ) ) {
						$data['img'] = wp_get_attachment_image( $cover_img_id, 'sdw-cover' );
					} else {
						$data['img'] = '<img src="'.esc_url( $cover_img ).'"/>';
					}

				} else {
					$data['img'] = sdw_get_default_cover_image();
				}
			}

		$sdw_cover_data = $data;

		return $data;
	}
endif;

/* Strip first p from page content if p is already displayed in cover area */
if ( !function_exists( 'sdw_strip_first_p' ) ):
	function sdw_strip_first_p( $content ) {
		if ( is_page() ) {
			$p = sdw_get_first_p( $content );
			if ( !empty( $p ) ) {
				$content = str_replace( $p, '', $content );
			}
			remove_filter( 'the_content', 'sdw_strip_first_p' );
		}
		return $content;
	}
endif;

/* Get home page posts */
if ( !function_exists( 'sdw_home_page_query' ) ):
	function sdw_home_page_query() {

		$args = array( 'post_type'=>'post' );

		//Check if we are on paginated home page
		if ( is_front_page() ) {
			$args['paged'] = get_query_var( 'page' );
			global $paged;
			$paged = $args['paged'];
		} else {
			$args['paged'] = get_query_var( 'paged' );
		}

		$orderby = sdw_get_option( 'home_order' );

		if ( $orderby != 'manual' ) {

			//Orderby
			if ( $orderby == 'views' && function_exists( 'ev_get_meta_key' ) ) {
				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = ev_get_meta_key();
			} else {
				$args['orderby'] =  $orderby;
			}

			//Time
			if ( $time_diff = sdw_get_option( 'home_time' ) ) {
				$args['date_query'] = array( 'after' => date( 'Y-m-d', sdw_calculate_time_diff( $time_diff ) ) );
			}

			//Cat
			$cats = sdw_get_option( 'home_cat' );
			if ( !empty( $cats ) ) {
				$args['cat'] = implode( ",", $cats );
			}

			//Tag
			$tags = sdw_get_option( 'home_tag' );
			if ( !empty( $tags ) ) {
				$args['tag__in'] =  $tags;
			}

			//Posts per page
			$layout = sdw_get_current_post_layout();
			$ppp = sdw_get_option( 'lay_'.$layout.'_ppp' );
			if ( $ppp == 'custom' ) {
				$args['posts_per_page'] = absint( sdw_get_option( 'lay_'.$layout.'_ppp_num' ) );
			}

		} else {

			//Pick manual posts
			if ( $manual_posts = sdw_get_option( 'home_manual_force' ) ) {
				$manual_posts = explode( ",", $manual_posts );
			} else {
				$manual_posts = sdw_get_option( 'home_manual' );
			}

			$args['orderby'] =  'post__in';
			$args['post__in'] =  $manual_posts;
		}


		//Exclude posts from featured area
		global $sdw_home_fa_posts;

		if ( isset( $sdw_home_fa_posts ) && !empty( $sdw_home_fa_posts ) ) {
			$args['post__not_in'] = $sdw_home_fa_posts;
		}

		//Get posts for home page
		$query = new WP_Query( $args );

		return $query;
	}
endif;

/* Get featured area posts */
if ( !function_exists( 'sdw_fa_query' ) ):
	function sdw_fa_query() {

		$args = array( 'post_type'=>'post', 'ignore_sticky_posts' => 1 );

		$orderby = sdw_get_option( 'home_fa_order' );

		if ( $orderby != 'manual' ) {

			//Orderby
			if ( $orderby == 'views' && function_exists( 'ev_get_meta_key' ) ) {
				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = ev_get_meta_key();
			} else {
				$args['orderby'] =  $orderby;
			}

			//Time
			if ( $time_diff = sdw_get_option( 'home_fa_time' ) ) {
				$args['date_query'] = array( 'after' => date( 'Y-m-d', sdw_calculate_time_diff( $time_diff ) ) );
			}

			//Cat
			$cats = sdw_get_option( 'home_fa_cat' );
			if ( !empty( $cats ) ) {
				$args['cat'] = implode( ",", $cats );
			}

			//Tag
			$tags = sdw_get_option( 'home_fa_tag' );
			if ( !empty( $tags ) ) {
				$args['tag__in'] =  $tags;
			}

			$args['posts_per_page'] = absint( sdw_get_option( 'home_fa_limit' ) );

		} else {

			//Pick manual posts
			if ( $manual_posts = sdw_get_option( 'home_fa_manual_force' ) ) {
				$manual_posts = explode( ",", $manual_posts );
			} else {
				$manual_posts = sdw_get_option( 'home_fa_manual' );
			}

			$args['orderby'] =  'post__in';
			$args['post__in'] =  $manual_posts;
		}

		//Get posts for featured area
		$query = new WP_Query( $args );

		if ( sdw_get_option( 'home_do_not_duplicate' ) ) {
			global $sdw_home_fa_posts;
			$sdw_home_fa_posts = array();
			if ( !is_wp_error( $query ) && isset( $query->posts ) && !empty( $query->posts ) ) {
				foreach ( $query->posts as $p ) {
					$sdw_home_fa_posts[] = $p->ID;
				}
			}
		}

		return $query;
	}
endif;



/* Get related posts for particular post */
if ( !function_exists( 'sdw_get_related_posts' ) ):
	function sdw_get_related_posts( $post_id = false ) {

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$args['post_type'] = 'post';

		//Exclude current post form query
		$args['post__not_in'] = array( $post_id );

		//If previuos next posts active exclude them too
		if ( sdw_get_option( 'show_prev_next' ) ) {
			$in_same_cat = sdw_get_option( 'prev_next_cat' ) ? true : false;
			$prev = get_previous_post( $in_same_cat );

			if ( !empty( $prev ) ) {
				$args['post__not_in'][] = $prev->ID;
			}
			$next = get_next_post( $in_same_cat );
			if ( !empty( $next ) ) {
				$args['post__not_in'][] = $next->ID;
			}
		}

		$num_posts = absint( sdw_get_option( 'related_limit' ) );
		if ( $num_posts > 100 ) {
			$num_posts = 100;
		}
		$args['posts_per_page'] = $num_posts;
		$args['orderby'] = sdw_get_option( 'related_order' );

		if ( $args['orderby'] == 'views' && function_exists( 'ev_get_meta_key' ) ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = ev_get_meta_key();
		}

		if ( $time_diff = sdw_get_option( 'related_time' ) ) {
			$args['date_query'] = array( 'after' => date( 'Y-m-d', sdw_calculate_time_diff( $time_diff ) ) );
		}

		if ( $type = sdw_get_option( 'related_type' ) ) {
			switch ( $type ) {

			case 'cat':
				$cats = get_the_category( $post_id );
				$cat_args = array();
				if ( !empty( $cats ) ) {
					foreach ( $cats as $k => $cat ) {
						$cat_args[] = $cat->term_id;
					}
				}
				$args['category__in'] = $cat_args;
				break;

			case 'tag':
				$tags = get_the_tags( $post_id );
				$tag_args = array();
				if ( !empty( $tags ) ) {
					foreach ( $tags as $tag ) {
						$tag_args[] = $tag->term_id;
					}
				}
				$args['tag__in'] = $tag_args;
				break;

			case 'cat_and_tag':
				$cats = get_the_category( $post_id );
				$cat_args = array();
				if ( !empty( $cats ) ) {
					foreach ( $cats as $k => $cat ) {
						$cat_args[] = $cat->term_id;
					}
				}
				$tags = get_the_tags( $post_id );
				$tag_args = array();
				if ( !empty( $tags ) ) {
					foreach ( $tags as $tag ) {
						$tag_args[] = $tag->term_id;
					}
				}
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'category',
						'field'    => 'id',
						'terms'    => $cat_args,
					),
					array(
						'taxonomy' => 'post_tag',
						'field'    => 'id',
						'terms'    => $tag_args,
					)
				);
				break;

			case 'cat_or_tag':
				$cats = get_the_category( $post_id );
				$cat_args = array();
				if ( !empty( $cats ) ) {
					foreach ( $cats as $k => $cat ) {
						$cat_args[] = $cat->term_id;
					}
				}
				$tags = get_the_tags( $post_id );
				$tag_args = array();
				if ( !empty( $tags ) ) {
					foreach ( $tags as $tag ) {
						$tag_args[] = $tag->term_id;
					}
				}
				$args['tax_query'] = array(
					'relation' => 'OR',
					array(
						'taxonomy' => 'category',
						'field'    => 'id',
						'terms'    => $cat_args,
					),
					array(
						'taxonomy' => 'post_tag',
						'field'    => 'id',
						'terms'    => $tag_args,
					)
				);
				break;

			case 'author':
				global $post;
				$author_id = isset( $post->post_author ) ? $post->post_author : 0;
				$args['author'] = $author_id;
				break;

			case 'default':
				break;
			}
		}

		$related_query = new WP_Query( $args );

		return $related_query;
	}
endif;

/* Get options for selection of time dependent posts */
if ( !function_exists( 'sdw_get_time_diff_opts' ) ) :
	function sdw_get_time_diff_opts() {

		$options = array(
			'-1 day' => __( '1 Day', THEME_SLUG ),
			'-3 days' => __( '3 Days', THEME_SLUG ),
			'-1 week' => __( '1 Week', THEME_SLUG ),
			'-1 month' => __( '1 Month', THEME_SLUG ),
			'-3 months' => __( '3 Months', THEME_SLUG ),
			'-6 months' => __( '6 Months', THEME_SLUG ),
			'-1 year' => __( '1 Year', THEME_SLUG ),
			'0' => __( 'All time', THEME_SLUG )
		);

		//Allow child themes or plugins to change these options
		$options = apply_filters( 'sdw_modify_time_diff_opts', $options );

		return $options;
	}
endif;

/* Galculate time difference based on timestring */
if ( !function_exists( 'sdw_calculate_time_diff' ) ) :
	function sdw_calculate_time_diff( $timestring ) {

		$now = current_time( 'timestamp' );

		switch ( $timestring ) {
		case '-1 day' : $time = $now - DAY_IN_SECONDS; break;
		case '-3 days' : $time = $now - ( 3 * DAY_IN_SECONDS ); break;
		case '-1 week' : $time = $now - WEEK_IN_SECONDS; break;
		case '-1 month' : $time = $now - ( YEAR_IN_SECONDS / 12 ); break;
		case '-3 months' : $time = $now - ( 3 * YEAR_IN_SECONDS / 12 ); break;
		case '-6 months' : $time = $now - ( 6 * YEAR_IN_SECONDS / 12 ); break;
		case '-1 year' : $time = $now - ( YEAR_IN_SECONDS ); break;
		default : $time = $now;
		}

		return $time;
	}
endif;


/* Get options for selection of post ordering */
if ( !function_exists( 'sdw_get_post_order_opts' ) ) :
	function sdw_get_post_order_opts( $args = array() ) {

		$options = array(
			'date' => __( 'Date', THEME_SLUG ),
			'comment_count' => __( 'Number of comments', THEME_SLUG ),
			'views' => __( 'Number of views', THEME_SLUG ),
			'rand' => __( 'Random', THEME_SLUG ),
			'manual' => __( 'Manual', THEME_SLUG ),
		);

		if ( isset( $args['exclude'] ) && !empty( $args['exclude'] ) ) {
			foreach ( $args['exclude'] as $option ) {
				unset( $options[$option] );
			}
		}

		//Allow child themes or plugins to change these options
		$options = apply_filters( 'sdw_modify_post_order_opts', $options );

		return $options;
	}
endif;


/* Compares two values and sanitazes 0 */
if ( !function_exists( 'sdw_compare' ) ):
	function sdw_compare( $a, $b ) {
		return (string) $a === (string) $b;
	}
endif;

/* 	Calculate reading time by content length */
if ( !function_exists( 'sdw_read_time' ) ):
	function sdw_read_time( $text ) {
		$words = str_word_count( strip_tags( $text ) );
		if ( !empty( $words ) ) {
			$time_in_minutes = ceil( $words / 200 );
			return $time_in_minutes;
		}
		return false;
	}
endif;

/* Check if post is paginated */
if ( !function_exists( 'sdw_is_paginated_post' ) ):
	function sdw_is_paginated_post() {

		global $multipage;
		return 0 !== $multipage;

	}
endif;

/* Get settings to pass to main JS file */
if ( !function_exists( 'sdw_get_js_settings' ) ):
	function sdw_get_js_settings() {
		global $sdw_rtl;
		$js_settings = array();
		$js_settings['sticky_header'] = sdw_get_option( 'sticky_header' ) ? true : false;
		$js_settings['sticky_header_offset'] = absint( sdw_get_option( 'sticky_header_offset' ) );
		$js_settings['logo_retina'] = sdw_get_option_media( 'logo_retina' );
		$js_settings['rtl_mode'] = sdw_is_rtl() ? 'true' : 'false';
		$js_settings['lay_fa_autoplay'] = sdw_get_option( 'lay_fa_autoplay' ) ? 'true' : 'false';
		$protocol = is_ssl() ? 'https://' : 'http://';
		$js_settings['ajax_url'] = admin_url( 'admin-ajax.php', $protocol );

		return $js_settings;
	}
endif;

/* Parse font option */
if ( !function_exists( 'sdw_get_font_option' ) ):
	function sdw_get_font_option( $option = false ) {

		$font = sdw_get_option( $option );
		$native_fonts = sdw_get_native_fonts();
		if ( !in_array( $font['font-family'], $native_fonts ) ) {
			$font['font-family'] = "'".$font['font-family']."'";
		}

		return $font;
	}
endif;

/* Parse background option */
if ( !function_exists( 'sdw_get_bg_styles' ) ):
	function sdw_get_bg_styles( $option = false ) {

		$style = sdw_get_option( $option );
		$css = '';

		if ( ! empty( $style ) && is_array( $style ) ) {
			foreach ( $style as $key => $value ) {
				if ( ! empty( $value ) && $key != "media" ) {
					if ( $key == "background-image" ) {
						$css .= $key . ":url('" . $value . "');";
					} else {
						$css .= $key . ":" . $value . ";";
					}
				}
			}
		}


		return $css;
	}
endif;


/* Get update notification */
if ( !function_exists( 'sdw_get_update_notification' ) ):
	function sdw_get_update_notification() {
		$current = get_site_transient( 'update_themes' );
		$message_html = '';
		if ( isset( $current->response['sidewalk'] ) ) {
			$message_html = '<span class="update-message">New update available!</span>
				<span class="update-actions">Version '.$current->response['sidewalk']['new_version'].': <a href="http://demo.mekshq.com/sidewalk/documentation#changelog" target="blank">See what\'s new</a><a href="'.admin_url( 'update-core.php' ).'">Update</a></span>';
		}

		return $message_html;
	}
endif;

/* Check if gravatar exists */
if ( !function_exists( 'sdw_is_valid_gravatar' ) ):
	function sdw_is_valid_gravatar( $id_or_email ) {
		//id or email code borrowed from wp-includes/pluggable.php
		$email = '';
		if ( is_numeric( $id_or_email ) ) {
			$id = (int) $id_or_email;
			$user = get_userdata( $id );
			if ( $user )
				$email = $user->user_email;
		} elseif ( is_object( $id_or_email ) ) {
			// No avatar for pingbacks or trackbacks
			$allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
			if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) )
				return false;

			if ( !empty( $id_or_email->user_id ) ) {
				$id = (int) $id_or_email->user_id;
				$user = get_userdata( $id );
				if ( $user )
					$email = $user->user_email;
			} elseif ( !empty( $id_or_email->comment_author_email ) ) {
				$email = $id_or_email->comment_author_email;
			}
		} else {
			$email = $id_or_email;
		}

		$hashkey = md5( strtolower( trim( $email ) ) );
		$protocol = is_ssl() ? 'https' : 'http';
		$uri = $protocol.'://www.gravatar.com/avatar/' . $hashkey . '?d=404';

		$data = wp_cache_get( $hashkey );
		if ( false === $data ) {
			$response = wp_remote_head( $uri );
			if ( is_wp_error( $response ) ) {
				$data = 'not200';
			} else {
				$data = $response['response']['code'];
			}
			wp_cache_set( $hashkey, $data, $group = '', $expire = 60*5 );

		}
		if ( $data == '200' ) {
			return true;
		} else {
			return false;
		}
	}
endif;



?>
