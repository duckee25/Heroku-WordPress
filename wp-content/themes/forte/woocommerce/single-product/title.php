<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

$hide_title = get_post_meta( get_the_id(), 'pix_pag_opts_hidetitle', true );
$page_template = get_post_meta( get_the_id(), 'pix_page_template_select', true );
$side_alignment =  pix_get_option('pix_aside_position') == 'right' ? 'left' : 'right';
?>
                <?php if ( !isset($hide_title) || $hide_title != 'on' ) { ?>
                    <section class="pix_divider firstDivider">
                        <div class="pix_column pix_column_990">
    						
                                <h1 itemprop="name" class="product_title entry-title"><span><?php the_title(); ?></span></h1>
                                <?php $pix_pag_opts_subtitle = get_post_meta( get_the_id(), 'pix_pag_opts_subtitle', true );
                                    if ( $pix_pag_opts_subtitle != '' ) { ?>
                                        <p class="h1_subtitle"><span><?php echo $pix_pag_opts_subtitle; ?></span></p>
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
                    
                <?php
                    if ( !isset($page_template) || $page_template=='default' ) { ?>
                        <div class="pix_column pix_column_730 align<?php echo $side_alignment; ?>">
                    <?php }
                ?>  



                		
