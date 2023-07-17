<?php

if (!defined('GA_FORM_NONCE')) {
    define("GA_FORM_NONCE", "cleverfolk_2023");
}

function create_inline_mailchimp_form($atts = array())
{
    extract(shortcode_atts(
        array(
            'page' => null,
        ),
        $atts
    ));


    $nonce = wp_create_nonce(GA_FORM_NONCE);
    $action = esc_url(admin_url('admin-ajax.php'));


    $form = "<form onsubmit='generic_form_send(event)' action={$action} method='post' class='generic-form'>
        <div class='form-internals'>
        <input type='hidden' name='action' value='my_generic_contact_form'>
        <input type='hidden' name='form-name' value='generic'>
        <input type='hidden' name='_ajax_nonce' value={$nonce}>
         <input type='hidden' name='nonce' value={$nonce}>
        </div>
        <label for='user-email'>Email <span class='required-star'>*</span></label>
        <input type='email' name='user-email' id='user-email' required placeholder='your email, so we can reply...'>
        <input type='text' name='user-order-id' id='user-order-id' placeholder='order ID, optional.' >
 
        <label for='user-message'>Message <span class='required-star'>*</span></label>
        <textarea name='user-message' id='user-message' cols='30' rows='10' required placeholder='your message...'></textarea>
       
        <div class='success-message' style='display:none;'>
        <p>Thanks for messaging !<br>We'll be in touch soon.</p>
        </div>
        <div id='error-message' class='error-message message-" . get_the_ID() . "' style='display:none;'>
        <p>There was a problem receiving your message.<br>Please try again.</p>
        </div>
        <input type='submit' value='Send'>
        <svg style='display:none; vertical-align: middle;' xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 24 24'>
        <path fill='currentColor' d='M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z' opacity='.25'/>
        <path fill='currentColor' d='M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z'>
        <animateTransform attributeName='transform' dur='0.75s' repeatCount='indefinite' type='rotate' values='0 12 12;360 12 12'/>
        </path>
        </svg>
    </form>";



    return $form;
}
add_shortcode("generic_inline_form", "create_inline_mailchimp_form");
