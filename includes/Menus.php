<?php 

	/**
		@author:  jlv
		@version: 1.0
	 */

// Register Navigation Menus
function NavMenus() {

	$locations = array(
		'SiteMenu' => 'Menu del Sitio',
	);
	register_nav_menus( $locations );

}

// Hook into the 'init' action
add_action( 'init', 'NavMenus' );

$SiteMenu = (array) array(
	'theme_location' => 'SiteMenu', 
	'container' => false, 
	'menu_id' => 'SiteMenu', 
	'menu_class' => 'SiteMenu', 
	'fallback_cb' => false
);
