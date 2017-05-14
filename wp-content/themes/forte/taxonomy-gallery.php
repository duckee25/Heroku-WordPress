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
    $pix_like,
    $pix_comments;

    $side_alignment =  pix_get_option('pix_aside_position') == 'right' ? 'left' : 'right';

    $the_post_type = get_post_type();

    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $termID = $term->term_id;
    $pix_array_gallery = pix_get_option('pix_array_gallery_'.$termID);

    $layout = (!isset($pix_array_gallery['layout'])) ? 'sixth' : $pix_array_gallery['layout'];
    $excerpt_lines = $pix_array_gallery['length'];
    $page_sidebar = $pix_array_gallery['sidebar'];
    $page_template = (!isset($pix_array_gallery['template'])) ? 'widepage' : $pix_array_gallery['template'];
    $posts_per_page = (!isset($pix_array_gallery['ppp'])) ? '12' : $pix_array_gallery['ppp'];
    $pix_sort = (!isset($pix_array_gallery['filter'])) ? 'true' : $pix_array_gallery['filter'];
    $pix_order = (!isset($pix_array_gallery['order'])) ? 'true' : $pix_array_gallery['order'];
    $pix_sort_by_tag = (!isset($pix_array_gallery['sort'])) ? 'true' : $pix_array_gallery['sort'];
    $pix_linkto = (!isset($pix_array_gallery['linkto'])) ? 'colorbox' : $pix_array_gallery['linkto'];
    $pagenavi = (!isset($pix_array_gallery['pagenavi'])) ? 'infinite' : $pix_array_gallery['pagenavi'];
    $pix_titles = (!isset($pix_array_gallery['title'])) ? 'true' : $pix_array_gallery['title'];
    $pix_more = (!isset($pix_array_gallery['more'])) ? 'true' : $pix_array_gallery['more']; 
    $pix_like = (!isset($pix_array_gallery['like'])) ? 'true' : $pix_array_gallery['like'];
    $pix_comments = (!isset($pix_array_gallery['comments'])) ? 'true' : $pix_array_gallery['comments'];; 


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