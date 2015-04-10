<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package longbow
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'longbow' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'longbow' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'longbow' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'longbow' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'longbow_posted_on_in_category' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and category.
     */
    function longbow_posted_on_in_category($id) {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c', $id ) ),
            esc_html( get_the_date( 'F j, Y', $id) ),
            esc_attr( get_the_modified_date( 'c', $id ) ),
            esc_html( get_the_modified_date( 'F j, Y', $id) )
        );

        $posted_on = sprintf( _x( '%s', 'post date', 'woc_broadsword' ), $time_string );

        $categories = get_the_category($id);
        $separator = ', ';
        $category_output = '';
        $byline = '';

        if ($categories) {
            foreach($categories as $category) {
                $category_output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s", "woc_broadsword" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
            }

            $category_output = trim($category_output, $separator);
            $byline = sprintf(_x( 'in %s', 'post category', 'woc_broadsword' ), $category_output);
        }

        echo '<h3>' . $posted_on . ' ' . $byline . '</h3>';

    }
endif;

if ( ! function_exists( 'longbow_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function longbow_posted_on() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date( 'F j' ) )
		);

		$posted_on = sprintf(
			_x( '%s', 'post date', 'longbow' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'longbow' ) );
		if ( $categories_list && longbow_categorized_blog() ) {
			printf( $posted_on . '<span class="cat-links">' . __( ' in %1$s', 'longbow' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'longbow' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'longbow' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( '', __( ' - 1 Comment', 'longbow' ), __( ' - % Comments', 'longbow' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'longbow' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'longbow_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function longbow_entry_footer() {
	$byline = sprintf(
		_x( 'Written by %s', 'post author', 'longbow' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"><div class="circle"></div> ' . $byline . '</span>';
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'longbow' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'longbow' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'longbow' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'longbow' ), get_the_date( _x( 'Y', 'yearly archives date format', 'longbow' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'longbow' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'longbow' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'longbow' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'longbow' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'longbow' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'longbow' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'longbow' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'longbow' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'longbow' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'longbow' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'longbow' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'longbow' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'longbow' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'longbow' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'longbow' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'longbow' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function longbow_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'longbow_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'longbow_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so longbow_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so longbow_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in longbow_categorized_blog.
 */
function longbow_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'longbow_categories' );
}
add_action( 'edit_category', 'longbow_category_transient_flusher' );
add_action( 'save_post',     'longbow_category_transient_flusher' );

if ( ! function_exists( 'longbow_post_nav' ) ) :
    /**
     * Display navigation to next/previous post when applicable.
     */
    function longbow_post_nav() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
        $next     = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous ) {
            return;
        }
        ?>
        <nav class="navigation post-navigation container-fluid" role="navigation">
            <div class="nav-links row">
                <?php
                $prev_post = get_previous_post();
                $post_class = array ( 'absolute', 'post-excerpt', 'col-xs-12' );
                $args = array( 'order' => 'ASC', 'post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'post_date', 'posts_per_page' => -1 );
                $posts_array = get_posts( $args );
                $first_post = count( $posts_array ) > 0 ? $posts_array[0] : NULL;
                $last_post = count( $posts_array ) > 0 ? $posts_array[count($posts_array) - 1] : NULL;

                if ( empty( $prev_post ) ) {
                    $prev_post = $last_post;
                }

                if ( has_post_thumbnail( $prev_post->ID) ) {
                    $prev_feat_image = wp_get_attachment_url( get_post_thumbnail_id($prev_post->ID) );
                }

                $next_post = get_next_post();
                if ( empty( $next_post ) ) {
                    $next_post = $first_post;
                }
                if ( has_post_thumbnail( $next_post->ID) ) {
                    $next_feat_image = wp_get_attachment_url( get_post_thumbnail_id($next_post->ID) );
                }
                ?>

                <?php
                // Check to see if we have a previous post to show
                if ( $prev_post != "" ) {
                    ?>
                    <div class="footer-nav col-sm-6">
                        <div class="fp-post fp-post-image transparent">
                            <div class="hover-overlay toparentheight"></div>
                            <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="bookmark">
                                <img src="<?php echo esc_url( $prev_feat_image ); ?>" alt="<?php echo esc_html( $prev_post->post_title ); ?>" />
                            </a>

                            <article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
                                <header class="entry-header">
                                    <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="bookmark">
                                        <h1 class="entry-title"><?php echo esc_html( $prev_post->post_title ); ?></h1>
                                    </a>

                                    <?php if ( 'post' == get_post_type() ) : ?>
                                        <div class="entry-meta">
                                            <?php longbow_posted_on(); ?>
                                        </div><!-- .entry-meta -->
                                    <?php endif; ?>
                                </header><!-- .entry-header -->

                                <footer class="entry-footer">
                                    <?php if ( 'post' == get_post_type() ) :
                                        longbow_entry_footer();
                                    endif; ?>
                                </footer><!-- .entry-footer -->
                            </article><!-- #post-## -->
                        </div>
                    </div>
                <?php
                }
                ?>

                <?php
                // Check to see if we have a next post to show
                if ( !empty( $next_post) ) {
                    ?>
                    <div class="footer-nav col-sm-6">
                        <div class="fp-post fp-post-image transparent">
                            <div class="hover-overlay toparentheight"></div>
                            <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="bookmark">
                                <img src="<?php echo esc_url( $next_feat_image ); ?>" alt="<?php echo esc_html( $next_post->post_title ); ?>" />
                            </a>
                            <article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
                                <header class="entry-header">
                                    <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="bookmark">
                                        <h1 class="entry-title"><?php echo esc_html( $next_post->post_title ); ?></h1>
                                    </a>

                                    <?php if ( 'post' == get_post_type() ) : ?>
                                        <div class="entry-meta">
                                            <?php longbow_posted_on(); ?>
                                        </div><!-- .entry-meta -->
                                    <?php endif; ?>
                                </header><!-- .entry-header -->

                                <footer class="entry-footer">
                                    <?php if ( 'post' == get_post_type() ) :
                                        longbow_entry_footer();
                                    endif; ?>
                                </footer><!-- .entry-footer -->
                            </article><!-- #post-## -->
                        </div>
                    </div>
                <?php
                }
                ?>

            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
    <?php
    }
endif;
