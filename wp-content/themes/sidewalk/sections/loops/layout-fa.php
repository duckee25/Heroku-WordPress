<article id="post-<?php the_ID(); ?>">

<?php if( $fimg = sdw_featured_image('sdw-lay-c', get_the_ID()) ): ?>
 	<figure class="fa-thumbnail">
 	<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
		<?php echo $fimg; ?>
		<?php if($icon = sdw_post_format_icon('lay_fa')) :?>
				<span class="sdw-format-icon">
					<i class="fa <?php echo $icon; ?>"></i>
				</span>
		<?php endif; ?>
	</a>
	</figure>
<?php endif; ?>

<div class="fa-content">
<?php if(sdw_get_option('lay_fa_cat')): ?>
	<div class="entry-categories"><?php the_category(); ?></div>
<?php endif; ?>
<h2 class="entry-title"><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php echo get_the_title(); ?></a></h2>
<?php if($meta = sdw_get_meta_data('lay_fa')): ?>
	<div class="entry-meta"><?php echo $meta; ?></div>
<?php endif; ?>	
</div>

</article>