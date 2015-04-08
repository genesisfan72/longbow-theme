<?php
/**
 * Front Page template file.
 *
 * @package Longbow
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

<?php
    global $wp_query;
    $total_pages = $wp_query->max_num_pages;
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $post_offset = 0;
    $layout = get_theme_mod( 'fp_layout', 'blog4' );

    if ( isset( $_GET[ 'fp_layout' ] ) ) {
        $layout = $_GET[ 'fp_layout' ];
    }
?>

<?php
/*****************************************
 *
 * Hero block
 *
 ****************************************/
?>
<?php if ( longbow_show_hero() === TRUE ) { ?>
    <?php if ( $paged == 1 ) { ?>
        <div id="fp_hero" class="container-fluid hero relative">
            <?php
            // Show the most recent post as the hero
            $args = array( 'posts_per_page' => 1, 'offset' => $post_offset );
            $fp_post = get_posts( $args );

            if ( count( $fp_post ) > 0 ) {
                $post_offset++;
                $post = $fp_post[0];
                setup_postdata( $post );

                // Get the featured image for this post
                $bg_img = longbow_featured_image( $post->ID );
                ?>
                <img class="bg-image absolute" src="<?php echo esc_url($bg_img); ?>" alt="<?php echo the_title(); ?>"/>
                <div class="container toparentheight relative">
                    <div class="row">
                        <?php get_template_part( 'content', 'excerpt' ); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
<?php } ?>

<?php
/*****************************************
 *
 * Post wrap block
 *
 ****************************************/
?>
<?php if ( longbow_show_post_wrap() === true ) { ?>
    <?php if ( $paged == 1 ) { ?>
        <div class="container-fluid relative post-wrap">
            <div class="fp-post-row">
                <?php
                // Show up to the three most recent posts
                $posts_to_show = $layout === 'blog5' ? 2 : 3;
                $args = array( 'posts_per_page' => $posts_to_show, 'offset' => $post_offset );
                $fp_posts = get_posts( $args );

                foreach ( $fp_posts as $post ) {
                    $post_offset++;
                    setup_postdata( $post );
                    // Get the featured image for this post
                    $post_img = longbow_featured_image( $post->ID );
                    $col_size = $layout === 'blog5' ? '6' : '4';
                    $margin_bottom = $layout === 'blog5' ? 'no-row-margin' : '';
                    ?>
                    <div class="col-sm-<?php echo esc_attr( $col_size ); ?> relative side-by-side">
                        <div class="fp-post fp-post-image transparent <?php echo $margin_bottom; ?>">
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
<?php } ?>

<?php
/*****************************************
 *
 * Post excerpts block
 *
 ****************************************/
?>
<?php if ( $layout === 'blog1' ) { ?>
    <div id="post_headlines" class="container">
        <div class="row blog1 fp-post-row">
            <?php
            $offset = $paged == 1 ? 1 : 0;
            $posts_per_page = get_option( 'posts_per_page' );
            $args = array( 'offset' => $post_offset, 'paged' => $paged, 'posts_per_page' => $posts_per_page );
            $fp_posts = get_posts( $args );

            foreach ( $fp_posts as $post ) {
                $post_offset++;
                setup_postdata( $post );

                // Get the featured image for this post
                $post_img = longbow_featured_image( $post->ID );
                ?>
                <div class="col-xs-12 col-sm-6 relative">
                    <div class="fp-post fp-post-image transparent">
                        <div class="hover-overlay toparentheight"></div>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                            <img src="<?php echo esc_url( $post_img ); ?>" alt="<?php echo esc_attr( the_title() ); ?>" />
                        </a>
                        <?php get_template_part( 'content', 'excerpt' ); ?>
                    </div>
                </div>
            <?php
            }
            ?>
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
<?php } ?>

<?php if ( $layout === 'blog2' || $layout === 'blog3' || $layout === 'blog4' ) { ?>
    <div id="post_headlines" class="blog2 headlines-container container">

        <div class="row">
            <?php $centerclass = $layout === 'blog3' || $layout === 'blog4' ? 'aligncenter no-float' : ''; ?>
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

            <?php if ( $layout === 'blog2' ) { ?>
                <div class="col-xs-12 col-sm-4 blog2 fp-sidebar">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<?php
/*****************************************
 *
 * Sidekick block
 *
 ****************************************/
?>
<?php if ( longbow_show_sidekick() === true ) { ?>
    <?php if ( $paged == 1 ) { ?>
        <div id="fp_hero" class="container-fluid hero relative">
            <?php
            // Show the most recent post as the hero
            $args = array( 'posts_per_page' => 1, 'offset' => $post_offset );
            $fp_post = get_posts( $args );

            if ( count( $fp_post ) > 0 ) {
                $post_offset++;
                $post = $fp_post[0];
                setup_postdata( $post );

                // Get the featured image for this post
                $bg_img = longbow_featured_image( $post->ID );
                ?>
                <img class="bg-image absolute" src="<?php echo esc_url($bg_img); ?>" alt="<?php echo the_title(); ?>"/>
                <div class="container toparentheight relative">
                    <div class="row">
                        <?php get_template_part( 'content', 'excerpt' ); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
<?php } ?>

<?php
/*****************************************
 *
 * Secondary post wrap block
 *
 ****************************************/
?>
<?php if ( longbow_show_secondary_post_wrap() === true ) { ?>
    <?php if ( $paged == 1 ) { ?>
        <div class="container-fluid relative post-wrap">
            <div class="fp-post-row">
                <?php
                // Show up to the three most recent posts
                $args = array( 'posts_per_page' => 2, 'offset' => $post_offset );
                $fp_posts = get_posts( $args );

                foreach ( $fp_posts as $post ) {
                    $post_offset++;
                    setup_postdata( $post );
                    // Get the featured image for this post
                    $post_img = longbow_featured_image( $post->ID );
                    $margin_bottom = $layout === 'blog5' ? 'no-row-margin' : '';
                    ?>
                    <div class="col-sm-6 relative side-by-side">
                        <div class="fp-post fp-post-image transparent <?php echo $margin_bottom; ?>">
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
<?php } ?>

<?php if ( $layout === 'blog1' || $layout === 'blog5' ) {
    $container = $layout === 'blog1' ? 'pagination-container' : 'load-more-container'; ?>
    <div id="fp_pagination" class="<?php echo $container; ?> container-fluid visible-lg-block relative">
        <div class="container alignvertical">
            <div class="row">
                <?php if ( $layout === 'blog1' ) { ?>
                    <div class="col-xs-6 centertext">
                        <?php echo get_previous_posts_link( __( '<i class="fa fa-angle-left"></i> &nbsp;Previous', 'longbow' ) ); ?>
                    </div>
                    <div class="col-xs-6 centertext">
                        <?php echo get_next_posts_link( __( 'Next &nbsp;<i class="fa fa-angle-right"></i>', 'longbow' ) ); ?>
                    </div>
                <?php } ?>
                <?php if ($layout === 'blog5' ) { ?>
                    <div class="load-more"><?php echo __( 'Load More', 'longbow' ); ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

<?php
/*****************************************
 *
 * Products block
 *
 ****************************************/
?>
<?php if ( longbow_show_featured_products() === true ) { ?>
    <div id="products" class="container-fluid products-container">
        <ul>
            <li class="product-square"><img src="http://lorempixel.com/400/400/fashion" alt=""/></li>
            <li class="product-square"><img src="http://lorempixel.com/400/400/sports" alt=""/></li>
            <li class="product-square"><img src="http://lorempixel.com/400/400/people" alt=""/></li>
            <li class="product-square"><img src="http://lorempixel.com/400/400/city" alt=""/></li>
            <li class="product-square"><img src="http://lorempixel.com/400/400/abstract" alt=""/></li>
            <li class="product-square"><img src="http://lorempixel.com/400/400/animals" alt=""/></li>
        </ul>
    </div>
<?php } ?>


<?php get_footer(); ?>