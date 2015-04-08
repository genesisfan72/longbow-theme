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
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<?php
$layout = get_theme_mod( 'fp_layout', 'blog1' );

if ( isset( $_GET[ 'fp_layout' ] ) ) {
    $layout = $_GET[ 'fp_layout' ];
}
?>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'longbow'); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <?php if ( $layout === 'blog2' ) { ?>
            <div class="wrap top-menu">
                <div class="container toparentheight">
                    <div class="row toparentheight">
                        <div class="hidden-xs hidden-sm col-md-4 alignvertical">
                            Telephone:
                        </div>
                        <nav class="hidden-xs hidden-sm col-md-8 toparentheight">
                            <?php wp_nav_menu(array(
                                'theme_location'  => 'secondary',
                                'menu_id'         => 'secondary-menu',
                                'menu_class'      => 'menu alignvertical',
                                'container_class' => 'toparentheight' )); ?>
                        </nav>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="container toparentheight branding-nav">
            <div class="row toparentheight">
                <div class="site-branding col-xs-9 col-md-4 alignvertical">
                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                    <span class="site-description alignvertical absolute hidden-xs"><?php bloginfo('description'); ?></span>
                </div>
                <!-- .site-branding -->

                <div class=" hidden-lg col-xs-2 col-md-8 pull-right alignvertical">
                    <div class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-3x fa-bars"></i></div>
                </div>

                <nav class="visible-lg col-md-8 main-navigation toparentheight">
                    <?php wp_nav_menu(array(
                                          'theme_location'  => 'primary',
                                          'menu_id'         => 'primary-menu',
                                          'menu_class'      => 'menu alignvertical',
                                          'container_class' => 'toparentheight',
                                          'items_wrap'      => '<ul id="%1$s" class="%2$s toparentheight">%3$s<li><i class="fa fa-search alignvertical"></i></li><li><i class="fa fa-shopping-cart alignvertical"></i></li></ul>')); ?>
                </nav>
                <!-- #site-navigation -->
            </div>
        </div>

        <nav>
            <div id="mobile-site-navigation" class="slide-menu slide-menu-right" role="navigation">
                <?php wp_nav_menu(array(
                                      'theme_location' => 'primary',
                                      'menu_id'        => 'primary-menu',
                                      'items_wrap'     => '<ul id="%1$s" class="%2$s"><li class="close-menu"><i class="fa fa-5x fa-times-circle-o"></i></li>%3$s</ul>')); ?>
            </div>
        </nav>
        <!-- #site-navigation -->
    </header>
    <!-- #masthead -->

    <div id="content" class="site-content">