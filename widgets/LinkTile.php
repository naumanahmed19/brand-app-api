<?php
// Adds widget: Brand Slider
class BrandLinkTile extends WP_Widget {

	function __construct() {
		parent::__construct(
			'widget_link_tile',
			esc_html__( 'Brand Link Tile', 'brand-app' ),
			array( 
				'description' => esc_html__( 'Display categories list in a carousel', 'brand-app' ),	
				'customize_selective_refresh' => true, 
			) // Args
		
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
					<?php echo esc_attr($title,'brand-app'); ?>
				</div>
			</div>	
   
		<?php
        echo $args['after_widget'];
	}



	public function form( $instance ) {
	
	}

	public function update( $new_instance, $old_instance ) {
	}
}

function register_BrandLinkTile() {
	register_widget( 'BrandLinkTile' );
}
add_action( 'widgets_init', 'register_BrandLinkTile' );