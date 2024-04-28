<?php
namespace Elementor;

use Codevz_Plus;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Xtra_Elementor_Widget_google_map extends Widget_Base {
	
	protected $id = 'cz_google_map';

    public function get_name() {
		return $this->id;
    }

    public function get_title() {
        return esc_html__( 'Google Map', 'custom-widgets' );
    }
    
    public function get_icon() {
        return 'eicon-google-maps';
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
                'label' => 'Google Map Settings',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'apikey',
			[
				'label' => esc_html__( 'Google API Key', 'custom-widgets' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
                'description' => esc_html__("Get your API Key from","codevz") . ' <a href="https://goo.gl/wVcKPP" target="_blank">' . esc_html__("Here","codevz") . '</a>',
				'default' => esc_html__( '', 'custom-widgets' ),
				'placeholder' => esc_html__( '', 'custom-widgets' ),
			]
		);

        $this->add_control(
			'lat',
			[
				'label' => esc_html__( 'Lat', 'codevz' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
                'description' => esc_html__("Find your location Lat and Long from","codevz") . ' <a href="http://www.latlong.net" target="_blank">' . esc_html__("Here","codevz") . '</a>',
				'default' => esc_html__( '40.712784', 'custom-widgets' ),
				'placeholder' => esc_html__( '40.712784', 'custom-widgets' ),
			]
		);
        
        $this->add_control(
			'long',
			[
				'label' => esc_html__( 'Long', 'custom-widgets' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( '-74.005941', 'custom-widgets' ),
				'placeholder' => esc_html__( '-74.005941', 'custom-widgets' ),
			]
		);

        $this->add_control(
			'zoom',
			[
				'label' => esc_html__( 'Zoom', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 19,
				'step' => 1,
				'default' => 14,
			]
		);

        $this->add_control(
			'offsetx',
			[
				'label' => esc_html__( 'Marker Offset X', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -400,
				'max' => 400,
				'step' => 10,
				'default' => 0,
			]
		);

        $this->add_control(
			'offsety',
			[
				'label' => esc_html__( 'Marker Offset Y', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -400,
				'max' => 400,
				'step' => 10,
				'default' => 0,
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__( 'Settings', 'custom-widgets' ),
			]
		);

        $this->add_responsive_control(
			'sk_map',
			[
				'label' => esc_html__( 'Map size', 'custom-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 50,
						'max' => 500,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
			]
		);

        $this->add_control(
			'color',
			[
				'label' => esc_html__( 'Color scheme', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => [
					'standard'  => esc_html__( 'Standard', 'custom-widgets' ),
					'light' => esc_html__( 'Light (Silver)', 'custom-widgets' ),
					'dark' => esc_html__( 'Dark', 'custom-widgets' ),
					'retro' => esc_html__( 'Retro', 'custom-widgets' ),
					'custom' => esc_html__( 'Custom Color', 'custom-widgets' ),
				],
			]
		);

        $this->add_control(
			'custom_color',
			[
				'label' => __( 'Custom color', 'custom-widgets' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
                'condition' => [
                    'color' => 'custom',
                ]
			]
		);

        $this->add_control(
			'grayscale',
			[
				'label' => esc_html__( 'Grayscale Effect?', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'custom-widgets' ),
				'label_off' => esc_html__( 'No', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_marker',
			[
				'label' => esc_html__( 'Marker', 'custom-widgets' ),
			]
		);

        $this->add_control(
			'marker',
			[
				'label' => esc_html__( 'Marker', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'off',
				'options' => [
					'off'  => esc_html__( 'Off', 'custom-widgets' ),
					'default' => esc_html__( 'Default Marker', 'custom-widgets' ),
					'custom' => esc_html__( 'Custom Image', 'custom-widgets' ),
				],
			]
		);

        $this->add_control(
			'markerimage',
			[
				'label' => esc_html__( 'Marker image', 'custom-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'marker' => 'custom',
                ]
			]
		);

        $this->add_control(
			'infowindow',
			[
				'label' => esc_html__( 'Info text', 'custom-widgets' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( '', 'custom-widgets' ),
				'placeholder' => esc_html__( '', 'custom-widgets' ),
                'condition' => [
                    'marker' => ['custom', 'default'],
                ]
			]
		);

        $this->add_control(
			'infowindowdefault',
			[
				'label' => esc_html__( 'Show info by default?', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes Please', 'custom-widgets' ),
				'label_off' => esc_html__( 'No', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition' => [
                    'marker' => ['default','custom'],
                ]
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_advanced',
			[
				'label' => esc_html__( 'ADVANCED SETTINGS', 'custom-widgets' ),
			]
		);

        $this->add_control(
			'scrollwheel',
			[
				'label' => esc_html__( 'Enable mouse wheel?', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes Please', 'custom-widgets' ),
				'label_off' => esc_html__( 'No', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition' => [
                    'marker' => ['default','custom'],
                ]
			]
		);
        
        $this->add_control(
			'hidecontrols',
			[
				'label' => esc_html__( 'Hide map controls?', 'custom-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes Please', 'custom-widgets' ),
				'label_off' => esc_html__( 'No', 'custom-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition' => [
                    'marker' => ['default','custom'],
                ]
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
        $settings = $this->get_settings_for_display();
        $settings['id'] = rand( 1111,9999 );
        $isfront = Codevz_Plus::$vc_editable ? true : false;

		// Data
		$str_data_apikey = $str_apikey = '';
		if( $settings['apikey'] ) {
			$str_apikey = '?key=' . $settings['apikey'] ;
			$str_data_apikey = ' data-api-key="' . $settings['apikey'] . '"' ;
		} else {
			return '<div style="border:1px solid #ccc;border-radius:5px;color:#bb0000;margin:20px 0;padding:30px 0;text-align: center;">
			<h3>Google API Key Error!</h3><h5 style="color:#555">Get your API Key from <a style="color:#bb0000" href="https://goo.gl/wVcKPP">here</a></h5></div>';
		}

        $classes = array();
		$classes[] = 'gmap';
		$classes[] = ( $settings['grayscale'] === 'yes' ) ? 'fx_grayscale fx_remove_grayscale_hover' : '';

		$str = '<div id="'. $settings['id'] .'"'. Codevz_Plus::classes( [], $classes ) . $str_data_apikey .  '> </div><div '. '' . '></div>';

		$str .= '<script type="text/javascript">
			function mapfucntion_' . $settings['id'] . '() {

				google.maps.Map.prototype.setCenterWithOffset= function(latlng, offsetX, offsetY) {
				    var map = this;
				    var ov = new google.maps.OverlayView();
				    ov.onAdd = function() {
				        var proj = this.getProjection();
				        var aPoint = proj.fromLatLngToContainerPixel(latlng);
				        aPoint.x = aPoint.x+offsetX;
				        aPoint.y = aPoint.y+offsetY;
				        map.setCenter(proj.fromContainerPixelToLatLng(aPoint));
				    }; 
				    ov.draw = function() {}; 
				    ov.setMap(this); 
				};

				var windx = jQuery(window), 

					latlng = new google.maps.LatLng(' . $settings['lat'] . ', ' . $settings['long'] . '),

					myOptions = {
						zoom: ' . ( $settings['zoom'] ? $settings['zoom'] : 14 ) . ',
						scrollwheel: ' . ( ( $settings['scrollwheel'] === 'yes' ) ? 'true' : 'false' ) . ',
						disableDefaultUI: ' . ( ( $settings['hidecontrols'] === 'true' ) ? 'true' : 'false' ) . ',
						center: latlng
					},

					' . $settings['id'] . ' = new google.maps.Map(document.getElementById("' . $settings['id'] . '"),
					myOptions),

					setCenterOffset = function() {

						if ( windx.width() < 768 ) {
							' . $settings['id'] . '.setCenterWithOffset( latlng, 0, 0 );
						} else {
							' . $settings['id'] . '.setCenterWithOffset( latlng, ' . $settings['offsetx'] . ', ' . $settings['offsety'] . ' );
						}

					};

				setCenterOffset();

				windx.on( "resize", function() {
					setCenterOffset();
				});
			';
		
		if ($settings['color']!='standard'){
			switch ($settings['color']) {
				case 'light':
					$str .= 'var styles = [{"elementType": "geometry","stylers": [{"color": "#f5f5f5"}]},{"elementType": "labels.icon","stylers": [{"visibility": "off"}]},{"elementType": "labels.text.fill","stylers": [{"color": "#616161"}]},{"elementType": "labels.text.stroke","stylers": [{"color": "#f5f5f5"}]},{"featureType": "administrative.land_parcel","elementType": "labels","stylers": [{"visibility": "off"}]},{"featureType": "administrative.land_parcel","elementType": "labels.text.fill","stylers": [{"color": "#bdbdbd"}]},{"featureType": "poi","elementType": "geometry","stylers": [{"color": "#eeeeee"}]},{"featureType": "poi","elementType": "labels.text","stylers": [{"visibility": "off"}]},{"featureType": "poi","elementType": "labels.text.fill","stylers": [{"color": "#757575"}]},{"featureType": "poi.park","elementType": "geometry","stylers": [{"color": "#e5e5e5"}]},{"featureType": "poi.park","elementType": "labels.text.fill","stylers": [{"color": "#9e9e9e"}]},{"featureType": "road","elementType": "geometry","stylers": [{"color": "#ffffff"}]},{"featureType": "road.arterial","elementType": "labels.text.fill","stylers": [{"color": "#757575"}]},{"featureType": "road.highway","elementType": "geometry","stylers": [{"color": "#dadada"}]},{"featureType": "road.highway","elementType": "labels.text.fill","stylers": [{"color": "#616161"}]},{"featureType": "road.local","elementType": "labels","stylers": [{"visibility": "off"}]},{"featureType": "road.local","elementType": "labels.text.fill","stylers": [{"color": "#9e9e9e"}]},{"featureType": "transit.line","elementType": "geometry","stylers": [{"color": "#e5e5e5"}]},{"featureType": "transit.station","elementType": "geometry","stylers": [{"color": "#eeeeee"}]},{"featureType": "water","elementType": "geometry","stylers": [{"color": "#c9c9c9"}]},{"featureType": "water","elementType": "labels.text.fill","stylers": [{"color": "#9e9e9e"}]}];';
					break;
				case 'dark':
					$str .= 'var styles =[{"elementType": "geometry","stylers": [{"color": "#212121"}]},{"elementType": "labels.icon","stylers": [{"visibility": "off"}]},{"elementType": "labels.text.fill","stylers": [{"color": "#757575"}]},{"elementType": "labels.text.stroke","stylers": [{"color": "#212121"}]},{"featureType": "administrative","elementType": "geometry","stylers": [{"color": "#757575"}]},{"featureType": "administrative.country","elementType": "labels.text.fill","stylers": [{"color": "#9e9e9e"}]},{"featureType": "administrative.land_parcel","stylers": [{"visibility": "off"}]},{"featureType": "administrative.land_parcel","elementType": "labels","stylers": [{"visibility": "off"}]},{"featureType": "administrative.locality","elementType": "labels.text.fill","stylers": [{"color": "#bdbdbd"}]},{"featureType": "poi","elementType": "labels.text","stylers": [{"visibility": "off"}]},{"featureType": "poi","elementType": "labels.text.fill","stylers": [{"color": "#757575"}]},{"featureType": "poi.park","elementType": "geometry","stylers": [{"color": "#181818"}]},{"featureType": "poi.park","elementType": "labels.text.fill","stylers": [{"color": "#616161"}]},{"featureType": "poi.park","elementType": "labels.text.stroke","stylers": [{"color": "#1b1b1b"}]},{"featureType": "road","elementType": "geometry.fill","stylers": [{"color": "#2c2c2c"}]},{"featureType": "road","elementType": "labels.text.fill","stylers": [{"color": "#8a8a8a"}]},{"featureType": "road.arterial","elementType": "geometry","stylers": [{"color": "#373737"}]},{"featureType": "road.highway","elementType": "geometry","stylers": [{"color": "#3c3c3c"}]},{"featureType": "road.highway.controlled_access","elementType": "geometry","stylers": [{"color": "#4e4e4e"}]},{"featureType": "road.local","elementType": "labels","stylers": [{"visibility": "off"}]},{"featureType": "road.local","elementType": "labels.text.fill","stylers": [{"color": "#616161"}]},{"featureType": "transit","elementType": "labels.text.fill","stylers": [{"color": "#757575"}]},{"featureType": "water","elementType": "geometry","stylers": [{"color": "#000000"}]},{"featureType": "water","elementType": "labels.text.fill","stylers": [{"color": "#3d3d3d"}]}];';
					break;
				case 'retro':
					$str .= 'var styles =[{"elementType": "geometry","stylers": [{"color": "#ebe3cd"}]},{"elementType": "labels.text.fill","stylers": [{"color": "#523735"}]},{"elementType": "labels.text.stroke","stylers": [{"color": "#f5f1e6"}]},{"featureType": "administrative","elementType": "geometry.stroke","stylers": [{"color": "#c9b2a6"}]},{"featureType": "administrative.land_parcel","elementType": "geometry.stroke","stylers": [{"color": "#dcd2be"}]},{"featureType": "administrative.land_parcel","elementType": "labels","stylers": [{"visibility": "off"}]},{"featureType": "administrative.land_parcel","elementType": "labels.text.fill","stylers": [{"color": "#ae9e90"}]},{"featureType": "landscape.natural","elementType": "geometry","stylers": [{"color": "#dfd2ae"}]},{"featureType": "poi","elementType": "geometry","stylers": [{"color": "#dfd2ae"}]},{"featureType": "poi","elementType": "labels.text","stylers": [{"visibility": "off"}]},{"featureType": "poi","elementType": "labels.text.fill","stylers": [{"color": "#93817c"}]},{"featureType": "poi.park","elementType": "geometry.fill","stylers": [{"color": "#a5b076"}]},{"featureType": "poi.park","elementType": "labels.text.fill","stylers": [{"color": "#447530"}]},{"featureType": "road","elementType": "geometry","stylers": [{"color": "#f5f1e6"}]},{"featureType": "road.arterial","elementType": "geometry","stylers": [{"color": "#fdfcf8"}]},{"featureType": "road.highway","elementType": "geometry","stylers": [{"color": "#f8c967"}]},{"featureType": "road.highway","elementType": "geometry.stroke","stylers": [{"color": "#e9bc62"}]},{"featureType": "road.highway.controlled_access","elementType": "geometry","stylers": [{"color": "#e98d58"}]},{"featureType": "road.highway.controlled_access","elementType": "geometry.stroke","stylers": [{"color": "#db8555"}]},{"featureType": "road.local","elementType": "labels","stylers": [{"visibility": "off"}]},{"featureType": "road.local","elementType": "labels.text.fill","stylers": [{"color": "#806b63"}]},{"featureType": "transit.line","elementType": "geometry","stylers": [{"color": "#dfd2ae"}]},{"featureType": "transit.line","elementType": "labels.text.fill","stylers": [{"color": "#8f7d77"}]},{"featureType": "transit.line","elementType": "labels.text.stroke","stylers": [{"color": "#ebe3cd"}]},{"featureType": "transit.station","elementType": "geometry","stylers": [{"color": "#dfd2ae"}]},{"featureType": "water","elementType": "geometry.fill","stylers": [{"color": "#b9d3c2"}]},{"featureType": "water","elementType": "labels.text.fill","stylers": [{"color": "#92998d"}]}];';
					break;
				case 'custom':
					if ($settings['custom_color']!=''){
						$str .= 'var styles = [{"featureType": "all",stylers: [{ hue: "'.$settings['custom_color'].'" },{ saturation: -20}]}];';		
					}
					break;
			}
			
			$str .= 'var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});';
			$str .=  $settings['id'] . '.mapTypes.set("map_style", styledMap);  ';
			$str .=  $settings['id'] . '.setMapTypeId("map_style");';
		}


		if ($settings['marker'] !='off'){
			
			$marker_icon ='';
			if($settings['marker']==='custom'){
				$img = Group_Control_Image_Size::get_attachment_image_html( $settings, 'markerimage' );
				$str .= 'var image = "'. $img .'";';
				$marker_icon .= 'icon: image,';
			}

			$str .= 'var marker = new google.maps.Marker({map: ' . $settings['id'] . ',';
			$str .= $marker_icon;
			if ($isfront){
			$str .= 'draggable:true,';	
			}
			$str .= 'position: ' . $settings['id'] . '.getCenter()});';

			if($isfront){
				$str .='google.maps.event.addListener(marker, "dragstart", function(marker){
					        var elm = jQuery("#'.$settings['id'].'").parent();
							jQuery("> .vc_controls .vc-c-icon-mode_edit", elm ).trigger("click");
					     });';

				$str .='google.maps.event.addListener(marker, "dragend", function(marker){
					        var latLng = marker.latLng; 
					        currentLatitude = latLng.lat();
					        currentLongitude = latLng.lng();
							jQuery( ".lat", parent.document.body ).val( currentLatitude);
							jQuery( ".long", parent.document.body ).val(currentLongitude);

					     });';
			}

		}

		if($settings['infowindow'] != '') {
			$thiscontent = htmlspecialchars_decode($settings['infowindow']);
			$str .= '
			var contentString = \'<div class="infowindow" style="white-space:nowrap">' . $thiscontent . '</div>\';
			var infowindow = new google.maps.InfoWindow({
				content: contentString
			});
						
			google.maps.event.addListener(marker, \'click\', function() {
			  infowindow.open(' . $settings['id'] . ',marker);
			});
			';

			if ($settings['infowindowdefault'] == 'yes')
			{
				$str .= 'infowindow.open(' . $settings['id'] . ',marker);';
			}
		}

		$str .= '}</script>';

        echo $str;
        echo $isfront ? '<script type="text/javascript">if ( typeof google != "undefined"){mapfucntion_' . $settings['id'] . '();}</script>' : '';
  



    }

}