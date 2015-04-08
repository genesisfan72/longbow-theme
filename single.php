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
$post_title = get_the_title($post->id);
$author_name = get_the_author_meta( 'user_nicename', $post->post_author );
$author_id = get_the_author_meta( 'ID', $post->post_author );
?>

    <div id="fp_hero" class="container-fluid hero relative">
        <?php
        // Get the featured image for this post
        $bg_img = longbow_featured_image( $post->ID );
        ?>
        <img class="bg-image absolute" src="<?php echo esc_url($bg_img); ?>" alt="<?php echo the_title(); ?>"/>
        <div class="container toparentheight relative">
            <div class="row">
                <?php get_template_part( 'content', 'excerpt' ); ?>
            </div>
        </div>
    </div>

    <div class="social-shares container-fluid">
        <div class="container toparentheight">
            <div class="row toparentheight">
                <div class="col-xs-12 alignvertical centertext">
                    <div class="row">
                        <div class="col-xs-4 col-sm-2 col-sm-offset-3 social-share">
                            <i class="fa fa-facebook"></i><?php get_facebook_shares( $post->ID ); ?>
                        </div>

                        <div class="col-xs-4 col-sm-2 social-share">
    <!--                        <i class="fa fa-twitter"></i>--><?php //get_twitter_shares( $post->ID ); ?>
                            <i class="fa fa-twitter"></i>18240
                        </div>

                        <div class="col-xs-4 col-sm-2 social-share">
                            <i class="fa fa-pinterest"></i><?php get_pinterest_shares( $post->ID ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div id="primary" class="container content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

            <div class="row">
                <div class="col-xs-12 col-sm-8">
                    <?php get_template_part( 'content', 'single' ); ?>
                </div>

                <div class="col-xs-12 col-sm-4">
                    <?php get_sidebar(); ?>
                </div>
            </div>

            <div class="row">
                <div class="container-fluid">
                    <?php the_post_navigation(); ?>
                </div>
            </div>

            <div class="row">
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
            </div>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->



<?php
/**
 * Get the post author info and title.
 */
$post_title = get_the_title($post->id);
$author_name = get_the_author_meta( 'user_nicename', $post->post_author );
$author_id = get_the_author_meta( 'ID', $post->post_author );
?>

<?php /*
<section id="primary" class="hideme content-area single">
    <div class="single-image-container header-image">
        <div class="arrow-container arrow-container-bottom">
            <i id="arrow_down" class="fa fa-angle-down fa-4x direction-arrow"></i>
        </div>

        <div class="post-details title-details single">
            <div class="entry-header">
                <h1><?php echo $post_title; ?></h1>
            </div><!-- .entry-header -->

            <div class="entry-summary">
                <div class="dimmed-06">
                    <div class="uppercase"><?php //woc_broadsword_posted_on_in_category($post->id); ?></div>
                    <?php
                    $byline = sprintf(
                        _x( 'by %s', 'post author', 'woc_broadsword' ),
                        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . esc_html( $author_name ) . '</a></span>'
                    );
                    ?>
                    <div><?php echo '<span class="byline"> ' . $byline . '</span>'; ?></div>
                </div>
            </div><!-- .entry-summary -->
        </div>
    </div>

    <main id="main" class="site-main" role="main">

        <div class="container-fluid">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'single' ); ?>

                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() ) :
                    comments_template();
                endif;
                ?>

                <?php //woc_broadsword_post_nav(); ?>

            <?php endwhile; // end of the loop. ?>

        </div>

    </main><!-- #main -->
</section><!-- #primary -->
*/ ?>
<?php get_footer(); ?>
