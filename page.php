<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package longbow
 */

get_header(); ?>

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

<?php get_footer(); ?>
