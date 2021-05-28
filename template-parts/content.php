<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

if ( has_post_thumbnail() ) {
    $post_class = 'has-thumbnail wow fadeInUp';
} else {
    $post_class = 'no-thumbnail wow fadeInUp';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?> data-wow-delay="0.5s">
	
	<?php wisdom_blog_post_thumbnail(); ?>

	<header class="entry-header">
		<div class="entry-cat">
			<?php
				wisdom_blog_post_categories_list();
			?>
		</div>
		<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
		?>
				<div class="entry-meta">
					<?php 
						wisdom_blog_posted_on();
					?>
				</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_excerpt( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wisdom-blog' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wisdom-blog' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-btn">
		<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'wisdom-blog' ); ?></a>
	</div>

	<footer class="entry-footer">
		<?php wisdom_blog_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
