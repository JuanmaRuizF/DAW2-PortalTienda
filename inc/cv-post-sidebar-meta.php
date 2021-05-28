<?php
/**
 * Functions for rendering meta boxes in post/page
 * 
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

/*----------------------------------------------------------------------------------------------------------------------------------------*/

add_action( 'add_meta_boxes', 'wisdom_blog_sidebar_metaboxes', 10, 2 );
function wisdom_blog_sidebar_metaboxes() {
    add_meta_box(
        'wisdom_blog_post_sidebar',
        __( 'Sidebar Layout', 'wisdom-blog' ),
        'wisdom_blog_sidebar_callback',
        'post',
        'normal',
        'default'
    );
    add_meta_box(
        'wisdom_blog_post_sidebar',
        __( 'Sidebar Layout', 'wisdom-blog' ),
        'wisdom_blog_sidebar_callback',
        'page',
        'normal',
        'default'
    );
}

/*----------------------------------------------------------------------------------------------------------------------------------------*/
function wisdom_blog_sidebar_callback( $post ) {

    // Setup our options.
    $wisdom_blog_page_sidebar_option = array(
        'default-sidebar' => array(
            'id'        => 'post-default-sidebar',
            'value'     => 'default_sidebar',
            'label'     => __( 'Default Sidebar', 'wisdom-blog' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/default-sidebar.png'
        ),
        'left-sidebar' => array(
            'id'        => 'post-left-sidebar',
            'value'     => 'left_sidebar',
            'label'     => __( 'Left sidebar', 'wisdom-blog' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/left-sidebar.png'
        ),
        'right-sidebar' => array(
            'id'        => 'post-right-sidebar',
            'value'     => 'right_sidebar',
            'label'     => __( 'Right sidebar', 'wisdom-blog' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/right-sidebar.png'
        ),
        'no-sidebar'    => array(
            'id'        => 'post-no-sidebar',
            'value'     => 'no_sidebar',
            'label'     => __( 'No sidebar Full width', 'wisdom-blog' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar.png'
        ),
        'no-sidebar-center' => array(
            'id'        => 'post-no-sidebar-center',
            'value'     => 'no_sidebar_center',
            'label'     => __( 'No sidebar Content Centered', 'wisdom-blog' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar-center.png'
        )
    );

    // Check for previously set.
    $sidebar_layout = get_post_meta( $post->ID, 'wisdom_blog_sidebar_layout', true );

    // If it is then we use it otherwise set to default.
    $sidebar_layout = ( $sidebar_layout ) ? $sidebar_layout : 'default_sidebar';

    // Create our nonce field.
    wp_nonce_field( 'wisdom_blog_nonce_' . basename( __FILE__ ) , 'wisdom_blog_sidebar_layout_nonce' );
    ?>
        <div class="cv-meta-options-wrap">
            <div class="buttonset">
                <?php
                    foreach ( $wisdom_blog_page_sidebar_option as $field ) {
                        $sidebar_layout = get_post_meta( $post->ID, 'wisdom_blog_sidebar_layout', true );
                        $sidebar_layout = ( $sidebar_layout ) ? $sidebar_layout : 'default_sidebar';
                ?>
                        <input type="radio" id="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $field['value'] ); ?>" name="wisdom_blog_sidebar_layout" <?php checked( $field['value'], $sidebar_layout ); ?> />
                        <label for="<?php echo esc_attr( $field['id'] ); ?>">
                            <span class="screen-reader-text"><?php echo esc_html( $field['label'] ); ?></span>
                            <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" title="<?php echo esc_attr( $field['label'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
                        </label>
                    
                <?php } ?>
            </div><!-- .buttonset -->
        </div><!-- .cv-meta-options-wrap  -->
    <?php
}

/*----------------------------------------------------------------------------------------------------------------------------------------*/
add_action( 'save_post', 'wisdom_blog_save_post_meta' );

function wisdom_blog_save_post_meta( $post_id ) {
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST['wisdom_blog_sidebar_layout_nonce'] ) && wp_verify_nonce( $_POST['wisdom_blog_sidebar_layout_nonce'], 'wisdom_blog_nonce_' . basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
        return;
    }

    // Check for out input value.
    if ( isset( $_POST['wisdom_blog_sidebar_layout'] ) ) {
        
        // We validate making sure that the option is something we can expect.
        $value = in_array( $_POST['wisdom_blog_sidebar_layout'], array( 'no_sidebar', 'left_sidebar', 'right_sidebar', 'no_sidebar_center', 'default_sidebar' ) ) ? $_POST['wisdom_blog_sidebar_layout'] : 'default_sidebar';
        
        // We update our post meta.
        update_post_meta( $post_id, 'wisdom_blog_sidebar_layout', $value );
    }
}