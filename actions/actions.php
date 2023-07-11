<?php

// https://woocommerce.wp-a2z.org/oik_file/includes/abstracts/abstract-wc-product-php/?bwscid1=

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

add_filter('woocommerce_product_tabs', 'remove_product_tabs', 99);

function remove_product_tabs($tabs)
{
    unset($tabs['additional_information']); // This line will remove the additional information tab
    return $tabs;
}



add_action('get-custom-products', 'custom_products_callback', 10, 2);

function custom_products_callback($count = -1)
{
?>
    <ul class="products">
        <?php
        $args = array(
            'post_type'   => 'product',
            'post_status' => 'publish',
            'posts_per_page' => $count
        );
        $the_query = new WP_Query($args);
        ?>

        <!--  https://woocommerce.wp-a2z.org/oik_file/includes/abstracts/abstract-wc-product-php -->

        <?php if ($the_query->have_posts()) : ?>
            <?php
            do_action('woocommerce_before_shop_loop');
            //woocommerce_product_loop_start();
            ?>
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>


                <?php
                // this will get all details of the product
                // api = https://woocommerce.wp-a2z.org/oik_file/includes/abstracts/abstract-wc-product-php/?bwscid1=2
                //https://bloggingcommerce.com/en/the-exciting-story-of-wc-stripe-payment-request-wrapper-you-cant-imagine-what-happened-in-the-end/
                $product = wc_get_product(get_the_ID());
                $details = new stdClass();
                $details->avail = $product->get_availability();
                $details->ID = get_the_ID();
                $details->stock_controlled =  $product->managing_stock();
                $details->stock_status =  $product->get_stock_status();
                $details->quantity =  $product->get_stock_quantity();
                $details->low_stock_amount =  $product->get_low_stock_amount();
                $details->permalink = $product->get_permalink();
                $details->cart_url = $product->add_to_cart_url();
                $details->name = $product->get_name();
                $details->price = get_woocommerce_currency_symbol("NZD") . $product->get_regular_price();
                $details->image_id = $product->get_image_id();
                $details->slug = $product->get_slug();
                $details->description =  $product->get_description();
                $details->short_description =  $product->get_short_description();
                $details->is_sale_item =  $product->is_on_sale();
                $details->sale_price =  get_woocommerce_currency_symbol("NZD") . $product->get_sale_price();
                $details->max_purchase = $product->get_max_purchase_quantity();
                $details->attribute_array = $product->get_attributes();

                // logger($details);

                // https://woocommerce.wp-a2z.org/oik_file/includes/abstracts/abstract-wc-product-php/?bwscid1=
                //https://freefrontend.com/assets/img/css-product-cards/E-Commerce-Card-HTML-CSS.png
                //https://deesbees.nz/collections/beeswax-food-wraps/products/birds-of-aotearoa-beeswax-food-wrap

                ?>
                <li>
                    <div class="product-card">




                        <div class="clever-notices">
                            <?php if ($details->is_sale_item) : ?>
                                <h1 class="notices-item sale">SALE</h1>
                            <?php endif; ?>
                            <?php if (($details->stock_status == "instock") && ($details->stock_controlled) && ($details->quantity < $details->low_stock_amount)) : ?>
                                <h1 class="notices-item low-stock">low stock</h1>
                            <?php endif; ?>

                            <?php if ($details->stock_status == "outofstock") : ?>
                                <h1 class="notices-item no-stock">out of stock</h1>
                            <?php endif; ?>
                        </div>

                        <div>
                            <a href=<?php echo $details->permalink ?> target="_self" rel="nofollow">
                                <!-- https://www.hostinger.com/tutorials/wp_get_attachment_image -->
                                <?php echo wp_get_attachment_image($details->image_id, 'woocommerce_single', "", array("alt" => "wax wrap", "class" => "img-aspect", "loading" => "eager")); ?>
                            </a>
                        </div>

                        <div class="card-details">
                            <div class="small-info">
                                <div>
                                    <span><?php echo $details->name ?></span>

                                    <span>

                                        <?php if ($details->is_sale_item) : ?>
                                            <?php echo "<span class='old-price'>WAS {$details->price}</span>" ?>
                                            <?php echo "{$details->sale_price} " ?>

                                        <?php else : ?>
                                            <?php echo $details->price ?>
                                        <?php endif; ?>

                                    </span>
                                </div>
                                <div>
                                    <!-- <span><?php #echo $details->avail['availability'] 
                                                ?></span> -->
                                    <span>
                                        <?php
                                        $var1 = $details->attribute_array['std']['name'];
                                        $var2 = $details->attribute_array['std']['options'][0];
                                        echo "Size {$var1} : {$var2}"; ?>
                                    </span>

                                </div>
                            </div>

                            <hr />

                            <div class="cart-buttons-grid">
                                <?php do_action('woocommerce_before_add_to_cart_form'); ?>
                                <?php

                                if (($details->stock_controlled) && ($details->quantity > 0)) {
                                    echo do_shortcode('[add_to_cart id=' . $details->ID . ' sku class="add-to-cart-wrapper" style="" show_price="false"]');
                                } else if (!($details->stock_controlled)) {
                                    echo do_shortcode('[add_to_cart id=' . $details->ID . ' sku class="add-to-cart-wrapper"  style="" show_price="false"]');
                                }

                                ?>

                                <a class="button product_type_simple" style="font-size: 18px; padding: 0.618em 1em; border-radius: 3px; line-height: 1;" href=<?php echo $details->permalink; ?> target="_self" rel="nofollow">
                                    View More
                                </a>

                            </div>

                        </div>
                    </div>

                </li>

            <?php endwhile; ?>
            <?php //woocommerce_product_loop_end();
            do_action('woocommerce_after_shop_loop'); ?>
        <?php endif;
        wp_reset_postdata(); ?>



    </ul>
<?php
}

/*
https://usersinsights.com/woocommerce-users-data/
https://usersinsights.com/woocommerce-get-product-price-by-id/

*/

?>