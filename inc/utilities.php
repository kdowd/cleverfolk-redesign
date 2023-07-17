<?php


// add_action('wp', 'hide_admin_bar');
// add_action('admin_init', 'hide_admin_bar', 9);

function hide_admin_bar()
{
    //  if (!current_user_can('manage_options')) {
    show_admin_bar(true);
    // }
}


//  Functions to display a list of all the shortcodes
function diwp_get_list_of_shortcodes()
{

    // Get the array of all the shortcodes
    global $shortcode_tags;

    $shortcodes = $shortcode_tags;

    // sort the shortcodes with alphabetical order
    ksort($shortcodes);

    $shortcode_output = "<ul>";

    foreach ($shortcodes as $shortcode => $value) {
        $shortcode_output = $shortcode_output . '<li>[' . $shortcode . ']</li>';
    }

    $shortcode_output = $shortcode_output . "</ul>";
    //   [get-shortcode-list] 
    return $shortcode_output;
}
add_shortcode('get-shortcode-list', 'diwp_get_list_of_shortcodes');


function console_output($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}


function show_addition_image_sizes()
{
    // in addition to the defaults
    global $_wp_additional_image_sizes;
    print '<pre>';
    print_r($_wp_additional_image_sizes);
    print '</pre>';
}