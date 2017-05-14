(function($) {
    	
        $(document).ready(function ($) {


        /* Image select */

        $('body').on('click', 'img.sdw-img-select', function(e){
            e.preventDefault();
            $(this).closest('ul').find('img.sdw-img-select').removeClass('selected');
            $(this).addClass('selected');
             $(this).closest('ul').find('input').removeAttr('checked');
                $(this).closest('li').find('input').attr('checked','checked');
        });

        /* Cover image upload */
        // Instantiates the variable that holds the media library frame.
        var meta_image_frame;
     
        // Runs when the image button is clicked.
        $('#sdw-cover-upload').click(function(e){
     
            // Prevents the default action from occuring.
            e.preventDefault();
     
            // If the frame already exists, re-open it.
            if ( meta_image_frame ) {
                meta_image_frame.open();
                return;
            }
     
            // Sets up the media library frame
             meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                title: 'Choose your image',
                button: { text:  'Add Image' },
                library: { type: 'image' }
            });
                    
            // Runs when an image is selected.
            meta_image_frame.on('select', function(){
     
                // Grabs the attachment selection and creates a JSON representation of the model.
                var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
               
                
                // Sends the attachment URL to our custom image input field.
                $('#sdw-cover-url').val(media_attachment.url);
                $('#sdw-cover-preview').attr('src',media_attachment.url);
                $('#sdw-cover-preview').show();
                $('#sdw-cover-clear').show();
                
                
            });
     
            // Opens the media library frame.
            meta_image_frame.open();
        });

        $('#sdw-cover-clear').click(function(e){
            $('#sdw-cover-preview').hide();
            $('#sdw-cover-url').val('');
            $(this).hide();
        });

    });
    	
})(jQuery);