<?php
/**
 * @package longbow
 */
?>

<?php
$layout = get_theme_mod( 'fp_layout', 'blog1' );

if ( isset( $_GET[ 'fp_layout' ] ) ) {
    $layout = $_GET[ 'fp_layout' ];
}

$post_class = array ( 'absolute', 'post-excerpt', 'col-xs-12' );
if ( $layout === 'blog1' ) {
    array_push( $post_class, 'col-sm-8' );
}
if ( $layout === 'blog5' || is_single() == true ) {
    array_push ( $post_class, 'variant' );
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
	<header class="entry-header">
        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
		    <?php the_title( '<h1 class="entry-title">', '</h1>' ) ?>
        </a>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php longbow_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<footer class="entry-footer">
        <?php if ( 'post' == get_post_type() ) :
		    longbow_entry_footer();
        endif; ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

