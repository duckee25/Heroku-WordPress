(function($) {

    $(document).ready(function() {

        /*-----------------------------------------------------------------------------------*/
        /* Load nicely and center
        /*-----------------------------------------------------------------------------------*/
        $('.sdw-cover-area').imagesLoaded().always(function(instance) {
            sdw_cover_center();
        });

        $('.sdw-featured-area').imagesLoaded().always(function(instance) {
            $('.sdw-featured-area').animate({
                opacity: 1
            }, 400);
        });

        /*-----------------------------------------------------------------------------------*/
        /* Navigation hover
        /*-----------------------------------------------------------------------------------*/

        $(".site-header .nav-menu li").hover(function() {
            $(this).find('ul:first').fadeIn(200);
        }, function() {
            $(this).find('ul:first').fadeOut(200);
        });


        /*-----------------------------------------------------------------------------------*/
        /* Fit Vids
        /*-----------------------------------------------------------------------------------*/
        $(".meta-media").fitVids();


        /*-----------------------------------------------------------------------------------*/
        /* Navigation icons control
        /*-----------------------------------------------------------------------------------*/
        $('.sdw-nav-search a, .sdw-nav-social a').on('click', function(e) {
            e.preventDefault();
            var $i = $(this).find('i');
            if ($i.hasClass('fa-times')) {
                sdw_nav_show($i);
            } else {
                sdw_nav_hide($i);
            }

        });


        /*-----------------------------------------------------------------------------------*/
        /* Initialize magnific pop-up
        /*-----------------------------------------------------------------------------------*/

        sdw_popup_image($('#primary'));
        sdw_popup_gallery($('#primary'));


        /*-----------------------------------------------------------------------------------*/
        /* Sticky Sidebar
        /*-----------------------------------------------------------------------------------*/

        $('#content').imagesLoaded().always(function(instance) {
            sticky_sidebar();
        });

        $('body').on('keydown', function(e) {
            if (e.which == 35) {
                $(this).click();
            }
            if (e.which == 36) {
                $(this).click();
            }
        });

        $(window).bind('resize', function() {
            if ($(window).width() < 1024) {
                $('.sdw-sid-left .sidebar').insertAfter('#primary');
            } else {
                $('.sdw-sid-left .sidebar').insertBefore('#primary');
            }
            sticky_sidebar();
            sdw_logo();
            sdw_cover_center();
        });

        if ($(window).width() < 1024 && $('.sdw-sid-left .sidebar').length) {
            $('.sdw-sid-left .sidebar').insertAfter('#primary');
        } else {
            $('.sdw-sid-left .sidebar').insertBefore('#primary');
        }


        /*-----------------------------------------------------------------------------------*/
        /* Owl Carousel
        /*-----------------------------------------------------------------------------------*/

        sdw_js_settings.rtl_mode = $.parseJSON(sdw_js_settings.rtl_mode);

        $('.sdw-post-slider').owlCarousel({
            loop: true,
            nav: true,
            autoWidth: false,
            rtl: sdw_js_settings.rtl_mode,
            center: true,
            fluidSpeed: 100,
            items: 1,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                    autoWidth: false
                }
            }
        });

        if ($('body').hasClass('sdw-sid-none')) {
            var fa_items = 2;
        } else {
            var fa_items = 3;
        }

        $('.sdw-featured-area').owlCarousel({
            loop: true,
            nav: true,
            autoWidth: false,
            rtl: sdw_js_settings.rtl_mode,
            autoplay: (sdw_js_settings.lay_fa_autoplay === "true"),
            autoplaySpeed: 400,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            center: false,
            fluidSpeed: 100,
            margin: 20,
            items: fa_items,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                    autoWidth: false,
                    nav: true
                },
                650: {
                    items: 2,
                    autoWidth: false
                },
                960: {
                    items: fa_items,
                    autoWidth: false
                }

            }
        });

        sdw_slide_gallery($('#primary'));

        function sdw_slide_gallery($obj) {
            $obj.find('.gallery-columns-1').owlCarousel({
                loop: true,
                nav: true,
                autoWidth: false,
                rtl: sdw_js_settings.rtl_mode,
                center: false,
                fluidSpeed: 100,
                margin: 0,
                items: 1,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
            });
        }    
       

        /*-----------------------------------------------------------------------------------*/
        /* Sticky Header
        /*-----------------------------------------------------------------------------------*/

        if (sdw_js_settings.sticky_header) {

            $('.site-header').clone(true, true).addClass('sdw-sticky-clone').insertAfter('.site-header');
            $('.sdw-sticky-clone').removeAttr('id', 'none');

            $(window).scroll(function() {
                var topwin = $(window).scrollTop();
                if (topwin >= sdw_js_settings.sticky_header_offset) {
                    $("body").addClass("sdw-sticky-show");
                } else {
                    $("body").removeClass("sdw-sticky-show");
                }
            });
        }


        /*-----------------------------------------------------------------------------------*/
        /* Load more button handler
        /*-----------------------------------------------------------------------------------*/

        var sdw_load_ajax_new_count = 0;

        $("body").on('click', '.sdw-load-more a', function(e) {
            e.preventDefault();
            var $link = $(this);
            var page_url = $link.attr("href");
            $link.addClass('sdw-loader-active');
            $('.sdw-loader').show();
            $("<div>").load(page_url, function() {
                var n = sdw_load_ajax_new_count.toString();
                var $wrap = $('.site-main');
                var $new = $(this).find('.sdw-post').addClass('sdw-new-' + n);
                var $this_div = $(this);

                $new.imagesLoaded(function() {

                    $new.hide().appendTo($wrap).fadeIn(400);

                    sdw_popup_image($new);
                    sdw_popup_gallery($new);
                    sdw_slide_gallery($new);

                    if ($this_div.find('.sdw-load-more').length) {
                        $('.sdw-load-more').html($this_div.find('.sdw-load-more').html());
                        $('.sdw-loader').hide();
                        $link.removeClass('sdw-loader-active');
                    } else {
                        $('.sdw-load-more').fadeOut('fast').remove();
                    }


                    if (page_url != window.location) {
                        window.history.pushState({
                            path: page_url
                        }, '', page_url);
                    }

                    sdw_load_ajax_new_count++;

                    return false;
                });

            });

        });

        /*-----------------------------------------------------------------------------------*/
        /* Infinite scroll handler
        /*-----------------------------------------------------------------------------------*/
        var sdw_infinite_allow = true;
        if ($('.sdw-infinite-scroll').length) {
            $(window).scroll(function() {
                //console.log('top: ' + $(this).scrollTop());
                ///console.log('inf: ' + ( $('.sdw-infinite-scroll').offset().top - $(this).height() ) );
                if (sdw_infinite_allow && $('.sdw-infinite-scroll').length && ($(this).scrollTop() > ($('.sdw-infinite-scroll').offset().top) - $(this).height() - 200)) {
                    var $link = $('.sdw-infinite-scroll a');
                    var page_url = $link.attr("href");
                    if (page_url != undefined) {

                        sdw_infinite_allow = false;

                        $('.sdw-loader').show();
                        $("<div>").load(page_url, function() {
                            var n = sdw_load_ajax_new_count.toString();
                            var $wrap = $('.site-main')
                            var $new = $(this).find('.sdw-post').addClass('sdw-new-' + n);
                            var $this_div = $(this);

                            $new.imagesLoaded(function() {
                                $new.hide().appendTo($wrap).fadeIn(400);

                                sdw_popup_image($new);
                                sdw_popup_gallery($new);
                                sdw_slide_gallery($new);

                                if ($this_div.find('.sdw-infinite-scroll').length) {
                                    $('.sdw-infinite-scroll').html($this_div.find('.sdw-infinite-scroll').html());
                                    $('.sdw-loader').hide();
                                    sdw_infinite_allow = true;
                                } else {
                                    $('.sdw-infinite-scroll').fadeOut('fast').remove();
                                }


                                if (page_url != window.location) {
                                    window.history.pushState({
                                        path: page_url
                                    }, '', page_url);
                                }

                                sdw_load_ajax_new_count++;



                                return false;
                            });

                        });
                    }
                }
            });
        }

        /*-----------------------------------------------------------------------------------*/
        /* Responsive navigation
        /*-----------------------------------------------------------------------------------*/

        $('.sdw-responsive-nav').sidr({
            name: 'sidr-main',
            source: '#site-navigation',
            speed: 100,
            onOpen: function() {
                $('body').addClass('sdw-left-open');
            },
            onClose: function() {
                $('body').removeClass('sdw-left-open');
            }
        });


        if ($(window).width() > 600) {
            if($('#sidebar').length){
                $('.sdw-res-sid-nav').sidr({
                    name: 'sidr-sidebar',
                    source: '#sidebar',
                    speed: 100,
                    side: 'right',
                    renaming: false,
                    onOpen: function() {
                        $('body').addClass('sdw-right-open');
                    },
                    onClose: function() {
                        $('body').removeClass('sdw-right-open');
                    }
                });
            }
        }

        $('.sidr ul li').each(function() {
            if ($(this).hasClass('sidr-class-menu-item-has-children')) {
                $(this).append('<span class="sdw-menu-parent fa fa-angle-down"></span>')
            }
        });
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            $('.sdw-menu-parent').on('touchstart', function(e) {
                $(this).prev().slideToggle();
                $(this).parent().toggleClass('sidr-class-current_page_item');
            });
        } else {
            $('.sdw-menu-parent').on('click', function(e) {
                $(this).prev().slideToggle();
                $(this).parent().toggleClass('sidr-class-current_page_item');
            });
        }

        $('#main-page').on('click', function(e) {
            if ($('body').hasClass('sidr-open')) {
                $.sidr('close', 'sidr-main');
                $.sidr('close', 'sidr-sidebar');
                $('body').removeClass('sdw-right-open').removeClass('sdw-left-open');
                $('.sdw-responsive-nav').removeClass('nav-open');
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /* Scroll to comments
        /*-----------------------------------------------------------------------------------*/
        $('.sdw-single .sdw-comments a, .sdw-cover-content .sdw-comments a').click(function(e) {
            e.preventDefault();
            var target = this.hash,
                $target = $(target);
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 900, 'swing', function() {
                window.location.hash = target;
            });
        });

        /*-----------------------------------------------------------------------------------*/
        /* Reverse submenu ul if out of the screen
        /*-----------------------------------------------------------------------------------*/
        $('.nav-menu li').hover(function(e) {
            if ($(this).closest('body').width() < $(document).width()) {

                $(this).find('ul').addClass('sdw-rev');
            }
        }, function() {
            $(this).find('ul').removeClass('sdw-rev');
        });

        /*-----------------------------------------------------------------------------------*/
        /* Open popup on post share links
        /*-----------------------------------------------------------------------------------*/
        $('body').on('click', 'ul.sdw-share-items a', function(e) {
            e.preventDefault();
            var data = $(this).attr('data-url');
            sdw_social_share(data);
        });


        if($('#sidr-main').length > 0){
            setTimeout(function(){
            clone_header_items();
        }, 100);
        }

        sdw_logo();

    }); //end document ready


    /* Center element vertically function */

    $.fn.sdwCenter = function(top) {
        if (top === undefined) {
            top = 0;
        } else {
            top = top / 2;
            if ($(window).width() > 768 && $('body').hasClass('sdw-cover-indent')) {
                top -= 10;
            }
        }
        this.css("position", "absolute");
        this.css("top", (($(this).parent().height() - this.height()) / 2 + top) + "px");
        return this;
    }

    /* Open social share popup */
    function sdw_social_share(data) {
        window.open(data, "Share", 'height=500,width=760,top=' + ($(window).height() / 2 - 250) + ', left=' + ($(window).width() / 2 - 380) + 'resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0');
    }

    /* Center cover content */
    function sdw_cover_center() {

        if ($('body').hasClass('sdw-cover-indent')) {
            toph = $('#masthead').height();
        } else {
            toph = 0;
        }

        if ($('.sdw-cover-content').height() > ($('.sdw-cover-area').height() - toph)) {
            var c_height = $('.sdw-cover-content').height() + toph + 40;
            if ($('body').hasClass('sdw-cover-indent')) {
                c_height += 20;
            }
            $('.sdw-cover-area').css('min-height', c_height + 'px');
            $('.sdw-cover-area').css('max-height', c_height + 'px');
            $('.sdw-cover-image img').css('height', '100%');
        }

        $('.sdw-cover-content').sdwCenter(toph).animate({
            opacity: 1
        }, 400);

    }


    /* Retina & responsive logo setup function */

    var sdw_logo_width;
    var sdw_logo_height;
    var sdw_logo_height_res;
    var sdw_logo_width_res;
    var sdw_logo_init;

    function sdw_logo() {
        if (sdw_js_settings.logo_retina != "" && $(".site-header .site-title img").length > 0) {
            var retina = window.devicePixelRatio > 1;
            if (retina) {
                $('.site-header .site-title').imagesLoaded().always(function(instance) {

                    if ($(window).width() > 960) {
                        if (sdw_logo_init === undefined) {
                            sdw_logo_init = 'desktop';
                        }
                        $('.site-header .site-title img').css("width", "initial");
                        $('.site-header .site-title img').css("height", "initial");

                        if (sdw_logo_width === undefined) {
                            sdw_logo_width = $('.site-header .site-title img').width();
                        }
                        if (sdw_logo_height === undefined) {

                            sdw_logo_height = $('.site-header .site-title img').height();

                        }
                        if (sdw_logo_init == 'responsive') {
                            sdw_logo_width = sdw_logo_width / 2;
                            sdw_logo_height = sdw_logo_height / 2;
                            sdw_logo_init = 'half';
                        }


                        $('.site-header .site-title img').css("width", sdw_logo_width);
                        $('.site-header .site-title img').css("height", sdw_logo_height);


                    } else {

                        if (sdw_logo_init === undefined) {
                            sdw_logo_init = 'responsive';
                        }

                        if (sdw_logo_width_res === undefined) {
                            sdw_logo_width_res = 'initial';
                        }
                        if (sdw_logo_height_res === undefined) {
                            sdw_logo_height_res = $('.site-header .site-title img').height();
                        }
                        $('.site-header .site-title img').css("width", sdw_logo_width_res);
                        $('.site-header .site-title img').css("height", sdw_logo_height_res);
                    }
                    $(".site-header .site-title img").attr("src", sdw_js_settings.logo_retina);
                });

            }
        }
    }

    /* Show hide icons/navigation in header */
    function sdw_nav_hide($obj) {
        $obj.closest('.site-header').find('.main-navigation').fadeOut(150).promise().done(function() {
            $obj.removeClass($obj.attr('data-icon-class')).addClass('fa-times');
            $obj.closest('ul').find('li').hide();
            $obj.closest('li').show();
            $obj.closest('.site-header').find('.' + $obj.attr('data-wrap')).show();
            $obj.closest('.site-header').find('.' + $obj.attr('data-wrap')).find('.sdw-search-input').focus();
        });
    }

    function sdw_nav_show($obj) {
        $('.' + $obj.attr('data-wrap')).fadeOut(150).promise().done(function() {
            $obj.removeClass('fa-times').addClass($obj.attr('data-icon-class'));
            $obj.closest('.site-header').find('.main-navigation').show();
            $obj.closest('ul').find('li').show();
        });

    }

    /* Sticky sidebar function */

    function sticky_sidebar() {
        if ($(window).width() > 943) {
            if ($('.sdw-sticky').length > 0) {
                if ($('.content-area').height() - 50 > $('.sidebar').height()) {

                    var t = $('.sdw-sticky').offset().top - 64;
                    console.log(t);
                    if ($('body').hasClass('admin-bar')) {
                        var b = 0;
                    } else {
                        var b = 30;
                    }

                    $(".sdw-sticky").affix({
                        offset: {
                            top: function() {
                                return t;
                            },
                            bottom: function() {
                                return ($(".sdw-sticky").hasClass("affix-top")) ? 0 : b;
                            }
                        }
                    });
                }
            }
        }
    }

    /* Popup Image */
    function sdw_popup_image($obj) {

            $obj.find('.sdw-image-format').magnificPopup({
                type: 'image',
                zoom: {
                    enabled: true,
                    duration: 300,
                    opener: function(element) {
                        return element.find('img');
                    }
                }
            });
        }
    
    /* Popup gallery */
    function sdw_popup_gallery($obj) {
        $obj.find('.gallery').each(function() {
            $(this).find('.gallery-icon a.sdw-popup').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                },

                image: {
                    titleSrc: function(item) {
                        var $caption = item.el.closest('.gallery-item').find('.gallery-caption');
                        if ($caption != 'undefined') {
                            return $caption.text();
                        }
                        return '';
                    }
                },

                zoom: {
                    enabled: true,
                    duration: 300,
                    opener: function(element) {
                        return element.find('img');
                    }
                }
            });
        });
    }

    function clone_header_items(){
        if($('#masthead .site-title').length > 0){
           $('#masthead .site-title').clone(true, true).insertBefore('#sidr-id-sdw_main_navigation_menu');
        }
        if($('#masthead .sdw-nav-social-wrap').length > 0){
          $('#masthead .sdw-nav-social-wrap').clone(true, true).insertAfter('#sidr-id-sdw_main_navigation_menu');  
        }
        if($('#masthead .sdw-nav-search-wrap').length > 0){
          $('#masthead .sdw-nav-search-wrap').clone(true, true).insertAfter('#sidr-id-sdw_main_navigation_menu');  
        }
        
    }



})(jQuery);