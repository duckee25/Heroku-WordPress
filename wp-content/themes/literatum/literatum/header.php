<?php
/**
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php if(is_home()) { echo get_bloginfo('name') . ' - ' . get_bloginfo('description'); } else { wp_title('');} ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!--[if IE 9 ]>
<div id="page" class="hfeed site ie9">
<![endif]-->
<!--[if !IE 9]>-->
<div id="page" class="hfeed site">
<!--<![endif]-->
	






	
<div class="container">

    <!-- Push Wrapper -->
    <div class="mp-pusher " id="mp-pusher">




 
        <!-- /mp-menu -->

        <nav id="mp-menu" class="mp-menu">
					<div class="mp-level">

						<div class="quit-menu-button-container">
							<span onclick="pushmenu_close()" class="quit-menu-button"><i>&#xe949;</i> <?php _e('Close', THEME_TEXTDOMAIN);?></span>
						</div>

						<div id="sidebar-content">

							<?php dynamic_sidebar( 'sidebar-common-area-top' ); ?>

							<?php if (is_front_page() || is_home()) {

								dynamic_sidebar( 'sidebar-frontpage-area' );

							} elseif(is_single()) {

								dynamic_sidebar( 'sidebar-post-area' );

							} elseif(is_page()) {

								dynamic_sidebar( 'sidebar-page-area' );

							} elseif(is_category() || is_tag()) {

								dynamic_sidebar( 'sidebar-category-area' );

							} elseif(is_author()) {

								dynamic_sidebar( 'sidebar-author-area' );

							} else {

								dynamic_sidebar( 'sidebar-others-area' );

							}?>

							<?php dynamic_sidebar( 'sidebar-common-area-bottom' ); ?>

						</div>



						<footer id="colophon" class="site-footer" role="contentinfo">
							<div class="site-info default-content-width">
								<div class="int">

									<?php $website_firm = get_option(ktt_var_name('website_firm'));
									if ($website_firm) {?>
									<div class="footer-firm">
										<?php echo $website_firm;?>
									</div>
									<?php } ?>

									

									<?php if ( has_nav_menu( 'bottom-menu' ) ) {?>
									<div class="bottom-menu-container" style="text-align:right">
											<?php wp_nav_menu( array( 'theme_location' => 'bottom-menu', 'menu_class' => 'bottom-menu',  )); ;?>
									</div>
									<?php } ?>  

									<div style="clear:both"></div>

								</div>
							</div><!-- .site-info -->
						</footer><!-- #colophon -->





						
					</div>
		</nav>
        
 
        <div class="scroller "><!-- this is for emulating position fixed of the nav -->
            
	            <div class="scroller-inner ">



	            				<!-- back to top button and menu -->
							    <div id="top-controls">
									<span class="top-button" onclick="scrollto('#page', 750, -30)">
										<i>&#xe824;</i>
									</span>

									<span class="top-button" onclick="pushmenu()">
										<i>&#xe944;</i>
									</div>
								</div>
								




            	            	<div class="push-cover"></div>







							    <header id="masthead" class="site-header " role="banner">

									<div class="row start-hand default-content-width">



									    <div class="column-7-hand head-column-1">

									    	<div class="logo">
										        <a id="site-logo" href="<?php echo home_url();?>" class="box">
										        	
										        	<?php 

										        	// favicong
													$logo = get_option(ktt_var_name('logo_image'));

													$logo_src = wp_get_attachment_image_src($logo, 'medium');
													$logo_src = $logo_src[0];


													if ($logo) {

														?>
														<img alt="<?php bloginfo('name');?>" style="width:100%;height:auto;" src="<?php echo $logo_src;?>">
														<?php

													} else {
														echo bloginfo('name');
													}

										        	


										        	?>
										        </a> 

										        <?php 
										        $website_slogan = get_option(ktt_var_name('website_slogan'));
										        if ($website_slogan) {?>
										        <div class="logo-legend">
										        	<?php echo wpautop($website_slogan);?>
										        </div>
										        <?php } ?>
										    </div>

									    </div>


									    
									    <?php if ( has_nav_menu( 'main-menu' ) ) {?>
									    <div class="column-auto-hand primary-menu-container head-column-2" style="text-align:right">
									    		<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'main-menu',  )); ;?>
									    </div>
									    <?php } ?>  
									    
									    

									    <div class="column-auto-hand menu-pusher-container head-column-3" style="min-width:80px;text-align:right;">
									        <div onclick="pushmenu()" class="box menu-pusher"><span class="hide-on-mobileX"><?php _e('Menu',THEME_TEXTDOMAIN);?></span> <i>&#xe944;</i></div>
									    </div>



									</div>
									
								</header><!-- #masthead -->





	<div id="content" class="site-content">
