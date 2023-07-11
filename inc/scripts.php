<?php

function load_site_styles()
{
    global $CACHE_BUSTER;

    wp_enqueue_style('site-styles', CODE_BASE . '/css/site-styles.min.css', array(), $CACHE_BUSTER);
    wp_enqueue_style('main-style', CODE_BASE . '/css/main.min.css', array(), $CACHE_BUSTER);
    wp_enqueue_style('temp-style', CODE_BASE . '/css/temp.css', array(), $CACHE_BUSTER);
}


add_action("wp_enqueue_scripts", "load_site_styles");


function load_warning()
{

    // logger(get_queried_object());

    if (is_page() &&  get_queried_object()->ID == 8) {
        wp_enqueue_script('warning-script', CODE_BASE . '/assets/js/warning.js', array(), false, true);
    }
}



add_action("wp_enqueue_scripts", "load_warning");



function watch_for_order_mutation()
{

    // logger(get_queried_object());

    if (is_page() &&  get_queried_object()->ID == 6) {
        wp_enqueue_script('mutation-script', CODE_BASE . '/assets/js/order-mutation.js', array(), false, true);
    }
}



add_action("wp_enqueue_scripts", "watch_for_order_mutation");
