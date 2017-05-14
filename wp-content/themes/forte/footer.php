<?php if ( pix_get_option ('pix_footer_widgets') == 'true' ) { ?>
        <footer>
            <div class="pix_column pix_column_990">
            

<?php 
    if ( pix_get_option('pix_second_footer') == '' && pix_get_option('pix_third_footer') == '' && pix_get_option('pix_fourth_footer') == '' ) {
        $first_class ='pix_column_990';
    } elseif ( pix_get_option('pix_second_footer') == '' && pix_get_option('pix_third_footer') == '' && pix_get_option('pix_fourth_footer') != '' ) {
        $first_class ='pix_column_730 alignleft';
    } elseif ( pix_get_option('pix_second_footer') == '' && pix_get_option('pix_third_footer') != '' ) {
        $first_class ='pix_column_470 alignleft';
    } else {
        $first_class ='pix_column_210 alignleft';
    }
?>
            <div class="<?php echo $first_class; ?>">
                <?php dynamic_sidebar( pix_get_option('pix_first_footer') ); ?>
            </div>
            
<?php 
    if ( pix_get_option('pix_second_footer') != '' && pix_get_option('pix_third_footer') == '' && pix_get_option('pix_fourth_footer') == '' ) {
        $second_class ='pix_column_730 alignright';
    } elseif ( pix_get_option('pix_second_footer') != '' && pix_get_option('pix_third_footer') == '' && pix_get_option('pix_fourth_footer') != '' ) {
        $second_class ='pix_column_470 alignleft';
    } elseif ( pix_get_option('pix_second_footer') != '' && pix_get_option('pix_third_footer') != '' ) {
        $second_class ='pix_column_210 alignleft';
    }
    
    if ( pix_get_option('pix_second_footer') != '' ) {
?>
            <div class="<?php echo $second_class; ?> alignleft">
                <?php dynamic_sidebar( pix_get_option('pix_second_footer') ); ?>
            </div>
            
<?php } ?>
            
<?php 
    if ( pix_get_option('pix_third_footer') != '' && pix_get_option('pix_fourth_footer') == '' ) {
        $third_class ='pix_column_470 alignright';
    } elseif ( pix_get_option('pix_third_footer') != '' && pix_get_option('pix_fourth_footer') != '' ) {
        $third_class ='pix_column_210 alignleft';
    }
    
    if ( pix_get_option('pix_third_footer') != '' ) {
?>
            <div class="<?php echo $third_class; ?> alignleft">
                <?php dynamic_sidebar( pix_get_option('pix_third_footer') ); ?>
            </div>
            
<?php } ?>
            
<?php 
    if ( pix_get_option('pix_fourth_footer') != '' ) {
?>
            <div class="pix_column_210 alignright">
                <?php dynamic_sidebar( pix_get_option('pix_fourth_footer') ); ?>
            </div>
            
<?php } ?>

            </div>
        </footer>
<?php } ?>

<?php if ( pix_get_option('pix_footer_credits')!='0' ) { ?>
        <div id="pix_credits">
        	<div class="pix_column_990 pix_column">
            
                <div class="alignleft">
                    <?php echo pix_get_option('pix_credits_left'); ?>
                </div><!-- .alignleft -->
    
                <div class="alignright">
                    <?php echo pix_get_option('pix_credits_right'); ?>
                </div><!-- .alignright -->
            </div>
        </div><!-- #pix_credits -->
<?php } ?>


    </div><!-- #content_wrap -->
    
    <aside class="alignleft toggleAside">
    
    	<div class="close_aside_left">
        	<i class="icon-remove"></i>
        </div>

   	  <div class="aside_wrap">
        
            <div class="aside_content pix_column pix_column_210">
            
                <?php
                    $pix_array_topleft_icon = pix_get_option('pix_array_topleft_icon_'); 
                    $i = 0;
                    while($i<count($pix_array_topleft_icon)) { ?>

                        <?php if(isset($pix_array_topleft_icon[$i]['sidebar']) && $pix_array_topleft_icon[$i]['sidebar']!='') { ?>

                            <div id="toggle_left_<?php echo $i.$pix_array_topleft_icon[$i]['sidebar']; ?>" class="toggle_aside_by_id">
                                <?php dynamic_sidebar( pix_selected_sidebar($pix_array_topleft_icon[$i]['sidebar']) ); ?>
                            </div>

                        <?php } ?>

                        <?php $i++;
                    } 
                ?>

            </div>
            
        </div>
        
        <div class="shadow"></div>
    
    </aside><!-- .alignleft -->
    
    <aside class="alignright toggleAside">
    
    	<div class="close_aside_right">
        	<i class="icon-remove"></i>
        </div>
   	  <div class="aside_wrap">
        
            <div class="aside_content pix_column pix_column_210">
            
                <?php
                    $pix_array_topright_icon = pix_get_option('pix_array_topright_icon_'); 
                    $i = 0;
                    while($i<count($pix_array_topright_icon)) { ?>

                        <?php if(isset($pix_array_topright_icon[$i]['sidebar']) && $pix_array_topright_icon[$i]['sidebar']!='') { ?>

                            <div id="toggle_right_<?php echo $i.$pix_array_topright_icon[$i]['sidebar']; ?>" class="toggle_aside_by_id">
                                <?php dynamic_sidebar( pix_selected_sidebar($pix_array_topright_icon[$i]['sidebar']) ); ?>
                            </div>

                        <?php } ?>

                        <?php $i++;
                    } 
                ?>

            </div>
            
        </div>
        
        <div class="shadow"></div>
    
    </aside><!-- .alignright -->
    
    <div class="click_scroll_up">
        <i class="icon-go-up"></i>
    </div>

    <div id="pix_loader"><span></span></div>

   <?php
	
		echo htmlspecialchars_decode(pix_get_option('pix_append_footer'),ENT_QUOTES);

        wp_footer();
		
    ?>
</div><!-- .super_wrap -->
</body>
</html>