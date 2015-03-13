<?php
/**
 * The template part for the hero blog layout.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package longbow
 */
?>

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

<div id="post_headlines" class="container scroll-container">
	<?php
		// Get up to two more posts
		$args = array( 'offset' => 1 );
		$fp_posts = get_posts( $args );

		foreach ( $fp_posts as $post ) {
			setup_postdata( $post );

			// Get the featured image for this post
			$bg_img = longbow_featured_image( $post->ID );
	?>
			<div class="row fp-post-row">
				<div class="col-xs-12 relative">
					<div class="bg-image-small" <?php if ( $bg_img != '' ) { ?>style="background:url(<?php echo esc_url($bg_img); ?>) 100% / cover;"<?php } ?>>
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
            <div class="btn-longbow btn-previous col-xs-12 pull-right"><?php echo __( 'Previous', 'longbow' ); ?></div>
        </div>
        <div class="col-xs-6">
            <div class="btn-longbow btn-next col-xs-12 pull-left"><?php echo __( 'Next', 'longbow' ); ?></div>
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