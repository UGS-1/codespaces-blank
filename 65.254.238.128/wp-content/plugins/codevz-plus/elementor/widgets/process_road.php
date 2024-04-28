<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_process_road extends Widget_Base {

    protected $id = 'cz_process_road';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Process Road', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'eicon-button';
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
                'label' => 'Process Road Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'road',
			[
				'label' => esc_html__( 'Road', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cz_road_cr',
				'options' => [
					'cz_road_cr' => esc_html__( 'Center to Right', 'custom-widgets' ),
					'cz_road_cb' => esc_html__( 'Center to Bottom', 'custom-widgets' ),
                    'cz_road_tl cz_road_cl' => esc_html__( 'Center to Left', 'custom-widgets' ),
                    'cz_road_tl cz_road_ct' => esc_html__( 'Center to Top', 'custom-widgets' ),
                    'cz_road_rb' => esc_html__( 'Right to bottom ( ┌ )', 'custom-widgets' ),
                    'cz_road_tb' => esc_html__( 'Top to bottom ( │ )', 'custom-widgets' ),
                    'cz_road_tr' => esc_html__( 'Top to right ( └ )', 'custom-widgets' ),
                    'cz_road_tl' => esc_html__( 'Top to left ( ┘ )', 'custom-widgets' ),
                    'cz_road_lr' => esc_html__( 'Left to right ( ─ )', 'custom-widgets' ),
                    'cz_road_lb' => esc_html__( 'Left to bottom ( ┐ )', 'custom-widgets' ),
                    'cz_road_vr' => esc_html__( 'Vertical & Right ( ├ )', 'custom-widgets' ),
                    'cz_road_lb cz_road_vl' => esc_html__( 'Vertical & Left ( ┤ )', 'custom-widgets' ),
                    'cz_road_tr cz_road_hu' => esc_html__( 'Horizontal & Up ( ┴ )', 'custom-widgets' ),
                    'cz_road_hd' => esc_html__( 'Horizontal & Down ( ┬ )', 'custom-widgets' ),
                    'cz_road_crs' => esc_html__( 'Cross ( ┼ )', 'custom-widgets' ),
				],
			]
		);

        $this->add_responsive_control(
			'line_height',
			[
				'label' => __( 'Height', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 500,
                        'step' => 10,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
                        'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xtra_line_height' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'line_border-style',
			[
				'label' => esc_html__( 'Lines style', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid' => esc_html__( 'Solid', 'custom-widgets' ),
					'dotted' => esc_html__( 'Dotted', 'custom-widgets' ),
                    'dashed' => esc_html__( 'Dashed', 'custom-widgets' ),
				],
			]
		);

        $this->add_control(
			'line_size',
			[
				'label' => esc_html__( 'Line size', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Select', 'custom-widgets' ),
					'cz_road_0px' => esc_html__( '0px', 'custom-widgets' ),
                    'cz_road_1px' => esc_html__( '1px', 'custom-widgets' ),
                    'cz_road_2px' => esc_html__( '2px', 'custom-widgets' ),
                    'cz_road_3px' => esc_html__( '3px', 'custom-widgets' ),
                    'cz_road_4px' => esc_html__( '4px', 'custom-widgets' ),
                    'cz_road_5px' => esc_html__( '5px', 'custom-widgets' ),
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'section_indicator',
            [
                'label' => esc_html__( 'INDICATOR', 'custom-widgets' )
            ]
        );

        $this->add_control(
			'type',
			[
				'label' => esc_html__( 'Type', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => esc_html__( 'Icon', 'custom-widgets' ),
					'number' => esc_html__( 'Number', 'custom-widgets' ),
                    'image' => esc_html__( 'Image', 'custom-widgets' ),
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
                    'type' => 'icon',
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
                    'type' => 'image',
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
                'default' => esc_html__( '1', 'custom-widgets' ),
                'placeholder' => esc_html__( '1', 'custom-widgets' ),
                'condition' => [
                    'type' => 'number',
                ],
            ]
        );

        $this->add_control(
			'icon_style',
			[
				'label' => esc_html__( 'Style', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cz_road_icon_rhombus',
				'options' => [
					'cz_road_icon_rhombus' => esc_html__( 'Rhombus', 'custom-widgets' ),
					'cz_road_icon_rhombus_2' => esc_html__( 'Rhombus Radius', 'custom-widgets' ),
                    'cz_road_icon_rhombus_3' => esc_html__( 'Pin', 'custom-widgets' ),
                    'cz_road_icon_custom' => esc_html__( 'Custom', 'custom-widgets' ),
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
			'line_border-color',
			[
				'label' => esc_html__( 'Line color', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

        $this->add_control(
			'sk_icon',
			[
				'label' => esc_html__( 'Icon styling', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);
        $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings_for_display();
        
		$custom = $settings['line_height'];
		//$custom .= $settings['line_border-color'] ? 'border-color:' . $settings['line_border-color'] . ';' : '';
		//$custom .= '<div style="line-border-style: ' . $settings['line_border-style'] . '"></div>';
		//$custom .= $settings['anim_delay'] ? 'animation-delay:' . $settings['anim_delay'] . ';' : '';

        //Icon
        $icon = ( $settings['type'] === 'icon' ) ? '<i class="' . Icons_Manager::render_icon( $settings['icon'] ) . '"></i>' : ( ( $settings['type'] === 'image' ) ? '<i><b>' . str_replace( '/>', $size . '>',  \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings )  ) . '</b></i>' : '<i><span>' . $settings['number'] . '</span></i>' );

        // Classes
		$classes = array();
		$classes[] = 'cz_process_road';
		$classes[] = $settings['road'];
		$classes[] = $settings['icon_style'];
		$classes[] = $settings['line_size'];

        ?>
        <div <?php echo xtra_elementor_classes( $classes ); ?>>
        <?php echo $icon; ?>
	    <div class="cz_process_road_a"></div>
	    <div class="cz_process_road_b"></div>
        </div>
        <?php
    }

    public function _content_template() {
        ?>
        <#
        if ( settings.image.url ) {
			var image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.image_size,
				dimension: settings.image_custom_dimension,
				model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image );

			if ( ! image_url ) {
				return;
			}
		}

        var classes = 'cz_process_road', 
                classes = settings.road ? classes + ' ' + settings.road : classes;
                classes = settings.icon_style ? classes + ' ' + settings.icon_style : classes;
                classes = settings.line_size ? classes + ' ' + settings.line_size : classes;

            var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' ),
			migrated = elementor.helpers.isIconMigrated( settings, 'icon' );

            view.addInlineEditingAttributes( 'number', 'basic' );


        var size = '';

        var imageHTML = '<img src="' + image_url + '" />';

        var icon = ( settings.type === 'icon' ) ? '<i class="' + iconHTML.value + '"></i>' : ( ( settings.type === 'image' ) ? '<i><b>' + imageHTML.replace( '/>', size + '>' ) + '</b></i>' : '<i><span>' + settings.number + '</span></i>' );
        #>

        <div class="{{{classes}}}">
        {{{ icon }}}
	    <div class="cz_process_road_a"></div>
	    <div class="cz_process_road_b"></div>
        </div>
        <?php
    }
}