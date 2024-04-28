<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_quote extends Widget_Base {

    protected $id = 'cz_quote';

    public function get_name() {
        return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Quote', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'fa fa-font';
    }

    public function get_categories() {
        return [ 'xtra' ];
    }
    public function get_style_depends() {
        if ( Codevz_Plus::$is_rtl ) {
			return [ $this->id, $this->id . '_rtl' ];
		} else {
			return [ $this->id ];
		}
    }

    public function _register_controls(){
        $this->start_controls_section(
            'section_content',
            [
                'label' => 'Quote Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        
        $this->add_control(
			'style',
			[
				'label' => __( 'Style', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => esc_html__( 'Select', 'custom-widgets' ),
					'cz_quote_center' => esc_html__( 'Default center', 'custom-widgets' ),
					'cz_quote_arrow' => esc_html__( 'Arrow bottom', 'custom-widgets' ),
					'cz_quote_arrow cz_quote_center' => esc_html__( 'Arrow bottom center', 'custom-widgets' ),
					'cz_quote_arrow cz_quote_top' => esc_html__( 'Arrow top', 'custom-widgets' ),
                    'cz_quote_arrow cz_quote_top cz_quote_center' => esc_html__( 'Arrow top center', 'custom-widgets' ),
				],
			]
		);

        $this->add_control(
            'content',
            [
                'label' => esc_html__('Content','custom-widgets'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'Great things in business are never done by one person. They are done by a team of people.',
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
				// 'default' => [
				// 	'url' => Utils::get_placeholder_image_src(),
				// ],
			]
		);

        $this->add_control(
            'name',
            [
                'label' => esc_html__( "Name", 'custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'John Doe', 'custom-widgets' ),
                'placeholder' => esc_html__( 'John Doe', 'custom-widgets' ),
            ]
        );

        $this->add_control(
            'subname',
            [
                'label' => esc_html__( "Sub name", 'custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Businessman', 'custom-widgets' ),
                'placeholder' => esc_html__( 'Businessman', 'custom-widgets' ),
            ]
        );

        $this->add_control(
			'rating',
			[
				'label' => esc_html__( 'Stars rating?', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => esc_html__( 'Select', 'custom-widgets' ),
					'5' => esc_html__( '5', 'custom-widgets' ),
					'4.5' => esc_html__( '4.5', 'custom-widgets' ),
					'4' => esc_html__( '4', 'custom-widgets' ),
					'3.5' => esc_html__( '3.5', 'custom-widgets' ),
                    '3' => esc_html__( '3', 'custom-widgets' ),
                    '2.5'  => esc_html__( '2.5', 'custom-widgets' ),
                    '2'  => esc_html__( '2', 'custom-widgets' ),
                    '1.5'  => esc_html__( '1.5', 'custom-widgets' ),
                    '1'  => esc_html__( '1', 'custom-widgets' ),
                    '0.5'  => esc_html__( '0.5', 'custom-widgets' ),
                    'Zero'  => esc_html__( '0', 'custom-widgets' ),
				],
			]
		);

        $this->add_control(
			'quote_position',
			[
				'label' => __( 'Quote shape', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => esc_html__( 'None', 'custom-widgets' ),
					'absolute;top: 10%;left: 10%' => esc_html__( 'Top left', 'custom-widgets' ),
					'absolute;top: 10%;left: calc(50% - 60px)' => esc_html__( 'Top center', 'custom-widgets' ),
					'absolute;top: 10%;right: 10%' => esc_html__( 'Top right', 'custom-widgets' ),
					'absolute;bottom: 10%;left: 10%' => esc_html__( 'Bottom left', 'custom-widgets' ),
                    'absolute;bottom: 10%;left: calc(50% - 60px)' => esc_html__( 'Buttom center', 'custom-widgets' ),
                    'absolute;bottom: 10%;right: 10%'  => esc_html__( 'Buttom right', 'custom-widgets' ),
                    'absolute;top: calc(50% - 60px);right: calc(50% - 60px)'  => esc_html__( 'Center center', 'custom-widgets' ),
                    'relative;margin: 0 0 20px;font-size: 40px;opacity: 1'  => esc_html__( 'Left relative', 'custom-widgets' ),
                    'relative;margin: 0 auto 20px;font-size: 40px;text-align: center;opacity: 1'  => esc_html__( 'Center relative', 'custom-widgets' ),
                    'relative;margin: 0 auto 20px;font-size: 40px;text-align: right;opacity: 1'  => esc_html__( 'Right relative', 'custom-widgets' ),
                    'absolute;top: 10%;left: 10%;'  => esc_html__( 'Top left + Bottom right', 'custom-widgets' ),
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
			'rating_color',
			[
				'label' => esc_html__( 'Stars color', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'quote_color',
			[
				'label' => esc_html__( 'Quote color', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
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
			'sk_image',
			[
				'label' => esc_html__( 'Image', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_name',
			[
				'label' => esc_html__( 'Name', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

        $this->add_control(
			'sk_subname',
			[
				'label' => esc_html__( 'Sub name', 'custom-widgets' ),
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

        // Variable's
		if ( $settings['rating'] !== '' ) {
			$rating_number = $settings['rating'];
			$half_rating = ( strpos( $rating_number, '.' ) !== false ) ? '<i class="fa fa-star-half-o"></i>' : '';
			$settings['rating'] = '<div class="cz_quote_rating" style="color: ' . $settings['rating_color'] . '">' . str_repeat( '<i class="fa fa-star"></i>', floor( $rating_number ) ) . $half_rating;
			$settings['rating'] .= str_repeat( '<i class="fa fa-star-o"></i>', ( 5 - round( $rating_number ) ) );
			$settings['rating'] .= '</div>';
		}

        $cite 	= $settings['name'] ? '<h4>' . $settings['name'] . '<small>' . $settings['subname'] . '</small></h4>' : '';
		$cite 	= $cite . $settings['rating'];
		$image 	= $settings['image'] ? Group_Control_Image_Size::get_attachment_image_html( $settings ) : '';
		$text 	= '<div class="cz_quote_content cz_wpe_content">' . $settings['content'] . '</div>';
		$quote_start_end = ( strpos( $settings['quote_position'], 'left' ) !== false ) ? 'left' : 'right';
		$icon_position = $settings['quote_position'] ? 'position:' . $settings['quote_position'] . ';' : '';
		$icon_color = $settings['quote_color'] ? 'color: ' . $settings['quote_color'] . ';' : '';
		$icon_tyle = ( $icon_color || $icon_position ) ? ' style="' . $icon_position . $icon_color . '"' : '';
		$icon 	= $settings['quote_position'] ? '<i class="fa fa-quote-' . $quote_start_end . ' cz_quote_shape"' . $icon_tyle . '></i>' : '';
		$sub 	= ( $image || $cite ) ? '<div class="cz_quote_info">' . $image . $cite . '</div>' : '';

        // Check if both quote selected
		if ( $settings['quote_position'] === 'absolute;top: 10%;left: 10%;' ) {
			$icon .= '<i class="fa fa-quote-right cz_quote_shape cz_quote_both_second"' . ( $icon_color ? ' style="' . $icon_color. '"' : '' ) . '></i>';
		}

        		// Classes
		$classes = array();
		$classes[] = 'cz_quote';
		$classes[] = $settings['style'];
		//$classes[] = $settings['text_center'] ? 'cz_mobile_text_center' : '';

        ?>
        <div <?php echo xtra_elementor_classes( $classes );?>>
        <?php if ( strpos( $settings['style'], 'cz_quote_top' ) !== false ) {
			echo $sub . '<blockquote>' . $icon . $text . '</blockquote>';
		} elseif ( strpos( $settings['style'], 'cz_quote_arrow' ) !== false ) {
			 echo '<blockquote>' . $icon . $text . '</blockquote>' . $sub;
		} else {
			echo '<blockquote>' . $icon . $text . $sub . '</blockquote>';
		}
        ?>
        </div>
        <?php

    }

    public function content_template() {
        ?>
        <#

        view.addRenderAttribute( 'content', 'class', 'xtra-quote-content' );
		view.addInlineEditingAttributes( 'content', 'none' );

        view.addRenderAttribute( 'name', 'class', 'xtra-quote-name' );
		view.addInlineEditingAttributes( 'name', 'none' );

        view.addRenderAttribute( 'subname', 'class', 'xtra-quote-subname' );
		view.addInlineEditingAttributes( 'subname', 'none' );
        
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

        if ( settings.rating !== '' ) {
			var rating_number = settings.rating;
			var half_rating =  ( rating_number, '+' ) !== false  ? '<i class="fa fa-star-half-o"></i>' : '';
            settings.rating = '<div class="cz_quote_rating" style="color: ' + settings.rating_color + '">' + '<i class="fa fa-star"></i>',  rating_number   + half_rating;
            settings.rating = '<i class="fa fa-star-o"></i>',  rating_number;
			settings.rating = '</div>';
        }

        var cite 	= settings.name ? '<h4>' + settings.name + '<small>' + settings.subname + '</small></h4>' : '';
		var cite 	= cite + settings.rating;
        var image 	= settings.image ? '<img src="' + image_url + '">' : '';
		var text 	= '<div class="cz_quote_content cz_wpe_content">' + settings.content + '</div>';
        var quote_start_end = ( settings.quote_position, 'left' ) !== false  ? 'left' : 'right';
        var icon_position = settings.quote_position ? 'position:' + settings.quote_position + ';' : '';
		var icon_color = settings.quote_color ? 'color: ' + settings.quote_color + ';' : '';
        var icon_tyle = ( icon_color || icon_position ) ? ' style="' + icon_position + icon_color + '"' : '';
        var icon 	= settings.quote_position ? '<i class="fa fa-quote-' + quote_start_end + ' cz_quote_shape" + icon_tyle + ></i>' : '';
		var sub 	= ( image || cite ) ? '<div class="cz_quote_info">' + image + cite + '</div>' : '';

        if ( settings.quote_position === 'absolute;top: 10%;left: 10%;' ) {
			var icon = '<i class="fa fa-quote-right cz_quote_shape cz_quote_both_second" +  icon_color ?  style="' + icon_color + '" :  + ></i>';
		}

        var classes = 'cz_quote', 
				classes = settings.style ? classes + ' ' + settings.style : classes;
        #>
        <?php

    }

}