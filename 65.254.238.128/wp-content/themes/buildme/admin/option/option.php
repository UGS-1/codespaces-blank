<?php
$top_nav_info_box_array =		array(
									array(
										'type' => 'fontawesome',
										'name' => 'ozy_buildme_top_nav_info_icon',
										'label' => esc_attr__('Icon', 'vp_textdomain') . ' ('. OZY_WPLANG . ')',
										'default' => 'oic-location-1'
									),
									array(
										'type' => 'textbox',
										'name' => 'ozy_buildme_top_nav_info',
										'label' => esc_attr__('Content', 'vp_textdomain') . ' ('. OZY_WPLANG . ')',
										'default' => esc_attr__('Unit D2/D3, Wira Offie Park LS16 6EB', 'vp_textdomain')
									)
								);
								
$logo_side_info_box_array =		array(
									array(
										'type' => 'toggle',
										'name' => 'ozy_buildme_logo_side_info_active1',
										'label' => esc_attr__('Activate Info Section #1', 'vp_textdomain') . ' ('. OZY_WPLANG . ')',
										'default' => '1',
									),
									array(
										'type' => 'fontawesome',
										'name' => 'ozy_buildme_logo_side_info_icon1',
										'label' => esc_attr__('Icon #1', 'vp_textdomain') . ' ('. OZY_WPLANG . ')',
										'default' => 'oic-flaticon5-Phone2'
									),
									array(
										'type' => 'textbox',
										'name' => 'ozy_buildme_logo_side_info_title1',
										'label' => esc_attr__('Title #1', 'vp_textdomain') . ' ('. OZY_WPLANG . ')',
										'default' => esc_attr__('Customer Support & Sales', 'vp_textdomain')
									),
									array(
										'type' => 'textbox',
										'name' => 'ozy_buildme_logo_side_info_value1',
										'label' => esc_attr__('Value #1', 'vp_textdomain') . ' ('. OZY_WPLANG . ')',
										'default' => esc_attr__('+80 664 578 78 64', 'vp_textdomain')
									),
									array(
										'type' => 'toggle',
										'name' => 'ozy_buildme_logo_side_info_active2',
										'label' => esc_attr__('Activate Info Section #2', 'vp_textdomain') . ' ('. OZY_WPLANG . ')',
										'default' => '1',
									),									
									array(
										'type' => 'fontawesome',
										'name' => 'ozy_buildme_logo_side_info_icon2',
										'label' => esc_attr__('Icon #2', 'vp_textdomain') . ' ('. OZY_WPLANG . ')',
										'default' => 'oic-flaticon5-Time'
									),
									array(
										'type' => 'textbox',
										'name' => 'ozy_buildme_logo_side_info_title2',
										'label' => esc_attr__('Title #2', 'vp_textdomain') . ' ('. OZY_WPLANG . ')',
										'default' => esc_attr__('Opening Times', 'vp_textdomain')
									),
									array(
										'type' => 'textbox',
										'name' => 'ozy_buildme_logo_side_info_value2',
										'label' => esc_attr__('Value #2', 'vp_textdomain') . ' ('. OZY_WPLANG . ')',
										'default' => esc_attr__('Mon - Sat 08:00 - 17:30', 'vp_textdomain')
									),
									array(
										'type' => 'toggle',
										'name' => 'ozy_buildme_logo_side_info_active3',
										'label' => esc_attr__('Is Shopping Bag Active?', 'vp_textdomain') . ' ('. OZY_WPLANG . ')',
										'description' => esc_attr__('Requires WooCommerce plugin installed and activated', 'vp_textdomain'),
										'default' => '1',
									),																								
								);								
								
$footer_copyright_array =		array(
									array(
										'type' => 'textbox',
										'name' => 'ozy_buildme_section_footer_copyright_text',
										'label' => esc_attr__('Footer Text', 'vp_textdomain') . ' ('. OZY_WPLANG . ')',
										'default' => esc_attr__('&copy; 2016 BuildMe - All Rights Reserved', 'vp_textdomain')
									)
								);

if(ozy_is_wpml_active()){
	$languages = icl_get_languages('skip_missing=0&orderby=code');
	if(!empty($languages)){
		foreach($languages as $l){
			if(OZY_WPLANG != $l['language_code']) {
				array_push($top_nav_info_box_array, array(
													'type' => 'fontawesome',
													'name' => 'ozy_buildme_top_nav_info_icon' . $l['language_code'],
													'label' => esc_attr__('Icon', 'vp_textdomain') . ' (' . strtoupper($l['native_name']) .')',
													'default' => 'oic-location-1'
												),				
												array(
													'type' => 'textbox',
													'name' => 'ozy_buildme_top_nav_info' . $l['language_code'],
													'label' => esc_attr__('Content', 'vp_textdomain') . ' (' . strtoupper($l['native_name']) .')'
												));

				array_push($logo_side_info_box_array, 
									array(
										'type' => 'toggle',
										'name' => 'ozy_buildme_logo_side_info_active1' . $l['language_code'],
										'label' => esc_attr__('Activate Info Section #1', 'vp_textdomain') . ' (' . strtoupper($l['native_name']) .')',
										'default' => '1',
									),
									array(
										'type' => 'fontawesome',
										'name' => 'ozy_buildme_logo_side_info_icon1' . $l['language_code'],
										'label' => esc_attr__('Icon #1', 'vp_textdomain') . ' (' . strtoupper($l['native_name']) .')',
										'default' => 'oic-flaticon5-Phone2'
									),
									array(
										'type' => 'textbox',
										'name' => 'ozy_buildme_logo_side_info_title1' . $l['language_code'],
										'label' => esc_attr__('Title #1', 'vp_textdomain') . ' (' . strtoupper($l['native_name']) .')',
										'default' => esc_attr__('Customer Support & Sales', 'vp_textdomain')
									),
									array(
										'type' => 'textbox',
										'name' => 'ozy_buildme_logo_side_info_value1' . $l['language_code'],
										'label' => esc_attr__('Value #1', 'vp_textdomain') . ' (' . strtoupper($l['native_name']) .')',
										'default' => esc_attr__('+80 664 578 78 64', 'vp_textdomain')
									),
									array(
										'type' => 'toggle',
										'name' => 'ozy_buildme_logo_side_info_active2' . $l['language_code'],
										'label' => esc_attr__('Activate Info Section #2', 'vp_textdomain') . ' (' . strtoupper($l['native_name']) .')',
										'default' => '1',
									),									
									array(
										'type' => 'fontawesome',
										'name' => 'ozy_buildme_logo_side_info_icon2' . $l['language_code'],
										'label' => esc_attr__('Icon #2', 'vp_textdomain') . ' (' . strtoupper($l['native_name']) .')',
										'default' => 'oic-flaticon5-Time'
									),
									array(
										'type' => 'textbox',
										'name' => 'ozy_buildme_logo_side_info_title2' . $l['language_code'],
										'label' => esc_attr__('Title #2', 'vp_textdomain') . ' (' . strtoupper($l['native_name']) .')',
										'default' => esc_attr__('Opening Times', 'vp_textdomain')
									),
									array(
										'type' => 'textbox',
										'name' => 'ozy_buildme_logo_side_info_value2' . $l['language_code'],
										'label' => esc_attr__('Value #2', 'vp_textdomain') . ' (' . strtoupper($l['native_name']) .')',
										'default' => esc_attr__('Mon - Sat 08:00 - 17:30', 'vp_textdomain')
									),
									array(
										'type' => 'toggle',
										'name' => 'ozy_buildme_logo_side_info_active3' . $l['language_code'],
										'label' => esc_attr__('Is Shopping Bag Active?', 'vp_textdomain') . ' (' . strtoupper($l['native_name']) .')',
										'description' => esc_attr__('Requires WooCommerce plugin installed and activated', 'vp_textdomain'),
										'default' => '1',
									)																							
								);
				
				array_push($footer_copyright_array, array(
													'type' => 'textbox',
													'name' => 'ozy_buildme_section_footer_copyright_text' . $l['language_code'],
													'label' => esc_attr__('Footer Text', 'vp_textdomain') . ' (' . strtoupper($l['native_name']) .')'
												));									
			}
		}
	}
}

//return 
$ozy_buildme_option_arr = array(
	'title' => esc_attr__('BUILDME Option Panel', 'vp_textdomain'),
	'logo' => OZY_BASE_URL . 'admin/images/logo.png',
	'menus' => array(
		array(
			'title' => esc_attr__('General Options', 'vp_textdomain'),
			'name' => 'ozy_buildme_general_options',
			'icon' => 'font-awesome:fa-gear',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => esc_attr__('General', 'vp_textdomain'),
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'ozy_buildme_back_to_top_button',
							'label' => esc_attr__('Back To Top Button', 'vp_textdomain'),
							'description' => esc_attr__('Enable / Disable Back To Top Button globally.', 'vp_textdomain'),
							'default' => '1',
						),						
						array(
							'type' => 'upload',
							'name' => 'ozy_buildme_favicon',
							'label' => esc_attr__('Favicon', 'vp_textdomain'),
							'description' => esc_attr__('Upload a 16px x 16px .png or .gif image, will be set as your favicon.', 'vp_textdomain'),
							'default' => get_stylesheet_directory_uri() . '/favico.gif',

						),
						array(
							'type' => 'upload',
							'name' => 'ozy_buildme_favicon_apple_small',
							'label' => esc_attr__('Apple Touch Icon (small)', 'vp_textdomain'),
							'description' => esc_attr__('Upload a 57px x 57px .png image, will be set as your small Apple Touch Icon.', 'vp_textdomain'),
							'default' => get_stylesheet_directory_uri() . '/images/favico_57.png',
						),array(
							'type' => 'upload',
							'name' => 'ozy_buildme_favicon_apple_medium',
							'label' => esc_attr__('Apple Touch Icon (medium)', 'vp_textdomain'),
							'description' => esc_attr__('Upload a 76px x 76px .png image, will be set as your large Apple Touch Icon (iPad).', 'vp_textdomain'),
							'default' => get_stylesheet_directory_uri() . '/images/favico_76.png',
						),array(
							'type' => 'upload',
							'name' => 'ozy_buildme_favicon_apple_large',
							'label' => esc_attr__('Apple Touch Icon (large)', 'vp_textdomain'),
							'description' => esc_attr__('Upload a 120px x 120px .png image, will be set as your large Apple Touch Icon (iPhone Retina).', 'vp_textdomain'),
							'default' => get_stylesheet_directory_uri() . '/images/favico_120.png',
						),array(
							'type' => 'upload',
							'name' => 'ozy_buildme_favicon_apple_xlarge',
							'label' => esc_attr__('Apple Touch Icon (large)', 'vp_textdomain'),
							'description' => esc_attr__('Upload a 152px x 152px .png image, will be set as your large Apple Touch Icon (iPad Retina).', 'vp_textdomain'),
							'default' => get_stylesheet_directory_uri() . '/images/favico_152.png',
						),
						array(
							'type' => 'codeeditor',
							'name' => 'ozy_buildme_custom_css',
							'label' => esc_attr__('Custom CSS', 'vp_textdomain'),
							'description' => esc_attr__('Write your custom css here. Please do not add "style" tags.', 'vp_textdomain'),
							'theme' => 'eclipse',
							'mode' => 'css',
						),
						array(
							'type' => 'codeeditor',
							'name' => 'ozy_buildme_custom_script',
							'label' => esc_attr__('Custom JS', 'vp_textdomain'),
							'description' => esc_attr__('Write your custom js here. Please do not add script tags into this box. Please do not add "script" tags.', 'vp_textdomain'),
							'theme' => 'mono_industrial',
							'mode' => 'javascript',
						),
					),
				),
			),
		),
		
		
		array(
			'title' => esc_attr__('Typography', 'vp_textdomain'),
			'name' => 'ozy_buildme_typography',
			'icon' => 'font-awesome:fa-pencil',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => esc_attr__('Extended Parameters', 'vp_textdomain'),
					'fields' => array(
						array(
							'type' => 'textbox',
							'name' => 'ozy_buildme_typography_google_param',
							'description' => 'Add extra parameters here. By this option, you can load non-latin charset or more types byt available parameters. Use like ":400,100,300,700".',
							'default' => ':100,200,300,400,500,600,700,800,900'
						),
					)
				),			
				array(
					'type' => 'section',
					'title' => esc_attr__('Content Typography', 'vp_textdomain'),
					'fields' => array(
						array(
							'type' => 'html',
							'name' => 'ozy_buildme_typography_font_preview',
							'binding' => array(
								'field'    => 'ozy_buildme_typography_font_face,ozy_buildme_typography_font_style,ozy_buildme_typography_font_weight,ozy_buildme_typography_font_size, ozy_buildme_typography_font_line_height',
								'function' => 'vp_font_preview',
							),
						),
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_typography_font_face',
							'label' => esc_attr__('Font Face', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'default' => 'Open Sans'
						),
						array(
							'type' => 'radiobutton',
							'name' => 'ozy_buildme_typography_font_style',
							'label' => esc_attr__('Font Style', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'ozy_buildme_typography_font_face',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'normal',
							),
						),
						array(
							'type' => 'radiobutton',
							'name' => 'ozy_buildme_typography_font_weight',
							'label' => esc_attr__('Font Weight', 'vp_textdomain'),
							'default' => 'normal',
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'ozy_buildme_typography_font_face',
										'value' => 'vp_get_gwf_weight',
									),
								),
							),
						),
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_typography_font_size',
							'label'   => esc_attr__('Font Size (px)', 'vp_textdomain'),
							'min'     => '5',
							'max'     => '86',
							'default' => '14',
						),
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_typography_font_line_height',
							'label'   => esc_attr__('Line Height (em)', 'vp_textdomain'),
							'min'     => '0',
							'max'     => '3',
							'default' => '1.5',
							'step'    => '0.1',
						),
					),
				),
				array(
					'type' => 'section',
					'title' => esc_attr__('Heading Typography', 'vp_textdomain'),
					'fields' => array(
						array(
							'type' => 'html',
							'name' => 'ozy_buildme_typography_heading_font_preview',
							'binding' => array(
								'field'    => 'ozy_buildme_typography_heading_font_face,ozy_buildme_typography_heading_font_style,ozy_buildme_typography_heading_font_weight,ozy_buildme_typography_heading_h1_font_size',
								'function' => 'vp_font_preview_simple',
							),
						),
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_typography_heading_font_face',
							'label' => esc_attr__('Font Face', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'default' => 'Raleway'
						)
					),
				),
				array(
					'type' => 'section',
					'title' => esc_attr__('H1 Options', 'vp_textdomain'),
					'fields' => array(
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_typography_heading_h1_font_size',
							'label'   => esc_attr__('H1 Size (px)', 'vp_textdomain'),
							'min'     => '5',
							'max'     => '128',
							'default' => '40',
						),
						array(
							'type' => 'radiobutton',
							'name' => 'ozy_buildme_typography_heading_h1_font_style',
							'label' => esc_attr__('H1 Font Style', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'ozy_buildme_typography_heading_font_face',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'normal',
							),
						),
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_typography_heading_font_weight_h1',
							'label' => esc_attr__('H1 Weight', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_font_weight_list',
									),
								),
							),
							'default' => array(
								'700',
							),							
						),
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_typography_heading_line_height_h1',
							'label'   => esc_attr__('H1 Line Height (em)', 'vp_textdomain'),
							'min'     => '0',
							'max'     => '3',
							'default' => '1.5',
							'step'    => '0.1',
						),					
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_typography_heading_font_ls_h1',
							'label' => esc_attr__('H1 Letter Spacing', 'vp_textdomain'),
							'default' => 'normal',							
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_font_letter_spacing_list',
									),
								),
							),
						),
					),
				),
				array(
					'type' => 'section',
					'title' => esc_attr__('H2 Options', 'vp_textdomain'),
					'fields' => array(												
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_typography_heading_h2_font_size',
							'label'   => esc_attr__('H2 Size (px)', 'vp_textdomain'),
							'min'     => '5',
							'max'     => '128',
							'default' => '30',
						),
						array(
							'type' => 'radiobutton',
							'name' => 'ozy_buildme_typography_heading_h2_font_style',
							'label' => esc_attr__('H2 Font Style', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'ozy_buildme_typography_heading_font_face',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'normal',
							),
						),						
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_typography_heading_font_weight_h2',
							'label' => esc_attr__('H2 Weight', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_font_weight_list',
									),
								),
							),
							'default' => array(
								'700',
							),
						),
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_typography_heading_line_height_h2',
							'label'   => esc_attr__('H2 Line Height (em)', 'vp_textdomain'),
							'min'     => '0',
							'max'     => '3',
							'default' => '1.5',
							'step'    => '0.1',
						),						
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_typography_heading_font_ls_h2',
							'label' => esc_attr__('H2 Letter Spacing', 'vp_textdomain'),
							'default' => 'normal',
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_font_letter_spacing_list',
									),
								),
							),
						),
					),
				),
				array(
					'type' => 'section',
					'title' => esc_attr__('H3 Options', 'vp_textdomain'),
					'fields' => array(						
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_typography_heading_h3_font_size',
							'label'   => esc_attr__('H3 Size (px)', 'vp_textdomain'),
							'min'     => '5',
							'max'     => '128',
							'default' => '26',
						),
						array(
							'type' => 'radiobutton',
							'name' => 'ozy_buildme_typography_heading_h3_font_style',
							'label' => esc_attr__('H3 Font Style', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'ozy_buildme_typography_heading_font_face',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'normal',
							),
						),						
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_typography_heading_font_weight_h3',
							'label' => esc_attr__('H3 Weight', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_font_weight_list',
									),
								),
							),
							'default' => array(
								'700',
							),							
						),
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_typography_heading_line_height_h3',
							'label'   => esc_attr__('H3 Line Height (em)', 'vp_textdomain'),
							'min'     => '0',
							'max'     => '3',
							'default' => '1.5',
							'step'    => '0.1',
						),						
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_typography_heading_font_ls_h3',
							'label' => esc_attr__('H3 Letter Spacing', 'vp_textdomain'),
							'default' => 'normal',							
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_font_letter_spacing_list',
									),
								),
							),
						),
					),
				),
				array(
					'type' => 'section',
					'title' => esc_attr__('H4 Options', 'vp_textdomain'),
					'fields' => array(						
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_typography_heading_h4_font_size',
							'label'   => esc_attr__('H4 Size (px)', 'vp_textdomain'),
							'min'     => '5',
							'max'     => '128',
							'default' => '18',
						),
						array(
							'type' => 'radiobutton',
							'name' => 'ozy_buildme_typography_heading_h4_font_style',
							'label' => esc_attr__('H4 Font Style', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'ozy_buildme_typography_heading_font_face',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'normal',
							),
						),						
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_typography_heading_font_weight_h4',
							'label' => esc_attr__('H4 Weight', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_font_weight_list',
									),
								),
							),
							'default' => array(
								'700',
							),							
						),
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_typography_heading_line_height_h4',
							'label'   => esc_attr__('H4 Line Height (em)', 'vp_textdomain'),
							'min'     => '0',
							'max'     => '3',
							'default' => '1.5',
							'step'    => '0.1',
						),						
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_typography_heading_font_ls_h4',
							'label' => esc_attr__('H4 Letter Spacing', 'vp_textdomain'),
							'default' => 'normal',							
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_font_letter_spacing_list',
									),
								),
							),
						),
					),
				),
				array(
					'type' => 'section',
					'title' => esc_attr__('H5 Options', 'vp_textdomain'),
					'fields' => array(						
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_typography_heading_h5_font_size',
							'label'   => esc_attr__('H5 Size (px)', 'vp_textdomain'),
							'min'     => '5',
							'max'     => '128',
							'default' => '16',
						),
						array(
							'type' => 'radiobutton',
							'name' => 'ozy_buildme_typography_heading_h5_font_style',
							'label' => esc_attr__('H5 Font Style', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'ozy_buildme_typography_heading_font_face',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'normal',
							),
						),						
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_typography_heading_font_weight_h5',
							'label' => esc_attr__('H5 Weight', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_font_weight_list',
									),
								),
							),
							'default' => array(
								'600',
							),							
						),
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_typography_heading_line_height_h5',
							'label'   => esc_attr__('H5 Line Height (em)', 'vp_textdomain'),
							'min'     => '0',
							'max'     => '3',
							'default' => '1.5',
							'step'    => '0.1',
						),						
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_typography_heading_font_ls_h5',
							'label' => esc_attr__('H5 Letter Spacing', 'vp_textdomain'),
							'default' => 'normal',							
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_font_letter_spacing_list',
									),
								),
							),
						),
					),
				),
				array(
					'type' => 'section',
					'title' => esc_attr__('H6 Options', 'vp_textdomain'),
					'fields' => array(						
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_typography_heading_h6_font_size',
							'label'   => esc_attr__('H6 Size (px)', 'vp_textdomain'),
							'min'     => '5',
							'max'     => '128',
							'default' => '14',
						),
						array(
							'type' => 'radiobutton',
							'name' => 'ozy_buildme_typography_heading_h6_font_style',
							'label' => esc_attr__('H6 Font Style', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'ozy_buildme_typography_heading_font_face',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'normal',
							),
						),						
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_typography_heading_font_weight_h6',
							'label' => esc_attr__('H6 Weight', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_font_weight_list',
									),
								),
							),
							'default' => array(
								'800',
							),							
						),
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_typography_heading_line_height_h6',
							'label'   => esc_attr__('H6 Line Height (em)', 'vp_textdomain'),
							'min'     => '0',
							'max'     => '3',
							'default' => '1.5',
							'step'    => '0.1',
						),						
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_typography_heading_font_ls_h6',
							'label' => esc_attr__('H6 Letter Spacing', 'vp_textdomain'),
							'default' => 'normal',
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_font_letter_spacing_list',
									),
								),
							),
						),						
					),
				),
				

				array(
					'type' => 'section',
					'title' => esc_attr__('Primary Menu Typography', 'vp_textdomain'),
					'name' => 'ozy_buildme_primary_menu_section_typography',
					'fields' => array(
						array(
							'type' => 'select',
							'name' => 'ozy_buildme_primary_menu_typography_font_face',
							'label' => esc_attr__('Font Face', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							'default' => 'Raleway'
						),
						array(
							'type' => 'radiobutton',
							'name' => 'ozy_buildme_primary_menu_typography_font_style',
							'label' => esc_attr__('Font Style', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'ozy_buildme_primary_menu_typography_font_face',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'normal',
							),
						),
						array(
							'type' => 'radiobutton',
							'name' => 'ozy_buildme_primary_menu_typography_font_weight',
							'label' => esc_attr__('Font Weight', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'ozy_buildme_primary_menu_typography_font_face',
										'value' => 'vp_get_gwf_weight',
									),
								),
							),
							'default' => array(
								'800',
							),
						),
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_primary_menu_typography_font_size',
							'label'   => esc_attr__('Font Size (px)', 'vp_textdomain'),
							'min'     => '5',
							'max'     => '128',
							'default' => '13',
						),
						array(
							'type'    => 'slider',
							'name'    => 'ozy_buildme_primary_menu_typography_line_height',
							'label'   => esc_attr__('Line Height (em)', 'vp_textdomain'),
							'min'     => '0',
							'max'     => '3',
							'default' => '1.5',

							'step'    => '0.1',
						),
					),
				),
								
			),
		),
		
				
		array(
			'title' => esc_attr__('Layout', 'vp_textdomain'),
			'name' => 'ozy_buildme_layout',
			'icon' => 'font-awesome:fa-magic',
			'menus' => array(
				array(
					'title' => esc_attr__('Primary Menu / Logo', 'vp_textdomain'),
					'name' => 'ozy_buildme_primary_menu',
					'icon' => 'font-awesome:fa-cogs',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => esc_attr__('Top Info Bar', 'vp_textdomain'),
							'name' => 'ozy_buildme_section_top_nav_info_box_layout',
							'fields' => $top_nav_info_box_array
						),
						
						array(
							'type' => 'section',
							'title' => esc_attr__('Logo Side Info Bar', 'vp_textdomain'),
							'name' => 'ozy_buildme_section_logo_side_info_box_layout',
							'fields' => $logo_side_info_box_array
						),						
					
						array(
							'type' => 'section',
							'title' => esc_attr__('Primary Menu', 'vp_textdomain'),
							'name' => 'ozy_buildme_section_header_layout',
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'ozy_buildme_primary_sticky_menu',
									'label' => esc_attr__('Sticky Menu', 'vp_textdomain'),
									'default' => 1
								),							
								array(
									'type' => 'radiobutton',
									'name' => 'ozy_buildme_primary_menu_align',
									'label' => esc_attr__('Menu Align', 'vp_textdomain'),
									'items' => array(
										array(
											'value' => 'left',
											'label' => esc_attr__('Left', 'vp_textdomain'),
										),
										array(
											'value' => 'center',
											'label' => esc_attr__('Center', 'vp_textdomain'),
										),
										array(
											'value' => 'right',
											'label' => esc_attr__('Right', 'vp_textdomain'),
										)										
									),
									'default' => array(
										'left',
									),
								),
								array(
									'type' => 'notebox',
									'name' => 'ozy_buildme_primary_menu_align_info',
									'label' => esc_attr__('Center Menu Position', 'vp_textdomain'),
									'description' => esc_attr__('In case “center align” selected; some of elements gets hide such as ; Request a Rate, Search button, Customer Support & Sales and Opening Times info.', 'vp_textdomain'),
									'dependency' => array(
										'field' => 'ozy_buildme_primary_menu_align',
										'function' => 'vp_dep_if_center_selected',
									),
									'status' => 'info',
								),																
								array(
									'type'    => 'slider',
									'name'    => 'ozy_buildme_primary_menu_height',
									'label'   => esc_attr__('Menu / Logo Height', 'vp_textdomain'),
									'description'   => esc_attr__('Set this value to fit at least same as your logo height for perfect results', 'vp_textdomain'),
									'min'     => '40',
									'max'     => '500',
									'default' => '92',
								),								
								array(
									'type' => 'radiobutton',
									'name' => 'ozy_buildme_primary_menu_search',
									'label' => esc_attr__('Search Button / Box', 'vp_textdomain'),
									'items' => array(
										array(
											'value' => '1',
											'label' => esc_attr__('On', 'vp_textdomain'),
										),
										array(
											'value' => '-1',
											'label' => esc_attr__('Off', 'vp_textdomain'),
										)
									),
									'default' => array(
										'1',
									),
								)
							),
						),
						array(
							'type' => 'section',
							'title' => esc_attr__('Logo', 'vp_textdomain'),
							'name' => 'ozy_buildme_section_image_logo',
							'description' => esc_attr__('You can use custom image logo for your site. To use this option, first activate \'Use Custom Logo\' switch', 'vp_textdomain'),
							'fields' => array(				
								array(
									'type' => 'toggle',
									'name' => 'ozy_buildme_use_custom_logo',
									'label' => esc_attr__('Use Custom Logo', 'vp_textdomain'),
									'default' => 1,
									'description' => esc_attr__('Use custom logo or text logo', 'vp_textdomain'),
								),
								array(
									'type' => 'upload',
									'name' => 'ozy_buildme_custom_logo',
									'label' => esc_attr__('Custom Logo', 'vp_textdomain'),
									'default' => OZY_BASE_URL . 'images/logo.png',
									'dependency' => array(
										'field' => 'ozy_buildme_use_custom_logo',
										'function' => 'vp_dep_boolean',
									),
									'description' => esc_attr__('Upload or choose custom logo', 'vp_textdomain'),
								),								
								array(
									'type' => 'upload',
									'name' => 'ozy_buildme_custom_logo_retina',
									'label' => esc_attr__('Custom Logo Retina', 'vp_textdomain'),
									'default' => OZY_BASE_URL . 'images/logo@2x.png',
									'dependency' => array(
										'field' => 'ozy_buildme_use_custom_logo',
										'function' => 'vp_dep_boolean',
									),
									'description' => esc_attr__('Upload or choose custom 2x bigger logo', 'vp_textdomain'),
								)							
							),
						),						
					),
				),
				

				array(
					'title' => esc_attr__('Header', 'vp_textdomain'),
					'name' => 'ozy_buildme_header',
					'icon' => 'font-awesome:fa-tasks',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => esc_attr__('Header Layout', 'vp_textdomain'),
							'name' => 'ozy_buildme_section_global_header_layout',
							'fields' => array(
								array(
									'type' => 'select',
									'name' => 'ozy_buildme_header_bread_crumbs',
									'label' => esc_attr__('Bread Crumbs', 'vp_textdomain'),
									'description' => esc_attr__('Enable / Disable bread crumbs globally', 'vp_textdomain'),
									'items' => array(
										array(
											'value' => 'enabled',
											'label' => esc_attr__('Enabled', 'vp_textdomain'),
										),
										array(
											'value' => 'disabled',
											'label' => esc_attr__('Disabled', 'vp_textdomain'),
										),
									),
									'default' => array(
										'enabled',
									),
								),
							),
						),
												
					),
				),	
				
				array(
					'title' => esc_attr__('Footer', 'vp_textdomain'),
					'name' => 'ozy_buildme_footer',
					'icon' => 'font-awesome:fa-cog',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => esc_attr__('Footer Layout', 'vp_textdomain'),
							'name' => 'ozy_buildme_section_footer_copyright',
							'fields' => $footer_copyright_array
						),
						array(
							'type' => 'section',
							'title' => esc_attr__('Footer Layout', 'vp_textdomain'),
							'name' => 'ozy_buildme_section_footer_layout',
							'fields' => array(
								array(
									'type' => 'slider',
									'name' => 'ozy_buildme_footer_height',
									'label' => esc_attr__('Footer Height', 'vp_textdomain'),
									'description' => esc_attr__('Select height of your footer. Minimum value set to 30 and maximum set to 360. Will be processed in pixels.', 'vp_textdomain'),
									'min' => '30',
									'max' => '360',
									'step' => '1',
									'default' => '56',
								),
							),
						),
												
					),
				),				
				

				array(
					'title' => esc_attr__('Content / Page / Post', 'vp_textdomain'),
					'name' => 'ozy_buildme_page',
					'icon' => 'font-awesome:fa-pencil',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => esc_attr__('Page Position / Layout', 'vp_textdomain'),
							'name' => 'ozy_buildme_page_section_position',
							'description' => esc_attr__('Select position for your page content', 'vp_textdomain'),
							'fields' => array(
								array(
									'type' => 'radiobutton',
									'name' => 'ozy_buildme_page_model',
									'label' => esc_attr__('Default Page Model', 'vp_textdomain'),
									'items' => array(
										array(
											'value' => 'boxed',
											'label' => esc_attr__('Boxed', 'vp_textdomain'),
										),
										array(
											'value' => 'full',
											'label' => esc_attr__('Full', 'vp_textdomain'),
										),
									),
									'default' => array(
										'full',
									),
								),																								
							),
						),
						array(
							'type' => 'section',
							'title' => esc_attr__('Custom Page Pointers', 'vp_textdomain'),
							'name' => 'ozy_buildme_page_section_custom_page_pointers',
							'description' => esc_attr__('Select a page to use as your custom pages for some available places.', 'vp_textdomain'),
							'fields' => array(
								array(
									'type' => 'select',
									'name' => 'ozy_buildme_page_404_page_id',
									'label' => esc_attr__('404 Page', 'vp_textdomain'),
									'description' => esc_attr__('Select a page to use as custom 404 page.', 'vp_textdomain'),
									'items' => array(
										'data' => array(
											array(
												'source' => 'function',
												'value' => 'vp_bind_ozy_buildme_pages',
											),
										),
									),
								),
								array(
									'type' => 'select',
									'name' => 'ozy_buildme_page_blog_page_id',
									'label' => esc_attr__('Blog Page', 'vp_textdomain'),
									'description' => esc_attr__('Select a page to use as custom Blog page.', 'vp_textdomain'),
									'items' => array(
										'data' => array(
											array(
												'source' => 'function',
												'value' => 'vp_bind_ozy_buildme_pages',
											),
										),
									),
								),
								array(
									'type' => 'select',
									'name' => 'ozy_buildme_page_project_page_id',
									'label' => esc_attr__('Project Page', 'vp_textdomain'),
									'description' => esc_attr__('Select a page to use as custom Project page.', 'vp_textdomain'),
									'items' => array(
										'data' => array(
											array(
												'source' => 'function',
												'value' => 'vp_bind_ozy_buildme_pages',
											),
										),
									),
								)																											
							),
						),							
						array(
							'type' => 'section',
							'title' => esc_attr__('Page', 'vp_textdomain'),
							'name' => 'ozy_buildme_page_section_page_sidebar_position',
							'description' => esc_attr__('Select position for your page sidebar', 'vp_textdomain'),
							'fields' => array(
								array(
									'type' => 'radioimage',
									'name' => 'ozy_buildme_page_page_sidebar_position',
									'label' => esc_attr__('Default Sidebar Position', 'vp_textdomain'),
									'description' => esc_attr__('Select one of available header type.', 'vp_textdomain'),
									'item_max_width' => '86',
									'items' => array(
										array(
											'value' => 'full',
											'label' => esc_attr__('No Sidebar', 'vp_textdomain'),
											'img' => OZY_BASE_URL . 'admin/images/full-width.png',
										),
										array(
											'value' => 'left',
											'label' => esc_attr__('Left Sidebar', 'vp_textdomain'),
											'img' => OZY_BASE_URL . 'admin/images/left-sidebar.png',
										),
										array(
											'value' => 'right',
											'label' => esc_attr__('Right Sidebar', 'vp_textdomain'),
											'img' => OZY_BASE_URL . 'admin/images/right-sidebar.png',
										)
									),
									'default' => array(
										'{{first}}',
									),
								),
								array(
									'type' => 'select',
									'name' => 'ozy_buildme_page_page_sidebar_id',
									'label' => esc_attr__('Default Sidebar', 'vp_textdomain'),
									'description' => esc_attr__('This option could be overriden individually.', 'vp_textdomain'),
									'items' => array(
										'data' => array(
											array(
												'source' => 'function',
												'value' => 'vp_bind_ozy_buildme_sidebars',
											),
										),
									),
								),
								array(
									'type' => 'toggle',
									'name' => 'ozy_buildme_page_page_comment',
									'label' => esc_attr__('Comments Section', 'vp_textdomain'),
									'description' => esc_attr__('Enable / Disable comment section on the pages', 'vp_textdomain'),
									'default' => '0',
								),
								array(
									'type' => 'toggle',
									'name' => 'ozy_buildme_page_page_author',
									'label' => esc_attr__('Author Section', 'vp_textdomain'),
									'description' => esc_attr__('Enable / Disable author section on the pages', 'vp_textdomain'),
									'default' => '0',
								),
								/*array(
									'type' => 'toggle',
									'name' => 'ozy_buildme_page_page_comment_closed',
									'label' => esc_attr__('Show Comments Closed Message', 'vp_textdomain'),
									'description' => esc_attr__('Whenever comments closed on a page or post a message appears, you can hide it.', 'vp_textdomain'),
									'default' => '0',
								),	
								array(
									'type' => 'toggle',
									'name' => 'ozy_buildme_page_page_share',
									'label' => esc_attr__('Share Buttons', 'vp_textdomain'),
									'description' => esc_attr__('Enable / Disable share buttons for pages.', 'vp_textdomain'),
									'default' => '0',
								)*/													
							),
						),
						array(
							'type' => 'section',
							'title' => esc_attr__('Blog', 'vp_textdomain'),
							'name' => 'ozy_buildme_page_section_blog_sidebar_position',
							'description' => esc_attr__('Select position for your blog page sidebar', 'vp_textdomain'),
							'fields' => array(
								array(
									'type' => 'radioimage',
									'name' => 'ozy_buildme_page_blog_sidebar_position',
									'label' => esc_attr__('Defaul Sidebar Position', 'vp_textdomain'),
									'description' => esc_attr__('Select one of available header type.', 'vp_textdomain'),
									'item_max_width' => '86',
									'items' => array(
										array(
											'value' => 'full',
											'label' => esc_attr__('No Sidebar', 'vp_textdomain'),
											'img' => OZY_BASE_URL . 'admin/images/full-width.png',
										),
										array(
											'value' => 'left',
											'label' => esc_attr__('Left Sidebar', 'vp_textdomain'),
											'img' => OZY_BASE_URL . 'admin/images/left-sidebar.png',
										),
										array(
											'value' => 'right',
											'label' => esc_attr__('Right Sidebar', 'vp_textdomain'),
											'img' => OZY_BASE_URL . 'admin/images/right-sidebar.png',
										)
									),
									'default' => array(
										'{{first}}',
									),
								),
								array(
									'type' => 'select',
									'name' => 'ozy_buildme_page_blog_sidebar_id',
									'label' => esc_attr__('Default Sidebar', 'vp_textdomain'),
									'description' => esc_attr__('This option could be overriden individually.', 'vp_textdomain'),
									'items' => array(
										'data' => array(
											array(
												'source' => 'function',
												'value' => 'vp_bind_ozy_buildme_sidebars',
											),
										),
									),
								),
								array(
									'type' => 'toggle',
									'name' => 'ozy_buildme_page_blog_comment',
									'label' => esc_attr__('Comments Section', 'vp_textdomain'),
									'description' => esc_attr__('Enable / Disable comment section on the blog posts', 'vp_textdomain'),
									'default' => '1',
								),
								array(
									'type' => 'toggle',
									'name' => 'ozy_buildme_page_blog_author',
									'label' => esc_attr__('Author Section', 'vp_textdomain'),
									'description' => esc_attr__('Enable / Disable author section on the blog posts', 'vp_textdomain'),
									'default' => '1',
								),
								array(
									'type' => 'toggle',
									'name' => 'ozy_buildme_page_blog_share',
									'label' => esc_attr__('Share Buttons', 'vp_textdomain'),
									'description' => esc_attr__('Enable / Disable share buttons for posts.', 'vp_textdomain'),
									'default' => '1',
								),
								array(
									'type' => 'toggle',
									'name' => 'ozy_buildme_page_blog_related_posts',
									'label' => esc_attr__('Related Posts', 'vp_textdomain'),
									'description' => esc_attr__('Enable / Disable related posts.', 'vp_textdomain'),
									'default' => '1',
								),
								array(
									'type' => 'select',
									'name' => 'ozy_buildme_page_blog_list_page_id',
									'label' => esc_attr__('Default Listing Page', 'vp_textdomain'),
									'description' => esc_attr__('Select a page to use as "Return to Blog" link.', 'vp_textdomain'),
									'items' => array(
										'data' => array(
											array(
												'source' => 'function',
												'value' => 'vp_bind_ozy_buildme_pages',
											),
										),
									),
								)											
							),
						),
						array(
							'type' => 'section',
							'title' => esc_attr__('WooCommerce', 'vp_textdomain'),
							'name' => 'ozy_buildme_page_section_woocommerce_sidebar_position',
							'description' => esc_attr__('Select position for your WooCommerce page sidebar', 'vp_textdomain'),
							'fields' => array(
								array(
									'type' => 'radioimage',
									'name' => 'ozy_buildme_page_woocommerce_sidebar_position',
									'label' => esc_attr__('Default Sidebar Position', 'vp_textdomain'),
									'description' => esc_attr__('Select one of available header type.', 'vp_textdomain'),
									'item_max_width' => '86',
									'items' => array(
										array(
											'value' => 'full',
											'label' => esc_attr__('No Sidebar', 'vp_textdomain'),
											'img' => OZY_BASE_URL . 'admin/images/full-width.png',
										),
										array(
											'value' => 'left',
											'label' => esc_attr__('Left Sidebar', 'vp_textdomain'),
											'img' => OZY_BASE_URL . 'admin/images/left-sidebar.png',
										),
										array(
											'value' => 'right',
											'label' => esc_attr__('Right Sidebar', 'vp_textdomain'),
											'img' => OZY_BASE_URL . 'admin/images/right-sidebar.png',
										)
									),
									'default' => array(
										'{{first}}',
									),
								),
								array(
									'type' => 'select',
									'name' => 'ozy_buildme_page_woocommerce_sidebar_id',
									'label' => esc_attr__('Default Sidebar', 'vp_textdomain'),
									'description' => esc_attr__('This option could be overriden individually.', 'vp_textdomain'),
									'items' => array(
										'data' => array(
											array(
												'source' => 'function',
												'value' => 'vp_bind_ozy_buildme_sidebars',
											),
										),
									),
								),												
							),
						),												
					),
				),	
				
				
				array(
					'title' => esc_attr__('Miscellaneous', 'vp_textdomain'),
					'name' => 'ozy_buildme_misc',
					'icon' => 'font-awesome:fa-puzzle-piece',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => esc_attr__('Fancy Box (Lightbox)', 'vp_textdomain'),
							'name' => 'ozy_buildme_section_fancybox_layout',
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'ozy_buildme_fancbox_media',
									'label' => esc_attr__('Video Support', 'vp_textdomain'),
									'description' => esc_attr__('By enabling this option Fancybox will start to support popular media links.', 'vp_textdomain'),
									'default' => '1',
								),
								array(
									'type' => 'toggle',
									'name' => 'ozy_buildme_fancbox_thumbnail',
									'label' => esc_attr__('Thumbnail', 'vp_textdomain'),
									'description' => esc_attr__('Enable this option to show thumnails under your Fancybox window.', 'vp_textdomain'),
									'default' => '0',
								),								
							),
						),
					),
				),
				array(
					'title' => esc_attr__('Countdown Page', 'vp_textdomain'),
					'name' => 'ozy_buildme_countdown',
					'icon' => 'font-awesome:fa-clock-o',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => esc_attr__('Countdown Page Options', 'vp_textdomain'),
							'name' => 'ozy_buildme_section_countdown',
							'fields' => array(
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_countdown_year',
									'label' => esc_attr__('End Year', 'vp_textdomain'),
									'description' => esc_attr__('Enter the Year of the date counter will count to.', 'vp_textdomain'),
									'default' => date('Y', time())
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_countdown_month',
									'label' => esc_attr__('End Month', 'vp_textdomain'),
									'description' => esc_attr__('Enter the Month of the date counter will count to.', 'vp_textdomain'),
									'default' => date('m', time())
								),								
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_countdown_day',
									'label' => esc_attr__('End Day', 'vp_textdomain'),
									'description' => esc_attr__('Enter the Day of the date counter will count to.', 'vp_textdomain'),
									'default' => '15'
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_countdown_hour',
									'label' => esc_attr__('End Hour', 'vp_textdomain'),
									'description' => esc_attr__('Enter the Hour of the date counter will count to.', 'vp_textdomain'),
									'default' => '12'
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_countdown_minute',
									'label' => esc_attr__('End Minute', 'vp_textdomain'),
									'description' => esc_attr__('Enter the Minute of the date counter will count to.', 'vp_textdomain'),
									'default' => '12'
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_countdown_second',
									'label' => esc_attr__('End Second', 'vp_textdomain'),
									'description' => esc_attr__('Enter the Second of the date counter will count to.', 'vp_textdomain'),
									'default' => '00'
								)		
							),
						),
												
					),
				),			
			),
		),
		array(
			'name' => 'ozy_buildme_color_options',
			'title' => esc_attr__('Color Options', 'vp_textdomain'),
			'icon' => 'font-awesome:fa-eye',
			'controls' => array(
							
				array(
					'type' => 'section',
					'title' => esc_attr__('GENERIC', 'vp_textdomain'),
					'fields' => array(
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_content_background_color',
							'label' => esc_attr__('Content Background', 'vp_textdomain'),
							'format' => 'rgba',
							'default' => 'rgba(255,255,255,1)'
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_heading_color',
							'label' => esc_attr__('Heading Color', 'vp_textdomain'),
							'description' => esc_attr__('Default color for H1-H6 elements', 'vp_textdomain'),
							'format' => 'hex',
							'default' => '#000000'
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_content_color',
							'label' => esc_attr__('Content Color', 'vp_textdomain'),
							'description' => esc_attr__('Font color of the content', 'vp_textdomain'),
							'format' => 'hex',
							'default' => '#83838c'
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_content_color_alternate',
							'label' => esc_attr__('Alternate Color #1', 'vp_textdomain'),
							'description' => esc_attr__('Like link color, hover color and input elements active border', 'vp_textdomain'),
							'format' => 'hex',
							'default' => '#ffd200'
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_content_color_alternate2',
							'label' => esc_attr__('Alternate Color #2', 'vp_textdomain'),
							'description' => esc_attr__('Like footer, footer sidebar title color, text color and seperator color', 'vp_textdomain'),
							'format' => 'hex',
							'default' => '#000000'
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_content_color_alternate3',
							'label' => esc_attr__('Alternate Color #3', 'vp_textdomain'),
							'description' => esc_attr__('Like footer sidebar link color', 'vp_textdomain'),
							'format' => 'hex',
							'default' => '#ffffff'
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_content_color_alternate4',
							'label' => esc_attr__('Alternate Color #4', 'vp_textdomain'),
							'description' => esc_attr__('Like Blog and Project filter bars', 'vp_textdomain'),
							'format' => 'hex',
							'default' => '#30303c'
						),												
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_content_background_color_alternate',
							'label' => esc_attr__('Alternate Background Color', 'vp_textdomain'),
							'description' => esc_attr__('Like comments background color', 'vp_textdomain'),
							'format' => 'rgba',
							'default' => 'rgba(248,248,248,1)'
						),						
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_primary_menu_separator_color',
							'label' => esc_attr__('Separator / Border Color', 'vp_textdomain'),
							'description' => esc_attr__('Used for, Primary menu, in page Seperators and Comments bottom border', 'vp_textdomain'),
							'default' => 'rgba(230,230,230,1)',
							'format' => 'rgba'
						),						
					),
				),				
				array(
					'type' => 'section',
					'title' => esc_attr__('Header / Logo / Info Bar', 'vp_textdomain'),
					'name' => 'ozy_buildme_header_section_colors',
					'fields' => array(	
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_primary_menu_logo_color',
							'label' => esc_attr__('Text Logo Color', 'vp_textdomain'),
							'default' => 'rgba(255,255,255,1)',
							'format' => 'rgba',
							'description' => esc_attr__('Available only when one or both logo image not supplied', 'vp_textdomain'),
						),							
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_header_heading_color',
							'label' => esc_attr__('Heading Color', 'vp_textdomain'),
							'default' => 'rgba(255,255,255,1)',
							'format' => 'rgba',
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_header_font_color',
							'label' => esc_attr__('Text Color', 'vp_textdomain'),
							'default' => 'rgba(170,170,180,1)',
							'format' => 'rgba',
							'description' => esc_attr__('This one used for usually generic texts', 'vp_textdomain'),
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_header_alternate_color',
							'label' => esc_attr__('Alternate Color', 'vp_textdomain'),
							'default' => 'rgba(255,210,0,1)',
							'format' => 'rgba',
							'description' => esc_attr__('Affects elements like icons', 'vp_textdomain'),
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_header_info_bar_background_color',
							'label' => esc_attr__('Info Bar Background', 'vp_textdomain'),
							'default' => 'rgba(43,43,53,1)',
							'format' => 'rgba',
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_header_background_color_start',
							'label' => esc_attr__('Background Color Start', 'vp_textdomain'),
							'default' => '#3c3c4a',
							'description' => esc_attr__('Gradient background start color', 'vp_textdomain'),
							'format' => 'hex',
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_header_background_color_end',
							'label' => esc_attr__('Background Color End', 'vp_textdomain'),
							'default' => '#30303b',
							'description' => esc_attr__('Gradient background end color', 'vp_textdomain'),
							'format' => 'hex',
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_header_separator_color',
							'label' => esc_attr__('Separator Color', 'vp_textdomain'),
							'default' => 'rgba(80,80,92,1)',
							'format' => 'rgba',
						),
						array(
							'type' => 'upload',
							'name' => 'ozy_buildme_header_background_image',
							'label' => esc_attr__('Background Image', 'vp_textdomain'),
							'description' => esc_attr__('Upload or choose custom page background image.', 'vp_textdomain')
						),						
					),
				),					
				
				array(
					'type' => 'section',
					'title' => esc_attr__('Primary Menu', 'vp_textdomain'),
					'name' => 'ozy_buildme_primary_menu_section_colors',
					'fields' => array(			
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_primary_menu_font_color',
							'label' => esc_attr__('Font Color', 'vp_textdomain'),
							'default' => 'rgba(0,0,0,1)',
							'format' => 'rgba',
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_primary_menu_font_color_hover',
							'label' => esc_attr__('Font Color : Hover / Active', 'vp_textdomain'),
							'default' => 'rgba(255,210,0,1)',
							'format' => 'rgba',
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_primary_menu_background_color',
							'label' => esc_attr__('Background Color', 'vp_textdomain'),
							'default' => '#f0f0f0',
							'format' => 'hex',
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_primary_menu_background_color_end',
							'label' => esc_attr__('Background Color End', 'vp_textdomain'),
							'default' => '#ffffff',
							'description' => esc_attr__('Gradient menu bar end color', 'vp_textdomain'),
							'format' => 'hex',
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_primary_menu_dropdown_background',
							'label' => esc_attr__('Dropdown Background Color', 'vp_textdomain'),
							'default' => 'rgba(255,210,0,1)',
							'format' => 'rgba',
						),										
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_primary_menu_dropdown_background_color_hover',
							'label' => esc_attr__('Dropdown Background Color : Hover / Active', 'vp_textdomain'),
							'default' => 'rgba(255,192,0,1)',
							'format' => 'rgba',
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_primary_menu_separator_color_2',
							'label' => esc_attr__('Separator Color', 'vp_textdomain'),
							'default' => 'rgba(219,219,219,1)',
							'format' => 'rgba',
						),
					),
				),				
				array(
					'type' => 'section',
					'title' => esc_attr__('Footer', 'vp_textdomain'),
					'name' => 'ozy_buildme_footer_section_colors',
					'fields' => array(
						array(
							'type' => 'upload',
							'name' => 'ozy_buildme_footer_background_image',
							'label' => esc_attr__('Background Image', 'vp_textdomain'),
							'description' => esc_attr__('Upload or choose custom page background image.', 'vp_textdomain'),
							'default' => OZY_BASE_URL . 'images/assets/footer_bg.png'
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_footer_color_1',
							'label' => esc_attr__('Background Color', 'vp_textdomain'),
							'default' => 'rgba(43,43,53,1)',
							'format' => 'rgba',
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_footer_color_2',
							'label' => esc_attr__('Foreground Color', 'vp_textdomain'),
							'default' => '#ffffff',
							'format' => 'hex',
						),					
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_footer_color_3',
							'label' => esc_attr__('Alternate Color', 'vp_textdomain'),
							'default' => '#ffd200',
							'format' => 'hex',
						),					
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_footer_color_4',
							'label' => esc_attr__('Separator Color', 'vp_textdomain'),
							'default' => '#41414a',
							'format' => 'hex',
						)
					),
				),
				array(
					'type' => 'section',
					'title' => esc_attr__('Form', 'vp_textdomain'),
					'name' => 'ozy_buildme_form_section_coloring',
					'fields' => array(
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_form_font_color',
							'label' => esc_attr__('Font Color', 'vp_textdomain'),
							'default' => 'rgba(35,35,35,1)',
							'format' => 'rgba',
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_form_background_color',
							'label' => esc_attr__('Background Color', 'vp_textdomain'),
							'default' => 'rgba(225,225,225,1)',
							'format' => 'rgba',
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_form_button_font_color',
							'label' => esc_attr__('Font Color (Button)', 'vp_textdomain'),
							'default' => 'rgba(0,0,0,1)',
							'format' => 'rgba',
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_form_button_font_color_hover',
							'label' => esc_attr__('Font Color : Hover / Active (Button)', 'vp_textdomain'),
							'default' => 'rgba(255,255,255,1)',
							'format' => 'rgba',
						),
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_form_button_background_color',
							'label' => esc_attr__('Background Color (Button)', 'vp_textdomain'),
							'default' => 'rgba(255,210,0,1)',
							'format' => 'rgba',
						),	
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_form_button_background_color_hover',
							'label' => esc_attr__('Background Color : Hover / Active (Button)', 'vp_textdomain'),
							'default' => 'rgba(0,0,0,1)',
							'format' => 'rgba',
						),											
					),
				),
				array(
					'type' => 'section',
					'title' => esc_attr__('Background Styling', 'vp_textdomain'),
					'fields' => array(
						array(
							'type' => 'color',
							'name' => 'ozy_buildme_body_background_color',
							'label' => esc_attr__('Background Color', 'vp_textdomain'),
							'description' => esc_attr__('This option will affect only page background.', 'vp_textdomain'),
							'default' => '#2b2b35',
							'format' => 'hex',
						),					
						array(
							'type' => 'upload',
							'name' => 'ozy_buildme_body_background_image',
							'label' => esc_attr__('Custom Background Image', 'vp_textdomain'),
							'description' => esc_attr__('Upload or choose custom page background image.', 'vp_textdomain'),
						),
						array(
							'type' => 'radiobutton',
							'name' => 'ozy_buildme_body_background_image_size',
							'label' => esc_attr__('Background Image Size', 'vp_textdomain'),
							'description' => esc_attr__('Only available on browsers which supports CSS3.', 'vp_textdomain'),
							'items' => array(
								array(
									'value' => '',
									'label' => esc_attr__('-not set-', 'vp_textdomain'),
								),			
								array(
									'value' => 'cover',
									'label' => esc_attr__('cover', 'vp_textdomain'),
								),
								array(
									'value' => 'contain',
									'label' => esc_attr__('contain', 'vp_textdomain'),
								)
							),
							'default' => '{{first}}',
						),
						array(
							'type' => 'radiobutton',
							'name' => 'ozy_buildme_body_background_image_repeat',
							'label' => esc_attr__('Background Image Repeat', 'vp_textdomain'),
							'items' => array(
								array(
									'value' => 'inherit',
									'label' => esc_attr__('inherit', 'vp_textdomain'),
								),			
								array(
									'value' => 'no-repeat',
									'label' => esc_attr__('no-repeat', 'vp_textdomain'),
								),
								array(
									'value' => 'repeat',
									'label' => esc_attr__('repeat', 'vp_textdomain'),
								),
								array(
									'value' => 'repeat-x',
									'label' => esc_attr__('repeat-x', 'vp_textdomain'),
								),
								array(
									'value' => 'repeat-y',
									'label' => esc_attr__('repeat-y', 'vp_textdomain'),
								)
							),
							'default' => '{{first}}',
						),
						array(
							'type' => 'radiobutton',
							'name' => 'ozy_buildme_body_background_image_attachment',
							'label' => esc_attr__('Background Image Attachment', 'vp_textdomain'),
							'items' => array(
								array(
									'value' => '',
									'label' => esc_attr__('-not set-', 'vp_textdomain'),
								),			
								array(
									'value' => 'fixed',
									'label' => esc_attr__('fixed', 'vp_textdomain'),
								),
								array(
									'value' => 'scroll',
									'label' => esc_attr__('scroll', 'vp_textdomain'),
								),
								array(
									'value' => 'local',
									'label' => esc_attr__('local', 'vp_textdomain')
								)
							),
							'default' => '{{first}}',
						),			
					),
				),
				
			),
		),			
		
		array(
			'title' => esc_attr__('Social', 'vp_textdomain'),
			'name' => 'ozy_buildme_typography',
			'icon' => 'font-awesome:fa-group',
			'menus' => array(
				array(
					'title' => esc_attr__('Accounts', 'vp_textdomain'),
					'name' => 'ozy_buildme_social_accounts',
					'icon' => 'font-awesome:fa-heart-o',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => esc_attr__('Social Accounts', 'vp_textdomain'),
							'description' => esc_attr__('Enter social account names/IDs box below', 'vp_textdomain'),
							'fields' => array(
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_fivehundredpx',
									'label' => esc_attr__('500px', 'vp_textdomain')
								),							
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_behance',
									'label' => esc_attr__('Behance', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_blogger',
									'label' => esc_attr__('Blogger', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_delicious',
									'label' => esc_attr__('Delicious', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_deviantart',
									'label' => esc_attr__('DeviantArt', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_digg',
									'label' => esc_attr__('Digg', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_dribble',
									'label' => esc_attr__('Dribble', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_email',
									'label' => esc_attr__('Email', 'vp_textdomain'),
									'default' => '#'
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_facebook',
									'label' => esc_attr__('Facebook', 'vp_textdomain'),
									'default' => '#'
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_flickr',
									'label' => esc_attr__('Flickr', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_forrst',
									'label' => esc_attr__('Forrst', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_foursquare',
									'label' => esc_attr__('Foursquare', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_github',
									'label' => esc_attr__('Github', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_googleplus',
									'label' => esc_attr__('Google+', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_instagram',
									'label' => esc_attr__('Instagram', 'vp_textdomain'),
									'default' => '#'
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_lastfm',
									'label' => esc_attr__('Last.FM', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_linkedin',
									'label' => esc_attr__('LinkedIn', 'vp_textdomain')
								),

								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_myspace',
									'label' => esc_attr__('MySpace', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_pinterest',
									'label' => esc_attr__('Pinterest', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_rss',
									'label' => esc_attr__('RSS', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_soundcloud',
									'label' => esc_attr__('SoundCloud', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_stumbleupon',
									'label' => esc_attr__('StumbleUpon', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_tumblr',
									'label' => esc_attr__('Tumblr', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_twitter',
									'label' => esc_attr__('Twitter', 'vp_textdomain'),
									'default' => '#'
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_vimeo',
									'label' => esc_attr__('Vimeo', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_wordpress',
									'label' => esc_attr__('WordPress', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_yahoo',
									'label' => esc_attr__('Yahoo!', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_yelp',
									'label' => __('Yelp (Please use full URL)', 'vp_textdomain')
								),							
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_youtube',
									'label' => esc_attr__('Youtube', 'vp_textdomain')
								),
								array(
									'type' => 'textbox',
									'name' => 'ozy_buildme_social_accounts_vk',
									'label' => __('VK', 'vp_textdomain')
								),																																																																																																																																																																																																			
							),
						),
					),
				),			
				array(
					'title' => esc_attr__('General', 'vp_textdomain'),
					'name' => 'ozy_buildme_social_general',
					'icon' => 'font-awesome:fa-group',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => esc_attr__('Social Icons', 'vp_textdomain'),
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'ozy_buildme_social_use',
									'label' => esc_attr__('Social Share Buttons', 'vp_textdomain'),
									'description' => esc_attr__('Enable / Disable social share buttons.', 'vp_textdomain'),
									'default' => '1',
								),
								array(
									'type' => 'sorter',
									'name' => 'ozy_buildme_social_icon_order',
									'max_selection' => 20,
									'label' => esc_attr__('Icon List / Order', 'vp_textdomain'),
									'description' => esc_attr__('Select visible icons and sort.', 'vp_textdomain'),
									'items' => array(
										'data' => array(
											array(
												'source' => 'function',
												'value' => 'vp_get_social_medias',
											),
										),
									),
									'default' => array('email', 'facebook', 'instagram', 'twitter')
								),
								array(
									'type' => 'select',
									'name' => 'ozy_buildme_social_icon_target',
									'label' => esc_attr__('Target Window', 'vp_textdomain'),
									'description' => esc_attr__('Where links will be opened?', 'vp_textdomain'),
									'items' => array(
										array(
											'value' => '_blank',
											'label' => esc_attr__('Blank Window / New Tab', 'vp_textdomain'),
										),
										array(
											'value' => '_self',
											'label' => esc_attr__('Self Window', 'vp_textdomain'),
										),
									),
									'default' => array(
										'_blank',
									),
								),								
							),
						),
					),
				),			
			),
		),
	)
);

return $ozy_buildme_option_arr;

/**
 *EOF
 */