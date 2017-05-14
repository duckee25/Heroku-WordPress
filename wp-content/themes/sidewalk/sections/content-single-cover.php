<article id="post-<?php the_ID(); ?>" <?php post_class( 'sdw-post sdw-post-cover sdw-single' ); ?>>

	<?php if($format = get_post_format()): ?>
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
						<a href="<?php echo esc_url($full_img[0]); ?>" class="sdw-image-format"><span class="sdw-image-overlay"><i class="fa fa-search-plus"></i></span><?php echo sdw_featured_image( 'sdw-lay-a' ); ?></a>
						<?php if($caption = get_post(get_post_thumbnail_id())->post_excerpt) : ?>
							<figcaption><?php echo $caption; ?></figcaption>
						<?php endif; ?>
					</figure>
				<?php endif; ?>
			<?php endif; ?>
	<?php endif; ?>

	<div class="entry-wrapper">

	<div class="entry-content">

		<?php the_content(); ?>		

		<?php if( sdw_is_paginated_post()) : ?>
				<?php get_template_part('sections/paginated-nav'); ?>
		<?php endif; ?>

	</div>

	<?php if(sdw_get_option('show_tags') && has_tag()) : ?>
		<div class="meta-tags">
			<?php echo __sdw('tagged_as'); ?><?php the_tags( false, ' ', false ); ?>
		</div>
	<?php endif; ?>

	<?php if($actions = sdw_get_action_buttons('single')): ?>
		<div class="entry-footer"><?php echo $actions; ?></div>
	<?php endif; ?>

	</div>


</article>