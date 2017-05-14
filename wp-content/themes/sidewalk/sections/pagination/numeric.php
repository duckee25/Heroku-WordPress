<?php if($pagination = sdw_pagination(__sdw('previous_posts'),__sdw('next_posts'))) : ?>
<div class="sdw-post-separator sdw-post-separator-1 sdw-pagination-separator"></div>
<nav id="sdw-pagination" class="sdw-pagination">
	<?php echo $pagination; ?>
</nav>
<?php endif; ?>