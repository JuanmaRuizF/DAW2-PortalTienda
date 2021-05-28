<?php
/**
 * Define customizer custom classes
 *
 * @package CodeVibrant
 * @subpackage Wisdom Blog
 * @since 1.0.0
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

/*----------------------------------------------------------------------------------------------------------------------------------------*/
	/**
     * Radio toggle customize control.
     *
     * @since  1.0.0
     * @access public
     */
    class Wisdom_Blog_Toggle_Checkbox_Custom_Control extends WP_Customize_Control {

		/**
		 * The type of control being rendered
		 */
		public $type = 'toogle_checkbox';
		
		/**
		 * Render the control in the customizer
		 */
		public function render_content(){
		?>
			<div class="cv-toggle-checkbox-wrap">
				<input id="<?php echo esc_attr( $this->id ); ?>" class="cv-checkbox-toggle" type="checkbox" <?php $this->link(); checked( true, $this->value() ); ?> data-toggle="toggle" data-style="slow" >
				<label for="<?php echo esc_attr( $this->id ); ?>"><?php echo esc_html( $this->label ); ?></label>
				<span id="_customize-description-<?php echo esc_attr( $this->id ); ?>" class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			</span>
		<?php
		}
	}

/*----------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * Radio image customize control.
     *
     * @since  1.0.0
     * @access public
     */
    class Wisdom_Blog_Customize_Control_Radio_Image extends WP_Customize_Control {
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'radio-image';

        /**
         * Loads the jQuery UI Button script and custom scripts/styles.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_script( 'jquery-ui-button' );
        }

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();

            // We need to make sure we have the correct image URL.
            foreach ( $this->choices as $value => $args )
                $this->choices[ $value ]['url'] = esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) );

            $this->json['choices'] = $this->choices;
            $this->json['link']    = $this->get_link();
            $this->json['value']   = $this->value();
            $this->json['id']      = $this->id;
        }


        /**
         * Underscore JS template to handle the control's output.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */

        public function content_template() { ?>
            <# if ( data.label ) { #>
                <span class="customize-control-title">{{ data.label }}</span>
            <# } #>

            <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>

            <div class="buttonset">

                <# for ( key in data.choices ) { #>

                    <input type="radio" value="{{ key }}" name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}-{{ key }}" {{{ data.link }}} <# if ( key === data.value ) { #> checked="checked" <# } #> /> 

                    <label for="{{ data.id }}-{{ key }}">
                        <span class="screen-reader-text">{{ data.choices[ key ]['label'] }}</span>
                        <img src="{{ data.choices[ key ]['url'] }}" title="{{ data.choices[ key ]['label'] }}" alt="{{ data.choices[ key ]['label'] }}" />
                    </label>
                <# } #>

            </div><!-- .buttonset -->
        <?php }
    }

/*--------------------------------------------------------------------------------------------------------------*/
    /**
     * Customize for multiple check boxes
     */
    class Wisdom_Blog_Customize_Multiple_Checkboxes_Control extends WP_Customize_Control {
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'checkbox-multiple';
        /**
         * Displays the control content.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function render_content() {

            if ( empty( $this->choices ) ) {
                return;
            }            
    ?>
            <?php if ( !empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php endif; ?>

            <?php if ( !empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php endif; ?>

            <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

            <ul>
                <?php foreach ( $this->choices as $value => $label ) : ?>

                    <li>
                        <label>
                            <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
                            <?php echo esc_html( $label ); ?>
                        </label>
                    </li>

                <?php endforeach; ?>
            </ul>

            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
    <?php
        }
    }

/*----------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * Customize controls for repeater field
     *
     * @since 1.0.0
     */
    class Wisdom_Blog_Repeater_Controler extends WP_Customize_Control {
        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'cv-repeater';

        public $wisdom_blog_box_label = '';

        public $wisdom_blog_box_add_control = '';

        /**
         * The fields that each container row will contain.
         *
         * @access public
         * @var array
         */
        public $fields = array();

        /**
         * Repeater drag and drop controller
         *
         * @since  1.0.0
         */
        public function __construct( $manager, $id, $args = array(), $fields = array() ) {
            $this->fields = $fields;
            $this->wisdom_blog_box_label = $args['wisdom_blog_box_label'] ;
            $this->wisdom_blog_box_add_control = $args['wisdom_blog_box_add_control'];
            parent::__construct( $manager, $id, $args );
        }

        public function render_content() {

            $values = json_decode( $this->value() );
            $repeater_id = $this->id;
            $field_count = count( $values );
        ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

            <?php if ( $this->description ){ ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post( $this->description ); ?>
                </span>
            <?php } ?>

            <ul class="cv-repeater-field-control-wrap">
                <?php $this->wisdom_blog_get_fields(); ?>
            </ul>

            <input type="hidden" <?php $this->link(); ?> class="cv-repeater-collector" value="<?php echo esc_attr( $this->value() ); ?>" />
            <input type="hidden" name="<?php echo esc_attr( $repeater_id ).'_count'; ?>" class="field-count" value="<?php echo absint( $field_count ); ?>">
            <input type="hidden" name="field_limit" class="field-limit" value="6">
            <button type="button" class="button cv-repeater-add-control-field"><?php echo esc_html( $this->wisdom_blog_box_add_control ); ?></button>
    <?php
        }

        private function wisdom_blog_get_fields(){
            $fields = $this->fields;
            $values = json_decode( $this->value() );

            if ( is_array( $values ) ){
            	foreach( $values as $value ){
        ?>
	            <li class="cv-repeater-field-control">
	            <h3 class="cv-repeater-field-title"><?php echo esc_html( $this->wisdom_blog_box_label ); ?></h3>
	            
	            <div class="cv-repeater-fields">
	            <?php
	                foreach ( $fields as $key => $field ) {
	                $class = isset( $field['class'] ) ? $field['class'] : '';
	            ?>
	                <div class="cv-repeater-field cv-repeater-type-<?php echo esc_attr( $field['type'] ).' '.esc_attr( $class ); ?>">

	                <?php 
	                    $label = isset( $field['label'] ) ? $field['label'] : '';
	                    $description = isset( $field['description'] ) ? $field['description'] : '';
	                    if ( $field['type'] != 'checkbox' ) { 
	                ?>
	                        <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
	                        <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
	                <?php 
	                    }

	                    $new_value = isset( $value->$key ) ? $value->$key : '';
	                    $default = isset( $field['default'] ) ? $field['default'] : '';

	                    switch ( $field['type'] ) {
	                        /**
                             * Text field
                             */
                            case 'text':
	                            echo '<input data-default="'.esc_attr( $default ).'" data-name="'.esc_attr( $key ).'" type="text" value="'.esc_attr( $new_value ).'"/>';
	                            break;

	                        /**
                             * URL field
                             */
                            case 'url':
	                            echo '<input data-default="'.esc_attr( $default ).'" data-name="'.esc_attr( $key ).'" type="text" value="'.esc_url( $new_value ).'"/>';
	                            break;

	                        /**
                             * Social Icon field
                             */
                            case 'social_icon':
                                $wisdom_blog_font_awesome_social_icon_array = wisdom_blog_font_awesome_social_icon_array();
	                            echo '<div class="cv-repeater-selected-icon"><i class="'.esc_attr( $new_value ).'"></i><span><i class="fa fa-angle-down"></i></span></div><ul class="cv-repeater-icon-list cv-clearfix">';
	                            foreach ( $wisdom_blog_font_awesome_social_icon_array as $wisdom_blog_font_awesome_icon ) {
	                                $icon_class = $new_value == $wisdom_blog_font_awesome_icon ? 'icon-active' : '';
	                                echo '<li class='.esc_attr( $icon_class ).'><i class="'.esc_attr( $wisdom_blog_font_awesome_icon ).'"></i></li>';
	                            }
	                            echo '</ul><input data-default="'.esc_attr( $default ).'" type="hidden" value="'.esc_attr( $new_value ).'" data-name="'.esc_attr( $key ).'"/>';
	                            break;

	                        default:
	                            break;
	                    }
	                ?>
	                </div>
            <?php
                }
            ?>
	                <div class="cv-clearfix cv-repeater-footer">
	                    <div class="alignright">
	                    <a class="cv-repeater-field-remove" href="#remove"><?php esc_html_e( 'Delete', 'wisdom-blog' ) ?></a> |
	                    <a class="cv-repeater-field-close" href="#close"><?php esc_html_e( 'Close', 'wisdom-blog' ) ?></a>
	                    </div>
	                </div><!-- .cv-repeater-footer -->
	            </div><!-- .cv-repeater-fields-->
	            </li>
        <?php   
            	}
            }
        }
    }

/*----------------------------------------------------------------------------------------------------------------------------------------*/
    
    /**
     * Upsell customizer section.
     *
     * @since  1.0.6
     * @access public
     */
    class Wisdom_Blog_Customize_Section_Upsell extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'upsell';

        /**
         * Custom button text to output.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_text = '';

        /**
         * Custom pro button URL.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_url = '';

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function json() {
            $json = parent::json();

            $json['pro_text'] = $this->pro_text;
            $json['pro_url']  = esc_url( $this->pro_url );

            return $json;
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        protected function render_template() { ?>

            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
                <h3 class="accordion-section-title">
                    {{ data.title }}

                    <# if ( data.pro_text && data.pro_url ) { #>
                        <a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
                </h3>
            </li>
        <?php }
    }
}