<?php

function remove_admin_bar()
{
    show_admin_bar(false);
}

if (!function_exists('mcluhan_setup')) {
    function mcluhan_setup()
    {



        // Automatic feed
        add_theme_support('automatic-feed-links');

        // Set content-width
        global $content_width;
        if (!isset($content_width)) {
            $content_width = 1200;
        }

        // Post thumbnail support
        add_theme_support('post-thumbnails');

        // Post thumbnail size
        set_post_thumbnail_size(1200, 9999);

        // Custom image sizes
        //add_image_size('mcluhan_preview-image', 600, 9999);

        // Background color
        add_theme_support('custom-background', array(
            'default-color' => 'ffffff',
        ));

        // Title tag support
        add_theme_support('title-tag');

        // Add nav menu
        register_nav_menu('main-menu', __('Main menu', 'mcluhan'));
        register_nav_menu('social-menu', __('Social links', 'mcluhan'));

        // Add excerpts to pages
        add_post_type_support('page', array('excerpt'));

        // HTML5 semantic markup
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

        // Make the theme translation ready
        load_theme_textdomain('mcluhan', get_template_directory() . '/languages');
    }
} // End if().

add_action('after_setup_theme', 'mcluhan_setup');


/*	-----------------------------------------------------------------------------------------------
	DEACTIVATE DEFAULT CORE GALLERY STYLES
	Only applies to the shortcode gallery.
--------------------------------------------------------------------------------------------------- */

add_filter('use_default_gallery_style', '__return_false');
