<?php
// Adds widget: Brand Slider
class Brand_BannerWithCategories_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'Brand_BannerWithCategories_widget',
			esc_html__( 'Brand Banner Categoires', 'brand-app' ),
			array( 'description' => esc_html__( 'Display categories list in a carousel', 'brand-app' ),
			'customize_selective_refresh' => true,  ) // Args
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
      	$widget_id = 'widget_' . $args['widget_id'];


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
	

		
        echo $args['after_widget'];
        
        
	}


	public function form( $instance ) {}

	public function update( $new_instance, $old_instance ) {

	}
}

function register_Brand_BannerWithCategories_widget() {
	register_widget( 'Brand_BannerWithCategories_Widget' );
}
add_action( 'widgets_init', 'register_Brand_BannerWithCategories_widget' );