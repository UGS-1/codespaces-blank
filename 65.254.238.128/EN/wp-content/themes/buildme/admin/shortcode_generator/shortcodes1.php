<?php

return array(

	'Showcase' => array(
		'elements'=> array(

			'all_controls' => array(
				'title'   => 'All Controls',
				'code'    => '[controls][/controls]',
				'attributes' => array(
					array(
						'name'                       => 'wpeditor',
						'type'                       => 'wpeditor',
						'label'                      => esc_attr__('WP Visual Editor', 'vp_textdomain'),
						'use_external_plugins'       => 1,
						'disabled_externals_plugins' => 'vp_sc_button',
						'disabled_internals_plugins' => '',
					),
					array(
						'name'  => 'radiobutton',
						'type'  => 'radiobutton',
						'label' => esc_attr__('Radio Button', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'value_1',
								'label' => 'Value 1'
							),
							array(
								'value' => 'value_2',
								'label' => 'Value 2'
							),
							array(
								'value' => 'value_3',
								'label' => 'Value 3'
							),
						),
					),
					array(
						'name'  => 'checkbox',
						'type'  => 'checkbox',
						'label' => esc_attr__('Checkbox', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'value_1',
								'label' => 'Value 1'
							),
							array(
								'value' => 'value_2',
								'label' => 'Value 2'
							),
							array(
								'value' => 'value_3',
								'label' => 'Value 3'
							),
						),
						'default' => array('{{first}}')
					),
					array(
						'name'  => 'select',
						'type'  => 'select',
						'label' => esc_attr__('Select', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'value_1',
								'label' => 'Value 1'
							),
							array(
								'value' => 'value_2',
								'label' => 'Value 2'
							),
							array(
								'value' => 'value_3',
								'label' => 'Value 3'
							),
						),
					),
					array(
						'name'  => 'fontawesome',
						'type'  => 'fontawesome',
						'label' => esc_attr__('Fontawesome Icon', 'vp_textdomain'),
					),
					array(
						'name'  => 'multiselect',
						'type'  => 'multiselect',
						'label' => esc_attr__('Multiselect', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'value_1',
								'label' => 'Value 1'
							),
							array(
								'value' => 'value_2',
								'label' => 'Value 2'
							),
							array(
								'value' => 'value_3',
								'label' => 'Value 3'
							),
						),
						'default' => array('{{first}}')
					),
					array(
						'name'  => 'color',
						'type'  => 'color',
						'label' => esc_attr__('Color', 'vp_textdomain'),
						'default' => '#00FF00',
					),
					array(
						'name'  => 'sorter',
						'type'  => 'sorter',
						'label' => esc_attr__('Sorter', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'value_1',
								'label' => 'Value 1'
							),
							array(
								'value' => 'value_2',
								'label' => 'Value 2'
							),
							array(
								'value' => 'value_3',
								'label' => 'Value 3'
							),
						),
						'default' => array('{{first}}')
					),
					array(
						'name'  => 'slider',
						'type'  => 'slider',
						'label' => esc_attr__('Slider', 'vp_textdomain'),
						'default' => '20',
						'min' => 5,
						'max' => 50,
					),
					array(
						'name'  => 'upload',
						'type'  => 'upload',
						'label' => esc_attr__('Upload', 'vp_textdomain'),
					),
					array(
						'name'  => 'date',
						'type'  => 'date',
						'label' => esc_attr__('Date', 'vp_textdomain'),
					),
					array(
						'name'  => 'textarea',
						'type'  => 'textarea',
						'label' => esc_attr__('Textarea', 'vp_textdomain'),
						'default' => 'test',
					),
					array(
						'name'  => 'checkimage',
						'type'  => 'checkimage',
						'label' => esc_attr__('Check Image', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'value_1',
								'label' => esc_attr__('Label 1', 'vp_textdomain'),
								'img' => 'http://placehold.it/100x100',
							),
							array(
								'value' => 'value_2',
								'label' => esc_attr__('Label 2', 'vp_textdomain'),
								'img' => 'http://placehold.it/120x80',
							),
							array(
								'value' => 'value_3',
								'label' => esc_attr__('Label 3', 'vp_textdomain'),
								'img' => 'http://placehold.it/80x120',
							),
							array(
								'value' => 'value_4',
								'label' => esc_attr__('Label 4', 'vp_textdomain'),
								'img' => 'http://placehold.it/50x50',
							),
						),
						'default' => array('{{first}}', '{{last}}'),
					),
					array(
						'name'  => 'radioimage',
						'type'  => 'radioimage',
						'label' => esc_attr__('Radio Image', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'value_1',
								'label' => esc_attr__('Label 1', 'vp_textdomain'),
								'img'   => 'http://placehold.it/100x100',
							),
							array(
								'value' => 'value_2',
								'label' => esc_attr__('Label 2', 'vp_textdomain'),
								'img'   => 'http://placehold.it/120x80',
							),
							array(
								'value' => 'value_3',
								'label' => esc_attr__('Label 3', 'vp_textdomain'),
								'img'   => 'http://placehold.it/80x120',
							),
							array(
								'value' => 'value_4',
								'label' => esc_attr__('Label 4', 'vp_textdomain'),
								'img'   => 'http://placehold.it/50x50',
							),
						),
						'default' => array('{{first}}'),
					),
					array(
						'name'  => 'codeeditor',
						'type'  => 'codeeditor',
						'label' => esc_attr__('Code Editor', 'vp_textdomain'),
						'default' => 'test',
					),
					array(
						'name'  => 'toggle',
						'type'  => 'toggle',
						'label' => esc_attr__('Toggle', 'vp_textdomain'),
					),
				)
			),

		),
	),

	'Layout System' => array(
		'elements' => array(

			'section'  => array(
				'title' => 'Section',
				'code'  => '[section][/section]',
				'attributes' => array(
					array(
						'name'  => 'accent',
						'type'  => 'select',
						'label' => esc_attr__('Color Accent', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'standard',
								'label' => 'Standard Color Accent'
							),
							array(
								'value' => 'alternative_1',
								'label' => 'Alternative 1 Color Accent'
							),
							array(
								'value' => 'alternative_2',
								'label' => 'Alternative 2 Color Accent'
							),
							array(
								'value' => 'alternative_3',
								'label' => 'Alternative 3 Color Accent'
							),
							array(
								'value' => 'alternative_4',
								'label' => 'Alternative 4 Color Accent'
							),
						),
					),
					array(
						'name'  => 'background_image_url',
						'type'  => 'upload',
						'label' => esc_attr__('Background Image URL', 'vp_textdomain'),
					),
					array(
						'name'  => 'background_image_repeat',
						'type'  => 'select',
						'label' => esc_attr__('Background Image Repeat', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'repeat-x',
								'label' => 'repeat-x'
							),
							array(
								'value' => 'repeat-y',
								'label' => 'repeat-y'
							),
							array(
								'value' => 'no-repeat',
								'label' => 'no-repeat'
							),
						),
					),
					array(
						'name'  => 'background_image_attachment',
						'type'  => 'select',
						'label' => esc_attr__('Background Image Attachment', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'scroll',
								'label' => 'scroll'
							),
							array(
								'value' => 'fixed',
								'label' => 'fixed'
							),
							array(
								'value' => 'inherit',
								'label' => 'inherit'
							),
						),
					),
					array(
						'name'  => 'background_image_position',
						'type'  => 'select',
						'label' => esc_attr__('Background Image Position', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'top left',
								'label' => 'top left'
							),
							array(
								'value' => 'top center',
								'label' => 'top center'
							),
							array(
								'value' => 'top right',
								'label' => 'top right'
							),
							array(
								'value' => 'center left',
								'label' => 'center left'
							),
							array(
								'value' => 'center center',
								'label' => 'center center'
							),
							array(
								'value' => 'center right',
								'label' => 'center right'
							),
							array(
								'value' => 'bottom left',
								'label' => 'bottom left'
							),
							array(
								'value' => 'bottom center',
								'label' => 'bottom center'
							),
							array(
								'value' => 'bottom right',
								'label' => 'bottom right'
							),
						),
					),
					array(
						'name'  => 'background_image_size',
						'type'  => 'select',
						'label' => esc_attr__('Background Image Size', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'cover',
								'label' => 'cover'
							),
							array(
								'value' => 'contain',
								'label' => 'contain'
							),
						),
					),
				),
			),
			'grid'  => array(
				'title' => 'Grid',
				'code'  => '[grid][/grid]',
				'attributes' => array(
					array(
						'name'  => 'col',
						'type'  => 'slider',
						'label' => esc_attr__('Column', 'vp_textdomain'),
						'min'   => 1,
						'max'   => 12,
					),
					array(
						'name'  => 'offset',
						'type'  => 'slider',
						'label' => esc_attr__('Offset', 'vp_textdomain'),
						'min'   => 0,
						'max'   => 11,
					),
				),
			),

		)
	),

	'Elements' => array(
		'elements'=> array(

			'button' => array(
				'title'   => 'Button',
				'code'    => '[ozy_button][x][/x][/ozy_button]',
				'attributes' => array(
					array(
						'name'  => 'accent',
						'type'  => 'select',
						'label' => esc_attr__('Color Accent', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'standard',
								'label' => 'Use Theme Options'
							),
							array(
								'value' => 'red',
								'label' => 'Red Color Accent'
							),
							array(
								'value' => 'brown',
								'label' => 'Brown Color Accent'
							),
							array(
								'value' => 'yellow',
								'label' => 'Yellow Color Accent'
							),
							array(
								'value' => 'turkuaz',
								'label' => 'Turkuaz Color Accent'
							),
							array(
								'value' => 'blue',
								'label' => 'Blue Color Accent'
							),							
						),
						'default' => array('{{first}}')
					),
					array(
						'name'  => 'text_color',
						'type'  => 'color',
						'label' => esc_attr__('Text Color', 'vp_textdomain'),
					),
					array(
						'name'  => 'background_color',
						'type'  => 'color',
						'label' => esc_attr__('Background Color', 'vp_textdomain'),
					),
					array(
						'name'  => 'caption',
						'type'  => 'textbox',
						'label' => esc_attr__('Button Caption', 'vp_textdomain'),
					),					
					array(
						'name'  => 'url',
						'type'  => 'textbox',
						'label' => esc_attr__('Button URL', 'vp_textdomain'),
					),
					array(
						'name'  => 'target',
						'type'  => 'select',
						'label' => esc_attr__('Target', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => '_self',
								'label' => '_self'
							),
							array(
								'value' => '_blank',
								'label' => '_blank'
							),
							array(
								'value' => 'lightbox',
								'label' => 'lightbox'
							),
						),
					),					
					array(
						'name'  => 'icon',
						'type'  => 'fontawesome',
						'label' => esc_attr__('Icon name', 'vp_textdomain'),
					),					
					array(
						'name'  => 'size',
						'type'  => 'select',
						'label' => esc_attr__('Size', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'small',
								'label' => 'small'
							),
							array(
								'value' => 'medium',
								'label' => 'medium'
							),
							array(
								'value' => 'large',
								'label' => 'large'
							),
						),
					),					
				)
			),

			'list' => array(
				'title' => 'List',
				'code'  => '[list][li icon="" color=""]Item 1[/li][li icon="icon-ok" color=""]Item 2[/li][li icon="icon-remove" color=""]Item 3[/li][/list]',
			),

			'icon' => array(
				'title'   => 'Icon',
				'code'    => '[icon][/icon]',
				'attributes' => array(
					array(
						'name'  => 'size',
						'type'  => 'select',
						'label' => esc_attr__('Size', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'small',
								'label' => 'small'
							),
							array(
								'value' => 'medium',
								'label' => 'medium'
							),
							array(
								'value' => 'large',
								'label' => 'large'
							),
						),
					),
					array(
						'name'  => 'name',
						'type'  => 'fontawesome',
						'label' => esc_attr__('Icon name', 'vp_textdomain'),
					),
				)
			),
			'button' => array(
				'title'   => 'Tab',
				'code'    => '[ozy_tab][ozy_tab_content][/ozy_tab_content][/ozy_tab]',
				'attributes' => array(
					array(
						'name'  => 'icon',
						'type'  => 'fontawesome',
						'label' => esc_attr__('Icon name', 'vp_textdomain'),
					),					
					array(
						'name'  => 'tab',
						'label' => esc_attr__('ID', 'vp_textdomain'),
						'type'  => 'textbox'
					),
					array(
						'name'                       => 'wpeditor',
						'type'                       => 'wpeditor',
						'label'                      => esc_attr__('WP Visual Editor', 'vp_textdomain'),
						'use_external_plugins'       => 1,
						'disabled_externals_plugins' => 'vp_sc_button',
						'disabled_internals_plugins' => '',
					),					
				)
			),			

			'pricing_table' => array(
				'title' => 'Pricing Table',
				'code'  => '[pricing_table][/pricing_table]',
			),

			'pricing_column' => array(
				'title'   => 'Pricing Column',
				'code'    => '[pricing_column][/pricing_column]',
				'attributes' => array(
					array(
						'name'  => 'color_accent',
						'type'  => 'select',
						'label' => esc_attr__('Color Accent', 'vp_textdomain'),
						'items' => array(
							array(
								'value' => 'small',
								'label' => 'small'
							),
							array(
								'value' => 'medium',
								'label' => 'medium'
							),
							array(
								'value' => 'large',
								'label' => 'large'
							),
						),
					),
					array(
						'name'  => 'name',
						'type'  => 'fontawesome',
						'label' => esc_attr__('Icon name', 'vp_textdomain'),
					),
				)
			),

		),
	),

	'Media Embeds' => array(
		'elements' => array(

			'youtube' => array(
				'title'   => 'Youtube',
				'code'    => '[youtube][/youtube]',
				'attributes' => array(
					array(
						'name'  => 'id',
						'label' => esc_attr__('ID', 'vp_textdomain'),
						'type'  => 'textbox'
					),
					array(
						'name'  => 'width',
						'label' => esc_attr__('Width', 'vp_textdomain'),
						'type'  => 'textbox'
					),
					array(
						'name'  => 'height',
						'label' => esc_attr__('Height', 'vp_textdomain'),
						'type'  => 'textbox'
					),
				)
			),
			'vimeo' => array(
				'title'   => 'Vimeo',
				'code'    => '[vimeo][/vimeo]',
				'attributes' => array(
					array(
						'name'  => 'id',
						'label' => esc_attr__('ID', 'vp_textdomain'),
						'type'  => 'textbox'
					),
					array(
						'name'  => 'width',
						'label' => esc_attr__('Width', 'vp_textdomain'),
						'type'  => 'textbox'
					),
					array(
						'name'  => 'height',
						'label' => esc_attr__('Height', 'vp_textdomain'),
						'type'  => 'textbox'
					),
				)
			),
			'soundcloud' => array(
				'title'   => 'Soundcloud',
				'code'    => '[soundcloud][/soundcloud]',
				'attributes' => array(
					array(
						'name'  => 'url',
						'label' => esc_attr__('URL', 'vp_textdomain'),
						'type'  => 'textbox'
					),
					array(
						'name'  => 'width',
						'label' => esc_attr__('Width', 'vp_textdomain'),
						'type'  => 'textbox'
					),
					array(
						'name'  => 'height',
						'label' => esc_attr__('Height', 'vp_textdomain'),
						'type'  => 'textbox'
					),
					array(
						'name'  => 'color',
						'label' => esc_attr__('Height', 'vp_textdomain'),
						'type'  => 'color'
					),
					array(
						'name'  => 'auto_play',
						'label' => esc_attr__('Autoplay', 'vp_textdomain'),
						'type'  => 'toggle'
					),
					array(
						'name'  => 'show_comments',
						'label' => esc_attr__('Show Comments', 'vp_textdomain'),
						'type'  => 'toggle'
					),
				)
			),

		)
	)

);

/**
 * EOF
 */