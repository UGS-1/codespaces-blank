<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_news_tricker extends Widget_Base {

    protected $id = 'cz_news_tricker';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'News Tricker', 'custom-widgets' );
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

    public function _register_controls(){
        $this->start_controls_section(
            'section_content',
            [
                'label' => 'News Tricker Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => esc_html__( 'Type', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'cz_title_pos_inline',
                'options' => [
                    'slider' => esc_html__( 'Slide', 'custom-widgets' ),
                    'fade' => esc_html__( 'Fade', 'custom-widgets' ),
                    'vertical' => esc_html__( 'Vertical', 'custom-widgets' ),
                ],
            ]
        );

        
        $this->add_control(
			'badge_title', [
				'label' => esc_html__( 'Badge', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'TRENDING' , 'custom-widgets' ),
				'label_block' => true,
			]
		);

        // $this->add_control(
        //     'speed',
        //     [
        //         'label' => esc_html__( 'Auto play seconds', 'custom-widgets' ),
        //         'type' => Controls_Manager::SLIDER,
        //         'size_units' => [ '' ],
        //         'range' => [
        //             '' => [
        //                 'min' => 1,
        //                 'max' => 10,
        //                 'step' => 1,
        //             ],
        //         ],
        //         'default' => 4,
        //         'selectors' => [
		// 			'{{WRAPPER}} .xtra-elements-nt' => 'speed: {{SIZE}}{{UNIT}};',
		// 		],
        //         'separator' => 'before',
		// 	]
        // );
        $this->end_controls_section();

        $this->start_controls_section(
            'query_section',
            [
                'label' => esc_html__( 'Query', 'custom-widgets' )
            ]
        );

        $this->add_control(
			'post_type', [
				'label' => esc_html__( 'Post type(s)', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);


        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Orderby', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__( 'Date', 'custom-widgets' ),
                    'ID' => esc_html__( 'ID', 'custom-widgets' ),
                    'rand' => esc_html__( 'Random', 'custom-widgets' ),
                    'author' => esc_html__( 'Author', 'custom-widgets' ),
                    'title' => esc_html__( 'Title', 'custom-widgets' ),
                    'name' => esc_html__( 'Name', 'custom-widgets' ),
                    'type' => esc_html__( 'Type', 'custom-widgets' ),
                    'modified' => esc_html__( 'Modified', 'custom-widgets' ),
                    'parent' => esc_html__( 'Parent ID', 'custom-widgets' ),
                    'comment_count' => esc_html__( 'Comment Count', 'custom-widgets' ),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__( 'Order', 'custom-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC' => esc_html__( 'Descending', 'custom-widgets' ),
                    'ASC' => esc_html__( 'Ascending', 'custom-widgets' ),
                ],
            ]
        );

        // $this->add_control(
        //     'order',
        //     [
        //         'label' => esc_html__( 'Order', 'custom-widgets' ),
        //         'type' => Controls_Manager::SELECT,
        //         'default' => 'DESC',
        //         'options' => [
        //             'DESC' => esc_html__( 'Descending', 'custom-widgets' ),
        //             'ASC' => esc_html__( 'Ascending', 'custom-widgets' ),
        //         ],
        //     ]
        // );
        // $this->end_controls_section();
    }
}