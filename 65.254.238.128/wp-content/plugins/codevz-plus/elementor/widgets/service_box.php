<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_service_box extends Widget_Base {

    protected $id = 'cz_service_box';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Service Box', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'eicon-button';
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
            'section_content',
            [
                'label' => 'Service Box Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => esc_html__( 'Layout', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'select',
                'options' => [
                    'horizontal' => esc_html__( 'Horizontal', 'custom-widgets' ),
                    'vertical' => esc_html__( 'Vertical', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
            'align',
            [
                'label' => esc_html__( 'Position', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Select', 'custom-widgets' ),
                    'left' => esc_html__( 'Left', 'custom-widgets' ),
                    'right' => esc_html__( 'Right', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Your Title' ,'custom-widgets' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => esc_html__('Description','custom-widgets'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'Lorem ipsum dolor sit amet, conse ctetur adipi scing elit. duis odio nisl, tinci dunt eturn sed molis velit.',
            ]
        );

        $this->add_control(
            'btn',
            [
                'label' => esc_html__( 'Button', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'btn_pos',
            [
                'label' => esc_html__( 'Button position', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'select',
                'options' => [
                    '' => esc_html__( 'Default', 'custom-widgets' ),
                    'left' => esc_html__( 'Left', 'custom-widgets' ),
                    'center' => esc_html__( 'Center', 'custom-widgets' ),
                    'right' => esc_html__( 'Right', 'custom-widgets' ),
                ], 
                // 'condition' => [
                //     'btn' => '',
                // ],
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

        $this->add_control(
			'link_only_btn',
			[
				'label' => esc_html__( 'Link only button', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'custom-widgets' ),
				'label_off' => __( 'No', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'cz_title_icons',
            [
                'label' => esc_html__( 'Icon', 'custom-widgets' )
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Icon type', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__( 'Icon', 'custom-widgets' ),
                    'style9' => esc_html__( 'Hexagon Icon', 'custom-widgets' ),
                    'style11' => esc_html__( 'Image', 'custom-widgets' ),
                    'style10' => esc_html__( 'Number', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
            'icon_fx',
            [
                'label' => esc_html__( 'Hover effect?', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Select', 'custom-widgets' ),
                    'cz_sbi_fx_0' => esc_html__( 'ZoomIn', 'custom-widgets' ),
                    'cz_sbi_fx_1' => esc_html__( 'ZoomOut', 'custom-widgets' ),
                    'cz_sbi_fx_2' => esc_html__( 'Bottom to Top', 'custom-widgets' ),
                    'cz_sbi_fx_3' => esc_html__( 'Top to Bottom', 'custom-widgets' ),
                    'cz_sbi_fx_4' => esc_html__( 'Left to Right', 'custom-widgets' ),
                    'cz_sbi_fx_5' => esc_html__( 'Right to Left', 'custom-widgets' ),
                    'cz_sbi_fx_6' => esc_html__( 'Rotate', 'custom-widgets' ),
                    'cz_sbi_fx_7a' => esc_html__( 'Shake', 'custom-widgets' ),
                    'cz_sbi_fx_7' => esc_html__( 'Shake Infinite', 'custom-widgets' ),
                    'cz_sbi_fx_8a' => esc_html__( 'Wink', 'custom-widgets' ),
                    'cz_sbi_fx_8' => esc_html__( 'Wink Infinite', 'custom-widgets' ),
                    'cz_sbi_fx_9a' => esc_html__( 'Quick Bob', 'custom-widgets' ),
                    'cz_sbi_fx_9' => esc_html__( 'Quick Bob Infinite', 'custom-widgets' ),
                    'cz_sbi_fx_10' => esc_html__( 'Flip Horizontal', 'custom-widgets' ),
                    'cz_sbi_fx_11' => esc_html__( 'Flip Vertical', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				// 'default' => [
				// 	'value' => 'fas fa-star',
				// 	'library' => 'solid',
				// ],
                'condition' => [
                    'style' => ['style1','style9'],
                ]
			]
		);

        $this->add_control(
			'sk_icon',
			[
				'label' => __( 'Icon styling', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'style' => [ 'style1' , 'style9' ],
                ]
			]
		);

        $this->add_control(
			'sk_icon_con',
			[
				'label' => __( 'Icon container', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'style' => [ 'style1' , 'style9' ],
                ]
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
                    'style' => 'style11',
                ]
			]
		);

        $this->add_control(
			'image_hover',
			[
				'label' => esc_html__( 'Image Hover', 'custom-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'style' => 'style11',
                ]
			]
		);

        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
                'condition' => [
                    'style' => 'style11',
                ]
			]
		);

        $this->add_control(
			'sk_image',
			[
				'label' => __( 'Image styling', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'style' => 'style11',
                ]
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
                    'style' => 'style10',
                ]
            ]
        );

        $this->add_control(
			'sk_num',
			[
				'label' => __( 'Number styling', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'style' => 'style10',
                ]
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'cz_title',
            [
                'label' => esc_html__( 'Hover Effect', 'custom-widgets' )
            ]
        );

        $this->add_control(
			'fx',
			[
				'label' => __( 'Default', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
				'prefix_class' => 'xtra-animation-',
			]
		);

        $this->add_control(
			'fx_hover',
			[
				'label' => __( 'Hover', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
				'prefix_class' => 'xtra-animation-',
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
			'cz_title_styling',
			[
				'label' => esc_html__( 'OTHER STYLING', 'custom-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'sk_overall',
			[
				'label' => esc_html__( 'Box container', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_title',
			[
				'label' => esc_html__( 'Title styling', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_con',
			[
				'label' => esc_html__( 'Content styling', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_button',
			[
				'label' => esc_html__( 'Button', 'custom-widgets' ),
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

        // Style
		$style = $settings['style'];
        // Title
		$title = $settings['title'] ? '<h3>' . $settings['title'] . '</h3>' : '';
        
        $return2 = '';
		if ( $style === 'style10' ) {
			$return2 = '<div class="service_img service_number">' . $settings['number'] . '</div>' ;
		}else {
			if ( $settings['image'] ) {
                $img = Group_Control_Image_Size::get_attachment_image_html( $settings );

                $img_have_hover = '';
			  	if ( $settings['image_hover'] ) {
			  		$img .= Group_Control_Image_Size::get_attachment_image_html( $settings );
			  		$img_have_hover = ' services_img_have_hover';
			  	}

                $return2 = '<div class="service_img' . $img_have_hover . '">' . $img . '</div>' ;

            } else if ( $settings['icon'] ){
				if ( $style == 'style9' ) {
					$return2 = '<div class="cz_hexagon service_custom"><i class="' . $settings['icon'] . '"></i></div>';
				}else {
					$return2 = '<i class="' . $settings['icon'] . '"></i>';
				}
            }
        }

        if ( $style == 'style1' ) {
			$return2 = '<div class="service_custom">' . $return2 .'</div>';
		}

        // Content
		$content = $settings['content'];

        // Separator
		// $separator = '';
		// if ( $settings['separator'] === 'line' ) {
		// 	$separator = '<span class="cz_sb_sep_line bar"></span>';
		// } else if ( $settings['separator'] === 'icon' ) {
		// 	$separator = '<i class="cz_sb_sep_icon ' . $settings['sep_icon'] . '"></i>';
		// }

        // Link 
		$a_attr = $settings['link'] ? $this->get_render_attribute_string( 'link' ) : '';

        // Button
		$btn = '';
		if ( $settings['btn'] ) {
			$btn_pos = $settings['btn_pos'] ? ' xtra-service-btn-' . $settings['btn_pos'] : '';
			$btn = $settings['link_only_btn'] ? '<a' . $a_attr . ' class="cz_btn' . $btn_pos . '">' . $settings['btn'] . '</a>' : '<div' . $a_attr . ' class="cz_btn' . $btn_pos . '">' . $settings['btn'] . '</div>';
		}

        // Classes
		$classes = array();
		$classes[] = 'services clr';
		$classes[] = $style;
		$classes[] = $settings['icon_fx'] ? $settings['icon_fx'] : '';

        // Type
		if ( $settings['type'] === 'vertical' ) {
			$classes[] = 'services_b';
			$classes[] = $settings['align'];
			$return = '<div' . xtra_elementor_classes($classes) . '>';
			$return .= $return2 . '<div class="service_text">' . $title . $separator . '<div class="cz_wpe_content">' . $content . '</div>' . $btn . '</div></div>';
		} else {
			$classes[] = $settings['align'] ? $settings['align'] : 'left';
			$return = '<div' . xtra_elementor_classes($classes) . '>';
			$return .= $return2 . '<div class="service_text">' . $title . '<div class="cz_wpe_content">' . $content . '</div>' . $btn . '</div></div>';
		}

        echo $settings['fx'] ? '<div class="' . $settings['fx'] . '">' : '';
		echo $settings['fx_hover'] ? '<div class="' . $settings['fx_hover'] . '">' : '';

		if ( $a_attr && ! $settings['link_only_btn'] ) {
			$return = '<a' . $a_attr . '>' . preg_replace( '/<a .*?<\/a>/', '', $return ) . '</a>';
		}

		echo $return;
		echo $settings['fx_hover'] ? '</div>' : '';
		echo $settings['fx'] ? '</div>' : '';

    }

    public function content_template() {
        ?>
        <?php
    }
}