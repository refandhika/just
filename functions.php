<?php

define('JUST_THEME_VERSION', '1.0.0');

if( !function_exists('just_setup') ){

    add_action( 'after_setup_theme', 'just_setup' );
    function just_setup(){
        add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');

	register_nav_menus(
	    array(
	    	'header-menu' => __( 'Header Menu' ),
	    	'footer-menu' => __( 'Footer Menu' )
	    )
        );

	register_sidebar(array(
		'name' => 'Just Sidebar',
		'before_widget' => '<div class="entry-sidebar">',
		'after_widget' => '</div>',
		'before_title' => '<div class="sidebar-title">',
		'after_title' => '</div>'
	));

	add_theme_support('html5', array(
	    'search-form',
	    'comment-form',
	    'comment-list',
	    'gallery',
	    'caption'
	));
    }

}

add_action( 'wp_enqueue_scripts', 'just_theme_scripts' );
function just_theme_scripts(){
    wp_enqueue_style( 'theme-core', get_stylesheet_uri() , false );

    if(!wp_style_is('masonry-js')){
	wp_enqueue_script( 'masonry-js', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array('jquery'), JUST_THEME_VERSION, true );
    }
    if(!wp_style_is('imagesload-js')){
	wp_enqueue_script( 'imagesload-js', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), JUST_THEME_VERSION, true );
    }
    wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/js/scripts.js', array('jquery','masonry-js','imagesload-js'), JUST_THEME_VERSION, true );

    wp_localize_script( 'theme-script', 'justajax', array( 'ajaxurl' => admin_url('admin-ajax.php') ) );
}

add_action( 'wp_ajax_just_get_posts', 'just_get_posts' );
add_action( 'wp_ajax_nopriv_just_get_posts', 'just_get_posts' );
function just_get_posts(){
    $ajax_params = array(
	'page' => (isset($_POST['page']) ? $_POST['page'] : 1)
    );

    $args = array(
    	'paged' => $ajax_params['page'],
	'post_status' => 'publish'
    );

    query_posts($args);
    ob_start();
    get_template_part('loop');
    $html = ob_get_clean();

    $res = array(
	'success' => true,
	'html' => $html
    );

    wp_die(json_encode($res));
}

add_filter( 'comment_form_default_fields', 'just_custom_comment_form' );
function just_custom_comment_form($fields) {
    /** Disable Website Field **/
    unset($fields['url']);
	
    /** Comment Fields to Bottom **/
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;

    /** Edit Cookies Consent Label **/
    $commenter = wp_get_current_commenter();
    $consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
    $buffer = '';
    $buffer .= '<p class="comment-form-cookies-consent">';
    $buffer .= '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />';
    $buffer .= '<label for="wp-comment-cookies-consent">';
    $buffer .= 'Save my name and email in this browser for the next time I comment.';
    $buffer .= '</label>';
    $buffer .= '</p>';
    $fields['cookies'] = $buffer;
	
    return $fields;
}

add_filter( 'comment_form_defaults', 'just_remove_comment_notes' );
function just_remove_comment_notes($args){
    $args['comment_notes_before'] = '';

    return $args;
}


