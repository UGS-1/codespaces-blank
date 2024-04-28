<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_before_after extends Widget_Base {
	
	protected $id = 'cz_before_after';

    public function get_name() {
		return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Before After', 'custom-widgets' );
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
    public function get_script_depends() {
        return [ $this->id ];
    }
    public function _register_controls() {
        $this->start_controls_section(
			'section_ba',
			[
				'label' => esc_html__( 'Before After Settings', 'custom-widgets' ),
			]
		);

        $this->add_control(
			'image_2',
			[
				'label' => esc_html__( 'Before Image', 'custom-widgets' ),
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
            'title_2',
            [
                'label' => esc_html__('Before Title','custom-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Before',
                'placeholder' => 'Before'
            ],
        );

        $this->add_control(
			'image_1',
			[
				'label' => esc_html__( 'After Image', 'custom-widgets' ),
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
            'title_1',
            [
                'label' => esc_html__('After title','custom-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'after',
                'placeholder' => 'after'
            ],
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
				'label' => __( 'Container', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'handle',
			[
				'label' => __( 'Handle', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'title',
			[
				'label' => __( 'Title', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
                ],
			]
		);

        $this->add_control(
			'background_layer',
			[
				'label' => __( 'Background Layer', 'custom-widgets' ),
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
		if ( empty( $settings['image_2']['url'] ) ) {
			return;
		}

		if ( empty( $settings['image_1']['url'] ) ) {
			return;
		}
        // Images
		$img1 = $settings['image_1'];
		$img2 = $settings['image_2'];

		// Classes
		$classes = array();
		$classes[] = 'cz_image_comparison_slider';
		//$classes[] = $settings['svg_bg'] ? 'cz_svg_bg' : '';
        ?>
        <div <?php echo Codevz_Plus::classes( [], $classes );  ?>>
	    <figure class="cz_image_container is_visible"><?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_1' ); ?><span class="cz_image_label" data-type="original"><?php echo $settings['title_1']; ?></span>
		<div class="cz_resize_img"><?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_2' ); ?><span class="cz_image_label" data-type="modified"><?php echo $settings['title_2']; ?></span>
		</div>	<span class="cz_handle"></span>
	    </figure>
        </div>
        <?php
    }

    public function _content_template() {
        ?>
        <#
		if ( settings.image_2.url ) {
			var image_2 = {
				id: settings.image_2.id,
				url: settings.image_2.url,
				size: settings.image_size,
				dimension: settings.image_custom_dimension,
				model: view.getEditModel()
			};

			var image_url_2 = elementor.imagesManager.getImageUrl( image_2 );

			if ( ! image_url_2 ) {
				return;
			}
		}

		view.addRenderAttribute( 'title_2', 'class', 'xtra-before-title' );
		view.addInlineEditingAttributes( 'title_2', 'none' );

		if ( settings.image_1.url ) {
			var image_1 = {
				id: settings.image_1.id,
				url: settings.image_1.url,
				size: settings.image_size,
				dimension: settings.image_custom_dimension,
				model: view.getEditModel()
			};

			var image_url_1 = elementor.imagesManager.getImageUrl( image_1 );

			if ( ! image_url_1 ) {
				return;
			}
		}

		
		view.addRenderAttribute( 'title_1', 'class', 'xtra-after-title' );
		view.addInlineEditingAttributes( 'title_1', 'none' );
        #>
        <div>
	    <figure class="cz_image_container is_visible"> <img src="{{ image_url_1 }}"/> <span class="cz_image_label" data-type="original">{{{settings.title_1}}}</span>
		<div class="cz_resize_img"> <img src="{{ image_url_2 }}"/><span class="cz_image_label" data-type="modified">{{{settings.title_2}}}</span>
		</div>	<span class="cz_handle"></span>
	    </figure>
        </div>
        <?php
    }
}