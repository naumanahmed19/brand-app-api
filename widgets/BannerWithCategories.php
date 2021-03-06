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


	
	




        // widget ID with prefix for use in ACF API functions
      	$widget_id = 'widget_' . $args['widget_id'];
	// 	$ff =[];
	// 	 $filters = get_field('filter', $widget_id);
	// 	foreach($filters as $f){
	// 		$ff[] ='brand-section-'.$f;
	// 	}


	//    echo '<div class="filterDiv '. implode(" ", $ff). '">';

		$categories = get_field( 'categories', $widget_id ) ? get_field( 'categories', $widget_id ) : '';
		$title = get_field( 'title', $widget_id ) ? get_field( 'title', $widget_id ) : '';
		$image = get_field( 'image', $widget_id ) ? get_field( 'image', $widget_id ) : '';
		?>
	
       
         <div>
            <div class="tab w-full overflow-hidden">
               <input class="absolute opacity-0 hidden " id="tab-<?php echo $widget_id ;?>" type="checkbox" name="tabs">
               <label class="block p-5 text-center cursor-pointer" for="tab-<?php echo $widget_id ;?>">
			  	<img class="rounded-md" src="<?php echo $image; ?>" alt="" />
			  	<div class="text-2xl p-3"> <?php echo esc_attr($title,'brand-app'); ?></div>
			   </label>
               <div class="tab-content overflow-hidden  leading-normal">
			   <?php  foreach ($categories as $key => $cat ) { ?>
                  <p class="text-2xl p-3"><?php echo $cat->name; ?></p>
              
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

		// echo '</div>';
		
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