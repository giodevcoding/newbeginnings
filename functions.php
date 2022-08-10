<?php

add_action( 'wp_enqueue_scripts', 'hnb_styles' );
function hnb_styles() {
    wp_enqueue_style(
        'hnb-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get( 'Version' )
    );
}
 

add_action( 'after_setup_theme', 'hnb_setup' );
function hnb_setup() {
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor_styles' );
}

require get_theme_file_path( 'blocks.php' );