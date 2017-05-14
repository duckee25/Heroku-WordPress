(function($) {
    $(document).ready(function (){
            
    		/* Image opts selection */
            $('body').on('click', 'img.sdw-img-select', function(e){
                e.preventDefault();
                $(this).closest('ul').find('img.sdw-img-select').removeClass('selected');
                $(this).addClass('selected');
                $(this).closest('ul').find('input').removeAttr('checked');
                $(this).closest('li').find('input').attr('checked','checked');

            });


            sdw_template_metaboxes();

            $('#page_template').change(function(e){
                    sdw_template_metaboxes();
            });
            
            
            /* Metabox switch - do not show every metabox for every template */
            function sdw_template_metaboxes(){

                var template = $('select#page_template').val();
                
                if(template == 'default'){
                    $('#sdw_layout').fadeIn(300);
                    $('#sdw_sidebar').fadeIn(300);
                }
                
                if( template == 'template-home.php' ){
                    $('#sdw_layout').fadeOut(300);
                    $('#sdw_sidebar').fadeOut(300);
                }

                if( template == 'template-full-width.php' ){
                    $('#sdw_sidebar').fadeOut(300);
                    $('#sdw_layout').fadeIn(300);
                }
            
            }   
    });


    
})(jQuery);