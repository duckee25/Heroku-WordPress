<?php
/**
 * Frontpage Design 1 (Mosaic)
 */

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if ( function_exists('KTT_ajax_show_header') ) {  KTT_ajax_show_header(); } else { get_header(); };



 ?>




	<div id="primary" class="content-area" style="min-height:100%">
		<div id="main" class="site-main" role="main" style="min-height:100%">

		<?php if ( have_posts() ) : ?>


			<?php /* Start the Loop */
			$n = 0;

			// fix to readjust grid
			$is_multiple = false;

			// we get the number of posts availables for the grid (-1 for the featured one)
			$number_of_posts_plus_page_controls = $wp_query->post_count ;
      $number_of_posts_plus_page_controls + 1;
			if ($paged < 2) $number_of_posts_plus_page_controls -= 1;
			//if (get_next_posts_link()) $number_of_posts_plus_page_controls += 1;


			if ( $number_of_posts_plus_page_controls % 3 == 0) $is_multiple = true;



			if(!$is_multiple) {

				$positions_to_enlarge = array();

				// we get the number of posts that need to duplicate his size
				$number_of_post_to_enlarge =  roundUp( $number_of_posts_plus_page_controls, 3) - $number_of_posts_plus_page_controls;

				if ($wp_query->post_count == 2) {

					$positions_to_enlarge[] = 1;


				} elseif ($wp_query->post_count == 11) {

					$positions_to_enlarge[] = 1;
					$positions_to_enlarge[] = 7;

				} elseif ( $number_of_post_to_enlarge > 1) {

					if ( ($wp_query->post_count) > 8 ) {


						$positions_to_enlarge[] = 1;
						$positions_to_enlarge[] = 5;

					} else {

						if (($wp_query->post_count) <= 5) {

							$positions_to_enlarge[] = 1;
							$positions_to_enlarge[] = 4;

						} else {

							$positions_to_enlarge[] = 1;
							$positions_to_enlarge[] = 7;

						}


					}

				} else {

					if ( ($wp_query->post_count) > 8 ) {

						$positions_to_enlarge[] = 4;


					} else {

						$positions_to_enlarge[] = 1;

					}

				}







			}



			?>
			<?php

			$posts_count = count($posts);



			foreach ($posts as $post) {

				the_post();

				if (!$n && $paged < 2 ) {

					get_template_part('elements', 'bigcard'); // post in BIG square

				} else {

					$enlarge = false;
					if (isset($positions_to_enlarge)) if( in_array($n, $positions_to_enlarge)) $enlarge = true;

					get_template_part('elements', 'card'); // post in square

				}

				$n += 1;

			}?>












		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</div><!-- #main -->
	</div><!-- #primary -->




			<?php if (get_next_posts_link() || get_previous_posts_link()) {?>


			<div class="frontpage-navigation" style="display:none">

							<?php if (get_next_posts_link()) {?>
							<a class="arrow ajaxlink arrow-right" href="<?php $npl=explode('"',get_next_posts_link()); echo $npl_url=$npl[1]; ;?>">
								<i>&#xe823;</i>
							</a>
							<?php } ?>

							<?php if (get_previous_posts_link()) {?>
							<a class="arrow ajaxlink arrow-left" href="<?php $npl=explode('"',get_previous_posts_link()); echo $npl_url=$npl[1]; ;?>">
								<i>&#xe822;</i>
							</a>
							<?php } ?>

			</div>

			<?php } ?>


<div id="load-more"></div>



<script>

	jQuery(function() {

		jQuery('#main').infinitescroll({
            loading: {
		        //finished: undefined,
		        finishedMsg: "<em><i>&#xe935;</i> <?php _e('No more articles', THEME_TEXTDOMAIN);?></em>",
		        img: "data:image/gif;base64,R0lGODlhAQABAHAAACH5BAUAAAAALAAAAAABAAEAAAICRAEAOw==",
		        msg: null,
		        msgText: "<em><i>&#xe93b;</i> <?php _e('Loading more articles ...', THEME_TEXTDOMAIN);?></em>",
		        selector: '#load-more',
		        speed: 'normal',
		        //start: undefined
		    },
		    state: {
		        isDuringAjax: false,
		        isInvalidPage: false,
		        isDestroyed: false,
		        isDone: false, // For when it goes all the way through the archive.
		        isPaused: false,
		        currPage: 1
		    },
		    debug: false,
		    //behavior: undefined,
		    binder: jQuery(window), // used to cache the selector for the element that will be scrolling
		    nextSelector: ".frontpage-navigation a.arrow-right",
		    navSelector: ".frontpage-navigation",

		    extraScrollPx: 150,
		    itemSelector: ".article-card",
		    animate: false,
		    pathParse: undefined,
		    dataType: 'html',
		    appendCallback: true,
		    bufferPx: 140,
		    errorCallback: function () { },

		    //pixelsFromNavToBottom: undefined,
		    //path: undefined, // Can either be an array of URL parts (e.g. ["/page/", "/"]) or a function that accepts the page number and returns a URL
		    prefill: true, // When the document is smaller than the window, load data until the document is larger or links are exhausted
		    //maxPage:undefined // to manually control maximum page (when maxPage is undefined, maximum page limitation is not work)

        });

	});

</script>


<?php if ( function_exists('KTT_ajax_show_footer') ) {  KTT_ajax_show_footer(); } else { get_footer(); };; ?>
