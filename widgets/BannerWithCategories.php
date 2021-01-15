<?php
// Adds widget: Brand Slider
class Brand_BannerWithCategories_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'Brand_BannerWithCategories_widget',
			esc_html__( 'Brand Banner Categoires', 'brand-app' ),
			array( 'description' => esc_html__( 'Display categories list in a carousel', 'brand-app' ), ) // Args
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
		$categories = get_field( 'categories', $widget_id ) ? get_field( 'categories', $widget_id ) : '';
		$title = get_field( 'title', $widget_id ) ? get_field( 'title', $widget_id ) : '';
		$image = get_field( 'image', $widget_id ) ? get_field( 'image', $widget_id ) : '';
		?>
	      <div>
         <p>Open <strong>multiple</strong></p>
         <div class="shadow-md">
            <div class="tab w-full overflow-hidden border-t">
               <input class="absolute opacity-0 " id="tab-multi-one" type="checkbox" name="tabs">
               <label class="block p-5 leading-normal cursor-pointer" for="tab-multi-one">
			  	<img src="<?php echo $image; ?>" alt="" />
			   <?php echo $title; ?>
			   </label>
               <div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-indigo-500 leading-normal">
			   <?php  foreach ($categories as $key => $cat ) { ?>
                  <p class="p-5"><?php echo $cat->name; ?></p>
               </div>
			   <?php } ?> 
            </div>
         
         </div>
      </div>
		<?php
	
        // echo '<div class="lightSlider" data-pager="false" data-item="4">';
        // foreach ($categories as $key => $cat ) {
		// 	$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 
		// 	$cat_thumb_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		// 	$image = wp_get_attachment_url( $cat_thumb_id ); 
		// 	echo '<div><img src="'.$image.'" /></div>';
        // }
        // echo '</div>';


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

function register_Brand_BannerWithCategories_widget() {
	register_widget( 'Brand_BannerWithCategories_Widget' );
}
add_action( 'widgets_init', 'register_Brand_BannerWithCategories_widget' );