<?php
/**
 * Wisdom Theme Customizer
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wisdom_blog_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'wisdom_blog_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'wisdom_blog_customize_partial_blogdescription',
		) );
	}

	/**
     * Register custom section types.
     *
     * @since 1.0.6
     */
    $wp_customize->register_section_type( 'Wisdom_Blog_Customize_Section_Upsell' );

    /**
     * Register theme upsell sections.
     *
     * @since 1.0.6
     */
    $wp_customize->add_section( new Wisdom_Blog_Customize_Section_Upsell(
        $wp_customize,
            'theme_upsell',
            array(
                'title'    => __( 'Wisdom Pro', 'wisdom-blog' ),
                'pro_text' => __( 'Buy Pro', 'wisdom-blog' ),
                'pro_url'  => 'https://codevibrant.com/wpthemes/wisdom-pro/',
                'priority' => 1,
            )
        )
    );

}
add_action( 'customize_register', 'wisdom_blog_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wisdom_blog_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wisdom_blog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wisdom_blog_customize_preview_js() {
	wp_enqueue_script( 'wisdom-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'wisdom_blog_customize_preview_js' );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 */
function wisdom_blog_customize_backend_scripts() {
 	
    global $wisdom_blog_theme_version;

    wp_enqueue_style( 'wisdom-blog-font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
    
    wp_enqueue_style( 'wisdom_blog_admin_customizer_style', get_template_directory_uri() . '/assets/css/cv-customizer-styles.css', array(), esc_attr( $wisdom_blog_theme_version ) );

    wp_enqueue_script( 'wisdom_blog_admin_bootstrap', get_template_directory_uri() . '/assets/js/cv-bootstrap-toogle.js', array( 'jquery' ), esc_attr( $wisdom_blog_theme_version ), true );

    wp_enqueue_script( 'wisdom_blog_admin_customizer', get_template_directory_uri() . '/assets/js/cv-customizer-controls.js', array( 'jquery', 'customize-controls' ), esc_attr( $wisdom_blog_theme_version ), true );
}
add_action( 'customize_controls_enqueue_scripts', 'wisdom_blog_customize_backend_scripts', 10 );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Load customizer required panels.
 */
require get_template_directory() . '/inc/customizer/cv-general-panel.php';
require get_template_directory() . '/inc/customizer/cv-header-panel.php';
require get_template_directory() . '/inc/customizer/cv-front-banner-panel.php';
require get_template_directory() . '/inc/customizer/cv-design-panel.php';
require get_template_directory() . '/inc/customizer/cv-additional-panel.php';
require get_template_directory() . '/inc/customizer/cv-footer-panel.php';


require get_template_directory() . '/inc/customizer/cv-custom-classes.php';
require get_template_directory() . '/inc/customizer/cv-customizer-sanitize.php';

