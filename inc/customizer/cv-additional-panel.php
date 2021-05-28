<?php
/**
 * Wisdom Additional Features panel at Theme Customizer
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

add_action( 'customize_register', 'wisdom_blog_additional_features_register' );

function wisdom_blog_additional_features_register( $wp_customize ) {

    /**
     * Add Additional Features Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'wisdom_blog_additional_features_panel',
	    array(
	        'priority'       => 30,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Additional Features', 'wisdom-blog' ),
	    )
    );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
	/**
     * Social Media section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'wisdom_blog_social_section',
        array(
        	'priority'       => 5,
        	'panel'          => 'wisdom_blog_additional_features_panel',
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
            'title'          => __( 'Social Media Section', 'wisdom-blog' )
        )
    );

    /**
     * Repeater field for social media
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'social_media_icons', 
        array(
            'capability'       => 'edit_theme_options',
            'default'          => json_encode(array(
                    array(
                        'cv_icons_list' => 'fa fa-twitter',
                    	'cv_url_field'  => '',
                    )
                )
            ),
            'sanitize_callback' => 'wisdom_blog_sanitize_repeater'
        )
    );
    $wp_customize->add_control( new Wisdom_Blog_Repeater_Controler(
        $wp_customize, 
            'social_media_icons', 
            array(
                'label'           => __( 'Social Media', 'wisdom-blog' ),
                'section'         => 'wisdom_blog_social_section',
                'settings'        => 'social_media_icons',
                'priority'        => 5,
                'wisdom_blog_box_label'       => __( 'Social Media Icons','wisdom-blog' ),
                'wisdom_blog_box_add_control' => __( 'Add Icon','wisdom-blog' )
            ),
            array(
                'cv_icons_list' => array(
                    'type'        => 'social_icon',
                    'label'       => __( 'Social Media Logo', 'wisdom-blog' ),
                    'description' => __( 'Choose social media icon.', 'wisdom-blog' )
                ),
                'cv_url_field' => array(
                    'type'        => 'url',
                    'label'       => __( 'Social Icon Url', 'wisdom-blog' ),
                    'description' => __( 'Enter social media url.', 'wisdom-blog' )
                )
            )
        ) 
    );

}