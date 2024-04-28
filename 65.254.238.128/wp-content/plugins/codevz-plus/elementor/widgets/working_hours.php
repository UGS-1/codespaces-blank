<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_working_hours extends Widget_Base {

	protected $id = 'cz_working_hours';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Working Hours', 'custom-widgets' );
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
                'label' => 'Working Hours Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'left_text', [
				'label' => esc_html__( 'Left text', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Monday' , 'custom-widgets' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'right_text', [
				'label' => esc_html__( 'Right text', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '9:00 to 16:30t' , 'custom-widgets' ),
				'show_label' => true,
			]
		);

		$repeater->add_control(
			'sub', [
				'label' => esc_html__( 'Subtitle', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'show_label' => true,
			]
		);

        $repeater->add_control(
			'badge', [
				'label' => esc_html__( 'Badge', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'show_label' => true,
			]
		);

        $repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Items', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'left_text' => esc_html__( 'Monday', 'custom-widgets' ),
						'right_text' => esc_html__( '9:00 to 16:30t', 'custom-widgets' ),
                        'sub' => esc_html__( '' , 'custom-widgets'),
					],
					[
						'badge' => __( '', 'custom-widgets' ),
						'icon' => __( '', 'custom-widgets' ),
					],
				],
				// 'title_field' => '{{{ list_title }}}',
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
			'between_texts',
			[
				'label' => esc_html__( 'Line between texts?', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'custom-widgets' ),
				'label_off' => __( 'No', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
			'sk_con',
			[
				'label' => esc_html__( 'Container', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);
        
        $this->add_control(
			'sk_line',
			[
				'label' => esc_html__( 'Line', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

        $this->add_control(
			'sk_left',
			[
				'label' => esc_html__( 'Left text', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

        $this->add_control(
			'sk_right',
			[
				'label' => esc_html__( 'Right text', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

        $this->add_control(
			'sk_badge',
			[
				'label' => esc_html__( 'Badge', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

        $this->add_control(
			'sk_sub',
			[
				'label' => esc_html__( 'Sub title', 'custom-widgets' ),
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
				'label' => esc_html__( 'Icon', 'custom-widgets' ),
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

        $classes = array();
		$classes[] = 'cz_wh';
		$classes[] = $settings['between_texts'] ? 'cz_wh_line_between' : '';
		$content = isset( $settings['content'] ) ?  $settings['content'] : '';
			// Out
			echo '<div' . xtra_elementor_classes( $classes ) . '>';
		
			// Content.
			echo $content ? '<p>' . do_shortcode( $content ) . '</p>' : '';
	
			// Description.
			$content = $content ? '<p class="xtra-working-hours-content">' . do_shortcode( $content ) . '</p>' : '';
	
			// Group.
			$items = $settings['items'];
			foreach ( $items as $i ) {
				$icon 	= empty( $i['icon'] ) ? '' : '<i class="' . Icons_Manager::render_icon( $i['icon'] ) . ' mr8"></i>';
				$badge 	= empty( $i['badge'] ) ? '' : '<small>' . $i['badge'] . '</small>';
				$sub 	= empty( $i['sub'] ) ? '' : '<span class="cz_wh_sub">' . $i['sub'] . '</span>';
				$left 	= empty( $i['left_text'] ) ? '' : '<span class="cz_wh_left">' . $icon . '<b>' . $i['left_text'] . '</b>' . $badge . $sub . '</span>';
				$right 	= empty( $i['right_text'] ) ? '' : '<span class="cz_wh_right">' . $i['right_text'] . '</span>';
	
				echo '<div class="mb10 last0 clr"><div class="clr">' . $left . $right . '</div><div class="cz_wh_line"></div></div>';
			}
			echo '</div>';
    }

    public function content_template() {
		?>
		<#
		
		
		var classes = 'cz_wh', 
                classes = settings.between_texts ? classes + ' ' + settings.between_texts : classes;
                classes = settings.content ? classes + ' ' + settings.content : classes;
		

		 var items = settings.items;
		 var html = ''; 
		 var i;
		 _.each( settings.social, function( item, index ) {
			var icon 	= ( i.icon ) ? '' : '<i class="' + '' + ' mr8"></i>';
			var badge 	= ( i.badge ) ? '' : '<small>' + i.badge + '</small>';
			var sub 	= ( i.sub ) ? '' : '<span class="cz_wh_sub">' + i.sub + '</span>';
			var left 	= ( i.left_text ) ? '' : '<span class="cz_wh_left">' + icon + '<b>' + i.left_text + '</b>' + badge + sub + '</span>';
			var right 	= ( i.right_text ) ? '' : '<span class="cz_wh_right">' + i.right_text + '</span>';

			html = html + '<div class="mb10 last0 clr"><div class="clr">' + left + right + '</div><div class="cz_wh_line"></div></div>';
        });
		#>
		<div class="{{{classes}}}">
		{{{html}}}
		</div>
		<?php

    }
}