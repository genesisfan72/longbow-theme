<?php
/**
 * longbow functions and definitions
 *
 * @package longbow
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( !isset( $content_width ) ) {
    $content_width = 640; /* pixels */
}

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'longbow_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 */
function longbow_register_required_plugins()
{

    $plugins = array(
        array(
            'name' => 'Wordpress Retina 2x',
            'slug' => 'wp-retina-2x',
            'required' => true,
        )
    );

    $theme_text_domain = 'woc_longbow';

    /**
     * Array of configuration settings. Uncomment and amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * uncomment the strings and domain.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain' => $theme_text_domain,
        'menu' => 'install-my-theme-plugins',
        'has_notices' => true, // Show admin notices
        'dismissable' => false, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'strings' => array(
            'page_title' => __( 'Install Recommended Plugins', $theme_text_domain ),
            'menu_title' => __( 'Install Plugins', $theme_text_domain ),
            'instructions_install' => __( 'The %1$s plugin is recommended for this theme. Click on the big blue button below to install and activate %1$s.', $theme_text_domain ),
            'instructions_activate' => __( 'The %1$s is installed but currently inactive. Please go to the <a href="%2$s">plugin administration page</a> page to activate it.', $theme_text_domain ),
            'button' => __( 'Install %s Now', $theme_text_domain ),
            'installing' => __( 'Installing Plugin: %s', $theme_text_domain ),
            'oops' => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install' => __( 'This theme recommends the use of the %1$s plugin. <a href="%2$s"><strong>Click here to begin the installation process</strong></a>. You may be asked for FTP credentials based on your server setup.', $theme_text_domain ),
            'notice_cannot_install' => __( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', $theme_text_domain ),
            'notice_can_activate' => __( 'This theme recommends the use of the %1$s plugin. That plugin is currently inactive, so please go to the <a href="%2$s">plugin administration page</a> to activate it.', $theme_text_domain ),
            'notice_cannot_activate' => __( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', $theme_text_domain ),
            'return' => __( 'Return to Plugins Installer', $theme_text_domain ),
        ),
    );

    tgmpa( $plugins, $config );
}

/**
 * Find and return the url for the featured image for a post
 */
if ( !function_exists( 'longbow_featured_image' ) ) {
    function longbow_featured_image( $post_id )
    {
        $thumbnail = get_post_thumbnail_id( $post_id );
        $bg_img = '';
        if ( $thumbnail != '' ) {
            $bg_img = wp_get_attachment_image_src( $thumbnail, 'single-post-thumbnail' ); // returns an array
            $bg_img = $bg_img[ 0 ];  // the url
        }

        return $bg_img;
    }
}

/**
 * Determine whether or not to show the hero area on the front page
 */
if ( !function_exists( 'longbow_show_hero' ) ) {
    function longbow_show_hero()
    {
        $show_hero = FALSE;
        $fp_layout = get_theme_mod( 'fp_layout', 'blog5' );

        if ( isset( $_GET[ 'fp_layout' ] ) ) {
            $fp_layout = $_GET[ 'fp_layout' ];
        }

        $allowed_layouts = array( 'blog1', 'blog4', 'blog5' );
        if ( in_array( $fp_layout, $allowed_layouts ) ) {
            $show_hero = TRUE;
        }

        return $show_hero;
    }
}

/**
 * Determine whether or not to show the post wrap area on the front page
 */
if ( !function_exists( 'longbow_show_post_wrap' ) ) {
    function longbow_show_post_wrap()
    {
        $show_wrap = FALSE;
        $fp_layout = get_theme_mod( 'fp_layout', 'blog1' );

        if ( isset( $_GET[ 'fp_layout' ] ) ) {
            $fp_layout = $_GET[ 'fp_layout' ];
        }

        $allowed_layouts = array( 'blog2', 'blog3', 'blog4', 'blog5' );
        if ( in_array( $fp_layout, $allowed_layouts ) ) {
            $show_wrap = TRUE;
        }

        return $show_wrap;
    }
}

/**
 * Determine whether or not to show the secondary post wrap area on the front page
 */
if ( !function_exists( 'longbow_show_secondary_post_wrap' ) ) {
    function longbow_show_secondary_post_wrap()
    {
        $show_wrap = FALSE;
        $fp_layout = get_theme_mod( 'fp_layout', 'blog1' );

        if ( isset( $_GET[ 'fp_layout' ] ) ) {
            $fp_layout = $_GET[ 'fp_layout' ];
        }

        $allowed_layouts = array( 'blog5' );
        if ( in_array( $fp_layout, $allowed_layouts ) ) {
            $show_wrap = TRUE;
        }

        return $show_wrap;
    }
}

/**
 * Determine whether or not to show the sidekick area on the front page
 */
if ( !function_exists( 'longbow_show_sidekick' ) ) {
    function longbow_show_sidekick()
    {
        $show_sidekick = FALSE;
        $fp_layout = get_theme_mod( 'fp_layout', 'blog5' );

        if ( isset( $_GET[ 'fp_layout' ] ) ) {
            $fp_layout = $_GET[ 'fp_layout' ];
        }

        $allowed_layouts = array( 'blog5' );
        if ( in_array( $fp_layout, $allowed_layouts ) ) {
            $show_sidekick = TRUE;
        }

        return $show_sidekick;
    }
}

if ( !function_exists( 'longbow_show_featured_products' ) ) {
    function longbow_show_featured_products()
    {
        $show_products = false;
        $fp_layout = get_theme_mod( 'fp_layout', 'blog1' );

        if ( isset( $_GET[ 'fp_layout' ] ) ) {
            $fp_layout = $_GET[ 'fp_layout' ];
        }

        $allowed_layouts = array( 'blog1', 'blog2', 'blog3', 'blog4' );
        if ( in_array( $fp_layout, $allowed_layouts ) ) {
            $show_products = TRUE;
        }

        return $show_products;
    }
}

/**
 * Enable WooCommerce support
 */
if ( !function_exists( 'woocommerce_support' ) ) {
    add_action( 'after_setup_theme', 'woocommerce_support' );
    function woocommerce_support()
    {
        add_theme_support( 'woocommerce' );
    }
}

/**
 * Get facebook shares for a post
 */
if ( !function_exists( 'get_facebook_shares' ) ) {
    function get_facebook_shares( $post_id )
    {
        $json = file_get_contents('http://graph.facebook.com/?id=http://stylehatch.co');
        $obj = json_decode($json);
        echo isset( $obj->shares ) ? $obj->shares : 0;
    }
}

/**
 * Get twitter shares for a post
 */
if ( !function_exists( 'get_twitter_shares' ) ) {
    function get_twitter_shares( $post_id )
    {
        $json = file_get_contents('http://cdn.api.twitter.com/1/urls/count.json?url=http://stylehatch.co');
        $obj = json_decode($json);
        echo isset( $obj->count ) ? $obj->count : 0;
    }
}

/**
 * Get pinterest shares for a post
 */
if ( !function_exists( 'get_pinterest_shares' ) ) {
    function get_pinterest_shares( $post_id )
    {
        $json = file_get_contents('http://api.pinterest.com/v1/urls/count.json?callback=&url=http://stylehatch.co');
        $obj = json_decode($json);
        echo isset( $obj->count ) ? $obj->count : 0;
    }
}

if ( !function_exists( 'longbow_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function longbow_setup()
    {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on longbow, use a find and replace
         * to change 'longbow' to the name of your theme in all the template files
         */
        load_theme_textdomain( 'longbow', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        //add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'longbow' ),
            'secondary' => __( 'Secondary Menu', 'longbow' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
        ) );

        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'aside', 'image', 'video', 'quote', 'link',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'longbow_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );
    }
endif; // longbow_setup
add_action( 'after_setup_theme', 'longbow_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function longbow_widgets_init()
{
    register_sidebar( array(
        'name' => __( 'Sidebar', 'longbow' ),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer 1', 'longbow' ),
        'id' => 'footer-1',
        'before_widget' => '<aside class="widget %2$s" id="%1$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer 2', 'longbow' ),
        'id' => 'footer-2',
        'before_widget' => '<aside class="widget %2$s" id="%1$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer 3', 'longbow' ),
        'id' => 'footer-3',
        'before_widget' => '<aside class="widget %2$s" id="%1$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
}

add_action( 'widgets_init', 'longbow_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function longbow_scripts()
{

    wp_enqueue_style( 'longbow-bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );

    wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );

    wp_enqueue_style( 'longbow-style', get_stylesheet_uri() );

    wp_enqueue_script( 'longbow-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

    wp_enqueue_script( 'longbow-bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '20130115', true );

    wp_enqueue_script( 'fastclick', get_template_directory_uri() . '/assets/js/fastclick.js', array(), '20130115', true );

    wp_enqueue_script( 'layzr', get_template_directory_uri() . '/assets/js/layzr.min.js', array(), '20130115', true );

    wp_enqueue_script( 'longbow', get_template_directory_uri() . '/assets/js/longbow.js', array( 'jquery' ), '20130115', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'longbow_scripts' );

/**
 * Pagination styling
 */
add_filter( 'next_posts_link_attributes', 'posts_link_attributes_1' );
add_filter( 'previous_posts_link_attributes', 'posts_link_attributes_2' );

function posts_link_attributes_1()
{
    return 'class="btn-longbow btn-next aligncenter"';
}

function posts_link_attributes_2()
{
    return 'class="btn-longbow btn-next aligncenter"';
}

// comment form field order
add_filter( 'comment_form_defaults', 'remove_textarea' );
add_action( 'comment_form_top', 'add_textarea' );

/**
 * Remove any default comment textareas
 * @param $defaults
 * @return mixed
 */
function remove_textarea($defaults)
{
    $defaults['comment_field'] = '';
    return $defaults;
}

/**
 * Add our custom textarea
 */
function add_textarea()
{
    echo '<div class="form-group comment-group-comment">' .
        '<textarea id="comment" class="form-control" name="comment" placeholder="' . __( 'Leave your comment here', 'longbow' ) . '" rows="1" aria-required="true"></textarea>' .
        '</div>';
}

/**
 * Custom comments layout callback
 */
function longbow_comment_layout($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>

    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-2">
            <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        </div>
        <div class="col-sm-10">
            <div class="row comment-author-row">
                <div class="comment-author vcard col-sm-6">
                    <?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); ?>
                </div>

                <div class="comment-meta commentmetadata col-sm-6">
                    <div class="pull-right">
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-date">
                            <?php
                            printf( '%1$s', get_comment_date() ); ?></a><?php edit_comment_link( __( '(Edit)', 'longbow' ), '  ', '' );
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'longbow' ); ?></em>
                        <br />
                    <?php endif; ?>

                    <?php comment_text(); ?>
                </div>

                <div class="col-sm-12">
                    <div class="reply">
                        <i class="fa fa-mail-reply">&nbsp;</i><?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php if ( 'div' != $args['style'] ) : ?>
        </div>
    <?php endif; ?>
<?php
}

/**
 * WooCommerce
 */
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 8;' ), 20 );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Google fonts
 */
function load_fonts()
{
    $protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_style( "PT Serif", "$protocol://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic" );
    wp_enqueue_style( "Open Sans", "$protocol://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,500,600,700,700italic,800,900" );
}

add_action( 'wp_print_styles', 'load_fonts' );
