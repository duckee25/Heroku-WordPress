<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class to create a control which can import customizer and refreshes live preview.
 *
 * @since 1.0.0
 */
class Themify_Import_Control extends WP_Customize_Control {

	/**
	 * Type of this control.
	 * @access public
	 * @var string
	 */
	public $type = 'themify_import';

	/**
	 * Render the control's content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {
		?>

		<span class="customize-control-title themify-control-title">
			<span class="customize-import">
				<i class="ti-import customize-import-icon"></i>
					<?php echo themify_get_uploader('customizer-import', array(
								'label'		=> __($this->label, 'themify'),
								'preset'	=> false,
								'preview'   => false,
								'tomedia'	=> false,
								'topost'	=> '',
								'fields'	=> '',
								'featured'	=> '',
								'message'	=> '',
								'fallback'	=> '',
								'dragfiles' => false,
								'confirm'	=> __('Import will overwrite all settings and configurations. Press OK to continue, Cancel to stop.', 'themify'),
								'medialib'	=> false,
								'formats'	=> 'zip,txt',
								'type'		=> ''
							)
						); ?>
			</span>
		</span>
		<input <?php $this->link(); ?> value="" type="hidden" class="<?php echo esc_attr( $this->type ); ?>_control"/>
		<?php
	}
}