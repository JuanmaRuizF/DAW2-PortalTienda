<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wisdom-blog' ); ?></a>
	<?php
		if ( function_exists( 'wp_body_open' ) ) {
	        wp_body_open();
	    }
		/**
	     * wisdom_blog_before_header hook
	     *
	     * @since 1.0.7
	     */
	    do_action( 'wisdom_blog_before_header' );
	?>

	<header id="masthead" class="site-header">
		<div class="cv-container">
			<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() || is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;
				$wisdom_blog_description = get_bloginfo( 'description', 'display' );
				if ( $wisdom_blog_description || is_customize_preview() ) :
			?>
					<p class="site-description"><?php echo $wisdom_blog_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
			</div><!-- .site-branding -->

			<div id="stickyNav" class="cv-menu-wrapper">
	            <div class="menu-toggle cv-hide"><a href="javascript:void(0);"><i class="fa fa-bars"></i></a></div>
				<nav id="site-navigation" class="main-navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'wisdom_blog_primary_menu', 'menu_id' => 'primary-menu', ) ); ?>
					<div class="menu-toggle-off" data-focus=".cv-menu-wrapper .menu-toggle"><a href="javascript:void(0);"><i class="fa fa-times"></i></a></div>
				</nav><!-- #site-navigation -->
				<div class="cv-menu-extra-wrap">
					<?php
						$wisdom_blog_menu_search_option = get_theme_mod( 'wisdom_blog_menu_search_option', true );
						if ( $wisdom_blog_menu_search_option === true ) {
					?>
					<div class="cv-menu-search">
						<div class="cv-search-icon"><a href="javascript:void(0);"><i class="fa fa-search"></i></a></div>
						<div class="cv-form-wrap">
							<div class="cv-form-close" data-focus="cv-menu-search .cv-search-icon"><a href="javascript:void(0);"><i class="fa fa-close"></i></a></div>
							<?php get_search_form(); ?>
						</div>
					</div>
					<?php } ?>
				</div><!-- .menu-extra-wrap -->
			</div><!-- .cv-menu-wrapper -->
		</div> <!-- cv-container -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<?php
			if ( is_page() && !is_front_page() ) {

				$inner_header_attribute = '';
				$inner_header_attribute = apply_filters( 'wisdom_blog_inner_header_style_attribute', $inner_header_attribute );
				if ( !empty( $inner_header_attribute ) ) {
					$header_class = 'has-bg-img';
				} else {
					$header_class = 'no-bg-img';
				}
		?>
				<div class="custom-header <?php echo esc_attr( $header_class ); ?>" <?php echo ( ! empty( $inner_header_attribute ) ) ? ' style="' . esc_attr( $inner_header_attribute ) . '" ' : ''; ?>>
					<div class="cv-container">
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header><!-- .entry-header -->
					</div><!-- .cv-container -->
				</div><!-- .custom-header -->
		<?php

			}
		?>
		<div class="cv-container">
			<?php
				if ( is_front_page() ) {
					/**
					 * wisdom_blog_front_banner hook
					 */
					do_action( 'wisdom_blog_front_banner' );
				}
			?>

