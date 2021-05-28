<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

?>

		</div><!-- .cv-container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php if ( is_active_sidebar( 'sidebar-footer' ) ): ?>
				<div class="footer-widget-area">
					<?php dynamic_sidebar( 'sidebar-footer' ); ?>
				</div><!-- .footer-widget-area -->
		<?php endif; ?>
		<div class="cv-container">
			<div class="cv-footer-logo">
				<?php
					$wisdom_blog_footer_logo = get_theme_mod( 'wisdom_blog_footer_logo_image', '' );
					if ( !empty( $wisdom_blog_footer_logo ) ) {
						echo '<figure><img src="'. esc_url( $wisdom_blog_footer_logo ) .'" /></figure>';
					}
				?>
			</div><!-- .cv-footer-logo -->
			<div class="cv-footer-right-wrapper">
					<nav id="site-footer-navigation" class="footer-navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'wisdom_blog_footer_menu', 'menu_id' => 'footer-menu', 'fallback_cb' => false ) ); ?>
					</nav><!-- #site-navigation -->
				<div class="cv-bottom-wrapper clearfix">
					<?php wisdom_blog_social_media(); ?>
					<div class="site-info">
						<span class="cv-copyright-text">
							<?php 
								$wisdom_blog_copyright_text = get_theme_mod( 'wisdom_blog_copyright_text', __( 'Wisdom Blog', 'wisdom-blog' ) );
								echo esc_html( $wisdom_blog_copyright_text );
							?>
						</span>
						<span class="sep"> | </span>
							<?php
							/* translators: 1: Theme name, 2: Theme author. */
							printf( esc_html__( 'Theme: %1$s by %2$s.', 'wisdom-blog' ), 'Wisdom Blog', '<a href="https://codevibrant.com/">CodeVibrant</a>' );
							?>
					</div><!-- .site-info -->
				</div><!-- .cv-bottom-wrapper -->
			</div><!-- .cv-footer-right-wrapper -->
		</div> <!-- cv-container -->
	</footer><!-- #colophon -->
	<div id="cv-scrollup" class="animated arrow-hide"><?php esc_html_e( 'Back To Top', 'wisdom-blog' ); ?></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
