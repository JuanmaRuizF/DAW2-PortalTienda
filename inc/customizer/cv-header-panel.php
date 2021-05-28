<?php
/**
 * Wisdom Header Settings panel at Theme Customizer
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

add_action( 'customize_register', 'wisdom_blog_header_settings_register' );

function wisdom_blog_header_settings_register( $wp_customize ) {

	$wp_customize->get_section( 'header_image' )->panel = 'wisdom_blog_header_settings_panel';
	$wp_customize->get_section( 'header_image' )->title = __( 'Innerpages Header Image', 'wisdom-blog' );
    $wp_customize->get_section( 'header_image' )->priority = '25';

    /**
     * Add General Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'wisdom_blog_header_settings_panel',
	    array(
	        'priority'       => 10,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Header Settings', 'wisdom-blog' ),
	    )
    );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
	/**
     * Top Header section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'wisdom_blog_header_extra_section',
        array(
        	'priority'       => 5,
        	'panel'          => 'wisdom_blog_header_settings_panel',
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
            'title'          => __( 'Extra Option', 'wisdom-blog' ),
            'description'    => __( 'Managed the extra settings for header section.', 'wisdom-blog' ),
        )
    );

    /**
     * Checkbox for search icon at primary menu
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_menu_search_option',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => true,
            'sanitize_callback' => 'wisdom_blog_sanitize_checkbox',
        )
    );
    $wp_customize->add_control( new Wisdom_Blog_Toggle_Checkbox_Custom_Control(
        $wp_customize, 
        'wisdom_blog_menu_search_option',
            array(
                'label'         => __( 'Search Icon', 'wisdom-blog' ),
                'description'   => __( 'Option to control search icon at primary menu.', 'wisdom-blog' ),
                'section'       => 'wisdom_blog_header_extra_section',
                'settings'      => 'wisdom_blog_menu_search_option',
                'priority'      => 5
            )
        )
    );

}