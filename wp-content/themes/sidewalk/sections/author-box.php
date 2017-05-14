<section class="sdw-box sdw-author-box">

	<h3 class="sdw-box-title"><span><?php echo __sdw('about_author'); ?></span></h3>

	<div class="sdw-box-inside">

	<div class="data-image">
		<?php echo get_avatar( get_the_author_meta('ID'), 135 ); ?>
	</div>
	
	<div class="data-content">
		<h4 class="author-title"><?php the_author_meta('display_name'); ?></h4>
		<div class="data-entry-content">
			<?php echo wpautop(get_the_author_meta('description')); ?>
		</div>


		<div class="sdw-data-links">
				<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="sdw-author-link sdw-button-secondary sdw-button-small"><i class="fa fa-file-text-o"></i><?php echo __sdw('view_all_posts'); ?></a>
		</div>
	
		<div class="sdw-author-links">
			<?php if (get_the_author_meta('url')) {?> <a href="<?php esc_url(the_author_meta('url')); ?>" target="_blank" class="fa fa-link sdw-author-website"></a><?php } ?>
			<?php $user_social = sdw_get_social(); ?>			
			<?php foreach($user_social as $soc_id => $soc_name): ?>
				<?php if($social_meta = get_the_author_meta($soc_id)) : ?>
					<a href="<?php echo esc_url($social_meta); ?>" target="_blank" class="fa fa-<?php echo esc_attr($soc_id); ?>"></a>
				<?php endif; ?>			
			<?php endforeach; ?>					
		</div>
	
	</div>	
	
	</div>
</section>