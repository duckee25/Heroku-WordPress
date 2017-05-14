<div class="pix_meta_shortcode" id="video_generator">

	<div class="width_560">

        <label>Source</label>
        
        <select class="toggler">
            <option value="externally">Externally hosted video</option>
            <option value="self">Self hosted video</option>
        </select>

        <div data-type="externally">
        
            <label>Your video</label>
            
            <textarea></textarea>
            
            <small>paste here the iframe</small>
            
        </div><!-- .externally -->
        
        <div data-type="self">
    
            <label>Your video (MP4)</label>
            
            <div class="pix_upload_video">
                <input type="text" class="url"><br>
                <a class="button-secondary pix_upload_video_button no_overlay" href="#">Upload Video</a>
            </div>
    
            <label>Your video (OGV)</label>
            
            <div class="pix_upload_video">
                <input type="text" class="ogv"><br>
                <a class="button-secondary pix_upload_video_button no_overlay" href="#">Upload Video</a>
            </div>
    
            <label>Poster image</label>
            <div class="pix_upload_image">
                <input type="text" class="poster"><br>
                <a class="button-secondary pix_upload_image_button no_overlay" href="#">Upload Image</a>
            </div><!-- .pix_upload_image -->
        
        </div><!-- .self -->
    
        <label>Width (% or px)</label>
        <input type="text" class="width" value="100%" />
        <small>If you specify a percentage, the width will be relative to the video container</small>

        <label>Height (% or px)</label>
        <input type="text" class="height" value="56%" />
        <small>If you specify a percentage, the height will be relative to the width of the video</small>

        <input type="button" class="button alignright" value="Insert shortcode">
    
    </div>
    
</div><!-- .pix_meta_shortcode -->
