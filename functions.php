<?php
/**
 * Describe child theme functions
 *
 * @package Wisdom Blog
 * @subpackage Wisdom Travel
 * 
 */

/*-------------------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'wisdom_travel_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wisdom_travel_setup() {

	    $wisdom_travel_theme_info = wp_get_theme();
	    $GLOBALS['wisdom_travel_version'] = $wisdom_travel_theme_info->get( 'Version' );
	}
	endif;

add_action( 'after_setup_theme', 'wisdom_travel_setup' );

/*-------------------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'wisdom_travel_fonts_url' ) ) :
	/**
	 * Register Google fonts for News Vibrant Mag.
	 *
	 * @return string Google fonts URL for the theme.
	 * @since 1.0.0
	 */
    function wisdom_travel_fonts_url() {

        $fonts_url = '';
        $font_families = array();

        /*
         * Translators: If there are characters in your language that are not supported
         * by Lora, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Lora font: on or off', 'wisdom-travel' ) ) {
            $font_families[] = 'Lora:400,700';
        }

        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/*-------------------------------------------------------------------------------------------------------------------------------*/
	
if( ! function_exists( 'wisdom_travel_customize_register' ) ) :
	/**
	 * Managed the theme default color
	 */
	function wisdom_travel_customize_register( $wp_customize ) {
		
		global $wp_customize;

		$wp_customize->get_setting( 'wisdom_blog_theme_color' )->default = '#00bcd4';

	}
endif;

add_action( 'customize_register', 'wisdom_travel_customize_register', 20 );

/*-------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue child theme styles and scripts
 */
add_action( 'wp_enqueue_scripts', 'wisdom_travel_scripts', 20 );

function wisdom_travel_scripts() {
    
    global $wisdom_travel_version;
    
    wp_enqueue_style( 'wisdom-travel-google-font', wisdom_travel_fonts_url(), array(), null );
    
    wp_dequeue_style( 'wisdom-blog-style' );
    wp_dequeue_style( 'wisdom-blog-responsive-style' );
    
	wp_enqueue_style( 'wisdom-blog-parent-style', get_template_directory_uri() . '/style.css', array(), esc_attr( $wisdom_travel_version ) );
    
    wp_enqueue_style( 'wisdom-blog-parent-responsive', get_template_directory_uri() . '/assets/css/cv-responsive.css', array(), esc_attr( $wisdom_travel_version ) );
    
    wp_enqueue_style( 'wisdom-travel', get_stylesheet_uri(), array(), esc_attr( $wisdom_travel_version ) );
    
    $wisdom_travel_theme_color = esc_attr( get_theme_mod( 'wisdom_blog_theme_color', '#00bcd4' ) );
    
    $output_css = '';
    
    $output_css .= ".edit-link .post-edit-link,.reply .comment-reply-link,.widget_search .search-submit,.widget_search .search-submit,article.sticky:before,.widget_search .search-submit:hover{ background: ". esc_attr( $wisdom_travel_theme_color ) ."}\n";
    
    $output_css .= "a,a:hover,a:focus,a:active,.entry-footer a:hover,.comment-author .fn .url:hover,.commentmetadata .comment-edit-link,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.banner-btn a:hover,.entry-title a:hover,.entry-title a:hover,.cat-links a:hover,.wisdom_blog_latest_posts .cv-post-title a:hover{ color: ". esc_attr( $wisdom_travel_theme_color ) ."}\n";

    $output_css .= "widget_search .search-submit,.widget_search .search-submit:hover { border-color: ". esc_attr( $wisdom_travel_theme_color ) ."}\n";

    $refine_output_css = wisdom_blog_css_strip_whitespace( $output_css );

    wp_add_inline_style( 'wisdom-travel', $refine_output_css );
    
}