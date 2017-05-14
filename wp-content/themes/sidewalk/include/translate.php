<?php

/* This is global array of translation strings used for internal theme translation */

global $sdw_translate;

$sdw_translate = array(
	'load_more' => array('option_title' => 'Load more', 'translated' => __(' Load more', THEME_SLUG), 'option_desc' => 'Load more button title'),
	'no_comments' => array('option_title' => 'Add Comment', 'translated' => __('Add Comment', THEME_SLUG), 'option_desc' => 'Comment meta data (if zero comments)'),
	'one_comment' => array('option_title' => '1 Comment', 'translated' => __('1 Comment', THEME_SLUG), 'option_desc' => 'Comment meta data (if 1 comment)'),
	'multiple_comments' => array('option_title' => '% Comments', 'translated' => __('% Comments', THEME_SLUG), 'option_desc' => 'Comment meta data (if more than 1 comments)'),
	'newer_entries' => array('option_title' => 'Newer Entries', 'translated' => __('Newer Entries', THEME_SLUG), 'option_desc' => 'Navigation button for newer entries'),
	'older_entries' => array('option_title' => 'Older Entries', 'translated' => __('Older Entries', THEME_SLUG), 'option_desc' => 'Navigation button for older entries'),
	'next_posts' => array('option_title' => 'Next', 'translated' => __('Next', THEME_SLUG), 'option_desc' => 'Navigation button for next posts'),
	'previous_posts' => array('option_title' => 'Previous', 'translated' => __('Previous', THEME_SLUG), 'option_desc' => 'Navigation button for previous posts'),
	'category' => array('option_title' => 'Category - ', 'translated' => __('Category - ', THEME_SLUG), 'option_desc' => 'Category archive title'),
	'tag' => array('option_title' => 'Tag - ', 'translated' => __('Tag - ', THEME_SLUG), 'option_desc' => 'Tag archive title'),
	'author' => array('option_title' => 'Author - ', 'translated' => __('Author - ', THEME_SLUG), 'option_desc' => 'Author archive title'),
	'archive' => array('option_title' => 'Archive - ', 'translated' => __('Archive - ', THEME_SLUG), 'option_desc' => 'Archive title i.e. date archives etc...'),
	'search_results_for' => array('option_title' => 'Search Results For - ', 'translated' => __('Search Results For - ', THEME_SLUG), 'option_desc' => 'Title for search results template'),
	'search_form' => array('option_title' => 'Type here to search...', 'translated' => __('Type here to search...', THEME_SLUG), 'option_desc' => 'Search input field text'),
	'ago' => array('option_title' => 'ago', 'translated' => __('ago', THEME_SLUG), 'option_desc' => 'Used if date format is set to "time ago" in Theme options -> Misc.'),
	'continue_reading' => array('option_title' => 'Continue reading', 'translated' => __('Continue reading', THEME_SLUG), 'option_desc' => 'Continue reading button label'),
	'share' => array('option_title' => 'Share', 'translated' => __('Share', THEME_SLUG), 'option_desc' => 'Share button label'),
	'by_author' => array('option_title' => 'by', 'translated' => __('by', THEME_SLUG), 'option_desc' => 'Used for author link in post meta data'),
	'views' => array('option_title' => 'Views', 'translated' => __('Views', THEME_SLUG), 'option_desc' => 'Used in post meta data'),
	'min_read' => array('option_title' => 'min read', 'translated' => __('min read', THEME_SLUG), 'option_desc' => 'Used in post meta (reading time)'),
	'tagged_as' => array('option_title' => 'Tagged as: ', 'translated' => __('Tagged as: ', THEME_SLUG), 'option_desc' => 'Used before tags listing on single post'),
	'next_posts_text' => array('option_title' => 'Next post', 'translated' => __('Next post', THEME_SLUG), 'option_desc' => 'Navigation link for next posts on single post'),
	'previous_posts_text' => array('option_title' => 'Previous post', 'translated' => __('Previous post', THEME_SLUG), 'option_desc' => 'Navigation link for previous posts on single post'),
	'related_title' => array('option_title' => 'You may also like', 'translated' => __('You may also like', THEME_SLUG), 'option_desc' => 'Used for "related posts" title'),
	'page_of' => array('option_title' => '%s / %s', 'translated' => __('%s / %s', THEME_SLUG), 'option_desc' => 'Used on paginated post navigation'),
	'view_all_posts' => array('option_title' => 'View all posts', 'translated' => __('View all posts', THEME_SLUG), 'option_desc' => 'Used in author box'),
	'about_author' => array('option_title' => 'About the author', 'translated' => __('About the author', THEME_SLUG), 'option_desc' => 'Author box title'),
	'comments_number' => array('option_title' => '% Comments', 'translated' => __('% Comments', THEME_SLUG), 'option_desc' => 'Comments area main title (if post has comments)'),
	'leave_a_comment' => array('option_title' => 'Leave a comment', 'translated' => __('Leave a comment', THEME_SLUG), 'option_desc' => 'Comments area title (if post has no comments)'),
	'reply_comment' => array('option_title' => 'Reply', 'translated' => __('Reply', THEME_SLUG), 'option_desc' => 'Comment reply button text'),		
	'leave_a_reply' => array('option_title' => 'Leave a Comment', 'translated' => __('Leave a Comment', THEME_SLUG), 'option_desc' => 'Comments area reply text'),
	'comment_submit' => array('option_title' => 'Post Comment', 'translated' => __('Post Comment', THEME_SLUG), 'option_desc' => 'Comment form submit button'),
	'comment_field' => array('option_title' => 'Comment', 'translated' => __('Comment', THEME_SLUG), 'option_desc' => 'Comment form field text area title'),
	'comment_name' => array('option_title' => 'Name', 'translated' => __('Name', THEME_SLUG), 'option_desc' => 'Comment form name field title'),
	'comment_email' => array('option_title' => 'Email', 'translated' => __('Email', THEME_SLUG), 'option_desc' => 'Comment form email field title'),
	'comment_website' => array('option_title' => 'Website', 'translated' => __('Website', THEME_SLUG), 'option_desc' => 'Comment form website field title'),
	'must_log_in' => array('option_title' => 'You must be <a href="%s">logged in</a> to post a comment.', 'translated' => __('You must be <a href="%s">logged in</a> to post a comment.', THEME_SLUG)),	
	'logged_in_as' => array('option_title' => 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'translated' => __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', THEME_SLUG)),
	'nothing_found' => array('option_title' => 'Nothing found', 'translated' => __('Nothing found', THEME_SLUG), 'option_desc' => 'Box title if posts are not found on the page'),
	'nothing_found_search' => array('option_title' => 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'translated' => __('Sorry, but nothing matched your search terms. Please try again with some different keywords.', THEME_SLUG), 'option_desc' => 'Text if posts are not found on the page'),
	'nothing_found_text' => array('option_title' => 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'translated' => __('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', THEME_SLUG)),	
	'404_title' => array('option_title' => '404 error: Page not found', 'translated' => __('404 error: Page not found', THEME_SLUG), 'option_desc' => '404 error page'),
	'404_subtitle' => array('option_title' => 'It seems that you got lost, but we are here to help', 'translated' => __('It seems that you got lost, but we are here to help', THEME_SLUG), 'option_desc' => '404 error page'),
	'404_quote' => array('option_title' => 'Not all those who wonder are lost<br/> - J.R.R. Tolkien', 'translated' => __('Not all those who wonder are lost<br/> - J.R.R. Tolkien', THEME_SLUG), 'option_desc' => '404 error page'),
	'404_text' => array('option_title' => 'The page that you are looking for doesn&rsquo;t exist on this website. You may have accidentally mistype the page address, or followed an expired link. Anyway, we will help you get back on track. Why don&rsquo;t you try one of these pages for starters.','translated' => __('The page that you are looking for doesn&rsquo;t exist on this website. You may have accidentally mistype the page address, or followed an expired link. Anyway, we will help you get back on track. Why don&rsquo;t you try one of these pages for starters.', THEME_SLUG), 'option_desc' => '404 error page')
);

?>