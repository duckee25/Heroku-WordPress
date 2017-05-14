<?php

function google_font_list(){
	global $options;
	if ($_GET['page']=='google_font_list') { 
	
$name = $_GET['name'];
$variants = $_GET['variants'];
$subsets = $_GET['subsets'];

	$font_families = pix_get_option('pix_font_families');
	$font_variants = pix_get_option('pix_font_variants');
	$font_subsets = pix_get_option('pix_font_subsets');
	
	$out = '<div id="font_list">';
	$out .= '<div class="alignleft">';
	$out .= '<em>Font family</em><br>';
	$out .= '<select name="'.$name.'" class="main_list">';
	$out .= '<option value="" '.selected( pix_get_option($name), '', false ).'>Not a Google Font</option>';
	foreach ( $font_families as $key => $item )
	{
		$out .= '<option value="'.str_replace(' ','+',$item).'" '.selected( pix_get_option($name), str_replace(' ','+',$item), false ).' data-value="'.sanitize_title($item).'" data-variants="'.implode(' ',$font_variants[$key]).'" data-subsets="'.implode(' ',$font_subsets[$key]).'">'.$item.'</option>';
	}
	$out .= '</select>';
	$out .= '</div>';
	
	if($variants!=''){
		
		$out .= '<input type="hidden" name="'.$variants.'" value="'.pix_get_option($variants).'" class="select_variants_fake">';
		$out .= '<div class="alignleft block_small">';
		$out .= '<em>Font variant</em><br>';
		foreach ( $font_variants as $key => $item ) {
			if ( $item != '' ) {
				$out .= '<select class="select_variants_fake" data-variant="'.sanitize_title($font_families[$key]).'">';
					foreach ( $item as $variant ) {
						$out .= '<option value="'.$variant.'" '.selected( pix_get_option($variants), $variant, false ).'">'.$variant.'</option>';
					}
				$out .= '</select>';
			}
		}
		$out .= '</div>';
	
	}

	$out .= '<input type="hidden" name="'.$subsets.'" value="'.pix_get_option($subsets).'" class="select_subsets_fake">';
	$out .= '<div class="width_wide">';
	$out .= '<div class="clear more_space"></div>';
	$out .= '<em>Font subset</em><br>';
	foreach ( $font_subsets as $key => $item ) {
		if ( $item != '' ) {
			$out .= '<select class="select_subsets_fake" data-variant="'.sanitize_title($font_families[$key]).'" multiple>';
				foreach ( $item as $subset ) {
					if ((in_array($subset,explode(',',pix_get_option($subsets))) || $subset == pix_get_option($subsets))) { $selected = ' selected="selected"'; } else { $selected = ''; }
					$out .= '<option value="'.$subset.'"'.$selected.'">'.$subset.'</option>';
				}
			$out .= '</select>';
		}
	}
	$out .= '</div>';
	$out .= '</div>';
	
	echo $out;
}
}

?>