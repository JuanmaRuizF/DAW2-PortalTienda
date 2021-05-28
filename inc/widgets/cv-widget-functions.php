<?php

/**
 * custom function and work related to widgets.
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wisdom_blog_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wisdom-blog' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wisdom-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'wisdom-blog' ),
		'id'            => 'sidebar-left',
		'description'   => esc_html__( 'Add widgets here for left sidebar.', 'wisdom-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar', 'wisdom-blog' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Add widgets here for footer widget area.', 'wisdom-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'wisdom_blog_widgets_init' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register different widgets
 *
 * @since 1.0.1
 */
add_action( 'widgets_init', 'wisdom_blog_register_widgets' );

function wisdom_blog_register_widgets() {

	// Author Info
	register_widget( 'Wisdom_Blog_Author_Info' );

	// Latest Posts
	register_widget( 'Wisdom_Blog_Latest_Posts' );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Load widget required files
 *
 * @since 1.0.0
 */

require get_template_directory() . '/inc/widgets/cv-widget-fields.php';    // Widget fields

require get_template_directory() . '/inc/widgets/cv-author-info.php';    // Author Info
require get_template_directory() . '/inc/widgets/cv-latest-posts.php';    // Author Info