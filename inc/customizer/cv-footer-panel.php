<?php
/**
 * Wisdom Footer panel at Theme Customizer
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

add_action( 'customize_register', 'wisdom_blog_footer_settings_register' );

function wisdom_blog_footer_settings_register( $wp_customize ) {


/*----------------------------------------------------------------------------------------------------------------------------------------*/
	/**
     * Footer section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'wisdom_blog_footer_section',
        array(
        	'priority'       => 35,
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
            'title'          => __( 'Footer Section', 'wisdom-blog' )
        )
    );


    /**
     * Image upload field for banner image
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_footer_logo_image',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control (
        $wp_customize,
        'wisdom_blog_footer_logo_image',
	        array(
	            'label'         => __( 'Footer Logo', 'wisdom-blog' ),
	            'section'       => 'wisdom_blog_footer_section',
	            'settings'      => 'wisdom_blog_footer_logo_image',
	            'type'          => 'upload',
	            'priority'      => 5
	        )
    	)
	);

	/**
     * Text field for copyright
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_copyright_text',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => __( 'wisdom-blog', 'wisdom-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'wisdom_blog_copyright_text',
        array(
            'label'         => __( 'Copyright Text', 'wisdom-blog' ),
            'section'       => 'wisdom_blog_footer_section',
            'settings'      => 'wisdom_blog_copyright_text',
            'type'          => 'text',
            'priority'      => 10
        )
    );

}