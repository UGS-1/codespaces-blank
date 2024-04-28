<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_2_buttons extends Widget_Base {

    protected $id = 'cz_2_buttons';

	public function get_name() {
		return $this->id;
	}

    public function get_title() {
        return esc_html__( '2 Buttons', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'xtra' ];
    }
    public function get_style_depends() {
        if ( Codevz_Plus::$is_rtl ) {
			return [ $this->id, $this->id . '_rtl', 'cz_button' , 'cz_button_rtl' ];
		} else {
			return [ $this->id, 'cz_button' ];
		}
    }

    public function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => '2 Button Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Button 1', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Button 1 title', 'custom-widgets' ),
                'placeholder' => esc_html__( 'Button 1 title', 'custom-widgets' ),
            ]
        );

        $this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link 1', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'custom-widgets' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

        $this->add_control(
            'title2',
            [
                'label' => esc_html__( 'Button 2', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Button 2 title', 'custom-widgets' ),
                'placeholder' => esc_html__( 'Button 2 title', 'custom-widgets' ),
            ]
        );

        $this->add_control(
			'link2',
			[
				'label' => esc_html__( 'Link 2', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'custom-widgets' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

        $this->add_control(
			'css_position',
			[
				'label' => esc_html__( 'Position', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cz_2_btn_center',
				'options' => [
					''  => esc_html__( 'Select', 'custom-widgets' ),
					'cz_2_btn_left' => esc_html__( 'Left', 'custom-widgets' ),
					'cz_2_btn_center' => esc_html__( 'Center', 'custom-widgets' ),
					'cz_2_btn_right' => esc_html__( 'Right', 'custom-widgets' ),
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'separator_section',
            [
                'label' => esc_html__( 'Separator', 'custom-widgets' )
            ]
        );

        $this->add_control(
			'separator',
			[
				'label' => esc_html__( 'Separator', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'text',
				'options' => [
					'text'  => esc_html__( 'Text', 'custom-widgets' ),
					'icon' => esc_html__( 'Icon', 'custom-widgets' ),
				],
			]
		);

        $this->add_control(
            'sep_text',
            [
                'label' => esc_html__( 'Text', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'OR', 'custom-widgets' ),
                'placeholder' => esc_html__( 'OR', 'custom-widgets' ),
                'condition' => [
                    'separator' => 'text'
                ],
            ],
        );

        $this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
				// 'default' => [
				// 	'value' => 'fas fa-star',
				// 	'library' => 'solid',
				// ],
                'condition' => [
                    'separator' => 'icon'
                ]
			]
		);

        $this->add_control(
			'style',
			[
				'label' => esc_html__( 'Style', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__( 'Style 1', 'custom-widgets' ),
					'style2' => esc_html__( 'Style 2', 'custom-widgets' ),
                    'style3' => esc_html__( 'Style 3', 'custom-widgets' ),
                    'style4' => esc_html__( 'Style 4', 'custom-widgets' ),
                    'style5' => esc_html__( 'Style 5', 'custom-widgets' ),
                    'style6' => esc_html__( 'Style 6', 'custom-widgets' ),
                    'style7' => esc_html__( 'Style 7', 'custom-widgets' ),
                    'style8' => esc_html__( 'Style 8', 'custom-widgets' ),
                    'style9' => esc_html__( 'Style 9', 'custom-widgets' ),
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
                'label' => esc_html__( 'Style', 'custom-widgets' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'sk_btn1',
			[
				'label' => esc_html__( 'Button 1', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_btn2',
			[
				'label' => esc_html__( 'Button 2', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_icon',
			[
				'label' => esc_html__( 'Separator', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_sep',
			[
				'label' => esc_html__( 'Container', 'custom-widgets' ),
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
         $this->add_link_attributes( 'link', $settings['link'] );
         $this->add_link_attributes( 'link2', $settings['link2'] );
	
		// Buttons
		$btn1 = $settings['title'] ? 
        '<a class="cz_btn btn1" ' . $this->get_render_attribute_string( 'link' ) . '> 
        <strong>' . $settings['title'] . '</strong> </a>' : '';
		$btn2 = $settings['title2'] ? 
        '<a class="cz_btn btn2" ' . $this->get_render_attribute_string( 'link2' ) . '>
        <strong>' . $settings['title2'] . '</strong> </a>' : '';
		
        // Classes
		$classes = array();
		$classes[] = 'cz_2_btn';
		$classes[] = $settings['css_position'] ? 'cz' . $settings['css_position'] : '';

        // Separator
		if ( $settings['separator'] === 'icon' ) {
            ob_start();
			echo Icons_Manager::render_icon( $settings['icon'] );
            $sep = ob_get_clean();
		} else {
			$sep = '<i><span>' . $settings['sep_text'] . '</span></i>';
		}
        ?>
        <div <?php echo Codevz_Plus::classes( [], $classes );  ?>>
        <?php echo $btn1; ?>
	    <div class="cz_2_btn_sep <?php echo $settings['style']; ?>">
        <?php echo $sep; ?>
        </div>
        <?php echo $btn2; ?>
        </div>
        <?php
    }

    public function _content_template() {
        ?>
        <#
        var btn1 = settings.title ? '<a class="cz_btn btn1"  href="' + settings.link.url + '"> <strong>' + settings.title + '</strong> </a>' : '';
		var btn2 = settings.title2 ? '<a class="cz_btn btn2"  href="' + settings.link2.url + '"><strong>' + settings.title2 + '</strong> </a>' : '';

        var classes = 'cz_2_btn', 
                classes = settings.css_position ? classes + ' ' + settings.css_position : classes;

        var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' ),
		migrated = elementor.helpers.isIconMigrated( settings, 'icon' );

        if ( settings.separator === 'icon' ) {
			var sep = iconHTML.value;
		} else {
			var sep = '<i><span>' + settings.sep_text + '</span></i>';
		}
        #>
        <div class="{{{classes}}}">
        {{{btn1}}}
	    <div class="cz_2_btn_sep {{{settings.style}}}">
        {{{sep}}}
        </div>
        {{{btn2}}}
        </div>
        <?php
    }
}