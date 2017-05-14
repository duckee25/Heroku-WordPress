<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 * @version     2.1.0
 * @version     1.6.4
 */
global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

if ( ! comments_open() )
	return; ?>
<div id="reviews"><?php 
	
	echo '<div id="comments">';
	
	?><h4><?php
		if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
			printf( _n('%s review for %s', '%s reviews for %s', $count, 'woocommerce'), $count, get_the_title() );
		else
			_e( 'Reviews', 'woocommerce' );
	?></h4><?php
	
	$title_reply = '';

	if ( have_comments() ) : 

		echo '<ol class="commentlist">';
		
		wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );

		echo '</ol>';
	
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="alignleft"><?php previous_comments_link( __( '<div class="nav-previous pix_button tiny_button"><span class="meta-nav">&larr;</span> Previous</div>', 'forte' ) ); ?></div>
				<div class="alignright"><?php next_comments_link( __( '<div class="nav-next pix_button tiny_button">Next <span class="meta-nav">&rarr;</span></div>', 'forte' ) ); ?></div>
			</div>

			<div class="clear"></div>
		<?php endif;
						
	else : 
		
		echo '<p>'.__('There are no reviews yet, would you like to <a href="#review_form" class="inline show_review_form">submit yours</a>?', 'forte').'</p>';
	
	endif;
	
	$commenter = wp_get_current_commenter();
	
	echo '</div><div id="review_form_wrapper"><div id="review_form">';
	
	$comment_form = array(
		'title_reply' => '',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => array(
			'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'forte' ) . '</label> ' . '<span class="required">*</span>:<br>' .
			            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
			'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'forte' ) . '</label> ' . '<span class="required">*</span>:<br>' .
			            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
		),
		'label_submit' => __('Submit Review', 'forte'),
		'logged_in_as' => '',
		'comment_field' => ''
	);
		
	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
	
		$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __('Rating', 'forte') .':</label><select name="rating" class="letmebe" id="rating">
			<option value="">'.__('Rate...', 'forte').'</option>
			<option value="5">'.__('Perfect', 'forte').'</option>
			<option value="4">'.__('Good', 'forte').'</option>
			<option value="3">'.__('Average', 'forte').'</option>
			<option value="2">'.__('Not that bad', 'forte').'</option>
			<option value="1">'.__('Very Poor', 'forte').'</option>
		</select></p>';
			
	}
	
	$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'forte' ) . ':</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>' .wp_nonce_field('comment_rating', true, false);
	
	comment_form( $comment_form ); 

	echo '</div></div>';
	
?><div class="clear"></div></div>