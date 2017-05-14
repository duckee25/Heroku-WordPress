<?php

	global $wp_query,
		$post, 
		$layout, 
		$pix_sort, 
		$page_template, 
		$page_sidebar, 
		$posts_per_page, 
		$the_post_type, 
		$pagenavi, 
		$shortcode_found, 
		$excerpt_lines,
		$pix_order,
		$pix_sort_by_tag,
		$pix_price,
		$pix_linkto,
	    $pix_titles,
	    $pix_more,
	    $pix_like,
	    $pix_comments,
	    $pix_meta,
	    $args_shortcode_found,
	    $query_shortcode_found,
	    $wp_version,
	    $mediaelement_en,
	    $woo_shortcode,
	    $product_categories,
	    $woocommerce_loop;
	    $woocommerce_loop['show_products'] = true;
	    $entry_content = '';
	    $woocommerce_product_subcategories = false;

	$inner_shortcode_found = ( $args_shortcode_found==true || $query_shortcode_found==true ) ? true : false;

	$page_ID = is_home() ? get_option('page_for_posts') : $post->ID;

	$side_alignment =  pix_get_option('pix_aside_position') == 'right' ? 'left' : 'right';

	if ( is_home() ) {
			$posts_per_page = get_option('posts_per_page');
	} else {
		$posts_per_page = $posts_per_page;
	}

	if ( pix_is_woocommerce() ) {
		$post__in = array_unique( apply_filters( 'loop_shop_post_in', array() ) );
	} else {
		$post__in = 0;
	}

	if ( is_front_page() ) {
		$paged = (get_query_var('page')) ? get_query_var('page') : 1;	
	} else {
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;	
	}

	if ( is_home() ) {
		$excerpt_lines = pix_get_option('pix_posts_page_excerpt_length');
	} elseif ( is_archive() ) {
		$excerpt_lines = $excerpt_lines;
	}

	if ( (pix_is_woocommerce() && $pix_price=='true') || $pix_order != 'true' ) {
		$sort_align = 'alignleft';
	} else {
		$sort_align = 'alignright';
	}

	if ( $the_post_type=='post' ) {
		$enable_like_button = pix_get_option('pix_like_posts');
		$pix_date_posts = pix_get_option('pix_date_posts');
		$pix_author_posts =  pix_get_option('pix_author_posts');
	} elseif ( $the_post_type=='portfolio' ) {
		$enable_like_button = pix_get_option('pix_like_portfolio');
		$pix_date_posts = pix_get_option('pix_date_portfolio');
		$pix_author_posts =  'false';
	} else {
		$enable_like_button = '';
		$pix_date_posts = '';
		$pix_author_posts =  'false';
	}

	if ( $pix_like == '' ) {
		$pix_like = $enable_like_button;
	}

?>

<?php 
    if ( pix_is_woocommerce() ) {
        if (!isset($_SESSION[$the_post_type.'_sort'])||$_SESSION[$the_post_type.'_sort']=='') {
        	$_SESSION[$the_post_type.'_sort'] = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
        }
    } else {
        if (!isset($_SESSION[$the_post_type.'_sort'])||$_SESSION[$the_post_type.'_sort']=='') {
        	$_SESSION[$the_post_type.'_sort'] = 'date';
        }
        if (!isset($_SESSION[$the_post_type.'_order'])||$_SESSION[$the_post_type.'_order']=='') $_SESSION[$the_post_type.'_order'] = 'DESC';
    }
    foreach ($_POST as $key => $value) {
        $_SESSION[$key] = $value;
    }
    if ( $_SESSION[$the_post_type.'_sort']=='price-desc' ) {
    	$_SESSION[$the_post_type.'_sort']='price';
    }
    if ( pix_is_woocommerce() && !isset($_SESSION[$the_post_type.'_order']) ) {
    	if (  get_option('woocommerce_default_catalog_orderby')=='menu_order' || get_option('woocommerce_default_catalog_orderby')=='price' ) {
            $_SESSION[$the_post_type.'_order']='ASC';
        } else {
            $_SESSION[$the_post_type.'_order']='DESC';
        }
    }
?>
			<div class="wrap_filter">

<?php if ( !$inner_shortcode_found ) { ?>

               <div class="pix_column pix_column_990 pix_loop_third">
                	<?php if ( !isset($page_template) || $page_template == 'default' ) {
                    	$template_class = ' pix_column_730 align'.$side_alignment;
                    } else {
                     	$template_class = ' pix_column_990';
                    } ?>
                    <div class="pix_column<?php echo $template_class; ?>">
<?php } ?>
                   
                	<?php if ( $pix_sort == 'true' ) { ?>

                    <section class="filters_section">

                        <div class="pix_column filters_wrap">
                            <?php if ( $layout == 'ninth' || $layout == 'tenth' ) { ?><div class="pix_column pix_column_990"><?php } ?>

                        <?php if ( $pix_order == 'true' ) { ?>
                            <div class="alignleft order_filter filter_box">
                                <form class="order_list alignleft" method="POST">
                                    <label><?php _e('Order by:','forte') ?></label>
                                    <select name="<?php echo $the_post_type; ?>_sort" class="orderby">
                                        <?php
                                        if ( pix_is_woocommerce() ) {
                                        	if ( version_compare( WOOCOMMERCE_VERSION, '2.0', '<' ) ) {
	                                            $catalog_orderby = array(
	                                                'menu_order title' => __('Default', 'forte'),
	                                                'price' => __('Price', 'forte'),
	                                                'date' => __('Date', 'forte'),
	                                                'name' => __('Name', 'forte')
	                                            );
	                                        } else {
	                                            $catalog_orderby = array(
													'menu_order title' => __( 'Default', 'forte' ),
													'popularity' => __( 'Popularity', 'forte' ),
													'rating'     => __( 'Average rating', 'forte' ),
													'date'       => __( 'Newness', 'forte' ),
													'price'      => __( 'Price', 'forte' ),
												);
											}
											if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
												unset( $catalog_orderby['rating'] );
                                        } else {
                                              $catalog_orderby = array(
                                                'date'      => __('Date', 'forte'),
                                                'name'  => __('Name', 'forte')
                                            );
                                        }
                                
                                            foreach ($catalog_orderby as $id => $name) echo '<option value="'.$id.'" '.selected( $_SESSION[$the_post_type.'_sort'], $id, false ).'>'.$name.'</option>';
                                        ?>
                                    </select>
									<?php
                                        if ( pix_is_woocommerce() && version_compare( WOOCOMMERCE_VERSION, '2.0', '>=' ) ) {
											foreach ( $_GET as $key => $val ) {
												if ( 'orderby' == $key )
													continue;
												echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
											}
										}
									?>
                                    <div class="alignleft order_icons">
				                        <?php if ( pix_is_woocommerce() && $_SESSION[$the_post_type.'_sort']!='rating' ) { ?>
	                                        <a href="#" class="order_desc <?php if($_SESSION[$the_post_type.'_order']=='DESC') echo 'selected'; ?>" data-value="DESC"><i class="icon-arrow-down"></i></a>
	                                        <a href="#" class="order_asc <?php if($_SESSION[$the_post_type.'_order']=='ASC') echo 'selected'; ?>" data-value="ASC"><i class="icon-arrow-up"></i></a>
	                                        <?php if (!$query_shortcode_found) { ?><input type="hidden" name="post_type" value="<?php echo $the_post_type; ?>"><?php } ?>
	                                        <input type="hidden" data-name="order-arrows" name="<?php echo $the_post_type; ?>_order" value="<?php echo $_SESSION[$the_post_type.'_order']; ?>">
	                                    <?php } ?>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                        
                        <?php if ( $pix_sort_by_tag == 'true' ) {

                                $code_array = array();
                                $code_array2 = array();

                                $args_related['posts_per_page'] = "100000000000000000000000000000";
		                        if ( isset($the_post_type) && $the_post_type!='' )
			                        $args_related['post_type'] = $the_post_type;

		                        $args_related['paged'] = '0';
								$sort_query = new wp_query( $args_related );
                                while ( $sort_query->have_posts() ) : $sort_query->the_post();

                                	if ( $the_post_type == 'portfolio') {
		                                $terms_ar = get_the_terms( $post->ID, 'portfolio_tag' ); 
	                                } elseif ( $the_post_type == 'product') {
		                                $terms_ar = get_the_terms( $post->ID, 'product_tag' ); 
	                                } else {
	                                    $terms_ar = get_the_tags( $post->ID ); 
		                            }

                                    if($terms_ar){
                                        foreach( $terms_ar as $term ) {
                                            if(!in_array($term->slug,$code_array)){
                                                $code_array[] = $term->slug;
                                            }
                                            if(!in_array($term->name,$code_array2)){
                                                $code_array2[] = $term->name;
                                            }
                                            unset($term);
                                        }
	                                }
                               endwhile; 

                                if(count($code_array)!=0 && count($code_array2)!=0) {
                                    $code_array3 = pix_array_combine($code_array, $code_array2);
                                    asort($code_array3);
                                    echo '<div class="'.$sort_align.' sort_filter filter_box">
                                        <form class="sort_tags '.$sort_align.'" method="POST">
                                                <label>'. __('Show:','forte') .'</label>';
                                
    
                                        echo "<select class='sort_select'>
                                                <option value='all'>". __('All','forte') ."</option>\r\n";
                                    
                                        foreach( $code_array3 as $key => $value ) {
                                            echo "<option value='$key'>$value</option>\r\n";
                                        }
                                        echo '</select>';
                                        echo "<select class='sort_select hidden_div letmebe' disabled='disabled'>
                                                <option value='all'>". __('All','forte') ."</option>\r\n";
                                    
                                        foreach( $code_array3 as $key => $value ) {
                                            echo "<option value='$key'>$value</option>\r\n";
                                        }
                                        echo '</select>
                                        </form>
                                    </div>';
                                }
                                wp_reset_postdata();
                    
                        } ?>

                        <?php if ( pix_is_woocommerce() && $pix_price=='true' ) { ?>
                        <div class="alignright filter_box price_filter">
                        	<div class="alignright">
	                        	<label><?php _e('Price range:','forte'); ?></label>
	                        	<span class="select_wrap">
	                        		<span class="select_fake alignleft pos_relative">
	                        			<span class="fake_text" style="display:block">
	                        				&euro;0 — &euro;0
	                        			</span>
	                        			<div class="dd_arrow">
	                        				<i class="icon-caret-down"></i>
	                        			</div>
	                        		</span>
			                    	<?php dynamic_sidebar('filter_price_sidebar');  ?>
	                        	</span>
	                        </div>
                        </div>
                        <?php } ?>

                    </div><!-- .pix_column_990 -->

                    </section>

                    <div class="clear"></div>

 						<?php if ( $shortcode_found ) {

							$the_content = get_the_content();
							$the_content = preg_replace('|\[pix_categories(.*?)\]|','',$the_content);
							$the_content = preg_replace('|\[pix_galleries(.*?)\]|','',$the_content);
							echo html5autop(do_shortcode($the_content));

						} ?>

                    <?php } ?>
                        

						<?php

						if ( $args_shortcode_found ) {
							global $args;
						} elseif ( $query_shortcode_found ) {
							global $args;
						} else {
                            $args = $wp_query->query_vars;

                            $args['orderby'] = $_SESSION[$the_post_type.'_sort'];
                            if ($args['orderby'] == 'menu_order') {
								$args['orderby'] = 'menu_order title';
                            } elseif ($args['orderby'] == 'price') {
								$args['meta_key'] = '_price';
								$args['orderby'] = 'meta_value_num';
                            } elseif ($args['orderby'] == 'popularity') {
								$args['meta_key'] = 'total_sales';
								$args['orderby'] = 'meta_value_num';
                            } elseif ($args['orderby'] == 'rating') {
								$args['meta_key'] = '';
								$args['orderby'] = 'menu_order title';
								$get_catalog_ordering_args = new WC_Query();
								add_filter( 'posts_clauses', array( $get_catalog_ordering_args, 'order_by_rating_post_clauses' ) );
                            } 
                            $args['order'] = $_SESSION[$the_post_type.'_order'];
                            $args['posts_per_page'] = $posts_per_page;
                            $args['post__in'] = $post__in;
	                        if ( isset($the_post_type) && $the_post_type!='' )
		                        $args['post_type'] = $the_post_type;
                        }
                        $args['paged'] = $paged;

							$my_query = new wp_query( $args );

						?>	
                        
						<?php if ( $my_query->have_posts() ) : ?>

						<?php if ( pix_is_woocommerce() ) {
							do_action('woocommerce_before_shop_loop');
							woocommerce_product_loop_start();
						} ?>

						<div class="pix_load_content">
            
							<?php if ( pix_is_woocommerce() ) {
								$woocommerce_product_subcategories = woocommerce_product_subcategories();
								do_action('pix_after_woo_cats');
							} ?>
							<?php
								if ( $product_categories != '' ) {
									foreach ( $product_categories as $category ) {

										wc_get_template( 'content-product_cat.php', array(
											'category' => $category
										) );

									}
								} elseif ( 
									(pix_is_shop() && get_option( 'woocommerce_shop_page_display' ) != 'subcategories') 
									||
									(pix_is_product_category() && $wp_query->post_count!=0)
									||
									(!pix_is_shop() && !pix_is_product_category())
									||
									(pix_is_woocommerce() && (is_search() || pix_is_filtered() || is_paged()))
								) {
							?>

                            <?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

                        <?php global $product; if ( (pix_is_woocommerce() && $product->is_visible() && $woocommerce_loop['show_products']) || !pix_is_woocommerce() ) { ?>

                            <?php                            
								$dataSort = 'all ';

                            	if ( $the_post_type == 'portfolio') {
	                                $terms_ar = get_the_terms( $post->ID, 'portfolio_tag' ); 
                                } elseif ( $the_post_type == 'product') {
	                                $terms_ar = get_the_terms( $post->ID, 'product_tag' ); 
                                } else {
                                    $terms_ar = get_the_tags( $post->ID ); 
	                            }

								if($terms_ar){
									foreach ($terms_ar as $term) { 
										$dataSort .= $term->slug.' ';
									}
								} 
							?>

                               <div class="entry post-id-<?php echo get_the_id(); ?>" data-sort="<?php echo $dataSort; ?>">
                                
									<?php
                                        $pix_pag_opts_subtitle = get_post_meta( get_the_id(), 'pix_pag_opts_subtitle', true );
										$subtitle = $pix_pag_opts_subtitle != '' ? '<h6>'. $pix_pag_opts_subtitle .'</h6>' : '';

										switch ( $layout ) {
											case 'first' :
												$thumb_size = 'two_columns_4_3';
												$column_size = 'pix_column_470';
												$thumb_width = 470;
												$thumb_height = 352;
												$clear = '';
												break;
											case 'second' :
												$thumb_size = 'one_column_thumb';
												$column_size = 'pix_column_210';
												$thumb_width = 210;
												$thumb_height = 132;
												$clear = '';
												break;
											case 'third' :
												$thumb_size = 'one_column_4_3';
												$column_size = 'pix_column_210';
												$thumb_width = 210;
												$thumb_height = 157;
												$clear = '';
												break;
											case 'fourth' :
												$thumb_size = ($page_template != 'default') ? 'three_columns_thumb' : 'three_columns';
												$column_size = 'pix_column_730';
												$thumb_width = 730;
												$thumb_height = 410;
												$clear = ($page_template != 'default') ? '' : 'clear';
												break;
											case 'fifth' :
												$thumb_size = ($page_template != 'default') ? 'four_columns' : 'three_columns';
												$column_size = ($page_template != 'default') ? 'pix_column_990' : 'pix_column_730';
												$thumb_width = ($page_template != 'default') ? 990 : 730;;
												$thumb_height = 'auto';
												$clear = 'clear';
												break;
											default :
												$thumb_size = 'two_columns_thumb';
												$column_size = 'pix_column_470';
												$thumb_width = 470;
												$thumb_height = 264;
												$clear = '';
										}
									?>


									<?php 
									
										if ( ($pix_titles!='0' && $pix_titles!='false') ) {
											echo '<h4><a href="'. get_permalink(). '" title="'. sprintf( esc_attr__( 'Go to %s', 'forte' ), the_title_attribute( 'echo=0' ) ) .'" rel="bookmark">'. get_the_title() .'</a></h4>'.PHP_EOL.$subtitle;
										}

									if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || 
                                				( get_post_type( $post ) == 'portfolio' && get_post_meta($post->ID, 'pix_post_format', true)=='gallery')  ) { 

                                    	$the_content = get_the_content();

										echo '<div class="gallery-post-format pix_column pix_column_thumb pix_column_featured '.$column_size.' alignleft">';

                                        if ( version_compare($wp_version, '3.5', '>=')  && strpos($the_content,'[gallery') !== false ) {
                                        	preg_match('/\[gallery(.*?)\]/isU', $the_content, $matches);
                                        	echo '<div class="pix_in_shortcode">'.(do_shortcode('[gallery archive="true" thumb="'.$thumb_size.'" linkto="'.$pix_linkto.'" '.$matches[1].']')).'</div>';
                                        } else {
	                                        $attachments = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
	                                        if ( $attachments ) {
												
	                                            foreach ( $attachments as $id => $attachment ) {
	                                                
	                                                $attAttr = wp_get_attachment_image_src($id,$thumb_size);
	                                                
	                                                if ( !isset($max_height) || $max_height > $attAttr[2] ) {
	                                                    $max_width = $attAttr[1];
	                                                    $max_height = $attAttr[2];
	                                                }
	                                            }
	                                        }

														echo '<div class="pix_slideshow pix_slideshow_preloading">
															<div class="pix_canvasloader-container"></div>
															<div class="pix_slideshow_until_image"></div>
															<div
															class="pix_slideshow_target pix_slideshow_preloading"
															style="height: '.$max_height.'px;
																width: '.$max_width.'px;">';
										
											foreach ( $attachments as $id => $attachment ) {
												
												$attAttr = wp_get_attachment_image_src($id,$thumb_size);
												$image = $attAttr[0];
												
													echo '<div><div style="background-color:transparent"
																	data-src="'.$image.'"
																	data-link="'.$full.'"
																	data-use="background"></div>
													<a href="'.wp_get_attachment_url($id).'" class="filmore_link_100 colorbox" data-rel="gallery-'.get_the_id().'">&nbsp;</a></div>';
												
											}
										
											echo '</div>
											<div class="filmore_commands">
												<div class="filmore_prev filmore_command"><i class="icon-prev-slide"></i></div>
												<div class="filmore_next filmore_command"><i class="icon-next-slide"></i></div>
												<div class="filmore_loader hidden_div"></div>
											</div>
										</div>';
											
										}

										echo '</div>';
                                    
                                    } elseif ( ( function_exists( 'get_post_format' ) && 'video' == get_post_format( $post->ID ) ) || 
                                				( get_post_type( $post ) == 'portfolio' && get_post_meta($post->ID, 'pix_post_format', true)=='video')  ) { 
									
										$the_content = get_the_content(); $the_content = apply_filters('the_content', $the_content);

										$iframe_pos = strpos($the_content, '<iframe');
										if ( version_compare($wp_version, '3.5.9', '>=') || $mediaelement_en=='active' ) {
											$video_pos = strpos($the_content, '<div class="video-embedded');	
										} else {
											$video_pos = strpos($the_content, '<div class="pix_flowplayer');
										}

										if ( ($video_pos < $iframe_pos || $iframe_pos=='') && $video_pos!='' ) {
											if ( version_compare($wp_version, '3.5.9', '>=') || $mediaelement_en=='active' ) {
												preg_match('/<div class="video-embedded.*<\/div>/isU', $the_content, $matches);
												$match = preg_replace('|<div class="video-embedded"><div style="(.+?)">|', '<div class="video-embedded">', $matches[0]);
											} else {
												preg_match('/<div class="pix_flowplayer.*<\/div>/isU', $the_content, $matches);
												$match = $matches[0];
											}
											echo '<div class="video-post-format pix_column pix_column_thumb pix_column_featured '.$column_size.' alignleft">
												'.$match.$entry_content.'</div>';
										} else {
											preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $the_content, $src);
											preg_match('/<iframe.*height=\"(.*)\".*><\/iframe>/isU', $the_content, $height);
											$frame_height = $clear=='clear' ? $height[1] : $thumb_height;
											$frame_wrap = $clear=='clear' ? 'div' : 'span';
											echo '<div class="video-post-format pix_column pix_column_thumb pix_column_featured '.$column_size.' alignleft">
												<'.$frame_wrap.'><iframe src="'.$src[1].'" frameborder="0" width="'.$thumb_width.'" height="'.$frame_height.'"></iframe></'.$frame_wrap.'>'.$entry_content.'
											</div>';
										}

                                    } elseif ( ( function_exists( 'get_post_format' ) && 'audio' == get_post_format( $post->ID ) ) || 
                                				( get_post_type( $post ) == 'portfolio' && get_post_meta($post->ID, 'pix_post_format', true)=='audio')  ) { 
									
										$the_content = get_the_content(); $the_content = apply_filters('the_content', $the_content);

										$frame_height = $clear=='clear' ? ($thumb_width*0.2) : $thumb_height;

										if ( version_compare($wp_version, '3.5.9', '>=') || $mediaelement_en=='active' ) {

											preg_match('/<audio.*<\/audio>/isU', $the_content, $matches);
											echo '<div class="audio-post-format pix_column pix_column_thumb pix_column_featured '.$column_size.' alignleft">
												'.$matches[0]
												.$entry_content.'</div>';

										} else {
											preg_match('/data-audio=\"(.*)\"/', $the_content, $matches);
																				
											echo '<div class="audio-post-format pix_column pix_column_thumb pix_column_featured '.$column_size.' alignleft notplaying" style="height:'.$frame_height.'px">
											
												<div class="pix_audio_shortcode"><div id="jquery_jplayer_'.get_the_id().'" class="jp-jplayer" data-mp3="'.$matches[1].'" data-id="'.get_the_id().'"></div>
												
												<div id="jp_container_'.get_the_id().'" class="jp-audio">
		
													<div class="jp-type-single">
												
														<div class="jp-gui jp-interface">
												
															<ul class="jp-controls" style="top: -'.$frame_height*0.5.'px">
																<li><a href="javascript:;" class="jp-play" tabindex="1"></a></li>
																<li><a href="javascript:;" class="jp-pause" tabindex="1"></a></li>
															</ul>
												
															<div class="jp-time-holder">
																<div class="jp-current-time"></div>
												
																<div class="jp-progress">
																	<div class="jp-seek-bar">
																		<div class="jp-play-bar"></div>
																	</div>
																</div>
												
																<div class="jp-duration"></div>
															</div>
												
															<ul class="jp-toggles">
																<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat"></a></li>
																<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off"></a></li>
																<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute"></a></li>
																<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute"></a></li>
																<li>
																	<div class="jp-volume-bar">
																		<div class="jp-volume-bar-value"></div>
																	</div>
																</li>
															</ul>
												
														</div>
												
													</div>
												
												</div></div>
											</div>';
										}

									} elseif ( function_exists( 'get_post_format' ) && 'image' == get_post_format( $post->ID ) ) {
										$th_id = get_post_thumbnail_id( get_the_ID() );
	                                    $image = wp_get_attachment_url( $th_id ); /*$image = $image['image']; $image = preg_replace('|\<a(.*?)<img(.*?)src=[\'"](.*?)[\'"](.*?)<\/a>|', '$3', $image);*/
	                                    $imageTh = get_pix_thumb($image, $thumb_size );
										$captTh = get_post(get_post_thumbnail_id())->post_excerpt != '' ? get_post(get_post_thumbnail_id())->post_excerpt : the_title_attribute( 'echo=0' );

										echo '<div class="pix_column pix_column_thumb pix_column_featured '.$column_size.' alignleft">';
										if ( $pix_linkto == 'colorbox' && !pix_is_woocommerce() ) {
											echo '<a href="'.$image.'" title="'.$captTh.'" data-rel="pix_slideshow">';
										} elseif ( $pix_linkto == 'page' && !pix_is_woocommerce() ) {
											echo '<a href="'.get_permalink().'">';
										} 
										echo '<img src="'.$imageTh.'" alt="'.get_the_title().'">';
										if ( $pix_linkto == 'colorbox' || $pix_linkto == 'page' ) {
											echo '</a>';
										}
										echo '</div>';

									} else {
										if ( has_post_thumbnail() ) {
											$thumb_id = get_post_thumbnail_id();
											$postTh = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
											
											echo '<div class="pix_column pix_column_thumb pix_column_featured '.$column_size.' alignleft">';
											if ( pix_is_woocommerce() ) {
												do_action( 'woocommerce_before_shop_loop_item' );
												do_action( 'woocommerce_before_shop_loop_item_title' );
											}
											if ( $pix_linkto == 'colorbox' ) {
												echo '<a href="'.$postTh[0].'" data-rel="pix_slideshow">';
											} elseif ( $pix_linkto == 'page' ) {
												echo '<a href="'.get_permalink().'">';
											} elseif ( pix_is_woocommerce() ) {
												echo '<a href="'. get_permalink(). '" title="'. sprintf( esc_attr__( 'Go to %s', 'forte' ), the_title_attribute( 'echo=0' ) ) .'" rel="bookmark">';
											}
											echo get_the_post_thumbnail(get_the_id(), $thumb_size );
											if ( $pix_linkto == 'colorbox' || $pix_linkto == 'page' || pix_is_woocommerce() ) {
												echo '</a>';
											}
											echo '</div>';
										} 
									} ?>

                                        
									<?php
										echo '<span class="'.$clear.'"></span><div class="entry-summary" data-lines="'.$excerpt_lines.'">'.pix_get_the_excerpt().'</div>';
									?>
                                        
                                
								<?php
									if ( pix_is_woocommerce() ) {
										echo '<div class="entry-meta">';
										do_action( 'woocommerce_after_shop_loop_item_title' );
										do_action( 'woocommerce_after_shop_loop_item' );
										echo '</div>';
									} else {
										if ( (function_exists('printGetLikes') && $pix_like=='true') || $pix_more=='true' || ($pix_comments == 'true' && comments_open()) || $pix_date_posts=='true' || $pix_author_posts=='true' ) {

											echo '<div class="entry-meta">';

	                                        if ( $pix_date_posts=='true' ) {
				                                echo '<span class="pix_meta_date"><span><i class="icon-time"></i> '.get_the_date().'</span></span>'.PHP_EOL;
	                                        }
	                                        if ( $pix_comments == 'true' && comments_open() ) {
	                                            if( get_comments_number() != '0' ) {
	                                                echo '<span class="pix_meta_comments"><a href="'.get_permalink($post->ID).'#comments"><i class="icon-comment"></i> '.get_comments_number().'</a></span>'.PHP_EOL;
	                                            }
	                                        }
	                                        if ( function_exists('printLikes') && $pix_like=='true' ) {
	                                            echo '<span class="like-this">';
	                                                printLikes(get_the_ID());
	                                            echo '</span>'.PHP_EOL;
	                                        }
	                                    ?>
											<?php if ( pix_get_option('pix_endmeta_posts') == 'true' && pix_category_list(', ') != '' && $pix_meta == 'true' ) { ?>
		                                        <span class="pix_meta_cat"><i class="icon-map-marker"></i> <?php echo pix_category_list(', '); ?></span>
		                                    <?php } ?>
		                                    <?php if ( $pix_author_posts == 'true'  && $pix_meta == 'true' ) { ?>
		                                        <span class="pix_meta_auth"><i class="icon-user"></i> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
		                                    <?php }
		                                        if ( $pix_more=='true' ) {
													echo '<a href="'. get_permalink() .'" class="read-more alignright">'. __('Read more','forte') .' <i class="icon-chevron-right"></i></a>';
												}
											echo '</div>';
										}
	                                } ?>
                                <hr>

                                </div><!-- .entry -->
            
                        <?php } ?>    

                            <?php endwhile; wp_reset_postdata(); ?>

	                        <?php } /*subcategories*/ ?>


                        </div><!-- .pix_load_content -->            
            
                        <?php else : ?>
                        
    						<?php echo '<div class="clear"></div>'.html5autop(do_shortcode(pix_get_option('pix_search_content'))); ?>
            
                        <?php endif; ?>
                        
							<?php
							if ( $args_shortcode_found || $query_shortcode_found ) {
								global $args;
								$args_2 = $args;
							} else {
	                            $args_2 = $wp_query->query_vars;

	                            $args_2['post__in'] = $post__in;
		                        if ( isset($the_post_type) && $the_post_type!='' )
			                        $args_2['post_type'] = $the_post_type;
	                        }
                            $args_2['posts_per_page'] = '100000000000000000000000000000';
	                        $args_2['paged'] = '0';


							if ( is_tax() ) {
								$tax = $wp_query->queried_object->taxonomy;
								$term = $wp_query->queried_object->slug;
								$args_2[$tax] = $term;
							} elseif ( is_tag() ) {
								$term = $wp_query->queried_object->term_id;
								$args_2['tag__in'] = $term;
							}
							global $my_query_2;
							$my_query_2 = new wp_query( $args_2 );

							if ( 
								(
									(pix_is_shop() && get_option( 'woocommerce_shop_page_display' ) != 'subcategories') 
									||
									(pix_is_product_category() && get_option( 'woocommerce_category_archive_display' ) != 'subcategories')
									||
									(pix_is_product_category() && get_option( 'woocommerce_category_archive_display' ) == 'subcategories' && !$woocommerce_product_subcategories)
									||
									(!pix_is_shop() && !pix_is_product_category())
									||
									(pix_is_woocommerce() && (is_search() || pix_is_filtered() || is_paged()))
								)
								&& !$woo_shortcode
							) {
								if ( is_home() && pix_get_option('pix_posts_page_pagenavi')=='' && !$inner_shortcode_found ) {
									pix_pagenavi();
								} elseif ( !is_home() && ($pagenavi == 'numbers' || $pagenavi == '') ) {
									pix_pagenavi($my_query_2->post_count);
								} elseif ( is_home() && pix_get_option('pix_posts_page_pagenavi')!='' && !$inner_shortcode_found ) {
									global $wp_query; if ( $wp_query->max_num_pages > 1 ) { ?>
			                        <span class="moreItemsInfinite"><?php next_posts_link( __( 'More items', 'forte' ) ); ?></span>
		                    	<?php } 
			                    } elseif ( !is_home() && $pagenavi == 'infinite' ) {
									if ( ($my_query_2->post_count / $posts_per_page) > 1 ) { ?>
			                        <span class="moreItemsInfinite"><a href="<?php echo esc_url( get_pagenum_link($paged+1)); ?>" class="pix_button first_color"><?php _e( 'More items', 'forte' ); ?></a></span>
	                    	<?php }
		                    }
                    	} wp_reset_postdata(); ?>

                        <?php if ( pix_is_woocommerce() ) {
                        	woocommerce_product_loop_end(); 
							do_action('woocommerce_after_shop_loop');
                        } ?>

<?php if ( !$inner_shortcode_found ) { ?>

                    </div><!-- .pix_column_990 -->
                    

				<?php 

					if ( (!isset($page_template) || $page_template == 'default' ) && !$shortcode_found ) { get_sidebar($page_sidebar);  } 

				?>
                
                </div>
                    
<?php } ?>
			</div>
<?php
	$pix_sort = false; 
	$pix_order = false; 
	$pix_sort_by_tag = false; 
	$pix_price = false; 
    $args_shortcode_found = false; 
    $query_shortcode_found = false; 
?>