<?php 

	/**
		@author:  jlv
		@version: 1.0
	 */

// Register Navigation Menus
function NavMenus() {

	$locations = array(
		'main' => 'Principal',
	);
	register_nav_menus( $locations );

}

// Hook into the 'init' action
add_action( 'init', 'NavMenus' );

$Main = (array) array(
	'theme_location' => 'main', 
	'container' => false, 
	'menu_id' => 'MainMenu', 
	'menu_class' => 'MainMenu', 
	'fallback_cb' => false
);
