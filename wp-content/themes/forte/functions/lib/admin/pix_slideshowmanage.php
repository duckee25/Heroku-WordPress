<?php

function slideshow_manage(){
	global $options;
	if ($_GET['page']=='slideshow_manage') { 


		function pix_print_easing( $name, $get_option, $class ) { ?>
            <select name="<?php echo $name; ?>" class="<?php echo $class; ?>">
                <option value="linear" <?php selected ( $get_option, 'linear' ); ?>>linear</option>
                <option value="swing" <?php selected ( $get_option, 'swing' ); ?>>swing</option>
                <option value="easeInQuad" <?php selected ( $get_option, 'easeInQuad' ); ?>>easeInQuad</option>
                <option value="easeOutQuad" <?php selected ( $get_option, 'easeOutQuad' ); ?>>easeOutQuad</option>
                <option value="easeInOutQuad" <?php selected ( $get_option, 'easeInOutQuad' ); ?>>easeInOutQuad</option>
                <option value="easeInCubic" <?php selected ( $get_option, 'easeInCubic' ); ?>>easeInCubic</option>
                <option value="easeOutCubic" <?php selected ( $get_option, 'easeOutCubic' ); ?>>easeOutCubic</option>
                <option value="easeInOutCubic" <?php selected ( $get_option, 'easeInOutCubic' ); ?>>easeInOutCubic</option>
                <option value="easeInQuart" <?php selected ( $get_option, 'easeInQuart' ); ?>>easeInQuart</option>
                <option value="easeOutQuart" <?php selected ( $get_option, 'easeOutQuart' ); ?>>easeOutQuart</option>
                <option value="easeInOutQuart" <?php selected ( $get_option, 'easeInOutQuart' ); ?>>easeInOutQuart</option>
                <option value="easeInQuint" <?php selected ( $get_option, 'easeInQuint' ); ?>>easeInQuint</option>
                <option value="easeOutQuint" <?php selected ( $get_option, 'easeOutQuint' ); ?>>easeOutQuint</option>
                <option value="easeInOutQuint" <?php selected ( $get_option, 'easeInOutQuint' ); ?>>easeInOutQuint</option>
                <option value="easeInSine" <?php selected ( $get_option, 'easeInSine' ); ?>>easeInSine</option>
                <option value="easeOutSine" <?php selected ( $get_option, 'easeOutSine' ); ?>>easeOutSine</option>
                <option value="easeInOutSine" <?php selected ( $get_option, 'easeInOutSine' ); ?>>easeInOutSine</option>
                <option value="easeInExpo" <?php selected ( $get_option, 'easeInExpo' ); ?>>easeInExpo</option>
                <option value="easeOutExpo" <?php selected ( $get_option, 'easeOutExpo' ); ?>>easeOutExpo</option>
                <option value="easeInOutExpo" <?php selected ( $get_option, 'easeInOutExpo' ); ?>>easeInOutExpo</option>
                <option value="easeInCirc" <?php selected ( $get_option, 'easeInCirc' ); ?>>easeInCirc</option>
                <option value="easeOutCirc" <?php selected ( $get_option, 'easeOutCirc' ); ?>>easeOutCirc</option>
                <option value="easeInOutCirc" <?php selected ( $get_option, 'easeInOutCirc' ); ?>>easeInOutCirc</option>
                <option value="easeInElastic" <?php selected ( $get_option, 'easeInElastic' ); ?>>easeInElastic</option>
                <option value="easeOutElastic" <?php selected ( $get_option, 'easeOutElastic' ); ?>>easeOutElastic</option>
                <option value="easeInOutElastic" <?php selected ( $get_option, 'easeInOutElastic' ); ?>>easeInOutElastic</option>
                <option value="easeInBack" <?php selected ( $get_option, 'easeInBack' ); ?>>easeInBack</option>
                <option value="easeOutBack" <?php selected ( $get_option, 'easeOutBack' ); ?>>easeOutBack</option>
                <option value="easeInOutBack" <?php selected ( $get_option, 'easeInOutBack' ); ?>>easeInOutBack</option>
                <option value="easeInBounce" <?php selected ( $get_option, 'easeInBounce' ); ?>>easeInBounce</option>
                <option value="easeOutBounce" <?php selected ( $get_option, 'easeOutBounce' ); ?>>easeOutBounce</option>
                <option value="easeInOutBounce" <?php selected ( $get_option, 'easeInOutBounce' ); ?>>easeInOutBounce</option>
            </select>
        <?php }
                    
?>

<div id="forte_dynamic_tab">
        	<div class="floating_button_bg">
            </div><!-- .floating_button_bg -->
        	<div id="forte_content_title">
            	Slideshows: <small>manage your slideshow</small>
                <div class="yellow_button button_floating">
                	<div class="button_left"></div>
                	<div class="button_right"></div>
                	<div class="button_body"></div>
                	<a href="#" class="save_changes">save changes</a>
                </div>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
            
                <div class="pix_slideshows_clone pix_slide pix_column clone">
                    <div class="field_wrap">
                        <div class="pix_slide_move pix_col_move"><span></span></div>
                        <a href="#" class="slide_composer">compose your slide</a>
                        
                        <a href="#" class="slideshow_toggle toggle_close">close all</a>
                    
                        <a href="#" class="slideshow_toggle toggle_open">expand all</a>
                        
                        <div class="pix_cells">
                                                    
                            <div class="clear"></div>

                            <div class="pix_slide pix_cell pix_bg_slide">
                                <div class="field_wrap">
                                    <label class="inner_label">Type:</label>
            
                                    <select name="<?php echo 'pix_array_your_slideshows_'.$_GET['slideshow'].'[slide][Colvariable][element][Nvariable][type]'; ?>" class="clone_select type_select">
                                        <option data-val="background" value="background">Background</option>
                                    </select>
        
                                    <div class="data-values background">
                                    
                                        <div class="clear less_space"></div>
                                        <label class="inner_label">Image:</label>
                                        <div class="pix_upload_image">
                                            <div class="pix_image_thumb"><img alt="Preview" src="<?php echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; ?>"></div>
                                            <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][backgroundimg]" type="text" value="" data-obj="background">
                                            <div class="grey_button pix_upload_image_button">
                                                <div class="button_left"></div>
                                                <div class="button_right"></div>
                                                <div class="button_body"></div>
                                                <a href="#">upload</a>
                                            </div>
                                        </div><!-- .pix_upload_image -->
        
                                        <div class="clear less_space"></div>
                                        
                                        <label class="inner_label">Color:</label>
                                        <div class="pix_color_picker">
                                            <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][bgcolor]" type="text" value="transparent">
                                            <div class="pix_palette"></div>
                                            <div class="colorpicker"></div>
                                        </div>
        
                                        <div class="clear less_space"></div>
                                        
                                    </div><!-- .background -->
        
                                </div><!-- .field_wrap -->
                                
                            </div><!-- .pix_slide -->
    
                            <a href="#" class="pix_add_slideshow_cell button">add an element</a>
                        </div><!-- .pix_cells -->
                            
                    </div><!-- .field_wrap -->
                    
                    <div class="pix_remove_column">
                        <a href="#">&nbsp;</a>
                    </div>
                </div><!-- .pix_slide.clone -->
                
            
                <div class="pix_slide pix_cell clone">
                    <div class="field_wrap">

                        <div class="pix_slide_move pix_cell_move"><span></span></div>

                        <label class="inner_label">Type:</label>

                        <select name="<?php echo 'pix_array_your_slideshows_'.$_GET['slideshow'].'[slide][Colvariable][element][Nvariable][type]'; ?>" class="clone_select type_select">
                            <option data-val="image" value="image">Image</option>
                            <option data-val="video" value="video">Video</option>
                            <option data-val="html" value="html">HTML code</option>
                            <option data-val="caption" value="caption">Caption</option>
                            <option data-val="link" value="link">100% link</option>
                        </select>
                                                    
                        <div class="data-values link">

                            <div class="clear less_space"></div>

                            <label class="inner_label">URL:</label>
                            
                            <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][link_100]" type="text" value="">
                            
                            <label class="inner_label width_auto">Target _blank:</label>
                            <div class="alignleft wrap_check">
                                <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][target_100]" type="hidden" value="0">
                                <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][target_100]" type="checkbox" value="true" class="clone_check">
                            </div>
                            
                        </div><!-- .link -->
                        
                        <div class="data-values image video caption html">
                        
                            <div class="clear less_space"></div>
                            
                            <div class="data-values video image">
                            
                                <label class="inner_label">Image:</label>
                                
                                <div class="pix_upload_image">
                                    <div class="pix_image_thumb"><img alt="Preview" src="<?php echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; ?>"></div>
                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][simpleimg]" type="text" value="" data-obj="simpleimage">
                                    <div class="grey_button pix_upload_image_button">
                                        <div class="button_left"></div>
                                        <div class="button_right"></div>
                                        <div class="button_body"></div>
                                        <a href="#">upload</a>
                                    </div>
                                </div><!-- .pix_upload_image -->
                                
                            </div>
                            
                            <div class="data-values video">
                                <div class="clear less_space"></div>

                                <small><strong><em>Poster image here above is mandatory, otherwise the slideshow won't work</em></strong></small>

                                <div class="clear less_space"></div>
                                <label class="inner_label">Iframe:</label>
                                <textarea name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][video]" data-obj="video"></textarea>

                                <div class="clear less_space"></div>
                            
                                <label class="width_auto inner_label">Stop the slideshow when click the video starts:</label>
                                <div class="alignleft wrap_check">
                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][videostop]" type="hidden" value="0">
                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][videostop]" type="checkbox" value="true" class="clone_check">
                                </div>
                            
                                <div class="clear less_space"></div>
                            
                                <label class="inner_label">Autoplay:</label>
                                <div class="alignleft wrap_check">
                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][autoplay]" type="hidden" value="0">
                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][autoplay]" type="checkbox" value="true" class="clone_check">
                                </div>
                            
                            </div>
                            

                            <div class="data-values caption">

                                <label class="inner_label">Text:</label>
                                <textarea name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][caption]" data-obj="caption"></textarea>
                            </div><!-- .caption -->
                            

                            <div class="data-values html">

                                <label class="inner_label">Code:</label>
                                <textarea name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][html]" data-obj="html"></textarea>
                            </div><!-- .caption -->
                                            
                            <div class="clear less_space"></div>
                            
                            <div class="clear less_space"></div>
                            
                            <div class="bordering">

                                <a href="#" class="slideel_toggle toggle_close">hide options</a>
                            
                                <a href="#" class="slideel_toggle toggle_open">see more options</a>
                                
                            </div><!-- .bordering -->
            
                            <div class="clear less_space"></div>

                            <div class="slideel_toggle_more_opts">
                        
                               <label class="inner_label">Position:</label>
                                
                                <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][position]" type="text" value="left:0,top:0" data-obj="position" class="get_position">
                                                
                                <label class="inner_label">Fade In:</label>
                                <div class="alignleft wrap_check">
                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][fadein]" type="hidden" value="0">
                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][fadein]" type="checkbox" value="true" class="clone_check">
                                </div>
                                                                        
                                <label class="inner_label">Fade Out:</label>
                                <div class="alignleft wrap_check">
                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][fadeout]" type="hidden" value="0">
                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][fadeout]" type="checkbox" value="true" class="clone_check">
                                </div>
                            
                                <div class="clear less_space"></div>
                            
                                 <div class="data-values caption html">
                                    <div class="bordering">
                                        <label class="width_auto text_left">Size</label>
                                    </div>

                                    <div class="slider_div percent">
                                        <label class="inner_label">Width:</label>
                                        <div class="alignleft">
                                            <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][width]" type="text" value="100" data-obj="width"><div class="alignleft code_wrapper"><code>%</code></div>
                                            <div class="slider_cursor"></div>
                                        </div>
                                    </div><!-- .slider_div -->
                                                
                                    <div class="clear less_space"></div>

                                    <div class="slider_div percent">
                                        <label class="inner_label">Height:</label>
                                        <div class="alignleft">
                                            <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][height]" type="text" value="100" data-obj="height"><div class="alignleft code_wrapper"><code>%</code></div>
                                            <div class="slider_cursor"></div>
                                        </div>
                                    </div><!-- .slider_div -->
                                                
                                    <div class="clear less_space"></div>

                                    <div class="data-values caption">
                                        <div class="slider_div percent">
                                            <label class="inner_label">Font size:</label>
                                            <div class="alignleft">
                                                <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][fontsize]" type="text" value="13" data-obj="fontsize"><div class="alignleft code_wrapper"><code>px</code></div>
                                                <div class="slider_cursor"></div>
                                            </div>
                                        </div><!-- .slider_div -->
                                                    
                                        <div class="clear less_space"></div>
                                    </div>
                                </div>
                                
                                <div class="bordering">
                                    <label class="width_auto text_left">Periods</label>
                                </div>

                                <div class="slider_div milliseconds_2 alignleft">
                                    <label class="inner_label">Delay:</label>
                                    <div class="alignleft">
                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][delay]" type="text" value="0">
                                        <div class="slider_cursor"></div>
                                    </div>
                                </div><!-- .slider_div -->
                                                
                                <div class="clear less_space"></div>
                            
                                <div class="slider_div milliseconds_2 alignleft">
                                    <label class="inner_label">Time:</label>
                                    <div class="alignleft">
                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][time]" type="text" value="800">
                                        <div class="slider_cursor"></div>
                                    </div>
                                </div><!-- .slider_div -->
                                                
                                <div class="data-values image">
                                    <div class="clear less_space"></div>
                                
                                    <div class="bordering">
                                        <label class="width_auto text_left">Link</label>
                                    </div>

                                    <label class="inner_label">URL:</label>
                                    
                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][link]" type="text" value="">
                                    
                                    <label class="inner_label width_auto">Target _blank:</label>
                                    <div class="alignleft wrap_check">
                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][target]" type="hidden" value="0">
                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][target]" type="checkbox" value="true" class="clone_check">
                                    </div>
                                </div>

                                <div class="clear less_space"></div>
                            
                                <div class="bordering">
                                    <label class="width_auto text_left">Effects in and out</label>
                                </div>
                                
                                    <label class="inner_label">In:</label>
                                    <select name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][fxin]" class="clone_select">
                                        <option value="none">None</option>
                                        <option value="fromtop">From top</option>
                                        <option value="frombottom">From bottom</option>
                                        <option value="fromright">From right</option>
                                        <option value="fromleft" selected>From left</option>
                                    </select>
                                    
                                    <div class="alignleft vert_separator"></div>
                                    
                                    <label class="inner_label width_auto">Rotation (in):</label>
                                    <div class="alignleft wrap_check">
                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][rotate_in]" type="hidden" value="0">
                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][rotate_in]" type="checkbox" value="true" class="clone_check">
                                    </div><!-- .wrap_check -->
                            
                                <div class="clear less_space"></div>

                                    <label class="inner_label">Out:</label>
                                    <select name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][fxout]" class="clone_select">
                                        <option value="none">None</option>
                                        <option value="totop">To top</option>
                                        <option value="tobottom">To bottom</option>
                                        <option value="toright">To right</option>
                                        <option value="toleft" selected>To left</option>
                                    </select>

                                    <div class="alignleft vert_separator"></div>
                                    
                                    <label class="inner_label width_auto">Rotation (out):</label>
                                    <div class="alignleft wrap_check">
                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][rotate_out]" type="hidden" value="0">
                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][Colvariable][element][Nvariable][rotate_out]" type="checkbox" value="true" class="clone_check">
                                    </div><!-- .wrap_check -->
                            
                                <div class="clear less_space"></div>
                            
                                <div class="bordering">
                                    <label class="width_auto text_left">Easing in and out</label>
                                </div>
                                
                                <label class="inner_label">In:</label>
                                <?php pix_print_easing( 'pix_array_your_slideshows_'. $_GET['slideshow'] .'[slide][Colvariable][element][Nvariable][easein]', 'easeOutQuad', 'clone_select' ); ?>
                                
                                <label class="inner_label">Out:</label>
                                <?php pix_print_easing( 'pix_array_your_slideshows_'. $_GET['slideshow'] .'[slide][Colvariable][element][Nvariable][easeout]', 'easeInQuad', 'clone_select' ); ?>
                                
                                <div class="clear less_space"></div>
                            
                            </div><!-- .slideel_toggle_more_opts -->
                            
                        </div><!-- .image -->
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
 
<?php $pix_array_your_slideshows = pix_get_option(stripslashes('pix_array_your_slideshows_'.$_GET['slideshow'])); ?>         
                
                <div class="slider_div ratio alignleft">
                    <label class="">Width:</label>
                    <div class="field_wrap">
                        <input class="pix_slideshow_width" name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[width]" type="text" value="<?php echo isset($pix_array_your_slideshows['width']) ? floatval($pix_array_your_slideshows['width']) : '16'; ?>">
                    </div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                
                <div class="alignleft vert_separator"></div>
            
                <div class="slider_div ratio alignleft">
                    <label>Height:</label>
                    <div class="field_wrap">
                        <input class="pix_slideshow_height" name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[height]" type="text" value="<?php echo isset($pix_array_your_slideshows['height']) ? floatval($pix_array_your_slideshows['height']) : '9'; ?>">
                    </div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                
                <div class="clear less_space"></div>
                
                <div class="tip_info_wrap">
                    <small class="tip_info">Width and height serve only to calculate a proportion, the slideshow will fit its container, so its width will be 100% and its height will be calculate on this value</small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
                            
                <div class="slider_div milliseconds alignleft">
                    <label>Time:</label>
                    <div class="field_wrap">
                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[time]" type="text" value="<?php echo isset($pix_array_your_slideshows['time']) ? floatval($pix_array_your_slideshows['time']) : '7000'; ?>">
                    </div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                
                <div class="alignleft vert_separator"></div>
            
                <div class="slider_div milliseconds alignleft">
                    <label>Transition period:</label>
                    <div class="field_wrap">
                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[transperiod]" type="text" value="<?php echo isset($pix_array_your_slideshows['transperiod']) ? floatval($pix_array_your_slideshows['transperiod']) : '1000'; ?>">
                    </div>
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                
                
                <div class="clear less_space"></div>

                <div class="tip_info_wrap">
                    <small class="tip_info">The <strong>time</strong> is the period between a slide and the next one, the <strong>transition period</strong> are the milliseconds that the transition effect of the background slide takes to change from one to the next one</small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->
                
                <div class="alignleft">
                    <label>Display the slideshow only above:</label>
                    <div class="field_wrap"><input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[until]" type="text" value="<?php echo isset($pix_array_your_slideshows['until']) ? $pix_array_your_slideshows['until'] : ''; ?>" data-type="until-field"><div class="alignleft code_wrapper"><code>px</code></div></div>
                </div><!-- .alignleft -->
                
                <div class="alignleft vert_separator"></div>
            
                <div class="alignleft">
                    <label>Display the slideshow only under:</label>
                    <div class="field_wrap"><input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[under]" type="text" value="<?php echo isset($pix_array_your_slideshows['under']) ? $pix_array_your_slideshows['under'] : ''; ?>"><div class="alignleft code_wrapper"><code>px</code></div></div>
                </div><!-- .alignleft -->
                
                <div class="clear less_space"></div>

                <div class="alignleft">
                    <label>Unique image under <input type="text" data-type="until-disabled" value="<?php echo isset($pix_array_your_slideshows['until']) ? $pix_array_your_slideshows['until'] : ''; ?>" class="small_input"> pixels:</label>
                    <div class="field_wrap">
                        <div class="pix_upload_image">
                            <div class="pix_image_thumb"><img alt="Preview" src="<?php if($pix_array_your_slideshows['image']!=''){ echo get_pix_thumb($pix_array_your_slideshows['image'], 'mini_preview'); } else { echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; } ?>"></div>
                            <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[image]" type="text" value="<?php echo $pix_array_your_slideshows['image']; ?>" data-obj="background">
                            <div class="grey_button pix_upload_image_button">
                                <div class="button_left"></div>
                                <div class="button_right"></div>
                                <div class="button_body"></div>
                                <a href="#">upload</a>
                            </div>
                        </div><!-- .pix_upload_image -->
                    </div><!-- .field_wrap -->
                </div><!-- .alignleft -->
                
                <div class="clear less_space"></div>

                <div class="tip_info_wrap">
                    <small class="tip_info">The <strong>image</strong> will be visible instead of the slideshow under the pixels you can read on the label above the field (you can edit that value of course and the value is referred to the entire window)</small>
                </div><!-- .tip_info_wrap -->
                <div class="more_info_wrap">
                    <div class="more_info">
                        <div class="open_info">info</div>
                        <div class="close_info">close</div>
                    </div><!-- .more_info -->
                </div><!-- .more_info_wrap -->

                <div class="clear less_space"></div>
                
                <div class="alignleft">
                    <label class="width_auto">Display the play/pause button:</label>
                    <div class="wrap_check">
                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[playpause]" type="hidden" value="0">
                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[playpause]" type="checkbox" value="true" <?php if ( !isset( $pix_array_your_slideshows['playpause'] ) || $pix_array_your_slideshows['playpause'] == 'true' ) { echo 'checked'; } ?>>
                    </div>
                </div>

                <div class="alignleft vert_separator"></div>

                <div class="alignleft">
                    <label class="width_auto">Display the next/prev buttons:</label>
                    <div class="wrap_check">
                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[prevnext]" type="hidden" value="0">
                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[prevnext]" type="checkbox" value="true" <?php if ( !isset( $pix_array_your_slideshows['prevnext'] ) || $pix_array_your_slideshows['prevnext'] == 'true' ) { echo 'checked'; } ?>>
                    </div>
                </div>

                <div class="alignleft vert_separator"></div>

                <div class="alignleft">
                    <label class="width_auto">Display the pagination bullets:</label>
                    <div class="wrap_check">
                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[pagination]" type="hidden" value="0">
                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[pagination]" type="checkbox" value="true" <?php if ( !isset( $pix_array_your_slideshows['pagination'] ) || $pix_array_your_slideshows['pagination'] == 'true' ) { echo 'checked'; } ?>>
                    </div>
                </div>

                <div class="alignleft">
                    <label class="width_auto">Display the pie loader:</label>
                    <div class="wrap_check">
                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[pie]" type="hidden" value="0">
                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[pie]" type="checkbox" value="true" <?php if ( !isset( $pix_array_your_slideshows['pie'] ) || $pix_array_your_slideshows['pie'] == 'true' ) { echo 'checked'; } ?>>
                    </div>
                </div>

                <div class="alignleft vert_separator"></div>
            
                <div class="alignleft">
                    <label>Auto advance:</label>
                    <div class="wrap_check">
                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[autoadvance]" type="hidden" value="0">
                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[autoadvance]" type="checkbox" value="true" <?php if ( !isset( $pix_array_your_slideshows['autoadvance'] ) || $pix_array_your_slideshows['autoadvance'] == 'true' ) { echo 'checked'; } ?>>
                    </div>
                </div>
                
                <div class="alignleft vert_separator"></div>

                <div class="alignleft">
                    <label class="width_auto">Pause on hover:</label>
                    <div class="wrap_check">
                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[hover]" type="hidden" value="0">
                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[hover]" type="checkbox" value="true" <?php if ( !isset( $pix_array_your_slideshows['hover'] ) || $pix_array_your_slideshows['hover'] == 'true' ) { echo 'checked'; } ?>>
                    </div>
                </div>

                <div class="clear more_space"></div>
                            
                <div class="clear more_space"></div>
                            
            <div class="pix_slides pix_slideshows">

<?php
	$get_slideshow_slide = $pix_array_your_slideshows['slide'];
	$i = 0;
	$count = count($get_slideshow_slide);
	if($count==0){
		$count = 1;
	}
	while ($i<$count) { ?>
					<div class="pix_slide pix_column">
						<div class="field_wrap">
							<div class="pix_slide_move pix_col_move"><span></span></div>
                            <a href="#" class="slide_composer">compose your slide</a>
                            
                            <a href="#" class="slideshow_toggle toggle_close">close all</a>
                        
                            <a href="#" class="slideshow_toggle toggle_open">expand all</a>
                            
                            <div class="clear less_space"></div>

                            <div class="pix_cells">
                        
                                <div class="clear"></div>
			<?php
                $get_slideshow_cell = $get_slideshow_slide[$i]['element'];
                $i2 = 0;
                $count2 = count($get_slideshow_cell);
                if($count2==0){
                    $count2 = 1;
                }
                while ($i2<$count2) { ?>
                                <div class="pix_slide pix_cell<?php if ($i2==0) { ?> pix_bg_slide<?php } ?>">
                                    <div class="field_wrap">
                                        <?php if ($i2>0) { ?>
                                        <div class="pix_slide_move pix_cell_move"><span></span></div>
                                        <?php } ?>
                                        <label class="inner_label">Type:</label>
            
                                        <select name="<?php echo 'pix_array_your_slideshows_'.$_GET['slideshow'].'[slide]['.$i.'][element]['.$i2.'][type]'; ?>" class="type_select">
                                        <?php if ($i2==0) { ?>
                                            <option data-val="background" value="background" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['type'], 'background'); ?>>Background</option>
                                        <?php } else { ?>
                                            <option data-val="image" value="image" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['type'], 'image'); ?>>Image</option>
                                            <option data-val="video" value="video" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['type'], 'video'); ?>>Video</option>
                                            <option data-val="html" value="html" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['type'], 'html'); ?>>HTML code</option>
                                            <option data-val="caption" value="caption" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['type'], 'caption'); ?>>Caption</option>
                                            <option data-val="link" value="link" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['type'], 'link'); ?>>100% link</option>
                                        <?php } ?>
                                        </select>
                                                                    
                                        <div class="data-values background">
                                        
                                             <div class="clear less_space"></div>
                                            <label class="inner_label">Image:</label>
                                            <div class="pix_upload_image">
                                                <div class="pix_image_thumb"><img alt="Preview" src="<?php if($get_slideshow_slide[$i]['element'][$i2]['backgroundimg']!=''){ echo get_pix_thumb($get_slideshow_slide[$i]['element'][$i2]['backgroundimg'], 'mini_preview'); } else { echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; } ?>"></div>
                                                <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][backgroundimg]" type="text" value="<?php echo $get_slideshow_slide[$i]['element'][$i2]['backgroundimg']; ?>" data-obj="background">
                                                <div class="grey_button pix_upload_image_button">
                                                    <div class="button_left"></div>
                                                    <div class="button_right"></div>
                                                    <div class="button_body"></div>
                                                    <a href="#">upload</a>
                                                </div>
                                            </div><!-- .pix_upload_image -->

                                            <div class="clear less_space"></div>
                                            
                                            <label class="inner_label">Color:</label>
                                            <div class="pix_color_picker">
                                                <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][bgcolor]" type="text" value="<?php echo !isset($get_slideshow_slide[$i]['element'][$i2]['bgcolor']) ? 'transparent' : $get_slideshow_slide[$i]['element'][$i2]['bgcolor']; ?>">
                                                <div class="pix_palette"></div>
                                                <div class="colorpicker"></div>
                                            </div>

                                            <div class="clear less_space"></div>
                                            
                                        </div><!-- .background -->

                                        <div class="data-values link">

                                            <div class="clear less_space"></div>
    
                                            <label class="inner_label">URL:</label>
                                            
                                            <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][link_100]" type="text" value="<?php echo $get_slideshow_slide[$i]['element'][$i2]['link_100']; ?>">
                                            
                                            <label class="inner_label width_auto">Target _blank:</label>
                                            <div class="alignleft wrap_check">
                                                <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][target_100]" type="hidden" value="0">
                                                <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][target_100]" type="checkbox" value="true" <?php checked( $get_slideshow_slide[$i]['element'][$i2]['target_100'], 'true' ); ?>>
                                            </div>
                                            
                                        </div><!-- .link -->
                                        
                                        <div class="data-values image video caption html">
                                        
                                            <div class="clear less_space"></div>
                                            
                                            <div class="data-values video image">
                                            
                                                <label class="inner_label">Image:</label>
                                                
                                                <div class="pix_upload_image">
                                                    <div class="pix_image_thumb"><img alt="Preview" src="<?php if($get_slideshow_slide[$i]['element'][$i2]['simpleimg']!=''){ echo get_pix_thumb($get_slideshow_slide[$i]['element'][$i2]['simpleimg'], 'mini_preview'); } else { echo get_template_directory_uri().'/functions/images/pix_image_thumb.png'; } ?>"></div>
                                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][simpleimg]" type="text" value="<?php echo $get_slideshow_slide[$i]['element'][$i2]['simpleimg']; ?>" data-obj="simpleimage">
                                                    <div class="grey_button pix_upload_image_button">
                                                        <div class="button_left"></div>
                                                        <div class="button_right"></div>
                                                        <div class="button_body"></div>
                                                        <a href="#">upload</a>
                                                    </div>
                                                </div><!-- .pix_upload_image -->
                                                
                                            </div>
                                            
                                            <div class="data-values video">
                                                <div class="clear less_space"></div>

                                                <small><strong><em>Poster image here above is mandatory, otherwise the slideshow won't work</em></strong></small>

                                                <div class="clear less_space"></div>
                                                <label class="inner_label">Iframe:</label>
                                                <textarea name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][video]" data-obj="video"><?php echo stripslashes($get_slideshow_slide[$i]['element'][$i2]['video']); ?></textarea>
                                            
                                                <div class="clear less_space"></div>

                                                <label class="inner_label width_auto">Stop the slideshow when click the video starts:</label>
                                                <div class="alignleft wrap_check">
                                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][videostop]" type="hidden" value="0">
                                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][videostop]" type="checkbox" value="true" <?php checked( $get_slideshow_slide[$i]['element'][$i2]['videostop'], 'true' ); ?>>
                                                </div>
                                            
                                                <div class="clear less_space"></div>

                                                <label class="inner_label">Autoplay:</label>
                                                <div class="alignleft wrap_check">
                                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][autoplay]" type="hidden" value="0">
                                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][autoplay]" type="checkbox" value="true" <?php checked( $get_slideshow_slide[$i]['element'][$i2]['autoplay'], 'true' ); ?>>
                                                </div>
                                            
                                            </div>
                                            
                
                                            <div class="data-values caption">
        
                                                <label class="inner_label">Text:</label>
                                                <textarea name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][caption]" data-obj="caption"><?php echo stripslashes($get_slideshow_slide[$i]['element'][$i2]['caption']); ?></textarea>
                                            </div><!-- .caption -->
                                            
                
                                            <div class="data-values html">
        
                                                <label class="inner_label">Code:</label>
                                                <textarea name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][html]" data-obj="html"><?php echo stripslashes($get_slideshow_slide[$i]['element'][$i2]['html']); ?></textarea>
                                            </div><!-- .caption -->
                                                            
                                            <div class="clear less_space"></div>
                                            
                                            <div class="clear less_space"></div>
                                            
                                            <div class="bordering">

                                                <a href="#" class="slideel_toggle toggle_close">hide options</a>
                                            
                                                <a href="#" class="slideel_toggle toggle_open">see more options</a>
                                                
                                            </div><!-- .bordering -->
                            
                                            <div class="clear less_space"></div>

                                            <div class="slideel_toggle_more_opts">
                                        
                                               <label class="inner_label">Position:</label>
                                                
                                                <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][position]" type="text" value="<?php echo $get_slideshow_slide[$i]['element'][$i2]['position']; ?>" data-obj="position" class="get_position">
                                                                
                                                <label class="inner_label">Fade In:</label>
                                                <div class="alignleft wrap_check">
                                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][fadein]" type="hidden" value="0">
                                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][fadein]" type="checkbox" value="true" <?php checked( $get_slideshow_slide[$i]['element'][$i2]['fadein'], 'true' ); ?>>
                                                </div>
                                                                                        
                                                <label class="inner_label">Fade Out:</label>
                                                <div class="alignleft wrap_check">
                                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][fadeout]" type="hidden" value="0">
                                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][fadeout]" type="checkbox" value="true" <?php checked( $get_slideshow_slide[$i]['element'][$i2]['fadeout'], 'true' ); ?>>
                                                </div>
                                            
                                                <div class="clear less_space"></div>
                                            
                                                 <div class="data-values caption html">
                                                    <div class="bordering">
                                                        <label class="width_auto text_left">Size</label>
                                                    </div>
    
                                                    <div class="slider_div percent">
                                                        <label class="inner_label">Width:</label>
                                                        <div class="alignleft">
                                                            <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][width]" type="text" value="<?php echo $get_slideshow_slide[$i]['element'][$i2]['width']; ?>" data-obj="width"><div class="alignleft code_wrapper"><code>%</code></div>
                                                            <div class="slider_cursor"></div>
                                                        </div>
                                                    </div><!-- .slider_div -->
                                                                
                                                    <div class="clear less_space"></div>

                                                    <div class="slider_div percent">
                                                        <label class="inner_label">Height:</label>
                                                        <div class="alignleft">
                                                            <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][height]" type="text" value="<?php echo $get_slideshow_slide[$i]['element'][$i2]['height']; ?>" data-obj="height"><div class="alignleft code_wrapper"><code>%</code></div>
                                                            <div class="slider_cursor"></div>
                                                        </div>
                                                    </div><!-- .slider_div -->
                                                            
                                                    <div class="clear less_space"></div>
                                                                
                                                    <div class="clear less_space"></div>

                                                    <div class="data-values caption">
                                                        <div class="slider_div percent">
                                                            <label class="inner_label">Font size:</label>
                                                            <div class="alignleft">
                                                                <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][fontsize]" type="text" value="<?php echo $get_slideshow_slide[$i]['element'][$i2]['fontsize']; ?>" data-obj="fontsize"><div class="alignleft code_wrapper"><code>px</code></div>
                                                                <div class="slider_cursor"></div>
                                                            </div>
                                                        </div><!-- .slider_div -->
                                                                
                                                        <div class="clear less_space"></div>
                                                    </div>

                                                </div>
                                                
                                                <div class="bordering">
                                                    <label class="width_auto text_left">Periods</label>
                                                </div>

                                                <div class="slider_div milliseconds_2 alignleft">
                                                    <label class="inner_label">Delay:</label>
                                                    <div class="alignleft">
                                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][delay]" type="text" value="<?php echo $get_slideshow_slide[$i]['element'][$i2]['delay']; ?>">
                                                        <div class="slider_cursor"></div>
                                                    </div>
                                                </div><!-- .slider_div -->
                                                                
                                                <div class="clear less_space"></div>
                                            
                                                <div class="slider_div milliseconds_2 alignleft">
                                                    <label class="inner_label">Time:</label>
                                                    <div class="alignleft">
                                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][time]" type="text" value="<?php echo $get_slideshow_slide[$i]['element'][$i2]['time']; ?>">
                                                        <div class="slider_cursor"></div>
                                                    </div>
                                                </div><!-- .slider_div -->
                                                                
                                                <div class="data-values image">
                                                    <div class="clear less_space"></div>
                                                
                                                    <div class="bordering">
                                                        <label class="width_auto text_left">Link</label>
                                                    </div>
    
                                                    <label class="inner_label">URL:</label>
                                                    
                                                    <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][link]" type="text" value="<?php echo $get_slideshow_slide[$i]['element'][$i2]['link']; ?>">
                                                    
                                                    <label class="inner_label width_auto">Target _blank:</label>
                                                    <div class="alignleft wrap_check">
                                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][target]" type="hidden" value="0">
                                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][target]" type="checkbox" value="true" <?php checked( $get_slideshow_slide[$i]['element'][$i2]['target'], 'true' ); ?>>
                                                    </div>
                                                </div>
    
                                                <div class="clear less_space"></div>
                                            
                                                <div class="bordering">
                                                    <label class="width_auto text_left">Effects in and out</label>
                                                </div>
                                                
                                                    <label class="inner_label">In:</label>
                                                    <select name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][fxin]">
                                                        <option value="none" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['fxin'], 'none' ); ?>>None</option>
                                                        <option value="fromtop" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['fxin'], 'fromtop' ); ?>>From top</option>
                                                        <option value="frombottom" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['fxin'], 'frombottom' ); ?>>From bottom</option>
                                                        <option value="fromright" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['fxin'], 'fromright' ); ?>>From right</option>
                                                        <option value="fromleft" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['fxin'], 'fromleft' ); ?>>From left</option>
                                                    </select>
                                                    
                                                    <div class="alignleft vert_separator"></div>
                                                    
                                                    <label class="inner_label width_auto">Rotation (in):</label>
                                                    <div class="alignleft wrap_check">
                                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][rotate_in]" type="hidden" value="0">
                                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][rotate_in]" type="checkbox" value="true" <?php checked( $get_slideshow_slide[$i]['element'][$i2]['rotate_in'], 'true' ); ?>>
                                                    </div><!-- .wrap_check -->
                                            
                                                <div class="clear less_space"></div>

                                                    <label class="inner_label">Out:</label>
                                                    <select name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][fxout]">
                                                        <option value="none" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['fxout'], 'none' ); ?>>None</option>
                                                        <option value="totop" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['fxout'], 'totop' ); ?>>To top</option>
                                                        <option value="tobottom" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['fxout'], 'tobottom' ); ?>>To bottom</option>
                                                        <option value="toright" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['fxout'], 'toright' ); ?>>To right</option>
                                                        <option value="toleft" <?php selected( $get_slideshow_slide[$i]['element'][$i2]['fxout'], 'toleft' ); ?>>To left</option>
                                                    </select>

                                                    <div class="alignleft vert_separator"></div>
                                                    
                                                    <label class="inner_label width_auto">Rotation (out):</label>
                                                    <div class="alignleft wrap_check">
                                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][rotate_out]" type="hidden" value="0">
                                                        <input name="pix_array_your_slideshows_<?php echo $_GET['slideshow']; ?>[slide][<?php echo $i; ?>][element][<?php echo $i2; ?>][rotate_out]" type="checkbox" value="true" <?php checked( $get_slideshow_slide[$i]['element'][$i2]['rotate_out'], 'true' ); ?>>
                                                    </div><!-- .wrap_check -->
                                            
                                                <div class="clear less_space"></div>
                                            
                                                <div class="bordering">
                                                    <label class="width_auto text_left">Easing in and out</label>
                                                </div>
                                                
                                                <label class="inner_label">In:</label>
                                                <?php pix_print_easing( 'pix_array_your_slideshows_'. $_GET['slideshow'] .'[slide]['. $i .'][element]['. $i2 .'][easein]', $get_slideshow_slide[$i]['element'][$i2]['easein'], '' ); ?>
                                                
                                                <label class="inner_label">Out:</label>
                                                <?php pix_print_easing( 'pix_array_your_slideshows_'. $_GET['slideshow'] .'[slide]['. $i .'][element]['. $i2 .'][easeout]', $get_slideshow_slide[$i]['element'][$i2]['easeout'], '' ); ?>
                                                
                                                <div class="clear less_space"></div>
                                            
                                            </div><!-- .slideel_toggle_more_opts -->
                                            
                                        </div><!-- .image -->
                                    </div>
                                    
									<?php if ($i2>0) { ?>
                                    <div class="pix_remove_cell">
                                        <a href="#">&nbsp;</a>
                                    </div>
									<?php } ?>
                                </div><!-- .pix_slide -->
               <?php
                $i2++; }
            ?>
                                
                                <a href="#" class="pix_add_slideshow_cell button">add an element</a>
        
                            </div><!-- .pix_cells -->
                            
						</div>

						<div class="pix_remove_column">
							<a href="#">&nbsp;</a>
						</div>
				  
					</div><!-- .pix_slide -->
   <?php
	$i++; }
?>

                    <div class="grey_button pix_add_slideshow_column">
                        <div class="button_left"></div>
                        <div class="button_right"></div>
                        <div class="button_body"></div>
                        <a href="#">add a slide</a>
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