<div class="pix_meta_shortcode" id="category_generator">

	<div>

        <label>What categories do you want to display?</label>
        <select multiple class="select_categories">
            <option value="all" selected>All the categories</option>
            <?php 
				$categories =  get_categories(); 
				foreach ($categories as $category) { ?>
				<option value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
			<?php } ?>
        </select>
    
        <label>Display as featured items:</label>
        <input type="checkbox" data-type="featured" value="true" checked>

        <label>Select the layout:</label>
        <select data-type="layout">
            <option value="default">Two columns wide thumb (16:9) + floating text</option>
            <option value="first">Two columns wide thumb (4:3) + floating text</option>
            <option value="second">One column wide thumb (16:9) + floating text</option>
            <option value="third">One column wide thumb (4:3) + floating text</option>
            <option value="fourth">Three columns wide thumb + floating text</option>
            <option value="fifth">Four columns wide thumb + floating text</option>
            <option value="sixth">Grid of one colum wide thumbs</option>
            <option value="sixth_bis">Grid of one colum wide thumbs (masonry)</option>
            <option value="seventh">Grid of two columns wide thumbs (4:3)</option>
            <option value="seventh_bis">Grid of two columns wide thumbs (4:3, masonry)</option>
            <option value="eighth">Grid of two columns wide thumbs (16:9)</option>
            <option value="eighth_bis">Grid of two columns wide thumbs (16:9, masonry)</option>
            <option value="ninth">Wall of 4:3 thumbs</option>
            <option value="tenth">Wall of 16:9 thumbs</option>
        </select>
        
        <small><strong>Pay attention: </strong>some layouts are not compatible with the default template, but require the wide page</small>

        <label>Display the sorting bar:</label>
        <input type="checkbox" data-type="sorting" value="true" checked>

        <label>Display the &quot;Order by&quot; filter:</label>
        <input type="checkbox" data-type="order" value="true" checked>

        <label>Display the &quot;Sort by tag&quot; filter:</label>
        <input type="checkbox" data-type="sort" value="true" checked>

        <label>Amount of lines for the excerpts:</label>
        <input type="text" data-type="excerpt" class="width_100" value="10">
        <small>Type 0 if you don't want to display the excerpt</small>
        
        <label>Posts per page:</label>
        <input type="text" data-type="amount" class="width_100" value="10">
        
        <label>Link the pictures to the posts or open in a ColorBox:</label>
        <select data-type="linkto">
            <option value="colorbox">ColorBox</option>
            <option value="page">Posts</option>
            <option value="none">None</option>
        </select>
                
        <label>Display the titles of the posts:</label>
        <input type="checkbox" data-type="titles" value="true" checked>

        <label>Display the &quot;Read more&quot; link:</label>
        <input type="checkbox" data-type="more" value="true" checked>

        <label>Display the &quot;Like&quot; button:</label>
        <input type="checkbox" data-type="like" value="true" checked>

        <label>Display the amount of comments:</label>
        <input type="checkbox" data-type="comments" value="true" checked>

        <label>Display the meta info of the posts (categories, author):</label>
        <input type="checkbox" data-type="meta" value="true" checked>

        <label>Page navigation:</label>
        <select data-type="pagenavi">
            <option value="">None</option>
            <option value="numbers">Page numbers</option>
            <option value="infinite">Infinite scroll button</option>
        </select>
        
        <br>
                
        <input type="button" class="button alignright" value="Insert shortcode">
 
    </div>

</div><!-- .pix_meta_control -->
