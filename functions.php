<?php
/**
 * longbow functions and definitions
 *
 * @package longbow
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'woc_broadsword_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 */
function woc_broadsword_register_required_plugins() {

    $plugins = array(
        array(
            'name'      => 'Wordpress Retina 2x',
            'slug'      => 'wp-retina-2x',
            'required'  => true,
        )
    );

    $theme_text_domain = 'woc_broadsword';

    /**
     * Array of configuration settings. Uncomment and amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * uncomment the strings and domain.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'       => $theme_text_domain,
        'menu'         => 'install-my-theme-plugins',
        'has_notices'  => true, // Show admin notices
        'dismissable'  => false, // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'strings'      	 => array(
            'page_title'             => __( 'Install Recommended Plugins', $theme_text_domain ),
            'menu_title'             => __( 'Install Plugins', $theme_text_domain ),
            'instructions_install'   => __( 'The %1$s plugin is recommended for this theme. Click on the big blue button below to install and activate %1$s.', $theme_text_domain ),
            'instructions_activate'  => __( 'The %1$s is installed but currently inactive. Please go to the <a href="%2$s">plugin administration page</a> page to activate it.', $theme_text_domain ),
            'button'                 => __( 'Install %s Now', $theme_text_domain ),
            'installing'             => __( 'Installing Plugin: %s', $theme_text_domain ),
            'oops'                   => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install'     => __( 'This theme recommends the use of the %1$s plugin. <a href="%2$s"><strong>Click here to begin the installation process</strong></a>. You may be asked for FTP credentials based on your server setup.', $theme_text_domain ),
            'notice_cannot_install'  => __( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', $theme_text_domain ),
            'notice_can_activate'    => __( 'This theme recommends the use of the %1$s plugin. That plugin is currently inactive, so please go to the <a href="%2$s">plugin administration page</a> to activate it.', $theme_text_domain ),
            'notice_cannot_activate' => __( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', $theme_text_domain ),
            'return'                 => __( 'Return to Plugins Installer', $theme_text_domain ),
        ),
    );

    tgmpa( $plugins, $config );
}

/**
 * Find and return the url for the featured image for a post
 */
if ( ! function_exists( 'longbow_featured_image' ) ) {
	function longbow_featured_image($post_id) {
		$thumbnail = get_post_thumbnail_id( $post_id );
	    $bg_img = '';
	    if ($thumbnail != '') {
	        $bg_img = wp_get_attachment_image_src( $thumbnail, 'single-post-thumbnail' ); // returns an array
	        $bg_img = $bg_img[0];  // the url
	    }

	    return $bg_img;
	}
}

if ( ! function_exists( 'longbow_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function longbow_setup() {

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'longbow' ),
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
function longbow_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'longbow' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

    register_sidebar(array(
        'name'          => __( 'Footer 1', 'longbow' ),
        'id'            => 'footer-1',
        'before_widget' => '<aside class="widget well %2$s" id="%1$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar(array(
        'name'          => __( 'Footer 2', 'longbow' ),
        'id'            => 'footer-2',
        'before_widget' => '<aside class="widget well %2$s" id="%1$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar(array(
        'name'          => __( 'Footer 3', 'longbow' ),
        'id'            => 'footer-3',
        'before_widget' => '<aside class="widget well %2$s" id="%1$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'longbow_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function longbow_scripts() {

	wp_enqueue_style( 'longbow-bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );

    wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );

	wp_enqueue_style( 'longbow-style', get_stylesheet_uri() );

	wp_enqueue_script( 'longbow-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'longbow-bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array(), '20130115', true );

    wp_enqueue_script( 'longbow', get_template_directory_uri() . '/assets/js/longbow.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'longbow_scripts' );

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
