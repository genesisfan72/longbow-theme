<?php
/**
 * @package longbow
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'absolute', 'post-excerpt', 'alignvertical' ) ); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title alignvertical"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php longbow_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<footer class="entry-footer">
		<?php longbow_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

