<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_banner extends Widget_Base { 

    protected $id = 'cz_banner';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Banner', 'custom-widgets' );;
    }
    
    public function get_icon() {
        return 'far fa-file-alt';
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
            'id',
            [
                'label' => 'Banner Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ],
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__( 'Style #1', 'custom-widgets' ),
                    'style2' => esc_html__( 'Style #2', 'custom-widgets' ),
                    'style3' => esc_html__( 'Style #3', 'custom-widgets' ),
                    'style4' => esc_html__( 'Style #4', 'custom-widgets' ),
                    'style5' => esc_html__( 'Style #5', 'custom-widgets' ),
                    'style6' => esc_html__( 'Style #6', 'custom-widgets' ),
                    'style7' => esc_html__( 'Style #7', 'custom-widgets' ),
                    'style8' => esc_html__( 'Style #8', 'custom-widgets' ),
                    'style9' => esc_html__( 'Style #9', 'custom-widgets' ),
                    'style10' => esc_html__( 'Style #10', 'custom-widgets' ),
                    'style11' => esc_html__( 'Style #11', 'custom-widgets' ),
                    'style12' => esc_html__( 'Style #12', 'custom-widgets' ),
                    'style13' => esc_html__( 'Style #13', 'custom-widgets' ),
                    'style14' => esc_html__( 'Style #14', 'custom-widgets' ),
                    'style15' => esc_html__( 'Style #15', 'custom-widgets' ),
                    'style16' => esc_html__( 'Style #16', 'custom-widgets' ),
                    'style17' => esc_html__( 'Style #17', 'custom-widgets' ),
                    'style18' => esc_html__( 'Style #18', 'custom-widgets' ),
                    'style19' => esc_html__( 'Style #19', 'custom-widgets' ),
                    'style20' => esc_html__( 'Style #20', 'custom-widgets' ),
                    'style21' => esc_html__( 'Style #21', 'custom-widgets' ),
                    'style22' => esc_html__( 'Style #22', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title','custom-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Your title'
            ],
        );
        
        $this->add_control(
            'content',
            [
                'label' => esc_html__('Caption','custom-widgets'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'Lorem ipsum dolor sit...'
            ],
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
			],
		);
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_image',
            [
                'label' => esc_html__( 'IMAGE', 'custom-widgets' )
            ],
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
			],
		);

        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
            ],
		);

        $this->add_control(
            'image_opacity',
            [
                'label' => esc_html__( 'Image opacity', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '0',
                'options' => [
                    '0' => esc_html__( '0', 'custom-widgets' ),
                    '0.1' => esc_html__( '0.1', 'custom-widgets' ),
                    '0.2' => esc_html__( '0.2', 'custom-widgets' ),
                    '0.3' => esc_html__( '0.3', 'custom-widgets' ),
                    '0.4' => esc_html__( '0.4', 'custom-widgets' ),
                    '0.5' => esc_html__( '0.5', 'custom-widgets' ),
                    '0.6' => esc_html__( '0.6', 'custom-widgets' ),
                    '0.7' => esc_html__( '0.7', 'custom-widgets' ),
                    '0.8' => esc_html__( '0.8', 'custom-widgets' ),
                    '0.9' => esc_html__( '0.9', 'custom-widgets' ),
                    '1' => esc_html__( '1', 'custom-widgets' ),
                ],
            ],
        );

        $this->add_control(
            'image_hover_opacity',
            [
                'label' => esc_html__( 'Image hover opacity', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '0' => esc_html__( '0', 'custom-widgets' ),
                    '0.1' => esc_html__( '0.1', 'custom-widgets' ),
                    '0.2' => esc_html__( '0.2', 'custom-widgets' ),
                    '0.3' => esc_html__( '0.3', 'custom-widgets' ),
                    '0.4' => esc_html__( '0.4', 'custom-widgets' ),
                    '0.5' => esc_html__( '0.5', 'custom-widgets' ),
                    '0.6' => esc_html__( '0.6', 'custom-widgets' ),
                    '0.7' => esc_html__( '0.7', 'custom-widgets' ),
                    '0.8' => esc_html__( '0.8', 'custom-widgets' ),
                    '0.9' => esc_html__( '0.9', 'custom-widgets' ),
                    '1' => esc_html__( '1', 'custom-widgets' ),
                ],
            ],
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_parallax',
            [
                'label' => esc_html__( 'PARALLAX', 'custom-widgets' ),
            ],
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
            ],
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
                'condition' => [
                    'parallax' => 'vertical',
                    'parallax' => 'vertical + mouse parallax',
                    'parallax' => 'horizontal',
                    'parallax' => 'horizontal + mouse parallax',
                ],
                'separator' => 'before',
			],
        );
        
        $this->add_control(
			'parallax_stop',
			[
				'label' => esc_html__( 'Stop when done', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'custom-widgets' ),
				'label_off' => __( 'Hide', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition' => [
                    'parallax' => 'vertical',
                    'parallax' => 'vertical + mouse parallax',
                    'parallax' => 'horizontal',
                    'parallax' => 'horizontal + mouse parallax',
                ],
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
                'condition' => [
                    'parallax' => 'vertical + mouse parallax',
                    'parallax' => 'horizontal + mouse parallax',
                ],
                'separator' => 'before',
			]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_tilt',
            [
                'label' => esc_html__( 'TILT EFFECT ON HOVER', 'custom-widgets' )
            ]
        );

		$this->add_control(
            'banner_tilt',
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
            'banner_glare',
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
            'banner_scale',
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
                'label' => __( 'Style', 'custom-widgets' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'sk_box',
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
				'label' => __( 'Title', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_caption',
			[
				'label' => __( 'Caption', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
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
			]
		);
        $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings_for_display();
        $this->add_link_attributes( 'link', $settings['link'] );
        $image =  $settings['image'];

        //$content = do_shortcode( Codevz_Plus::fix_extra_p( $content ) );
		$content = $settings['content'] ? '<p class="cz_wpe_content">' . $settings['content'] . '</p>' : '';
		// Classes
		$classes = array();
		$classes[] = 'cz_banner clr';
		$classes[] = $settings['svg_bg'] ? 'cz_svg_bg' : '';
		//$classes[] = $settings['text_center'] ? 'cz_mobile_text_center' : '';
        ?>
        <div <?php echo Codevz_Plus::classes( [], $classes );  ?>>
	        <figure class="effect-<?php echo $settings['style']; ?>">
            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image' ); ?>
		        <figcaption>
			    <div>
				    <h4><?php echo $settings['title']; ?>
                    </h4><?php echo $settings['content']; ?>
                </div> 
                <?php echo $this->get_render_attribute_string( 'link' ); ?>
                </figcaption>
	            </figure>
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

        var classes = 'cz_banner clr', 
                classes = settings.svg_bg ? classes + ' ' + settings.svg_bg : classes;

        view.addRenderAttribute( 'title', 'class', 'xtra-banner-title' );
		view.addInlineEditingAttributes( 'title', 'none' );
        #>

        <div class="cz_banner clr">
	        <figure class="effect-{{{settings.style}}}">
                <img src="{{ image_url }}"/>
		        <figcaption>
			    <div>
				    <h4>{{{settings.title}}}
                    </h4>{{{settings.content}}}
                </div> 
                {{{settings.link.url}}}
                </figcaption>
	        </figure>
        </div>
        <?php
    }
}