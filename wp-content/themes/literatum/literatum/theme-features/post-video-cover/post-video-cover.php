<?php
/**
 * Add a new field in the post editor to add photo credit for featured images.
 *
 */




// return true to enable the photo credit feature in the theme
function KTT_post_video_cover_enabled() {
	return true;
}






/**
 * Adds a meta box to the post editing screen
 */
function KTT_video_cover_meta() {
    add_meta_box( 'KTT_video_cover', __( 'Video cover', THEME_TEXTDOMAIN ), 'KTT_video_cover_meta_callback', 'post', 'side', 'low');
}




// META BOX FORM
function KTT_video_cover_meta_callback( $post ) {

    $video_cover = get_post_meta($post->ID, ktt_var_name('video_cover'), true);

    $value = '';
    if (isset($video_cover['src'])) $value = $video_cover['src'];

    ?>

    <p><?php _e('Add a video to show as cover for this post.',THEME_TEXTDOMAIN);?></p>





       <div class="wp-tab-panel" style="border-radius:4px;margin:15px 0;padding-bottom:15px;max-height:100%;">

       <h3><span><?php _e('Video Source', THEME_TEXTDOMAIN);?></span></h3>
            

           

            
            <div <?php if (!$value){?> style="display:none"<?php } ?> class="video-cover-preview">

                <video id="video" controls preload width="100%">
                    <source src="<?php echo $value;?>" type="video/mp4">
                </video>

                <p><a onclick="quit_video_cover()" style="text-decoration:underline;cursor:pointer"><?php _e('Remove video cover', THEME_TEXTDOMAIN);?></a></p>

            </div>
               



            <div <?php if ($value){?>style="display:none"<?php } ?> class="video-cover-form">

                <p class="media-library-mode-message"><?php _e('Select a video from the Media library or upload a new one.',THEME_TEXTDOMAIN);?></p>
                
                <p class="use-url-mode-message" style="display:none"><?php _e('Introduce the URL of the video file.',THEME_TEXTDOMAIN);?></p>
                <textarea 
                type="text"
                onchange="validate_video_input(this)"
                class="normal-text"
                id="upload-video-video-cover"
                name=""
                style="display:none;width:100%"
                rows="4"
                ><?php echo $value;?></textarea>

                <input 
                type="hidden"
                class="regular-text"
                id="upload-video-video-cover-real"
                name="<?php echo ktt_var_name('video_cover');?>[src]"
                value="<?php echo $value;?>">

                <span 
                class="button-primary button"
                id="upload-button-video-cover"
                >
                <?php _e('Select video cover', THEME_TEXTDOMAIN);?>
                </span> 

                <a onclick="use_url_mode()" class="button"><?php _e('Use URL');?></a>
            
                <p class="video-cover-error" style="color:#e74c3c"></p>

                <p style=""><b><?php _e('Available formats:',THEME_TEXTDOMAIN);?></b> mp4, ogg, webm, m4v, wmv, mov, ogv.</p>

            </div>











                <script>
                    
                        // Uploading files
                        var file_frame;
                         
                          jQuery('#upload-button-video-cover').live('click', function( event ){
                         
                            event.preventDefault();

                            button = jQuery(this);
                         
                         
                            // Create the media frame.
                            file_frame = wp.media.frames.file_frame = wp.media({
                              title: jQuery( this ).data( 'uploader_title' ),
                              button: {
                                text: jQuery( this ).data( 'uploader_button_text' ),
                              },
                              multiple: false  // Set to true to allow multiple files to be selected
                            });
                         
                            // When an image is selected, run a callback.
                            file_frame.on( 'select', function() {
                              // We set multiple to false so only get one image from the uploader
                              attachment = file_frame.state().get('selection').first().toJSON();
                              jQuery('#upload-video-video-cover').val(attachment.url);
                              jQuery('#upload-video-video-cover').change();
                              media_library_mode()
                              

                         
                            });
                         
                            // Finally, open the modal
                            file_frame.open();
                          });


                        function validate_video_input(input) {
                            

                            if (!is_video_file(input.value)) {  
                                    jQuery('.video-cover-error').html('<?php _e('The introduced URL does not seem as a valid video file. Please, introduce a valid video file URL.',THEME_TEXTDOMAIN);?>');
                                    jQuery('#upload-video-video-cover-real').val('');
                                    return false;
                            }


                            jQuery('.video-cover-error').html('');
                            jQuery('#upload-video-video-cover-real').val(input.value);
                            put_video_cover()
                            

                        }


                        function quit_video_cover() {

                            jQuery('.video-cover-preview').hide();
                            jQuery('.video-cover-form').show();
                            jQuery('#upload-video-video-cover-real').val('');
                            jQuery('#upload-video-video-cover').val('');


                        }

                        function put_video_cover() {

                            jQuery('.video-cover-preview').show();
                            jQuery('.video-cover-form').hide();

                            jQuery('.video-cover-preview video').attr('src', jQuery('#upload-video-video-cover').val());
                            


                        }


                        function is_youtube_file(file_string) {


                        }


                        function is_video_file(file_string) {
                            valid = ['mp4', 'm4v', 'ogg', 'webm', 'avi', 'mov', 'ogv', 'mpg', 'wmv'];
                            ext = file_string.split('.').pop();

                            if(valid.indexOf(ext) != -1) return true;
                            return false;
                        }


                        function use_url_mode() {

                            jQuery('#upload-video-video-cover').show().val('');
                            jQuery('.use-url-mode-message').show()
                            jQuery('.media-library-mode-message').hide()

                        }

                        function media_library_mode() {
                            jQuery('#upload-video-video-cover').hide();
                            jQuery('.use-url-mode-message').hide()
                            jQuery('.media-library-mode-message').show()
                        }


                    </script>














        
    </div>
      
        


            <script>

            jQuery(document).ready( function($) {
                // wp tabs
                $('.wp-tab-bar a').click(function(event){
                    event.preventDefault();
                    // Limit effect to the container element.
                    var context = $(this).parents('.wp-tab-bar').first().parent();
                    $('.wp-tab-bar li', context).removeClass('wp-tab-active');
                    $(this).parents('li').first().addClass('wp-tab-active');
                    $('.wp-tab-panel', context).hide();
                    $( $(this).attr('href'), context ).show();
                });
                // Make setting wp-tab-active optional.
                $('.wp-tab-bar').each(function(){
                    if ( $('.wp-tab-active', this).length )
                        $('.wp-tab-active', this).click();
                    else $('a', this).first().click();
                });
            });

            </script>


    <?php
    
}




// SAVE 
function KTT_video_cover_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 

    $vars = array(
            ktt_var_name('video_cover')
    );


    // Checks for input and sanitizes/saves if needed
    foreach ($vars as $var) {
	    if( isset( $_POST[ $var ] ) ) {
	        update_post_meta( $post_id, $var, $_POST[ $var ] );
	    }
	}
 
}


if (KTT_post_video_cover_enabled()) add_action( 'add_meta_boxes', 'KTT_video_cover_meta' );
if (KTT_post_video_cover_enabled()) add_action( 'save_post', 'KTT_video_cover_meta_save' );


?>