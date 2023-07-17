<?php
get_header(); ?>



<header class="entry-header section-inner">
    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
</header>
<hr>



<div class="entry-content section-inner">
    <?php the_content(); ?>
    <?php echo do_shortcode('[generic_inline_form]'); ?>
</div>


<?php get_footer(); ?>