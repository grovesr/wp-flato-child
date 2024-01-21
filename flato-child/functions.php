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

	function ot_register_theme_options_page() {
  
		/* get the settings array */
		$get_settings = get_option( 'option_tree_settings' );
		
		/* sections array */
		$sections = isset( $get_settings['sections'] ) ? $get_settings['sections'] : array();
		
		/* settings array */
		$settings = isset( $get_settings['settings'] ) ? $get_settings['settings'] : array();
		
		/* contexual_help array */
		$contextual_help = isset( $get_settings['contextual_help'] ) ? $get_settings['contextual_help'] : array();
		
		/* build the Theme Options */
		if ( function_exists( 'ot_register_settings' ) && OT_USE_THEME_OPTIONS ) {
		  
		  ot_register_settings( array(
			  array(
				'id'                  => 'option_tree',
				'pages'               => array( 
				  array(
					'id'              => 'ot_theme_options',
					'parent_slug'     => apply_filters( 'ot_theme_options_parent_slug', 'themes.php' ),
					'page_title'      => apply_filters( 'ot_theme_options_page_title', __( 'Theme Options', 'option-tree' ) ),
					'menu_title'      => apply_filters( 'ot_theme_options_menu_title', __( 'Theme Options', 'option-tree' ) ),
					'capability'      => $caps = apply_filters( 'ot_theme_options_capability', 'edit_theme_options' ),
					'menu_slug'       => apply_filters( 'ot_theme_options_menu_slug', 'ot-theme-options' ),
					'icon_url'        => apply_filters( 'ot_theme_options_icon_url', null ),
					'position'        => apply_filters( 'ot_theme_options_position', null ),
					'updated_message' => apply_filters( 'ot_theme_options_updated_message', __( 'Theme Options updated.', 'option-tree' ) ),
					'reset_message'   => apply_filters( 'ot_theme_options_reset_message', __( 'Theme Options reset.', 'option-tree' ) ),
					'button_text'     => apply_filters( 'ot_theme_options_button_text', __( 'Save Changes', 'option-tree' ) ),
					'screen_icon'     => 'themes',
					'contextual_help' => $contextual_help,
					'sections'        => $sections,
					'settings'        => $settings
				  )
				)
			  )
			) 
		  );
		  
		  // Filters the options.php to add the minimum user capabilities.
		  // replace the below create_function with an anonymous function because create_function() is deprecated and causes 
		  // fatal errors in PHP 8.0
		  //add_filter( 'option_page_capability_option_tree', create_function( '$caps', "return '$caps';" ), 999 );
		  add_filter( 'option_page_capability_option_tree', 
		  function( $caps ) {
			return $caps;
		  }
		  , 999 );
		
		}
	  
	}

function flato_child_enqueue_styles() {
	$theme        = wp_get_theme();
	$parenthandle = 'themememe-base';
	wp_enqueue_style( 'themememe-child-base',
		get_stylesheet_directory_uri() . '/css/base.css',
		array( $parenthandle ),
		$theme->get( 'Version' ) // This only works if you have Version defined in the style header.
	);
	$parenthandle = 'themememe-icons';
	wp_enqueue_style( 'themememe-child-icons',
		get_stylesheet_directory_uri() . '/css/font-awesome.min.css',
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
