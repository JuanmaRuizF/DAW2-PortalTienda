<?php
/**
 * Wisdom Front Page Settings panel at Theme Customizer
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

add_action( 'customize_register', 'wisdom_blog_frontpage_settings_register' );

function wisdom_blog_frontpage_settings_register( $wp_customize ) {

/*----------------------------------------------------------------------------------------------------------------------------------------*/
	/**
     * Banner Section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'wisdom_blog_front_banner_section',
        array(
        	'priority'       => 10,
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
            'title'          => __( 'Banner Settings', 'wisdom-blog' ),
            'description'    => __( 'Managed the banner at frontpage.', 'wisdom-blog' ),
        )
    );

    /**
     * Checkbox for banner section at frontpage
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_front_banner_option',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => true,
            'sanitize_callback' => 'wisdom_blog_sanitize_checkbox',
        )
    );
    $wp_customize->add_control( new Wisdom_Blog_Toggle_Checkbox_Custom_Control(
        $wp_customize, 
        'wisdom_blog_front_banner_option',
            array(
                'label'         => __( 'Banner Option', 'wisdom-blog' ),
                'description'   => __( 'Option to control banner section at frontpage.', 'wisdom-blog' ),
                'section'       => 'wisdom_blog_front_banner_section',
                'settings'      => 'wisdom_blog_front_banner_option',
                'priority'      => 5
            )
        )
    );

    /**
     * Image upload field for banner image
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_front_banner_image',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control (
        $wp_customize,
        'wisdom_blog_front_banner_image',
	        array(
	            'label'         => __( 'Banner Image', 'wisdom-blog' ),
	            'section'       => 'wisdom_blog_front_banner_section',
	            'settings'      => 'wisdom_blog_front_banner_image',
	            'type'          => 'upload',
	            'priority'      => 10
	        )
    	)
	);

	/**
     * Text field for banner title
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_banner_title',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => __( 'Banner Title', 'wisdom-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'wisdom_blog_banner_title',
        array(
            'label'         => __( 'Banner Title', 'wisdom-blog' ),
            'section'       => 'wisdom_blog_front_banner_section',
            'settings'      => 'wisdom_blog_banner_title',
            'type'          => 'text',
            'priority'      => 15
        )
    );

    /**
     * Textarea field for banner content
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_banner_content',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control(
        'wisdom_blog_banner_content',
        array(
            'label'         => __( 'Banner Content', 'wisdom-blog' ),
            'description'   => __( 'Add banner info.', 'wisdom-blog' ),
            'section'       => 'wisdom_blog_front_banner_section',
            'settings'      => 'wisdom_blog_banner_content',
            'type'          => 'textarea',
            'priority'      => 20
        )
    );

    /**
     * Text field for banner button text
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_banner_btn_text',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => __( 'Discover', 'wisdom-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'wisdom_blog_banner_btn_text',
        array(
            'label'         => __( 'Banner Button Text', 'wisdom-blog' ),
            'section'       => 'wisdom_blog_front_banner_section',
            'settings'      => 'wisdom_blog_banner_btn_text',
            'type'          => 'text',
            'priority'      => 25
        )
    );

    /**
     * Text field for banner button text
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_banner_btn_link',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'wisdom_blog_banner_btn_link',
        array(
            'label'         => __( 'Banner Button Link', 'wisdom-blog' ),
            'section'       => 'wisdom_blog_front_banner_section',
            'settings'      => 'wisdom_blog_banner_btn_link',
            'type'          => 'text',
            'priority'      => 30
        )
    );

}