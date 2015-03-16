<?php
/**
 * @package longbow
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'absolute', 'post-excerpt', 'col-xs-12', 'col-sm-8' ) ); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ) ?>

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

