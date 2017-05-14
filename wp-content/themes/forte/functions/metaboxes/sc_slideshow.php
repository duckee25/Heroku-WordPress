<div class="pix_meta_shortcode" id="slideshow_generator">

	<div>
    
        <label>Select a slideshow:</label>
        
        <select>
            <?php 
                $get_slideshows = pix_get_option('pix_array_your_slideshows_');
                if($get_slideshows != "") {
                    foreach ($get_slideshows as $get_slideshow) { ?>
                        <option value="<?php echo $get_slideshow; ?>"><?php echo $get_slideshow; ?></option>
                    <?php } 
                }
            ?>

        </select>
        <small>To create a form go to Forte admin panel &rarr; Slideshows &rarr; Create your slideshows</small>
                
        <input type="button" class="button alignright" value="Insert shortcode">
    
    </div>

</div><!-- .pix_meta_shortcode -->
