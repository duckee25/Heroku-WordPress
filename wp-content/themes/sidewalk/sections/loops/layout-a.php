<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'sdw-post sdw-layout-a', sdw_highlight_post_class() )); ?>>

	<?php $format = get_post_format(); ?>

	<?php if( sdw_get_option( 'lay_a_fimg' ) && ( !$format || ($format && sdw_get_option('lay_a_format') == 'icon') ) && $fimg = sdw_featured_image('sdw-lay-a') ): ?>
	 	<figure class="post-thumbnail">
	 	<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
			<?php echo $fimg; ?>
			<?php if(sdw_get_option( 'lay_a_fimg_cap' ) && !$format && $caption = get_post(get_post_thumbnail_id())->post_excerpt) : ?>
				<figcaption><?php echo $caption;  ?></figcaption>
			<?php endif; ?>
			<?php if($format && $icon = sdw_post_format_icon('lay_a') ) : ?>
				<span class="sdw-format-icon">
						<i class="fa <?php echo $icon; ?>"></i>
				</span>
			<?php endif; ?>
		</a>
		</figure>
	<?php endif; ?>

	<?php if(sdw_get_option( 'lay_a_fimg' ) && $format && sdw_get_option('lay_a_format') == 'media' ): ?>
			<?php if($format == 'gallery') : ?>
				<?php if ( $gallery = hybrid_media_grabber( array( 'type' => 'gallery', 'split_media' => true ) ) ): ?>
					<div class="meta-media"><?php echo $gallery; ?></div>
				<?php endif; ?>
			<?php elseif( $format == 'video') : ?>
				<?php if ( $video = hybrid_media_grabber( array( 'type' => 'video', 'split_media' => true ) ) ): ?>
					<div class="meta-media"><?php echo $video; ?></div>
				<?php endif; ?>
			<?php elseif( $format == 'audio') : ?>
				<?php if ($audio = hybrid_media_grabber( array( 'type' => 'audio', 'split_media' => true ) ) ): ?>
				 	<div class="meta-media">
				 		<?php echo $audio; ?>
				 		<?php if ( has_post_thumbnail() ) : ?>
							<?php echo sdw_featured_image('sdw-lay-a'); ?>
						<?php endif; ?>	
					</div>
				<?php endif; ?>
			<?php elseif( $format == 'image') : ?>
				<?php if ( has_post_thumbnail() ) : ?>
				 	<figure class="post-thumbnail">
						<?php $full_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
						<a href="<?php echo esc_url($full_img[0]); ?>" class="sdw-image-format"><?php echo sdw_featured_image( 'sdw-lay-a' ); ?></a>
						<?php if($caption = get_post(get_post_thumbnail_id())->post_excerpt) : ?>
							<figcaption><?php echo $caption; ?></figcaption>
						<?php endif; ?>
					</figure>
				<?php endif; ?>
			<?php endif; ?>
	<?php endif; ?>
	
	<div class="entry-wrapper">

		<div class="entry-header">
		<?php if(sdw_get_option('lay_a_cat')): ?>
			<div class="entry-categories"><?php the_category(); ?></div>
		<?php endif; ?>
		<h2 class="entry-title"><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h2>
		<?php if($meta = sdw_get_meta_data('lay_a')): ?>
			<div class="entry-meta"><?php echo $meta; ?></div>
		<?php endif; ?>
		</div>

		<div class="entry-content">
			<?php if( sdw_get_option('lay_a_content_type') == 'content') : ?>
				<?php the_content( '' ); ?>
			<?php else: ?>
				<p><?php echo sdw_get_excerpt('lay_a'); ?></p>
			<?php endif; ?>
		</div>

		<?php if($actions = sdw_get_action_buttons('lay_a')): ?>
			<div class="entry-footer"><?php echo $actions; ?></div>
		<?php endif; ?>

	</div>
	
<div class="sdw-post-separator sdw-post-separator-1"></div>
</article>