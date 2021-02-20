<?php
// Adds widget: Brand Slider
class Brand_ProductsCarousel_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'Brand_ProductsCarousel_widget',
			esc_html__( 'Products Carousel', 'brand-app' ),
			array( 'description' => esc_html__( 'Display proudcts carousel', 'brand-app' ), ) // Args
		);
	}

	private $widget_fields = array(
	);

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		?>

		<div class="px-5">
		
		<?php

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        // widget ID with prefix for use in ACF API functions
		  $widget_id = 'widget_' . $args['widget_id'];
		  
		
		  $ctrl = new BrandProductController();
		  $products = $ctrl->getProducts($widget_id);
		
		$title = get_field( 'title', $widget_id ) ? get_field( 'title', $widget_id ) : '';
		$items = intval(get_field('columns', $widget_id));
		?>
			<div class="py-5 text-xl font-semibold"><?php  echo esc_attr( $title, 'brand-app' );  ?></div>
		<?php 
		
        echo '<div class="lightSlider" data-pager="false" data-item="'.$items.'">';
		foreach ($products as $key => $product ) {?>
			<div>
				<img src="<?php echo $product['images'][0]['src'] ; ?>" />
				<div  class="py-2 text-xl">
				<div><?php echo $product['name'] ; ?></div>
				<div><?php echo $product['price'] ; ?></div>
				</div>
		

		 </div>
       <?php } ?>
	   
        </div>
		</div>



		<?php


		// Output generated fields
		
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

function register_Brand_ProductsCarousel_widget() {
	register_widget( 'Brand_ProductsCarousel_Widget' );
}
add_action( 'widgets_init', 'register_Brand_ProductsCarousel_widget' );