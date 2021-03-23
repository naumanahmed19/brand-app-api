<?php
// Adds widget: Brand Slider
class Brandslider_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'brandslider_widget',
			esc_html__( 'Brand Slider', 'brand-app' ),
			array( 'description' => esc_html__( 'A slider with images linked to  a product category or url', 'brand-app' ),'customize_selective_refresh' => true,  ) // Args
	
		);
		// Enqueue style if widget is active (appears in a sidebar) or if in Customizer preview.
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}
		}

		public function enqueue_scripts() {
			wp_enqueue_script( 'brand-main', plugin_dir_url( __FILE__ ) . 'assets/js/main.js', array('jquery'), '1.0.0', false );

		}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];

    	 // widget ID with prefix for use in ACF API functions
      	$widget_id = 'widget_' . $args['widget_id'];
     
        $slides = get_field( 'slides', $widget_id ) ? get_field( 'slides', $widget_id ) : '';
        
        echo '<div class="lightSlider" data-pager="false" data-item="1" data-item-lg="1" data-item-md="1"
        data-item-sm="1">';
        foreach ($slides as $key => $slide ) {
           echo '<div><img src="'.$slide['image'].'" /></div>';
        }
        echo '</div>';


		// Output generated fields
		
        echo $args['after_widget'];
        
	}



	public function form( $instance ) {
	}
	public function update( $new_instance, $old_instance ) {
	}
}

function register_brandslider_widget() {
	register_widget( 'Brandslider_Widget' );
}
add_action( 'widgets_init', 'register_brandslider_widget' );