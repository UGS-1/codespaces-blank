<?php

return array(
	'id'          => 'ozy_buildme_meta_project',
	'types'       => array('ozy_project'),
	'title'       => esc_attr__('Project Options', 'vp_textdomain'),
	'priority'    => 'high',
	'template'    => array(
		array(
			'type' => 'toggle',
			'name' => 'ozy_buildme_meta_project_hide_meta_info',
			'label' => esc_attr__('Hide Meta Info', 'vp_textdomain'),
			'description' => esc_attr__('Check this box if you like to hide Meta Information section.', 'vp_textdomain'),
		),		
		array(
			'type'      => 'group',
			'repeating' => true,
			'sortable'	=> true,
			'name'      => 'ozy_buildme_meta_project_meta_info',
			'title'     => esc_attr__('Facts', 'vp_textdomain'),
			'fields'    => array(
				 array(
					'type' => 'fontawesome',
					'name' => 'ozy_buildme_meta_project_meta_info_icon',
					'label' => esc_attr__('Icon', 'vp_textdomain'),
					'description' => esc_attr__('Select an icon for your meta info', 'vp_textdomain'),
					'default' => array(
						'{{first}}',
					),
				),			
				array(
					'type' => 'textbox',
					'name' => 'ozy_buildme_meta_project_meta_info_label',
					'label' => esc_attr__('Label', 'vp_textdomain'),
					'description' => esc_attr__('Enter a label, like "City"', 'vp_textdomain'),
					'default' => ''
				),
				array(
					'type' => 'textbox',
					'name' => 'ozy_buildme_meta_project_meta_info_value',
					'label' => esc_attr__('Value', 'vp_textdomain'),
					'description' => esc_attr__('Type something, like "London"', 'vp_textdomain'),
					'default' => ''
				),						
			),
		),
		array(
			'type' => 'notebox',
			'name' => 'ozy_buildme_meta_project_video_files_infobox',
			'label' => esc_attr__('Video Files', 'vp_textdomain'),
			'description' => esc_attr__('Please only enter YouTube or Vimeo video ID at once, otherwise first entry will be ignored.', 'vp_textdomain'),
			'status' => 'info',
		),		
		array(
			'type'      => 'group',
			'repeating' => true,
			'sortable'	=> true,
			'name'      => 'ozy_buildme_meta_project_video_files',
			'title'     => esc_attr__('Video Files', 'vp_textdomain'),
			'fields'    => array(		
				array(
					'type' => 'upload',
					'name' => 'ozy_buildme_meta_project_meta_video_img',
					'label' => esc_attr__('Preview Image', 'vp_textdomain'),
					'description' => esc_attr__('upload', 'vp_textdomain'),
					'default' => ''
				),
				array(
					'type' => 'textbox',
					'name' => 'ozy_buildme_meta_project_meta_video_label',
					'label' => esc_attr__('Label', 'vp_textdomain'),
					'description' => esc_attr__('Enter any text as slide label', 'vp_textdomain'),
					'default' => ''
				),				
				array(
					'type' => 'textbox',
					'name' => 'ozy_buildme_meta_project_meta_video_youtube',
					'label' => esc_attr__('YouTube Video ID', 'vp_textdomain'),
					'description' => 'http://www.youtube.com/watch?v=<strong>XiBYM6g8Tck</strong> ' . esc_attr__('only bold part', 'vp_textdomain'),
					'default' => ''
				),
				array(
					'type' => 'textbox',
					'name' => 'ozy_buildme_meta_project_meta_video_vimeo',
					'label' => esc_attr__('Vimeo Video ID', 'vp_textdomain'),
					'description' => 'https://vimeo.com/<strong>121810910</strong> ' .esc_attr__('only bold part', 'vp_textdomain'),
					'default' => ''
				),			
			),
		),
		array(
			'type' => 'textbox',
			'name' => 'ozy_buildme_meta_project_map',
			'label' => esc_attr__('Google Map', 'vp_textdomain'),
			'description' => esc_attr__('Enter and absolute address or comma separated coordinates', 'vp_textdomain'),
			'default' => ''
		),							
	),
);

/**
 * EOF
 */