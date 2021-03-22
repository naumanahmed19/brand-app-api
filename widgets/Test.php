<?php

/**
 * Widget API: WP_Widget_Recent_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Brand_ProductsCarousel_Widget extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'Brand_ProductsCarousel_widget',
			'description'                 => __(  'Display proudcts carousel','brand-app'),
			'customize_selective_refresh' => true,
            
		);
		parent::__construct( 'Brand_ProductsCarousel_widget', __( 'Brand Products Carousel' ), $widget_ops );

        // Enqueue style if widget is active (appears in a sidebar) or if in Customizer preview.
        if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        }
    }


    public function enqueue_scripts() {
        wp_enqueue_script( 'brand-main', plugin_dir_url( __FILE__ ) . 'assets/js/main.js', array('jquery'), '1.0.0', false );
	
    }
  
	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        
        $widget_id = 'widget_' . $args['widget_id'];
		$ctrl = new BrandProductController();
		$products = $ctrl->getProducts($widget_id);
		
		//$title = get_field( 'title', $widget_id ) ? get_field( 'title', $widget_id ) : '';
		$items = intval(get_field('columns', $widget_id));
		?>
		<?php echo $args['before_widget']; ?>

        
		<div class="px-5">
			<div class="py-5 text-xl font-semibold">
			<?php
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
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
		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
		<?php
	}
}

function register_widget_test() {
	register_widget( 'Brand_ProductsCarousel_Widget' );
}
add_action( 'widgets_init', 'register_widget_test' );