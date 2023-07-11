<?php

// some great hacks here:
// https://wpsimplehacks.com/woocommerce-single-product-page-hacks/
//https://www.businessbloomer.com/woocommerce-change-return-shop-url/
//https://wpbeaches.com/tag/woocommerce/


/* THESE ARE UNLINKED IN FUNCTIONS PHP*/

/**
 * Changes the redirect URL for the Return To Shop button ( ONLY )in the cart.
 */

add_filter('woocommerce_is_purchasable', '__return_false');


add_filter('woocommerce_return_to_shop_redirect', 'custom_empty_cart', 10);
function custom_empty_cart()
{
    // return get_home_url('empty_cart');
    return site_url() . '/empty-cart';
}



add_filter('woocommerce_product_query_meta_query', 'shop_only_instock_products', 10, 2);
function shop_only_instock_products($meta_query, $query)
{

    // Only on shop archive pages
    if (is_admin() || is_search() || !is_shop()) return $meta_query;
    $meta_query[] = array(
        'key' => '_stock_status',
        'value' => 'outofstock',
        'compare' => ' != '
    );

    return $meta_query;
}


// this will exclude the item from the shop page
// but not from my custom front page for this site
add_filter('woocommerce_product_query_meta_query', 'filter_product_query_meta_query', 10, 2);
function filter_product_query_meta_query($meta_query, $query)
{

    if (is_shop()) {
        logger($meta_query);
    }


    // Exclude products "out of stock"
    $meta_query[] = array(
        'key' => '_stock_status',
        'value' => 'outofstock',
        'compare' => '!=',
    );

    return $meta_query;
}


add_action('pre_get_posts', 'hide_out_of_stock_in_search');
function hide_out_of_stock_in_search($query)
{
    if ($query->is_search() && $query->is_main_query()) {
        $query->set('meta_key', '_stock_status');
        $query->set('meta_value', 'instock');
    }
}


function hide_out_of_stock_option($option)
{
    return 'yes';
}

add_action('woocommerce_before_template_part', function ($template_name) {
    if ($template_name !== "single-product/related.php") {
        return;
    }

    add_filter('pre_option_woocommerce_hide_out_of_stock_items', 'hide_out_of_stock_option');
});

add_action('woocommerce_after_template_part', function ($template_name) {
    if ($template_name !== "single-product/related.php") {
        return;
    }

    remove_filter('pre_option_woocommerce_hide_out_of_stock_items', 'hide_out_of_stock_option');
});


function custom_remove_all_quantity_fields($return, $product)
{
    return true;
}
add_filter('woocommerce_is_sold_individually', 'custom_remove_all_quantity_fields', 10, 2);


//OR
add_filter('woocommerce_is_sold_individually', 'cw_remove_quantity_fields');
function cw_remove_quantity_fields($return, $product)
{
    switch ($product->product_type):

        case "grouped":
            return true;
            break;
        case "external":
            return true;
            break;
        case "variable":
            return true;
            break;
        default:
            return true;
            break;
    endswitch;
}


add_filter('woocommerce_show_variation_price', function () {
    return TRUE;
});


//To create special emails based on the product that a customer purchases
add_action('woocommerce_email_order_details', 'uiwc_email_order_details_products', 1, 4);

function uiwc_email_order_details_products($order, $admin, $plain, $email)
{
    $status = $order->get_status();

    // checking if it's the order status we want
    if ($status == "completed") {

        // the IDs of our VIP products
        $prod_arr = array(21, 37, 85);

        // getting the order products
        $items = $order->get_items();

        // starting the bought products variable
        $bought = false;

        // let's loop through each of them
        foreach ($items as $item) {

            // checking if the ordered product is a VIP product
            if (in_array($item['product_id'], $prod_arr)) {
                $bought = true;
            }
        }

        if ($bought) {

            //using WP's function for localization
            echo __('<strong>Premium offer:</strong> Your ordered products puts you in our VIP list.
You can <a href="#">sign up for it here</a>.', 'uiwc');
        }
    }
}



// https://passwordprotectwp.com/category/wordpress-tutorials/
// If you want to send your customers a special message or offer once the total value 
// of their order exceeds a certain amount (let’s say $100), this section is for you. 


//https://passwordprotectwp.com/submit-websites-to-search-engines/
//https://passwordprotectwp.com/how-to-index-your-page-on-search-engine/



add_action('woocommerce_email_order_details', 'uiwc_email_order_details', 1, 4);

function uiwc_email_order_details($order, $admin, $plain, $email)
{

    $total = $order->get_total();

    $status = $order->get_status();

    if ($total >= 100) {

        if ($status == "completed") {

            //using WordPress' function for localization
            echo __('<strong>Discount code:</strong> Thank you for your purchase.
You can redeem it in future purchases at <a href="#">our store</a>.', 'uiwc');
        }
    }
}



// hide price variations
function wc_varb_price_range($wcv_price, $product)
{

    $prefix = sprintf('%s: ', __('From', 'wcvp_range'));

    $wcv_reg_min_price = $product->get_variation_regular_price('min', true);

    $wcv_min_sale_price    = $product->get_variation_sale_price('min', true);

    $wcv_max_price = $product->get_variation_price('max', true);

    $wcv_min_price = $product->get_variation_price('min', true);

    $wcv_price = ($wcv_min_sale_price == $wcv_reg_min_price) ?

        wc_price($wcv_reg_min_price) :

        '<del>' . wc_price($wcv_reg_min_price) . '</del>' . '<ins>' . wc_price($wcv_min_sale_price) . '</ins>';

    return ($wcv_min_price == $wcv_max_price) ?

        $wcv_price :

        sprintf('%s%s', $prefix, $wcv_price);
}

add_filter('woocommerce_variable_sale_price_html', 'wc_varb_price_range', 10, 2);

add_filter('woocommerce_variable_price_html', 'wc_varb_price_range', 10, 2);



// order
// https://woocommerce.github.io/code-reference/classes/WC-Order.html
function getWC_order_details($order_id)
{
    $order = new WC_Order($order_id);
    //var_dump($order);
    $order_shipping_total = $order->get_shipping();
    $order_shipping_method = $order->get_shipping_methods();
    var_dump($order_shipping_total); //Use it for debugging purpose or to see details in that array
    var_dump($order_shipping_method); //Use it for debugging purpose or to see details in that array

    $_order =   $order->get_items(); //to get info about product
    foreach ($_order as $order_product_detail) {
        //var_dump($order_product_detail);
        echo "<b>Product ID:</b> " . $order_product_detail['product_id'] . "<br>";
        echo "<b>Product Name:</b> " . $order_product_detail['name'] . "<br><br>";
    }
    //var_dump($_order);
}


// uses the title filter - so wil inject html just afetr the title
#add_action('woocommerce_before_shop_loop_item', 'iconic_available_attributes', 20);
add_action('woocommerce_after_shop_loop_item_title', 'add_attribute', 5);
function add_attribute()
{
    $desired_att = 'Size';
    global $product;
    $product_variable = new WC_Product_Variable($product->id);

    #logger($product_variable);

    // $product_variations = $product_variable->get_available_variations();
    // logger($$product_variations); 

    // echo '<span class="price">';
    // if ($numItems == 1) {
    //     foreach ($product_variations as $variation) {
    //         echo $variation['attributes']['med'];
    //     }
    // } else if ($numItems > 1) {
    //     $i = 0;
    //     foreach ($product_variations as $variation) {
    //         if (++$i === $numItems) {
    //             echo $variation['attributes']['med'];
    //         } else {
    //             echo $variation['attributes']['med'] . ", ";
    //         }
    //     }
    // }
    // echo '</span>';
}



////VARIATIONS
function test_func()
{
    global $woocommerce, $product, $post;
    // test if product is variable
    if ($product->is_type('variable')) {
        // Loop through available product variation data
        foreach ($product->get_available_variations() as $key => $variation) {
            // Loop through the product attributes for this variation
            foreach ($variation['attributes'] as $attribute => $term_slug) {
                // Get the taxonomy slug
                $taxonmomy = str_replace('attribute_', '', $attribute);

                // Get the attribute label name
                $attr_label_name = wc_attribute_label($taxonmomy);

                // Display attribute labe name
                $term_name = get_term_by('slug', $term_slug, $taxonmomy)->name;

                // Testing output
                echo '<p>' . $attr_label_name . ': ' . $term_name . '</p>';
            }
        }
    }
}


// OR

function create_product_variants($id, $product, $data)
{
    foreach ($data as $variation_data) {
        if (isset($variation_data['attribute_name']) && isset($variation_data['variant'])) {
            $variation = new WC_Product_Variation();

            $variation->set_parent_id($id); // Set parent ID

            $variation->set_regular_price($variation_data['price']); // Set price
            $variation->set_price($variation_data['price']); // Set price

            // Enable and set stock
            if (isset($variation_data['quantity'])) {
                $variation->set_manage_stock(true);
                $variation->set_stock_quantity($variation_data['quantity']);
                $variation->set_stock_status('instock');
            }

            $attributes      = array(); // Initializing
            $attribute_names = (array) $variation_data['attribute_name'];
            $attribute_terms = (array) $variation_data['variant'];

            // Formatting attributes data array
            foreach ($attribute_names as $key => $attribute_name) {
                $attributes[sanitize_title($attribute_name)] = $attribute_terms[$key];
            }

            $variation->set_attributes($attributes); // Set attributes
            $variation_id = $variation->save(); // Save to database (return the variation Id)
        }
    }
}


// good gists here:
// https://gist.github.com/kloon/


/**
 * Do not allow account creation with temp email addresses
 * @param  Object $validation_errors
 * @param  string $username
 * @param  string $email
 * @return WP_Error
 */
function do_not_allow_temp_email_addresses($validation_errors, $username, $email)
{
    $prohibitied_domains = array(
        'sharklasers.com',
        'grr.la',
        'guerrillamail.biz',
        'guerrillamail.com',
        'guerrillamail.de',
        'guerrillamail.net',
        'guerrillamail.org',
        'guerrillamailblock.com',
        'spam4.me',
    );

    $email_domain = explode('@', $email)[1];

    if (in_array($email_domain, $prohibitied_domains)) {
        return new WP_Error('registration-error-bad-email', __('Please use a valid email address.'));
    }

    return $validation_errors;
} // End do_not_allow_temp_email_addresses()
add_filter('woocommerce_registration_errors', 'do_not_allow_temp_email_addresses', 10, 3);
