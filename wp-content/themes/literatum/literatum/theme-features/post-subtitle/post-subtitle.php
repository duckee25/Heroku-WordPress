<?php
/**
 * add subtitle input for posts.
 *
 *
 */






// add form

add_action( 'edit_form_after_title', 'KTT_subtitle_form'  );

function KTT_subtitle_form() {
    // return if not admin panel
    if ( !is_admin() ) return;

    global $post;
    $value =  get_post_meta($post->ID, ktt_var_name('post_subtitle'), true);
    
    ?>
    <div id="subtitlediv" style="">
        <div id="subtitlewrap">
            <label class="screen-reader-text" id="subtitle-prompt-text" for="title"><?php _e('Enter subtitle here', THEME_TEXTDOMAIN);?></label>
            <input 
            type="text" 
            placeholder="<?php _e('Enter subtitle here', THEME_TEXTDOMAIN);?>" 
            name="<?php echo ktt_var_name('post_subtitle');?>"  
            value="<?php echo $value;?>" 
            id="subtitle" 
            class="regular-text"
            style="width:100%;padding:10px;font-size:16px;line-height:30px;height:35px;"
            autocomplete="off" />
        </div>
    </div>
    <br>
    <?php    
}




// save post subtitle
add_action( 'save_post', 'KTT_save_post_subtitle' );
function KTT_save_post_subtitle( $post_id ) {

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
 
    if ( isset ( $_POST[ ktt_var_name('post_subtitle') ] ) ) return update_post_meta( $post_id, ktt_var_name('post_subtitle'), $_POST[ ktt_var_name('post_subtitle') ] );
    
}



// add post_subtitle right in the $post object
add_action( 'wp', 'KTT_add_post_subtitle_to_post_object' );
function KTT_add_post_subtitle_to_post_object(){

    global $post;
    if(!$post) return;
    $post_subtitle = get_post_meta($post->ID, ktt_var_name('post_subtitle'), true);
    $post->post_subtitle = $post_subtitle;

}

?>