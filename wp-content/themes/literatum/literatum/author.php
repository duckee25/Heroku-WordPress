<?php
/**
 * The template for displaying Author profile.
 */

@$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $_GET['author_name']) : get_userdata($_GET['author']);
if(!$curauth) $curauth = get_user_by( 'slug', get_query_var( 'author_name' ) );


if ( function_exists('KTT_ajax_show_header') ) {  KTT_ajax_show_header(); } else { get_header(); }; ?>

	<?php get_template_part('elements','head-author');?>

	<div class="author-profile-info article-default-width">

		<div class="author-avatar">
			<?php 

			$profile_avatar_id = get_user_meta($curauth->ID, ktt_var_name('profile_avatar'), true);
			
			if ($profile_avatar_id) {

				$image_attributes = wp_get_attachment_image_src( $profile_avatar_id, 'thumbnail' );
				$avatar_src = $image_attributes[0];

				?>
				<img alt='' src='<?php echo $avatar_src;?>' class='avatar avatar-170 photo' height='170' width='170' />
				<?php

			} else {
				echo get_avatar( $curauth->ID, 170 );
			}
			




			?>
		</div>

		<span class="author-name">
			<?php echo $curauth->display_name;?>
		</span>

		<span class="author-desc">
			<?php echo $curauth->description;?>
		</span>

		<div class="author-contact">

			<?php 
			$author_url = get_the_author_meta( 'user_url', $curauth->ID );
			if ($author_url) {?>
			<a href="<?php echo $author_url;?>" target="_blank" class="c-method">
				<i>&#xe8c5;</i> <?php echo $author_url;?>
			</a>
			<?php } ?>

			<?php 
			$author_twitter = get_the_author_meta( 'twitter', $curauth->ID );
			if ($author_twitter) {?>
			<a href="https://twitter.com/<?php echo $author_twitter;?>" target="_blank" class="c-method">
				<i>&#xe908;</i> @<?php echo $author_twitter;?>
			</a>
			<?php } ?>

			<?php 
			$author_facebook = get_the_author_meta( 'facebook', $curauth->ID );
			if ($author_facebook) {?>
			<a href="https://facebook.com/<?php echo $author_facebook;?>" target="_blank" class="c-method">
				<i>&#xe90a;</i> Facebook
			</a>
			<?php } ?>

		</div>

	</div>






	<section id="primary" class="content-area entry-content">
		
		<?php if ( have_posts() ) : ?>

			
			<?php get_template_part('elements', 'loop-default');?>
			

		<?php else : ?>

			
			<?php get_template_part( 'content', 'none' ); ?>
			

		<?php endif; ?>

	</section><!-- #primary -->



<?php if ( function_exists('KTT_ajax_show_footer') ) {  KTT_ajax_show_footer(); } else { get_footer(); };  ?>
