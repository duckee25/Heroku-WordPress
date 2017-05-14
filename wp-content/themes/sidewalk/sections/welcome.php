<!-- This is a welcome message that displays on theme activation -->
<?php 
		$protocol = isset( $_SERVER['https'] ) ? 'https://' : 'http://';
		$sdw_ajax_url = admin_url( 'admin-ajax.php', $protocol );
?>
<script>
	(function($) {
		$(document).ready(function() {
				$("body").on('click', '#sdw_welcome_box_hide',function(e){
	    			e.preventDefault();
	    			$(this).parent().fadeOut(300).remove();
	    			$.post('<?php echo $sdw_ajax_url; ?>', {action: 'sdw_hide_welcome'}, function(response) {});
    			});
		});
	})(jQuery);

</script> 

<div id="welcome-panel" class="welcome-panel sdw-welcome-panel">
	<a href="#" class="welcome-panel-close" id="sdw_welcome_box_hide">Dismiss</a>
	<div class="welcome-panel-content">
	
		<h3>Thank you for choosing <?php echo THEME_NAME; ?>!</h3>
		<p class="about-description">We really appreciate your trust and support.</p>
		
		<div class="welcome-panel-column-container">

			<div class="welcome-panel-column">
				<h4>1. Get Started</h4>
				<p>We suggest that you first install our recommended plugins which will enhance the theme functionality and provide you with the best experience.</p>
				<a class="button button-primary button-hero" href="<?php echo esc_url(admin_url('themes.php?page=install-required-plugins')); ?>">Install plugins</a>
			</div>

			<div class="welcome-panel-column">
				<h4>2. Import Demo</h4>
				<p>
					If you want your website to look very similar to our demo, you can use our one-click demo importer and start tweaking from that point.
				</p>
				<a class="button button-primary button-hero" href="<?php echo esc_url(admin_url('admin.php?page=sdw_options&tab=22')); ?>">Import demo</a>
				
			</div>

			<div class="welcome-panel-column welcome-panel-last">
				<h4>3. Explore Features</h4>
				<p>We provide you with a full documentation to make sure you can easily setup and fully customize the theme to your liking.</p>
				<a class="button button-primary button-hero" href="http://demo.mekshq.com/sidewalk/documentation" target="_blank">Learn more</a> <span class="sdw-customize-welcome">or <a href="<?php echo esc_url(admin_url('admin.php?page=sdw_options')); ?>">start customizing</a> now</span>.
			</div>

		</div>

	</div>

</div>