<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_counter extends Widget_Base {

	protected $id = 'cz_counter';

	public function get_name() {
		return $this->id;
	}

	public function get_title() {
		return esc_html__( 'Counter', 'codevz' );
	}
	
	public function get_icon() {
		return 'fa fa-sort-numeric-up-alt';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_style_depends() {
		return [ $this->id ];
	}

	public function get_script_depends() {
		return [ $this->id ];
	}

	public function _register_controls() {
		$this->start_controls_section(
			'counter',
			[
				'label' 	=> 'Counter Settings',
				'tab' 		=> \Elementor\Controls_Manager::TAB_CONTENT,
			],
		);

		$this->add_control(
			'before',
			[
				'label' 	=> esc_html__('Prefix','codevz'),
				'type' 		=> \Elementor\Controls_Manager::TEXT,
				'default' 	=> ''
			],
		);

		$this->add_control(
			'number',
			[
				'label' 	=> esc_html__( 'Number', 'codevz' ),
				'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> '500',
				'min' 		=> 1,
				'step' 		=> 1,
				'max' 		=> 500
			]
		);

		$this->add_control(
			'symbol',
			[
				'label' 	=> esc_html__('Symbol','codevz'),
				'type' 		=> \Elementor\Controls_Manager::TEXT,
				'default' 	=> ''
			],
		);

		$this->add_control(
			'after',
			[
				'label' 	=> esc_html__('Suffix','codevz'),
				'type' 		=> \Elementor\Controls_Manager::TEXT,
				'default' 	=> 'Project'
			],
		);

		$this->add_control(
			'position',
			[
				'label' 	=> esc_html__( 'Position', 'codevz' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '',
				'options' 	=> [
					'tal cz_1row' 	=> esc_html__( 'Inline | Left', 'codevz' ),
					'tac cz_1ro' 	=> esc_html__( 'Inline | Center', 'codevz' ),
					'tar cz_1ro' 	=> esc_html__( 'Inline | Right', 'codevz' ),
					'tal cz_2rows' 	=> esc_html__( 'Block | Left', 'codevz' ),
					'tac cz_2rows' 	=> esc_html__( 'Block | Center', 'codevz' ),
					'tar cz_2rows' 	=> esc_html__( 'Block | Right', 'codevz' ),
				],
			]
		);

		$this->add_control(
			'duration',
			[
				'label' 	=> esc_html__( 'Duration', 'codevz' ),
				'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> '4',
				'min' 		=> 1,
				'step' 		=> 1,
				'max' 		=> 10,
			]
		);

		$this->add_control(
			'delay',
			[
				'label' 	=> esc_html__( 'Delay Seconds', 'codevz' ),
				'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> '0',
				'min' 		=> 0,
				'step' 		=> 1,
				'max' 		=> 10,
			]
		);

		$this->add_control(
			'comma',
			[
				'label' 	=> esc_html__( 'Disable comma?', 'codevz' ),
				'type' 		=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 	=> __( 'Yes', 'codevz' ),
				'label_off' => __( 'No', 'codevz' ),
				'return_value' => 'yes',
				'default' 	=> 'no',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_parallax',
			[
				'label' => esc_html__( 'PARALLAX', 'codevz' )
			]
		);

		$this->add_control(
			'parallax',
			[
				'label' 	=> esc_html__( 'Parallax', 'codevz' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> 'select',
				'options' 	=> [
					'' 			=> esc_html__( 'Select', 'codevz' ),
					'v' 		=> esc_html__( 'Vertical', 'codevz' ),
					'vmouse' 	=> esc_html__( 'Vertical + Mouse Parallax', 'codevz' ),
					'true' 		=> esc_html__( 'Horizontal', 'codevz' ),
					'truemouse' => esc_html__( 'Horizontal + Mouse Parallax', 'codevz' ),
					'truemouse' => esc_html__( 'Horizontal + Mouse Parallax', 'codevz' ),
					'mouse' 	=> esc_html__( 'Mouse Parallax', 'codevz' ),
				],
			]
		);

		$this->add_control(
			'parallax_speed',
			[
				'label' 	=> esc_html__( 'Parallax Speed', 'codevz' ),
				'type' 		=> Controls_Manager::SLIDER,
				'range' 	=> [
					'px' 	=> [
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
				'label' 	=> esc_html__( 'Stop when done', 'codevz' ),
				'type' 		=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 	=> __( 'Show', 'codevz' ),
				'label_off' => __( 'Hide', 'codevz' ),
				'return_value' => 'yes',
				'default' 	=> 'yes',
			]
		);

		
		$this->add_control(
			'mouse_speed',
			[
				'label' 	=> esc_html__( 'Mouse Speed', 'codevz' ),
				'type' 		=> Controls_Manager::SLIDER,
				'range' 	=> [
					'ms' 	=> [
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
				'label' => __( 'Style', 'codevz' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'sk_overall',
			[
				'label' 	=> __( 'Container', 'codevz' ),
				'type' 		=> Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'sk_num',
			[
				'label' 	=> __( 'Number', 'codevz' ),
				'type' 		=> Controls_Manager::COLOR,
			]
		);


		$this->add_control(
			'sk_symbol',
			[
				'label' 	=> __( 'Symbol', 'codevz' ),
				'type' 		=> Controls_Manager::COLOR,
			]
		);


		$this->add_control(
			'sk_ba',
			[
				'label' 	=> __( 'Prefix', 'codevz' ),
				'type' 		=> Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'sk_after',
			[
				'label' 	=> __( 'Suffix', 'codevz' ),
				'type' 		=> Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'svg_bg',
			[
				'label' 	=> __( 'Background layer', 'codevz' ),
				'type' 		=> Controls_Manager::COLOR,
			]
		);

		$this->end_controls_section();

	}

	public function render() {

		$atts = $this->get_settings_for_display();

		// Classes
		$classes = array();
		$classes[] = 'cz_counter clr';
		$classes[] = $atts['position'];
		//$classes[] = $atts['text_center'] ? 'cz_mobile_text_center' : '';

		$before = $atts['before'] ? '<span class="cz_counter_before">' . $atts['before'] . '</span>' : '';
		$after  = $atts['after'] ? '<span class="cz_counter_after">' . $atts['after'] . '</span>' : '';
		$symbol = $atts['symbol'] ? '<i>' . $atts['symbol'] . '</i>' : '';
		$number = $atts['number'] ? $atts['number'] : '0';
		$number = '<span class="cz_counter_num_wrap"><span class="cz_counter_num">' . $number . '</span>' . $symbol . '</span>';

		?>

		<div<?php echo Codevz_Plus::classes( [], $classes ); ?> data-disable-comma="<?php echo $atts['comma']; ?>" data-duration="<?php echo $atts['duration']; ?>000" data-delay="<?php echo $atts['delay']; ?>000">

			<div class="<?php echo $atts['svg_bg'] ? 'cz_svg_bg' : ''; ?>">
				<?php echo wp_kses_post( $before . $number . $after ); ?>
			</div>

		</div>

		<?php

	}

	public function content_template() {
		?>

		<#
			var classes = 'cz_counter clr', 
				classes = classes + ( settings.position ? ' ' + settings.position : '' ),

				svg_bg = settings.svg_bg ? 'cz_svg_bg' : '';

				before = settings.before ? '<span class="cz_counter_before">' + settings.before + '</span>' : '',
				after  = settings.after ? '<span class="cz_counter_after">' + settings.after + '</span>' : '',
				symbol = settings.symbol ? '<i>' + settings.symbol + '</i>' : '',
				number = settings.number ? settings.number : '0',
				number = '<span class="cz_counter_num_wrap"><span class="cz_counter_num">' + number + '</span>' + symbol + '</span>';
		#>

		<div class="{{{classes}}}" data-disable-comma="{{{settings.comma}}}" data-duration="{{{settings.duration}}}000" data-delay="{{{settings.delay}}}000">

			<div class="{{{svg_bg}}}">
				{{{before}}}
				{{{number}}}
				{{{after}}}
			</div>

		</div>

		<?php
	}
}