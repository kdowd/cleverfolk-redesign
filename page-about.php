<?php
get_header(); ?>



<header class="entry-header section-inner">
    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
</header>

<div class="entry-content section-inner">
    <?php the_content(); ?>

    <!-- /post_password_required() -->
    <form action="">
        <label for="user-email">Email <span style="color:crimson">*</span></label>
        <input style="margin-top:12px" type="email" name="user-email" id="user-email" required placeholder="Your email, so we can reply...">
        <textarea name="user-text" id="user-text" cols="30" rows="10" required placeholder="Your comment..."></textarea>
        <input type="submit" value="Send">
    </form>
</div>



<?php get_footer(); ?>