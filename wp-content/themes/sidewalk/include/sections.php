<?php

/* Branding */
Redux::setSection( $opt_name , array(
        'icon'      => ' el-icon-smiley',
        'title'     => __( 'Branding', THEME_SLUG ),
        'desc'     => __( 'Personalize Sidewalk by adding your own icons and images', THEME_SLUG ),
        'fields'    => array(

            array(
                'id'        => 'logo',
                'type'      => 'media',
                'url'       => true,
                'title'     => __( 'Logo', THEME_SLUG ),
                'subtitle'      => __( 'Upload your logo image here, or leave empty to show the website title instead', THEME_SLUG ),
                'default'   => array( 'url' => esc_url(IMG_URI.'sidewalk_logo.png') ),
            ),

            array(
                'id'        => 'logo_retina',
                'type'      => 'media',
                'url'       => true,
                'title'     => __( 'Retina logo (2x)', THEME_SLUG ),
                'subtitle'      => __( 'Optionally upload another logo for devices with retina displays. It should be double the size of your normal logo.', THEME_SLUG ),
                'default'   => array( 'url' => esc_url(IMG_URI.'sidewalk_logo@2x.png')),
            ),

            array(
                'id'        => 'cover_image',
                'type'      => 'media',
                'url'       => true,
                'title'     => __( 'Cover image', THEME_SLUG ),
                'subtitle'      => __( 'Upload your header cover image here. It will be displayed below the header bar.', THEME_SLUG ),
                'width' => '300px',
                'height' => '20',
                'default'   => array( 'url' => esc_url(IMG_URI.'sidewalk_cover.png')),
            ),

            array(
                'id'        => 'default_fimg',
                'type'      => 'media',
                'url'       => true,
                'title'     => __( 'Default featured image', THEME_SLUG ),
                'subtitle'      => __( 'Upload your default featured image/placeholder. It will be displayed for posts that do not have a featured image set.', THEME_SLUG ),
                'default'   => array( 'url' => esc_url(IMG_URI.'sidewalk_default.jpg') ),
            ),

            array(
                'id' => 'favicon',
                'type' => 'media',
                'url' => true,
                'title' => __( 'Favicon', THEME_SLUG ),
                'subtitle' => __( 'Upload your favicon here. Favicons can easily be created with <a href="http://iconogen.com/" target="_blank">this tool</a>.', THEME_SLUG ),
                'default' => array( 'url' => THEME_URI.'favicon.ico' )
            ),
            array(
                'id' => 'apple_touch_icon',
                'type' => 'media',
                'url' => true,
                'title' => __( 'Apple Touch Icon', THEME_SLUG ),
                'subtitle' => __( 'Upload an icon for Apple touch', THEME_SLUG ),
                'desc' => __( 'Size: 77x77 px', THEME_SLUG ),
                'default'   => array( 'url' => '' )

            ),
            array(
                'id' => 'metro_icon',
                'type' => 'media',
                'url' => true,
                'title' => __( 'Windows 8 Icon', THEME_SLUG ),
                'subtitle' => __( 'Upload an icon for the Windows 8 interface', THEME_SLUG ),
                'desc' => __( 'Size: 144x144 px', THEME_SLUG ),
                'default'   => array( 'url' => '' )
            )
        ) )
);

/* Image Options */
Redux::setSection( $opt_name , array(
        'icon'      => ' el-icon-picture',
        'title'     => __( 'Image Options', THEME_SLUG ),
        'desc'     => __( 'Sidewalk will generate appropriate image sizes for each of the layouts/templates. You can use these options to modify the default image format/ratio or disable some sizes if you don\'t want to use a particular layout. <br/><br/>NOTE: Every time you change these options it is highly recommended to <a href="http://demo.mekshq.com/sidewalk/documentation#regenerate" target="_blank">regenerate thumbnails</a> for all of your previously uploaded images, as described in the theme documentation.', THEME_SLUG ),
        'fields'    => array(

            array(
                'id'        => 'img_size_cover',
                'type'      => 'switch',
                'title'     => __( 'Generate Cover image size', THEME_SLUG ),
                'subtitle'  => __( 'Used for the cover image below the header bar', THEME_SLUG ),
                'default'   => true,
            ),

            array(
                'id'        => 'img_size_cover_height',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => __( 'Cover image height', THEME_SLUG ),
                'subtitle'  => __( 'Specify a height for the cover image', THEME_SLUG ),
                'desc'      => __( 'Note: Value is in px', THEME_SLUG ),
                'default'   => 500,
                'validate' => 'numeric',
                'required'  => array( 'img_size_cover', '=', true ),
            ),

            array(
                'id'        => 'img_size_lay_a',
                'type'      => 'switch',
                'title'     => __( 'Generate Layout A image size', THEME_SLUG ),
                'subtitle'  => __( 'Used for: Layout A, Single posts and Pages', THEME_SLUG ),
                'default'   => true,
            ),

            array(
                'id'        => 'img_size_lay_a_ratio',
                'type'      => 'radio',
                'title'     => __( 'Layout A image ratio', THEME_SLUG ),
                'subtitle'  => __( 'Choose an image ratio for Layout A', THEME_SLUG ),
                'options'   => array(
                    'original' => __( 'Original (ratio as uploaded - do not crop)', THEME_SLUG ),
                    '4_3' => __( '4:3', THEME_SLUG ),
                    '16_9' => __( '16:9', THEME_SLUG ),
                    'custom' => __( 'Your custom ratio', THEME_SLUG )
                ),
                'default'   => 'original',
                'required'  => array( 'img_size_lay_a', '=', true ),
            ),

            array(
                'id'        => 'img_size_lay_a_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => __( 'Layout A image custom ratio', THEME_SLUG ),
                'subtitle'  => __( 'Specify your custom ratio for Layout A images', THEME_SLUG ),
                'desc'      => __( 'Note: put 3:4 or 2:1 or any custom ratio you want', THEME_SLUG ),
                'default'   => '',
                'required'  => array( 'img_size_lay_a_ratio', '=', 'custom' ),
            ),


            array(
                'id'        => 'img_size_lay_b',
                'type'      => 'switch',
                'title'     => __( 'Generate Layout B image size', THEME_SLUG ),
                'subtitle'  => __( 'Used for: Layout B and Sidewalk Posts widget', THEME_SLUG ),
                'default'   => true,
            ),

            array(
                'id'        => 'img_size_lay_b_ratio',
                'type'      => 'radio',
                'title'     => __( 'Layout B image ratio', THEME_SLUG ),
                'subtitle'  => __( 'Choose an image ratio for Layout A', THEME_SLUG ),
                'options'   => array(
                    'original' => __( 'Original (ratio as uploaded - do not crop)', THEME_SLUG ),
                    '4_3' => __( '4:3', THEME_SLUG ),
                    '16_9' => __( '16:9', THEME_SLUG ),
                    'custom' => __( 'Your custom ratio', THEME_SLUG )
                ),
                'default'   => '4_3',
                'required'  => array( 'img_size_lay_b', '=', true ),
            ),

            array(
                'id'        => 'img_size_lay_b_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => __( 'Layout B image custom ratio', THEME_SLUG ),
                'subtitle'  => __( 'Specify your custom ratio for Layout B images', THEME_SLUG ),
                'desc'      => __( 'Note: put 3:4 or 2:1 or any custom ratio you want', THEME_SLUG ),
                'default'   => '',
                'required'  => array( 'img_size_lay_b_ratio', '=', 'custom' ),
            ),

            array(
                'id'        => 'img_size_lay_c',
                'type'      => 'switch',
                'title'     => __( 'Generate Layout C image size', THEME_SLUG ),
                'subtitle'  => __( 'Used for: Layout C, Featured slider, Related posts and Sidewalk Posts widget (list)', THEME_SLUG ),
                'default'   => true,
            ),

            array(
                'id'        => 'img_size_lay_c_ratio',
                'type'      => 'radio',
                'title'     => __( 'Layout C image ratio', THEME_SLUG ),
                'subtitle'  => __( 'Choose an image ratio for Layout C', THEME_SLUG ),
                'options'   => array(
                    'original' => __( 'Original (ratio as uploaded - do not crop)', THEME_SLUG ),
                    '4_3' => __( '4:3', THEME_SLUG ),
                    '16_9' => __( '16:9', THEME_SLUG ),
                    'custom' => __( 'Your custom ratio', THEME_SLUG )
                ),
                'default'   => '4_3',
                'required'  => array( 'img_size_lay_c', '=', true ),
            ),

            array(
                'id'        => 'img_size_lay_c_custom',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => __( 'Layout C image custom ratio', THEME_SLUG ),
                'subtitle'  => __( 'Specify your custom ratio for Layout C images', THEME_SLUG ),
                'desc'      => __( 'Note: put 3:4 or 2:1 or any custom ratio you want', THEME_SLUG ),
                'default'   => '',
                'required'  => array( 'img_size_lay_c_ratio', '=', 'custom' ),
            ),

        ) )
);

/* Header */
Redux::setSection( $opt_name , array(
        'icon'      => ' el-icon-bookmark',
        'title'     => __( 'Header Styling', THEME_SLUG ),
        'desc'     => __( 'This is where you modify and style your header area', THEME_SLUG ),
        'fields'    => array(

            array(
                'id' => 'header_height',
                'type' => 'text',
                'class' => 'small-text',
                'title' => __( 'Header bar height', THEME_SLUG ),
                'subtitle' => __( 'Specify a height for your header area', THEME_SLUG ),
                'desc' => __( 'Note: Height value is in px.', THEME_SLUG ),
                'default' => 70,
                'validate' => 'numeric'
            ),

            array(
                'id' => 'logo_position',
                'type' => 'spacing',
                'title' => __( 'Logo/title position', THEME_SLUG ),
                'subtitle' => __( 'Specify left and top positions for your logo/website title placement inside the header bar', THEME_SLUG ),
                'top' => false,
                'left' => false,
                'default'            => array(
                    'padding-bottom'     => '22',
                    'padding-right'   => '0'
                )
            ),

            array(
                'id' => 'color_header_bg',
                'type' => 'color',
                'title' => __( 'Header bar background', THEME_SLUG ),
                'subtitle' => __( 'This option applies to your main header area', THEME_SLUG ),
                'transparent' => false,
                'default' => '#000000',
            ),

            array(
                'id'        => 'color_header_opc',
                'type'      => 'slider',
                'title'     => __( 'Header bar background transparency', THEME_SLUG ),
                'subtitle'  => __( 'Choose a value for the header bar transparency', THEME_SLUG ),
                'description' => __( 'Note: This option will be applied if the cover image is indented into the header bar', THEME_SLUG ),
                "default" => .2,
                'resolution' => 0.1,
                "min" => 0,
                "step" => .1,
                "max" => 1
            ),

            array(
                'id' => 'color_header_txt',
                'type' => 'color',
                'title' => __( 'Header bar text color', THEME_SLUG ),
                'subtitle' => __( 'This option applies to your navigation', THEME_SLUG ),
                'transparent' => false,
                'default' => '#ffffff',
            ),

            array(
                'id' => 'color_header_acc',
                'type' => 'color',
                'title' => __( 'Header bar accent color', THEME_SLUG ),
                'subtitle' => __( 'This option applies to your navigation links hover', THEME_SLUG ),
                'transparent' => false,
                'default' => '#00acc6',
            ),

             array(
                'id' => 'color_website_title',
                'type' => 'color',
                'title' => __( 'Site title color', THEME_SLUG ),
                'subtitle' => __( 'Specify a color for your website title (if the logo is not used)', THEME_SLUG ),
                'transparent' => false,
                'default' => '#ffffff',
            ),

             array(
                'id' => 'header_orientation',
                'type' => 'radio',
                'title' => __( 'Header bar width', THEME_SLUG ),
                'options' => array( 'narrow' => __( 'Narrow (content width)', THEME_SLUG ), 'wide' => __( 'Wide (browser width)', THEME_SLUG ) ),
                'subtitle' => __( 'Choose whether you want to use a narrow (content width) or a wide (window width) header', THEME_SLUG ),
                'default' => 'narrow',
            ),


            array(
                'id'        => 'color_cover_opc',
                'type'      => 'slider',
                'title'     => __( 'Cover overlay transparency', THEME_SLUG ),
                'subtitle'  => __( 'Choose a value for the cover image overlay transparency', THEME_SLUG ),
                "default" => .5,
                'resolution' => 0.1,
                "min" => 0,
                "step" => .1,
                "max" => 1
            ),

            array(
                'id'        => 'cover_indent',
                'type'      => 'switch',
                'title'     => __( 'Indent cover', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to indent your cover image into the header bar', THEME_SLUG ),
                'default'   => true,
            ),


            array(
                'id'        => 'header_search',
                'type'      => 'switch',
                'title'     => __( 'Display search', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to display the search icon after the main navigation', THEME_SLUG ),
                'default'   => true,
            ),

            array(
                'id'        => 'header_social',
                'type'      => 'switch',
                'title'     => __( 'Display social menu', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to display the social icon after the main navigation', THEME_SLUG ),
                'default'   => true,
            ),

            array(
                'id'        => 'sticky_header',
                'type'      => 'switch',
                'title'     => __( 'Sticky header', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to make the main navigation always visible (sticky)', THEME_SLUG ),
                'default'   => true,
            ),

            array(
                'id'        => 'sticky_header_offset',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => __( 'Sticky header offset', THEME_SLUG ),
                'subtitle'  => __( 'Specify after how many px of scrolling the sticky header should appear', THEME_SLUG ),
                'default'   => 600,
                'validate'  => 'numeric',
                'required' => array( 'sticky_header', '=', true )
            ),

             array(
                'id' => 'logo_custom_url',
                'type' => 'text',
                'title' => __( 'Logo/title custom URL', THEME_SLUG ),
                'subtitle' => __( 'Specify a URL if you want to link your logo/website title to some specific URL address. By default it will lead to your home page.', THEME_SLUG ),
                'default' => '',
                'validate' => 'url'
            )


        ) )
);

/* Content */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-screen',
        'title'     => __( 'Content Styling', THEME_SLUG ),
        'desc'     => __( 'This is where you style your main content area', THEME_SLUG ),
        'fields'    => array(

            array(
                'id'        => 'body_layout',
                'type'      => 'image_select',
                'title'     => __( 'Body layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose a general body layout', THEME_SLUG ),
                'options'   => array(
                    'wide' => array( 'title' => __( 'Full width', THEME_SLUG ),       'img' =>  IMG_URI.'admin/content_full.png' ),
                    'boxed' => array( 'title' => __( 'Boxed', THEME_SLUG ),       'img' => IMG_URI.'admin/content_boxed.png' ),
                ),
                'default'   => 'wide',

            ),

            array(
                'id'       => 'body_style',
                'type'     => 'background',
                'title'    => __( 'Body background', THEME_SLUG ),
                'subtitle' => __( 'Setup your body background color, image or pattern', THEME_SLUG ),
                'default'  => array(
                    'background-color' => '#f0f0f0',
                ),
                'required' => array( 'body_layout', '=', 'boxed' )
            ),

            array(
                'id' => 'color_content_bg',
                'type' => 'color',
                'title' => __( 'Content background', THEME_SLUG ),
                'subtitle' => __( 'Specify the main content background color', THEME_SLUG ),
                'transparent' => false,
                'default' => '#ffffff',
            ),

            array(
                'id' => 'color_content_title',
                'type' => 'color',
                'title' => __( 'Titles (headings) color', THEME_SLUG ),
                'subtitle' => __( 'Specify a color for posts/page/widget titles, h1, h2, h3, etc...', THEME_SLUG ),
                'transparent' => false,
                'default' => '#222222',
            ),

            array(
                'id' => 'color_content_txt',
                'type' => 'color',
                'title' => __( 'Main text', THEME_SLUG ),
                'subtitle' => __( 'This color applies to common text', THEME_SLUG ),
                'transparent' => false,
                'default' => '#333333',
            ),

            array(
                'id' => 'color_content_acc',
                'type' => 'color',
                'title' => __( 'Accent color', THEME_SLUG ),
                'subtitle' => __( 'This color applies to links, buttons, special elements, etc...', THEME_SLUG ),
                'transparent' => false,
                'default' => '#00acc6',
            ),

            array(
                'id' => 'color_content_meta',
                'type' => 'color',
                'title' => __( 'Meta color', THEME_SLUG ),
                'subtitle' => __( 'This color applies to miscellaneous items such as date labels, image captions, etc...', THEME_SLUG ),
                'transparent' => false,
                'default' => '#999999',
            ),

            array(
                'id'        => 'smooth_scroll',
                'type'      => 'switch',
                'title'     => __( 'Smooth scroll effect', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to enable smooth scroll effect for a stylish appearance of your content', THEME_SLUG ),
                'default'   => false,
            )

        ) )
);




/* Footer */

Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-bookmark-empty',
        'title'     => __( 'Footer Styling', THEME_SLUG ),
        'desc'     => __( 'This is where you style your footer area', THEME_SLUG ),
        'fields'    => array(

            array(
                'id' => 'footer_display',
                'type' => 'switch',
                'switch' => true,
                'title' => __( 'Enable footer widgetized area', THEME_SLUG ),
                'subtitle' => sprintf( __( 'Check if you want to include footer widgetized area in your theme. You can manage the footer content in the <a href="%s">Apperance -> Widgets</a> settings.', THEME_SLUG ), admin_url( 'widgets.php' ) ),
                'default' => true
            ),

            array(
                'id' => 'color_footer_bg',
                'type' => 'color',
                'title' => __( 'Footer background', THEME_SLUG ),
                'subtitle' => __( 'Specify a footer background color', THEME_SLUG ),
                'transparent' => false,
                'default' => '#121c20',
            ),


            array(
                'id' => 'color_footer_title',
                'type' => 'color',
                'title' => __( 'Headings color', THEME_SLUG ),
                'subtitle' => __( 'This color will apply to footer widget titles, headings, etc...', THEME_SLUG ),
                'transparent' => false,
                'default' => '#ffffff',
            ),

            array(
                'id' => 'color_footer_txt',
                'type' => 'color',
                'title' => __( 'Text color', THEME_SLUG ),
                'subtitle' => __( 'This is the standard text color for the footer', THEME_SLUG ),
                'transparent' => false,
                'default' => '#ffffff',
            ),

            array(
                'id' => 'color_footer_acc',
                'type' => 'color',
                'title' => __( 'Accent color', THEME_SLUG ),
                'subtitle' => __( 'This color will apply to buttons, links, etc...', THEME_SLUG ),
                'transparent' => false,
                'default' => '#00acc6',
            ),

            array(
                'id' => 'color_footer_meta',
                'type' => 'color',
                'title' => __( 'Meta color', THEME_SLUG ),
                'subtitle' => __( 'This color will apply to miscellaneous text like date, number of views, etc...', THEME_SLUG ),
                'transparent' => false,
                'default' => '#ffffff',
            ),


            array(
                'id' => 'enable_copyright',
                'type' => 'switch',
                'title' => __( 'Enable bottom bar / copyright area', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to include a copyright area below the footer', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id' => 'footer_copyright',
                'type' => 'editor',
                'title' => __( 'Copyright', THEME_SLUG ),
                'subtitle' => __( 'Specify the copyright text to show at the bottom of the website', THEME_SLUG ),
                'default' => __( 'Copyright &copy; 2015. Created by <a href="http://mekshq.com" target="_blank">Meks</a>. Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a>.', THEME_SLUG ),
                'args'   => array(
                    'textarea_rows'    => 3  ,
                    'default_editor' => 'html'                          ),
                'required' => array( 'enable_copyright', '=', true )
            ),


        ) )
);

/* Highlight */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-heart',
        'title'     => __( 'Highlight Posts', THEME_SLUG ),
        'desc'     => __( 'You can choose posts by a specific criteria and they will be displayed in different color/styling in order to stand out among other posts on the post listing templates.', THEME_SLUG ),
        'fields'    => array(

            array(
                'id'        => 'use_highlight',
                'type'      => 'switch',
                'title'     => __( 'Enable highlight posts', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to enable and use the highlight feature', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id' => 'color_highlight_bg',
                'type' => 'color',
                'title' => __( 'Background color', THEME_SLUG ),
                'subtitle' => __( 'Choose a background color for highlight posts', THEME_SLUG ),
                'transparent' => false,
                'default' => '#00acc6',
                'required' => array( 'use_highlight', '=', true )
            ),

            array(
                'id' => 'color_highlight_txt',
                'type' => 'color',
                'title' => __( 'Text color', THEME_SLUG ),
                'subtitle' => __( 'Choose a text color for highlight posts', THEME_SLUG ),
                'transparent' => false,
                'default' => '#ffffff',
                'required' => array( 'use_highlight', '=', true )
            ),

            array(
                'id'        => 'highlight_cat',
                'type'      => 'select',
                'data'      => 'categories',
                'multi'     => true,
                'title'     => __( 'In category', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to highlight posts that belong to a particular category', THEME_SLUG ),
                'desc'      => __( 'Note: You can select one or more categories. Leave empty for "all categories"', THEME_SLUG ),
                'required' => array( 'use_highlight', '=', true )
            ),

            array(
                'id'        => 'highlight_tag',
                'type'      => 'select',
                'data'      => 'tags',
                'multi'     => true,
                'title'     => __( 'Tagged with', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to highlight posts that are tagged with a specific tag(s)', THEME_SLUG ),
                'required' => array( 'use_highlight', '=', true )
            ),

            array(
                'id'        => 'highlight_comments',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => __( 'With more than "x" comments', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to highlight posts which have at least a certain number of comments', THEME_SLUG ),
                'desc'      => __( 'i.e. If you put 50, posts with more than 50 comments will be highlighted ', THEME_SLUG ),
                'validate'  => 'numeric',
                'default'   => '',
                'required' => array( 'use_highlight', '=', true )
            ),

            array(
                'id'        => 'highlight_views',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => __( 'With more than "x" views', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to highlight posts which have at least a certain number of views', THEME_SLUG ),
                'desc'      => __( 'i.e. If you put 50, posts with more than 50 views will be highlighted ', THEME_SLUG ),
                'validate'  => 'numeric',
                'default'   => '',
                'required' => array( 'use_highlight', '=', true )
            ),

            array(
                'id'        => 'highlight_manual',
                'type'      => 'select',
                'data'      => 'post',
                'multi'     => true,
                'sortable'     => true,
                'title'     => __( 'Pick manually', THEME_SLUG ),
                'subtitle'  => __( 'Choose your highlight posts manually', THEME_SLUG ),
                'args' => array( 'posts_per_page' => 100, 'post_type' => array( 'post' ) ),
                'required' => array( 'use_highlight', '=', true )
            ),

            array(
                'id'        => 'highlight_manual_ids',
                'type'      => 'text',
                'title'     => __( 'Choose posts by IDs', THEME_SLUG ),
                'subtitle'  => __( 'Due to certain limitations, the previous select option displays a maximum of 100 latest posts. Use this option to manually specify posts by their IDs if they cannot be found in the option above', THEME_SLUG ),
                'desc'      => __( 'Note: This option has a priority over the above option. Separate post IDs by comma, i.e. 43,56,26,187', THEME_SLUG ),
                'required' => array( 'use_highlight', '=', true )
            ),            


        ) )
);

/* Layout settings */

Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-th-large',
        'title'     => __( 'Post Layouts', THEME_SLUG ),
        'heading' => false,
        'fields'    => array(

            array(
                'id'        => 'section_layout_fa',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url(IMG_URI . 'admin/layout_fa.png').'"/>'.__( 'Featured slider', THEME_SLUG ),
                'subtitle'  => __( 'Manage options for posts displayed in the featured slider', THEME_SLUG ),
                'indent'   => false
            ),

            array(
                'id' => 'lay_fa_cat',
                'type' => 'switch',
                'title' => __( 'Display category', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display a category link for posts in the featured area', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id'        => 'lay_fa_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => __( 'Meta data', THEME_SLUG ),
                'subtitle'  => __( 'Check which meta data to show for posts in the featured area', THEME_SLUG ),
                'options'   => array(
                    'date' => __( 'Date/time', THEME_SLUG ),
                    'comments' => __( 'Comments', THEME_SLUG ),
                    'author' => __( 'Author', THEME_SLUG ),
                    'views' => __( 'Views', THEME_SLUG ),
                    'rtime' => __( 'Reading time', THEME_SLUG )
                ),
                'default' => array(
                    'date' => 0,
                    'comments' => 0,
                    'author' => 0,
                    'views' => 0,
                    'rtime' => 0
                )
            ),

            array(
                'id' => 'lay_fa_icon',
                'type' => 'switch',
                'title' => __( 'Post format icon', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display post format icons for posts in the featured area', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id' => 'lay_fa_autoplay',
                'type' => 'switch',
                'title' => __( 'Enable autoplay', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to auto-rotate posts in slider', THEME_SLUG ),
                'default' => false
            ),

            array(
                'id'        => 'section_layout_a',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url(IMG_URI . 'admin/layout_a.png').'"/>'.__( 'Layout A', THEME_SLUG ),
                'subtitle'  => __( 'Manage options for posts displayed in Layout A', THEME_SLUG ),
                'indent'   => false
            ),

           

            array(
                'id' => 'lay_a_fimg',
                'type' => 'switch',
                'title' => __( 'Display featured image/media', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display a featured image for posts in Layout A', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id' => 'lay_a_fimg_cap',
                'type' => 'switch',
                'title' => __( 'Display featured image caption', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display caption/description on the featured image', THEME_SLUG ),
                'default' => false,
                'required'  => array( 'lay_a_fimg', '=', true )
            ),

            array(
                'id' => 'lay_a_format',
                'type' => 'radio',
                'title' => __( 'Post formats display', THEME_SLUG ),
                'subtitle' => __( 'Choose what to display if a post has specific format (video, gallery, etc... )', THEME_SLUG ),
                'options'   => array(
                    'media' => __( 'Media (video, audio, gallery...)', THEME_SLUG ),
                    'icon' => __( 'Featured image', THEME_SLUG )
                ),
                'required'  => array( 'lay_a_fimg', '=', true ),
                'default' => 'media'
            ),

             array(
                'id' => 'lay_a_icon',
                'type' => 'switch',
                'title' => __( 'Post format icon', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display post format icons for posts in the Layout A', THEME_SLUG ),
                'required'  => array( 'lay_a_format', '=', 'icon' ),
                'default' => true
            ),

             array(
                'id' => 'lay_a_cat',
                'type' => 'switch',
                'title' => __( 'Display category', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display a category link for posts in Layout A', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id'        => 'lay_a_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => __( 'Meta data', THEME_SLUG ),
                'subtitle'  => __( 'Check which meta data to show for posts in Layout A', THEME_SLUG ),
                'options'   => array(
                    'date' => __( 'Date/time', THEME_SLUG ),
                    'comments' => __( 'Comments', THEME_SLUG ),
                    'author' => __( 'Author', THEME_SLUG ),
                    'views' => __( 'Views', THEME_SLUG ),
                    'rtime' => __( 'Reading time', THEME_SLUG )
                ),
                'default' => array(
                    'date' => 0,
                    'comments' => 0,
                    'author' => 1,
                    'views' => 1,
                    'rtime' => 1
                )
            ),

            array(
                'id' => 'lay_a_content_type',
                'type' => 'radio',
                'title' => __( 'Layout A content type', THEME_SLUG ),
                'subtitle' => __( 'Check how would you like to display post content for Layout A', THEME_SLUG ),
                'options'   => array(
                    'content' => __( 'Content (manually split with "<--more-->" tag)', THEME_SLUG ),
                    'excerpt' => __( 'Excerpt (automatically limit a certain number of characters)', THEME_SLUG )
                ),
                'default' => 'content'
            ),

            array(
                'id' => 'lay_a_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => __( 'Excerpt limit', THEME_SLUG ),
                'subtitle' => __( 'Specify your excerpt limit', THEME_SLUG ),
                'desc' => __( 'Note: Value represents number of characters', THEME_SLUG ),
                'default' => '380',
                'validate' => 'numeric',
                'required'  => array( 'lay_a_content_type', '=', 'excerpt' )
            ),

            array(
                'id'        => 'lay_a_actions',
                'type'      => 'checkbox',
                'multi'      => 'true',
                'title'     => __( 'Action buttons', THEME_SLUG ),
                'subtitle'  => __( 'Choose which actions to show for posts in Layout A', THEME_SLUG ),
                'options'   => array(
                    'rm' => __( 'Read more', THEME_SLUG ),
                    'comments' => __( 'Comments', THEME_SLUG ),
                    'share' => __( 'Share', THEME_SLUG ),
                ),
                'default' => array(
                    'rm' => 1,
                    'comments' => 1,
                    'share' => 1
                )
            ),

            array(
                'id'        => 'lay_a_pag',
                'type'      => 'image_select',
                'title'     => __( 'Pagination type', THEME_SLUG ),
                'subtitle'  => __( 'Choose a pagination type for Layout A', THEME_SLUG ),
                'options'   => sdw_get_pagination_layouts(),
                'default'   => 'numeric'
            ),

            array(
                'id'        => 'lay_a_ppp',
                'type'      => 'radio',
                'title'     => __( 'Posts per page', THEME_SLUG ),
                'subtitle'  => __( 'Choose how many posts per page you want to display for Layout A', THEME_SLUG ),
                'options'   => array(
                    'inherit' => sprintf( __( 'Inherit from global option in <a href="%s">Settings->Reading</a>', THEME_SLUG ), admin_url( 'options-general.php' ) ),
                    'custom' => __( 'Custom number', THEME_SLUG )
                ),
                'default'   => 'inherit'
            ),

            array(
                'id'        => 'lay_a_ppp_num',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => __( 'Number of posts per page', THEME_SLUG ),
                'default'   => get_option( 'posts_per_page' ),
                'required'  => array( 'lay_a_ppp', '=', 'custom' ),
                'validate'  => 'numeric'
            ),

            array(
                'id'        => 'lay_a_comb_num',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => __( 'Number of posts if combined', THEME_SLUG ),
                'subtitle'     => __( 'If Layout A is combined with another layout on the same page (i.e A+B or A+C), choose how many starter posts will be displayed in Layout A', THEME_SLUG ),
                'default'   => 1,
                'validate'  => 'numeric'
            ),

            array(
                'id'        => 'section_layout_b',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url(IMG_URI . 'admin/layout_b.png').'"/>'.__( 'Layout B', THEME_SLUG ),
                'subtitle'  => __( 'Manage options for posts displayed in Layout B', THEME_SLUG ),
                'indent' => false
            ),

            array(
                'id' => 'lay_b_cat',
                'type' => 'switch',
                'title' => __( 'Display category', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display a category link for posts in Layout B', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id'        => 'lay_b_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => __( 'Meta data', THEME_SLUG ),
                'subtitle'  => __( 'Check which meta data to show for posts in Layout B', THEME_SLUG ),
                'options'   => array(
                    'date' => __( 'Date/time', THEME_SLUG ),
                    'comments' => __( 'Comments', THEME_SLUG ),
                    'author' => __( 'Author', THEME_SLUG ),
                    'views' => __( 'Views', THEME_SLUG ),
                    'rtime' => __( 'Reading time', THEME_SLUG )
                ),
                'default' => array(
                    'date' => 1,
                    'comments' => 1,
                    'author' => 0,
                    'views' => 0,
                    'rtime' => 0
                )
            ),

            array(
                'id' => 'lay_b_excerpt',
                'type' => 'switch',
                'title' => __( 'Layout B excerpt', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to show a text excerpt for posts in Layout B', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id' => 'lay_b_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => __( 'Excerpt limit', THEME_SLUG ),
                'subtitle' => __( 'Specify your excerpt limit', THEME_SLUG ),
                'desc' => __( 'Note: Value represents number of characters', THEME_SLUG ),
                'default' => '200',
                'validate' => 'numeric',
                'required'  => array( 'lay_b_excerpt', '=', true )
            ),

            array(
                'id' => 'lay_b_icon',
                'type' => 'switch',
                'title' => __( 'Post format icon', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display post format icons for posts in Layout B', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id'        => 'lay_b_pag',
                'type'      => 'image_select',
                'title'     => __( 'Pagination type', THEME_SLUG ),
                'subtitle'  => __( 'Choose a pagination type for Layout B', THEME_SLUG ),
                'options'   => sdw_get_pagination_layouts(),
                'default'   => 'numeric'
            ),

            array(
                'id'        => 'lay_b_ppp',
                'type'      => 'radio',
                'title'     => __( 'Posts per page', THEME_SLUG ),
                'subtitle'  => __( 'Choose how many posts per page you want to display for Layout B', THEME_SLUG ),
                'options'   => array(
                    'inherit' => sprintf( __( 'Inherit from global option in <a href="%s">Settings->Reading</a>', THEME_SLUG ), admin_url( 'options-general.php' ) ),
                    'custom' => __( 'Custom number', THEME_SLUG )
                ),
                'default'   => 'inherit'
            ),

            array(
                'id'        => 'lay_b_ppp_num',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => __( 'Number of posts per page', THEME_SLUG ),
                'default'   => get_option( 'posts_per_page' ),
                'required'  => array( 'lay_b_ppp', '=', 'custom' ),
                'validate'  => 'numeric'
            ),

            array(
                'id'        => 'section_layout_c',
                'type'      => 'section',
                'title'     => '<img src="'.esc_url(IMG_URI . 'admin/layout_c.png').'"/>'.__( 'Layout C', THEME_SLUG ),
                'subtitle'  => __( 'Manage options for posts displayed in Layout C', THEME_SLUG ),
                'indent' => false
            ),

            array(
                'id' => 'lay_c_cat',
                'type' => 'switch',
                'title' => __( 'Display category', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display a category link for posts in Layout C', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id'        => 'lay_c_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => __( 'Meta data', THEME_SLUG ),
                'subtitle'  => __( 'Check which meta data to show for posts in Layout C', THEME_SLUG ),
                'options'   => array(
                    'date' => __( 'Date/time', THEME_SLUG ),
                    'comments' => __( 'Comments', THEME_SLUG ),
                    'author' => __( 'Author', THEME_SLUG ),
                    'views' => __( 'Views', THEME_SLUG ),
                    'rtime' => __( 'Reading time', THEME_SLUG )
                ),
                'default' => array(
                    'date' => 1,
                    'comments' => 1,
                    'author' => 0,
                    'views' => 0,
                    'rtime' => 0
                )
            ),

            array(
                'id' => 'lay_c_icon',
                'type' => 'switch',
                'title' => __( 'Post format icon', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display post format icons for posts in Layout C', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id'        => 'lay_c_pag',
                'type'      => 'image_select',
                'title'     => __( 'Pagination type', THEME_SLUG ),
                'subtitle'  => __( 'Choose a pagination type for Layout C', THEME_SLUG ),
                'options'   => sdw_get_pagination_layouts(),
                'default'   => 'numeric'
            ),

            array(
                'id'        => 'lay_c_ppp',
                'type'      => 'radio',
                'title'     => __( 'Posts per page', THEME_SLUG ),
                'subtitle'  => __( 'Choose how many posts per page you want to display for Layout C', THEME_SLUG ),
                'options'   => array(
                    'inherit' => sprintf( __( 'Inherit from global option in <a href="%s">Settings->Reading</a>', THEME_SLUG ), admin_url( 'options-general.php' ) ),
                    'custom' => __( 'Custom number', THEME_SLUG )
                ),
                'default'   => 'inherit'
            ),

            array(
                'id'        => 'lay_c_ppp_num',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => __( 'Number of posts per page', THEME_SLUG ),
                'default'   => get_option( 'posts_per_page' ),
                'required'  => array( 'lay_c_ppp', '=', 'custom' ),
                'validate'  => 'numeric'
            ),


        ) )
);

/* Home Page */

Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-home',
        'title'     => __( 'Home Page', THEME_SLUG ),
        'desc'     => __( 'This is where you manage your home page settings. In order to use these settings properly, you need to create a <strong>Home Page template</strong> and use it with the "front page displays static page" option in <a href="'.admin_url( 'options-reading.php' ).'">Settings -> Reading</a>', THEME_SLUG ),
        'fields'    => array(

            array(
                'id'        => 'home_cover',
                'type'      => 'switch',
                'title'     => __( 'Cover image', THEME_SLUG ),
                'subtitle'  => __( 'Choose whether you want to display a cover image on the home page', THEME_SLUG ),
                'desc' => __( 'You can change the cover image by uploading a "featured image" for the page that is set as the home page', THEME_SLUG ),
                'default'   => true
            ),

            array(
                'id'        => 'section_home_fa',
                'type'      => 'section',
                'title'     => ''.__( 'Featured area (slider) options', THEME_SLUG ),
                'subtitle'  => __( 'Manage options for the home page featured area (slider)', THEME_SLUG ),
                'indent'   => false
            ),


            array(
                'id'        => 'home_fa',
                'type'      => 'switch',
                'title'     => __( 'Display featured area', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to enable the featured area on the home page', THEME_SLUG ),
                'default'   => true
            ),

            array(
                'id'        => 'home_fa_limit',
                'type'      => 'text',
                'class' => 'small-text',
                'title'     => __( 'Number of featured area posts', THEME_SLUG ),
                'subtitle'  => __( 'Check how many posts you want to display in the featured area', THEME_SLUG ),
                'default'   => 6,
                'validate'  => 'numeric',
                'required' => array( 'home_fa', '=', true )
            ),

            array(
                'id'        => 'home_fa_order',
                'type'      => 'radio',
                'title'     => __( 'Featured area posts order by', THEME_SLUG ),
                'subtitle'  => __( 'Choose how to order posts in the home page featured area', THEME_SLUG ),
                'options'   => sdw_get_post_order_opts( array( 'exclude' => array( 'rand' ) ) ),
                'default'   => 'date',
                'required' => array( 'home_fa', '=', true )
            ),

            array(
                'id'        => 'home_fa_cat',
                'type'      => 'select',
                'data'      => 'categories',
                'multi'     => true,
                'title'     => __( 'In category', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to display posts in the featured area only from a specific category(s)', THEME_SLUG ),
                'desc'      => __( 'Note: You can select one or more categories. Leave empty for "all categories"', THEME_SLUG ),
                'required' => array( 'home_fa_order', '!=', 'manual' )
            ),

            array(
                'id'        => 'home_fa_tag',
                'type'      => 'select',
                'data'      => 'tags',
                'multi'     => true,
                'title'     => __( 'Tagged with', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to display posts in the featured area that are tagged with a specific tag(s)', THEME_SLUG ),
                'desc'      => __( 'Note: You can select one or more tags. Leave empty for "all tags"', THEME_SLUG ),
                'required' => array( 'home_fa_order', '!=', 'manual' )
            ),

            array(
                'id'        => 'home_fa_time',
                'type'      => 'radio',
                'title'     => __( 'Not older than', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to display posts which are not older than a specific time difference', THEME_SLUG ),
                'options'   => sdw_get_time_diff_opts(),
                'default'   => '0',
                'required' => array( 'home_fa_order', '!=', 'manual' )
            ),

            array(
                'id'        => 'home_fa_manual',
                'type'      => 'select',
                'data'      => 'post',
                'multi'     => true,
                'sortable'     => true,
                'title'     => __( 'Choose posts', THEME_SLUG ),
                'subtitle'  => __( 'Pick your featured area posts manually', THEME_SLUG ),
                'required' => array( 'home_fa_order', '=', 'manual' ),
                'args' => array( 'posts_per_page' => 100, 'post_type' => array( 'post', 'page' ) )
            ),

            array(
                'id'        => 'home_fa_manual_force',
                'type'      => 'text',
                'title'     => __( 'Choose posts/pages by IDs', THEME_SLUG ),
                'subtitle'  => __( 'Due to certain limitations, the previous select option displays a maximum of 100 latest posts/pages. Use this option to manually specify posts or pages by their IDs if they cannot be found in the option above', THEME_SLUG ),
                'desc'      => __( 'Note: This option has priority over above option. Separate post/page ids by comma, i.e. 43,56,26,187', THEME_SLUG ),
                'required' => array( 'home_fa_order', '=', 'manual' )
            ),

            array(
                'id'        => 'home_do_not_duplicate',
                'type'      => 'switch',
                'title'     => __( 'Do not duplicate', THEME_SLUG ),
                'subtitle'  => __( 'Do not duplicate posts on the home page (if posts are displayed inside the featured area they will not be displayed inside the post listing below)', THEME_SLUG ),
                'default'   => false,
                'required' => array( 'home_fa', '=', true )
            ),

            array(
                'id'        => 'section_home_main',
                'type'      => 'section',
                'title'     => ''.__( 'Main content', THEME_SLUG ),
                'subtitle'  => __( 'Manage options for home page main content', THEME_SLUG ),
                'indent'   => false
            ),

            array(
                'id'        => 'home_layout',
                'type'      => 'image_select',
                'title'     => __( 'Home page layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose a layout for the home page posts', THEME_SLUG ),
                'options'   => sdw_get_main_layouts(),
                'default'   => 'a_b',
            ),

            array(
                'id'        => 'home_use_sidebar',
                'type'      => 'image_select',
                'title'     => __( 'Home sidebar layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose a sidebar layout for home page', THEME_SLUG ),
                'options'   => sdw_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'home_sidebar',
                'type'      => 'select',
                'title'     => __( 'Home standard sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose the home page standard sidebar', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sidebar',
                'required'  => array( 'home_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'home_sticky_sidebar',
                'type'      => 'select',
                'title'     => __( 'Home sticky sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose the home page sticky sidebar', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sticky_sidebar',
                'required'  => array( 'home_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'home_order',
                'type'      => 'radio',
                'title'     => __( 'Order posts by', THEME_SLUG ),
                'subtitle'  => __( 'Choose how to order posts on the home page', THEME_SLUG ),
                'options'   => sdw_get_post_order_opts( array( 'exclude' => array( 'rand' ) ) ),
                'default'   => 'date',
            ),

            array(
                'id'        => 'home_cat',
                'type'      => 'select',
                'data'      => 'categories',
                'multi'     => true,
                'title'     => __( 'In category', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to display posts only from a specific category(s)', THEME_SLUG ),
                'desc'      => __( 'Note: You can select one or more categories. Leave empty for "all categories"', THEME_SLUG ),
                'required' => array( 'home_order', '!=', 'manual' )
            ),

            array(
                'id'        => 'home_tag',
                'type'      => 'select',
                'data'      => 'tags',
                'multi'     => true,
                'title'     => __( 'Tagged with', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to display posts that are tagged with a specific tag(s)', THEME_SLUG ),
                'desc'      => __( 'Note: You can select one or more tags. Leave empty for "all tags"', THEME_SLUG ),
                'required' => array( 'home_order', '!=', 'manual' )
            ),

            array(
                'id'        => 'home_time',
                'type'      => 'radio',
                'title'     => __( 'Not older than', THEME_SLUG ),
                'subtitle'  => __( 'Check if you want to display posts that are not older than a specific time difference', THEME_SLUG ),
                'options'   => sdw_get_time_diff_opts(),
                'default'   => '0',
                'required' => array( 'home_order', '!=', 'manual' )
            ),

            array(
                'id'        => 'home_manual',
                'type'      => 'select',
                'data'      => 'post',
                'multi'     => true,
                'sortable'     => true,
                'title'     => __( 'Choose posts', THEME_SLUG ),
                'subtitle'  => __( 'Pick your home page posts manually', THEME_SLUG ),
                'required' => array( 'home_order', '=', 'manual' ),
                'args' => array( 'posts_per_page' => 100 )
            ),

            array(
                'id'        => 'home_manual_force',
                'type'      => 'text',
                'title'     => __( 'Choose posts/pages by IDs', THEME_SLUG ),
                'subtitle'  => __( 'Due to certain limitations, the previous select option displays a maximum 100 latest posts/pages. Use this option to manually specify posts or pages by their IDs if they cannot be found in the option above', THEME_SLUG ),
                'desc'      => __( 'Note: This option has priority over above option. Separate post/page ids by comma, i.e. 43,56,26,187', THEME_SLUG ),
                'required' => array( 'home_order', '=', 'manual' )
            ),
        ) )
);

/* Single Post */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-pencil',
        'title'     => __( 'Single Post Template', THEME_SLUG ),
        'desc'     => __( 'Manage settings for the single post template', THEME_SLUG ),
        'fields'    => array(

            array(
                'id'        => 'single_layout',
                'type'      => 'image_select',
                'title'     => __( 'Single post layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose a default layout for single posts', THEME_SLUG ),
                'desc' => __( 'Note: You can override this option for each specific post', THEME_SLUG ),
                'options'   => sdw_get_single_layouts(),
                'default'   => 'classic'
            ),

            array(
                'id'        => 'single_use_sidebar',
                'type'      => 'image_select',
                'title'     => __( 'Sidebar layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose a default sidebar layout for single posts', THEME_SLUG ),
                'desc' => __( 'Note: You can override this option for each particular post', THEME_SLUG ),
                'options'   => sdw_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'single_sidebar',
                'type'      => 'select',
                'title'     => __( 'Post standard sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose a single post standard sidebar', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sidebar',
                'required'  => array( 'single_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'single_sticky_sidebar',
                'type'      => 'select',
                'title'     => __( 'Post sticky sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose a single post sticky sidebar', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sticky_sidebar',
                'required'  => array( 'single_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'single_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => __( 'Meta data', THEME_SLUG ),
                'subtitle'  => __( 'Check which meta data to show for single posts', THEME_SLUG ),
                'options'   => array(
                    'date' => __( 'Date/time', THEME_SLUG ),
                    'comments' => __( 'Comments', THEME_SLUG ),
                    'author' => __( 'Author', THEME_SLUG ),
                    'views' => __( 'Views', THEME_SLUG ),
                    'rtime' => __( 'Reading time', THEME_SLUG )
                ),
                'default' => array(
                    'date' => 1,
                    'comments' => 0,
                    'author' => 1,
                    'views' => 1,
                    'rtime' => 1
                )
            ),

            array(
                'id' => 'show_cat',
                'type' => 'switch',
                'title' => __( 'Display category link', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display a category link', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id' => 'show_fimg',
                'type' => 'switch',
                'title' => __( 'Display featured image', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display the featured image', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id' => 'show_fimg_cap',
                'type' => 'switch',
                'title' => __( 'Display featured image caption', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display a caption/description on the featured image', THEME_SLUG ),
                'default' => false,
                'required'  => array( 'show_fimg', '=', true )
            ),

            array(
                'id' => 'show_tags',
                'type' => 'switch',
                'title' => __( 'Display tags', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display tags below the post content', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id'        => 'single_actions',
                'type'      => 'checkbox',
                'multi'      => 'true',
                'title'     => __( 'Action buttons', THEME_SLUG ),
                'subtitle'  => __( 'Check which actions to show for single posts', THEME_SLUG ),
                'options'   => array(
                    'comments' => __( 'Comments', THEME_SLUG ),
                    'share' => __( 'Share', THEME_SLUG ),
                ),
                'default' => array(
                    'comments' => 1,
                    'share' => 1
                )
            ),

            array(
                'id' => 'show_prev_next',
                'type' => 'switch',
                'title' => __( 'Display previous/next post links', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display the previous and next post links for the current post.', THEME_SLUG ),
                'default' => true
            ),
            array(
                'id' => 'prev_next_cat',
                'type' => 'checkbox',
                'title' => __( 'Previous/next links to posts from the same category?', THEME_SLUG ),
                'subtitle' => __( 'Check if you want the previous and next post links to display only posts from the same category.', THEME_SLUG ),
                'default' => false,
                'required' => array( 'show_prev_next', '=', '1' )
            ),

            array(
                'id' => 'show_author_box',
                'type' => 'switch',
                'title' => __( 'Display author box', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to display the "about the author" area.', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id' => 'show_cover_excerpt',
                'type' => 'switch',
                'title' => __( 'Display post excerpt in cover area', THEME_SLUG ),
                'subtitle' => __( 'Check this option if you want to show the post excerpt in the cover area', THEME_SLUG ),
                'default' => false
            ),

            array(
                'id' => 'section_related',
                'type' => 'section',
                'title' => __( 'Related posts', THEME_SLUG ),
                'subtitle' => __( 'These are options for the related posts area below the single post', THEME_SLUG ),
                'default' => true,
                'indent' => false
            ),

            array(
                'id' => 'show_related',
                'type' => 'switch',
                'title' => __( 'Display "related" posts box', THEME_SLUG ),
                'subtitle' => __( 'Choose if you want to display an additional area with related posts below the post content', THEME_SLUG ),
                'default' => true
            ),

            array(
                'id'        => 'related_limit',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => __( 'Related area posts number limit', THEME_SLUG ),
                'default'   => 3,
                'validate'  => 'numeric',
                'required'  => array( 'show_related', '=', true ),
            ),

            array(
                'id'        => 'related_type',
                'type'      => 'radio',
                'title'     => __( 'Related area chooses from', THEME_SLUG ),
                'options'   => array(
                    'cat' => __( 'Posts located in the same category', THEME_SLUG ),
                    'tag' => __( 'Posts tagged with at least one same tag', THEME_SLUG ),
                    'cat_or_tag' => __( 'Posts located in the same category OR tagged with a same tag', THEME_SLUG ),
                    'cat_and_tag' => __( 'Posts located in the same category AND tagged with a same tag', THEME_SLUG ),
                    'author' => __( 'Posts by the same author', THEME_SLUG ),
                    '0' => __( 'All posts', THEME_SLUG )
                ),
                'default'   => 'cat',
                'required'  => array( 'show_related', '=', true ),
            ),

            array(
                'id'        => 'related_order',
                'type'      => 'radio',
                'title'     => __( 'Related posts are ordered by', THEME_SLUG ),
                'options'   => sdw_get_post_order_opts(),
                'default'   => 'date',
                'required'  => array( 'show_related', '=', true ),
            ),

            array(
                'id'        => 'related_time',
                'type'      => 'radio',
                'title'     => __( 'Related posts are not older than', THEME_SLUG ),
                'options'   => sdw_get_time_diff_opts(),
                'default'   => '0',
                'required'  => array( 'show_related', '=', true ),
            )

        ) )
);

/* Page */
Redux::setSection( $opt_name ,  array(
        'icon'      => 'el-icon-file-edit',
        'title'     => __( 'Page Template', THEME_SLUG ),
        'desc'     => __( 'Manage default settings for your pages', THEME_SLUG ),
        'fields'    => array(

            array(
                'id'        => 'page_layout',
                'type'      => 'image_select',
                'title'     => __( 'Page layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose a default layout for pages', THEME_SLUG ),
                'desc' => __( 'Note: You can override this option for each specific page', THEME_SLUG ),
                'options'   => sdw_get_single_layouts(),
                'default'   => 'classic'
            ),

            array(
                'id'        => 'page_use_sidebar',
                'type'      => 'image_select',
                'title'     => __( 'Sidebar layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose a default sidebar layout for pages', THEME_SLUG ),
                'desc' => __( 'Note: You can override this option for each particular page', THEME_SLUG ),
                'options'   => sdw_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'page_sidebar',
                'type'      => 'select',
                'title'     => __( 'Page standard sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose a page standard sidebar', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sidebar',
                'required'  => array( 'page_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'page_sticky_sidebar',
                'type'      => 'select',
                'title'     => __( 'Page sticky sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose a page sticky sidebar', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sticky_sidebar',
                'required'  => array( 'page_use_sidebar', '!=', 'none' )
            ),

            array(
                'id' => 'page_show_fimg',
                'type' => 'switch',
                'title' => __( 'Display the featured image', THEME_SLUG ),
                'subtitle' => __( 'Choose if you want to display the featured image on single pages', THEME_SLUG ),
                'default' => true,
            ),

            array(
                'id' => 'page_show_fimg_cap',
                'type' => 'switch',
                'title' => __( 'Display the featured image caption', THEME_SLUG ),
                'subtitle' => __( 'Choose if you want to display the caption/description on the featured image', THEME_SLUG ),
                'default' => false,
                'required'  => array( 'page_show_fimg', '=', true )
            ),


            array(
                'id' => 'page_show_share',
                'type' => 'switch',
                'title' => __( 'Display the share buttons', THEME_SLUG ),
                'subtitle' => __( 'Choose if you want to display the social share buttons', THEME_SLUG ),
                'default' => false
            ),

            array(
                'id' => 'page_first_p',
                'type' => 'switch',
                'title' => __( 'Display first paragraph as cover description', THEME_SLUG ),
                'subtitle' => __( 'If you check this option, the first paragraph on the page will be automatically displayed over the cover image', THEME_SLUG ),
                'default' => false
            ),

            array(
                'id' => 'page_show_comments',
                'type' => 'switch',
                'title' => __( 'Display comments', THEME_SLUG ),
                'subtitle' => __( 'Choose if you want to display comments on pages', THEME_SLUG ),
                'description' => __( 'Note: This is just an option to quickly hide the comments on pages. If you want to allow/disallow comments properly, you need to do it in the "Discussion" box for each particular page.', THEME_SLUG ),
                'default' => true
            )
        ) )
);

/* Categories */
Redux::setSection( $opt_name ,  array(
        'icon'      => 'el-icon-folder',
        'title'     => __( 'Category Template', THEME_SLUG ),
        'desc'     => __( 'Manage settings for the category templates. Note: these are global category settings, you can optionally modify these settings for each individual category.', THEME_SLUG ),
        'fields'    => array(

            array(
                'id'        => 'category_cover',
                'type'      => 'switch',
                'title'     => __( 'Cover image', THEME_SLUG ),
                'subtitle'  => __( 'Choose whether you want to display a cover image on the category template', THEME_SLUG ),
                'default'   => true
            ),


            array(
                'id'        => 'category_layout',
                'type'      => 'image_select',
                'title'     => __( 'Category posts main layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose how to display your posts on category templates', THEME_SLUG ),
                'desc'  => __( 'Note: You can override this option for each category separately', THEME_SLUG ),
                'options'   => sdw_get_main_layouts(),
                'default'   => 'b'
            ),

            array(
                'id'        => 'category_use_sidebar',
                'type'      => 'image_select',
                'title'     => __( 'Sidebar layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose a default sidebar layout for the category template', THEME_SLUG ),
                'options'   => sdw_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'category_sidebar',
                'type'      => 'select',
                'title'     => __( 'Category standard sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose a standard category sidebar', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sidebar',
                'required'  => array( 'category_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'category_sticky_sidebar',
                'type'      => 'select',
                'title'     => __( 'Category sticky sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose a sticky category sidebar', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sticky_sidebar',
                'required'  => array( 'category_use_sidebar', '!=', 'none' )
            ),

        ) )
);

/* Tags */
Redux::setSection( $opt_name , array(
        'icon'      => ' el-icon-tag',
        'title'     => __( 'Tag Template', THEME_SLUG ),
        'desc'     => __( 'Manage settings for the tag templates', THEME_SLUG ),
        'fields'    => array(

            array(
                'id'        => 'tag_cover',
                'type'      => 'switch',
                'title'     => __( 'Cover image', THEME_SLUG ),
                'subtitle'  => __( 'Choose whether you want to display a cover image on the tag template', THEME_SLUG ),
                'default'   => true
            ),

            array(
                'id'        => 'tag_layout',
                'type'      => 'image_select',
                'title'     => __( 'Tag archives layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose how to display your posts on the tag template', THEME_SLUG ),
                'options'   => sdw_get_main_layouts(),
                'default'   => 'b'
            ),


            array(
                'id'        => 'tag_use_sidebar',
                'type'      => 'image_select',
                'title'     => __( 'Sidebar layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose a sidebar layout for the tag template', THEME_SLUG ),
                'options'   => sdw_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'tag_sidebar',
                'type'      => 'select',
                'title'     => __( 'Tag standard sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose a standard sidebar for the tag template', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sidebar',
                'required'  => array( 'tag_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'tag_sticky_sidebar',
                'type'      => 'select',
                'title'     => __( 'Tag sticky sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose a sticky sidebar for the tag template', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sticky_sidebar',
                'required'  => array( 'tag_use_sidebar', '!=', 'none' )
            ),

        ) )
);

/* Author */
Redux::setSection( $opt_name ,  array(
        'icon'      => 'el-icon-user',
        'title'     => __( 'Author Template', THEME_SLUG ),
        'desc'     => __( 'Manage settings for the author templates', THEME_SLUG ),
        'fields'    => array(

            array(
                'id'        => 'author_cover',
                'type'      => 'switch',
                'title'     => __( 'Cover image', THEME_SLUG ),
                'subtitle'  => __( 'Choose if you want to display a cover image on the author template', THEME_SLUG ),
                'default'   => true
            ),

            array(
                'id'        => 'author_avatar',
                'type'      => 'switch',
                'title'     => __( 'Display author avatar', THEME_SLUG ),
                'subtitle'  => __( 'Choose if you want to display the author avatar/image', THEME_SLUG ),
                'default'   => true
            ),

            array(
                'id'        => 'author_desc',
                'type'      => 'switch',
                'title'     => __( 'Display author description', THEME_SLUG ),
                'subtitle'  => __( 'Choose if you want to display the author bio/description', THEME_SLUG ),
                'default'   => true
            ),

            array(
                'id'        => 'author_layout',
                'type'      => 'image_select',
                'title'     => __( 'Author archives layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose how to display your posts on the author template', THEME_SLUG ),
                'options'   => sdw_get_main_layouts(),
                'default'   => 'b'
            ),

            array(
                'id'        => 'author_use_sidebar',
                'type'      => 'image_select',
                'title'     => __( 'Sidebar layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose a sidebar layout for the author template', THEME_SLUG ),
                'options'   => sdw_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'author_sidebar',
                'type'      => 'select',
                'title'     => __( 'Author standard sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose a standard sidebar for the author template', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sidebar',
                'required'  => array( 'author_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'author_sticky_sidebar',
                'type'      => 'select',
                'title'     => __( 'Author sticky sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose a sticky sidebar for the author template', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sticky_sidebar',
                'required'  => array( 'author_use_sidebar', '!=', 'none' )
            ),

        ) )
);

/* Search */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-search',
        'title'     => __( 'Search Template', THEME_SLUG ),
        'desc'     => __( 'Manage settings for the search results template', THEME_SLUG ),
        'fields'    => array(

            array(
                'id'        => 'search_cover',
                'type'      => 'switch',
                'title'     => __( 'Cover image', THEME_SLUG ),
                'subtitle'  => __( 'Choose whether you want to display a cover image on the search results template', THEME_SLUG ),
                'default'   => true
            ),

            array(
                'id'        => 'search_layout',
                'type'      => 'image_select',
                'title'     => __( 'Search archives layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose how to display your posts on the search template', THEME_SLUG ),
                'options'   => sdw_get_main_layouts(),
                'default'   => 'b'
            ),

            array(
                'id'        => 'search_use_sidebar',
                'type'      => 'image_select',
                'title'     => __( 'Sidebar layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose a sidebar layout for the search template', THEME_SLUG ),
                'options'   => sdw_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'search_sidebar',
                'type'      => 'select',
                'title'     => __( 'Search standard sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose a standard sidebar for the search template', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sidebar',
                'required'  => array( 'search_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'search_sticky_sidebar',
                'type'      => 'select',
                'title'     => __( 'Search sticky sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose a sticky sidebar for the search template', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sticky_sidebar',
                'required'  => array( 'search_use_sidebar', '!=', 'none' )
            ),

        ) )
);

/* Archives */

Redux::setSection( $opt_name ,  array(
        'icon'      => 'el-icon-folder-open',
        'title'     => __( 'Archive Templates', THEME_SLUG ),
        'desc'     => __( 'Manage settings for other miscellaneous templates like date archives, post format archives, etc...', THEME_SLUG ),
        'fields'    => array(

            array(
                'id'        => 'archive_cover',
                'type'      => 'switch',
                'title'     => __( 'Cover image', THEME_SLUG ),
                'subtitle'  => __( 'Choose whether you want to display a cover image on archives', THEME_SLUG ),
                'default'   => true
            ),

            array(
                'id'        => 'archive_layout',
                'type'      => 'image_select',
                'title'     => __( 'Posts layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose how to display your posts on the archive templates', THEME_SLUG ),
                'options'   => sdw_get_main_layouts(),
                'default'   => 'b'
            ),

            array(
                'id'        => 'archive_use_sidebar',
                'type'      => 'image_select',
                'title'     => __( 'Sidebar layout', THEME_SLUG ),
                'subtitle'  => __( 'Choose a sidebar layout for the archive templates', THEME_SLUG ),
                'options'   => sdw_get_sidebar_layouts(),
                'default'   => 'right'
            ),

            array(
                'id'        => 'archive_sidebar',
                'type'      => 'select',
                'title'     => __( 'Archive standard sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose a standard sidebar for the archive templates', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sidebar',
                'required'  => array( 'archive_use_sidebar', '!=', 'none' )
            ),

            array(
                'id'        => 'archive_sticky_sidebar',
                'type'      => 'select',
                'title'     => __( 'Archive sticky sidebar', THEME_SLUG ),
                'subtitle'  => __( 'Choose a sticky sidebar for the archive templates', THEME_SLUG ),
                'options'   => sdw_get_sidebars_list(),
                'default'   => 'sdw_default_sticky_sidebar',
                'required'  => array( 'archive_use_sidebar', '!=', 'none' )
            ),
        ) )
);

/* Typography */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-fontsize',
        'title'     => __( 'Typography', THEME_SLUG ),
        'desc'     => __( 'Manage fonts and typography settings', THEME_SLUG ),
        'fields'    => array(

            array(
                'id'          => 'main_font',
                'type'        => 'typography',
                'title'       => __( 'Main text font', THEME_SLUG ),
                'google'      => true,
                'font-backup' => false,
                'font-size' => false,
                'color' => false,
                'line-height' => false,
                'text-align' => false,
                'units'       =>'px',
                'subtitle'    => __( 'This is your main font for standard text', THEME_SLUG ),
                'default'     => array(
                    'google'      => true,
                    'font-weight'  => '400',
                    'font-family' => 'Source Sans Pro',
                    'subsets' => 'latin-ext'
                ),
                'preview' => array(
                    'always_display' => true,
                    'font-size' => '16px',
                    'line-height' => '26px',
                    'text' => 'This is a font used for your main content on the website. Here at MeksHQ, we believe that readability is a very important part of any WordPress theme. This is an example of how a simple paragraph of text will look like on your website.'
                )
            ),

            array(
                'id'          => 'h_font',
                'type'        => 'typography',
                'title'       => __( 'Headings font', THEME_SLUG ),
                'google'      => true,
                'font-backup' => false,
                'font-size' => false,
                'color' => false,
                'line-height' => false,
                'text-align' => false,
                'units'       =>'px',
                'subtitle'    => __( 'This font is used for headings, titles, h-elements...', THEME_SLUG ),
                'default'     => array(
                    'google'      => true,
                    'font-weight'  => '300',
                    'font-family' => 'Merriweather',
                    'subsets' => 'latin-ext'
                ),
                'preview' => array(
                    'always_display' => true,
                    'font-size' => '24px',
                    'line-height' => '30px',
                    'text' => 'There is no good blog without great readability'
                )

            ),

            array(
                'id'          => 'nav_font',
                'type'        => 'typography',
                'title'       => __( 'Navigation font', THEME_SLUG ),
                'google'      => true,
                'font-backup' => false,
                'font-size' => false,
                'color' => false,
                'line-height' => false,
                'text-align' => false,
                'units'       =>'px',
                'subtitle'    => __( 'This font is used for the main website navigation', THEME_SLUG ),
                'default'     => array(
                    'font-weight'  => '300',
                    'font-family' => 'Source Sans Pro',
                    'subsets' => 'latin-ext'
                ),

                'preview' => array(
                    'always_display' => true,
                    'font-size' => '16px',
                    'text' => 'Home &nbsp;&nbsp;About &nbsp;&nbsp;Blog &nbsp;&nbsp;Contact'
                )

            ),
            array(
                'id' => 'text_upper',
                'type' => 'checkbox',
                'multi' => true,
                'title' => __( 'Uppercase text', THEME_SLUG ),
                'subtitle' => __( 'Check if you want to show CAPITAL LETTERS for specific elements', THEME_SLUG ),
                'options' => array(
                    'site-title a' => __( 'Site title', THEME_SLUG ),
                    'nav-menu li a' => __( 'Main navigation', THEME_SLUG ),
                    'entry-title' => __( 'Post/Page titles', THEME_SLUG ),
                    'sdw-title-area h1' => __( 'Archive titles', THEME_SLUG ),
                    'sdw-cover-area h1' => __( 'Cover area titles', THEME_SLUG ),
                    'sidebar .widget-title' => __( 'Widget titles', THEME_SLUG ),
                    'site-footer .widget-title' => __( 'Footer widget titles', THEME_SLUG ),
                ),
                'default' => array(
                    'site-title a' => 0,
                    'nav-menu li a' => 0,
                    'entry-title' => 0,
                    'sdw-title-area h1' => 0,
                    'sdw-cover-area h1' => 0,
                    'sidebar .widget-title' => 0,
                    'site-footer .widget-title' => 0,
                )
            )

        ) )
);

/* General */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-wrench',
        'title'     => __( 'General', THEME_SLUG ),
        'desc'     => __( 'These are the general theme settings', THEME_SLUG ),
        'fields'    => array(

            

            array(
                'id' => 'add_sidebars',
                'type' => 'text',
                'class' => 'small-text',
                'title' => __( 'Additional sidebars', THEME_SLUG ),
                'subtitle' => sprintf( __( 'Specify a number of additional sidebars you want to use in this theme. You can manage your sidebars through <a href="%s">Appearance -> Widgets</a>', THEME_SLUG ), admin_url( 'widgets.php' ) ),
                'desc' => __( 'Note: Leave empty for no additional sidebars.', THEME_SLUG ),
                'default' => 5,
                'validate' => 'numeric'
            ),

            array(
                'id'        => 'social_share',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => __( 'Social share buttons', THEME_SLUG ),
                'subtitle'  => __( 'Choose social networks that you want to use for sharing', THEME_SLUG ),
                'options'   => array(
                    'facebook' => __( 'Facebook', THEME_SLUG ),
                    'twitter' => __( 'Twitter', THEME_SLUG ),
                    'gplus' => __( 'Google+', THEME_SLUG ),
                    'pinterest' => __( 'Pinterest', THEME_SLUG ),
                    'linkedin' => __( 'LinkedIN', THEME_SLUG )
                ),
                'default' => array(
                    'facebook' => 1,
                    'twitter' => 1,
                    'gplus' => 1,
                    'pinterest' => 1,
                    'linkedin' => 1
                ),
            ),

            array(
                'id' => 'rtl_mode',
                'type' => 'switch',
                'title' => __( 'RTL mode (right to left)', THEME_SLUG ),
                'subtitle' => __( 'Enable this option if you are using right to left writing/reading', THEME_SLUG ),
                'default' => false
            ),
            array(
                'id' => 'rtl_lang_skip',
                'type' => 'text',
                'title' => __( 'Skip RTL for specific language(s)', THEME_SLUG ),
                'subtitle' => __( 'Paste specific WordPress language <a href="http://wpcentral.io/internationalization/" target="_blank">locale code</a> to exclude it from the RTL mode', THEME_SLUG ),
                'desc' => __( 'i.e. If you are using Arabic and English versions on the same WordPress installation you should put "en_US" in this field and its version will not be displayed as RTL. Note: To exclude multiple languages, separate by comma: en_US, de_DE', THEME_SLUG ),
                'default' => '',
                'required' => array( 'rtl_mode', '=', true )
            ),

            array(
                'id' => 'more_string',
                'type' => 'text',
                'class' => 'small-text',
                'title' => __( 'More string', THEME_SLUG ),
                'subtitle' => __( 'Specify your "more" string to append after limited post excerpts', THEME_SLUG ),
                'default' => '...',
                'validate' => 'no_html'
            ),

            array(
                'id'        => 'time_ago',
                'type'      => 'switch',
                'title'     => __( 'Display "time ago" format', THEME_SLUG ),
                'subtitle'  => __( 'Display post dates in "time ago" manner, like Twitter and Facebook (i.e 5 hours ago, 3 days ago, 2 weeks ago, 4 months ago, etc...)', THEME_SLUG ),
                'desc'  => sprintf( __( 'Note: If you disable this option, you can choose your preferred date format in <a href="%s">Settings -> General</a>', THEME_SLUG ), admin_url( 'options-general.php' ) ),
                'default'   => true
            ),

            array(
                'id'        => 'time_ago_limit',
                'type'      => 'radio',
                'title'     => __( 'Apply "time ago" to posts which are not older than', THEME_SLUG ),
                'options'   => sdw_get_time_diff_opts(),
                'default'   => '0',
                'required'  => array( 'time_ago', '=', true ),
            ),

            array(
                'id'        => 'ago_before',
                'type'      => 'checkbox',
                'title'     => __( 'Display "ago" word before date/time', THEME_SLUG ),
                'subtitle'  => __( 'By default, "ago" word goes after date/time string but in some languages different than English it is more proper to display it before.', THEME_SLUG ),
                'desc'  => __( 'Example: "Publie depuis 3 heures"', THEME_SLUG ),
                'default'   => false,
                'required'  => array( 'time_ago', '=', true )
            ),

            array(
                'id' => 'views_forgery',
                'type' => 'text',
                'class' => 'small-text',
                'title' => __( 'Post views forgery', THEME_SLUG ),
                'subtitle' => __( 'Specify a value to add to the real number of entry views for each post', THEME_SLUG ),
                'desc' => __( 'i.e. If a post has 45 views and you put 100, your post will display 145 views', THEME_SLUG ),
                'default' => '',
                'validate' => 'numeric'
            ),

            array(
                'id' => '404_img',
                'type' => 'media',
                'url' => true,
                'title' => __( '404 template image', THEME_SLUG ),
                'subtitle' => __( 'Upload an image for the 404 template (optional)', THEME_SLUG ),
                'desc' => __( 'Supported formats: .jpg and .png', THEME_SLUG ),
                'default' => array( 'url' => '' )
            )


        )
    )
);


Redux::setSection( $opt_name , array(
        'type' => 'divide',
        'id' => 'sdw-divide',
    ) );

/* Translation Options */

$translate_options[] = array(
    'id' => 'enable_translate',
    'type' => 'switch',
    'switch' => true,
    'title' => __( 'Enable theme translation?', THEME_SLUG ),
    'default' => '1'
);

$translate_strings = sdw_get_translate_options();

foreach ( $translate_strings as $string_key => $string ) {
    $translate_options[] = array(
        'id' => 'tr_'.$string_key,
        'type' => 'text',
        'title' => esc_html( $string['option_title'] ),
        'subtitle' => isset( $string['option_desc'] ) ? $string['option_desc'] : '',
        'default' => ''
    );
}

Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-globe-alt',
        'title' => __( 'Translation', THEME_SLUG ),
        'desc' => __( 'Use these settings to quckly translate or change the text in this theme. If you want to remove the text completely instead of modifying it, you can use <strong>"-1"</strong> as a value for particular field translation. <br/><br/><strong>Note:</strong> If you are using this theme for a multilingual website, you need to disable these options and use multilanguage plugins (such as WPML) or manual translation with .po and .mo files located inside the "languages" folder.', THEME_SLUG ),
        'fields' => $translate_options
    ) );

/* Additional code */

Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-css',
        'title' => __( 'Additional Code', THEME_SLUG ),
        'desc' =>  __( 'Modify the default styling of the theme by adding custom CSS or JavaScript code. <strong>Note:</strong> These options are for advanced users only, so use them with caution.', THEME_SLUG ),
        'fields' => array(


            array(
                'id'       => 'additional_css',
                'type'     => 'ace_editor',
                'title'    => __( 'Additional CSS', THEME_SLUG ),
                'subtitle' => __( 'Use this field to write or paste CSS code and modify the default theme styling', THEME_SLUG ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'default'  => ''
            ),

            array(
                'id'       => 'additional_js',
                'type'     => 'ace_editor',
                'title'    => __( 'Additional JavaScript', THEME_SLUG ),
                'subtitle' => __( 'Use this field to write or paste additional JavaScript code', THEME_SLUG ),
                'mode'     => 'javascript',
                'theme'    => 'monokai',
                'default'  => ''
            ),

            array(
                'id'       => 'ga',
                'type'     => 'ace_editor',
                'title'    => __( 'Google Analytics tracking code', THEME_SLUG ),
                'subtitle' => __( 'Paste your google analytics tracking code (or any other JavaScript related tracking code)', THEME_SLUG ),
                'mode'     => 'text',
                'theme'    => 'monokai',
                'default'  => ''
            )
        ) )
);


/* Updater Options */

Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-time',
        'title' => __( 'Updater', THEME_SLUG ),
        'desc' => sprintf( __( 'Specify your ThemeForest username and API Key in order to enable the quick Sidewalk theme updates. Whenever we release a new Sidewalk update it will appear on your <a href="%s">updates screen</a>.', THEME_SLUG ), admin_url( 'update-core.php' ) ),
        'fields' => array(

            array(
                'id' => 'theme_update_username',
                'type' => 'text',
                'title' => __( 'Your ThemeForest Username', THEME_SLUG ),
                'default' => ''
            ),

            array(
                'id' => 'theme_update_apikey',
                'type' => 'text',
                'title' => __( 'Your ThemeForest API Key', THEME_SLUG ),
                'desc' => __( 'Where can I find my <a href="http://themeforest.net/help/api" target="_blank">API key</a>?', THEME_SLUG ),
                'default' => ''
            )
        ) )
);


?>
