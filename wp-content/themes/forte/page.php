<?php
/**
 * @package WordPress
 * @subpackage Forte
**/

get_header();

$hide_title = get_post_meta( get_the_id(), 'pix_pag_opts_hidetitle', true );

$side_alignment =  pix_get_option('pix_aside_position') == 'right' ? 'left' : 'right';

$page_builder = get_post_meta( get_the_id(), 'pix_editor_field', true );
?>
        
        
        <div id="content">
                   
            <article>
                <?php if ( !isset($hide_title) || $hide_title != 'on' ) { ?>
                    <section class="pix_divider firstDivider" <?php echo pix_wide_bg(); ?>>
                        <div class="pix_column pix_column_990">
    						
                                <h1><span <?php echo pix_title_lines_bg(); ?>><?php the_title(); ?></span></h1>
                                <?php $pix_pag_opts_subtitle = get_post_meta( get_the_id(), 'pix_pag_opts_subtitle', true );
                                    if ( $pix_pag_opts_subtitle != '' ) { ?>
                                        <p class="h1_subtitle"><span <?php echo pix_title_lines_bg(); ?>><?php echo $pix_pag_opts_subtitle; ?></span></p>
                                <?php } ?>
                            
                        </div><!-- .pix_column_990 -->
                    </section>
                    
                    <section id="pix_breadcrumbs">
                        <div class="pix_column pix_column_990">
                                <?php pix_breadcrumbs(); ?>                        
                        </div><!-- .pix_column_990 -->
                    </section>
                    
                    <div class="clearone"></div>
                <?php } ?>
                
                <div class="pix_column pix_column_990">
                	<div class="pix_column pix_column_730 align<?php echo $side_alignment; ?>">
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    
                        <?php
                            global $multipage, $numpages;
                            $paged = (get_query_var('page')) ? get_query_var('page') : 1;

                            if ( ($multipage && $page != 1) || $page_builder=='on' ) {
                                echo '<section>
                                    <div class="pix_column pix_column_730">
                                        <div class="pix_column pix_column_730 alignleft">';                            
                            }

                            $the_content = get_the_content(); $the_content = apply_filters('the_content', $the_content);  
                            $pix_hidden_field = get_post_meta( get_the_id(), 'pix_hidden_field', true );
                            
                            if ( isset($pix_hidden_field) ) {
                                echo $the_content;
                            } else {
                                echo '<div class="pix_column pix_column_730 alignleft">'.$the_content.'</div>';
                            }

                            wp_link_pages(array(
                                'before' => '<div class="page-link">',
                                'after' => '</div>',
                                'pagelink' => '<span>%</span>'
                                )
                            );

                            if ( ($multipage && $page == 1) || $page_builder=='on' ) {
                                        echo '</div> <!-- .pix_column.pix_column_730.alignleft -->                       
                                    </div> <!-- .pix_column.pix_column_730 -->
                                </section>';                            
                            }

                        ?>
                    <div class="clear"></div>
    
                    <?php endwhile; ?>

                        <?php
                        edit_post_link( __( 'Edit', 'forte' ), '<span class="edit-link">', '</span>' );

                        ?>

                        <?php if ( ( 
                                pix_get_option('pix_share_pages') == 'true' 
                                &&
                                get_post_meta( $post->ID, 'pix_pag_opts_share', true ) == '' 
                                && !pix_is_cart() && !pix_is_checkout() && !pix_is_account_page() 
                                ) 
                                || 
                                get_post_meta( $post->ID, 'pix_pag_opts_share', true ) == 'display' ) { ?>
                            <div id="pix_social_share">
                                <div id="fb-root" class="alignleft"></div>
                                <script>(function(d, s, id) {
                                  var js, fjs = d.getElementsByTagName(s)[0];
                                  if (d.getElementById(id)) return;
                                  js = d.createElement(s); js.id = id;
                                  js.src = "//connect.facebook.net/<?php $lang = get_locale(); if(!empty($lang)) { echo $lang; } else { echo 'en_US'; } ?>/all.js#xfbml=1";
                                  fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                                <div class="fb-like alignleft" data-href="<?php echo pix_current_page(); ?>" data-send="true" data-layout="button_count" data-width="150" data-show-faces="true"></div>
                                <div class="alignleft pix_gplus" id="gplus_sharing_icon">
                                    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
                                    <div class="g-plusone" data-size="medium" data-count="true"></div>
                                </div>
                                <div class="alignleft" id="twitter_sharing_icon">
                                    <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
                                    <a href="http://twitter.com/share" class="twitter-share-button">Tweet</a>
                                </div>
                                <div class="alignleft pix_linkedin" id="linkedin_sharing_icon">
                                    <script src="//platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-counter="right"></script>
                                </div>                                
                                <?php if (has_post_thumbnail()) { ?>
                                <div class="alignleft" id="pinterest_sharing_icon">
                                    <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
                                    <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $postTh[0]; ?>&description=<?php the_title(); ?>" class="pin-it-button letmebe pix_social_share" count-layout="horizontal" data-width="800"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
                                </div>
                                <?php } ?>
                                
                                
                                <div class="clear"></div>   
                                    
                            </div><!-- #pix_social_share -->
                        <?php } ?>

                    <?php if (pix_get_option('pix_comments_on_page')=='true') { comments_template( '', true ); } ?>

                    </div><!-- .pix_column_730 -->
                    
					<?php get_sidebar(); ?>
                </div><!-- .pix_column_990 -->

            </article>
            
        </div><!-- #content -->
        


<?php get_footer(); ?>