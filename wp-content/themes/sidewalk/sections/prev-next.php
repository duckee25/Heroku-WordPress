<?php
	$in_same_cat = sdw_get_option('prev_next_cat') ? true : false;
	$prev = get_previous_post($in_same_cat); 
	$next = get_next_post($in_same_cat);
?>
<div class="sdw-post-separator sdw-post-separator-1 sdw-ps-show"></div>
<nav class="prev-next-nav">
	<?php if($prev) : ?>
		
		<div class="sdw-prev-link">
			<span class="sdw-pn-label"><?php echo __sdw('previous_posts_text'); ?></span>
			<?php previous_post_link('%link','<span class="sdw-pn-ico"><i class="fa fa fa-chevron-left"></i></span><span class="sdw-prev-next-link">%title</span>', $in_same_cat); ?>
		</div>

	<?php endif; ?>
	
	<?php if($next) : ?>
		<div class="sdw-next-link">
		<span class="sdw-pn-label"><?php echo __sdw('next_posts_text'); ?></span>
			<?php next_post_link('%link','<span class="sdw-pn-ico"><i class="fa fa fa-chevron-right"></i></span><span class="sdw-prev-next-link">%title</span>', $in_same_cat); ?>
		</div>	
	<?php endif; ?>
</nav>