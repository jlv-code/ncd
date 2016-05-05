<?php

	/**
		@author:  jlv
		@version: 1.0
	 */

// Register Scripts
function Scripts() {
	wp_enqueue_script( 'GFonts', get_template_directory_uri() . '/static/js/GFonts.js', array(), false, true );
	wp_enqueue_script( 'SliderjQuery', get_template_directory_uri() . '/static/js/SliderjQuery.js', array(), false, true );
}

// Hook into the 'wp_enqueue_scripts' action
add_action('wp_enqueue_scripts', 'Scripts');