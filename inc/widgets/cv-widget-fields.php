<?php
/**
 * Define custom fields for widgets
 * 
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

function wisdom_blog_widgets_show_widget_field( $instance = '', $widget_field = '', $wisdom_blog_widget_field_value = '' ) {
    
    extract( $widget_field );

    switch ( $wisdom_blog_widgets_field_type ) {

        /**
         * text widget field
         */
        case 'text'
        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $wisdom_blog_widgets_name ) ); ?>"><?php echo esc_html( $wisdom_blog_widgets_title ); ?></label></span>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $wisdom_blog_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $wisdom_blog_widgets_name ) ); ?>" type="text" value="<?php echo esc_html( $wisdom_blog_widget_field_value ); ?>" />

                <?php if ( isset( $wisdom_blog_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $wisdom_blog_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * url widget field
         */
        case 'url' :
        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $wisdom_blog_widgets_name ) ); ?>"><?php echo esc_html( $wisdom_blog_widgets_title ); ?></label></span>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $wisdom_blog_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $wisdom_blog_widgets_name ) ); ?>" type="text" value="<?php echo esc_url( $wisdom_blog_widget_field_value ); ?>" />

                <?php if ( isset( $wisdom_blog_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $wisdom_blog_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * Select field
         */
        case 'select' :
            if ( empty( $wisdom_blog_widget_field_value ) ) {
                $wisdom_blog_widget_field_value = $wisdom_blog_widgets_default;
            }

        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $wisdom_blog_widgets_name ) ); ?>"><?php echo esc_html( $wisdom_blog_widgets_title ); ?></label></span> 
                <select name="<?php echo esc_attr( $instance->get_field_name( $wisdom_blog_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $wisdom_blog_widgets_name ) ); ?>" class="widefat">
                    <?php foreach ( $wisdom_blog_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
                        <option value="<?php echo esc_attr( $athm_option_name ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>" <?php selected( $athm_option_name, $mt_widget_field_value ); ?>><?php echo esc_html( $athm_option_title ); ?></option>
                    <?php } ?>
                </select>

                <?php if ( isset( $wisdom_blog_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $wisdom_blog_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * user dropdown widget field
         */
        case 'user_dropdown' :
            if ( empty( $wisdom_blog_widget_field_value ) ) {
                $wisdom_blog_widget_field_value = $wisdom_blog_widgets_default;
            }
            $select_field = 'name="'. esc_attr( $instance->get_field_name( $wisdom_blog_widgets_name ) ) .'" id="'. esc_attr( $instance->get_field_id( $wisdom_blog_widgets_name ) ) .'" class="widefat"';
        ?>
                <p>
                    <label for="<?php echo esc_attr( $instance->get_field_id( $wisdom_blog_widgets_name ) ); ?>"><?php echo esc_html( $wisdom_blog_widgets_title ); ?>:</label>
                    <?php
                        $dropdown_args = wp_parse_args( array(
                            'show_option_none'  => __( '- - Select User - -', 'wisdom-blog' ),
                            'selected'          => esc_attr( $wisdom_blog_widget_field_value ),
                        ) );

                        $dropdown_args['echo'] = false;

                        $dropdown = wp_dropdown_users( $dropdown_args );
                        $dropdown = str_replace( '<select', '<select ' . $select_field, $dropdown );
                        echo $dropdown;
                    ?>
                </p>
        <?php
            break;
        
        /**
         * checkbox widget field
         */
        case 'checkbox' :
            ?>
            <p>
                <input id="<?php echo esc_attr( $instance->get_field_id( $wisdom_blog_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $wisdom_blog_widgets_name ) ); ?>" type="checkbox" value="1" <?php checked( '1', $wisdom_blog_widget_field_value ); ?>/>
                <label for="<?php echo esc_attr( $instance->get_field_id( $wisdom_blog_widgets_name ) ); ?>"><?php echo esc_html( $wisdom_blog_widgets_title ); ?></label>

                <?php if ( isset( $wisdom_blog_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $wisdom_blog_widgets_description ); ?></em>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * category dropdown widget field
         */
        case 'category_dropdown' :
            if ( empty( $wisdom_blog_widget_field_value ) ) {
                $wisdom_blog_widget_field_value = $wisdom_blog_widgets_default;
            }
            $select_field = 'name="'. esc_attr( $instance->get_field_name( $wisdom_blog_widgets_name ) ) .'" id="'. esc_attr( $instance->get_field_id( $wisdom_blog_widgets_name ) ) .'" class="widefat"';
        ?>
                <p>
                    <label for="<?php echo esc_attr( $instance->get_field_id( $wisdom_blog_widgets_name ) ); ?>"><?php echo esc_html( $wisdom_blog_widgets_title ); ?>:</label>
                    <?php
                        $dropdown_args = wp_parse_args( array(
                            'taxonomy'          => 'category',
                            'show_option_none'  => __( '- - Select Category - -', 'wisdom-blog' ),
                            'selected'          => esc_attr( $wisdom_blog_widget_field_value ),
                            'show_option_all'   => '',
                            'orderby'           => 'id',
                            'order'             => 'ASC',
                            'show_count'        => 0,
                            'hide_empty'        => 1,
                            'child_of'          => 0,
                            'exclude'           => '',
                            'hierarchical'      => 1,
                            'depth'             => 0,
                            'tab_index'         => 0,
                            'hide_if_empty'     => false,
                            'option_none_value' => 0,
                            'value_field'       => 'slug',
                        ) );

                        $dropdown_args['echo'] = false;

                        $dropdown = wp_dropdown_categories( $dropdown_args );
                        $dropdown = str_replace( '<select', '<select ' . $select_field, $dropdown );
                        echo $dropdown;
                    ?>
                </p>
        <?php
            break;

        /**
         * number widget field
         */
        case 'number' :
            if ( empty( $wisdom_blog_widget_field_value ) ) {
                $wisdom_blog_widget_field_value = $wisdom_blog_widgets_default;
            }
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $wisdom_blog_widgets_name ) ); ?>"><?php echo esc_html( $wisdom_blog_widgets_title ); ?></label>
                <input name="<?php echo esc_attr( $instance->get_field_name( $wisdom_blog_widgets_name ) ); ?>" type="number" step="1" min="1" id="<?php echo esc_attr( $instance->get_field_id( $wisdom_blog_widgets_name ) ); ?>" value="<?php echo esc_html( $wisdom_blog_widget_field_value ); ?>" class="small-text" />

                <?php if ( isset( $wisdom_blog_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $wisdom_blog_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * multi checkboxes widget field
         */
        case 'multicheckboxes':
        ?>
            <p><span class="field-label"><label><?php echo esc_html( $wisdom_blog_widgets_title ); ?></label></span></p>

        <?php
            foreach ( $wisdom_blog_widgets_field_options as $checkbox_option_name => $checkbox_option_title ) {
                if ( isset( $wisdom_blog_widget_field_value[$checkbox_option_name] ) ) {
                    $wisdom_blog_widget_field_value[$checkbox_option_name] = 1;
                }else{
                    $wisdom_blog_widget_field_value[$checkbox_option_name] = 0;
                }
            ?>
                <p>
                    <input id="<?php echo esc_attr( $instance->get_field_id( $checkbox_option_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $wisdom_blog_widgets_name ).'['.$checkbox_option_name.']' ); ?>" type="checkbox" value="1" <?php checked( '1', $wisdom_blog_widget_field_value[$checkbox_option_name] ); ?>/>
                    <label for="<?php echo esc_attr( $instance->get_field_id( $checkbox_option_name ) ); ?>"><?php echo esc_html( $checkbox_option_title ); ?></label>
                </p>
            <?php
                }
                if ( isset( $wisdom_blog_widgets_description ) ) {
            ?>
                    <em><?php echo wp_kses_post( $wisdom_blog_widgets_description ); ?></em>
            <?php
                }
            break;

    }
}

function wisdom_blog_widgets_updated_field_value( $widget_field, $new_field_value ) {

    extract( $widget_field );
    
    if ( $wisdom_blog_widgets_field_type == 'number') {
        return absint( $new_field_value );
    } elseif ( $wisdom_blog_widgets_field_type == 'url' ) {
        return esc_url( $new_field_value );
    } elseif ( $wisdom_blog_widgets_field_type == 'multicheckboxes' ) {
        return wp_kses_post( $new_field_value );
    } else {
        return sanitize_text_field( $new_field_value );
    }
}