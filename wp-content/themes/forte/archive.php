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
    $pix_sort,
    $pagenavi,
    $excerpt_lines,
    $the_post_type,
    $pix_order,
    $pix_sort_by_tag,
    $pix_linkto,
    $pix_titles,
    $pix_more,
    $pix_like,
    $pix_comments,
    $pix_meta;

$the_post_type = get_post_type();

$page_ID = get_option('page_for_posts');

$hide_title = get_post_meta( $page_ID, 'pix_pag_opts_hidetitle', true );

$catID = get_query_var('cat');
$pix_array_category = pix_get_option('pix_array_category_'.$catID);

if ( is_category() ) {
    $pagenavi = isset($pix_array_category['pagenavi']) ? $pix_array_category['pagenavi'] : '';
    $page_template = isset($pix_array_category['template']) ? $pix_array_category['template'] : '';
    $page_sidebar = isset($pix_array_category['sidebar']) ? $pix_array_category['sidebar'] : '';
    $layout = isset($pix_array_category['layout']) ? $pix_array_category['layout'] : '';
    $excerpt_lines = isset($pix_array_category['length']) ? $pix_array_category['length'] : '';
    $posts_per_page = (isset($pix_array_category['ppp']) && $pix_array_category['ppp']!='') ? $pix_array_category['ppp'] : get_option('posts_per_page');
    $pix_sort = isset($pix_array_category['filter']) ? $pix_array_category['filter'] : 'true';
    $pix_order = isset($pix_array_category['order']) ? $pix_array_category['order'] : 'true';
    $pix_sort_by_tag = isset($pix_array_category['sort']) ? $pix_array_category['sort'] : 'true';
    $pix_linkto = isset($pix_array_category['linkto']) ? $pix_array_category['linkto'] : 'true';
    $pix_titles = isset($pix_array_category['titles']) ? $pix_array_category['titles'] : 'true';
    $pix_more = isset($pix_array_category['more']) ? $pix_array_category['more'] : 'true';
    $pix_like = isset($pix_array_category['like']) ? $pix_array_category['like'] : 'true';
    $pix_comments = isset($pix_array_category['comments']) ? $pix_array_category['comments'] : 'true';
    $pix_meta = isset($pix_array_category['meta']) ? $pix_array_category['meta'] : 'true';
} elseif ( is_archive() ) {
    $pagenavi = pix_get_option( 'pix_archive_pagenavi' );
    $page_template = pix_get_option( 'pix_archive_template' );
    $page_sidebar = pix_get_option( 'pix_archive_sidebar' );
    $layout = pix_get_option('pix_archive_layout');
    $excerpt_lines = pix_get_option('pix_archive_excerpt_length');
    $posts_per_page = pix_get_option('pix_archive_ppp') != '' ? pix_get_option('pix_archive_ppp') : get_option('posts_per_page');
    $pix_sort = pix_get_option('pix_archive_filter');;
    $pix_order = pix_get_option('pix_archive_order');
    $pix_sort_by_tag = pix_get_option('pix_archive_sort');
    $pix_linkto = pix_get_option('pix_archive_linkto');
    $pix_titles = pix_get_option('pix_archive_titles');
    $pix_more = pix_get_option('pix_archive_more');
    $pix_like = pix_get_option('pix_archive_like');
    $pix_comments = pix_get_option('pix_archive_comments');
    $pix_meta = pix_get_option('pix_archive_meta');
}

$side_alignment =  pix_get_option('pix_aside_position') == 'right' ? 'left' : 'right';

?>
        
        
        <div id="content">
                   
            <article>

                <section class="pix_divider firstDivider">

                    <div class="pix_column pix_column_990">

                    	<h1><span>
							<?php if ( is_day() ) { ?>
                                <?php printf( __( 'Daily Archives: %s', 'forte' ), '<span>' . get_the_date() . '</span>' ); ?>
                            <?php } elseif ( is_month() ) { ?>
                                <?php printf( __( 'Monthly Archives: %s', 'forte' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
                            <?php } elseif ( is_year() ) { ?>
                                <?php printf( __( 'Yearly Archives: %s', 'forte' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
                            <?php } elseif ( is_category() ) { ?>
                                <?php printf( __( '%s', 'forte' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
                            <?php } elseif ( is_tag() ) { ?>
                                <?php printf( __( '%s', 'forte' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
                            <?php } elseif ( is_author() ) { ?>
                                <?php printf( __( 'Author Archives: %s', 'forte' ), '<span class="vcard">' . get_the_author() . '</span>' ); ?>
                            <?php } else { ?>
                                <?php _e( 'Blog Archives', 'forte' ); ?>
                            <?php } ?>
                        </span></h1>
                
						<?php if(is_category() && category_description()!='' ) {
							echo '<p class="h1_subtitle"><span>'.category_description().'</span></p>';
                        } ?>

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
                                case 'sixth':
                                case 'sixth_bis':
                                case 'seventh':
                                case 'seventh_bis':
                                case 'eighth':
                                case 'eighth_bis':
                                    if ( locate_template( 'loop-first.php' ) )
                                       locate_template( 'loop-first.php', true, false );
                                    break;
                                case 'ninth':
                                case 'tenth':
                                    if ( locate_template( 'loop-second.php' ) )
                                       locate_template( 'loop-second.php', true, false );
                                    break;
                                default:
                                    if ( locate_template( 'loop-third.php' ) )
                                       locate_template( 'loop-third.php', true, false );
                            }
                        ?>


                    

            </article>
            
        </div><!-- #content -->
        


<?php get_footer(); ?>