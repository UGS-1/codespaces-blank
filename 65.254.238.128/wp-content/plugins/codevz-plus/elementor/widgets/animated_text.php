<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_animated_text extends Widget_Base {

    protected $id = 'cz_animated_text';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Animated Text', 'custom-widgets' );
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
    public function get_script_depends() {
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
            'before_text',
            [
                'label' => esc_html__('Prefix','custom-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'This is'
            ]
        );

        $this->add_control(
            'words',
            [
                'label' => esc_html__('Words','custom-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Awesome,Fantastic,Wonderful',
            ]
        );

        $this->add_control(
            'after_text',
            [
                'label' => esc_html__('Suffix','custom-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Theme!'
            ]
        );

        $this->add_control(
            'fx',
            [
                'label' => esc_html__( 'Effect', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'rotate-1',
                'options' => [
                    'rotate-1' => esc_html__( 'Rotate 1', 'custom-widgets' ),
                    'letters_type' => esc_html__( 'Type', 'custom-widgets' ),
                    'letters_rotate-2' => esc_html__( 'Rotate 2', 'custom-widgets' ),
                    'loading-bar' => esc_html__( 'Bar', 'custom-widgets' ),
                    'slide' => esc_html__( 'Slide', 'custom-widgets' ),
                    'clip_is-full-width' => esc_html__( 'Clip', 'custom-widgets' ),
                    'zoom' => esc_html__( 'Zoom', 'custom-widgets' ),
                    'letters_rotate-3' => esc_html__( 'Rotate 3', 'custom-widgets' ),
                    'letters_scale' => esc_html__( 'Scale', 'custom-widgets' ),
                    'push' => esc_html__( 'Push', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
            'tag',
            [
                'label' => esc_html__( 'Html tag', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h2' => esc_html__( 'H2', 'custom-widgets' ),
                    'h1' => esc_html__( 'H1', 'custom-widgets' ),
                    'h3' => esc_html__( 'H3', 'custom-widgets' ),
                    'h4' => esc_html__( 'H4', 'custom-widgets' ),
                    'h5' => esc_html__( 'H5', 'custom-widgets' ),
                    'h6' => esc_html__( 'H6', 'custom-widgets' ),
                    'span' => esc_html__( 'Span', 'custom-widgets' ),
                    'div' => esc_html__( 'Div', 'custom-widgets' ),
                    'p' => esc_html__( 'P', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
			'time',
			[
				'label' => esc_html__( 'Animation Delay', 'custom-widgets' ) . ' (ms)',
				'type' => Controls_Manager::NUMBER,
				'default' => '3000',
				'min' => 0,
				'step' => 500,
                'max' => 10000,
				// 'condition' => [
				// 	'animation!' => '',
				// ],
				'render_type' => 'none',
				'frontend_available' => true,
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
                'label' => __( 'Style', 'custom-widgets' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

          $this->add_control(
			'sk_overall',
			[
				'label' => __( 'Container', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_words',
			[
				'label' => __( 'Animated words', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_before',
			[
				'label' => __( 'Prefix', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_after',
			[
				'label' => __( 'Suffix', 'custom-widgets' ),
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

        // Classes
		$classes = array();
		$classes[] = 'cz_headline';
		$classes[] = str_replace( '_', ' ', $settings['fx'] );
        ?>
        <<?php echo $settings['tag']; ?>  <?php echo $settings['time'] ?> <?php echo Codevz_Plus::classes( [], $classes );  ?>>
        <span class="cz_before_text"><?php echo $settings['before_text']; ?></span>
        <span class="cz_words-wrapper"> 
		<?php $i = 1; ?>
		<?php $words = (array) explode( ',', $settings['words'] ); ?>
		<?php foreach ( $words as $word ) { ?>
			<?php $visible = ( $i !== 1 ) ? ' class="is-hidden"' : ' class="is-visible"'; ?>
			<b' <?php echo $visible;?>><?php echo $word;?></b>
			<?php $i++; ?>
		 <?php } ?>
		</span>
        <span class="cz_after_text"><?php echo $settings['after_text']?></span>
        </<?php echo $settings['tag']; ?>>
        <?php

    }

    public function _content_template() {
        ?>
        <#
        view.addRenderAttribute( 'before_text', 'class', 'xtra-animated-before_text' );
		view.addInlineEditingAttributes( 'before_text', 'none' );

        view.addRenderAttribute( 'words', 'class', 'xtra-animated-words' );
		view.addInlineEditingAttributes( 'words', 'none' );

        view.addRenderAttribute( 'after_text', 'class', 'xtra-animated-after_text' );
		view.addInlineEditingAttributes( 'after_text', 'none' );

        var classes = 'cz_headline', 
                classes = settings.fx ? classes + ' ' + settings.fx : classes;
        #>

        <{{{settings.tag}}} class="{{{classes}}}" time="{{{settings.time}}}" >
        <span class="cz_before_text">{{{settings.before_text}}}</span>
        <span class="cz_words-wrapper"> 
		<?php $i = 1; ?>
		{{{settings.words}}}
			<b>{{{settings.words}}}</b>
			<?php $i++; ?>
		</span>
        <span class="cz_after_text">{{{settings.after_text}}}</span>
        </{{{settings.tag}}}>
        <?php

    }
}