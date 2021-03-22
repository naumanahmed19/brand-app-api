<?php
// Adds widget: Brand categorylist
class Brand_CategoryList_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'brandcategorylist_widget',
			esc_html__( 'Brand Category List', 'brand-app' ),
			array( 'description' => esc_html__( 'A categorylist with images linked to  a product category or url', 'brand-app' ), 'customize_selective_refresh' => true, ) // Args
		
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
		


       // widget ID with prefix for use in ACF API functions
	  $widget_id = 'widget_' . $args['widget_id'];
	  

        $items = get_field( 'category_list', $widget_id ) ? get_field( 'category_list', $widget_id ) : '';

		$allSlides = [];
		
        foreach ($items as $key => $item ) {?>
			<ons-list>
	
			<ons-list-item expandable>
				<div class="py-1 px-5"><?php echo esc_attr($item['title'], 'brand-app'); ?></div>
				
			<div class="expandable-content">
			<?php foreach($item['categories'] as $key => $category){ ?>
			<div class="p-4"><?php echo $category->name ;?></div>
		
			<?php } ?>
			</div>

			</ons-list-item>
			</ons-list>
	
		<?php
		}
        echo $args['after_widget'];
        
        
	}


	public function form( $instance ) {
	}

	public function update( $new_instance, $old_instance ) {
	}
}

function register_brandcategorylist_widget() {
	register_widget( 'Brand_CategoryList_Widget' );
}
add_action( 'widgets_init', 'register_brandcategorylist_widget' );