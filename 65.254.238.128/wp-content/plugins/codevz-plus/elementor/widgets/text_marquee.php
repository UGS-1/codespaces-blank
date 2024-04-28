<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_text_marquee extends Widget_Base {

    protected $id = 'cz_text_marquee';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Text Marquee', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'fa fa-font';
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
            'section_content',
            [
                'label' => 'Text Marquee Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'marquee',
            [
                'label' => esc_html__( "Text", 'custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'I am marquee text, you can edit me and insert your text ...', 'custom-widgets' ),
                'placeholder' => esc_html__( 'I am marquee text, you can edit me and insert your text ...', 'custom-widgets' ),
            ]
        );

        
		$this->add_control(
			'duration',
			[
				'label' => __( 'Duration', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 8,
			]
		);

        $this->add_control(
			'direction',
			[
				'label' => __( 'Direction', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => esc_html__( 'Left', 'custom-widgets' ),
					'right' => esc_html__( 'Right', 'custom-widgets' ),
				],
			]
		);

        $this->add_control(
			'duplicate',
			[
				'label' => esc_html__( 'Duplicate', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'false'  => esc_html__( 'No', 'custom-widgets' ),
					'true' => esc_html__( 'Yes', 'custom-widgets' ),
				],
			]
		);

        $this->add_control(
			'stop_on_hover',
			[
				'label' => esc_html__( 'Stop on hover?', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'custom-widgets' ),
				'label_off' => esc_html__( 'No', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_responsive_control(
			'gap',
			[
				'label' => esc_html__( 'Gap', 'custom-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
                    'size' => 100,
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 300,
                        'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xtra-text_marquee' => 'width: {{SIZE}}{{UNIT}};',
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
			'sk_marquee',
			[
				'label' => esc_html__( 'Styling', 'custom-widgets' ),
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
		$classes[] = 'cz_text_marquee';
		$classes[] = $settings['stop_on_hover'] ? 'cz_text_marquee_soh' : '';

		// Data
		$data = ' data-duration="' . $settings['duration'] . '000"';
		$data .= ' data-direction="' . $settings['direction'] . '"';
		$data .= ' data-duplicated="' . $settings['duplicate'] . '"';
		//$data .= ' data-gap="' . $settings['gap'] . '"';  

        ?>
        <div  <?php echo Codevz_Plus::classes( [], $classes );  ?> <?php echo $data; ?> ><?php echo $settings['marquee']; ?></div>
        <div aria-hidden="true"></div>
        <?php

    }

    public function content_template() {
        ?>
        <#
        view.addRenderAttribute( 'marquee', 'class', 'xtra-text-marquee' );
		view.addInlineEditingAttributes( 'marquee', 'none' );
        
        
        var classes = 'cz_text_marquee', 
				classes = settings.stop_on_hover ? classes + ' ' + settings.stop_on_hover : classes;

        var data = ' data-duration="' + settings.duration + '000"';
		var data = ' data-direction="' + settings.direction + '"';
		var data = ' data-duplicated="' + settings.duplicate + '"';

        #>
        <div  class="{{{classes}}}" {{{data}}} >{{{settings.marquee}}}</div>
        <div aria-hidden="true"></div>
        <?php
    }

}