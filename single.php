<?php
/**
 * The template for displaying all single posts.
 *
 * @package longbow
 */

get_header(); ?>

<?php
/**
 * Get the post author info and title.
 */
$post_title = get_the_title( $post->id );
$author_name = get_the_author_meta( 'user_nicename', $post->post_author );
$author_id = get_the_author_meta( 'ID', $post->post_author );
?>

<div id="fp_hero" class="wrap hero relative">
    <?php
    // Get the featured image for this post
    $bg_img = longbow_featured_image( $post->ID );
    ?>
    <img class="bg-image absolute" src="<?php echo esc_url( $bg_img ); ?>" alt="<?php echo the_title(); ?>"/>

    <div class="container toparentheight relative">
        <div class="row">
            <?php get_template_part( 'content', 'excerpt' ); ?>
        </div>
    </div>
</div>

<div class="top-social">
    <?php get_template_part( 'content', 'social-row' ); ?>
</div>

<div id="primary" class="container content-area">
    <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="row">
                <div class="col-xs-12 <?php if ( get_theme_mod( 'show_single_sidebar', false ) ) { ?>col-sm-8<?php } ?>">
                    <?php get_template_part( 'content', 'single' ); ?>
                </div>

                <?php if ( get_theme_mod( 'show_single_sidebar', false ) ) { ?>
                    <div class="col-xs-12 col-sm-4">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>
            </div>

        <?php endwhile; // end of the loop. ?>

    </main>
    <!-- #main -->
</div><!-- #primary -->

<?php get_template_part( 'content', 'social-row' ); ?>

<div class="wrap comments-container">
    <div class="container">
        <div class="row row-centered">
            <div class="col-xs-12 col-sm-8 col-centered">
                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>
            </div>
        </div>
    </div>
</div>

<?php longbow_post_nav(); ?>

<?php get_footer(); ?>
