<?php
/**
 * Wisdom Design Settings panel at Theme Customizer
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

add_action( 'customize_register', 'wisdom_blog_design_settings_register' );

function wisdom_blog_design_settings_register( $wp_customize ) {

    $wp_customize->register_control_type( 'Wisdom_Blog_Customize_Control_Radio_Image' );

    /**
     * Add Design Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'wisdom_blog_design_settings_panel',
	    array(
	        'priority'       => 20,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Design Settings', 'wisdom-blog' ),
	    )
    );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
	/**
     * Archive section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'wisdom_blog_archive_section',
        array(
        	'priority'       => 5,
        	'panel'          => 'wisdom_blog_design_settings_panel',
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
            'title'          => __( 'Archive Section', 'wisdom-blog' )
        )
    );

    /**
     * Radio image field for archive sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_archive_sidebar',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'wisdom_blog_sanitize_select',
        )
    );
    $wp_customize->add_control( new Wisdom_Blog_Customize_Control_Radio_Image(
        $wp_customize,
        'wisdom_blog_archive_sidebar',
            array(
                'label'         => __( 'Archive Sidebars', 'wisdom-blog' ),
                'description'   => __( 'Choose sidebar from available layouts', 'wisdom-blog' ),
                'section'       => 'wisdom_blog_archive_section',
                'settings'      => 'wisdom_blog_archive_sidebar',
                'priority'      => 5,
                'choices'       => array(
                    'left_sidebar'      => array(
                        'label'         => __( 'Left Sidebar', 'wisdom-blog' ),
                        'url'           => '%s/assets/images/left-sidebar.png'
                    ),
                    'right_sidebar'     => array(
                        'label'         => __( 'Right Sidebar', 'wisdom-blog' ),
                        'url'           => '%s/assets/images/right-sidebar.png'
                    ),
                    'no_sidebar'        => array(
                        'label'         => __( 'No Sidebar', 'wisdom-blog' ),
                        'url'           => '%s/assets/images/no-sidebar.png'
                    ),
                    'no_sidebar_center' => array(
                        'label'         => __( 'No Sidebar Center', 'wisdom-blog' ),
                        'url'           => '%s/assets/images/no-sidebar-center.png'
                    )
                )
            )
        )
    );

    /**
     * Image Radio field for archive layout
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_archive_layout',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 'classic',
            'sanitize_callback' => 'wisdom_blog_sanitize_select',
        )
    );
    $wp_customize->add_control( new Wisdom_Blog_Customize_Control_Radio_Image(
        $wp_customize,
        'wisdom_blog_archive_layout',
            array(
                'label'         => __( 'Archive Layouts', 'wisdom-blog' ),
                'description'   => __( 'Choose layout from available layouts', 'wisdom-blog' ),
                'section'       => 'wisdom_blog_archive_section',
                'settings'      => 'wisdom_blog_archive_layout',
                'priority'      => 10,
                'choices'       => array(
                    'classic'   => array(
                        'label' => __( 'Classic', 'wisdom-blog' ),
                        'url'   => '%s/assets/images/archive-layout1.png'
                    ),
                    'grid' => array(
                        'label' => __( 'Grid', 'wisdom-blog' ),
                        'url'   => '%s/assets/images/archive-layout2.png'
                    )
                ),
                
            )
        )
    );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * Page Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'wisdom_blog_page_section',
        array(
            'priority'       => 10,
            'panel'          => 'wisdom_blog_design_settings_panel',
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Page Settings', 'wisdom-blog' )
        )
    );      

    /**
     * Radio image field for page sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_global_page_sidebar',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'wisdom_blog_sanitize_select',
        )
    );
    $wp_customize->add_control( new Wisdom_Blog_Customize_Control_Radio_Image(
        $wp_customize,
        'wisdom_blog_global_page_sidebar',
            array(
                'label'         => __( 'Page Sidebars', 'wisdom-blog' ),
                'description'   => __( 'Choose sidebar from available layouts', 'wisdom-blog' ),
                'section'       => 'wisdom_blog_page_section',
                'settings'      => 'wisdom_blog_global_page_sidebar',
                'priority'      => 5,
                'choices'       => array(
                    'left_sidebar'      => array(
                        'label'         => __( 'Left Sidebar', 'wisdom-blog' ),
                        'url'           => '%s/assets/images/left-sidebar.png'
                    ),
                    'right_sidebar'     => array(
                        'label'         => __( 'Right Sidebar', 'wisdom-blog' ),
                        'url'           => '%s/assets/images/right-sidebar.png'
                    ),
                    'no_sidebar'        => array(
                        'label'         => __( 'No Sidebar', 'wisdom-blog' ),
                        'url'           => '%s/assets/images/no-sidebar.png'
                    ),
                    'no_sidebar_center' => array(
                        'label'         => __( 'No Sidebar Center', 'wisdom-blog' ),
                        'url'           => '%s/assets/images/no-sidebar-center.png'
                    )
                )
            )
        )
    );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * Post Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'wisdom_blog_post_section',
        array(
            'priority'       => 15,
            'panel'          => 'wisdom_blog_design_settings_panel',
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Post Settings', 'wisdom-blog' )
        )
    );      

    /**
     * Radio image field for page sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'wisdom_blog_global_post_sidebar',
        array(
            'capability'        => 'edit_theme_options',
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'wisdom_blog_sanitize_select',
        )
    );
    $wp_customize->add_control( new Wisdom_Blog_Customize_Control_Radio_Image(
        $wp_customize,
        'wisdom_blog_global_post_sidebar',
            array(
                'label'         => __( 'Post Sidebars', 'wisdom-blog' ),
                'description'   => __( 'Choose sidebar from available layouts', 'wisdom-blog' ),
                'section'       => 'wisdom_blog_post_section',
                'settings'      => 'wisdom_blog_global_post_sidebar',
                'priority'      => 5,
                'choices'       => array(
                    'left_sidebar'      => array(
                        'label'         => __( 'Left Sidebar', 'wisdom-blog' ),
                        'url'           => '%s/assets/images/left-sidebar.png'
                    ),
                    'right_sidebar'     => array(
                        'label'         => __( 'Right Sidebar', 'wisdom-blog' ),
                        'url'           => '%s/assets/images/right-sidebar.png'
                    ),
                    'no_sidebar'        => array(
                        'label'         => __( 'No Sidebar', 'wisdom-blog' ),
                        'url'           => '%s/assets/images/no-sidebar.png'
                    ),
                    'no_sidebar_center' => array(
                        'label'         => __( 'No Sidebar Center', 'wisdom-blog' ),
                        'url'           => '%s/assets/images/no-sidebar-center.png'
                    )
                )
            )
        )
    );

}