<?php
// Adds widget: Brand Slider
class Brandslider_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'brandslider_widget',
			esc_html__( 'Brand Slider', 'brand-app' ),
			array( 'description' => esc_html__( 'A slider with images linked to  a product category or url', 'brand-app' ), ) // Args
		);
	}

	private $widget_fields = array(
	);

	public function widget( $args, $instance ) {
		echo $args['before_widget'];



		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

              // widget ID with prefix for use in ACF API functions
      $widget_id = 'widget_' . $args['widget_id'];

	         // widget ID with prefix for use in ACF API functions
			 $widget_id = 'widget_' . $args['widget_id'];
			 $ff =[];
			  $filters = get_field('filter', $widget_id);
			 foreach($filters as $f){
				 $ff[] ='brand-section-'.$f;
			 }
	 
	 
			echo '<div class="filterDiv '. implode(" ", $ff). '">';
     
        $slides = get_field( 'slides', $widget_id ) ? get_field( 'slides', $widget_id ) : '';
        
        echo '<div class="lightSlider" data-pager="false" data-item="1" data-item-lg="1" data-item-md="1"
        data-item-sm="1">';
        foreach ($slides as $key => $slide ) {
           echo '<div><img src="'.$slide['image'].'" /></div>';
        }
        echo '</div>';


		// Output generated fields
		echo '</div>';
		
        echo $args['after_widget'];
        
        
	}

	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$default = '';
			if ( isset($widget_field['default']) ) {
				$default = $widget_field['default'];
			}
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'brand-app' );
			switch ( $widget_field['type'] ) {
				default:
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'brand-app' ).':</label> ';
					$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'brand-app' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'brand-app' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$this->field_generator( $instance );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				default:
					$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
		}
		return $instance;
	}
}

function register_brandslider_widget() {
	register_widget( 'Brandslider_Widget' );
}
add_action( 'widgets_init', 'register_brandslider_widget' );