<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_image extends Widget_Base { 

	protected $id = 'cz_image';

    public function get_name() {
		return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Image', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'eicon-image';
    }

    public function get_categories() {
        return [ 'xtra' ];
    }

    public function get_keywords() {
		return [ 'image', 'photo', 'visual' ];
	}

    protected function register_controls() {
        $this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image', 'custom-widgets' ),
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
			]
		);

        $this->add_control(
            'fx_hover',
            [
                'label' => esc_html__( 'Hover effect', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Select', 'custom-widgets' ),
                    'simple_fade' => esc_html__( 'Simple Fade', 'custom-widgets' ),
                    'flip_horizontal' => esc_html__( 'Flip Horizontal', 'custom-widgets' ),
                    'flip_vertical' => esc_html__( 'Flip Vertical', 'custom-widgets' ),
                    'fade_to_top' => esc_html__( 'Fade To Top', 'custom-widgets' ),
                    'fade_to_bottom' => esc_html__( 'Fade To Bottom', 'custom-widgets' ),
                    'fade_to_left' => esc_html__( 'Fade To Left', 'custom-widgets' ),
                    'fade_to_right' => esc_html__( 'Fade To Right', 'custom-widgets' ),
                    'zoom_in' => esc_html__( 'Zoom In', 'custom-widgets' ),
                    'zoom_out' => esc_html__( 'Zoom Out', 'custom-widgets' ),
                    'blurred' => esc_html__( 'Blurred', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
			'hover_image',
			[
				'label' => esc_html__( 'Hover Image', 'custom-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => false,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'condition' => [
					'fx_hover' => 'simple_fade',
				],
			]
		); 
        
        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
			]
		);

        $this->add_control(
            'css_position',
            [
                'label' => esc_html__( 'Image Position', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'select',
                'options' => [
                    'inline' => esc_html__( 'Inline', 'custom-widgets' ),
                    'block' => esc_html__( 'Block', 'custom-widgets' ),
                    'left' => esc_html__( 'Left', 'custom-widgets' ),
                    'center' => esc_html__( 'Center', 'custom-widgets' ),
                    'right' => esc_html__( 'Right', 'custom-widgets' ),
                    'left (center_in_m)' => esc_html__( 'Left (center_in_mobile)', 'custom-widgets' ),
                    'right (center_in_m)' => esc_html__( 'Right (center_in_mobile)', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
			'link_type',
			[
				'label' => esc_html__( 'Link Type', 'custom-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'None', 'custom-widgets' ),
					'lightbox' => __( 'Link to large image (Lightbox)', 'custom-widgets' ),
					'custom' => __( 'Custom', 'custom-widgets' ),
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
				'condition' => [
					'link_type' => 'custom',
				],
				'show_label' => false,
			]
		);

        $this->add_control(
            'tooltip',
            [
                'label' => esc_html__('Tooltip','custom-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
            'section_caption',
            [
                'label' => esc_html__( 'CAPTION', 'custom-widgets' )
            ]
        );

		$this->add_control(
            'content',
            [
                'label' => esc_html__('Caption','custom-widgets'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => ''
            ]
        );

		$this->add_control(
			'sticky_caption',
			[
				'label' => esc_html__( 'Sticky on mouse hover?', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'custom-widgets' ),
				'label_off' => esc_html__( 'No', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'smart_fs',
			[
				'label' => esc_html__( 'Mobile smart font size?', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'custom-widgets' ),
				'label_off' => __( 'No', 'custom-widgets' ),
				'return_value' => 'no',
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
			'section_style_image',
			[
				'label' => __( 'Image', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'css_width',
			[
				'label' => esc_html__( 'Custom Width', 'custom-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 50,
						'max' => 500,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xtra-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'sk_css',
			[
				'label' => __( 'Image styling', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .xtra-elements-gt' => 'sk_css: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'svg_bg',
			[
				'label' => __( 'Background layer', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .xtra-elements-gt' => 'svg_bg: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sk_caption',
			[
				'label' => __( 'Caption styling', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .xtra-elements-gt' => 'sk_caption: {{VALUE}};',
				],
			]
		);
    }

	public function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['image']['url'] ) ) {
			return;
		}
		$link = $this->get_link_url( $settings );
		if ( $link ) {
			$this->add_link_attributes( 'link', $link );

			if ( Plugin::$instance->editor->is_edit_mode() ) {
				$this->add_render_attribute( 'link', [
					'class' => 'xtra-elementor-clickable',
				] );
			}

			if ( 'custom' !== $settings['link_type'] ) {
				$this->add_lightbox_data_attributes( 'link', $settings['image']['id']);
			}
		}
		$classes = array();
		$classes[] = 'cz_image clr';
		$classes[] = $settings['fx_hover'];
		$classes[] = $settings['smart_fs'] ? 'cz_smart_fs' : '';
		$classes[] = $settings['tooltip'] ? 'cz_tooltip_up' : '';
		$classes[] = $settings['sticky_caption'] ? 'cz_image_caption_sticky' : '';
		$classes[] = ( $settings['css_position'] === 'relative' ) ? 'center_on_mobile' : '';

		$tooltip = $settings['tooltip'] ? ' data-title="' . $settings['tooltip'] . '"' : '';
		?>
		<div <?php  echo xtra_elementor_classes($classes); ?>>
		<div <?php echo  $tooltip; ?> <?php echo xtra_elementor_tilt( $settings ); ?>>
		<?php if ( $link ) : ?>
					<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
		<?php endif; ?>
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
		<?php if ( $link ) : ?>
					</a>
		<?php endif; ?>
		<?php echo  $settings['content'] ; ?>
		</div></div>
		<?php
	}

	protected function _content_template(){
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

		var link_url;

			if ( 'custom' === settings.link_type ) {
				link_url = settings.link.url;
			}

			if ( 'file' === settings.link_type ) {
				link_url = settings.image.url;
			}

			#>
			<div class="cz_image clr " >
			<div data-title="  {{ settings.tooltip }}  ">
			<#
			if ( link_url ) {
					#><a class="xtra-elementor-clickable" href="{{ link_url }}"><#
			}
						#><img src="{{ image_url }}"/><#

			if ( link_url ) {
					#></a><#
			}
		#>
		<#
		#>{{{ settings.content }}}<#
		
		#><#
		#>
		</div></div>
		<?php
	}

	private function get_link_url( $settings ) {
		if ( 'none' === $settings['link_type'] ) {
			return false;
		}

		if ( 'custom' === $settings['link_type'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}

			return $settings['link'];
		}

		return [
			'url' => $settings['image']['url'],
		];
	}
}

