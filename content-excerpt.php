<?php
/**
 * @package longbow
 */
?>

<?php
$layout = get_theme_mod( 'fp_layout', 'blog5' );

if ( isset( $_GET[ 'fp_layout' ] ) ) {
    $layout = $_GET[ 'fp_layout' ];
}

$post_class = array ( 'absolute', 'post-excerpt', 'col-xs-12', 'col-sm-8' );
if ( $layout === 'blog5' ) {
    array_push ( $post_class, 'variant' );
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ) ?>

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

