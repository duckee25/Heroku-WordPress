<?php
/**
 * @package WordPress
 * @subpackage Forte
**/

get_header();

global $layout,
    $pix_titles,
    $excerpt_lines,
    $pix_more;
$layout = pix_get_option('pix_post_related_layout');
$pix_titles = pix_get_option('pix_post_related_titles');
$excerpt_lines = pix_get_option('pix_post_related_excerpt_length');
$pix_more = pix_get_option('pix_post_related_more');

$hide_title = get_post_meta( get_the_id(), 'pix_pag_opts_hidetitle', true );

?>
        
        
        <div id="content">
                   
            <article>
            <?php if ( !isset($hide_title) || $hide_title != 'on' ) { ?>
                <section class="pix_divider firstDivider">
                    <div class="pix_column pix_column_990">
                            <h1><span><?php the_title(); ?></span></h1>
                            <?php $pix_pag_opts_subtitle = get_post_meta( get_the_id(), 'pix_pag_opts_subtitle', true );
                                if ( $pix_pag_opts_subtitle != '' ) { ?>
                                    <p class="h1_subtitle"><span><?php echo $pix_pag_opts_subtitle; ?></span></p>
                            <?php }
                            if (pix_get_option('pix_date_posts')=='true') {
                                echo '<span class="pix_meta_date"><span><i class="icon-time"></i> '.get_the_date().'</span></span>'.PHP_EOL;
                            } ?>
                        
                    </div><!-- .pix_column_990 -->
                </section>
                
                <section id="pix_breadcrumbs">
                    <div class="pix_column pix_column_990">
                        <?php if ( !isset($hide_title) || $hide_title != 'on' ) { ?>
                            <?php pix_breadcrumbs(); ?>
                        <?php } ?>
                        
                    </div><!-- .pix_column_990 -->
                </section>
                
                <div class="clearone"></div>
            <?php } ?>
                
<?php
    /**
     * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
     * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
     */
    $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
    foreach ( $attachments as $k => $attachment ) {
        if ( $attachment->ID == $post->ID )
            break;
    }
    $k++;
    // If there is more than 1 attachment in a gallery
    if ( count( $attachments ) > 1 ) {
        if ( isset( $attachments[ $k ] ) )
            // get the URL of the next image attachment
            $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
        else
            // or get the URL of the first image attachment
            $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
    } else {
        // or, if there's only 1 image, get the URL of the image
        $next_attachment_url = wp_get_attachment_url();
    }
?>
                <div class="pix_column pix_column_990">
                    <div class="pix_column pix_column_990 alignleft">
                        <?php echo wp_get_attachment_image( $post->ID, 'four_columns' ); ?>

                        <?php if ( ( $pix_loop_in_page != true && pix_get_option('pix_share_pages') == 'true' && get_post_meta( get_the_id(), 'pix_pag_opts_share', true ) == '' ) || get_post_meta( get_the_id(), 'pix_pag_opts_share', true ) == 'display' ) { ?>
                            <div class="clear"></div>
                        
                            <div id="pix_social_share">
                                <div id="fb-root" class="alignleft"></div>
                                <script>(function(d, s, id) {
                                  var js, fjs = d.getElementsByTagName(s)[0];
                                  if (d.getElementById(id)) return;
                                  js = d.createElement(s); js.id = id;
                                  js.src = "//connect.facebook.net/<?php $lang = get_locale(); if(!empty($lang)) { echo $lang; } else { echo ''; } ?>/all.js#xfbml=1";
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
                                    <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $postTh[0]; ?>&description=<?php the_title(); ?>" class="pin-it-button letmebe pix_social_share" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
                                </div>
                                <?php } ?>
                                
                                
                                <div class="clear"></div>   
                                    
                            </div><!-- #pix_social_share -->
                        <?php } ?>


                    </div><!-- .pix_column_990 -->
                    
                </div><!-- .pix_column_990 -->

            </article>
            
        </div><!-- #content -->
        


<?php get_footer(); ?>