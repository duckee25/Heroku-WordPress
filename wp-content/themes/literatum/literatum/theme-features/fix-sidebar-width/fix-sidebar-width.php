<?php

/*
adjust the style of the sidebar width option in the customize page
*/

function KTT_fix_sidebar_width() {

    // we get the sidebar option saved in the database
    $sidebar_width_option = get_option(ktt_var_name('sidebar_width'));
    // if the sidebar width option is used...
    if (isset($sidebar_width_option) && $sidebar_width_option) {

        $width = $sidebar_width_option['sidebar_width']['value'];

        if (!$width) return;

        ?>
        <style>

        .scroller.cbp-spmenu-push-toright {
          /*left: 300px;*/
          -webkit-transform: translate3d(-<?php echo $width;?>,0,0);
          -moz-transform: translate3d(-<?php echo $width;?>,0,0);
          transform: translate3d(-<?php echo $width;?>,0,0);
        }
        </style>
        <?php

    }

}

add_action('wp_head', 'KTT_fix_sidebar_width');