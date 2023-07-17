<?php
// rpc blocked via htaccess
// add_filter('xmlrpc_enabled', '__return_false');

// Disable X-Pingback to header
// add_filter('wp_headers', 'disable_x_pingback');
function disable_x_pingback($headers)
{
    unset($headers['X-Pingback']);

    return $headers;
}
