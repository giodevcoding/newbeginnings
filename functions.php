<?php

add_action( 'wp_enqueue_scripts', 'hnb_styles' );
function hnb_styles() {
    wp_enqueue_style(
        'hnb-style',
        get_theme_file_uri("/build/index.css"),
        array(),
        wp_get_theme()->get( 'Version' )
    );

    wp_enqueue_style(
        'google-fonts-lato',
        'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap',
        array(),
        false
    );

    wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css',
        array(),
        false
    );
}

add_action( 'wp_head', 'hnb_head_injection' );
function hnb_head_injection() {
    echo ( '<link rel="preconnect" href="https://fonts.googleapis.com">' );
    echo ( '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' ); 
}
 

add_action( 'after_setup_theme', 'hnb_setup' );
function hnb_setup() {
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor_styles' );
    
    register_nav_menus( array() );
}

require get_theme_file_path( 'blocks.php' );