<?php
/**
 * Ajax Navigation Support
 *
 */


function KTT_ajax_is_enabled() {
	return get_option(ktt_var_name('active_ajax_navigation'));
}





function KTT_ajax_show_header() {

	if (isset($_REQUEST['ajax']) && KTT_ajax_is_enabled()) return;
	get_header(); 
	

}

function KTT_ajax_show_footer() {

	if (isset($_REQUEST['ajax']) && KTT_ajax_is_enabled()) return;
	get_footer(); 

}




function KTT_ajax_js() {

	if (!KTT_ajax_is_enabled()) return;
	?>

 	<script>

 			jQuery(document).on('click', '.ajaxlink > a, a.ajaxlink', function(e) {
			//jQuery('a.ajaxlink').on('click', function(e) {
				//jQuery("#loading").show();


				href = jQuery(this).attr("href");

				if (href == document.URL) return false;
				
				loadContent(href);
				
				// HISTORY.PUSHSTATE
				history.pushState('', 'New URL: '+href, href);
				e.preventDefault();
				
				
			});
			
			// THIS EVENT MAKES SURE THAT THE BACK/FORWARD BUTTONS WORK AS WELL
			
			window.onpopstate = function(event) {
				if(event.state !== null) {
				//jQuery("#loading").show();
				console.log("pathname: "+location.href);
				loadContent(location.href);
				}
			}

			function loadContent(url){
			// USES JQUERY TO LOAD THE CONTENT

				div = '';

				link = jQuery('a.ajaxlink[href="'+url+'"]');

				
				if (link.attr('data-contentdiv')) div = link.attr('data-contentdiv');

				if(!div)  div = '#content'; 

				if(!div) {
					window.location.assign(url);
				}

				//url = url + simbolito + 'ajax=1';

				jQuery(link).parents('ul').find('li').removeClass('active');
				jQuery(link).parents('li').addClass('active');

				animate_in = link.attr('data-anim-in')
				animate_out = link.attr('data-anim-out');

				if (!animate_in) animate_in = 'fadeIn';
				if (!animate_out) animate_out = 'fadeOut';


				simbolito = '&';
				if (url.indexOf("?") === -1 ) simbolito = '?';



						if (typeof NProgress != "undefined") NProgress.start();
						if (typeof NProgress != "undefined") NProgress.set(0.6)


							jQuery(div).addClass('veryfast animated');
							jQuery(div).addClass(animate_out).delay(250).queue(function(){
								scrollto('body', 50, 0);
								if (typeof NProgress != "undefined") NProgress.inc();

							});
							//jQuery(div).css({'opacity':'0.4'});

							

							<?php do_action('KTT_before_ajax_link_load');?>
							
							
							

	                    	jQuery(div).load(url + simbolito + 'ajax=1', function () {


	                    		jQuery(div).dequeue();
	                    		
	                    		jQuery(window).scroll(); //load fix



	                       		jQuery(div).removeClass(animate_out).addClass(animate_in).delay(250)

							    .queue(function(){
							        jQuery(this).removeClass(animate_in);
							        if (typeof NProgress != "undefined") NProgress.done();
							        jQuery(this).dequeue();

							        pushmenu_close();
							      

							        if (link.attr('data-scrollto')) {


							        	speed = 500;
							        	if(link.attr('data-scrollto-speed')) speed = link.attr('data-scrollto-speed');

							        	offset = -60;
							        	if (link.attr('data-scrollto-offset')) offset = link.attr('data-scrollto-offset');

							        	scrollto(link.attr('data-scrollto'), speed, parseFloat(offset));

							        	
							        }


							        <?php do_action('KTT_after_ajax_link_load');?>
							        
							        
							    });


	                        })

				
				
			}


 	</script>

	<?php
}


add_action('wp_footer', 'KTT_ajax_js');





// Add the class "ajaxlink" to the next/previous navigation to make this ajax ready
if (KTT_ajax_is_enabled()) {
	add_filter('next_posts_link_attributes', 'ktt_next_posts_link_attributes');
	add_filter('previous_posts_link_attributes', 'ktt_previous_posts_link_attributes');
	function ktt_next_posts_link_attributes(){return 'class="next_link ajaxlink"';}
	function ktt_previous_posts_link_attributes(){return 'class="previous_link ajaxlink"';}
}






/**
 * Enqueue scripts for ajax navigation
 */
function KTT_ajax_navigation_scripts() {

	wp_enqueue_script( 'nprogress', KTT_path_to_url(dirname(__FILE__)) . '/js/nprogress.js', array(), '20130115', 'jquery' );

}
if (KTT_ajax_is_enabled()) add_action( 'wp_enqueue_scripts', 'KTT_ajax_navigation_scripts' );









// --------------------------------------------------------------------------------------------------------------
// options form for the admin pages
// --------------------------------------------------------------------------------------------------------------
if (is_admin()) {


			// add page to theme options

			$args = array();
			$args['id'] = ktt_var_name('ajax-navigation-page');
			$args['page_title'] = 'AJAX navigation';
			$args['page_description'] = __('AJAX Navigation can be activated with just one click to accelerate and approach the navigation throughout the website.', THEME_TEXTDOMAIN);
			$args['menu_title'] = 'AJAX navigation';
			$args['menu_order'] = 2;
			$args['parent'] = 'theme-options';

			$new_admin_submenu = new KTT_admin_submenu($args);




			// add option to admin panel

			$args                           = array();
			$args['option_id']              = ktt_var_name('active_ajax_navigation');
			$args['option_name']            = __('AJAX Navigation', THEME_TEXTDOMAIN);
			$args['option_label']           = __('Active dynamic navigation in the site.', THEME_TEXTDOMAIN);
			$args['option_description']     = __('To make AJAX ready also the links of the WP menus (appearance/menus) add the class "ajaxlink" in the "CSS Classes" inputbox of every menu item.', THEME_TEXTDOMAIN);
			$args['option_type']            = 'checkbox';
			$args['option_default'] 		= 1;
			$args['option_page']            = ktt_var_name('ajax-navigation-page');

			$KTT_new_setting = new KTT_new_setting($args);




			

}

?>