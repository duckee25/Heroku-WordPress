<?php 
$cryptinstall=get_template_directory()."/scripts/crypt/cryptographp.fct.php";
include $cryptinstall; 
$_SESSION['cryptdir'] = get_template_directory_uri().'/scripts/crypt'; 

if ( is_page() && get_the_id()==pix_get_option('pix_posts_page_id') && get_option('show_on_front')=='posts' ) {
    wp_redirect( home_url() );
    exit;
}
?>
<!DOCTYPE HTML>
<!-- Forte is a Pixedelic work on Wordpress platform | Manuel Masia (designer and developer) -->
<!--[if lte IE 7]> <html class="ie7 ms-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="ie8 ms-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>     <html class="ie9 ms-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gte IE 9]><html class="working" <?php language_attributes(); ?>><![endif]-->
<!--[if !IE]><!--><html class="working" <?php language_attributes(); if( pix_is_facebook() ){ echo 'xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/"'; }?>><!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" >
    
    <?php pix_get_seo(); ?>

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php if ( pix_get_option('pix_favicon')!='' ) { ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo pix_get_option('pix_favicon'); ?>"> 
    <?php } ?>
     
        
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--///////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //      Scripts
    //
    ///////////////////////////////////////////////////////////////////////////////////////////////////-->

    <!--mfunc pix_sc_code --><?php echo pix_front_javascript_var(); ?><!--/mfunc pix_sc_code-->

    <?php echo pix_get_option('pix_append_head_top'); ?>

    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/scripts/html5.js"></script>
    <![endif]-->   
    
    
    <?php
        if ( is_singular() && get_option( 'thread_comments' ) )
            wp_enqueue_script( 'comment-reply' );
    
        
    echo pix_get_option('pix_append_head_bottom');

        wp_head();


    ?>

</head>
<body <?php body_class(); ?> data-uri="<?php echo get_template_directory_uri(); ?>" onunload="">

<div id="super_wrap">
    <div id="content_wrap">
        <!--mfunc pix_sc_code --><?php echo pixRefererHeader(); ?><!--/mfunc pix_sc_code-->
        
            <div class="wrap_header">
            
                <div class="pix_column pix_column_990">
            
                    <h1 id="logo" class="alignleft">
                        <a href="<?php echo home_url(); ?>" class="letmebe"><?php do_action('forte_before_logo'); if(pix_get_option('pix_logoimage')!='') { echo '<img src="'.pix_remove_protocol(pix_get_option('pix_logoimage')).'" style="'.pix_get_option('pix_logostyle').'">'; } ?><span><?php echo get_bloginfo('name'); ?></span><?php do_action('forte_after_logo'); ?></a>
                    </h1>
                    <?php if ( get_bloginfo('description') != '' ) { ?><h2 id="logo_subtitle"><span><?php echo get_bloginfo('description'); ?></span></h2><?php } ?>
                
                    <nav class="alignright" data-listart="100" data-liend="70">
                    
                        <div>
                        
                        <?php
                            if (menuCount('primary_menu')!=0) { 
                                wp_nav_menu( array( 'container' => 'ul','theme_location' => 'primary_menu', 'menu_class' => 'menu', 'walker' => new Pix_Walker ) );
                                wp_nav_menu( array( 'items_wrap' => '<select id="pix_select_menu">%3$s</select>','theme_location' => 'primary_menu', 'walker' => new Pix_Walker_Mobile ) );
                            } else {
                                echo '<ul class="menu">
                                    <li>
                                        <a href="'.get_bloginfo('url').'"><span><i class="icon-home pix_icon_menu"></i>Home page</span></a>
                                    </li>
                                    <li>
                                        <a href="'.get_permalink(get_option('page_for_posts')).'"><span><i class="icon-blog pix_icon_menu"></i>Blog</span></a>
                                    </li>
                                    <li>
                                        <a href="'.get_admin_url().'nav-menus.php"><span><i class="icon-cogs pix_icon_menu"></i>Set your menu</span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span><i class="icon-film pix_icon_menu"></i>Video utorials</span></a>
                                        <ul class="children">
                                            <li>
                                                <a href="http://www.pixedelic.com/themes/forte/install-forte/" target="_blank">Install Forte</a>
                                            </li>
                                            <li>
                                                <a href="http://www.pixedelic.com/themes/forte/first-steps/" target="_blank">First steps</a>
                                            </li>
                                            <li>
                                                <a href="http://www.pixedelic.com/themes/forte/import-data/" target="_blank">Import data</a>
                                            </li>
                                            <li>
                                                <a href="http://www.pixedelic.com/themes/forte/create-a-menu/" target="_blank">Create a menu</a>
                                            </li>
                                            <li>
                                                <a href="http://www.pixedelic.com/themes/forte/sidebars-and-side-icons/" target="_blank">Sidebars and side icons</a>
                                            </li>
                                            <li>
                                                <a href="http://www.pixedelic.com/themes/forte/create-a-slideshow/" target="_blank">Create a slideshow</a>
                                            </li>
                                            <li>
                                                <a href="http://www.pixedelic.com/themes/forte/the-page-builder/" target="_blank">The page builder</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="menu-menu-container">
                                    <select id="pix_select_menu">
                                        <option value="Home page" data-href="'.get_bloginfo('url').'">Home page</option>
                                        <option value="Blog" data-href="'.get_permalink(get_option('page_for_posts')).'">Blog</option>
                                        <option value="Set your menu" data-href="'.get_admin_url().'nav-menus.php">Set your menu</option>
                                        <option value="Video utorials" data-href="http://www.pixedelic.com/themes/forte/install-forte/">Video utorials</option>
                                    </select>
                                </div>';
                            } 
                        ?>

                        </div>
                    
                    </nav>
                    
                </div><!-- .pix_column_990 -->
                
            </div>
                <div class="shadow bottom">
                </div><!-- .shadow.bottom -->
                
                <div class="click_aside click_aside_left">
                    <div>
                    <?php
                        $pix_array_topleft_icon = pix_get_option('pix_array_topleft_icon_'); 
                        $i = 0;
                        while($i<count($pix_array_topleft_icon)) { ?>
                        <div style="
                            <?php if(isset($pix_array_topleft_icon[$i]['color']) && $pix_array_topleft_icon[$i]['color']!='') echo 'color:'.$pix_array_topleft_icon[$i]['color'].';'; ?>
                            <?php if(isset($pix_array_topleft_icon[$i]['bgcolor']) && $pix_array_topleft_icon[$i]['bgcolor']!='') echo 'background:rgba('.hex2RGB($pix_array_topleft_icon[$i]['bgcolor'],true).','.pix_get_option('pix_floatingicons_position_bgcolor_opacity').');    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_floatingicons_position_bgcolor_opacity')) . pix_remove_something('#',$pix_array_topleft_icon[$i]['bgcolor']).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_floatingicons_position_bgcolor_opacity')) . pix_remove_something('#',$pix_array_topleft_icon[$i]['bgcolor']).');'; ?>
                            "
                            <?php if( isset($pix_array_topleft_icon[$i]['text']) && $pix_array_topleft_icon[$i]['text']!='' ) { echo 'data-tip="'.stripslashes($pix_array_topleft_icon[$i]['text']).'"'; } ?>

                            <?php if(isset($pix_array_topleft_icon[$i]['sidebar']) && $pix_array_topleft_icon[$i]['sidebar']!='') echo ' data-sidebar="toggle_left_'.$i.$pix_array_topleft_icon[$i]['sidebar'].'"'; ?>
                            > 

                            <?php if(isset($pix_array_topleft_icon[$i]['url']) && $pix_array_topleft_icon[$i]['url']!='') { 
                                echo '<a href="'.$pix_array_topleft_icon[$i]['url'].'"';
                                    if(!isset($pix_array_topleft_icon[$i]['target']) || $pix_array_topleft_icon[$i]['target']!='true') {
                                        echo 'target="_blank"'; 
                                    } ?>
                            <?php echo '>'; } ?>

                            <i class="<?php if(isset($pix_array_topleft_icon[$i]['icon']) && $pix_array_topleft_icon[$i]['icon']!='') echo $pix_array_topleft_icon[$i]['icon']; ?>"></i>

                            <?php if(isset($pix_array_topleft_icon[$i]['url']) && $pix_array_topleft_icon[$i]['url']!='') echo '</a>'; ?>

                        </div>
                            <?php $i++;
                        } 
                    ?>
                    </div>
                </div>

                <div class="click_aside click_aside_right">
                    <div>
                    <?php
                        $pix_array_topright_icon = pix_get_option('pix_array_topright_icon_'); 
                        $i = 0;
                        while($i<count($pix_array_topright_icon)) { ?>
                        <div style="
                            <?php if(isset($pix_array_topright_icon[$i]['color']) && $pix_array_topright_icon[$i]['color']!='') echo 'color:'.$pix_array_topright_icon[$i]['color'].';'; ?>
                            <?php if(isset($pix_array_topright_icon[$i]['bgcolor']) && $pix_array_topright_icon[$i]['bgcolor']!='') echo 'background:rgba('.hex2RGB($pix_array_topright_icon[$i]['bgcolor'],true).','.pix_get_option('pix_floatingicons_position_bgcolor_opacity').');    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.pix_hex_opacity(pix_get_option('pix_floatingicons_position_bgcolor_opacity')) . pix_remove_something('#',$pix_array_topright_icon[$i]['bgcolor']).', endColorstr=#'. pix_hex_opacity(pix_get_option('pix_floatingicons_position_bgcolor_opacity')) . pix_remove_something('#',$pix_array_topright_icon[$i]['bgcolor']).');'; ?>
                            "
                            <?php if( isset($pix_array_topright_icon[$i]['text']) && $pix_array_topright_icon[$i]['text']!='' ) { echo 'data-tip="'.stripslashes($pix_array_topright_icon[$i]['text']).'"'; } ?>

                            <?php if(isset($pix_array_topright_icon[$i]['sidebar']) && $pix_array_topright_icon[$i]['sidebar']!='') echo ' data-sidebar="toggle_right_'.$i.$pix_array_topright_icon[$i]['sidebar'].'"'; ?>
                            > 

                            <?php if(isset($pix_array_topright_icon[$i]['url']) && $pix_array_topright_icon[$i]['url']!='') { 
                                echo '<a href="'.$pix_array_topright_icon[$i]['url'].'"';
                                    if(!isset($pix_array_topright_icon[$i]['target']) || $pix_array_topright_icon[$i]['target']!='true') {
                                        echo 'target="_blank"'; 
                                    } ?>
                            <?php echo '>'; } ?>

                            <i class="<?php if(isset($pix_array_topright_icon[$i]['icon']) && $pix_array_topright_icon[$i]['icon']!='') echo $pix_array_topright_icon[$i]['icon']; ?>"></i>

                            <?php if(isset($pix_array_topright_icon[$i]['url']) && $pix_array_topright_icon[$i]['url']!='') echo '</a>'; ?>

                        </div>
                            <?php $i++;
                        } 
                    ?>
                    </div>
                 </div><!-- .click_aside_right -->        
    
       </header>