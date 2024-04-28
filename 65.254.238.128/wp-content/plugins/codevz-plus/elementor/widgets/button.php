<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_button extends Widget_Base {

	protected $id = 'cz_button';

	public function get_name() {
		return $this->id;
	}

	public function get_title() {
		return esc_html__( 'Button', 'custom-widgets' );
	}

	public function get_icon() {
		return 'eicon-button';
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

	public function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => 'Settings',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'custom-widgets' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Button title', 'custom-widgets' ),
				'placeholder' => esc_html__( 'Button title', 'custom-widgets' ),
			]
		);
		
		$this->add_control(
			'subtitle',
			[
				'label' =>esc_html__( 'Subtitle', 'custom-widgets' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		
		$this->add_control(
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
		$this->add_control(
			'btn_position',
			[
				'label' => esc_html__( 'Position', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => esc_html__( 'Select', 'custom-widgets' ),
					'cz_btn_inline' => esc_html__( 'Inline', 'custom-widgets' ),
					'cz_btn_block' => esc_html__( 'Block', 'custom-widgets' ),
					'cz_btn_left' => esc_html__( 'Left', 'custom-widgets' ),
					'cz_btn_center' => esc_html__( 'Center', 'custom-widgets' ),
					'cz_btn_right' => esc_html__( 'Right', 'custom-widgets' ),
				],
			]
		);
		
		$this->add_control(
			'botton_styling',
			[
				'label' => esc_html__( "Button styling", 'custom-widgets'),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Button styling', 'custom-widgets' ),
				'placeholder' => esc_html__( 'Button styling', 'custom-widgets' ),
				'settings' =>[
					'color', 'font-size', 'background', 'border',
				],
			]
		);
		
		$this->add_control(
			'icon_type',
			[
				'label' => esc_html__( 'Icon Type', 'custom-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => esc_html__( 'Icon', 'custom-widgets' ),
					'image' => esc_html__( 'Image', 'custom-widgets' ),
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'skin' => 'inline',
				'condition' => [
					'icon_type' => 'icon'
				]
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label' => esc_html__( 'Icon Position', 'custom-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'before',
				'options' => [
					'before' => __( 'Before title', 'custom-widgets' ),
					'after' => __( 'After title', 'custom-widgets' ),
				],
			]
		);


		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image',
				'default' => 'large',
				'separator' => 'none',
				'condition' => [
					'icon_type' => 'image',
				],
			]
		);
		$this->add_control(
			'hover_image',
			[
				'label' => esc_html__( 'Hover Image', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image',
				],
			]
		);
			  
		$this->add_control(
			'btn_effect',
			[
				'label' => esc_html__( 'Button Effect', 'custom-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cz_btn_no_fx',
				'options' => [
					'cz_btn_no_fx' => esc_html__( 'Select', 'custom-widgets' ),
					'cz_btn_move_up' => esc_html__( 'Move Up', 'custom-widgets' ),
					'cz_btn_zoom_in' => esc_html__( 'Zoom In', 'custom-widgets' ),
					'cz_btn_zoom_out' => esc_html__( 'Zoom Out', 'custom-widgets' ),
					'cz_btn_winkle' => esc_html__( 'Winkle', 'custom-widgets' ),
					'cz_btn_absorber' => esc_html__( 'Absorber', 'custom-widgets' ),
					'cz_btn_half_to_fill' => esc_html__( 'Low to Fill', 'custom-widgets' ),
					'cz_btn_half_to_fill_v' => esc_html__( 'Low to Fill Vertical', 'custom-widgets' ),
					'cz_btn_fill_up' => esc_html__( 'Fill Up', 'custom-widgets' ),
					'cz_btn_fill_down' => esc_html__( 'Fill Down', 'custom-widgets' ),
					'cz_btn_fill_left' => esc_html__( 'Fill Left', 'custom-widgets' ),
					'cz_btn_fill_right' => esc_html__( 'Fill Right', 'custom-widgets' ),
					'cz_btn_beat' => esc_html__( 'Single Hard Beat', 'custom-widgets' ),
					'cz_btn_flash' => esc_html__( 'Flash', 'custom-widgets' ),
					'cz_btn_shine' => esc_html__( 'Shine', 'custom-widgets' ),
					'cz_btn_circle_fade' => esc_html__( 'Circle Fade', 'custom-widgets' ),
					'cz_btn_blur' => esc_html__( 'Blur', 'custom-widgets' ),
					'cz_btn_unroll_v' => esc_html__( 'Unroll Vertical', 'custom-widgets' ),
					'cz_btn_unroll_h' => esc_html__( 'Unroll Horizontal', 'custom-widgets' ),
					
				],
			]
		);
		
		$this->add_control(
			'text_effect',
			[
				'label' => esc_html__( 'Text Effect', 'custom-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cz_btn_txt_no_fx',
				'options' => [
					'cz_btn_txt_no_fx' => esc_html__( 'Select', 'custom-widgets' ),
					'cz_btn_txt_fade' => esc_html__( 'Simple Fade', 'custom-widgets' ),
					'cz_btn_txt_move_up' => esc_html__( 'Text Move Up', 'custom-widgets' ),
					'cz_btn_txt_move_down' => esc_html__( 'Text Move Down', 'custom-widgets' ),
					'cz_btn_txt_move_right' => esc_html__( 'Text Move Right', 'custom-widgets' ),
					'cz_btn_txt_move_left' => esc_html__( 'Text Move Left', 'custom-widgets' ),
					'cz_btn_move_up_icon' => esc_html__( 'Move Up Show Icon', 'custom-widgets' ),
					'cz_btn_show_hidden_icon' => esc_html__( 'Show Hidden Icon', 'custom-widgets' ),
					'cz_btn_ghost_icon' => esc_html__( 'Ghost Icon', 'custom-widgets' ),
					'cz_btn_zoom_out_in' => esc_html__( 'Zoom Out In', 'custom-widgets' ), 
				],
			]
		);
		

		$this->add_control(
			'alt_title',
			[
				'label' => esc_html__( 'Alternative title', 'custom-widgets' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'dependency'	=> array(
					'element'				=> 'text_effect',
					'value_not_equal_to'	=> array( 'cz_btn_txt_no_fx' )
				),
			]
		);

		$this->add_control(
			'alt_subtitle',
			[
				'label' => esc_html__( 'Alternative subtitle', 'custom-widgets' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'dependency'	=> array(
					'element'				=> 'text_effect',
					'value_not_equal_to'	=> array( 'cz_btn_txt_no_fx' )
				),
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

	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_link_attributes( 'link', $settings['link'] );
		$icon = $icon_after = '';
		if( $settings['icon_type'] === 'icon' && $settings['icon'] ) {

		ob_start();
		Icons_Manager::render_icon( $settings['icon'] );
		$icon = ob_get_clean();

		} else if( $settings['icon_type'] === 'image' && $settings['image'] ) {

			$icon = '<i>' . Group_Control_Image_Size::get_attachment_image_html( $settings );
			$settings['image']['url'] = $settings['hover_image']['url'];
			$settings['image']['size'] = $settings['hover_image']['size'];
			$icon .= Group_Control_Image_Size::get_attachment_image_html( $settings );
			$icon .= '</i>';

		}
		
		// Icon position.	
		if( $settings['icon_position'] === 'after' ) {
			$icon_after = $icon;
			$icon = '';
			$settings['btn_effect'] .= ' cz_btn_icon_after';
		}

		// Subtitle
		$subtitle = $settings['subtitle'] ? '<small>' . $settings['subtitle'] . '</small>' : '';
		$alt_subtitle = $settings['alt_subtitle'] ? '<small>' . $settings['alt_subtitle'] . '</small>' : $subtitle;

		// Classes
		$classes = array();
		$classes[] = 'cz_btn';
		$classes[] = $subtitle ? 'cz_btn_subtitle' : '';
		$classes[] = $settings['text_effect'];
		$classes[] = $settings['btn_effect'];
		$classes[] = empty( $settings['btn_position'] ) ? 'cz_mobile_btn_center' : '';
		$classes[] = $settings['icon_type'] === 'image' ? 'cz_btn_has_image' : '';
		$clr = Codevz_Plus::contains( $settings['btn_position'], array( 'btn_left', 'btn_right' ) ) ? '<div class="clr"></div>' : '';
		?>
		<div class="<?php echo $settings['btn_position']; ?>">
		<div> <a <?php echo Codevz_Plus::classes( [], $classes );  ?> <?php echo $this->get_render_attribute_string( 'link' ); ?>>
		 <span><?php echo $icon; ?>
		 <strong><?php echo $settings['title']; ?>
		 <?php echo $subtitle; ?>
		 </strong>
		 <?php echo $icon_after; ?>
		 </span>
		 <b class="cz_btn_onhover">
		 <?php echo $icon; ?>
		 <strong>
		 <?php echo $settings['alt_title']; ?>
		 <?php echo $settings['alt_title'] ? $settings['alt_title']   : $settings['title']; echo $alt_subtitle; ?>
		 </strong>
		 <?php echo $icon_after; ?></b></a></div>
		</div> <?php echo $clr; ?>
		<?php
	}

	protected function content_template() {
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

		if ( settings.hover_image.url ) {
			var hover_image = {
				id: settings.hover_image.id,
				url: settings.hover_image.url,
				size: settings.image_size,
				dimension: settings.image_custom_dimension,
				model: view.getEditModel()
			};

			var hover_image_url = elementor.imagesManager.getImageUrl( hover_image );

			if ( ! hover_image_url ) {
				return;
			}
		}
		view.addRenderAttribute( 'title', 'class', 'xtra-button-title' );
		view.addInlineEditingAttributes( 'title', 'none' );
		var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' ),
			migrated = elementor.helpers.isIconMigrated( settings, 'icon' );

			var classes = 'cz_btn', 
				classes = settings.text_effect ? classes + ' ' + settings.text_effect : classes;
				classes = settings.btn_effect ? classes + ' ' + settings.btn_effect : classes;
				classes = settings.btn_position ? classes + ' ' + settings.btn_position : classes;
				classes = settings.icon_type ? classes + ' ' + settings.icon_type : classes;

			var subtitle = settings.subtitle ? '<small>' + settings.subtitle + '</small>' : '';
			var alt_subtitle = settings.alt_subtitle  ? '<small>' + settings.alt_subtitle + '</small>' : subtitle;

			var icon = icon_after = '';
			var clr = '';

			if( settings.icon_type === 'icon' && settings.icon ) {

				icon = iconHTML.value;

			} else if( settings.icon_type === 'image' && settings.image ) {

				icon = '<i><img src="' + image_url + '"><img src="' + hover_image_url + '"></i>';

			}

			// Icon position.	
			if( settings.icon_position === 'after' ) {
				var icon_after = icon;
				icon = '';
				settings.btn_effect = ' cz_btn_icon_after';
			}

		#>
		<div class="{{{settings.btn_position}}}">
		<div> <a class="{{{classes}}}" href="{{{settings.link.url}}}">
		 <span>{{{ icon }}}
		 <strong>{{{settings.title}}}
		 {{{subtitle}}}
		 </strong>
		 {{{icon_after}}}
		 </span>
		 <b class="cz_btn_onhover">
		 {{{icon}}}
		 <strong>
		 {{{settings.alt_title}}}
	   <#
			if ( settings.alt_title ) {
				#> {{{settings.alt_title}}}  <#
			}else{
				#> {{{settings.title}}} <#
			}
		 #>
		 {{{settings.alt_subtitle}}}
		 </strong>
		 {{{icon_after}}}</b></a></div>
		</div>{{{clr}}}
		<?php
	}
}