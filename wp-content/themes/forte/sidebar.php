<?php 
	global $no_sidebar, $page_sidebar;
	if ( !$no_sidebar ) { ?>
<aside class="pix_sidebar pix_column pix_column_210 align<?php echo pix_get_option('pix_aside_position'); ?>">
	<?php dynamic_sidebar( pix_selected_sidebar($page_sidebar) ); ?>
</aside>

<?php } ?>
