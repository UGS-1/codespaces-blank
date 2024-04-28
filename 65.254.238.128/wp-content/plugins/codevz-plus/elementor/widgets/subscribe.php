<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_subscribe extends Widget_Base { 

    protected $id = 'cz_subscribe';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Subscribe', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'fas fa-envelope';
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
                'label' => 'Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Form style', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Square', 'custom-widgets' ),
                    'cz_subscribe_round' => esc_html__( 'Round', 'custom-widgets' ),
                    'cz_subscribe_round_2' => esc_html__( 'Round 2', 'custom-widgets' ),
                    'cz_subscribe_relative' => esc_html__( 'Square,Button next line', 'custom-widgets' ),
                    'cz_subscribe_relative cz_subscribe_round' => esc_html__( 'Round,Button next line', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
            'position',
            [
                'label' => esc_html__( 'Position', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( '~ Default ~', 'custom-widgets' ),
                    'center' => esc_html__( 'Center', 'custom-widgets' ),
                    'right' => esc_html__( 'Right', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
            'btn_position',
            [
                'label' => esc_html__( 'Button Position', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( '~ Default ~', 'custom-widgets' ),
                    'center' => esc_html__( 'Center', 'custom-widgets' ),
                    'right' => esc_html__( 'Right', 'custom-widgets' ),
                ],
                'condition' => [
					'form_style' => 'round_bnl',
				],
            ]
        );

        $this->add_control(
			'action',
			[
				'label' => esc_html__( 'Action URL', 'custom-widgets' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( '#', 'custom-widgets' ),
				'show_label' => false,
			]
		);

        $this->add_control(
            'placeholder',
            [
                'label' => esc_html__('Placeholder','custom-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Enter Your Email...'
            ]
        );

        $this->add_control(
            'type_attr',
            [
                'label' => esc_html__( 'Input type attributes', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'email',
                'options' => [
                    'email' => esc_html__( 'Email', 'custom-widgets' ),
                    'text' => esc_html__( 'Text', 'custom-widgets' ),
                    'number' => esc_html__( 'Number', 'custom-widgets' ),
                    'search' => esc_html__( 'Search', 'custom-widgets' ),
                    'tel' => esc_html__( 'Tel', 'custom-widgets' ),
                    'time' => esc_html__( 'Time', 'custom-widgets' ),
                    'date' => esc_html__( 'Date', 'custom-widgets' ),
                    'url' => esc_html__( 'url', 'custom-widgets' ),
                    'password' => esc_html__( 'Password', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
            'name_attr',
            [
                'label' => esc_html__('Input name attributes','custom-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'MERGE0'
            ]
        );

        $this->add_control(
            'btn_title',
            [
                'label' => esc_html__('Button Title','custom-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'join now'
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
                'label' => __( 'Style', 'custom-widgets' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'container',
			[
				'label' => esc_html__( 'Container', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'input',
			[
				'label' => esc_html__( 'Input', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'button',
			[
				'label' => esc_html__( 'Button', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);
    }

    public function render() {
        $settings = $this->get_settings_for_display();
        //$btn_title = $settings['icon'] ? '<i class="' . $settings['icon'] . ( $settings['btn_title'] ? ' mr8' : '' ) . '"></i>' . $settings['btn_title'] : $settings['btn_title'];

        $classes = array();
		$classes[] = 'cz_subscribe_elm clr';
		$classes[] = $settings['style'];
		$classes[] = $settings['btn_position'];
		$classes[] = $settings['position'] ? 'cz_subscribe_elm_' . $settings['position'] : '';

        ?>
        <form <?php $settings['action']  ?> method="post" name="mc-embedded-subscribe-form" target="_blank" <?php echo xtra_elementor_classes( $classes ); ?>>
	    <input type="<?php echo $settings['type_attr']; ?>" name="<?php echo $settings['name_attr']; ?>" placeholder="<?php echo $settings['placeholder']; ?>" required="required">
		<button name="subscribe" type="submit"><?php echo $settings['btn_title']; ?></button>
	    </form>
	    <div class="clr"></div>
        <?php
    }

    protected function _content_template() {
        ?>
        <#
        view.addInlineEditingAttributes( 'placeholder', 'basic' );
        #>
        <form class="cz_subscribe_elm clr {{{ settings.style }}}" action="{{{settings.action}}}" method="post" name="mc-embedded-subscribe-form" target="_blank">
	    <input type="{{{settings.type_attr}}}" name="{{{settings.name_attr}}}" placeholder="{{{settings.placeholder}}}" required="required">
		<button name="subscribe" type="submit"> {{{settings.btn_title}}} </button>
	    </form>
	    <div class="clr"></div>
        <?php 
        
    }
}
