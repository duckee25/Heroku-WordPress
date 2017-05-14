<?php

/*
We add to the footer the javascript code to make parallax backgorund images
*/
function KTT_fix_webkit_background_tiles() {


    ?>

      <script>
     
          (function($) {

              $.fn.parallax = function(options) {


                  var windowHeight = $(window).height();

                  // Establish default settings
                  var settings = $.extend({
                      speed        : 0.15
                  }, options);

                  

                  // Iterate over each object in collection
                  return this.each( function() {


                      // Save a reference to the element
                      var $this = $(this);

                      // Set up Scroll Handler
                      $(document).scroll(function(){

                          var scrollTop = $(window).scrollTop();
                          var offset = $this.offset().top;
                          var height = $this.outerHeight();

                          // Check if above or below viewport
                          if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) {
                          return;
                          }

                          var yBgPosition = Math.round((offset - scrollTop) * settings.speed);
                          // Apply the Y Background Position to Set the Parallax Effect
                          $this.css('background-position', 'center ' + yBgPosition + 'px');
                          
                      });
                  });
              }
          }(jQuery));



          jQuery('.image-background.image-final.image-in-single-page').parallax({
          speed : 0.50
          });

      </script>

    <?php

}
add_action('wp_footer', 'KTT_fix_webkit_background_tiles');





/**
* hotfix to work with AJAX navigation
*/
function KTT_parallax_cover_background_with_ajax() {

  ?>

    (function($) {

              $.fn.parallax = function(options) {

                
                  var windowHeight = $(window).height();

                  // Establish default settings
                  var settings = $.extend({
                      speed        : 0.15
                  }, options);

                  

                  // Iterate over each object in collection
                  return this.each( function() {


                      // Save a reference to the element
                      var $this = $(this);

                      // Set up Scroll Handler
                      $(document).scroll(function(){

                          var scrollTop = $(window).scrollTop();
                          var offset = $this.offset().top;
                          var height = $this.outerHeight();

                          // Check if above or below viewport
                          if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) {
                          return;
                          }

                          var yBgPosition = Math.round((offset - scrollTop) * settings.speed);
                          // Apply the Y Background Position to Set the Parallax Effect
                          $this.css('background-position', 'center ' + yBgPosition + 'px');
                          
                      });
                  });
              }
          }(jQuery));
          

    jQuery('.image-background.image-final.image-in-single-page').parallax({ speed : 0.50 });
    
  <?php

}

add_action('KTT_after_ajax_link_load', 'KTT_parallax_cover_background_with_ajax');

