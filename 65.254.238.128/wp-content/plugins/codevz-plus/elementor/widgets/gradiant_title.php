<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_gradiant_title extends Widget_Base { 

    protected $id = 'cz_gradiant_title';


    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Gradian Title', 'custom-widgets' );
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

    public function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => 'Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Text','codevz'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'TITLE'
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
			'background_color',
			[
				'label' => esc_html__( 'Background Color', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .xtra-elements-gt' => 'background-color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'text', 'class', 'xtra-gradianttitle');

		$this->add_inline_editing_attributes( 'text', 'advanced' );
        $this->add_render_attribute( 'wrapper', 'class', 'xtra-elements-gt' );

		// Classes
		$classes = array();
		$classes[] = 'cz_gradient_title';
		// $classes[] = $settings['smart_fs'] ? 'cz_smart_fs' : '';
		// $classes[] = $settings['text_center'] ? 'cz_mobile_text_center' : '';
		if( strpos( $settings['text'], ': center;' ) !== false || strpos( $settings['text'], ':center;' ) !== false ) {
			$classes[] = 'cz_gradient_title_center';
		}
        ?>
    <div <?php echo xtra_elementor_classes( $classes ); ?>>
	    <div class="cz_wpe_content"><?php echo $settings['text']; ?></div>
    </div>
        <?php
    }

    protected function content_template() {
    ?>
    <#
        view.addRenderAttribute( 'text', 'class', 'xtra-gradianttitle');
        view.addInlineEditingAttributes( 'text', 'advanced' );
        var smart_fs = settings.smart_fs ? 'cz_smart_fs' : '';
        var text_center = settings.text_center ? 'cz_mobile_text_center' : '';
    #>
    <div class="cz_gradient_title">
	<div class="cz_wpe_content" {{{ view.getRenderAttributeString( 'text' ) }}}>{{{settings.text}}}</div>
    </div>
    <?php
    }
}
    