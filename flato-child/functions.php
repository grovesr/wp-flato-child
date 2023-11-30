<?php
/*
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	wp_enqueue_style( 'child-style',
		get_stylesheet_uri(),
		array( 'parenthandle' ),
		wp_get_theme()->get( 'Version' ) // This only works if you have Version defined in the style header.
	);
	*/

function flato_child_enqueue_styles() {
	$theme        = wp_get_theme();
	$parenthandle = 'themememe-base';
	wp_enqueue_style( 'themememe-child-base',
		get_stylesheet_uri() . '/css/base.css',
		array( $parenthandle ),
		$theme->get( 'Version' ) // This only works if you have Version defined in the style header.
	);
	$parenthandle = 'themememe-icons';
	wp_enqueue_style( 'themememe-child-icons',
		get_stylesheet_uri() . '/css/font-awesome.min.css',
		array( $parenthandle ),
		$theme->get( 'Version' ) // This only works if you have Version defined in the style header.
	);
	$parenthandle = 'themememe-style'; // This is themememe-style for the Flato theme.
	wp_enqueue_style( $parenthandle,
		get_template_directory_uri() . '/style.css');
	wp_enqueue_style( 'themememe-child-style',
		get_stylesheet_uri(),
		array( $parenthandle ),
		$theme->get( 'Version' ) // This only works if you have Version defined in the style header.
	);
}
add_action( 'wp_enqueue_scripts', 'flato_child_enqueue_styles');

function wpdocs_remove_website_field( $fields ) {
	unset( $fields['url'] );
	return $fields;
}

add_filter( 'comment_form_default_fields', 'wpdocs_remove_website_field' );
