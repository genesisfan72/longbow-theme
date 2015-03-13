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

	<footer id="colophon" class="site-footer container-fluid" role="contentinfo">
		<div id="footer_widget_area" class="site-info row">
            <div class="footer-widgets-1 col-sm-4">
                <?php dynamic_sidebar( 'footer-1' ); ?>
            </div>

            <div class="footer-widgets-1 col-sm-4">
                <?php dynamic_sidebar( 'footer-2' ); ?>
            </div>

            <div class="footer-widgets-1 col-sm-4">
                <?php dynamic_sidebar( 'footer-2' ); ?>
            </div>
        </div>

        <div class="copyright row">
            <div class="col-sm-12">
                <?php printf( __( 'Copyright %1$s.', 'woc_broadsword' ), date('Y') ); ?>
                <?php printf( __( ' Built by yours truly, %1$s.', 'woc_broadsword' ), '<a href=' . esc_url( "http://warriorsofcode.com" ) . '>the warriors</a>' ); ?>
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
