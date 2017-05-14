<?php $sid = sdw_get_current_sidebar(); ?>
<aside id="sidebar" class="sidebar">
	<div class="sidebar">
		<?php
			if ( is_active_sidebar( $sid['sidebar'] ) ) {
				dynamic_sidebar( $sid['sidebar'] );
			}

			if ( is_active_sidebar( $sid['sticky_sidebar'] ) ) {
				echo '<div class="sdw-sticky">';
				dynamic_sidebar( $sid['sticky_sidebar'] );
				echo '</div>';
			}
		?>
	</div>
</aside>