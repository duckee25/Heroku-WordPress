<?php
/**
 * @package WordPress
 * @subpackage Forte
 */

get_header();

global $layout, 
    $page_template, 
    $page_sidebar, 
    $posts_per_page, 
    $excerpt_lines,
    $pix_sort, 
    $pix_order,
    $pix_sort_by_tag,
    $the_post_type,
    $pagenavi,
    $pix_linkto,
    $pix_comments,
    $pix_titles,
    $pix_more,
    $pix_like,
    $pix_meta,
    $pix_price;

    $side_alignment = pix_get_option('pix_aside_position') == 'right' ? 'left' : 'right';

    //$the_post_type = get_post_type();


    switch($_GET['post_type']) {
        case 'portfolio':
            $type = 'portfolio_archive';
            break;
        default:
            $type = 'archive';
    }


    $layout = have_posts() ? pix_get_option('pix_'.$type.'_layout') : 'first';
    $page_template = have_posts() ? pix_get_option('pix_'.$type.'_template') : pix_get_option('pix_search_template');
    $page_sidebar = have_posts() ? pix_get_option('pix_'.$type.'_sidebar') : pix_get_option('pix_search_sidebar');
    $posts_per_page = pix_get_option('pix_'.$type.'_ppp');
    $excerpt_lines = pix_get_option('pix_'.$type.'_excerpt_length');
    $pagenavi = pix_get_option('pix_'.$type.'_pagenavi');
    $pix_sort = have_posts() ? pix_get_option('pix_'.$type.'_filter') : '0';
    $pix_order = have_posts() ? pix_get_option('pix_'.$type.'_order') : '0';
    $pix_sort_by_tag = '0';
    $pix_linkto = pix_get_option('pix_'.$type.'_linkto');
    $pix_titles = pix_get_option('pix_'.$type.'_titles'); 
    $pix_more = pix_get_option('pix_'.$type.'_more'); 
    $pix_like = pix_get_option('pix_'.$type.'_like'); 
    $pix_meta = pix_get_option('pix_'.$type.'_meta');
    $pix_comments = pix_get_option('pix_'.$type.'_comments');
?>
        
        
        <div id="content">
                   
            <article>

                <section class="pix_divider firstDivider">

                    <div class="pix_column pix_column_990">

                        <h1><span>
                            <?php printf( __( 'Search Results for: %s', 'forte' ), get_search_query() ); ?>
                        </span></h1>

                    </div><!-- .pix_column_990 -->
                </section>
                
                <section id="pix_breadcrumbs">

                    <div class="pix_column pix_column_990">

                        <?php pix_breadcrumbs(); ?>  

                    </div><!-- .pix_column_990 -->

                </section>
                
                <div class="clearone"></div>
            

                        <?php
                            switch ( $layout ) {
                                case 'default':
                                case 'first':
                                case 'second':
                                case 'third':
                                case 'fourth':
                                case 'fifth':
                                    if ( locate_template( 'loop-third.php' ) )
                                       locate_template( 'loop-third.php', true, false );
                                    break;
                                case 'ninth':
                                case 'tenth':
                                    if ( locate_template( 'loop-second.php' ) )
                                       locate_template( 'loop-second.php', true, false );
                                    break;
                                default:
                                    if ( locate_template( 'loop-first.php' ) )
                                       locate_template( 'loop-first.php', true, false );
                            }
                        ?>


                    

            </article>
            
        </div><!-- #content -->
        


<?php get_footer(); ?>