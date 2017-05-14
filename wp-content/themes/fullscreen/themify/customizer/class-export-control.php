<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class to create a control which allows to export customizer.
 *
 * @since 1.0.0
 */
class Themify_Export_Control extends WP_Customize_Control {

	/**
	 * Type of this control.
	 * @access public
	 * @var string
	 */
	public $type = 'themify_export';

	/**
	 * Render the control's content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {
		?>

		<span class="customize-control-title themify-control-title">
			<a href="<?php echo esc_attr(add_query_arg( 'export', 'themify-customizer', wp_nonce_url(admin_url('customize.php'), 'themify_customizer_export_nonce') )); ?>" class="customize-export" target="_blank">
				<span class="ti-export customize-export-icon"></span>
				<?php echo esc_html( $this->label ); ?>
			</a>
		</span>

		<input <?php $this->link(); ?> value="" type="hidden" class="<?php echo esc_attr( $this->type ); ?>_control"/>
		<?php
	}
}