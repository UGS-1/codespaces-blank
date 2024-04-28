<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_gap extends Widget_Base {

	protected $id = 'cz_gap';

    public function get_name() {
		return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Gap', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'eicon-spacer';
    }

    public function get_categories() {
        return [ 'xtra' ];
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
			'height',
			[
				'label' => __( 'Height', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .xtra_gap' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'height__tablet',
			[
				'label' => __( 'On Tablet', 'elementor' ),
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
						'min' => 0,
						'max' => 300,
                        'step' => 1,
					],
					'vh' => [
						'min' => 0,
						'max' => 300,
                        'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xtra_gap' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'height__mobile',
			[
				'label' => __( 'On Mobile', 'elementor' ),
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
						'min' => 0,
						'max' => 300,
                        'step' => 1,
					],
					'vh' => [
						'min' => 0,
						'max' => 300,
                        'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xtra_gap' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings_for_display();

		$primary_class = $settings['height__tablet'] ? ' hide_on_tablet hide_on_mobile' : '';
		$primary_class .= ( $settings['height__mobile'] && ! $settings['height__tablet'] ) ? ' hide_on_mobile' : '';
        $show_only_tablet = $settings['height__mobile']['size'] ? ' show_only_tablet' : '';
        ?>
        <?php echo $settings['height']['size'] . $settings['height']['unit']; ?><div class="cz_gap clr ' <?php echo $primary_class; ?> '" style="height: ' <?php echo  $settings['height']['size'] . $settings['height']['unit'];  ?>'"></div>
        <div class="cz_gap show_on_tablet clr ' . <?php echo $show_only_tablet; ?> . '" style="height: ' . <?php echo $settings['height__tablet']['size']; ?> . '"></div>
        <div class="cz_gap show_on_mobile clr" style="height: ' <?php echo  $settings['height__mobile']['size']; ?> '"></div>
        <?php
    }

    public function _content_template() {
        ?>
        <#
        #>
        <div class="cz_gap clr ' {{settings.primary_class}} '" style="height: {{settings.height.size}}{{settings.height.unit}}"></div>
        <div class="cz_gap show_on_tablet clr ' . {{settings.show_only_tablet}} . '" style="height: {{settings.height__tablet.size}}{{settings.height__tablet.unit}}"></div>
        <div class="cz_gap show_on_mobile clr" style="height: {{settings.height__mobile.size}}{{settings.height__mobile.unit}}"></div>
        <?php
    }
}