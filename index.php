<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

get_header();
?>
<div class="cv-content-wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		$total_post_count = $wp_query->found_posts;
		$post_count = 1;
		$wisdom_blog_archive_layout = get_theme_mod( 'wisdom_blog_archive_layout', 'classic' );
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				if ( $wisdom_blog_archive_layout == 'grid' ) {
					if ( $post_count == 1 ) {
	                	echo '<div class="archive-classic-post-wrapper">';
	                } elseif ( $post_count == 2 ) {
	                	echo '<div class="archive-grid-post-wrapper">';
	                }
				}

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

				if ( $wisdom_blog_archive_layout == 'grid' ) {
					if ( $post_count == 1 || $post_count == 5 || $post_count == $total_post_count ) {
						echo '</div>';
					}
					if ( $post_count == 5 ) { $post_count = 0; }
					$post_count++;
				}

			endwhile;

			the_posts_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

    <?php wisdom_blog_get_sidebar(); ?>
</div><!-- .cv-content-wrapper -->

<?php
get_footer();