<?php
/**
* Show a square with the post title and image 
 * @package Amanda
 */


$post_featured_image = '';
$post_featured_image_thumb = '';

if ( has_post_thumbnail() ) {
	$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
	$post_featured_image = $image_attributes[0];

	$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'small' );
	$post_featured_image_thumb = $image_attributes[0];

}
?><div id="card-<?php echo $post->ID;?>" class="article-card searchhead under-header">


			<div class="inner">
				
				


				<div class="image-background thumb" style="z-index:0;background-image:url('<?php echo $post_featured_image_thumb;?>');">

				</div>

				<div class="image-background hidden" style="z-index:0;<?php if (is_single()) {?>background-attachment:fixed;<?php } ?>background-image:url('<?php echo $post_featured_image;?>');">

				</div>


				
				<div class="image-cover">


					<div class="search-form">
						<?php get_search_form();?>
					</div>


				</div>





			</div>

			<script>


			var img = jQuery("<img />").attr('src', '<?php echo $post_featured_image;?>')
		    .load(function() {
		        if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
		            
		        } else {
		            jQuery('#card-<?php echo $post->ID;?> .image-background').animate({opacity: 1}, 540, function() {jQuery('.image-background.thumb').fadeOut()}  );
		        }
		    });


			</script>


</div>




