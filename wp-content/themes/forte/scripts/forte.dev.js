jQuery.noConflict();

function isMobile() {
    if( navigator.userAgent.match(/Android/i) ||
        navigator.userAgent.match(/webOS/i) ||
        navigator.userAgent.match(/iPad/i) ||
        navigator.userAgent.match(/iPhone/i) ||
        navigator.userAgent.match(/iPod/i)
    ){
        return true;
    }
}

/**!
 * trunk8 v1.3.2
 * https://github.com/rviscomi/trunk8
 * 
 * Copyright 2012 Rick Viscomi
 * Released under the MIT License.
 * 
 * Date: October 21, 2012
 */

(function($){var methods,utils,SIDES={center:'center',left:'left',right:'right'},WIDTH={auto:'auto'};function trunk8(element){this.$element=$(element);this.original_text=this.$element.html();this.settings=$.extend({},$.fn.trunk8.defaults);}trunk8.prototype.updateSettings=function(options){this.settings=$.extend(this.settings,options);};function truncate(){var data=this.data('trunk8'),settings=data.settings,width=settings.width,side=settings.side,fill=settings.fill,line_height=utils.getLineHeight(this)*settings.lines,str=data.original_text,length=str.length,max_bite='',lower,upper,bite_size,bite;this.html(str);if(width===WIDTH.auto){if(this.height()<=line_height){return;}lower=0;upper=length-1;while(lower<=upper){bite_size=lower+((upper-lower)>>1);bite=utils.eatStr(str,side,length-bite_size,fill);this.html(bite);if(this.height()>line_height){upper=bite_size-1;}else{lower=bite_size+1;max_bite=(max_bite.length>bite.length)?max_bite:bite;}}this.html('');this.html(max_bite);if(settings.tooltip){this.attr('data-title',str);}}else if(!isNaN(width)){bite_size=length-width;bite=utils.eatStr(str,side,bite_size,fill);this.html(bite);if(settings.tooltip){this.attr('data-title',str);}}else{$.error('Invalid width "'+width+'".');}}methods={init:function(options){return this.each(function(){var $this=$(this),data=$this.data('trunk8');if(!data){$this.data('trunk8',(data=new trunk8(this)));}data.updateSettings(options);truncate.call($this);});},update:function(new_string){return this.each(function(){var $this=$(this);if(new_string){$this.data('trunk8').original_text=new_string;}truncate.call($this);});},revert:function(){return this.each(function(){var text=$(this).data('trunk8').original_text;$(this).html(text);});},getSettings:function(){return this.get(0).data('trunk8').settings;}};utils={eatStr:function(str,side,bite_size,fill){var length=str.length,key=utils.eatStr.generateKey.apply(null,arguments),half_length,half_bite_size;if(utils.eatStr.cache[key]){return utils.eatStr.cache[key];}if((typeof str!=='string')||(length===0)){$.error('Invalid source string "'+str+'".');}if((bite_size<0)||(bite_size>length)){$.error('Invalid bite size "'+bite_size+'".');}else if(bite_size===0){return str;}if(typeof(fill+'')!=='string'){$.error('Fill unable to be converted to a string.');}switch(side){case SIDES.right:return utils.eatStr.cache[key]=$.trim(str.substr(0,length-bite_size))+fill;case SIDES.left:return utils.eatStr.cache[key]=fill+$.trim(str.substr(bite_size));case SIDES.center:half_length=length>>1;half_bite_size=bite_size>>1;return utils.eatStr.cache[key]=$.trim(utils.eatStr(str.substr(0,length-half_length),SIDES.right,bite_size-half_bite_size,''))+fill+$.trim(utils.eatStr(str.substr(length-half_length),SIDES.left,half_bite_size,''));default:$.error('Invalid side "'+side+'".');}},getLineHeight:function(elem){var $elem=$(elem),float=$elem.css('float'),position=$elem.css('position'),html=$elem.html(),wrapper_id='line-height-test',line_height;if(float!=='none'){$elem.css('float','none');}if(position==='absolute'){$elem.css('position','static');}$elem.html('i').wrap('<div id="'+wrapper_id+'" />');line_height=$('#'+wrapper_id).innerHeight();$elem.html(html).css({'float':float,'position':position}).unwrap();return line_height;}};utils.eatStr.cache={};utils.eatStr.generateKey=function(){return Array.prototype.join.call(arguments,'');};$.fn.trunk8=function(method){if(methods[method]){return methods[method].apply(this,Array.prototype.slice.call(arguments,1));}else if(typeof method==='object'||!method){return methods.init.apply(this,arguments);}else{$.error('Method '+method+' does not exist on jQuery.trunk8');}};$.fn.trunk8.defaults={fill:'&hellip;',lines:1,side:SIDES.right,tooltip:true,width:WIDTH.auto};})(jQuery);


/*! Copyright 2012, Ben Lin (http://dreamerslab.com/)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Version: 1.0.13
 *
 * Requires: jQuery 1.2.3 ~ 1.8.2
 */
;(function(a){a.fn.extend({actual:function(b,l){if(!this[b]){throw'$.actual => The jQuery method "'+b+'" you called does not exist';}var f={absolute:false,clone:false,includeMargin:false};var i=a.extend(f,l);var e=this.eq(0);var h,j;if(i.clone===true){h=function(){var m="position: absolute !important; top: -1000 !important; ";e=e.clone().attr("style",m).appendTo("body");};j=function(){e.remove();};}else{var g=[];var d="";var c;h=function(){c=e.parents().andSelf().filter(":hidden");d+="visibility: hidden !important; display: block !important; ";if(i.absolute===true){d+="position: absolute !important; ";}c.each(function(){var m=a(this);g.push(m.attr("style"));m.attr("style",d);});};j=function(){c.each(function(m){var o=a(this);var n=g[m];if(n===undefined){o.removeAttr("style");}else{o.attr("style",n);}});};}h();var k=/(outer)/g.test(b)?e[b](i.includeMargin):e[b]();j();return k;}});})(jQuery);


;(function($){
  var
  props = ['Width', 'Height'],
  prop;

  while (prop = props.pop()) {
    (function (natural, prop) {
      $.fn[natural] = (natural in new Image()) ? 
      function () {
        return this[0][natural];
      } : 
      function () {
        var 
        node = this[0],
        img,
        value;

        if (node.tagName.toLowerCase() === 'img') {
          img = new Image();
          img.src = node.src,
          value = img[prop];
        }
        return value;
      };
    }('natural' + prop, prop.toLowerCase()));
  }
}(jQuery));

function excerptTruncate() {
    jQuery('.entry-summary p').each(function(){
        var t = jQuery(this),
            lines = parseFloat(t.parent().attr('data-lines'));
                                
        t.parent().show();
        t.trunk8({
            fill: ' [&hellip;]',
            lines: lines
        });
        
        jQuery(".pix_column").bind('oanimationend animationend webkitAnimationEnd', function() {
            t.trunk8('update');
        });
        jQuery(window).bind('resize', function() {
            t.trunk8('update');
        });
    });
}

(function ($) {
    // Monkey patch jQuery 1.3.1+ css() method to support CSS 'transform'
    // property uniformly across Safari/Chrome/Webkit, Firefox 3.5+, IE 9+, and Opera 11+.
    // 2009-2011 Zachary Johnson www.zachstronaut.com
    // Updated 2011.05.04 (May the fourth be with you!)
    function getTransformProperty(element)
    {
        // Try transform first for forward compatibility
        // In some versions of IE9, it is critical for msTransform to be in
        // this list before MozTranform.
        var properties = ['transform', 'WebkitTransform', 'msTransform', 'MozTransform', 'OTransform'];
        var p;
        while (p = properties.shift())
        {
            if (typeof element.style[p] != 'undefined')
            {
                return p;
            }
        }
        
        // Default to transform also
        return 'transform';
    }
    
    var _propsObj = null;
    
    var proxied = $.fn.css;
    $.fn.css = function (arg, val)
    {
        // Temporary solution for current 1.6.x incompatibility, while
        // preserving 1.3.x compatibility, until I can rewrite using CSS Hooks
        if (_propsObj === null)
        {
            if (typeof $.cssProps != 'undefined')
            {
                _propsObj = $.cssProps;
            }
            else if (typeof $.props != 'undefined')
            {
                _propsObj = $.props;
            }
            else
            {
                _propsObj = {}
            }
        }
        
        // Find the correct browser specific property and setup the mapping using
        // $.props which is used internally by jQuery.attr() when setting CSS
        // properties via either the css(name, value) or css(properties) method.
        // The problem with doing this once outside of css() method is that you
        // need a DOM node to find the right CSS property, and there is some risk
        // that somebody would call the css() method before body has loaded or any
        // DOM-is-ready events have fired.
        if
        (
            typeof _propsObj['transform'] == 'undefined'
            &&
            (
                arg == 'transform'
                ||
                (
                    typeof arg == 'object'
                    && typeof arg['transform'] != 'undefined'
                )
            )
        )
        {
            _propsObj['transform'] = getTransformProperty(this.get(0));
        }
        
        // We force the property mapping here because jQuery.attr() does
        // property mapping with jQuery.props when setting a CSS property,
        // but curCSS() does *not* do property mapping when *getting* a
        // CSS property.  (It probably should since it manually does it
        // for 'float' now anyway... but that'd require more testing.)
        //
        // But, only do the forced mapping if the correct CSS property
        // is not 'transform' and is something else.
        if (_propsObj['transform'] != 'transform')
        {
            // Call in form of css('transform' ...)
            if (arg == 'transform')
            {
                arg = _propsObj['transform'];
                
                // User wants to GET the transform CSS, and in jQuery 1.4.3
                // calls to css() for transforms return a matrix rather than
                // the actual string specified by the user... avoid that
                // behavior and return the string by calling jQuery.style()
                // directly
                if (typeof val == 'undefined' && jQuery.style)
                {
                    return jQuery.style(this.get(0), arg);
                }
            }

            // Call in form of css({'transform': ...})
            else if
            (
                typeof arg == 'object'
                && typeof arg['transform'] != 'undefined'
            )
            {
                arg[_propsObj['transform']] = arg['transform'];
                delete arg['transform'];
            }
        }
        
        return proxied.apply(this, arguments);
    };
})(jQuery);

/*!
/**
 * Monkey patch jQuery 1.3.1+ to add support for setting or animating CSS
 * scale and rotation independently.
 * https://github.com/zachstronaut/jquery-animate-css-rotate-scale
 * Released under dual MIT/GPL license just like jQuery.
 * 2009-2012 Zachary Johnson www.zachstronaut.com
 */
(function ($) {
    // Updated 2010.11.06
    // Updated 2012.10.13 - Firefox 16 transform style returns a matrix rather than a string of transform functions.  This broke the features of this jQuery patch in Firefox 16.  It should be possible to parse the matrix for both scale and rotate (especially when scale is the same for both the X and Y axis), however the matrix does have disadvantages such as using its own units and also 45deg being indistinguishable from 45+360deg.  To get around these issues, this patch tracks internally the scale, rotation, and rotation units for any elements that are .scale()'ed, .rotate()'ed, or animated.  The major consequences of this are that 1. the scaled/rotated element will blow away any other transform rules applied to the same element (such as skew or translate), and 2. the scaled/rotated element is unaware of any preset scale or rotation initally set by page CSS rules.  You will have to explicitly set the starting scale/rotation value.
    
    function initData($el) {
        var _ARS_data = $el.data('_ARS_data');
        if (!_ARS_data) {
            _ARS_data = {
                rotateUnits: 'deg',
                scale: 1,
                rotate: 0
            };
            
            $el.data('_ARS_data', _ARS_data);
        }
        
        return _ARS_data;
    }
    
    function setTransform($el, data) {
        $el.css('transform', 'rotate(' + data.rotate + data.rotateUnits + ') scale(' + data.scale + ',' + data.scale + ')');
    }
    
    $.fn.rotate = function (val) {
        var $self = $(this), m, data = initData($self);
                        
        if (typeof val == 'undefined') {
            return data.rotate + data.rotateUnits;
        }
        
        m = val.toString().match(/^(-?\d+(\.\d+)?)(.+)?$/);
        if (m) {
            if (m[3]) {
                data.rotateUnits = m[3];
            }
            
            data.rotate = m[1];
            
            setTransform($self, data);
        }
        
        return this;
    };
    
    // Note that scale is unitless.
    $.fn.scale = function (val) {
        var $self = $(this), data = initData($self);
        
        if (typeof val == 'undefined') {
            return data.scale;
        }
        
        data.scale = val;
        
        setTransform($self, data);
        
        return this;
    };

    // fx.cur() must be monkey patched because otherwise it would always
    // return 0 for current rotate and scale values
    var curProxied = $.fx.prototype.cur;
    $.fx.prototype.cur = function () {
        if (this.prop == 'rotate') {
            return parseFloat($(this.elem).rotate());
            
        } else if (this.prop == 'scale') {
            return parseFloat($(this.elem).scale());
        }
        
        return curProxied.apply(this, arguments);
    };
    
    $.fx.step.rotate = function (fx) {
        var data = initData($(fx.elem));
        $(fx.elem).rotate(fx.now + data.rotateUnits);
    };
    
    $.fx.step.scale = function (fx) {
        $(fx.elem).scale(fx.now);
    };
    
    /*
    
    Starting on line 3905 of jquery-1.3.2.js we have this code:
    
    // We need to compute starting value
    if ( unit != "px" ) {
        self.style[ name ] = (end || 1) + unit;
        start = ((end || 1) / e.cur(true)) * start;
        self.style[ name ] = start + unit;
    }
    
    This creates a problem where we cannot give units to our custom animation
    because if we do then this code will execute and because self.style[name]
    does not exist where name is our custom animation's name then e.cur(true)
    will likely return zero and create a divide by zero bug which will set
    start to NaN.
    
    The following monkey patch for animate() gets around this by storing the
    units used in the rotation definition and then stripping the units off.
    
    */
    
    var animateProxied = $.fn.animate;
    $.fn.animate = function (prop) {
        if (typeof prop['rotate'] != 'undefined') {
            var $self, data, m = prop['rotate'].toString().match(/^(([+-]=)?(-?\d+(\.\d+)?))(.+)?$/);
            if (m && m[5]) {
                $self = $(this);
                data = initData($self);
                data.rotateUnits = m[5];
            }
            
            prop['rotate'] = m[1];
        }
        
        return animateProxied.apply(this, arguments);
    };
})(jQuery);

// filmore slideshow version 0.0.1 - a jQuery slideshow with many effects, transitions, easy to customize, using canvas and mobile ready, based on jQuery 1.4+
// Copyright (c) 2012 by Manuel Masia - www.pixedelic.com
// Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
;(function($){$.fn.filmore = function(opts, callback) {
    

    var slideshow = $(this).parents('.pix_slideshow').eq(0),
        target = $(this).wrapInner('<div class="film_slide" />'),

    defaults = {
        time            : 8000, //the milliseconds between a slide and the next one
        transPeriod     : 800, //the milliseconds that the transition effect takes
        easing          : 'easeInOutQuad',
        prev            : $('#prev'),
        next            : $('#next'),
        pause           : $('#pause'),
        play            : $('#play'),
        pagination      : $('#pagination'),
        loader          : $('#loader'),
        autoadv         : true,
        hover           : true,
        pieDiameter     : 20,
        loaderStroke    : 5,
        loaderColor     : pix_pie_stroke,
        loaderBgColor   : pix_pie_bg,
        loaderPadding   : 0,
        fullscreen      : false
    },
        opts = $.extend({}, defaults, opts),
        wrap = target.find('.film_slide'),
        arrSlides = new Array(),
        arrImages = new Array();
         
    $(' > div', wrap).each(function(){
        
        var index = $(this).index();
        $(this).addClass('filmoreSlide').addClass('filmoreSlide_'+index);
        arrImages[index] = new Array();
        
        $(' > div', wrap).eq(index).find('div[data-use="background"]').each(function(){
            var dataBg = $(this).attr('data-src');
            if ( dataBg.indexOf('?')!=-1 ) {
                var fixSymbol = '&';
            } else {
                var fixSymbol = '?';
            }
            $(this)
                .addClass('filmoreBgs')
            dataBg = dataBg/* + fixSymbol + 'filmoretime=' + new Date().getTime()*/;
            arrSlides.push(dataBg);
            $(this).attr('data-src',dataBg);
        });
        
        //I populate the array with all the other images
        $(' > div', wrap).eq(index).find('div[data-use="simple"], div[data-use="video"]').each(function(){
            var dataSrc = $(this).attr('data-src');
            if ( dataSrc.indexOf('?')!=-1 ) {
                var fixSymbol = '&';
            } else {
                var fixSymbol = '?';
            }
            dataSrc = dataSrc/* + fixSymbol + 'filmoretime=' + new Date().getTime()*/;
            arrImages[index].push(dataSrc);
            $(this).attr('data-src',dataSrc)
        });
        
    });
    
            
    var slideStartW = target.width();
    var slideStartH = target.height();

    target.css({
        width: '100%'
    });
    
    var slideW = $('.pix_slideshow_target_inner:visible',target).outerWidth();

    function resizeCinemascope(){
        
        var w = $(window).width(),
            h = $(window).height(),
            minH = parseFloat($('header').attr('data-height')),
            parent = target.parents('.pix_slideshow').eq(0).find('.filmore_commands'),
            minComm = parent.is(':visible') ? parseFloat(parent.outerHeight()) : 0,
            newH = h-(minH+minComm);

        $(this).css({
            height:newH
        });

        target.css({
            height:newH
        });
    }
                
    function resizeBg(){
        target.find('div[data-use="background"]:visible').each(function(){
            var w = target.outerWidth(),
                h = target.outerHeight(),
                t = $(this),
                img = t.find('img'),
                imgW = img.naturalWidth(),
                imgH = img.naturalHeight();

            if((imgW/imgH)>(w/h)) {
                        
                var r = h / imgH;
                var d = (w - (imgW*r))*0.5;
                img.css({
                    'height' : h,
                    'margin-left' : d+'px',
                    'margin-right' : d+'px',
                    'margin-top' : 0,
                    'position' : 'absolute',
                    'visibility' : 'visible',
                    'width' : imgW*r
                });
            } else {
                var r = w / imgW;
                var d = (h - (imgH*r))*0.5;
                img.css({
                    'height' : imgH*r,
                    'margin-left' : 0,
                    'margin-right' : 0,
                    'margin-top' : d+'px',
                    'position' : 'absolute',
                    'visibility' : 'visible',
                    'width' : w
                });
            }
        });
        target.not('.filmore_freezed').fadeIn();
    }

    if ( opts.fullscreen == true ) {
        var slideH = $('.pix_slideshow_target_inner',target).actual('outerHeight');
    } else {
        var slideH = target.outerHeight();
    }

    
    if ( opts.fullscreen == true ) {
        resizeCinemascope();
        $(window).bind('load resize', function(){
            resizeCinemascope();
            resizeBg();
        });
    } else {
        target.hide();
        target.css({
            height: (slideStartW*slideStartH)/slideW
        }).addClass('sized');
        $('body').ajaxSuccess(function() {
            if ( opts.fullscreen == true ) {
                slideW = $('.pix_slideshow_target_inner:visible',target).outerWidth();
            } else {
                slideW = target.outerWidth();
            }
            target.css({
                height: slideW/(slideStartW/slideStartH)
            });
            if ( opts.fullscreen == true ) {
                slideH = $('.pix_slideshow_target_inner',target).actual('outerHeight');
            } else {
                slideH = target.outerHeight();
            }
            resizeBg();
        });
        $(window).bind('load resize',function(){
            if ( opts.fullscreen == true ) {
                slideW = $('.pix_slideshow_target_inner:visible',target).outerWidth();
            } else {
                slideW = target.outerWidth();
            }
            target.css({
                height: slideW/(slideStartW/slideStartH)
            });
            if ( opts.fullscreen == true ) {
                slideH = $('.pix_slideshow_target_inner',target).actual('outerHeight');
            } else {
                slideH = target.outerHeight();
            }
            resizeBg();
        });
    }
    
    $('.filmore_caption').each(function(){
        var t = $(this),
            w = t.width();
        if ( w == 0 ) {
            t.css({
                whiteSpace: 'nowrap'
            });
        }
    }); 
    
    
    
    if (opts.pagination) {
        $.each(arrSlides, function(index, value) {
            $(opts.pagination).append(
                '<span class="filmore_pag filmore_pag_'+index+'" data-pag="'+index+'"><span>'+index+'</span></span>'
            );
        });
    }

    
    function shuffle(arr) {
        for(
          var j, x, i = arr.length; i;
          j = parseInt(Math.random() * i),
          x = arr[--i], arr[i] = arr[j], arr[j] = x
        );
        return arr;
    }


    var amountSlide = arrSlides.length;
        
            thisCheckImages(0,0);
            
            function thisCheckImages(slideI, counterThis){
                            
            if( arrSlides[slideI] && !target.find('.filmoreSlide_'+slideI).hasClass('filmoreLoaded')){ 
                    
                var arrThisImgs = new Array();
                arrThisImgs.push(arrSlides[slideI]);
                
                $.each(arrImages[slideI], function(index, value) {
                    arrThisImgs.push(value);
                });
                
                var countThisImgs = arrThisImgs.length;
                    
                function thisCheckImages_sec(slideI, counterThis){      
                    var imgUrl = arrThisImgs[counterThis];
                    
                    $('<img />').load( function(){
                                                
                        counterThis = counterThis+1;
                        if ( counterThis < countThisImgs ) {
                            clearTimeout(checkTimeout);
                            var checkTimeout = setTimeout(function(){
                                thisCheckImages_sec(slideI,counterThis);
                            },10);
                        } else {
                                        
                            target.find('.filmoreSlide_'+slideI)
                                .addClass('filmoreLoaded');
                                
                            target.find('.filmoreSlide_'+slideI+' div[data-use="background"]').not('.dataLoaded').each(function(){
                                var t = $(this);
                                var dataSrc = $(this).attr('data-src');
                                t.addClass('dataLoaded');
                                //if (jQuery.browser.msie && jQuery.browser.version < 9) {
                                    t.append('<img src="' + dataSrc + '" />');
                                //}
                                $('<img />').load( function(){

                                    var w = target.outerWidth(),
                                        h = target.outerHeight(),
                                        img = t.find('img'),
                                        imgW = img.naturalWidth(),
                                        imgH = img.naturalHeight();
                                    if ( target.find('.filmoreSlide_'+slideI+' > div[data-src].filmoreLoaded').length == countThisImgs ) {
                                        target.find('.filmoreSlide_'+slideI)
                                            .addClass('filmoreLoaded');
                                    }
                                    
                                    /*if (!(jQuery.browser.msie && jQuery.browser.version < 9)) {
                                        t.css({
                                            backgroundAttachment : 'scroll',
                                            backgroundImage : 'url('+dataSrc+')',
                                            backgroundPosition : '50% 50%',
                                            backgroundRepeat : 'no-repeat',
                                            backgroundSize : 'cover'
                                        });
                                    } else {*/
                                        t.find('img').css({
                                            position: 'absolute'
                                        }).addClass('filmoreLoaded');
                                        if ( target.find('.filmoreSlide_'+slideI+' > div[data-src].filmoreLoaded').length == countThisImgs ) {
                                            target.find('.filmoreSlide_'+slideI)
                                                .addClass('filmoreLoaded');
                                        }
                                        if((imgW/imgH)>(w/h)) {
                                            var r = h / imgH;
                                            var d = (w - (imgW*r))*0.5;
                                            img.css({
                                                'height' : h,
                                                'margin-left' : d+'px',
                                                'margin-right' : d+'px',
                                                'margin-top' : 0,
                                                'position' : 'absolute',
                                                'visibility' : 'visible',
                                                'width' : imgW*r
                                            });
                                        } else {
                                            var r = w / imgW;
                                            var d = (h - (imgH*r))*0.5;
                                            img.css({
                                                'height' : imgH*r,
                                                'margin-left' : 0,
                                                'margin-right' : 0,
                                                'margin-top' : d+'px',
                                                'position' : 'absolute',
                                                'visibility' : 'visible',
                                                'width' : w
                                            });
                                        }
                                    //}
                                        
                                    
                                }).attr('src', dataSrc).each(function() {
                                    if(this.complete) $(this).load();
                                });
                            });
                                
                            target.find('.filmoreSlide_'+slideI+' div[data-use="video"]').not('.dataLoaded').each(function(){
                                var t = $(this);
                                var dataSrc = $(this).attr('data-src') != '' ? $(this).attr('data-src') : forte_theme_dir+'/images/blank.gif';
                                t.addClass('dataLoaded');
                                t.append('<div class="imgFake" />');
                                var div = $('.imgFake',t);
                                div.css({
                                    position: 'absolute',
                                    bottom: 0,
                                    top: 0,
                                    right: 0,
                                    left: 0,
                                    width: '100%',
                                    height: '100%',
                                    overflow: 'hidden'
                                });
                                $('<img />').load( function(){
                                    var natW = ((parseFloat(t.attr('data-width'))/slideStartW)*100),
                                        natH = ((parseFloat(t.attr('data-height'))/slideStartH)*100);
                                    div.css({
                                        backgroundImage: 'url('+dataSrc+')',
                                        backgroundRepeat: 'no-repeat',
                                        backgroundSize: 'cover',
                                        display: 'none'
                                    });
                                    t.css({width:natW+'%',height:natH+'%'}).addClass('filmoreLoaded');
                                    if ( target.find('.filmoreSlide_'+slideI+' > div[data-src].filmoreLoaded').length == countThisImgs ) {
                                        target.find('.filmoreSlide_'+slideI)
                                            .addClass('filmoreLoaded');
                                    }
                                }).attr('src', dataSrc).each(function() {
                                    if(this.complete) $(this).load();
                                });
                            });
                                
                            target.find('.filmoreSlide_'+slideI+' div[data-use="simple"]').not('.dataLoaded').each(function(){
                                var t = $(this);
                                var dataSrc = $(this).attr('data-src');
                                var thisApp = $('> a',this).length ? $('> a',this) : $(this);
                                $(this).addClass('dataLoaded');
                                thisApp.append('<img src="' + dataSrc + '" />');
                                $('<img />').load( function(){
                                    var img = $(this);
                                    var natW = ((parseFloat(img.naturalWidth())/slideStartW)*100);
                                    t.css({width:natW+'%',display:'none'}).addClass('filmoreLoaded');
                                    if ( target.find('.filmoreSlide_'+slideI+' > div[data-src].filmoreLoaded').length == countThisImgs ) {
                                        target.find('.filmoreSlide_'+slideI)
                                            .addClass('filmoreLoaded');
                                    }
                                }).attr('src', dataSrc).each(function() {
                                    if(this.complete) $(this).load();
                                });
                            });
                                
                            thisCheckImages(slideI+1);
                        }
                    }).attr('src', imgUrl).each(function() {
                        if(this.complete) $(this).load();
                    });
                }
                
                thisCheckImages_sec(slideI, 0);

            }
            }
            

                $('iframe[src]',target).each(function(){
                    var t = $(this).css({
                        position: 'absolute',
                        top: 0,
                        left: 0
                    }),
                        autoplay;
                    
                    var src = t.attr('src');
                    if ( src.indexOf('autoplay') == -1 ) {
                        if(src.indexOf('vimeo') != -1 || src.indexOf('youtube') != -1) {
                            if(src.indexOf('?') != -1){
                                autoplay = '&autoplay=1';
                            } else {
                                autoplay = '?autoplay=1';
                            }
                        } else if(src.indexOf('dailymotion') != -1) {
                            if(cloneSrc.indexOf('?') != -1){
                                autoplay = '&autoPlay=1';
                            } else {
                                autoplay = '?autoPlay=1';
                            }
                        }
                    }
                    t.attr('data-src',src+autoplay);
                    src = t.attr('data-src');
                    var parent = t.parents('div').eq(0);
                    var valW = t.attr('width'),
                        valH = t.attr('height');
                                        
                    parent.attr('data-width',valW).attr('data-height',valH);
                    t.attr('width','100%').attr('height','100%').removeAttr('src');

                    target.off('click','.imgFake');
                    target.on('click','.imgFake',function(){
                        var parent = $(this).parents('div').eq(0),
                            src = $('iframe',parent).attr('data-src');
                        $('iframe',parent).attr('src',src).show();
                        if ( jQuery(this).parents('[data-use="video"]').eq(0).attr('data-stop') == 'true' && opts.pause.length ) {
                            opts.pause.click();
                        }
                        $(this).hide();
                    });
                });


            target.css({
                visibility: 'visible'
            });
            
            var pieID = 'filmore_loader_'+wrap.index('.film_slide');
            opts.loader.append('<canvas id="'+pieID+'"></canvas>');
            var G_vmlCanvasManager;
            var canvas = document.getElementById(pieID);
            canvas.setAttribute("width", opts.pieDiameter);
            canvas.setAttribute("height", opts.pieDiameter);
            var rad;
            var radNew;
    
            if (canvas && canvas.getContext) {
                var ctx = canvas.getContext("2d");
                ctx.rotate(Math.PI*(3/2));
                ctx.translate(-opts.pieDiameter,0);
            }
        function canvasLoader() {
            rad = 0;
            if (!(jQuery.browser.msie && jQuery.browser.version < 9)) {
                ctx.clearRect(0,0,opts.pieDiameter,opts.pieDiameter); 
            }
        }
        
        
        canvasLoader();



    var alreadyStarted = false,
        rad,
        intval,
        iframeTimeOut;
    checkIframe(0);
        
    if ( opts.autoadv == false ) {
        target.addClass('filmore_stopped');
    }
    
    if ( opts.hover == true ) {
        target.hover(function(){
            target.addClass('filmore_hovered');
        },function(){
            target.removeClass('filmore_hovered');
        });
    }
    
        function checkIframe(navSlide, direction) {
            if ( !$('iframe[src]',target).length ) {
                nextSlide(navSlide, direction);
            } else {
                $('iframe[src]',target).each(function(){
                    var t = $(this);
                    var src = t.attr('src');
                    t.attr('data-src',src);
                    var parent = t.parents('div').eq(0);
                    parent.find('.imgFake').show();
                    t.fadeOut(400,function(){
                        clearInterval(intval);
                        clearTimeout(iframeTimeOut);
                        t.removeAttr('src');
                        iframeTimeOut = setTimeout(function(){
                            nextSlide(navSlide, direction)
                        },500);
                    });

                    $('.imgFake').off('click');
                    $('.imgFake').live('click',function(){
                        var parent = $(this).parents('div').eq(0),
                            src = $('iframe',parent).attr('data-src');
                        $('iframe',parent).attr('src',src).show();
                        if ( jQuery(this).parents('[data-use="video"]').eq(0).attr('data-stop') == 'true' && opts.pause.length ) {
                            opts.pause.click();
                        }
                        $(this).hide();
                    });
                });
            }
        }



    function nextSlide(navSlide, direction){

        clearInterval(intval);
        rad = 0;
        opts.loader.fadeOut(200);

        target.addClass('filmoresliding');
                
        var slideI;


        if (navSlide < 0 ) {
            slideI = (amountSlide-1); 
        } else if (navSlide >= amountSlide ) {
            slideI = 0;
        } else {
            slideI = navSlide;
        }
        
        direction = direction=='' ? 'next' : direction;
    
        switch(direction){
            case 'prev':
                minusSign = '+';
                plusSign = '-';
                break;
            default:
                minusSign = '-';
                plusSign = '+';
                break;
        }

        var slide = $('.filmoreSlide:eq('+slideI+')',target);
        var current = $('.filmoreSlide.filmoreCurrent',target);
        if ( opts.pagination.length ) {
            opts.pagination.find('.filmore_pag').removeClass('filmore_current_pag');
            opts.pagination.find('.filmore_pag.filmore_pag_'+slideI).addClass('filmore_current_pag');
        }
                
        clearTimeout(slideTryAgain);
        

        var leng = current.find('div[data-use="simple"], div[data-use="video"], div[data-use="caption"], div[data-use="html"]').length,
            animated;

        if( arrSlides[slideI] && target.find('.filmoreSlide_'+slideI).hasClass('filmoreLoaded')){ 
            $('div.filmoreSlide',target).css({
                zIndex : 0 
            });             
                            
            
            function delaySlide() {
            
                if ( alreadyStarted ) {

                    slide
                        .css({
                            left : '0%', 
                            zIndex : 1 
                        })
                        .show()
                        /*.delay(300).animate({
                            left : '0%'
                        },opts.transPeriod,opts.easing,function(){
                            $('div.filmoreSlide',target).removeClass('filmoreCurrent'); 
                            $(this).addClass('filmoreCurrent').addClass('filmoreLoaded');
                            $('div.filmoreSlide',target).not('.filmoreCurrent').hide(); 
                            target.removeClass('filmoresliding'); 
                            filmoreTimer(slideI+1);
                        })*/
                    .find('div[data-use="background"]').each(function(){
                        /*$(this).css({
                            left : minusSign+'80%',
                            backgroundPositionX : plusSign+'20%'
                        });
                        
                        /*$(this).stop(true,true).delay(300).animate({
                            left: '0%',
                            backgroundPositionX: '50%'
                        },opts.transPeriod,opts.easing);*/

                        resizeBg();

                        $(this).hide().stop(true,true).fadeIn(opts.transPeriod,function(){
                            $('div.filmoreSlide',target).removeClass('filmoreCurrent'); 
                            slide.addClass('filmoreCurrent').addClass('filmoreLoaded');
                            $('div.filmoreSlide',target).not('.filmoreCurrent').hide(); 
                            target.removeClass('filmoresliding'); 
                            otherSlides();
                            filmoreTimer(slideI+1);
                            resizeBg();
                        });
                    }); 
                } else {
                    slide.find('div[data-use="simple"], div[data-use="video"], div[data-use="caption"], div[data-use="html"]').each(function(){
                        var objW = $(this).outerWidth(),
                            objH = $(this).outerHeight(),
                            dataTime = $(this).attr('data-time')!='undefined' ? parseFloat($(this).attr('data-time')) : opts.transPeriod,
                            thisDelay = $(this).attr('data-delay')!='undefined' ? parseFloat($(this).attr('data-delay')) : 0;
        
                        eval('var css = {' + $(this).attr('data-style') + '}');
    
                        $(this).css(css);
                    });
                    target.removeClass('pix_slideshow_preloading');
                    $('body').trigger('filmore_started');

                    slide.fadeIn(opts.transPeriod,function(){
                        slideW = $('.pix_slideshow_target_inner',target).actual('outerWidth');
                        slideH = $('.pix_slideshow_target_inner',target).actual('outerHeight');
                        pixSlideshowInnerPos();
                    
                        $(this).addClass('filmoreCurrent').addClass('filmoreLoaded');
                        target.removeClass('filmoresliding');
                        alreadyStarted = true;
                        slideshow.removeClass('pix_slideshow_preloading');
                        otherSlides();
                        filmoreTimer(slideI+1);
                    });
                }
                
                function otherSlides(){

                    slide.find('div[data-use="simple"], div[data-use="video"], div[data-use="caption"], div[data-use="html"]').css('visibility','hidden').each(function(){
                        var objW = $(this).outerWidth(),
                            objH = $(this).outerHeight(),
                            gapW = parseFloat($('.pix_slideshow_target_inner',slide).offset().left),
                            gapH = (opts.fullscreen == true) ? parseFloat($('.pix_slideshow_target_inner',slide).offset().top) : 0, 
                            slideW = parseFloat($('.pix_slideshow_target_inner',slide).actual('outerWidth')),
                            slideH = parseFloat($('.pix_slideshow_target_inner',slide).actual('outerHeight')), 
                            dataTime = $(this).attr('data-time')!='undefined' ? parseFloat($(this).attr('data-time')) : 0,
                            thisDelay = $(this).attr('data-delay')!='undefined' ? parseFloat($(this).attr('data-delay')) : 0,
                            thisEaseIn = $(this).attr('data-easein')!='undefined' ? $(this).attr('data-easein') : 'linear',
                            thisFxIn = $(this).attr('data-fxin')!='undefined' ? $(this).attr('data-fxin') : '',
                            thisFadeIn = ($(this).attr('data-fadein')!='undefined' && $(this).attr('data-fadein')!='false') ? $(this).attr('data-fadein') : '0',
                            thisCss,
                            thisAnim;

                        eval('var css = {' + $(this).attr('data-style') + '}');
        
                        $(this).show().css(css);
                        
                        var leftPercent = ((parseFloat($(this).css('left'))/slideStartW)*100),
                            topPercent = ((parseFloat($(this).css('top'))/slideStartH)*100);

                        //console.log(topPercent);
                            
                        pixSlideshowInnerPos();
                                                    
                        switch ( thisFxIn ) {
                            case 'fromtop' :
                                thisCss = "top: '-'+(((parseFloat(gapH+objH)/slideH)*100)+10)+'%', left: leftPercent+'%', ";
                                thisAnim = "top: topPercent+'%', opacity:1";
                                break;
                            case 'fromright' :
                                thisCss = "left: (((parseFloat(gapW)/slideW)*100)+110)+'%', top: topPercent+'%', ";
                                thisAnim = "left: leftPercent+'%', opacity:1";
                                break;
                            case 'frombottom' :
                                thisCss = "top: (((parseFloat(gapH)/slideH)*100)+110)+'%', left: leftPercent+'%', ";
                                thisAnim = "top: topPercent+'%', opacity:1";
                                break;
                            case 'fromleft' :
                                thisCss = "left: '-'+(((parseFloat(gapW+objW)/slideW)*100)+10)+'%', top: topPercent+'%', ";
                                thisAnim = "left: leftPercent+'%', opacity:1";
                                break;
                            default :
                                thisCss = "left: leftPercent+'%', top: topPercent+'%', ";
                                thisAnim = "opacity:1";
                                break;
                        }
                                            
                        eval('thisCss = {' + thisCss + 'visibility:"visible"}');
                        eval('thisAnim = {' + thisAnim + '}');

                            $(this).css(thisCss);

                            if ( thisFadeIn != '0' ) {
                                $(this).animate({opacity:0},0);
                            } else {
                                $(this).animate({opacity:1},0);
                            }
                            
                            $('.imgFake',this).show();

                            $(this).removeClass('pix_animated').stop(true,true).delay((thisDelay)).animate(thisAnim, dataTime, thisEaseIn, function(){
                                if ( jQuery(this).attr('data-autoplay') == 'true' ) {
                                    jQuery('.imgFake',this).click();
                                }
                            });
                            $('.filmore_rotate_wrap',this).animate({ rotate: '0' },0);
                            if ($(this).attr('data-rotatein')!='undefined' && $(this).attr('data-rotatein')!='false') {
                                if ( !$('.filmore_rotate_wrap',this).length ) {
                                    $(this).wrapInner('<div class="filmore_rotate_wrap" />');
                                    $('.filmore_rotate_wrap',this).animate({ rotate: '180deg' },0);
                                }
                                $('.filmore_rotate_wrap',this).delay((thisDelay)).animate({ rotate: '360deg' }, dataTime, thisEaseIn);
                            }
                            
                    });
                }
            }
    
            if ( opts.fullscreen == true ) {
                if ( $('header').attr('data-referer')!='' ) {
                    if ( leng==0 && !alreadyStarted ) {
                        delaySlide();
                    }
                } else {
                    if ( jQuery('nav').hasClass('menu_loaded') && leng==0 && !alreadyStarted ) {
                        delaySlide();
                    } else {
                        $('body').bind('menu_loaded',function(){
                            if ( leng==0 ) {
                                delaySlide();
                            }
                        });
                    }
                }
            } else {
                if ( leng==0 && !alreadyStarted ) {
                    delaySlide();
                }
            }

            if ( leng==0 && alreadyStarted ) {
                delaySlide();
            }
            
            /*current
            .find('div[data-use="background"]').each(function(){
                $(this).css({
                    left: '0%',
                    backgroundPositionX : minusSign+'20%'
                });
                $(this).delay(300).animate({
                    left: minusSign+'20%',
                    backgroundPositionX : '50%'
                },opts.transPeriod,opts.easing);
            });*/
            
            
            current.find('div[data-use="simple"], div[data-use="video"], div[data-use="caption"], div[data-use="html"]').each(function(){
                
                var objW = $(this).outerWidth(),
                    objH = $(this).outerHeight(),
                    gapW = parseFloat($('.pix_slideshow_target_inner',current).offset().left),
                    gapH = (opts.fullscreen == true) ? parseFloat($('.pix_slideshow_target_inner',current).offset().top) : 0, 
                    slideW = parseFloat($('.pix_slideshow_target_inner',current).actual('outerWidth')),
                    slideH = parseFloat($('.pix_slideshow_target_inner',current).actual('outerHeight')), 
                    dataTime = $(this).attr('data-time')!='undefined' ? parseFloat($(this).attr('data-time')) : 0,
                    thisDelay = $(this).attr('data-delay')!='undefined' ? parseFloat($(this).attr('data-delay')) : 0,
                    thisEaseOut = $(this).attr('data-easeout')!='undefined' ? $(this).attr('data-easeout') : 'linear',
                    thisFxOut = $(this).attr('data-fxout')!='undefined' ? $(this).attr('data-fxout') : '',
                    thisFadeOut = ($(this).attr('data-fadeout')!='undefined' && $(this).attr('data-fadeout')!='false') ? '0' : '1',
                    thisAnim;
                
                switch ( thisFxOut ) {
                    case 'totop' :
                        thisAnim = "top: '-'+(((parseFloat(gapH+objH)/slideH)*100)+10)+'%', opacity: thisFadeOut";
                        break
                    case 'toright' :
                            thisAnim = "left: (((parseFloat(gapW)/slideW)*100)+110)+'%', opacity: thisFadeOut";
                        break
                    case 'tobottom' :
                        thisAnim = "top: (((parseFloat(gapH)/slideH)*100)+110)+'%', opacity: thisFadeOut";
                        break
                    case 'toleft' :
                            thisAnim = "left: '-'+(((parseFloat(gapW+objW)/slideW)*100)+10)+'%', opacity: thisFadeOut";
                        break
                    default : 
                        thisAnim = "opacity: thisFadeOut";
                }

                eval('thisAnim = {' + thisAnim + '}');
                
                var index = $(this).index();
                
                if ($(this).attr('data-rotateout')!='undefined' && $(this).attr('data-rotateout')!='false') {
                    $('.filmore_rotate_wrap',this).animate({ rotate: '0' },0);
                    if ( !$('.filmore_rotate_wrap',this).length ) {
                        $(this).wrapInner('<div class="filmore_rotate_wrap" />');
                    }
                    $('.filmore_rotate_wrap',this).stop(true,false).delay(thisDelay).animate({ rotate: '180deg' },dataTime,thisEaseOut);
                }

                $(this).stop(true,false).delay(thisDelay).animate(thisAnim,dataTime,thisEaseOut,function(){
                    $(this).addClass('pix_animated').hide();
                    leng = current.find('div[data-use="simple"], div[data-use="video"], div[data-use="caption"], div[data-use="html"]').length;
                    animated = current.find('div.pix_animated').length;
                    if ( leng == animated ) {
                        delaySlide();
                    }
                });
                
            });
                

        } else {
            var slideTryAgain = setTimeout(function(){
                    nextSlide(slideI);
                },100);
        }



    }
    
    
    if ( opts.prev.length ) {
        opts.prev.bind('click',function(){
            if ( !target.hasClass('filmoresliding') ) {
                var vis = parseFloat($('div.filmoreSlide.filmoreCurrent',target).index());
                checkIframe(vis-1, 'prev');
            }
            return false;
        });
    }

    if ( opts.next.length ) {
        opts.next.bind('click',function(){
            if ( !target.hasClass('filmoresliding') ) {
                var vis = parseFloat($('div.filmoreSlide.filmoreCurrent',target).index());
                checkIframe(vis+1);
                }
            return false;
        });
    }
    
    target.on('swipeleft', function(e) {
        if ( !target.hasClass('filmoresliding') ) {
                var vis = parseFloat($('div.filmoreSlide.filmoreCurrent',target).index());
            checkIframe(vis+1);
        }
    })

    target.on('swiperight', function(e) {
        if ( !target.hasClass('filmoresliding') ) {
                var vis = parseFloat($('div.filmoreSlide.filmoreCurrent',target).index());
            checkIframe(vis-1,'prev');
        }
    })

    if ( opts.pause.length ) {
        opts.pause.bind('click',function(){
            target.addClass('filmore_stopped');
            $(this).fadeOut(50,function(){
                opts.play.fadeIn(50);
            });
            return false;
        });
    }
    
    if ( opts.play.length ) {
        opts.play.bind('click',function(){
            target.removeClass('filmore_stopped');
            $(this).fadeOut(50,function(){
                opts.pause.fadeIn(50);
            });
            return false;
        });
    }
    
    $('.filmore_pag',opts.pagination).on('click',function(){
        if ( !target.hasClass('filmoresliding') ) {
            var vis = parseFloat($('div.filmoreSlide.filmoreCurrent',target).index('.filmoreSlide')),
                thiS = parseFloat($(this).attr('data-pag'));
            if ( vis < thiS ) {
                var direction = 'next';
            } else {
                var direction = 'prev';
            }
            if (  vis != thiS ) { 
                checkIframe(thiS, direction);
            }
        }
        return false;
    });
    
    
    
    function filmoreTimer(slide) {
                            var radSum = 0.01;
                            clearInterval(intval);
                            intval = setInterval(
                                function(){
                                        radNew = rad;
                                        if (!(jQuery.browser.msie && jQuery.browser.version < 9)) {
                                            ctx.clearRect(0,0,opts.pieDiameter,opts.pieDiameter);
                                            ctx.globalCompositeOperation = 'destination-over';
                                            ctx.beginPath();
                                            ctx.arc((opts.pieDiameter)/2, (opts.pieDiameter)/2, (opts.pieDiameter)/2-opts.loaderStroke,0,Math.PI*2,false);
                                            ctx.lineWidth = opts.loaderStroke;
                                            ctx.strokeStyle = opts.loaderBgColor;
                                            ctx.stroke();
                                            ctx.closePath();
                                            ctx.globalCompositeOperation = 'source-over';
                                            ctx.beginPath();
                                            ctx.arc((opts.pieDiameter)/2, (opts.pieDiameter)/2, (opts.pieDiameter)/2-opts.loaderStroke,0,Math.PI*2*radNew,false);
                                            ctx.lineWidth = opts.loaderStroke-(opts.loaderPadding*2);
                                            ctx.strokeStyle = opts.loaderColor;
                                            ctx.stroke();
                                            ctx.closePath();
                                        }
                                        opts.loader.fadeIn(200);
                                                        
                                    if(rad<=1.002 && !target.hasClass('filmore_stopped') && !target.hasClass('filmore_freezed') && !target.hasClass('filmore_hovered')){
                                        rad = (rad+radSum);
                                    } else if (rad<=1.002 && (target.hasClass('filmore_stopped') || target.hasClass('filmore_hovered'))){
                                        rad = rad;
                                    } else {
                                        if(!target.hasClass('filmore_stopped') && !target.hasClass('filmore_freezed') && !target.hasClass('filmore_hovered')) {
                                            checkIframe(slide);
                                        }
                                    }
                                },opts.time*radSum
                            );
    }
    
    
    function pixSlideshowInnerPos() {
        //if ( opts.fullscreen == true ) {
            $('.pix_slideshow_target_inner',target).each(function(){
                var t = $(this),
                    w,
                    h,
                    margin,
                    parentw,
                    dataW = parseFloat(target.attr('data-width')),
                    dataH = parseFloat(target.attr('data-height')),
                    winH;
                w = t.actual('outerWidth');
                h = (w/dataW)*dataH;
                winH = parseFloat(target.height());
                margin = (winH-h)*0.5 > 0 ? (winH-h)*0.5 : 0;
                t.css({
                    marginTop: margin,
                    height: h
                });
            });

            var setUntiUnder;

            clearTimeout(setUntiUnder);

            setUntiUnder = setTimeout(function(){

                var until = target.data('until');
                if ( typeof until != 'undefined' && until != '' ) {
                    if ( $(window).width() >= until ) {
                        target.removeClass('filmore_freezed');
                    } else {
                        target.addClass('filmore_freezed');
                    }
                }

                var under = target.data('under');
                if ( typeof under != 'undefined' && under!='' ) {
                    if ( $(window).width() < under ) {
                       target.removeClass('filmore_freezed');
                    } else {
                        target.addClass('filmore_freezed');
                    }
                }

            }, 10);
        //}
        
        $('.filmore_caption, .filmore_caption *, [data-fontsize], [data-fontsize] *',target).each(function(){
            var t = $(this),
                captionFontSize = parseFloat(t.attr('data-fontsize')),
                captionLineHeight = parseFloat(t.attr('data-lineheight')),
                margin = parseFloat(t.css('margin')),
                padding = parseFloat(t.css('padding')),
                fontSizeCheck = (slideW/forte_content_width)*captionFontSize,
                lineHeightCheck = (slideH/slideStartH)*captionLineHeight,
                fontSize = fontSizeCheck < captionFontSize ? fontSizeCheck : captionFontSize,
                lineHeight = lineHeightCheck < captionLineHeight ? lineHeightCheck : captionLineHeight;

                slideW = $('.pix_slideshow_target_inner',target).actual('outerWidth');
                slideH = $('.pix_slideshow_target_inner',target).actual('outerHeight');

                t.css({
                    fontSize : fontSize+'px',
                    lineHeight : lineHeight+'px'
                });
        });
        
        $('div[data-use="simple"] img',target).each(function(){
            var t = $(this),
                imgW = t.naturalWidth();

                slideW = $('.pix_slideshow_target_inner',target).actual('outerWidth');
                slideH = $('.pix_slideshow_target_inner',target).actual('outerHeight');

                t.css({
                    width : imgW*(slideW/slideStartW)
                });
        });

    }

    $(window).bind('load resize',function(){
        //if ( opts.fullscreen == true ) {
            var set;
            clearTimeout(set);
            set = setTimeout(function(){
                pixSlideshowInnerPos();
            },200);
        //}
    });
    
    jQuery('header .pix_column_990').bind('resize',function(){
        pixSlideshowInnerPos();
    });
    
}})(jQuery);


/********************************
*
*   Canvas loader
*
********************************/
function canvasLoader() {
    jQuery('.pix_canvasloader-container').each(function(){
        var ind = jQuery(this).parents('.pix_slideshow').eq(0).index('body .pix_slideshow');
        jQuery(this).attr('id','canvasloader-container_'+ind);
        var cl = new CanvasLoader('canvasloader-container_'+ind);
        cl.setColor(pix_canvas_color); // default is '#000000'
        cl.setDiameter(26); // default is 40
        cl.setDensity(160); // default is 40
        cl.setRange(0.5); // default is 1.3
        cl.setSpeed(8); // default is 2
        cl.setFPS(30); // default is 24
        cl.show(); // Hidden by default
    
        var loaderObj = jQuery('> div',this).get(0);
    
        loaderObj.style.position = "absolute";
    
        loaderObj.style["top"] = cl.getDiameter() * -0.5 + "px";
    
        loaderObj.style["left"] = cl.getDiameter() * -0.5 + "px";
    });

    jQuery('#pix_loader > span').each(function(){
        var ind = jQuery(this).index();
        jQuery(this).attr('id','canvasloader-footer_'+ind);
        var cl = new CanvasLoader('canvasloader-footer_'+ind);
        cl.setColor('#5b5b5b'); // default is '#000000'
        cl.setDiameter(26); // default is 40
        cl.setDensity(160); // default is 40
        cl.setRange(0.5); // default is 1.3
        cl.setSpeed(8); // default is 2
        cl.setFPS(30); // default is 24
        cl.show(); // Hidden by default
    
        var loaderObj = jQuery('> div',this).get(0);
    
        loaderObj.style.position = "absolute";
    
        loaderObj.style["top"] = cl.getDiameter() * -0.5 + "px";
    
        loaderObj.style["left"] = cl.getDiameter() * -0.5 + "px";
    });
}


/********************************
*
*   Remove img attributes
*
********************************/
function removeImgAtts() {
    jQuery('img').removeAttr('width').removeAttr('height');
}
        
/******************************************************
*
*   Smoothscroll
*
******************************************************/
function smoothScroll() {
    jQuery('a.pix_scroll[href*="#"], .pix_scroll a[href*="#"]').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
        && location.hostname == this.hostname) {
            var target = jQuery(this.hash);
            target = target.length && target
            || jQuery('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                var targetOffset = target.offset().top;
                jQuery('body')
                .animate({scrollTop: targetOffset}, 1000);
                jQuery('html')
                .animate({scrollTop: targetOffset}, 1000);
                return false;
            }
        }
    });
}

/********************************
*
*   Sliding sidebars
*
********************************/
function slidingSidebars() {
    jQuery('.click_aside_left [data-sidebar], .close_aside_left').click(function(){
        var t = jQuery(this);
        if ( jQuery(this).attr('data-sidebar') ) {
            var dataSidebar = jQuery(this).attr('data-sidebar');
            jQuery('.aside_content > div#'+dataSidebar).show();
        }
        jQuery(this).addClass('clicked');
        jQuery('.click_aside_left, .close_aside_left').toggleClass('clicked');
        jQuery('aside.alignleft').toggleClass('visible');

        if ( jQuery('.close_aside_right.clicked').length ) {
            jQuery('.click_aside_right, .close_aside_right').toggleClass('clicked');
            jQuery('aside.alignright').toggleClass('visible');
        }

        jQuery('body').trigger('pix_show_sidebars');

        jQuery("aside.alignleft").bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
            //jQuery(window).scroll();
            if ( !jQuery('.click_aside_left').hasClass('clicked' )) {
                jQuery('aside.alignleft .aside_content > div').hide();
                jQuery('.click_aside_left [data-sidebar]').removeClass('clicked');
            }
        });
        return false;
    });

    jQuery('.click_aside_right [data-sidebar], .close_aside_right').click(function(){
        var t = jQuery(this);
        if ( jQuery(this).attr('data-sidebar') ) {
            var dataSidebar = jQuery(this).attr('data-sidebar');
            jQuery('.aside_content > div#'+dataSidebar).show();
        }
        jQuery(this).addClass('clicked');
        jQuery('.click_aside_right, .close_aside_right').toggleClass('clicked');
        jQuery('aside.alignright').toggleClass('visible');

        if ( jQuery('.close_aside_left.clicked').length ) {
            jQuery('.click_aside_left, .close_aside_left').toggleClass('clicked');
            jQuery('aside.alignleft').toggleClass('visible');
        }

        jQuery('body').trigger('pix_show_sidebars');

        jQuery("aside.alignright").bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
            //jQuery(window).scroll();
            if ( !jQuery('.click_aside_right').hasClass('clicked' )) {
                jQuery('aside.alignright .aside_content > div').hide();
                jQuery('.click_aside_right [data-sidebar]').removeClass('clicked');
            }
        });
        return false;
    });
}


function closeSlidingSidebars() {
    jQuery('.pix_success_open_toggle').each(function(){
        var getID = jQuery(this).parents('.toggle_aside_by_id').attr('id');
        jQuery('div[data-sidebar="'+getID+'"]').click();
    });
}


/********************************
*
*   Shortcodes in pre
*
********************************/
function preShortcodes() {
    jQuery('pre').each(function(){
        var txt = jQuery(this).text();
        txt = txt.replace(/\[ (.*?) \](.*?)\[ (.*?) \]/g,'[$1]$2[$3]');
        jQuery(this).text(txt);
    });
}




/********************************
*
*   Scroll buttons
*
********************************/
function scrollButtons() {
    jQuery(document).off('click','.click_scroll_down');
    jQuery(document).on('click','.click_scroll_down',function(){
        var winH = parseFloat( jQuery(window).height() ),
            headerH = parseFloat( jQuery('header').outerHeight() ),
            value = -60;
        jQuery('html,body').animate({
            scrollTop : (winH- ( headerH + (value) ) )
        },1000,'easeInOutExpo');
    });

    jQuery(document).off('click','.click_scroll_up');
    jQuery(document).on('click','.click_scroll_up',function(){
        jQuery('html,body').animate({
            scrollTop : 0
        },1000,'easeInOutExpo');
    });
}


function displayScrollButtons() {
    var fromTop,
        headerH;

            
    if (!isMobile()){
        var setUp;
        clearTimeout(setUp);
        setUp = setTimeout(function(){
            fromTop = ( parseFloat(jQuery('html').scrollTop()) + parseFloat(jQuery('body').scrollTop() ) );
            headerH = parseFloat( jQuery('header').outerHeight() );
            if ( fromTop > headerH ) {
                jQuery('.click_scroll_up').not(':visible').fadeIn();
            } else {
                jQuery('.click_scroll_up:visible').fadeOut();
            }
        },1000);
    }

    if ( jQuery('.firstSlideShow.pix_fullheight').length ) {
        var setDown;          
        if (isMobile()){
            jQuery('.click_scroll_down').css({position:'absolute'}).show();
        } else {
            clearTimeout(setDown);
            setDown = setTimeout(function(){
                fromTop = ( parseFloat(jQuery('html').scrollTop()) + parseFloat(jQuery('body').scrollTop() ) );
                headerH = parseFloat( jQuery('header').outerHeight() );
                if ( fromTop > 40 ) {
                    jQuery('.click_scroll_down:visible').fadeOut();
                } else {
                    jQuery('.click_scroll_down').not(':visible').fadeIn();
                }
            },1000);
        }
    }   

}

/********************************
*
*   Slideshow
*
********************************/
function initPixSlideshows() {
    /*jQuery('.pix_slideshow_target:visible').removeClass('filmore_freezed');
    jQuery('.pix_slideshow_target').not(':visible').addClass('filmore_freezed');*/
    jQuery('.pix_slideshow').not('.already_init').each(function(){
        if ( jQuery('.pix_slideshow_target',this).is(':visible')) {
            var t = jQuery('.pix_slideshow_target',this),
                prev = jQuery('.filmore_prev',this),
                next = jQuery('.filmore_next',this),
                pause = jQuery('.filmore_pause',this),
                play = jQuery('.filmore_play',this),
                pagination = jQuery('.filmore_pagination',this),
                loader = jQuery('.filmore_loader',this),
                time = parseFloat(t.attr('data-time')),
                transperiod = parseFloat(t.attr('data-transperiod')),
                autoadv = t.attr('data-autoadvance')=='true' ? true : false,
                hover = t.attr('data-hover')=='true' ? true : false;
                            
            if ( jQuery(this).hasClass('gallery') || jQuery(this).parents('.pix_column').eq(0).hasClass('gallery-post-format') ) {
                jQuery(this).addClass('already_init');
                t.filmore({
                    prev : prev,
                    next : next,
                    loader : loader,
                    autoadv: false,
                    hover : false
                });
            } else if ( jQuery(this).parents('section').eq(0).hasClass('pix_fullheight') ) {
                jQuery(this).addClass('already_init');
                t.filmore({
                    time: time,
                    transPeriod: transperiod,
                    prev : prev,
                    next : next,
                    pause : pause,
                    play : play,
                    pagination : pagination,
                    loader : loader,
                    autoadv: autoadv,
                    hover : hover,
                    fullscreen : true
                });
            } else {
                jQuery(this).addClass('already_init');
                t.filmore({
                    time: time,
                    transPeriod: transperiod,
                    prev : prev,
                    next : next,
                    pause : pause,
                    play : play,
                    pagination : pagination,
                    loader : loader,
                    autoadv: autoadv,
                    hover : hover
                });
            }
        }  
    });
}

/********************************
*
*   Dropdown menu
*
********************************/
function dropDownMenu() {
    jQuery('nav > div > ul > li').has('ul').find('> a').each(function(){
        jQuery(this).wrapInner('<span class="plus_ul" />');
        jQuery(this).append('<span class="totop_arrow" />');
    });
    jQuery('nav > div > ul > li ul.children').each(function(){
        jQuery(this).wrapInner('<span />');
    });
    jQuery('nav > div > ul > li li ul').each(function(){
        jQuery(this).parent().find('> a').wrapInner('<span class="plus_ul" />');
        jQuery(this).append('<span class="toleft_arrow"><span></span></span>').append('<span class="toright_arrow"><span></span></span>');
    });
    jQuery('nav > div > ul > li > a > .plus_ul').append('<i class="icon-plus" />');
    jQuery('nav > div > ul > li > ul .plus_ul').prepend('<i class="icon-plus" />');
    jQuery('nav > div > ul li a').bind('mouseenter',function(){
        jQuery(this).addClass('pix_hover');
    });
    jQuery('nav > div > ul li').not(':has(ul)').bind('mouseleave',function(){
        jQuery('> a ',this).removeClass('pix_hover');
    });
    if (isMobile()) {
        jQuery('nav > div > ul.menu > li > div').append('<span class="close_x"><i class="icon-remove"></i></span>');
        jQuery('nav > div > ul.menu > li').not('.pix_megamenu').find('ul').append('<span class="close_x"><i class="icon-remove"></i></span>');
    }
    var setInShadow,
        setOutShadow;
        
    jQuery('nav > div > ul > li:has(>ul)').each(function(){
        var setIn,
            setOut,
            setVal,
            off,
            off2,
            ulW,
            winW,
            ulH,
            pass = 0,
            t = jQuery(this);
            ulH = parseFloat(jQuery('> ul',t).css('height'));
            jQuery('> ul',t).animate({opacity:0},1);
            jQuery('.totop_arrow',t).css({height:0}).animate({opacity:0},1);
        jQuery('> ul',t).css({height:0});
        if (isMobile()) {
            jQuery('> a',t).bind('click',function(){
                if(!jQuery(this).hasClass('mob_open')){
                    jQuery(this).addClass('mob_open');
                    off = jQuery('> ul',t).offset();
                    off2 = jQuery('nav').offset();
                    winW = jQuery(window).width();
                    setVal = 200;
                    /*if(off.left<0){
                        jQuery('> ul',t).css({marginRight:'-'+(Math.abs(off.left)+40)+'px'});
                    }*/
                    jQuery('.totop_arrow',t).show();
                    jQuery('> ul',t).css({top:0,left:'auto',right:0});
                    jQuery('.totop_arrow',t).stop(true,false).animate({height:'5px',opacity:1},100,'easeOutQuart');
                    jQuery('> ul',t).stop(true,true).animate({height:ulH,opacity:1},220,'easeOutQuart');
                    return false;
                }
            });
            jQuery('.close_x',t).bind('click',function(){
                jQuery('> a',t).removeClass('mob_open');
                jQuery('> ul',t).stop(true,false).animate({height:0,opacity:0},150,'easeInQuart',function(){
                    jQuery(this).css({top:'-9999px',left:'-9999px',right:'auto'});
                    jQuery('> a',t).removeClass('pix_hover');
                });
                jQuery('.totop_arrow',t).stop(true,false).animate({height:0,opacity:0},100,'easeInQuart',function(){
                    jQuery(this).hide();
                });
            });
        } else {
            jQuery('> a, > ul',t).bind('mouseenter',function(){
                if (!(jQuery.browser.msie && jQuery.browser.version < 9)) {
                    jQuery('nav ul ul, nav ul div').css({zIndex:10});
                    jQuery(' > ul',t).css({zIndex:11});
                }
                clearTimeout(setIn);
                off = jQuery('> ul',t).offset();
                off2 = jQuery('nav').offset();
                winW = jQuery(window).width();
                setVal = 200;
                setOut = setTimeout(function(){
                    /*if(off.left<0){
                        jQuery('> ul',t).css({marginRight:'-'+(Math.abs(off.left)+40)+'px'});
                    }*/
                    jQuery('.totop_arrow',t).show();
                    jQuery('> ul',t).css({top:0,left:'auto',right:0});
                    jQuery('.totop_arrow',t).stop(true,false).animate({height:'5px',opacity:1},100,'easeOutQuart');
                    jQuery('> ul',t).stop(true,true).animate({height:ulH,opacity:1},220,'easeOutQuart',function(){
                        setVal = 200;
                    });
                },150);

            });
            t.bind('mouseleave',function(){
                clearTimeout(setOut);
                if(setVal==0){
                    jQuery('> a',t).removeClass('pix_hover');
                }
                setIn = setTimeout(function(){
                    jQuery('> ul',t).stop(true,false).animate({height:0,opacity:0},100,'easeInQuart',function(){
                        jQuery(this).css({top:'-9999px',left:'-9999px',right:'auto'});
                        jQuery('> a',t).removeClass('pix_hover');
                    });
                    jQuery('.totop_arrow',t).stop(true,false).animate({height:0,opacity:0},60,'easeInQuart',function(){
                        jQuery(this).hide();
                    });
                },setVal);
            });
        }
    });

    jQuery('nav div ul.menu li li:has(>ul)').each(function(){
        var setIn,
            setOut,
            setVal,
            off,
            off2,
            ulW,
            t = jQuery(this);
        //jQuery('> ul',t).css({width:0});
        //if (t.has('>ul')) {
            if (isMobile()) {
                jQuery('> a',t).bind('click',function(){
                    if(!jQuery(this).hasClass('mob_open')){
                        jQuery(this).addClass('mob_open');
                        var ulW = jQuery('> ul',t).outerWidth(),
                        winW = jQuery(window).width();
                        liulW = jQuery('> ul',t).css('width');
                        jQuery('> ul',t).animate({opacity:0},1);
                        jQuery('.toleft_arrow, .toright_arrow',t).animate({opacity:0},1);
                        off2 = jQuery('nav').offset();
                        jQuery('> ul',t).addClass('pix_open');
                        jQuery('> ul',t).css({left:'-'+ulW+'px',right:'auto'});
                        var off = jQuery('> ul',t).offset();
                        if((off.left)<0){
                            jQuery('> ul',t).css({right:'-'+ulW+'px',left:'auto'});
                            var arrow = jQuery('.toleft_arrow',t);
                        } else {
                            jQuery('> ul',t).css({left:'-'+ulW+'px',right:'auto'});
                            var arrow = jQuery('.toright_arrow',t);
                        }
                        arrow.show();
                        jQuery('> ul',t).css({top:0});
                        jQuery('> ul',t).stop(true,false).animate({opacity:1},120,'easeOutQuart');
                        arrow.stop(true,false).animate({opacity:1},100,'easeOutQuart');
                        return false;
                    }
                });
                jQuery('.close_x',t).bind('click',function(){
                    jQuery('> a',t).removeClass('mob_open');
                    jQuery('> ul',t).stop(true,false).animate({opacity:0},150,'easeInQuart',function(){
                        jQuery(this).css({top:'-9999px'}).removeClass('pix_open');
                        jQuery('> a',t).removeClass('pix_hover');
                    });
                    jQuery('.toleft_arrow, .toright_arrow',t).stop(true,false).animate({opacity:0},150,'easeInQuart',function(){
                        jQuery(this).hide();
                    });
                });
            } else {
                jQuery(this).bind('mouseenter',function(){
                    clearTimeout(setIn);
                    if(!jQuery('> ul',t).hasClass('pix_open')){
                        var ulW = jQuery('> ul',t).outerWidth(),
                        winW = jQuery(window).width();
                        liulW = jQuery('> ul',t).css('width');
                        jQuery('> ul',t).animate({opacity:0},1);
                        jQuery('.toleft_arrow, .toright_arrow',t).animate({opacity:0},1);
                        off2 = jQuery('nav').offset();
                        setVal = 0;
                        setOut = setTimeout(function(){
                            jQuery('> ul',t).addClass('pix_open');
                            jQuery('> ul',t).css({left:'-'+ulW+'px',right:'auto'});
                            var off = jQuery('> ul',t).offset();
                            if((off.left)<0){
                                jQuery('> ul',t).css({right:'-'+ulW+'px',left:'auto'});
                                var arrow = jQuery('.toleft_arrow',t);
                            } else {
                                jQuery('> ul',t).css({left:'-'+ulW+'px',right:'auto'});
                                var arrow = jQuery('.toright_arrow',t);
                            }
                            arrow.show();
                            jQuery('> ul',t).css({top:0});
                            jQuery('> ul',t).stop(true,false).animate({opacity:1},120,'easeOutQuart',function(){
                                setVal = 200;
                            });
                            arrow.stop(true,false).animate({opacity:1},100,'easeOutQuart');
                        },150);
                    }
                });
                t.bind('mouseleave',function(){
                    t = jQuery(this);
                    clearTimeout(setOut);
                    if(setVal==0){
                        jQuery('> a',t).removeClass('pix_hover');
                    }
                    setIn = setTimeout(function(){
                        jQuery('> ul',t).stop(true,false).animate({opacity:0},100,'easeInQuart',function(){
                            jQuery(this).css({top:'-9999px'}).removeClass('pix_open');
                            jQuery('> a',t).removeClass('pix_hover');
                        });
                        jQuery('.toleft_arrow, .toright_arrow',t).stop(true,false).animate({opacity:0},60,'easeInQuart',function(){
                            jQuery(this).hide();
                        });
                    },setVal);
                });
            }
        //}
    });

    jQuery('nav > div > ul > li:has(>div)').each(function(){
        var setIn,
            setOut,
            setVal,
            off,
            off2,
            ulW,
            winW,
            ulH,
            t = jQuery(this);
            jQuery('.totop_arrow',t).css({height:0}).animate({opacity:0},1);
        if (isMobile()) {
            jQuery('> a',t).bind('click',function(){
                if (!jQuery('> a',t).hasClass('mob_open')){
                    jQuery('> a',t).addClass('mob_open');
                    Array.max = function( array ){
                        return Math.max.apply( Math, array );
                    };
                    var amountArr = new Array();
                    jQuery('> div > div',t).each( function() { 
                        var amountUl = jQuery('ul',this).length,
                            countUl = 0,
                            sumUl = 0;
                        while(countUl < amountUl) {
                            sumUl = sumUl + jQuery('ul',this).eq(countUl).width();
                            if(countUl == (amountUl-1)) {
                                amountArr.push(sumUl);
                            }
                            countUl++;
                        }
                    });
                    jQuery('> div',t).css({width:(Array.max(amountArr))});
                    ulH = parseFloat(jQuery('> div',t).css('height'));
                    jQuery('> div',t).css({height:0});
                    jQuery('> div',t).animate({opacity:0},1);
                    jQuery('.totop_arrow',t).css({height:0}).animate({opacity:0},1);
            
                    if (!(jQuery.browser.msie && jQuery.browser.version < 9)) {
                        jQuery('nav ul ul, nav ul div').css({zIndex:10});
                        jQuery(' > div',t).css({zIndex:11});
                    }
                    jQuery('> div',t).css({left:'auto',right:0});
                    off = jQuery('> div',t).offset();
                    off2 = jQuery('nav').offset();
                    winW = jQuery(window).width();
                    setVal = 0;
                    if(off.left<0){
                        jQuery('> div',t).css({marginRight:'-'+(Math.abs(off.left)+40)+'px'});
                    }
                    jQuery('.totop_arrow',t).show();
                    jQuery('> div',t).css({top:0});
                    jQuery('> div',t).stop(true,true).animate({height:ulH,opacity:1},220,'easeOutQuart');
                    jQuery('.totop_arrow',t).stop(true,true).animate({height:'5px',opacity:1},100,'easeOutQuart');
                    return false;
                }
            });
            jQuery('.close_x',t).bind('click',function(){
                jQuery('> a',t).removeClass('mob_open');
                jQuery('> div',t).stop(true,false).animate({height:0,opacity:0},150,'easeInQuart',function(){
                    jQuery(this).css({top:'-9999px',left:'-9999px',height:'auto',right:'auto'});
                    jQuery('> a',t).removeClass('pix_hover');
                    jQuery('> div',t).removeClass('pix_open');
                });
                jQuery('.totop_arrow',t).stop(true,false).animate({height:0,opacity:0},100,'easeInQuart',function(){
                    jQuery(this).hide();
                });
            });
        } else {
            t.bind('mouseenter',function(){
                clearTimeout(setIn);
                if (!jQuery('> div',t).hasClass('pix_open')){
                    jQuery('> div',t).addClass('pix_open');
                    Array.max = function( array ){
                        return Math.max.apply( Math, array );
                    };
                    var amountArr = new Array();
                    jQuery('> div > div',t).each( function() { 
                        var amountUl = jQuery('ul',this).length,
                            countUl = 0,
                            sumUl = 0;
                        while(countUl < amountUl) {
                            sumUl = sumUl + jQuery('ul',this).eq(countUl).width();
                            if(countUl == (amountUl-1)) {
                                amountArr.push(sumUl);
                            }
                            countUl++;
                        }
                    });
                    jQuery('> div',t).css({width:(Array.max(amountArr))});
                    ulH = parseFloat(jQuery('> div',t).css('height'));
                    jQuery('> div',t).css({height:0});
                    jQuery('> div',t).animate({opacity:0},1);
                    jQuery('.totop_arrow',t).css({height:0}).animate({opacity:0},1);
            
                    if (!(jQuery.browser.msie && jQuery.browser.version < 9)) {
                        jQuery('nav ul ul, nav ul div').css({zIndex:10});
                        jQuery(' > div',t).css({zIndex:11});
                    }
                    jQuery('> div',t).css({left:'auto',right:0});
                    off = jQuery('> div',t).offset();
                    off2 = jQuery('nav').offset();
                    winW = jQuery(window).width();
                    setVal = 0;
                    setOut = setTimeout(function(){
                        if(off.left<0){
                            jQuery('> div',t).css({marginRight:'-'+(Math.abs(off.left)+40)+'px'});
                        }
                        jQuery('.totop_arrow',t).show();
                        jQuery('> div',t).css({top:0});
                        jQuery('> div',t).stop(true,true).animate({height:ulH,opacity:1},120,'easeOutQuart',function(){
                            setVal = 200;
                        });
                        jQuery('.totop_arrow',t).stop(true,true).animate({height:'5px',opacity:1},100,'easeOutQuart');
                    },100);
                }
            });
            t.bind('mouseleave',function(){
                clearTimeout(setOut);
                if(setVal==0){
                    jQuery('> a',t).removeClass('pix_hover');
                }
                setIn = setTimeout(function(){
                    jQuery('> div',t).stop(true,false).animate({height:0,opacity:0},100,'easeInQuart',function(){
                        jQuery(this).css({top:'-9999px',left:'-9999px',right:'auto',height:'auto'});
                        jQuery('> a',t).removeClass('pix_hover');
                        jQuery('> div',t).removeClass('pix_open');
                    });
                    jQuery('.totop_arrow',t).stop(true,false).animate({height:0,opacity:0},60,'easeInQuart',function(){
                        jQuery(this).hide();
                    });
                },setVal);
            });
        }
    });
}


/********************************
*
*   Select
*
********************************/
function fakeSelect(){
    jQuery('#pix_select_menu option.current-menu-item').prop('selected',true);
    if(!jQuery('body').hasClass('donot_smooth_ds')){
        if (!(jQuery.browser.msie)) {
            jQuery('select').not('.letmebe, [class^="country"], [class^="state"], [name="billing_state"], .chzn-done').each(function(){
                if(!jQuery(this).prop('multiple')){
                    var s = jQuery(this),
                        v = jQuery('option:selected',s).val(),
                        tx = jQuery('option:selected',s).text(),
                        outW,
                        fake,
                        set;
                    s.animate({opacity:0},0).css({display:'block'}).wrap(
                        '<span class="select_wrap" />'
                    );
                    s.after(
                        '<span class="select_fake"><span class="fake_text">'+tx+'</span></span>'
                    );
                    function selectFakeResize(){
                        s.css({width:'auto'}).addClass('letmebe');
                        outW = s.actual('outerWidth');
                        s.next('.select_fake').css({width:'auto'});
                        fake = s.next('.select_fake').css({width:outW});
                        wrap = s.parents('.select_wrap').eq(0);
                        wrap.css({width:fake.actual('outerWidth')});
                        s.css({width:fake.actual('outerWidth')}).addClass('letmebe');
                        var wrapW = s.parents('form').eq(0).actual('outerWidth'),
                            fakeW = fake.actual('outerWidth');
                        if ( wrapW <= fakeW && s.attr('id')!='pix_select_menu' ) {
                            fake.addClass('box-sizing');
                        } else {
                            fake.removeClass('box-sizing');
                        }
                    } 
                    selectFakeResize();
                    jQuery(window).bind('resize',function(){
                        clearTimeout(set);
                        set = setTimeout(function(){
                            selectFakeResize();
                        },600);
                    });
                    fake.append('<div class="dd_arrow"><i class="icon-caret-down"></i></div>').append('<div class="dd_divider" />');
                    
                    s.bind('change',function(){
                        tx = jQuery('option:selected',s).text();
                        fake.find('.fake_text').text(tx);
                    });
                    jQuery('form.variations_form').bind('change',function(){
                        jQuery('select', this).each(function(){
                            var tx = jQuery('option:selected',this).text(),
                                fake = jQuery(this).next('.select_fake');
                            fake.find('.fake_text').text(tx);
                        });
                    });
                }
            });
        } else {
            jQuery('select').addClass('letmebe');
        }
    }

    if(!jQuery('body').hasClass('donot_smooth_cb')){
        if (!(jQuery.browser.msie && jQuery.browser.version < 8)) {
            jQuery('input[type="checkbox"]').not('.letmebe').each(function(){
                jQuery(this).wrap('<label class="fake_label" />');
                jQuery(this).addClass('letmebe').after('<span />');
            });
        } else {
            jQuery('input[type="checkbox"').addClass('letmebe');
        }
    }

    if(!jQuery('body').hasClass('donot_smooth_rb')){
        if (!(jQuery.browser.msie && jQuery.browser.version < 8)) {
            jQuery('input[type="radio"]').not('.letmebe').each(function(){
                jQuery(this).wrap('<label class="fake_label" />');
                jQuery(this).addClass('letmebe').after('<span />');
            });
        } else {
            jQuery('input[type="checkbox"').addClass('letmebe');
        }
    }
}

/********************************
*
*   Advanced search
*
********************************/
function advancedSearch(){
    var post_type_val = '';
    jQuery('#pix_search_advanced input[type="checkbox"]').each(function(){
        var form = jQuery(this).parents('form').eq(0),
            input = form.find('input[name="post_type"]');
        if ( jQuery(this).is(':checked') ) {
            post_type_val = post_type_val + jQuery(this).val() + ',';
        }
        input.val(post_type_val.substr(0,post_type_val.length - 1));
        jQuery(this).click(function(){
            var post_type_val = '';
            jQuery('input[type="checkbox"]',form).each(function(){
                if ( jQuery(this).is(':checked') ) {
                    post_type_val = post_type_val + jQuery(this).val() + ',';
                }
            });
            input.val(post_type_val.substr(0,post_type_val.length - 1));
        });
    });

    jQuery(document).on('click','#pix_search_advanced .advanced_toggle:not(".clicked")',function(){
        var t = jQuery(this);
        t.addClass('clicked');
        t.parents('form').eq(0).find('.advanced_search_options').slideDown(200);
        return false;
    });

    jQuery(document).on('click','#pix_search_advanced .advanced_toggle.clicked',function(){
        var t = jQuery(this);
        t.parents('form').eq(0).find('.advanced_search_options').slideUp(200,function(){
            t.removeClass('clicked');           
        });
        return false;
    });
}

/********************************
*
*   Header
*
********************************/
function forteHeader(){

    var logoW = jQuery('#logo span').length ? parseFloat(jQuery('#logo').outerWidth(true)) : 0,
        logoSubtitleW = jQuery('#logo_subtitle:visible').length ? parseFloat(jQuery('#logo_subtitle').outerWidth(true)) : 0,
        navW = 0,
        selectBox = jQuery.browser.msie ? jQuery('#pix_select_menu') : jQuery('nav .select_wrap');
        selectDDMenu = parseFloat(selectBox.actual( 'outerWidth', { includeMargin : true }));
        
    jQuery('nav ul.menu > li').each(function(){
        navW = (navW + parseFloat(jQuery(this).actual( 'outerWidth', { includeMargin : true })));
    });
    
    var docW = parseFloat(jQuery('header .pix_column_990').width());
        
    if ( jQuery.browser.msie )
        jQuery('html').addClass('ms-ie');

    if ( (logoW +logoSubtitleW + selectDDMenu) > (docW) ) {
        jQuery('body').addClass('small_enough');
        jQuery('body').removeClass('small_screen');
        jQuery('body').trigger('menu_loaded');
        jQuery('nav').addClass('menu_loaded');
    } else if ( (logoW +logoSubtitleW + navW) > (docW) ) {
        jQuery('body').addClass('small_screen');
        jQuery('body').removeClass('small_enough');
        jQuery('body').trigger('menu_loaded');
        jQuery('nav').addClass('menu_loaded');
    } else {
        jQuery('body').removeClass('small_screen');
        jQuery('body').removeClass('small_enough');
    }
    
    jQuery('header .pix_column_990').bind('resize',function(){


        var docW = parseFloat(jQuery('header .pix_column_990').width());
        
        if ( (logoW +logoSubtitleW + navW) > (docW) ) {
            if ( (logoW +logoSubtitleW + selectDDMenu) > (docW) ) {
                jQuery('body').addClass('small_enough');
            } else {
                jQuery('body').addClass('small_screen');
            }
        } else {
            jQuery('body').removeClass('small_screen');
            jQuery('body').removeClass('small_enough');
        }
        
    });
}

function headerScrollResize(){
    var fromTop = ( parseFloat(jQuery('html').scrollTop()) + parseFloat(jQuery('body').scrollTop() ) ),
        winH = jQuery(window).height(),     
        listart = parseFloat(jQuery('nav').attr('data-listart')),
        selectBox = jQuery.browser.msie || jQuery('body').hasClass('donot_smooth_ds') ? jQuery('#pix_select_menu') : jQuery('nav .select_wrap');
        liend = parseFloat(jQuery('nav').attr('data-liend'));

    if ( !jQuery('html').hasClass('ie8') && !jQuery('body').hasClass('header_scroll') && jQuery('body').hasClass('header_resize') ) {
        if ( jQuery(window).width() > 767 ) {
            if ( fromTop < 70 ) {
                jQuery('#logo, #logo a, #logo_subtitle, #logo_subtitle span, nav > div > ul > li > a, nav > div > ul > li > a *').not('.totop_arrow').css({
                    height : (100-(fromTop*0.5))+'px',
                    lineHeight : (100-(fromTop*0.5))+'px'
                });

                jQuery('nav > div > ul > li').css({
                    height : (listart-(fromTop*0.5))+'px'
                });
                jQuery('nav > div > ul > li > ul, nav > div > ul > li > div').css({
                    marginTop : (100-(fromTop*0.5))+'px'
                });
                selectBox.each(function(){
                    var heightThis = jQuery(this).outerHeight();
                    jQuery(this).css({
                        marginTop : ((50-(heightThis/2))-(fromTop*0.5))+'px'
                    });
                });
            } else {
                jQuery('#logo, #logo a, #logo_subtitle, #logo_subtitle span, nav > div > ul > li > a, nav > div > ul > li > a *').not('.totop_arrow').css({
                    height : '70px',
                    lineHeight : '70px'
                });
                jQuery('nav > div > ul > li').css({
                    height : liend+'px'
                });
                jQuery('nav > div > ul > li > ul, nav > div > ul > li > div').css({
                    marginTop : '70px'
                });
                selectBox.each(function(){
                    var heightThis = jQuery(this).outerHeight(false);
                    jQuery(this).css({
                        marginTop : ((35-(heightThis/2)))+'px'
                    });
                });
            }
        } else {
            selectBox.each(function(){
                var heightThis = jQuery(this).outerHeight(false);
                jQuery(this).css({
                    marginTop : ((50-(heightThis/2)))+'px'
                });
            });
        }
    } else {
                jQuery('#logo, #logo a, #logo_subtitle, #logo_subtitle span, nav > div > ul > li > a, nav > div > ul > li > a *').not('.totop_arrow').css({
                    height : '100px',
                    lineHeight : '100px'
                });
                jQuery('nav > div > ul > li').css({
                    height : '100px'
                });
                jQuery('nav > div > ul > li > ul, nav > div > ul > li > div').css({
                    marginTop : '100px'
                });
                selectBox.each(function(){
                    var heightThis = jQuery(this).outerHeight(false);
                    jQuery(this).css({
                        marginTop : ((50-(heightThis/2)))+'px'
                    });
                });
    }
    
}

/********************************
*
*   Tooltips
*
********************************/
function forteTooltips() {
    var setOut,
        setIn;
    jQuery('*[data-tip]').bind('mouseenter',function(){
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
            tW = t.outerWidth()*0.5;
            tH = t.outerHeight();
            jQuery('body').append('<div id="pix_tooltip">'+cont+'</div><div id="pix_tooltip_arrow" class="'+arrowClass+'"></div>');
            jQuery('#pix_tooltip').css({
                top: 0,
                left: 0,
                display: 'block',
                opacity: 0,
                width: t.attr('data-width')+'px'
            });
            ttW = jQuery('#pix_tooltip').outerWidth() * 0.5;
            ttH = jQuery('#pix_tooltip').outerHeight();
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
            } else if ( (off.left + tW + ttW) > jQuery(window).width() ) {
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

/********************************
*
*   Header effect in
*
********************************/
function headerFxIn(){
    
    if ( !jQuery('body').hasClass('small_screen') && (jQuery('header').attr('data-referer')=='' || jQuery('header').attr('data-referer').indexOf('landing/forte_landing.php')!=-1) && jQuery('body').hasClass('pix_header_effect') ) {
        
        jQuery(window).bind('load',function(){
    
            jQuery('#logo a, #logo_subtitle span, nav > div > ul > li > a > span').css({
                marginTop : '-60px'
            });
            
            jQuery('#logo').css({
                overflow : 'hidden',
                visibility: 'visible'
            });
            
            jQuery('#logo a').animate({
                marginTop : 0
            },2000,'easeOutElastic',function(){
                jQuery('#logo').css({
                    overflow : 'visible'
                });
            });
            
            jQuery('#logo_subtitle').css({
                overflow : 'hidden',
                visibility: 'visible'
            });
            
            var delay_subtitle = 0;
            
            if ( jQuery('#logo_subtitle').length ) {
                delay_subtitle = 100;
            }
            
            jQuery('#logo_subtitle span').delay(100).animate({
                marginTop : 0
            },2000,'easeOutElastic',function(){
                jQuery('#logo_subtitle').css({
                    overflow : 'visible'
                });
            });
            
            jQuery('nav > div > ul > li').css({
                overflow : 'hidden',
                visibility: 'visible'
            });
            
            jQuery('nav > div > ul > li').each(function(){
                var index = (jQuery(this).index()+1),
                    t = jQuery(this);
                jQuery('> a > span',this).stop(false,false).delay(delay_subtitle+(100*index)).animate({
                    marginTop : 0
                },2000,'easeOutElastic',function(){
                    t.css({
                        overflow : 'visible'
                    }).addClass('pix_loaded');
                    if ( jQuery('nav > div > ul > li').length == jQuery('nav > div > ul > li.pix_loaded').length ) {
                        jQuery('body').trigger('menu_loaded');
                        jQuery('nav').addClass('menu_loaded');
                    }
                });
            });
        
        });
        
    } else {
        jQuery('#logo, #logo_subtitle, nav > div > ul > li').css({
            visibility : 'visible'
        });
        jQuery('nav').addClass('menu_loaded');
   }
}

/********************************
*
*   Scrollpane
*
********************************/
function initScrollPane() {
    jQuery('.aside_wrap').jScrollPane();

    jQuery('body').bind('pix_show_sidebars',function(){
        jQuery('.aside_wrap').each(function(){
            var pane = jQuery(this),
                api = pane.data('jsp');
            if ( typeof api !== 'undefined' && api !== false ) {
                api.reinitialise();
            }
        });
        jQuery('.pix_accordion').accordion('refresh');
    });

    jQuery('.pix_widget').bind('resize',function(){
        jQuery('.aside_wrap').each(function(){
            var pane = jQuery(this),
                api = pane.data('jsp');
            api.reinitialise();
        });
    });

}

function adjustScrollPane() {
    jQuery('.aside_wrap').each(function(){
        var pane = jQuery(this),
            api = pane.data('jsp');
        if ( typeof api !== 'undefined' && api !== false ) {
            api.reinitialise();
        }
    });
}

/******************************************************
*
*   iFrame height
*
******************************************************/
function pixIframeHeight() {
    jQuery('iframe').each(function () {
        var t = jQuery(this),
            ratio,
            w;
            
        if ( t.attr('data-size')=='percent' && !jQuery(this).parents('div').eq(0).hasClass('letmebe') && !jQuery(this).parents('div').eq(0).hasClass('pix_column_thumb') ) {
            t.attr('width',(t.attr('width')+'%'));
            w = t.width();
            ratio = Math.round(parseInt(t.attr('height')));
            t.height( (w*(ratio*0.01)) );
            jQuery(window).bind('resize',function(){
                w = t.width();
                t.height( (w*(ratio*0.01)) );
            });
        } else {
            t.css( 'width','100%');
            w = t.width();
            ratio = t.attr('height')/t.attr('width');
            t.height( w*ratio );
            jQuery(window).bind('resize',function(){
                w = t.width();
                t.height( w*ratio );
            });
        }
    });
    
    jQuery('.pix_wrap_player').each(function () {
        var t = jQuery(this),
            h = t.attr('data-height'),
            w = t.width();
            
        if ( typeof h !== 'undefined' && h !== false && h.indexOf('%')!=-1 ) {
            ratio = h.replace('%','');
            t.height( (w*(ratio*0.01)) );
            jQuery(window).bind('resize',function(){
                w = t.width();
                t.height( (w*(ratio*0.01)) );
            });
        }
    });

}

/******************************************************
*
*   iFrame height
*
******************************************************/
function pixMepHeight() {
    jQuery('video.wp-video-shortcode').each(function() {
        var t = jQuery(this),
            p = t.parents('.pix_column').eq(0),
            wP,
            w = parseFloat(t.attr('width')),
            h = parseFloat(t.attr('height')),
            set;
        function pixMepHeightRun(){
            wP = parseFloat(p.width());
            newH = h/(w/wP);
            t.attr('width',wP).attr('height',newH);
            p.find('div.mejs-container').parent().height(newH);
        }
        pixMepHeightRun();
        jQuery(window).bind('load resize',function(){
            p.find('div.mejs-container').addClass('pix-mejs-container');
            pixMepHeightRun();
        });
        jQuery('body').bind('isotoped, pixWallreLayout',function(){
            p.find('div.mejs-container').addClass('pix-mejs-container');
            pixMepHeightRun();
        });

    });
}

/********************************
*
*   Select menu
*
********************************/
function selectMenu() {
    jQuery('#pix_select_menu').on('change',function(){
        var href = jQuery('option:selected',this).attr('data-href');
        window.location.href = href;
    });
}

/********************************
*
*   Hover image effect
*
********************************/
function pixOverlayImage() {
    jQuery('a:has(img), a.filmore_link_100').not('[data-content]').not('.letmebe').not('.rsswidget').not('.cloud-zoom').not('.cloud-zoom-gallery').each(function(){
        if ( !jQuery('.pix_overlay_icon',this).length && !jQuery(this).parents('ul').eq(0).hasClass('product_list_widget') && !jQuery(this).parents('.pix_slideshow').length && !jQuery(this).parents('nav').length ) {
            jQuery(this).css({display:'block',position:'relative'}).append('<span class="pix_overlay_icon" />');
            jQuery(this).css({display:'block',position:'relative'}).append('<span class="pix_overlay_border" />');

            var t = jQuery(this),
                img = jQuery('img',t),
                imgClass = img.attr('class'),
                href = t.attr('href');

            if(typeof href !== 'undefined' && href !== false && href != '') {
                if ( 
                        href.match( /\.jpg/ig ) 
                        ||
                        href.match( /\.jpeg/ig ) 
                        ||
                        href.match( /\.png/ig )
                        ||
                        href.match( /\.gif/ig ) 
                    ) 
                {
                    t.not('.cloud-zoom, .cloud-zoom-gallery').addClass('colorbox').find('.pix_overlay_icon').append('<i class="icon-zoom-in" />');
                    t.each(function(){
                        var dataTitle = jQuery(this).attr('data-title');
                    });

                } 
                else if (
                        href.match( /vimeo/ig ) 
                        ||
                        href.match( /youtube/ig ) 
                        ||
                        href.match( /dailymotion/ig ) 
                        ||
                        href.match( /mp4/ig ) 
                        ||
                        href.match( /flv/ig ) 
                    )
                {
                    t.addClass('toVideo');
                }
                else {
                    t.find('.pix_overlay_icon').append('<i class="icon-link" />');
                }
            }
        }
                    
    });
}

/********************************
*
*   ColorBox
*
********************************/
function pixInitColorbox(){

    if(jQuery.isFunction(jQuery.fn.colorbox) && !jQuery('body').hasClass('colorbox_disabled')) {

        jQuery("a.colorbox, a[data-colorbox=true]").not('.cloud-zoom').not('.cloud-zoom-gallery').not('.fake-colorbox').not('.letmebe').each(function(){
            var dataRel = jQuery(this).attr('data-rel');
            var dataTitle = jQuery(this).attr('data-title');
            if (!jQuery(this).parents('[data-href].display_none').length) {
                if ( jQuery(this).attr('data-iframe') ) {
                    var scrolling = (jQuery(this).attr('data-scrolling') == '' || typeof(jQuery(this).attr('data-scrolling')) == 'undefined') ? true : false;
                    var width = (jQuery(this).attr('data-width') == '' || typeof(jQuery(this).attr('data-width')) == 'undefined') ? "90%" : parseFloat(jQuery(this).attr('data-width')),
                        height = (jQuery(this).attr('data-height') == '' || typeof(jQuery(this).attr('data-height')) == 'undefined') ? "90%" : parseFloat(jQuery(this).attr('data-height'));
                    jQuery(this).colorbox({iframe:true, innerWidth:width, innerHeight:height, scrolling:scrolling, rel:dataRel, current:"{current} / {total}", close: pix_CB_close, next: pix_CB_next, previous: pix_CB_prev, onComplete: function(){ jQuery(this).parents('.over_icons').eq(0).fadeOut(); } });
                } else {
                    jQuery(this).colorbox({maxWidth:"98%", maxHeight:"98%", rel:dataRel, current:"{current} / {total}", close: pix_CB_close, next: pix_CB_next, previous: pix_CB_prev, onComplete: function(){ jQuery('#cboxLoadedContent').prepend('<div class="cboxPrevent" />'); jQuery('#cboxTitle').text(dataTitle); }, onClosed: function(){ jQuery('.cboxPrevent').remove(); jQuery('#cboxTitle').text(''); } });
                }
            }    
        });
    }
}

/********************************
*
*   jPlayer
*
********************************/
function pixJPlayerInit() {
    jQuery(".jp-jplayer").each(function(){
        var id = jQuery(this).attr('data-id'),
            mp3 = jQuery(this).attr('data-mp3');

        jQuery('#jquery_jplayer_'+id).jPlayer( {
            ready: function () {
              jQuery(this).jPlayer("setMedia", {
                mp3: mp3
              });
            },
            cssSelectorAncestor: '#jp_container_'+id,
            supplied: "mp3",
            swfPath: forte_theme_dir+"/scripts/Jplayer.swf"
        });     

        jQuery(document).on('click','.audio-post-format.pix_column_210.playing',function(){
            jQuery('.jp-pause',this).click();
            jQuery(this).removeClass('playing').addClass('notplaying');
        });
        jQuery(document).on('click','.audio-post-format.pix_column_210.notplaying',function(){
            jQuery('.jp-play',this).click();
            jQuery(this).removeClass('notplaying').addClass('playing');
        });
    });
}

/********************************
*
*   Wall effect
*
********************************/
function pixWallEffect(){
    jQuery('html.working section.pix_wall .entry').bind('mouseenter',function(){
        var t = jQuery(this);
        jQuery('section.pix_wall .entry').not('.isotope-hidden').addClass('notHover');
        if ( !t.hasClass('isotope-hidden') ) {
            t.addClass('hover');           
        }
        if ( jQuery('.entry-sliding-content', t).length && !jQuery('.entry-sliding-arrow', t).length ) {
            t.append('<div class="entry-sliding-arrow" />');
            jQuery('.entry-sliding-content', t).each(function(){
                var h = parseFloat(jQuery(this).outerHeight()),
                    parentH = parseFloat(t.outerHeight()),
                    parentBottom = ( parseFloat(t.offset().top) + parentH ),
                    winEnd = ( parseFloat(jQuery(window).height()) + parseFloat(jQuery('html').scrollTop()) + parseFloat(jQuery('body').scrollTop() ) );

                if ( ( parentBottom + h ) > winEnd ) {
                    jQuery(this).addClass('toTop');
                    jQuery('.entry-sliding-arrow',t).addClass('toTop').stop(true,false)
                        .animate({
                            marginTop: Math.floor(h/3)+'px',
                            opacity: 1
                        },400,'easeInOutExpo');
                    t.find('> .pix_column').stop(true,false)
                        .animate({
                            marginTop: Math.floor(h/3)+'px'
                        },400,'easeInOutExpo');
                    jQuery(this)
                        .stop(true,false)
                        .animate({
                            marginTop: '-'+(h-1)+'px',
                            opacity: 1
                        },400,'easeInOutExpo');
                } else {
                    jQuery(this).removeClass('toTop');
                    jQuery('.entry-sliding-arrow',t).removeClass('toTop').stop(true,false)
                        .animate({
                            opacity: 1
                        },400,'easeInOutExpo');
                    t.find('> .pix_column').stop(true,false)
                        .animate({
                            marginTop: '-'+Math.floor(h/3)+'px'
                        },400,'easeInOutExpo');
                    jQuery(this)
                        .stop(true,false)
                        .animate({
                            marginBottom: '-'+(h-1)+'px',
                            opacity: 1
                        },400,'easeInOutExpo');
                }
            });

        }
    });
    jQuery('html.working section.pix_wall .entry').bind('mouseleave',function(){
        jQuery('section.pix_wall .entry:visible').removeClass('notHover');
        var t = jQuery(this);
        t.removeClass('hover');
        if ( jQuery('.entry-sliding-content', t).length ) {
            t.find('> .pix_column').stop(true,false)
                .animate({
                    marginTop: 0,
                    opacity: 1
                },400,'easeInOutExpo');
            jQuery('.entry-sliding-content', t)
                .stop(true,false)
                .animate({
                    marginBottom: 0,
                    marginTop: 0,
                    opacity: 0
                },400,'easeInOutExpo');
        }

        jQuery('.entry-sliding-arrow',t).stop(true,false).animate({
            opacity: 0,
            marginTop: 0
        },400,'easeInOutExpo',function(){
            jQuery(this).remove();
        });
    });
    jQuery('html.ie8 section.pix_wall .entry').each(function(){
        var t = jQuery(this);
        if ( jQuery('.entry-sliding-content', t).length ) {
            t.hover(function(){
                jQuery('.entry-sliding-content', t).stop(true,false).fadeIn(400,'easeInOutExpo');
            }, function(){
                jQuery('.entry-sliding-content', t).stop(true,false).fadeOut(200,'easeOutExpo');
            });
        }
    });
}
function pixWallEffectNo(){
    jQuery('section.pix_wall .entry').unbind();
}

function pixGridFolio() {
    jQuery('.pix_wall').each(function(){
        var w = jQuery(window).width(),
            wWall = jQuery(this).width(),
            cols = Math.ceil(w / 470);

        if ( wWall > 470 && (w/cols) > 299 ) {
            itemW = Math.floor(w/cols);
        } else if ( wWall > 470 && (w/cols) < 300 ) {
            itemW = 470;
        } else  {
            itemW = wWall;
        }

        if ( jQuery('.pix_column_thumb', this).hasClass('pix_column_4_3') ) {
            itemH = Math.floor((itemW*3)/4);
        } else {
            itemH = Math.floor((itemW*9)/16);
        }

        jQuery('.pix_column_thumb, .pix_in_shortcode', this).css({
            height: itemH,
            width: itemW
        });

        if (jQuery.browser.msie && jQuery.browser.version < 9) {
            jQuery('.entry', this).css({
                height: itemH,
                width: itemW
            });
        }

        jQuery('ul.jp-controls',this).css({
            top: '-'+(itemH/2)+'px'
        }).parents('.pix_wall').eq(0).animate({
            opacity : 1
        },200);
    });

        var set;
        clearTimeout(set);
        set = setTimeout(function(){
            jQuery('.pix_wall').isotope('reLayout');
            jQuery('body').trigger('pixWallreLayout')
        },100);
}

/********************************
*
*   Masonry
*
********************************/
function initMasonry() {
    jQuery('.pix_load_content').each(function(){
        var wall = jQuery(this),
            counter = 1,
            loadContentInd = jQuery(this).index('body .pix_load_content'),
            moreinf = wall.next('.moreItemsInfinite').eq(0),
            article = wall.parents('.wrap_filter').eq(0),
            sort_select = article.find('.sort_select').not('.hidden_div').eq(0),
            layoutMode = wall.hasClass('masonry') ? 'masonry' : 'fitRows';
        wall.imagesLoaded( function(){
            wall.isotope({
                itemSelector:".entry",
                animationEngine:"jquery",
                layoutMode: layoutMode,
                animationOptions: {
                    duration: 1,
                    easing: 'easeOutQuad'
                }
            });
            var set;
            clearTimeout(set);
            set = setTimeout(function(){
                wall.isotope('reLayout').animate({
                    opacity : 1
                },200);
            },100);

            jQuery(window).bind('resize', function() {
                wall.isotope('reLayout');
            }).trigger('resize');
        });

        var sortOpts = jQuery('.sort_select.hidden_div',article).html();
            
        var sortSelect = function(){
            sort_select.each(function(){
                jQuery(this).html(sortOpts);
                var stringClasses;
                jQuery('.entry',wall).each(function(){
                    stringClasses = stringClasses + jQuery(this).attr('data-sort');
                });
                arrClasses = stringClasses.split(' ');
                arrClasses = jQuery.unique(arrClasses);
                jQuery('option',this).each(function(){
                    var thisVal = jQuery(this).val();
                    if(jQuery.inArray(thisVal,arrClasses) < 0) {
                        jQuery(this).remove();
                    }
                });

                jQuery(this).change(function(){
                    wall.find('.isotope-hidden').show();
                    var set;
                    pixWallEffectNo();
                    var selector = '[data-sort*="' + jQuery('option:selected',this).val() + ' "]';
                    wall.isotope({ filter: selector, animationOptions: { duration: 300 } },function(){
                        clearTimeout(set);
                        set = setTimeout(function(){
                            pixWallEffect();
                            initPixImages();
                            wall.find('.isotope-hidden').hide();
                        },600);
                    });
                });
                fakeSelect();
            });
        };

        sortSelect();
                                    
        jQuery('a', moreinf).off('click');
        jQuery('a', moreinf).on('click',function(){

            pixWallEffectNo();
            
            var t = jQuery(this),
                url = t.attr('href'),
                newUrl,
                loadedContent;

            jQuery('#pix_loader').fadeIn(150);

            var sel = jQuery('option:selected',sort_select).val();

            jQuery.ajax({
                url: url,
                success: function(loadedData){
                    counter++;
                    loadedContent = jQuery("<div/>").append(loadedData.replace(/<script(.|\s)*?\/script>/g, "")).find('.pix_load_content:eq('+loadContentInd+') .entry, .pix_load_content:eq('+loadContentInd+') .maybe_clear');
                    newUrl = jQuery("<div/>").append(loadedData.replace(/<script(.|\s)*?\/script>/g, "")).find('.pix_load_content:eq('+loadContentInd+')').next('.moreItemsInfinite').eq(0).find('a').attr('href');
                    jQuery.ajax({
                        url: newUrl,
                        success: function(loadedDataNew){
                            var loadedContentNew = jQuery("<div/>").append(loadedDataNew.replace(/<script(.|\s)*?\/script>/g, "")).find('.pix_load_content:eq('+loadContentInd+') .entry, .pix_load_content:eq('+loadContentInd+') .maybe_clear');
                            if(typeof loadedContentNew.html() === 'undefined' || typeof loadedContentNew.html() === 'null' || loadedContentNew.html() == '') {
                                moreinf.slideUp();                               
                            }
                    initPixSlideshows();
                        }
                    });
                    jQuery(loadedContent).css('opacity',0);
                    wall.append(loadedContent);
                    if( typeof mediaelementplayer == 'function' ) { loadedContent.find('audio,video').mediaelementplayer(); }
                    t.attr('href',newUrl);
                    pixOverlayImage();
                    pixInitColorbox();
                    pixGridFolio();
                    initPixSlideshows();
                    pixJPlayerInit();
                    excerptTruncate();
                    initFlowPlayer();
                    saleRibbonPosition();
                    jQuery('body').trigger('isotoped');
                    jQuery('#pix_loader').fadeOut(150);
                    wall.isotope( 'appended', loadedContent,function(){
                        if(typeof sel !== 'undefined' && sel !== false && sel!=''){
                            jQuery('option[value='+sel+']',sort_select).prop('selected',true);
                            var selector = '[data-sort*="' + sel + ' "]';
                            wall.isotope({ filter: selector, animationOptions: { duration: 300 } },function(){
                                wall.isotope({ animationOptions: { duration: 1 } });
                                initPixImages();
                            });
                        }
                    });
                    loadedContent.find('.hidden_select').contents().filter(function(){
                        return this.nodeType == 8;
                    }).each(function(i, e){
                        //console.log(e.nodeValue);
                    });
                    sortSelect();
                }, complete: function(){
                    jQuery(loadedContent).imagesLoaded( function(){
                        wall.isotope('reLayout',function(){
                            pixWallEffect();
                        });
                    });
                }
            });
            
            return false;

        });
        jQuery(document).ajaxError(function(e,xhr,opt){
            if (xhr.status == 404) {
                moreinf.slideUp().remove();
            }
        });

    });

}

/********************************
*
*   Load next page items
*
********************************/
function loadNextData(){
    jQuery('.pix_load_content').each(function(){
        if ( jQuery(this).next('.moreItemsInfinite').eq(0).length ) {
            var newUrl = jQuery(this).next('.moreItemsInfinite').eq(0).find('a').attr('href'),
                loadContentInd = jQuery(this).index('body .pix_load_content');
            jQuery.ajax({
                url: newUrl,
                success: function(loadedDataNew){
                    var loadedContentNew = jQuery("<div/>").append(loadedDataNew.replace(/<script(.|\s)*?\/script>/g, "")).find('.pix_load_content:eq('+loadContentInd+') .entry, .pix_load_content:eq('+loadContentInd+') .maybe_clear');
                }
            });
        }
    });
}

/********************************
*
*   WooCommerce ordering
*
********************************/
function wcOrdering(){
    jQuery('form.order_list select').bind('change', function(){
        jQuery(this).closest('form').submit();
    });
    
    jQuery('form.order_list a, form.woocommerce_ordering a, form.order-list a, form.woocommerce-ordering a').click(function(){
        if(jQuery(this).hasClass('selected')){
            return false;
        }
        var form = jQuery(this).closest('form'),
            value = jQuery(this).attr('data-value');
        jQuery('input[data-name=order-arrows]',form).val(value);
        form.submit();
        return false;
    });
}

/********************************
*
*   FlowPlayer
*
********************************/
function initFlowPlayer(){
    jQuery(".pix_flowplayer").each(function(){
        var t = jQuery(this);
        if (!(jQuery.browser.msie && jQuery.browser.version < 9)) {
            t.flowplayer();
            t.bind('click',function(){
                t.css({
                    background: '#000000'
                });
            });
        }
    });
}

/******************************************************
*
*   Ajax form
*
******************************************************/
function ajaxForm(){

    jQuery('.pix_contact_form.commentform').each(function () { 
        
        var t = jQuery(this);

        t.submit(function() {
        
            jQuery('input[type="checkbox"]').each(function(){
                if(!jQuery(this).is(':checked')){
                    jQuery(this).val('');
                } else {
                    jQuery(this).val('on');
                }
            })

            var req = 0,
                tag;

            jQuery('.pix_required', t).each(function() {
                
                if ( jQuery(this).hasClass('email') ) {
                                
                    var emailReq = jQuery(this).val(),
                        emailCheck = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if(!emailCheck.test(emailReq)  || jQuery(this).val()=='' ) {
                        jQuery(this).prevAll('label').eq(0).addClass('label_error');
                        req = 1;
                    }
                    
                } else if ( !jQuery(this).hasClass('email') && jQuery(this).val()=='' ) {
                    
                    jQuery(this).prevAll('label').eq(0).addClass('label_error');
                    jQuery(this).closest('.select_wrap').prevAll('label').eq(0).addClass('label_error');
                    jQuery(this).closest('.captchaCont').prevAll('label').eq(0).addClass('label_error');
                    req = 1;
                    
                } else {
                    
                    jQuery(this).prevAll('label').eq(0).removeClass('label_error');
                    jQuery(this).closest('.select_wrap').prevAll('label').eq(0).removeClass('label_error');
                    jQuery(this).closest('.captchaCont').prevAll('label').eq(0).removeClass('label_error');
                    
                }

            });
            
            jQuery('input[type=radio].pix_required', t).each(function(){
                var radioName = jQuery(this).attr('name');
                if ( !jQuery('input[name='+radioName+']:checked').length ) {
                    jQuery(this).prevAll('label').eq(0).addClass('label_error');
                    req = 1;
                }
            });
            
            jQuery('select[multiple].pix_required', t).each(function(){
                if ( !jQuery('option:selected',this).length ) {
                    jQuery(this).prevAll('label').eq(0).addClass('label_error');
                    req = 1;
                }
            });
            
            jQuery('input.email', t).not('.pix_required').each(function() {
                var emailReq = jQuery(this).val(),
                    emailCheck = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if(!emailCheck.test(emailReq) && emailReq!='' ) {
                    jQuery(this).prevAll('label').eq(0).addClass('label_error');
                    req = 1;
                }
            });
            
            jQuery('input').not('.email').bind('change keyup blur click',function(){
                if(jQuery(this).attr('type')=='checkbox'){
                    if(!jQuery(this).is(':checked')){
                        jQuery(this).val('');
                    } else {
                        jQuery(this).val('on');
                    }
                }

                if(jQuery(this).val()!=''){
                    jQuery(this).prevAll('label').eq(0).removeClass('label_error');
                    jQuery(this).closest('.captchaCont').prevAll('label').eq(0).removeClass('label_error');
                }
            })
            
            jQuery('select').bind('change',function(){
                if(jQuery(this).val()!=''){
                     jQuery(this).prevAll('label').eq(0).removeClass('label_error');
                     jQuery(this).closest('.select_wrap').prevAll('label').eq(0).removeClass('label_error');
                }
            })
            
            jQuery('input.email').bind('keyup blur',function(){
                var emailReq = jQuery(this).val(),
                    emailCheck = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if(jQuery(this).hasClass('.pix_required')){
                    if(emailCheck.test(jQuery(this).val()) && jQuery(this).val()!='' ) {
                         jQuery(this).prevAll('label').eq(0).removeClass('label_error');
                    }
                } else {
                    if( emailCheck.test(jQuery(this).val()) || jQuery(this).val()=='' ) {
                         jQuery(this).prevAll('label').eq(0).removeClass('label_error');
                    }
                }
            })
            
            jQuery('textarea').bind('keyup blur',function(){
                if(jQuery(this).val()!=''){
                     jQuery(this).prevAll('label').eq(0).removeClass('label_error');
                }
            })
            
            if(req == 1){
                return false;
            }

            data = t.serialize();
            
            jQuery('#pix_loader').fadeIn(200);
            jQuery('.pix_success:visible',t).slideUp(100);
            jQuery('.pix_error:visible',t).slideUp(100);

            jQuery.ajax({
                url: forte_theme_dir+"/scripts/mailer/pix-comments-post.php",
                type: "POST",
                data: data,     
                cache: false,
                success: function (html) {
                    if (html.indexOf('pix_duplicate')!=-1) {
                        jQuery('#pix_loader').fadeOut(100);
                        loadedContent = jQuery("<div/>").append(html.replace(/<script(.|\s)*?\/script>/g, "")).find('p').html();
                        jQuery('label[for="comment"]',t).addClass('label_error');
                    } else if (html.indexOf('siCaptcha')!=-1 ) { 
                        jQuery('#pix_loader').fadeOut(100);
                        location.reload();
                    } else if (html.indexOf('captcha')!=-1) {
                        jQuery('#pix_loader').fadeOut(100);
                        jQuery('.captchaCont label',t).addClass('label_error');
                        jQuery('.recaptcha',t).click();
                    }
                }        
            });

            return false;

        }); 
    }); 


    jQuery('.pix_contact_form').not('.commentform').each(function () {        
        
        
        var t = jQuery(this);

        jQuery('form',t).submit(function () {
            
            jQuery('.pix_success:visible',t).slideUp(100);
            jQuery('.pix_error:visible',t).slideUp(100);

            var data = 'captcha='+jQuery('input[name="captcha"]',t).val()+'&form='+t.attr('id');
            var allRequired = [];
            var allFields = [];
            var allValues = [];
            jQuery('input[type="checkbox"]').each(function(){
                if(!jQuery(this).is(':checked')){
                    jQuery(this).val('');
                } else {
                    jQuery(this).val('on');
                }
            })
            /*jQuery('.pix_required', t).each(function() {
                allRequired.push(jQuery(this).val());
            });*/
            var req = 0,
                tag;
            /*jQuery.each(allRequired, function(key, value) {
                tag = jQuery('.pix_required:eq('+key+')', t).attr('type');
                if(tag!='checkbox') {
                    if(allRequired[key]==''){
                        jQuery('.pix_required:eq('+key+')', t).prevAll('label').eq(0).addClass('label_error');
                        req = 1;
                    } else {
                        jQuery('.pix_required:eq('+key+')', t).prevAll('label').eq(0).removeClass('label_error');
                    }
                }
            });*/
            jQuery('.pix_required', t).each(function() {
                
                if ( jQuery(this).hasClass('email') ) {
                                
                    var emailReq = jQuery(this).val(),
                        emailCheck = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if(!emailCheck.test(emailReq)  || jQuery(this).val()=='' ) {
                        jQuery(this).prevAll('label').eq(0).addClass('label_error');
                        req = 1;
                    }
                    
                } else if ( !jQuery(this).hasClass('email') && jQuery(this).val()=='' ) {
                    
                    jQuery(this).prevAll('label').not('.fake_label').eq(0).addClass('label_error');
                    jQuery(this).closest('.fake_label').prevAll('label').eq(0).addClass('label_error');
                    jQuery(this).closest('.select_wrap').prevAll('label').eq(0).addClass('label_error');
                    jQuery(this).closest('.captchaCont').prevAll('label').eq(0).addClass('label_error');
                    req = 1;
                    
                } else {
                    
                    jQuery(this).prevAll('label').not('.fake_label').eq(0).removeClass('label_error');
                    jQuery(this).closest('.fake_label').prevAll('label').eq(0).removeClass('label_error');
                    jQuery(this).closest('.select_wrap').prevAll('label').eq(0).removeClass('label_error');
                    jQuery(this).closest('.captchaCont').prevAll('label').eq(0).removeClass('label_error');
                    
                }
            });
            
            jQuery('input[type=radio].pix_required', t).each(function(){
                var radioName = jQuery(this).attr('name');
                if ( !jQuery('input[name='+radioName+']:checked', t).length ) {
                    if ( jQuery('.fake_label').length ) {
                        jQuery(this).closest('.fake_label').prevAll('label').not('.fake_label').eq(0).addClass('label_error');
                    } else {
                        jQuery(this).prevAll('label').eq(0).addClass('label_error');
                    }
                    req = 1;
                }
            });
            
            jQuery('select[multiple].pix_required', t).each(function(){
                if ( !jQuery('option:selected',this).length ) {
                    jQuery(this).prevAll('label').eq(0).addClass('label_error');
                    req = 1;
                }
            });
            
            jQuery('input.email', t).not('.pix_required').each(function() {
                var emailReq = jQuery(this).val(),
                    emailCheck = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if(!emailCheck.test(emailReq) && emailReq!='' ) {
                    jQuery(this).prevAll('label').eq(0).addClass('label_error');
                    req = 1;
                }
            });
            
            jQuery('input').not('.email').bind('change keyup blur click date_filled',function(){
                if(jQuery(this).attr('type')=='checkbox'){
                    if(!jQuery(this).is(':checked')){
                        jQuery(this).val('');
                    } else {
                        jQuery(this).val('on');
                    }
                }

                if(jQuery(this).val()!=''){
                    jQuery(this).prevAll('label').eq(0).removeClass('label_error');
                    jQuery(this).closest('.fake_label').prevAll('label').not('.fake_label').eq(0).removeClass('label_error');
                    jQuery(this).closest('.captchaCont').prevAll('label').eq(0).removeClass('label_error');
                }
            })
            
            jQuery('select').bind('change',function(){
                if(jQuery(this).val()!=''){
                     jQuery(this).prevAll('label').eq(0).removeClass('label_error');
                     jQuery(this).closest('.select_wrap').prevAll('label').eq(0).removeClass('label_error');
                }
            })
            
            jQuery('input.email').bind('keyup blur',function(){
                var emailReq = jQuery(this).val(),
                    emailCheck = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if(jQuery(this).hasClass('.pix_required')){
                    if(emailCheck.test(jQuery(this).val()) && jQuery(this).val()!='' ) {
                         jQuery(this).prevAll('label').eq(0).removeClass('label_error');
                    }
                } else {
                    if( emailCheck.test(jQuery(this).val()) || jQuery(this).val()=='' ) {
                         jQuery(this).prevAll('label').eq(0).removeClass('label_error');
                    }
                }
            })
            
            jQuery('textarea').bind('keyup blur',function(){
                if(jQuery(this).val()!=''){
                     jQuery(this).prevAll('label').eq(0).removeClass('label_error');
                }
            })
            
            if(req == 1){
                jQuery('html, body').animate({
                    scrollTop: ( parseFloat(t.find('.label_error:first').offset().top) - ( parseFloat(jQuery('header').height()) + 20 )  )
                }, 500, 'easeInOutExpo');
                return false;
            }

            jQuery('input, textarea, select', t).each(function() {
                if(jQuery(this).attr('type')=='checkbox' || jQuery(this).attr('type')=='radio'){
                    if (jQuery(this).is(':checked')) {
                        allFields.push(jQuery(this).attr('data-field'));
                    }
                } else {
                    allFields.push(jQuery(this).attr('data-field'));
                }
            });
            
            jQuery('input, textarea, select', t).each(function() {
                if(jQuery(this).attr('type')=='checkbox' || jQuery(this).attr('type')=='radio'){
                    if (jQuery(this).is(':checked')) {
                        allValues.push(jQuery(this).val());
                    }
                } else {
                    allValues.push(jQuery(this).val());
                }
            });
            
            jQuery.each(allFields, function(key, value) {
                if(allFields[key]){
                    data = data+'&'+allFields[key] + '=value_'+key;
                }
            });
            
            jQuery.each(allValues, function(key, value) {
                data = data.replace('value_'+key, allValues[key]);
            });
            
            jQuery('#pix_loader').fadeIn(200);

            jQuery.ajax({
                url: forte_theme_dir+"/scripts/mailer/mailer.php",
                type: "POST",
                data: data,     
                cache: false,
                success: function (html) { 
                    if (html.indexOf('success')!=-1) {
                        jQuery('.recaptcha',t).click();
                        t.find('form')[0].reset();
                        jQuery('#pix_loader').fadeOut(100);
                        jQuery('.pix_success',t).slideDown(200);
                        if(typeof _gaq !== 'undefined' && typeof _gaq !== 'null') {
                            _gaq.push(['_trackPageview', '/sent-email-from-'+ t.attr('id')]);
                        }
                        if(typeof _gaq !== 'undefined' && typeof _gaq !== 'null') {
                            pageTracker = _gat._getTracker('/sent-email-from-'+ t.attr('id'));
                            pageTracker._trackPageview();
                        }
                    } else if (html.indexOf('noCaptcha')!=-1) {
                        jQuery('#pix_loader').fadeOut(100);
                        jQuery('#pix_unsuccess').fadeIn(100);
                        jQuery('.captchaCont',t).prevAll('label').eq(0).addClass('label_error');
                        jQuery('.recaptcha',t).click();
                    } else {
                        jQuery('#pix_loader').fadeOut(100);
                        jQuery('#pix_unsuccess').fadeIn(100);
                        jQuery('.pix_error').slideDown(100);
                    }
                }       
            });
            
            return false;
        }); 
    }); 
}

/******************************************************
*
*   Date picker
*
******************************************************/
function datePicker() {
    jQuery('.pix_contact_form').each(function () { 
        var t = jQuery(this); 
        if(jQuery.isFunction(jQuery.fn.datepicker)){      
            var dates = jQuery( "#from, #to", t ).datepicker({
                defaultDate: "+1w",
                changeMonth: false,
                numberOfMonths: 1,
                showOn: "both",
                buttonImage: forte_theme_dir+"/images/blank.gif",
                buttonImageOnly: true,
                onSelect: function( selectedDate ) {
                    var option = this.id == "from" ? "minDate" : "maxDate",
                        instance = jQuery( this ).data( "datepicker" ),
                        date = jQuery.datepicker.parseDate(
                            instance.settings.dateFormat ||
                            jQuery.datepicker._defaults.dateFormat,
                            selectedDate, instance.settings );
                    dates.not( this ).datepicker( "option", option, date );
                    jQuery(this).trigger('date_filled');
                }
            });
        }
    });
}


/******************************************************
*
*   Tabs
*
******************************************************/
function dateTabs() {
    if(jQuery('.pix_tabs').length!=0){
        jQuery( '.pix_tabs' ).each(function(){
            var aA = parseFloat(jQuery(this).attr('data-active'));
            jQuery( this ).tabs({
                icons: false,
                selected: aA-1
            });
        });
    }
}

/******************************************************
*
*   Accordions
*
******************************************************/
function initAccordions() {
    if(jQuery('.pix_accordion').length!=0){
        jQuery( '.pix_accordion' ).each(function(){
            var t = jQuery(this),
                aA = parseFloat(jQuery(this).attr('data-active'));
            if(aA==0){
                aA = 100000;
            }
            jQuery( this ).accordion({
                autoHeight: false,
                heightStyle: 'content',
                animated: 'easeOutQuart',
                duration: 400,
                navigation: false,
                collapsible: true,
                icons: false,
                header: 'a.header_accordion',
                active: aA-1,
                create: function(event, ui) {
                    t.find('.ui-state-active').addClass('ui-pix-state-active');
                }
            });
            jQuery(this).bind('accordionchangestart', function(event, ui) {
                ui.newHeader.addClass('ui-pix-state-active');
            });
            jQuery(this).bind('accordionchange', function(event, ui) {
                ui.oldHeader.removeClass('ui-pix-state-active');
            });
        });
    }
}

/******************************************************
*
*   Price tables
*
******************************************************/
function priceTables(){
    jQuery('.pix_price_table').each(function(){
        
        var t = jQuery(this),
            div = t.parents('*').eq(0),
            clone = t.clone().hide().addClass('cloned'),
            html = clone.html();
            
        clone.find('tr').remove();
        
        htmlS = html.replace(/\<tr\>/g,'').replace(/\<\/tr\>/g,'').replace(/\<td\>/g,'<tr><td>').replace(/\<\/td\>/g,'</tr></td>');
        
        clone.html(htmlS);
        
        t.after(clone);
        
        jQuery(window).bind('load resize',function(){
            var tdW = t.find('td:first').outerWidth();
            
            if ( tdW < 200 ) {
                t.css({
                    position: 'absolute',
                    visibility: 'hidden'
                });
                clone.show();
            } else {
                clone.hide();
                t.css({
                    position: 'relative',
                    visibility: 'visible'
                });
            }
        });
    });
}

/******************************************************
*
*   Price filter
*
******************************************************/
function initPriceFilter() {
    jQuery('.price_filter .select_wrap').each(function(){
        var t = jQuery(this),
            val_min = t.find('.widget_price_filter #min_price').val() == '' ? t.find('.widget_price_filter #min_price').attr('data-min') : t.find('.widget_price_filter #min_price').val(),
            val_max = t.find('.widget_price_filter #max_price').val() == '' ? t.find('.widget_price_filter #max_price').attr('data-max') : t.find('.widget_price_filter #max_price').val();

            price = woocommerce_price_slider_params.currency_symbol + " " + parseInt(val_min) + ' - ' + woocommerce_price_slider_params.currency_symbol + " " + parseInt(val_max);

        t.find('.fake_text').text(price);

        t.click(function(){
            t.find('.widget_price_filter').not('.visible')
                .show()
                .animate({
                    opacity: 0
                },0)
                .animate({
                    marginTop: 0,
                    opacity: 1
                },200,'easeInOutQuad',function(){
                    jQuery(this).addClass('visible');
                    priceFilterPos();
                });
        });

        t.on('click', '.close_el', function(e) {
            t.find('.widget_price_filter.visible').animate({
                marginTop: -10,
                opacity: 0
            },150,'easeInOutQuad',function(){
                jQuery(this).removeClass('visible').hide();
            });
        });

        jQuery('.price_slider',t).bind( "slide slidechange", function(event, ui) {
            price = woocommerce_price_slider_params.currency_symbol + " " + t.find('.widget_price_filter #min_price').val() + ' - ' + woocommerce_price_slider_params.currency_symbol + " " + t.find('.widget_price_filter #max_price').val();
            t.find('.fake_text').text(price);
        });
    });
}

function priceFilterPos() {
    jQuery('.price_filter .select_wrap .widget_price_filter.visible').each(function(){
        var t = jQuery(this),
            parent = t.parents('.select_wrap').eq(0),
            left = parseFloat(t.offset().left),
            wThis = parseFloat(t.outerWidth()),
            w = parseFloat(jQuery(window).width()),
            before = parent.find('.widget_price_filter.visible:before');

        if ( left < 10 ) {
            t.css({
                right: '-'+(73+Math.abs(left))+'px'
            }).addClass('moved');
        }  else {
            t.css({
                right: '-63px'
            }).removeClass('moved');
        }
    });
}

/******************************************************
*
*   Filter section and footer responsiveness
*
******************************************************/
function filterSectionSet() {
    jQuery('.filters_wrap').each(function(){
        var sum = 0;

        jQuery('.filter_box', this).each(function(){
            var wThis = parseFloat(jQuery(this).outerWidth());
            sum = parseFloat(sum+wThis);
        })

        jQuery(this).attr('data-width',sum);

        filterSectionResp();
    });

    jQuery('#pix_credits').each(function(){
        var sum = 0;

        jQuery('> .pix_column > div', this).each(function(){
            var wThis = parseFloat(jQuery(this).outerWidth());
            sum = parseFloat(sum+wThis);
        })

        jQuery(this).attr('data-width',sum);

        filterSectionResp();
    });
}

function filterSectionResp() {
    jQuery('.filters_wrap').each(function(){
        var dataW = parseFloat(jQuery(this).attr('data-width')),
            w = jQuery('> .pix_column_990', this).length ? jQuery('> .pix_column_990', this).width() : jQuery(this).width();
        if (dataW > w) {
            jQuery(this).find('.filter_box')
                .addClass('alignleft')
                .removeClass('alignright')
                .css({
                    clear: 'both',
                    margin: '2px 0'
                });
        } else {
            jQuery(this).find('.filter_box')
                .css({
                    clear: 'none',
                    margin: '0'
                });
            if (jQuery(this).find('.filter_box').length>1) {
                jQuery(this).find('.filter_box:last-child').addClass('alignright');
            }
        }
    });

    jQuery('#pix_credits').each(function(){
        var dataW = parseFloat(jQuery(this).attr('data-width')),
            w = jQuery('> .pix_column', this).width();
        if (dataW > w) {
            jQuery(this).find('> .pix_column > div')
                .addClass('alignleft')
                .removeClass('alignright')
                .css({
                    clear: 'both',
                    margin: '2px 0'
                });
        } else {
            jQuery(this).find('> .pix_column > div')
                .css({
                    clear: 'none',
                    margin: '0'
                });
            if (jQuery(this).find('.filter_box').length>1) {
                jQuery(this).find('> .pix_column > div:last-child').addClass('alignright');
            }
        }
    });
}

/******************************************************
*
*   Close elements
*
******************************************************/
function addCloseButtons() {
    jQuery('.el_to_close, .widget_price_filter').append('<span class="close_el" />');
}

/******************************************************
*
*   On sale ribbon
*
******************************************************/
function saleRibbonPosition(){
    jQuery('.onsale').each(function(){
        var t = jQuery(this),
            w = parseFloat(t.outerWidth()),
            h = parseFloat(t.outerHeight());
        t.css({
            marginTop: '-'+h+'px',
            marginRight: '-'+(Math.floor( w-( w/Math.sqrt(2) ))+(Math.round(h*0.5)))+'px'
        });
    });
}
jQuery(function(){
    jQuery('.onsale').click(function(){
        saleRibbonPosition();
    });
});

/********************************
*
*   Share section
*
********************************/
function shareSection(){
    jQuery('a.pix_social_share').each(function(){
        var t = jQuery(this),
            w = t.attr('data-width'),
            h = t.attr('data-height');
        if ( h == '' ) {
            h = 500;
        }
        if ( w == '' ) {
            w = 500;
        }
        t.popupWindow({ 
        centerBrowser:1,
        width:w,
        height:h
        });
    });
}

/********************************
*
*   Number of products in the cart
*
********************************/
function appendAmountProducts(){
    jQuery('.widget_shopping_cart').each(function(){
        var idPar = jQuery(this).parents('div').eq(0).attr('id');
        if ( jQuery('div[data-sidebar="'+idPar+'"]').length && !jQuery('div[data-sidebar="'+idPar+'"] .amount_appended').length ) {
            jQuery('div[data-sidebar="'+idPar+'"]').append('<div class="amount_appended"><span></span></div>');
        }
    });
    jQuery('.aside_content > div').each(function(){
        if ( !jQuery.trim( jQuery(this).html() ) ) {
            var id = jQuery(this).attr('id');
            jQuery('div[data-sidebar="'+id+'"]').hide();
        }
    });
}

function quantProductList(){
    jQuery('.widget_shopping_cart').each(function(){
        var idPar = jQuery(this).parents('div').eq(0).attr('id'),
            quant = 0;
        jQuery('.quantity',this).each(function(){
            quant = quant + parseFloat(jQuery(this).text());
        });
        if ( jQuery('div[data-sidebar="'+idPar+'"] .amount_appended').length ) {
            jQuery('div[data-sidebar="'+idPar+'"] .amount_appended').text(quant);
            if ( quant != 0 ) {
                jQuery('div[data-sidebar="'+idPar+'"] .amount_appended').not(':visible').fadeIn();
            } else {
                jQuery('div[data-sidebar="'+idPar+'"] .amount_appended:visible').fadeOut();
            }
        }
    });

}

function quantProductChange(){
    //plus minus buttons on cart
    jQuery( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );
    jQuery( 'div.quantity, td.quantity' ).each(function(){
        var $quant = jQuery(this),
            $numb = jQuery('input[type="number"]', $quant),
            $plus = jQuery('.plus', $quant),
            $minus = jQuery('.minus', $quant),
            val;

        $plus.on('click', function(){
            val = parseFloat($numb.val());
            val = val + 1;
            $numb.val(val);
        });

        $minus.on('click', function(){
            val = parseFloat($numb.val()) > 1 ? parseFloat($numb.val()) : 2;
            $numb.val(val-1);
        });
    });
}

/********************************
*
*   Zoom effect plus ColorBox
*
********************************/
function zoomPlusColorbox(){
    jQuery('.colorbox-gallery').on('click','a:not(".hidden_div")',function(){
        eval('var rel = {' + jQuery(this).attr('rel') + '}');
        var useZoom = rel['useZoom'],
            smallImage = rel['smallImage'],
            href = jQuery(this).attr('href');
        jQuery('#'+useZoom).attr('href',href);
        jQuery('#'+useZoom+' img').attr('src',smallImage);
        jQuery('.colorbox-gallery a').removeClass('zoomSelected');
        jQuery(this).addClass('zoomSelected');
        return false;   
    });

    jQuery(document).on('click','a.fake-colorbox',function(){
        var href = jQuery(this).attr('href');
        jQuery('.thumbnails a.hidden_div[href="'+href+'"]').click();
        return false;
    });

    var set;

    jQuery('form.variations_form').bind('change',function(){
        clearTimeout(set);
        set = setTimeout(function(){
            var href = jQuery('a[itemprop="image"]').attr('href');
            jQuery('a.fake-colorbox').attr('href',href);
            jQuery('a.fake.colorbox').attr('href',href);
            jQuery('.thumbnails div[data-href!="'+href+'"]').addClass('display_none');
            jQuery('.thumbnails div[data-href!="'+href+'"] a').removeClass('cboxElement');
            jQuery('.thumbnails div[data-href="'+href+'"]').removeClass('display_none');
            pixInitColorbox();
            jQuery('.thumbnails div[data-href="'+href+'"] a[href="'+href+'"]:visible').click();
        },50);
    });
    jQuery('form.variations_form').bind('reset_image',function(){
        clearTimeout(set);
        set = setTimeout(function(){
            var href = jQuery('a[itemprop="image"]').attr('href');
            jQuery('a.fake-colorbox').attr('href',href);
            jQuery('a.fake.colorbox').attr('href',href);
            jQuery('.thumbnails div[data-href!="'+href+'"]').addClass('display_none');
            jQuery('.thumbnails div[data-href!="'+href+'"] a').removeClass('cboxElement');
            jQuery('.thumbnails div[data-href="'+href+'"]').removeClass('display_none');
            pixInitColorbox();
            jQuery('.thumbnails div[data-href="'+href+'"] a[href="'+href+'"]:visible').click();
        },50);
    });

}


function pixUpdateChackout(){
    jQuery('body').bind('updated_checkout',function(){
        jQuery('form.checkout .payment_box').each(function(){
            if(!jQuery('.arrow_up',this).length){
                jQuery(this).prepend('<div class="arrow_up" />');
            }
        });
    });
}


//////////////////////////////////////////////////////////////////////////////////
// Cloud Zoom V1.0.2
// (c) 2010 by R Cecco. <http://www.professorcloud.com>
// MIT License
//
// Please retain this copyright header in all versions of the software
//////////////////////////////////////////////////////////////////////////////////
function initCloudZoom(){
    var set;
    jQuery('.cloud-zoom, .cloud-zoom-gallery').click(function(event) {
        event.preventDefault();
    }).CloudZoom();
    jQuery('form.variations_form').bind('change',function(){
        clearTimeout(set);
        set = setTimeout(function(){
            var href = jQuery('#zoom1').attr('href');
            if ( jQuery('.thumbnails a[href="'+href+'"]:visible').length ) {
                jQuery('.thumbnails a[href="'+href+'"]:visible').click();
            } else {
                jQuery('.cloud-zoom').each(function() {
                    jQuery('.mousetrap').remove();
                    jQuery(this).CloudZoom();
                });
            }
        },10);
    });
    /*jQuery('form.variations_form').bind('reset_image',function(){
        clearTimeout(set);
        set = setTimeout(function(){
            var href = jQuery('#zoom1').attr('href');
            if ( jQuery('.thumbnails a[href="'+href+'"]:visible').length ) {
                jQuery('.thumbnails a[href="'+href+'"]:visible').click();
            } else {
                jQuery('.cloud-zoom').each(function() {
                    jQuery(this).data('zoom').destroy();
                    jQuery(this).CloudZoom();
                });
            }
        },10);
    });*/
    
}

(function ($) {

    function format(str) {
        for (var i = 1; i < arguments.length; i++) {
            str = str.replace('%' + (i - 1), arguments[i]);
        }
        return str;
    }

    function CloudZoom(jWin, opts) {
        var sImg = $('img', jWin);
        var img1;
        var img2;
        var zoomDiv = null;
        var $mouseTrap = null;
        var lens = null;
        var $tint = null;
        var softFocus = null;
        var $ie6Fix = null;
        var zoomImage;
        var controlTimer = 0;      
        var cw, ch;
        var destU = 0;
        var destV = 0;
        var currV = 0;
        var currU = 0;      
        var filesLoaded = 0;
        var mx,
            my; 
        var ctx = this, zw;
        // Display an image loading message. This message gets deleted when the images have loaded and the zoom init function is called.
        // We add a small delay before the message is displayed to avoid the message flicking on then off again virtually immediately if the
        // images load really fast, e.g. from the cache. 
        //var   ctx = this;
        /*setTimeout(function () {
            //                       <img src="/images/loading.gif"/>
            if ($mouseTrap === null) {
                var w = jWin.width();
                jWin.parent().append(format('<div style="width:%0px;position:absolute;top:75%;left:%1px;text-align:center" class="cloud-zoom-loading" >Loading...</div>', w / 3, (w / 2) - (w / 6))).find(':last').css('opacity', 0.5);
            }
        }, 200);*/


        var ie6FixRemove = function () {

            if ($ie6Fix !== null) {
                $ie6Fix.remove();
                $ie6Fix = null;
            }
        };

        // Removes cursor, tint layer, blur layer etc.
        this.removeBits = function () {
            //$mouseTrap.unbind();
            if (lens) {
                lens.remove();
                lens = null;             
            }
            if ($tint) {
                $tint.remove();
                $tint = null;
            }
            if (softFocus) {
                softFocus.remove();
                softFocus = null;
            }
            ie6FixRemove();

            $('.cloud-zoom-loading', jWin.parent()).remove();
        };


        this.destroy = function () {
            jWin.data('zoom', null);

            if ($mouseTrap) {
                $mouseTrap.unbind();
                $mouseTrap.remove();
                $mouseTrap = null;
            }
            if (zoomDiv) {
                zoomDiv.remove();
                zoomDiv = null;
            }
            //ie6FixRemove();
            this.removeBits();
            // DON'T FORGET TO REMOVE JQUERY 'DATA' VALUES
        };


        // This is called when the zoom window has faded out so it can be removed.
        this.fadedOut = function () {
            
            if (zoomDiv) {
                zoomDiv.remove();
                zoomDiv = null;
            }
             this.removeBits();
            //ie6FixRemove();
        };

        this.controlLoop = function () {
            
            if (lens) {
                var x = (mx - sImg.offset().left - (cw * 0.5)) >> 0;
                var y = (my - sImg.offset().top - (ch * 0.5)) >> 0;
                
               
                if (x < 0) {
                    x = 0;
                }
                else if (x > (sImg.outerWidth() - cw)) {
                    x = (sImg.outerWidth() - cw);
                }
                if (y < 0) {
                    y = 0;
                }
                else if (y > (sImg.outerHeight() - ch)) {
                    y = (sImg.outerHeight() - ch);
                }

                lens.css({
                    left: x,
                    top: y
                });

                lens.css('background-position', (-x) + 'px ' + (-y) + 'px');

                destU = (((x) / sImg.outerWidth()) * zoomImage.width) >> 0;
                destV = (((y) / sImg.outerHeight()) * zoomImage.height) >> 0;
                currU += (destU - currU) / opts.smoothMove;
                currV += (destV - currV) / opts.smoothMove;

                zoomDiv.css('background-position', (-(currU >> 0) + 'px ') + (-(currV >> 0) + 'px'));              
            }
            controlTimer = setTimeout(function () {
                ctx.controlLoop();
            }, 30);
        };

        this.init2 = function (img, id) {

            filesLoaded++;
            if (id === 1) {
                zoomImage = img;
            }
            //this.images[id] = img;
            if (filesLoaded === 2) {
                this.init();
            }
        };

        /* Init function start.  */
        this.init = function () {
            // Remove loading message (if present);
            $('.cloud-zoom-loading', jWin.parent()).remove();


/* Add a box (mouseTrap) over the small image to trap mouse events.
        It has priority over zoom window to avoid issues with inner zoom.
        We need the dummy background image as IE does not trap mouse events on
        transparent parts of a div.
        */
            $mouseTrap = jWin.parent().append(format("<div class='mousetrap' style='background-image:url(\".\");z-index:999;position:absolute;width:%0px;height:%1px;left:%2px;top:%3px;\'></div>", sImg.outerWidth(), sImg.outerHeight(), 0, 0)).find(':last');

            // Detect device type, normal mouse or touchy(ipad android) by albanx
            var touchy=("ontouchstart" in document.documentElement)?true:false;
            var m_move='touchmove mousemove';
            var m_end='touchend mouseleave';
            var m_ent='touchstart mouseenter';
            //////////////////////////////////////////////////////////////////////          
            /* Do as little as possible in mousemove event to prevent slowdown. */
            
            $mouseTrap.bind(m_move, this, function (e) {
                // Just update the mouse position         
                mx=( typeof(e.originalEvent.touches) !='undefined')?
                        e.originalEvent.touches[0].pageX:e.pageX;
                my=( typeof(e.originalEvent.touches) !='undefined')?
                        e.originalEvent.touches[0].pageY:e.pageY;
            });
            //////////////////////////////////////////////////////////////////////                  
            $mouseTrap.bind(m_end, this, function (event) {
                clearTimeout(controlTimer);
                //event.data.removeBits();                
                if(lens) { lens.fadeOut(299); }
                if($tint) { $tint.fadeOut(299); }
                if(softFocus) { softFocus.fadeOut(299); }
                zoomDiv.fadeOut(300, function () {
                    ctx.fadedOut();
                });                                                             
                return false;
            });
            //////////////////////////////////////////////////////////////////////          
            $mouseTrap.bind(m_ent, this, function (event) {
                if(touchy)//i consider only one touches for zooming
                {
                    event.preventDefault();
                }
                mx=( typeof(event.originalEvent.touches) !='undefined')?
                        event.originalEvent.touches[0].pageX:event.pageX;
                my=( typeof(event.originalEvent.touches) !='undefined')?
                        event.originalEvent.touches[0].pageY:event.pageY;
                        
                zw = event.data;
                if (zoomDiv) {
                    zoomDiv.stop(true, false);
                    zoomDiv.remove();
                }

                var xPos = opts.adjustX,
                    yPos = opts.adjustY;
                             
                var siw = sImg.outerWidth();
                var sih = sImg.outerHeight();

                var w = opts.zoomWidth;
                var h = opts.zoomHeight;
                if (opts.zoomWidth == 'auto') {
                    w = siw;
                }
                if (opts.zoomHeight == 'auto') {
                    h = sih;
                }
                //$('#info').text( xPos + ' ' + yPos + ' ' + siw + ' ' + sih );
                var appendTo = jWin.parent(); // attach to the wrapper          
                switch (opts.position) {
                case 'top':
                    yPos -= h; // + opts.adjustY;
                    break;
                case 'right':
                    xPos += siw; // + opts.adjustX;                 
                    break;
                case 'bottom':
                    yPos += sih; // + opts.adjustY;
                    break;
                case 'left':
                    xPos -= w; // + opts.adjustX;                   
                    break;
                case 'inside':
                    w = siw;
                    h = sih;
                    break;
                    // All other values, try and find an id in the dom to attach to.
                default:
                    appendTo = $('#' + opts.position);
                    // If dom element doesn't exit, just use 'right' position as default.
                    if (!appendTo.length) {
                        appendTo = jWin;
                        xPos += siw; //+ opts.adjustX;
                        yPos += sih; // + opts.adjustY; 
                    } else {
                        w = appendTo.innerWidth();
                        h = appendTo.innerHeight();
                    }
                }

                zoomDiv = appendTo.append(format('<div id="cloud-zoom-big" class="cloud-zoom-big" style="display:none;position:absolute;left:%0px;top:%1px;width:%2px;height:%3px;background-image:url(\'%4\');z-index:99;"></div>', xPos, yPos, w, h, zoomImage.src)).find(':last');
                
                // Add the title from title tag.
                if (sImg.attr('title') && opts.showTitle) {
                    zoomDiv.append(format('<div class="cloud-zoom-title">%0</div>', sImg.attr('title'))).find(':last').css('opacity', opts.titleOpacity);
                }

                // Fix ie6 select elements wrong z-index bug. Placing an iFrame over the select element solves the issue...     
                if ($.browser.msie && $.browser.version < 7) {
                    $ie6Fix = $('<iframe frameborder="0" src="#"></iframe>').css({
                        position: "absolute",
                        left: xPos,
                        top: yPos,
                        zIndex: 99,
                        width: w,
                        height: h
                    }).insertBefore(zoomDiv);
                }

                zoomDiv.fadeIn(500);

                if (lens) {
                    lens.remove();
                    lens = null;
                } /* Work out size of cursor */
                cw = (sImg.outerWidth() / zoomImage.width) * zoomDiv.width();
                ch = (sImg.outerHeight() / zoomImage.height) * zoomDiv.height();

                // Attach mouse, initially invisible to prevent first frame glitch
                lens = jWin.append(format("<div class = 'cloud-zoom-lens' style='display:none;z-index:98;position:absolute;width:%0px;height:%1px;'></div>", cw, ch)).find(':last');

                $mouseTrap.css('cursor', lens.css('cursor'));

                var noTrans = false;

                // Init tint layer if needed. (Not relevant if using inside mode)           
                if (opts.tint) {
                    lens.css('background', 'url("' + sImg.attr('src') + '")');
                    $tint = jWin.append(format('<div style="display:none;position:absolute; left:0px; top:0px; width:%0px; height:%1px; background-color:%2;" />', sImg.outerWidth(), sImg.outerHeight(), opts.tint)).find(':last');
                    $tint.css('opacity', opts.tintOpacity);                    
                    noTrans = true;
                    $tint.fadeIn(500);

                }
                if (opts.softFocus) {
                    lens.css('background', 'url("' + sImg.attr('src') + '")');
                    softFocus = jWin.append(format('<div style="position:absolute;display:none;top:2px; left:2px; width:%0px; height:%1px;" />', sImg.outerWidth() - 2, sImg.outerHeight() - 2, opts.tint)).find(':last');
                    softFocus.css('background', 'url("' + sImg.attr('src') + '")');
                    softFocus.css('opacity', 0.5);
                    noTrans = true;
                    softFocus.fadeIn(500);
                }

                if (!noTrans) {
                    lens.css('opacity', opts.lensOpacity);                                      
                }
                if ( opts.position !== 'inside' ) { lens.fadeIn(500); }

                // Start processing. 
                zw.controlLoop();

                return; // Don't return false here otherwise opera will not detect change of the mouse pointer type.
            });
        };

        img1 = new Image();
        $(img1).load(function () {
            ctx.init2(this, 0);
        });
        img1.src = sImg.attr('src');

        img2 = new Image();
        $(img2).load(function () {
            ctx.init2(this, 1);
        });
        img2.src = jWin.attr('href');
    }

    $.fn.CloudZoom = function (options) {
        // IE6 background image flicker fix
        try {
            document.execCommand("BackgroundImageCache", false, true);
        } catch (e) {}
        this.each(function () {
            var relOpts, opts;
            // Hmm...eval...slap on wrist.
            eval('var   a = {' + $(this).attr('rel') + '}');
            relOpts = a;
            if ($(this).is('.cloud-zoom')) {
                $(this).css({
                    'position': 'relative',
                    'display': 'block'
                });
                $('img', $(this)).css({
                    'display': 'block'
                });
                // Wrap an outer div around the link so we can attach things without them becoming part of the link.
                // But not if wrap already exists.
                if ($(this).parent().attr('id') != 'wrap') {
                    $(this).wrap('<div id="wrap" style="top:0px;z-index:1;position:relative;"></div>');
                }
                opts = $.extend({}, $.fn.CloudZoom.defaults, options);
                opts = $.extend({}, opts, relOpts);
                $(this).data('zoom', new CloudZoom($(this), opts));
                
            } else if ($(this).is('.cloud-zoom-gallery')) {
                opts = $.extend({}, relOpts, options);
                $(this).data('relOpts', opts);
                var t = $(this);
                t.bind('touchstart click', t, function (event) {
                    var data = event.data.data('relOpts');
                    // Destroy the previous zoom
                    $('#' + data.useZoom).data('zoom').destroy();
                    // Change the biglink to point to the new big image.
                    $('#' + data.useZoom).attr('href', event.data.attr('href'));
                    // Change the small image to point to the new small image.
                    $('#' + data.useZoom + ' img').attr('src', event.data.data('relOpts').smallImage);
                    $('.fake-colorbox').attr('href', event.data.attr('href'));
                    // Init a new zoom with the new images.             
                    $('#' + event.data.data('relOpts').useZoom).CloudZoom();
                    $('.cloud-zoom-gallery').removeClass('zoomSelected');
                    t.addClass('zoomSelected');
                    return false;
                });
            }
        });
        return this;

    };

    $.fn.CloudZoom.defaults = {
        zoomWidth: 'auto',
        zoomHeight: 'auto',
        position: 'right',
        tint: false,
        tintOpacity: 0.5,
        lensOpacity: 0.5,
        softFocus: false,
        smoothMove: 3,
        showTitle: true,
        titleOpacity: 0.5,
        adjustX: 0,
        adjustY: 0
    };

})(jQuery);

/******************************************************
*
*   Background fixes in IE8
*
******************************************************/
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
function bgOpacityIEfix() {
    if (jQuery.browser.msie && jQuery.browser.version < 9) {
        jQuery('.pix_edited_text[data-style*="rgba"]').each(function(){
            var rgb = rgb2hex(jQuery(this).attr('data-style'));
            jQuery(this).css({
                backgroundColor: rgb
            });
        });

        jQuery('.pix_cover').each(function(){
            var t = jQuery(this),
                dataSrc = t.css('background-image').replace(/url\([\'"](.*?)[\'"]\)/g,'$1').replace(/url\((.*?)\)/g,'$1');
            t.css('background-image','').append('<img src="' + dataSrc + '" />');
            jQuery('<img />').load( function(){
                var w = t.outerWidth(),
                    h = t.outerHeight(),
                    img = t.find('img'),
                    imgW = img.naturalWidth(),
                    imgH = img.naturalHeight();
                img.css({
                    maxWidth: 'none',
                    position: 'absolute'
                });
                if((imgW/imgH)>(w/h)) {
                    var r = h / imgH;
                    var d = (w - (imgW*r))*0.5;
                    img.css({
                        'height' : h,
                        'margin-left' : d+'px',
                        'margin-right' : d+'px',
                        'margin-top' : 0,
                        'position' : 'absolute',
                        'visibility' : 'visible',
                        'width' : imgW*r
                    });
                } else {
                    var r = w / imgW;
                    var d = (h - (imgH*r))*0.5;
                    img.css({
                        'height' : imgH*r,
                        'margin-left' : 0,
                        'margin-right' : 0,
                        'margin-top' : d+'px',
                        'position' : 'absolute',
                        'visibility' : 'visible',
                        'width' : w
                    });
                }
            }).attr('src', dataSrc);

            jQuery(window).bind('resize', function(){
                var w = t.outerWidth(),
                    h = t.outerHeight(),
                    img = t.find('img'),
                    imgW = img.naturalWidth(),
                    imgH = img.naturalHeight();
                img.css({
                    maxWidth: 'none',
                    position: 'absolute'
                });
                if((imgW/imgH)>(w/h)) {
                    var r = h / imgH;
                    var d = (w - (imgW*r))*0.5;
                    img.css({
                        'height' : h,
                        'margin-left' : d+'px',
                        'margin-right' : d+'px',
                        'margin-top' : 0,
                        'position' : 'absolute',
                        'visibility' : 'visible',
                        'width' : imgW*r
                    });
                } else {
                    var r = w / imgW;
                    var d = (h - (imgH*r))*0.5;
                    img.css({
                        'height' : imgH*r,
                        'margin-left' : 0,
                        'margin-right' : 0,
                        'margin-top' : d+'px',
                        'position' : 'absolute',
                        'visibility' : 'visible',
                        'width' : w
                    });
                }
            });
        });

    }
}

/******************************************************
*
*   Loading effect for images
*
******************************************************/
function isScrolledIntoView(elem) {
    var docViewTop = jQuery(window).scrollTop();
    var docViewBottom = docViewTop + jQuery(window).height();

    var elemTop = jQuery(elem).offset().top;
    var elemBottom = elemTop + jQuery(elem).height();

    return ((elemBottom >= docViewTop && elemBottom <= docViewBottom ) || (elemTop <= docViewBottom && elemTop >= docViewTop));
}
function initPixImages() {
    if (!(jQuery.browser.msie && jQuery.browser.version < 9)) {
        jQuery('#content img').not('.iclflag, .pixImageLoaded, .ajax-loader, .ajax-loading').each(function(){
            if (!jQuery(this).parents('.pix_slideshow').length && !jQuery(this).parents('.pix_wall').length && isScrolledIntoView(jQuery(this))){
                var t = jQuery(this).css({opacity:0}),
                    ind = jQuery(this).index('#content img');
                t.delay(50*ind).load(function(){
                    t.css({visibility:'visible'}).animate({opacity:1},500).addClass('pixImageLoaded');
                }).each(function() {
                    if(this.complete) jQuery(this).load();
                });
            }
        });
    }
}


/******************************************************
*
*   IE8 Flowplayer size
*
******************************************************/
function ie_fp_size() {
    jQuery('.flow_player').each(function(){
        var t = jQuery(this),
            ratio = parseFloat(t.attr('data-ratio')),
            w = parseFloat(t.outerWidth());
        t.css({
            height: w*ratio
        });
    });
}


/******************************************************
*
*   a tags around images
*
******************************************************/
function a_tags_wrapper() {
    jQuery('a > img').each(function(){
        var t = jQuery(this),
            a = t.parents('a').eq(0),
            tClass = t.attr('class');
        if ( typeof tClass !== 'undefined' && tClass !== false && !a.hasClass('letmebe') ) {
            if ( tClass.indexOf('alignleft')!=-1 ) {
                a.addClass('alignleft');
            } else if ( tClass.indexOf('alignright')!=-1 ) {
                a.addClass('alignright');
            } else if ( tClass.indexOf('aligncenter')!=-1 ) {
                a.addClass('aligncenter');
            } else if ( tClass.indexOf('alignnone')!=-1 ) {
                a.addClass('alignnone');
            }
        }
    });
}


/******************************************************
*
*   Demo store message
*
******************************************************/
function pix_demo_store() {
    if(jQuery('.demo_store').length){
        var h = jQuery('.demo_store').outerHeight(),
            pos = jQuery('header[data-height]').css('position');
        jQuery('#content_wrap, aside.toggleAside').css({
            top: h
        });
        if ( pos == 'fixed' ) {
            jQuery('header[data-height]').css({top:h});
        } else {
            jQuery('header[data-height]').css({top:0});
        }
    }
}


/******************************************************
*
*   Init everything
*
******************************************************/

jQuery(document).ready(function(){
    pix_demo_store();
    pixMepHeight();
    a_tags_wrapper();
    initPixImages();
    preShortcodes();
    canvasLoader();
    removeImgAtts();
    smoothScroll();
    slidingSidebars();
    scrollButtons();
    initPixSlideshows();
    dropDownMenu();
    fakeSelect();
    forteHeader();
    advancedSearch();
    forteTooltips();
    initScrollPane();
    headerFxIn();
    pixIframeHeight();
    selectMenu();
    pixOverlayImage();
    pixJPlayerInit();
    initMasonry();
    loadNextData();
    wcOrdering();
    initFlowPlayer();
    ajaxForm();
    datePicker();
    dateTabs();
    initAccordions();
    initPriceFilter();
    filterSectionSet();
    priceTables();
    saleRibbonPosition();
    shareSection();
    appendAmountProducts();
    quantProductList();
    quantProductChange();
    zoomPlusColorbox();
    pixUpdateChackout();
    initCloudZoom();
    excerptTruncate();
    bgOpacityIEfix();
    ie_fp_size();
    jQuery('input[placeholder], textarea[placeholder]').placeholder();
    jQuery('body').ajaxSuccess(function() {
        a_tags_wrapper();
        initPixImages();
        fakeSelect();
        pixOverlayImage();
        removeImgAtts();
        initMasonry();
        pixMepHeight();
        pixOverlayImage();
        pixInitColorbox();
        pixGridFolio();
        initPixSlideshows();
        excerptTruncate();
        saleRibbonPosition();
        pix_demo_store();
        pixWallEffect();
        quantProductList();
        jQuery('input[placeholder], textarea[placeholder]').placeholder();
    });
    jQuery('body').bind('cart_widget_refreshed added_to_cart',function(){
        a_tags_wrapper();
        initPixImages();
        quantProductList();
    });
    jQuery('.slide_testimonials').each(function(){
        var t = jQuery(this);
        t.css({
            height: jQuery('li',t).eq(0).actual('outerHeight', { includeMargin : true })
        });
        t.cycle({
            slides: '> li',
            autoHeight: -1,
            timeout: 10000,
            speed: 500
        });
        t.on( 'cycle-before', function( event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag ) {
            t.animate({
                height: jQuery(incomingSlideEl).actual('outerHeight', { includeMargin : true })
            },250);
        });
    });
    jQuery('.slide_tweets').each(function(){
        var t = jQuery(this);
        t.css({
            height: jQuery('li',t).eq(0).actual('outerHeight', { includeMargin : true })
        });
        t.cycle({
            slides: '> li',
            autoHeight: -1,
            timeout: 7000,
            speed: 500,
            fx: 'scrollHorz'
        });
        t.on( 'cycle-before', function( event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag ) {
            t.animate({
                height: jQuery(incomingSlideEl).actual('outerHeight', { includeMargin : true })
            },250);
        });
    });
});

jQuery(window).bind('load',function(){
    pix_demo_store();
    closeSlidingSidebars();
    displayScrollButtons();
    fakeSelect();
    headerScrollResize();
    pixInitColorbox();
    pixGridFolio(); 
    addCloseButtons();
    pixWallEffect();
    ie_fp_size();
    quantProductList();
    removeImgAtts();
    var set = setTimeout(function(){quantProductList()},1000);
    jQuery('.slide_testimonials, .slide_tweets').each(function(){
        var t = jQuery(this);
        t.css({
            height: jQuery('li:visible',t).actual('outerHeight', { includeMargin : true })
        });
    });
});

jQuery(window).bind('scroll',function(){
    initPixImages();
    displayScrollButtons();
    headerScrollResize();
});

jQuery(window).bind('resize',function(){
    pix_demo_store();
    initPixImages();
    displayScrollButtons();
    headerScrollResize();
    adjustScrollPane();
    pixGridFolio();
    filterSectionResp();
    priceFilterPos();
    initPixSlideshows();
    ie_fp_size();
    jQuery('.slide_testimonials').each(function(){
        var t = jQuery(this);
        t.css({
            height: jQuery('li:visible',t).actual('outerHeight', { includeMargin : true })
        });
    });
});