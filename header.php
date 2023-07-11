<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, NOODP, noarchive, max-image-preview:large">
    <meta name="description" content="crafts">
    <meta name=" language" content="en_NZ">
    <meta name="keywords" content="auckland craft, wax wraps">
    <meta name="google-site-verification" content="AGQVsaemuT_BVUfe8370hAlLjKSeEcIMxxBoqTzpFdA">

    <link rel="icon" type="image/png" href="<?php echo CODE_BASE . '/assets/images/favicon.ico' ?>">

    <link rel="canonical" href="https://cleverfolk.co.nz">
    <meta name="google-site-verification" content="AGQVsaemuT_BVUfe8370hAlLjKSeEcIMxxBoqTzpFdA">


    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>

</head>

<!-- <body id="override" <?php body_class(); ?>
    style="background-image:url(<?php echo CODE_BASE . '/assets/images/white_carbon.webp' ?>)"> -->

<body id="override" <?php body_class(); ?>>

    <?php wp_body_open(); ?>


    <header class="site-header group">



        <p class="site-title">
            <a href="<?php echo esc_url(home_url()); ?>" class="site-name">
                <?php bloginfo('name'); ?>
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 640 512" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M80 48a48 48 0 1 1 96 0A48 48 0 1 1 80 48zm64 193.7v65.1l51 51c7.1 7.1 11.8 16.2 13.4 26.1l15.2 90.9c2.9 17.4-8.9 33.9-26.3 36.8s-33.9-8.9-36.8-26.3l-14.3-85.9L66.8 320C54.8 308 48 291.7 48 274.7V186.6c0-32.4 26.2-58.6 58.6-58.6c24.1 0 46.5 12 59.9 32l47.4 71.1 10.1 5V160c0-17.7 14.3-32 32-32H384c17.7 0 32 14.3 32 32v76.2l10.1-5L473.5 160c13.3-20 35.8-32 59.9-32c32.4 0 58.6 26.2 58.6 58.6v88.1c0 17-6.7 33.3-18.7 45.3l-79.4 79.4-14.3 85.9c-2.9 17.4-19.4 29.2-36.8 26.3s-29.2-19.4-26.3-36.8l15.2-90.9c1.6-9.9 6.3-19 13.4-26.1l51-51V241.7l-19 28.5c-4.6 7-11 12.6-18.5 16.3l-59.6 29.8c-2.4 1.3-4.9 2.2-7.6 2.8c-2.6 .6-5.3 .9-7.9 .8H256.7c-2.5 .1-5-.2-7.5-.7c-2.9-.6-5.6-1.6-8.1-3l-59.5-29.8c-7.5-3.7-13.8-9.4-18.5-16.3l-19-28.5zM2.3 468.1L50.1 348.6l49.2 49.2-37.6 94c-6.6 16.4-25.2 24.4-41.6 17.8S-4.3 484.5 2.3 468.1zM512 0a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm77.9 348.6l47.8 119.5c6.6 16.4-1.4 35-17.8 41.6s-35-1.4-41.6-17.8l-37.6-94 49.2-49.2z">
                    </path>
                </svg>
            </a>
        </p>

        <?php if (get_bloginfo('description')) : ?>

        <div class="site-description"><?php echo wpautop(get_bloginfo('description')); ?></div>

        <?php endif; ?>


        <div class="menu-widgets-area">
            <?php if (is_active_sidebar('Mini Cart')) : ?>
            <div id="secondary-sidebar" class="new-widget-area">
                <?php dynamic_sidebar('Mini Cart'); ?>
            </div>
            <?php endif; ?>
            <?php if (has_nav_menu('social-menu') || (!get_theme_mod('mcluhan_hide_social') || is_customize_preview())) : ?>
            <div class="social-menu desktop">
                <ul class="social-menu-inner">
                    <li class="social-search-wrapper"><a href="<?php echo esc_url(home_url('?s=')); ?>"></a></li>

                    <?php

                        $social_args = array(
                            'theme_location'    => 'social-menu',
                            'container'            => '',
                            'container_class'    => 'menu-social group',
                            'items_wrap'        => '%3$s',
                            'menu_id'            => 'menu-social-items',
                            'menu_class'        => 'menu-items',
                            'depth'                => 1,
                            'link_before'        => '<span class="screen-reader-text">',
                            'link_after'        => '</span>',
                            'fallback_cb'        => '',
                        );

                        wp_nav_menu($social_args);

                        ?>

                </ul><!-- .social-menu-inner -->

            </div><!-- .social-menu -->

            <?php endif; ?>


            <div class="nav-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </div>



        <div class="menu-wrapper">

            <ul class="main-menu desktop">

                <?php

                if (has_nav_menu('main-menu')) {

                    $main_menu_args = array(
                        'container'         => '',
                        'items_wrap'         => '%3$s',
                        'theme_location'     => 'main-menu',
                    );

                    wp_nav_menu($main_menu_args);
                } else {

                    $fallback_args = array(
                        'container' => '',
                        'title_li'     => '',
                    );

                    wp_list_pages($fallback_args);
                }
                ?>
            </ul>

        </div><!-- .menu-wrapper -->



    </header><!-- header -->

    <div class="mobile-menu-wrapper">

        <ul class="main-menu mobile">
            <?php
            if (has_nav_menu('main-menu')) {
                wp_nav_menu($main_menu_args);
            } else {
                wp_list_pages($fallback_args);
            }
            if (!get_theme_mod('mcluhan_hide_social', false)) : ?>
            <li class="toggle-mobile-search-wrapper"><a href="#"
                    class="toggle-mobile-search"><?php _e('Search', 'mcluhan'); ?></a></li>
            <?php endif; ?>
        </ul><!-- .main-menu.mobile -->

        <?php if (has_nav_menu('social-menu') && (!get_theme_mod('mcluhan_hide_social', false) || is_customize_preview())) : ?>

        <div class="social-menu mobile">

            <ul class="social-menu-inner">

                <?php wp_nav_menu($social_args); ?>

            </ul><!-- .social-menu-inner -->

        </div><!-- .social-menu -->

        <?php endif; ?>

    </div><!-- .mobile-menu-wrapper -->

    <?php if (!get_theme_mod('mcluhan_hide_social', false)) : ?>

    <div class="mobile-search">

        <div class="untoggle-mobile-search"></div>

        <?php get_search_form(); ?>

        <div class="mobile-results">

            <div class="results-wrapper"></div>

        </div>

    </div><!-- .mobile-search -->

    <div class="search-overlay">

        <?php get_search_form(); ?>

    </div><!-- .search-overlay -->

    <?php endif; ?>

    <main class="site-content" id="site-content">