<?php
// Adds widget: Brand categorylist
class Brandcategorylist_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'brandcategorylist_widget',
			esc_html__( 'Brand categorylist', 'brand-app' ),
			array( 'description' => esc_html__( 'A categorylist with images linked to  a product category or url', 'brand-app' ), ) // Args
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
	  


        $items = get_field( 'category_list', $widget_id ) ? get_field( 'category_list', $widget_id ) : '';

		$allSlides = [];
		
        foreach ($items as $key => $item ) {?>
			<ons-list>
			<ons-list-item expandable>
			<?php echo $item['title'];?>
			<?php
				$ctrl = new BrandHomeController(); 
			$categoires  = $ctrl->getCategories($item['categories'])
			foreach($categoires as $category){ ?>
				<div class="expandable-content"><?php $category->name; ;?></div>
		
			<?php } ?>
			</ons-list-item>
			</ons-list>
	
		<?php
		}
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

function register_brandcategorylist_widget() {
	register_widget( 'Brandcategorylist_Widget' );
}
add_action( 'widgets_init', 'register_brandcategorylist_widget' );