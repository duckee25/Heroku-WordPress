jQuery.noConflict();

jQuery(window).one('load',function(){
	
	pix_meta_sortable();
	
});

function pix_meta_sortable() {
	jQuery( ".pix_meta_shortcode .pix_slides" ).sortable({ 
		opacity: 0.8,
		items: 'div.pix_slide:visible',
		placeholder: "ui-state-highlight",
		handle: '.pix_slide_move',
		tolerance: 'pointer',
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


	jQuery( ".pix_meta_shortcode .pix_add_slide a" ).click(function(){

		var t = jQuery(this),
			p = t.parents('.pix_add_slide'),
			prev = p.parents('.pix_slides'),
			ser = prev.find('.pix_start_serialize'),
			clone = prev.find('.pix_slide.clone', prev).clone();
		
			
		ser.append(clone);
		clone.removeClass('clone').show().css({opacity:0}).slideDown(200,function(){jQuery(this).animate({opacity:1},200)});
		jQuery('select.clone_select',clone).removeClass('clone_select');


		return false;
	});

	jQuery(document).off('click', ".pix_meta_shortcode .pix_remove_slide a");
	jQuery(document).on('click', ".pix_meta_shortcode .pix_remove_slide a" ,function(){
		var t = jQuery(this),
			prev = t.parents('.pix_slides');
			
		t.parents('.pix_slide').animate({opacity:0},100,function(){jQuery(this).slideUp(200,function(){
			jQuery(this).remove();
			checkDBvalues();
			
			jQuery('.pix_slide',prev).each(function(){
				var key = jQuery(this).index('.pix_slide');
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
}


function htmlEntities(str) {
    return String(str).replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/\'/g, '&quot;');
}


/**
 * WordPress plugin.
 */

function forteTinyMCEinit() {
	var DOM = tinymce.DOM,
		alreadyInit = false;

	
	tinymce.init
	
	tinymce.create('tinymce.plugins.Forte', {
		mceTout : 0,

		
		init : function(ed, url) {
			var t = this;


/**************
	ELEMETS
**************/

			t._handleScBreak(ed, url);
			
			ed.on('init',function() {

				if ( alreadyInit===false ) {
					alreadyInit = true;
					fortePageBuilder();
				}

				var bodyTMCE = tinyMCE.activeEditor.dom.select('body');
				
				var bW = jQuery(bodyTMCE).width(),
					bClass;
				switch (true) {
					case ( bW >= 1024 && bW < 1279 ) :
						bClass = 'media10241279';
						break;
					case ( bW >= 768 && bW < 1023 ) :
						bClass = 'media7681023';
						break;
					case ( bW >= 480 && bW < 767 ) :
						bClass = 'media480767';
						break;
					case ( bW >= 320 && bW < 479 ) :
						bClass = 'media320479';
						break;
					default:
						bClass = '';
						break;
				}
				jQuery(bodyTMCE).attr('data-width',bClass);
				
				
				jQuery(window).bind('resize',function(){
						bW = jQuery(bodyTMCE).width();
						bClass;
					switch (true) {
						case ( bW >= 1024 && bW < 1279 ) :
							bClass = 'media10241279';
							break;
						case ( bW >= 768 && bW < 1023 ) :
							bClass = 'media7681023';
							break;
						case ( bW >= 480 && bW < 767 ) :
							bClass = 'media480767';
							break;
						case ( bW >= 320 && bW < 479 ) :
							bClass = 'media320479';
							break;
						default:
							bClass = '';
							break;
					}
					jQuery(bodyTMCE).attr('data-width',bClass);
				});
			});

			ed.on('BeforeSetContent',function() {

				var head = tinyMCE.activeEditor.dom.select('head');

				var thisLink = jQuery("<link>"),
					thisLink2 = jQuery("<link>");
				thisLink.attr({
						type: 'text/css',
						rel: 'stylesheet',
						href: themedir+'/functions/css/forte_editor_style.css'
				});
				jQuery(head).append( thisLink );

				if ( pix_css_inline == '0' ) {
					thisLink2.attr({
							type: 'text/css',
							rel: 'stylesheet',
							href: upload_dir+'/css_include.css'
					});
				} else {
					thisLink2.attr({
							type: 'text/css',
							rel: 'stylesheet',
							href: themedir+'/functions/css/css_include.css'
					});
				}
				jQuery(head).append( thisLink2 );

				if ( typeof import_google_font !== 'undefined' && import_google_font !== false ) {
					jQuery.each(import_google_font, function(key, value) {
						var googleStyle = jQuery("<link>");
						googleStyle.attr({
								type: 'text/css',
								rel: 'stylesheet',
								href: value
						});
						jQuery(head).append( googleStyle );
					});
				}
			});

		
/**************
	BUTTONS
**************/

/* EDIT TEXT */			
			ed.addButton('pix_edittext_sc', {
				title : 'Edit the text', 
				image : themedir+'/functions/images/sc_icons/edittext_shortcode_icon.png',
				onclick : function() {
					if(tinyMCE.activeEditor.selection.getContent()=='') {
						var textCant = '<p>Sorry, select some text</p>';
						jQuery('body').append('<div id="pix_builder_cant" /></div>');
						jQuery('#pix_builder_cant').html(textCant).dialog({
							buttons: false,
							width: 300,
							modal: true,
							dialogClass: 'wp-dialog',
							title: 'Select some text',
							zIndex: 100
						});
					} else {
						var t = jQuery("#edittext_generator").clone();
						t.dialog({
							height: 'auto',
							maxHeight: '800',
							width: '565',
							modal: true,
							dialogClass: 'wp-dialog',
							title: 'Edit the text',
							zIndex: 100,
							open: function() {
								var selected = tinyMCE.activeEditor.selection.getContent(),
									node = tinyMCE.activeEditor.selection.getNode(),
									nodeClass = jQuery(tinyMCE.activeEditor.selection.getNode()).attr('class'),
									styleNode;
								if ( node.nodeName == 'SPAN' && nodeClass == 'pix_edited_text' ) {
									styleNode = jQuery(node).attr('style');
								} else {
									styleNode = jQuery(node).find('.pix_edited_text').attr('style');
								}
								if ( styleNode ) {
									var style = styleNode.replace(/;/g,'|');
										style = style.replace(/:/g,'|');
										var styleArray = style.split('|');
									var styleArray_2 = [];
									var i = 0;
									while(i<styleArray.length) {
										key = styleArray[i].replace(/ /g,'');
										styleArray_2[key] = styleArray[(i+1)];
										i = i+2;
									}
									if ( styleArray_2['color'] ) {
										jQuery('input[name="text_color"]',t).val(styleArray_2['color'].replace(/ /g,''));
									}
									if ( styleArray_2['background'] ) {
										var bgColor = styleArray_2['background'].replace(/ /g,'');
										if ( bgColor.indexOf('rgb')!=-1 ) {
											bgColor = rgb2hex(styleArray_2['background'].replace(/ /g,''));
										}
										jQuery('input[name="bg_color"]',t).val(bgColor);
									}
									if ( styleArray_2['background-color'] ) {
										var bgColor = styleArray_2['background-color'].replace(/ /g,'');
										if ( bgColor.indexOf('rgb')!=-1 ) {
											bgColor = rgb2hex(bgColor);
										}
										jQuery('input[name="bg_color"]',t).val(bgColor);
									}
									if ( styleNode.indexOf('rgba')!=-1 ) {
										opacity = styleNode.match(/rgba\((.*?),(.*?),(.*?),(.*?)\)/);
										jQuery('input[name="bg_opacity"]',t).val(opacity[4].replace(/ /g,''));
									}
									if ( styleArray_2['line-height'] ) {
										jQuery('input[name="line_height"]',t).val(styleArray_2['line-height'].replace(/ /g,'').replace(/em/g,''));
									}
								}
								init_farbtastic();
								init_sliders();
							}
						});
						jQuery('.button.remove',t).one('click',function(){
							t.dialog('close').remove();
							var node = tinyMCE.activeEditor.selection.getNode();
							var nodeClass = jQuery(tinyMCE.activeEditor.selection.getNode()).attr('class');
							var selected = tinyMCE.activeEditor.selection.getContent();
							var selected2 = selected.replace(/<span(.*?)class=[\'"]pix_edited_text[\'"](.*?)>(.*?)<\/span>/g,'$3');
							if ( node.nodeName != 'BODY' ) {
								jQuery(node).remove();
								tinyMCE.activeEditor.selection.setContent(selected);
							} else {
								var content = tinyMCE.activeEditor.getContent().replace(selected,selected2);
								tinyMCE.activeEditor.setContent(content);
							}
						});
						jQuery('.button.insert',t).one('click',function(){
							var form = jQuery('select option:selected',t).val(),
								selected = tinyMCE.activeEditor.selection.getContent(),
								node = tinyMCE.activeEditor.selection.getNode();
								nodeClass = jQuery(tinyMCE.activeEditor.selection.getNode()).attr('class'),
								color = jQuery('input[name="text_color"]',t).val(),
								bgColor = hex2rgb(jQuery('input[name="bg_color"]',t).val()),
								opacity = jQuery('input[name="bg_opacity"]',t).val(),
								lineHeight = jQuery('input[name="line_height"]',t).val();

							t.dialog('close').remove();
							tinyMCE.activeEditor.focus();
							selected2 = selected.replace(/<span(.*?)class=[\'"]pix_edited_text[\'"](.*?)>(.*?)<\/span>/g,'$3');
							if ( node.nodeName == 'BODY' ) {
								selected2 = selected2.replace(/<(h1|h2|h3|h4|h5|h6|p)(.*?)>(.+?)<\/(h1|h2|h3|h4|h5|h6|p)>/g,'<$1$2><span class="pix_edited_text" style="color:'+color+';background-color:rgba('+bgColor+','+opacity+');line-height:'+lineHeight+'em" data-style="rgba('+bgColor+','+opacity+')">$3</span></$4>');
							} else {
								selected2 = '<span class="pix_edited_text" style="color:'+color+';background-color:'+rgb2hex('rgba('+bgColor+','+opacity+')')+';background-color:rgba('+bgColor+','+opacity+');line-height:'+lineHeight+'em" data-style="rgba('+bgColor+','+opacity+')">'+selected2+'</span>';
							}
							var content = tinyMCE.activeEditor.getContent().replace(selected,selected2);
							tinyMCE.activeEditor.setContent(content);
						});
					}
				}
			});

/* SLIDESHOWS */
			ed.addButton('pix_slideshow_sc', {
				title : 'Add a slideshow',
				image : themedir+'/functions/images/sc_icons/slideshow_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#slideshow_generator").clone();
					t.dialog({
						height: 'auto',
						maxHeight: '800',
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Slideshow shortcode generator',
						zIndex: 100
					});
					jQuery('.button',t).one('click',function(){
						var form = jQuery('select option:selected',t).val();
						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						var sC = '<img src="' + themedir + '/images/blank.gif" data-slideshow="' + form +'" class="mceWPslideshow mceItemNoResize mcePixItem" />';
						tinyMCE.activeEditor.selection.setContent(sC);
					});
				}
			});

/* GOOGLEMAP */			
			ed.addButton('pix_googlemap_sc', {
				title : 'Add a Google map', 
				image : themedir+'/functions/images/sc_icons/googlemap_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#googlemap_generator").clone();
					t.dialog({
						height: 'auto',
						maxHeight: '800',
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Google map shortcode generator',
						zIndex: 100
					});
					
					jQuery('textarea, input',t).off('keyup');
					jQuery('textarea, input',t).on('keyup',function(){
						var extVal = jQuery('textarea',t).val(),
							wVal = jQuery('input.width',t).val(),
							hVal = jQuery('input.height',t).val();

						if ( typeof wVal !== 'undefined' && wVal !== false && wVal.indexOf('%')!=-1 && typeof hVal !== 'undefined' && hVal !== false && hVal.indexOf('%')!=-1  ) {
							wVal = Math.round(parseInt(wVal));							
							hVal = Math.round(parseInt(hVal));
							extVal = extVal.replace(/[^n]width=[\'"](.*?)[\'"]/g,' width="'+wVal+'%"');
							extVal = extVal.replace(/[^n]height=[\'"](.*?)[\'"]/g,' height="'+hVal+'%"');
						}

						/*extVal = extVal.replace(/src=\'(.*?)\'/g,'src="$1&amp;output=embed"');
						extVal = extVal.replace(/src="(.*?)"/g,'src="$1&amp;output=embed"');*/
			
						jQuery('textarea',t).val(extVal);
					})
	
					jQuery('.button',t).one('click',function(){
						var iframe = jQuery('textarea',t).val();
						t.dialog('close').remove();
						tinyMCE.activeEditor.focus();
						tinyMCE.execCommand('mceInsertRawHTML', true, iframe)
					});
				}
			});

/* CONTACT FORMS */			
			ed.addButton('pix_contactform_sc', {
				title : 'Add a contact form', 
				image : themedir+'/functions/images/sc_icons/contactform_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#contactform_generator").clone();
					t.dialog({
						height: 'auto',
						maxHeight: '800',
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Contact form shortcode generator',
						zIndex: 100
					});
					jQuery('.button',t).one('click',function(){
						var form = jQuery('select option:selected',t).val();
						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						var sC = '<img src="' + themedir + '/images/blank.gif" data-form="' + form +'" class="mceWPcontactform mceItemNoResize mcePixItem" />';
						tinyMCE.activeEditor.selection.setContent(sC);
					});
				}
			});

/* TOOLTIPS */			
			ed.addButton('pix_tooltip_sc', {
				title : 'Add a tooltip', 
				image : themedir+'/functions/images/sc_icons/tooltip_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#tooltip_generator").clone();
					t.dialog({
						height: 'auto',
						maxHeight: '800',
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Tooltip shortcode generator',
						zIndex: 100
					});
					jQuery('.button',t).one('click',function(){
						var sC = tinyMCE.activeEditor.selection.getContent();
						if ( sC == '' ) {
							sC = 'Your tooltip';
						}
						var width = jQuery('input',t).val(),
							position = jQuery('select',t).val(),
							content = jQuery('textarea',t).val();
						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						tinyMCE.activeEditor.selection.setContent('[pix_tooltip width="' + width +'" position="' + position + '" tooltip="' + htmlEntities(content) + '"]' + sC + '[/pix_tooltip]');
					});
				}
			});

/* VIDEOS */			
		ed.addButton('pix_video_sc', {
				title : 'Insert a video', 
				image : themedir+'/functions/images/sc_icons/movie_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#video_generator").clone();
					t.dialog({
						height: 600,
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Video shortcode generator',
						zIndex: 100,
						open: function() {
							var sel = jQuery('select.toggler',t),
								show = jQuery('option:selected',sel).val();
							jQuery('#video_generator > div > div').hide();
							jQuery('#video_generator > div > div[data-type='+show+']').show();
							
							sel.change(function(){
								var show = jQuery('option:selected',this).val();
								jQuery('#video_generator > div > div[data-type]').hide();
								jQuery('#video_generator > div > div[data-type='+show+']').show();
							});
						}
					});
					
					jQuery('textarea, input',t).off('keyup');
					jQuery('textarea, input',t).on('keyup',function(){
						var extVal = jQuery('textarea',t).val(),
							wVal = jQuery('input.width',t).val(),
							hVal = jQuery('input.height',t).val();
							
						if ( typeof wVal !== 'undefined' && wVal !== false && wVal.indexOf('%')!=-1 && typeof hVal !== 'undefined' && hVal !== false && hVal.indexOf('%')!=-1  ) {
							wVal = Math.round(parseInt(wVal));							
							hVal = Math.round(parseInt(hVal));
							extVal = extVal.replace(/[^n]width=[\'"](.*?)[\'"]/g,' width="'+wVal+'%"');
							extVal = extVal.replace(/[^n]height=[\'"](.*?)[\'"]/g,' height="'+hVal+'%"');
						}
			
						jQuery('textarea',t).val(extVal);
					})

					jQuery('.button',t).one('click',function(){
					
						var sC;
					
						if ( jQuery('select.toggler option:selected',t).val() == 'externally' ) {
							
							sC = jQuery('textarea',t).val();
							
						} else {
							
							var mp4 = jQuery('input.url',t).val(),
								ogv = jQuery('input.ogv',t).val(),
								poster = jQuery('input.poster',t).val(),
								w = jQuery('input.width',t).val(),
								h = jQuery('input.height',t).val();
			
							sC = '<img src="' + themedir + '/images/blank.gif" data-mp4="' + mp4 +'" data-ogv="' + ogv +'" data-poster="' + poster +'" data-width="' + w +'" data-height="' + h +'" class="mceWPvideo mceItemNoResize mcePixItem" />';
							
						}
					
						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						tinyMCE.activeEditor.selection.setContent(sC);
					});
				}
			}
		);
		
/* AUDIO */			
			ed.addButton('pix_audio_sc', {
				title : 'Insert an MP3', 
				image : themedir+'/functions/images/sc_icons/audio_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#audio_generator").clone();
					t.dialog({
						height: 'auto',
						maxHeight: '800',
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Audio shortcode generator',
						zIndex: 100
					});
					jQuery('.button',t).one('click',function(){
						var n = Math.floor(Math.random()*1000000),
							id = 'id_'+n,
							src = jQuery('input[type=text]',t).val(),
							pl;
						if(jQuery('input[type="checkbox"]',t).is(':checked')){
							pl = 'true';
						} else {
							pl = 'false';
						}
						var sC = '<img src="' + themedir + '/images/blank.gif" data-src="' + src + '" data-id="' + id +'" data-play="' + pl +'" class="mceWPaudio mceItemNoResize mcePixItem" />';

						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						tinyMCE.activeEditor.selection.setContent(sC);
					});
				}
			});

/* ACCORDION */			
			ed.addButton('pix_accordion_sc', {
				title : 'Insert an accordion', 
				image : themedir+'/functions/images/sc_icons/accordion_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#accordion_generator").clone();
					t.dialog({
						height: 700,
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Accordion shortcode generator',
						zIndex: 100,
						/****************CREATOR****************/
						open: function(){
	
							var selected = tinyMCE.activeEditor.selection.getContent();
							
							if ( selected != '' && selected.indexOf('[pix_accordion')==0 ) {
								
								var active = selected.match(/\[pix_accordion data_active=[\'"](.*?)[\'"]/),
									
									getTitles = selected.match(/\[pix_acc data-title=[\'"](.*?)[\'"]\]/g),
									
									getContents = selected.match(/\[pix_acc data-title=[\'"](.*?)[\'"]\](.*?)\[\/pix_acc\]/g);
																								
								jQuery('.pix_start_serialize',t).html('');
								
								jQuery('input.tab_active',t).val(active);
								
								for ( i=0; i<=(getTitles.length-1); i++ ) {
																			
									var clone = jQuery('.clone',t).clone();
									
									clone.removeClass('clone').show();
																			
									jQuery('input',clone).val(getTitles[i].replace(/\[pix_acc data-title=[\'"]/,'').replace(/[\'"]\]/,''));
									
									jQuery('textarea',clone).val(getContents[i].replace(/\[pix_acc data-title=[\'"](.*?)[\'"]\]/,'').replace(/\[\/pix_acc\]/,''));
									
									jQuery('.pix_start_serialize',t).append(clone);
									
								}
							}
							
							pix_meta_sortable();
								
						}
						/***************************************/
					});
					jQuery('.button',t).one('click',function(){

						var aA = parseFloat(jQuery('.accordion_active', t).val()),
							allTitles = [],
							allContents = [],
							sC;
							
						jQuery('.pix_start_serialize input[type=text]', t).not('.accordion_active').each(function() {
							allTitles.push(jQuery(this).val());
						});

						jQuery('.pix_start_serialize textarea', t).each(function() {
							allContents.push(jQuery(this).val());
						});

						sC = '<img src="' + themedir + '/images/blank.gif" data-active="'+aA+'" data-content="';
						
						jQuery.each(allTitles, function(key, value) {
							if(allTitles[key]!=''){
								var pix_acc = ('[pix_acc data-title="'+htmlEntities(allTitles[key])+'"]content'+key+'[/pix_acc]').replace(/[\'"]/g,'pix_quotes');
								sC = sC + pix_acc;
							}
						});
						
						jQuery.each(allContents, function(key, value) {
							var keyCont = htmlEntities(allContents[key]).replace(/\n\r?/g, '[br]').replace(/[\'"]/g,'pix_quotes');
							sC = sC.replace(/\n\r?/g, '[br]').replace('content'+key, keyCont);
						});
						
						sC = sC + '" class="mceWPaccordion mceItemNoResize mcePixItem" />';

						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						tinyMCE.activeEditor.selection.setContent(sC);
					});
				}
			});

/* TABS */			
			ed.addButton('pix_tab_sc', {
				title : 'Insert tabs', 
				image : themedir+'/functions/images/sc_icons/tab_shortcode_icon.png',
				onclick : function() {
					
					var t = jQuery("#tab_generator").clone();
					
					t.dialog({
						height: 700,
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Tab shortcode generator',
						zIndex: 100,
						/****************CREATOR****************/
						open: function(){
	
							var selected = tinyMCE.activeEditor.selection.getContent();
							
							if ( selected != '' && selected.indexOf('[pix_tabs')==0 ) {
								
								var active = selected.match(/\[pix_tabs data_active=[\'"](.*?)[\'"]/),
									
									getTitles = selected.match(/\[pix_tab data_title=[\'"](.*?)[\'"]\]/g),
									
									selected = selected.replace(/\[pix_tab_content (.*?)\]/g, '[pix_tab_content]'),
									
									getContents = selected.match(/\[pix_tab_content\](.*?)\[\/pix_tab_content\]/g);
																								
								jQuery('.pix_start_serialize',t).html('');
								
								jQuery('input.tab_active',t).val(active[1]);
								
								for ( i=0; i<=(getTitles.length-1); i++ ) {
																			
									var clone = jQuery('.clone',t).clone();
									
									clone.removeClass('clone').show();
																			
									jQuery('input',clone).val(getTitles[i].replace(/\[pix_tab data_title=\"/,'').replace(/\"\]/,''));
									
									jQuery('textarea',clone).val(getContents[i].replace(/\[pix_tab_content\]/,'').replace(/\[\/pix_tab_content\]/,''));
									
									jQuery('.pix_start_serialize',t).append(clone);
									
								}
							}
							
							pix_meta_sortable();
								
						}
						/***************************************/
					});

					jQuery('.button',t).one('click',function(){
						var aA = parseFloat(jQuery('.tab_active', t).val()),
							allTitles = [],
							allContents = [],
							sC;
							
						jQuery('.pix_start_serialize input[type=text]', t).not('.tab_active').each(function() {
							allTitles.push(jQuery(this).val());
						});

						jQuery('.pix_start_serialize textarea', t).each(function() {
							allContents.push(jQuery(this).val());
						});

						sC = '<img src="' + themedir + '/images/blank.gif" data-active="'+aA+'" data-content="[ul]';
						
						jQuery.each(allTitles, function(key, value) {
							if(allTitles[key]!=''){
								var pix_tab = ('[pix_tab data-title="'+htmlEntities(allTitles[key])+'"]').replace(/[\'"]/g,'pix_quotes');
								sC = sC + pix_tab;
							}
						});
						
						sC = sC + '[/ul]';
						
						jQuery.each(allTitles, function(key, value) {
							if(allTitles[key]!=''){
								var pix_tab = ('[pix_tab_content data-title="'+htmlEntities(allTitles[key])+'"]content'+key+'[/pix_tab_content]').replace(/[\'"]/g,'pix_quotes');
								sC = sC + pix_tab;
							}
						});
						
						jQuery.each(allContents, function(key, value) {
							var keyCont = htmlEntities(allContents[key]).replace(/\n\r?/g, '[br]').replace(/[\'"]/g,'pix_quotes');
							sC = sC.replace('content'+key, keyCont);
						});
						
						sC = sC + '" class="mceWPtabs mceItemNoResize mcePixItem" />';

						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						tinyMCE.activeEditor.selection.setContent(sC);
					});
				}
			});

/* SITEMAP */			
			ed.addButton('pix_sitemap_sc', {
				title : 'Add a Site map', 
				image : themedir+'/functions/images/sc_icons/sitemap_shortcode_icon.png',
				onclick : function() {
					var sC = '[pix_sitemap]';
					tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
				}
			});

/* BOXES */			
			ed.addButton('pix_box_sc', {
				title : 'Insert a box', 
				image : themedir+'/functions/images/sc_icons/box_shortcode_icon.png',
				onclick : function() {
					
					var t = jQuery("#box_generator").clone();

					t.dialog({
						height: 'auto',
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Box shortcode generator',
						zIndex: 100
					});
					jQuery('.button',t).one('click',function(){
						t.dialog('close').remove();
						var sC = tinyMCE.activeEditor.selection.getContent();
						if ( sC == '' ) {
							sC = 'Your box content';
						}
						var type = jQuery('select option:selected',t).val();
						tinyMCE.activeEditor.focus(); 
						tinyMCE.activeEditor.selection.setContent('[pix_box type="'+type+'"]' + sC + '[/pix_box]');
					});
				}
			});

/* TESTIMONIALS */			
			ed.addButton('pix_testimonial_sc', {
				title : 'Insert testimonials', 
				image : themedir+'/functions/images/sc_icons/testimonial_shortcode_icon.png',
				onclick : function() {
					
					var t = jQuery("#testimonial_generator").clone();

					t.dialog({
						height: 'auto',
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Testimonial shortcode generator',
						zIndex: 100
					});
					jQuery('.button',t).one('click',function(){
						t.dialog('close').remove();
						var ids = jQuery('input[type=text]',t).val().replace(/\ /g, ''),
							layout = jQuery('select option:selected',t).val();
						tinyMCE.activeEditor.focus(); 
						var sC = '<img src="' + themedir + '/images/blank.gif" data-ids="' + ids +'" data-layout="' + layout +'" class="mceWPtestimonials mceItemNoResize mcePixItem" />';
						tinyMCE.activeEditor.selection.setContent(sC);
					});
				}
			});

/* DROPCAP */			
			ed.addButton('pix_dropcap_sc', {
				title : 'Add a dropcap letter', 
				image : themedir+'/functions/images/sc_icons/dropcap_shortcode_icon.png',
				onclick : function() {
					var sC = tinyMCE.activeEditor.selection.getContent();
					if ( sC == '' ) {
						sC = 'A';
					}
					tinyMCE.activeEditor.focus(); 
					tinyMCE.activeEditor.selection.setContent('[pix_dropcap]' + sC + '[/pix_dropcap]');
				}
			});

/* BUTTONS */			
			ed.addButton('pix_button_sc', {
				title : 'Insert a button', 
				image : themedir+'/functions/images/sc_icons/button_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#button_generator").clone();
					t.dialog({
						height: 350,
						width: 520,
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Drop cap shortcode generator',
						zIndex: 100
					});
					jQuery('.button',t).one('click',function(){
						t.dialog('close').remove();
						var sC = tinyMCE.activeEditor.selection.getContent();
						if ( sC == '' ) {
							sC = 'Your button content';
						}
						var size = jQuery('select.size option:selected',t).val(),
							type = jQuery('select.color option:selected',t).val();
						tinyMCE.activeEditor.focus(); 
						tinyMCE.activeEditor.selection.setContent('[pix_button type="'+type+'" size="'+size+'"]' + sC + '[/pix_button]');
					});
				}
			});

/* PRICE TABLES */			
			ed.addButton('pix_pricetable_sc', {
				title : 'Add a price table', 
				image : themedir+'/functions/images/sc_icons/pricetable_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#pricetable_generator").clone();
					t.dialog({
						height: 'auto',
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Price table shortcode generator',
						zIndex: 100
					});
					jQuery('.button',t).one('click',function(){
						var form = jQuery('select option:selected',t).val();
						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						var sC = '<img src="' + themedir + '/images/blank.gif" data-table="' + form +'" class="mceWPpricetable mceItemNoResize mcePixItem" />';
						tinyMCE.activeEditor.selection.setContent(sC);
					});
				}
			});

/* HR */			
			ed.addButton('pix_hr_sc', {
				title : 'Insert a hr', 
				image : themedir+'/functions/images/sc_icons/hr_shortcode_icon.png',
				onclick : function() {
					var sC = '<img src="' + themedir + '/images/blank.gif" class="mceWPhr mceItemNoResize mcePixItem" />';
					tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
				}
			});

/* CLEAR */			
			ed.addButton('pix_clear_sc', {
				title : 'Insert a clear div', 
				image : themedir+'/functions/images/sc_icons/clear_shortcode_icon.png',
				onclick : function() {
					var sC = '<img src="' + themedir + '/images/blank.gif" class="mceWPclear mceItemNoResize mcePixItem" />';
					tinyMCE.execCommand('mceInsertContent', false, sC);
				}
			});

/* TWEETS */			
			ed.addButton('pix_tweet_sc', {
				title : 'Your last tweet', 
				image : themedir+'/functions/images/sc_icons/tweets_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#tweets_generator").clone();
					t.dialog({
						height: 'auto',
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Twitter shortcode generator',
						zIndex: 100
					});
					
					jQuery('.button',t).one('click',function(){
						var user = jQuery('input.user',t).val(),
							replies = jQuery('input[type=checkbox]',t).is(':checked') ? 'hide' : 'show',
							blacklist = jQuery('input.black',t).val(),
							whitelist = jQuery('input.white',t).val();
							amount = jQuery('input.amount',t).val();
							layout = jQuery('select[data-type=layout] option:selected',t).val(),
						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						tinyMCE.activeEditor.selection.setContent('[pix_tweet user="'+user+'" replies="'+replies+'" blacklist="'+blacklist+'" whitelist="'+whitelist+'" amount="'+amount+'" layout="'+layout+'"]');
					});
				}
			});

/* GALLERIES */			
			ed.addButton('pix_gallery_sc', {
				title : 'Add a gallery', 
				image : themedir+'/functions/images/sc_icons/gallery_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#gallery_generator").clone();
					t.dialog({
						height: 600,
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Display a gallery',
						zIndex: 100
					});
					
					jQuery('.button',t).one('click',function(){
						var galleries = jQuery('select[multiple]',t).val(),
							featured = jQuery('input[data-type=featured]',t).is(':checked') ? 'true' : 'false',
							sorting = jQuery('input[data-type=sorting]',t).is(':checked') ? 'true' : 'false',
							order = jQuery('input[data-type=order]',t).is(':checked') ? 'true' : 'false',
							sort = jQuery('input[data-type=sort]',t).is(':checked') ? 'true' : 'false',
							layout = jQuery('select[data-type=layout] option:selected',t).val(),
							excerpt = jQuery('input[data-type=excerpt]',t).val(),
							amount = jQuery('input[data-type=amount]',t).val(),
							pagenavi = jQuery('select[data-type=pagenavi] option:selected',t).val(),
							linkto = jQuery('select[data-type=linkto] option:selected',t).val(),
							titles = jQuery('input[data-type=titles]',t).is(':checked') ? 'true' : 'false',
							comments = jQuery('input[data-type=comments]',t).is(':checked') ? 'true' : 'false',
							morelink = jQuery('input[data-type=more]',t).is(':checked') ? 'true' : 'false',
							likebutton = jQuery('input[data-type=like]',t).is(':checked') ? 'true' : 'false';
						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						tinyMCE.activeEditor.selection.setContent('[pix_galleries galleries="'+galleries+'" featured="'+featured+'" layout="'+layout+'" sorting="'+sorting+'" order="'+order+'" sort="'+sort+'" excerpt="'+excerpt+'" amount="'+amount+'" linkto="'+linkto+'" titles="'+titles+'" comments="'+comments+'" morelink="'+morelink+'" likebutton="'+likebutton+'" pagenavigation="'+pagenavi+'"]');
					});
				}
			});

/* CATEGORIES */			
			ed.addButton('pix_category_sc', {
				title : 'Add a category', 
				image : themedir+'/functions/images/sc_icons/category_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#category_generator").clone();
					t.dialog({
						height: 600,
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Display a category',
						zIndex: 100
					});
					
					jQuery('.button',t).one('click',function(){
						var cat = jQuery('select[multiple]',t).val(),
							featured = jQuery('input[data-type=featured]',t).is(':checked') ? 'true' : 'false',
							sorting = jQuery('input[data-type=sorting]',t).is(':checked') ? 'true' : 'false',
							order = jQuery('input[data-type=order]',t).is(':checked') ? 'true' : 'false',
							sort = jQuery('input[data-type=sort]',t).is(':checked') ? 'true' : 'false',
							layout = jQuery('select[data-type=layout] option:selected',t).val(),
							excerpt = jQuery('input[data-type=excerpt]',t).val(),
							amount = jQuery('input[data-type=amount]',t).val(),
							pagenavi = jQuery('select[data-type=pagenavi] option:selected',t).val(),
							linkto = jQuery('select[data-type=linkto] option:selected',t).val(),
							titles = jQuery('input[data-type=titles]',t).is(':checked') ? 'true' : 'false',
							comments = jQuery('input[data-type=comments]',t).is(':checked') ? 'true' : 'false',
							morelink = jQuery('input[data-type=more]',t).is(':checked') ? 'true' : 'false',
							likebutton = jQuery('input[data-type=like]',t).is(':checked') ? 'true' : 'false',
							meta = jQuery('input[data-type=meta]',t).is(':checked') ? 'true' : 'false';
						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						tinyMCE.activeEditor.selection.setContent('[pix_categories cat="'+cat+'" featured="'+featured+'" layout="'+layout+'" sorting="'+sorting+'" order="'+order+'" sort="'+sort+'" excerpt="'+excerpt+'" amount="'+amount+'" linkto="'+linkto+'" titles="'+titles+'" comments="'+comments+'" morelink="'+morelink+'" likebutton="'+likebutton+'" pagenavigation="'+pagenavi+'" meta="'+meta+'"]');
					});
				}
			});

		},


		_handleScBreak : function(ed, url) {

			var clearHTML = '<img src="' + themedir + '/images/blank.gif" data-content="$1" class="mceWPclear mceItemNoResize mcePixItem" />',
				hrHTML = '<img src="' + themedir + '/images/blank.gif" $1 class="mceWPhr mceItemNoResize mcePixItem" />',
				slideshowHTML = '<img src="' + themedir + '/images/blank.gif" $1 class="mceWPslideshow mceItemNoResize mcePixItem" />',
				contactformHTML = '<img src="' + themedir + '/images/blank.gif" $1 class="mceWPcontactform mceItemNoResize mcePixItem" />',
				videoHTML = '<img src="' + themedir + '/images/blank.gif" $1 class="mceWPvideo mceItemNoResize mcePixItem" />',
				audioHTML = '<img src="' + themedir + '/images/blank.gif" $1 class="mceWPaudio mceItemNoResize mcePixItem" />',
				accordionHTML = '<img src="' + themedir + '/images/blank.gif" data-active="$1" data-content="$2" class="mceWPaccordion mceItemNoResize mcePixItem" />',
				tabsHTML = '<img src="' + themedir + '/images/blank.gif" data-active="$1" data-content="$2" class="mceWPtabs mceItemNoResize mcePixItem" />',
				pricetableHTML = '<img src="' + themedir + '/images/blank.gif" $1 class="mceWPpricetable mceItemNoResize mcePixItem" />',
				testimonialsHTML = '<img src="' + themedir + '/images/blank.gif" $1 class="mceWPtestimonials mceItemNoResize mcePixItem" />',
				columnArray,
				columnArray2 = new Array(),
				loopColumns = 0,
				colID = 0;
			
			// Display clearbreak instead if img in element path
			ed.on('PostRender',function() {
				if (ed.theme.onResolveName) {
					ed.theme.onResolveName.add(function(th, o) {
						if (o.node.nodeName == 'IMG') {
							if ( ed.dom.hasClass(o.node, 'mceWPclear') )
								o.name = 'wpclear';
						}

					});
				}
			});

			// Replace clearbreak with images
			ed.on('BeforeSetContent',function(o) {
				if ( o.content ) {
					o.content = o.content.replace(/\[clear\]/g, clearHTML);

					o.content = o.content.replace(/\[hr\]/g, hrHTML);

					o.content = o.content.replace(/\[pix_slideshow(.*?)\]/g, slideshowHTML);
					
					o.content = o.content.replace(/\[pix_price_table(.*?)\]/g, pricetableHTML);
					
					o.content = o.content.replace(/\[pix_testimonials(.*?)\]/g, testimonialsHTML);
					
					o.content = o.content.replace(/\[pix_contact_form(.*?)\]/g, contactformHTML);
					
					o.content = o.content.replace(/\[pix_video(.*?)\]/g, videoHTML);
					
					o.content = o.content.replace(/\[pix_audio(.*?)\]/g, audioHTML);
					
					o.content = o.content.replace(/\[pix_acc data_title=([\'"])(.*?)([\'"])\](.*?)\[\/pix_acc\]/g, function(match, $1, $2, $3, $4, offset, string) { return '[pix_acc data_title=pix_quotes'+$2+'pix_quotes]'+htmlEntities($4)+'[/pix_acc]'; })
					
					o.content = o.content.replace(/\[pix_accordion data_active=[\'"](.*?)[\'"]\](.*?)\[\/pix_accordion\]/g, accordionHTML);
					
					o.content = o.content.replace(/\[pix_tabs data_active=([\'"])(.*?)([\'"])\](.*?)\[\/pix_tabs\]/g, function(match, $1, $2, $3, $4, offset, string) { return '[pix_tabs data_active="'+$2+'"]'+$4.replace(/"/g,'pix_quotes')+'[/pix_tabs]'; })
					
					o.content = o.content.replace(/\[pix_tabs data_active=[\'"](.*?)[\'"]\](.*?)\[\/pix_tabs\]/g, tabsHTML);
					
					o.content = o.content.replace(/data_/g, 'data-');
					
					var matchThis = /<div id=[\'"]mCePixPrevent[\'"]>/;
					check = o.content.match(matchThis);

					/*o.content = o.content.replace(/<br \/>/g, '[br]');
					o.content = o.content.replace(/<br>/g, '[br]');*/
				}
			});
			
			if ( !jQuery('input[name="pix_editor_field"]').is(':checked') && typeof tinymce!=='undefined' && typeof tinymce.get('content')!=='undefined' && tinymce.get('content')!==null ) {
				tinymce.get('content').off('keyPress');
				tinymce.get('content').on('keyPress',function(o) {
					var textCant = '<p>Sorry, you can\'t do this operation.</p><p>This is only the preview of your web page, to edit it switch to the &quot;Builder&quot; mode</p><p>P.S.: don\'t forget to read the documentation and watch the tutorial :-)</p>';
					jQuery('body').append('<div id="pix_builder_cant" /></div>');
					jQuery('#pix_builder_cant').html(textCant).dialog({
						buttons: false,
						width: 300,
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Sorry, you can\'t',
						zIndex: 100
					});
					return false;
				});

				tinymce.get('content').on('click',function(o) {
					return false;
				});
			}

			ed.on('LoadContent',function(o) {
				/*gridHTML = '<img src="' + themedir + '/images/blank.gif" class="mceWPgrid mceItemNoResize mcePixItem" />';
				var test = /\[pix_grid\](.*?)\[\/pix_grid\]/g;
				columnArray = o.content.match(test);
				o.content = o.content.replace(/\[pix_grid\](.*?)\[\/pix_grid\]/g, gridHTML);
				tinyMCE.activeEditor.setContent(o.content);
				var im = 0;
				var img = tinyMCE.activeEditor.dom.select('img.mceWPgrid');
				jQuery(img).each(function(){
					jQuery(this).attr('id','column_image_'+im);
					im++;
				});
				for(var i in columnArray)
				{
					columnArray2['column_image_'+i] = columnArray[i];
				}
				loopColumns = 0;*/
				
				if ( !jQuery('input[name="pix_editor_field"]').is(':checked') && typeof tinymce!=='undefined' && typeof tinymce.get('content')!=='undefined' && tinymce.get('content')!==null ) {
					jQuery('#wp-content-wrap .mce-toolbar-grp .mce-container').hide();
					var allImg = tinyMCE.get('content').dom.select('img');
					var allA = tinyMCE.get('content').dom.select('a');
					
					jQuery(allImg).bind('click dblclick mouseup',function(event){
						return false;
					});
					
					jQuery(allA).bind('click dblclick mouseup',function(event){
						return false;
					});
									
					var tinyMCEbody = tinyMCE.get('content').dom.select('body');
					
					jQuery(tinyMCEbody).off('click mousedown keypress mouseup');
					jQuery(tinyMCEbody).on('click mousedown keypress mouseup',function(event){
						if ( !jQuery('#pix_builder_cant').length ) {
							var textCant = '<p>Sorry, you can\'t modify the visual editor directly from here. Switch to &quot;Builder&quot; mode and edit each section</p>';
							jQuery('body').append('<div id="pix_builder_cant" /></div>');
							jQuery('#pix_builder_cant').html(textCant).dialog({
								buttons: false,
								width: 300,
								modal: true,
								dialogClass: 'wp-dialog',
								title: 'Select some text',
								zIndex: 100,
								close: function(){
									jQuery('#pix_builder_cant').remove();
								}
							});
						} else {
							return false;
						}
					});
					
					tinyMCE.get('content').getBody().setAttribute('contenteditable', false);
				}
				
				
				/******************************************************
				*
				*	iFrame height
				*
				******************************************************/
				var allImgIframe = tinyMCE.activeEditor.dom.select('img.mceItemIframe');
				jQuery(allImgIframe).bind('load',function () {
					var t = jQuery(this),
						/*dataJson = t.attr('data-mce-json'),
						dataJson = dataJson.replace(/'/g,'"'),*/
						h = t.attr('height'),
						w = t.width();

						//var jsonObj = jQuery.parseJSON('[' + dataJson + ']');
						
						
					if ( typeof h !== 'undefined' && h !== false && h.indexOf('%')!=-1 && !jQuery(this).parents('div').eq(0).hasClass('letmebe') ) {
						ratio = Math.round(parseInt(h));
						t.height( (w*(ratio*0.01)) );
						jQuery(window).bind('resize',function(){
							w = t.width();
							t.height( (w*(ratio*0.01)) );
						});
					}
					
				});
			});
			
			// Replace images with clearbreak
			ed.on('PostProcess',function(o) {

				if (o.get)
					o.content = o.content.replace(/<img[^>]+>/g, function(im) {
						if (im.indexOf('class="mceWPclear') !== -1) {
							im = '[clear]';
						}
						if (im.indexOf('class="mceWPhr') !== -1) {
							im = '[hr]';
						}
						if (im.indexOf('class="mceWPslideshow') !== -1) {
							var m, content = (m = im.match(/data-slideshow=[\'"](.*?)[\'"]/)) ? m[1] : '';
							im = '[pix_slideshow data_slideshow=\''+content+'\']';
						}
						if (im.indexOf('class="mceWPpricetable') !== -1) {
							var m, content = (m = im.match(/data-table=[\'"](.*?)[\'"]/)) ? m[1] : '';
							im = '[pix_price_table data_table=\''+content+'\']';
						}
						if (im.indexOf('class="mceWPtestimonials') !== -1) {
							var m, ids = (m = im.match(/data-ids=[\'"](.*?)[\'"]/)) ? m[1] : '',
								m2, layout = (m2 = im.match(/data-layout=[\'"](.*?)[\'"]/)) ? m2[1] : '';
							im = '[pix_testimonials data_ids=\''+ids+'\' data_layout=\''+layout+'\']';
						}
						if (im.indexOf('class="mceWPcontactform') !== -1) {
							var m, content = (m = im.match(/data-form=[\'"](.*?)[\'"]/)) ? m[1] : '';
							im = '[pix_contact_form data_form=\''+content+'\']';
						}
						if (im.indexOf('class="mceWPvideo') !== -1) {
							var m, mp4 = (m = im.match(/data-mp4=[\'"](.*?)[\'"]/)) ? m[1] : '',
								m2, ogv = (m2 = im.match(/data-ogv=[\'"](.*?)[\'"]/)) ? m2[1] : '',
								m3, poster = (m3 = im.match(/data-poster=[\'"](.*?)[\'"]/)) ? m3[1] : '',
								m4, width = (m4 = im.match(/data-width=[\'"](.*?)[\'"]/)) ? m4[1] : '',
								m5, height = (m5 = im.match(/data-height=[\'"](.*?)[\'"]/)) ? m5[1] : '';
							im = '[pix_video data_mp4=\''+mp4+'\' data_ogv=\''+ogv+'\' data_poster=\''+poster+'\' data_width=\''+width+'\' data_height=\''+height+'\']';
						}
						if (im.indexOf('class="mceWPaudio') !== -1) {
							var m, src = (m = im.match(/data-src=[\'"](.*?)[\'"]/)) ? m[1] : '',
								m2, id = (m2 = im.match(/data-id=[\'"](.*?)[\'"]/)) ? m2[1] : '',
								m3, play = (m3 = im.match(/data-play=[\'"](.*?)[\'"]/)) ? m3[1] : '';
							im = '[pix_audio data_src=\''+src+'\' data_id=\''+id+'\' data_play=\''+play+'\']';
						}
						if (im.indexOf('class="mceWPaccordion') !== -1) {
							var m, active = (m = im.match(/data-active=[\'"](.*?)[\'"]/)) ? m[1] : '',
								m2, content = (m2 = im.match(/data-content=[\'"](.*?)[\'"]/)) ? m2[1] : '';
							content = content.replace(/pix_quotes/g,'"');
							im = '[pix_accordion data_active=\''+active+'\']'+content+'[/pix_accordion]';
						}
						if (im.indexOf('class="mceWPtabs') !== -1) {
							var m, active = (m = im.match(/data-active=[\'"](.*?)[\'"]/)) ? m[1] : '',
								m2, content = (m2 = im.match(/data-content=[\'"](.*?)[\'"]/)) ? m2[1] : '';
							content = content.replace(/pix_quotes/g,'"');
							im = '[pix_tabs data_active=\''+active+'\']'+content+'[/pix_tabs]';
						}
						im = im.replace(/data-/g, 'data_');
						return im;
					});
					//o.content = o.content.replace(/\[br\]/g, '\n\r');
					colID = 0;
			});

			ed.on('DblClick',function(e) {
				if ( e.target.nodeName == 'IMG' && jQuery(e.target).hasClass('mceWPslideshow')) {
					var t = jQuery("#slideshow_generator").clone();
					t.dialog({
						height: 'auto',
						maxHeight: '800',
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Slideshow shortcode generator',
						zIndex: 100,
						open: function() {
							var sel = jQuery('select',t),
								selected = jQuery(e.target).attr('data-slideshow');
							jQuery('option[value="'+selected+'"]',sel).prop('selected',true);
						}
					});
					jQuery('.button',t).one('click',function(){
						var form = jQuery('select option:selected',t).val();
						t.dialog('close').remove();
						tinyMCE.activeEditor.focus();
						jQuery(e.target).attr('data-slideshow',form);
					});
				} else if ( e.target.nodeName == 'IMG' && jQuery(e.target).hasClass('mceWPpricetable')) {
					var t = jQuery("#pricetable_generator").clone();
					t.dialog({
						height: 'auto',
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Price table shortcode generator',
						zIndex: 100,
						open: function() {
							var sel = jQuery('select',t),
								selected = jQuery(e.target).attr('data-table');
							jQuery('option[value="'+selected+'"]',sel).prop('selected',true);
						}
					});
					jQuery('.button',t).one('click',function(){
						var form = jQuery('select option:selected',t).val();
						t.dialog('close').remove();
						tinyMCE.activeEditor.focus();
						jQuery(e.target).attr('data-table',form);
					});
				} else if ( e.target.nodeName == 'IMG' && jQuery(e.target).hasClass('mceWPtestimonials')) {
					var t = jQuery("#testimonial_generator").clone();
					t.dialog({
						height: 'auto',
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Testimonial shortcode generator',
						zIndex: 100,
						open: function() {
							var sel = jQuery('select',t),
								ids = jQuery(e.target).attr('data-ids'),
								layout = jQuery(e.target).attr('data-layout');
							jQuery('input[type="text"]',t).val(ids);
							jQuery('option[value="'+layout+'"]',sel).prop('selected',true);
						}
					});
					jQuery('.button',t).one('click',function(){
						t.dialog('close').remove();
						var ids = jQuery('input[type=text]',t).val().replace(/\ /g, ''),
							layout = jQuery('select option:selected',t).val();
						tinyMCE.activeEditor.focus(); 
						var sC = '<img src="' + themedir + '/images/blank.gif" data-ids="' + ids +'" data-layout="' + layout +'" class="mceWPtestimonials mceItemNoResize mcePixItem" />';
						tinyMCE.activeEditor.selection.setContent(sC);
					});
				} else if ( e.target.nodeName == 'IMG' && jQuery(e.target).hasClass('mceWPcontactform')) {
					var t = jQuery("#contactform_generator").clone();
					t.dialog({
						height: 'auto',
						maxHeight: '800',
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Contact form shortcode generator',
						zIndex: 100,
						open: function() {
							var sel = jQuery('select',t),
								selected = jQuery(e.target).attr('data-form');
							jQuery('option[value="'+selected+'"]',sel).prop('selected',true);
						}
					});
					jQuery('.button',t).one('click',function(){
						var form = jQuery('select option:selected',t).val();
						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						var sC = '<img src="' + themedir + '/images/blank.gif" data-form="' + form +'" class="mceWPcontactform mceItemNoResize mcePixItem" />';
						tinyMCE.activeEditor.selection.setContent(sC);
					});
				} else if ( e.target.nodeName == 'IMG' && jQuery(e.target).hasClass('mceWPvideo')) {
					var t = jQuery("#video_generator").clone(),
						thisImg = jQuery(e.target);
					t.dialog({
						height: 600,
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Video shortcode generator',
						zIndex: 100,
						open: function() {
							var sel = jQuery('select.toggler',t),
								show = jQuery('option:selected',sel).val();
							jQuery('#video_generator > div > div').hide();
							jQuery('#video_generator > div > div[data-type='+show+']').show();
							
							jQuery('option[value="self"]',sel).prop('selected',true);

							jQuery('#video_generator > div > div[data-type]').hide();
							jQuery('#video_generator > div > div[data-type="self"]').show();

							jQuery('input.url',t).val(thisImg.attr('data-mp4'));
							jQuery('input.ogv',t).val(thisImg.attr('data-ogv'));
							jQuery('input.poster',t).val(thisImg.attr('data-poster'));
							jQuery('input.width',t).val(thisImg.attr('data-width'));
							jQuery('input.height',t).val(thisImg.attr('data-height'));

							sel.change(function(){
								var show = jQuery('option:selected',this).val();
								jQuery('#video_generator > div > div[data-type]').hide();
								jQuery('#video_generator > div > div[data-type='+show+']').show();
							});
						}
					});
					jQuery('.button',t).one('click',function(){
					
						var sC;
					
						if ( jQuery('select.toggler option:selected',t).val() == 'externally' ) {
							
							sC = jQuery('textarea',t).val();
							
						} else {
							
							var mp4 = jQuery('input.url',t).val(),
								ogv = jQuery('input.ogv',t).val(),
								poster = jQuery('input.poster',t).val(),
								w = jQuery('input.width',t).val(),
								h = jQuery('input.height',t).val();
			
							sC = '<img src="' + themedir + '/images/blank.gif" data-mp4="' + mp4 +'" data-ogv="' + ogv +'" data-poster="' + poster +'" data-width="' + w +'" data-height="' + h +'" class="mceWPvideo mceItemNoResize mcePixItem" />';
							
						}
					
						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						tinyMCE.activeEditor.selection.setContent(sC);
					});

				} else if ( e.target.nodeName == 'IMG' && jQuery(e.target).hasClass('mceWPaudio')) {
					var t = jQuery("#audio_generator").clone();
					t.dialog({
						height: 'auto',
						maxHeight: '800',
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Audio shortcode generator',
						zIndex: 100,
						open: function() {
							jQuery('input[type=text]',t).val(jQuery(e.target).attr('data-src'));
							if ( jQuery(e.target).attr('data-play')=='true' ) {
								jQuery('input[type="checkbox"]',t).prop('checked',true);
							}
						}
					});
					jQuery('.button',t).one('click',function(){
						var n = Math.floor(Math.random()*1000000),
							id = 'id_'+n,
							src = jQuery('input[type=text]',t).val(),
							pl;
						if(jQuery('input[type="checkbox"]',t).is(':checked')){
							pl = 'true';
						} else {
							pl = 'false';
						}
						var sC = '<img src="' + themedir + '/images/blank.gif" data-src="' + src + '" data-id="' + id +'" data-play="' + pl +'" class="mceWPaudio mceItemNoResize mcePixItem" />';

						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						tinyMCE.activeEditor.selection.setContent(sC);
					});
				} else if ( e.target.nodeName == 'IMG' && jQuery(e.target).hasClass('mceWPaccordion')) {
					var t = jQuery("#accordion_generator").clone();
					t.dialog({
						height: 700,
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Accordion shortcode generator',
						zIndex: 100,
						open: function(){
	
							var active = jQuery(e.target).attr('data-active'),

								selected = jQuery(e.target).attr('data-content'),
									
								getTitles = selected.match(/\[pix_acc data-title=pix_quotes(.*?)pix_quotes\]/g),
									
								getContents = selected.match(/\[pix_acc data-title=pix_quotes(.*?)pix_quotes\](.*?)\[\/pix_acc\]/g);
																								
							jQuery('.pix_start_serialize',t).html('');
							
							jQuery('input.tab_active',t).val(active[1]);
							
							for ( i=0; i<=(getTitles.length-1); i++ ) {
																		
								var clone = jQuery('.clone',t).clone();
								
								clone.removeClass('clone').show();
																		
								jQuery('input',clone).val(getTitles[i].replace(/\[pix_acc data-title=pix_quotes/,'').replace(/pix_quotes\]/,''));
								
								jQuery('textarea',clone).val(getContents[i].replace(/\[pix_acc data-title=pix_quotes(.*?)pix_quotes\]/,'').replace(/\[\/pix_acc\]/,'').replace(/\[br\]/g, '\n'));
								
								jQuery('.pix_start_serialize',t).append(clone);
								
							}

							pix_meta_sortable();

						}

					});
					jQuery('.button',t).one('click',function(){

						var aA = parseFloat(jQuery('.accordion_active', t).val()),
							allTitles = [],
							allContents = [],
							sC;
							
						jQuery('.pix_start_serialize input[type=text]', t).not('.accordion_active').each(function() {
							allTitles.push(jQuery(this).val());
						});

						jQuery('.pix_start_serialize textarea', t).each(function() {
							allContents.push(jQuery(this).val());
						});

						sC = '<img src="' + themedir + '/images/blank.gif" data-active="'+aA+'" data-content="';
						
						jQuery.each(allTitles, function(key, value) {
							if(allTitles[key]!=''){
								var pix_acc = ('[pix_acc data-title="'+htmlEntities(allTitles[key])+'"]content'+key+'[/pix_acc]').replace(/[\'"]/g,'pix_quotes');
								sC = sC + pix_acc;
							}
						});
						
						jQuery.each(allContents, function(key, value) {
							var keyCont = htmlEntities(allContents[key]).replace(/\n\r?/g, '[br]').replace(/[\'"]/g,'pix_quotes');
							sC = sC.replace(/\n\r?/g, '[br]').replace('content'+key, keyCont);
						});
						
						sC = sC + '" class="mceWPaccordion mceItemNoResize mcePixItem" />';

						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						tinyMCE.activeEditor.selection.setContent(sC);
					});
				} else if ( e.target.nodeName == 'IMG' && jQuery(e.target).hasClass('mceWPtabs')) {
					var t = jQuery("#tab_generator").clone();
					t.dialog({
						height: 700,
						width: 'auto',
						modal: true,
						dialogClass: 'wp-dialog',
						title: 'Tab shortcode generator',
						zIndex: 100,
						open: function(){
	
							var active = jQuery(e.target).attr('data-active'),
								
								selected = jQuery(e.target).attr('data-content');

							var	getTitles = selected.match(/\[pix_tab data-title=pix_quotes(.*?)pix_quotes\]/g),
								
								selected = selected.replace(/\[pix_tab_content (.*?)\]/g, '[pix_tab_content]'),
								
								getContents = selected.match(/\[pix_tab_content\](.*?)\[\/pix_tab_content\]/g);
																							
							jQuery('.pix_start_serialize',t).html('');
							
							jQuery('input.tab_active',t).val(active);
							
							for ( i=0; i<=(getTitles.length-1); i++ ) {
																		
								var clone = jQuery('.clone',t).clone();
								
								clone.removeClass('clone').show();
																		
								jQuery('input',clone).val(getTitles[i].replace(/\[pix_tab data-title=pix_quotes/,'').replace(/pix_quotes\]/,''));
								
								jQuery('textarea',clone).val(getContents[i].replace(/\[pix_tab_content\]/,'').replace(/pix_quotes/g,'"').replace(/\[\/pix_tab_content\]/,'').replace(/\[br\]/g, '\n'));
								
								jQuery('.pix_start_serialize',t).append(clone);
									
							}

							pix_meta_sortable();

						}

					});
					jQuery('.button',t).one('click',function(){
						var aA = parseFloat(jQuery('.tab_active', t).val()),
							allTitles = [],
							allContents = [],
							sC;
							
						jQuery('.pix_start_serialize input[type=text]', t).not('.tab_active').each(function() {
							allTitles.push(jQuery(this).val());
						});

						jQuery('.pix_start_serialize textarea', t).each(function() {
							allContents.push(jQuery(this).val());
						});

						sC = '<img src="' + themedir + '/images/blank.gif" data-active="'+aA+'" data-content="[ul]';
						
						jQuery.each(allTitles, function(key, value) {
							if(allTitles[key]!=''){
								var pix_tab = ('[pix_tab data-title="'+htmlEntities(allTitles[key])+'"]').replace(/[\'"]/g,'pix_quotes');
								sC = sC + pix_tab;
							}
						});
						
						sC = sC + '[/ul]';
						
						jQuery.each(allTitles, function(key, value) {
							if(allTitles[key]!=''){
								var pix_tab = ('[pix_tab_content data-title="'+htmlEntities(allTitles[key])+'"]content'+key+'[/pix_tab_content]').replace(/[\'"]/g,'pix_quotes');
								sC = sC + pix_tab;
							}
						});
						
						jQuery.each(allContents, function(key, value) {
							var keyCont = htmlEntities(allContents[key]).replace(/\n\r?/g, '[br]').replace(/[\'"]/g,'pix_quotes');
							sC = sC.replace('content'+key, keyCont);
						});
						
						sC = sC + '" class="mceWPtabs mceItemNoResize mcePixItem" />';

						t.dialog('close').remove();
						tinyMCE.activeEditor.focus(); 
						tinyMCE.activeEditor.selection.setContent(sC);
					});
				} 
			});

		}

			
	});

	tinymce.PluginManager.add('forte', tinymce.plugins.Forte);
	
	
	jQuery('label[for="pix_page_builder-hide"]').remove();
	jQuery('label[for="pix_page_builder_content-hide"]').remove();
	jQuery('label[for="pix_meta_edittext-hide"]').remove();
	jQuery('label[for="pix_meta_googlemap-hide"]').remove();
	jQuery('label[for="pix_meta_contactform-hide"]').remove();
	jQuery('label[for="pix_meta_tooltip-hide"]').remove();
	jQuery('label[for="pix_meta_video-hide"]').remove();
	jQuery('label[for="pix_meta_audio-hide"]').remove();
	jQuery('label[for="pix_meta_accordion-hide"]').remove();
	jQuery('label[for="pix_meta_tab-hide"]').remove();
	jQuery('label[for="pix_meta_box-hide"]').remove();
	jQuery('label[for="pix_meta_button-hide"]').remove();
	jQuery('label[for="pix_meta_pricetable-hide"]').remove();
	jQuery('label[for="pix_meta_tweets-hide"]').remove();
	jQuery('label[for="pix_meta_galleries-hide"]').remove();
	jQuery('label[for="pix_meta_categories-hide"]').remove();
	jQuery('label[for="pix_meta_slideshow-hide"]').remove();
	jQuery('label[for="pix_meta_testimonial_sc-hide"]').remove();

}
(function() { forteTinyMCEinit() })();
