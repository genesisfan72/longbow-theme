<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package longbow
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'longbow' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container toparentheight">
			<div class="row toparentheight">
				<div class="site-branding col-xs-9 col-md-6 alignvertical">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<span class="site-description alignvertical absolute hidden-xs"><?php bloginfo( 'description' ); ?></span>
				</div><!-- .site-branding -->

				<div class="col-xs-2 col-md-6 pull-right alignvertical">
                    <div class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-3x fa-bars"></i></div>
				</div>
			</div>
		</div>

        <nav id="mobile-site-navigation" class="slide-menu slide-menu-right" role="navigation">
            <?php wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id' => 'primary-menu',
                'items_wrap' => '<ul id="%1$s" class="%2$s"><li class="close-menu"><i class="fa fa-5x fa-times-circle-o"></i></li>%3$s</ul>' ) ); ?>
        </nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">