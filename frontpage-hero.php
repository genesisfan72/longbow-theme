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
?>

<?php if ( $paged == 1 ) { ?>
    <div id="fp_hero" class="container-fluid">
        <?php
            // Show the most recent post as the hero
            $args = array( 'posts_per_page' => 1 );
            $fp_post = get_posts( $args );

            if ( count( $fp_post ) > 0 ) {
                $post = $fp_post[0];
                setup_postdata( $post );

                // Get the featured image for this post
                $bg_img = longbow_featured_image( $post->ID );
        ?>
                <div class="row hero relative">
                    <div class="bg-image toparentheight" <?php if ( $bg_img != '' ) { ?>style="background:url(<?php echo esc_url($bg_img); ?>) 100% / cover;"<?php } ?>>
                    </div>
                    <?php get_template_part( 'content', 'excerpt' ); ?>
                </div>
        <?php } ?>
    </div>
<?php } ?>

<div id="post_headlines" class="container">
	<?php
        $offset = $paged == 1 ? 1 : 0;
        $posts_per_page = get_option( 'posts_per_page' );
		$args = array( 'offset' => $offset, 'paged' => $paged, 'posts_per_page' => $posts_per_page );
		$fp_posts = get_posts( $args );

		foreach ( $fp_posts as $post ) {
			setup_postdata( $post );

			// Get the featured image for this post
			$bg_img = longbow_featured_image( $post->ID );
	?>
			<div class="row fp-post-row">
				<div class="col-xs-12 relative">
                    <div class="fp-post">
                        <img src="<?php echo esc_url( $bg_img ); ?>" alt="<?php echo esc_attr( the_title() ); ?>"/>
					</div>
					<?php get_template_part( 'content', 'excerpt' ); ?>
				</div>
			</div>
	<?php
		}
	?>
</div>

<div id="fp_pagination" class="container btn-container">
	<div class="row">
        <div class="col-xs-6">
            <?php echo get_previous_posts_link( __( 'Previous', 'longbow' ) ); ?>
        </div>
        <div class="col-xs-6">
            <?php echo get_next_posts_link( __( 'Next', 'longbow' ) ); ?>
        </div>
	</div>
</div>

<div id="products" class="container-fluid products-container">
    <ul>
        <li class="product-square"></li>
        <li class="product-square"></li>
        <li class="product-square"></li>
        <li class="product-square"></li>
    </ul>

</div>