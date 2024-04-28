<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_icon extends Widget_Base {

    protected $id = 'cz_icon';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Icon', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'eicon-favorite';
    }

    public function get_categories() {
        return [ 'xtra' ];
    }

    public function _register_controls() {
        $this->start_controls_section(
                'section_content',
                [
                    'label' => 'Icon Settings',
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
    
            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'icon',
                [
                    'label' => esc_html__( 'Icon', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fa fa-facebook',
                        'library' => 'solid',
                    ],
                ]
            );

            $repeater->add_control(
                'title', [
                    'label' => esc_html__( 'Title', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'link',
                [
                    'label' => __( 'Link', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => __( 'https://your-link.com', 'custom-widgets' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'link_target',
                [
                    'label' => esc_html__( 'Open in same page?', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'custom-widgets' ),
                    'label_off' => __( 'No', 'custom-widgets' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'social',
                [
                    'label' => esc_html__( 'Add icon(s)', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'icon' => esc_html__( 'fa fa-facebook', 'custom-widgets' ),
                            'title' => esc_html__( '', 'custom-widgets' ),
                            'link' => esc_html__( '#' , 'custom-widgets'),
                            'link_target' => esc_html__( '' , 'custom-widgets'),
                        ],
                    ],
                    // 'title_field' => '{{{ list_title }}}',
                ]
            );
    
            $this->end_controls_section();

            $this->start_controls_section(
                'cz_title',
                [
                    'label' => esc_html__( 'SETTINGS', 'custom-widgets' ),
                ],
            );

            $this->add_control(
                'position',
                [
                    'label' => esc_html__( 'Position', 'custom-widgets' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'tal',
                    'options' => [
                        'tal' => esc_html__( 'Left', 'custom-widgets' ),
                        'tac' => esc_html__( 'Center', 'custom-widgets' ),
                        'tar' => esc_html__( 'Right', 'custom-widgets' ),
                    ],
                ],
            );

            $this->add_control(
                'tooltip',
                [
                    'label' => esc_html__( 'Tooltip?', 'custom-widgets' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__( 'Select', 'custom-widgets' ),
                        'cz_tooltip cz_tooltip_up' => esc_html__( 'Up', 'custom-widgets' ),
                        'cz_tooltip cz_tooltip_down' => esc_html__( 'Down', 'custom-widgets' ),
                        'cz_tooltip cz_tooltip_left' => esc_html__( 'Left', 'custom-widgets' ),
                        'cz_tooltip cz_tooltip_right' => esc_html__( 'Right', 'custom-widgets' ),
                    ],
                ],
            );

            $this->add_control(
                'fx',
                [
                    'label' => esc_html__( 'Hover effect', 'custom-widgets' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__( 'Select', 'custom-widgets' ),
                        'cz_social_fx_0' => esc_html__( 'ZoomIn', 'custom-widgets' ),
                        'cz_social_fx_1' => esc_html__( 'ZoomOut', 'custom-widgets' ),
                        'cz_social_fx_2' => esc_html__( 'Bottom to Top', 'custom-widgets' ),
                        'cz_social_fx_3' => esc_html__( 'Top to Bottom', 'custom-widgets' ),
                        'cz_social_fx_4' => esc_html__( 'Left to Right', 'custom-widgets' ),
                        'cz_social_fx_5' => esc_html__( 'Right to Left', 'custom-widgets' ),
                        'cz_social_fx_6' => esc_html__( 'Rotate', 'custom-widgets' ),
                        'cz_social_fx_7' => esc_html__( 'Infinite Shake', 'custom-widgets' ),
                        'cz_social_fx_8' => esc_html__( 'Infinite Wink', 'custom-widgets' ),
                        'cz_social_fx_9' => esc_html__( 'Quick Bob', 'custom-widgets' ),
                        'cz_social_fx_10' => esc_html__( 'Flip Horizontal', 'custom-widgets' ),
                        'cz_social_fx_11' => esc_html__( 'Flip Vertical', 'custom-widgets' ),
                    ],
                ],
            );

            $this->add_control(
                'inline_title',
                [
                    'label' => esc_html__( 'Inline title?', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'custom-widgets' ),
                    'label_off' => __( 'No', 'custom-widgets' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'color_mode',
                [
                    'label' => esc_html__( 'Social icons color', 'custom-widgets' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__( 'Select', 'custom-widgets' ),
                        'cz_social_colored' => esc_html__( 'Original colors', 'custom-widgets' ),
                        'cz_social_colored_hover' => esc_html__( 'Original colors on hover', 'custom-widgets' ),
                        'cz_social_colored_bg' => esc_html__( 'Original background', 'custom-widgets' ),
                        'cz_social_colored_bg_hover' => esc_html__( 'Original background on hover', 'custom-widgets' ),
                    ],
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
                'sk_con',
                [
                    'label' => esc_html__( 'Container', 'custom-widgets' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_ACCENT,
                    ],
                ]
            );

            $this->add_control(
                'sk_icons',
                [
                    'label' => esc_html__( 'Icons', 'custom-widgets' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_ACCENT,
                    ],
                ]
            );

            $this->add_control(
                'sk_inner_icon',
                [
                    'label' => esc_html__( 'Inner icons', 'custom-widgets' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_ACCENT,
                    ],
                ]
            );

            $this->add_control(
                'sk_title',
                [
                    'label' => esc_html__( 'Inline title', 'custom-widgets' ),
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

        // if ( $settings['social'] ) {
		// 	echo '<dl>';
		// 	foreach (  $settings['social'] as $item ) {
		// 		<?php echo '<dt class="elementor-repeater-item-' . $item['_id'] . '">' . $item['icon'] . '</dt>';
		// 		echo '<dd>' . $item['title'] . '</dd>';
        //         echo '<dd>' . $item['link'] . '</dd>';
        //         echo '<dd>' . $item['link_target'] . '</dd>';
		// 	}
		// 	echo '</dl>';
		// }

        $inline_title = $settings['inline_title'] ? 'cz_social_inline_title' : '';

        $social_icons =( $settings['social'] );

        $social = '';
		foreach ( $social_icons as $i ) {
			if ( empty( $i['icon'] ) ) {
				continue;
			}
			$i['title'] = empty( $i['title'] ) ? '' : $i['title'];
			//$social_class = 'cz-' . str_replace( $social_fa_upgrade, '', '' );
			$i['link'] = empty( $this->get_render_attribute_string( 'link' ) ) ? '' : ' href="' . $this->get_render_attribute_string( 'link' ) . '" rel="noreferrer"';
			$target = empty( $i['link_target'] ) ? ' target="_blank" ' : '';
			$social .= '<a' . $this->get_render_attribute_string( 'link' ) . ' class="' . '' . '"' . $target . ( $settings['tooltip'] ? 'data-' : '' ) . 'title="' . $i['title'] . '"' . ( $i['title'] ? ' aria-label="' . ( $i['title'] ) . '"' : '' ) . '><i class="' . Icons_Manager::render_icon( $i['icon'] ) . '">' . ( $inline_title ? '<span class="ml10">' . $i['title'] . '</span>' : '' ) . '</i></a>';
		}

        // Classes
		$classes = array();
		$classes[] = 'cz_social_icons cz_social clr';
		$classes[] = $inline_title;
		$classes[] = $settings['fx'];
		$classes[] = $settings['position'];
		$classes[] = $settings['color_mode'];
		$classes[] = $settings['tooltip'];
		// $classes[] = $settings['center_on_mobile'] ? 'center_on_mobile' : '';
        
        ?>
        <div <?php echo xtra_elementor_classes( $classes ); ?> ><?php echo $social ?></div>
        <?php
    }

    public function _content_template() {
        ?>
        <#
        _.each( settings.social, function( item, index ) {
            
        });
        #>
        <?php
    }
}