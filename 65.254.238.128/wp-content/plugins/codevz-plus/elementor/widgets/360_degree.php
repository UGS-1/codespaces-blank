<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_360_degree extends Widget_Base { 

	protected $id = 'cz_360_degree';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( '360 Degree', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'eicon-image';
    }

    public function get_categories() {
        return [ 'xtra' ];
    }
    public function get_style_depends() {
        return [ $this->id ];
    }
    public function get_script_depends() {
		return [ $this->id ];
    }
    public function _register_controls() {
        $this->start_controls_section(
			'360_degree',
			[
				'label' => esc_html__( '360 Degree Settings', 'custom-widgets' ),
			]
		);

        $this->add_control(
			'placeholder_image',
			[
				'label' => esc_html__( 'Placeholder (loading image)', 'custom-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'stripe_image',
			[
				'label' => esc_html__( 'Stripe Image', 'custom-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'count',
			[
				'label' => esc_html__( 'Frames Count', 'custom-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'' => [
						'min' => 1,
						'max' => 40,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .count' => 'count: {{UNIT}};',
				],
			]
		);

        $this->add_control(
            'action',
            [
                'label' => esc_html__( 'Rotate by', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'drag',
                'options' => [
                    'drag' => esc_html__( 'Mouse Dragging', 'custom-widgets' ),
                    'hover' => esc_html__( 'Mouse Hover', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
			'handle',
			[
				'label' => esc_html__( 'Show Handle?', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'custom-widgets' ),
				'label_off' => esc_html__( 'Hide', 'custom-widgets' ),
				'return_value' => 'no',
				'default' => 'no',
			]
		);

        $this->add_control(
			'sk_handle',
			[
				'label' => __( 'Handle', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'handle' => 'label_on'
                ]
			]
		);

        $this->add_control(
			'sk_bar',
			[
				'label' => __( 'Bar', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'handle' => 'label_on'
                ]
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Style', 'custom-widgets' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'container',
			[
				'label' => __( 'Container', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

    }
    public function render() {
		$settings = $this->get_settings_for_display();
		// Image
		$imgsrc = $settings['stripe_image']['url'];
		$plc_imgsrc = $settings['placeholder_image']['url'];
		
		// Count
		$count = $settings['count'] ? $settings['count'] : '16';

		// Classes
		$classes = array();
		$classes[] = 'cz_product-viewer-wrapper';
		?>
		<div data-frame= <?php echo $count ?>  data-friction="0.33" data-action="<?php echo $settings['action']; ?>  "  <?php echo Codevz_Plus::classes( [], $classes );  ?> >
		<div>
		<figure class="product-viewer">
			<img src="<?php echo $plc_imgsrc?>" alt="Loading">
			<div class="product-sprite" data-image="<?php echo $imgsrc; ?>" style="width:' . ( $count * 100 ) . '%;background-image:url(' . $imgsrc . ')"></div>
		</figure>

		<?php if ( $atts['handle'] == true ) {	?>
			<div class="cz_product-viewer-handle"><span class="fill"></span><span class="handle"><i class="fa fa-arrows-h"></i></span></div>
		 <?php } ?>
		</div></div>
		<?php
    }

    public function _content_template() {
        
    }
}