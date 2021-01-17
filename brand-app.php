<?php
/**
 * Plugin Name: Brand App API
 * Description: A app to extend woo API
 * Plugin URI:  https://xvelopers.com/
 * Version:     1.0.1
 * Author:      Nauman
 * Author URI:  https://xvelopers.com/
 * Text Domain: rekord
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class Brand_App_API {

	/**
	 * Plugin Version
	 *
	 * @since 1.2.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'rekord' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {

		if( ! class_exists( 'XV_Updater' ) ){
			include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
			$updater = new XV_Updater( __FILE__ );
			$updater->set_username( 'naumanahmed19' );
			$updater->set_repository( 'brand-app' );
			/*
				$updater->authorize( 'abcdefghijk1234567890' ); // Your auth code goes here for private repos
			*/
			$updater->initialize();
	
		}

		add_action('wp_enqueue_scripts', 'brand_enqueue_script');
		
		function brand_enqueue_script()

		{   wp_enqueue_style( 'onsenui', 'https://unpkg.com/onsenui/css/onsenui.css' );
			wp_enqueue_style( 'onsen-css-components', 'https://unpkg.com/onsenui/css/onsen-css-components.min.css' );
			
			wp_enqueue_style( 'tailwind', plugin_dir_url( __FILE__ )  . '/assets/css/tailwind.min.css' );
			wp_enqueue_style( 'slick', plugin_dir_url( __FILE__ )  . '/assets/css/slick.css' );
			wp_enqueue_style( 'brand-css', plugin_dir_url( __FILE__ )  . '/assets/css/main.css' );

			wp_enqueue_script( 'onsenui', 'https://unpkg.com/onsenui/js/onsenui.min.js', array('jquery') );
			wp_enqueue_script( 'onsen-css-components', 'https://unpkg.com/jquery/dist/jquery.min.js', array('jquery') );
			

			wp_enqueue_script( 'slick', plugin_dir_url( __FILE__ ) . 'assets/js/slick.min.js', array('jquery'), '1.4.0', false );
			wp_enqueue_script( 'brand-main', plugin_dir_url( __FILE__ ) . 'assets/js/main.js', array('jquery'), '1.0.0', false );
		}


		require_once( __DIR__ . '/api/api.php' );
		// require_once( __DIR__ . '/blocks/blocks.php' );
		require_once( __DIR__ . '/widgets/Slider.php' );
		require_once( __DIR__ . '/widgets/CategoriesCarousel.php' );
		require_once( __DIR__ . '/widgets/ProductsCarousel.php' );
		require_once( __DIR__ . '/widgets/BannerWithCategories.php' );





		/**
		 * Add a sidebar.
		 */
		function brand_sidebars_init() {
			register_sidebar( array(
				'name'          => __( 'Brand Home Screen', 'textdomain' ),
				'id'            => 'brand-home-screen',
				'description'   => __( 'Widgets in this area will be shown on app home screen.', 'textdomain' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widgettitle">',
				'after_title'   => '</h4>',
			) );
			register_sidebar( array(
				'name'          => __( 'Brand Search Screen', 'textdomain' ),
				'id'            => 'brand-search-screen',
				'description'   => __( 'Widgets in this area will be shown on app search screen.', 'textdomain' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widgettitle">',
				'after_title'   => '</h4>',
			) );
		}
		add_action( 'widgets_init', 'brand_sidebars_init' );




		add_action('customize_register','my_customize_register');
function my_customize_register( $wp_customize ) {
$wp_customize->add_panel( 'menus', array(
  'title' => __( 'Menus' ),
  'description' => $description, // Include html tags such as <p>.
  'priority' => 160, // Mixed with top-level-section hierarchy.
) );
$wp_customize->add_section( $section_id , array(
  'title' => $menu->name,
  'panel' => 'menus',
) );
}


		
	}


}
new Brand_App_API();