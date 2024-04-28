<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_accordion extends Widget_Base { 

    protected $id = 'cz_accordion';


    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Accordion, Toggle', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'eicon-skill-bar';
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
    public function get_script_depends() {
        return [ $this->id ];
    }
    
    public function _register_controls(){
            $this->start_controls_section(
                'accordion',
                [
                    'label' => esc_html__( 'Accordion, Toggle Settings', 'custom-widgets' ),
                ]
            );

            $this->add_control(
                'toggle',
                [
                    'label' => esc_html__( 'Toggle mode?', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'custom-widgets' ),
                    'label_off' => esc_html__( 'No', 'custom-widgets' ),
                    'return_value' => 'Yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'first_open',
                [
                    'label' => esc_html__( '1st open?', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'custom-widgets' ),
                    'label_off' => esc_html__( 'No', 'custom-widgets' ),
                    'return_value' => 'Yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'icon_before',
                [
                    'label' => esc_html__( 'Icons before title?', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'custom-widgets' ),
                    'label_off' => esc_html__( 'No', 'custom-widgets' ),
                    'return_value' => 'Yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'subtitle_inline',
                [
                    'label' => esc_html__( 'Inline subtitle?', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'custom-widgets' ),
                    'label_off' => esc_html__( 'No', 'custom-widgets' ),
                    'return_value' => 'Yes',
                    'default' => 'no',
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
                    'label' => esc_html__( 'Default and activated icons', 'custom-widgets' )
                ]
            );

            $this->add_control(
                'open_icon',
                [
                    'label' => esc_html__( 'Default icon', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-chevron-circle-up',
                        'library' => 'solid',
                    ],
                ]
            );

            $this->add_control(
                'sk_open_icon',
                [
                    'label' => __( 'Icon Styling', 'custom-widgets' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_ACCENT,
                    ],
                ]
            );

            $this->add_control(
                'close_icon',
                [
                    'label' => esc_html__( 'Activated icon', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-chevron-circle-down',
                        'library' => 'solid',
                    ],
                ]
            );

            $this->add_control(
                'sk_close_icon',
                [
                    'label' => __( 'Icon Styling', 'custom-widgets' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_ACCENT,
                    ],
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'section_style',
                [
                    'label' => __( 'STYLING', 'custom-widgets' ),
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
                'sk_title',
                [
                    'label' => __( 'Titles', 'custom-widgets' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_ACCENT,
                    ],
                ]
            );

            $this->add_control(
                'sk_active',
                [
                    'label' => __( 'Active title', 'custom-widgets' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_ACCENT,
                    ],
                ]
            );

            $this->add_control(
                'sk_subtitle',
                [
                    'label' => __( 'Subtitle', 'custom-widgets' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_ACCENT,
                    ],
                ]
            );

            $this->add_control(
                'sk_content',
                [
                    'label' => __( 'Content', 'custom-widgets' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_ACCENT,
                    ],
                ]
            );

            $this->add_control(
                'sk_title_icons',
                [
                    'label' => __( 'Title icons', 'custom-widgets' ),
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
        // Arrows
		$arrows =  $settings['open_icon']['close_icon'] ;

		// Classes
		$classes = array();
		$classes[] = 'cz_acc clr';
		$classes[] = $settings['subtitle_inline'] ? 'cz_acc_subtitle_inline' : '';
		$classes[] = $settings['toggle'] ? 'cz_acc_toggle' : '';
		$classes[] = $settings['icon_before'] ? 'cz_acc_icon_before' : '';
		$classes[] = $settings['first_open'] ? 'cz_acc_first_open' : '';

        ?>
        <div data-arrows='' json_encode( $arrows ) <?php echo Codevz_Plus::classes( [], $classes );  ?> >
	    <div><?php echo $content; ?></div>
        </div>
        <?php

    }

    public function _content_template() {

    }
}