<?php

function price_table_manage(){
	global $options;
	if ($_GET['page']=='price_table_manage') { 
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Price tables: <small>manage your table</small>
                <div class="yellow_button button_floating">
                	<div class="button_left"></div>
                	<div class="button_right"></div>
                	<div class="button_body"></div>
                	<a href="#" class="save_changes">save changes</a>
                </div>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
            
                <div class="pix_price_tables_clone pix_slide pix_column clone">
                    <div class="field_wrap">
                        <div class="pix_slide_move pix_col_move"><span></span></div>
                        <label class="inner_label padding_right">Highlighted:</label>
                        <div class="alignleft wrap_check">
                            <input 
                                type="checkbox" 
                                name="<?php echo 'pix_array_your_tables_'.$_GET['table'].'[columns][Nvariable][highlighted]'; ?>"
                                class="clone_check"
                                value="true">
                        </div>
                        
                        <a href="#" class="price_table_toggle toggle_close">close all</a>
                    
                        <a href="#" class="price_table_toggle toggle_open">expand all</a>
                        
                        <div class="pix_cells">
                                                    
                            <div class="clear"></div>

                            <a href="#" class="pix_add_table_cell button">add a cell</a>
    
                        </div><!-- .pix_cells -->
                        
                    </div>
                    
                    <div class="pix_remove_column">
                        <a href="#">&nbsp;</a>
                    </div>
                </div><!-- .pix_slide.clone -->
                
            
                <div class="pix_price_tables_clone pix_slide pix_cell clone">
                    <div class="field_wrap">
                        <div class="pix_slide_move pix_cell_move"><span></span></div>
                        <label class="inner_label">Type:</label>

                        <select name="<?php echo 'pix_array_your_tables_'.$_GET['table'].'[columns][Colvariable][cell][Nvariable][type]'; ?>" class="clone_select">
                            <option value="header_start">Start of the header</option>
                            <option value="header_end">End of the header</option>
                            <option value="title">Title</option>
                            <option value="price">Price</option>
                            <option value="subtitle">Subtitle</option>
                            <option value="small">Small</option>
                            <option value="checked">Checked field</option>
                            <option value="unchecked">Unchecked field</option>
                            <option value="text">Text</option>
                            <option value="button">Button</option>
                        </select>
                                                    
                        <div class="block_url">
                            <div class="clear less_space"></div>
                            
                            <label class="inner_label">URL:</label>
                            <input type="text" name="<?php echo 'pix_array_your_tables_'.$_GET['table'].'[columns][Colvariable][cell][Nvariable][url]'; ?>" value="">
                            
                                <label class="inner_label width_auto">Target _blank:</label>
                                <div class="alignleft wrap_check">
                                <input 
                                    type="checkbox" 
                                    name="<?php echo 'pix_array_your_tables_'.$_GET['table'].'[columns][Colvariable][cell][Nvariable][blank]'; ?>"
                                    class="clone_check"
                                    value="true">
                            </div>
                        </div><!-- .block_url -->
                            
                        <div class="block_textarea">
                            <div class="clear less_space"></div>
                            
                            <label class="inner_label">Content:</label>
                            <textarea name="<?php echo 'pix_array_your_tables_'.$_GET['table'].'[columns][Colvariable][cell][Nvariable][content]'; ?>"></textarea>
                        </div><!-- .block_textarea -->
                    </div>
                    
                    <div class="pix_remove_cell">
                        <a href="#">&nbsp;</a>
                    </div>

                </div><!-- .pix_slide -->

				<?php if (pix_esc_option('pix_allow_ajax')=='true') { ?>
                <form action="/" class="dynamic_form ajax_form">
                <?php } else { ?>
                <form method="post" class="dynamic_form" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
                <?php } ?>   
 
                    <div class="pix_slides pix_price_tables">

<?php $pix_array_your_tables = pix_get_option(stripslashes('pix_array_your_tables_'.$_GET['table'])); ?>         
<?php
	$get_price_table_column = $pix_array_your_tables['columns'];
	$i = 0;
	$count = count($get_price_table_column);
	if($count==0){
		$count = 1;
	}
	while ($i<$count) { ?>
					<div class="pix_slide pix_column">
						<div class="field_wrap">
							<div class="pix_slide_move pix_col_move"><span></span></div>
							<label for="pix_array_your_tables_<?php echo $_GET['table']; ?>[columns][<?php echo $i; ?>][highlighted]" class="inner_label padding_right">Highlighted:</label>
							<div class="alignleft wrap_check">
								<input 
									type="checkbox" 
									name="<?php echo 'pix_array_your_tables_'.$_GET['table'].'[columns]['.$i.'][highlighted]'; ?>"
									value="true"
									<?php if ( isset($get_contact_form_field[$i]['highlighted']) && $get_contact_form_field[$i]['highlighted']=='true' ) echo ' checked'; ?>>
							</div>
                            
                            <a href="#" class="price_table_toggle toggle_close">close all</a>
                        
                            <a href="#" class="price_table_toggle toggle_open">expand all</a>
                        
                            <div class="pix_cells">
                        
                                <div class="clear"></div>
			<?php
                $get_price_table_cell = $get_price_table_column[$i]['cell'];
                $i2 = 0;
                $count2 = count($get_price_table_cell);
                if($count2==0){
                    $count2 = 1;
                }
                while ($i2<$count2) { ?>
                                <div class="pix_slide pix_cell">
                                    <div class="field_wrap">
                                        <div class="pix_slide_move pix_cell_move"><span></span></div>
                                        <label for="pix_array_your_tables_<?php echo $_GET['table']; ?>[columns][<?php echo $i; ?>][cell][<?php echo $i2; ?>][type]" class="inner_label">Type:</label>
            
                                        <select name="<?php echo 'pix_array_your_tables_'.$_GET['table'].'[columns]['.$i.'][cell]['.$i2.'][type]'; ?>">
                                            <option value="header_start" <?php selected( $get_price_table_column[$i]['cell'][$i2]['type'], 'header_start'); ?>>Start of the header</option>
                                            <option value="header_end" <?php selected( $get_price_table_column[$i]['cell'][$i2]['type'], 'header_end'); ?>>End of the header</option>
                                            <option value="title" <?php selected( $get_price_table_column[$i]['cell'][$i2]['type'], 'title'); ?>>Title</option>
                                            <option value="price" <?php selected( $get_price_table_column[$i]['cell'][$i2]['type'], 'price'); ?>>Price</option>
                                            <option value="subtitle" <?php selected( $get_price_table_column[$i]['cell'][$i2]['type'], 'subtitle'); ?>>Subtitle</option>
                                            <option value="small" <?php selected( $get_price_table_column[$i]['cell'][$i2]['type'], 'small'); ?>>Small</option>
                                            <option value="checked" <?php selected( $get_price_table_column[$i]['cell'][$i2]['type'], 'checked'); ?>>Checked field</option>
                                            <option value="unchecked" <?php selected( $get_price_table_column[$i]['cell'][$i2]['type'], 'unchecked'); ?>>Unchecked field</option>
                                            <option value="text" <?php selected( $get_price_table_column[$i]['cell'][$i2]['type'], 'text'); ?>>Text</option>
                                            <option value="button" <?php selected( $get_price_table_column[$i]['cell'][$i2]['type'], 'button'); ?>>Button</option>
                                        </select>
                                                                    
                                        <div class="block_url">
                                            <div class="clear less_space"></div>
                                            
                                            <label for="pix_array_your_tables_<?php echo $_GET['table']; ?>[columns][<?php echo $i; ?>][cell][<?php echo $i2; ?>][url]" class="inner_label">URL:</label>
                                            <input type="text" name="<?php echo 'pix_array_your_tables_'.$_GET['table'].'[columns]['.$i.'][cell]['.$i2.'][url]'; ?>" value="<?php echo stripslashes($get_price_table_column[$i]['cell'][$i2]['url']); ?>">


                                            <label for="pix_array_your_tables_<?php echo $_GET['table']; ?>[columns][<?php echo $i; ?>][cell][<?php echo $i2; ?>][blank]" class="inner_label width_auto">Target _blank:</label>
                                            <div class="alignleft wrap_check">
                                                <input 
                                                    type="checkbox" 
                                                    name="<?php echo 'pix_array_your_tables_'.$_GET['table'].'[columns]['.$i.'][cell]['.$i2.'][blank]'; ?>"
                                                    value="true"
													<?php checked( $get_price_table_column[$i]['cell'][$i2]['blank'], 'true'); ?>>
                                            </div>
                                        </div><!-- .block_url -->
                                            
                                        <div class="block_textarea">
                                            <div class="clear less_space"></div>
                                            <label for="pix_array_your_tables_<?php echo $_GET['table']; ?>[columns][<?php echo $i; ?>][cell][<?php echo $i2; ?>][content]" class="inner_label">Content:</label>
                                            <textarea name="<?php echo 'pix_array_your_tables_'.$_GET['table'].'[columns]['.$i.'][cell]['.$i2.'][content]'; ?>"><?php echo stripslashes($get_price_table_column[$i]['cell'][$i2]['content']); ?></textarea>
                                        </div><!-- .block_textarea -->
                                    </div>
                                    
                                    <div class="pix_remove_cell">
                                        <a href="#">&nbsp;</a>
                                    </div>
                              
                                </div><!-- .pix_slide -->
               <?php
                $i2++; }
            ?>
                                
                                <a href="#" class="pix_add_table_cell button">add a cell</a>
        
                            </div><!-- .pix_cells -->
                            
						</div>

						<div class="pix_remove_column">
							<a href="#">&nbsp;</a>
						</div>
				  
					</div><!-- .pix_slide -->
   <?php
	$i++; }
?>

                    <div class="grey_button pix_add_table_column">
                        <div class="button_left"></div>
                        <div class="button_right"></div>
                        <div class="button_body"></div>
                        <a href="#">add a column</a>
                    </div>
                </div>
                <input type="hidden" name="action" value="data_save">
                <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
                <input type="submit" class="hidden_div" value="">
            </form><!-- .dynamic_form -->


        </div><!-- #forte_content_content -->
</div>


<?php }
} ?>