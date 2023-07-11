<?php



function mcluhan_body_classes($classes)
{

    // Check whether we're in the customizer preview
    if (is_customize_preview()) {
        $classes[] = 'customizer-preview';
    }


    if (is_page('shop')) {
        $classes[] = 'is-shop';
    }


    // if (is_page_template('page-shop.php')) {
    //     $classes[] = 'is-shop';
    // }


    return $classes;
}

add_action('body_class', 'mcluhan_body_classes');
