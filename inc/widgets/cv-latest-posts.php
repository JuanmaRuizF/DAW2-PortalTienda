<?php
/**
 * CV: Latest Posts
 *
 * Widget show the latest post with thumbnail.
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

class Wisdom_Blog_Latest_Posts extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'wisdom_blog_latest_posts',
            'description' => __( 'A widget to display the latest posts with thumbnail.', 'wisdom-blog' )
        );
        parent::__construct( 'wisdom_blog_latest_posts', __( 'CV: Latest Posts', 'wisdom-blog' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(

            'widget_title' => array(
                'wisdom_blog_widgets_name'         => 'widget_title',
                'wisdom_blog_widgets_title'        => __( 'Widget title', 'wisdom-blog' ),
                'wisdom_blog_widgets_field_type'   => 'text'
            ),

            'widget_post_count' => array(
                'wisdom_blog_widgets_name'         => 'widget_post_count',
                'wisdom_blog_widgets_title'        => __( 'Post Count', 'wisdom-blog' ),
                'wisdom_blog_widgets_default'      => '5',
                'wisdom_blog_widgets_field_type'   => 'number'
            ),

        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        if ( empty( $instance ) ) {
            return ;
        }

        $wisdom_blog_widget_title = empty( $instance['widget_title'] ) ? '' : $instance['widget_title'];
        $wisdom_blog_post_count = empty( $instance['widget_post_count'] ) ? '5' : $instance['widget_post_count'];

        echo $before_widget;
    ?>
            <div class="cv-latest-posts-wrapper">
                <?php
                    if ( !empty( $wisdom_blog_widget_title ) ) {
                        echo $before_title . esc_html( $wisdom_blog_widget_title ) . $after_title;
                    }
                ?>
                <div class="cv-posts-content-wrapper">
                    <?php
                        $wisdom_blog_posts_args = array(
                                'posts_per_page' => absint( $wisdom_blog_post_count )
                            );
                        $wisdom_blog_posts_query = new WP_Query( $wisdom_blog_posts_args );
                        if ( $wisdom_blog_posts_query->have_posts() ) {
                            while( $wisdom_blog_posts_query->have_posts() ) {
                                $wisdom_blog_posts_query->the_post();
                    ?>
                                <div class="cv-single-post-wrap">
                                    <?php if ( has_post_thumbnail() ){ ?>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <figure><div class="cv-post-thumb"><?php the_post_thumbnail( 'thumbnail' ); ?></div></figure>
                                        </a>
                                    <?php } ?>
                                    <div class="cv-post-content">
                                        <h5 class="cv-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                        <div class="cv-post-meta"><?php wisdom_blog_posted_on(); ?></div>
                                    </div>
                                </div><!-- .cv-single-post-wrap -->
                    <?php
                            }
                        }
                    ?>
                </div><!-- .cv-posts-content-wrapper -->
            </div><!-- .cv-latest-posts-wrapper -->
    <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    wisdom_blog_widgets_updated_field_value()     defined in cv-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$wisdom_blog_widgets_name] = wisdom_blog_widgets_updated_field_value( $widget_field, $new_instance[$wisdom_blog_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    wisdom_blog_widgets_show_widget_field()       defined in cv-widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $wisdom_blog_widgets_field_value = !empty( $instance[$wisdom_blog_widgets_name] ) ? wp_kses_post( $instance[$wisdom_blog_widgets_name] ) : '';
            wisdom_blog_widgets_show_widget_field( $this, $widget_field, $wisdom_blog_widgets_field_value );
        }
    }
}