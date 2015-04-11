<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package longbow
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    $comments_args = array(
        'label_submit'         => __( 'Post Comment', 'longbow' ),
        'title_reply'          => '<span class="comment-notes">' . __( 'Share Your Thoughts', 'longbow' ) . '</span>',
        'comment_notes_before' => '',
        'comment_notes_after'  => '',
        'fields'               => apply_filters( 'comment_form_default_fields', array(
                                                                                  'author'  =>
                                                                                      '<div class="form-group comment-form-author">' .
                                                                                      '<input id="author" name="author" type="text" class="form-control" placeholder="' . __( 'Name', 'longbow' ) . '" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" />' .
                                                                                      '</div>',

                                                                                  'email'   =>
                                                                                      '<div class="form-group comment-form-email">' .
                                                                                      '<input id="email" name="email" type="text" class="form-control" placeholder="' . __( 'Email', 'longbow' ) . '" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" />' .
                                                                                      '</div>',

                                                                                  'website' =>
                                                                                      '<div class="form-group comment-form-website">' .
                                                                                      '<input id="website" name="website" type="text" class="form-control" placeholder="' . __( 'Website (Optional)', 'longbow' ) . '" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '" />' .
                                                                                      '</div>',
                                                                              )
        )
    );

    comment_form( $comments_args );
    ?>

    <?php if ( have_comments() ) : ?>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'longbow' ); ?></h2>

                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'longbow' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'longbow' ) ); ?></div>

                </div>
                <!-- .nav-links -->
            </nav><!-- #comment-nav-above -->
        <?php endif; // check for comment navigation ?>

        <ul class="comment-list">
            <?php
            wp_list_comments( array(
                                  'style'       => 'ul',
                                  'short_ping'  => true,
                                  'avatar_size' => 70,
                                  'callback'    => 'longbow_comment_layout',
                                  'type'        => 'comment'
                              ) );
            ?>
        </ul><!-- .comment-list -->

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'longbow' ); ?></h2>

                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'longbow' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'longbow' ) ); ?></div>

                </div>
                <!-- .nav-links -->
            </nav><!-- #comment-nav-below -->
        <?php endif; // check for comment navigation ?>

    <?php endif; // have_comments() ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( !comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
        ?>
        <p class="no-comments"><?php _e( 'Comments are closed.', 'longbow' ); ?></p>
    <?php endif; ?>

</div><!-- #comments -->
