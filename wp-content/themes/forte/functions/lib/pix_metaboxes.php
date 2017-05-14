<?php

add_action( 'add_meta_boxes', 'pix_meta_box_add' );
function pix_meta_box_add()
{
	$post_types = array('page','post','portfolio','product','ciccio');
    foreach ( $post_types as $post_type ) {
		
		if( $post_type == 'post' || $post_type == 'portfolio' || $post_type == 'product' ) {
			add_meta_box( 'pix_page_template', 'Page template', 'pix_page_template', $post_type, 'side', 'high' );
			add_meta_box( 'pix_thumb_size', 'Featured image properties', 'pix_thumb_size', $post_type, 'side', 'low' );
		}

		if( $post_type == 'page' || $post_type == 'portfolio' || $post_type == 'post' ) {
            add_meta_box( 'pix_page_builder', 'Hidden meta', 'pix_page_builder', $post_type, 'normal', 'low' );
            add_meta_box( 'pix_page_builder_content', 'Hidden meta', 'pix_page_builder_content', $post_type, 'normal', 'low' );
		}

		if( $post_type == 'portfolio' ) {
			add_meta_box( 'pix_post_format', 'Format', 'pix_post_format', $post_type, 'side', 'high' );
		}

			add_meta_box( 'pix_page_options', 'Page options', 'pix_meta_page_options', $post_type, 'normal', 'high' );
	
			add_meta_box( 'pix_page_seo', 'SEO', 'pix_page_seo', $post_type, 'normal', 'high' );
	
			add_meta_box( 'pix_sidebar_select', 'Sidebars', 'pix_sidebar_meta', $post_type, 'side', 'high' );
	
			add_meta_box( 'pix_meta_edittext', 'Hidden meta', 'pix_meta_edittext', $post_type, 'normal', 'low' );
	
			add_meta_box( 'pix_meta_googlemap', 'Hidden meta', 'pix_meta_googlemap', $post_type, 'normal', 'low' );
	
			add_meta_box( 'pix_meta_contactform', 'Hidden meta', 'pix_meta_contactform', $post_type, 'normal', 'low' );
	
			add_meta_box( 'pix_meta_tooltip', 'Hidden meta', 'pix_meta_tooltip', $post_type, 'normal', 'low' );
	
			add_meta_box( 'pix_meta_video', 'Hidden meta', 'pix_meta_video', $post_type, 'normal', 'low' );
	
			add_meta_box( 'pix_meta_audio', 'Hidden meta', 'pix_meta_audio', $post_type, 'normal', 'low' );
	
			add_meta_box( 'pix_meta_accordion', 'Hidden meta', 'pix_meta_accordion', $post_type, 'normal', 'low' );
	
			add_meta_box( 'pix_meta_tab', 'Hidden meta', 'pix_meta_tab', $post_type, 'normal', 'low' );
	
			add_meta_box( 'pix_meta_box', 'Hidden meta', 'pix_meta_box', $post_type, 'normal', 'low' );
	
			add_meta_box( 'pix_meta_button', 'Hidden meta', 'pix_meta_button', $post_type, 'normal', 'low' );
	
			add_meta_box( 'pix_meta_pricetable', 'Hidden meta', 'pix_meta_pricetable', $post_type, 'normal', 'low' );
	
			add_meta_box( 'pix_meta_tweets', 'Hidden meta', 'pix_meta_tweets', $post_type, 'normal', 'low' );
	
			add_meta_box( 'pix_meta_galleries', 'Hidden meta', 'pix_meta_galleries', $post_type, 'normal', 'low' );
	
			add_meta_box( 'pix_meta_categories', 'Hidden meta', 'pix_meta_categories', $post_type, 'normal', 'low' );
    
            add_meta_box( 'pix_meta_slideshow', 'Hidden meta', 'pix_meta_slideshow', $post_type, 'normal', 'low' );
    
            add_meta_box( 'pix_meta_testimonial_sc', 'Hidden meta', 'pix_meta_testimonial_sc', $post_type, 'normal', 'low' );
	}

    add_meta_box( 'pix_meta_testimonial', 'Other info', 'pix_meta_testimonial', 'testimonial', 'normal', 'high' );

}

function pix_meta_testimonial( $post )
{
    $values = get_post_custom( $post->ID );
    $pix_testimonial_info = isset( $values['pix_testimonial_info'] ) ? esc_attr( $values['pix_testimonial_info'][0] ) : '';
    wp_nonce_field( 'pix_meta_testimonial_nonce', 'pix_meta_testimonial_nonce' );
    ?>
    <div class="pix_meta_boxes">
        <p>
            <label for="pix_testimonial_info">Other info</label><br>
            <div class="field_wrap"><input type="text" name="pix_testimonial_info" id="pix_testimonial_info" value="<?php echo $pix_testimonial_info; ?>"></div>
        </p>

        <div class="clear"></div>
        
 
    </div><!-- .pix_meta_boxes -->
    <?php   
}


add_action( 'save_post', 'pix_meta_testimonial_save' );
function pix_meta_testimonial_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['pix_meta_testimonial_nonce'] ) || !wp_verify_nonce( $_POST['pix_meta_testimonial_nonce'], 'pix_meta_testimonial_nonce' ) ) return;
    
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
    
    if( isset( $_POST['pix_testimonial_info'] ) )
        update_post_meta( $post_id, 'pix_testimonial_info', esc_attr( $_POST['pix_testimonial_info'] ) );
        
}

function pix_meta_page_options( $post )
{
	$values = get_post_custom( $post->ID );
	$post_type = get_post_type();
	$pix_hidden_field = isset( $values['pix_hidden_field'] ) ? esc_attr( $values['pix_hidden_field'][0] ) : '';
	$pix_editor_field = isset( $values['pix_editor_field'] ) ? esc_attr( $values['pix_editor_field'][0] ) : '';
	$pix_meta_bg = isset( $values['pix_meta_bg'] ) ? esc_attr( $values['pix_meta_bg'][0] ) : '';
	$pix_meta_repeat = isset( $values['pix_meta_repeat'] ) ? esc_attr( $values['pix_meta_repeat'][0] ) : '';
	$pix_meta_widebg = isset( $values['pix_meta_widebg'] ) ? esc_attr( $values['pix_meta_widebg'][0] ) : '';
	$pix_meta_portrait = isset( $values['pix_meta_portrait'] ) ? esc_attr( $values['pix_meta_portrait'][0] ) : '';
	$pix_meta_attachment = isset( $values['pix_meta_attachment'] ) ? esc_attr( $values['pix_meta_attachment'][0] ) : '';
	$pix_meta_alignment = isset( $values['pix_meta_alignment'] ) ? esc_attr( $values['pix_meta_alignment'][0] ) : '';
	$pix_pag_opts_subtitle = isset( $values['pix_pag_opts_subtitle'] ) ? esc_attr( $values['pix_pag_opts_subtitle'][0] ) : '';
	$pix_color_title = isset( $values['pix_color_title'] ) ? esc_attr( $values['pix_color_title'][0] ) : '';
	$pix_color_title = isset( $values['pix_color_title'] ) ? esc_attr( $values['pix_color_title'][0] ) : '';
	$pix_bg_title = isset( $values['pix_bg_title'] ) ? esc_attr( $values['pix_bg_title'][0] ) : '';
	$pix_bg_title_lines = isset( $values['pix_bg_title_lines'] ) ? esc_attr( $values['pix_bg_title_lines'][0] ) : '';
	$pix_opacity_title_lines = isset( $values['pix_opacity_title_lines'] ) ? esc_attr( $values['pix_opacity_title_lines'][0] ) : '';
	$pix_pag_opts_hidetitle = isset( $values['pix_pag_opts_hidetitle'] ) ? esc_attr( $values['pix_pag_opts_hidetitle'][0] ) : '';
	$pix_pag_opts_share = isset( $values['pix_pag_opts_share'] ) ? esc_attr( $values['pix_pag_opts_share'][0] ) : '';
	wp_nonce_field( 'pix_page_options_nonce', 'pix_page_options_nonce' );
	?>
    <div class="pix_meta_boxes">
        <input type="hidden" name="pix_hidden_field" value="<?php echo $pix_hidden_field; ?>">
        <?php if ( $post_type == 'post' || $post_type == 'page' || $post_type == 'portfolio' ) { ?>
        <p>
            <label for="pix_editor_field">Disable the page builder:
            <input type="checkbox" name="pix_editor_field" <?php checked( $pix_editor_field, 'on' ); ?>></label>
            <br><small>Tick to disable it, but please, pay attention and read the message when the dialog box will open. <strong>Update after changing this option</strong></small>
        </p>
        <?php } ?>
        
        <?php if ( $post_type == 'page' ) { ?>
        <p>
            <label for="pix_meta_bg">Enable the custom background for the title section:
            <input type="checkbox" name="pix_meta_bg" <?php checked( $pix_meta_bg, 'on' ); ?>></label>
        </p>
        
        <div class="clear"></div>

        <div>
            <label for="pix_bg_title">Background color of the section</label><br>
            <div class="pix_color_picker">
                <input name="pix_bg_title" type="text" id="pix_bg_title" value="<?php echo $pix_bg_title=='' ? 'Set a color' : $pix_bg_title; ?>">
                <div class="pix_palette"></div>
                <div class="colorpicker"></div>
            </div>
        </div>
        
        <div class="clear"></div>

        <p>
            <label for="pix_meta_widebg">Custom background image:</label>
            <div class="field_wrap">
                <div class="pix_upload_image">
                    <div class="pix_image_thumb"><img alt="Preview" src="<?php if($pix_meta_widebg!=''){ echo get_pix_thumb($pix_meta_widebg, 'mini_preview'); } else { echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; } ?>"></div>
                    <input name="pix_meta_widebg" type="text" value="<?php echo $pix_meta_widebg; ?>">
                    <div class="pix_upload_image_button">
                        <a href="#" class="button">upload</a>
                    </div>
                </div><!-- .pix_upload_image -->
            </div><!-- .field_wrap -->
        </p>
            
        <div class="clear"></div>

        <p>
            <label for="pix_meta_portrait">Background size</label>
            <select name="pix_meta_portrait" id="pix_meta_portrait">
                <option value="auto" <?php selected( $pix_meta_portrait, '' ); ?>>normal</option>
                <option value="cover" <?php selected( $pix_meta_portrait, 'cover' ); ?>>fullscreen</option>
                <option value="contain" <?php selected( $pix_meta_portrait, 'contain' ); ?>>portrait</option>
            </select>
        </p>
            
       <p>
            <label for="pix_meta_repeat">Background repeat
            <input type="checkbox" name="pix_meta_repeat" <?php checked( $pix_meta_repeat, 'on' ); ?>></label>
        </p>
        
        <p>
            <label for="pix_meta_alignment">Background alignment</label>
            <select name="pix_meta_alignment" id="pix_meta_alignment">
                <option value="center" <?php selected( $pix_meta_alignment, 'center' ); ?>>center</option>
                <option value="left top" <?php selected( $pix_meta_alignment, 'left top' ); ?>>left top</option>
                <option value="right top" <?php selected( $pix_meta_alignment, 'right top' ); ?>>right top</option>
                <option value="center top" <?php selected( $pix_meta_alignment, 'center top' ); ?>>center top</option>
                <option value="left center" <?php selected( $pix_meta_alignment, 'left center' ); ?>>left center</option>
                <option value="right center" <?php selected( $pix_meta_alignment, 'right center' ); ?>>right center</option>
                <option value="left bottom" <?php selected( $pix_meta_alignment, 'left bottom' ); ?>>left bottom</option>
                <option value="center bottom" <?php selected( $pix_meta_alignment, 'center bottom' ); ?>>center bottom</option>
                <option value="right bottom" <?php selected( $pix_meta_alignment, 'right bottom' ); ?>>right bottom</option>
            </select>
        </p>
            
        <p>
            <label for="pix_meta_attachment">Background attachment</label>
            <select name="pix_meta_attachment" id="pix_meta_attachment">
                <option value="scroll" <?php selected( $pix_meta_attachment, 'scroll' ); ?>>scroll</option>
                <option value="fixed" <?php selected( $pix_meta_attachment, 'fixed' ); ?>>fixed</option>
            </select>
        </p>
            
        <div>
            <label for="pix_color_title">Text color</label><br>
            <div class="pix_color_picker">
                <input name="pix_color_title" type="text" id="pix_color_title" value="<?php echo $pix_color_title=='' ? 'Set a color' : $pix_color_title; ?>">
                <div class="pix_palette"></div>
                <div class="colorpicker"></div>
            </div>
        </div>
        <div class="clear"></div>
        
        <br>

        <div>
            <label for="pix_bg_title_lines">Background color of the text lines</label><br>
            <div class="pix_color_picker">
                <input name="pix_bg_title_lines" type="text" id="pix_bg_title_lines" value="<?php echo $pix_bg_title_lines=='' ? 'Set a color' : $pix_bg_title_lines; ?>">
                <div class="pix_palette"></div>
                <div class="colorpicker"></div>
            </div>
        </div>
        
        <div class="clear"></div>
        
        <br>

        <div class="slider_div opacity">
                                
            <label for="pix_opacity_title_lines">Opacity of the background color:</label><br>
            <input name="pix_opacity_title_lines" type="text" id="pix_opacity_title_lines" value="<?php echo $pix_opacity_title_lines=='' ? '1' : $pix_opacity_title_lines; ?>" class="reduced_input">
            <div class="slider_cursor"></div>
        
        </div><!-- .slider_div -->    
        
        <div class="clear"></div>
        <?php } ?>

        <p>
            <label for="pix_pag_opts_subtitle">Subtitle</label><br>
            <input type="text" name="pix_pag_opts_subtitle" id="pix_pag_opts_subtitle" value="<?php echo $pix_pag_opts_subtitle; ?>">
        </p>
        <div class="clear"></div>
        
        <p>
            <label for="pix_pag_opts_hidetitle">Hide the title section of the page <input type="checkbox" name="pix_pag_opts_hidetitle" id="pix_pag_opts_hidetitle" <?php checked( $pix_pag_opts_hidetitle, 'on' ); ?>></label>
            <small>If checked the title, the subtitle, the border below them and the breadcrumbs will be hidden</small>
        </p>

        <p>
            <label for="pix_pag_opts_share">Display/hide the share section</label>
            <select name="pix_pag_opts_share" id="pix_pag_opts_share">
                <option value="" <?php selected( $pix_pag_opts_share, 'default' ); ?>>Default option</option>
                <option value="hide" <?php selected( $pix_pag_opts_share, 'hide' ); ?>>Hide the share section</option>
                <option value="display" <?php selected( $pix_pag_opts_share, 'display' ); ?>>Display the share section</option>
            </select>
        </p>

        <div class="clear"></div>
        
 
    </div><!-- .pix_meta_boxes -->
	<?php	
}


add_action( 'save_post', 'pix_meta_page_options_save' );
function pix_meta_page_options_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['pix_page_options_nonce'] ) || !wp_verify_nonce( $_POST['pix_page_options_nonce'], 'pix_page_options_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	$chk = ( isset( $_POST['pix_meta_bg'] ) && $_POST['pix_meta_bg'] ) ? 'on' : 'off';
	update_post_meta( $post_id, 'pix_meta_bg', $chk );

	if( isset( $_POST['pix_hidden_field'] ) )
		update_post_meta( $post_id, 'pix_hidden_field', esc_attr( $_POST['pix_hidden_field'] ) );
		
	$chkedit = ( isset( $_POST['pix_editor_field'] ) && $_POST['pix_editor_field'] ) ? 'on' : 'off';
	update_post_meta( $post_id, 'pix_editor_field', $chkedit );

	if( isset( $_POST['pix_meta_widebg'] ) )
		update_post_meta( $post_id, 'pix_meta_widebg', esc_attr( $_POST['pix_meta_widebg'] ) );
		
	if( isset( $_POST['pix_meta_portrait'] ) )
		update_post_meta( $post_id, 'pix_meta_portrait', esc_attr( $_POST['pix_meta_portrait'] ) );

	$chk = ( isset( $_POST['pix_meta_repeat'] ) && $_POST['pix_meta_repeat'] ) ? 'on' : 'off';
	update_post_meta( $post_id, 'pix_meta_repeat', $chk );

	if( isset( $_POST['pix_meta_alignment'] ) )
		update_post_meta( $post_id, 'pix_meta_alignment', esc_attr( $_POST['pix_meta_alignment'] ) );

	if( isset( $_POST['pix_meta_attachment'] ) )
		update_post_meta( $post_id, 'pix_meta_attachment', esc_attr( $_POST['pix_meta_attachment'] ) );

	if( isset( $_POST['pix_pag_opts_subtitle'] ) )
		update_post_meta( $post_id, 'pix_pag_opts_subtitle', esc_attr( $_POST['pix_pag_opts_subtitle'] ) );
		
	if( isset( $_POST['pix_color_title'] ) )
		update_post_meta( $post_id, 'pix_color_title', esc_attr( $_POST['pix_color_title'] ) );
		
	if( isset( $_POST['pix_color_title'] ) )
		update_post_meta( $post_id, 'pix_color_title', esc_attr( $_POST['pix_color_title'] ) );
		
	if( isset( $_POST['pix_bg_title'] ) )
		update_post_meta( $post_id, 'pix_bg_title', esc_attr( $_POST['pix_bg_title'] ) );
		
	if( isset( $_POST['pix_bg_title_lines'] ) )
		update_post_meta( $post_id, 'pix_bg_title_lines', esc_attr( $_POST['pix_bg_title_lines'] ) );
		
	if( isset( $_POST['pix_opacity_title_lines'] ) )
		update_post_meta( $post_id, 'pix_opacity_title_lines', esc_attr( $_POST['pix_opacity_title_lines'] ) );
		
	$chk = ( isset( $_POST['pix_pag_opts_hidetitle'] ) && $_POST['pix_pag_opts_hidetitle'] ) ? 'on' : 'off';
	update_post_meta( $post_id, 'pix_pag_opts_hidetitle', $chk );

	if( isset( $_POST['pix_pag_opts_share'] ) )
		update_post_meta( $post_id, 'pix_pag_opts_share', esc_attr( $_POST['pix_pag_opts_share'] ) );
		
}

function pix_page_seo( $post )
{
    $values = get_post_custom( $post->ID );
    $pix_pag_opts_metatitle = isset( $values['pix_pag_opts_metatitle'] ) ? esc_attr( $values['pix_pag_opts_metatitle'][0] ) : '';
    $pix_pag_opts_metadescription = isset( $values['pix_pag_opts_metadescription'] ) ? esc_attr( $values['pix_pag_opts_metadescription'][0] ) : '';
    $pix_pag_opts_metakeys = isset( $values['pix_pag_opts_metakeys'] ) ? esc_attr( $values['pix_pag_opts_metakeys'][0] ) : '';
    wp_nonce_field( 'pix_page_seo_nonce', 'pix_page_seo_nonce' );
    ?>
    <div class="pix_meta_boxes">
        <p>
            <label for="pix_pag_opts_metatitle">Meta title</label><br>
            <div class="field_wrap"><input type="text" name="pix_pag_opts_metatitle" id="pix_pag_opts_metatitle" class="pix_title_seo" value="<?php echo $pix_pag_opts_metatitle; ?>"></div>
        </p>

        <p>
            <label for="pix_pag_opts_metadescription">Meta description</label><br>
            <div class="field_wrap"><input type="text" name="pix_pag_opts_metadescription" id="pix_pag_opts_metadescription" class="pix_desc_seo" value="<?php echo $pix_pag_opts_metadescription; ?>"></div>
        </p>

        <p>
            <label for="pix_pag_opts_metakeys">Meta keywords</label><br>
            <div class="field_wrap"><textarea name="pix_pag_opts_metakeys" id="pix_pag_opts_metakeys" ><?php echo $pix_pag_opts_metakeys; ?></textarea></div>
        </p>
        <div class="clear"></div>
        
 
    </div><!-- .pix_meta_boxes -->
    <?php   
}


add_action( 'save_post', 'pix_page_seo_save' );
function pix_page_seo_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['pix_page_seo_nonce'] ) || !wp_verify_nonce( $_POST['pix_page_seo_nonce'], 'pix_page_seo_nonce' ) ) return;
    
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
    
    if( isset( $_POST['pix_pag_opts_metatitle'] ) )
        update_post_meta( $post_id, 'pix_pag_opts_metatitle', esc_attr( $_POST['pix_pag_opts_metatitle'] ) );
        
    if( isset( $_POST['pix_pag_opts_metadescription'] ) )
        update_post_meta( $post_id, 'pix_pag_opts_metadescription', esc_attr( $_POST['pix_pag_opts_metadescription'] ) );
        
    if( isset( $_POST['pix_pag_opts_metakeys'] ) )
        update_post_meta( $post_id, 'pix_pag_opts_metakeys', esc_attr( $_POST['pix_pag_opts_metakeys'] ) );
        
}

function pix_page_builder_content( $post )
{
    $values = get_post_custom( $post->ID );
    $pix_page_builder_content = isset( $values['pix_page_builder_content'] ) ? esc_attr( $values['pix_page_builder_content'][0] ) : '';
    wp_nonce_field( 'pix_page_builder_content_nonce', 'pix_page_builder_content_nonce' );
    ?>
    <div class="pix_meta_boxes">
        <p>
            <label for="pixBuilderTxtArea">Content</label><br>
            <div class="field_wrap"><textarea name="pix_page_builder_content" id="pixBuilderTxtArea" ><?php echo $pix_page_builder_content; ?></textarea></div>
        </p>
        <div class="clear"></div>
        
 
    </div><!-- .pix_meta_boxes -->
    <?php   
}


add_action( 'save_post', 'pix_page_builder_content_save' );
function pix_page_builder_content_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['pix_page_builder_content_nonce'] ) || !wp_verify_nonce( $_POST['pix_page_builder_content_nonce'], 'pix_page_builder_content_nonce' ) ) return;
    
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
    
    if( isset( $_POST['pix_page_builder_content'] ) )
        update_post_meta( $post_id, 'pix_page_builder_content', esc_attr( $_POST['pix_page_builder_content'] ) );
        
}

function pix_page_template( $post )
{
	global $typenow;
	if ( empty( $typenow ) && !empty( $_GET['post'] ) ) {
        $post = get_post( $_GET['post'] );
        $typenow = $post->post_type;
    } elseif ( empty( $typenow ) && !empty( $_GET['post_type'] ) ) {
        $typenow = $_GET['post_type'];
    }
	
	$values = get_post_custom( $post->ID );
	if ($typenow=='portfolio') {
		$selected = isset( $values['pix_page_template_select'] ) ? esc_attr( $values['pix_page_template_select'][0] ) : 'widepage.php';
	} else {
		$selected = isset( $values['pix_page_template_select'] ) ? esc_attr( $values['pix_page_template_select'][0] ) : '';
	}
	wp_nonce_field( 'pix_page_template_nonce', 'pix_page_template_nonce' );
	?>	
    <div class="pix_meta_boxes">
        <label for="pix_page_template_select">Template</label>
        <p>
            <select name="pix_page_template_select" id="pix_page_template_select">
                <option value="default" <?php selected( $selected, 'default' ); ?>>Default</option>
                <option value="widepage.php" <?php selected( $selected, 'widepage.php' ); ?>>Widepage</option>
            </select>
        </p>
    </div><!-- .pix_meta_boxes -->
	<?php	
}


add_action( 'save_post', 'pix_page_template_save' );
function pix_page_template_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['pix_page_template_nonce'] ) || !wp_verify_nonce( $_POST['pix_page_template_nonce'], 'pix_page_template_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	if( isset( $_POST['pix_page_template_select'] ) )
		update_post_meta( $post_id, 'pix_page_template_select', esc_attr( $_POST['pix_page_template_select'] ) );
}

function pix_sidebar_meta( $post )
{
	$values = get_post_custom( $post->ID );
	$selected = isset( $values['pix_sidebar_select'] ) ? esc_attr( $values['pix_sidebar_select'][0] ) : '';
	wp_nonce_field( 'pix_sidebar_select_nonce', 'pix_sidebar_select_nonce' );
	?>	
    <div class="pix_meta_boxes">
        <label for="pix_page_template_select">Select a sidebar</label>
        <p>
            <select name="pix_sidebar_select">
                <option value="" <?php selected( $selected, '' ); ?>>Inherit</option>
                <option value="forte_default_sidebar" <?php selected( $selected, 'forte_default_sidebar' ); ?>>Forte default sidebar</option>
                <option value="woocommerce_default_sidebar" <?php selected( $selected, 'woocommerce_default_sidebar' ); ?>>WooCommerce default sidebar</option>
                <?php
                $get_sidebar_options = sidebar_generator_pix::get_sidebars();
                if($get_sidebar_options != "") {
                $i=1;
                    foreach ($get_sidebar_options as $sidebar_gen) { ?>                        
                            <option value="<?php echo $sidebar_gen; ?>" <?php selected( $selected, $sidebar_gen ); ?>><?php echo $sidebar_gen; ?></option>
                    <?php $i++;  
                    }
                }
                ?>
            </select>
        </p>
    </div><!-- .pix_meta_boxes -->
	<?php	
}


add_action( 'save_post', 'pix_sidebar_meta_save' );
function pix_sidebar_meta_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['pix_sidebar_select_nonce'] ) || !wp_verify_nonce( $_POST['pix_sidebar_select_nonce'], 'pix_sidebar_select_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	if( isset( $_POST['pix_sidebar_select'] ) )
		update_post_meta( $post_id, 'pix_sidebar_select', esc_attr( $_POST['pix_sidebar_select'] ) );
}

function pix_thumb_size( $post )
{
	global $typenow;
	if ( empty( $typenow ) && !empty( $_GET['post'] ) ) {
        $post = get_post( $_GET['post'] );
        $typenow = $post->post_type;
    } elseif ( empty( $typenow ) && !empty( $_GET['post_type'] ) ) {
        $typenow = $_GET['post_type'];
    }
	
	$values = get_post_custom( $post->ID );
	$pix_zoom_featured_images = isset( $values['pix_zoom_featured_images'] ) ? esc_attr( $values['pix_zoom_featured_images'][0] ) : '';
	$pix_display_feat_image = isset( $values['pix_display_feat_image'] ) ? esc_attr( $values['pix_display_feat_image'][0] ) : 'on';
	$pix_colorbox_feat_image = isset( $values['pix_colorbox_feat_image'] ) ? esc_attr( $values['pix_colorbox_feat_image'][0] ) : 'on';
	wp_nonce_field( 'pix_thumb_size_nonce', 'pix_thumb_size_nonce' );
	?>
    <div class="pix_meta_boxes">
        
	<?php if ($typenow=='product') { ?>
        <label for="pix_zoom_featured_images">Enable the zoom for the product images</label>
      
        <p>
            <select name="pix_zoom_featured_images" id="pix_zoom_featured_images">
                <option value="default" <?php selected( $pix_zoom_featured_images, 'default' ); ?>>default</option>
                <option value="enable" <?php selected( $pix_zoom_featured_images, 'enable' ); ?>>enable</option>
                <option value="disable" <?php selected( $pix_zoom_featured_images, 'disable' ); ?>>disable</option>
            </select>
        </p>
    <?php } else { ?>
        
        <p>
            <label for="pix_display_feat_image">Display the featured image on the top of the page itself:
            <input type="checkbox" name="pix_display_feat_image" <?php checked( $pix_display_feat_image, 'on' ); ?>></label>
        </p>
        
        <p>
            <label for="pix_colorbox_feat_image">Enlarge the featured image when you click it:
            <input type="checkbox" name="pix_colorbox_feat_image" <?php checked( $pix_colorbox_feat_image, 'on' ); ?>></label>
        </p>
    <?php } ?>

    </div><!-- .pix_meta_boxes -->
	<?php	
}

add_action( 'save_post', 'pix_thumb_size_save' );
function pix_thumb_size_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['pix_thumb_size_nonce'] ) || !wp_verify_nonce( $_POST['pix_thumb_size_nonce'], 'pix_thumb_size_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	if( isset( $_POST['pix_zoom_featured_images'] ) ) {
		update_post_meta( $post_id, 'pix_zoom_featured_images', esc_attr( $_POST['pix_zoom_featured_images'] ) );
	}
		$chk = ( isset( $_POST['pix_display_feat_image'] ) && $_POST['pix_display_feat_image'] ) ? 'on' : 'off';
		update_post_meta( $post_id, 'pix_display_feat_image', $chk );

		$chk = ( isset( $_POST['pix_colorbox_feat_image'] ) && $_POST['pix_colorbox_feat_image'] ) ? 'on' : 'off';
		update_post_meta( $post_id, 'pix_colorbox_feat_image', $chk );
}


function pix_post_format( $post )
{
	
	$values = get_post_custom( $post->ID );
	$pix_post_format = isset( $values['pix_post_format'] ) ? esc_attr( $values['pix_post_format'][0] ) : '0';
	wp_nonce_field( 'pix_post_format_nonce', 'pix_post_format_nonce' );
	?>
    <div class="pix_meta_boxes">
        
		<input type="radio" name="pix_post_format" class="post-format" id="post-format-0" value="0" <?php checked( $pix_post_format, '0' ); ?>> <label for="post-format-0">Standard</label>
		<br><input type="radio" name="pix_post_format" class="post-format" id="post-format-gallery" value="gallery" <?php checked( $pix_post_format, 'gallery' ); ?>> <label for="post-format-gallery">Gallery</label>
		<br><input type="radio" name="pix_post_format" class="post-format" id="post-format-video" value="video" <?php checked( $pix_post_format, 'video' ); ?> > <label for="post-format-video">Video</label>
		<br><input type="radio" name="pix_post_format" class="post-format" id="post-format-audio" value="audio" <?php checked( $pix_post_format, 'audio' ); ?> > <label for="post-format-audio">Audio</label>

    </div><!-- .pix_meta_boxes -->
	<?php	
}

add_action( 'save_post', 'pix_post_format_save' );
function pix_post_format_save( $post_id )
{
	if( isset( $_POST['pix_post_format'] ) ) {
		update_post_meta( $post_id, 'pix_post_format', esc_attr( $_POST['pix_post_format'] ) );
	}
}


/*=========================================================================================*/

function pix_meta_edittext()
{
	require_once(get_template_directory().'/functions/metaboxes/sc_edittext.php');
}

function pix_meta_googlemap()
{
	require_once(get_template_directory().'/functions/metaboxes/sc_googlemap.php');
}

function pix_meta_contactform()
{
	require_once(get_template_directory().'/functions/metaboxes/sc_contactform.php');
}

function pix_meta_slideshow()
{
    require_once(get_template_directory().'/functions/metaboxes/sc_slideshow.php');
}

function pix_meta_testimonial_sc()
{
    require_once(get_template_directory().'/functions/metaboxes/sc_testimonial.php');
}

function pix_meta_tooltip()
{
	require_once(get_template_directory().'/functions/metaboxes/sc_tooltip.php');
}

function pix_meta_video()
{
	require_once(get_template_directory().'/functions/metaboxes/sc_video.php');
}

function pix_meta_audio()
{
	require_once(get_template_directory().'/functions/metaboxes/sc_audio.php');
}

function pix_meta_accordion()
{
	require_once(get_template_directory().'/functions/metaboxes/sc_accordion.php');
}

function pix_meta_tab()
{
	require_once(get_template_directory().'/functions/metaboxes/sc_tab.php');
}

function pix_meta_box()
{
	require_once(get_template_directory().'/functions/metaboxes/sc_box.php');
}

function pix_meta_button()
{
	require_once(get_template_directory().'/functions/metaboxes/sc_button.php');
}

function pix_meta_pricetable()
{
	require_once(get_template_directory().'/functions/metaboxes/sc_pricetable.php');
}

function pix_meta_tweets()
{
	require_once(get_template_directory().'/functions/metaboxes/sc_tweets.php');
}

function pix_meta_galleries()
{
	require_once(get_template_directory().'/functions/metaboxes/sc_galleries.php');
}

function pix_meta_categories()
{
	require_once(get_template_directory().'/functions/metaboxes/sc_categories.php');
}

function pix_page_builder()
{
    require_once(get_template_directory().'/functions/metaboxes/page_builder.php');
}


/*=========================================================================================*/

