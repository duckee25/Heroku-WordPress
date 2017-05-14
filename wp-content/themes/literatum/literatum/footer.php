<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 */
?>

	</div><!-- #content -->






			</div><!-- /scroller-inner -->
        </div><!-- /scroller -->
 

		

    </div><!-- /pusher -->
</div><!-- /container -->




<script>



function pushmenu() {
	jQuery('#mp-menu, .scroller').addClass('cbp-spmenu-push-toright');
	jQuery( ".push-cover" ).bind( "click", function() {
	  pushmenu_close();
	});
}

function pushmenu_close() {
	jQuery('#mp-menu, .scroller').removeClass('cbp-spmenu-push-toright');
}


function scrollto(div, time, offset) {

			if (!time) time = 600;
			if (!offset) offset = 0;
			jQuery('html, body').animate({scrollTop: jQuery(div).offset().top + offset}, time);

}




	// back to top and menu buttons ---------------------------------------------------------------------------
	var previousScroll = 0,
	headerOrgOffset = jQuery('#top-controls').height();

	jQuery(window).scroll(function () {


		toolbar = jQuery('#top-controls');
	    var currentScroll = jQuery(this).scrollTop();
	    if (currentScroll > headerOrgOffset + 500) {
	        if (currentScroll >= previousScroll ) {

	        	toolbar.removeClass('animated fadeInDown').addClass('animated fadeOutUp')

	        } else {
	            toolbar.removeClass('animated fadeOutUp').addClass('affix animated veryfast fadeInDown')

	        }
	    } else {
	            toolbar.removeClass('animated affix fadeInDown fadeOutUp')
	    }
	    previousScroll = currentScroll;

	});
	// --------------------------------------------------------------------------------------------------------


</script>


	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
