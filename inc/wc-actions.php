<?php

add_action('before_woocommerce_init', function () {
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
});


add_filter('woocommerce_product_tabs', 'bbloomer_remove_product_tabs', 98);

function bbloomer_remove_product_tabs($tabs)
{
    unset($tabs['additional_information']);
    return $tabs;
}


// fires on the single product page only
// eg https://cleverfolk.co.nz/product/papaya/
add_action("woocommerce_single_product_summary", 'add_sizes_to_product');

function add_sizes_to_product()
{
    // that cart
    //https://cleverfolk.co.nz/wp-json/wc/store/v1/cart/
    global $product;
    $str = "";

    $html = "<fieldset class='switch-group'>";
    $html .= "<legend>Sizes:</legend>";

    // woo intro with variations
    // https://www.youtube.com/watch?v=H_LUUfJyPWQ&ab_channel=Automattic
    $mycount = 0;
    foreach ($product->attributes as $item) {
        // var_dump_pretty($item['name']);

        // show only 1 size
        if ($mycount == 1) break;

        $checkbool = (!!$mycount) ? null : 'checked';
        $html .= "<div class='group-switch'>";
        $html .= "<label for='size-{$item['name']}'>";
        $html .= "<input type='radio' {$checkbool} name='size' id='size-{$item['name']}' value='{$item['name']}'>";
        $html .= "<span>{$item['name']}, </span>";
        $html .= "<span>{$item['options'][0]}</span>";
        $html .= "</label></div>";
        $mycount++;
    }
    $html .= "</fieldset>";





    echo $html;
}

// array(2) {
// [std] = object(WC_Product_Attribute)#18800 (1) {
// ["data":protected] = array(6) {
// [id] = int() 0
// [name] = string(3) "std"
// [options] = array(1) {
// [0] = string(10) "20 x 25 cm"
// }
// [position] = int() 0
// [visible] = bool(true)
// [variation] = bool(true)
// }
// }
// [med] = object(WC_Product_Attribute)#18786 (1) {
// ["data":protected] = array(6) {
// [id] = int() 0
// [name] = string(3) "med"
// [options] = array(1) {
// [0] = string(10) "25 x 33 cm"
// }
// [position] = int() 1
// [visible] = bool(true)
// [variation] = bool(true)
// }
// }
// }