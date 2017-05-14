<?php  if(get_next_posts_link() || get_previous_posts_link()) : ?>
<div class="sdw-post-separator sdw-post-separator-1 sdw-pagination-separator"></div>
<nav id="sdw-pagination" class="sdw-pagination">
	<div class="sdw-next">
		<?php previous_posts_link(__sdw('newer_entries')); ?>
	</div>
	<div class="sdw-prev">
		<?php next_posts_link(__sdw('older_entries')); ?>
	</div>
</nav>
<?php endif; ?>