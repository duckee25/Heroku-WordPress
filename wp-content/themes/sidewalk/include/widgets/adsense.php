<?php
/*-----------------------------------------------------------------------------------*/
/*	Adsense Widget Class
/*-----------------------------------------------------------------------------------*/

class SDW_Adsense_Widget extends WP_Widget { 

	var $defaults;

	function __construct() {
		$widget_ops = array( 'classname' => 'sdw_adsense_widget', 'description' => __('You can place Google AdSense or any JavaScript related code inside this widget', THEME_SLUG) );
		$control_ops = array( 'id_base' => 'sdw_adsense_widget' );
		parent::__construct( 'sdw_adsense_widget', __('Sidewalk Adsense', THEME_SLUG), $widget_ops, $control_ops );

		$this->defaults = array( 
				'title' => '',
				'adsense_code' => '',
			);
	}

	
	function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;

		if ( !empty($title) ) {
			echo $before_title . $title . $after_title;
		}
		
		$adsense_code = !empty( $instance['adsense_code'] ) ? $instance['adsense_code'] : '';

		?>
		<div class="sdw_adsense_wrapper">
			<?php echo $adsense_code; ?>
		</div>
	
		<?php
			echo $after_widget;
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['adsense_code'] = current_user_can('unfiltered_html') ? $new_instance['adsense_code'] : stripslashes( wp_filter_post_kses( addslashes($new_instance['adsense_code']) ) );
		return $instance;
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>
			
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', THEME_SLUG); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
			<small class="howto"><?php _e('Leave empty for no title', THEME_SLUG); ?></small>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'adsense_code' ); ?>"><?php _e('Adsense Code', THEME_SLUG); ?>:</label>
			<textarea id="<?php echo $this->get_field_id( 'adsense_code' ); ?>" type="text" name="<?php echo $this->get_field_name( 'adsense_code' ); ?>" class="widefat" rows="10"><?php echo $instance['adsense_code']; ?></textarea>
			<small class="howto"><?php _e('Place your Google Adsense code or any JavaScript related advertising code.', THEME_SLUG); ?></small>
		</p>
				
	<?php
	}
}

?>