<?php

get_header(); ?>

<!-- https://wp-kama.com/plugin/woocommerce/function -->
<!-- https://woocommerce.com/documentation/plugins/woocommerce/getting-started/ -->


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content() ?>
    <?php endwhile; ?>
<?php endif; ?>

<?php #echo do_shortcode('[products]') 
?>
<?php #echo do_shortcode('[product_page id=' . '98' . ']')  
?>

<?php get_footer(); ?>



<!-- 
[acf]
[add_to_cart]
[add_to_cart_url]
[audio]
[best_selling_products]
[caption]
[embed]
[featured_products]
[gallery]
[get-shortcode-list]
[playlist]
[product]
[product_attribute]
[product_categories]
[product_category]
[product_page]
[products]
[recent_products]
[related_products]
[sale_products]
[shop_messages]
[top_rated_products]
[video]
[wc_stripe_payment_buttons]
[woocommerce_cart]
[woocommerce_checkout]
[woocommerce_messages]
[woocommerce_my_account]
[woocommerce_order_tracking]
[wp_caption] -
->