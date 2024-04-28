<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_free_line extends Widget_Base {

    protected $id = 'cz_free_line';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Free Line', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'eicon-divider';
    }

    public function get_categories() {
        return [ 'xtra' ];
    }
    public function get_style_depends() {
        return [ $this->id ];
    }

    public function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => 'Freeline Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'position',
			[
				'label' => esc_html__( 'Position', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'tal',
				'options' => [
					'tal' => esc_html__( 'Left', 'custom-widgets' ),
					'tac' => esc_html__( 'Center', 'custom-widgets' ),
                    'tar' => esc_html__( 'Right', 'custom-widgets' ),
                    'tal tac_in_mobile' => esc_html__( 'Left (Center in Small Devices)', 'custom-widgets' ),
                    'tar tac_in_mobile' => esc_html__( 'Right (Center in Small Devices)', 'custom-widgets' ),
				],
			]
		);

        $this->add_control(
			'circles',
			[
				'label' => esc_html__( 'Circles Type', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Select', 'custom-widgets' ),
					'cz_line_before_circle' => esc_html__( 'Before', 'custom-widgets' ),
                    'cz_line_after_circle' => esc_html__( 'After', 'custom-widgets' ),
                    'cz_line_before_circle cz_line_after_circle' => esc_html__( 'Both Sides', 'custom-widgets' ),
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_parallax',
            [
                'label' => esc_html__( 'PARALLAX', 'custom-widgets' )
            ]
        );

        $this->add_control(
            'parallax',
            [
                'label' => esc_html__( 'Parallax', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'select',
                'options' => [
                    'select' => esc_html__( 'Select', 'custom-widgets' ),
                    'vertical' => esc_html__( 'Vertical', 'custom-widgets' ),
                    'vertical + mouse parallax' => esc_html__( 'Vertical + Mouse Parallax', 'custom-widgets' ),
                    'horizontal' => esc_html__( 'Horizontal', 'custom-widgets' ),
                    'horizontal + mouse parallax' => esc_html__( 'Horizontal + Mouse Paralla', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
            'parallax_speed',
            [
                'label' => esc_html__( 'Parallax Speed', 'custom-widgets' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
					'{{WRAPPER}} .xtra-elements-gt' => 'speed: {{SIZE}}{{UNIT}};',
				],
                'separator' => 'before',
			]
        );
        
        $this->add_control(
			'parallax_stop',
			[
				'label' => esc_html__( 'Stop when done', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'custom-widgets' ),
				'label_off' => esc_html__( 'Hide', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        
        $this->add_control(
            'mouse_speed',
            [
                'label' => esc_html__( 'Mouse Speed', 'custom-widgets' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'ms' => [
                        'min' => -30,
                        'max' => 30,
                    ],
                ],
                'selectors' => [
					'{{WRAPPER}} .xtra-elements-gt' => 'speed: {{SIZE}}{{UNIT}};',
				],
                'separator' => 'before',
			]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'custom-widgets' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'sk_line',
			[
				'label' => esc_html__( 'Line Styling', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_circles',
			[
				'label' => esc_html__( 'Circle Styling', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_brfx',
			[
				'label' => esc_html__( 'Block Reveal', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);
        $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings_for_display();
        
        // Classes
		$classes = array();
		$classes[] = 'cz_line';
		$classes[] = $settings['circles'];
		$classes[] = $settings['position'];
        //$delay = $settings['anim_delay'] ? ' style="animation-delay:' . $settings['anim_delay'] . ';"' : '';
        $animation = '';
        ?>
        <div' <?php echo $animation; ?> >
        <div <?php echo xtra_elementor_classes( $classes ); ?>></div>
        </div>
        <div class="clr"></div>
        <?php
    }

    public function _content_template() {
        ?>
        <#
        var classes = 'cz_line', 
                classes = settings.road ? classes + ' ' + settings.road : classes;
                classes = settings.circles ? classes + ' ' + settings.circles : classes;
                classes = settings.position ? classes + ' ' + settings.position : classes;
        var animation = ''; 
        #>
        <div {{{animation}}} >
        <div class="{{{classes}}}"></div>
        </div>
        <div class="clr"></div>
        <?php
    }
}