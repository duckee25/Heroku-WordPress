jQuery.noConflict();

/******************************************************
*
*	Hex2RGB
*
******************************************************/
function hex2rgb(hexStr){
    // note: hexStr should be #rrggbb
    var hex = parseInt(hexStr.substring(1), 16);
    var r = (hex & 0xff0000) >> 16;
    var g = (hex & 0x00ff00) >> 8;
    var b = hex & 0x0000ff;
    return [r, g, b];
}

function rgb2hex(rgb) {
	var hexDigits = ["0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"];
	if ( rgb.indexOf('rgba')!=-1 ) {
		rgb = rgb.match(/rgba\((.*?),(.*?),(.*?),(.*?)\)/);		
	} else {
		rgb = rgb.match(/rgb\((.*?),(.*?),(.*?)\)/);		
	}
	function hex(x) {
		return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
	}
	return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}
/***************************************
*
*	Smoothscroll
*
***************************************/
jQuery(function(){
	if(pagenow=='toplevel_page_admin_interface') {
		jQuery(document).on('click','a[href*="#"]',function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
			&& location.hostname == this.hostname) {
				var target = jQuery(this.hash);
				target = target.length && target
				|| jQuery('[name="' + this.hash.slice(1) +'"]');
				if (target.length) {
					var targetOffset = target.offset().top;
					jQuery('body')
					.animate({scrollTop: targetOffset}, 500);
					jQuery('html')
					.animate({scrollTop: targetOffset}, 500);
					return false;
				}
			}
		});
	}
});

/********************************
*
*	Save changes button
*
********************************/
function floating_save_button(){
	if(jQuery('#forte_contentbar').length){
		var off = jQuery('#forte_contentbar').offset(),
			top = off.top,
			left = off.left,
			topAdmin,
			width = jQuery('#forte_contentbar').outerWidth(),
			buttW = jQuery('.button_floating').outerWidth(),
			sumScroll = jQuery('html').scrollTop()+jQuery('body').scrollTop();
			jQuery('.floating_button_bg').css({left:(left+10)});
			if ( !jQuery('#back_to_top').length ) {
				jQuery('.floating_button_bg').append('<a id="back_to_top" href="#wpwrap">&uarr; Back to top</a>');
			}
			if(jQuery('#wpadminbar').length){
				topAdmin = 28;
			} else {
				topAdmin = 0;
			}
			
		if(sumScroll>(top-topAdmin)){
			if(!jQuery('.floating_button_bg').is(':visible')){
				jQuery('.floating_button_bg').show().css({top:topAdmin+'px'});
				jQuery('.button_floating').css({position:'fixed',left:((width+left)-(buttW+19)),top:(topAdmin+11)+'px',right:'auto',zIndex:11});
			}
		} else {
			if(jQuery('.floating_button_bg').is(':visible')){
				jQuery('.floating_button_bg').hide();
				jQuery('.button_floating').css({position:'absolute',right:'19px',top:'11px',left:'auto',zIndex:0});
			}
		}
	}
}
jQuery(window).bind('scroll load',function(){
	floating_save_button();
});

/********************************
*
*	Checkboxes
*
********************************/
function slidify_checkboxes(){
	jQuery('#forte_content_content input[type=checkbox]').not('.slidified, .clone_check').each(function(){
		var c = jQuery(this),
			classes = c.attr('class');
			classes = (typeof classes !== 'undefined' && classes !== false) ? ' '+classes : '';
		c.addClass('slidified').after(
			'<div class="checkbox'+classes+'">'+
				'<div class="checkbox_bg">'+
				'</div><!-- .checkbox_bg -->'+
				'<div class="checkbox_fill">'+
				'</div><!-- .checkbox_fill -->'+
				'<div class="checkbox_switch">'+
					'<div class="checkbox_no">'+
					'</div><!-- .checkbox_no -->'+
					'<div class="checkbox_ok">'+
					'</div><!-- .checkbox_ok -->'+
				'</div><!-- .checkbox_switch -->'+
			'</div><!-- .checbox -->'
		);
		var t = c.next('div.checkbox');
		if(c.is(':checked')){
			c.next('div.checkbox').addClass('checked');
			jQuery('.checkbox_no',t).hide();
			jQuery('.checkbox_ok',t).show();
		} else {
			c.next('div.checkbox').removeClass('checked');
			jQuery('.checkbox_ok',t).hide();
			jQuery('.checkbox_no',t).show();
		}
		c.hide();
		t.click(function(){
			if(c.is(':checked')){
				t.find('.checkbox_switch').animate({left:0},100,function(){
					t.removeClass('checked');
				});
				jQuery('.checkbox_ok',t).hide();
				jQuery('.checkbox_no',t).show();
				jQuery('.checkbox_fill',t).animate({width:0},100);
				c.removeAttr('checked');
			} else {
				t.find('.checkbox_switch').animate({left:'22px'},100,function(){
					t.addClass('checked');
				});
				jQuery('.checkbox_fill',t).animate({width:22},100);
				jQuery('.checkbox_no',t).hide();
				jQuery('.checkbox_ok',t).show();
				c.attr('checked', 'checked');
			}
			c.trigger('check_change');
		});
	});
}

/********************************
*
*	Select
*
********************************/
function smoothify_selects(){
	jQuery('#forte_content_content select').not('.letmebe, .clone_select').each(function(){
		if (!(jQuery.browser.msie && jQuery.browser.version < 9)) {
				if(!jQuery(this).prop('multiple')){
				var s = jQuery(this).animate({opacity:0},0).css({display:'block'}).addClass('letmebe'),
					v = jQuery('option:selected',s).val(),
					tx = jQuery('option:selected',s).text(),
					outW = s.width(),
					fake;
				s.wrap(
					'<span class="select_wrap"></div>'
				);
				s.after(
					'<span class="select_fake"><span class="fake_text">'+tx+'</span></span>'
				);
				fake = s.next('.select_fake').css({width:outW});
				s.css({width:fake.outerWidth()});
				fake.append('<div class="dd_arrow" />');
				
				s.bind('change',function(){
					tx = jQuery('option:selected',s).text();
					fake.find('.fake_text').text(tx);
				});
				}
		} else {
			jQuery('select').addClass('letmebe');
		}
	});
}

/******************************************************
*
*	Slider
*
******************************************************/
function init_sliders() {
	if(jQuery.isFunction(jQuery.fn.slider)) {
		jQuery('.slider_div').each(function(){
			var t = jQuery(this);
			var value = jQuery('input',t).val();
			if(t.hasClass('milliseconds')){
				var mi = 0;
				var m = 50000;
				var s = 100;
			} else if(t.hasClass('milliseconds_2')){
				var mi = 0;
				var m = 5000;
				var s = 100;
			} else if(t.hasClass('opacity')){
				var mi = 0;
				var m = 1;
				var s = 0.05;
			} else if(t.hasClass('googlemap')){
				var mi = 1;
				var m = 19;
				var s = 1;
			} else if(t.hasClass('border')){
				var mi = 0;
				var m = 50;
				var s = 1;
			} else if(t.hasClass('em')){
				var mi = 0;
				var m = 8;
				var s = 0.001;
			} else if(t.hasClass('percent')){
				var mi = 0;
				var m = 100;
				var s = 1;
			} else if(t.hasClass('ratio')){
				var mi = 0;
				var m = 20;
				var s = 0.01;
			} else {
				var mi = 0;
				var m = 200;
				var s = 1;
			}
			jQuery('.slider_cursor',t).slider({
				range: 'min',
				value: value,
				min: mi,
				max: m,
				step: s,
				slide: function( event, ui ) {
					jQuery('input',t).val( ui.value );
				}
			});
			jQuery('input',t).keyup(function(){
				var v = jQuery('input',t).val();
				jQuery('.slider_cursor',t).slider({
					range: 'min',
					value: v,
					min: 0,
					max: m,
					step: s,
					slide: function( event, ui ) {
						jQuery('input',t).val( ui.value );
					}
				});
			});
			jQuery('.slider_cursor',t).each(function(){
				if ( jQuery('.ui-slider-range-min',this).length > 1 ) {
					jQuery('.ui-slider-range-min',this).not(':last').remove();
				}
			});
		});
	}
}


/******************************************************
*
*	Select menu icons
*
******************************************************/
jQuery(function(){

	jQuery(document).on('click','.pix_select_icon .pix_select_icon_button, .pix_select_icon .pix_image_thumb',function() {
		
		var h = parseFloat(jQuery(window).height()),
			t = jQuery(this).parents('.pix_select_icon').eq(0),
			dial = jQuery('#pix_list_icons').clone();

		dial.dialog({
			height: 'auto',
			width: 'auto',
			modal: true,
			dialogClass: 'wp-dialog',
			zIndex: 50,
			open: function(event, ui) {
				var input = jQuery('input[type=hidden]',t),
					preview = jQuery('.pix_image_thumb i',t);
				jQuery('.menu_icon_preview',dial).click(function(){
					var cl = jQuery(this).find('i').attr('class');
					input.val(cl);
					preview.attr('class',cl);
					dial.dialog('close').remove();
				});
			}
		});
	
		return false;
	});

});

/******************************************************
*
*	Upload buttons
*
******************************************************/
jQuery(function(){
 	jQuery(document).on('keyup','.pix_upload_image input[type=text]',function() {
		var upField = jQuery(this);
		var upThumb = upField.parents('.pix_upload_image').find('.pix_image_thumb img');
		imgurl = upField.val();
		if(imgurl!=''){
			var imgurlNoF = imgurl.substring(0,imgurl.lastIndexOf('.'));
			var onlyFormat = imgurl.substr(imgurl.lastIndexOf('.'));
			jQuery.ajax({
				url:imgurlNoF+'-33x33'+onlyFormat,
				type:'HEAD',
				error:
					function(){
						var imgurlNoF2 = imgurlNoF.substring(0,imgurlNoF.lastIndexOf('-'));
						var preview = imgurlNoF2+'-48x48'+onlyFormat;
						jQuery.ajax({
							url:preview,
							type:'HEAD',
							error: function(){
								upThumb.attr('src',imgurl).show();
							},
							success: function(){
								upThumb.attr('src',preview).show();
							}
						});
					},
				success:
					function(){
						var preview = imgurlNoF+'-33x33'+onlyFormat;
						upThumb.attr('src',preview).show();
					}
			});
		} else {
			upThumb.hide();
		}
	});

 	jQuery(document).off('click','.pix_upload_image .pix_upload_image_button, .pix_upload_image .pix_image_thumb');
	
	jQuery(document).on('click','.pix_upload_image .pix_upload_image_button, .pix_upload_image .pix_image_thumb',function() {
		var upLoad = jQuery(this).parents('.pix_upload_image');
		var upField = upLoad.find('input[type="text"]');
		var upThumb = upLoad.find('.pix_image_thumb img');
		window.formfield_image = '';
		
		window.formfield_image = upField;
		tb_show('', 'media-upload.php?type=image&height=800&width=600&TB_iframe=true');
		if(jQuery(this).hasClass('no_overlay')){
			jQuery('#TB_overlay').removeClass('TB_overlayBG');
		}
	
		window.image_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html, f) {
			if (window.formfield_image != '') {
				imgurl = jQuery('img',html).attr('src');
				window.formfield_image.val(imgurl).keyup();
                var imgurlNoF = imgurl.substring(0,imgurl.lastIndexOf('.'));
                var onlyFormat = imgurl.substr(imgurl.lastIndexOf('.'));
				window.formfield_image = '';
				tb_remove();
				jQuery.ajax({
					url:imgurlNoF+'-33x33'+onlyFormat,
					type:'HEAD',
				error:
					function(){
						var imgurlNoF2 = imgurlNoF.substring(0,imgurlNoF.lastIndexOf('-'));
						var preview = imgurlNoF2+'-33x33'+onlyFormat;
						upThumb.attr('src',preview).show();
					},
				success:
					function(){
						var preview = imgurlNoF+'-33x33'+onlyFormat;
						upThumb.attr('src',preview).show();
					}
					});
				}
			else {
				window.image_send_to_editor(html);
			}
		}
		return false;
	});


 	jQuery(document).off('click','.pix_upload_video input[type=button], .pix_upload_video a.pix_upload_video_button');

 	jQuery(document).on('click','.pix_upload_video input[type=button], .pix_upload_video a.pix_upload_video_button',function() {
		var upLoad = jQuery(this).parents('.pix_upload_video');
		var upField = upLoad.find('input[type=text]');
		window.formfield_video = '';
		
		window.formfield_video = upField;
		tb_show('', 'media-upload.php?type=video&TB_iframe=true');
		if(jQuery(this).hasClass('no_overlay')){
			jQuery('#TB_overlay').removeClass('TB_overlayBG');
		}
		
		window.video_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html) {
			if (window.formfield_video != '') {
				imgurl = jQuery(html).attr('href');
				window.formfield_video.val(imgurl);
				window.formfield_video = '';
				tb_remove();
			}
			else {
				window.video_send_to_editor(html);
			}
		}
		return false;
	});


 	jQuery(document).off('click','.pix_upload_audio input[type=button], .pix_upload_audio a.pix_upload_audio_button');

 	jQuery(document).on('click','.pix_upload_audio input[type=button], .pix_upload_audio a.pix_upload_audio_button',function() {
		var upLoad = jQuery(this).parents('.pix_upload_audio');
		var upField = upLoad.find('input[type=text]');
		window.formfield_video = '';
		
		window.formfield_video = upField;
		tb_show('', 'media-upload.php?type=audio&TB_iframe=true');
		if(jQuery(this).hasClass('no_overlay')){
			jQuery('#TB_overlay').removeClass('TB_overlayBG');
		}
		
		window.video_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html) {
			if (window.formfield_video != '') {
				imgurl = jQuery(html).attr('href');
				window.formfield_video.val(imgurl);
				window.formfield_video = '';
				tb_remove();
			}
			else {
				window.video_send_to_editor(html);
			}
		}
		return false;
	});


});

/******************************************************
*
*	Sortable
*
******************************************************/
function sort_slides(){
	jQuery( ".pix_slides" ).not('.pix_contact_forms').sortable({ 
		opacity: 0.8,
		items: 'div.pix_slide:visible',
		placeholder: "ui-state-highlight",
		handle: '.pix_slide_move',
		stop: function() {
            var order = jQuery(this).sortable('toArray'),
				id = jQuery('.pix_slide:last',this).attr('id'),
				suf = id.lastIndexOf('_')+1,
				nameSubs = id.substring(0,suf);
			jQuery.each(order, function(key, value) {
				jQuery('#'+order[key]).find('*[name]').each(function(){
					var name = jQuery(this).attr('name'),
						fieldStart = name.lastIndexOf('[')+1,
						fieldEnd = name.lastIndexOf(']'),
						field = name.substring(fieldStart,fieldEnd);
						jQuery(this).attr('name',nameSubs+'[' + key + ']'+'[' + field + ']');
				});
			});
       },
		start: function(event,ui) {
			var uiW = ui.item.outerWidth(),
				uiH = ui.item.outerHeight();
			jQuery('.ui-state-highlight').css({height:(uiH-2),width:(uiW-2)});
		}
	});

	jQuery( ".pix_slides.pix_contact_forms" ).sortable({ 
		opacity: 0.8,
		items: 'div.pix_slide:visible',
		placeholder: "ui-state-highlight",
		handle: '.pix_slide_move',
		stop: function() {
				jQuery('.pix_slide',this).each(function(){
					var key = parseFloat(jQuery(this).index());
					jQuery(this).find('*[name]').each(function(){
						var name = jQuery(this).attr('name');
							fieldEnd = name.lastIndexOf('[')-1,
							field = name.substring(0,fieldEnd),
							fieldStart = field.lastIndexOf('[')+1,
							order = field.substring(fieldStart),
							newName = name.replace('['+order+']','['+(key-1)+']');
						jQuery(this).attr('name',newName);
					});
				});
       },
		start: function(event,ui) {
			var uiW = ui.item.outerWidth(),
				uiH = ui.item.outerHeight();
			jQuery('.ui-state-highlight').css({height:(uiH-2),width:(uiW-2)});
		}
	});

	jQuery( ".pix_slides.pix_price_tables" ).sortable({ 
		opacity: 0.8,
		items: '> div.pix_slide:visible',
		placeholder: "ui-state-highlight",
		handle: '.pix_col_move',
		tolerance: 'pointer',
		stop: function() {
			jQuery('.pix_column',this).each(function(){
				var key = jQuery(this).index();
				jQuery(this).find('*[name]').each(function(){
					var name = jQuery(this).attr('name'),
						i = 0;
					jQuery(this).attr('name', name.replace(/\[.+?\]/g,function (match, pos, original) {
						i++;
						return (i == 2) ? '['+(key)+']' : match;
					}));
				});
			});
       },
		start: function(event,ui) {
			var uiW = ui.item.outerWidth(),
				uiH = ui.item.outerHeight();
			jQuery('.ui-state-highlight').css({height:(uiH-2),width:(uiW-2)});
		}
	});
	
	//var thisItems = jQuery( ".pix_slides.pix_slideshows:visible" )

	jQuery( ".pix_slides.pix_slideshows" ).sortable({ 
		opacity: 0.8,
		items: '> div.pix_slide:visible',
		placeholder: "ui-state-highlight",
		handle: '.pix_col_move',
		tolerance: 'pointer',
		stop: function() {
			jQuery('.pix_column',this).each(function(){
				var key = jQuery(this).index();
				jQuery(this).find('*[name]').each(function(){
					var name = jQuery(this).attr('name'),
						i = 0;
					jQuery(this).attr('name', name.replace(/\[.+?\]/g,function (match, pos, original) {
						i++;
						return (i == 2) ? '['+(key)+']' : match;
					}));
				});
			});
       },
		start: function(event,ui) {
			var uiW = ui.item.outerWidth(),
				uiH = ui.item.outerHeight();
			jQuery('.ui-state-highlight').css({height:(uiH-2),width:(uiW-2)});
		}
	});

	jQuery(".pix_cells").sortable({ 
		opacity: 0.8,
		items: '> div.pix_slide:not(.pix_bg_slide):visible',
		placeholder: "ui-state-highlight",
		handle: '.pix_cell_move',
		tolerance: 'pointer',
		stop: function() {
			jQuery('.pix_cell',this).each(function(){
				var key = jQuery(this).index();
				jQuery(this).find('*[name]').each(function(){
					var name = jQuery(this).attr('name'),
						i = 0;
					jQuery(this).attr('name', name.replace(/\[.+?\]/g,function (match, pos, original) {
						i++;
						return (i == 4) ? '['+(key-1)+']' : match;
					}));
				});
			});
	   },
		start: function(event,ui) {
			var uiW = ui.item.outerWidth(),
				uiH = ui.item.outerHeight();
			jQuery('.ui-state-highlight').css({height:(uiH-2),width:(uiW-2)});
		}
	});
}

/******************************************************
*
*	Manage slides
*
******************************************************/
function manage_slides(){
	jQuery( ".pix_add_slide a" ).click(function(){
		var t = jQuery(this),
			p = t.parents('.pix_add_slide'),
			prev = p.parents('.pix_slides'),
			clone = prev.find('.pix_slide.clone').clone(),
			slideL = jQuery('.pix_slide',prev).not('.clone').length,
			idS = clone.attr('id'),
			replIdS = idS.replace("Nvariable", slideL);
			
		clone.attr('id',replIdS);
		
		jQuery('[data-name*="Nvariable"]',clone).each(function(){
			var nameS = jQuery(this).attr('data-name'),
				replS = nameS.replace("Nvariable", slideL);
			jQuery(this).attr('name',replS).removeAttr('data-name');
		});
		
			
		p.before(clone);
		clone.removeClass('clone').show().css({opacity:0}).slideDown(200,function(){jQuery(this).animate({opacity:1},200)});
		jQuery('select.clone_select',clone).removeClass('clone_select');
		jQuery('input.clone_check',clone).removeClass('clone_check');
		smoothify_selects();
		slidify_checkboxes();
		init_farbtastic();

		return false;
	});
	jQuery(document).on('click', ".pix_remove_slide a" ,function(){
		var t = jQuery(this),
			prev = t.parents('.pix_slides');
			
		t.parents('.pix_slide').eq(0).animate({opacity:0},100,function(){jQuery(this).slideUp(200,function(){
			jQuery(this).remove();
			checkDBvalues();
			
			jQuery('.pix_slide',prev).each(function(){
				var key = jQuery(this).index();
				jQuery(this).find('*[name]').each(function(){
					var name = jQuery(this).attr('name');
						fieldEnd = name.lastIndexOf('[')-1,
						field = name.substring(0,fieldEnd),
						fieldStart = field.lastIndexOf('[')+1,
						order = field.substring(fieldStart),
						newName = name.replace('['+order+']','['+(key-1)+']');
					jQuery(this).attr('name',newName);
				});
			});

		})});
		
		return false;
	});

	jQuery(document).on('click', ".pix_remove_cell a" ,function(){
		var t = jQuery(this),
			prev = t.parents('.pix_cells').eq(0);
			
		t.parents('.pix_cell').eq(0).animate({opacity:0},100,function(){jQuery(this).slideUp(200,function(){
			jQuery(this).remove();
			checkDBvalues();
			
			jQuery('.pix_cell',prev).each(function(){
				var key = jQuery(this).index();
				jQuery(this).find('*[name]').each(function(){
					var name = jQuery(this).attr('name'),
						i = 0;
					jQuery(this).attr('name', name.replace(/\[.+?\]/g,function (match, pos, original) {
						i++;
						return (i == 4) ? '['+(key-1)+']' : match;
					}));
				});
			});

		})});
		
		return false;
	});

	jQuery(document).on('click', ".pix_remove_column a" ,function(){
		var t = jQuery(this),
			prev = t.parents('.pix_slides').eq(0);
			
		t.parents('.pix_column').eq(0).animate({opacity:0},100,function(){jQuery(this).slideUp(200,function(){
			jQuery(this).remove();
			checkDBvalues();
			
			jQuery('.pix_column',prev).each(function(){
				var key = jQuery(this).index();
				jQuery(this).find('*[name]').each(function(){
					var name = jQuery(this).attr('name'),
						i = 0;
					jQuery(this).attr('name', name.replace(/\[.+?\]/g,function (match, pos, original) {
						i++;
						return (i == 2) ? '['+key+']' : match;
					}));
				});
			});

		})});
		
		return false;
	});
}

/******************************************************
*
*	Farbtastic
*
******************************************************/
function init_farbtastic(){
	if(jQuery.isFunction(jQuery.fn.farbtastic)) {
		jQuery('.colorpicker').after('<div class="picker_close" />');
		jQuery('.pix_palette').click(function(){
			jQuery('.colorpicker').fadeOut(0);
			jQuery('.picker_close').fadeOut(0);
			jQuery(this).next('.colorpicker').fadeIn(300);
			jQuery(this).next('.colorpicker').next('.picker_close').fadeIn(300);
			return false;
		});
		jQuery('.colorpicker').each(function(){
			var the_picker = jQuery(this);
			jQuery(this).next('.picker_close').click(function(){
				the_picker.fadeOut(150);
				jQuery(this).fadeOut(150);
				return false;
			});
		});
		jQuery('.pix_color_picker').each(function() {
			var divPicker = jQuery(this).find('.colorpicker');
			var inputPicker = jQuery(this).find('input[type=text]');
			divPicker.farbtastic(inputPicker);
		});
	}
}
jQuery(function(){
	init_farbtastic();
	init_sliders();
});

/******************************************************
*
*	More info toggles
*
******************************************************/
function more_infos(){
	jQuery('.more_info_wrap').each(function(){
		var t = jQuery(this),
			h = t.prev('.tip_info_wrap').find('.tip_info').outerHeight();
		t.prev('.tip_info_wrap').css({height:'1px'});
		jQuery('.open_info',t).click(function(){
			jQuery(this).fadeOut(100);
			jQuery('.close_info',t).fadeIn(100);
			t.prev('.tip_info_wrap').animate({height:h},200);
		});
		jQuery('.close_info',t).click(function(){
			jQuery(this).fadeOut(100);
			jQuery('.open_info',t).fadeIn(100);
			t.prev('.tip_info_wrap').animate({height:'1px'},200);
		});
	});
}

/******************************************************
*
*	SEO counter
*
******************************************************/
function seo_counter(){
    jQuery('.pix_title_seo').each(function() {
		var c = jQuery(this).val().length;
		jQuery(this).closest('.field_wrap').after('<p />');
		var p = jQuery(this).closest('.field_wrap').next('p').css({clear:'both'});
		if(c<=70){
			p.html('<strong class="strong_char_good">'+(70-c)+'</strong> recommended characters');
		} else {
			p.html('<strong class="strong_char_bad">'+(70-c)+'</strong> recommended characters');
		}
		jQuery(this).keyup(function(){
			c = jQuery(this).val().length;
			if(c<=70){
				p.html('<strong class="strong_char_good">'+(70-c)+'</strong> recommended characters');
			} else {
				p.html('<strong class="strong_char_bad">'+(70-c)+'</strong> recommended characters');
			}
		});
    });

    jQuery('.pix_desc_seo').each(function() {
		var c = jQuery(this).val().length;
		jQuery(this).closest('.field_wrap').after('<p />');
		var p = jQuery(this).closest('.field_wrap').next('p').css({clear:'both'});
		if(c<=160){
			p.html('<strong class="strong_char_good">'+(160-c)+'</strong> recommended characters');
		} else {
			p.html('<strong class="strong_char_bad">'+(160-c)+'</strong> recommended characters');
		}
		jQuery(this).keyup(function(){
			c = jQuery(this).val().length;
			if(c<=160){
				p.html('<strong class="strong_char_good">'+(160-c)+'</strong> recommended characters');
			} else {
				p.html('<strong class="strong_char_bad">'+(160-c)+'</strong> recommended characters');
			}
		});
    });
}

jQuery(function(){
	seo_counter();
});

/***************************************
*
*	AJAX wpdb
*
***************************************/
function forte_show_success(t) {
	jQuery('#pix_loader').fadeOut(100);
	jQuery('#pix_success').fadeIn(150);
	function hide_success(t) {
		jQuery('#pix_success').fadeOut(150,function(){
			jQuery('#forte_contentbar').fadeTo(150,1);
		});
	}
	var data = {
		action: 'pix_wpdb'
	};
	jQuery.post(ajaxurl, data);
	var s = setTimeout(function() { hide_success(t);},1000);
}

function forte_show_error(t) {
	jQuery('#pix_loader').fadeOut(100);
	jQuery('#pix_error').fadeIn(150);
	function hide_error(t) {
		jQuery('#pix_error').fadeOut(150,function(){
			jQuery('#forte_contentbar').fadeTo(150,1);
		});
	}
	var s = setTimeout(function() { hide_error(t);},1000);
}
jQuery(function(){
	if(pagenow=='toplevel_page_admin_interface') {
		jQuery(document).on('submit','form.ajax_form',function() {
			jQuery('#forte_contentbar').animate({opacity:.4},250);
			jQuery('#pix_loader').fadeIn(250);
			var data = jQuery(this).serialize();
			jQuery.post(ajaxurl, data)
				.success(function() { forte_show_success(jQuery(this)); })
				.error(function() { forte_show_error(jQuery(this)); });
			return false;
		});
		
		jQuery(document).on('submit','form.ajax_fake',function() {
			var t = jQuery(this),
				data = t.serialize();
			jQuery('#forte_contentbar').animate({opacity:.4},250);
			jQuery('#pix_loader').fadeIn(250);
			jQuery.post(ajaxurl, data)
				.success(function() { t.removeClass('ajax_fake').submit(); })
				.error(function() { t.removeClass('ajax_fake').submit(); });
			return false;
		});
		
		jQuery(document).off('click','a.save_changes');
		jQuery(document).on('click','a.save_changes',function(){
			jQuery('form.dynamic_form input[type=submit]').click();

			return false;
		});
		
		jQuery(document).off('click','a.fake_button');
		jQuery(document).on('click','a.fake_button',function(){
			jQuery(this).parents('form.dynamic_form').find('input[type=submit]').click();

			return false;
		});
	}
});

/********************************
*
*	Navsidebar menu
*
********************************/
	
jQuery(function(){
	if(pagenow=='toplevel_page_admin_interface') {
		jQuery('#forte_navsidebar > ul > li:first').css({borderTop:'0px'});
		jQuery('#forte_navsidebar > ul > li:last').css({borderBottom:'0px'});
		
		var forte_active_tab = localStorage.getItem("forte_active_tab"),
			forte_active_link = localStorage.getItem("forte_active_link");
		if(typeof forte_active_tab == 'undefined' || forte_active_tab == false || forte_active_tab == null) {
			forte_active_tab = 'general_head';
		}
		if(typeof forte_active_link == 'undefined' || forte_active_link == false || forte_active_link == null) {
			forte_active_link = 'admin_panel';
		}
		var tabH = jQuery('#forte_wraploader').height();
		jQuery('#forte_contentbar').animate({opacity:.4},250);
		jQuery('#pix_loader').fadeIn(250);
	
		function pix_ajax_update() {
			jQuery.ajax({
				url: jQuery('#forte_navsidebar a[data-store='+forte_active_link+']').attr('href'),
				success: function(loadeddata){
					jQuery('#forte_wraploader').height(tabH);
					jQuery('#forte_navsidebar a[data-store='+forte_active_tab+']').addClass('current');
					jQuery('#forte_navsidebar a[data-store='+forte_active_link+']').addClass('current');
					var html = jQuery("<div/>").append(loadeddata.replace(/<script(.|\s)*?\/script>/g, "")).find('#forte_dynamic_tab').html();
						jQuery('#forte_contentbar').animate({opacity:0},0).html(html);
						slidify_checkboxes();
						init_formColorsSwitchers();
						pixInitColorbox();
						floating_save_button();
						smoothify_selects();
						init_sliders();
						//pix_upload_media();
						sort_slides();
						manage_slides();
						init_farbtastic();
						selectToggle();
						init_googlefontselect();
						pix_remove_sidebar();
						pix_manage_contactform();
						pix_manage_pricetable();
						pix_manage_slideshow();
						pix_fullscreen_alignment();
						init_googlefontlist();
						init_buttonpreview();
						more_infos();
						seo_counter();
						if(jQuery('#pix_customstyles').length){
							var editor = CodeMirror.fromTextArea(document.getElementById("pix_customstyles"), {theme:'default'});
						}
						
						var newH = jQuery('#forte_contentbar').outerHeight();
						
						if(typeof forte_data_saved != 'undefined' && forte_data_saved != false && forte_data_saved != 'undefined' && forte_data_saved != null){
							jQuery('#forte_contentbar').fadeTo(0,.4);
							jQuery('#forte_wraploader').animate({height:newH},400,function(){
								forte_show_success(jQuery(this));
								jQuery('#forte_wraploader').css({height:'auto'});
							});
						} else {
							jQuery('#forte_wraploader').animate({height:newH},400,function(){
								jQuery('#pix_loader').fadeOut(250,function(){
									if (typeof forte_demo_mode != 'undefined' && forte_demo_mode != false && forte_demo_mode != 'undefined' && forte_demo_mode != null && !jQuery('#pix_demo_message').hasClass('seen')) {
										jQuery(function(){
											jQuery('#pix_demo_message').addClass('seen').dialog({
												height: 'auto',
												width: 400,
												modal: true,
												dialogClass: 'wp-dialog',
												zIndex: 50
											});
										});
									}
								});
								jQuery('#forte_wraploader').css({height:'auto'});
								jQuery('#forte_contentbar').animate({opacity:1},250);
							});
						}
		
					//Update the last tweet
					if(forte_active_link=='forte_news' && forte_active_tab=='twitter_head'){
						jQuery('#forte_navsidebar .alert_tweet').remove();
						var data = jQuery('form#pix_tweet_form').serialize();
						var updateurl = ajaxurl;
						jQuery.post(updateurl, data)
					}
				},
				error: function(){
					forte_active_tab = 'general_head';
					forte_active_link = 'admin_panel';
				}
			});
		}
	
		if(forte_active_tab!='no-tab'){
			jQuery('#forte_navsidebar a[data-store='+forte_active_tab+']').parents('li').find('> ul').addClass('open_toggle').slideDown(200,function(){
				pix_ajax_update();
			});
		} else {
			pix_ajax_update();
		}
		jQuery('#forte_navsidebar > ul > li').each(function(){
			var p = jQuery(this);
			jQuery('> a',p).bind('click',function(){
				var t = jQuery(this),
					c = jQuery('#forte_navsidebar a'),
					page = t.attr('href');
				if(t.parent().has('ul').length){
					jQuery('ul.open_toggle').slideUp(200,function(){
						jQuery(this).removeClass('open_toggle')
					});
					if(!t.parents('li').find('> ul').hasClass('open_toggle')){
						t.parents('li').find('> ul').addClass('open_toggle').slideDown(400);
					}
				} else {
					var tabH = jQuery('#forte_wraploader').height();
					jQuery('#forte_contentbar').animate({opacity:.4},250);
					jQuery('#pix_loader').fadeIn(250);
					jQuery.ajax({
						url: page,
						success: function(loadeddata){
							jQuery('#forte_wraploader').height(tabH);
							c.removeClass('current');
							t.addClass('current');
							var html = jQuery("<div/>").append(loadeddata.replace(/<script(.|\s)*?\/script>/g, "")).find('#forte_dynamic_tab').html();
								jQuery('#forte_contentbar').animate({opacity:0},0).html(html);
								slidify_checkboxes();
								init_formColorsSwitchers();
								pixInitColorbox();
								floating_save_button();
								smoothify_selects();
								init_sliders();
								//pix_upload_media();
								sort_slides();
								manage_slides();
								init_farbtastic();
								selectToggle();
								init_googlefontselect();
								pix_remove_sidebar();
								pix_manage_contactform();
								pix_manage_pricetable();
								pix_manage_slideshow();
								pix_fullscreen_alignment();
								more_infos();
								seo_counter();
								if(jQuery('#pix_customstyles').length){
									var editor = CodeMirror.fromTextArea(document.getElementById("pix_customstyles"), {theme:'default'});
								}
								
								var newH = jQuery('#forte_contentbar').outerHeight();
								jQuery('#forte_wraploader').animate({height:newH},400,function(){
									jQuery('#pix_loader').fadeOut(250);
									jQuery('#forte_wraploader').css({height:'auto'});
									jQuery('#forte_contentbar').animate({opacity:1},250);
								});
								jQuery('ul.open_toggle').slideUp(200,function(){
									jQuery(this).removeClass('open_toggle')
								});
								if (Modernizr.localstorage) {
									var tab = 'no-tab',
										linK = t.attr('data-store');
									localStorage.setItem("forte_active_tab", tab)
									localStorage.setItem("forte_active_link", linK)
								}
	
	
						},
						error: function(){
							forte_active_tab = 'general_head';
							forte_active_link = 'admin_panel';
						}
					});
	
	
				}
				return false;
			});
			jQuery('> ul > li > a',p).bind('click',function(){
				var t = jQuery(this),
					c = jQuery('#forte_navsidebar a'),
					page = t.attr('href'),
					tabH = jQuery('#forte_wraploader').height();
				jQuery('#forte_contentbar').animate({opacity:.4},250);
				jQuery('#pix_loader').fadeIn(250);
				jQuery.ajax({
					url: page,
					success: function(loadeddata){
						jQuery('#forte_wraploader').height(tabH);
						c.removeClass('current');
						p.find('>a').addClass('current');
						t.addClass('current');
						var html = jQuery("<div/>").append(loadeddata.replace(/<script(.|\s)*?\/script>/g, "")).find('#forte_dynamic_tab').html();
							jQuery('#forte_contentbar').animate({opacity:0},0).html(html);
							slidify_checkboxes();
							init_formColorsSwitchers();
							pixInitColorbox();
							floating_save_button();
							smoothify_selects();
							init_sliders();
							//pix_upload_media();
							sort_slides();
							manage_slides();
							init_farbtastic();
							selectToggle();
							init_googlefontselect();
							pix_remove_sidebar();
							pix_manage_contactform();
							pix_manage_pricetable();
							pix_manage_slideshow();
							pix_fullscreen_alignment();
							init_googlefontlist();
							init_buttonpreview();
							more_infos();
							seo_counter();
							if(jQuery('#pix_customstyles').length){
								var editor = CodeMirror.fromTextArea(document.getElementById("pix_customstyles"), {theme:'default'});
							}
							
							var newH = jQuery('#forte_contentbar').outerHeight();
							jQuery('#forte_wraploader').animate({height:newH},400,function(){
								jQuery('#pix_loader').fadeOut(250);
								jQuery('#forte_wraploader').css({height:'auto'});
								jQuery('#forte_contentbar').animate({opacity:1},250);
							});
							var tab = p.find('>a').attr('data-store'),
								linK = t.attr('data-store');
						if (Modernizr.localstorage) {
							localStorage.setItem("forte_active_tab", tab)
							localStorage.setItem("forte_active_link", linK)
						}
						
	
						//Update the last tweet
						if(linK=='forte_news' && tab=='twitter_head'){
							jQuery('#forte_navsidebar .alert_tweet').remove();
							var data = jQuery('form#pix_tweet_form').serialize();
							var updateurl = ajaxurl;
							jQuery.post(updateurl, data);
						}
	
					},
					error: function(){
						forte_active_tab = 'general_head';
						forte_active_link = 'admin_panel';
					}
				});
				return false;
			});
		});
	}
});

/******************************************************
*
*	MegaMenu
*
******************************************************/
function update_megamenu(){
	jQuery('.menu-item-depth-0 .pix-megamenu-item').each(function(){
		var c = jQuery(this),
			li = c.closest('li'),
			p = jQuery('> dl .item-type',li),
			megaEq = li.index('.menu-item-depth-0'),
			megaNext = jQuery('.menu-item-depth-0').eq(megaEq+1),
			startEq = li.index('.menu-item'),
			endEq = megaNext.length ? megaNext.index('.menu-item') : jQuery('.menu-item').length;
		if(!jQuery('> dl .custom-type',li).length){
			p.after('<span class="custom-type" />').hide();
		}
		var te = jQuery('> dl .custom-type',li);
		if(c.is(':checked')){
			te.html('<strong><em style="color:#d57800">MegaMenu</em></strong>').show();
			p.hide();
			li.addClass('pix-megamenu-parent');
			li.nextUntil('.menu-item-depth-0').addClass('in-a-megamenu');
		} else {
			te.hide();
			p.show();
			li.removeClass('pix-megamenu-parent');
			li.nextUntil('.menu-item-depth-0').removeClass('in-a-megamenu');
		}
		jQuery('.in-a-megamenu').each(function(){
			var subs = jQuery(this).attr('class').indexOf('menu-item-depth-'),
				depth = parseFloat(jQuery(this).attr('class').substring(subs+16,subs+17));
			if ( depth > 2 ) {
				jQuery(this).addClass('menu-item-alert');
				if ( !jQuery('#pix_builder_cant').length ) {
					jQuery('body').append('<div id="pix_builder_cant" /></div>');
				}
				jQuery('#pix_builder_cant').html('<p>MegaMenu can\'t have more than two levels, please check</p>')
					.dialog({
						height: 'auto',
						width: 250,
						modal: true,
						dialogClass: 'wp-dialog',
						zIndex: 50,
						close: function(){
							jQuery('#pix_builder_cant').remove();
						}
					});
			} else {
				jQuery(this).removeClass('menu-item-alert');
			}
		});
		c.bind('click',function(){
			if(c.is(':checked')){
				te.html('<strong><em style="color:#d57800">MegaMenu</em></strong>').show();
				p.hide();
			} else {
				te.hide();
				p.show();
			}
		});
	});
	jQuery('.menu-item-depth-1 .pix-column-item').each(function(){
		var c = jQuery(this),
			v = jQuery('option:selected',c).val(),
			li = c.closest('li'),
			p = jQuery('> dl .item-type',li);
		if(!jQuery('> dl .custom-type',li).length){
			p.after('<span class="custom-type" />').hide();
		}
		var te = jQuery('> dl .custom-type',li);
		if(v == 'column'){
			c.parents('li').eq(0).addClass('menu-item-column');
			te.html('<strong><em style="color:#00b4d5">Column</em></strong>').show();
			p.hide();
			jQuery('.pix_url-item, .field-link-target, field-css-classes, .field-xfn, .field-description, .pix_image-item',li).hide();
			jQuery('.pix_width-item',li).show();
		} else if(v == 'row'){
			c.parents('li').eq(0).addClass('menu-item-row');
			te.html('<strong><em style="color:#0fd500">Row</em></strong>').show();
			p.hide();
			jQuery('.pix_url-item, .field-link-target, field-css-classes, .field-xfn, .field-description, .pix_image-item',li).hide();
			jQuery('.pix_width-item',li).hide();
		} else {
			te.hide();
			p.show();
			jQuery('.pix_url-item, .field-link-target, field-css-classes, .field-xfn, .field-description, .pix_image-item',li).show();
			jQuery('.pix_width-item',li).hide();
		}
		c.change(function(){
			v = jQuery('option:selected',c).val();
			if(v == 'column'){
				te.html('<strong><em style="color:#00b4d5">Column</em></strong>').show();
				p.hide();
				jQuery('.pix_url-item, .field-link-target, field-css-classes, .field-xfn, .field-description, .pix_image-item',li).slideUp();
				jQuery('.pix_width-item',li).slideDown();
			} else if(v == 'row'){
				te.html('<strong><em style="color:#0fd500">Row</em></strong>').show();
				p.hide();
				jQuery('.pix_url-item, .field-link-target, field-css-classes, .field-xfn, .field-description, .pix_image-item',li).slideUp();
				jQuery('.pix_width-item',li).slideUp();
			} else {
				te.hide();
				p.show();
				jQuery('.pix_url-item, .field-link-target, field-css-classes, .field-xfn, .field-description, .pix_image-item',li).slideDown();
				jQuery('.pix_width-item',li).slideUp();
			}
		});
	});
}

jQuery(function(){
	if(pagenow=='nav-menus') {

		update_megamenu();

		jQuery('body').ajaxSuccess(function() {
			var set = setTimeout('update_megamenu()',1);
		});
		
		jQuery('#menu-to-edit').bind( "sortstop", function(event, ui) {
			var set = setTimeout('update_megamenu()',1);
		});
		
	}
});

/******************************************************
*
*	Google font select
*
******************************************************/
if(pagenow=='toplevel_page_admin_interface' && typeof google !== 'undefined' && google !== false) {
	google.load("webfont", "1");
}
function init_googlefontselect(){
	jQuery('.pix_font_select').each(function(){
		if(typeof WebFont !== 'undefined' && WebFont !== false) {
			var t = jQuery(this);
			var main = jQuery(this).parents('.pix_groupped');
			var main_list = jQuery('select.main_list',main);
			
			var option = jQuery('option:selected',main_list).attr('data-value');
			var font = jQuery('option:selected',main_list).val();
			var fontCss = jQuery('option:selected',main_list).text();
			var variant = jQuery('select.select_variants_fake option:selected',main).val();
			if ((/regular/i.test(variant))) {
				variant = variant.replace('regular', '400');
			} else if ((/bold/i.test(variant))) {
				variant = variant.replace('bold', '700');
			}
			var subset = jQuery('input.select_subsets_fake',main).val();
			jQuery('select.select_variants_fake',main).closest('.select_wrap').hide();
			jQuery('select.select_subsets_fake',main).hide();
			jQuery('select.select_variants_fake[data-variant="'+option+'"]',main).closest('.select_wrap').show();
			jQuery('select.select_subsets_fake[data-variant="'+option+'"]',main).show();
			WebFont.load({
				google: {
					families: [ font+':200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic:latin' ]
				}
			});
			var style = '';
			if ((/italic/i.test(variant))) {
				variant = variant.replace('italic', '');
				style = 'italic';
			}
			jQuery('.select_font_preview',main).css({'font-style':style,'font-weight':variant}); 
			var fontSize = jQuery('input.font_size',main).val(),
				fontSign = jQuery('.slider_div',main).hasClass('em') ? 'em' : 'px';
			jQuery('.select_font_preview',main).css({'font-family':fontCss, fontSize:fontSize+fontSign, lineHeight:'1em'}); 
			
			
			main.on('change','select.main_list',function(){
				var option = jQuery('option:selected',this).attr('data-value');
				var font = jQuery('option:selected',this).val();
				var fontCss = jQuery('option:selected',this).text();
				jQuery('select.select_variants_fake',main).closest('.select_wrap').hide();
				jQuery('select.select_subsets_fake',main).hide();
				jQuery('select.select_variants_fake[data-variant="'+option+'"]',main).closest('.select_wrap').show();
				var variant = jQuery('select.select_variants_fake[data-variant="'+option+'"] option',main).eq(0).prop('selected',true).val();
				jQuery('select.select_variants_fake[data-variant="'+option+'"]',main).closest('.select_wrap').find('.fake_text').text(variant);
				if ((/regular/i.test(variant))) {
					variant = variant.replace('regular', '400');
				} else if ((/bold/i.test(variant))) {
					variant = variant.replace('bold', '700');
				}
				jQuery('input.select_variants_fake',main).val(variant);
				jQuery('select.select_subsets_fake[data-variant="'+option+'"]',main).show();
				var subset = jQuery('select.select_subsets_fake[data-variant="'+option+'"] option',main).eq(0).prop('selected',true).val();
				if(typeof subset != 'undefined' && subset != false && subset != null) {
					if (subset.substring(subset.length-1) == ",") {
						subset = subset.substring(0, subset.length-1);
					}
					jQuery('input.select_subsets_fake',main).val(subset);
				}
				WebFont.load({
					google: {
					families: [ font+':200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic:latin' ]
					}
				});
				var style = 'normal';
				if ((/italic/i.test(variant))) {
					variant = variant.replace('italic', '');
					style = 'italic';
				}
				jQuery('.select_font_preview',main).css({'font-style':style,'font-weight':variant}); 
				jQuery('.select_font_preview',main).css({'font-family':fontCss}); 
			});
			
			main.on('change','select.select_variants_fake',function(){
				var font = jQuery('select.main_list option:selected',main).val();
				var variant = jQuery('option:selected',this).val();
				var subset = jQuery('input.select_subsets_fake',main).val();
				if (subset.substring(subset.length-1) == ",") {
					subset = subset.substring(0, subset.length-1);
				}
				jQuery('input.select_variants_fake',main).val(variant);
				if ((/regular/i.test(variant))) {
					variant = variant.replace('regular', '');
				} else if (variant=='italic') {
					variant = '400italic';
				} else if ((/bold/i.test(variant))) {
					variant = variant.replace('bold', '700');
				}
				WebFont.load({
					google: {
					families: [ font+':200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic:latin' ]
					}
				});
				var style = 'normal';
				if ((/italic/i.test(variant))) {
					variant = variant.replace('italic', '');
					style = 'italic';
				} else if ( variant == '' ) {
					variant = 'normal';
				}
				jQuery('.select_font_preview',main).css({'font-style':style,'font-weight':variant}); 
			});
			
			jQuery('.slider_cursor',main).bind('slidechange', function(event, ui) {
				var fontSize = jQuery('input.font_size',main).val(),
					fontSign = jQuery('.slider_div',main).hasClass('em') ? 'em' : 'px';
				jQuery('.select_font_preview',main).css({fontSize:fontSize+fontSign, lineHeight:'1em'}); 
			});		

			var select_subsets_fake = jQuery('select.select_subsets_fake:visible',main);
			var font2 = jQuery('select.main_list option:selected',main).val();
			var subset2 = jQuery('input.select_subsets_fake',main).val();
			if(typeof subset2 != 'undefined' && subset2 != false && subset2 != null) {
				var subsetArray = subset2.split(',');
				jQuery.each(subsetArray, function(key, value) {
					jQuery('option[value='+value+']',select_subsets_fake).prop('selected', true);
				});
			}
			var fontCss2 = jQuery('select.main_list option:selected',main).text();
			jQuery('.select_font_preview',main).css('font-family',fontCss2);
			
			main.on('change','select.select_subsets_fake',function(){
				var font = jQuery('select.main_list option:selected',main).val();
				var variant = jQuery('input.select_variants_fake',main).val();
				var subset = "";
				jQuery('option:selected',this).each(function () {
						subset += jQuery(this).val() + ",";
				});
				if (subset.substring(subset.length-1) == ",") {
					subset = subset.substring(0, subset.length-1);
				}
				jQuery('input.select_subsets_fake',main).val(subset);
				var fontCss = jQuery('select.main_list option:selected',main).text();
				WebFont.load({
					google: {
						families: [ font+':'+variant+':'+subset ]
					}
				});
			jQuery('.select_font_preview',main).css('font-family',fontCss); 
			});

			main.on('click','.load_fonts_button',function(){
				jQuery(this).hide();
				jQuery('.for_the_loader',main).append('<div class="pix_loader"></div>');
				jQuery('.pix_loader',main).fadeIn(100);
				jQuery.ajax({
					url: t.attr('data-select'),
					success: function(loadeddata){
						var html = jQuery("<div/>").append(loadeddata.replace(/<script(.|\s)*?\/script>/g, "")).find('#font_list').html();
						jQuery('.dynamic_box',main).html(html);
						smoothify_selects();
						var main_list = jQuery('select.main_list',main)
						var option = jQuery('option:selected',main_list).attr('data-value');
						jQuery('select.select_variants_fake',main).closest('.select_wrap').hide();
						jQuery('select.select_subsets_fake',main).hide();
						jQuery('select.select_variants_fake[data-variant="'+option+'"]',main).closest('.select_wrap').show();
						jQuery('select.select_subsets_fake[data-variant="'+option+'"]',main).show();
						jQuery('.pix_loader',main).fadeOut(100,function(){
							jQuery('.dynamic_box',main).animate({opacity:1},100);
						});
					},
					error: function(){
						jQuery('.dynamic_box',main).html('Sorry, there is a problem. You are unable to load the dynamic content');
					}
				});
				return false;
			});
		} else {
			jQuery(this).hide();
		}
	});
}


/******************************************************
*
*	Google font list
*
******************************************************/
function init_googlefontlist(){
	
	jQuery('.checkboxes_font').each(function(){
		if(jQuery('input[type=checkbox]',this).is(':checked')) {
			jQuery(this).css({background:'#f8f7f3'});
		}
	});
	jQuery('div.checkbox').bind('click',function(){
		var parent = jQuery(this).closest('.checkboxes_font');
		if (jQuery(this).hasClass('checked')) {
			parent.css({background:'transparent'});
		} else {
			parent.css({background:'#f8f7f3'});
		}
	});
	jQuery(document).on('click','a.preview_font_list',function(){
		var parent = jQuery(this).closest('.checkboxes_font'),
			font = jQuery('.font_preview',parent).attr('data-font'),
			webfont = jQuery('.font_preview',parent).attr('data-webfont');
			WebFont.load({
				google: {
				families: [ webfont ]
				}
			});
		jQuery('.font_preview',parent).css({fontFamily:font, fontSize:'30px', fontWeight:'normal'}).animate({lineHeight:'30px'}); 
		jQuery(this).fadeOut(200);
		return false;
	});
}


/******************************************************
*
*	Form colors switchers
*
******************************************************/
function init_formColorsSwitchers(){
	jQuery('input[type="checkbox"][data-panel]').each(function(){
		var t = jQuery(this),
			panel = t.attr('data-panel');
		if ( !t.is(':checked') ) {
			jQuery('div[data-panel="target_'+panel+'"]').show();
		}
		t.on('check_change', function(){
			jQuery('div[data-panel="target_'+panel+'"]').animate({
				height: 'toggle',
				opacity: 'toggle'
			},200);
		});
	});
}


/******************************************************
*
*	Button preview
*
******************************************************/
function init_buttonpreview(){
	
	jQuery('.pix_create_button').each(function(){
		var wrap = jQuery(this),
			bgColor = jQuery('.pix_buttons_bg',wrap).val(),
			color = jQuery('.pix_buttons_textcolor',wrap).val(),
			border = jQuery('.pix_buttons_border',wrap).val();
		if (Modernizr.cssgradients || (jQuery.browser.msie && jQuery.browser.version > 8) ) {
			var browser;
			if (jQuery.browser.webkit) {
				browser = '-webkit-';
			} else if (jQuery.browser.mozilla) {
				browser = '-moz-';
			} else if (jQuery.browser.opera) {
				browser = '-o-';
			} else {
				browser = '';
			}
			jQuery('.button_preview',wrap).css({
					background: bgColor,
					borderBottom: '2px solid ' + border,
					color: color
			});
		} else {
			jQuery('.wrap_button_preview',wrap).remove();
		}
	});

	jQuery('.pix_create_button *').bind('mouseup keyup blur',function(){
		var wrap = jQuery(this).parents('.pix_create_button'),
			bgColor = jQuery('.pix_buttons_bg',wrap).val(),
			color = jQuery('.pix_buttons_textcolor',wrap).val(),
			border = jQuery('.pix_buttons_border',wrap).val();
		if (Modernizr.cssgradients || (jQuery.browser.msie && jQuery.browser.version > 8) ) {
			var browser;
			if (jQuery.browser.webkit) {
				browser = '-webkit-';
			} else if (jQuery.browser.mozilla) {
				browser = '-moz-';
			} else if (jQuery.browser.opera) {
				browser = '-o-';
			} else {
				browser = '';
			}
			jQuery('.button_preview',wrap).css({
					background: bgColor,
					borderBottom: '2px solid ' + border,
					color: color
			});
		}
	});
}

/******************************************************
*
*	Sidebar generator
*
******************************************************/
function pix_remove_sidebar() {
	jQuery('a.create_sidebar').on("click",function(){
		
		var t = jQuery(this);
		
		t.parents('form.dynamic_form').submit();
	
		return false;
		
	});

	jQuery(".pix_remove_sidebar a").on("click",function(){
		
		var t = jQuery(this),
			form = t.parents('form.dynamic_form'),
			row = t.closest('.pix_sidebar_row'),
			ind = t.attr('data-remove');
		
		form.find('input[name=sidebar_removed]').val(ind);
		
		row.animate({opacity:0,height:0, paddingTop:0, paddingBottom:0},150,function(){
			jQuery(this).remove();
			form.submit();
		});

		return false;
		
	});
}

/******************************************************
*
*	Contact form generator
*
******************************************************/
function pix_manage_contactform() {	

	checkDBvalues();
	
	jQuery('a.create_contact_form').click(function(){
		
		jQuery(this).parents('form.dynamic_form').submit();

		return false;
		
	});
	
	
	jQuery('form.check_forms').submit(function(){
		var t = jQuery(this),
			arrVal = new Array(),
			val = jQuery('input#pix_array_your_forms_').val();
		
		if ( !t.hasClass('checked') ) {
			
			jQuery('#forte_contentbar').animate({opacity:.4},250);
			jQuery('#pix_loader').fadeIn(250);
			var data = {
				action: 'pix_sanitize',
				title: val
			};
			jQuery.post(ajaxurl, data)
				.success(function(html){ 
					jQuery('input#pix_array_your_forms_').val(html);
					jQuery('input.pix_contact_form_check').each( function() { 
						arrVal.push(jQuery(this).val());
					});
								
					if ( jQuery.inArray(html, arrVal) > -1 ) {
						
						jQuery('#pix_loader').fadeOut(0);
						jQuery('#forte_contentbar').animate({opacity:1},0);
						jQuery('#pix_dialog_general').text(
						'You already use this name for another form, please, change it'
						).dialog({
							height: 'auto',
							width: 250,
							modal: true,
							dialogClass: 'wp-dialog',
							zIndex: 50
						});
						
					} else {
						jQuery('input#pix_array_your_forms_').attr('name','pix_array_your_forms_['+html+']');
						jQuery('#pix_loader').fadeOut(100);
						jQuery('#pix_success').fadeIn(150);
						t.addClass('checked').submit();
					}
				});
				
			return false;
			
		}
	});
	
	jQuery(".pix_remove_contact_form a").on("click",function(){
		
		var t = jQuery(this);

		jQuery('#pix_dialog_general').text(
		'Are you sure you want to delete this form? You can\'t restore it'
		).dialog({
			height: 'auto',
			width: 250,
			modal: true,
			dialogClass: 'wp-dialog',
			zIndex: 50,
			buttons: {
				"Yes, continue": function() {
					jQuery( this ).dialog( "close" );

					var	form = t.parents('form.dynamic_form'),
						row = t.closest('.pix_contact_form_row'),
						data = t.attr('data-remove');
					form.find('input.pix_contact_form_input').attr('name',data);
					
					row.animate({opacity:0,height:0, paddingTop:0, paddingBottom:0},150,function(){
						row.remove();
						jQuery('#forte_contentbar').animate({opacity:.4},250);
						jQuery('#pix_loader').fadeIn(250);
						
						form.submit();
					});
				},
				"No, cancel": function() {
					jQuery( this ).dialog( "close" );
				}
			}
		});

		return false;
		
	});

	jQuery('.pix_add_contact_field a').click(function(){
		
		var t = jQuery(this),
			p = t.parents('.pix_add_contact_field'),
			par = p.parents('#forte_content_content'),
			clone = par.find('.pix_slide.clone').clone(),
			slideL = jQuery('.pix_slide',par).not('.clone').length;
			
		jQuery('[name*="Nvariable"]',clone).each(function(){
			var nameS = jQuery(this).attr('name'),
				replS = nameS.replace("Nvariable", slideL);
			jQuery(this).attr('name',replS);
		});
		
			
		p.before(clone);
		clone.removeClass('clone').show().css({opacity:0}).slideDown(200,function(){jQuery(this).animate({opacity:1},200)});
		jQuery('select.clone_select',clone).removeClass('clone_select');
		jQuery('input.clone_check',clone).removeClass('clone_check');
		smoothify_selects();
		slidify_checkboxes();
		init_formColorsSwitchers();
		pixInitColorbox();
		checkDBvalues();

		return false;
	});
	
	jQuery('.pix_contact_forms').off('change','select');

	jQuery('.pix_contact_forms').on('change','select',function(){
		var t = jQuery(this),
			par = t.parents('.pix_slide'),
			sel = jQuery('option:selected',t).attr('data-sc'),
			val = jQuery('div[data-stored='+sel+']').html(),
			name = par.find('input[type=text]').val();
			
		val = val.replace(/NvariableNameI/g,sanitize_title(name));
		val = val.replace(/NvariableName/g,name);
		
		if( par.find('div.checkbox').not('.lock').hasClass('checked') ) {
			val = val.replace(']',' required="required"]');
		}

		par.find('textarea').val(val);

	});
	
	jQuery('.pix_contact_forms').on('keyup','input[type=text]',function(){
		
		var t = jQuery(this),
			par = t.parents('.pix_slide'),
			sel = t.val(),
			val = par.find('textarea').val();
				
		if ( !jQuery('div.checkbox.lock',par).hasClass('checked') ) {

			val = val.replace(/>(.*?)<\/label>/,'>'+sel+'</label>');
			val = val.replace(/field=\"(.*?)\"/g,'field="'+sel+'"');
			val = val.replace(/for=\"(.*?)\"/g,'for="'+sanitize_title(sel)+'"');
			val = val.replace(/name=\"(.*?)\"/g,'name="'+sanitize_title(sel)+'"');
			
			par.find('textarea').val(val);
			
		}

		checkDBvalues();

	});
	
	jQuery(document).off('click','.pix_contact_forms div.checkbox');
		
	jQuery(document).on('click','.pix_contact_forms div.checkbox',function(){
		if ( !jQuery(this).hasClass('lock') ) {
			var t = jQuery(this),
				par = t.parents('.pix_slide'),
				val = par.find('textarea').val();
				
			if ( t.hasClass('checked') ) {			
				val = val.replace(/ required="required"/g,'');				
			} else {
				val = val.replace(']',' required="required"]');
			}
			
			par.find('textarea').val(val);
		}
	});
	
}

function checkDBvalues() {
	var valArr = new Array(),
		check = false,
		it = 0,
		already,
		checked;
	jQuery('.pix_contact_forms input[type=text]').each(function(){
		var thisVal = jQuery(this).val();
		if ( jQuery.inArray(thisVal,valArr) != -1 ) {
			check = true;
			already = jQuery.inArray(thisVal,valArr);
			checked = it;
		} 
		valArr.push(jQuery(this).val());
		it++;
	});
	if ( check == true ) {
		jQuery('.pix_contact_forms #message').slideDown();
		jQuery('.pix_contact_forms input[type=text]').eq(already).css({borderColor:'red'});
		jQuery('.pix_contact_forms input[type=text]').eq(checked).css({borderColor:'red'});
	} else {
		jQuery('.pix_contact_forms #message:visible').slideUp();
		jQuery('.pix_contact_forms input[type=text]').css({borderColor:'#c2c2c2'});
		jQuery('.pix_contact_forms input[type=text]').css({borderColor:'#c2c2c2'});
	}
}


/******************************************************
*
*	Price table generator
*
******************************************************/
function pix_manage_pricetable() {	

	jQuery('a.create_price_table').click(function(){
		
		jQuery(this).parents('form.dynamic_form').submit();

		return false;
		
	});
	
	
	jQuery('form.check_tables').submit(function(){
		var t = jQuery(this),
			arrVal = new Array(),
			val = jQuery('input#pix_array_your_tables_').val();
		
		if ( !t.hasClass('checked') ) {
			
			jQuery('#forte_contentbar').animate({opacity:.4},250);
			jQuery('#pix_loader').fadeIn(250);
			var data = {
				action: 'pix_sanitize',
				title: val
			};
			jQuery.post(ajaxurl, data)
				.success(function(html){ 
					jQuery('input#pix_array_your_tables_').val(html);
					jQuery('input.pix_price_table_check').each( function() { 
						arrVal.push(jQuery(this).val());
					});
								
					if ( jQuery.inArray(html, arrVal) > -1 ) {
						
						jQuery('#pix_loader').fadeOut(0);
						jQuery('#forte_contentbar').animate({opacity:1},0);
						jQuery('#pix_dialog_general').text(
						'You already use this name for another table, please, change it'
						).dialog({
							height: 'auto',
							width: 250,
							modal: true,
							dialogClass: 'wp-dialog',
							zIndex: 50
						});
						
					} else {
						jQuery('input#pix_array_your_tables_').attr('name','pix_array_your_tables_['+html+']');
						jQuery('#pix_loader').fadeOut(100);
						jQuery('#pix_success').fadeIn(150);
						t.addClass('checked').submit();
					}
				});
				
			return false;
			
		}
	});

	jQuery(".pix_remove_price_table a").on("click",function(){
		
		var t = jQuery(this);

		jQuery('#pix_dialog_general').text(
		'Are you sure you want to delete this table? You can\'t restore it'
		).dialog({
			height: 'auto',
			width: 250,
			modal: true,
			dialogClass: 'wp-dialog',
			zIndex: 50,
			buttons: {
				"Yes, continue": function() {
					jQuery( this ).dialog( "close" );

					var	form = t.parents('form.dynamic_form'),
						row = t.closest('.pix_price_table_row'),
						data = t.attr('data-remove');
					form.find('input.pix_price_tables_input').attr('name',data);
					
					row.animate({opacity:0,height:0, paddingTop:0, paddingBottom:0},150,function(){
						row.remove();
						jQuery('#forte_contentbar').animate({opacity:.4},250);
						jQuery('#pix_loader').fadeIn(250);
						
						form.submit();
					});
				},
				"No, cancel": function() {
					jQuery( this ).dialog( "close" );
				}
			}
		});

		return false;
		
	});

	jQuery('.pix_add_table_column a').click(function(){
		
		var t = jQuery(this),
			p = t.parents('.pix_add_table_column'),
			par = p.parents('#forte_content_content'),
			clone = par.find('.pix_column.clone').clone(),
			slideL = jQuery('.pix_column',par).not('.clone').length;
			
		jQuery('[name*="Nvariable"]',clone).each(function(){
			var nameS = jQuery(this).attr('name'),
				replS = nameS.replace("Nvariable", slideL);
			jQuery(this).attr('name',replS);
		});
		
		p.before(clone);
		clone.removeClass('clone').show().css({opacity:0}).slideDown(200,function(){jQuery(this).animate({opacity:1},200)});
		jQuery('select.clone_select',clone).removeClass('clone_select');
		jQuery('input.clone_check',clone).removeClass('clone_check');
		smoothify_selects();
		slidify_checkboxes();
		init_formColorsSwitchers();
		pixInitColorbox();

		return false;
	});

	jQuery(document).off('click','a.pix_add_table_cell');
	jQuery(document).on('click','a.pix_add_table_cell',function(){
		
		var t = jQuery(this),
			p = t.parents('.pix_cells'),
			par = t.parents('#forte_content_content'),
			clone = par.find('.pix_cell.clone').clone(),
			slideL = jQuery('.pix_cell',p).not('.clone').length,
			colL = t.parents('.pix_column').eq(0).index();
			
		jQuery('[name*="Nvariable"]',clone).each(function(){
			var nameS = jQuery(this).attr('name'),
				replS = nameS.replace("Nvariable", slideL);
			jQuery(this).attr('name',replS);
		});
		
		jQuery('[name*="Colvariable"]',clone).each(function(){
			var nameS = jQuery(this).attr('name'),
				replS = nameS.replace("Colvariable", colL);
			jQuery(this).attr('name',replS);
		});
		
		t.before(clone);
		clone.removeClass('clone').show().css({opacity:0}).slideDown(200,function(){jQuery(this).animate({opacity:1},200)});
		jQuery('select.clone_select',clone).removeClass('clone_select');
		jQuery('input.clone_check',clone).removeClass('clone_check');
		smoothify_selects();
		slidify_checkboxes();
		init_formColorsSwitchers();
		pixInitColorbox();
		sort_slides();

		return false;
	});
	
	jQuery(document).off('change','.pix_price_tables');

	jQuery('.pix_price_tables').on('change','.pix_cells select',function(){
		var t = jQuery(this),
			par = t.parents('.pix_cell').eq(0),
			val = jQuery('option:selected',t).val();

		if( val == 'button' ) {
			par.find('.block_url').show();
		} else {
			par.find('.block_url').hide();
		}

		if( val == 'header_start' || val == 'header_end' || val == 'separator' ) {
			par.find('.block_textarea').hide();
		} else {
			par.find('.block_textarea').show();
		}

	});
	
	jQuery('.pix_price_tables .pix_cell select, .pix_price_tables_clone.pix_cell select').each(function(){
		var t = jQuery(this),
			par = t.parents('.pix_cell').eq(0),
			val = jQuery('option:selected',t).val();

		if( val == 'button' ) {
			par.find('.block_url').show();
		} else {
			par.find('.block_url').hide();
		}

		if( val == 'header_start' || val == 'header_end' || val == 'separator' ) {
			par.find('.block_textarea').hide();
		} else {
			par.find('.block_textarea').show();
		}

	});
	
	jQuery(document).off('click','a.price_table_toggle.toggle_close');
	
	jQuery(document).on('click','a.price_table_toggle.toggle_close',function(){
		var t = jQuery(this),
			pix_column = t.parents('.pix_column').eq(0),
			pix_cells = pix_column.find('.pix_cells');
			
		t.hide();
		pix_column.find('a.price_table_toggle.toggle_open').show();
		pix_cells.animate({
			opacity: 'toggle',
			height: 'toggle'
		});
		
		return false;

	});
	
	jQuery(document).off('click','a.price_table_toggle.toggle_open');
	
	jQuery(document).on('click','a.price_table_toggle.toggle_open',function(){
		var t = jQuery(this),
			pix_column = t.parents('.pix_column').eq(0),
			pix_cells = pix_column.find('.pix_cells');
			
		t.hide();
		pix_column.find('a.price_table_toggle.toggle_close').show();
		pix_cells.animate({
			opacity: 'toggle',
			height: 'toggle'
		});
		
		return false;

	});
	
}

/******************************************************
*
*	Slideshow generator
*
******************************************************/
function pix_manage_slideshow() {	

	jQuery('a.create_slideshow').click(function(){
		
		jQuery(this).parents('form.dynamic_form').submit();

		return false;
		
	});
	
	
	jQuery(document).on('submit','form.check_slideshows',function(){
		var t = jQuery(this),
			arrVal = new Array(),
			val = jQuery('input#pix_array_your_slideshows_').val();
		
		if ( !t.hasClass('checked') ) {
			
			jQuery('#forte_contentbar').animate({opacity:.4},250);
			jQuery('#pix_loader').fadeIn(250);
			var data = {
				action: 'pix_sanitize',
				title: val
			};
			jQuery.post(ajaxurl, data)
				.success(function(html){ 
					jQuery('input#pix_array_your_slideshows_').val(html);
					jQuery('input.pix_slideshow_check').each( function() { 
						arrVal.push(jQuery(this).val());
					});
								
					if ( jQuery.inArray(html, arrVal) > -1 ) {
						
						jQuery('#pix_loader').fadeOut(0);
						jQuery('#forte_contentbar').animate({opacity:1},0);
						jQuery('#pix_dialog_general').text(
						'You already use this name for another slideshow, please, change it'
						).dialog({
							buttons: false,
							height: 'auto',
							width: 250,
							modal: true,
							dialogClass: 'wp-dialog',
							zIndex: 50,
							close: function(){ 
								jQuery('input#pix_array_your_slideshows_').val('');
								jQuery('input[name="slideshow_action"]').val('add_a_slideshow');
								jQuery('input[name="slideshow_cloned"]').val('');
								jQuery('input[name="slideshow_clone"]').val('');
							}
						});
						
					} else {
						jQuery('input#pix_array_your_slideshows_').attr('name','pix_array_your_slideshows_['+html+']');
						jQuery('#pix_loader').fadeOut(100);
						jQuery('#pix_success').fadeIn(150);
						t.addClass('checked').submit();
					}
				});
				
			return false;
			
		}
	});

	jQuery(".pix_remove_slideshow a").on("click",function(){
		
		var t = jQuery(this);

		jQuery('#pix_dialog_general').text(
		'Are you sure you want to delete this slideshow? You can\'t restore it'
		).dialog({
			height: 'auto',
			width: 250,
			modal: true,
			dialogClass: 'wp-dialog',
			zIndex: 50,
			buttons: {
				"Yes, continue": function() {
					jQuery( this ).dialog( "close" );

					var	form = t.parents('form.dynamic_form'),
						row = t.closest('.pix_slideshow_row'),
						data = t.attr('data-remove');
					form.find('input.pix_slideshow_input').attr('name',data);
					
					row.animate({opacity:0,height:0, paddingTop:0, paddingBottom:0},150,function(){
						row.remove();
						jQuery('#forte_contentbar').animate({opacity:.4},250);
						jQuery('#pix_loader').fadeIn(250);
						
						form.submit();
					});
				},
				"No, cancel": function() {
					jQuery( this ).dialog( "close" );
				}
			}
		});

		return false;
		
	});


	jQuery(document).off("click", ".pix_clone_slideshow a");
	jQuery(document).on("click", ".pix_clone_slideshow a",function(){
		
		var t = jQuery(this);

		var	form = jQuery('form.dynamic_form.check_slideshows'),
			input = form.find('input#pix_array_your_slideshows_'),
			hidden = form.find('input[name="slideshow_action"]'),
			cloned = form.find('input[name="slideshow_cloned"]'),
			clone = form.find('input[name="slideshow_clone"]'),
			dataClone = jQuery(this).attr('data-clone');
		
		jQuery('#pix_dialog_general').html(
		'<form class="pix_clone_name"><fieldset><p><label>Type here below an identificative name<br>for your slideshow, use latin characters only:</label></p><div class="field_wrap"><input type="text" value=""></div></fieldset></form>'
		).dialog({
			height: 'auto',
			width: 'auto',
			modal: true,
			dialogClass: 'wp-dialog',
			zIndex: 50,
			open: function(){
				jQuery(document).on('keyup','.pix_clone_name input',this,function(){
					input.val(jQuery(this).val());
					clone.val(jQuery(this).val());
				});
			},
			buttons: {
				"Submit": function() {
					jQuery( this ).dialog( "close" );
					hidden.val('clone_a_slideshow');
					cloned.val(dataClone);
					form.submit();
				},
				"Cancel": function() {
					jQuery( this ).dialog( "close" );
				}
			}
		});

		return false;
		
	});

	jQuery('.pix_add_slideshow_column a').click(function(){
		
		var t = jQuery(this),
			p = t.parents('.pix_add_slideshow_column'),
			par = p.parents('#forte_content_content'),
			clone = par.find('.pix_column.clone').clone(),
			slideL = jQuery('.pix_column',par).not('.clone').length;
			
		jQuery('[name*="Nvariable"]',clone).each(function(){
			var nameS = jQuery(this).attr('name'),
				replS = nameS.replace("Nvariable", '0');
			jQuery(this).attr('name',replS);
		});
		
		jQuery('[name*="Colvariable"]',clone).each(function(){
			var nameS = jQuery(this).attr('name'),
				replS = nameS.replace("Colvariable", slideL);
			jQuery(this).attr('name',replS);
		});
		
		p.before(clone);
		clone.removeClass('clone').show().css({opacity:0}).slideDown(200,function(){jQuery(this).animate({opacity:1},200)});
		jQuery('select.clone_select',clone).removeClass('clone_select');
		jQuery('input.clone_check',clone).removeClass('clone_check');
		smoothify_selects();
		slidify_checkboxes();
		init_formColorsSwitchers();
		pixInitColorbox();

		return false;
	});

	jQuery(document).off('click','a.pix_add_slideshow_cell');
	jQuery(document).on('click','a.pix_add_slideshow_cell',function(){
		
		var t = jQuery(this),
			p = t.parents('.pix_cells'),
			par = t.parents('#forte_content_content'),
			clone = par.find('.pix_cell.clone').clone(),
			slideL = jQuery('.pix_cell',p).not('.clone').length,
			colL = t.parents('.pix_column').eq(0).index();
			
		jQuery('[name*="Nvariable"]',clone).each(function(){
			var nameS = jQuery(this).attr('name'),
				replS = nameS.replace("Nvariable", slideL);
			jQuery(this).attr('name',replS);
		});
		
		jQuery('[name*="Colvariable"]',clone).each(function(){
			var nameS = jQuery(this).attr('name'),
				replS = nameS.replace("Colvariable", colL);
			jQuery(this).attr('name',replS);
		});
		
		t.before(clone);
		clone.removeClass('clone').show().css({opacity:0}).slideDown(200,function(){jQuery(this).animate({opacity:1},200)});
		jQuery('select.clone_select',clone).removeClass('clone_select');
		jQuery('input.clone_check',clone).removeClass('clone_check');
		smoothify_selects();
		slidify_checkboxes();
		init_formColorsSwitchers();
		pixInitColorbox();
		sort_slides();
		jQuery('.slideel_toggle_more_opts',clone).hide();
		jQuery('select.type_select',clone).each(function(){
			var t = jQuery(this),
				par = t.parents('.pix_cell').eq(0),
				val = jQuery('option:selected',t).attr('data-val');
	
			par.find('.data-values').not('.'+val).hide();
			par.find('.data-values.'+val).show();
	
		});
		init_sliders();

		return false;
	});
	
	jQuery(document).off('change','.pix_slideshows .pix_cells select.type_select');

	jQuery(document).on('change','.pix_slideshows .pix_cells select.type_select',function(){
		var t = jQuery(this),
			par = t.parents('.pix_cell').eq(0),
			val = jQuery('option:selected',t).attr('data-val');

		par.find('.data-values').not('.'+val).hide();
		par.find('.data-values.'+val).show();

	});
	
	jQuery('.pix_slideshows .pix_cell select.type_select, .pix_slideshows_clone.pix_cell select.type_select').each(function(){
		var t = jQuery(this),
			par = t.parents('.pix_cell').eq(0),
			val = jQuery('option:selected',t).attr('data-val');

		par.find('.data-values').not('.'+val).hide();
		par.find('.data-values.'+val).show();

	});
	
	jQuery(document).off('click','a.slideshow_toggle.toggle_close');
	
	jQuery(document).on('click','a.slideshow_toggle.toggle_close',function(){
		var t = jQuery(this),
			pix_column = t.parents('.pix_column').eq(0),
			pix_cells = pix_column.find('.pix_cells');
			
		t.hide();
		pix_column.find('a.slideshow_toggle.toggle_open').show();
		pix_column.find('a.slide_composer').hide();
		pix_cells.animate({
			opacity: 'toggle',
			height: 'toggle'
		});
		
		return false;

	});
	
	jQuery('.slideel_toggle_more_opts:visible').hide();
	
	jQuery(document).off('click','a.slideshow_toggle.toggle_open');
	
	jQuery(document).on('click','a.slideshow_toggle.toggle_open',function(){
		var t = jQuery(this),
			pix_column = t.parents('.pix_column').eq(0),
			pix_cells = pix_column.find('.pix_cells');
			
		t.hide();
		pix_column.find('a.slideshow_toggle.toggle_close').show();
		pix_column.find('a.slide_composer').show();
		pix_cells.animate({
			opacity: 'toggle',
			height: 'toggle'
		});
		
		return false;

	});
	
	jQuery(document).off('click','a.slideel_toggle.toggle_close');
	
	jQuery(document).on('click','a.slideel_toggle.toggle_close',function(){
		var t = jQuery(this),
			pix_slide = t.parents('.pix_slide').eq(0),
			pix_toggle = pix_slide.find('.slideel_toggle_more_opts');
			
		t.hide();
		pix_slide.find('a.slideel_toggle.toggle_open').show();
		pix_toggle.animate({
			opacity: 'toggle',
			height: 'toggle'
		});
		
		return false;

	});
	
	jQuery(document).off('click','a.slideel_toggle.toggle_open');
	
	jQuery(document).on('click','a.slideel_toggle.toggle_open',function(){
		var t = jQuery(this),
			pix_slide = t.parents('.pix_slide').eq(0),
			pix_toggle = pix_slide.find('.slideel_toggle_more_opts');
			
		t.hide();
		pix_slide.find('a.slideel_toggle.toggle_close').show();
		pix_toggle.animate({
			opacity: 'toggle',
			height: 'toggle'
		});
		
		return false;

	});
	
	jQuery(document).off('click','a.slide_composer');
	
	jQuery(document).on('click','a.slide_composer',function(){
		var t = jQuery(this),
			slide = jQuery(this).parents('.pix_slide').eq(0),
			pix_slide = t.parents('.pix_slide').eq(0),
			pix_toggle = pix_slide.find('.slideel_toggle_more_opts');
			
		var previewW = parseFloat(jQuery('input.pix_slideshow_width').val()),
			previewH = parseFloat(jQuery('input.pix_slideshow_height').val());
						
		jQuery('#pix_slideshow_composer_inner').css({
			position: 'relative',
			height: 990/(previewW/previewH),
			width: 990
		}).html('');

		var posInput,
			allowDialog = true;
		
		jQuery('.pix_slide',slide).each(function(){
			var div = jQuery('<div>');
			jQuery('#pix_slideshow_composer_inner').append(div);
			if (jQuery('select.type_select option:selected',this).val()=='background') {
				div.css({
					backgroundImage: 'url('+jQuery(this).find('input[data-obj=background]').val()+')',
					backgroundPosition: 'center',
					backgroundSize: 'cover',
					top: 0,
					left: 0,
					width: 990,
					height: 990/(previewW/previewH),
					overflow: 'hidden',
					position: 'absolute'
				});
			} else if (jQuery('select.type_select option:selected',this).val()=='video') {
				var posInput = jQuery(this).find('input[data-obj=position]'),
					valInput = jQuery(this).find('textarea[data-obj=video]').val();
				eval('var css = {' + posInput.val() + '}');
				
				var valW = valInput.match(/width=\"(.*?)\"/i) != null ? valInput.match(/width=\"(.*?)\"/i) : valInput.match(/width=\'(.*?)\'/i),
					valH = valInput.match(/height=\"(.*?)\"/i) != null ? valInput.match(/height=\"(.*?)\"/i) : valInput.match(/height=\'(.*?)\'/i);
										
				if ( valW == null || valH == null ) {
					alert('Please, set the width and the height of your iframe');
					allowDialog = false;
				} else {
					valW = valW[1];
					valH = valH[1];
					
					div
						.addClass('video')
						.css(css)
						.css({
							backgroundColor: '#000',
							backgroundImage: 'url('+jQuery(this).find('input[data-obj=simpleimage]').val()+')',
							backgroundSize: 'cover',
							width: valW,
							height: valH,
							overflow: 'hidden',
							position: 'absolute'
						});
	
					div.draggable({
						//containment: '#pix_slideshow_composer_inner',
						cursor: 'move',
						stop: function(event, ui) {
							var pos = jQuery(this).position(),
								posString = 'left:' +pos.left + ',top:' + pos.top;
							posInput.attr('data-posfake',posString);
						}
					});
				}
			} else if (jQuery('select.type_select option:selected',this).val()=='image') {
				var posInput = jQuery(this).find('input[data-obj=position]');
				eval('var css = {' + posInput.val() + '}');

				div
					.append('<img src="'+jQuery(this).find('input[data-obj=simpleimage]').val()+'">')
					.addClass('simpleImage')
					.css(css)
					.css({
						position: 'absolute'
					});
					
				div.draggable({
					//containment: '#pix_slideshow_composer_inner',
					cursor: 'move',
					stop: function(event, ui) {
						var pos = jQuery(this).position(),
							posString = 'left:' +pos.left + ',top:' + pos.top;
						posInput.attr('data-posfake',posString);
					}
				});
			} else if (jQuery('select.type_select option:selected',this).val()=='caption') {
				var posInput = jQuery(this).find('input[data-obj=position]'),
					text = jQuery(this).find('textarea[data-obj=caption]').val(),
					height = parseFloat(jQuery(this).find('input[data-obj=height]').val()),
					width = parseFloat(jQuery(this).find('input[data-obj=width]').val()),
					fontSize = parseFloat(jQuery(this).find('input[data-obj=fontsize]').val()),
					wSpace = isNaN(width) ? 'nowrap' : 'normal';

				eval('var css = {' + posInput.val() + '}');

				WebFont.load({
					google: {
						families: [ pix_caption_font_family+':200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic:latin' ]
					}
				});
				
				var fontCSS = pix_caption_font_family.replace(/\+/g,' ');
		
				div
					.addClass('sampleCaption')
					.css(css)
					.css({
						fontFamily: fontCSS,
						position: 'absolute',
						height: height+'%',
						width: width+'%',
						fontSize: fontSize+'px',
						whiteSpace: wSpace
					})
					.text(text);
					
				div.draggable({
					//containment: '#pix_slideshow_composer_inner',
					cursor: 'move',
					stop: function(event, ui) {
						var pos = jQuery(this).position(),
							posString = 'left:' +pos.left + ',top:' + pos.top;
						posInput.attr('data-posfake',posString);
					}
				});
			} else if (jQuery('select.type_select option:selected',this).val()=='html') {
				var posInput = jQuery(this).find('input[data-obj=position]'),
					width = parseFloat(jQuery(this).find('input[data-obj=width]').val()),
					height = parseFloat(jQuery(this).find('input[data-obj=height]').val()),
					code = jQuery(this).find('textarea[data-obj=html]').val();
				eval('var css = {' + posInput.val() + '}');
				
				div
					.append(code)
					.css(css)
					.css({
						position: 'absolute',
						height: height+'%',
						width: width+'%'
					})
					
				div.draggable({
					//containment: '#pix_slideshow_composer_inner',
					cursor: 'move',
					stop: function(event, ui) {
						var pos = jQuery(this).position(),
							posString = 'left:' +pos.left + ',top:' + pos.top;
						posInput.attr('data-posfake',posString);
					}
				});
			}
		});
		
		if ( allowDialog == true ) {
		
			jQuery('#pix_slideshow_composer').dialog({
				height: 'auto',
				width: 'auto',
				modal: true,
				dialogClass: 'wp-dialog',
				zIndex: 150,
				close: function(){
					jQuery('#pix_slideshow_composer_inner > div').remove();
				},
				buttons: [{
					text: 'Cancel',
					class: 'button',
					click: function() {
						jQuery( this ).dialog( "close" );
					}
				},{
					text: 'Edit',
					class: 'button-primary',
					click: function() {
						jQuery('input[data-posfake]',slide).each(function(){
							jQuery(this).val(jQuery(this).attr('data-posfake'));
						});
						jQuery( this ).dialog( "close" );
					}
				}]
			});
			
		}
		
		return false;
	});
	
	jQuery(document).on('blur keyup','input[data-type="until-field"]',function(){
		var val = jQuery(this).val();
		console.log(val);
		jQuery('input[data-type="until-disabled"]').val(val);
	});
}

/******************************************************
*
*	Fullscreen alignment
*
******************************************************/
function pix_fullscreen_alignment() {
	jQuery('.fullscreen_alignment').each(function(){
		
		var t = jQuery(this),
			input = t.find('input[type=hidden]'),
			value = input.val();
			
		t.find('> div[data-align="'+value+'"]').addClass('checked')
		
		t.find('> div').click(function(){
			var alignment = jQuery(this).attr('data-align');
			input.val(alignment);
			t.find('> div').removeClass('checked');
			jQuery(this).addClass('checked');
		});
		
	});
}

jQuery(function(){
	pix_fullscreen_alignment();
});


/******************************************************
*
*	Loader, buddies position
*
******************************************************/
function loader_buddies_pos() {
	if(pagenow=='toplevel_page_admin_interface') {
		var width = jQuery('#forte_wraploader').outerWidth(),
			left = jQuery('#forte_wraploader').offset().left;
		
		jQuery('#forte_wrap #pix_loader, #forte_wrap #pix_success, #forte_wrap #pix_error').css({
			left: left+(width/2)
		});
	}
}
jQuery(function(){
	loader_buddies_pos();
})
jQuery(window).bind('load resize', function(){
	loader_buddies_pos();
})


function sanitize_title(val){
	return val.replace(/[^a-zA-Z 0-9-]+/g,'').toLowerCase().replace(/\s/g,'-');
};


jQuery(window).bind('load',function(){
	toggleWidget();
	jQuery('body').ajaxSuccess(function() {
		toggleWidget();
	});
});

function toggleWidget() {
	jQuery('.widget').each( function() {
		var t = jQuery(this);
		jQuery('select.toggler',this).each(function(){
			var selected = jQuery('option:selected',this).val();
			jQuery('span[data-select='+selected+']',t).show();
		});
			
	});
	
	jQuery('div.widgets-sortables').bind('sortstop',function(event, ui) {
		var t = jQuery(this);
		jQuery('select.toggler',t).each(function(){
			var selected = jQuery('option:selected',this).val();
			jQuery('span[data-select='+selected+']').show();
		});
		jQuery(document).on('change','select.toggler',function(){
			var selected = jQuery('option:selected',this).val();
			jQuery('span[data-select]',t).hide();
			jQuery('span[data-select='+selected+']',t).show();
		});
	});
	
	jQuery('.pix_gallery_widget_wrap').each(function(){
		var t = jQuery(this);
		jQuery(document).off('change','select.toggler');
		jQuery(document).on('change','select.toggler',t,function(){
			var selected = jQuery('option:selected',this).val();
			jQuery('span[data-select]',t).hide();
			jQuery('span[data-select='+selected+']',t).show();
		});
	});
}


/******************************************************
*
*	Select toggle
*
******************************************************/
function selectToggle(){
	jQuery('.pix_select_toggle').each(function(){
		var wrap = jQuery(this),
			sel = jQuery('select[data-select="select"]',wrap),
			opt = jQuery('option:selected',sel).val();
		wrap.find('[data-selected*="'+opt+'"]',wrap).show();
		sel.change(function(){
			opt = jQuery('option:selected',sel).val();
			wrap.find('[data-selected]').each(function(){
				if(jQuery(this).attr('data-selected').indexOf(opt)!=-1 && opt!=''){
					jQuery(this).css('opacity', 0)
						.slideDown(200)
						.animate({opacity:1},{queue:false,duration:200});
				} else {
					jQuery(this)
						.slideUp(200)
						.animate({opacity:0},{queue:false,duration:200});
				}
			});
		});
	});

	/**********************************
	Added this function to selectToggle() even if that's something else
	**********************************/

	jQuery("a.pix_import_skin").on("click",function(){
		
		var t = jQuery(this);

		jQuery('#pix_dialog_general').text(
		'This operation will replace your current settings. You can\'t restore them if you didn\'t export them before. Are you sure you want to continue?'
		).dialog({
			height: 'auto',
			width: 250,
			modal: true,
			dialogClass: 'wp-dialog',
			zIndex: 50,
			buttons: {
				"Yes, continue": function() {
					jQuery( this ).dialog( "close" );

					var	form = t.parents('form.dynamic_form');
					form.submit();
				},
				"No, cancel": function() {
					jQuery( this ).dialog( "close" );
				}
			}
		});
	
		return false;
			
	});

}


jQuery(function(){
	jQuery('a.pix_dont_show').bind('click',function(){
		var div = jQuery(this).parents('div').eq(0),
			form = div.find('form');
		form.find('input[type=text]').val('false');
		form.submit();
		div.slideUp();
		return false;
	});
});


/********************************
*
*	ColorBox
*
********************************/
function pixInitColorbox(){

	if(jQuery.isFunction(jQuery.fn.colorbox)) {

		jQuery("a.colorbox, a[data-colorbox=true]").each(function(){
			if ( jQuery(this).attr('data-iframe')=='true' ) {
				jQuery(this).colorbox({iframe:true, innerWidth:"75%", innerHeight:"75%", scrolling:true});
			} else {
				jQuery(this).colorbox({maxWidth:"90%", maxHeight:"90%", scrolling:false});
			}
		});
	}
}