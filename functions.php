<?php 

	/**
		@author:  Coordinación Web MiPPCI
		@version: 1.0
	 */

include ( 'includes/Styles.php' );
include ( 'includes/Scripts.php' );
include ( 'includes/Menus.php' );
include ( 'includes/WidgetsArea.php' );

// Register Theme Features
function ThemeFeatures(){

	// Add theme support for Automatic Feed Links
	add_theme_support( 'automatic-feed-links' );

	// Add theme support for Featured Images
	add_theme_support( 'post-thumbnails', array( 'post', ));

	// Add theme support for HTML5 Semantic Markup
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Add theme support for document Title tag
	add_theme_support( 'title-tag' );

	if (function_exists( 'add_image_size' )) {
		//add_image_size('lsThumb', 270, 190, true);
	}

	// Activate or Deactivate Wordpress Admin Bar
	show_admin_bar( false );

	// Remove Wordpress Generator MetaTag
	remove_action( 'wp_head', 'wp_generator' );

	// Remove Twitter Emoji Graphics
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	// Put Jetpack Plugin Offline
	add_filter( 'jetpack_development_mode', '__return_true' );

}

// Hook into the 'after_setup_theme' action
add_action( 'after_setup_theme', 'ThemeFeatures' );

function the_pagination( $pages = '', $range = 4 ){  
	$showitems = ( $range * 2 ) + 1;  
 
	global $paged;
	if ( empty( $paged ) ) $paged = 1;

	if ( $pages == '' ){
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages) $pages = 1;
	}

	if ( 1 != $pages ){
		echo "<div class=\"Pagination\"><span class=\"PaginationInfo\">Página ".$paged." de ".$pages."</span>";
		if ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) echo "<a class=\"PaginationPage PaginationFirst\" href='" . get_pagenum_link( 1 ) . "'>&laquo;</a>";
		if ( $paged > 1 && $showitems < $pages ) echo "<a class=\"PaginationPage PaginationPrevious\" href='" . get_pagenum_link( $paged - 1 ) . "'>&lsaquo;</a>";

		for ( $i=1; $i <= $pages; $i++ ){
			if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) )
				echo ( $paged == $i ) ? "<span class=\"PaginationPage PaginationCurrent\">" . $i . "</span>" : "<a class=\"PaginationPage\" href='" . get_pagenum_link($i) . "' class=\"PaginationPage\">" . $i . "</a>";
		}
 
		if ( $paged < $pages && $showitems < $pages ) echo "<a class=\"PaginationPage PaginationNext\" href=\"" . get_pagenum_link( $paged + 1 ) . "\">&rsaquo;</a>";
		if ( $paged < $pages - 1 &&  $paged + $range - 1 < $pages && $showitems < $pages ) echo "<a class=\"PaginationPage PaginationLast\" href='" . get_pagenum_link( $pages ) . "'>&raquo;</a>";
		echo "</div>\n";
	}
}

// Updated Views for Posts
function nx_set_post_views($postID) {
  $count_key = 'nx_post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if($count == ''){
      $count = 0;
      delete_post_meta($postID, $count_key);
      add_post_meta($postID, $count_key, '0');
  }else{
      $count++;
      update_post_meta($postID, $count_key, $count);
  }
}