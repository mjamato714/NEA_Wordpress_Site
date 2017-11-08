<?php
/**
 * business functions and definitions
 *
 * @package business
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200; /* pixels */
}


if ( ! function_exists( 'business_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function business_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on business, use a find and replace
	 * to change 'business' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'business', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'business_client', 160, 75, true ); // use 420
	add_image_size( 'business_team', 400, 400, true );
	add_image_size( 'business_medium', 525, 365, false );
	add_image_size( 'business_large', 640, 555, true );
	add_image_size( 'sell_media_item', 520, 520, true ); // sell media images

	update_option( 'thumbnail_size_w', 120, true );
	update_option( 'thumbnail_size_h', 120, true );
	update_option( 'medium_size_w', 900, true );
	update_option( 'medium_size_h', '', true );
	update_option( 'large_size_w', 1280, true );
	update_option( 'large_size_h', '', true );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'business' ),
		'footer' => __( 'Footer Menu', 'business' ),
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'business_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/**
	 * Updater
	 */
	$gpp_updater = new GPP_Updater(
		'base',
		'Base',
		'base',
		'theme'
	);
}
endif; // business_setup
add_action( 'after_setup_theme', 'business_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function business_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'business' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget one-third column %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'business' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget one-third column %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'business' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget one-third column %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'business' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Bottom', 'business' ),
		'id'            => 'bottom',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'business_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function business_scripts() {

	$theme = wp_get_theme( 'business' );

	wp_enqueue_style( 'business-genericons', get_template_directory_uri() . '/genericons/genericons.css', '', business_get_theme_version() );
	wp_enqueue_style( 'business-flexslider-style', get_template_directory_uri() . '/js/flexslider/flexslider.css', '', business_get_theme_version() );
	wp_enqueue_style( 'style', get_stylesheet_uri(), array('business-genericons','business-flexslider-style'), business_get_theme_version() );
	if ( business_sell_media_check() == true )
		wp_enqueue_style( 'business-sell-media', get_template_directory_uri() . '/css/sell-media.css', '', business_get_theme_version() );

	wp_enqueue_script( 'business-navigation', get_template_directory_uri() . '/js/navigation.js', array(), business_get_theme_version(), true );
	wp_enqueue_script( 'business-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), business_get_theme_version(), true );
	wp_enqueue_script( 'business-flexslider-script', get_template_directory_uri() . '/js/flexslider/jquery.flexslider-min.js', array('jquery'), business_get_theme_version() );
	wp_enqueue_script( 'business-waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array( 'jquery' ), business_get_theme_version() );

	wp_enqueue_script( 'business-script', get_template_directory_uri() . '/js/scripts.js', array( 'jquery', 'business-flexslider-script', 'business-waypoints' ), business_get_theme_version() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'business_scripts' );

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
 * Load our custom widgets
 */
require get_template_directory() . '/inc/custom-widgets.php';
/**
 * Load custom post types
 */
require_once( get_template_directory() . '/inc/custom-post-types.php' );
/**
 * Load custom taxonomies
 */
require_once( get_template_directory() . '/inc/custom-taxonomies.php' );

/**
 * Load our custom post meta
 */
require get_template_directory() . '/inc/custom-post-meta.php';

/**
 * Updater
 */
require get_template_directory() . '/inc/updater.php';

/**
 * Load GPP theme options
 */
include_once(get_template_directory().'/options/options.php');
include_once(get_template_directory().'/theme-options.php');
