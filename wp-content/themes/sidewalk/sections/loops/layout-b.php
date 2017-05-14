<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'sdw-post sdw-layout-b', sdw_highlight_post_class() )); ?>>
<div class="sdw-post-inside">
	<?php if( $fimg = sdw_featured_image('sdw-lay-b') ): ?>
	 	<figure class="post-thumbnail">
	 	<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
			<?php echo $fimg; ?>
			<?php if($icon = sdw_post_format_icon('lay_b')) :?>
					<span class="sdw-format-icon">
						<i class="fa <?php echo $icon; ?>"></i>
					</span>
			<?php endif; ?>
		</a>
		</figure>
	<?php endif; ?>

	<div class="entry-wrapper">

	<div class="entry-header">
		<?php if(sdw_get_option('lay_b_cat')): ?>
			<div class="entry-categories"><?php the_category(); ?></div>
		<?php endif; ?>
		<h2 class="entry-title"><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php echo get_the_title(); ?></a></h2>
		<?php if($meta = sdw_get_meta_data('lay_b')): ?>
			<div class="entry-meta"><?php echo $meta; ?></div>
		<?php endif; ?>
	</div>

	<?php if(sdw_get_option('lay_b_excerpt')): ?>
		<div class="entry-content">
			<p><?php echo sdw_get_excerpt('lay_b'); ?></p>
		</div>
	<?php endif; ?>

	</div>
</div>	
<div class="sdw-post-separator sdw-post-separator-1"></div>
</article>