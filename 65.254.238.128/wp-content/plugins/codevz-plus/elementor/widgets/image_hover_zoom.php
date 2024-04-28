<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_image_hover_zoom extends Widget_Base {

    protected $id = 'cz_image_hover_zoom';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Image Hover', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'eicon-image';
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
            'section_ihz',
            [
                'label' => 'Image Hover Zoom Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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

        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
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
			'section_styling',
			[
				'label' => esc_html__( 'STYLING', 'custom-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'sk_css',
			[
				'label' => esc_html__( 'Container styling', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'svg_bg',
			[
				'label' => esc_html__( 'Background layer', 'custom-widgets' ),
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
        // Image
		$img = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings );
		$link = '<img src="' . $settings['image']['url'] . '">';
		
		// Classes
		$classes = array();
		$classes[] = 'cz_image_hover_zoom';
		$classes[] = $settings['svg_bg'] ? 'cz_svg_bg' : '';

        ?>
        <div <?php echo xtra_elementor_classes( $classes );?>> 
	    <div> <a href="<?php echo $link; ?>"><?php echo $img;?></a>
	    </div>
        </div>
        <?php
    }

    public function content_template() {
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

        var classes = 'cz_image_hover_zoom', 
                classes = settings.svg_bg ? classes + ' ' + settings.svg_bg : classes;

        var img = '<img src="' + image_url + '">';
		var link = 'settings.image.url'; 
        #>
        <div class="{{{classes}}}"> 
	    <div> <a href="{{{link}}}">{{{img}}}</a>
	    </div>
        </div>
        <?php
    }
}