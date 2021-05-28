<?php
/**
 * File to sanitize customizer field
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

if ( ! function_exists( 'wisdom_blog_sanitize_checkbox' ) ) :

    /**
     * Sanitize checkbox
     */
    function wisdom_blog_sanitize_checkbox( $checked ) {
        return ( ( isset( $checked ) && true === $checked ) ? true : false );
    }

endif;

/*----------------------------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'wisdom_blog_sanitize_repeater' ) ) :
    /**
     * Sanitize repeater value
     *
     * @since 1.0.0
     */
    function wisdom_blog_sanitize_repeater( $input, $setting ){
        $input_decoded = json_decode( $input, true );
            
        if ( !empty( $input_decoded ) ) {
            foreach ( $input_decoded as $boxes => $box ){
                foreach ( $box as $key => $value ){
                    if ( $key == 'cv_url_field' ) {
                        $input_decoded[$boxes][$key] = esc_url_raw( $value );
                    } else {
                        $input_decoded[$boxes][$key] = wp_kses_post( $value );
                    }
                }
            }
            return json_encode( $input_decoded );
        }
        
        return $input;
    }
endif;

/*----------------------------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'wisdom_blog_sanitize_mulitple_checkbox' ) ) :
    /**
     * Sanitize multicheckboxes value
     *
     * @since 1.0.0
     */
    function wisdom_blog_sanitize_mulitple_checkbox( $values ) {

        $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

        return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
    }
endif;

/*----------------------------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'wisdom_blog_sanitize_select' ) ) :

    /**
     * Sanitize select.
     *
     * @since 1.0.0
     *
     * @param mixed                $input The value to sanitize.
     * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
     * @return mixed Sanitized value.
     */
    function wisdom_blog_sanitize_select( $input, $setting ) {
        $input = sanitize_key( $input );
        $choices = $setting->manager->get_control( $setting->id )->choices;
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }

endif;