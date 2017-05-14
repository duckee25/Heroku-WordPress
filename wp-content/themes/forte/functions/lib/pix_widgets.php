<?php

function pix_widgets_init() {
	global $woocommerce_en;

	if ( $woocommerce_en == 'active') {
		register_sidebar( array(
			'name' => __( 'Filter by price' ),
			'id' => 'filter_price_sidebar',
			'description' => 'This sidebar is built for the &quot;WooCommerce Price Filter&quot; widget only',
			'before_widget' => '<div id="%1$s" class="pix_widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6>',
			'after_title' => '</h6>',
		) );
	
		register_sidebar( array(
			'name' => __( 'Woocommerce default sidebar' ),
			'id' => 'woocommerce_default_sidebar',
			'description' => 'A default sidebar for WooCommerce plugin',
			'before_widget' => '<div id="%1$s" class="pix_widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6>',
			'after_title' => '</h6>',
		) );
	
	}

	register_sidebar( array(
		'name' => __( 'Forte default sidebar' ),
		'id' => 'forte_default_sidebar',
		'description' => 'A default sidebar for Forte pages and posts',
		'before_widget' => '<div id="%1$s" class="pix_widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	) );

	unregister_sidebar('sidebar-1');

}
add_action( 'widgets_init', 'pix_widgets_init' );

/*=========================================================================================*/

function pix_default_widgets() {
	global $woocommerce_en;
	$sidebars = get_option( 'sidebars_widgets' );
	
	if ( empty ( $sidebars['forte_default_sidebar'] ) && isset( $_GET['activated'] ) ) {
		$widget_text =  get_option ( 'widget_text' );
		$widget_text[2] = array( 'title' => __( 'Default sidebar', 'forte' ),  'text' => __( 'This is the default sidebar. You can create other sidebars and add to them widgets. Play with them or read the documentation about them', 'forte' ) );
		update_option( 'widget_text', $widget_text );
		$forte_default_sidebar =  array('text-2');
	} else {
		$forte_default_sidebar = $sidebars['forte_default_sidebar'];
	}
	

	if ( $woocommerce_en == 'active' ) {
		if ( version_compare( WOOCOMMERCE_VERSION, '2.1', '>=' ) ) {
			if ( empty ( $sidebars['filter_price_sidebar'] ) || count($sidebars['filter_price_sidebar'])>1 || $sidebars['filter_price_sidebar'][0]!='woocommerce_price_filter-2' ) {
				$widget_price_filter =  get_option ( 'widget_woocommerce_price_filter' );
				$widget_price_filter[2] = array( 'title' => 'Filter:' );
				update_option( 'widget_woocommerce_price_filter', $widget_price_filter );
				$filter_price_sidebar =  array('woocommerce_price_filter-2');
			} else {
				$filter_price_sidebar = $sidebars['filter_price_sidebar'];
			}
		} elseif ( version_compare( WOOCOMMERCE_VERSION, '2.0.1000', '>=' ) && version_compare( WOOCOMMERCE_VERSION, '2.1', '<' ) ) {
			if ( empty ( $sidebars['filter_price_sidebar'] ) || count($sidebars['filter_price_sidebar'])>1 || $sidebars['filter_price_sidebar'][0]!='woocommerce_price_filter-2' ) {
				$widget_price_filter =  get_option ( 'woocommerce_price_filter' );
				$widget_price_filter[2] = array( 'title' => 'Filter:' );
				update_option( 'woocommerce_price_filter', $widget_price_filter );
				$filter_price_sidebar =  array('woocommerce_price_filter-2');
			} else {
				$filter_price_sidebar = $sidebars['filter_price_sidebar'];
			}
		} else {	
			if ( empty ( $sidebars['filter_price_sidebar'] ) || count($sidebars['filter_price_sidebar'])>1 || $sidebars['filter_price_sidebar'][0]!='price_filter-2' ) {
				$widget_price_filter =  get_option ( 'widget_price_filter' );
				$widget_price_filter[2] = array( 'title' => 'Filter:' );
				update_option( 'widget_price_filter', $widget_price_filter );
				$filter_price_sidebar =  array('price_filter-2');
			} else {
				$filter_price_sidebar = $sidebars['filter_price_sidebar'];
			}
		}
	
		if ( empty ( $sidebars['woocommerce_default_sidebar'] ) ) {
			$widget_recently_viewed_products =  get_option ( 'widget_recently_viewed_products' );
			$widget_recently_viewed_products[2] = array( 'title' => 'Recently viewed', 'number' => 5 );
			update_option( 'widget_recently_viewed_products', $widget_recently_viewed_products );
			
			$widget_product_categories =  get_option ( 'widget_product_categories' );
			$widget_product_categories[2] = array( 'title' => 'Our products', 'number' => 5 );
			update_option( 'widget_product_categories', $widget_product_categories );
			$woocommerce_default_sidebar = array('recently_viewed_products-2', 'product_categories-2');
		} else {
			$woocommerce_default_sidebar = $sidebars['woocommerce_default_sidebar'];
		}

		$sidebars['filter_price_sidebar'] = $filter_price_sidebar;
		$sidebars['woocommerce_default_sidebar'] = $woocommerce_default_sidebar;
	}
	$sidebars['forte_default_sidebar'] = $forte_default_sidebar;
	update_option( 'sidebars_widgets',$sidebars);
}
add_action( 'after_setup_theme', 'pix_default_widgets' );
add_action( 'woocommerce_init', 'pix_default_widgets' );

/*=========================================================================================*/

class pixRecentPosts extends WP_Widget
{
    function pixRecentPosts(){
    $widget_ops = array('class' => 'pix-sliding-news', 'description' => __( "Recent posts with thumbnail and control on the excerpt length") );
    parent::__construct('pixRecentPosts', __('Pixedelic Recent Posts'), $widget_ops, 200);
    }

    function widget($args, $instance){
      extract($args);
	$title = $instance['title'];
	$posts = $instance['posts'];
	$thumbnail = $instance['thumbnail'];
	$category = $instance['category'];
	$excerpt = $instance['excerpt'];

      echo $before_widget;

      if ( $title )
      echo $before_title . $title . $after_title .'';

	$args=array(
	  'cat' => $category,
	  'post_type' => 'post',
	  'post_status' => 'publish',
	  'posts_per_page' => $posts
	);
	
	$my_query = new WP_Query($args); ?>
  	<?php
 	if ($my_query->have_posts()) :
	$count_posts = $my_query->post_count; ?>
		<?php $i = 1; while ($my_query->have_posts()) : $my_query->the_post();
	$the_title = get_the_title();
		 ?>
                                <div class="entry-widget">
                                <p>
                                	<a class="letmebe" href="<?php echo get_permalink(); ?>">
                                <?php
                                    if(has_post_thumbnail() && $thumbnail==true) { ?>
                                            <span class="post_thumbnail alignleft"><?php the_post_thumbnail('mini_th'); ?></span>
                                    <?php }
                                    echo $the_title .'</a></p>';
                                    echo '<span class="entry-content">'.pix_the_excerpt($lenght=$excerpt).'</span>';
                                    ?>
                                </div><!-- .entry-widget -->
        	<?php $i++; endwhile; remove_filter('excerpt_length', 'excerpt_recent_posts'); ?>
  	<?php endif; ?>
    <?php wp_reset_query(); ?>

     <?php
		echo $after_widget . '';
  }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['posts'] = strip_tags(stripslashes($new_instance['posts']));
      $instance['thumbnail'] = isset($new_instance['thumbnail']);
      $instance['category'] = strip_tags(stripslashes($new_instance['category']));
      $instance['excerpt'] = strip_tags(stripslashes($new_instance['excerpt']));

    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=>'News', 'posts'=>'5', 'thumbnail'=>true, 'category'=>'0', 'excerpt'=>'20') );

      $title = htmlspecialchars($instance['title']);
      $posts = htmlspecialchars($instance['posts']);
      $thumbnail = isset($new_instance['thumbnail']);
      $category = htmlspecialchars($instance['category']);
      $excerpt = htmlspecialchars($instance['excerpt']);

		echo '<p><label for="' . $this->get_field_name('title') . '">Title <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '"></label></p>';
		
		echo '<p><label for="' . $this->get_field_name('category') . '">Include categories</label><input class="widefat" id="' . $this->get_field_name('category') . '" name="' . $this->get_field_name('category') . '" type="text" value="'.$category.'"></p>';

		?>
       <p><label for="<?php echo $this->get_field_name('thumbnail'); ?>">Show featured image</label>&nbsp;
		<input id="<?php echo $this->get_field_id('thumbnail'); ?>" name="<?php echo $this->get_field_name('thumbnail'); ?>" type="checkbox" <?php checked(isset($instance['thumbnail']) ? $instance['thumbnail'] : 0); ?>>
   		 </p>

		<?php echo '<p><label for="' . $this->get_field_name('excerpt') . '">How many words to display in the excerpt</label><input class="widefat" id="' . $this->get_field_name('excerpt') . '" name="' . $this->get_field_name('excerpt') . '" type="text" value="'.$excerpt.'"></p>';

		echo '<p><label for="' . $this->get_field_name('posts') . '">Amount of news</label><input class="widefat" id="' . $this->get_field_name('posts') . '" name="' . $this->get_field_name('posts') . '" type="text" value="'.$posts.'"></p>';
		
  }

}

  function pixPostsInit() {
  register_widget('pixRecentPosts');
  }
  add_action('widgets_init', 'pixPostsInit');



function get_flickr_images( $id = "", $number = 5, $key = "") {
	require_once(get_template_directory()."/scripts/phpFlickr.php");
	$phpFlickrObj = new phpFlickr($key);
	$user_url = $phpFlickrObj->urls_getUserPhotos($id);
	$photos = $phpFlickrObj->people_getPublicPhotos($id, NULL, NULL, $number);
	return $photos['photos']['photo'];
}

/*=========================================================================================*/

class pixThumbGallery extends WP_Widget
{
	function pixThumbGallery(){
    $widget_ops = array('class' => 'pix-thumb-gallery', 'description' => __( "Create a thumb-gallery from your posts") );
    parent::__construct('pixThumbGallery', __('Pixedelic Thumb Gallery'), $widget_ops, 200);
    }

    function widget($args, $instance){
      extract($args);
	$title = $instance['title'];
	$posts = $instance['posts'];
	$category = $instance['category'];
	$gallery = $instance['gallery'];
	$click = $instance['click'];
	$source = $instance['source'];
	$flickrid = $instance['flickrid'];
	$key = $instance['key'];
	
	
      echo $before_widget;

      if ( $title )
      echo $before_title . $title . $after_title;

	  if ($source == 'posts') { query_posts('cat='.$category.'&posts_per_page='.$posts); ?>
 	<div class="pix_thumbs">
	<?php if (have_posts()) : ?>
		<?php $i=1; while (have_posts()) : the_post();
	if(has_post_thumbnail()) {
		$attachment_id = get_post_thumbnail_id($post->ID);
		$image_id = get_post_thumbnail_id();  
		$image_url = wp_get_attachment_image_src($image_id,'mid_th');  
		$image_url = $image_url[0]; 
		$image_full = wp_get_attachment_image_src($image_id,'full');  
		$image_full = $image_full[0]; 
	?>
        <a href="<?php if($click == 'colorbox') { echo $image_full; } else { the_permalink(); } ?>" data-rel="thumbgallery"><img src="<?php echo $image_url; ?>" alt="<?php echo the_title_attribute(); ?>"></a>
<?php $i++; }  ?>
		<?php endwhile; ?>
    </div><!-- .pix_thumbs -->
 	<?php endif; ?>
    <?php wp_reset_query(); 
	
	  } elseif ($source == 'galleries') {
		  if($gallery=='all') {
			  $gallery='';
		  }
		  
		$args=array(
			'gallery'	=> $gallery,
			'post_type' => 'portfolio',
			'posts_per_page' => $posts
	);
	$my_query = null;
	$my_query = new WP_Query($args);  ?>

 	<div class="pix_thumbs">
		<?php $i=1; 
	while ( $my_query->have_posts() ) : $my_query->the_post();
	if(has_post_thumbnail()) {
		$attachment_id = get_post_thumbnail_id($post->ID);
		$image_id = get_post_thumbnail_id();  
		$image_url = wp_get_attachment_image_src($image_id,'mid_th');  
		$image_url = $image_url[0]; 
		$image_full = wp_get_attachment_image_src($image_id,'full');  
		$image_full = $image_full[0]; 
	?>
        <a href="<?php if($click == 'colorbox') { echo $image_full; } else { the_permalink(); } ?>" data-rel="thumbgallery"><img src="<?php echo $image_url; ?>" alt="<?php echo the_title_attribute(); ?>"></a>
<?php $i++; }  ?>


<?php	endwhile; ?>
    </div><!-- .pix_thumbs -->
<?php	wp_reset_query();
	?>
      
      
      
      
	  <?php } else { ?>

    <div class="pix_thumbs pix_flickr">
<?php 

$images = get_flickr_images($flickrid,$posts,$key);
$i=1;
require_once(get_template_directory()."/scripts/phpFlickr.php");
$phpFlickrObj = new phpFlickr($key);
$user_url = $phpFlickrObj->urls_getUserPhotos($flickrid);
foreach( $images as $image ) { ?>
        <a href="<?php if($click == 'colorbox') { echo $phpFlickrObj->buildPhotoURL($image, "large"); } else { echo 'http://www.flickr.com/photos/'.$flickrid.'/'.$image['id'].'/in/photostream'; } ?>" data-rel="thumbgallery"<?php if($i % 3 === 0) { ?> class="marginZero"<?php } ?><?php if($click == 'topost') { echo ' target="_blank"'; } ?>><img src="<?php echo $phpFlickrObj->buildPhotoURL($image, 'large_square'); ?>" alt="<?php echo $image['title']; ?>"></a>
<?php $i++; }  ?>

    </div><!-- .pix_thumbs -->


    <?php }

		echo $after_widget;
  }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['posts'] = strip_tags(stripslashes($new_instance['posts']));
      $instance['category'] = strip_tags(stripslashes($new_instance['category']));
      $instance['gallery'] = strip_tags(stripslashes($new_instance['gallery']));
      $instance['click'] = strip_tags(stripslashes($new_instance['click']));
      $instance['source'] = strip_tags(stripslashes($new_instance['source']));
      $instance['flickrid'] = strip_tags(stripslashes($new_instance['flickrid']));
      $instance['key'] = strip_tags(stripslashes($new_instance['key']));

    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=>'Gallery', 'posts'=>'8', 'category'=>'0', 'gallery'=>'0', 'click'=>'c', 'source'=>'posts', 'source'=>'flickr', 'flickrid'=>'Your Flickr ID', 'key'=>'Flickr API key') );

      $title = htmlspecialchars($instance['title']);
      $posts = htmlspecialchars($instance['posts']);
      $category = htmlspecialchars($instance['category']);
      $gallery = htmlspecialchars($instance['gallery']);
      $click = htmlspecialchars($instance['click']);
      $source = htmlspecialchars($instance['source']);
      $flickrid = htmlspecialchars($instance['flickrid']);
      $key = htmlspecialchars($instance['key']);
	  
	  	echo '<span class="pix_gallery_widget_wrap">';

		echo '<p><label for="' . $this->get_field_name('title') . '">Title <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '"></label></p>';
		
		?>
		<p>
			<label for="<?php echo $this->get_field_name('source'); ?>"> Choose the source for the thumbnails</label>
            	<select id="<?php echo $this->get_field_name('source'); ?>" name="<?php echo $this->get_field_name('source'); ?>" class="widefat toggler">
                	<option value="posts"<?php selected( $instance['source'], 'posts' ); ?>>Posts</option>
                	<option value="galleries"<?php selected( $instance['source'], 'galleries' ); ?>>Galleries</option>
                    <option value="flickr"<?php selected( $instance['source'], 'flickr' ); ?>>Flickr</option>
                </select>
		</p>

       <span data-select="posts" style="display:none">
           <p class="<?php echo $this->get_field_name('source'); ?> toggle" data-type="posts"><label for="<?php echo $this->get_field_name('category'); ?>">Category <small>(if you previously selected posts)</small></label>     
            <?php wp_dropdown_categories(array('selected' => $category, 'name' => $this->get_field_name('category'), 'show_option_all'=>'All', 'class'=>'widefat', 'sort_column'=> 'menu_order, post_title'));?>
             </p>
        </span>
    
       <span data-select="galleries" style="display:none">
           <p class="<?php echo $this->get_field_name('source'); ?> toggle" data-type="galleries"><label for="<?php echo $this->get_field_name('gallery'); ?>">Gallery <small>(if you selected galleries)</small></label>     
            <?php 
                $terms = get_terms("gallery");
                $count = count($terms);
                if($count > 0){
                    echo '<select id="'.$this->get_field_name('gallery').'" name="'.$this->get_field_name('gallery').'" class="widefat">';
                    echo '<option value="all"'. selected( $instance['gallery'], 'all' ) .'>All</option>';
                    foreach ($terms as $term) {
                        echo '<option value="'.$term->slug.'"'. selected( $instance['gallery'], $term->slug ) .'>'.$term->name.'</option>';
                    }
                    echo "</select>";
                }
            ?>
             </p>
        </span>

       <span data-select="flickr" style="display:none">
		<?php echo '<p class="'.$this->get_field_name('source').' toggle" data-type="flickr"><label for="' . $this->get_field_name('flickrid') . '">Flickr ID <small>(if you previously selected Flickr)</small></label><input class="widefat" id="' . $this->get_field_name('flickrid') . '" name="' . $this->get_field_name('flickrid') . '" type="text" value="'.$flickrid.'"></p>'; ?>

		<?php echo '<p class="'.$this->get_field_name('source').' toggle" data-type="flickr"><label for="' . $this->get_field_name('key') . '">Flickr API key <small>(if you previously selected Flickr: <a href="http://www.flickr.com/services/apps/create/apply" target="_blank">where to get it</a>)</small></label><input class="widefat" id="' . $this->get_field_name('key') . '" name="' . $this->get_field_name('key') . '" type="text" value="'.$key.'"></p>'; ?>
        </span>

		<p>
			<label for="<?php echo $this->get_field_name('click'); ?>"> Choose the thumbnails links</label>
            	<select id="<?php echo $this->get_field_name('click'); ?>" name="<?php echo $this->get_field_name('click'); ?>" class="widefat">
                	<option value="colorbox"<?php selected( $instance['click'], 'colorbox' ); ?>>Open with Colorbox</option>
                    <option value="topost"<?php selected( $instance['click'], 'topost' ); ?>>Go to the post or page</option>
                </select>
		</p>

		<?php echo '<p><label for="' . $this->get_field_name('posts') . '">Amount of thumbs</label><input class="widefat" id="' . $this->get_field_name('posts') . '" name="' . $this->get_field_name('posts') . '" type="text" value="'.$posts.'"></p>';
		

	  	echo '</span>'; //.pix_gallery_widget_wrap

  }

}

  function pixThumbInit() {
  register_widget('pixThumbGallery');
  }
  add_action('widgets_init', 'pixThumbInit');

/*=========================================================================================*/

function pix_recent_comments($amount) {
  $pre_HTML ="";
  $post_HTML ="";
  global $wpdb;
  $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,  comment_author_email, comment_content FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT ".$amount;

  $comments = $wpdb->get_results($sql);
  $output = $pre_HTML;
  $i = 1;
  $count = count($comments);
  foreach ($comments as $comment) {
	$comment_text = strip_tags($comment->comment_content);
	$blah = explode(' ', $comment_text);
	if (count($blah) > 15) {
		$k = 15;
		$use_dotdotdot = 1;
	} else {
		$k = count($blah);
		$use_dotdotdot = 0;
	}
	$excerpt = '';
	for ($i=0; $i<$k; $i++) {
		$excerpt .= $blah[$i] . ' ';
	}
	$excerpt .= ($use_dotdotdot) ? '&hellip;' : '';
	$output .= '<div class="comment">';
	$output .= '<span class="vcard alignleft">';
	$output .= get_avatar( $comment->comment_author_email, $size = '45' );
	$output .= '</span><!-- .vcard -->';
	$output .= strip_tags($comment->comment_author) . __(' on','forte').' <a href="' . get_permalink($comment->ID).'#comment-' . $comment->comment_ID . '" title="'. __('on','forte').' '.$comment->post_title . '" class="side_comments_post_title">'.get_the_title($comment->ID).'</a><br>';
	$output .= '<span class="comment_text">&ldquo;'.$excerpt.'&rdquo;</span><!-- .commenttext -->';
	$output .= '</div><!-- .comment -->';
	$i++;
 }
  $output .= $post_HTML;
  echo $output;
}


class pixRecentComments extends WP_Widget
{
    function pixRecentComments(){
    $widget_ops = array('classname' => 'pix-recent-comments', 'description' => __( "Add a fading slide show for recent comments") );
    parent::__construct('pixRecentComments', __('Pixedelic Recent Comments'), $widget_ops, 200);
    }

    function widget($args, $instance){
      extract($args);
	$title = $instance['title'];
	$posts = $instance['posts'];

      echo $before_widget;

      if ( $title )
      echo $before_title . $title . $after_title. '<div class="pix_side_comments">' ;

        ?>
							<?php pix_recent_comments($posts); ?>

      <?php
		echo '</div><!-- pix_side_comments -->'.$after_widget;
  }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['posts'] = strip_tags(stripslashes($new_instance['posts']));

    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=>'Comments', 'posts'=>'10') );

      $title = htmlspecialchars($instance['title']);
      $posts = htmlspecialchars($instance['posts']);

		echo '<p><label for="' . $this->get_field_name('title') . '">Title <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '"></label></p>';
		
		?>

		<?php echo '<p><label for="' . $this->get_field_name('posts') . '">Amount of comments</label><input class="widefat" id="' . $this->get_field_name('posts') . '" name="' . $this->get_field_name('posts') . '" type="text" value="'.$posts.'"></p>';

  }

}

  function pixSlidCommentInit() {
  register_widget('pixRecentComments');
  }
  add_action('widgets_init', 'pixSlidCommentInit');
  
/*=========================================================================================*/
  
function unregister_them() {
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WC_Widget_Product_Search' );
	unregister_widget( 'WooCommerce_Widget_Login' );
}
add_action('widgets_init','unregister_them',10);


/*=========================================================================================*/


class pixContactForm extends WP_Widget
{
	function pixContactForm(){
    $widget_ops = array('class' => 'pix-contact-form', 'description' => __( "Select a form") );
    parent::__construct('pixContactForm', __('Pixedelic Contact Forms'), $widget_ops, 200);
	remove_action('wp_enqueue_scripts', 'remove_datePicker2');
	}


	
    function widget($args, $instance){
      extract($args);
	$title = $instance['title'];
	$form = $instance['form'];
	global $print_datepicker;	
     echo $before_widget;

      if ( $title )
      echo $before_title . $title . $after_title; ?>
      
                <?php echo do_shortcode('[pix_contact_form data_form="'.$form.'"]'); ?>

    <?php

		echo $after_widget;
  }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['form'] = strip_tags(stripslashes($new_instance['form']));

    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=> __('Contact us','forte'), 'form'=>'') );

      $title = htmlspecialchars($instance['title']);
      $form = htmlspecialchars($instance['form']);

		echo '<p><label for="' . $this->get_field_name('title') . '">Title <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '"></label></p>';
		
		?>
		<p>
			<label for="<?php echo $this->get_field_name('form'); ?>">Select a form</label>
            	<select id="<?php echo $this->get_field_name('form'); ?>" name="<?php echo $this->get_field_name('form'); ?>" class="widefat">
					<?php
                    $get_contact_form_options = pix_get_option('pix_array_your_forms_');
                    if($get_contact_form_options != "") {
                    $i=1;
                    foreach ($get_contact_form_options as $contact_form_gen) { ?>
                        <option value="<?php echo $contact_form_gen;; ?>"<?php selected( $instance['form'], $contact_form_gen ); ?>><?php echo $contact_form_gen; ?></option>
					<?php $i++; } 
                    }
                    ?>
                </select>
		</p>
		<?php 

  }

}

  function pixContactInit() {
	register_widget('pixContactForm');
  }
  add_action('widgets_init', 'pixContactInit');

/*=========================================================================================*/

class pixTweets extends WP_Widget
{
    function pixTweets(){
		$widget_ops = array('class' => 'pix-tweets-widget', 'description' => __( "Display your recent tweets") );
		parent::__construct('pixTweets', __('Pixedelic Tweets'), $widget_ops, 200);
    }

    function widget($args, $instance){
		extract($args);
		$title = $instance['title'];
		$user = $instance['user'];
		$replies = $instance['replies'];
		$avatar = $instance['avatar'];
		$blacklist = $instance['blacklist'];
		$whitelist = $instance['whitelist'];
		$amount = $instance['amount'];

		echo $before_widget;

		if ( $title )
		echo $before_title . $title . $after_title .'<div class="pix_tweet_list"><a href="https://twitter.com/#!/'.$user.'" class="pix_widget_follow_link" target="_blank">'.__('Follow','forte').'</a>';

	
		$pix_tweets = array();
		$tweet_key = 0;
				
		$blacklist = str_replace(',','|',$blacklist);
		
		$whitelist = str_replace(',','|',$whitelist);
		
		$tweets = json_decode(pix_cache_tweets($user=$user,$count='1000')); // get tweets and decode them into a variable
		
		if(count($tweets)!=0){
			foreach ($tweets as $value) {
				
				$matchRep = ( ($replies != true && substr($value->text,0,1) != '@') || $replies == true ) ? true : false;
		
				$nomatch = $blacklist != '' ? preg_match ( '/(' . $blacklist . ')/i',  $value->text ) : false;
		
				$match = $whitelist != '' ? preg_match ( '/(' . $whitelist . ')/i',  $value->text ) : true;
				
				if (  $matchRep && !$nomatch && $match) {
					$pix_tweet = '<a href="https://twitter.com/#!/'.$value->user->screen_name.'" target="_blank" class="letmebe">';
					if ( $avatar == true ) {
						$pix_tweet .= '<img class="alignleft" alt="" src="'.($value->user->profile_image_url_https).'">';
					}
					$pix_tweet .= '<span class="screen_name">'.($value->user->screen_name).'</span></a><br>
					<span class="name">'.($value->user->name).'</span><br><span class="tweet_text">'.pix_url_2_link($value->text).'</span><br><small><a href="http://twitter.com/pixedelic/statuses/'.$value->id_str.'" target="_blank">'.pix_compare_dates($value->created_at).' &rarr;</a></small>';
					array_push($pix_tweets, $pix_tweet);
					
					if ($tweet_key == 0) {
						$pix_tweets_0 = $value->created_at;
					}
					
					$tweet_key++;
				}
			}
		}

		$i=0;
		if(count($pix_tweets)==0){
			echo '<p>'.__('Sorry, no tweets available,<br>maybe because of the amount of requests<br>or maybe because Twitter is down...','forte').'</p>';
		} else {
			while($i<=($amount-1)){
				if($i<count($pix_tweets)){
					echo '<div class="pix_row tweets">'.$pix_tweets[$i].'</div>';
				}
				$i++;
			}
		}
		echo '</div>' . $after_widget;
  }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['user'] = strip_tags(stripslashes($new_instance['user']));
      $instance['replies'] = isset($new_instance['replies']);
      $instance['avatar'] = isset($new_instance['avatar']);
      $instance['blacklist'] = strip_tags(stripslashes($new_instance['blacklist']));
      $instance['whitelist'] = strip_tags(stripslashes($new_instance['whitelist']));
      $instance['amount'] = strip_tags(stripslashes($new_instance['amount']));

    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=>'Tweets', 'replies'=>true, 'amount'=>'5', 'user'=>'', 'avatar'=>true, 'blacklist'=>'', 'whitelist'=>'') );

      $title = htmlspecialchars($instance['title']);
      $user = htmlspecialchars($instance['user']);
      $replies = isset($new_instance['replies']);
      $avatar = htmlspecialchars($instance['avatar']);
      $blacklist = htmlspecialchars($instance['blacklist']);
      $whitelist = htmlspecialchars($instance['whitelist']);
      $amount = htmlspecialchars($instance['amount']);

		echo '<p><label for="' . $this->get_field_name('title') . '">Title <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '"></label></p>';
		
		echo '<p><label for="' . $this->get_field_name('user') . '">Your Twitter username</label><input class="widefat" id="' . $this->get_field_name('user') . '" name="' . $this->get_field_name('user') . '" type="text" value="'.$user.'"></p>';

		?>
       <p><label for="<?php echo $this->get_field_name('replies'); ?>">Show replies</label>&nbsp;
		<input id="<?php echo $this->get_field_id('replies'); ?>" name="<?php echo $this->get_field_name('replies'); ?>" type="checkbox" <?php checked(isset($instance['replies']) ? $instance['replies'] : 0); ?>>
   		 </p>

       <p><label for="<?php echo $this->get_field_name('avatar'); ?>">Dispaly avatars</label>&nbsp;
		<input id="<?php echo $this->get_field_id('avatar'); ?>" name="<?php echo $this->get_field_name('avatar'); ?>" type="checkbox" <?php checked(isset($instance['avatar']) ? $instance['avatar'] : 0); ?>>
   		 </p>

		<?php echo '<p><label for="' . $this->get_field_name('blacklist') . '">Hide tweets that contain these words (separate them with commas)</label><input class="widefat" id="' . $this->get_field_name('blacklist') . '" name="' . $this->get_field_name('blacklist') . '" type="text" value="'.$blacklist.'"></p>';
		
		 echo '<p><label for="' . $this->get_field_name('whitelist') . '">Display only tweets that contain these words (separate them with commas)</label><input class="widefat" id="' . $this->get_field_name('whitelist') . '" name="' . $this->get_field_name('whitelist') . '" type="text" value="'.$whitelist.'"></p>';		
		
		 echo '<p><label for="' . $this->get_field_name('amount') . '">How many tweets to display</label><input class="widefat" id="' . $this->get_field_name('amount') . '" name="' . $this->get_field_name('amount') . '" type="text" value="'.$amount.'"></p>';		
  }

}

  function pixTweetsInit() {
  register_widget('pixTweets');
  }
  add_action('widgets_init', 'pixTweetsInit');



/*=========================================================================================*/

class pixAdvancedSearch extends WP_Widget
{
    function pixAdvancedSearch(){
		$widget_ops = array('class' => 'pix-advanced-search-widget', 'description' => __( "Search among...") );
		parent::__construct('pixAdvancedSearch', __('Advanced search'), $widget_ops, 200);
    }

    function widget($args, $instance){
		extract($args);
		$title = $instance['title'];
		$post_type = $instance['post_type'];
		$added_type = $instance['added_type'] != '' ? ','.$instance['added_type'] : '';
		$user_select = $instance['user_select'];

		echo $before_widget;

		echo $before_title;
		if ( $title ) {
			echo $title;
		}
		echo $after_title; 

		echo '<form role="search" method="get" id="pix_search_advanced" action="' . ( home_url( '/' ) ) . '" >
			<input type="text" name="s" id="s" placeholder="'.__('Search...','forte').'">
			<button type="submit">
                <i class="icon-search"></i>
            </button>';

        if ( $user_select=='selected' ) {
        	echo '<a href="#" class="advanced_toggle alignright">'.__( 'advanced','forte' ).'</a>';
        	echo '<div class="advanced_search_options">';
        	$post_type_selected = $post_type.$added_type;
        	$post_type_selected = explode(',',$post_type_selected);
        	if ( isset($_GET['post_type']) && $_GET['post_type']!='' ) {
        		$post_type_checked = explode(',',$_GET['post_type']);
        	} else {
        		$post_type_checked = $post_type_selected;
        	}
        	foreach ($post_type_selected as $key => $value) {
        		$name = get_post_type_object($value);
        		$checked = in_array($value,$post_type_checked) ? 'checked' : '';
        		echo '<label><input type="checkbox" value="'.$value.'" '.$checked.'><span></span>'.$name->labels->singular_name.'</label>';
        	}
        	echo '</div>';
        } else if ( $user_select=='all' ) {
        	echo '<a href="#" class="advanced_toggle alignright">'.__( 'advanced','forte' ).'</a>';
        	echo '<div class="advanced_search_options">';
        	$post_type_selected = 'post,page,portfolio,product'.$added_type;
        	$post_type_selected = explode(',',$post_type_selected);
        	if ( isset($_GET['post_type']) && $_GET['post_type']!='' ) {
        		$post_type_checked = explode(',',$_GET['post_type']);
        	} else {
        		$post_type_checked = explode(',',$post_type.$added_type);
        	}
        	foreach ($post_type_selected as $key => $value) {
        		$name = get_post_type_object($value);
        		$checked = in_array($value,$post_type_checked) ? 'checked' : '';
        		echo '<label><input type="checkbox" value="'.$value.'" '.$checked.'><span></span>'.$name->labels->singular_name.'</label>';
        	}
        	echo '</div>';
        }
		echo '<input type="hidden" name="post_type" value="'.$post_type.$added_type.'">';

		if ( defined('ICL_LANGUAGE_CODE') )
			echo '<input type="hidden" name="lang" value="' . ICL_LANGUAGE_CODE . '"/>';
         
		echo '</form>';

		echo $after_widget;
  }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['post_type'] = implode(',',$new_instance['post_type']);
      $instance['added_type'] = strip_tags(stripslashes($new_instance['added_type']));
      $instance['user_select'] = strip_tags(stripslashes($new_instance['user_select']));
    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=>'Search','post_type'=>'post,page,portfolio,product','added_type'=>'','user_select'=>'') );

      $title = htmlspecialchars($instance['title']);
      $post_type = explode(',',$instance['post_type']);
      $added_type = htmlspecialchars($instance['added_type']);
      $user_select = htmlspecialchars($instance['user_select']);

		echo '<p><label for="' . $this->get_field_name('title') . '">Title <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '"></label></p>'; ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('post_type'); ?>">Select the post types (hold down CTRL on Win or CMD on MAC to select multiple options)</label>
            	<select id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>[]" class="widefat" multiple>
                	<option value="post"<?php echo (in_array('post',$post_type)) ? 'selected' : ''; ?>>Posts</option>
                	<option value="page"<?php echo (in_array('page',$post_type)) ? 'selected' : ''; ?>>Pages</option>
                    <option value="portfolio"<?php echo (in_array('portfolio',$post_type)) ? 'selected' : ''; ?>>Portfolio items</option>
                    <option value="product"<?php echo (in_array('product',$post_type)) ? 'selected' : ''; ?>>Products</option>
                </select>
		</p>
	
		<?php	

		echo '<p><label for="' . $this->get_field_name('added_type') . '">Add other post types (comma separated, use the slugs)
		<input class="widefat" id="' . $this->get_field_id('added_type') . '" name="' . $this->get_field_name('added_type') . '" type="text" value="' . $added_type . '"></label></p>'; ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('user_select'); ?>">Let the user select</label>
            	<select id="<?php echo $this->get_field_id('user_select'); ?>" name="<?php echo $this->get_field_name('user_select'); ?>" class="widefat">
                	<option value=""<?php selected( $instance['user_select'], 'posts' ); ?>>Nothing</option>
                	<option value="selected"<?php selected( $instance['user_select'], 'selected' ); ?>>Among the post types you selected</option>
                	<option value="all"<?php selected( $instance['user_select'], 'all' ); ?>>Among all the post types</option>
                </select>
		</p>
	
		<?php	
		
  }

}

function pixAdvancedSearchInit() {
  register_widget('pixAdvancedSearch');
}
add_action('widgets_init', 'pixAdvancedSearchInit');


/*=========================================================================================*/

class pixLoginForm extends WP_Widget
{
    function pixLoginForm(){
		$widget_ops = array('class' => 'pix-login-form', 'description' => __( "Login form") );
		parent::__construct('pixLoginForm', __('Login form'), $widget_ops, 200);
    }

    function widget($args, $instance){
    	global $woocommerce_en;
		extract($args);
		$title = $instance['title'];

		echo $before_widget;

		echo $before_title;
		if ( $title ) {
			echo $title;
		}
		echo $after_title; 

		?>



<div id="login-register-password">

	<?php global $user_ID, $user_identity; get_currentuserinfo(); if (!$user_ID) { ?>

	<div class="pix_accordion">
		<a href="#tab1_login" class="header_accordion"><?php _e('Login','forte'); ?></a>
		<div id="tab1_login" class="tab_content_login"><div>

			<?php $register = $_GET['register']; $reset = $_GET['reset']; if ($register == true) { ?>

			<div class="pix_success pix_success_open_toggle"><p><?php _e('Success!','forte'); ?></p></div>
			<small><em><?php _e('Check your email for the password and then return to log in.','forte'); ?></em></small>

			<?php } elseif ($reset == true) { ?>

			<div class="pix_success pix_success_open_toggle"><p><?php _e('Success!','forte'); ?></p></div>
			<small><em><?php _e('Check your email to reset your password.','forte'); ?></em></small>

			<?php } ?>

			<form method="post" action="<?php echo wp_login_url(); ?>" class="wp-user-form">
				<div class="username">
					<label for="user_login"><?php _e('Username','forte'); ?>: </label>
					<input type="text" name="log" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="11">
				</div>
				<div class="password">
					<label for="user_pass"><?php _e('Password','forte'); ?>: </label>
					<input type="password" name="pwd" value="" size="20" id="user_pass" tabindex="12">
				</div>
				<div class="login_fields">
					<div class="rememberme alignright">
						<label for="rememberme">
							<input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13"> Remember me
						</label>
					</div>
					<?php do_action('login_form'); ?>
					<input type="submit" name="user-submit" value="<?php _e('Login','forte'); ?>" tabindex="14" class="user-submit second_color">
					<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
					<input type="hidden" name="user-cookie" value="1">
				</div>
			</form>
		</div></div>
		<?php if (get_option('users_can_register')) { ?>	
		<a href="#tab2_login" class="header_accordion"><?php _e('Register','forte'); ?></a>
		<div id="tab2_login" class="tab_content_login"><div>
			<form method="post" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" class="wp-user-form">
				<div class="username">
					<label for="user_login_reg"><?php _e('Username','forte'); ?>: </label>
					<input type="text" name="user_login" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login_reg" tabindex="101">
				</div>
				<div class="email">
					<label for="user_email"><?php _e('Your email','forte'); ?>: </label>
					<input type="text" name="user_email" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" id="user_email" tabindex="102">
				</div>
				<div class="login_fields">
					<?php do_action('register_form'); ?>
					<input type="submit" name="user-submit" value="<?php _e('Sign up','forte'); ?>" class="user-submit third_color" tabindex="103">
					<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?register=true">
					<input type="hidden" name="user-cookie" value="1">
				</div>
			</form>
		</div></div>
		<?php } ?>
		<a href="#tab3_login" class="header_accordion"><?php _e('Forgot?','forte'); ?></a>
		<div id="tab3_login" class="tab_content_login"><div>
			<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
				<div class="username_or_email">
					<label for="user_login_forgot" class="hide"><?php _e('Username or Email','forte'); ?>: </label>
					<input type="text" name="user_login" value="" size="20" id="user_login_forgot" tabindex="1001">
				</div>
				<div class="login_fields">
					<?php do_action('login_form', 'resetpass'); ?>
					<input type="submit" name="user-submit" value="<?php _e('Reset password','forte'); ?>" class="user-submit" tabindex="1002">
					<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true">
					<input type="hidden" name="user-cookie" value="1">
				</div>
			</form>
		</div></div>
	</div>

	<?php } else { // is logged in ?>

	<div class="sidebox">
		<div class="userinfo">
			<span class="usericon alignleft">
				<?php global $userdata; get_currentuserinfo(); echo get_avatar($userdata->ID, 32); ?>
			</span>
			<?php if ( $woocommerce_en == 'active' ) { ?>
				<p>
					<?php _e('Welcome','forte'); ?>
					<br>
					<strong><?php echo '<a href="' . get_permalink(woocommerce_get_page_id('myaccount')) . '">' . $user_identity . '</a>'; ?></strong>
				</p>
				<div class="clear"></div>
				<ul class="pagenav">
					<li>
						<?php echo '<a href="' . get_permalink(woocommerce_get_page_id('change_password')) . '">' . __('Change my password', 'forte') . '</a>'; ?>
					</li>
					<li>
						<a href="<?php echo wp_logout_url($_SERVER['REQUEST_URI']); ?>"><?php _e('Log out','forte'); ?></a>
					</li>
				<ul>
			<?php } else { ?>
			<p><?php _e('Welcome','forte'); ?> <strong><?php echo '<a href="' . admin_url() . 'profile.php">' . $user_identity . '</a>'; ?></strong>
				<br>
				<span class="edit-link"><a href="<?php echo wp_logout_url($_SERVER['REQUEST_URI']); ?>"><i class="icon-unlock"></i> <?php _e('Log out','forte'); ?></a></span>
			</p>
				<?php } ?>
		</div>
	</div>

	<?php } ?>

</div>



		<?php

		echo $after_widget;
  }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=>'') );

      $title = htmlspecialchars($instance['title']);

		echo '<p><label for="' . $this->get_field_name('title') . '">Title <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '"></label></p>'; ?>
		
		<?php	
		
  }

}

function pixLoginFormInit() {
  register_widget('pixLoginForm');
}
add_action('widgets_init', 'pixLoginFormInit');