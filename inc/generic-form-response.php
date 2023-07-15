<?php

add_action('init', function () {
    add_action('wp_ajax_nopriv_my_generic_contact_form', 'my_generic_contact_form');
    add_action('wp_ajax_my_generic_contact_form', 'my_generic_contact_form');
});


function my_generic_contact_form()
{
    // print_r($_POST);



    if (!wp_verify_nonce($_POST['nonce'], GA_FORM_NONCE)) {
        wp_die("Are you being naughty?" . $_POST['nonce']);
    }

    if (empty($_POST['user-email']) || empty($_POST['user-message'])) {
        wp_send_json(array('success'  => false));
        wp_die("Are you being naughty?");
    }

    if (empty($_POST['user-order-id'])) {
        $orderID = "order number not set";
    } else {
        $orderID = sanitize_text_field($_POST['user-order-id']);
    }



    $to = 'kevin.dowd@gmail.com';
    $subject = "CleverFolk message: " . $orderID;
    $message = sanitize_text_field($_POST['user-email']) . PHP_EOL . sanitize_text_field($_POST['user-message']);
    $$headers = null;
    $attachments = null;
    //$headers = array('Content-Type: text/html; charset=UTF-8');

    // if (DEV_MODE) {
    //     wp_send_json(array('dev_mode'  => true));
    //     wp_die("in dev mode");
    // }

    $emailResult = wp_mail($to, $subject, $message, $headers, $attachments);
    wp_send_json(array('success'  => $emailResult));
    wp_die();
}


function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
