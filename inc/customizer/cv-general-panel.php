<?php
/**
 * Wisdom General Settings panel at Theme Customizer
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

add_action( 'customize_register', 'wisdom_blog_general_settings_register' );

function wisdom_blog_general_settings_register( $wp_customize ) {

	$wp_customize->get_section( 'title_tagline' )->panel        = 'wisdom_blog_general_settings_panel';
    $wp_customize->get_section( 'title_tagline' )->priority     = '5';
    $wp_customize->get_section( 'colors' )->panel               = 'wisdom_blog_general_settings_panel';
    $wp_customize->get_section( 'colors' )->priority            = '10';
    $wp_customize->get_section( 'background_image' )->panel     = 'wisdom_blog_general_settings_panel';
    $wp_customize->get_section( 'background_image' )->priority  = '15';
    $wp_customize->get_section( 'static_front_page' )->panel    = 'wisdom_blog_general_settings_panel';
    $wp_customize->get_section( 'static_front_page' )->priority = '20';

    /**
     * Add General Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'wisdom_blog_general_settings_panel',
	    array(
	        'priority'       => 5,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'General Settings', 'wisdom-blog' ),
	    )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Color option for theme
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_theme_color',
        array(
            'default'     => '#27B6D4',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    ); 
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
            'wisdom_blog_theme_color',
            array(
                'label'      => __( 'Theme Color', 'wisdom-blog' ),
                'section'    => 'colors',
                'priority'   => 5
            )
        )
    );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * Site layout
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'wisdom_blog_site_settings_section',
        array(
            'priority'       => 50,
            'panel'          => 'wisdom_blog_general_settings_panel',
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Site Settings', 'wisdom-blog' )
        )
    );

    /**
     * Select field for site layout
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_site_layout',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 'fullwidth',
            'sanitize_callback' => 'wisdom_blog_sanitize_select',
        )
    );
    $wp_customize->add_control(
        'wisdom_blog_site_layout',
        array(
            'label'         => __( 'Website Layout', 'wisdom-blog' ),
            'description'   => __( 'Choose layout for entire website.', 'wisdom-blog' ),
            'section'       => 'wisdom_blog_site_settings_section',
            'settings'      => 'wisdom_blog_site_layout',
            'type'          => 'select',
            'priority'      => 5,
            'choices'       => array(
                'boxed'     => __( 'Boxed Layout', 'wisdom-blog' ),
                'fullwidth' => __( 'FullWidth Layout', 'wisdom-blog' )
            )
        )
    );

}