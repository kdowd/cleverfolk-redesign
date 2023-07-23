<?php

// https://developer.wordpress.org/reference/functions/add_theme_support/

#add_theme_support('title-tag');




function my_wp_title($title, $sep)
{
    echo $title;
    return $title;
}
#add_filter('wp_title', 'my_wp_title', 10, 2);