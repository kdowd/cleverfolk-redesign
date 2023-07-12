<?php

get_header(); ?>

<!-- https://wp-kama.com/plugin/woocommerce/function -->
<!-- https://woocommerce.com/documentation/plugins/woocommerce/getting-started/ -->
<?php #do_action('get-toast-ui') 
?>
<div class="div-content-first-element page-<?= $post->ID  ?>">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content() ?>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php do_action('get-custom-products', 3); ?>
</div>

<?php #echo do_shortcode('[get-shortcode-list]') 
?>


<?php

get_footer(); ?>