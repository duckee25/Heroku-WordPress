(function($) {
    $(document).ready(function (){
            $('body').on('click', 'img.sdw-img-select', function(e){
                e.preventDefault();
                $(this).closest('ul').find('img.sdw-img-select').removeClass('selected');
                $(this).addClass('selected');
                $(this).closest('ul').find('input').removeAttr('checked');
                $(this).closest('li').find('input').attr('checked','checked');
            }); 
    });
    
})(jQuery);