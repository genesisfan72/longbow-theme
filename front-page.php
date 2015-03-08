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
		$fp_layout = get_theme_mod( 'fp_layout', 'hero' );

		get_template_part( 'frontpage', $fp_layout );
	?>



<?php get_footer(); ?>