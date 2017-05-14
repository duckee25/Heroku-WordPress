<?php
	$out = '
body {
	';

	if (pix_get_option('pix_enable_google')=='true') {
		$body_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_general_fontfamily')) .'";';
	} else {
		$body_font = '';
	}

	$out .= '
	background: '.pix_get_option('pix_body_bgcolor').';
	color: '.pix_get_option('pix_general_text_color').';
	'.$body_font.'
	font-size: '. pix_get_option('pix_general_fontsize') .'px;
}
a {
	color: '.pix_get_option('pix_general_link_color').';
	text-decoration: underline;
}
h1 {
	';

	if (pix_get_option('pix_enable_google')=='true') {
		$h1_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_h1_fontfamily')) .'";';
		if (strpos(pix_get_option('pix_h1_fontvariants'),'italic')!==false) {
			$h1_font .= 'font-style: italic;';
		}
		if (pix_get_option('pix_h1_fontvariants')!='' && strpos(pix_get_option('pix_h1_fontvariants'),'italic')===false) {
			$h1_font .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_h1_fontvariants'))) .';';
		}
	} else {
		$h1_font = '';
	}

	$out .= '
	color: '. pix_get_option('pix_h1_color') .';
	'.$h1_font.'
	font-size: '. pix_get_option('pix_h1_fontsize') .'em;
}
p.h1_subtitle {
	color: '. pix_get_option('pix_h1_color') .';
}
h2 {
	';

	if (pix_get_option('pix_enable_google')=='true') {
		$h2_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_h2_fontfamily')) .'";';
		if (strpos(pix_get_option('pix_h2_fontvariants'),'italic')!==false) {
			$h2_font .= 'font-style: italic;';
		}
		if (pix_get_option('pix_h2_fontvariants')!='' && strpos(pix_get_option('pix_h2_fontvariants'),'italic')===false) {
			$h2_font .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_h2_fontvariants'))) .';';
		}
	} else {
		$h2_font = '';
	}

	$out .= '
	color: '. pix_get_option('pix_h2_color') .';
	'.$h2_font.'
	font-size: '. pix_get_option('pix_h2_fontsize') .'em;
}
h3 {
	';

	if (pix_get_option('pix_enable_google')=='true') {
		$h3_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_h3_fontfamily')) .'";';
		if (strpos(pix_get_option('pix_h3_fontvariants'),'italic')!==false) {
			$h3_font .= 'font-style: italic;';
		}
		if (pix_get_option('pix_h3_fontvariants')!='' && strpos(pix_get_option('pix_h3_fontvariants'),'italic')===false) {
			$h3_font .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_h3_fontvariants'))) .';';
		}
	} else {
		$h3_font = '';
	}

	$out .= '
	color: '. pix_get_option('pix_h3_color') .';
	'.$h3_font.'
	font-size: '. pix_get_option('pix_h3_fontsize') .'em;
}
h4, h2.bundled_product_title {
	';

	if (pix_get_option('pix_enable_google')=='true') {
		$h4_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_h4_fontfamily')) .'";';
		if (strpos(pix_get_option('pix_h4_fontvariants'),'italic')!==false) {
			$h4_font .= 'font-style: italic;';
		}
		if (pix_get_option('pix_h4_fontvariants')!='' && strpos(pix_get_option('pix_h4_fontvariants'),'italic')===false) {
			$h4_font .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_h4_fontvariants'))) .';';
		}
	} else {
		$h4_font = '';
	}

	$out .= '
	color: '. pix_get_option('pix_h4_color') .';
	'.$h4_font.'
	font-size: '. pix_get_option('pix_h4_fontsize') .'em;
}
h5 {
	';

	if (pix_get_option('pix_enable_google')=='true') {
		$h5_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_h5_fontfamily')) .'";';
		if (strpos(pix_get_option('pix_h5_fontvariants'),'italic')!==false) {
			$h5_font .= 'font-style: italic;';
		}
		if (pix_get_option('pix_h5_fontvariants')!='' && strpos(pix_get_option('pix_h5_fontvariants'),'italic')===false) {
			$h5_font .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_h5_fontvariants'))) .';';
		}
	} else {
		$h5_font = '';
	}

	$out .= '
	color: '. pix_get_option('pix_h5_color') .';
	'.$h5_font.'
	font-size: '. pix_get_option('pix_h5_fontsize') .'em;
}
h6 {
	';

	if (pix_get_option('pix_enable_google')=='true') {
		$h6_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_h6_fontfamily')) .'";';
		if (strpos(pix_get_option('pix_h6_fontvariants'),'italic')!==false) {
			$h6_font .= 'font-style: italic;';
		}
		if (pix_get_option('pix_h6_fontvariants')!='' && strpos(pix_get_option('pix_h6_fontvariants'),'italic')===false) {
			$h6_font .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_h6_fontvariants'))) .';';
		}
	} else {
		$h6_font = '';
	}

	$out .= '
	color: '. pix_get_option('pix_h6_color') .';
	'.$h6_font.'
	font-size: '. pix_get_option('pix_h6_fontsize') .'em;
}
h1 a:hover,
h2 a:hover,
h3 a:hover,
h4 a:hover,
h5 a:hover,
h6 a:hover {
	background-color: '.pix_get_option('pix_headinghover_bg').';
}
';	
	$header_bg_image = pix_get_option('pix_header_bgimage')!='' ? 'url('.pix_remove_protocol(pix_get_option('pix_header_bgimage')).')' : '';
	$out .= '
#content_wrap > header > div.wrap_header {
	background: '.$header_bg_image.' '.pix_get_option('pix_header_bgimage_css').';
	background: '.$header_bg_image.' rgba('.hex2RGB ( pix_get_option('pix_header_bgcolor'), true ) .','. pix_get_option('pix_header_bgcolor_opacity') .') '.pix_get_option('pix_header_bgimage_css').';
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_header_bgcolor_opacity')) . pix_remove_something('#',pix_get_option('pix_header_bgcolor')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_header_bgcolor_opacity')) . pix_remove_something('#',pix_get_option('pix_header_bgcolor')).');
	border-bottom: 1px solid '.pix_get_option('pix_header_borderbottom').';
	border-top: 2px solid '.pix_get_option('pix_header_bordertop').';
	-webkit-box-shadow: '.pix_get_option('pix_header_shadow_x').'px '.pix_get_option('pix_header_shadow_y').'px '.pix_get_option('pix_header_shadow_blur').'px '.pix_get_option('pix_header_shadow_spread').'px rgba('.hex2RGB ( pix_get_option('pix_header_shadow_color'), true ) .',' . pix_get_option('pix_header_shadow_opacity') .');
	box-shadow: '.pix_get_option('pix_header_shadow_x').'px '.pix_get_option('pix_header_shadow_y').'px '.pix_get_option('pix_header_shadow_blur').'px '.pix_get_option('pix_header_shadow_spread').'px rgba('.hex2RGB ( pix_get_option('pix_header_shadow_color'), true ) .',' . pix_get_option('pix_header_shadow_opacity') .');
}
	';

	if (pix_get_option('pix_enable_google')=='true') {
		$logo_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_sitetitle_fontfamily')) .'";';
		if (strpos(pix_get_option('pix_sitetitle_fontvariants'),'italic')!==false) {
			$logo_font .= 'font-style: italic;';
		}
		if (pix_get_option('pix_sitetitle_fontvariants')!='' && strpos(pix_get_option('pix_sitetitle_fontvariants'),'italic')===false) {
			$logo_font .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_sitetitle_fontvariants'))) .';';
		}
	} else {
		$logo_font = '';
	}

	$out .= '
#logo {
	background-color: '.pix_get_option('pix_logo_bgcolor').';
	'.$logo_font.'
	font-size: '. pix_get_option('pix_sitetitle_fontsize') .'px;
}
#logo a, #logo a:hover {
	color: '.pix_get_option('pix_logo_color').';
}


#logo_subtitle {	';
	if (pix_get_option('pix_enable_google')=='true') {
		$out .= '
	font-family: "'. str_replace('+',' ',pix_get_option('pix_sitedescription_fontfamily')) .'";
		';
		if (strpos(pix_get_option('pix_sitedescription_fontvariants'),'italic')!==false) {
			$out .= 'font-style: italic;';
		}
		if (pix_get_option('pix_sitedescription_fontvariants')!='' && strpos(pix_get_option('pix_sitedescription_fontvariants'),'italic')===false) {
			$out .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_sitedescription_fontvariants'))) .';';
		}
	}
		$out .= '
		font-size: '. pix_get_option('pix_sitedescription_fontsize') .'px;
}
nav > div > ul > li {	';
	if (pix_get_option('pix_enable_google')=='true') {
		$out .= '
	font-family: "'. str_replace('+',' ',pix_get_option('pix_nav_1stlevel_fontfamily')) .'";
		';
		if (strpos(pix_get_option('pix_nav_1stlevel_fontvariants'),'italic')!==false) {
			$out .= 'font-style: italic;';
		}
		if (pix_get_option('pix_nav_1stlevel_fontvariants')!='' && strpos(pix_get_option('pix_nav_1stlevel_fontvariants'),'italic')===false) {
			$out .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_nav_1stlevel_fontvariants'))) .';';
		}
	}
		$out .= '
		font-size: '. pix_get_option('pix_nav_1stlevel_fontsize') .'px;
}
		';

	$out .= '
nav > div > ul > li > a {
	color: '.pix_get_option('pix_nav_1stcolor').';
}
nav > div > ul > li:hover{
	border-color: '. pix_get_option('pix_nav_1sthover_indicator') .';
}
nav > div > ul > li:hover > a {
	background: rgba('.hex2RGB ( pix_get_option('pix_nav_1sthover_bg'), true ) .','. pix_get_option('pix_nav_1sthover_bg_opacity') .');
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_nav_1sthover_bg_opacity')) . pix_remove_something('#',pix_get_option('pix_nav_1sthover_bg')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_nav_1sthover_bg_opacity')) . pix_remove_something('#',pix_get_option('pix_nav_1sthover_bg')).');
	color: '.pix_get_option('pix_nav_1sthover').';
}
nav > div > ul > li.current-menu-item {
	border-color: '.pix_get_option('pix_nav_current_indicator').';
}
nav > div > ul > li.current-menu-item > a {
	background: rgba('.hex2RGB ( pix_get_option('pix_nav_current_bg'), true ) .','. pix_get_option('pix_nav_current_bg_opacity') .');
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_nav_current_bg_opacity')) . pix_remove_something('#',pix_get_option('pix_nav_current_bg')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_nav_current_bg_opacity')) . pix_remove_something('#',pix_get_option('pix_nav_current_bg')).');
	color: '.pix_get_option('pix_nav_1scurrent').';
}
nav > div > ul > li.current-menu-item a:after {
	border-bottom: 5px dashed '.pix_get_option('pix_nav_current_indicator').';
}
nav .select_fake {
	background: '.pix_get_option('pix_nav_button_bg').';
	border-bottom: 1px solid '.pix_get_option('pix_nav_button_border').';
	color: '.pix_get_option('pix_nav_button').';
}
nav > div > ul > li > ul, 
nav > div > ul > li li > ul, 
nav > div > ul > li > div { ';
	if (pix_get_option('pix_enable_google')=='true') {
		$out .= '
	font-family: "'. str_replace('+',' ',pix_get_option('pix_nav_2ndlevel_fontfamily')) .'";
		';
		if (strpos(pix_get_option('pix_nav_2ndlevel_fontvariants'),'italic')!==false) {
			$out .= 'font-style: italic;';
		}
		if (pix_get_option('pix_nav_2ndlevel_fontvariants')!='' && strpos(pix_get_option('pix_nav_2ndlevel_fontvariants'),'italic')===false) {
			$out .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_nav_2ndlevel_fontvariants'))) .';';
		}
	}
		$out .= '
		font-size: '. pix_get_option('pix_nav_2ndlevel_fontsize') .'px;
}
nav > div > ul > li ul a,
nav .pix_mega_title small,
nav .close_x {
	color: '. pix_get_option('pix_nav_2ndcolor') .';
}
nav .pix_mega_title {
	color: '. pix_get_option('pix_nav_megatitles') .';
}
nav > div > ul > li > ul > span,
nav > div > ul > li > div > div,
nav > div > ul > li li > ul > span,
nav .totop_arrow,
nav .toleft_arrow,
nav .toright_arrow,
nav .close_x {
	background: rgba('.hex2RGB ( pix_get_option('pix_nav_2ndbg'), true ) .','. pix_get_option('pix_dropdown_2ndbgopacity') .');
}
.ie8 nav > div > ul > li > ul > span,
.ie8 nav > div > ul > li > div > div,
.ie8 nav > div > ul > li li > ul > span,
.ie8 nav .totop_arrow,
.ie8 nav .toleft_arrow,
.ie8 nav .toright_arrow,
.ie8 nav .close_x {
	background: '. pix_get_option('pix_nav_2ndbg') .';
}
nav > div > ul > li li:hover {
	background-color: '. pix_get_option('pix_nav_2ndhover_bg') .';
	border-color: '. pix_get_option('pix_nav_2ndhover_border') .';
}
nav > div > ul > li li:hover > a {
	color: '. pix_get_option('pix_nav_2ndhover') .';
}
.mega_clear > div {
	background: rgba('.hex2RGB ( pix_get_option('pix_mega_separator_color'), true ) .','. pix_get_option('pix_mega_separator_opacity') .');
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_mega_separator_opacity')) . pix_remove_something('#',pix_get_option('pix_mega_separator_color')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_mega_separator_opacity')) . pix_remove_something('#',pix_get_option('pix_mega_separator_color')).');
}
.ie8 .mega_clear > div {
	background: '. pix_get_option('pix_mega_separator_color') .';
}
.amount_appended, .onsale {
	background: ' . pix_get_option('pix_floatingicons_woocommerce_amount_bg') . ';
	color:  ' . pix_get_option('pix_floatingicons_woocommerce_amount_color') . ';
}
.filmore_commands {
	background: '.pix_get_option('pix_body_bgcolor').';
}
.filmore_command, .filmore_commands a {
	color:  ' . pix_get_option('pix_slideshow_commands_color') . ';
}
.filmore_pag > span {
	border: 2px solid ' . pix_get_option('pix_slideshow_commands_color') . ';
}
.filmore_pag.filmore_current_pag > span, .filmore_pag:hover > span {
	background: ' . pix_get_option('pix_slideshow_commands_color') . ';
}
	';
	if (pix_get_option('pix_enable_google')=='true') {
		$filmore_caption_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_slideshow_caption_fontfamily')) .'";';
	} else {
		$filmore_caption_font = '';
	}

	$out .= '
.filmore_caption {
	background: rgba('.hex2RGB ( pix_get_option('pix_slideshow_caption_bg'), true ) .','. pix_get_option('pix_slideshow_caption_bg_opacity') .');
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_slideshow_caption_bg_opacity')) . pix_remove_something('#',pix_get_option('pix_slideshow_caption_bg')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_slideshow_caption_bg_opacity')) . pix_remove_something('#',pix_get_option('pix_slideshow_caption_bg')).');
	color: ' . pix_get_option('pix_slideshow_caption_color') . ';
	' . $filmore_caption_font . '
}
	';
	$footer_bg_image = pix_get_option('pix_footer_bgimage')!='' ? 'url('.pix_remove_protocol(pix_get_option('pix_footer_bgimage')).')' : '';
	$out .= '
.pix_price_column {
	border: 1px solid ' . pix_get_option('pix_table_border') . ';
	border-top: 0;
}
.pix_price_column.highlighted {
	border: 5px solid ' . pix_get_option('pix_table_border_highlighted') . '!important;
}
.pix_price_column > div > div {
	border-top: 1px solid ' . pix_get_option('pix_table_border') . ';
}
.pix_price_checked [class^="icon-"] {
	color: ' . pix_get_option('pix_table_check_sign') . ';
}
.pix_price_unchecked [class^="icon-"] {
	color: ' . pix_get_option('pix_table_uncheck_sign') . ';
}
.pix_price_column .pix_price_header {
	background-color: ' . pix_get_option('pix_header_table_bg') . ';
	color: ' . pix_get_option('pix_header_text_color') . ';
	border-top: 0;
}
.pix_price_column .pix_price_header .tobottom_arrow {
	border-top: 6px dashed ' . pix_get_option('pix_header_table_bg') . ';
}
.pix_price_column > div > div.odd {
	background-color: ' . pix_get_option('pix_table_2nd_bg') . ';
}
footer {
	background: '.$footer_bg_image.' '.pix_get_option('pix_footer_bgimage_css').' '.pix_get_option('pix_footer_bgcolor').';
	border-top: 1px solid '.pix_get_option('pix_footer_border').';
	color: '.pix_get_option('pix_footer_color').';
}
footer h1,
footer h2,
footer h3,
footer h4,
footer h5,
footer h6 {
	color: '.pix_get_option('pix_footer_title').';
}
footer a {
	color: '.pix_get_option('pix_footer_link').';
}
footer li:before,
footer li a:before {
	color: '.pix_get_option('pix_footer_list_sign').';
}
footer li,
footer hr,
footer .widget_nav_menu li a,
footer .widget_pages li a {
  border-bottom: 1px solid '.pix_get_option('pix_footer_separator_color').';
}
footer .widget_calendar tfoot td {
  border-top: 1px solid '.pix_get_option('pix_footer_separator_color').';
  border-bottom: 1px solid '.pix_get_option('pix_footer_separator_color').';
}
footer .widget_calendar th {
  background-color: '.pix_get_option('pix_footer_soft_bg').';
}
	';
	$credits_bg_image = pix_get_option('pix_credits_bgimage')!='' ? 'url('.pix_remove_protocol(pix_get_option('pix_credits_bgimage')).')' : '';
	$out .= '
#pix_credits {
	background: '.$credits_bg_image.' '.pix_get_option('pix_credits_bgimage_css').' '.pix_get_option('pix_credits_bgcolor').';
	border-top: 1px solid '.pix_get_option('pix_credits_border').';
	color: '.pix_get_option('pix_credits_color').';
}
	';
	$aside_bg_image = pix_get_option('pix_aside_bgimage')!='' ? 'url('.pix_remove_protocol(pix_get_option('pix_aside_bgimage')).')' : '';
	$out .= '
.pix_sidebar {
	color: '.pix_get_option('pix_sidebar_text_color').';
	background: '.$aside_bg_image.' '.pix_get_option('pix_aside_bgimage_css').';
	background: '.$aside_bg_image.' '.pix_get_option('pix_aside_bgimage_css').' rgba('.hex2RGB ( pix_get_option('pix_aside_bgcolor'), true ) .','. pix_get_option('pix_aside_bgcolor_opacity') .');
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_aside_bgcolor_opacity')) . pix_remove_something('#',pix_get_option('pix_aside_bgcolor')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_aside_bgcolor_opacity')) . pix_remove_something('#',pix_get_option('pix_aside_bgcolor')).');
}
.pix_sidebar a {
	color: '.pix_get_option('pix_sidebar_link_color').';
}
.pix_sidebar li:before,
.pix_sidebar li a:before {
	color: '.pix_get_option('pix_sidebar_list_sign').';
}
.pix_sidebar li,
.pix_sidebar hr,
.pix_sidebar .widget_nav_menu li a,
.pix_sidebar .widget_pages li a {
  border-bottom: 1px solid '.pix_get_option('pix_aside_separators_color').';
}
.pix_sidebar #pix_search_advanced label:not(.fake_label), .pix_sidebar #login-register-password .pix_accordion > a, .pix_sidebar #login-register-password .pix_accordion > div > div {
	border-bottom: 1px solid '.pix_get_option('pix_aside_separators_color').'!important;
}
.pix_sidebar #login-register-password .pix_accordion > a.ui-pix-state-active {
	border-bottom: 0!important;
}
.pix_sidebar .widget_calendar tfoot td {
  border-top: 1px solid '.pix_get_option('pix_aside_separators_color').';
  border-bottom: 1px solid '.pix_get_option('pix_aside_separators_color').';
}
.pix_sidebar .widget_calendar th {
  background-color: '.pix_get_option('pix_aside_soft_bg').';
}
aside.toggleAside {
	color: '.pix_get_option('pix_slidaside_text_color').';
	background: '.$aside_bg_image.' '.pix_get_option('pix_slidaside_bgimage_css').' '.pix_get_option('pix_slidaside_bgcolor').';
}
aside.toggleAside a {
	color: '.pix_get_option('pix_slidaside_link_color').';
}
aside.toggleAside li:before,
aside.toggleAside li a:before {
	color: '.pix_get_option('pix_slidaside_list_sign').';
}
aside.toggleAside li,
aside.toggleAside hr,
aside.toggleAside .widget_nav_menu li a,
aside.toggleAside .widget_pages li a {
  border-bottom: 1px solid '.pix_get_option('pix_slidaside_separators_color').';
}
aside.toggleAside #pix_search_advanced label:not(.fake_label), aside.toggleAside #login-register-password .pix_accordion > a, aside.toggleAside #login-register-password .pix_accordion > div > div {
	border-bottom: 1px solid '.pix_get_option('pix_slidaside_separators_color').'!important;
}
aside.toggleAside #login-register-password .pix_accordion > a.ui-pix-state-active {
	border-bottom: 0!important;
}
aside.toggleAside .widget_calendar tfoot td {
  border-top: 1px solid '.pix_get_option('pix_slidaside_separators_color').';
  border-bottom: 1px solid '.pix_get_option('pix_slidaside_separators_color').';
}
aside.toggleAside .widget_calendar th {
  background-color: '.pix_get_option('pix_slidaside_soft_bg').';
}
aside.toggleAside .shadow {
	background: rgba('.hex2RGB ( pix_get_option('pix_slidaside_drag_cont_bgcolor'), true ) .','. pix_get_option('pix_slidaside_drag_cont_opacity') .');
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_slidaside_drag_cont_opacity')) . pix_remove_something('#',pix_get_option('pix_slidaside_drag_cont_bgcolor')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_slidaside_drag_cont_opacity')) . pix_remove_something('#',pix_get_option('pix_slidaside_drag_cont_bgcolor')).');
}
.pix_sidebar #pix_search_advanced button[type="submit"]:active,
aside.toggleAside #pix_search_advanced button[type="submit"]:active {
	border-width: 0!important;
}
.pix_sidebar #pix_search_advanced label:not(.fake_label):last-child,
aside.toggleAside #pix_search_advanced label:not(.fake_label):last-child {
	border-bottom: 0!important;
}
.pix_sidebar #pix_search_advanced .advanced_search_options,
.pix_sidebar #pix_search_advanced .advanced_toggle {
	box-shadow: 0px 1px 0px 0px rgba('.hex2RGB ( pix_get_option('pix_aside_separators_color'), true ) .', .8);
}
aside.toggleAside #pix_search_advanced .advanced_search_options,
aside.toggleAside #pix_search_advanced .advanced_toggle {
	box-shadow: 0px 1px 0px 0px rgba('.hex2RGB ( pix_get_option('pix_slidaside_separators_color'), true ) .', .8);
}
.pix_sidebar #pix_search_advanced .advanced_toggle.clicked,
aside.toggleAside #pix_search_advanced .advanced_toggle.clicked {
	box-shadow: none!important;
}
.jspDrag {
	background: rgba('.hex2RGB ( pix_get_option('pix_slidaside_drag_bgcolor'), true ) .','. pix_get_option('pix_slidaside_drag_opacity') .');
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_slidaside_drag_opacity')) . pix_remove_something('#',pix_get_option('pix_slidaside_drag_bgcolor')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_slidaside_drag_opacity')) . pix_remove_something('#',pix_get_option('pix_slidaside_drag_bgcolor')).');
}
.close_aside_left {
	border-top: 32px solid ' . pix_get_option('pix_slidaside_close_bg') .';
	color: ' . pix_get_option('pix_slidaside_close_color') .';
}
.close_aside_right {
	border-top: 32px solid ' . pix_get_option('pix_slidaside_close_bg') .';
	color: ' . pix_get_option('pix_slidaside_close_color') .';
}
	';
	$pix_divider_bg_image = pix_get_option('pix_title_section_bgimage')!='' ? 'background-image: url('.pix_remove_protocol(pix_get_option('pix_title_section_bgimage')).');' : '';
	$pix_divider_bg_repeat = pix_get_option('pix_title_section_bgprepeat')!='0' ? 'repeat' : 'no-repeat';
	$out .= '
.pix_divider {
	'.$pix_divider_bg_image.'
	background-color: '.pix_get_option('pix_title_section_bg_color').';
	background-attachment: '.pix_get_option('pix_title_section_widebg').';
	background-position: '.pix_get_option('pix_title_section_full_alignment').';
	background-repeat: '.$pix_divider_bg_repeat.';
	background-size: '.pix_get_option('pix_title_section_widebg').';
	-webkit-box-shadow: inset '.pix_get_option('pix_divider_shadow_x').'px '.pix_get_option('pix_divider_shadow_y').'px '.pix_get_option('pix_divider_shadow_blur').'px '.pix_get_option('pix_divider_shadow_spread').'px rgba('.hex2RGB ( pix_get_option('pix_divider_shadow_color'), true ) .',' . pix_get_option('pix_divider_shadow_opacity') .');
	box-shadow: inset '.pix_get_option('pix_divider_shadow_x').'px '.pix_get_option('pix_divider_shadow_y').'px '.pix_get_option('pix_divider_shadow_blur').'px '.pix_get_option('pix_divider_shadow_spread').'px rgba('.hex2RGB ( pix_get_option('pix_divider_shadow_color'), true ) .',' . pix_get_option('pix_divider_shadow_opacity') .');
	border-bottom: 1px solid '.pix_get_option('pix_divider_border').';
	border-top: 1px solid '.pix_get_option('pix_divider_border').';
	color: '.pix_get_option('pix_title_section_color').';
}
.pix_slideshow_wrap.firstSlideShow,
.pix_column_thumb .pix_audio_shortcode .jp-jplayer {
	'.$pix_divider_bg_image.'
	background-color: '.pix_get_option('pix_title_section_bg_color').';
	background-attachment: '.pix_get_option('pix_title_section_widebg').';
	background-position: '.pix_get_option('pix_title_section_full_alignment').';
	background-repeat: '.$pix_divider_bg_repeat.';
	background-size: '.pix_get_option('pix_title_section_widebg').';
}
.pix_divider > div > * > span {
	background-color: rgba('.hex2RGB ( pix_get_option('pix_title_lines_bgcolor'), true ) .','. pix_get_option('pix_title_lines_opacity') .');
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_title_lines_opacity')) . pix_remove_something('#',pix_get_option('pix_title_lines_bgcolor')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_title_lines_opacity')) . pix_remove_something('#',pix_get_option('pix_title_lines_bgcolor')).');
}
code, pre, #author-info, .postmetadata, .pix_tweet_sc > div, form.checkout .payment_box p, .pix_info, .col2-set.addresses .col-1, .col2-set.addresses .col-2, .order_details, .pix_accordion > div, .pix_tabs > ul > li.ui-state-active a, .pix_tabs > ul > li.active a, .pix_tabs > div, .pix_testimonials li .comment_testim, .demo_store {
	background: rgba('.hex2RGB ( pix_get_option('pix_secondary_bg'), true ) .','. pix_get_option('pix_secondary_bgcolor_opacity') .')!important;
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_secondary_bgcolor_opacity')) . pix_remove_something('#',pix_get_option('pix_secondary_bg')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_secondary_bgcolor_opacity')) . pix_remove_something('#',pix_get_option('pix_secondary_bg')).');
}
.pix_tabs > ul > li.ui-state-active a, .pix_tabs > ul > li.active a {
	color: '.pix_get_option('pix_general_text_color').';
}
.shop_attributes th {
	background: '.pix_get_option('pix_body_bgcolor').';
}
.pix_testimonials .testimonial_th.no_th {
	background: '.pix_get_option('pix_body_bgcolor').';
	border: 1px solid ' . pix_get_option('pix_hr_color') . ';
}
.pix_testimonials .tobottom_arrow {
	border-top: 8px solid '.pix_get_option('pix_secondary_bg').'; 
}
#pix_loader, #infscr-loading {
	background: rgba('.hex2RGB ( pix_get_option('pix_secondary_bg'), true ) .','. pix_get_option('pix_secondary_bgcolor_opacity') .')!important;
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_secondary_bgcolor_opacity')) . pix_remove_something('#',pix_get_option('pix_secondary_bg')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_secondary_bgcolor_opacity')) . pix_remove_something('#',pix_get_option('pix_secondary_bg')).');
	border: 1px solid ' . pix_get_option('pix_secondary_bg') . ';
}
form.checkout .payment_box .arrow_up {
	border-bottom: 5px dashed ' . pix_get_option('pix_secondary_bg') . ';
}
ul.order_details li {
	background: ' . pix_get_option('pix_secondary_bg') . ';
	border-right: 1px solid ' . pix_color_darken(pix_get_option('pix_hr_color'),3) . ';
}
hr {
	border-bottom: 1px solid ' . pix_get_option('pix_hr_color') . ';
}
hr.double, .entry-meta {
	border-top: 1px solid ' . pix_get_option('pix_hr_color') . ';
}
.comment_indent {
	border-bottom: 1px solid ' . pix_get_option('pix_hr_color') . ';
	border-left: 1px solid ' . pix_get_option('pix_hr_color') . ';
}
.filters_wrap {
	border-bottom: 1px solid ' . pix_get_option('pix_hr_color') . ';
	border-top: 1px solid ' . pix_get_option('pix_hr_color') . ';
}
.commentlist li .comment_container_wrap {
	border-left: 1px solid ' . pix_get_option('pix_hr_color') . ';
}
.pix_overlay_icon, .gallery-post-format .filmore_commands, .gallery .filmore_commands {
	background: rgba('.hex2RGB ( pix_get_option('pix_hover_icons_bg'), true ) .','. pix_get_option('pix_hover_icons_bg_opacity') .');
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_hover_icons_bg_opacity')) . pix_remove_something('#',pix_get_option('pix_hover_icons_bg')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_hover_icons_bg_opacity')) . pix_remove_something('#',pix_get_option('pix_hover_icons_bg')).');
	color:' . pix_get_option('pix_hover_icons_color') . ';
}
.gallery-post-format .filmore_command,
.gallery .filmore_command {
	color:' . pix_get_option('pix_hover_icons_color') . ';
}
.pix_overlay_border {
	background: rgba('.hex2RGB ( pix_get_option('pix_hover_bg'), true ) .','. pix_get_option('pix_hover_bg_opacity') .');
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_hover_bg_opacity')) . pix_remove_something('#',pix_get_option('pix_hover_bg')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_hover_bg_opacity')) . pix_remove_something('#',pix_get_option('pix_hover_bg')).');
	border: 1px solid ' . pix_get_option('pix_hover_bg_border') . ';
}
.filters_section .widget_price_filter {
	background: '.pix_get_option('pix_filter_price_bg').';
	-webkit-box-shadow: '.pix_get_option('pix_main_shadow_x').'px '.pix_get_option('pix_main_shadow_y').'px '.pix_get_option('pix_main_shadow_blur').'px '.pix_get_option('pix_main_shadow_spread').'px rgba('.hex2RGB ( pix_get_option('pix_main_shadow_color'), true ) .',' . pix_get_option('pix_main_shadow_opacity') .');
	box-shadow: '.pix_get_option('pix_main_shadow_x').'px '.pix_get_option('pix_main_shadow_y').'px '.pix_get_option('pix_main_shadow_blur').'px '.pix_get_option('pix_main_shadow_spread').'px rgba('.hex2RGB ( pix_get_option('pix_main_shadow_color'), true ) .',' . pix_get_option('pix_main_shadow_opacity') .');
}
.widget_price_filter:before {
	border-bottom: 8px dashed '.pix_get_option('pix_filter_price_bg').'; 
}
.filters_section .widget_price_filter .close_el {
	color: '.pix_get_option('pix_filter_price_range').';
}
.widget_price_filter .price_slider {
	background: '.pix_color_darken(pix_get_option('pix_filter_price_track')).';
	background: -moz-linear-gradient(
		top,
		'.pix_color_darken(pix_get_option('pix_filter_price_track')).' 0%,
		'.pix_get_option('pix_filter_price_track').');
	background: -webkit-gradient(
		linear, left top, left bottom, 
		from('.pix_color_darken(pix_get_option('pix_filter_price_track')).'),
		to('.pix_get_option('pix_filter_price_track').'));
	background: -o-linear-gradient(
		top,
		'.pix_color_darken(pix_get_option('pix_filter_price_track')).' 0%,
		'.pix_get_option('pix_filter_price_track').');
	border: 1px solid '.pix_color_darken(pix_get_option('pix_filter_price_track')).';
	-moz-box-shadow: 
		0px 1px 0px rgba('.hex2RGB ( pix_get_option('pix_filter_price_light_border'), true ) .',1);
	-webkit-box-shadow: 
		0px 1px 0px rgba('.hex2RGB ( pix_get_option('pix_filter_price_light_border'), true ) .',1);
}
.widget_price_filter .price_slider .ui-slider-handle {
	background: -moz-linear-gradient(
		top,
		'.pix_color_lighten(pix_get_option('pix_filter_price_dragger')).' 0%,
		'.pix_get_option('pix_filter_price_dragger').' 50%,
		'.pix_color_darken(pix_get_option('pix_filter_price_dragger')).');
	background: -webkit-gradient(
		linear, left top, left bottom, 
		from('.pix_color_lighten(pix_get_option('pix_filter_price_dragger')).'),
		color-stop(0.50, '.pix_get_option('pix_filter_price_dragger').'),
		to('.pix_color_darken(pix_get_option('pix_filter_price_dragger')).'));
	-moz-box-shadow:
		0px 1px 3px rgba('.hex2RGB ( pix_get_option('pix_filter_price_dark_border'), true ) .',0.7),
		inset 0px 0px 2px rgba('.hex2RGB ( pix_get_option('pix_filter_price_light_border'), true ) .',1);
	-webkit-box-shadow:
		0px 1px 3px rgba('.hex2RGB ( pix_get_option('pix_filter_price_dark_border'), true ) .',0.7),
		inset 0px 0px 2px rgba('.hex2RGB ( pix_get_option('pix_filter_price_light_border'), true ) .',1);
	box-shadow:
		0px 1px 3px rgba('.hex2RGB ( pix_get_option('pix_filter_price_dark_border'), true ) .',0.7),
		inset 0px 0px 2px rgba('.hex2RGB ( pix_get_option('pix_filter_price_light_border'), true ) .',1);
	text-shadow:
		0px -1px 0px rgba('.hex2RGB ( pix_get_option('pix_filter_price_dark_border'), true ) .',0.2),
		0px 1px 0px rgba('.hex2RGB ( pix_get_option('pix_filter_price_light_border'), true ) .',1);
}
.widget_price_filter .price_slider .ui-slider-handle:before {
	background: '.pix_get_option('pix_filter_price_track').';
	-moz-box-shadow:
		0px 1px 0px rgba('.hex2RGB ( pix_get_option('pix_filter_price_light_border'), true ) .',1);
	-webkit-box-shadow:
		0px 1px 0px rgba('.hex2RGB ( pix_get_option('pix_filter_price_light_border'), true ) .',1);
	box-shadow:
		0px 1px 0px rgba('.hex2RGB ( pix_get_option('pix_filter_price_light_border'), true ) .',1);
}
.widget_price_filter .price_slider .ui-slider-range {
	background: '.pix_color_darken(pix_get_option('pix_filter_price_range')).';
	background: -moz-linear-gradient(
		top,
		'.pix_get_option('pix_filter_price_range').' 0%,
		'.pix_color_darken(pix_get_option('pix_filter_price_range')).');
	background: -webkit-gradient(
		linear, left top, left bottom, 
		from('.pix_get_option('pix_filter_price_range').'),
		to('.pix_color_darken(pix_get_option('pix_filter_price_range')).'));
	background: -o-linear-gradient(
		top,
		'.pix_get_option('pix_filter_price_range').' 0%,
		'.pix_color_darken(pix_get_option('pix_filter_price_range')).');
}
	';
	$tiny_border = (pix_get_option('pix_tiny_button_border')!='' && pix_get_option('pix_tiny_button_border')!='transparent') ? 'border-bottom: 1px solid '.pix_get_option('pix_tiny_button_border').';' : '';
	if (pix_get_option('pix_enable_google')=='true') {
		$tiny_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_tiny_button_fontfamily')) .'";';
		if (strpos(pix_get_option('pix_tiny_button_fontvariants'),'italic')!==false) {
			$tiny_font .= 'font-style: italic;';
		}
		if (pix_get_option('pix_tiny_button_fontvariants')!='' && strpos(pix_get_option('pix_tiny_button_fontvariants'),'italic')===false) {
			$tiny_font .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_tiny_button_fontvariants'))) .';';
		}
	} else {
		$tiny_font = '';
	}
	$out .= '
.comment-reply-link,
.comment-edit-link,
#cancel-comment-reply-link,
.pix_widget_follow_link,
.pix_button.tiny_button {
	background: ' . pix_get_option('pix_tiny_button_bg') . '!important;
	' . $tiny_border . '
	color: ' . pix_get_option('pix_tiny_button_textcolor') . '!important;
	' . $tiny_font . '
	font-size: '. pix_get_option('pix_tiny_button_fontsize') .'em;
}
.pix_button:active, input[type="submit"]:active, .button.cancel:active {
	border-bottom-width: 1px!important;
}
.buttons_added input[type="button"], .shop_table td.product-remove a, .buttons_added input[type="button"].minus, .buttons_added input[type="button"].plus {
	background: ' . pix_get_option('pix_tiny_button_bg') . '!important;
	color: '.pix_get_option('pix_tiny_button_textcolor').';
}
.shop_table .odd td {
	background: '.pix_color_darken(pix_get_option('pix_body_bgcolor'),3).';
}
.shop_table th {
	border-bottom: 2px solid ' . pix_color_darken(pix_get_option('pix_hr_color'),3) . ';
}
.shop_table tfoot th , .shop_table td, .cart_totals {
	border-bottom: 1px solid ' . pix_color_darken(pix_get_option('pix_hr_color'),3) . ';
}
.shop_table td.actions {
	border-bottom: 2px solid ' . pix_color_darken(pix_get_option('pix_hr_color'),3) . ';
	border-top: 2px solid ' . pix_color_darken(pix_get_option('pix_hr_color'),3) . ';
}
.cart_totals table {
	border-top: 1px solid ' . pix_color_darken(pix_get_option('pix_hr_color'),3) . ';
}
	';
	$first_color_border = (pix_get_option('pix_first_color_button_border')!='' && pix_get_option('pix_first_color_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_first_color_button_border').'!important;' : 'border-bottom: 0!important;';
	if (pix_get_option('pix_enable_google')=='true') {
		$first_color_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_first_color_button_fontfamily')) .'";';
		if (strpos(pix_get_option('pix_first_color_button_fontvariants'),'italic')!==false) {
			$first_color_font .= 'font-style: italic;';
		}
		if (pix_get_option('pix_first_color_button_fontvariants')!='' && strpos(pix_get_option('pix_first_color_button_fontvariants'),'italic')===false) {
			$first_color_font .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_first_color_button_fontvariants'))) .';';
		}
	} else {
		$first_color_font = '';
	}
	$out .= '
.pix_button.first_color, input[type="submit"], button[type=submit] {
	background: ' . pix_get_option('pix_first_color_button_bg') . '!important;
	' . $first_color_border . '
	color: ' . pix_get_option('pix_first_color_button_textcolor') . '!important;
	' . $first_color_font . '
	font-size: '. pix_get_option('pix_first_color_button_fontsize') .'em;
}
.pix_accordion > a {
	background: ' . pix_get_option('pix_first_color_button_bg') . '!important;
	border-bottom-color: ' . pix_get_option('pix_first_color_button_border') . '!important;
	color: ' . pix_get_option('pix_first_color_button_textcolor') . '!important;
}
	';
	$simple_border = (pix_get_option('pix_simple_button_border')!='' && pix_get_option('pix_simple_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_simple_button_border').';' : 'border-bottom: 0!important;';
	if (pix_get_option('pix_enable_google')=='true') {
		$simple_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_simple_button_fontfamily')) .'";';
		if (strpos(pix_get_option('pix_simple_button_fontvariants'),'italic')!==false) {
			$simple_font .= 'font-style: italic;';
		}
		if (pix_get_option('pix_simple_button_fontvariants')!='' && strpos(pix_get_option('pix_simple_button_fontvariants'),'italic')===false) {
			$simple_font .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_simple_button_fontvariants'))) .';';
		}
	} else {
		$simple_font = '';
	}
	$out .= '
.pix_button.simple_button, .products .button, .price_slider_amount button {
	background: ' . pix_get_option('pix_simple_button_bg') . '!important;
	' . $simple_border . '
	color: ' . pix_get_option('pix_simple_button_textcolor') . '!important;
	' . $simple_font . '
	font-size: '. pix_get_option('pix_simple_button_fontsize') .'em;
}
    ';
    $second_color_border = (pix_get_option('pix_second_color_button_border')!='' && pix_get_option('pix_second_color_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_second_color_button_border').'!important;' : 'border-bottom: 0!important;';
    if (pix_get_option('pix_enable_google')=='true') {
        $second_color_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_second_color_button_fontfamily')) .'";';
        if (strpos(pix_get_option('pix_second_color_button_fontvariants'),'italic')!==false) {
            $second_color_font .= 'font-style: italic;';
        }
        if (pix_get_option('pix_second_color_button_fontvariants')!='' && strpos(pix_get_option('pix_second_color_button_fontvariants'),'italic')===false) {
            $second_color_font .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_second_color_button_fontvariants'))) .';';
        }
    } else {
        $second_color_font = '';
    }
    $out .= '
.pix_button.second_color,
.second_color,
input[type="submit"].second_color,
button.second_color,
.button.cancel,
.submitbutton#wp-submit {
    background: ' . pix_get_option('pix_second_color_button_bg') . '!important;
    ' . $second_color_border . '
    color: ' . pix_get_option('pix_second_color_button_textcolor') . '!important;
    ' . $second_color_font . '
    font-size: '. pix_get_option('pix_second_color_button_fontsize') .'em;
}
	';
    $third_color_border = (pix_get_option('pix_third_color_button_border')!='' && pix_get_option('pix_third_color_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_third_color_button_border').'!important;' : 'border-bottom: 0!important;';
    if (pix_get_option('pix_enable_google')=='true') {
        $third_color_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_third_color_button_fontfamily')) .'";';
        if (strpos(pix_get_option('pix_third_color_button_fontvariants'),'italic')!==false) {
            $third_color_font .= 'font-style: italic;';
        }
        if (pix_get_option('pix_third_color_button_fontvariants')!='' && strpos(pix_get_option('pix_third_color_button_fontvariants'),'italic')===false) {
            $third_color_font .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_third_color_button_fontvariants'))) .';';
        }
    } else {
        $third_color_font = '';
    }
    $out .= '
.pix_button.third_color,
.third_color,
input[type="submit"].third_color,
button.third_color {
    background: ' . pix_get_option('pix_third_color_button_bg') . '!important;
    ' . $third_color_border . '
    color: ' . pix_get_option('pix_third_color_button_textcolor') . '!important;
    ' . $third_color_font . '
    font-size: '. pix_get_option('pix_third_color_button_fontsize') .'em;
}
.pix_button.large {
    font-size: '. pix_get_option('pix_large_button_fontsize') .'em;
}
.pix_button.extra {
    font-size: '. pix_get_option('pix_extra_button_fontsize') .'em;
}
	';
	if ( pix_get_option('pix_button_footer')=='0' ) {
		$footer_simple_border = (pix_get_option('pix_footer_simple_button_border')!='' && pix_get_option('pix_footer_simple_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_footer_simple_button_border').';' : 'border-bottom: 0!important;';
		$out .= '
footer .pix_button.simple_button, footer .products .button, footer .price_slider_amount button {
	background: ' . pix_get_option('pix_footer_simple_button_bg') . ';
		' . $footer_simple_border . '
	color: ' . pix_get_option('pix_footer_simple_button_textcolor') . ';
}
		';
		$footer_tiny_border = (pix_get_option('pix_footer_tiny_button_border')!='' && pix_get_option('pix_footer_tiny_button_border')!='transparent') ? 'border-bottom: 1px solid '.pix_get_option('pix_footer_tiny_button_border').';' : '';
		$out .= '
footer .pix_widget_follow_link,
footer .pix_button.tiny_button {
	background: ' . pix_get_option('pix_footer_tiny_button_bg') . '!important;
		' . $footer_tiny_border . '
	color: ' . pix_get_option('pix_footer_tiny_button_textcolor') . '!important;
}
		';
		$footer_first_color_border = (pix_get_option('pix_footer_first_color_button_border')!='' && pix_get_option('pix_footer_first_color_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_footer_first_color_button_border').'!important;' : 'border-bottom: 0!important;';
		$out .= '
footer .pix_button.first_color, footer input[type="submit"], footer button {
	background: ' . pix_get_option('pix_footer_first_color_button_bg') . '!important;
		' . $footer_first_color_border . '
	color: ' . pix_get_option('pix_footer_first_color_button_textcolor') . '!important;
}
	    ';
	    $footer_second_color_border = (pix_get_option('pix_footer_second_color_button_border')!='' && pix_get_option('pix_footer_second_color_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_footer_second_color_button_border').'!important;' : 'border-bottom: 0!important;';
	    $out .= '
footer .second_color,
footer input[type="submit"].second_color,
footer .button.cancel,
footer .submitbutton#wp-submit {
    background: ' . pix_get_option('pix_footer_second_color_button_bg') . '!important;
	    ' . $footer_second_color_border . '
    color: ' . pix_get_option('pix_footer_second_color_button_textcolor') . '!important;
}
		';
	    $footer_third_color_border = (pix_get_option('pix_footer_third_color_button_border')!='' && pix_get_option('pix_footer_third_color_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_footer_third_color_button_border').'!important;' : 'border-bottom: 0!important;';
	    $out .= '
footer input[type="submit"].third_color,
footer .third_color {
    background: ' . pix_get_option('pix_footer_third_color_button_bg') . '!important;
    ' . $footer_third_color_border . '
    color: ' . pix_get_option('pix_footer_third_color_button_textcolor') . '!important;
}
	    ';
	}
	if ( pix_get_option('pix_button_aside')=='0' ) {
		$aside_simple_border = (pix_get_option('pix_aside_simple_button_border')!='' && pix_get_option('pix_aside_simple_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_aside_simple_button_border').'!important;' : 'border-bottom: 0!important;';
		$out .= '
.pix_sidebar .pix_button.simple_button, .pix_sidebar .products .button, .pix_sidebar .price_slider_amount button {
	background: ' . pix_get_option('pix_aside_simple_button_bg') . '!important;
		' . $aside_simple_border . '
	color: ' . pix_get_option('pix_aside_simple_button_textcolor') . '!important;
}
		';
		$aside_tiny_border = (pix_get_option('pix_aside_tiny_button_border')!='' && pix_get_option('pix_aside_tiny_button_border')!='transparent') ? 'border-bottom: 1px solid '.pix_get_option('pix_aside_tiny_button_border').'!important;' : '';
		$out .= '
.pix_sidebar .pix_widget_follow_link,
.pix_sidebar .pix_button.tiny_button {
	background: ' . pix_get_option('pix_aside_tiny_button_bg') . '!important;
		' . $aside_tiny_border . '
	color: ' . pix_get_option('pix_aside_tiny_button_textcolor') . '!important;
}
		';
		$aside_first_color_border = (pix_get_option('pix_aside_first_color_button_border')!='' && pix_get_option('pix_aside_first_color_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_aside_first_color_button_border').';' : 'border-bottom: 0!important;';
		$out .= '
.pix_sidebar .pix_button.first_color, .pix_sidebar input[type="submit"], .pix_sidebar button {
	background: ' . pix_get_option('pix_aside_first_color_button_bg') . '!important;
		' . $aside_first_color_border . '
	color: ' . pix_get_option('pix_aside_first_color_button_textcolor') . '!important;
}
	    ';
	    $aside_second_color_border = (pix_get_option('pix_aside_second_color_button_border')!='' && pix_get_option('pix_aside_second_color_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_aside_second_color_button_border').'!important;' : 'border-bottom: 0!important;';
	    $out .= '
.pix_sidebar .second_color,
.pix_sidebar input[type="submit"].second_color,
.pix_sidebar .button.cancel,
.pix_sidebar .submitbutton#wp-submit {
    background: ' . pix_get_option('pix_aside_second_color_button_bg') . '!important;
	    ' . $aside_second_color_border . '
    color: ' . pix_get_option('pix_aside_second_color_button_textcolor') . '!important;
}
		';
	    $aside_third_color_border = (pix_get_option('pix_aside_third_color_button_border')!='' && pix_get_option('pix_aside_third_color_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_aside_third_color_button_border').'!important;' : 'border-bottom: 0!important;';
	    $out .= '
.pix_sidebar input[type="submit"].third_color,
.pix_sidebar .third_color {
    background: ' . pix_get_option('pix_aside_third_color_button_bg') . '!important;
	    ' . $aside_third_color_border . '
    color: ' . pix_get_option('pix_aside_third_color_button_textcolor') . '!important;
}
		';
	}
	if ( pix_get_option('pix_button_slidaside')=='0' ) {
        $slideaside_simple_border = (pix_get_option('pix_slidaside_simple_button_border')!='' && pix_get_option('pix_slidaside_simple_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_slidaside_simple_button_border').';' : 'border-bottom: 0!important;';
        $out .= '
aside.toggleAside .pix_button.simple_button, aside.toggleAside .products .button, aside.toggleAside .price_slider_amount button {
    background: ' . pix_get_option('pix_slidaside_simple_button_bg') . '!important;
        ' . $slideaside_simple_border . '
    color: ' . pix_get_option('pix_slidaside_simple_button_textcolor') . '!important;
}
        ';
        $slideaside_tiny_border = (pix_get_option('pix_slidaside_tiny_button_border')!='' && pix_get_option('pix_slidaside_tiny_button_border')!='transparent') ? 'border-bottom: 1px solid '.pix_get_option('pix_slidaside_tiny_button_border').'!important;' : '';
        $out .= '
aside.toggleAside .pix_widget_follow_link,
aside.toggleAside .pix_button.tiny_button {
    background: ' . pix_get_option('pix_slidaside_tiny_button_bg') . '!important;
        ' . $slideaside_tiny_border . '
    color: ' . pix_get_option('pix_slidaside_tiny_button_textcolor') . '!important;
}
        ';
        $slideaside_first_color_border = (pix_get_option('pix_slidaside_first_color_button_border')!='' && pix_get_option('pix_slidaside_first_color_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_slidaside_first_color_button_border').';' : 'border-bottom: 0!important;';
        $out .= '
aside.toggleAside .pix_button.first_color, aside.toggleAside input[type="submit"], aside.toggleAside button {
    background: ' . pix_get_option('pix_slidaside_first_color_button_bg') . '!important;
        ' . $slideaside_first_color_border . '
    color: ' . pix_get_option('pix_slidaside_first_color_button_textcolor') . '!important;
}
        ';
        $slideaside_second_color_border = (pix_get_option('pix_slidaside_second_color_button_border')!='' && pix_get_option('pix_slidaside_second_color_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_slidaside_second_color_button_border').'!important;' : 'border-bottom: 0!important;';
        $out .= '
aside.toggleAside .second_color,
aside.toggleAside input[type="submit"].second_color,
aside.toggleAside .button.cancel,
aside.toggleAside .submitbutton#wp-submit {
    background: ' . pix_get_option('pix_slidaside_second_color_button_bg') . '!important;
        ' . $slideaside_second_color_border . '
    color: ' . pix_get_option('pix_slidaside_second_color_button_textcolor') . '!important;
}
        ';
        $slideaside_third_color_border = (pix_get_option('pix_slidaside_third_color_button_border')!='' && pix_get_option('pix_slidaside_third_color_button_border')!='transparent') ? 'border-bottom: 2px solid '.pix_get_option('pix_slidaside_third_color_button_border').'!important;' : 'border-bottom: 0!important;';
        $out .= '
aside.toggleAside .third_color,
aside.toggleAside input[type="submit"].third_color {
    background: ' . pix_get_option('pix_slidaside_third_color_button_bg') . '!important;
        ' . $slideaside_third_color_border . '
    color: ' . pix_get_option('pix_slidaside_third_color_button_textcolor') . '!important;
}
        ';
	}

	$out .= '
input[type="text"], input[type="password"], input[type="email"], input.input-text, textarea, select[multiple], .chzn-container-single .chzn-single, .shop_table .coupon input.input-text, .shipping_calculator input, ul.order_details, .col2-set.addresses .col-1, .col2-set.addresses .col-2 {
	background: ' . pix_get_option('pix_form_bg') . ';
	border-bottom: 1px solid ' . pix_get_option('pix_form_border_bottom') . ';
	border-top: 1px solid ' . pix_get_option('pix_form_border_top') . ';
	color: ' . pix_get_option('pix_form_color') . ';
}
.chzn-container-single .chzn-single {
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border: 0!important;
	border-bottom: 1px solid ' . pix_get_option('pix_form_border_top') . '!important;
	border-radius: 2px;
	-webkit-box-shadow: none!important;
	box-shadow: none!important;
	height: 34px!important;
	line-height: 30px!important;
	max-width: 365px;
}
	';
	if ( pix_get_option('pix_form_bg')==pix_get_option('pix_secondary_bg') ) {
		$out .= '
.pix_tabs input[type="text"], .pix_tabs input[type="password"], .pix_tabs input[type="email"], .pix_tabs input.input-text, .pix_tabs textarea, .pix_tabs select[multiple] {
	background-color: ' . pix_color_lighten(pix_get_option('pix_form_bg'),20) . ';
}
		';
	}
	$out .= '
#login-register-password .wp-user-form .username:after,
#login-register-password .wp-user-form .password:after,
#login-register-password .wp-user-form .email:after {
	background-color: rgba('.hex2RGB ( pix_get_option('pix_form_color'), true ) .',0.05);
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(0.05) . pix_remove_something('#',pix_get_option('pix_form_color')).', endColorstr=#'. pix_hex_opacity(0.05) . pix_remove_something('#',pix_get_option('pix_form_color')).');
	border-left: 1px solid ' . pix_get_option('pix_form_border_top') . ';
	border-right: 1px solid ' . pix_get_option('pix_form_border_top') . ';
}
.pix_contact_form .icon-calendar {
	color: ' . pix_get_option('pix_form_color') . ';	
}
.select_fake {
	background-color: ' . pix_get_option('pix_form_bg') . ';
	border-bottom: 1px solid ' . pix_get_option('pix_form_border_top') . ';
	color: ' . pix_get_option('pix_form_color') . ';
}
.pix_contact_form .label_error {
	color: ' . pix_get_option('pix_simple_error_color') . ';
}
.pix_success, .woocommerce_message, .woocommerce-message {
	background-color: ' . pix_get_option('pix_success_bg') . ';
	color: ' . pix_get_option('pix_success_color') . ';
}
.pix_error, .woocommerce_error, .woocommerce-error {
	background-color: ' . pix_get_option('pix_error_bg') . ';
	color: ' . pix_get_option('pix_error_color') . ';
}
.pix_question {
	background-color: ' . pix_get_option('pix_info_bg') . ';
	color: ' . pix_get_option('pix_info_color') . ';
}
	';
	if ( pix_get_option('pix_form_footer')=='0' ) {
		$out .= '
footer input[type="text"], footer input[type="password"], footer input[type="email"], footer input.input-text, footer textarea, footer select[multiple] {
	background-color: ' . pix_get_option('pix_form_footer_bg') . ';
	border-bottom: 1px solid ' . pix_get_option('pix_form_footer_border_bottom') . ';
	border-top: 1px solid ' . pix_get_option('pix_form_footer_border_top') . ';
	color: ' . pix_get_option('pix_form_footer_color') . ';
}
footer .pix_contact_form .icon-calendar {
	color: ' . pix_get_option('pix_form_footer_color') . ';	
}
footer .select_fake {
	background-color: ' . pix_get_option('pix_form_footer_bg') . ';
	border-bottom: 1px solid ' . pix_get_option('pix_form_footer_border_top') . ';
	color: ' . pix_get_option('pix_form_footer_color') . ';
}
footer .pix_contact_form .label_error {
	color: ' . pix_get_option('pix_simple_footer_error_color') . ';
}
footer .pix_success {
	background-color: ' . pix_get_option('pix_success_footer_bg') . ';
	color: ' . pix_get_option('pix_success_footer_color') . ';
}
footer .pix_error {
	background-color: ' . pix_get_option('pix_error_footer_bg') . ';
	color: ' . pix_get_option('pix_error_footer_color') . ';
}
footer .pix_question {
	background-color: ' . pix_get_option('pix_info_footer_bg') . ';
	color: ' . pix_get_option('pix_info_footer_color') . ';
}
		';
	}
    if ( pix_get_option('pix_form_aside')=='0' ) {
        $out .= '
.pix_sidebar input[type="text"], .pix_sidebar input[type="password"], .pix_sidebar input[type="email"], .pix_sidebar input.input-text, .pix_sidebar textarea, .pix_sidebar select[multiple] {
    background-color: ' . pix_get_option('pix_form_aside_bg') . ';
    border-bottom: 1px solid ' . pix_get_option('pix_form_aside_border_bottom') . ';
    border-top: 1px solid ' . pix_get_option('pix_form_aside_border_top') . ';
    color: ' . pix_get_option('pix_form_aside_color') . ';
}
.pix_sidebar .pix_contact_form .icon-calendar {
    color: ' . pix_get_option('pix_form_aside_color') . '; 
}
.pix_sidebar .select_fake {
    background-color: ' . pix_get_option('pix_form_aside_bg') . ';
    border-bottom: 1px solid ' . pix_get_option('pix_form_aside_border_top') . ';
    color: ' . pix_get_option('pix_form_aside_color') . ';
}
.pix_sidebar .pix_contact_form .label_error {
    color: ' . pix_get_option('pix_simple_aside_error_color') . ';
}
.pix_sidebar .pix_success {
    background-color: ' . pix_get_option('pix_success_aside_bg') . ';
    color: ' . pix_get_option('pix_success_aside_color') . ';
}
.pix_sidebar .pix_error {
    background-color: ' . pix_get_option('pix_error_aside_bg') . ';
    color: ' . pix_get_option('pix_error_aside_color') . ';
}
.pix_sidebar .pix_question {
    background-color: ' . pix_get_option('pix_info_aside_bg') . ';
    color: ' . pix_get_option('pix_info_aside_color') . ';
}
        ';
    }
    if ( pix_get_option('pix_form_slidaside')=='0' ) {
        $out .= '
aside.toggleAside input[type="text"], aside.toggleAside input[type="password"], aside.toggleAside input[type="email"], aside.toggleAside input.input-text, aside.toggleAside textarea, aside.toggleAside select[multiple] {
    background-color: ' . pix_get_option('pix_form_slidaside_bg') . ';
    border-bottom: 1px solid ' . pix_get_option('pix_form_slidaside_border_bottom') . ';
    border-top: 1px solid ' . pix_get_option('pix_form_slidaside_border_top') . ';
    color: ' . pix_get_option('pix_form_slidaside_color') . ';
}
aside.toggleAside .pix_contact_form .icon-calendar {
    color: ' . pix_get_option('pix_form_slidaside_color') . '; 
}
aside.toggleAside .select_fake {
    background-color: ' . pix_get_option('pix_form_slidaside_bg') . ';
    border-bottom: 1px solid ' . pix_get_option('pix_form_slidaside_border_top') . ';
    color: ' . pix_get_option('pix_form_slidaside_color') . ';
}
aside.toggleAside .pix_contact_form .label_error {
    color: ' . pix_get_option('pix_simple_slidaside_error_color') . ';
}
aside.toggleAside .pix_success {
    background-color: ' . pix_get_option('pix_success_slidaside_bg') . ';
    color: ' . pix_get_option('pix_success_slidaside_color') . ';
}
aside.toggleAside .pix_error {
    background-color: ' . pix_get_option('pix_error_slidaside_bg') . ';
    color: ' . pix_get_option('pix_error_slidaside_color') . ';
}
aside.toggleAside .pix_question {
    background-color: ' . pix_get_option('pix_info_slidaside_bg') . ';
    color: ' . pix_get_option('pix_info_slidaside_color') . ';
}
.pix_sidebar #pix_search_advanced .advanced_toggle, 
.pix_sidebar #login-register-password .pix_accordion > div, 
.pix_sidebar #pix_search_advanced .advanced_search_options,
.pix_sidebar #login-register-password .pix_accordion > a,
.pix_sidebar .widget_layered_nav small.count {
    background: ' . pix_get_option('pix_aside_accordion_bgcolor') . '!important;
}

aside.toggleAside #pix_search_advanced .advanced_toggle,
aside.toggleAside #login-register-password .pix_accordion > div,
aside.toggleAside #pix_search_advanced .advanced_search_options,
aside.toggleAside #login-register-password .pix_accordion > a,
aside.toggleAside .widget_layered_nav small.count {
    background: ' . pix_get_option('pix_slidaside_accordion_bgcolor') . '!important;
}
	';
	}
	$out .= '
#pix_tooltip {
	background: rgba('.hex2RGB ( pix_get_option('pix_tooltips_bg'), true ) .','. pix_get_option('pix_tooltips_bg_opacity') .');
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_tooltips_bg_opacity')) . pix_remove_something('#',pix_get_option('pix_tooltips_bg')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_tooltips_bg_opacity')) . pix_remove_something('#',pix_get_option('pix_tooltips_bg')).');
	color: ' . pix_get_option('pix_tooltips_color') . ';
}
#pix_tooltip a {
	color: ' . pix_get_option('pix_tooltips_color_links') . ';
}
#pix_tooltip_arrow.tobottom_arrow {
	border-top: 4px solid ' . pix_get_option('pix_tooltips_bg') . ';
	opacity: ' . pix_get_option('pix_tooltips_bg_opacity') . ';
}
#pix_tooltip_arrow.totop_arrow {
	border-bottom: 4px solid ' . pix_get_option('pix_tooltips_bg') . '; 
	opacity: ' . pix_get_option('pix_tooltips_bg_opacity') . ';
}
	';
	if (pix_get_option('pix_enable_google')=='true') {
		$pagenavi_font = 'font-family: "'. str_replace('+',' ',pix_get_option('pix_pagenavi_fontfamily')) .'";';
		if (strpos(pix_get_option('pix_pagenavi_fontvariants'),'italic')!==false) {
			$pagenavi_font .= 'font-style: italic;';
		}
		if (pix_get_option('pix_pagenavi_fontvariants')!='' && strpos(pix_get_option('pix_pagenavi_fontvariants'),'italic')===false) {
			$pagenavi_font .= 'font-weight: '. str_replace('italic','',pix_font_variant_hack(pix_get_option('pix_pagenavi_fontvariants'))) .';';
		}
	} else {
		$pagenavi_font = '';
	}
	$out .= '
.pagenavi, .page-link {
	' . $pagenavi_font . '
}
.pagenavi a, .page-link a {
	color: ' . pix_get_option('pix_pagenavi_link_color') . ';
}
.pagenavi .current, .page-link > span {
	background: ' . pix_get_option('pix_pagenavi_current_bg') . ';
	color: ' . pix_get_option('pix_pagenavi_current_color') . ';
}
.product_list_widget li .amount, .cart .amount, .summary .reset_variations:before, .products ins, .cart_totals .total td, .products ins, .cart_totals .order-total td {
	color: ' . pix_get_option('pix_general_highlighted_color') . ';
}
.pix_sidebar .cart_list li .amount {
	color: ' . pix_get_option('pix_aside_highlighted_color') . ';
}
aside.toggleAside .cart_list li .amount {
	color: ' . pix_get_option('pix_slidaside_highlighted_color') . ';
}
footer .cart_list li .amount {
	color: ' . pix_get_option('pix_footer_highlighted_color') . ';
}
.click_scroll_down, .click_scroll_up {
	background: rgba('.hex2RGB ( pix_get_option('pix_scroll_button_bg'), true ) .','. pix_get_option('pix_scroll_button_bg_opacity') .');
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_scroll_button_bg_opacity')) . pix_remove_something('#',pix_get_option('pix_scroll_button_bg')).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_scroll_button_bg_opacity')) . pix_remove_something('#',pix_get_option('pix_scroll_button_bg')).');
	color: '. pix_get_option('pix_scroll_button_color') .';
}
.pix_simple_grid .entry-content, #reviews .commentlist li {
	background: '.pix_get_option('pix_body_bgcolor').';
}
.pix_simple_grid .pix_column_thumb {
	-webkit-box-shadow: 0px 1px 2px 0px rgba('.hex2RGB ( pix_get_option('pix_general_text_color'), true ) .', 0.5);
	box-shadow: 0px 1px 2px 0px rgba('.hex2RGB ( pix_get_option('pix_general_text_color'), true ) .', 0.5);
}
.entry-sliding-content {
	background: '.pix_get_option('pix_body_bgcolor').';
	-webkit-box-shadow: '.pix_get_option('pix_main_shadow_x').'px '.pix_get_option('pix_main_shadow_y').'px '.pix_get_option('pix_main_shadow_blur').'px '.pix_get_option('pix_main_shadow_spread').'px rgba('.hex2RGB ( pix_get_option('pix_main_shadow_color'), true ) .',' . pix_get_option('pix_main_shadow_opacity') .');
	box-shadow: '.pix_get_option('pix_main_shadow_x').'px '.pix_get_option('pix_main_shadow_y').'px '.pix_get_option('pix_main_shadow_blur').'px '.pix_get_option('pix_main_shadow_spread').'px rgba('.hex2RGB ( pix_get_option('pix_main_shadow_color'), true ) .',' . pix_get_option('pix_main_shadow_opacity') .');
}
.entry-sliding-arrow {
	border-bottom: 6px dashed '.pix_get_option('pix_body_bgcolor').';
}
.entry-sliding-arrow.toTop {
	border-top: 6px dashed '.pix_get_option('pix_body_bgcolor').';
}
.entry-meta .done [class^="icon-"], .likes-list .icon-heart, .likeThis.done [class^="icon-"] {
	color: '.pix_get_option('pix_like_color').';
}
.pix_sidebar .widget_calendar tbody td a {
	background: '.pix_get_option('pix_aside_soft_bg').';
}
.pix_sidebar .widget_calendar tbody td#today {
	background: '.pix_get_option('pix_aside_soft_bg').';
	color: '.pix_get_option('pix_sidebar_link_color').';
}
.pix_sidebar .pix_side_comments .comment, .pix_sidebar .widget_pixrecentposts .entry-widget, .pix_sidebar .pix_row.tweets {
	border-bottom: 1px solid '.pix_get_option('pix_aside_separators_color').';
}
footer .widget_calendar tbody td a {
	background: '.pix_get_option('pix_footer_soft_bg').';
}
footer .widget_calendar tbody td#today {
	background: '.pix_get_option('pix_footer_soft_bg').';
	color: '.pix_get_option('pix_footer_link').';
}
footer .pix_side_comments .comment, footer .widget_pixrecentposts .entry-widget, footer .pix_row.tweets {
	border-bottom: 1px solid '.pix_get_option('pix_footer_separator_color').';
}
aside.toggleAside .widget_calendar tbody td a {
	background: '.pix_get_option('pix_slidaside_soft_bg').';
}
aside.toggleAside .widget_calendar tbody td#today {
	background: '.pix_get_option('pix_slidaside_soft_bg').';
	color: '.pix_get_option('pix_slidaside_link_color').';
}
aside.toggleAside .pix_side_comments .comment, aside.toggleAside .widget_pixrecentposts .entry-widget, aside.toggleAside .pix_row.tweets {
	border-bottom: 1px solid '.pix_get_option('pix_slidaside_separators_color').';
}   ';

	if(pix_get_option('pix_customstyles')!='') {
		$out .= pix_get_option('pix_customstyles') ;
	}
	
	
	$slideshows = pix_get_option('pix_array_your_slideshows_');

	if ( !empty($slideshows) && isset($slideshows) ) {

		
		foreach($slideshows as $slideshow) {
			$pix_array_your_slideshow = pix_get_option('pix_array_your_slideshows_'.$slideshow); 
			
			if ( $pix_array_your_slideshow['until'] != '' ) {
	
				$out .= '@media only screen and (max-width: '.$pix_array_your_slideshow['until'].'px) {
					#pix_slideshow_'.$slideshow.' .pix_slideshow_until_image {
						display: block;
					}
					#pix_slideshow_'.$slideshow.' .pix_slideshow_target, #pix_slideshow_'.$slideshow.' .filmore_commands {
						display: none;
					}
					.pix_slideshow_preloading .pix_canvasloader-container {
						display: none;
					}
				}';
				
			}
					
			if ( $pix_array_your_slideshow['under'] != '' ) {
	
				$out .= '@media only screen and (min-width: '.$pix_array_your_slideshow['under'] .'px) {
					#pix_slideshow_'.$slideshow.' .pix_slideshow_target, #pix_slideshow_'.$slideshow.' .filmore_commands {
						display: none;
					}
				}';
				
			}
			
		}
	}

	$out = str_replace("	", "", $out);
	$out = str_replace("\n", "", $out);
	
	echo $out;
?>