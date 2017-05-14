<?php

/*
functions for the compability of Aesop Story Engine with Literatum 
*/





/**
 * Load aesop css file
 */
function KTT_load_aesop_css() {


    wp_enqueue_style( 'aesop-story-style', KTT_path_to_url(dirname(__FILE__) . '/css/aesop.css'), array('literatum-style-articles') );


}
add_action( 'wp_enqueue_scripts', 'KTT_load_aesop_css' );














add_action("the_content","KTT_aesop_fixes");
function KTT_aesop_fixes($content){
    global $post;


    if (is_single()) {



    // ----------- CHAPTERS -------------------- //

    if (aesop_component_exists('chapter')) {

        ?>


        <span class="chapters-indicator" onclick="jQuery('.chapters-wrap').addClass('display')">
            <i>&#xe872;</i>
            <?php _e('Chapters', THEME_TEXTDOMAIN);?>
        </span>


        <div class="chapters-wrap" onclick="jQuery('.chapters-wrap').removeClass('display')">

            


            <div class="chapters-div">

                <span class="chapters-label"><i>&#xe872;</i> <?php _e('Chapters', THEME_TEXTDOMAIN);?></span>

                <ul>

                   
                </ul>

              
            </div>



        </div>



            <script>

            jQuery(function() {


                chapter_list = jQuery('.chapters-div ul');

                jQuery( ".aesop-article-chapter-wrap" ).each(function( index ) {

                    var chapter_div = jQuery( this );

                    var_chapter_title = chapter_div.find('.aesop-cover-title').html();

                    var li =    jQuery('<li/>')
                                .appendTo(chapter_list);

                    var a =     jQuery('<a/>')
                                .click(function(){ 

                                    jQuery('.chapters-wrap').removeClass('display');
                                    jQuery('html,body').animate({scrollTop: chapter_div.offset().top + 50}, 0);

                                 })
                                .appendTo(li);

                    

                    var title = jQuery('<div/>')
                                .addClass('chapter-title')
                                .html(var_chapter_title)
                                .appendTo(a);
            

                });

            });
            </script>

        <?php
    }











    // ----------------- TIMELINES ------------------- //
    if (aesop_component_exists('timeline_stop')) {

        ?>


        <div id="timeline-list-wrap">

            <div id="timeline-list">

                <ul>
                    

                </ul>

            </div>

        </div>


        <script>

            jQuery(function() {

                    timeline_list = jQuery('#timeline-list ul');



                    jQuery('.aesop-timeline-stop').each(function(){

                        var stop_div = jQuery( this );


                        var title = jQuery(this).attr('data-title');
                        var label = jQuery(this).html();

                        stop_div.html(title);

                        var li =    jQuery('<li/>')
                                    .appendTo(timeline_list);

                        var bullet = jQuery('<span/>')
                                    .addClass('bullet')
                                    .click(function(){ 

                                        jQuery('html,body').animate({scrollTop: stop_div.offset().top - 40}, 300);

                                     })
                                    .appendTo(li);

                        var message_div = jQuery('<div/>')
                                    .addClass('bullet-message')
                                    .appendTo(li);

                        var message = jQuery('<span/>')
                                    .html(label)
                                    .appendTo(message_div);

                       
                    });

            });


        </script>
        <?php
    }

    



    // fix for components non compatibles with AJAX
    if ( aesop_component_exists('map') || aesop_component_exists('video') || aesop_component_exists('audio')) {

        if (isset($_REQUEST['ajax']) && $_REQUEST['ajax']) {
        ?>
        <script>location.reload()</script>
        <?php
        }

    }


    }


  return $content;
}






// delete the default js script of the chapters
function KTT_chapter_custom($content) {
    remove_action('wp', 'aesop_chapter_heading_loader',11);
    return $content;
}

add_action( 'aesop_chapter_after', 'KTT_chapter_custom' );









// delete the default js script of the timelines
function KTT_timeline_stop_custom($content) {
    remove_action('wp', 'aesop_timeline_class_loader',11);
    return $content;
}

add_action( 'aesop_timeline_output', 'KTT_timeline_stop_custom' );



