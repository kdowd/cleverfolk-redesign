<?php

// https://blacksaildivision.com/how-to-clean-up-wordpress-head-tag
function cleanup()
{
    remove_action('wp_head', 'wlwmanifest_link');
    // remove_action('wp_head', 'wp_generator');
}

add_action('init', 'cleanup');


function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'disable_emojis');

function change_default_jquery()
{
    if (current_user_can('level_1')) {
        return;
    }

    wp_dequeue_script('jquery');
    wp_deregister_script('jquery');
    wp_deregister_style('dashicons');
}

#removing jquery is dangerous - some script depend on it
#add_filter('wp_enqueue_scripts', 'change_default_jquery', PHP_INT_MAX);


//kills all those svgs
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
