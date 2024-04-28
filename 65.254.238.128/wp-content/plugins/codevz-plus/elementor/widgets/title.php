<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_title extends Widget_Base {

    protected $id = 'cz_title';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Title & Text', 'custom-widgets' );;
    }
    
    public function get_icon() {
        return 'fa fa-font';
    }

    public function get_categories() {
        return [ 'xtra' ];
    }
    public function get_style_depends() {
        if ( Codevz_Plus::$is_rtl ) {
			return [ $this->id, $this->id . '_rtl' ];
		} else {
			return [ $this->id ];
		}
    }

    public function _register_controls() {
        $this->start_controls_section(
            'title_text',
            [
                'label' => 'Title & Text Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ],
        );

        $this->add_control(
            'content',
            [
                'label' => esc_html__('Title','custom-widgets'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'Title Element'
            ]
        );

        $this->add_control(
            'title_pos',
            [
                'label' => esc_html__( 'Position?', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'cz_title_pos_inline',
                'options' => [
                    'cz_title_pos_inline' => esc_html__( 'Inline', 'custom-widgets' ),
                    'cz_title_pos_block' => esc_html__( 'Block', 'custom-widgets' ),
                    'cz_title_pos_left' => esc_html__( 'Left', 'custom-widgets' ),
                    'cz_title_pos_center' => esc_html__( 'Center', 'custom-widgets' ),
                    'cz_title_pos_right' => esc_html__( 'Right', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'custom-widgets' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'custom-widgets' ),
				'show_label' => false,
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'title_line',
            [
                'label' => esc_html__( 'Title Line', 'custom-widgets' )
            ]
        );

        $this->add_control(
            'bline',
            [
                'label' => esc_html__( 'Type', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Select', 'custom-widgets' ),
                    'cz_line_before_title' => esc_html__( 'Above title', 'custom-widgets' ),
                    'cz_line_after_title' => esc_html__( 'Below title', 'custom-widgets' ),
                    'cz_line_left_side' => esc_html__( 'Left Side', 'custom-widgets' ),
                    'cz_line_right_side' => esc_html__( 'Right Side', 'custom-widgets' ),
                    'cz_line_both_side' => esc_html__( 'Both Side', 'custom-widgets' ),
                ],
            ]
        );

        
        $this->add_control(
            'css_right_line_left',
            [
                'label' => esc_html__( 'Horizontal Offset Right Line', 'custom-widgets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [  'px' ],
                'range' => [
                    'px' => [
                        'min' => -80,
                        'max' => 80,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
					'{{WRAPPER}} .xtra-elements-title' => 'speed: {{SIZE}}{{UNIT}};',
				],
                'separator' => 'before',
                'condition' => [
                    'bline' => ['cz_line_right_side' , 'cz_line_both_side'],
                ],
			]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'cz_title_icbt',
            [
                'label' => esc_html__( 'Icon Before Title', 'custom-widgets' )
            ]
        );

        $this->add_control(
            'icon_before_type',
            [
                'label' => esc_html__( 'Type', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Select', 'custom-widgets' ),
                    'icon' => esc_html__( 'Iocn', 'custom-widgets' ),
                    'image' => esc_html__( 'Image', 'custom-widgets' ),
                    'number' => esc_html__( 'Number', 'custom-widgets' ),
                ],
            ]
        );
        
        
        $this->add_control(
			'image_as_icon',
			[
				'label' => esc_html__( 'Image', 'custom-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'icon_before_type' => 'image',
                ],
			]
		);

        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image_as_icon_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension1`.
				'default' => 'large',
				'separator' => 'none',
                'condition' => [
                    'icon_before_type' => 'image',
                ],
			]
		);

        $this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
                'condition' => [
                    'icon_before_type' => 'icon'
                ],
			]
		);

        $this->add_control(
            'number',
            [
                'label' => esc_html__( 'Number', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'icon_before_type' => 'number',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'cz_title_icat',
            [
                'label' => esc_html__( 'Icon After Title', 'custom-widgets' )
            ]
        );

        $this->add_control(
            'icon_after_type',
            [
                'label' => esc_html__( 'Type', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Select', 'custom-widgets' ),
                    'icon' => esc_html__( 'Iocn', 'custom-widgets' ),
                    'image' => esc_html__( 'Image', 'custom-widgets' ),
                    'number' => esc_html__( 'Number', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
			'image_as_icon_after',
			[
				'label' => esc_html__( 'Image', 'custom-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'icon_after_type' => 'image',
                ],
			]
		);

        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image_as_icon_after_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension2`.
				'default' => 'large',
				'separator' => 'none',
                'condition' => [
                    'icon_after_type' => 'image',
                ],
			]
		);

        $this->add_control(
			'icon_after',
			[
				'label' => esc_html__( 'Icon', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
                'condition' => [
                    'icon_after_type' => 'icon'
                ],
			]
		);

        $this->add_control(
            'number_after',
            [
                'label' => esc_html__( 'Number', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'icon_after_type' => 'number',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'cz_title_shp',
            [
                'label' => esc_html__( 'Shape', 'custom-widgets' )
            ]
        );

        $this->add_control(
            'shape',
            [
                'label' => esc_html__( 'Shape', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Select', 'custom-widgets' ),
                    'text' => esc_html__( 'Text', 'custom-widgets' ),
                    'icon' => esc_html__( 'Icon', 'custom-widgets' ),
                    'image' => esc_html__( 'Image', 'custom-widgets' ),
                    'circle' => esc_html__( 'Circle', 'custom-widgets' ),
                    'circle cz_title_shape_outline' => esc_html__( 'Circle Outline', 'custom-widgets' ),
                    'square' => esc_html__( 'Square', 'custom-widgets' ),
                    'square cz_title_shape_outline' => esc_html__( 'Square Outline', 'custom-widgets' ),
                    'rhombus' => esc_html__( 'Rhombus', 'custom-widgets' ),
                    'rhombus cz_title_shape_outline' => esc_html__( 'Rhombus Outline', 'custom-widgets' ),
                    'rhombus_radius' => esc_html__( 'Rhombus Radius', 'custom-widgets' ),
                    'rhombus_radius cz_title_shape_outline' => esc_html__( 'Rhombus Radius Outline', 'custom-widgets' ),
                    'rectangle' => esc_html__( 'Rectangle', 'custom-widgets' ),
                    'rectangle cz_title_shape_outline' => esc_html__( 'Rectangle Outline', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'custom-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'shape' => 'image',
                ],
			]
		);

        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension3`.
				'default' => 'large',
				'separator' => 'none',
                'condition' => [
                    'shape' => 'image',
                ],
			]
		);

        $this->add_control(
			'shape_icon',
			[
				'label' => esc_html__( 'Icon', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
                'condition' => [
                    'shape' => 'icon'
                ],
			]
		);

        $this->add_control(
            'shape_text',
            [
                'label' => esc_html__( 'Text', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'shape' => 'text',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'cz_title_shp2',
            [
                'label' => esc_html__( 'Shape 2', 'custom-widgets' )
            ]
        );

        $this->add_control(
            'shape2',
            [
                'label' => esc_html__( 'Shape 2', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Select', 'custom-widgets' ),
                    'text' => esc_html__( 'Text', 'custom-widgets' ),
                    'icon' => esc_html__( 'Icon', 'custom-widgets' ),
                    'image' => esc_html__( 'Image', 'custom-widgets' ),
                    'circle' => esc_html__( 'Circle', 'custom-widgets' ),
                    'circle cz_title_shape_outline' => esc_html__( 'Circle Outline', 'custom-widgets' ),
                    'square' => esc_html__( 'Square', 'custom-widgets' ),
                    'square cz_title_shape_outline' => esc_html__( 'Square Outline', 'custom-widgets' ),
                    'rhombus' => esc_html__( 'Rhombus', 'custom-widgets' ),
                    'rhombus cz_title_shape_outline' => esc_html__( 'Rhombus Outline', 'custom-widgets' ),
                    'rhombus_radius' => esc_html__( 'Rhombus Radius', 'custom-widgets' ),
                    'rhombus_radius cz_title_shape_outline' => esc_html__( 'Rhombus Radius Outline', 'custom-widgets' ),
                    'rectangle' => esc_html__( 'Rectangle', 'custom-widgets' ),
                    'rectangle cz_title_shape_outline' => esc_html__( 'Rectangle Outline', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
			'image2',
			[
				'label' => esc_html__( 'Image', 'custom-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'shape2' => 'image',
                ],
			]
		);

        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image2_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case2 `image_size` and `image_custom_dimension4`.
				'default' => 'large',
				'separator' => 'none',
                'condition' => [
                    'shape2' => 'image',
                ],
			]
		);

        $this->add_control(
			'shape_icon2',
			[
				'label' => esc_html__( 'Icon', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
                'condition' => [
                    'shape2' => 'icon'
                ],
			]
		);

        $this->add_control(
            'shape_text2',
            [
                'label' => esc_html__( 'Text', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'shape2' => 'text',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'advanced',
            [
                'label' => 'Advanced',
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ],
        );

        $this->add_control(
            'vertical',
            [
                'label' => esc_html__( 'Type', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Select', 'custom-widgets' ),
                    'cz_title_vertical' => esc_html__( 'Vertical 1', 'custom-widgets' ),
                    'cz_title_vertical cz_title_vertical_outside' => esc_html__( 'Vertical Outside 1', 'custom-widgets' ),
                    'cz_title_vertical_2' => esc_html__( 'Vertical 2', 'custom-widgets' ),
                    'cz_title_vertical_2 cz_title_vertical_outside' => esc_html__( 'Vertical Outside 2', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
            'css_transform',
            [
                'label' => esc_html__( 'Rotate title?', 'custom-widgets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [  'deg' ],
                'range' => [
                    'deg' => [
                        'min' => 0,
                        'max' => 360,
                        'step' => 1,
                    ],
                ],
                'separator' => 'before',
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
            'section_style',
            [
                'label' => esc_html__( 'Style', 'custom-widgets' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'sk_overall',
			[
				'label' => __( 'Container', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_lines_con',
			[
				'label' => __( 'Line(s) container', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        
        $this->add_control(
			'sk_icon_before',
			[
				'label' => __( 'Icon Before Title', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_icon_after',
			[
				'label' => __( 'Icon After Title', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_shape',
			[
				'label' => __( 'Shape Styling', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_shape2',
			[
				'label' => __( 'Shape2 Styling', 'custom-widgets' ),
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

        $line_before = $line_after = $icon = $icon_after = '';

        // Shape
		$shape = $settings['shape'];
		if ( $shape === 'text' ) {
			$shape_content = $settings['shape_text'];
		} else if ( $shape === 'icon' ) {
			$shape_content = '<i class="' . $settings['shape_icon'] . '"></i>';
		} else if ( $shape === 'image' ) {
			$shape_content = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'image' );
		} else {
			$shape_content = '';
		}
		$shape_out = '';
		if ( $shape ) {
			$shape_out .= $shape ? '<div class="cz_title_shape shape_' . $shape . ' cz_shape_1">' . $shape_content . '</div>' : '';
		}

		// Shape 2
		$shape2 = $settings['shape2'];
		if ( $shape2 === 'text' ) {
			$shape_content2 = $settings['shape_text2'];
		} else if ( $shape2 === 'icon' ) {
			$shape_content2 = '<i class="' . $settings['shape_icon2'] . '"></i>';
		} else if ( $shape2 === 'image' ) {
			$shape_content2 = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'image2' );
		} else {
			$shape_content2 = '';
		}
		if ( $shape2 ) {
			$shape_out .= $shape2 ? '<div class="cz_title_shape shape_' . $shape2 . ' cz_shape_2">' . $shape_content2 . '</div>' : '';
		}

		if ( $settings['bline'] ) {
			$line = '<div class="cz_title_line ' . $settings['bline'] . '"><span>_</span></div>';
			$line_before = ( $settings['bline'] === 'cz_line_before_title' ) ? $line : '';
			$line_before = ( $settings['bline'] === 'cz_line_left_side' || $settings['bline'] === 'cz_line_both_side' ) ? '<span class="cz_line_side_solo">_</span>' : $line_before;
			$line_after = ( $settings['bline'] === 'cz_line_after_title' ) ? $line : '';
			$bline_css = ( $settings['css_right_line_left'] && $settings['bline'] === 'cz_line_both_side' ) ? ' style="' . $settings['css_right_line_left'] . '"' : '';
			$line_after = ( $settings['bline'] === 'cz_line_both_side' || $settings['bline'] === 'cz_line_right_side' ) ? '<span class="cz_line_side_solo cz_line_side_after"' . $bline_css . '>_</span>' : $line_after;
		}

		// Icon before
		if ( $settings['image_as_icon'] ) {
			$icon = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_as_icon' );
			$icon = '<span class="cz_title_icon_before cz_title_image">' . $icon . '</span>';
		} else if ( $settings['icon'] ) {
			$icon = '<i class="cz_title_icon_before ' . $settings['icon'] . '"></i>';
		} else if ( $settings['number'] ) {
			$icon = '<i class="cz_title_icon_before cz_title_number"><span>' . $settings['number'] . '</span></i>';
		}

		// Icon after
		if ( $settings['image_as_icon_after'] ) {
			$icon_after = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_as_icon_after' );
			$icon_after = '<span class="cz_title_icon_after cz_title_image">' . $icon_after . '</span>';
		} else if ( $settings['icon_after'] ) {
			$icon_after = '<i class="cz_title_icon_after ' . $settings['icon_after'] . ' icon_after"></i>';
		} else if ( $settings['number_after'] ) {
			$icon_after = '<i class="cz_title_icon_after cz_title_number"><span>' . $settings['number_after'] . '</span></i>';
		}

        // Animation
		$animation = '';
		// if ( Codevz_Plus::contains( $settings['css_animation'], 'cz_brfx_' ) ) {
			
		// 	// WPBakery old versions
		// 	wp_enqueue_script( 'waypoints' );
		// 	wp_enqueue_style( 'animate-css' );

		// 	// WPBakery after v6.x
		// 	wp_enqueue_script( 'vc_waypoints' );
		// 	wp_enqueue_style( 'vc_animate-css' );
			
		// 	$delay = $settings['anim_delay'] ? ' style="animation-delay:' . $settings['anim_delay'] . ';"' : '';
		// 	$animation = ' class="wpb_animate_when_almost_visible wpb_' . $settings['css_animation'] . ' ' . $settings['css_animation'] . ' relative ' . $settings['class'] . '"' . $delay;
		// 	unset( $settings['css_animation'] );
		// 	$settings['class'] = '';
		// }

        // Classes
		$classes = array();
		$classes[] = 'cz_title clr';
		// $classes[] = $settings['smart_fs'] ? 'cz_smart_fs' : '';
		// $classes[] = $settings['text_center'] ? 'cz_mobile_text_center' : '';
		$classes[] =  $icon || $icon_after  ? 'cz_title_has_icon' : '';
		// $classes[] = $settings['sk_overall'], 'background'  ? 'cz_title_has_bg' : '';
		// $classes[] = $settings['sk_overall'], 'border-width'  ? 'cz_title_has_border' : '';
		//$classes[] = (( $settings['bline'], 'before' )  || ( $settings['bline'], 'after' ))  ? 'cz_title_ba_line' : '';
		$classes[] = $settings['vertical'];
		$classes[] = $settings['title_pos'];
		$content =  $settings['content']; 
        if ( strpos( $content, 'center;' ) !== false || strpos( $content, ': center' ) !== false ) {
			$classes[] = 'tac';
		} else if ( strpos( $content, 'right;' ) !== false || strpos( $content, ': right' ) !== false ) {
			$classes[] = 'tar';
		}
        // Content
		
        $out_content = $shape_out . '<div class="cz_title_content">' . $line_before . $icon . '<div class="cz_wpe_content">' . ( function_exists( 'wpb_js_remove_wpautop' ) ? wpb_js_remove_wpautop( $content, true ) : do_shortcode( $content ) ) . '</div>' . $icon_after . $line_after. '</div>';
        ?>
        <?php echo  $animation; ?>  
        <div' <?php echo $animation; ?>>
        <div <?php echo xtra_elementor_classes( $classes );  ?>><?php echo $out_content; ?></div>
        <?php echo $animation; ?></div>
        <?php
    }

    public function _content_template() {
        ?>
        <#
        #>
        <?php

    }
}