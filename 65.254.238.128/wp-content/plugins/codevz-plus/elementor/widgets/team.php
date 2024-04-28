<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_team extends Widget_Base {

    protected $id = 'cz_team';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Team Member', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'fa fa-clock';
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
            'section_content',
            [
                'label' => 'Team Member Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'style',
			[
				'label' => esc_html__( 'Style', 'codevz' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cz_team_1',
				'options' => [
					'cz_team_1'  => esc_html__( 'No hover', 'codevz' ),
					'cz_team_2' => esc_html__( 'Social icons on image', 'codevz' ),
					'cz_team_3' => esc_html__( 'Social icons on image 2', 'codevz' ),
					'cz_team_4' => esc_html__( 'Social and title on image', 'codevz' ),
					'cz_team_5' => esc_html__( 'Social and title on image 2', 'codevz' ),
					'cz_team_6' => esc_html__( 'Only title on mouse moves', 'codevz' ),
                    'cz_team_7' => esc_html__( 'Title on mouse moves and social below image', 'codevz' ),
				],
			]
		);

        $this->add_control(
			'hover_mode',
			[
				'label' => esc_html__( 'Hover mode?', 'codevz' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => esc_html__( 'Selcet', 'codevz' ),
					'cz_team_rev_hover' => esc_html__( 'Reverse hover mode', 'codevz' ),
					'cz_team_always_show' => esc_html__( 'Always show details', 'codevz' ),
				],
                'condition' => [
                    'style' => [ 'cz_team_1', 'cz_team_6', 'cz_team_7' ],
                ],
			]
		);

        $this->add_control(
			'image',
			[
				'label' => __( 'Image', 'codevz' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => 'https://xtratheme.com/img/450x450.jpg',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image',
				'default' => 'large',
				'separator' => 'none',
			]
		);

        $this->add_control(
            'content',
            [
                'label' => esc_html__('Name and job title','custom-widgets'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<h4><strong>John Carter</strong></h4><span style="color: #999999;">Developer</span>',
                'placeholder' => '<h4><strong>John Carter</strong></h4><span style="color: #999999;">Developer</span>',
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
				'show_label' => true,
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'codevz' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'sk_overall',
			[
				'label' => esc_html__( 'Container', 'custom-widgets' ),
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

        $this->add_control(
			'sk_image_con',
			[
				'label' => esc_html__( 'Image container', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_image_img',
			[
				'label' => __( 'Image', 'custom-widgets' ),
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

        $this->end_controls_section();

        $this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'codevz' ),
			]
		);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				// 'default' => [
				// 	'value' => 'fas fa-star',
				// 	'library' => 'solid',
				// ],
			]
		);

        $repeater->add_control(
			'title', 
            [
				'label' => esc_html__( 'Title', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

        $repeater->add_control(
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
			'social',
			[
				'label' => esc_html__( 'Social', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'icon' => esc_html__( '', 'custom-widgets' ),
						'title' => esc_html__( '', 'custom-widgets' ),
                        'link' => esc_html__( 'https://your-link.com' , 'custom-widgets'),
					],
				],
				// 'title_field' => '{{{ list_title }}}',
			]
		);
        
        $this->add_control(
			'color_mode',
			[
				'label' => esc_html__( 'Color mode?', 'codevz' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => esc_html__( 'Selcet', 'codevz' ),
					'cz_social_colored' => esc_html__( 'Original colors', 'codevz' ),
					'cz_social_colored_hover' => esc_html__( 'Original colors on hover', 'codevz' ),
                    'cz_social_colored_bg'  => esc_html__( 'Original background', 'codevz' ),
                    'cz_social_colored_bg_hover'  => esc_html__( 'Original background on hover', 'codevz' ),
				],
			]
		);

        $this->add_control(
			'social_tooltip',
			[
				'label' => esc_html__( 'Tooltip?', 'codevz' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => esc_html__( 'Selcet', 'codevz' ),
					'cz_tooltip cz_tooltip_up' => esc_html__( 'Up', 'codevz' ),
					'cz_tooltip cz_tooltip_down' => esc_html__( 'Down', 'codevz' ),
                    'cz_tooltip cz_tooltip_left'  => esc_html__( 'Righr', 'codevz' ),
                    'cz_tooltip cz_tooltip_right'  => esc_html__( 'Left', 'codevz' ),
				],
			]
		);

        $this->add_control(
			'social_align',
			[
				'label' => esc_html__( 'Position?', 'codevz' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => esc_html__( 'Default', 'codevz' ),
					'tal' => esc_html__( 'Left', 'codevz' ),
					'tac' => esc_html__( 'Right', 'codevz' ),
                    'tar'  => esc_html__( 'Center', 'codevz' ),
				],
			]
		);

        $this->add_control(
			'fx',
			[
				'label' => esc_html__( 'Hover effect?', 'codevz' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => esc_html__( 'Select', 'codevz' ),
					'cz_social_fx_0' => esc_html__( 'ZoomIn', 'codevz' ),
					'cz_social_fx_1' => esc_html__( 'ZoomOut', 'codevz' ),
                    'cz_social_fx_2'  => esc_html__( 'Bottom to Top', 'codevz' ),
                    'cz_social_fx_3'  => esc_html__( 'Top to Buttom', 'codevz' ),
                    'cz_social_fx_4'  => esc_html__( 'Left to Right', 'codevz' ),
                    'cz_social_fx_5'  => esc_html__( 'Right to Left', 'codevz' ),
                    'cz_social_fx_6'  => esc_html__( 'Rotate', 'codevz' ),
                    'cz_social_fx_7'  => esc_html__( 'Infinite Shake', 'codevz' ),
                    'cz_social_fx_8'  => esc_html__( 'Infinite Wink', 'codevz' ),
                    'cz_social_fx_9'  => esc_html__( 'Quick Bob', 'codevz' ),
                    'cz_social_fx_10'  => esc_html__( 'Flip Horizontal', 'codevz' ),
                    'cz_social_fx_11'  => esc_html__( 'Flip Vertical', 'codevz' ),
				],
			]
		);

        $this->add_control(
			'social_v',
			[
				'label' => esc_html__( 'Vertical mode?', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'custom-widgets' ),
				'label_off' => esc_html__( 'No', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
			'sk_social_con',
			[
				'label' => esc_html__( 'Container', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_icons_hover',
			[
				'label' => esc_html__( 'Icons', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
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

    }

    public function render() {
        $settings = $this->get_settings_for_display();
        //$this->add_link_attributes( 'link', $link );
        // Link 
		$a_attr = $settings['link'] ? $this->get_render_attribute_string( 'link' ) : '';

		// Image
		$img = Group_Control_Image_Size::get_attachment_image_html( $settings );
		if ( $a_attr ) {
			$img = '<a' . $a_attr . '>' . $img . '</a>';
		}

		// Title content
		$content = '<div class="cz_team_content cz_wpe_content">' . $settings['content'] . '</div>';
		if ( $a_attr ) {
			$content = '<a' . $a_attr . '>' . $content . '</a>';
		}

		// Social
		$social_icons = (array) vc_param_group_parse_atts( $settings['social'] );
		$social = '<div class="' . implode( ' ', array_filter( array( 'cz_team_social cz_social clr', $settings['color_mode'], $settings['fx'], $settings['social_align'], $settings['social_tooltip'] ) ) ) . '">';
		$social = '<div class="cz_team_social_in">';
		foreach ( $social_icons as $i ) {
			if ( ! empty( $i['icon'] ) ) {
				$class = 'cz-' . str_replace( Codevz_Plus::$social_fa_upgrade, '', $i['icon'] );

				$link = ( empty( $i['link'] ) ? '#' : $i['link'] );

				$target = ( Codevz_Plus::contains( $link, [ $_SERVER['HTTP_HOST'], 'tel:', 'mailto:' ] ) || $link === '#' ) ? '' : ' target="_blank"';

				$social = '<a href="' . esc_attr( $link ) . '" class="' . $class . '" ' . ( empty( $i['title'] ) ? '' : ( $settings['social_tooltip'] ? ' data-title' : ' title' ) . '="' . $i['title'] . '"' ) . $target . '><i class="' . $i['icon'] . '"></i></a>';
			}
		}
		$social .= '</div></div>';

        // Classes
		$classes = array();
		$classes[] = 'cz_team mb30 clr';
		$classes[] = $settings['hover_mode'];
		$classes[] = $settings['svg_bg'] ? 'cz_svg_bg' : '';
		$classes[] = $settings['style'];
		$classes[] = $settings['social_v'] ? 'cz_social_v' : '';

        ?>
        <div  <?php echo Codevz_Plus::classes( [], $classes );  ?>>
        <?php if ( empty( $settings['style'] ) || $settings['style'] === 'cz_team_1' ) {
			echo '<div class="cz_team_img"' . Codevz_Plus::tilt( $settings ) . '>' . $img . '</div>' . $content . $social;
		} else if ( $settings['style'] === 'cz_team_2' || $settings['style'] === 'cz_team_4' ) {
			echo '<div class="cz_team_img"' . Codevz_Plus::tilt( $settings ) . '>' . $img . $social . '</div>' . $content;
		} else if ( $settings['style'] === 'cz_team_3' || $settings['style'] === 'cz_team_5' ) {
			echo '<div class="cz_team_img"' . Codevz_Plus::tilt( $settings ) . '>' . $img . $content . $social . '</div>';
		} else if ( $settings['style'] === 'cz_team_6' ) {
			echo '<div class="cz_team_img"' . Codevz_Plus::tilt( $settings ) . '>' . $img . $content . '</div>';
		} else if ( $settings['style'] === 'cz_team_7' ) {
			echo '<div class="cz_team_img"' . Codevz_Plus::tilt( $settings ) . '>' . $img . $content . '</div>' . $social;
		}
        ?>
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

        view.addRenderAttribute( 'content', 'class', 'xtra-team-content' );
		view.addInlineEditingAttributes( 'content', 'none' );
		var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' ),
			migrated = elementor.helpers.isIconMigrated( settings, 'icon' );

        // Link 
		var a_attr = settings.link;

		// Image
		var img = '<img src="' + image_url + '">';
		if ( a_attr ) {
			 img = '<a + a_attr + >' + img + '</a>';
		}

        var content = '<div class="cz_team_content cz_wpe_content">' + settings.content + '</div>';
		if ( a_attr ) {
			content = '<a + a_attr + >' + content + '</a>';
		}

        var social_icons = settings.social;
        var social = '<div class="cz_team_social cz_social clr, settings.color_mode, settings.fx, settings.social_align, settings.social_toolti">';
        var social = '<div class="cz_team_social_in">';
        var social = '</div></div>';

        var classes = 'cz_team mb30 clr', 
                classes = settings.hover_mode ? classes + ' ' + settings.hover_mode : classes;
                classes = settings.svg_bg ? classes + ' ' + settings.svg_bg : classes;
                classes = settings.style ? classes + ' ' + settings.style : classes;
                classes = settings.social_v ? classes + ' ' + settings.social_v : classes;
        #>

        <div  class="{{{classes}}}">
        </div>

        <?php
    }


}