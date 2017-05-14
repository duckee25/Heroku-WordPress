function fortePageBuilder(){

	if ( pagenow == 'post' || pagenow == 'page' || pagenow == 'portfolio' ) {

		jQuery('input[name="pix_editor_field"]').click(function(){
			var textCant,
				t = jQuery(this),
				check;
			
			if ( t.is(':checked') ) {
				textCant= '<p>This change can generate some problems to the layout. You must pay attention to the HTML of this entry and a backup is always recommended before saving the new settings</p>';
				check = true;
			} else {
				textCant= '<p>This change can generate some problems to the layout. A backup is always recommended before saving the new settings</p>';
				check = false;
			}
			jQuery('body').append('<div id="pix_builder_cant" /></div>');
			jQuery('#pix_builder_cant').html(textCant).dialog({
				buttons: {
					"Confirm": function() {
						t.attr('checked',check);
						jQuery( this ).dialog( "close" );
					},
					"Cancel": function() {
						jQuery( this ).dialog( "close" );
					}
				},
				width: 200,
				modal: true,
				dialogClass: 'wp-dialog pix-dialog',
				title: 'Sorry, you can\'t',
				zIndex: 100,
				close: function(){
					jQuery('#pix_builder_cant').remove();
				}
			});
			return false;
		});
		
		if ( !jQuery('input[name="pix_editor_field"]').is(':checked') ) {
			var defaults = {
				
				sectionClose: '</div></section>',
				
				oneColumnClass: 'pix_column_210',
						
				twoColumnClass: 'pix_column_470',
						
				threeColumnClass: 'pix_column_730',
						
				fourColumnClass: 'pix_column_990'
						
			};
			
			var opts = jQuery.extend({}, defaults, opts);
			
			if ( !jQuery('#pix-content-builder').length ) {
				if ( jQuery('#wp-content-editor-tools .wp-editor-tabs').length )
					jQuery('#wp-content-editor-tools .wp-editor-tabs').append(
						'<a id="pix-content-builder" class="hide-if-no-js wp-switch-editor switch-builder" onclick="switchEditors.switchto(this);">Builder</a>'
					);
				else
					jQuery('#wp-content-editor-tools').prepend(
						'<a id="pix-content-builder" class="hide-if-no-js wp-switch-editor switch-builder" onclick="switchEditors.switchto(this);">Builder</a>'
					);
			}
				
			var forte_editor_tab = localStorage.getItem("forte_editor_tab"),
				page_template,
				max_columns,
				class_wrap;
			
			jQuery('select#page_template, select#pix_page_template_select').each(function(){
				var t = jQuery(this),
					sel = jQuery('option:selected',t).val();
				page_template = sel;
				
				switch (page_template) {
					case 'widepage.php' :
						max_columns = 4;
						class_wrap = 'pix_column_990';
						break;
					default :
						max_columns = 3;
						class_wrap = 'pix_column_730';
						break;
				}
				
				jQuery('#pix_builder_canvas .wrap').each(function(){
					jQuery(this).attr('data-maxcolumns', max_columns);
				});
				
				t.bind('change',function(){
					sel = jQuery('option:selected',t).val();
					page_template = sel;
					switch (page_template) {
						case 'widepage.php' :
							max_columns = 4;
							class_wrap = 'pix_column_990';
							break;
						default :
							max_columns = 3;
							class_wrap = 'pix_column_730';
							break;
					}
				
					jQuery('#pix_builder_canvas .wrap').each(function(){
						jQuery(this).attr('data-maxcolumns', max_columns);
					});
				});
			});
			
			function setVisualContent() {			

				tinymce.execCommand('mceRemoveEditor',true,'content');
				tinymce.execCommand('mceAddEditor',true,'content');
				var content = '';
				
				jQuery('#pix_builder_canvas .pix_builded_grid').each(function(){
									
					if ( jQuery(this).attr('data-full') == 'true' && jQuery(this).attr('data-slideshow') == 'true' ) {
											
							
						var firstSlide,
							fullClass;
							
						if ( jQuery(this).index() == 0 ) {
							firstSlide = ' firstSlideShow'
						} else {
							firstSlide = ''
						}
						
						if ( jQuery('li',this).attr('class').indexOf('pix_fullheight') != -1 ) {
							fullClass = ' pix_fullheight'
						} else {
							fullClass = ''
						}
						
						content = content + '<section class="pix_slideshow_wrap'+firstSlide+fullClass+'"><div class="pix_column">';
						jQuery('> span > li',this).each(function(){
							var attrClass = jQuery(this).attr('class'),
								dataClass = jQuery(this).attr('data-class'),
								attrID = typeof jQuery(this).attr('id') !== "undefined" ? ' id="'+jQuery(this).attr('id')+'"' : '',
								alignment = jQuery(this).attr('data-last')=='true' ? ' alignright' : ' alignleft',
								fullDivider = jQuery(this).attr('data-full')=='true' ? ' data-full=\'true\'' : '';
								slideshow = jQuery(this).attr('data-slideshow')=='true' ? ' data-slideshow=\'true\'' : '';
							content = content+'<div class=\'pix_column\' data-class=\''+attrClass+'\''+fullDivider+attrID+slideshow+'>'+jQuery('> .liContent',this).text()+'</div>';
						});			
		
					} else if ( jQuery(this).attr('data-full') == 'true' && jQuery(this).attr('data-slideshow') != 'true' ) {
						
						var bgImg = (jQuery('li',this).css('background-image') != 'none' && jQuery('li',this).css('background-image') != '') ? 'style="background-image:'+jQuery('li',this).css('background-image').replace(/[\'"]/g,'')+'"' : '',
							bgClass;
							
						if ( jQuery('li',this).attr('class').indexOf('pix_cover') != -1 ) {
							bgClass = ' pix_cover'
						} else if ( jQuery('li',this).attr('class').indexOf('pix_norepeat') != -1 ) {
							bgClass = ' pix_norepeat'
						} else {
							bgClass = ''
						}
						
						content = content + '<section class="pix_divider'+bgClass+'" '+bgImg+'><div class="pix_column pix_column_990">';
						jQuery('> span > li',this).each(function(){
							var attrClass = jQuery(this).attr('class'),
								dataClass = jQuery(this).attr('data-class'),
								attrID = typeof jQuery(this).attr('id') !== "undefined" ? ' id="'+jQuery(this).attr('id')+'"' : '',
								alignment = jQuery(this).attr('data-last')=='true' ? ' alignright' : ' alignleft',
								fullDivider = jQuery(this).attr('data-full')=='true' ? ' data-full=\'true\'' : '';
							content = content+'<div class=\''+dataClass+alignment+'\' data-class=\''+attrClass+'\''+fullDivider+attrID+'>'+jQuery('> .liContent',this).text()+'</div>';
						});			
		
					} else {
					
						content = content + '<section><div class="pix_column '+class_wrap+'">';
						jQuery('> span > li',this).each(function(){
							var attrClass = jQuery(this).attr('class'),
								dataClass = jQuery(this).attr('data-class'),
								attrID = typeof jQuery(this).attr('id') !== "undefined" ? ' id="'+jQuery(this).attr('id')+'"' : '',
								alignment = jQuery(this).attr('data-last')=='true' ? ' alignright' : ' alignleft',
								fullDivider = jQuery(this).attr('data-full')=='true' ? ' data-full=\'true\'' : '';
							content = content+'<div class=\''+dataClass+alignment+'\' data-class=\''+attrClass+'\''+fullDivider+attrID+'>'+jQuery('> .liContent',this).text()+'</div>';
						});			
					
					}
		
					content = content + opts.sectionClose;

				});
				
				tinymce.get('content').setContent(content);
				
				var allImg = tinymce.get('content').dom.select('img');
				var allA = tinymce.get('content').dom.select('a');
				
				if ( !jQuery('input[name="pix_editor_field"]').is(':checked') ) {
					jQuery(allImg).bind('click dblclick',function(event){
						return false;
					});
					
					jQuery(allA).bind('click dblclick',function(event){
						return false;
					});
					
					tinymce.get('content').getBody().setAttribute('contenteditable', false);

					var tinyMCEbody = tinymce.get('content').dom.select('body');
					
					jQuery(tinyMCEbody).bind('click mousedown keypress',function(event){
						var textCant = '<p>Sorry, you can\'t modify the visual editor directly from here. Switch to &quot;Builder&quot; mode and edit each section</p>';
						jQuery('body').append('<div id="pix_builder_cant" /></div>');
						jQuery('#pix_builder_cant').html(textCant).dialog({
							buttons: false,
							width: 300,
							modal: true,
							dialogClass: 'wp-dialog pix-dialog',
							title: 'Select some text',
							zIndex: 100
						});
					});
				}

				jQuery('textarea#content').val(content);
				
				/******************************************************
				*
				*	iFrame height
				*
				******************************************************/
				var allImgIframe = tinymce.get('content').dom.select('img.mceItemIframe');
				jQuery(allImgIframe).each(function () {
					var t = jQuery(this),
						h = t.attr('height'),
						w = t.width();
						
					if ( typeof h !== 'undefined' && h !== false && h.indexOf('%')!=-1 && !jQuery(this).parents('div').eq(0).hasClass('letmebe') ) {
						ratio = Math.round(parseInt(h));
						t.height( (w*(ratio*0.01)) );
						jQuery(window).bind('resize',function(){
							w = t.width();
							t.height( (w*(ratio*0.01)) );
						});
					}
				});
					
		
			}
			
			function setBuilderContent() {

				if ( typeof tinymce !== "undefined" ) {
				
					var tnmce = tinymce.get('content'),
						theDom,
						theBody,
						content = '',
						bgImg,
						bgClass;
					
					/*if ( typeof tnmce === "undefined" ) {
						theBody = jQuery('textarea#content').val();
					} else {
						theDom = tinymce.get('content').dom.select('body');
						theBody = jQuery(theDom).html();
					}*/

					theBody = jQuery('textarea#content').text();

					theBody = theBody.replace(/<img[^>]+>/g, function(im) {
						if (im.indexOf('class="mceWPclear') !== -1) {
							im = '[clear]';
						}
						if (im.indexOf('class="mceWPhr') !== -1) {
							im = '[hr]';
						}
						if (im.indexOf('class="mceWPslideshow') !== -1) {
							var m, theBody = (m = im.match(/data-slideshow=[\'"](.*?)[\'"]/)) ? m[1] : '';
							im = '[pix_slideshow data_slideshow=\''+theBody+'\']';
						}
						if (im.indexOf('class="mceWPpricetable') !== -1) {
							var m, theBody = (m = im.match(/data-table=[\'"](.*?)[\'"]/)) ? m[1] : '';
							im = '[pix_price_table data_table=\''+theBody+'\']';
						}
						if (im.indexOf('class="mceWPtestimonials') !== -1) {
							var m, ids = (m = im.match(/data-ids=[\'"](.*?)[\'"]/)) ? m[1] : '',
								m2, layout = (m2 = im.match(/data-layout=[\'"](.*?)[\'"]/)) ? m2[1] : '';
							im = '[pix_testimonials data_ids=\''+ids+'\' data_layout=\''+layout+'\']';
						}
						if (im.indexOf('class="mceWPcontactform') !== -1) {
							var m, theBody = (m = im.match(/data-form=[\'"](.*?)[\'"]/)) ? m[1] : '';
							im = '[pix_contact_form data_form=\''+theBody+'\']';
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
							var m, src = (m = im.match(/data-src=[\'"](.*?)[\'"]/)) ? m[1] : '';
							im = '[pix_audio src="'+src+'"]';
						}
						if (im.indexOf('class="mceWPaccordion') !== -1) {
							var m, active = (m = im.match(/data-active=[\'"](.*?)[\'"]/)) ? m[1] : '',
								m2, content = (m2 = im.match(/data-content=[\'"](.*?)[\'"]/)) ? m2[1] : '';
							content = content.replace(/pix_quotes/g,'"')/*.replace(/\[br\]/g, '\n\r')*/;
							im = '[pix_accordion data_active=\''+active+'\']'+content+'[/pix_accordion]';
						}
						if (im.indexOf('class="mceWPtabs') !== -1) {
							var m, active = (m = im.match(/data-active=[\'"](.*?)[\'"]/)) ? m[1] : '',
								m2, content = (m2 = im.match(/data-content=[\'"](.*?)[\'"]/)) ? m2[1] : '';
							content = content.replace(/pix_quotes/g,'"')/*.replace(/\[br\]/g, '\n\r')*/;
							im = '[pix_tabs data_active=\''+active+'\']'+content+'[/pix_tabs]';
						}
						im = im.replace(/data-/g, 'data_');
						return im;
					});
						
					if ( !jQuery('#tempContent').length ) {
						jQuery('body').append('<div id="tempContent" />');
					}

					theBody = switchEditors.wpautop(theBody);

					jQuery('#tempContent').html(theBody);
					
					if ( !jQuery('#tempContent > section > div').length ) {

						content = '<ul class="pix_builded_grid"><span><li class=\'pix_column '+class_wrap+'\' data-size=\''+max_columns+'\'><span class="liContent">'+theBody+'</span></li></span></ul>';
						
					} else {
			
						jQuery('#tempContent > section > div').each(function(){
							
							if ( jQuery(this).parents('section').eq(0).hasClass('pix_divider') ) {
								bgImg = ' style="background-image:'+jQuery(this).parents('section').eq(0).css('background-image').replace(/[\'"]/g,'')+'"';
								if ( !jQuery('> div',this).length ) { jQuery(this).append('<div class="pix_column pix_column_990 alignleft" data-class="pix_column pix_column_990 pix_cover" data-full="true" />'); }
								if ( jQuery(this).parents('section').eq(0).hasClass('pix_cover') ) {
									bgClass = ' pix_cover';
								} else if ( jQuery(this).parents('section').eq(0).hasClass('pix_norepeat') ) {
									bgClass = ' pix_norepeat';
								}
							} else if ( jQuery(this).parents('section').eq(0).hasClass('pix_slideshow_wrap') ) {
								bgImg = '';
								if ( jQuery(this).parents('section').eq(0).hasClass('pix_fullheight') ) {
									bgClass = ' pix_fullheight';
								} else {
									bgClass = '';
								}
							} else {
								bgImg = '';
								bgClass = '';
							}
							 
							content = content + '<ul class="pix_builded_grid"><span>';
				
							jQuery('> div.pix_column',this).each(function(){
								var attrClass = jQuery(this).attr('data-class'),
									dataClass = jQuery(this).attr('class'),
									attrID = typeof jQuery(this).attr('id') !== "undefined" ? ' id="'+jQuery(this).attr('id')+'"' : '',
									fullDivider = jQuery(this).attr('data-full')=='true' ? ' data-full=\'true\'' : '',
									slideshow = jQuery(this).attr('data-slideshow')=='true' ? ' data-slideshow=\'true\'' : '',
									dataSize;
								if ( typeof attrClass !== 'undefined' && attrClass !== false ) {
									if ( attrClass.indexOf(opts.oneColumnClass)!=-1 ) {
										dataSize = 1;
									} else if ( attrClass.indexOf(opts.twoColumnClass)!=-1 ) {
										dataSize = 2;
									} else if ( attrClass.indexOf(opts.threeColumnClass)!=-1 ) {
										dataSize = 3;
									} else if ( attrClass.indexOf(opts.fourColumnClass)!=-1 ) {
										dataSize = 4;
									}
								} else {
									dataSize = parseFloat(jQuery('#pix_builder_canvas .wrap').attr('data-maxcolumns'));
								}
								content = content+'<li class=\''+dataClass+bgClass+'\' data-class=\''+attrClass+'\' data-size=\''+dataSize+'\''+fullDivider+bgImg+attrID+slideshow+'><span class="liContent">'+jQuery(this).html()+'</span></li>';
							});
							
							content = content + '</span></ul>';
							
						});
						
					}
					
					jQuery('#pix_builder_canvas > .wrap').html(content);

					jQuery('#pix_builder_canvas > .wrap .liContent').each(function(){
						var html = jQuery(this).html();
						jQuery(this).text(html);
					});
					
					clearTimeout(set);
					var set = setTimeout(function(){ dataSizeToClass(); },1); //to prevent that the dyna-generated <li> elements have width=0
					
				}
			}
			
			function dataSizeToClass(){
				jQuery("ul.pix_builded_grid").each(function(){
					var t = jQuery(this),
						sizeT = 0,
						set;
					t.attr('data-full','');
					jQuery(" > span > li", t).not('.ui-state-highlight').not('.ui-sortable-helper').each(function(){
						var size = parseFloat(jQuery(this).attr('data-size')),
							classLi;
						switch (size) {
							case 4:
								classLi = 'pix_column ' + opts.fourColumnClass;
								break;
							case 3:
								classLi = 'pix_column ' + opts.threeColumnClass;
								break;
							case 2:
								classLi = 'pix_column ' + opts.twoColumnClass;
								break;
							default:
								classLi = 'pix_column ' + opts.oneColumnClass;
						}
						jQuery(this).removeClass(opts.oneColumnClass).removeClass(opts.twoColumnClass).removeClass(opts.threeColumnClass).removeClass(opts.fourColumnClass);
						jQuery(this).addClass(classLi).attr('data-class',classLi);
						sizeT = (sizeT+size);
						var thisUl = jQuery(this);
						clearTimeout(set);
						set = setTimeout(function() { 
							var thisW = thisUl.width(),
								parentW = t.width(),
								thisL = thisUl.position().left;
							if ( ( thisW+thisL ) > ( parentW * 0.8 ) && t.find('> span > li').length > 1 ) {
								thisUl.attr('data-last','true');
							} else {
								thisUl.attr('data-last','false');
							}
							jQuery(this).addClass('transitioning');
			
							if ( thisUl.attr('data-full')=='true' ) {
								t.attr('data-full','true');
							} else {
								t.attr('data-full','');
							}
			
							if ( thisUl.attr('data-slideshow')=='true' ) {
								t.attr('data-slideshow','true');
							} else {
								t.attr('data-slideshow','');
							}
						}, 200);
					});
					t.attr('data-size',sizeT);
					jQuery('input[name="pix_hidden_field"]').val(sizeT);
				});
			}
			dataSizeToClass();
			
			jQuery('#content-tmce').bind('click',function(){
				var wrap = jQuery(this).parents('#wp-content-wrap').eq(0);
				wrap.addClass('tmce-active').removeClass('builder-active');
				jQuery('#pix-builder-editor-container').hide();
				jQuery('#wp-content-editor-container, #post-status-info').show();
				
				var set;
				clearTimeout(set);
				set = setTimeout(function(){ setVisualContent(); },200);

				
				localStorage.setItem('forte_editor_tab', 'forte_visual')
		
			});
			
			var after = jQuery('#pix-builder-editor-container');
			
			jQuery('#wp-content-editor-container').after(after);
			
			function builderSortable(){
				jQuery('#pix_builder_canvas > .wrap').sortable({
					items: '> ul.pix_builded_grid',
					cursor: 'move',
					handle: '.pix_builder_move',
					placeholder: "ui-state-highlight",
					revert: 100,
					tolerance: 'pointer',
					stop: function(event,ui) {
						var set;
						clearTimeout(set);
						set = setTimeout(function(){ setVisualContent(); },200);
					}
				});
			
				jQuery("ul.pix_builded_grid > span").each(function(){
					var t = jQuery(this);
					t.sortable({
						connectWith: jQuery('ul.pix_builded_grid > span'),
						cursor: 'move',
						handle: '.pix_builder_move',
						placeholder: "ui-state-highlight",
						revert: 100,
						tolerance: 'pointer',
						sort: function(event,ui){
							jQuery("ul.pix_builded_grid > span > li").removeClass('transitioning');
							var itemClass = ui.item.attr('class');
							jQuery('.ui-state-highlight').attr('class','ui-state-highlight '+itemClass);
							var setSizeclass;
							clearTimeout(setSizeclass);
							setSizeclass = setTimeout(function(){ dataSizeToClass(); },100);
						},
						stop: function(event,ui){
							var setStopSort;
							clearTimeout(setStopSort);
							setStopSort = setTimeout(function(){
								jQuery("ul.pix_builded_grid > span > li").addClass('transitioning');
								var sizeT = parseFloat(ui.item.closest('ul.pix_builded_grid').attr('data-size')),
									sizeItem = parseFloat(ui.item.attr('data-size'));
								if ( (sizeT+sizeItem) > max_columns ) {
									var textCant = '<p>Sorry, this movement is not possible. This doesn\'t fit here</p><p>You need to change the width of the column. Your column will now go back to it\'s last position but errors are possible so please <strong>double check that your column is where it should be before saving</strong></p>';
									jQuery('body').append('<div id="pix_builder_cant" /></div>');
									jQuery('#pix_builder_cant').html(textCant).dialog({
										buttons: false,
										width: 200,
										modal: true,
										dialogClass: 'wp-dialog pix-dialog',
										title: 'Sorry, you can\'t',
										zIndex: 100,
										close: function(){
											jQuery('#pix_builder_cant').remove();
										}
									});
									t.sortable('cancel');
								}
								dataSizeToClass();
							});
							var set;
							clearTimeout(set);
							set = setTimeout(function(){ setVisualContent(); },200);
						}
					});
				});
			}
			
		
			function addRowIcons(){
				jQuery("ul.pix_builded_grid").each(function(){
					if ( !jQuery('> .pix_builder_move', this).length ) {
						jQuery(this).append('<div class="pix_row_icons pix_builder_move" />');
					}
					if ( !jQuery('> .pix_builder_remove', this).length ) {
						jQuery(this).append('<div class="pix_row_icons pix_builder_remove" data-tip="Remove this section" />');
					}
					if ( !jQuery('> .pix_builder_add', this).length ) {
						jQuery(this).append('<div class="pix_row_icons pix_builder_add" data-tip="Add a new column<br>to this section" />');
					}
					if ( !jQuery('> .pix_builder_clone', this).length ) {
						jQuery(this).append('<div class="pix_row_icons pix_builder_clone" data-tip="Clone this section" />');
					}
				});
			}
			
			function addItemIcons(){
				jQuery("ul.pix_builded_grid > span > li").each(function(){
					if ( !jQuery('.pix_builder_move', this).length ) {
						jQuery(this).append('<div class="pix_items_icons pix_builder_move" />');
					}
					if ( !jQuery('.pix_builder_remove', this).length ) {
						jQuery(this).append('<div class="pix_items_icons pix_builder_remove" data-tip="Remove this column" />');
					}
					if ( !jQuery('.pix_builder_edit', this).length && jQuery(this).attr('data-slideshow')!='true' ) {
						jQuery(this).append('<div class="pix_items_icons pix_builder_edit" data-tip="Edit this column" />');
					}
					if ( !jQuery('.pix_builder_bg', this).length && jQuery(this).attr('data-full')=='true' && jQuery(this).attr('data-slideshow')!='true' ) {
						jQuery(this).append('<div class="pix_items_icons pix_builder_bg" data-tip="Add a bg image" />');
					}
					if ( !jQuery('.pix_builder_cancelbg', this).length && jQuery(this).attr('data-full')=='true' && jQuery(this).attr('data-slideshow')!='true' ) {
						jQuery(this).append('<div class="pix_items_icons pix_builder_cancelbg" data-tip="Remove the bg image" />');
					}
					if ( !jQuery('.pix_builder_repeat', this).length && jQuery(this).attr('data-full')=='true' && jQuery(this).attr('data-slideshow')!='true' ) {
						var bgClass,
							tipText;
						if ( jQuery(this).attr('class').indexOf('pix_cover') != -1 ) {
							bgClass = ' pix_cover';
							tipText = 'Fullscreen bg (click to change)';
						} else if ( jQuery(this).attr('class').indexOf('pix_norepeat') != -1 ) {
							bgClass = ' pix_norepeat';
							tipText = 'Portrait bg (click to change)';
						} else {
							bgClass = '';
							tipText = 'Repeated bg (click to change)';
						}
						jQuery(this).append('<div class="pix_items_icons pix_builder_repeat'+bgClass+'" data-tip="'+tipText+'" />');
					}
					if ( !jQuery('.pix_builder_slideshow', this).length && jQuery(this).attr('data-full')=='true' && jQuery(this).attr('data-slideshow')=='true' ) {
						jQuery(this).append('<div class="pix_items_icons pix_builder_slideshow" data-tip="Add a slideshow" />');
					}
					if ( !jQuery('.pix_builder_slideheight', this).length && jQuery(this).attr('data-full')=='true' && jQuery(this).attr('data-slideshow')=='true' ) {
						var bgClass,
							tipText;
						if ( jQuery(this).attr('class').indexOf('pix_fullheight') != -1 ) {
							bgClass = ' pix_fullheight';
							tipText = '100% height (click to change)';
						} else {
							bgClass = '';
							tipText = 'Auto height (click to change)';
						}
						jQuery(this).append('<div class="pix_items_icons pix_builder_slideheight'+bgClass+'" data-tip="'+tipText+'" />');
					}
					if ( !jQuery('.pix_builder_id', this).length ) {
						jQuery(this).append('<div class="pix_items_icons pix_builder_id" data-tip="Add an ID to this column" />');
					}
					if ( !jQuery('.pix_builder_expand', this).length && jQuery(this).attr('data-full')!='true' ) {
						jQuery(this).append('<div class="pix_items_icons pix_builder_expand" data-tip="Expand the column width" />');
					}
					if ( !jQuery('.pix_builder_contract', this).length && jQuery(this).attr('data-full')!='true' ) {
						jQuery(this).append('<div class="pix_items_icons pix_builder_contract" data-tip="Contract the column width" />');
					}
					if ( !jQuery('.pix_builder_clone', this).length && jQuery(this).attr('data-full')!='true' ) {
						jQuery(this).append('<div class="pix_items_icons pix_builder_clone" data-tip="Clone this column" />');
					}
					if ( !jQuery('.gradient_end', this).length ) {
						jQuery(this).append('<div class="gradient_end" />');
					}
				});
				pix_tooltips();
			}
			
			function switchBuilder(){
				setBuilderContent();
				addItemIcons();
				addRowIcons();
				builderSortable();
				pix_tooltips();
		
				jQuery('#wp-content-editor-container, #post-status-info').hide();
				jQuery('#pix-builder-editor-container').show();
				var wrap = jQuery('#wp-content-wrap');
				wrap.removeClass('tmce-active').addClass('builder-active');
				localStorage.setItem('forte_editor_tab', 'forte_builder');
				
			}
		
			jQuery(document).off('click','#pix-content-builder');
			jQuery(document).on('click','#pix-content-builder',function(){
				switchBuilder();
			});
			
			if ( forte_editor_tab == 'forte_builder' ) {
				switchBuilder();
			}
			
			jQuery(document).off('click','ul.pix_builded_grid .pix_builder_add');
			jQuery(document).on('click','ul.pix_builded_grid .pix_builder_add',function(){
				var parent = jQuery(this).parents('ul.pix_builded_grid').eq(0),
					sizeT = parseFloat(parent.attr('data-size'));
				if ( sizeT < max_columns ) {
					if ( sizeT == 0 && max_columns==4 ) {
						var textCant = 'You can select between:<form><fieldset><select name="pix_section_select" id="pix_section_select"><option value="simple">Simple column</option><option value="divider">Full screen divider</option><option value="slideshow">Full screen slideshow</option></select></fieldset></form>';
						jQuery('body').append('<div id="pix_builder_cant" /></div>');
						jQuery('#pix_builder_cant').html(textCant).dialog({
							width: 200,
							modal: true,
							dialogClass: 'wp-dialog pix-dialog',
							title: 'Please, select',
							buttons: {
								"Select": function() {
									if ( jQuery('#pix_section_select option:selected').val() == 'simple' ) {
										jQuery('> span',parent).append('<li data-size="1"><span class="liContent"></span><span class="gradient_end"></span></li>');
										dataSizeToClass();
										addItemIcons();
									} else if ( jQuery('#pix_section_select option:selected').val() == 'divider' ) {
										jQuery('> span',parent).append('<li data-size="'+max_columns+'" data-full="true"><span class="liContent"></span><span class="gradient_end"></span></li>');
										dataSizeToClass();
										addItemIcons();
									} else {
										jQuery('> span',parent).append('<li data-size="'+max_columns+'" data-full="true" data-slideshow="true"><span class="liContent"></span><span class="gradient_end"></span></li>');
										dataSizeToClass();
										addItemIcons();
									}
									jQuery( this ).dialog( "close" );
									var set;
									clearTimeout(set);
									set = setTimeout(function(){ setVisualContent(); },200);
								},
								"Cancel": function() {
									jQuery( this ).dialog( "close" );
								}
							},
							zIndex: 100,
							close: function(){
								jQuery('#pix_builder_cant').remove();
							}
						});
					} else {
						jQuery('> span',parent).append('<li data-size="1"><span class="liContent"></span><span class="gradient_end"></span></li>');
						dataSizeToClass();
						addItemIcons();
						var set;
						clearTimeout(set);
						set = setTimeout(function(){ setVisualContent(); },200);
					}
				} else {
					var textCant = 'Sorry, this movement is not possible. This doesn\'t fit here';
					jQuery('body').append('<div id="pix_builder_cant" /></div>');
					jQuery('#pix_builder_cant').text(textCant).dialog({
						buttons: false,
						width: 200,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Sorry, you can\'t',
						zIndex: 100,
						close: function(){
							jQuery('#pix_builder_cant').remove();
						}
					});
				}
			});
			
			jQuery(document).off('click','ul.pix_builded_grid > span > li .pix_builder_remove');
			jQuery(document).on('click','ul.pix_builded_grid > span > li .pix_builder_remove',function(){
				var parentLi = jQuery(this).parents('li[data-size]').eq(0),
					textCant = 'Are you sure you want to delete this item?';
				jQuery('body').append('<div id="pix_builder_cant" /></div>');
				jQuery('#pix_builder_cant').text(textCant).dialog({
					width: 200,
					modal: true,
					dialogClass: 'wp-dialog pix-dialog',
					title: 'Are you sure?',
					buttons: {
						"Yes, I'm sure": function() {
							jQuery( this ).dialog( "close" );
							parentLi.removeClass('transitioning').fadeTo(350, 0,function(){
								jQuery(this).hide(150,function(){
									jQuery(this).remove();
									dataSizeToClass();
									var set;
									clearTimeout(set);
									set = setTimeout(function(){ setVisualContent(); },200);
								});
							});
							
						},
						"No, cancel": function() {
							jQuery( this ).dialog( "close" );
						}
					},
					zIndex: 100,
					close: function(){
						jQuery('#pix_builder_cant').remove();
					}
				});
			});
			
			jQuery(document).off('click','ul.pix_builded_grid > span > li .pix_builder_expand');
			jQuery(document).on('click','ul.pix_builded_grid > span > li .pix_builder_expand',function(){
				var parent = jQuery(this).parents('ul.pix_builded_grid').eq(0),
					parentLi = jQuery(this).parents('li[data-size]').eq(0),
					sizeT = parseFloat(parent.attr('data-size')),
					size = (parseFloat(parentLi.attr('data-size')));
				if ( size <= max_columns ) {
					if ( sizeT<max_columns ) {
						parentLi.attr('data-size',(size+1));
						dataSizeToClass(); 
						var set;
						clearTimeout(set);
						set = setTimeout(function() { setVisualContent(); }, 200);
					} else {
						var textCant = 'Sorry, this movement is not possible. This doesn\'t fit here';
						jQuery('body').append('<div id="pix_builder_cant" /></div>');
						jQuery('#pix_builder_cant').text(textCant).dialog({
							buttons: false,
							width: 200,
							modal: true,
							dialogClass: 'wp-dialog pix-dialog',
							title: 'Sorry, you can\'t',
							zIndex: 100,
							close: function(){
								jQuery('#pix_builder_cant').remove();
							}
						});
					}
				} else {
					var textCant = 'Sorry, you reached the maximum width';
					jQuery('body').append('<div id="pix_builder_cant" /></div>');
					jQuery('#pix_builder_cant').text(textCant).dialog({
						buttons: false,
						width: 200,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Sorry, you can\'t',
						zIndex: 100,
						close: function(){
							jQuery('#pix_builder_cant').remove();
						}
					});
				}
			});
			
			jQuery(document).off('click','ul.pix_builded_grid > span > li .pix_builder_contract')
			jQuery(document).on('click','ul.pix_builded_grid > span > li .pix_builder_contract',function(){
				var parent = jQuery(this).parents('ul.pix_builded_grid').eq(0),
					parentLi = jQuery(this).parents('li[data-size]').eq(0)
					size = parseFloat(parentLi.attr('data-size'));
				if ( size > 1 ) {
					parentLi.attr('data-size',(size-1));
					dataSizeToClass(); 
					var set;
					clearTimeout(set);
					set = setTimeout(function() { setVisualContent(); }, 200);
				} else {
					var textCant = 'Sorry, you reached the minimum width';
					jQuery('body').append('<div id="pix_builder_cant" /></div>');
					jQuery('#pix_builder_cant').text(textCant).dialog({
						buttons: false,
						width: 200,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Sorry, you can\'t',
						zIndex: 100,
						close: function(){
							jQuery('#pix_builder_cant').remove();
						}
					});
				}
			});
			
			jQuery(document).off('click','ul.pix_builded_grid > span > li .pix_builder_clone');
			jQuery(document).on('click','ul.pix_builded_grid > span > li .pix_builder_clone',function(){
				var parent = jQuery(this).parents('ul.pix_builded_grid').eq(0),
					parentLi = jQuery(this).parents('li[data-size]').eq(0)
					sizeT = parseFloat(parent.attr('data-size')),
					size = parseFloat(parentLi.attr('data-size')),
					clone = parentLi.clone();
				if ( (sizeT+size) <= max_columns ) {
					parentLi.after(clone);
				} else {
					var textCant = 'Sorry, this movement is not possible. This doesn\'t fit here';
					jQuery('body').append('<div id="pix_builder_cant" /></div>');
					jQuery('#pix_builder_cant').text(textCant).dialog({
						buttons: false,
						width: 200,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Sorry, you can\'t',
						zIndex: 100,
						close: function(){
							jQuery('#pix_builder_cant').remove();
						}
					});
				}
				dataSizeToClass();
				addItemIcons();
				builderSortable();
				var set;
				clearTimeout(set);
				set = setTimeout(function(){ setVisualContent(); },200);
			});
			
			jQuery(document).off('click','ul.pix_builded_grid > .pix_builder_clone');
			jQuery(document).on('click','ul.pix_builded_grid > .pix_builder_clone',function(){
				var parent = jQuery(this).parents('ul.pix_builded_grid').eq(0),
					clone = parent.clone();
				parent.after(clone);
				dataSizeToClass();
				addItemIcons();
				builderSortable();
				var set;
				clearTimeout(set);
				set = setTimeout(function(){ setVisualContent(); },200);
			});
		
		
			jQuery(document).off('click','ul.pix_builded_grid > .pix_builder_remove');
			jQuery(document).on('click','ul.pix_builded_grid > .pix_builder_remove',function(){
				var parent = jQuery(this).parents('ul.pix_builded_grid').eq(0),
					textCant = 'Are you sure you want to delete this section?';
				jQuery('body').append('<div id="pix_builder_cant" /></div>');
				jQuery('#pix_builder_cant').text(textCant).dialog({
					width: 200,
					modal: true,
					dialogClass: 'wp-dialog pix-dialog',
					title: 'Are you sure?',
					buttons: {
						"Yes, I'm sure": function() {
							jQuery( this ).dialog( "close" );
							parent.removeClass('transitioning').fadeTo(350, 0,function(){
								jQuery(this).hide(150,function(){
									jQuery(this).remove();
									dataSizeToClass();
									var set;
									clearTimeout(set);
									set = setTimeout(function(){ setVisualContent(); },200);
								});
							});
							
						},
						"No, cancel": function() {
							jQuery( this ).dialog( "close" );
						}
					},
					zIndex: 100,
					close: function(){
						jQuery('#pix_builder_cant').remove();
					}
				});
			});

			jQuery(document).off('click',"ul.pix_builded_grid > span > li .pix_builder_edit");
			jQuery(document).on('click',"ul.pix_builded_grid > span > li .pix_builder_edit",function(){
				tinymce.execCommand('mceRemoveEditor',false,'textArea');
				var li = jQuery(this).parents('li').eq(0),
					htmlThis = jQuery('.liContent',li).text(),
					h = jQuery(window).height(),
					div = jQuery('#textarea_builder'),
					dataClass = li.attr('data-class');
				jQuery(div).dialog({
					width: '80%',
					modal: false,
					dialogClass: 'wp-dialog pix-dialog pix-page-builder',
					title: 'Add some content',
					zIndex: 50,
					open: function(){
						//forteTinyMCEinit();
						jQuery('body').append('<div id="pix-modal-overlay" />');
						jQuery('#pix-modal-overlay').css({
							background: '#000000',
							bottom: 0,
							height: '100%',
							left: 0,
							opacity: 0.6,
							position: 'fixed',
							right: 0,
							top: 0,
							width: '100%',
							zIndex: 1000
						});
						tinymce.execCommand('mceAddEditor',false,'textArea');
						tinymce.execCommand('mceFocus',false,'textArea');
						tinymce.get('textArea').setContent(htmlThis);
						var bodyTMCE = tinymce.get('textArea').dom.select('body');
						jQuery(bodyTMCE).addClass(dataClass);
						jQuery('#wp-textArea-wrap').removeClass('html-active').addClass('tmce-active');
						/******************************************************
						*
						*	iFrame height
						*
						******************************************************/
						var allImgIframe = tinymce.get('textArea').dom.select('img.mceItemIframe');
						jQuery(function() {
							jQuery(allImgIframe).each(function () {
								var iframe = jQuery(this),
									h = iframe.attr('height'),
									w = iframe.width();
									
								if ( typeof h !== 'undefined' && h !== false && h.indexOf('%')!=-1 && !jQuery(this).parents('div').eq(0).hasClass('letmebe') ) {
									ratio = Math.round(parseInt(h));
									iframe.height( (w*(ratio*0.01)) );
									jQuery(window).bind('resize',function(){
										w = iframe.width();
										iframe.height( (w*(ratio*0.01)) );
									});
								}
							});
							
						});
					},
					buttons: [ 
						{
							text: "Edit", 
							click: function() { 
								var cont;
								if ( jQuery('#wp-textArea-wrap').hasClass('html-active') && tinymce.activeEditor.getParam('wpautop', true) ) {
									cont = switchEditors.wpautop(jQuery('textarea#textArea').val());
								} else {
									cont = tinymce.activeEditor.getContent();
								}

								jQuery('.liContent',li).text(cont);

								var set;
								clearTimeout(set);
								set = setTimeout(function(){ setVisualContent(); },200);
												
								var bodyTMCE = tinymce.get('textArea').dom.select('body');
								jQuery( this ).dialog( "close" );
							} 
						},
						{
							text: "Cancel", 
							click: function() { 
								jQuery( this ).dialog( "close" );
							} 
						}

					],
					close: function(){
						var bodyTMCE = tinymce.get('textArea').dom.select('body');
						jQuery(bodyTMCE).removeClass(dataClass);
						jQuery('#pix-modal-overlay').remove();
					}
				});
			});
			
			jQuery(document).off('click',"ul.pix_builded_grid > span > li .pix_builder_bg");
			jQuery(document).on('click',"ul.pix_builded_grid > span > li .pix_builder_bg",function(){
				
				var el = jQuery(this).parents('li').eq(0);
				
				tb_show('', 'media-upload.php?type=image&height=800&width=600&TB_iframe=true');
		
				window.image_send_to_editor = window.send_to_editor;
				window.send_to_editor = function(html, f) {
		
					var imgurl = jQuery('img',html).attr('src');
					
					el.css({
						backgroundImage : 'url('+imgurl+')'
					});
					
					var set;
					clearTimeout(set);
					set = setTimeout(function(){ setVisualContent(); },200);
					
					tb_remove();
				
				}
			});
			
			jQuery(document).off('click',"ul.pix_builded_grid > span > li .pix_builder_cancelbg");
			jQuery(document).on('click',"ul.pix_builded_grid > span > li .pix_builder_cancelbg",function(){
				
				var el = jQuery(this).parents('li').eq(0);
				
				el.css({
					backgroundImage : ''
				});
				
				var set;
				clearTimeout(set);
				set = setTimeout(function(){ setVisualContent(); },200);
					
				tb_remove();
				
			});
			
			jQuery(document).off('click',"ul.pix_builded_grid > span > li .pix_builder_repeat");
			jQuery(document).on('click',"ul.pix_builded_grid > span > li .pix_builder_repeat",function(){
				
				var parent = jQuery(this).parents('li').eq(0);
				
				if ( jQuery(this).hasClass('pix_cover') ) {
					jQuery(this).removeClass('pix_cover').addClass('pix_norepeat').attr('data-tip','Portrait bg (click to change)').trigger('retooltip');
					jQuery('#pix_tooltip').html('Portrait bg (click to change)');
					parent.removeClass('pix_cover').addClass('pix_norepeat');
				} else if( jQuery(this).hasClass('pix_norepeat') ) {
					jQuery(this).removeClass('pix_norepeat').attr('data-tip','Repeated bg (click to change)').trigger('retooltip');
					jQuery('#pix_tooltip').html('Repeated bg (click to change)');
					parent.removeClass('pix_norepeat');
				} else {
					jQuery(this).addClass('pix_cover').attr('data-tip','Fullscreen bg (click to change)').trigger('retooltip');
					jQuery('#pix_tooltip').html('Fullscreen bg (click to change)');
					parent.addClass('pix_cover');
				}
				
				var set;
				clearTimeout(set);
				set = setTimeout(function(){ setVisualContent(); },200);
					
			});
			
			jQuery(document).off('click',"ul.pix_builded_grid > span > li .pix_builder_slideheight")
			jQuery(document).on('click',"ul.pix_builded_grid > span > li .pix_builder_slideheight",function(){
				
				var parent = jQuery(this).parents('li').eq(0);
				
				if ( jQuery(this).hasClass('pix_fullheight') ) {
					jQuery(this).removeClass('pix_fullheight').attr('data-tip','Auto height (click to change)').trigger('retooltip');
					jQuery('#pix_tooltip').html('Auto height (click to change)');
					parent.removeClass('pix_fullheight');
				} else {
					jQuery(this).addClass('pix_fullheight').attr('data-tip','100% height (click to change)').trigger('retooltip');
					jQuery('#pix_tooltip').html('100% height (click to change)');
					parent.addClass('pix_fullheight');
				}
				
				var set;
				clearTimeout(set);
				set = setTimeout(function(){ setVisualContent(); },200);
					
			});
			
			jQuery(document).off('click',"ul.pix_builded_grid > span > li .pix_builder_slideshow");
			jQuery(document).on('click',"ul.pix_builded_grid > span > li .pix_builder_slideshow",function(){
				
				var parent = jQuery(this).parents('li').eq(0);
				
				var t = jQuery("#slideshow_generator").clone();
				t.dialog({
					height: 'auto',
					maxHeight: '800',
					width: 'auto',
					modal: true,
					dialogClass: 'wp-dialog pix-dialog',
					title: 'Slideshow shortcode generator',
					zIndex: 100
				});
				jQuery('.button',t).one('click',function(){
					var set;
					clearTimeout(set);
					set = setTimeout(function(){ setVisualContent(); },200);
					var form = jQuery('select option:selected',t).val();
					t.dialog('close').remove();
					jQuery('> span.liContent', parent).html('<p>[pix_slideshow data-slideshow=\''+form+'\']</p>' );
				});
		
				var set;
				clearTimeout(set);
				set = setTimeout(function(){ setVisualContent(); },200);
					
			});
			
			jQuery(document).off('click',"ul.pix_builded_grid > span > li .pix_builder_id");
			jQuery(document).on('click',"ul.pix_builded_grid > span > li .pix_builder_id",function(){
				var t = jQuery(this).parents('li').eq(0),
					idThis = typeof t.attr('id') === "undefined" ? '' : t.attr('id'),
					textCant = '<form><fieldset><label>Add an ID (latin characters only and no empty space allowed):</label><input type="text" name="idThis" id="idThis" value="'+idThis+'"></fieldset></form>';
				jQuery('body').append('<div id="pix_builder_cant" class="pix_builder_form" /></div>');
				jQuery('#pix_builder_cant').html(textCant).dialog({
					width: 300,
					modal: true,
					dialogClass: 'wp-dialog pix-dialog',
					title: 'Add an ID',
					zIndex: 50,
					buttons: {
						'Add': function() {
							var value = jQuery( 'input#idThis',this ).val();
							t.attr('id',value);
							jQuery( this ).dialog( "close" );
							var set;
							clearTimeout(set);
							set = setTimeout(function(){ setVisualContent(); },200);
						},
						Cancel: function() {
							jQuery( this ).dialog( "close" );
						}
					},
					close: function(){
						jQuery('#pix_builder_cant').remove();
					}
				});
			});
			
			jQuery(document).off('click','#pix_builder_tools .pix_builder_addrow');
			jQuery(document).on('click','#pix_builder_tools .pix_builder_addrow',function(){
				jQuery('#pix_builder_canvas > .wrap').append('<ul class="pix_builded_grid" data-size="0"><span></span></ul>');
				addRowIcons();
				addItemIcons();
				builderSortable();
				var set;
				clearTimeout(set);
				set = setTimeout(function(){ setVisualContent(); },200);
			});
		}
	}
		
}


/********************************
*
*	Tooltips
*
********************************/
function pix_tooltips() {
	var setOut,
		setIn;
	jQuery('*[data-tip]').bind('mouseenter retooltip',function(){
		var t = jQuery(this);
		setOut = setTimeout(function(){
			var off,
				cont = t.attr('data-tip'),
				position = t.attr('data-position'),
				ttW,
				left,
				arrowClass,
				arrowTop,
				arrowLeft,
				top;
			if ( position == 'bottom' ) {
				arrowClass = 'totop_arrow';
			} else {
				arrowClass = 'tobottom_arrow';
			}
			off = t.offset();
			tW = parseFloat(t.outerWidth()*0.5);
			tH = parseFloat(t.outerHeight());
			jQuery('html').append('<div id="pix_tooltip">'+cont+'</div><div id="pix_tooltip_arrow" class="'+arrowClass+'"></div>');
			jQuery('#pix_tooltip').css({
				top: 0,
				left: 0,
				display: 'block',
				opacity: 0,
				width: t.attr('data-width')+'px'
			});
			ttW = parseFloat(jQuery('#pix_tooltip').outerWidth()) * 0.5;
			ttH = parseFloat(jQuery('#pix_tooltip').outerHeight());
			if ( position == 'bottom' ) {
				arrowTop = ( off.top + tH );
				top = (( off.top + tH ) + 4);
			} else {
				arrowTop = ( off.top );
				top = ( off.top - ttH ) - 4;
			}
			arrowLeft = (off.left+tW);
			left = ( off.left + tW ) - ttW;
			if ( left < 0 ) {
				left = 5;
			} else if ( (off.left+ttW) > jQuery(window).width() ) {
				left = ( ( jQuery(window).width() - (ttW*2) ) -5 );
			}
			jQuery('#pix_tooltip_arrow').css({
				top: arrowTop,
				left: arrowLeft
			}).fadeIn(100);
			jQuery('#pix_tooltip').css({
				top: top,
				left: left
			}).animate({opacity:1},100);
			
		},70);
	});
	jQuery('*[data-tip]').bind('mouseleave',function(){
		clearTimeout(setOut);
		jQuery('#pix_tooltip, #pix_tooltip_arrow').fadeOut(30,function(){
			jQuery(this).remove();
		});
	});

}

