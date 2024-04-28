<?php

return array(

	'Layout' => array(
		'elements' => array(

			'row' => array(
				'title'   => esc_attr__('Row', 'qualia_td'),
				'code'    => '[row][/row]',
			),

			'column' => array(
				'title'   => esc_attr__('Column', 'qualia_td'),
				'code'    => '[column][/column]',
				'attributes' => array(
					array(
						'name'    => 'grid',
						'type'    => 'slider',
						'label'   => esc_attr__('Grid', 'qualia_td'),
						'min'     => 1,
						'max'     => 12,
						'default' => 12,
					),
					array(
						'name'    => 'offset',
						'type'    => 'slider',
						'label'   => esc_attr__('Offset', 'qualia_td'),
						'min'     => 0,
						'max'     => 11,
						'default' => 0,
					),
				),
			),

			'spacer' => array(
				'title'   => esc_attr__('Inner Spacer', 'qualia_td'),
				'code'    => '[spacer]',
				'attributes' => array(
					array(
						'name'    => 'size',
						'type'    => 'slider',
						'label'   => esc_attr__('Size', 'qualia_td'),
						'default' => 0,
						'min'     => 0,
						'max'     => 500,
					),
				),
			),
		),
	),

);

/**
 * EOF
 */