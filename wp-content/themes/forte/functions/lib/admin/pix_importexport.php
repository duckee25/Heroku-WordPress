<?php

function import_export(){
	global $options, $wpdb, $blog_id;
	
	if (!isset($blog_id) || $blog_id == 1) {
		$blog = '';
	} else {
		$blog = $blog_id.'_';
	}
	
	$upload_dir = wp_upload_dir();
	if ($_GET['page']=='import_export') { 
?>

<div id="forte_dynamic_tab">
        	<div id="forte_content_title">
            	General: <small>import/export</small>
            </div><!-- #forte_content_title -->
            
            <div id="forte_content_content">
            <form method="post" class="dynamic_form" action="<?php echo get_template_directory_uri().'/functions/lib/pix_export.php'; ?>">

            	<label>Do you want to export all the settings you saved across the custom admin panel?</label>
                <div class="tip_info_wrap visible_tip">
                    <small class="tip_info">
                        The settings will be exported in a .txt file. The images you used in this panel are not exported, only their path will be exported and the &quot;uploads&quot; directory will be replaced with the new one (if you are moving the site to another domain). But you need to physically move the images by downloading them from the old server and uploading them to the new one if you are moving the site.
                    </small>
                </div>
                <div class="clear"></div>
                <div class="yellow_button">
                	<div class="button_left"></div>
                	<div class="button_right"></div>
                	<div class="button_body"></div>
                    <a href="#" class="fake_button">Export</a>
                </div>
                <div class="clear"></div>
        <input type="hidden" name="export_host" value="<?php echo DB_HOST; ?>">
        <input type="hidden" name="export_user" value="<?php echo DB_USER; ?>">
        <input type="hidden" name="export_password" value="<?php echo DB_PASSWORD; ?>">
        <input type="hidden" name="export_db" value="<?php echo DB_NAME; ?>">
        <input type="hidden" name="export_table" value="<?php echo $wpdb->base_prefix.$blog.'forte'; ?>">
        <input type="hidden" name="export_upload_dir" value="<?php echo $upload_dir['baseurl']; ?>">
        <input type="hidden" name="export_theme_dir" value="<?php echo get_template_directory_uri(); ?>">
        <input type="hidden" name="export_panel" value="export_panel">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
        <input type="submit" class="hidden_div" value="">
            </form><!-- .dynamic_form -->
<br>
            <div class="tip_info_wrap">
            </div><!-- .tip_info_wrap -->
<br>
            <form method="post" class="dynamic_form" enctype="multipart/form-data" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">

            	<label>Do you want to import a .txt file with the saved styles?</label>
                <div class="tip_info_wrap visible_tip">
                    <small class="tip_info">
                        <strong>N.B.:</strong> by clicking the button below you will replace all the settings regarding the style (colors, images, fonts... but not, for instance, the logo, if you have one or other customizations regarding the brand) of your admin panel. As more backups as you can are recommended before proceeding.<br>
                        If you want to import only the content for your admin panel (titles, subtitles, logo, SEO...) use the button <strong>&quot;Import skin contents&quot;</strong> too.
                    </small>
                </div>
                <div class="clear"></div>
                <div class="field_wrap">
                	<input type="file" name="file" id="file">
                </div>
                <div class="clear"></div>
                <div class="yellow_button">
                	<div class="button_left"></div>
                	<div class="button_right"></div>
                	<div class="button_body"></div>
                    <a href="#" class="pix_import_skin">Import skin style</a>
                </div>
                <div class="clear"></div>
           

        <input type="hidden" name="forte_set_import" value="import_skin_style">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
        <input type="submit" class="hidden_div" value="">
            </form><!-- .dynamic_form -->
<br>
            <div class="tip_info_wrap">
            </div><!-- .tip_info_wrap -->
<br>
            <form method="post" class="dynamic_form" enctype="multipart/form-data" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">

            	<label>Do you want to import a .txt file with the saved contents?</label>
                <div class="tip_info_wrap visible_tip">
                    <small class="tip_info">
                        <strong>N.B.:</strong> by clicking the button below you will replace all the settings regarding the content (titles, subtitles, logo, SEO...) of your admin panel. As more backups as you can are recommended before proceeding.<br>
                        If you want to import the styles only (colors, images, fonts...) use the button <strong>&quot;Import skin style&quot;</strong> too.
                    </small>
                </div>
                <div class="clear"></div>
                <div class="field_wrap">
                	<input type="file" name="file" id="file">
                </div>
                <div class="clear"></div>
                <div class="yellow_button">
                	<div class="button_left"></div>
                	<div class="button_right"></div>
                	<div class="button_body"></div>
                    <a href="#" class="pix_import_skin">Import skin contents</a>
                </div>
                <div class="clear"></div>
           

        <input type="hidden" name="forte_set_import" value="import_skin_content">
        <input type="hidden" name="forte_security" value="<?php echo wp_create_nonce('forte_data'); ?>">
        <input type="submit" class="hidden_div" value="">
            </form><!-- .dynamic_form -->

            </div><!-- #forte_content_content -->
</div>


<?php }
} ?>