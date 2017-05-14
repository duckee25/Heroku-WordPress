<?php
	global $post,
		$layout,
	    $pix_titles,
	    $excerpt_lines,
	    $pix_more,
	    $query_related,
	    $wp_version,
	    $mediaelement_en,
	    $product;

	$page_ID = is_home() ? get_option('page_for_posts') : $post->ID;

	$page_template = get_post_meta( $page_ID, '_wp_page_template', true );

	$page_sidebar = get_post_meta( $page_ID, 'pix_sidebar_select', true );

	$side_alignment =  pix_get_option('pix_aside_position') == 'right' ? 'left' : 'right';

	$counter = 1;

	$data_cols = $page_template == 'default' ? '3' : '4';

?>
                        
						<?php if ( $query_related->have_posts() ) : ?>

						<?php if ( $layout == 'sixth' || $layout == 'sixth_bis' ) { ?>
						<div class="pix_related_grid">

						<div class="pix_simple_grid <?php if ( $layout == 'sixth_bis' ) { ?>masonry<?php } ?> pix_load_content" data-cols="<?php echo $data_cols; ?>"> 
						<?php } ?>           

                            <?php while ( $query_related->have_posts() ) : $query_related->the_post(); ?>

                        <?php global $product; if ( (pix_is_woocommerce() && $product->is_visible()) || !pix_is_woocommerce() ) { ?>

                               <div class="entry post-id-<?php echo get_the_id(); ?> alignleft">
                                
									<?php
										switch ( $layout ) {
											case 'second' :
												$thumb_size = 'one_column_thumb';
												$column_size = 'pix_column_featured pix_column_210';
												$thumb_width = 210;
												$thumb_height = 132;
												break;
											case 'third' :
												$thumb_size = 'one_column_4_3';
												$column_size = 'pix_column_featured pix_column_210';
												$thumb_width = 210;
												$thumb_height = 157;
												break;
											case 'sixth_bis' :
												$thumb_size = 'one_column';
												$column_size = 'pix_column_210';
												$thumb_width = 210;
												$thumb_height = 'auto';
												break;
											default:
												$thumb_size = 'one_column_4_3';
												$column_size = 'pix_column_210';
												$thumb_width = 210;
												$thumb_height = 157;
											}
									?>


									<?php 
										$the_post_type = get_post_type( $post->ID );

										if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) )   || 
                                				($the_post_type == 'portfolio' && get_post_meta($post->ID, 'pix_post_format', true)=='gallery')  ) { 
                                        $attachments = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
										
                                    	$the_content = get_the_content();

										echo '<div class="gallery-post-format pix_column pix_column_thumb '.$column_size.' alignleft">';

                                        if ( version_compare($wp_version, '3.5', '>=') && strpos($the_content,'[gallery') !== false ) {
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
													<a href="'.wp_get_attachment_url($id).'" class="filmore_link_100 colorbox" data-rel="gallery-'.$post->ID.'">&nbsp;</a></div>';
												
											}
										
											echo '</div>
											<div class="filmore_commands">
													<div class="filmore_prev filmore_command"><i class="icon-prev-slide"></i></div>
													<div class="filmore_next filmore_command"><i class="icon-next-slide"></i></div>
													<div class="filmore_loader hidden_div"></div>
												</div>
											</div>';
											
										}
                                    
                                    } elseif ( ( function_exists( 'get_post_format' ) && 'video' == get_post_format( $post->ID ) )  || 
                                				($the_post_type == 'portfolio' && get_post_meta($post->ID, 'pix_post_format', true)=='video')  ) { 
									
										$the_content = get_the_content(); $the_content = apply_filters('the_content', $the_content);
										$iframe_pos = strpos($the_content, '<iframe');
										$video_pos = strpos($the_content, '<div class="pix_flowplayer');

										if ( ($video_pos < $iframe_pos || $iframe_pos=='') && $video_pos!='' ) {
											if ( version_compare($wp_version, '3.5.9', '>=') || $mediaelement_en=='active' ) {
												preg_match('/<div class="video-embedded.*<\/div>/isU', $the_content, $matches);
												$match = preg_replace('|<div class="video-embedded"><div style="(.+?)">|', '<div class="video-embedded">', $matches[0]);
											} else {
												preg_match('/<div class="pix_flowplayer.*<\/div>/isU', $the_content, $matches);
												$match = $matches[0];
											}
											echo '<div class="video-post-format pix_column pix_column_thumb '.$column_size.' alignleft"><table style="height:'.$thumb_height.'px"><tr><td>
												'.$match.'
											</td></tr></table>';
										} else {
											preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $the_content, $src);
											preg_match('/<iframe.*height=\"(.*)\".*><\/iframe>/isU', $the_content, $height);
											$frame_height = $clear=='clear' ? $height[1] : $thumb_height;
											$frame_wrap = $clear=='clear' ? 'div' : 'span';
											echo '<div class="video-post-format pix_column pix_column_thumb '.$column_size.' alignleft">
												<'.$frame_wrap.'><iframe src="'.$src[1].'" frameborder="0" width="'.$thumb_width.'" height="'.$frame_height.'"></iframe></'.$frame_wrap.'>';
										}

									} elseif ( ( function_exists( 'get_post_format' ) && 'audio' == get_post_format( $post->ID ) )  || 
                                				($the_post_type == 'portfolio' && get_post_meta($post->ID, 'pix_post_format', true)=='audio')  ) { 
									
										$the_content = get_the_content(); $the_content = apply_filters('the_content', $the_content);
										preg_match('/data-audio=\"(.*)\"/', $the_content, $matches);
										
										$frame_height = $clear=='clear' ? ($thumb_width*0.2) : $thumb_height;
										
										if ( version_compare($wp_version, '3.5.9', '>=')  || $mediaelement_en=='active' ) {

												preg_match('/<audio.*<\/audio>/isU', $the_content, $matches);
												echo '<div class="audio-post-format pix_column pix_column_thumb '.$column_size.' alignleft">
													'.$matches[0];

										} else {

											preg_match('/data-audio=\"(.*)\"/', $the_content, $matches);
										
											echo '<div class="audio-post-format pix_column pix_column_thumb '.$column_size.' alignleft">
											<div class="notplaying" style="height:'.$frame_height.'px">
											
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
												
												</div>
												
											</div></div>';
										}

									} else {
										echo '<div class="pix_column pix_column_thumb '.$column_size.' alignleft">';
										if ( has_post_thumbnail() ) {
											$thumb_id = get_post_thumbnail_id();
											//$enlarge = get_post_meta( get_the_id(), 'pix_colorbox_feat_image', true );
											$postTh = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
											
											$linkto = '';

											switch ($the_post_type) {
												case 'portfolio':
													$linkto = pix_get_option('pix_portfolio_related_linkto');
													break;
												default:
													$linkto = pix_get_option('pix_post_related_linkto');
													break;
											}

											if ( !pix_is_woocommerce() ) {
												if ( $linkto == 'colorbox' ) {
													$linkto = '<a href="'.$postTh[0].'">';
												} elseif ( $linkto == 'page' ) {
													$linkto = '<a href="'. get_permalink(). '" title="'. sprintf( esc_attr__( 'Go to %s', 'forte' ), the_title_attribute( 'echo=0' ) ) .'" rel="bookmark">';
												}
											} else {
												$linkto = '<a href="'. get_permalink(). '" title="'. sprintf( esc_attr__( 'Go to %s', 'forte' ), the_title_attribute( 'echo=0' ) ) .'" rel="bookmark">';
											}

											echo $linkto;
											echo get_the_post_thumbnail(get_the_id(), $thumb_size );
											if ( $linkto!='' ) {
												echo '</a>';
											}
										}
									} 

									if ( $the_post_type=='product' ) do_action( 'woocommerce_before_shop_loop_item' );
									if ( $the_post_type=='product' ) do_action( 'woocommerce_before_shop_loop_item_title' );
		                            if ( $the_post_type=='product' ) woocommerce_product_loop_start();

								
									if ( $layout == 'second' || $layout == 'third' ) {
										echo '</div>';
										if ( $pix_titles != '0' ) {
											echo '<h6><a href="'. get_permalink(). '" title="'. sprintf( esc_attr__( 'Go to %s', 'forte' ), the_title_attribute( 'echo=0' ) ) .'" rel="bookmark">'. get_the_title() .'</a></h6>';
											if ( $the_post_type=='product' ) do_action( 'woocommerce_after_shop_loop_item_title' );
										}
										echo '<span class="'.$clear.'"></span><div class="entry-summary" data-lines="'.$excerpt_lines.'">'.pix_get_the_excerpt().'</div>';
										?>
										<?php if ( $pix_more == 'true' ) { ?>
											<a href="<?php the_permalink(); ?>" class="read-more alignright"><?php _e('Read more','forte'); ?> <i class="icon-chevron-right"></i></a>
										<?php }
									} else {
										echo '<div class="entry-content">';
										if ( $pix_titles != '0' ) {
											echo '<h5><a href="'. get_permalink(). '" title="'. sprintf( esc_attr__( 'Go to %s', 'forte' ), the_title_attribute( 'echo=0' ) ) .'" rel="bookmark">'. get_the_title() .'</a></h5>';
											if ( $the_post_type=='product' ) do_action( 'woocommerce_after_shop_loop_item_title' );
										}

										if ( $the_post_type=='product' || $pix_more=='true' ) {
				                            echo '<div class="entry-meta">';
													if ( $the_post_type!='product' && $pix_more=='true' ) {
				                                        echo '<a href="'. get_permalink() .'" class="read-more alignright">'. __('Read more','forte') .' <i class="icon-chevron-right"></i></a>';
				                                    }
					                            if ( $the_post_type=='product' ) do_action( 'woocommerce_after_shop_loop_item' );
				                                echo '</div>';
				                            }
			                            echo '</div>
			                            </div>';
									} ?>
                                        
                                

					            <?php if ( $the_post_type=='product' ) woocommerce_product_loop_end(); ?>
                                </div><!-- .entry -->

								<?php
									if ( $counter != $query_related->post_count && $layout != 'sixth' && $layout != 'sixth_bis') {
										echo '<hr>';
									} 
									$counter = $counter +1;
								?>
            
                        <?php } ?>    

                            <?php endwhile; wp_reset_query(); ?>
                        
						<?php if ( $layout == 'sixth' || $layout == 'sixth_bis' ) { ?>
							</div><!-- .pix_simple_grid -->
							</div><!-- .pix_related_grid -->

							<div class="clear"></div>
						<?php } ?>           
                        <?php endif; ?>