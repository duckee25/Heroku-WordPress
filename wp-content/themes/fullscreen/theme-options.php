<?php
/**
 * Main Themify class
 * @package themify
 */
class Themify {
	
	/**
	 * Object that stores all theme special functions
	 */
	public $theme;
	/** Default sidebar layout
	 * @var string */
	public $layout;
	/** Default posts layout
	 * @var string */
	public $post_layout;
	
	public $hide_title;
	public $hide_meta;
	public $hide_date;
	public $hide_image;
	
	public $unlink_title;
	public $unlink_image;
	
	public $display_content = '';
	public $auto_featured_image;
	
	public $width = '';
	public $height = '';
	
	public $avatar_size = 96;
	public $page_navigation;
	public $posts_per_page;
	
	public $image_align = '';
	public $image_setting = '';
	
	public $page_id = '';
	public $page_image_width = 978;
	public $query_category = '';
	public $query_post_type = '';
	public $query_taxonomy = '';
	public $paged = '';

	// Sorting Parameters
	public $order = 'DESC';
	public $orderby = 'date';
	
	/////////////////////////////////////////////
	// Set Default Image Sizes 					
	/////////////////////////////////////////////
	
	// Default Index Layout
	static $content_width = 978;
	static $sidebar1_content_width = 745;
	static $sidebar2_content_width = 474;
	
	// Default Single Post Layout
	static $single_content_width = 978;
	static $single_sidebar1_content_width = 745;
	
	// Default Single Image Size
	static $single_image_width = 978;
	static $single_image_height = 500;
	
	// Grid4
	static $grid4_width = 222;
	static $grid4_height = 140;
	
	// Grid3
	static $grid3_width = 306;
	static $grid3_height = 190;
	
	// Grid2
	static $grid2_width = 474;
	static $grid2_height = 270;
	
	// List Large
	static $list_large_image_width = 580;
	static $list_large_image_height = 316;
	 
	// List Thumb
	static $list_thumb_image_width = 160;
	static $list_thumb_image_height = 100;
	
	// List Post
	static $list_post_width = 978;
	static $list_post_height = 400;
	
	// List Grid2 Thumb
	static $grid2_thumb_width = 110;
	static $grid2_thumb_height = 100;
        
        	// Single Portfolio
	static $single_portfolio_image_width = 978;
	static $single_portfolio_image_height = 500;

	function __construct() {
		
		///////////////////////////////////////////
		//Global options setup
		///////////////////////////////////////////
		$this->layout = themify_get('setting-default_layout');
		if($this->layout == '' ) $this->layout = 'sidebar1';
		
		$this->post_layout = themify_get( 'setting-default_post_layout', 'list-post' );
		
		$this->page_title = themify_get('setting-hide_page_title');
		$this->hide_title = themify_get('setting-default_post_title');
		$this->unlink_title = themify_get('setting-default_unlink_post_title');
		
		$this->hide_image = themify_get('setting-default_post_image');
		$this->unlink_image = themify_get('setting-default_unlink_post_image');
		$this->auto_featured_image = !themify_check('setting-auto_featured_image')? 'field_name=post_image, image, wp_thumb&' : '';
		$this->hide_page_image = themify_get( 'setting-hide_page_image' ) == 'yes' ? 'yes' : 'no';
		$this->image_page_single_width = themify_check( 'setting-page_featured_image_width' ) ? themify_get( 'setting-page_featured_image_width' ) : $this->page_image_width;
		$this->image_page_single_height = themify_check( 'setting-page_featured_image_height' ) ? themify_get( 'setting-page_featured_image_height' ) : 0;
		
		$this->hide_meta = themify_get('setting-default_post_meta');
		$this->hide_date = themify_get('setting-default_post_date');

		// Set Order & Order By parameters for post sorting
		$this->order = themify_check('setting-index_order')? themify_get('setting-index_order'): 'DESC';
		$this->orderby = themify_check('setting-index_orderby')? themify_get('setting-index_orderby'): 'date';
		
		$this->display_content = themify_get('setting-default_layout_display');
		$this->avatar_size = apply_filters('themify_author_box_avatar_size', 96);
		
		add_action('template_redirect', array(&$this, 'template_redirect'));
	}

	function template_redirect() {
		
		$post_image_width = $post_image_height = '';
		if (is_page()) {
                    if(post_password_required()){
                        return;
                    }
                    $this->page_id = get_the_ID();
                    $this->post_layout = themify_get( 'layout', 'list-post' );
                    // set default post layout
                    if($this->post_layout == ''){
                            $this->post_layout = 'list-post';
                    }
                    $post_image_width = themify_get('image_width');
                    $post_image_height = themify_get('image_height');
		}
		if(!isset($post_image_width) || $post_image_width===''){
                    $post_image_width = themify_get('setting-image_post_width');
		}
		if(!isset($post_image_height) || $post_image_height===''){
                    $post_image_height = themify_get('setting-image_post_height');
		}


		if( is_singular() ) {
			$this->display_content = 'content';
		}
		
		if( empty( $post_image_width ) || empty( $post_image_height ) ) {
                    ///////////////////////////////////////////
                    // Setting image width, height
                    ///////////////////////////////////////////
                    switch ($this->post_layout){
                        case 'grid4':
                            $this->width = self::$grid4_width;
                            $this->height = self::$grid4_height;
                        break;
                        case 'grid3':
                            $this->width = self::$grid3_width;
                            $this->height = self::$grid3_height;
                        break;
                        case 'grid2':
                            $this->width = self::$grid2_width;
                            $this->height = self::$grid2_height;
                        break;
                        case 'list-large-image':
                            $this->width = self::$list_large_image_width;
                            $this->height = self::$list_large_image_height;
                        break;
                        case 'list-thumb-image':
                            $this->width = self::$list_thumb_image_width;
                            $this->height = self::$list_thumb_image_height;
                        break;
                        case 'grid2-thumb':
                            $this->width = self::$grid2_thumb_width;
                            $this->height = self::$grid2_thumb_height;
                        break;
                        default :
                            $this->width = self::$list_post_width;
                            $this->height = self::$list_post_height;
                        break;
                    }
                }
		if ( is_numeric( $post_image_width ) && $post_image_width >= 0 ) {
			$this->width = $post_image_width;
		}
		if ( is_numeric( $post_image_height ) && $post_image_height >= 0 ) {
			$this->height = $post_image_height;
		}
		
		if( is_page() ) {
			if(get_query_var('paged')):
				$this->paged = get_query_var('paged');
			elseif(get_query_var('page')):
				$this->paged = get_query_var('page');
			else:
				$this->paged = 1;
			endif;
			global $paged;
			$paged = $this->paged;
			$this->query_category = themify_get('query_category');
			
			$this->layout = (themify_get('page_layout') != 'default' && themify_check('page_layout')) ? themify_get('page_layout') : themify_get('setting-default_page_layout');
			if($this->layout == ''){
				$this->layout = 'sidebar1';
                        }
			$this->post_layout = themify_get( 'layout', 'list-post' );
			
			$this->page_title = (themify_get('hide_page_title') != 'default' && themify_check('hide_page_title')) ? themify_get('hide_page_title') : themify_get('setting-hide_page_title'); 
			$this->hide_title = themify_get('hide_title'); 
			$this->unlink_title = themify_get('unlink_title'); 
			$this->hide_image = themify_get('hide_image'); 
                        $this->unlink_image = themify_get('unlink_image'); 
			$this->hide_meta = themify_get('hide_post_meta'); 
			$this->hide_date = themify_get('hide_date'); 
			$this->display_content = themify_get( 'display_content', 'excerpt' );
			$this->post_image_width = themify_get('image_width'); 
			$this->post_image_height = themify_get('image_height'); 
			$this->page_navigation = themify_get('hide_navigation'); 
			$this->posts_per_page = themify_get('posts_per_page');
			$this->order = (themify_get('order') && '' != themify_get('order')) ? themify_get('order') : (themify_check('setting-index_order') ? themify_get('setting-index_order') : 'DESC');
			$this->orderby = (themify_get('orderby') && '' != themify_get('orderby')) ? themify_get('orderby') : (themify_check('setting-index_orderby') ? themify_get('setting-index_orderby') : 'date');

			// Post query or portfolio query ///////////////////
			$post_query_category = themify_get('query_category');
			$post_query_taxonomy = 'category';

			$portfolio_query_category = themify_get('portfolio_query_category');
			$portfolio_query_taxonomy = 'portfolio-category';

			if( '' != $portfolio_query_category ) {
				
				$this->query_category = $portfolio_query_category;
				$this->query_taxonomy = $portfolio_query_taxonomy;
				$this->query_post_type = 'portfolio';

				if(themify_check('portfolio_hide_meta_all')){
					$this->hide_meta = themify_get('portfolio_hide_meta_all');
				} else {
					$this->hide_meta = themify_check('setting-default_portfolio_index_post_meta_category')?
					themify_get('setting-default_portfolio_index_post_meta_category') : 'no';
				}

				$this->post_layout = themify_get('portfolio_layout') ? themify_get('portfolio_layout') : themify_get('setting-default_portfolio_index_post_layout');
				if('' == $this->post_layout)
					$this->post_layout = 'list-post';

				if(themify_get('page_layout') != 'default'){
					$this->layout = themify_get('page_layout');
				} else {
					$this->layout = themify_check('setting-default_portfolio_index_layout')? themify_get('setting-default_portfolio_index_layout') : 'sidebar-none';
				}

				$this->hide_title = themify_get('portfolio_hide_title');
				$this->unlink_title = themify_get('portfolio_unlink_title');
				$this->hide_image = themify_get('portfolio_hide_image');
				$this->unlink_image = themify_get('portfolio_unlink_image');

				$this->hide_date = themify_get('portfolio_hide_date');
				$this->display_content = themify_get('portfolio_display_content', 'excerpt');
				$this->post_image_width = themify_get('portfolio_image_width');
				$this->post_image_height = themify_get('portfolio_image_height');
				$this->page_navigation = themify_get('portfolio_hide_navigation');
				$this->posts_per_page = themify_get('portfolio_posts_per_page');
				$this->order = themify_get('portfolio_order');
				$this->orderby = themify_get('portfolio_orderby');
			} else {
				$this->query_category = $post_query_category;
				$this->query_taxonomy = $post_query_taxonomy;
				$this->query_post_type = 'post';
			}
		}
		elseif (is_tax('portfolio-category')) {
			$this->post_layout = themify_check('setting-default_portfolio_index_post_layout')? themify_get('setting-default_portfolio_index_post_layout') : 'list-post';
			$this->layout = themify_check('setting-default_portfolio_index_layout')? themify_get('setting-default_portfolio_index_layout') : 'sidebar-none';
			$this->hide_meta = themify_check('setting-default_portfolio_index_post_meta_category')?
					themify_get('setting-default_portfolio_index_post_meta_category') : 'no';
			$this->hide_date = themify_check('setting-default_portfolio_index_post_date')?
					themify_get('setting-default_portfolio_index_post_date') : 'no';
		}
		elseif( is_singular('post') || is_singular('portfolio') ) {
                        $is_portfolio = is_singular('portfolio');
			$this->hide_image = (themify_get('hide_post_image') != 'default' && themify_check('hide_post_image')) ? themify_get('hide_post_image') : themify_get('setting-default_page_post_image');
			$this->unlink_image = (themify_get('unlink_post_image') != 'default' && themify_check('unlink_post_image')) ? themify_get('unlink_post_image') : themify_get('setting-default_page_unlink_post_image');

			if(!$is_portfolio){
				// Post singular settings
				$this->hide_title = (themify_get('hide_post_title') != 'default' && themify_check('hide_post_title')) ? themify_get('hide_post_title') : themify_get('setting-default_page_post_title');
				$this->hide_meta = (themify_get('hide_post_meta') != 'default' && themify_check('hide_post_meta')) ? themify_get('hide_post_meta') : themify_get('setting-default_page_post_meta');
				$this->unlink_title = (themify_get('unlink_post_title') != 'default' && themify_check('unlink_post_title')) ? themify_get('unlink_post_title') : themify_get('setting-default_page_unlink_post_title');
				$this->hide_date = (themify_get('hide_post_date') != 'default' && themify_check('hide_post_date')) ? themify_get('hide_post_date') : themify_get('setting-default_page_post_date');
				$this->layout = (themify_get('layout') == 'sidebar-none'
							|| themify_get('layout') == 'sidebar1'
							|| themify_get('layout') == 'sidebar1 sidebar-left'
							|| themify_get('layout') == 'sidebar2'
							|| themify_get('layout') == 'sidebar2 content-left'
							|| themify_get('layout') == 'sidebar2 content-right') ?
								themify_get('layout') : themify_get('setting-default_page_post_layout');
				 // set default layout
				 if($this->layout == ''){
				 	$this->layout = 'sidebar1';
                                 }
                                $post_image_width = themify_get('setting-image_post_single_width');
                                $post_image_height = themify_get('setting-image_post_single_height');
			} else {
				// Portfolio singular settings
				$this->hide_title = (themify_get('hide_post_title') != 'default' && themify_check('hide_post_title')) ? themify_get('hide_post_title') : themify_get('setting-default_portfolio_single_title');
				$this->hide_meta = (themify_get('hide_post_meta') != 'default' && themify_check('hide_post_meta')) ? themify_get('hide_post_meta') : themify_check('setting-default_portfolio_single_post_meta_category')? themify_get('setting-default_portfolio_single_post_meta_category') : 'no';
				$this->unlink_title = (themify_get('unlink_post_title') != 'default' && themify_check('unlink_post_title')) ? themify_get('unlink_post_title') : themify_get('setting-default_portfolio_single_unlink_post_title');
				$this->hide_date = (themify_get('hide_post_date') != 'default' && themify_check('hide_post_date')) ? themify_get('hide_post_date') : themify_get('setting-default_portfolio_single_post_date');
				$this->layout = themify_check('setting-default_portfolio_single_layout')? themify_get('setting-default_portfolio_single_layout') : 'sidebar-none';
                                
                                $post_image_width = themify_get('setting-default_portfolio_single_image_post_width');
				$post_image_height = themify_get('setting-default_portfolio_single_image_post_height');
			}
			
			$this->display_content = '';
			self::$content_width = self::$single_content_width;
			
                        // Set Default Image Sizes for Single
                        $this->width =$post_image_width>=0?$post_image_width:($is_portfolio?self::$single_portfolio_image_width:self::$single_image_width);
                        $this->height = $post_image_height>=0?$post_image_height:($is_portfolio ?self::$single_portfolio_image_height:self::$single_image_height);
		}

		if(is_single() && $this->hide_image != 'yes') {
			$this->image_align = themify_get('setting-image_post_single_align');
			$this->image_setting = 'setting=image_post_single&';
		} elseif($this->query_category != '' && $this->hide_image != 'yes') {
			$this->image_align = '';
			$this->image_setting = '';
		} else {
			$this->image_align = themify_get('setting-image_post_align');
			$this->image_setting = 'setting=image_post&';
		}

	}
	
	/**
	 * Returns post category IDs concatenated in a string
	 * @param number Post ID
	 * @return string Category IDs
	 */
	public function get_categories_as_classes($post_id){
		$categories = wp_get_post_categories($post_id);
		$class = '';
		foreach($categories as $cat)
			$class .= ' cat-'.$cat;
		return $class;
	}
	 	 
	 /**
	  * Returns category description
	  * @return string
	  */
	 function get_category_description(){
	 	$category_description = category_description();
		if ( !empty( $category_description ) ){
			return '<div class="category-description">' . $category_description . '</div>';
		}
	 }
}

/**
 * Initializes Themify class
 */
function themify_global_options() {
	/**
	 * Themify initialization class
	 */
	global $themify;
	$themify = new Themify();
	$themify->theme = new Themify_ThemeClass();
}
add_action( 'after_setup_theme','themify_global_options', 12 );

?>