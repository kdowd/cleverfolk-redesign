<?php
/* ---------------------------------------------------------------------------------------------
   SPECIFY BLOCK EDITOR SUPPORT
------------------------------------------------------------------------------------------------ */

if (!function_exists('mcluhan_add_block_editor_features')) :
    function mcluhan_add_block_editor_features()
    {

        /* Block Editor Features ------------- */

        add_theme_support('align-wide');

        /* Block Editor Palette -------------- */

        add_theme_support('editor-color-palette', array(
            array(
                'name'     => _x('Black', 'Name of the black color in the Gutenberg palette', 'mcluhan'),
                'slug'     => 'black',
                'color' => '#121212',
            ),
            array(
                'name'     => _x('Dark Gray', 'Name of the dark gray color in the Gutenberg palette', 'mcluhan'),
                'slug'     => 'dark-gray',
                'color' => '#333',
            ),
            array(
                'name'     => _x('Medium Gray', 'Name of the medium gray color in the Gutenberg palette', 'mcluhan'),
                'slug'     => 'medium-gray',
                'color' => '#555',
            ),
            array(
                'name'     => _x('Light Gray', 'Name of the light gray color in the Gutenberg palette', 'mcluhan'),
                'slug'     => 'light-gray',
                'color' => '#777',
            ),
            array(
                'name'     => _x('White', 'Name of the white color in the Gutenberg palette', 'mcluhan'),
                'slug'     => 'white',
                'color' => '#fff',
            ),
        ));

        /* Block Editor Font Sizes ----------- */

        add_theme_support('editor-font-sizes', array(
            array(
                'name'         => _x('Small', 'Name of the small font size in Gutenberg', 'mcluhan'),
                'shortName' => _x('S', 'Short name of the small font size in the Gutenberg editor.', 'mcluhan'),
                'size'         => 16,
                'slug'         => 'small',
            ),
            array(
                'name'         => _x('Normal', 'Name of the regular font size in Gutenberg', 'mcluhan'),
                'shortName' => _x('N', 'Short name of the regular font size in the Gutenberg editor.', 'mcluhan'),
                'size'         => 18,
                'slug'         => 'normal',
            ),
            array(
                'name'         => _x('Large', 'Name of the large font size in Gutenberg', 'mcluhan'),
                'shortName' => _x('L', 'Short name of the large font size in the Gutenberg editor.', 'mcluhan'),
                'size'         => 24,
                'slug'         => 'large',
            ),
            array(
                'name'         => _x('Larger', 'Name of the larger font size in Gutenberg', 'mcluhan'),
                'shortName' => _x('XL', 'Short name of the larger font size in the Gutenberg editor.', 'mcluhan'),
                'size'         => 28,
                'slug'         => 'larger',
            ),
        ));
    }
    add_action('after_setup_theme', 'mcluhan_add_block_editor_features');
endif;


/* ---------------------------------------------------------------------------------------------
   BLOCK EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if (!function_exists('mcluhan_block_editor_styles')) :
    function mcluhan_block_editor_styles()
    {

        $theme_version = wp_get_theme('mcluhan')->get('Version');

        wp_register_style('mcluhan-block-editor-styles-font', get_theme_file_uri('/assets/css/fonts.css'));
        wp_enqueue_style('mcluhan-block-editor-styles', get_theme_file_uri('/assets/css/mcluhan-block-editor-styles.css'), array('mcluhan-block-editor-styles-font'), $theme_version, 'all');
    }
    add_action('enqueue_block_editor_assets', 'mcluhan_block_editor_styles', 1);
endif;
