<?php
/**
 * The template for displaying archive pages
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
		?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
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
