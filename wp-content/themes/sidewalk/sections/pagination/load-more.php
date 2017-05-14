<?php   $more_link = get_next_posts_link( __sdw('load_more') ); ?>
<?php if(!empty($more_link)) : ?>
<div class="sdw-post-separator sdw-post-separator-1 sdw-pagination-separator"></div>
<nav id="sdw-pagination" class="sdw-pagination sdw-load-more">
		<?php echo $more_link; ?>
		<div class="sdw-loader"><?php _e('Loading...', THEME_SLUG); ?></div>
</nav>

<?php endif; ?>