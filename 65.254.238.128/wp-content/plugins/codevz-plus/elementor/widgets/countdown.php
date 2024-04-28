<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_countdown extends Widget_Base {

    protected $id = 'cz_countdown';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Countdown', 'custom-widgets' );
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
                'label' => 'Countdown Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'type',
			[
				'label' => esc_html__( 'Type', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'down',
				'options' => [
					'down' => esc_html__( 'Count down', 'custom-widgets' ),
					'up' => esc_html__( 'Count up', 'custom-widgets' ),
                    'loop' => esc_html__( 'Loop count down', 'custom-widgets' ),
				],
			]
		);

        $this->add_control(
			'date',
			[
				'label' => __( 'Date', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'default' => date( 'Y/m/j H:i', strtotime("1 year") )
            ]
		);

        $this->add_control(
			'dat_e',
			[
				'label' => __( 'Date', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
                'condition' => [
                    'type' => 'down',
                ],
            ]
		);

        $this->add_control(
            'loop',
            [
                'label' => esc_html__( 'Minutes', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( '120', 'custom-widgets' ),
                'placeholder' => esc_html__( '120', 'custom-widgets' ),
                'condition' => [
                    'type' => 'loop',
                ],
            ]
        );

        $this->add_control(
			'pos',
			[
				'label' => esc_html__( 'Position', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'tac',
				'options' => [
					'tac' => esc_html__( 'Center', 'custom-widgets' ),
					'tal' => esc_html__( 'Left', 'custom-widgets' ),
                    'tar' => esc_html__( 'Right', 'custom-widgets' ),
                    'tac cz_countdown_center_v' => esc_html__( 'Center vertical', 'custom-widgets' ),
                    'tal cz_countdown_left_v' => esc_html__( 'Left vertical', 'custom-widgets' ),
                    'tal cz_countdown_right_v' => esc_html__( 'Right vertical', 'custom-widgets' ),
                    'tac cz_countdown_inline' => esc_html__( 'Inline view', 'custom-widgets' ),
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'translation',
            [
                'label' => esc_html__( 'TRANSLATION', 'custom-widgets' )
            ]
        );
        $this->add_control(
            'year',
            [
                'label' => esc_html__( 'Year', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Year', 'custom-widgets' ),
                'placeholder' => esc_html__( 'Year', 'custom-widgets' ),
                'condition' => [
                    'type' => 'up',
                ],
            ]
        );

        $this->add_control(
            'day',
            [
                'label' => esc_html__( 'Day', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Day', 'custom-widgets' ),
                'placeholder' => esc_html__( 'Day', 'custom-widgets' ),
            ]
        );

        $this->add_control(
            'hour',
            [
                'label' => esc_html__( 'Hour', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Hour', 'custom-widgets' ),
                'placeholder' => esc_html__( 'Hour', 'custom-widgets' ),
            ]
        );

        $this->add_control(
            'minute',
            [
                'label' => esc_html__( 'Minute', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Minute', 'custom-widgets' ),
                'placeholder' => esc_html__( 'Minute', 'custom-widgets' ),
            ]
        );

        $this->add_control(
            'second',
            [
                'label' => esc_html__( 'Second', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Second', 'custom-widgets' ),
                'placeholder' => esc_html__( 'Second', 'custom-widgets' ),
            ]
        );

        $this->add_control(
            'plus',
            [
                'label' => esc_html__( 'Apostrophe s', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 's', 'custom-widgets' ),
                'placeholder' => esc_html__( 's', 'custom-widgets' ),
            ]
        );

        $this->add_control(
            'expire',
            [
                'label' => esc_html__( 'Expire message', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'This event has been expired', 'custom-widgets' ),
                'placeholder' => esc_html__( 'This event has been expired', 'custom-widgets' ),
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
				'label_on' => esc_html__( 'Show', 'custom-widgets' ),
				'label_off' => esc_html__( 'Hide', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
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
                'label' => esc_html__( 'Style', 'custom-widgets' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
			'sk_cols',
			[
				'label' => esc_html__( 'Columns', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_nums',
			[
				'label' => esc_html__( 'Numbers', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_title',
			[
				'label' => esc_html__( 'Titles', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_expired',
			[
				'label' => esc_html__( 'Expired message', 'custom-widgets' ),
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
        // $date = strtotime( $this->get_settings( 'date' ) );
		// $date_in_days = $date / DAY_IN_SECONDS;

        $data = array(
			'type'	=> $settings['type'],
			'date'	=> ( $settings['type'] === 'loop' ) ? $settings['loop'] * 60 : strtotime( $settings['date'] ) - strtotime( current_time( 'Y/m/j H:i' ) ),
			'elapse'=> ( $settings['type'] === 'up' ) ? true : false,
			'y'		=> ( $settings['type'] === 'up' ) ? $settings['year'] : '',
			'd'		=> $settings['day'],
			'h'		=> $settings['hour'],
			'm'		=> $settings['minute'],
			's'		=> $settings['second'],
			'p'		=> $settings['plus'] ? $settings['plus'] : '&nbsp;',
			'ex'	=> $settings['expire'] ? $settings['expire'] : '&nbsp;',
		);

        // Classes
		$classes = array();
		$classes[] = 'cz_countdown clr';
		$classes[] = $settings['pos'];

		// Inner HTML.
		$html = '';
		$html .= ( $settings['type'] === 'up' && $settings['year'] ) ? '<li><span>00</span><p>' . esc_html( $settings['year'] ) . '</p></li>' : '';
		$html .= $settings['day'] ? '<li><span>00</span><p>' . esc_html( $settings['day'] ) . '</p></li>' : '';
		$html .= $settings['hour'] ? '<li><span>00</span><p>' . esc_html( $settings['hour'] ) . '</p></li>' : '';
		$html .= $settings['minute'] ? '<li><span>00</span><p>' . esc_html( $settings['minute'] ) . '</p></li>' : '';
		$html .= $settings['second'] ? '<li><span>00</span><p>' . esc_html( $settings['second'] ) . '</p></li>' : '';

        ?>
        <ul data-countdown='<?php echo json_encode( $data, JSON_HEX_APOS ); ?>'  <?php echo xtra_elementor_classes( $classes ); ?>><?php echo $html; ?></ul>
        <div></div>
        <?php
    }

    public function _content_template() {
        ?>
        <#
        var classes = 'cz_countdown clr', 
                classes = settings.pos ? classes + ' ' + settings.pos : classes;

     
        var html = '';

        html = html + ( ( settings.type === 'up' && settings.year ) ? '<li><span>00</span><p>' + settings.year + '</p></li>' : '' );

        html = html + ( settings.day ? '<li><span>00</span><p>' + settings.day + '</p></li>' : '' );

        html = html + ( settings.hour ? '<li><span>00</span><p>' + settings.hour + '</p></li>' : '' );

        html = html + ( settings.minute ? '<li><span>00</span><p>' + settings.minute + '</p></li>' : '' );

        html = html + ( settings.second ? '<li><span>00</span><p>' + settings.second + '</p></li>' : '' );
        var currentdate = new Date(); 
        var data = {
			'type'	: settings.type,
			'date'	: ( settings.type === 'loop' ) ? settings.loop * 60 : Date.parse( settings.date ) - Date.parse( currentdate.getDate() ),
			'elapse': ( settings.type === 'up' ) ? true : false,
			'y'		: ( settings.type === 'up' ) ? settings.year : '',
			'd'		: settings.day,
			'h'		: settings.hour,
			'm'		: settings.minute,
			's'		: settings.second,
			'p'		: settings.plus ? settings.plus : '&nbsp;',
			'ex'	: settings.expire ? settings.expire : '&nbsp;',
        };
        var data = JSON.stringify(data);
        #>
        <ul data-countdown='{{{data}}} ' class="{{{classes}}}">{{{html}}}</ul>
        <div></div>
        <?php
    }
}