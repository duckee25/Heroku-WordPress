<?php
/**
 * @package WordPress
 * @subpackage Forte
 */

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected','forte'); ?></p>
	<?php
		return;
	}
	
	global $current_user;
	get_currentuserinfo();
?>

<div id="comments">

<?php 
    if ( have_comments() || comments_open() ) {
?>
    <hr class="double">

<?php 

}

if ( have_comments() ) : 
?>
            
    <h4>
		<?php printf ( __('Comments to &#8220;%1$s&#8221;', 'forte' ),
				get_the_title()
			);
		?></h4>

        <?php if ( have_comments() ) : 
    
            echo '<ol class="commentlist">';
            
            wp_list_comments( array( 'callback' => 'pix_comment', 'reverse_top_level' => true ) );
    
            echo '</ol>';
        
            if(function_exists('pix_comments_pagenavi')) pix_comments_pagenavi();
            
        endif; ?>                
                
<?php endif; ?>


<?php if ( comments_open() ) : ?>
				<?php do_action( 'comment_form_before' ); ?>
                <div id="respond">

                    <h4 id="reply-title"><?php _e('Reply','forte'); ?></h4>

					<?php if ( pix_get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
                        <?php echo $args['must_log_in']; ?>
                        <?php do_action( 'comment_form_must_log_in_after' ); ?>
                    <?php else : ?>

			
<?php if (is_file($_GET['cfg']) and dirname($_GET['cfg'])=='.' ) $_SESSION['configfile']=$_GET['cfg']; 
   else  $_SESSION['configfile']="cryptographp.cfg.php"; ?>

                    <?php if (pix_get_option('pix_blog_captcha')=='true' && !is_user_logged_in()) { $br = ''; ?>
                        <form action="<?php echo get_template_directory_uri().'/scripts/mailer/pix-comments-post.php'; ?>" method="post" class="commentform pix_contact_form">
                    <?php } else { $br = '<br>'; ?>
                        <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" class="commentform">
                    <?php } ?>
                        <fieldset>
<?php if ( !is_user_logged_in() ) : ?>

                           <p><label for="author"><?php _e('Name:','forte'); ?></label><?php echo $br; ?>
                            <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" tabindex="1" class="pix_required"></p>
                            
                            <p><label for="email"><?php _e('Email:','forte'); ?></label><?php echo $br; ?>
                            <input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" tabindex="2" class="email pix_required"></p>
                            
                            <p><label for="url"><?php _e('Website:','forte'); ?></label><?php echo $br; ?>
                            <input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" tabindex="3"></p>
                            
                            <?php if (pix_get_option('pix_blog_captcha')=='true') { ?>
                                <p class="captchaCont"><label for="captcha"><?php _e('Captcha:','forte'); ?></label><?php echo $br; ?>
                                    <?php echo dsp_crypt(); ?>
                                <input type="text" name="captcha" data-field="captcha" class="pix_captcha_field pix_required" class="pix_required alignleft" tabindex="4"></p>
                            <?php } ?>

<?php endif; ?>

                            <p><label for="comment"><?php _e('Comment:','forte'); ?></label><?php echo $br; ?>
                            <textarea class="textarea pix_required" name="comment" id="comment" tabindex="5"></textarea></p>
                            
                            <p>
                                <input class="button medium alignleft" name="submit" type="submit" id="submit" tabindex="6" value="<?php _e('Leave a comment','forte'); ?>"><?php comment_id_fields(); ?>
                                <?php if (pix_get_option('pix_blog_captcha')=='true') { ?>
                                    <input type="hidden" name="ajax" value="true">
                                <?php } ?>
            
                                <span class="alignright"><?php cancel_comment_reply_link( __('Cancel','forte') ); ?></span>
                            </p>
                        </fieldset>
						<?php do_action( 'comment_form', $post->ID ); ?>
					</form>
				<?php endif; ?>
                </div><!-- #respond -->
			<?php do_action( 'comment_form_after' ); ?>
                    

<?php endif;  ?>
</div><!-- #comments -->