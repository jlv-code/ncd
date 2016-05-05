<?php 

// Register Widgets Area
function WidgetsArea() {

	$Widget = 'Widget';
	$WidgetTitle = 'WidgetTitle';

	$WidgetBase = array(
		
		'before_widget' => '<div class="'.$Widget.'">',
		
		'before_title' => '<span class="'.$WidgetTitle.'">',

		'after_title' => '</span>',

		'after_widget' => '</div>',

	);

	/**
		Áreas de Widgets para la Página Principal
	 */

	$Banners = array(
		'id' => 'home-header-banners',
		'name' => 'Banners',
		'description' => 'Área de Publicidad en la Cabecera de la Página Principal',
		'empty_title'=> '',
	);

	register_sidebar( array_merge( $WidgetBase, $Banners ) );

}

add_action( 'widgets_init', 'WidgetsArea' );