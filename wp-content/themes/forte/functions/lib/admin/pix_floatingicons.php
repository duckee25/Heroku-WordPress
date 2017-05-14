<?php

function front_floatingicons(){
    global $options, $woocommerce_en;
	if ($_GET['page']=='front_floatingicons') { 

    $get_sidebar_options = sidebar_generator_pix::get_sidebars();
                    
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	General: <small>top bar</small>
                <div class="yellow_button button_floating">
                	<div class="button_left"></div>
                	<div class="button_right"></div>
                	<div class="button_body"></div>
                	<a href="#" class="save_changes">save changes</a>
                </div>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
            <?php if (pix_esc_option('pix_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form">
            <?php } else { ?>
            <form method="post" class="dynamic_form" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>

                <div class="tip_info_wrap visible_tip">
                	<small class="tip_info">What are side icons? <a href="http://www.pixedelic.com/forte_support_images/floating_icons.jpg" class="colorbox">Click here</a></small>

                </div>
                <div class="clear"></div>

                <label for="pix_floatingicons_position_bgcolor_opacity">Opacity of the background color:</label>
                <div class="slider_div opacity">
                    <div class="field_wrap"><input type="text" name="pix_floatingicons_position_bgcolor_opacity" value="<?php echo pix_esc_option('pix_floatingicons_position_bgcolor_opacity'); ?>"></div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->

                <div class="clear"></div>

               	<label>Icons on the left side</label>
                <?php
					$pix_array_topleft_icon = pix_get_option('pix_array_topleft_icon_'); 
				?>
                    <input type="hidden" style="display:none" name="pix_array_topleft_icon_[0]" value="">

                <div class="pix_slides">
                    <div class="pix_slide clone" id="pix_array_topleft_icon_Nvariable">
                        <div class="field_wrap">
                            <div class="pix_slide_move"><span></span></div>

                            <label class="inner_label">Icon:</label>
                            <span class="pix_select_icon pix-icon-item">
                                <span class="pix_image_thumb"><i></i></span>
                                <input type="hidden" class="pix-icon-item" data-name="pix_array_topleft_icon_[Nvariable][icon]">
                                <span class="grey_button pix_select_icon_button">
                                    <span class="button_left"></span>
                                    <span class="button_right"></span>
                                    <span class="button_body"></span>
                                    <a href="#">select</a>
                                </span>
                            </span><!-- .pix_select_icon -->
                            

                            <label class="inner_label">Link URL:</label>
                            <input data-name="pix_array_topleft_icon_[Nvariable][url]" type="text" value="" class="pix_icon_url">
                            <div class="clear less_space"></div>

                            <div class="clear"></div>

                            <label class="inner_label">Open in the same window:</label>
                            <div class="alignleft wrap_check">
                                <input 
                                    type="checkbox" 
                                    data-name="pix_array_topleft_icon_[Nvariable][target]"
                                    class="clone_check"
                                    value="true">
                            </div>

                            <div class="clear"></div>

                            <label class="inner_label">Background color:</label>
                            <div class="pix_color_picker">
                                <input data-name="pix_array_topleft_icon_[Nvariable][bgcolor]" type="text" value="#666666">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="clear less_space"></div>

                            <label class="inner_label">Icon color:</label>
                            <div class="pix_color_picker">
                                <input data-name="pix_array_topleft_icon_[Nvariable][color]" type="text" value="#eaeaea">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="clear less_space"></div>
                
                            <label class="inner_label">Sidebar on click:</label>
                            <select data-name="pix_array_topleft_icon_[Nvariable][sidebar]" class="clone_select">
                                <option value="">None</option>
                                <?php
                                    foreach ($get_sidebar_options as $sidebar) {
                                        echo '<option value="'.$sidebar.'">'.$sidebar.'</option>';
                                    }
                                ?>
                            </select>

                            <div class="clear less_space"></div>

                            <label class="inner_label">Tooltip text:</label>
                            <textarea data-name="pix_array_topleft_icon_[Nvariable][text]"></textarea>
                        </div><!-- .field_wrap -->
                        <div class="pix_remove_slide">
                            <a href="#">&nbsp;</a>
                        </div>
                    </div><!-- .pix_slide.clone -->

                        <?php 

							$i = 0;
                            if ( $pix_array_topleft_icon[$i]!='' ) {
    							while($i<count($pix_array_topleft_icon)) {
						?>

                    <div class="pix_slide" id="pix_array_topleft_icon_<?php echo $i; ?>">
                        <div class="field_wrap">
                            <div class="pix_slide_move"><span></span></div>



                            <label class="inner_label">Icon:</label>
                                <span class="pix_select_icon pix-icon-item">
                                    <span class="pix_image_thumb"><i class="<?php if(isset($pix_array_topleft_icon[$i]['icon'])) { echo $pix_array_topleft_icon[$i]['icon']; } ?>"></i></span>
                                    <input type="hidden" class="pix-icon-item" name="pix_array_topleft_icon_[<?php echo $i; ?>][icon]" value="<?php if(isset($pix_array_topleft_icon[$i]['icon'])) { echo $pix_array_topleft_icon[$i]['icon']; } ?>">
                                    <span class="grey_button pix_select_icon_button">
                                        <span class="button_left"></span>
                                        <span class="button_right"></span>
                                        <span class="button_body"></span>
                                        <a href="#">select</a>
                                    </span>
                                </span><!-- .pix_select_icon -->
                                

                            <label class="inner_label">Link URL:</label>
                            <input name="pix_array_topleft_icon_[<?php echo $i; ?>][url]" type="text" value="<?php if(isset($pix_array_topleft_icon[$i]['url'])) echo $pix_array_topleft_icon[$i]['url']; ?>" class="pix_icon_url">
                            <div class="clear less_space"></div>

                            <div class="clear"></div>

                            <label class="inner_label">Open in the same window:</label>
                            <div class="alignleft wrap_check">
                                <input 
                                    type="checkbox" 
                                    name="pix_array_topleft_icon_[<?php echo $i; ?>][target]"
                                    <?php if ( isset($pix_array_topleft_icon[$i]['target']) && $pix_array_topleft_icon[$i]['target']=='true' ) echo ' checked'; ?>
                                    value="true">
                            </div>

                            <div class="clear"></div>

                            <label class="inner_label">Background color:</label>
                            <div class="pix_color_picker">
                                <input name="pix_array_topleft_icon_[<?php echo $i; ?>][bgcolor]" type="text" value="<?php if(isset($pix_array_topleft_icon[$i]['bgcolor'])) echo $pix_array_topleft_icon[$i]['bgcolor']; ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>


                            <div class="clear less_space"></div>

                            <label class="inner_label">Icon color:</label>
                            <div class="pix_color_picker">
                                <input name="pix_array_topleft_icon_[<?php echo $i; ?>][color]" type="text" value="<?php if(isset($pix_array_topleft_icon[$i]['color'])) echo $pix_array_topleft_icon[$i]['color']; ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="clear less_space"></div>

                            <label class="inner_label">Sidebar on click:</label>
                            <select name="pix_array_topleft_icon_[<?php echo $i; ?>][sidebar]">
                                <option value="">None</option>
                                <?php
                                    foreach ($get_sidebar_options as $sidebar) { ?>
                                        <option value="<?php echo $sidebar; ?>"<?php if($pix_array_topleft_icon[$i]['sidebar']==$sidebar) { ?> selected="selected"<?php } ?>><?php echo $sidebar; ?></option>
                                    <?php }
                                ?>
                            </select>

                            <div class="clear less_space"></div>


                            <label class="inner_label">Tooltip text:</label>
                            <textarea name="pix_array_topleft_icon_[<?php echo $i; ?>][text]"><?php if(isset($pix_array_topleft_icon[$i]['text'])) echo stripslashes($pix_array_topleft_icon[$i]['text']); ?></textarea>
                        </div><!-- .field_wrap -->
                        <div class="pix_remove_slide">
                            <a href="#">&nbsp;</a>
                        </div>
                    </div><!-- .pix_slide.clone -->

							<?php	$i++;
							} 
                        }
						?>
                        
                    <div class="grey_button pix_add_slide">
                        <div class="button_left"></div>
                        <div class="button_right"></div>
                        <div class="button_body"></div>
                        <a href="#">add an icon</a>
                    </div>
                </div><!-- .pix_slides -->

                <div class="clear"></div>
                <div class="tip_info_wrap">
                    <small class="tip_info">
                    	<strong>Icon:</strong> choose the icon you prefer<br>
                        <strong>Link URL:</strong> type the entire URL of the page (included <strong>http://</strong>) you wish to link your icon to.<br>
                        <strong>Background color:</strong> just type the color in hexadecimal format or pick it from the color palette.<br>
                        <strong>Icon color:</strong> same as above.<br>
                        <strong>Sidebar on click:</strong> if you select a sidebar when you'll click the icon a sliding column will open. The column will contain the widgets you put in it on &quot;Appearance &rarr; Widgets&quot;. To create a sidebar go to &quot;Forte admin panel &rarr; Sidebars&quot;. <strong>N.B.:</strong> this event will overwrite the other ones, so you can't have a link in the link URL field too<br>
                        <strong>Tooltip text:</strong> type here some descriptive, short text to display in a tooltip on &quot;hover&quot; event.
                    </small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->

            
            	<label>Icons on the right side</label>
                <?php
					$pix_array_topright_icon = pix_get_option('pix_array_topright_icon_'); 
				?>
                    <input type="hidden" style="display:none" name="pix_array_topright_icon_[0]" value="">

                <div class="pix_slides">
                    <div class="pix_slide clone" id="pix_array_topright_icon_Nvariable">
                        <div class="field_wrap">
                            <div class="pix_slide_move"><span></span></div>


                            <label class="inner_label">Icon:</label>
                                <span class="pix_select_icon pix-icon-item">
                                    <span class="pix_image_thumb"><i></i></span>
                                    <input type="hidden" class="pix-icon-item" data-name="pix_array_topright_icon_[Nvariable][icon]">
                                    <span class="grey_button pix_select_icon_button">
                                        <span class="button_left"></span>
                                        <span class="button_right"></span>
                                        <span class="button_body"></span>
                                        <a href="#">select</a>
                                    </span>
                                </span><!-- .pix_select_icon -->
                                


                            <label class="inner_label">Link URL:</label>
                            <input data-name="pix_array_topright_icon_[Nvariable][url]" type="text" value="" class="pix_icon_url">

                            <div class="clear"></div>

                            <label class="inner_label">Open in the same window:</label>
                            <div class="alignleft wrap_check">
                                <input 
                                    type="checkbox" 
                                    data-name="pix_array_topright_icon_[Nvariable][target]"
                                    class="clone_check"
                                    value="true">
                            </div>

                            <div class="clear"></div>

                            <label class="inner_label">Background color:</label>
                            <div class="pix_color_picker">
                                <input data-name="pix_array_topright_icon_[Nvariable][bgcolor]" type="text" value="#666666">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>


                            <div class="clear less_space"></div>


                            <label class="inner_label">Icon color:</label>
                            <div class="pix_color_picker">
                                <input data-name="pix_array_topright_icon_[Nvariable][color]" type="text" value="#eaeaea">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>

                            <div class="clear less_space"></div>

                            <label class="inner_label">Sidebar on click:</label>
                            <select data-name="pix_array_topright_icon_[Nvariable][sidebar]" class="clone_select">
                                <option value="">None</option>
                                <?php
                                    foreach ($get_sidebar_options as $sidebar) {
                                        echo '<option value="'.$sidebar.'">'.$sidebar.'</option>';
                                    }
                                ?>
                            </select>

                            <div class="clear less_space"></div>

                            <label class="inner_label">Tooltip text:</label>
                            <textarea data-name="pix_array_topright_icon_[Nvariable][text]"></textarea>
                        </div><!-- .field_wrap -->
                        <div class="pix_remove_slide">
                            <a href="#">&nbsp;</a>
                        </div>
                    </div><!-- .pix_slide.clone -->

                        <?php 

							$i = 0;

                            if ( $pix_array_topright_icon[$i]!='' ) {
    							while($i<count($pix_array_topright_icon)) {
						 ?>


                    <div class="pix_slide" id="pix_array_topright_icon_<?php echo $i; ?>">
                        <div class="field_wrap">
                            <div class="pix_slide_move"><span></span></div>



                            <label class="inner_label">Icon:</label>
                                <span class="pix_select_icon pix-icon-item">
                                    <span class="pix_image_thumb"><i class="<?php if(isset($pix_array_topright_icon[$i]['icon'])) { echo $pix_array_topright_icon[$i]['icon']; } ?>"></i></span>
                                    <input type="hidden" class="pix-icon-item" name="pix_array_topright_icon_[<?php echo $i; ?>][icon]" value="<?php if(isset($pix_array_topright_icon[$i]['icon'])) { echo $pix_array_topright_icon[$i]['icon']; } ?>">
                                    <span class="grey_button pix_select_icon_button">
                                        <span class="button_left"></span>
                                        <span class="button_right"></span>
                                        <span class="button_body"></span>
                                        <a href="#">select</a>
                                    </span>
                                </span><!-- .pix_select_icon -->





                            <label class="inner_label">Link URL:</label>
                            <input name="pix_array_topright_icon_[<?php echo $i; ?>][url]" type="text" value="<?php if(isset($pix_array_topright_icon[$i]['url'])) echo $pix_array_topright_icon[$i]['url']; ?>" class="pix_icon_url">
                            <div class="clear less_space"></div>

                            <div class="clear"></div>

                            <label class="inner_label">Open in the same window:</label>
                            <div class="alignleft wrap_check">
                                <input 
                                    type="checkbox" 
                                    name="pix_array_topright_icon_[<?php echo $i; ?>][target]"
                                    <?php if ( isset($pix_array_topright_icon[$i]['target']) && $pix_array_topright_icon[$i]['target']=='true' ) echo ' checked'; ?>
                                    value="true">
                            </div>

                            <div class="clear"></div>

                            <label class="inner_label">Background color:</label>
                            <div class="pix_color_picker">
                                <input name="pix_array_topright_icon_[<?php echo $i; ?>][bgcolor]" type="text" value="<?php if(isset($pix_array_topright_icon[$i]['bgcolor'])) echo $pix_array_topright_icon[$i]['bgcolor']; ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>


                            <div class="clear less_space"></div>

                            <label class="inner_label">Icon color:</label>
                            <div class="pix_color_picker">
                                <input name="pix_array_topright_icon_[<?php echo $i; ?>][color]" type="text" value="<?php if(isset($pix_array_topright_icon[$i]['color'])) echo $pix_array_topright_icon[$i]['color']; ?>">
                                <div class="pix_palette"></div>
                                <div class="colorpicker"></div>
                            </div>


                            <div class="clear less_space"></div>


                            <label class="inner_label">Sidebar on click:</label>
                            <select name="pix_array_topright_icon_[<?php echo $i; ?>][sidebar]">
                                <option value="">None</option>
                                <?php
                                    foreach ($get_sidebar_options as $sidebar) { ?>
                                        <option value="<?php echo $sidebar; ?>"<?php if(isset($pix_array_topright_icon[$i]['sidebar']) && $pix_array_topright_icon[$i]['sidebar']==$sidebar) { ?> selected="selected"<?php } ?>><?php echo $sidebar; ?></option>
                                    <?php }
                                ?>
                            </select>

                            <div class="clear less_space"></div>

                            <label class="inner_label">Tooltip text:</label>
                            <textarea name="pix_array_topright_icon_[<?php echo $i; ?>][text]"><?php if(isset($pix_array_topright_icon[$i]['text'])) echo stripslashes($pix_array_topright_icon[$i]['text']); ?></textarea>
                        </div><!-- .field_wrap -->
                        <div class="pix_remove_slide">
                            <a href="#">&nbsp;</a>
                        </div>
                    </div><!-- .pix_slide.clone -->

							<?php	$i++;
							} 
                        }
						?>
                        
                    <div class="grey_button pix_add_slide">
                        <div class="button_left"></div>
                        <div class="button_right"></div>
                        <div class="button_body"></div>
                        <a href="#">add an icon</a>
                    </div>
                </div><!-- .pix_slides -->

                <div class="clear"></div>
                <div class="tip_info_wrap">
                    <small class="tip_info">
                        <strong>Icon:</strong> choose the icon you prefer<br>
                        <strong>Link URL:</strong> type the entire URL of the page (included <strong>http://</strong>) you wish to link your icon to.<br>
                        <strong>Background color:</strong> just type the color in hexadecimal format or pick it from the color palette.<br>
                        <strong>Icon color:</strong> same as above.<br>
                        <strong>Sidebar on click:</strong> if you select a sidebar when you'll click the icon a sliding column will open. The column will contain the widgets you put in it on &quot;Appearance &rarr; Widgets&quot;. To create a sidebar go to &quot;Forte admin panel &rarr; Sidebars&quot;. <strong>N.B.:</strong> this event will overwrite the other ones, so you can't have a link in the link URL field too<br>
                        <strong>Tooltip text:</strong> type here some descriptive, short text to display in a tooltip on &quot;hover&quot; event.
                    </small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
        <input type="hidden" name="action" value="data_save">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
        <input type="submit" class="hidden_div" value="">
            </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>