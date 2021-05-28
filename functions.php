<?php
/**
 * Wisdom functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

if ( ! function_exists( 'wisdom_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wisdom_blog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Wisdom, use a find and replace
		 * to change 'wisdom-blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wisdom-blog', get_template_directory() . '/languages' );

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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Set default post thumbnail. 16:9.
		set_post_thumbnail_size( 768, 432, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'wisdom_blog_primary_menu' => esc_html__( 'Primary Menu', 'wisdom-blog' ),
			'wisdom_blog_footer_menu'  => esc_html__( 'Footer Menu', 'wisdom-blog' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wisdom_blog_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );


		// add post-formats to default post type 'posts'
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'video', 'audio', 'quote' ) );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 400,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'wisdom_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wisdom_blog_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'wisdom_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'wisdom_blog_content_width', 0 );

/**
 * Set the theme version, based on theme stylesheet.
 *
 * @global string $wisdom_blog_theme_version
 */
function wisdom_blog_theme_info() {
	$wisdom_blog_theme_info = wp_get_theme();
	$GLOBALS['wisdom_blog_theme_version'] = $wisdom_blog_theme_info->get( 'Version' );
}
add_action( 'after_setup_theme', 'wisdom_blog_theme_info', 0 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/cv-customizer.php';

/**
 * hooks
 */
require get_template_directory() . '/inc/cv-custom-hooks.php';

/**
 * Custom function for widgets
 */
require get_template_directory() . '/inc/widgets/cv-widget-functions.php';

/**
 * Custom function for widgets
 */
require get_template_directory() . '/inc/cv-post-sidebar-meta.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load TGM
 */
require get_template_directory() . '/inc/tgm/cv-recommended-plugins.php';