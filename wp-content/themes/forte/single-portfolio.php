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
$layout = pix_get_option('pix_portfolio_related_layout');
$pix_titles = pix_get_option('pix_portfolio_related_titles');
$excerpt_lines = pix_get_option('pix_portfolio_related_excerpt_length');
$pix_more = pix_get_option('pix_portfolio_related_more');

$hide_title = get_post_meta( get_the_id(), 'pix_pag_opts_hidetitle', true );

$side_alignment =  pix_get_option('pix_aside_position') == 'right' ? 'left' : 'right';

$page_builder = get_post_meta( get_the_id(), 'pix_editor_field', true );
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
                            if (pix_get_option('pix_date_portfolio')=='true') {
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
                
                <div class="pix_column pix_column_990">
                    <div class="pix_column pix_column_730 align<?php echo $side_alignment; ?>">
                    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    
                        <?php
                            if (pix_get_option('pix_portfolio_featured_image')!='true' && has_post_thumbnail() && get_post_meta( $post->ID, 'pix_display_feat_image', true ) == 'on' || get_post_meta( $post->ID, 'pix_display_feat_image', true ) == '') {
                                $postTh = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                                $thumb_size = 'three_columns';
                                
                                $colorbox = get_post_meta( $post->ID, 'pix_colorbox_feat_image', true );
                                if ( !isset($colorbox) || $colorbox == 'on' || $colorbox == '' ) {
                                    echo '<a href="'. $postTh[0] .'" id="pix_featured_image" data-rel="pix_featured_image">';
                                }
                                
                                echo get_the_post_thumbnail(get_the_id(), $thumb_size);
                                
                                if ( !isset($colorbox) || $colorbox == 'on' || $colorbox == '' ) {
                                    echo '</a>';
                                }
                            }

                            $the_content = get_the_content(); $the_content = apply_filters('the_content', $the_content);  
                            $pix_hidden_field = get_post_meta( get_the_id(), 'pix_hidden_field', true );
                            
                            if ( $page_builder=='on' ) {
                                echo '<section>
                                    <div class="pix_column pix_column_730">
                                        <div class="pix_column pix_column_730 alignleft">';                            
                            }
                            if ( isset($pix_hidden_field) ) {
                                echo '<div class="clear"></div>'.$the_content;
                            } else {
                                echo '<div class="clear"></div><div class="pix_column pix_column_730 alignleft">'.$the_content.'</div>';
                            }
                            if ( $page_builder=='on' ) {
                                        echo '</div> <!-- .pix_column.pix_column_730.alignleft -->                       
                                    </div> <!-- .pix_column.pix_column_730 -->
                                </section>';                            
                            }
                        ?>
    
                    <?php endwhile; ?>

                        <?php if (pix_get_option('pix_endmeta_portfolio')=='true' || (function_exists('printLikes') && pix_get_option('pix_like_portfolio')=='true')) { ?>

                            <div class="postmetadata">
                                <?php if (pix_get_option('pix_endmeta_portfolio')=='true') {
                                    if ( get_the_term_list( $post->ID, 'gallery', '', ', ', '' ) != '' ) { echo '<span class="list-categories"><i class="icon-map-marker"></i> '.get_the_term_list( $post->ID, 'gallery', '', ', ', '' ).'</span>'; }
                                    
                                    if( get_the_term_list( $post->ID, 'portfolio_tag', '', ', ', '' ) != '' ) { ?><span class="list-tags"><i class="icon-tag"></i> <?php echo get_the_term_list( $post->ID, 'portfolio_tag', '', ', ', '' ); ?></span><?php }
                                    }

                                    if (function_exists('printLikes') && pix_get_option('pix_like_posts')=='true') {
                                        echo '<span class="like-this">';
                                            printLikes(get_the_ID());
                                        echo '</span>';
                                    }
                                ?>
                            </div><!-- .postmetadata -->
                        <?php }
                        edit_post_link( __( 'Edit', 'forte' ), '<span class="edit-link">', '</span>' );
                        ?>

                        <?php if ( ( pix_get_option('pix_share_portfolio') == 'true' && get_post_meta( $post->ID, 'pix_pag_opts_share', true ) == '' ) || get_post_meta( $post->ID, 'pix_pag_opts_share', true ) == 'display' ) { ?>
                            <div id="pix_social_share">
                                <div id="fb-root" class="alignleft"></div>
                                <script>(function(d, s, id) {
                                  var js, fjs = d.getElementsByTagName(s)[0];
                                  if (d.getElementById(id)) return;
                                  js = d.createElement(s); js.id = id;
                                  js.src = "//connect.facebook.net/<?php $lang = WPLANG; if(!empty($lang)) { echo $lang; } else { echo 'en_US'; } ?>/all.js#xfbml=1";
                                  fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                                <div class="fb-like alignleft" data-href="<?php echo pix_current_page(); ?>" data-send="true" data-layout="button_count" data-width="150" data-show-faces="true"></div>
                                <div class="alignleft pix_gplus" id="gplus_sharing_icon">
                                    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
                                    <div class="g-plusone" data-size="medium" data-count="true"></div>
                                </div>
                                <div class="alignleft" id="twitter_sharing_icon">
                                    <script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
                                    <a href="//twitter.com/share" class="twitter-share-button">Tweet</a>
                                </div>
                                <div class="alignleft pix_linkedin" id="linkedin_sharing_icon">
                                    <script src="//platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-counter="right"></script>
                                </div>                                
                                <?php if (has_post_thumbnail()) { ?>
                                <div class="alignleft" id="pinterest_sharing_icon">
                                    <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
                                    <a href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $postTh[0]; ?>&description=<?php the_title(); ?>" class="pin-it-button letmebe pix_social_share" count-layout="horizontal" data-width="800"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
                                </div>
                                <?php } ?>
                                
                                
                                <div class="clear"></div>   
                                    
                            </div><!-- #pix_social_share -->
                        <?php } ?>
                            
                        <?php
                            global $post;
                            $prev = get_previous_post(); 
                            $next = get_next_post(); 
 
                            if ( pix_get_option('pix_prevnext_portfolio') == 'true' && ( $prev!='' || $next!='' )) {

                                if($prev!='') $prevID = $prev->ID;
                                if($next!='') $nextID = $next->ID;
                            ?>
                            <hr class="double">

                            <table id="pix_prev_next_post">
                                <tr class="hideme">
                                    <td class="even_td">
                                        <?php if($prev!='') { ?><a href="<?php echo get_permalink($prevID); ?>"><i class="icon-chevron-left"></i> <?php echo get_the_title($prevID); ?></a><?php } ?>
                                    </td>
                                    <td class="even_td textalignright">
                                        <?php if($next!='') { ?><a href="<?php echo get_permalink($nextID); ?>"><?php echo get_the_title($nextID); ?> <i class="icon-chevron-right"></i></a><?php } ?>
                                    </td>
                                </tr>
                                <tr class="showme">
                                    <td>
                                        <?php if($prev!='') { ?><a href="<?php echo get_permalink($prevID); ?>"><i class="icon-chevron-left"></i> <?php echo get_the_title($prevID); ?></a><?php } ?>
                                    </td>
                                </tr>
                                <tr class="showme">
                                    <td>
                                        <?php if($next!='') { ?><a href="<?php echo get_permalink($nextID); ?>"><?php echo get_the_title($nextID); ?> <i class="icon-chevron-right"></i></a><?php } ?>
                                    </td>
                                </tr>
                            </table>
                        <?php } ?>

                        <?php if ( get_the_author_meta( 'description' ) && pix_get_option('pix_author_portfolio') == 'true' ) : ?>
                        <hr class="double">

                        <div class="author-info">
                            <div id="author-info">
                                <?php echo $dotted; ?>
                                <div id="author-description">
                                    <div id="author-avatar">
                                        <?php echo get_avatar( get_the_author_meta( 'user_email' ), 50 ); ?>
                                    </div><!-- #author-avatar -->
                                    <h6><?php printf( __( 'About the author: %s', 'forte' ), '<a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a>' ); ?></h6><?php the_author_meta( 'description' ); ?>
                                </div><!-- #author-description  -->
                            </div><!-- #author-info -->
                        </div><!-- .author-info -->
                        <?php endif; ?>



                        <?php
                            if ( pix_get_option('pix_portfolio_related_ppp') != '0' ) {

                                $orig_post = $post;

                                global $post, $post_type, $query_related;
                                $tags = get_the_terms( $post->ID, 'portfolio_tag' ); 

                                $count = 0;

                                $post_array = array();
                                
                                if ($tags) {
                                    foreach($tags as $tag) {

                                        $args2 = array(
                                            'portfolio_tag' => $tag->slug,
                                            'post_type' => 'portfolio',
                                            'post__not_in' => array($orig_post->ID),
                                            'posts_per_page'=> -1,
                                            'ignore_sticky_posts' => 1
                                        );

                                        $query_related_2 = new wp_query( $args2 );

                                        if ( $query_related_2->have_posts() ) {

                                            while ($query_related_2->have_posts()) : $query_related_2->the_post();
                                            
                                                array_push( $post_array, $query_related_2->post->ID );

                                            endwhile;
                                        }
                                            }

                                $post_array = array_unique($post_array);
                                wp_reset_postdata();

                                if ( !empty($post_array) ) {
                                    $args = array(
                                        'post_type' => 'portfolio',
                                        'orderby' => 'rand',
                                        'post__in' => $post_array,
                                        'posts_per_page'=> pix_get_option('pix_portfolio_related_ppp'),
                                        'orderby' => 'rand',
                                        'ignore_sticky_posts' => 1
                                    );

                                    $query_related = new wp_query( $args );
                                    if( $query_related->have_posts() ) {
                                    echo '<hr class="double"><div id="related_posts">                        
                                    <h4 class="heading_flag">'.__('Related items','forte').'</h4><div class="related_wrapper">';

                                        if ( locate_template( 'loop-related.php' ) )
                                           locate_template( 'loop-related.php', true, false );

                                    echo '
                                    </div>
                                    </div><!-- #related_posts -->';
                                    }
                                    }
                                    $post = $orig_post;
                                    wp_reset_postdata();
                                } ?>
                        <?php } ?>

                    <?php comments_template( '', true ); ?>

                    </div><!-- .pix_column_730 -->
                    
                    <?php get_sidebar(); ?>
                </div><!-- .pix_column_990 -->

            </article>
            
        </div><!-- #content -->
        


<?php get_footer(); ?>