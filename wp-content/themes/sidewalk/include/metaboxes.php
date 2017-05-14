<?php
/*-----------------------------------------------------------------------------------*/
/*	Add Metaboxes
/*-----------------------------------------------------------------------------------*/

add_action( 'load-post.php', 'sdw_meta_boxes_setup' );
add_action( 'load-post-new.php', 'sdw_meta_boxes_setup' );

/* Meta box setup function. */
if ( !function_exists( 'sdw_meta_boxes_setup' ) ) :
	function sdw_meta_boxes_setup() {
		global $typenow;
		if ( $typenow == 'page' ) {
			add_action( 'add_meta_boxes', 'sdw_load_page_metaboxes' );
			add_action( 'save_post', 'sdw_save_page_metaboxes', 10, 2 );
		}

		if ( $typenow == 'post' ) {
			add_action( 'add_meta_boxes', 'sdw_load_post_metaboxes' );
			add_action( 'save_post', 'sdw_save_post_metaboxes', 10, 2 );
		}
	}
endif;

/* Add page metaboxes */
if ( !function_exists( 'sdw_load_page_metaboxes' ) ) :
	function sdw_load_page_metaboxes() {

		/* Sidebar metabox */
		add_meta_box(
			'sdw_sidebar',
			__( 'Sidebar', THEME_SLUG ),
			'sdw_sidebar_metabox',
			'page',
			'side',
			'default'
		);

		/* Layout metabox */
		add_meta_box(
			'sdw_layout',
			__( 'Layout', THEME_SLUG ),
			'sdw_layout_metabox',
			'page',
			'side',
			'default'
		);

	}
endif;

/* Add post metaboxes */
if ( !function_exists( 'sdw_load_post_metaboxes' ) ) :
	function sdw_load_post_metaboxes() {

		/* Sidebar metabox */
		add_meta_box(
			'sdw_sidebar',
			__( 'Sidebar', THEME_SLUG ),
			'sdw_sidebar_metabox',
			'post',
			'side',
			'default'
		);

		/* Layout metabox */
		add_meta_box(
			'sdw_layout',
			__( 'Layout', THEME_SLUG ),
			'sdw_layout_metabox',
			'post',
			'side',
			'default'
		);


	}
endif;


/* Create Sidebars Metabox */
if ( !function_exists( 'sdw_sidebar_metabox' ) ) :
	function sdw_sidebar_metabox( $object, $box ) {
		
		if($object->post_type == 'post'){
			$sdw_meta = sdw_get_post_meta( $object->ID );
		} else {
			$sdw_meta = sdw_get_page_meta( $object->ID );
		}
		
		$sidebars_lay = sdw_get_sidebar_layouts( true );
		$sidebars = sdw_get_sidebars_list( true );
?>
	  	<ul class="sdw-img-select-wrap">
	  	<?php foreach ( $sidebars_lay as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = $id == $sdw_meta['use_sidebar'] ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="sdw-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="sdw-hidden" name="sdw[use_sidebar]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $sdw_meta['use_sidebar'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>

	   <p class="description"><?php _e( 'Sidebar layout', THEME_SLUG ); ?></p>

	  <?php if ( !empty( $sidebars ) ): ?>

	  	<p><select name="sdw[sidebar]" class="widefat">
	  	<?php foreach ( $sidebars as $id => $name ): ?>
	  		<option value="<?php echo esc_attr($id); ?>" <?php selected( $id, $sdw_meta['sidebar'] );?>><?php echo $name; ?></option>
	  	<?php endforeach; ?>
	  </select></p>
	  <p class="description"><?php _e( 'Choose standard sidebar to display', THEME_SLUG ); ?></p>

	  	<p><select name="sdw[sticky_sidebar]" class="widefat">
	  	<?php foreach ( $sidebars as $id => $name ): ?>
	  		<option value="<?php echo esc_attr($id); ?>" <?php selected( $id, $sdw_meta['sticky_sidebar'] );?>><?php echo $name; ?></option>
	  	<?php endforeach; ?>
	  </select></p>
	  <p class="description"><?php _e( 'Choose sticky sidebar to display', THEME_SLUG ); ?></p>

	  <?php endif; ?>
	  <?php
	}
endif;

/* Create Cover Metabox */
if ( !function_exists( 'sdw_layout_metabox' ) ) :
	function sdw_layout_metabox( $object, $box ) {
		
		if($object->post_type == 'post'){
			$sdw_meta = sdw_get_post_meta( $object->ID );
		} else {
			$sdw_meta = sdw_get_page_meta( $object->ID );
		}

		$layouts = sdw_get_single_layouts( true );
?>
	  	<ul class="sdw-img-select-wrap">
	  	<?php foreach ( $layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = $id == $sdw_meta['layout'] ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="sdw-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="sdw-hidden" name="sdw[layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $sdw_meta['layout'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>

	   <p class="description"><?php _e( 'Choose a layout', THEME_SLUG ); ?></p>

	  <?php
	}
endif;




/* Save Page Meta */
if ( !function_exists( 'sdw_save_page_metaboxes' ) ) :
	function sdw_save_page_metaboxes( $post_id, $post ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( isset( $_POST['sdw_page_nonce'] ) ) {
			if ( !wp_verify_nonce( $_POST['sdw_page_nonce'], __FILE__  ) )
				return;
		}

		if ( $post->post_type == 'page' && isset( $_POST['sdw'] ) ) {
			$post_type = get_post_type_object( $post->post_type );
			if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
				return $post_id;

			$sdw_meta = array();

			$sdw_meta = array();

			if( isset( $_POST['sdw']['use_sidebar'] ) &&  $_POST['sdw']['use_sidebar'] != 'inherit' ){
				$sdw_meta['use_sidebar'] = $_POST['sdw']['use_sidebar'];
			}
			
			if( isset( $_POST['sdw']['sidebar'] ) &&  $_POST['sdw']['sidebar'] != 'inherit' ){
				$sdw_meta['sidebar'] = $_POST['sdw']['sidebar'];
			}

			if( isset( $_POST['sdw']['sticky_sidebar'] ) &&  $_POST['sdw']['sticky_sidebar'] != 'inherit' ){
				$sdw_meta['sticky_sidebar'] = $_POST['sdw']['sticky_sidebar'];
			}

			if( isset( $_POST['sdw']['layout'] ) &&  $_POST['sdw']['layout'] != 'inherit' ){
				$sdw_meta['layout'] = $_POST['sdw']['layout'];
			}
			
			if(!empty($sdw_meta)){
				update_post_meta( $post_id, '_sdw_meta', $sdw_meta );
			} else {
				delete_post_meta( $post_id, '_sdw_meta');
			}

		}
	}
endif;

/* Save Post Meta */
if ( !function_exists( 'sdw_save_post_metaboxes' ) ) :
	function sdw_save_post_metaboxes( $post_id, $post ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( isset( $_POST['sdw_post_nonce'] ) ) {
			if ( !wp_verify_nonce( $_POST['sdw_post_nonce'], __FILE__  ) )
				return;
		}


		if ( $post->post_type == 'post' && isset( $_POST['sdw'] ) ) {
			$post_type = get_post_type_object( $post->post_type );
			if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
				return $post_id;

			$sdw_meta = array();

			if( isset( $_POST['sdw']['use_sidebar'] ) &&  $_POST['sdw']['use_sidebar'] != 'inherit' ){
				$sdw_meta['use_sidebar'] = $_POST['sdw']['use_sidebar'];
			}
			
			if( isset( $_POST['sdw']['sidebar'] ) &&  $_POST['sdw']['sidebar'] != 'inherit' ){
				$sdw_meta['sidebar'] = $_POST['sdw']['sidebar'];
			}

			if( isset( $_POST['sdw']['sticky_sidebar'] ) &&  $_POST['sdw']['sticky_sidebar'] != 'inherit' ){
				$sdw_meta['sticky_sidebar'] = $_POST['sdw']['sticky_sidebar'];
			}

			if( isset( $_POST['sdw']['layout'] ) &&  $_POST['sdw']['layout'] != 'inherit' ){
				$sdw_meta['layout'] = $_POST['sdw']['layout'];
			}
			
			if(!empty($sdw_meta)){
				update_post_meta( $post_id, '_sdw_meta', $sdw_meta );
			} else {
				delete_post_meta( $post_id, '_sdw_meta');
			}

		}
	}
endif;

/* Add metaboxes to category */

if ( !function_exists( 'sdw_category_add_meta_fields' ) ) :
	function sdw_category_add_meta_fields() {
		$sdw_meta = sdw_get_category_meta();
		$sidebars_lay = sdw_get_sidebar_layouts( true );
		$sidebars = sdw_get_sidebars_list( true );
		$post_layouts = sdw_get_main_layouts( true, false );
?>

	 <div class="form-field">
	  		<label><?php _e( 'Cover image', THEME_SLUG ); ?></label>

    		<?php $display = $sdw_meta['cover'] ? 'initial' : 'none'; ?>
		  <p>
		  	<img id="sdw-cover-preview" src="<?php echo esc_url($sdw_meta['cover']); ?>" style="width: 300px;  border: 2px solid #ebebeb; display:<?php echo $display; ?>;">
		  </p>

		  <p>
	    	<input type="hidden" name="sdw[cover]" id="sdw-cover-url" value="<?php echo esc_attr($sdw_meta['cover']); ?>" />
	   	  	<input type="button" id="sdw-cover-upload" class="button-secondary" value="<?php _e( 'Upload', THEME_SLUG ); ?>" />
	   	  	<input type="button" id="sdw-cover-clear" class="button-secondary" value="<?php _e( 'Clear', THEME_SLUG ); ?>" style="display:<?php echo $display; ?>"/>
	      </p>
	
		  <p class="description"><?php _e( 'Upload cover image for this category', THEME_SLUG ); ?></p>
	  </div>

	 <div class="form-field">
	  	<label><?php _e( 'Posts main layout', THEME_SLUG ); ?></label>
	  	<ul class="sdw-img-select-wrap next-hide">
	  	<?php foreach ( $post_layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = sdw_compare( $sdw_meta['layout'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="sdw-img-select<?php echo esc_attr($selected_class); ?>">
	  			<input type="radio" class="sdw-hidden" name="sdw[layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $sdw_meta['layout'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>
	   <p class="description"><?php _e( 'Choose posts layout for this category', THEME_SLUG ); ?></p>
	 </div>

	 <div class="form-field">
	  	<label><?php _e( 'Sidebar layout', THEME_SLUG ); ?></label>
	  	<ul class="sdw-img-select-wrap">
	  	<?php foreach ( $sidebars_lay as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = sdw_compare( $sdw_meta['use_sidebar'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="sdw-img-select<?php echo esc_attr($selected_class); ?>">
	  			<input type="radio" class="sdw-hidden" name="sdw[use_sidebar]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $sdw_meta['use_sidebar'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>
	   <p class="description"><?php _e( 'Choose sidebar layout', THEME_SLUG ); ?></p>
	 </div>

	  <?php if ( !empty( $sidebars ) ): ?>
	  <div class="form-field">
	  <label><?php _e( 'Standard sidebar', THEME_SLUG ); ?></label>
	  	<select name="sdw[sidebar]">
	  	<?php foreach ( $sidebars as $id => $name ): ?>
	  		<option value="<?php echo esc_attr($id); ?>" <?php selected( $id, $sdw_meta['sidebar'] );?>><?php echo $name; ?></option>
	  	<?php endforeach; ?>
	  </select>
	  <p class="description"><?php _e( 'Choose standard sidebar to display', THEME_SLUG ); ?></p>
	  </div>
	  <div class="form-field">
	  <label><?php _e( 'Sticky sidebar', THEME_SLUG ); ?></label>
	  <select name="sdw[sticky_sidebar]">
	  	<?php foreach ( $sidebars as $id => $name ): ?>
	  		<option value="<?php echo esc_attr($id); ?>" <?php selected( $id, $sdw_meta['sticky_sidebar'] );?>><?php echo $name; ?></option>
	  	<?php endforeach; ?>
	  </select>
	   <p class="description"><?php _e( 'Choose sticky sidebar to display', THEME_SLUG ); ?></p>
	   </div>
	  <?php endif; ?>

	  <?php

?>

	<?php
	}
endif;

add_action( 'category_add_form_fields', 'sdw_category_add_meta_fields', 10, 2 );

if ( !function_exists( 'sdw_category_edit_meta_fields' ) ) :
	function sdw_category_edit_meta_fields( $term ) {
		$sdw_meta = sdw_get_category_meta( $term->term_id );
		$sidebars_lay = sdw_get_sidebar_layouts( true );
		$sidebars = sdw_get_sidebars_list( true );
		$post_layouts = sdw_get_main_layouts( true );
?>
	
	  <tr class="form-field">
		<th scope="row" valign="top">
	  		<label><?php _e( 'Cover image', THEME_SLUG ); ?></label>
	  	</th>
	  	<td>
    		<?php $display = $sdw_meta['cover'] ? 'initial' : 'none'; ?>
		  <p>
		  	<img id="sdw-cover-preview" src="<?php echo esc_url($sdw_meta['cover']); ?>" style="width: 300px;  border: 2px solid #ebebeb; display:<?php echo $display; ?>;">
		  </p>

		  <p>
	    	<input type="hidden" name="sdw[cover]" id="sdw-cover-url" value="<?php echo esc_url($sdw_meta['cover']); ?>" />
	   	  	<input type="button" id="sdw-cover-upload" class="button-secondary" value="<?php _e( 'Upload', THEME_SLUG ); ?>" />
	   	  	<input type="button" id="sdw-cover-clear" class="button-secondary" value="<?php _e( 'Clear', THEME_SLUG ); ?>" style="display:<?php echo $display; ?>"/>
	      </p>
	
		  <p class="description"><?php _e( 'Upload cover image for this category', THEME_SLUG ); ?></p>
	 	</td>
	  </tr>

	  <tr class="form-field">
		<th scope="row" valign="top">
	  		<label><?php _e( 'Posts main layout', THEME_SLUG ); ?></label>
	  	</th>
	  	<td>
		  	<ul class="sdw-img-select-wrap next-hide">
	  		<?php foreach ( $post_layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = sdw_compare( $sdw_meta['layout'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="sdw-img-select<?php echo $selected_class; ?>">
	  			<input type="radio" class="sdw-hidden" name="sdw[layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $sdw_meta['layout'] );?>/> </label>
	  		</li>
	  		<?php endforeach; ?>
	   		</ul>
		   	<p class="description"><?php _e( 'Choose posts layout for this category', THEME_SLUG ); ?></p>
	 	</td>
	  </tr>

	  <tr class="form-field">
		<th scope="row" valign="top">
	  		<label><?php _e( 'Sidebar layout', THEME_SLUG ); ?></label>
	  	</th>
	  	<td>
		  	<ul class="sdw-img-select-wrap">
	  		<?php foreach ( $sidebars_lay as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = sdw_compare( $sdw_meta['use_sidebar'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="sdw-img-select<?php echo esc_attr($selected_class); ?>">
	  			<input type="radio" class="sdw-hidden" name="sdw[use_sidebar]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $sdw_meta['use_sidebar'] );?>/> </label>
	  		</li>
	  		<?php endforeach; ?>
	   </ul>
		   	<p class="description"><?php _e( 'Choose sidebar layout', THEME_SLUG ); ?></p>
	 	</td>
	  </tr>

	  <tr class="form-field">
		<th scope="row" valign="top">
	  		<label><?php _e( 'Standard sidebar', THEME_SLUG ); ?></label>
	  	</th>
	  	<td>
			<select name="sdw[sidebar]">
			<?php foreach ( $sidebars as $id => $name ): ?>
				<option value="<?php echo esc_attr($id); ?>" <?php selected( $id, $sdw_meta['sidebar'] );?>><?php echo $name; ?></option>
			<?php endforeach; ?>
			</select>
			<p class="description"><?php _e( 'Choose standard sidebar to display', THEME_SLUG ); ?></p>
	  	</td>
	  </tr>
	  <tr class="form-field">
		<th scope="row" valign="top">
	  		<label><?php _e( 'Sticky sidebar', THEME_SLUG ); ?></label>
	  	</th>
	  	<td>
		  	<select name="sdw[sticky_sidebar]">
		  	<?php foreach ( $sidebars as $id => $name ): ?>
		  		<option value="<?php echo esc_attr($id); ?>" <?php selected( $id, $sdw_meta['sticky_sidebar'] );?>><?php echo $name; ?></option>
		  	<?php endforeach; ?>
		  	</select>
		    <p class="description"><?php _e( 'Choose sticky sidebar to display', THEME_SLUG ); ?></p>
	   </td>
	 </tr>

	 <?php

?>

	<?php
	}
endif;

add_action( 'category_edit_form_fields', 'sdw_category_edit_meta_fields', 10, 2 );


if ( !function_exists( 'sdw_save_category_meta_fields' ) ) :
	function sdw_save_category_meta_fields( $term_id ) {

		if ( isset( $_POST['sdw'] ) ) {

			$sdw_meta = array();

			if( isset( $_POST['sdw']['layout'] ) && $_POST['sdw']['layout'] != 'inherit' ){
				$sdw_meta['layout'] = $_POST['sdw']['layout'];
			}

			if( isset( $_POST['sdw']['use_sidebar'] ) && $_POST['sdw']['use_sidebar'] != 'inherit' ){
				$sdw_meta['use_sidebar'] = $_POST['sdw']['use_sidebar'];
			}


			if( isset( $_POST['sdw']['sidebar'] ) && $_POST['sdw']['sidebar'] != 'inherit' ){
				$sdw_meta['sidebar'] = $_POST['sdw']['sidebar'];
			}

			if( isset( $_POST['sdw']['sticky_sidebar'] ) && $_POST['sdw']['sticky_sidebar'] != 'inherit' ){
				$sdw_meta['sticky_sidebar'] = $_POST['sdw']['sticky_sidebar'];
			}

			if( isset( $_POST['sdw']['layout'] ) && $_POST['sdw']['layout'] != 'inherit' ){
				$sdw_meta['layout'] = $_POST['sdw']['layout'];
			}

			if( isset( $_POST['sdw']['cover'] ) && !empty($_POST['sdw']['cover']) ){
				$sdw_meta['cover'] = $_POST['sdw']['cover'];
			}

			if(!empty($sdw_meta)){
				update_option( '_sdw_category_'.$term_id, $sdw_meta );
			} else {
				delete_option( '_sdw_category_'.$term_id );
			}
			
		}

	}
endif;

add_action( 'edited_category', 'sdw_save_category_meta_fields', 10, 2 );
add_action( 'create_category', 'sdw_save_category_meta_fields', 10, 2 );


?>