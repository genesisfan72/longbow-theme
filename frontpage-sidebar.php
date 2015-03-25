<?php
/**
 * The template part for the hero blog layout.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package longbow
 */
?>

<?php
    global $wp_query;
    $total_pages = $wp_query->max_num_pages;
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $layout = get_theme_mod( 'fp_layout', 'centerblock' );
?>

<?php if ( $paged == 1 ) { ?>
    <div id="fp_latest_posts" class="wrap relative">
        <div class="fp-post-row row">
            <?php
                // Show up to the three most recent posts
                $args = array( 'posts_per_page' => 3 );
                $fp_posts = get_posts( $args );

                foreach ( $fp_posts as $post ) {
                    setup_postdata( $post );
                    // Get the featured image for this post
                    $post_img = longbow_featured_image( $post->ID );
                ?>
                <div class="col-sm-4 relative side-by-side">
                    <div class="fp-post fp-post-image transparent">
                        <div class="hover-overlay toparentheight"></div>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                            <img src="<?php echo esc_url( $post_img ); ?>" alt="<?php echo esc_attr( the_title() ); ?>" />
                        </a>
                        <?php get_template_part( 'content', 'excerpt' ); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<div id="post_headlines" class="blog2 headlines-container container">

    <div class="row">
        <?php $centerclass = $layout === 'centerblock' ? 'aligncenter no-float' : ''; ?>
        <div class="col-xs-12 col-sm-8 <?php echo $centerclass; ?>">
            <?php get_template_part( 'content', 'excerpt-blog2' ); ?>

            <div class="row blog2">
                <div id="fp_pagination" class="pagination-container visible-lg-block relative">
                    <div class="col-xs-12">
                        <div class="col-xs-6 lefttext alignvertical">
                            <?php echo get_previous_posts_link( __( '< Previous', 'longbow' ) ); ?>
                        </div>
                        <div class="col-xs-6 righttext alignvertical">
                            <?php echo get_next_posts_link( __( 'Next >', 'longbow' ) ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="fp_mobile_pagination" class="container btn-container hidden-lg">
            <div class="row">
                <div class="col-xs-6">
                    <?php echo get_previous_posts_link( __( 'Previous', 'longbow' ) ); ?>
                </div>
                <div class="col-xs-6">
                    <?php echo get_next_posts_link( __( 'Next', 'longbow' ) ); ?>
                </div>
            </div>
        </div>

        <?php if ( $layout === 'sidebar' ) { ?>
            <div class="col-xs-12 col-sm-4 blog2 fp-sidebar">
                <?php get_sidebar(); ?>
            </div>
        <?php } ?>
    </div>
</div>

<div id="products" class="wrap products-container">
    <ul>
        <li class="product-square"><img src="http://lorempixel.com/400/400/fashion" alt=""/></li>
        <li class="product-square"><img src="http://lorempixel.com/400/400/sports" alt=""/></li>
        <li class="product-square"><img src="http://lorempixel.com/400/400/people" alt=""/></li>
        <li class="product-square"><img src="http://lorempixel.com/400/400/city" alt=""/></li>
        <li class="product-square"><img src="http://lorempixel.com/400/400/abstract" alt=""/></li>
        <li class="product-square"><img src="http://lorempixel.com/400/400/animals" alt=""/></li>
    </ul>

</div>