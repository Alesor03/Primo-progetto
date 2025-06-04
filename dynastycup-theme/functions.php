<?php
/**
 * Funzioni principali del tema Dynasty Cup
 */

// Aggiunge supporto per Elementor e altre funzionalità
function dynastycup_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'dynastycup_setup' );

// Enqueue di script e stili
function dynastycup_scripts() {
    wp_enqueue_style( 'dynastycup-style', get_stylesheet_uri(), array(), '1.0' );
    wp_enqueue_script( 'dynastycup-countdown', get_template_directory_uri() . '/js/countdown.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'dynastycup_scripts' );

