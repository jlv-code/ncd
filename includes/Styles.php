<?php 

	/**
		@author:  Coordinación Web MiPPCI
		@version: 1.0
	 */

// Register Styles
function Styles() {
	wp_enqueue_style( 'Style', get_template_directory_uri() . '/style.css' );
}

// Hook into the 'wp_enqueue_scripts' action
add_action('wp_enqueue_scripts', 'Styles');