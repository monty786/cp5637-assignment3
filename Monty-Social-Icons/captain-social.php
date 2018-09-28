<?php
/*
Plugin Name: Monty Social Icons
Plugin URI: http://127.0.0.1/wordpress
Description: Simple & beautiful social media profile icons and links.
Author: Monty
Author URI: http://127.0.0.1/wordpress
Version: 1.0.0
Text Domain: montySocial
License: GNU GPL v2
*/


// Plugin Folder Path
if ( !defined( 'CTSOCIAL_PLUGIN_DIR' ) ) {
	define( 'CTSOCIAL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

// Plugin Folder URL
if ( !defined( 'CTSOCIAL_PLUGIN_URL' ) ) {
	define( 'CTSOCIAL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

// Plugin Version
if ( !defined( 'CTSOCIAL_VERSION' ) ) {
	define( 'CTSOCIAL_VERSION', '1.0.0' );
}

load_plugin_textdomain( 'ctsocial', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );


function ctsocial_load_scripts() {
	wp_register_style( 'ctsocial-styles',  CTSOCIAL_PLUGIN_URL . 'includes/css/ctsocial-styles.css', array(  ), CTSOCIAL_VERSION );

	wp_enqueue_style( 'ctsocial-styles' );	
}
add_action( 'wp_enqueue_scripts', 'ctsocial_load_scripts' );


function ctsocial_settings_link( $link, $file ) {
	static $this_plugin;
	
	if ( !$this_plugin )
		$this_plugin = plugin_basename( __FILE__ );

	if ( $file == $this_plugin ) {
		$settings_link = '<a href="' . admin_url( 'options-general.php?page=ctsocial_all_options' ) . '">' . __( 'Settings', 'ctsocial' ) . '</a>';
		array_unshift( $link, $settings_link );
	}
	
	return $link;
}
add_filter( 'plugin_action_links', 'ctsocial_settings_link', 10, 2 );

include_once( CTSOCIAL_PLUGIN_DIR . 'includes/admin/settings.php' );

include_once( CTSOCIAL_PLUGIN_DIR . 'includes/front-end/template.php' );
include_once( CTSOCIAL_PLUGIN_DIR . 'includes/front-end/shortcode.php' );