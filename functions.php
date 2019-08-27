<?php

add_action( 'wp_enqueue_scripts', 'just_theme_scripts' );
function just_theme_scripts(){
    wp_enqueue_style( 'theme-core', get_stylesheet_uri() , false );
}