<?php
/**
 * Enable support for Post Thumbnails on posts and pages.
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
 *
 */




// return true if count words is active in the site
function KTT_show_post_read_time_is_active() {
	return get_option(ktt_var_name('show_read_time'));
}


// content word counts
function KTT_post_word_count($article = '') {
    global $post;
    if ($article) $post = $article;
    $content = get_post_field( 'post_content', $post->ID );
    $word_count = str_word_count( strip_tags( $content ) );
    return $word_count;
}



// function that diplays the read time o word count of an article in string format
function KTT_display_post_read_time($article = '') {
	$result 			= '';
	$read_time_type 	= get_option(ktt_var_name('read_time_type'));
	$words_count 		= KTT_post_word_count($article);

	if ($read_time_type == 'words_count') {
		$result =  $words_count . ' ' . __('words', THEME_TEXTDOMAIN);
	} else {
		$words_by_second = 3;
		$result = round(($words_count / $words_by_second) / 60) . ' ' . __('min read', THEME_TEXTDOMAIN);
	}

	return $result;
}










// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


				// add page to theme options

				$args = array();
				$args['id'] 				= ktt_var_name('readtime-page');
				$args['page_title'] 		= __('Read Time',THEME_TEXTDOMAIN);
				$args['page_description'] 	= __('', THEME_TEXTDOMAIN);
				$args['menu_title'] 		= __('Read Time',THEME_TEXTDOMAIN);
				$args['menu_order'] 		= 10;
				$args['parent'] 			= 'theme-options';

				$new_admin_submenu = new KTT_admin_submenu($args);




				// add section for read time

				$args                           	= array();
				$args['section_id']              	= ktt_var_name('read_time');
				$args['section_name']            	= __('Read Time for articles', THEME_TEXTDOMAIN);
				$args['section_description']     	= __('Configure the Read Time option for articles.', THEME_TEXTDOMAIN);
				$args['section_page']            	= ktt_var_name('readtime-page');

				$KTT_new_section = new KTT_new_section($args);




				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('show_read_time');
				$args['option_name']            = __('Display Read Time', THEME_TEXTDOMAIN);
				$args['option_label']           = __('Active the display of the read time option in the articles.', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Check this option if you want to active read time',THEME_TEXTDOMAIN);
				$args['option_type']            = 'checkbox';
				$args['option_page']            = ktt_var_name('readtime-page');
				$args['option_page_section']    = ktt_var_name('read_time');
				$args['option_default']			= '1';

				$KTT_new_setting = new KTT_new_setting($args);





				// add option to admin panel

				$args                           = array();
				$args['option_id']              = ktt_var_name('read_time_type');
				$args['option_name']            = __('Display Type', THEME_TEXTDOMAIN);
				$args['option_label']           = __('Choose display type.', THEME_TEXTDOMAIN);
				$args['option_description']     = __('Select between display the read time or the number of words.',THEME_TEXTDOMAIN);
				$args['option_type']            = 'select';
				$args['option_type_vars']       = array(
													'read_time' => __('Read time',THEME_TEXTDOMAIN),
													'words_count' => __('Words count',THEME_TEXTDOMAIN)
												);
				$args['option_page']            = ktt_var_name('readtime-page');
				$args['option_page_section']    = ktt_var_name('read_time');
				$args['option_default']			= 'read_time';

				$KTT_new_setting = new KTT_new_setting($args);

}


?>