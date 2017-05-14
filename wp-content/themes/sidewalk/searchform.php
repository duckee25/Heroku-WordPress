<form class="sdw-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<input name="s" class="sdw-search-input" size="20" type="text" value="<?php echo esc_attr(__sdw('search_form')); ?>" onfocus="(this.value == '<?php echo esc_attr(__sdw('search_form')); ?>') && (this.value = '')" onblur="(this.value == '') && (this.value = '<?php echo esc_attr(__sdw('search_form')); ?>')" placeholder="<?php echo esc_attr(__sdw('search_form')); ?>" />
	<button type="submit" class="sdw-search-submit"><i class="fa fa-search"></i></button> 
</form>