<?php
/*
 * Plugin Name: Jetpack shortlinks for sharing buttons
 * Plugin URI: http://wordpress.org/extend/plugins/jetpack-shortlinks-for-sharing-buttons/
 * Description: Use shortlinks instead of permalinks in Jetpack sharing buttons
 * Author: Jeremy Herve
 * Version: 1.0
 * Author URI: http://jeremyherve.com
 * License: GPL2+
 */
 
// Grab the shortlink
function jp_sd_custshortlink( $post ) {
	global $post;
	
	if ( !$post )
		return;
	
	$post_id = $post->ID;
	return wp_get_shortlink( $post_id );
}

// Enable the plugin only when Jetpack and Sharedaddy are enabled
function jp_sd_custshortlink_enable() {
	if (
		class_exists( 'Jetpack' ) && method_exists( 'Jetpack', 'get_active_modules' ) && in_array( 'sharedaddy', Jetpack::get_active_modules() )
		) {
		add_filter( 'sharing_permalink', 'jp_sd_custshortlink' );
	}
}
add_action( 'plugins_loaded', 'jp_sd_custshortlink_enable' );
