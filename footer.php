<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package longbow
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div id="footer_widget_area" class="site-info wrap">
            <div class="container">
                <div class="row">
                    <div class="footer-widgets-1 col-sm-4">
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>

                    <div class="footer-widgets-1 col-sm-4">
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    </div>

                    <div class="footer-widgets-1 col-sm-4">
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    </div>
                </div>
            </div>
        </div>

        <nav>
            <select name="footer-nav" id="footer_nav" class="visible-xs mobile-footer-nav">
                <?php
                if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'secondary' ] ) ) {
                    $menu = wp_get_nav_menu_object( $locations[ 'secondary' ] );
                    $items = wp_get_nav_menu_items( $menu->term_id );

                    $menu_list = '';
                    foreach ((array)$items as $key => $menu_item ) {
                        $menu_list .= '<option><a href="' . esc_url( $menu_item->url ) . '">' . $menu_item->title . '</a></option>';
                    }
                    echo $menu_list;
                }
                ?>
            </select>

            <div class="hidden-xs footer-nav">
                <?php wp_nav_menu( array( 'container_class' => 'menu-footer', 'theme_location' => 'secondary', 'fallback_cb' => false ) ); ?>
            </div>
        </nav>

        <div class="social row">
            <div class="col-sm-12 text-center">
                <a href=""><i class="fa fa-4x fa-facebook"></i></a>
                <a href=""><i class="fa fa-4x fa-twitter"></i></a>
                <a href=""><i class="fa fa-4x fa-instagram"></i></a>
                <a href=""><i class="fa fa-4x fa-pinterest"></i></a>
                <a href=""><i class="fa fa-4x fa-youtube"></i></a>
                <a href=""><i class="fa fa-4x fa-google-plus"></i></a>
            </div>
        </div>

        <div class="copyright row">
            <div class="col-sm-12 alignvertical">
                <?php printf( __( 'Copyright %1$s.', 'woc_broadsword' ), date('Y') ); ?>
                <?php printf( __( ' Built by yours truly, %1$s.', 'woc_broadsword' ), '<a href=' . esc_url( "http://warriorsofcode.com" ) . '>the warriors</a>' ); ?>
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
