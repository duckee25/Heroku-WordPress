<?php
/**
 * @package WordPress
 * @subpackage Forte
 */

get_header();

?>
        
        
        <div id="content">
                   
            <article>
                <section class="pix_divider firstDivider">
                    <div class="pix_column pix_column_990">
                            <h1><span><?php _e( pix_get_option('pix_404_title'), 'forte' ); ?></span></h1>
							<?php if ( pix_esc_option('pix_404_subtitle') != '' ) { ?>
                            	<p class="h1_subtitle"><span><?php _e( pix_get_option('pix_404_subtitle'), 'forte' ); ?></span></p>
							<?php } ?>
                        
                    </div><!-- .pix_column_990 -->
                </section>
                
                <section id="pix_breadcrumbs">
                    <div class="pix_column pix_column_990">
						<?php pix_breadcrumbs(); ?>
                        
                    </div><!-- .pix_column_990 -->
                </section>
                
                <div class="clearone"></div>
                
                <section>
                    <div class="pix_column pix_column_990">
                        <?php if ( pix_get_option('pix_404_template') != 'widepage' ) { ?><div class="pix_column pix_column_730 alignleft"><?php } ?>                        
    						<?php echo html5autop(do_shortcode(pix_get_option('pix_404_content'))); ?>
                        <?php if ( pix_get_option('pix_404_template') != 'widepage' ) { ?>
                            </div>
                            <?php get_sidebar(); ?>
                        <?php } ?>
                    </div><!-- .pix_column_990 -->
                </section>

            </article>
            
        </div><!-- #content -->
        


<?php get_footer(); ?>