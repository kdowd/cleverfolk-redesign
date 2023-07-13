<?php

get_header(); ?>

<!-- https://wp-kama.com/plugin/woocommerce/function -->
<!-- https://woocommerce.com/documentation/plugins/woocommerce/getting-started/ -->

<div class="div-content-first-element page-<?= $post->ID  ?>">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content() ?>
    <?php endwhile; ?>
    <?php endif; ?>

    <?php do_action('get-custom-products'
    , 3); ?>
</div>

<?php #echo do_shortcode('[get-shortcode-list]') 
?>


<?php

get_footer(); ?>


<!-- {"totals":{
"total_items":"2800"
,"total_items_tax":"420"
,"total_fees":"0"
,"total_fees_tax":"0"
,"total_discount":"0"
,"total_discount_tax":"0"
,"total_shipping":"0"
,"total_shipping_tax":"0"
,"total_price":"3220"
,"total_tax":"420"
,"tax_lines":[{"name":"GST"
,"price":"420"
,"rate":"15%"}]
,"currency_code":"NZD"
,"currency_symbol":"$"
,"currency_minor_unit":2
,"currency_decimal_separator":"."
,"currency_thousand_separator":"
,"
,"currency_prefix":"$"
,"currency_suffix":""}
,"itemsCount":3} -->