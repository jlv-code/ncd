<?php 

	/**
		@author:  jlv
		@version: 1.0
	 */

?>

<!DOCTYPE html>
<html <?php language_attributes() ?>>

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="identifier-url" content="http://" />
	<meta name="title" content="NCD | NotiCentroDigital.com" />
	<meta name="author" content="jlv" />
	<meta name="robots" content="All" />
	<meta name="revisit-after" content="1" />
	<meta name="description" content="NotiCentroDigital es tu mejor opción para ver las noticias" />
	<meta name="keywords" content="venezuela, noticias, politica, entretenimiento, deporte, farandula, loteria" />
	<meta name="copyright" content="NCD | <?php echo date( 'Y' ) ?>" />

	<?php wp_head() ?>

</head>

<body <?php body_class() ?>>
	<main id="Main">
		<div class="Inner">
			<header id="Header" class="Header">
				<div class="Inner">
					<div class="Logo"><img src="<?php echo get_template_directory_uri() ?>/static/images/logo.png" alt="NCD"></div>
					<div class="Date"><?php echo date( 'M d, Y' ) ?></div>
					<div class="NavBar">
						<div class="Inner">
							<nav id="NavBarMenu" class="NavBarMenu"><?php global $SiteMenu; wp_nav_menu( $SiteMenu )  ?></nav>
						</div>
					</div>
				</div>
			</header>