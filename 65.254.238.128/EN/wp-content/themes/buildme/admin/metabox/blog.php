<?php

return array(
	'id'          => 'ozy_buildme_meta_post',
	'types'       => array('post'),
	'title'       => esc_attr__('Post Options', 'vp_textdomain'),
	'priority'    => 'high',
	'template'    => array(
		array(
			'type' => 'radiobutton',
			'name' => 'ozy_buildme_meta_post_item_type',
			'label' => esc_attr__('Item Type', 'vp_textdomain'),
			'items' => array(
				array(
					'value' => 'standard',
					'label' => 'Standard',
				),
				array(
					'value' => 'colorbox',
					'label' => 'Colorbox',
				)
			),
			'default' => 'standard'
		),
		array(
			'type' => 'radiobutton',
			'name' => 'ozy_buildme_meta_post_item_size',
			'label' => esc_attr__('Item Size', 'vp_textdomain'),
			'items' => array(
				array(
					'value' => 'small',
					'label' => 'Small',
				),
				array(
					'value' => 'large',
					'label' => 'Large',
				)
			),
			'default' => 'small'
		),
		array(
			'type' => 'toggle',
			'name' => 'ozy_buildme_meta_post_thumbnail_color',
			'label' => esc_attr__('Use Custom Thumbnail Coloring', 'vp_textdomain'),
			'description' => esc_attr__('Related options only available few layout types, like Blog : Masonry.', 'vp_textdomain'),
		),
		array(
			'type'      => 'group',
			'repeating' => false,
			'length'    => 1,
			'name'      => 'ozy_buildme_meta_post_thumbnail_color_group',
			'title'     => esc_attr__('Custom Thumbnail Coloring', 'vp_textdomain'),
			'dependency' => array(
				'field'    => 'ozy_buildme_meta_post_thumbnail_color',
				'function' => 'vp_dep_boolean',
			),
			'fields'    => array(	
				array(
					'type' => 'color',
					'name' => 'ozy_buildme_meta_post_thumbnail_color_overlay',
					'label' => esc_attr__('Overlay Color', 'vp_textdomain'),
					'description' => esc_attr__('Select a Overlay Color.', 'vp_textdomain'),
					'default' => 'rgba(0,0,0,1)',
					'format' => 'rgba',
				),
				array(
					'type' => 'color',
					'name' => 'ozy_buildme_meta_post_thumbnail_color_heading',
					'label' => esc_attr__('Heading Color', 'vp_textdomain'),
					'description' => esc_attr__('Select a text color.', 'vp_textdomain'),
					'default' => '#ffffff',
					'format' => 'hex',
				),
				array(
					'type' => 'color',
					'name' => 'ozy_buildme_meta_post_thumbnail_color_text',
					'label' => esc_attr__('Text Color', 'vp_textdomain'),
					'description' => esc_attr__('Select a text color.', 'vp_textdomain'),
					'default' => '#ffffff',
					'format' => 'hex',
				)															
			),
		)		
	),	
);

/**
 * EOF
 */