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