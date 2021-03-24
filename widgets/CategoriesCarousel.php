<?php
// Adds widget: Brand Slider
class Brand_CategoriesCarousel_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'Brand_CategoriesCarousel_widget',
			esc_html__( 'Brand Category Carousel', 'brand-app' ),
			array( 'description' => esc_html__( 'Display categories list in a carousel', 'brand-app' ),'customize_selective_refresh' => true,  ) // Args

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
	?>

		<div class="px-5">
			<?php
				$widget_id = 'widget_' . $args['widget_id'];
				$title = get_field( 'title', $widget_id ) ? get_field( 'title', $widget_id ) : '';
				
				// widget ID with prefix for use in ACF API functions
				$widget_id = 'widget_' . $args['widget_id'];
				$categories = get_field( 'categories', $widget_id ) ? get_field( 'categories', $widget_id ) : '';
				$categories = get_field( 'categories', $widget_id ) ? get_field( 'categories', $widget_id ) : '';

				$size = intval(get_field('img_size', $wId)) ? intval(get_field('img_size', $wId)) : 80;
				
				
				?>
				<style>
					.item-img{
						border-radius: <?php echo intval(get_field('img_radius', $wId)); ?>px;
						width: <?php echo $size ?>px;
						height:<?php echo $size ?>px;
					}

				</style>
			
					<div class="py-5 text-xl font-semibold"><?php  echo esc_attr( $title, 'brand-app' );  ?></div>
					<div class="lightSlider" data-pager="false" data-item="4">
					<?php
					foreach ($categories as $key => $cat ) { 
						$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 
						$cat_thumb_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
						$image = wp_get_attachment_url( $cat_thumb_id,'thumbnail' ); 
				?>
				<div class="text-center">
					<div><img class="rounded-lg h-w-90 item-img" src="<?php echo $image ?>"/></div>
					<div class="py-2 text-xl"><?php echo esc_attr($cat->name, 'brand-app' );  ?></div>
				</div>

				<?php } ?>
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

function register_Brand_CategoriesCarousel_widget() {
	register_widget( 'Brand_CategoriesCarousel_Widget' );
}
add_action( 'widgets_init', 'register_Brand_CategoriesCarousel_widget' );