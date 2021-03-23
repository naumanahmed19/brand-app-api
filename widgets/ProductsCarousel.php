<?php
// Adds widget: Brand Slider
class Brand_ProductsCarousel_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'Brand_ProductsCarousel_widget',
			esc_html__( 'Brand Products Carousel', 'brand-app' ),
			array( 'description' => esc_html__( 'Display proudcts carousel', 'brand-app' ), 'customize_selective_refresh' => true, ) // Args
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
		$ctrl = new BrandProductController();
		$products = $ctrl->getProducts($widget_id);
		
		$title = get_field( 'title', $widget_id ) ? get_field( 'title', $widget_id ) : '';
		$items = intval(get_field('columns', $widget_id));
	?>
		<div class="px-5">
			<div class="py-5 text-xl font-semibold">
				<?php  echo esc_attr( $title, 'brand-app' );  ?>
			</div>
			<div class="lightSlider" data-pager="false" data-item="<?php echo $items; ?>">
				<?php 
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

	


	public function form( $instance ) {
	}

	public function update( $new_instance, $old_instance ) {
	}
}

function register_Brand_ProductsCarousel_widget() {
	register_widget( 'Brand_ProductsCarousel_Widget' );
}
add_action( 'widgets_init', 'register_Brand_ProductsCarousel_widget' );