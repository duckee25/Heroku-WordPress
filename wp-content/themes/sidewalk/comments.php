<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) {
		return;
	}
?>

<?php if ( have_comments() ) : ?>
<div id="comments" class="comments-main">
     <div class="comments-holder sdw-box">
        <h3 class="comment-title sdw-box-title"><span><?php comments_number(__sdw('no_comments'), __sdw('one_comment'), __sdw('comments_number')); ?></span></h3> 

      <div class="sdw-comments-inside">              
        <ul class="comment-list">
            <?php $args = array(
                'avatar_size' => 50,
                'reply_text' => __sdw('reply_comment'),
                'format' => 'html5'
            );?>
            <?php wp_list_comments($args); ?>
        </ul>
        </div>
    		
    		<div class="navigation">
  			   <?php paginate_comments_links(); ?> 
 			</div>
    </div>
</div>
<?php endif; ?>

<?php if(comments_open()) : ?>
    <?php 

    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $comment_form_args = array(
        'comment_notes_after' => '',
        'cancel_reply_link' => '<i class="fa fa-times"></i>',
        'label_submit'      => __sdw( 'comment_submit' ),
        'title_reply' => '<span>'.__sdw( 'leave_a_reply' ).'</span>',
        'must_log_in' => '<p class="must-log-in">' . sprintf( __sdw('must_log_in'), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
        'logged_in_as' => '<p class="logged-in-as">' . sprintf(__sdw( 'logged_in_as' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . __sdw( 'comment_field' ) .'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .'</textarea></p>',
        'fields' => apply_filters( 'comment_form_default_fields', array(
            'author' =>
              '<p class="comment-form-author">' .
              '<label for="author">' . __sdw( 'comment_name' ) . ( $req ? '<span class="required"> *</span>' : '' ) . '</label> ' .
              '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
              '" size="30"' . esc_attr($aria_req) . ' /></p>',

            'email' =>
              '<p class="comment-form-email"><label for="email">' . __sdw( 'comment_email' ) . ( $req ? '<span class="required"> *</span>' : '' ).'</label> '  .
              '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
              '" size="30"' . esc_attr($aria_req) . ' /></p>',

            'url' =>
              '<p class="comment-form-url"><label for="url">' .
              __sdw( 'comment_website' ) . '</label>' .
              '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
              '" size="30" /></p>'
            )
          ),
        );

    ?>

  <?php comment_form($comment_form_args); ?>
<?php endif; ?>