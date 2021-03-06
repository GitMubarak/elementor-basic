<?php
/**
 * Plugin Name: HM Elementor Demo
 * Description: TBA
 * Plugin URI: tba
 * Version: 1.0.0
 * Author: Hossni Mubarak
 * Author URI: http://abc.net
 * Text Domain: hm-elementor-demo
 */
use \Elementor\Plugin as Plugin;

if ( ! defined( 'ABSPATH' ) ) exit;

final class HmElementorDemo
{
	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '7.0';

	private static $_instance = null;
	public static function instance() {

        if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

    }

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}
	
	public function init() {

		load_plugin_textdomain( 'hm-elementor-demo' );

        // Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
        }
        // Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
        }
        // Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
        }
        
        // Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

		// Add New Widgets Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_new_category' ] );

		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'hm_elementor_styles' ] );
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'hm_elementor_scripts' ] );
	}

	public function hm_elementor_styles() {

		wp_enqueue_style( 'hm-button', plugins_url( '/assets/css/hm-button.css', __FILE__ ) );
		wp_enqueue_style( 'hm-text', plugins_url( '/assets/css/hm-text.css', __FILE__ ) );

	}

	public function hm_elementor_scripts() {
		wp_enqueue_script( 'hm-button-js', plugins_url( '/assets/js/hm-button.js', __FILE__ ), ['jquery'], time(), true );
	}
	
	public function register_new_category($manager){
		$manager->add_category('hm-category',[
			'title' => __('Hossni Mubarak', 'hm-elementor-demo'),
			'icon'  => 'fa fa-video'
		]);
	}

    public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'hm-elementor-demo' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'hm-elementor-demo' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'hm-elementor-demo' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'hm-elementor-demo' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'hm-elementor-demo' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'hm-elementor-demo' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }
    
    public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'hm-elementor-demo' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'hm-elementor-demo' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'hm-elementor-demo' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }
    
    public function init_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/widgets/hm-text.php' );
		require_once( __DIR__ . '/widgets/hm-button.php' );
		require_once( __DIR__ . '/widgets/hm-faq.php' );
		require_once( __DIR__ . '/widgets/hm-google-map.php' );

		// Register widget
		Plugin::instance()->widgets_manager->register_widget_type( new \Hm_Text() );
		Plugin::instance()->widgets_manager->register_widget_type( new \Hm_Button() );
		Plugin::instance()->widgets_manager->register_widget_type( new \Hm_Faq() );
		Plugin::instance()->widgets_manager->register_widget_type( new \Hm_Google_Map() );

	}
    
	public function includes() {}

}

HmElementorDemo::instance();