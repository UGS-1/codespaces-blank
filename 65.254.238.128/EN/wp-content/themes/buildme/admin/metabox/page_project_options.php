<?php

return array(
	'id'          => 'ozy_buildme_meta_page_project',
	'types'       => array('page'),
	'title'       => esc_attr__('Project Options', 'vp_textdomain'),
	'priority'    => 'high',
	'template'    => array(
		array(
			'type' => 'notebox',
			'name' => 'ozy_buildme_meta_page_project_infobox',
			'label' => esc_attr__('project Options', 'vp_textdomain'),
			'description' => esc_attr__('Below this point all the options are only works with project template types.', 'vp_textdomain'),
			'status' => 'info',
		),
		array(
			'type' => 'sorter',
			'name' => 'ozy_buildme_meta_page_project_category_sort',
			'label' => esc_attr__('Category Select / Order', 'vp_textdomain'),
			'description' => esc_attr__('If you leave this field blank, all available categories will be listed. By this option, you can create multiple project/gallery pages with different items.', 'vp_textdomain'),			
			'default' => '{{all}}',
			'items' => array(
				'data' => array(
					array(
						'source' => 'function',
						'value' => 'vp_bind_ozy_buildme_project_categories_simple',
					),
				),
			),
		),	
		array(
			'type' => 'radiobutton',
			'name' => 'ozy_buildme_meta_page_project_order',
			'label' => esc_attr__('Item Order', 'vp_textdomain'),
			'description' => esc_attr__('By selecting "Custom Order ..." you will have to set the order field of each of the items.', 'vp_textdomain'),			
			'items' => array(
				array(
					'value' => 'date-desc',
					'label' => 'Date DESC',
				),
				array(
					'value' => 'date-asc',
					'label' => 'Date ASC',
				),
				array(
					'value' => 'menu_order-desc',
					'label' => 'Custom DESC',
				),
				array(
					'value' => 'menu_order-asc',
					'label' => 'Custom ASC',
				),
			),
			'default' => '{{first}}'
		),
		array(
			'type' => 'radiobutton',
			'name' => 'ozy_buildme_meta_page_project_column_count',
			'label' => esc_attr__('Column Count', 'vp_textdomain'),
			'items' => array(
				array(
					'value' => '3',
					'label' => '3',
				),
				array(
					'value' => '4',
					'label' => '4',
				)
			),
			'default' => '3'
		),			
		array(
			'type' => 'textbox',
			'name' => 'ozy_buildme_meta_page_project_count',
			'label' => esc_attr__('Item Count Per Load', 'vp_textdomain'),
			'description' => esc_attr__('How many project item will be loaded for each load.', 'vp_textdomain'),
			'default' => '32',
			'validation' => 'numeric',
		),			
	),	
);

/**
 * EOF
 */