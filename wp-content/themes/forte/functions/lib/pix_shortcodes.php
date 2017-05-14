<?php

function pixGoogleMap( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'link'      => '',
        'width'      => '427',
        'height'      => '300',
    ), $atts));
	
	$out = '<iframe width="'. $width .'" height="'. $height .'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'. $link .'&amp;output=embed"></iframe>';
	
   return $out;
}
add_shortcode("googlemap", "pixGoogleMap");

/*=========================================================================================*/

function pixContactEmail( $content = null ) {
	
	$out = '<input type="email" name="emailaddress" data-field="email" class="pix_required email onlyonce">';
	
   return $out;
}
add_shortcode("pix_email", "pixContactEmail");

/*=========================================================================================*/

function pixContactText( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'field'      => '',
        'required'      => ''
    ), $atts));
	$required = $required=='required' ? 'pix_required' : '';
	
	$out = '<input type="text" name="'.sanitize_title($name).'" data-field="'.$field.'" class="'.$required.'">';
	
   return $out;
}
add_shortcode("pix_text", "pixContactText");

/*=========================================================================================*/

function pixContactAltEmail( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'field'      => '',
        'required'      => ''
    ), $atts));
	$required = $required=='required' ? 'pix_required' : '';
	
	$out = '<input type="email" name="'.sanitize_title($name).'" data-field="'.$field.'" class="'.$required.' email">';
	
   return $out;
}
add_shortcode("pix_alt_email", "pixContactAltEmail");

/*=========================================================================================*/

function pixContactTextarea( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'field'      => '',
        'required'      => ''
    ), $atts));
	$required = $required=='required' ? 'pix_required' : '';
	
	$out = '<textarea name="'.sanitize_title($name).'" data-field="'.$field.'" class="'.$required.'"></textarea>';
	
   return $out;
}
add_shortcode("pix_textarea", "pixContactTextarea");

/*=========================================================================================*/

function pixCaptchaImg() {
	return dsp_crypt();
	}
add_shortcode("pix_captcha_img", "pixCaptchaImg");

/*=========================================================================================*/

function pixCaptchaInput() {
	return '<input type="text" name="captcha" data-field="captcha" class="pix_captcha_field" class="pix_required alignleft">';
	}
add_shortcode("pix_captcha_input", "pixCaptchaInput");

/*=========================================================================================*/

function pixSelect( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'field'      => '',
        'required'      => '',
		'multiple'	=> '',
		'height'	=> ''
    ), $atts));
	$required = $required=='required' ? 'pix_required' : '';
	
	$out = '<select name="'.sanitize_title($name).'" data-field="'.$field.'" class="'.$required.'"';
		if($multiple=='multiple') {
	$out .= ' multiple ';
		}
		if($height!='') {
	$out .= ' style="height:'.$height.'px" ';
		}
	$out .= '>';
	$out .= do_shortcode(pix_space_brackets($content));
	$out .= '</select>';
	
   return $out;
}
add_shortcode("pix_select", "pixSelect");

/*=========================================================================================*/

function pixOption( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'value'      => ''
    ), $atts));
	
	$out = '<option value="'.$value.'">'.$content.'</option>';
	
   return $out;
}
add_shortcode("pix_option", "pixOption");

/*=========================================================================================*/

function pixCheckBox( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'field'      => '',
        'required'      => ''
    ), $atts));
	$required = $required=='required' ? 'pix_required' : '';
	
	$out = '<input type="checkbox" name="'.sanitize_title($name).'" data-field="'.$field.'" class="'.$required.'">';
	
   return $out;
}
add_shortcode("pix_checkbox", "pixCheckBox");

/*=========================================================================================*/

function pixRadioButton( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'field'      => '',
        'value'      => '',
        'required'      => ''
    ), $atts));
	$required = $required=='required' ? 'pix_required' : '';
	
	$out = '<input type="radio" name="'.sanitize_title($name).'" data-field="'.$field.'" class="'.$required.'" data-value="'.$value.'" value="'.$value.'">';
	
   return $out;
}
add_shortcode("pix_radio", "pixRadioButton");

/*=========================================================================================*/

function pixPeriodFrom( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'field'      => '',
        'required'      => ''
    ), $atts));
	$required = $required=='required' ? 'pix_required' : '';
	
	global $print_datepicker;
	$print_datepicker = true;
	$out = '<input type="text" name="'.sanitize_title($name).'" data-field="'.$field.'" class="'.$required.'" id="from"><i class="icon-calendar"></i>';
	
   return $out;

}
add_shortcode("pix_period_from", "pixPeriodFrom");

/*=========================================================================================*/

function pixPeriodTo( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'field'      => '',
        'required'      => ''
    ), $atts));
	$required = $required=='required' ? 'pix_required' : '';
	
	global $print_datepicker;
	$print_datepicker = true;
	$out = '<input type="text" name="'.sanitize_title($name).'" data-field="'.$field.'" class="'.$required.'" id="to"><i class="icon-calendar"></i>';
	
   return $out;
}
add_shortcode("pix_period_to", "pixPeriodTo");

/*=========================================================================================*/

function pixContactForm( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'data_form'      => ''
    ), $atts));
	
	global $shortcode_form, $post;
	
	$shortcode_form = true;
	
	$pix_array_your_forms = pix_get_option('pix_array_your_forms_'.$data_form);

	$data_pageFrom = isset($pix_array_your_forms['pagefrom']) && $pix_array_your_forms['pagefrom']=='true' ? '<input type="hidden" name="pagefrom" data-field="'.__('Sended from:','forte').'" value="'.get_permalink($post->ID).'">' : '';
	
	$out = '<div class="pix_contact_form" id="'.$data_form.'">
                    <form>
                        <fieldset>';
		$i = 0;
		$pix_array_your_field = $pix_array_your_forms['fields'];
		
		while ($i<count($pix_array_your_field)){
			
			$out .= do_shortcode(pix_space_brackets(stripslashes($pix_array_your_field[$i]['output'])));
			
			$i++;
		} 
    $out .='<div class="clear"></div>
			'.$data_pageFrom.'
			<input type="submit" value="'.stripslashes($pix_array_your_forms['button']).'">

            <div class="pix_success display_none">
            '.stripslashes($pix_array_your_forms['success']).' 
            </div>
            <div class="pix_error display_none">
            '.stripslashes($pix_array_your_forms['unsuccess']).' 
            </div>
                        </fieldset>
                    </form>
                </div><!-- .contactForm -->';
	
   return do_shortcode(stripslashes($out));
}
add_shortcode("pix_contact_form", "pixContactForm");

/*=========================================================================================*/

function pixPriceTable( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'data_table'      => ''
    ), $atts));
	
	$out = '<table class="pix_price_table" id="pix_price_table_'.$data_table.'"><tbody><tr>';
	
	$pix_array_your_tables = pix_get_option('pix_array_your_tables_'.$data_table);        

	$get_price_table_column = $pix_array_your_tables['columns'];
	$i = 0;
	$count = count($get_price_table_column);
	while ($i<$count) {

		$highlighted = (isset($get_price_table_column[$i]['highlighted']) && $get_price_table_column[$i]['highlighted']=='true') ? ' highlighted' : '';
	
		$out .= '<td style="width:'.(100/$count).'%"><div class="pix_price_column pix_price_column_'.$i.' alignleft'.$highlighted.'"><div>';
		
			$get_price_table_cell = $get_price_table_column[$i]['cell'];
			$i2 = 0;
			$count2 = count($get_price_table_cell);

			while ($i2<$count2) {
				
				$type = $get_price_table_column[$i]['cell'][$i2]['type'];
					$line_class = $i2%2 == 0 ? 'odd' : 'even';
				switch($type) {
					case 'header_start':
						$out .= '<div class="pix_price_header">';
						break;
					case 'header_end':
						$out .= '<div class="tobottom_arrow"></div></div>';//.pix_price_header
						break;
					case 'title':
						$out .= '<div class="pix_price_title">';
							$out .= $get_price_table_column[$i]['cell'][$i2]['content'];
						$out .= '</div>';//.pix_price_title
						break;
					case 'price':
						$out .= '<div class="pix_price_price">';
							$out .= $get_price_table_column[$i]['cell'][$i2]['content'];
						$out .= '</div>';//.pix_price_price
						break;
					case 'subtitle':
						$out .= '<div class="pix_price_subtitle">';
							$out .= $get_price_table_column[$i]['cell'][$i2]['content'];
						$out .= '</div>';//.pix_price_subtitle
						break;
					case 'small':
						$out .= '<div class="pix_price_small '.$line_class.'">';
							$out .= $get_price_table_column[$i]['cell'][$i2]['content'];
						$out .= '</div>';//.pix_price_small
						break;
					case 'checked':
						$out .= '<div class="pix_price_checked '.$line_class.'">';
							$out .= '<i class="icon-ok"></i>&nbsp&nbsp'.$get_price_table_column[$i]['cell'][$i2]['content'];
						$out .= '</div>';//.pix_price_checked
						break;
					case 'unchecked':
						$out .= '<div class="pix_price_unchecked '.$line_class.'">';
							$out .= '<i class="icon-remove"></i>&nbsp&nbsp'.$get_price_table_column[$i]['cell'][$i2]['content'];
						$out .= '</div>';//.pix_price_unchecked
						break;
					case 'text':
						$out .= '<div class="pix_price_text '.$line_class.'">';
							$out .= $get_price_table_column[$i]['cell'][$i2]['content'];
						$out .= '</div>';//.pix_price_text
						break;
					case 'button':
						$class_button = $highlighted == ' highlighted' ? 'large' : 'small';
						$out .= '<div class="pix_price_button '.$line_class.'">';
							$target = $get_price_table_column[$i]['cell'][$i2]['blank'] == 'true' ? ' target="_blank"' : '';
							$out .= '<a class="pix_button '.pix_esc_option('pix_table_button').' '.$class_button.'" href="'.$get_price_table_column[$i]['cell'][$i2]['url'].'"'.$target.'>'.$get_price_table_column[$i]['cell'][$i2]['content'].'</a>';
						$out .= '</div>';//.pix_price_button
						break;
				}
				
				$i2++;
			}
				
		
		$out .= '</div></div></td>';//.pix_price_column
		
		$i++;
		
	}
		
		$out .= '</tr></tbody></table>';//.pix_price_table
	
   return do_shortcode(stripslashes($out));
}
add_shortcode("pix_price_table", "pixPriceTable");

/*=========================================================================================*/

function pixSlideShow( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'data_slideshow'      => ''
    ), $atts));
	
	global $content_width;
	
	$pix_array_your_slideshow = pix_get_option('pix_array_your_slideshows_'.$data_slideshow);        

	$get_slideshow_slide = $pix_array_your_slideshow['slide'];
	
	$out = '
	<div id="pix_slideshow_'.$data_slideshow.'" class="pix_slideshow pix_slideshow_preloading">
	
	<div class="pix_canvasloader-container"></div>';
	
	if ( $pix_array_your_slideshow['image']!='' ) {
		$out .= '<div class="pix_slideshow_until_image">
			<img src="'.$pix_array_your_slideshow['image'].'" alt="Still image">
		</div>';
	}
    $out .= '<div 
			class="pix_slideshow_target pix_slideshow_preloading" 
			style="
				height: '. ($content_width/$pix_array_your_slideshow['width'])*$pix_array_your_slideshow['height'].'px;
				width: '.$content_width.'px;"
			data-height="'.$pix_array_your_slideshow['height'].'"
			data-width="'.$pix_array_your_slideshow['width'].'"
			data-time="'.$pix_array_your_slideshow['time'].'"
			data-transperiod="'.$pix_array_your_slideshow['transperiod'].'"
			data-until="'.$pix_array_your_slideshow['until'].'"
			data-under="'.$pix_array_your_slideshow['under'].'"
			data-autoadvance="'.$pix_array_your_slideshow['autoadvance'].'"
			data-playpause="'.$pix_array_your_slideshow['playpause'].'"
			data-prevnext="'.$pix_array_your_slideshow['prevnext'].'"
			data-pagination="'.$pix_array_your_slideshow['pagination'].'"
			data-pie="'.$pix_array_your_slideshow['pie'].'"
			data-hover="'.$pix_array_your_slideshow['hover'].'"
			>';
	
	$i = 0;
	$count = count($get_slideshow_slide);
	while ($i<$count) {

		$get_slideshow_cell = $get_slideshow_slide[$i]['element'];
		$i2 = 0;
		$count2 = count($get_slideshow_cell);
		if($count2==0){
			$count2 = 1;
		}
		
		$out .= '<div>';

		while ($i2<$count2) {
			
			$backgroundimg = (isset($get_slideshow_slide[$i]['element'][$i2]['backgroundimg']) && $get_slideshow_slide[$i]['element'][$i2]['backgroundimg']!='') ? pix_remove_protocol($get_slideshow_slide[$i]['element'][$i2]['backgroundimg']) : get_template_directory_uri().'/images/blank.gif';
			$bgcolor = (isset($get_slideshow_slide[$i]['element'][$i2]['bgcolor']) && $get_slideshow_slide[$i]['element'][$i2]['bgcolor']!='')
				? $get_slideshow_slide[$i]['element'][$i2]['bgcolor'] : 'transparent';
			$simpleimg = isset($get_slideshow_slide[$i]['element'][$i2]['simpleimg']) ? pix_remove_protocol($get_slideshow_slide[$i]['element'][$i2]['simpleimg']) : get_template_directory_uri().'/images/blank.gif';
			$video = isset($get_slideshow_slide[$i]['element'][$i2]['video']) ? $get_slideshow_slide[$i]['element'][$i2]['video'] : '';
			$autoplay = (isset($get_slideshow_slide[$i]['element'][$i2]['autoplay']) && $get_slideshow_slide[$i]['element'][$i2]['autoplay']=='true')
				? 'true' : 'false';
			$videostop = (isset($get_slideshow_slide[$i]['element'][$i2]['videostop']) && $get_slideshow_slide[$i]['element'][$i2]['videostop']=='true')
				? 'true' : 'false';
			$caption = isset($get_slideshow_slide[$i]['element'][$i2]['caption']) ? $get_slideshow_slide[$i]['element'][$i2]['caption'] : '';
			$width = (isset($get_slideshow_slide[$i]['element'][$i2]['width']) && $get_slideshow_slide[$i]['element'][$i2]['width']!='') ? $get_slideshow_slide[$i]['element'][$i2]['width'].'%' : '';
			$height = (isset($get_slideshow_slide[$i]['element'][$i2]['height']) && $get_slideshow_slide[$i]['element'][$i2]['height']!='') ? $get_slideshow_slide[$i]['element'][$i2]['height'].'%' : '';
			$fontsize = (isset($get_slideshow_slide[$i]['element'][$i2]['fontsize']) && $get_slideshow_slide[$i]['element'][$i2]['fontsize']!='') ? $get_slideshow_slide[$i]['element'][$i2]['fontsize'].'px' : '';
			$html = isset($get_slideshow_slide[$i]['element'][$i2]['html']) ? $get_slideshow_slide[$i]['element'][$i2]['html'] : '';
			$position = isset($get_slideshow_slide[$i]['element'][$i2]['position']) ? $get_slideshow_slide[$i]['element'][$i2]['position'] : '';
			$delay = isset($get_slideshow_slide[$i]['element'][$i2]['delay']) ? $get_slideshow_slide[$i]['element'][$i2]['delay'] : '';
			$time = isset($get_slideshow_slide[$i]['element'][$i2]['time']) ? $get_slideshow_slide[$i]['element'][$i2]['time'] : '';
			$easein = isset($get_slideshow_slide[$i]['element'][$i2]['easein']) ? $get_slideshow_slide[$i]['element'][$i2]['easein'] : '';
			$easeout = isset($get_slideshow_slide[$i]['element'][$i2]['easeout']) ? $get_slideshow_slide[$i]['element'][$i2]['easeout'] : '';
			$target = (isset($get_slideshow_slide[$i]['element'][$i2]['target']) && $get_slideshow_slide[$i]['element'][$i2]['target']=='true')
				? ' target="_blank"' : '';
			$link = (isset($get_slideshow_slide[$i]['element'][$i2]['link']) && $get_slideshow_slide[$i]['element'][$i2]['link']!='')
				? '<a href="'.$get_slideshow_slide[$i]['element'][$i2]['link'].'"'.$target.'></a>' : '';
			$target_100 = (isset($get_slideshow_slide[$i]['element'][$i2]['target_100']) && $get_slideshow_slide[$i]['element'][$i2]['target_100']=='true')
				? ' target="_blank"' : '';
			$link_100 = (isset($get_slideshow_slide[$i]['element'][$i2]['link_100']) && $get_slideshow_slide[$i]['element'][$i2]['link_100']!='')
				? '<a class="filmore_link_100" href="'.$get_slideshow_slide[$i]['element'][$i2]['link_100'].'"'.$target_100.'>&nbsp;</a>' : '';
			$time = isset($get_slideshow_slide[$i]['element'][$i2]['time']) ? $get_slideshow_slide[$i]['element'][$i2]['time'] : '';
			$fxin = isset($get_slideshow_slide[$i]['element'][$i2]['fxin']) ? $get_slideshow_slide[$i]['element'][$i2]['fxin'] : '';
			$fxout = isset($get_slideshow_slide[$i]['element'][$i2]['fxout']) ? $get_slideshow_slide[$i]['element'][$i2]['fxout'] : '';
			$fadein = (isset($get_slideshow_slide[$i]['element'][$i2]['fadein']) && $get_slideshow_slide[$i]['element'][$i2]['fadein']=='true') ? 'true' : 'false';
			$fadeout = (isset($get_slideshow_slide[$i]['element'][$i2]['fadeout']) && $get_slideshow_slide[$i]['element'][$i2]['fadeout']=='true') ? 'true' : 'false';
			$rotatein = (isset($get_slideshow_slide[$i]['element'][$i2]['rotate_in']) && $get_slideshow_slide[$i]['element'][$i2]['rotate_in']=='true')
				? 'true' : 'false';
			$rotateout = (isset($get_slideshow_slide[$i]['element'][$i2]['rotate_out']) && $get_slideshow_slide[$i]['element'][$i2]['rotate_out']=='true')
				? 'true' : 'false';
				
			switch($get_slideshow_slide[$i]['element'][$i2]['type']){
				case 'background':
					$out .= ' <div 
								style="background-color:'.$bgcolor.'"
								data-src="'.$backgroundimg.'"
								data-use="background"
							></div><div class="pix_slideshow_target_inner">';
					break;
				case 'image':
					$out .= ' <div 
								data-src="'.$simpleimg.'"
								data-use="simple"
								data-style="'.$position.'"
								data-delay="'.$delay.'"
								data-time="'.$time.'"
								data-easein="'.$easein.'"
								data-easeout="'.$easeout.'"
								data-fxin="'.$fxin.'"
								data-fxout="'.$fxout.'"
								data-fadein="'.$fadein.'"
								data-fadeout="'.$fadeout.'"
								data-rotatein="'.$rotatein.'"
								data-rotateout="'.$rotateout.'"
							>'.$link.'</div>';
					break;
				case 'video':
					$out .= ' <div class="letmebe"
								data-src="'.$simpleimg.'"
								data-use="video"
								data-autoplay="'.$autoplay.'"
								data-stop="'.$videostop.'"
								data-style="'.$position.'"
								data-delay="'.$delay.'"
								data-time="'.$time.'"
								data-easein="'.$easein.'"
								data-easeout="'.$easeout.'"
								data-fxin="'.$fxin.'"
								data-fxout="'.$fxout.'"
								data-fadein="'.$fadein.'"
								data-fadeout="'.$fadeout.'"
								data-rotatein="'.$rotatein.'"
								data-rotateout="'.$rotateout.'"
						>'.$video.'</div>';
					break;
				case 'caption':
					$out .= ' <div class="filmore_caption"
								style="width:'.$width.'; height:'.$height.'; font-size:'.$fontsize.'"
								data-fontsize="'.$fontsize.'"
								data-use="caption"
								data-style="'.$position.'"
								data-delay="'.$delay.'"
								data-time="'.$time.'"
								data-easein="'.$easein.'"
								data-easeout="'.$easeout.'"
								data-fxin="'.$fxin.'"
								data-fxout="'.$fxout.'"
								data-fadein="'.$fadein.'"
								data-fadeout="'.$fadeout.'"
								data-rotatein="'.$rotatein.'"
								data-rotateout="'.$rotateout.'"
						>'.nl2br($caption).'</div>';
					break;
				case 'html':
					$out .= ' <div
								style="width:'.$width.'; height:'.$height.'; display: none"
								data-use="html"
								data-style="'.$position.'"
								data-delay="'.$delay.'"
								data-time="'.$time.'"
								data-easein="'.$easein.'"
								data-easeout="'.$easeout.'"
								data-fxin="'.$fxin.'"
								data-fxout="'.$fxout.'"
								data-fadein="'.$fadein.'"
								data-fadeout="'.$fadeout.'"
								data-rotatein="'.$rotatein.'"
								data-rotateout="'.$rotateout.'"
						>'.$html.'</div>';
					break;
				case 'link':
					$out .= $link_100;
					break;
						
				
			}
			
			$i2++;

		}

		$out .= '</div></div>';

		$i++;
	}
		
		$filmore_autoadv = $pix_array_your_slideshow['autoadvance']=='true' ? ' filmore_autoadv' : '';
		
		$filmore_commands = 
			( 
				$pix_array_your_slideshow['playpause']!='true'
			&&
				$pix_array_your_slideshow['prevnext']!='true'
			&& 
				$pix_array_your_slideshow['pagination']!='true'
			&& 
				$pix_array_your_slideshow['pie']!='true'
			)
			 ? ' style="display:none!important"' : '';

		$filmore_playpause = $pix_array_your_slideshow['playpause']!='true' ? ' style="display:none!important"' : '';
		$filmore_prevnext = $pix_array_your_slideshow['prevnext']!='true' ? ' style="display:none!important"' : '';
		$filmore_pagination = $pix_array_your_slideshow['pagination']!='true' ? ' style="display:none!important"' : '';
		$filmore_loader = $pix_array_your_slideshow['pie']!='true' ? ' style="visibility:hidden!important"' : '';
		
		$out .= '</div>
        <div class="filmore_commands'.$filmore_autoadv.'"'.$filmore_commands.'>
			<div class="pix_column">
				<span class="filmore_pause filmore_command"'.$filmore_playpause.'><i class="icon-pause"></i></span>
				<span class="filmore_play filmore_command"'.$filmore_playpause.'><i class="icon-play"></i></span>
				<span class="filmore_prev filmore_command"'.$filmore_prevnext.'><i class="icon-prev-slide"></i></span>
				<span class="filmore_pagination"'.$filmore_pagination.'></span>
				<span class="filmore_next filmore_command"'.$filmore_prevnext.'><i class="icon-next-slide"></i></span>
				<div class="filmore_loader"'.$filmore_loader.'></div>
			</div><!-- .pix_column_990 -->
        </div></div>';//.pix_slideshow
	
		$out .= '<div class="click_scroll_down">
		    <i class="icon-go-down"></i>
		</div>';

   return do_shortcode(stripslashes($out));
}
add_shortcode("pix_slideshow", "pixSlideShow");

/*=========================================================================================*/

function pixToolTip( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'width'     => '',
		'tooltip'	=> '',
		'position'	=> ''
    ), $atts));
	
	
	$out = '<span data-tip="'.$tooltip.'" data-width="'.$width.'" data-position="'.$position.'">';
	$out .= do_shortcode($content);
	$out .= '</span>';
	
   return $out;
}
add_shortcode("pix_tooltip", "pixToolTip");

/*=========================================================================================*/

function pixMovieFrame( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'data_mp4'		=> '',
        'data_ogv'		=> '',
		'data_height'	=> '56%',
		'data_width'	=> '100%',
		'data_poster'	=> '',
		'data_id'		=> ''
    ), $atts));
	
	if($data_poster!='') {
		$autoPlay = ' autoplay';
	} else {
		$autoPlay = '';
	}
	
	if($data_poster!=''){
		$printposter = 'style="background:transparent url('.pix_remove_protocol($data_poster).') center no-repeat; background-size:cover!important"';
	} else {
		$printposter = '';
	}

	$data_id = $data_id=='' ? sanitize_title($data_mp4) : $data_id;
	$auto_play = $autoPlay=='' ? 'false' : 'true';

	/*if(detectIE8()){
		$out = '
		<a
			href="'.$data_mp4.'"
			style="display:block; width:100%; height:200px"
			data-ratio="'.(floatval($data_height)/floatval($data_width)).'"
			class="flow_player"
			id="'.$data_id.'"><span';
		if($data_poster!=''){
			$out .= ' style="background: url('.$data_poster.') no-repeat center;"';
		}
		$out .= '></span></a>
		<script type="text/javascript">
	        flowplayer("'.$data_id.'", "'.get_template_directory_uri().'/scripts/flowplayer-3.2.15.swf", {
	            clip: {
	                autoPlay: '.$auto_play.', 
	                scaling: "orig",
	                autoBuffering: true
	            }
	        });
		</script>
		';
	
	} else {*/

		$out = '<div class="pix_flowplayer flowplayer" '.$printposter.' data-ratio="'.(floatval($data_height)/floatval($data_width)).'">
		    <video poster="'.$data_poster.'">';
		      if ( $data_mp4!='' ) {
		      	$out .= '<source type="video/mp4" src="'.$data_mp4.'"/>';
		      	$out .= '<source type="video/flash" src="mp4:'.$data_mp4.'">';
		      }
		      if ( $data_ogv!='' ) {
		      	$out .= '<source type="video/ogg" src="'.$data_ogv.'"/>';
		      }
		   $out .= '</video>
		</div>';
	//}
	
  return $out;
}
add_shortcode("pix_video", "pixMovieFrame");

/*=========================================================================================*/

function pixAudioPlay( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'data_src'     => '',
		'data_play'		=> 'false',
		'data_id'		=> ''
    ), $atts));
	
	$autoplay = $play == 'true' ? '.jPlayer("play")' : '';

	$out = '<div class="pix_audio_shortcode"><div id="jquery_jplayer_'.$data_id.'" class="jp-jplayer" data-audio="'.$data_src.'"></div>

<div id="jp_container_'.$data_id.'" class="jp-audio">

	<div class="jp-type-single">

		<div class="jp-gui jp-interface">

			<ul class="jp-controls">
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
  <script type="text/javascript">
    jQuery(function(){
		jQuery("#jquery_jplayer_'.$data_id.'").jPlayer( {
			ready: function () {
			  jQuery(this).jPlayer("setMedia", {
				mp3: "'.$data_src.'"
			  })'.$data_autoplay.';
			},
			cssSelectorAncestor: "#jp_container_'.$data_id.'",
			supplied: "mp3",
			swfPath: "'.get_template_directory_uri().'/scripts"
		});		
    });
  </script></div><!-- .pix_audio_shortcode -->';
	
  return $out;
}
add_shortcode("pix_audio", "pixAudioPlay");

/*=========================================================================================*/

function pixUIaccordion( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'data_active'     => ''
    ), $atts));
	
	$out = '<div class="pix_accordion" data-active="'.$data_active.'">'.do_shortcode($content).'</div><!-- .pix_accordion -->';
	
  return $out;
}
add_shortcode("pix_accordion", "pixUIaccordion");

/*=========================================================================================*/

function pixUIacc( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'data_title'     => ''
    ), $atts));

	$out = '<a class="header_accordion" href="#'.sanitize_title($data_title).'"><span>'.$data_title.'</span></a>';
	$out .= '<div><div>'.html5autop(html_entity_decode(do_shortcode($content))).'</div></div>';
	
  return $out;
}
add_shortcode("pix_acc", "pixUIacc");

/*=========================================================================================*/

function pixUItabs( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'data_active'     => ''
    ), $atts));
	
	$out = '<div class="pix_tabs" data-active="'.$data_active.'">'.do_shortcode($content).'</div><!-- .pix_tabs -->';	
	
  return $out;
}
add_shortcode("pix_tabs", "pixUItabs");

/*=========================================================================================*/

function pixUItab( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'data_title'     => ''		
    ), $atts));
	
	$id = preg_replace( "/\%/", '', sanitize_title($data_title) );

	$out = '<li><a href="#_'.$id.'">'.$data_title.'</a></li>';
	
  return $out;
}
add_shortcode("pix_tab", "pixUItab");

/*=========================================================================================*/

function pixUItabContent( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'data_title'     => ''
    ), $atts));

	$id = preg_replace( "/\%/", '', sanitize_title($data_title) );

	$out .= '<div id="_'.$id.'">'.html5autop(html_entity_decode(do_shortcode($content))).'</div>';
	
  return $out;
}
add_shortcode("pix_tab_content", "pixUItabContent");

/*=========================================================================================*/

function pixUl( $atts, $content = null ) {

	$out = '<ul>'.do_shortcode($content).'</ul>';
	
  return $out;
}
add_shortcode("ul", "pixUl");

/*=========================================================================================*/

function pixSiteMap( $atts, $content = null ) {

	global $woocommerce_en;
	
	$out = '<div class="pix_sitemap">
	
				<div class="pix_accordion" data-active="0">';

	$args=array(
	  'public'   => true
	); 
	$output = 'names';
	$operator = 'and';
	$post_types = get_post_types($args,$output,$operator);
    foreach ( $post_types as $post_type ) {
				$obj = get_post_type_object($post_type);
				$archive_query = new WP_Query('post_type='.$post_type.'&posts_per_page=-1');
				if ( $archive_query->have_posts() && strpos($post_type,'shop_') === false && strpos($post_type,'product_') === false ) {
				$out .= '<a class="header_accordion" href="#"><span>'. ($obj->labels->name) .'</span></a>
				<div><div><ul>';
					while ($archive_query->have_posts()) : $archive_query->the_post();
	$out .= '<li>
				<a href="'. get_permalink() .'" rel="bookmark" title="'.__( 'Link to', 'forte' ). get_the_title() .'">'. get_the_title() .'</a> 
			</li>';
				endwhile; wp_reset_query();
	$out .= '</ul></div></div>';
	} }
				$out .= '<a class="header_accordion" href="#"><span>'. __ ('Categories','forte') .'</span></a>
				<div><div><ul>';
			$categories=  get_categories(); 
			foreach ($categories as $category) {
				$out .= '<li><a href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a></li>';
			}

	$out .='</ul></div></div>                

				<a class="header_accordion" href="#"><span>'. __ ('Monthly archives','forte') .'</span></a>
				<div><div><ul>
					'. wp_get_archives('echo=0&format=custom&before=<li>&after=</li>') .'  
				</ul></div></div>  ';                 

			$terms = get_terms("gallery");
			$count = count($terms);
			if($count > 0){
				$out .= '<a class="header_accordion" href="#"><span>'. __ ('Galleries','forte') .'</span></a>
				<div><div>';
				$out .= "<ul>";
				foreach ($terms as $term) {
					$out .= '<li><a href="'.get_term_link($term->slug, 'gallery').'">'.$term->name.'</a></li>';
			
				}
				$out .= "</ul></div></div>";
			}

			if ( $woocommerce_en == 'active' ) {

				$terms = get_terms("product_cat");
				$count = count($terms);
				if($count > 0){
					$out .= '<a class="header_accordion" href="#"><span>'. __ ('Product categories','forte') .'</span></a>
					<div><div>';
					$out .= "<ul>";
					foreach ($terms as $term) {
						$out .= '<li><a href="'.get_term_link($term->slug, 'product_cat').'">'.$term->name.'</a></li>';
				
					}
					$out .= "</ul></div></div>";
				}

			}
			
			$out .= '</div><!-- .pix_accordion -->                   
		
			<span class="clear"></span>
		
		</div>';
	
   return $out;
}
add_shortcode("pix_sitemap", "pixSiteMap");

/*=========================================================================================*/

function pixBox( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'type'	=> ''
    ), $atts));

	global $content_width;
	
	$width = $content_width - ($border_size + 40);
	
	$out = '<div class="pix_'.$type.'">'.html5autop(do_shortcode($content)).'</div>';
	
  return $out;
}
add_shortcode("pix_box", "pixBox");

/*=========================================================================================*/

function pixDropCap( $atts, $content = null  ) {
   return html5autop('<span class="pix_firstletter">'.$content.'</span>');
}
add_shortcode("pix_dropcap", "pixDropCap");

/*=========================================================================================*/

function pixButton( $atts, $content = null  ) {
	extract(shortcode_atts(array(
        'type'		=> '',
		'size'		=> '',
		'style'		=> ''
    ), $atts));

    if (substr($content, 0, 2) === '<a' && substr($content, -4) === '</a>') {
    	preg_match('/<a(.*?)>(.*?)<\/a>/',$content,$match);
		return '<a'.$match[1].'><span class="pix_button '.$type.' '.$size.'" style="'.$style.'">'.$match[2].'</span></a>';    	
    } else {
		return '<span class="pix_button '.$type.' '.$size.'" style="'.$style.'">'.$content.'</span>';
    }
}
add_shortcode("pix_button", "pixButton");

/*=========================================================================================*/

function pixDiv( $atts, $content = null  ) {
	extract(shortcode_atts(array(
        'class'		=> '',
		'id'		=> '',
		'style'		=> ''
    ), $atts));

	return '<div class="'.$class.'" style="'.$style.'" id="'.$id.'">'.do_shortcode(html5autop($content)).'</div>';
}
add_shortcode("div", "pixDiv");

/*=========================================================================================*/

function pixHr( $atts, $content = null ) {
		
   return '<div class="clear"></div><hr><div class="clear"></div>';
}
add_shortcode("hr", "pixHr");

/*=========================================================================================*/

function pixBr( $atts, $content = null ) {
		
   return '<br>';
}
add_shortcode("br", "pixBr");

/*=========================================================================================*/

function pixTweet( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'user'		=> '',
		'replies'	=> '',
		'blacklist'	=> '',
		'whitelist'	=> '',
		'amount'	=> '',
		'layout'	=> ''
    ), $atts));

    	$amount = $amount=='' ? 1 : $amount;
		
		$out = '<div class="pix_tweet_sc"><div><div class="pix_tweet_tweety"></div>';
	
		$pix_tweets = array();
		$tweet_key = 0;

		$blacklist = str_replace(',','|',$blacklist);
		
		$whitelist = str_replace(',','|',$whitelist);
		
		$tweets = json_decode(pix_cache_tweets($user=$user,$count='1000')); // get tweets and decode them into a variable
		
		if ( is_array($tweets) ) {
		
			if ( $amount >= 1 && $layout == 'slides' ) { 
				$slide_tweets = ' slide_tweets';
			}
				
			$out .= '<ul class="pix_tweets_shortcode'.$slide_tweets.'">';

			foreach ($tweets as $value) {
				
				$matchRep = ( ($replies == 'hide' && substr($value->text,0,1) != '@') || $replies != 'hide' ) ? true : false;
		
				$nomatch = $blacklist != '' ? preg_match ( '/(' . $blacklist . ')/i',  $value->text ) : false;
		
				$match = $whitelist != '' ? preg_match ( '/(' . $whitelist . ')/i',  $value->text ) : true;
				
				if (  $matchRep && !$nomatch && $match) {
					if ($tweet_key<$amount){
						$pix_tweet = '<li><span class="screen_name"><a href="https://twitter.com/#!/'.$value->user->screen_name.'" target="_blank">'.($value->user->screen_name).'</a></span>
						<span class="name">'.($value->user->name).'</span><br><span class="tweet_text">'.pix_url_2_link($value->text).'</span><br><small><a href="http://twitter.com/pixedelic/statuses/'.$value->id_str.'" target="_blank">'.pix_compare_dates($value->created_at).' &rarr;</a></small></li>';

						$out .= $pix_tweet;
					
						array_push($pix_tweets, $pix_tweet);
					}
					
					/*if ($tweet_key == 0) {
						$pix_tweets_0 = $value->created_at;
					}*/
					
					$tweet_key++;
				}
			}
			
			$out .= '</ul>';
		}

		if(count($pix_tweets)==0){
			$out .= __('Sorry, no tweets available,<br>maybe because of the amount of requests<br>or maybe because Twitter is down...','forte');
		}
		$out .= '</div></div>';
		
		return $out;
}
add_shortcode("pix_tweet", "pixTweet");

/*=========================================================================================*/

function pixTestimonials( $atts, $content = null ) {
 
    global $post;

	extract(shortcode_atts(array(
		'data_ids' => '',
		'data_layout' => 'list'
    ), $atts));

    if ( $data_ids == '' ) {
		$args = array(
			'post_type'	=> 'testimonial',
			'post_status' => 'publish',
			'posts_per_page' => 9999999999999,
			'orderby' => 'none'
		);
	} else {
		$data_ids = explode(',', $data_ids);
		$args = array(
			'post__in' => $data_ids,
			'post_type'	=> 'testimonial',
			'post_status' => 'publish',
			'posts_per_page' => 9999999999999,
			'orderby' => 'none'
		);
	}
    
	$test_query = new wp_query( $args );

	ob_start();

	$slideTest = $data_layout == 'slides' ? ' slide_testimonials' : '';
	
	echo '<ul class="pix_testimonials'.$slideTest.'">';

    while ( $test_query->have_posts() ) : $test_query->the_post();
    	echo '<li>';
    	$info = get_post_meta( get_the_id(), 'pix_testimonial_info', true );
    	$e_info = ( isset($info) && $info!='' ) ? ' <small>'.$info.'</small>' : '';
    	echo '<span class="comment_testim">'.get_the_content().'<span class="tobottom_arrow"></span></span>';
    	if ( has_post_thumbnail() ) { 
    		echo '<span class="testimonial_th alignleft">'.get_the_post_thumbnail(get_the_id(), 'mini_th').'</span>';
    	} else {
    		echo '<span class="testimonial_th no_th alignleft"><i class="icon-user"></i></span>';
    	}
    	echo '<span class="testimonial_name alignleft">'.get_the_title().$e_info.'</span>';
    	echo '</li>';
    endwhile;

	echo '</ul><div class="clear"></div>';

	wp_reset_query();

	return ob_get_clean();
}
add_shortcode("pix_testimonials", "pixTestimonials");

/*=========================================================================================*/

function pixGalleries( $atts, $content = null ) {
 
    global $wp_query,
    	$post, 
    	$posts_per_page, 
    	$layout, 
    	$page_template, 
    	$page_sidebar, 
    	$pix_sort, 
    	$pix_order,
    	$pix_sort_by_tag,
    	$pix_linkto,
    	$pagenavi, 
    	$shortcode_found, 
    	$excerpt_lines, 
    	$no_sidebar, 
    	$the_post_type,
	    $pix_titles,
	    $pix_comments,
	    $pix_more,
	    $pix_like,
		$query_shortcode_found,
		$args;

	extract(shortcode_atts(array(
		'galleries' => '',
		'layout' => '',
		'excerpt' => '',
		'sorting' => '',
		'order' => '',
		'sort' => '',
		'amount' => '',
		'linkto' => '',
		'pagenavigation' => '',
		'titles' => '',
		'comments' => '',
		'morelink' => '',
		'likebutton' => '',
		'featured'	=> 'true'
    ), $atts));
	

    $galleries = $galleries=='all' ? 0 : $galleries;
    $posts_per_page = $amount;
    $pix_linkto = $linkto;
    $excerpt_lines = $excerpt;
	$the_post_type = 'portfolio';
    $pix_titles = $titles;
    $pix_comments = $comments;
    $pix_more = $morelink;
    $pix_like = $likebutton;
    $pagenavi = $pagenavigation=='' ? 'false' : $pagenavigation;
    $pix_sort = $sorting;
    $pix_order = $order;
    $pix_sort_by_tag = $sort;
    $shortcode = 'true';

    if ( $featured!="false" ) {
	    $pix_order = 'false';
    	$query_shortcode_found = true;

		$args['post_type']='portfolio';
		$args['ignore_sticky_posts']=1;
		$args['posts_per_page']=$posts_per_page;
		$args['gallery']=$galleries;
   } else {
		$query_shortcode_found = true;
		$page_template = get_post_meta( $post->ID, '_wp_page_template', true );
		$args['post_type']='portfolio';
		$args['ignore_sticky_posts']=1;
		$args['posts_per_page']=$posts_per_page;
		$args['orderby']=$_SESSION[$the_post_type.'_sort'];
		$args['order']=$_SESSION[$the_post_type.'_order'];
		$args['gallery']=$galleries;
   }

	ob_start();

    switch ( $layout ) {
        case 'sixth':
        case 'sixth_bis':
        case 'seventh':
        case 'seventh_bis':
        case 'eighth':
        case 'eighth_bis':
            if ( locate_template( 'loop-first.php' ) )
               locate_template( 'loop-first.php', true, false );
            break;
        case 'ninth':
        case 'tenth':
            if ( locate_template( 'loop-second.php' ) )
               locate_template( 'loop-second.php', true, false );
            break;
        default:
            if ( locate_template( 'loop-third.php' ) )
               locate_template( 'loop-third.php', true, false );
    }

	$args = '';

	wp_reset_postdata();

	return ob_get_clean();
}
add_shortcode("pix_galleries", "pixGalleries");

/*=========================================================================================*/

function pixCategories( $atts, $content = null ) {

    global $wp_query,
    	$post,
    	$posts_per_page,
    	$layout,
    	$page_template,
    	$page_sidebar, 
    	$pix_sort, 
    	$pix_order,
    	$pix_sort_by_tag,
    	$pix_linkto,
    	$pagenavi, 
    	$query_string, 
    	$shortcode_found, 
    	$excerpt_lines, 
    	$no_sidebar, 
    	$the_post_type,
	    $pix_titles,
	    $pix_comments,
	    $pix_more,
	    $pix_like,
	    $pix_meta,
		$query_shortcode_found,
		$args;

	$the_post_type = 'post';

	extract(shortcode_atts(array(
		'cat' => '',
		'layout' => '',
		'excerpt' => '',
		'sorting' => '',
		'order' => '',
		'sort' => '',
		'amount' => '',
		'linkto' => '',
		'pagenavigation' => '',
		'titles' => '',
		'comments' => '',
		'morelink' => '',
		'likebutton' => '',
		'meta' => '',
		'featured'	=> 'true'
    ), $atts));

    $posts_per_page = $amount;
    $pix_sort = $sorting;
    $pix_order = $order;
    $pix_sort_by_tag = $sort;
    $pix_linkto = $linkto;
    $pagenavi = $pagenavigation=='' ? 'false' : $pagenavigation;
    $shortcode = 'true';
    $excerpt_lines = $excerpt;
    $pix_titles = $titles;
    $pix_comments = $comments;
    $pix_more = $morelink;
    $pix_like = $likebutton;
    $pix_meta = $meta;

    if ( $featured!="false" ) {
	    $pix_order = 'false';
    	$query_shortcode_found = true;
		$args['post_type']='post';
		$args['ignore_sticky_posts']='1';
		$args['posts_per_page']=$posts_per_page;
		$args['cat']=$cat;
   } else {
		$query_shortcode_found = true;
		$page_template = get_post_meta( $post->ID, '_wp_page_template', true );
		$args['post_type']='post';
		$args['ignore_sticky_posts']='1';
		$args['orderby']=$_SESSION[$the_post_type.'_sort'];
		$args['order']=$_SESSION[$the_post_type.'_order'];
		$args['posts_per_page']=$posts_per_page;
		$args['cat']=$cat;
	}

	ob_start();

    switch ( $layout ) {
        case 'sixth':
        case 'sixth_bis':
        case 'seventh':
        case 'seventh_bis':
        case 'eighth':
        case 'eighth_bis':
            if ( locate_template( 'loop-first.php' ) )
               locate_template( 'loop-first.php', true, false );
            break;
        case 'ninth':
        case 'tenth':
            if ( locate_template( 'loop-second.php' ) )
               locate_template( 'loop-second.php', true, false );
            break;
        default:
            if ( locate_template( 'loop-third.php' ) )
               locate_template( 'loop-third.php', true, false );
    }

	$args = '';

	wp_reset_postdata();

	return ob_get_clean();
}
add_shortcode("pix_categories", "pixCategories");

/*=========================================================================================*/

function pixClear( $atts, $content = null ) {
	
	return '<div class="clear"></div>';
}
add_shortcode("clear", "pixClear");

/*=========================================================================================*/

function pixMobile( $atts, $content = null ) {
		
   if(pix_detectMobile()){
	  return do_shortcode($content);
   }
}
add_shortcode("pix_mobile", "pixMobile");

/*=========================================================================================*/

function pixNotMobile( $atts, $content = null ) {
		
   if(!pix_detectMobile()){
	  return do_shortcode($content);
   }
}
add_shortcode("pix_not_mobile", "pixNotMobile");

/*=========================================================================================*/

function pixBloginfo( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'show' => ''
    ), $atts));
	return get_bloginfo($show);
}
add_shortcode("pix_bloginfo", "pixBloginfo");

/*=========================================================================================*/

?>