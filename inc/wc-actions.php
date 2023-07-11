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
