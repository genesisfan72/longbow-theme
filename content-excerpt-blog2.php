<?php
/**
 * @package longbow
 */
?>

<?php
$offset = $paged == 1 ? 1 : 0;
$posts_per_page = get_option( 'posts_per_page' );
$args = array( 'offset' => $offset, 'paged' => $paged, 'posts_per_page' => $posts_per_page );
$fp_posts = get_posts( $args );

foreach ( $fp_posts as $post ) {
    setup_postdata( $post );

    // Get the featured image for this post
    $post_img = longbow_featured_image( $post->ID );
    ?>
    <div class="row fp-post-row blog2">
        <div class="fp-post">
            <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'relative', 'post-excerpt', 'col-xs-12' ) ); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ) ?>

                    <?php if ( 'post' == get_post_type() ) : ?>
                        <div class="entry-meta">
                            <?php longbow_posted_on(); ?>
                        </div><!-- .entry-meta -->
                    <?php endif; ?>
                </header><!-- .entry-header -->

                <div class="fp-post-image relative">
                    <div class="hover-overlay toparentheight"></div>

                    <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                        <img src="<?php echo esc_url( $post_img ); ?>" alt="<?php echo esc_attr( the_title() ); ?>" />
                    </a>

                    <div class="absolute byline-container">
                        <?php longbow_entry_footer(); ?>
                    </div>
                </div>

                <div class="entry-excerpt hidden-xs">
                    <?php the_excerpt(); ?>
                </div>
            </article><!-- #post-## -->
        </div>
    </div>
<?php
}
?>




