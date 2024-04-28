<?php if ( ! defined( 'ABSPATH' ) ) {exit;} // Exit if accessed directly.

/**
 * Elementor extensions.
 * 
 * @since  4.2.0
 * @author XtraTheme
 */

class Xtra_Elementor {

	protected static $instance = null;

	protected function __construct() {

		// Add Categories.
		add_action( 'elementor/elements/categories_registered', [ $this, 'categories' ] );

		// Register controls.
		add_action( 'elementor/controls/controls_registered', [ $this, 'controls' ] );

		// Register widgets.
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'widgets' ], 99 );

		// Enqueue scripts for Elementor.
		add_action( 'elementor/frontend/after_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

	}

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Add elementor widgets categories.
	 * 
	 * @var $elements_manager = Elementor manager object.
	 */
	public function categories( $elements_manager ) {

		$elements_manager->add_category(
			'xtra',
			[
				'title' => esc_html__( 'XTRA', 'plugin-name' ),
				'icon' => 'fa fa-plug',
			]
		);

	}

	/**
	 * Register custom elementor controls.
	 * 
	 * @var $controls_registry = Elementor control manager.
	 */
	public function controls( $controls_registry ) {

		// Require all new controls.
		foreach( glob( Codevz_Plus::$dir . 'elementor/controls/*.php' ) as $i ) {

			require_once( $i );

			$name = str_replace( '.php', '', basename( $i ) );

			$class = 'Xtra_Elementor_Control_' . $name;

			\Elementor\Plugin::$instance->controls_manager->register_control( $name, new $class() );

		}

	}

	/**
	 * Register elementor widgets.
	 * 
	 * @var $elements_manager = Elementor manager object.
	 */
	public function widgets( $elements_manager ) {

		// Require all new widgets.
		foreach( glob( Codevz_Plus::$dir . 'elementor/widgets/*.php' ) as $i ) {

			require_once( $i );

			$name = str_replace( '.php', '', basename( $i ) );
			$class = '\Elementor\Xtra_Elementor_Widget_' . $name;

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class() );

		}

	}

	/**
	 * Enqueue scripts for elementor.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'xtra-elementor-frontend', Codevz_Plus::$url . 'elementor/assets/js/elementor.js', [], Codevz_Plus::$ver, false );

	}

}

// Run.
Xtra_Elementor::instance();

function xtra_elementor_classes( $classes ) {
	return Codevz_Plus::classes( [], $classes );
}

function xtra_elementor_tilt( $settings ) {
	return Codevz_Plus::tilt( $settings );
}