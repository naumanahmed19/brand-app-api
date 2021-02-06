<?php
// Adds widget: Brand Slider
class BrandLinkTile extends WP_Widget {

	function __construct() {
		parent::__construct(
			'widget_link_tile',
			esc_html__( 'Brand Link Tile', 'brand-app' ),
			array( 'description' => esc_html__( 'Display categories list in a carousel', 'brand-app' ), ) // Args
		);
	}

	private $widget_fields = array(
	);

	public function widget( $args, $instance ) {
		echo $args['before_widget'];


        // widget ID with prefix for use in ACF API functions
      	$widget = 'widget_' . $args['widget_id'];
	
			$icon =  get_field('leading_icon', 'widget_' .$widget);
		
			
			$widget_id = 'widget_' . $args['widget_id'];
			$post = get_field( 'page', $widget_id ) ? get_field( 'page', $widget_id ) : '';

			$title = $post->post_title;
		?>


			<div class=" max-w-md mx-auto  h-11 flex m-3 space-x-5">
			<i class="<?php echo $icon ?>"></i>

				<div class="text-gray-500 text-md">
					<?php echo $title ?>
				</div>
			</div>	
   
		<?php
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
	
		$this->field_generator( $instance );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
	
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				default:
					$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
		}
		return $instance;
	}
}

function register_BrandLinkTile() {
	register_widget( 'BrandLinkTile' );
}
add_action( 'widgets_init', 'register_BrandLinkTile' );