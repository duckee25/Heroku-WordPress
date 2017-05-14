<?php
/*-----------------------------------------------------------------------------------*/
/*	Register widgets
/*-----------------------------------------------------------------------------------*/ 

if(!function_exists('sdw_register_widgets')) :
	function sdw_register_widgets(){
			
			//Include widget classes
	 		require_once('widgets/posts.php');
	 		require_once('widgets/video.php');
	 		require_once('widgets/adsense.php');

			register_widget('SDW_Posts_Widget');
			register_widget('SDW_Video_Widget');
			register_widget('SDW_Adsense_Widget');
	}
endif;

?>