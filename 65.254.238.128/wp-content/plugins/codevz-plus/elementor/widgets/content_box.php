<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_content_box extends Widget_Base { 

	protected $id = 'cz_content_box';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Content Box', 'custom-widgets' );
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
			'section_content',
			[
				'label' => 'Content Box Settings',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'type',
			[
				'label' => esc_html__( 'Box type', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1'  => esc_html__( 'Default', 'custom-widgets' ),
					'2' => esc_html__( 'Split box with image', 'custom-widgets'),
				],
			]
		);

        $this->add_control(
			'link',
			[
				'label' => __( 'Clickable box?', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'custom-widgets' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

        $this->add_control(
			'split_box_image',
			[
				'label' => __( 'Image', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'type' => '2',
				],
			]
		);

        $this->add_control(
			'split_box_position',
			[
				'label' => esc_html__( 'Image position', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cz_split_box_right',
				'options' => [
					'cz_split_box_right'  => esc_html__( 'Right', 'custom-widgets' ),
					'cz_split_box_left'  => esc_html__( 'Left', 'custom-widgets' ),
                    'cz_split_box_top'  => esc_html__( 'Top', 'custom-widgets' ),
                    'cz_split_box_bottom'  => esc_html__( 'Buttom', 'custom-widgets' ),
                    'cz_split_box_right cz_split_box_q'  => esc_html__( 'Right Quarter', 'custom-widgets' ),
                    'cz_split_box_left cz_split_box_q'  => esc_html__( 'Left Quarter', 'custom-widgets' ),
				],
                'condition' => [
                    'type' => '2',
                ]
			]
		);
        
        $this->add_control(
			'split_box_hide_arrow',
			[
				'label' => esc_html__( 'Hide box arrow?', 'codevz' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'custom-widgets' ),
				'label_off' => __( 'No', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition' => [
                    'type' => '2',
                ],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_hover_effect',
			[
				'label' => esc_html__( 'Hover Effect', 'codevz' )
			]
		);

        $this->add_control(
			'fx',
			[
				'label' => esc_html__( 'Default', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => Codevz_Plus::fx(),
			]
		);
        
        $this->add_control(
			'fx_hover',
			[
				'label' => esc_html__( 'Hover', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => Codevz_Plus::fx( '_hover' ),
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_flip',
			[
				'label' => esc_html__( 'Flip', 'codevz' ),
                'condition' => [
                    'type' => '1',
                ]
			]
		);

        $this->add_control(
			'back_box',
			[
				'label' => esc_html__( 'Back box?', 'codevz' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'custom-widgets' ),
				'label_off' => __( 'No', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition' => [
                    'type' => '1',
                ],
			]
		);
        
        $this->add_control(
            'back_title',
            [
                'label' => esc_html__( "Title", 'custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'type' => '1',
                ]
            ]
        );

        $this->add_control(
			'back_content',
			[
				'label' => esc_html__( 'Content', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
                'condition' => [
                    'type' => '1',
                ],
			]
		);

        $this->add_control(
            'back_btn_title',
            [
                'label' => esc_html__( "Button Title", 'custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'type' => '1',
                ]
            ]
        );

        $this->add_control(
			'back_btn_link',
			[
				'label' => __( 'Button Link', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'custom-widgets' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
                'condition' => [
                    'type' => '1',
                ]
			]
		);

        $this->add_control(
			'back_content_position',
			[
				'label' => esc_html__( 'Content position', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cz_box_back_pos_mc',
				'options' => [
					'cz_box_back_pos_tl'  => esc_html__( 'Top Left', 'custom-widgets' ),
                    'cz_box_back_pos_tc'  => esc_html__( 'Top Center', 'custom-widgets' ),
                    'cz_box_back_pos_tr'  => esc_html__( 'Top Right', 'custom-widgets' ),
                    'cz_box_back_pos_ml'  => esc_html__( 'Middle Left', 'custom-widgets' ),
                    'cz_box_back_pos_mc'  => esc_html__( 'Middle Center', 'custom-widgets' ),
                    'cz_box_back_pos_mr'  => esc_html__( 'Middle Right', 'custom-widgets' ),
                    'cz_box_back_pos_bl'  => esc_html__( 'Buttom Left', 'custom-widgets' ),
                    'cz_box_back_pos_bc'  => esc_html__( 'Buttom Center', 'custom-widgets' ),
                    'cz_box_back_pos_br'  => esc_html__( 'Buttom Right', 'custom-widgets' ),
				],
                'condition' => [
                    'type' => '1',
                ]
			]
		);

        $this->add_control(
			'fx_backed',
			[
				'label' => esc_html__( 'Hover effect', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'fx_flip_h'  => esc_html__( 'Flip Horizontal', 'custom-widgets' ),
                    'fx_flip_v'  => esc_html__( 'Flip Vertical', 'custom-widgets' ),
                    'fx_backed_fade_out_in'  => esc_html__( 'Fade Out/In', 'custom-widgets' ),
                    'fx_backed_fade_to_top'  => esc_html__( 'Fade To Top', 'custom-widgets' ),
                    'fx_backed_fade_to_bottom'  => esc_html__( 'Fade To Bottom', 'custom-widgets' ),
                    'fx_backed_fade_to_left'  => esc_html__( 'Fade To Left', 'custom-widgets' ),
                    'fx_backed_fade_to_right'  => esc_html__( 'Fade To Right', 'custom-widgets' ),
                    'fx_backed_zoom_in'  => esc_html__( 'Zoom In', 'custom-widgets' ),
                    'fx_backed_zoom_out'  => esc_html__( 'Zoom Out', 'custom-widgets' ),
                    'fx_backed_bend_in'  => esc_html__( 'Bend In', 'custom-widgets' ),
                    'fx_backed_blurred'  => esc_html__( 'Blurred', 'custom-widgets' ),
				],
                'condition' => [
                    'type' => '1',
                ]
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
				'label_on' => __( 'Show', 'custom-widgets' ),
				'label_off' => __( 'Hide', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
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
            'cz_title',
            [
                'label' => esc_html__( 'TILT EFFECT ON HOVER', 'custom-widgets' )
            ]
        );

		$this->add_control(
            'tilt',
            [
                'label' => esc_html__( 'Tilt effect', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Off', 'custom-widgets' ),
                    'on' => esc_html__( 'On', 'custom-widgets' ),
                ],
            ]
        );

		$this->add_control(
            'glare',
            [
                'label' => esc_html__( 'Glare', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( '0', 'custom-widgets' ),
                    '0.2' => esc_html__( '0.2', 'custom-widgets' ),
                    '0.4' => esc_html__( '0.4', 'custom-widgets' ),
                    '0.6' => esc_html__( '0.6', 'custom-widgets' ),
                    '0.8' => esc_html__( '0.8', 'custom-widgets' ),
					'1' => esc_html__( '1', 'custom-widgets' ),
                ],
				'condition' => [
                    'tilt' => 'on'
                ],
            ]
        );

		$this->add_control(
            'scale',
            [
                'label' => esc_html__( 'Scale', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '0.9' => esc_html__( '0.9', 'custom-widgets' ),
                    '0.8' => esc_html__( '0.8', 'custom-widgets' ),
                    '' => esc_html__( '1', 'custom-widgets' ),
                    '1.1' => esc_html__( '1.1', 'custom-widgets' ),
                    '1.2' => esc_html__( '1.2', 'custom-widgets' ),
                ],
				'condition' => [
                    'tilt' => 'on'
                ],
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
			'sk_wrap',
			[
				'label' => esc_html__( 'Wrap', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'type' => '2',
                ]
			]
		);

        $this->add_control(
			'sk_overall',
			[
				'label' => esc_html__( 'Container', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'type' => '2',
                ]
			]
		);

        $this->add_control(
			'sk_image',
			[
				'label' => esc_html__( 'Image', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'type' => '2',
                ]
			]
		);

        $this->add_control(
			'svg_bg',
			[
				'label' => esc_html__( 'Background layer', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'type' => '2',
                ]
			]
		);

        $this->add_control(
			'sk_back',
			[
				'label' => esc_html__( 'Container', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'type' => '1',
                ]
			]
		);

        $this->add_control(
			'sk_back_in',
			[
				'label' => esc_html__( 'Content', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'type' => '1',
                ]
			]
		);

        $this->add_control(
			'sk_back_title',
			[
				'label' => esc_html__( 'Title', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'type' => '1',
                ]
			]
		);

        $this->add_control(
			'sk_back_btn',
			[
				'label' => esc_html__( 'Button', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'type' => '1',
                ]
			]
		);

        $this->end_controls_section();
    }
}