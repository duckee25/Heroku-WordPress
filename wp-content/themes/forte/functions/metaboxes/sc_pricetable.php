<div class="pix_meta_shortcode" id="pricetable_generator">

	<div>
        <label>Select a table:</label>
        
        <select>
            <?php 
                $get_price_table_options = pix_get_option('pix_array_your_tables_');
                if($get_price_table_options != "") {
                    foreach ($get_price_table_options as $price_table_gen) { ?>
                        <option value="<?php echo $price_table_gen; ?>"><?php echo $price_table_gen; ?></option>
                    <?php } 
                }
            ?>

        </select>
        <small>To create a form go to Forte admin panel &rarr; Price tables &rarr; Create your tables</small>
        
        <input type="button" class="button alignright" value="Insert shortcode">
    
    </div>

</div><!-- .pix_meta_shortcode -->
