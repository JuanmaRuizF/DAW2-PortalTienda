<?php
/**
 * File to define the custom hook functions 
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 *
 */

/*----------------------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'wisdom_blog_front_banner_content' ) ) :
	/**
	 * function to define banner section
	 */
	function wisdom_blog_front_banner_content() {
		$wisdom_blog_front_banner_option = get_theme_mod( 'wisdom_blog_front_banner_option', true );
		if ( $wisdom_blog_front_banner_option === false ) {
			return;
		}
		$wisdom_blog_front_banner_image = get_theme_mod( 'wisdom_blog_front_banner_image', '' );
		$wisdom_blog_banner_title 		= get_theme_mod( 'wisdom_blog_banner_title', __( 'Banner Title', 'wisdom-blog' ) );
		$wisdom_blog_banner_content 	= get_theme_mod( 'wisdom_blog_banner_content', '' );
		$wisdom_blog_banner_btn_text 	= get_theme_mod( 'wisdom_blog_banner_btn_text', __( 'Discover', 'wisdom-blog' ) );
		$wisdom_blog_banner_btn_link 	= get_theme_mod( 'wisdom_blog_banner_btn_link', '' );
		if ( !empty( $wisdom_blog_front_banner_image ) ) {
?>
			<div class="cv-banner-wrapper">
				<figure>
					<img src="<?php echo esc_url( $wisdom_blog_front_banner_image ); ?>">
				</figure>
				<div class="banner-content">
					<h2 class="banner-title"><?php echo esc_html( $wisdom_blog_banner_title ); ?></h2>
					<div class="banner-info"><?php echo wp_kses_post( $wisdom_blog_banner_content ); ?></div>
					<div class="banner-btn"><a href="<?php echo esc_url( $wisdom_blog_banner_btn_link ); ?>"><?php echo esc_html( $wisdom_blog_banner_btn_text ); ?> <i class="fa fa-long-arrow-right"></i></a></div>
				</div>
			</div><!-- .cv-banner-wrapper -->
<?php
		}
	}
endif;

add_action( 'wisdom_blog_front_banner', 'wisdom_blog_front_banner_content', 10 );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * author avatar box
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wisdom_blog_author_box_section' ) ) :
    function wisdom_blog_author_box_section() {
        global $post;
        $author_id = $post->post_author;
        $author_nickname = get_the_author_meta( 'display_name', $author_id );
        $np_author_website = get_the_author_meta( 'user_url', $author_id );
?>
        <div class="cv-author-box-wrapper clearfix">
            <div class="author-avatar">
                <a class="author-image" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>">
                    <?php echo get_avatar( $author_id, '132' ); ?>
                </a>
            </div><!-- .author-avatar -->

            <div class="author-desc-wrapper">                
                <a class="author-title" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><?php echo esc_html( $author_nickname ); ?></a>
                <div class="author-description"><?php echo wp_kses_post( wpautop( get_the_author_meta( 'description', $author_id ) ) ); ?></div>
                <div class="author-social">
                    <?php wisdom_blog_social_media(); ?>
                </div><!-- .author-social -->
                <?php if ( !empty( $np_author_website ) ) { ?>
                    <a href="<?php echo esc_url( $np_author_website ); ?>" target="_blank" class="admin-dec"><?php echo esc_url( $np_author_website ); ?></a>
                <?php } ?>
            </div><!-- .author-desc-wrapper-->
        </div><!-- .cv-author-box-wrapper -->
<?php
    }
endif;

add_action( 'wisdom_blog_author_box', 'wisdom_blog_author_box_section', 10 );