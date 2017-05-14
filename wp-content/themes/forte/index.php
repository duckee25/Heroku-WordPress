<?php
/**
 * @package WordPress
 * @subpackage Forte
 */

get_header();

global $layout,
    $page_template,
    $page_sidebar,
    $pagenavi,
    $pix_sort,
    $the_post_type,
    $pix_order,
    $pix_sort_by_tag,
    $pix_linkto,
    $pix_titles,
    $pix_more,
    $pix_like,
    $pix_comments,
    $pix_meta;

$the_post_type = 'post';

$page_ID = !is_front_page() ? get_option('page_for_posts') : pix_get_option('pix_posts_page_id');

$hide_title = get_post_meta( $page_ID, 'pix_pag_opts_hidetitle', true );

$page_template = get_post_meta( $page_ID, '_wp_page_template', true );

$page_sidebar = get_post_meta( $page_ID, 'pix_sidebar_select', true );

$pagenavi = pix_get_option('pix_posts_page_pagenavi');

$side_alignment =  pix_get_option('pix_aside_position') == 'right' ? 'left' : 'right';

$layout =  pix_get_option('pix_posts_page_layout');

$pix_sort = pix_get_option('pix_posts_page_filter');

$pix_order = pix_get_option('pix_posts_page_order');

$pix_sort_by_tag = pix_get_option('pix_posts_page_sort');

$pix_linkto = pix_get_option('pix_posts_page_linkto');

$pix_titles = pix_get_option('pix_posts_page_titles'); 

$pix_more = pix_get_option('pix_posts_page_more');

$pix_like = pix_get_option('pix_posts_page_like');

$pix_comments = pix_get_option('pix_posts_page_comments');

$pix_meta = pix_get_option('pix_posts_page_meta');

?>
        
        
        <div id="content">
                   
            <article>

                <?php if ( !isset($hide_title) || $hide_title != 'on' ) { ?>
                    <section class="pix_divider firstDivider" <?php echo pix_wide_bg(); ?>>

                        <div class="pix_column pix_column_990">
    						
                            <h1><span <?php echo pix_title_lines_bg(); ?>><?php echo get_the_title($page_ID); ?></span></h1>

                            <?php $pix_pag_opts_subtitle = get_post_meta( $page_ID, 'pix_pag_opts_subtitle', true );

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