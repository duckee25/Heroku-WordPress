<?php
if (!defined('ABSPATH'))
	exit; // Exit if accessed directly
/**
 * Template Video
 * 
 * Access original fields: $mod_settings
 * @author Themify
 */
if (TFCache::start_cache('video', self::$post_id, array('ID' => $module_ID))):
	
	$fields_default = array(
		'mod_title_video' => '',
		'style_video' => 'video-top',
		'url_video' => '',
		'autoplay_video' => 'no',
		'width_video' => '',
		'unit_video' => '',
		'title_video' => '',
		'title_link_video' => false,
		'caption_video' => '',
		'css_video' => '',
		'animation_effect' => ''
	);

	$fields_args = wp_parse_args($mod_settings, $fields_default);
	extract($fields_args, EXTR_SKIP);
	$animation_effect = $this->parse_animation_effect($animation_effect, $fields_args);

	$video_maxwidth = ( empty($width_video) ) ? '' : $width_video . $unit_video;
	$container_class = implode(' ', apply_filters('themify_builder_module_classes', array(
			'module', 'module-' . $mod_name, $module_ID, $style_video, $css_video, $animation_effect
		), $mod_name, $module_ID, $fields_args)
	);
	$container_props = apply_filters( 'themify_builder_module_container_props', array(
        'id' => $module_ID,
        'class' => $container_class
    ), $fields_args, $mod_name, $module_ID );

	add_filter('oembed_result', 'themify_modify_youtube_embed_url', 10, 3);
	if(!function_exists('themify_modify_youtube_embed_url')){
		function themify_modify_youtube_embed_url($html, $url, $args) {
			$parse_url = parse_url($url);
			if(!empty($parse_url['query']) || !empty($parse_url['fragment'])){
				$parse_url['host'] = str_replace('www.','',$parse_url['host']);
				$query = !empty($parse_url['query'])?$parse_url['query']:false;
				$query.= !empty($parse_url['fragment'])?$parse_url['fragment']:'';
				if(trim($parse_url['path'],'/')!=='playlist' && ($parse_url['host']==='youtu.be' || $parse_url['host']==='youtube.com')){
					$query = preg_replace('@v=([^"&]*)@','',$query);
					$query = str_replace('&038;','&',$query);
					return  $query?preg_replace('@embed/([^"&]*)@', 'embed/$1?'.$query, $html):$html;
				}
				elseif($parse_url['host']=='vimeo.com'){
					 $query = str_replace('&038;','&',$query);
					 return  $query?preg_replace('@video/([^"&]*)@', 'video/$1?'.$query, $html):$html;
				}
			}
			return $html;
		}
	}
	?>

	<!-- module video -->
	<div<?php echo $this->get_element_attributes( $container_props ); ?>>

		<?php if ($mod_title_video != ''): ?>
			<?php echo $mod_settings['before_title'] . wp_kses_post(apply_filters('themify_builder_module_title', $mod_title_video, $fields_args)) . $mod_settings['after_title']; ?>
		<?php endif; ?>

		<?php do_action('themify_builder_before_template_content_render'); ?>

		<div class="video-wrap" <?php echo '' != $video_maxwidth ? 'style="max-width:' . esc_attr($video_maxwidth) . ';"' : ''; ?>>
			<?php
			$video = wp_oembed_get( esc_url( $url_video ) );
                        if($video){
                            $video = str_replace( 'frameborder="0"', '', $video );
                            if( $autoplay_video == 'yes' ) {
                                    $video = preg_replace_callback( '/src=["\'](http[^"\']*)["\']/', array( 'TB_Video_Module', 'autoplay_callback' ), $video );
                            }     
                            echo $video;
                        }
                        else{
                            global $wp_embed;
                            $video = $wp_embed->run_shortcode('[embed]'.$url_video.'[/embed]');
                            if($video){
                                if( $autoplay_video == 'yes' ) {
                                    $video = str_replace('src','autoplay="on" src',$video);
                                }
                                echo do_shortcode($video);
                            }
                        }
			?>
		</div>
		<!-- /video-wrap -->

		<?php if ('' != $title_video || '' != $caption_video): ?>
			<div class="video-content">
				<?php if ('' != $title_video): ?>
					<h3 class="video-title">
						<?php if ($title_link_video) : ?>
							<a href="<?php echo esc_url($title_link_video); ?>"><?php echo wp_kses_post($title_video); ?></a>
						<?php else: ?>
							<?php echo wp_kses_post($title_video); ?>
						<?php endif; ?>
					</h3>
				<?php endif; ?>

				<?php if ('' != $caption_video): ?>
					<div class="video-caption">
						<?php echo apply_filters('themify_builder_module_content', $caption_video); ?>
					</div>
					<!-- /video-caption -->
				<?php endif; ?>
			</div>
			<!-- /video-content -->
		<?php endif; ?>

		<?php do_action('themify_builder_after_template_content_render'); ?>
	</div>
	<!-- /module video -->
<?php endif; ?>
<?php TFCache::end_cache(); ?>