<?php

function register_custom_widget_area() {
register_sidebar(
array(
'id' => 'mini-cart',
'name' => esc_html__( 'Mini Cart', 'mccluhan' ),
'description' => esc_html__( 'mini cart for widgets', 'mccluhan' ),
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '',
'after_title' => ''
)
);
}



add_action( 'widgets_init', 'register_custom_widget_area' );