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
    $pix_titles,
    $pix_more,
    $pix_like;

    $side_alignment =  pix_get_option('pix_aside_position') == 'right' ? 'left' : 'right';

    $the_post_type = get_post_type();

    $layout = pix_get_option('pix_portfolio_archive_layout');
    $page_template = pix_get_option('pix_portfolio_archive_template');
    $page_sidebar =  pix_get_option('pix_portfolio_archive_sidebar');
    $posts_per_page = pix_get_option('pix_portfolio_archive_ppp');
    $excerpt_lines = pix_get_option('pix_portfolio_archive_excerpt_length');
    $pagenavi = pix_get_option('pix_portfolio_archive_pagenavi');
    $pix_sort = pix_get_option('pix_portfolio_archive_filter');
    $pix_order = pix_get_option('pix_portfolio_archive_order');
    $pix_sort_by_tag = pix_get_option('pix_portfolio_archive_sort');
    $pix_linkto = pix_get_option('pix_portfolio_archive_linkto');
    $pix_titles = pix_get_option('pix_portfolio_archive_titles'); 
    $pix_more = pix_get_option('pix_portfolio_archive_more'); 
    $pix_like = pix_get_option('pix_portfolio_archive_like'); 
?>
        
        
        <div id="content">
                   
            <article>

                <section class="pix_divider firstDivider">

                    <div class="pix_column pix_column_990">

                    <h1><span><?php single_cat_title(); ?></span></h1>
                    <?php if ( term_description() != '' ) { ?>
                        <p class="h1_subtitle"><span><?php echo term_description(); ?></span></p>
                    <?php } ?>

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