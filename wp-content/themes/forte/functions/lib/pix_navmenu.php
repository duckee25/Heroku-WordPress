<?php

add_action( 'init', 'register_pix_menus' );
function register_pix_menus() {
	register_nav_menus(
		array(
			'primary_menu' => __( 'Primary menu' )
		)
	);
}

/*=========================================================================================*/

function menuCount($menu_name){
$menu_to_count = wp_nav_menu(array(
					'echo' => false,
					'theme_location' => $menu_name
				));
$menu_items = substr_count($menu_to_count,'class="menu-item ');
return $menu_items;
}
			
/*=========================================================================================*/




add_action('wp_update_nav_menu_item', 'pix_megamenu_update',10, 3);
function pix_megamenu_update($menu_id, $menu_item_db_id, $args ) {
    if(isset($_POST['pix-megamenu-item'])){
		if ( is_array($_POST['pix-megamenu-item']) ) {
			if(array_key_exists($menu_item_db_id, $_POST['pix-megamenu-item'])) {
				$custom_value = $_POST['pix-megamenu-item'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_pix_megamenu_item', $custom_value );
			}
		}
	}
    if(isset($_POST['pix-column-item'])){
		if ( is_array($_POST['pix-column-item']) ) {
			if(array_key_exists($menu_item_db_id, $_POST['pix-column-item'])) {
				$custom_value = $_POST['pix-column-item'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_pix_column_item', $custom_value );
			}
		}
	}
    if(isset($_POST['pix-icon-item'])){
		if ( is_array($_POST['pix-icon-item']) ) {
			if(array_key_exists($menu_item_db_id, $_POST['pix-icon-item'])) {
				$custom_value = $_POST['pix-icon-item'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_pix_icon_item', $custom_value );
			}
		}
	}
    if(isset($_POST['pix-image-item'])){
		if ( is_array($_POST['pix-image-item']) ) {
			if(array_key_exists($menu_item_db_id, $_POST['pix-image-item'])) {
				$custom_value = $_POST['pix-image-item'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_pix_image_item', $custom_value );
			}
		}
	}
    if(isset($_POST['pix-width-item'])){
		if ( is_array($_POST['pix-width-item']) ) {
			if(array_key_exists($menu_item_db_id, $_POST['pix-width-item'])) {
				$custom_value = $_POST['pix-width-item'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_pix_width_item', $custom_value );
			}
		}
	}
    if(isset($_POST['pix-title-item'])){
		if ( is_array($_POST['pix-title-item']) ) {
			if(array_key_exists($menu_item_db_id, $_POST['pix-title-item'])) {
				$custom_value = $_POST['pix-title-item'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_pix_title_item', $custom_value );
			}
		}
	}
}

/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_Custom
 */
add_filter( 'wp_setup_nav_menu_item','pix_megamenu_items' );
function pix_megamenu_items($menu_item) {
    $menu_item->custom = get_post_meta( $menu_item->ID, '_pix_megamenu_item', true );
    $menu_item->custom = get_post_meta( $menu_item->ID, '_pix_column_item', true );
    $menu_item->custom = get_post_meta( $menu_item->ID, '_pix_icon_item', true );
    $menu_item->custom = get_post_meta( $menu_item->ID, '_pix_image_item', true );
    $menu_item->custom = get_post_meta( $menu_item->ID, '_pix_width_item', true );
    $menu_item->custom = get_post_meta( $menu_item->ID, '_pix_title_item', true );
    return $menu_item;
}


add_filter('wp_edit_nav_menu_walker','pix_nav_menu_class');

function pix_nav_menu_class(){
	class Custom_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit  {
		/**
		 * @see Walker_Nav_Menu::start_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 */
		function start_lvl( &$output, $depth = 0, $args = array() ) {}
	
		/**
		 * @see Walker_Nav_Menu::end_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 */
		function end_lvl( &$output, $depth = 0, $args = array() ) {
		}
	
		/**
		 * @see Walker::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param object $args
		 */
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $_wp_nav_menu_max_depth, $megamenu;
			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
	
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
			ob_start();
			$item_id = esc_attr( $item->ID );
			$removed_args = array(
				'action',
				'customlink-tab',
				'edit-menu-item',
				'menu-item',
				'page-tab',
				'_wpnonce',
			);
	
			$original_title = '';
			if ( 'taxonomy' == $item->type ) {
				$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
				if ( is_wp_error( $original_title ) )
					$original_title = false;
			} elseif ( 'post_type' == $item->type ) {
				$original_object = get_post( $item->object_id );
				$original_title = $original_object->post_title;
			}
	
			$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
			);
	
			$title = $item->title;
	
			if ( ! empty( $item->_invalid ) ) {
				$classes[] = 'menu-item-invalid';
				/* translators: %s: title of menu item which is invalid */
				$title = sprintf( __( '%s (Invalid)' ), $item->title );
			} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
				$classes[] = 'pending';
				/* translators: %s: title of menu item in draft status */
				$title = sprintf( __('%s (Pending)'), $item->title );
			}
	
			$title = empty( $item->label ) ? $title : $item->label;
	
			?>
			<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
				<dl class="menu-item-bar">
					<dt class="menu-item-handle">
						<span class="item-title"><?php echo esc_html( $title ); ?></span>
						<span class="item-controls">
							<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
							<span class="item-order">
								<a href="<?php
									echo wp_nonce_url(
										add_query_arg(
											array(
												'action' => 'move-up-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									);
								?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up'); ?>">&#8593;</abbr></a>
								|
								<a href="<?php
									echo wp_nonce_url(
										add_query_arg(
											array(
												'action' => 'move-down-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									);
								?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down'); ?>">&#8595;</abbr></a>
							</span>
							<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php _e('Edit Menu Item'); ?>" href="<?php
								echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
							?>"><?php _e( 'Edit Menu Item' ); ?></a>
						</span>
					</dt>
				</dl>
	
				<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
                    <!---custom items-->
                	<div class="pix_custom-items">
                        <p class="field-checkbox description pix_megamenu-item">
                            <label for="pix-megamenu-item-<?php echo $item_id; ?>">
                                <input type="hidden" name="pix-megamenu-item[<?php echo $item_id; ?>]" value='0' />
                                <input type="checkbox" id="pix-megamenu-item-<?php echo $item_id; ?>" class="pix-megamenu-item" name="pix-megamenu-item[<?php echo $item_id; ?>]"<?php if (get_post_meta( $item_id, '_pix_megamenu_item', true)=='1') { echo 'checked="checked"'; } ?> value='1' />
                                <?php _e( 'Use it for your megamenu' ); ?>
                            </label>
                        </p>	
    
                        <p class="field-checkbox description pix_megamenu-item">
                            <label for="pix-icon-item-<?php echo $item_id; ?>">
                                <?php _e( 'Descriptive icon' ); ?><br />
                                <span class="pix_select_icon pix-icon-item">
                                    <span class="pix_image_thumb"><i <?php if (get_post_meta( $item_id, '_pix_icon_item', true)!='') { echo ' class="'.esc_html(get_post_meta( $item_id, '_pix_icon_item', true)).'"'; } ?>></i></span>
                                    <input type="hidden" id="pix-icon-item-<?php echo $item_id; ?>" class="pix-icon-item" name="pix-icon-item[<?php echo $item_id; ?>]" value="<?php echo esc_html(get_post_meta( $item_id, '_pix_icon_item', true)); ?>">
                                    <span class="grey_button pix_select_icon_button">
                                        <span class="button_left"></span>
                                        <span class="button_right"></span>
                                        <span class="button_body"></span>
                                        <a href="#">select</a>
                                    </span>
                                </span><!-- .pix_select_icon -->
                                
                            </label>
                        </p>	
    
                        <?php if( 'custom' == $item->type ) : ?>
                         <p class="field-checkbox description pix_column-item">
                            <label for="pix-column-item-<?php echo $item_id; ?>">
                                <?php _e( 'Use it to start a new column or a new row' ); ?><br />
                                <select id="pix-column-item-<?php echo $item_id; ?>" class="widefat pix-column-item" name="pix-column-item[<?php echo $item_id; ?>]">
                                    <option value="no" <?php if (get_post_meta( $item_id, '_pix_column_item', true)=='no') { echo 'selected="selected"'; } ?>><?php _e('No'); ?></option>
                                    <option value="column" <?php if (get_post_meta( $item_id, '_pix_column_item', true)=='column') { echo 'selected="selected"'; } ?>><?php _e('Start a new column'); ?></option>
                                    <option value="row" <?php if (get_post_meta( $item_id, '_pix_column_item', true)=='row') { echo 'selected="selected"'; } ?>><?php _e('Start a new row'); ?></option>
                                </select>
                            </label>
                        </p>	

                         <p class="field-checkbox description pix_width-item">
                            <label for="pix-width-item-<?php echo $item_id; ?>">
                                <?php _e( 'Make it &hellip; wide' ); ?><br />
                                <select id="pix-width-item-<?php echo $item_id; ?>" class="widefat pix-width-item" name="pix-width-item[<?php echo $item_id; ?>]">
                                    <option value="1" <?php if (get_post_meta( $item_id, '_pix_width_item', true)=='1') { echo 'selected="selected"'; } ?>><?php _e('1 column'); ?></option>
                                    <option value="2" <?php if (get_post_meta( $item_id, '_pix_width_item', true)=='2') { echo 'selected="selected"'; } ?>><?php _e('2 columns'); ?></option>
                                    <option value="3" <?php if (get_post_meta( $item_id, '_pix_width_item', true)=='3') { echo 'selected="selected"'; } ?>><?php _e('3 columns'); ?></option>
                                    <option value="4" <?php if (get_post_meta( $item_id, '_pix_width_item', true)=='4') { echo 'selected="selected"'; } ?>><?php _e('4 columns'); ?></option>
                                </select>
                            </label>
                        </p>	
                        <?php endif; ?>
    
                         <p class="field-checkbox description pix_title-item">
                            <label for="pix-title-item-<?php echo $item_id; ?>">
                                <input type="hidden" name="pix-title-item[<?php echo $item_id; ?>]" value='0' />
                                <input type="checkbox" id="pix-title-item-<?php echo $item_id; ?>" class="pix-title-item" name="pix-title-item[<?php echo $item_id; ?>]"<?php if (get_post_meta( $item_id, '_pix_title_item', true)=='pix_mega_title' && $megamenu == 0) { echo 'checked="checked"'; } ?> value='pix_mega_title' />
                                <?php _e( 'Use it as title' ); ?>
                            </label>
                        </p>	

                         <p class="field-checkbox description pix_image-item">
                            <label for="pix-image-item-<?php echo $item_id; ?>">
                                <?php _e( 'Descriptive thumb' ); ?><br />
                                <span class="pix_upload_image pix-image-item">
                                    <span class="pix_image_thumb"><img alt="Preview" src="<?php if(get_post_meta( $item_id, '_pix_image_item', true)!=''){ echo get_pix_thumb(esc_html(get_post_meta( $item_id, '_pix_image_item', true)), 'miniTh'); } else { echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; } ?>"></span>
                                        <input type="text" id="pix-image-item-<?php echo $item_id; ?>" class="pix-image-item" name="pix-image-item[<?php echo $item_id; ?>]" value="<?php echo esc_html(get_post_meta( $item_id, '_pix_image_item', true)); ?>">
                                    <span class="grey_button pix_upload_image_button">
                                        <span class="button_left"></span>
                                        <span class="button_right"></span>
                                        <span class="button_body"></span>
                                        <a href="#">upload</a>
                                    </span>
                                </span><!-- .pix_upload_image -->
                                
                            </label>
                        </p>	
    
                    </div>
                    <div class="clear"></div>
                    <!--end custom items-->
                    
					<?php if( 'custom' == $item->type ) : ?>
						<p class="field-url description description-wide pix_url-item">
							<label for="edit-menu-item-url-<?php echo $item_id; ?>">
								<?php _e( 'URL' ); ?><br />
								<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
							</label>
						</p>
					<?php endif; ?>
					<p class="description description-thin">
						<label for="edit-menu-item-title-<?php echo $item_id; ?>">
							<?php _e( 'Navigation Label' ); ?><br />
							<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
						</label>
					</p>
                    
					<p class="description description-thin">
						<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
							<?php _e( 'Title Attribute' ); ?><br />
							<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
						</label>
					</p>

					<?php if( 'custom' == $item->type ) : ?>
					<p class="field-link-target description description-thin">
						<label for="edit-menu-item-target-<?php echo $item_id; ?>">
							<?php _e( 'Link Target' ); ?><br />
							<select id="edit-menu-item-target-<?php echo $item_id; ?>" class="widefat edit-menu-item-target" name="menu-item-target[<?php echo $item_id; ?>]">
								<option value="" <?php selected( $item->target, ''); ?>><?php _e('Same window or tab'); ?></option>
								<option value="_blank" <?php selected( $item->target, '_blank'); ?>><?php _e('New window or tab'); ?></option>
							</select>
						</label>
					</p>
					<?php endif; ?>

					<p class="field-css-classes description description-thin">
						<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
							<?php _e( 'CSS Classes (optional)' ); ?><br />
							<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
						</label>
					</p>
					<p class="field-xfn description description-thin">
						<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
							<?php _e( 'Link Relationship (XFN)' ); ?><br />
							<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
						</label>
					</p>
					<p class="field-description description description-wide">
						<label for="edit-menu-item-description-<?php echo $item_id; ?>">
							<?php _e( 'Description' ); ?><br />
							<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
							<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.'); ?></span>
						</label>
					</p>
	
					<div class="menu-item-actions description-wide submitbox">
						<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
							<p class="link-to-original">
								<?php printf( __('Original: %s'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
							</p>
						<?php endif; ?>
						<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
						echo wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'delete-menu-item',
									'menu-item' => $item_id,
								),
								remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
							),
							'delete-menu_item_' . $item_id
						); ?>"><?php _e('Remove'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php	echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
							?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel'); ?></a>
					</div>
	
					<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
					<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
					<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
					<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
					<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
					<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
				</div><!-- .menu-item-settings-->
				<ul class="menu-item-transport"></ul>
			<?php
			$output .= ob_get_clean();
		}
	}

	return 'Custom_Walker_Nav_Menu_Edit';

}




class Pix_Walker extends Walker_Nav_Menu
{
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query, $megamenu, $column_width;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		
		$item_id = esc_attr( $item->ID );
		$a_class = get_post_meta( $item_id, '_pix_title_item', true);
		
		if ($depth==0) {
			
			if ( get_post_meta( $item_id, '_pix_megamenu_item', true ) == '1' ) {
			
				$classes[] = 'menu-item-' . $item->ID;
		
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				$class_names .= ' pix_megamenu';
				$class_names = ' class="' . esc_attr( $class_names ) . '"';

				$output .= $indent . '<li' . $id . $value . $class_names .'>';
	
				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'><span>';
				$item_icon = get_post_meta( $item_id, '_pix_icon_item', true )!='' ? ' class="'.get_post_meta( $item_id, '_pix_icon_item', true ).' pix_icon_menu"' : '';
				$item_output .= '<i'.$item_icon.'></i>';
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				/*if ( $item->description != '' ) {
					$item_output .= '<span class="pix_menu_desc">' . $item->description . '</span>';
				}*/
				//$item_output .= '<span>' . get_post_meta( $item_id, '_pix_column_item', true) . '</span>';
				$item_output .= '</span></a>';
				$item_output .= $args->after;
		
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
				$output .= $indent . '<div><div>';
				$megamenu = 1;
				
			} else {
				
				$classes[] = 'menu-item-' . $item->ID;
		
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				$class_names = ' class="' . esc_attr( $class_names ) . '"';

				$output .= $indent . '<li' . $id . $value . $class_names .'>';
	
				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$attributes .= ! empty( $a_class )     	   ? ' class="'   . $a_class .'"' : '';
		
				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'><span>';
				$item_icon = get_post_meta( $item_id, '_pix_icon_item', true )!='' ? ' class="'.get_post_meta( $item_id, '_pix_icon_item', true ).' pix_icon_menu"' : '';
				$item_output .= '<i'.$item_icon.'></i>';
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				/*if ( $item->description != '' ) {
					$item_output .= '<span class="pix_menu_desc">' . $item->description . '</span>';
				}*/
				//$item_output .= '<span>' . get_post_meta( $item_id, '_pix_column_item', true) . '</span>';
				$item_output .= '</span></a>';
				$item_output .= $args->after;
		
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
				$megamenu = 0;
				
			}

		} elseif (get_post_meta( $item_id, '_pix_column_item', true) == 'column' && $depth==1) {
			
			$column_width = get_post_meta( $item_id, '_pix_width_item', true );
			
			$output .= $indent . '<ul>';
			
		} elseif (get_post_meta( $item_id, '_pix_column_item', true) == 'row' && $depth==1) {
			
			$column_width = '';

			$output .= $indent . '</div><div class="mega_clear"><div></div></div><div>';

		} else {
			
			if( $depth>1 && $megamenu == 1 ) {
				
				$output .= $indent . '<li' . $id . $value . ' class="pix_megamenu_'. $column_width .'_col">';
				
			} else {
				
				$output .= $indent . '<li' . $id . $value . $class_names .'>';
				
			}
	
				$item_output = $args->before;
				$item_output .= $args->after;
		
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$attributes .= ! empty( $a_class )     	   ? ' class="'   . $a_class .'"' : '';
		
				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';

				if(get_post_meta( $item_id, '_pix_image_item', true) != ''){
					$item_output .= '<span class="pix_desc_image"><img src="'.get_post_meta( $item_id, '_pix_image_item', true).'" alt=""></span>';
				}

				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				if ( $item->description != '' ) {
					$item_output .= '<br><small>' . $item->description . '</small>';
				}
				$item_output .= '</a>';
				$item_output .= $args->after;
		
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
							
		}
			

	}
	
	
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		global $wp_query, $megamenu;
		$item_id = esc_attr( $item->ID );
		
		if (get_post_meta( $item_id, '_pix_megamenu_item', true) == '1' && $depth==0) {
			
			$output .= "</div></div></li>";
			$megamenu = 0;

		} elseif (get_post_meta( $item_id, '_pix_column_item', true) == 'column' && $depth==1) {
			
			$output .= "</ul>";

		} elseif (get_post_meta( $item_id, '_pix_column_item', true) == 'row' && $depth==1) {
			
			$output .= "";

		}  else {

			$output .= "</li>";
		
		}
	}


	function start_lvl( &$output, $depth = 0, $args = array() ) {
		global $megamenu;
		if(($megamenu==1 && $depth==0) || ($megamenu==1 && $depth==1)){
			$output .= '';
		} else {
			$output .= "<ul class='children'>";
		}
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		global $megamenu;
		if(($megamenu==1 && $depth==0) || ($megamenu==1 && $depth==1)){
			$output .= '';
		} else {
			$output .= "</ul>";
		}
	}
}

/***************************************************/

class Pix_Walker_Mobile extends Walker_Nav_Menu
{
	function start_lvl( &$output, $depth = 0, $args = array() ){
      $indent = str_repeat("\t", $depth);
    }

    function end_lvl( &$output, $depth = 0, $args = array() ){
      $indent = str_repeat("\t", $depth);
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ){

		global $wp_query, $column, $option;

		$item_id = esc_attr( $item->ID );
		
		if (get_post_meta( $item_id, '_pix_column_item', true) == 'column') {
			$column = 1;
		}

		if (get_post_meta( $item_id, '_pix_column_item', true) != 'column' && get_post_meta( $item_id, '_pix_column_item', true) != 'row') {
			
			$col_value = ($depth-$column) >= 0 ? ($depth-$column) : 0;
			
			$class_names = $value = '';
	
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
	
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
			
			$item->title = str_repeat("- ", $col_value).' '.$item->title;
	
			$classes[] = 'menu-item-' . $item->ID;
			
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';
			
			$attributes = ! empty( $item->target )     ? ' data-target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' data-href="'   . esc_attr( $item->url        ) .'"' : '';
			$attributes .= ! empty( $a_class )     	   ? ' class="'   . $a_class .'"' : '';
			
			$item_output = $args->before;
	
			$output .= '<option value="'.$args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after . $args->after.'"' . $id . $value . $class_names . $attributes .'>';
			
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after . $args->after;
			
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

			$option = true;
			
		}
			
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ){

		global $option;

		$item_id = esc_attr( $item->ID );

		if (get_post_meta( $item_id, '_pix_column_item', true) == 'column') {
			$column = 0;
		}

		if (get_post_meta( $item_id, '_pix_column_item', true) != 'column' && get_post_meta( $item_id, '_pix_column_item', true) != 'row' && $option == true) {
			$output .= "</option>\n";
			$option = false;
		}
    }
}

/*=========================================================================================*/

add_filter('wp_nav_menu_items', 'pix_replace_lang_switcher',12, 2);
function pix_replace_lang_switcher($items, $args){
        global $sitepress_settings, $sitepress, $icl_language_switcher, $wpml_en;

        if ( $wpml_en=='active' && !empty($sitepress_settings['display_ls_in_menu'])) {
        
	        $argsArr = get_object_vars($args);

	        $walker = '';
	        if ( is_object($argsArr['walker']) ) { 
	        	$walker = get_class($argsArr['walker']);
	        }
	        
	        // menu can be passed as integger or object
	        if(isset($args->menu->term_id)) $args->menu = $args->menu->term_id;
	        
	        $abs_menu_id = icl_object_id($args->menu, 'nav_menu', false, $sitepress->get_default_language());
	        
	        if($abs_menu_id == $sitepress_settings['menu_for_ls']){
	        
	            $languages = $sitepress->get_ls_languages();
	            
	            if ($walker=='Pix_Walker') {
		            $items .= '<li class="menu-item menu-item-language menu-item-language-current">';
		            if(isset($args->before)){
		                $items .= $args->before;
		            }                                 
		            $items .= '<a href="#" onclick="return false">';
		            if(isset($args->link_before)){
		                $items .= $args->link_before;
		            } 
		            if( $sitepress_settings['icl_lso_flags'] ){
		                $items .= '<img class="iclflag" src="'.$languages[$sitepress->get_current_language()]['country_flag_url'].'" width="18" height="12" alt="'.$languages[$sitepress->get_current_language()]['translated_name'].'" />';
		            }
		            $items .= $languages[$sitepress->get_current_language()]['translated_name'];
		            if(isset($args->link_after)){
		                $items .= $args->link_after;
		            }                                 
		            $items .= '</a>';
		            if(isset($args->after)){
		                $items .= $args->after;
		            }                                             
		            
		            unset($languages[$sitepress->get_current_language()]);

		            if(!empty($languages)){
		                $items .= '<ul class="sub-menu submenu-languages children">'; 
		                foreach($languages as $code => $lang){
		                    $items .= '<li class="menu-item menu-item-language menu-item-language-current">';
		                    $items .= '<a href="'.$lang['url'].'">';
		                    if( $sitepress_settings['icl_lso_flags'] ){
		                        $items .= '<img class="iclflag" src="'.$lang['country_flag_url'].'" width="18" height="12" alt="'.$lang['translated_name'].'" />';
		                    }
		                    if($sitepress_settings['icl_lso_native_lang']){
		                        $items .= $lang['native_name'];
		                    }
		                    if($sitepress_settings['icl_lso_display_lang'] && $sitepress_settings['icl_lso_native_lang']){
		                        $items .= ' (';
		                    }
		                    if($sitepress_settings['icl_lso_display_lang']){
		                        $items .= $lang['translated_name'];
		                    }
		                    if($sitepress_settings['icl_lso_display_lang'] && $sitepress_settings['icl_lso_native_lang']){
		                        $items .= ')';
		                    }                
		                    $items .= '</a>';
		                    $items .= '</li>';
		                    
		                }
		                $items .= '</ul>';
		            }
		            $items .= '</li>';
		        
		        } elseif ($walker=='Pix_Walker_Mobile') {
		            $items .= '<option class="menu-item menu-item-language menu-item-language-current">';
		            if(isset($args->before)){
		                $items .= $args->before;
		            }                                 
		            if(isset($args->link_before)){
		                $items .= $args->link_before;
		            } 
		            $items .= $languages[$sitepress->get_current_language()]['translated_name'];
		            if(isset($args->link_after)){
		                $items .= $args->link_after;
		            }                                 
		            if(isset($args->after)){
		                $items .= $args->after;
		            }                                             
		            
		            unset($languages[$sitepress->get_current_language()]);

		            if(!empty($languages)){
		                foreach($languages as $code => $lang){
		                    $items .= '<option class="menu-item menu-item-language menu-item-language-current" data-href="'.$lang['url'].'">';
		                    if($sitepress_settings['icl_lso_native_lang']){
		                        $items .= '- ' . $lang['native_name'];
		                    }
		                    if($sitepress_settings['icl_lso_display_lang'] && $sitepress_settings['icl_lso_native_lang']){
		                        $items .= ' (';
		                    }
		                    if($sitepress_settings['icl_lso_display_lang']){
		                        $items .= $lang['translated_name'];
		                    }
		                    if($sitepress_settings['icl_lso_display_lang'] && $sitepress_settings['icl_lso_native_lang']){
		                        $items .= ')';
		                    }                
		                    $items .= '</option>';
		                    
		                }
		            }
		            $items .= '</option>';
		        
		        }
		    }
		}
	        
	        return $items;
    
}

function pix_replace_default_lang_switcher() {
        global $icl_language_switcher;
        remove_filter( 'wp_nav_menu_items', array($icl_language_switcher, 'wp_nav_menu_items_filter') );
}
add_action('init','pix_replace_default_lang_switcher');

