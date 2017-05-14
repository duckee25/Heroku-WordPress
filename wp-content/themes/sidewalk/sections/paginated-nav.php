<div class="sdw-link-pages">
		<?php global $page, $numpages; ?>

		<span class="sdw-paginated-num"><?php printf( __sdw( 'page_of' ), $page, $numpages ); ?></span>

		<?php if ( $page == 1 ) : ?>
			<?php echo _wp_link_page( $numpages ).'<i class="fa fa-angle-left"></i></a>'; ?>
		<?php endif; ?>

		<?php wp_link_pages( array( 'before' => '', 'after' => '', 'next_or_number' => 'next', 'nextpagelink'     => '<i class="fa fa-angle-right"></i>',
		'previouspagelink' => '<i class="fa fa-angle-left"></i>' ) ); ?>

		<?php if ( $page == $numpages ) : ?>
			<?php echo _wp_link_page( 1 ).'<i class="fa fa-angle-right"></i></a>'; ?>
		<?php endif; ?>
</div>
