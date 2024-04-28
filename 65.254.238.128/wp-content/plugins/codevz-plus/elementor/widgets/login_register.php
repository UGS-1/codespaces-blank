<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_login_register extends Widget_Base {

    protected $id = 'cz_login_register';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Login,Register', 'custom-widgets' );
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
                'section_login_register',
                [
                    'label' => 'Login, Register Settings',
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
                'login',
                [
                    'label' => esc_html__( 'Login form?', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'custom-widgets' ),
                    'label_off' => __( 'No', 'custom-widgets' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'register',
                [
                    'label' => esc_html__( 'Registration form?', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'custom-widgets' ),
                    'label_off' => __( 'No', 'custom-widgets' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'pass_r',
                [
                    'label' => esc_html__( 'Pass Recovery form?', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'custom-widgets' ),
                    'label_off' => __( 'No', 'custom-widgets' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'show',
                [
                    'label' => esc_html__( 'Show form for admin?', 'custom-widgets' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'custom-widgets' ),
                    'label_off' => __( 'No', 'custom-widgets' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_url',
            [
                'label' => esc_html__( 'REDIRECT URL', 'custom-widgets' )
            ]
        );

        
        $this->add_control(
            'redirect',
            [
                'label' => esc_html__( 'Redirect URL', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_gdpr',
            [
                'label' => esc_html__( 'GDPR', 'custom-widgets' )
            ]
        );

        $this->add_control(
            'gdpr',
            [
                'label' => esc_html__( 'GDPR Confirmation', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'gdpr_error',
            [
                'label' => esc_html__( 'GDPR Error', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_translation',
            [
                'label' => esc_html__( 'Translation', 'custom-widgets' )
            ]
        );

        $this->add_control(
            'username',
            [
                'label' => esc_html__( 'Username', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Username',
                'placeholder' => 'Username',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'password',
            [
                'label' => esc_html__( 'Password', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Password',
                'placeholder' => 'Password',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'email',
            [
                'label' => esc_html__( 'Your email', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Your email',
                'placeholder' => 'Your email',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'e_or_p',
            [
                'label' => esc_html__( 'Email', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Email',
                'placeholder' => 'Email',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'login_btn',
            [
                'label' => esc_html__( 'Login button', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Login Now',
                'placeholder' => 'Login Now',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'register_btn',
            [
                'label' => esc_html__( 'Register button', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Signup Now',
                'placeholder' => 'Signup Now',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'pass_r_btn',
            [
                'label' => esc_html__( 'Password recovery button', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Send my Password',
                'placeholder' => 'Send my Password',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'login_t',
            [
                'label' => esc_html__( 'Custom login link', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Already registered? Sign In',
                'placeholder' => 'Already registered? Sign In',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'f_pass_t',
            [
                'label' => esc_html__( 'Forgot password link', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Forgot your password? Get help',
                'placeholder' => 'Forgot your password? Get help',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'register_t',
            [
                'label' => esc_html__( 'Regisration link', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Not registered? Create an account',
                'placeholder' => 'Not registered? Create an account',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'logout',
            [
                'label' => esc_html__( 'Logout', 'custom-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Logout',
                'placeholder' => 'Logout',
                'dynamic' => [
                    'active' => true,
                ],
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
			'sk_inputs',
			[
				'label' => esc_html__( 'Inputs', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_buttons',
			[
				'label' => esc_html__( 'Buttons', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_btn_active',
			[
				'label' => esc_html__( 'Buttons loader', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_links',
			[
				'label' => esc_html__( 'Links', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_msg',
			[
				'label' => esc_html__( 'Messages', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_content',
			[
				'label' => esc_html__( 'Title styling', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'custom-widgets' ),
			]
		);

        $this->add_control(
			'content_l',
			[
				'label' => esc_html__( 'Title above login form', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
			]
		);

        $this->add_control(
			'content_r',
			[
				'label' => esc_html__( 'Title above register form', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
			]
		);

        $this->add_control(
			'content_pr',
			[
				'label' => esc_html__( 'Title above password recovery form', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
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

    }

    public function content_template() {

    }
}