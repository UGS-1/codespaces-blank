<?php

return array(
	'id'          => 'ozy_buildme_meta_page',
	'types'       => array('page'),
	'title'       => esc_attr__('Page Options', 'vp_textdomain'),
	'priority'    => 'high',
	'template'    => array(
		array(
			'type' => 'select',
			'name' => 'ozy_buildme_meta_page_custom_menu',
			'label' => esc_attr__('Custom Menu', 'vp_textdomain'),
			'description' => esc_attr__('You can select a custom menu for this page.', 'vp_textdomain'),
			'items' => array(
				'data' => array(
					array(
						'source' => 'function',
						'value' => 'vp_bind_ozy_buildme_list_wp_menus',
					),
				),
			),
			'default' => '-1',
		),
		array(
			'type' => 'select',
			'name' => 'ozy_buildme_meta_page_revolution_slider',
			'label' => esc_attr__('Revolution Header Slider', 'vp_textdomain'),
			'description' => esc_attr__('You can select a header slider if you have installed and activated Revolution Slider which comes bundled with your theme.', 'vp_textdomain'),
			'items' => array(
				'data' => array(
					array(
						'source' => 'function',
						'value' => 'vp_bind_ozy_buildme_revolution_slider',
					),
				),
			),
			'default' => '{{first}}',
		),
		array(
			'type' => 'select',
			'name' => 'ozy_buildme_meta_page_master_slider',
			'label' => esc_attr__('Master Header Slider', 'vp_textdomain'),
			'description' => esc_attr__('You can select a header slider if you have installed and activated Master Slider which comes bundled with your theme.', 'vp_textdomain'),
			'items' => array(
				'data' => array(
					array(
						'source' => 'function',
						'value' => 'vp_bind_ozy_buildme_master_slider',
					),
				),
			),
			'default' => '{{first}}',
		),		


		array(
			'type' => 'toggle',
			'name' => 'ozy_buildme_meta_page_use_footer_slider',
			'label' => esc_attr__('Use Footer Slider', 'vp_textdomain'),
			'description' => esc_attr__('You can use footer slider with header slider too.', 'vp_textdomain'),
		),
		array(
			'type'      => 'group',
			'repeating' => false,
			'length'    => 1,
			'name'      => 'ozy_buildme_meta_page_use_footer_slider_group',
			'title'     => esc_attr__('Footer Slider', 'vp_textdomain'),
			'dependency' => array(
				'field'    => 'ozy_buildme_meta_page_use_footer_slider',
				'function' => 'vp_dep_boolean',
			),
			'fields'    => array(
				array(
					'type' => 'select',
					'name' => 'ozy_buildme_meta_page_revolution_footer_slider',
					'label' => esc_attr__('Revolution Footer Slider', 'vp_textdomain'),
					'description' => esc_attr__('You can select a footer slider if you have installed and activated Revolution Slider which comes bundled with your theme.', 'vp_textdomain'),
					'items' => array(
						'data' => array(
							array(
								'source' => 'function',
								'value' => 'vp_bind_ozy_buildme_revolution_slider',
							),
						),
					),
					'default' => '{{first}}',
				),
				array(
					'type' => 'select',
					'name' => 'ozy_buildme_meta_page_master_footer_slider',
					'label' => esc_attr__('Master Footer Slider', 'vp_textdomain'),
					'description' => esc_attr__('You can select a footer slider if you have installed and activated Master Slider which comes bundled with your theme.', 'vp_textdomain'),
					'items' => array(
						'data' => array(
							array(
								'source' => 'function',
								'value' => 'vp_bind_ozy_buildme_master_slider',
							),
						),
					),
					'default' => '{{first}}',
				),				
			),
		),

		array(
			'type' => 'toggle',
			'name' => 'ozy_buildme_meta_page_show_loader',
			'label' => esc_attr__('Show Loading Screen', 'vp_textdomain'),
			'description' => esc_attr__('Check this option to display a loading screen for this page only.', 'vp_textdomain'),
		),
		array(
			'type' => 'radiobutton',
			'name' => 'ozy_buildme_meta_page_hide_footer_widget_bar',
			'label' => esc_attr__('Footer Bars Visiblity', 'vp_textdomain'),
			'description' => esc_attr__('By this option you can hide footer bars as you wish.', 'vp_textdomain'),
			'items' => array(
				array(
					'value' => '-1',
					'label' => esc_attr__('All Visible', 'vp_textdomain'),
				),
				array(
					'value' => '1',
					'label' => esc_attr__('Hide Widget Bar', 'vp_textdomain'),
				),
				array(
					'value' => '2',
					'label' => esc_attr__('Hide Widget Bar and Footer', 'vp_textdomain'),
				),
			),
			'default' => array(
				'-1',
			),
		),
		


		array(
			'type' => 'toggle',
			'name' => 'ozy_buildme_meta_page_hide_title',
			'label' => esc_attr__('Hide Page Title', 'vp_textdomain'),
			'description' => esc_attr__('Page title will not be shown on the page.', 'vp_textdomain'),
		),
		
		array(
			'type' => 'toggle',
			'name' => 'ozy_buildme_meta_page_use_no_content_padding',
			'label' => esc_attr__('No content top padding', 'vp_textdomain'),
			'description' => esc_attr__('Check this option to disable the padding top of your content (after page title).', 'vp_textdomain'),
		),		
		array(
			'type' => 'toggle',
			'name' => 'ozy_buildme_meta_page_use_custom_title',
			'label' => esc_attr__('Custom Header/Title', 'vp_textdomain'),
			'description' => esc_attr__('There are several options to help you customize your page header.', 'vp_textdomain'),
		),
		array(
			'type'      => 'group',
			'repeating' => false,
			'length'    => 1,
			'name'      => 'ozy_buildme_meta_page_use_custom_title_group',
			'title'     => esc_attr__('Custom Header/Title Options', 'vp_textdomain'),
			'dependency' => array(
				'field'    => 'ozy_buildme_meta_page_use_custom_title',
				'function' => 'vp_dep_boolean',
			),
			'fields'    => array(	
				array(
					'type' => 'radiobutton',
					'name' => 'ozy_buildme_meta_page_custom_title_position',
					'label' => esc_attr__('Title Position', 'vp_textdomain'),
					'items' => array(
						array(
							'value' => 'left',
							'label' => esc_attr__('Left', 'vp_textdomain'),
						),
						array(
							'value' => 'right',
							'label' => esc_attr__('Right', 'vp_textdomain'),
						),
						array(
							'value' => 'center',
							'label' => esc_attr__('Center', 'vp_textdomain'),
						),
					),
					'default' => array(
						'center',
					),
				),			
				array(
					'type'      => 'textbox',
					'name'      => 'ozy_buildme_meta_page_custom_title',
					'label'     => esc_attr__('Page Title', 'vp_textdomain'),
				),
				array(
					'type'      => 'color',
					'name'      => 'ozy_buildme_meta_page_custom_title_color',
					'label'     => esc_attr__('Title Color', 'vp_textdomain'),
					'default' => '',
					'format' => 'rgba'
				),				
				array(
					'type'      => 'textbox',
					'name'      => 'ozy_buildme_meta_page_custom_sub_title',
					'label'     => esc_attr__('Sub Title', 'vp_textdomain'),
				),
				array(
					'type'      => 'color',
					'name'      => 'ozy_buildme_meta_page_custom_sub_title_color',
					'label'     => esc_attr__('Sub Title Color', 'vp_textdomain'),
					'default' => '',
					'format' => 'rgba'
				),				
				array(
					'type'      => 'color',
					'name'      => 'ozy_buildme_meta_page_custom_title_bgcolor',
					'label'     => esc_attr__('Header Background Color', 'vp_textdomain'),
					'default' => '',
					'format' => 'rgba'
				),				
				array(
					'type'      => 'upload',
					'name'      => 'ozy_buildme_meta_page_custom_title_bg',
					'label'     => esc_attr__('Header Image', 'vp_textdomain'),
					'description'=> esc_attr__('Please use images like 1600px, 2000px wide and have a minimum height like 475px for good results.', 'vp_textdomain'),
				),
				array(
					'type' => 'radiobutton',
					'name' => 'ozy_buildme_meta_page_custom_title_bg_x_position',
					'label' => esc_attr__('Background X-Position', 'vp_textdomain'),
					'items' => array(
						array(
							'value' => 'left',
							'label' => esc_attr__('Left', 'vp_textdomain'),
						),
						array(
							'value' => 'right',
							'label' => esc_attr__('Right', 'vp_textdomain'),
						),
						array(
							'value' => 'center',
							'label' => esc_attr__('Center', 'vp_textdomain'),
						),
						array(
							'value' => 'top',
							'label' => esc_attr__('Top', 'vp_textdomain'),
						),
						array(
							'value' => 'bottom',
							'label' => esc_attr__('Bottom', 'vp_textdomain'),
						),
					),
					'default' => array(
						'left',
					),
				),
				array(
					'type' => 'radiobutton',
					'name' => 'ozy_buildme_meta_page_custom_title_bg_y_position',
					'label' => esc_attr__('Background Y-Position', 'vp_textdomain'),
					'items' => array(
						array(
							'value' => 'left',
							'label' => esc_attr__('Left', 'vp_textdomain'),
						),
						array(
							'value' => 'right',
							'label' => esc_attr__('Right', 'vp_textdomain'),
						),
						array(
							'value' => 'center',
							'label' => esc_attr__('Center', 'vp_textdomain'),
						),
						array(
							'value' => 'top',
							'label' => esc_attr__('Top', 'vp_textdomain'),
						),
						array(
							'value' => 'bottom',
							'label' => esc_attr__('Bottom', 'vp_textdomain'),
						),
					),
					'default' => array(
						'top',
					),
				),				
				array(
					'type'      => 'textbox',
					'name'      => 'ozy_buildme_meta_page_custom_title_height',
					'label'     => esc_attr__('Header Height', 'vp_textdomain'),
					'description'=> esc_attr__('Height of your header in pixels? Don\'t include "px" in the string. e.g. 400', 'vp_textdomain'),
					'default'	=> 170,
					'validation' => 'numeric'
				),				
			),
		),
		array(
			'type' => 'toggle',
			'name' => 'ozy_buildme_meta_page_hide_content',
			'label' => esc_attr__('Hide Page Content', 'vp_textdomain'),
			'description' => esc_attr__('Page content will not be shown. Supposed to use with Video backgrounds or Fullscreen sliders.', 'vp_textdomain'),
		),		
		array(
			'type' => 'toggle',
			'name' => 'ozy_buildme_meta_page_use_sidebar',
			'label' => esc_attr__('Use Custom Sidebar', 'vp_textdomain'),
			'description' => esc_attr__('You can use custom sidebar individually.', 'vp_textdomain'),
		),
		array(
			'type'      => 'group',
			'repeating' => false,
			'length'    => 1,
			'name'      => 'ozy_buildme_meta_page_sidebar_group',
			'title'     => esc_attr__('Custom Sidebar', 'vp_textdomain'),
			'dependency' => array(
				'field'    => 'ozy_buildme_meta_page_use_sidebar',
				'function' => 'vp_dep_boolean',
			),
			'fields'    => array(
				array(
					'type' => 'radioimage',
					'name' => 'ozy_buildme_meta_page_sidebar_position',
					'label' => esc_attr__('Sidebar Position', 'vp_textdomain'),
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
					'default' => '{{first}}',
				),			
				array(
					'type' => 'select',
					'name' => 'ozy_buildme_meta_page_sidebar',
					'label' => esc_attr__('Sidebar', 'vp_textdomain'),
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
		array(
			'type' => 'toggle',
			'name' => 'ozy_buildme_meta_page_use_custom_style',
			'label' => esc_attr__('Use Custom Style', 'vp_textdomain'),
			'description' => esc_attr__('Options to customize your page individually.', 'vp_textdomain'),
		),
		array(
			'type'      => 'group',
			'repeating' => false,
			'length'    => 1,
			'name'      => 'ozy_buildme_meta_page_layout_group',
			'title'     => esc_attr__('Layout Styling', 'vp_textdomain'),
			'dependency' => array(
				'field'    => 'ozy_buildme_meta_page_use_custom_style',
				'function' => 'vp_dep_boolean',
			),
			'fields'    => array(					
				array(
					'type' => 'color',
					'name' => 'ozy_buildme_meta_page_layout_ascend_background',
					'label' => esc_attr__('Background Color', 'vp_textdomain'),
					'description' => esc_attr__('This option will affect, main wrapper\'s background color.', 'vp_textdomain'),
					'default' => 'rgba(255,255,255,1)',
					'format' => 'rgba',
				),
				array(
					'type' => 'toggle',
					'name' => 'ozy_buildme_meta_page_layout_transparent_background',
					'label' => esc_attr__('Transparent Content Background', 'vp_textdomain'),
					'description' => esc_attr__('If you want, you can use transparent background for your content.', 'vp_textdomain'),
					'default' => '0',
				)														
			),
		),
		array(
			'type' => 'toggle',
			'name' => 'ozy_buildme_meta_page_use_custom_background',
			'label' => esc_attr__('Use Custom Background', 'vp_textdomain'),
			'description' => esc_attr__('Lots of options to customize your page background individually.', 'vp_textdomain'),
		),		
		array(
			'type'      => 'group',
			'repeating' => false,
			'name'      => 'ozy_buildme_meta_page_background_group',
			'title'     => esc_attr__('Background Styling', 'vp_textdomain'),
			'dependency' => array(
				'field'    => 'ozy_buildme_meta_page_use_custom_background',
				'function' => 'vp_dep_boolean',
			),
			'fields'    => array(					
				array(
					'type' => 'upload',
					'name' => 'ozy_buildme_meta_page_background_image',
					'label' => esc_attr__('Custom Background Image', 'vp_textdomain'),
					'description' => esc_attr__('Upload or choose custom page background image.', 'vp_textdomain'),
				),
				array(
					'type' => 'radiobutton',
					'name' => 'ozy_buildme_meta_page_background_image_size',
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
					'name' => 'ozy_buildme_meta_page_background_image_pos_x',
					'label' => esc_attr__('Background Position X', 'vp_textdomain'),
					'items' => array(
						array(
							'value' => 'left',
							'label' => esc_attr__('left', 'vp_textdomain'),
						),			
						array(
							'value' => 'center',
							'label' => esc_attr__('center', 'vp_textdomain'),
						),
						array(
							'value' => 'right',
							'label' => esc_attr__('right', 'vp_textdomain'),
						)
					),
					'default' => 'left',
				),
				array(
					'type' => 'radiobutton',
					'name' => 'ozy_buildme_meta_page_background_image_pos_y',
					'label' => esc_attr__('Background Position Y', 'vp_textdomain'),
					'items' => array(
						array(
							'value' => 'top',
							'label' => esc_attr__('top', 'vp_textdomain'),
						),			
						array(
							'value' => 'center',
							'label' => esc_attr__('center', 'vp_textdomain'),
						),
						array(
							'value' => 'bottom',
							'label' => esc_attr__('bottom', 'vp_textdomain'),
						)
					),
					'default' => 'top',
				),				
				
				array(
					'type' => 'radiobutton',
					'name' => 'ozy_buildme_meta_page_background_image_repeat',
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
					'name' => 'ozy_buildme_meta_page_background_image_attachment',
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
				array(
					'type' => 'color',
					'name' => 'ozy_buildme_meta_page_background_color',
					'label' => esc_attr__('Background Color', 'vp_textdomain'),
					'description' => esc_attr__('This option will affect only page background.', 'vp_textdomain'),
					'default' => '#ffffff',
					'format' => 'hex',
				),
				array(
					'type' => 'toggle',
					'name' => 'ozy_buildme_meta_page_background_use_gmap',
					'label' => esc_attr__('Use Google Map', 'vp_textdomain'),
					'description' => esc_attr__('Instead of using a static background, you can use a Google Map as background.', 'vp_textdomain'),
				),					
				array(
					'type'      => 'group',
					'repeating' => false,
					'name'      => 'ozy_buildme_meta_page_background_gmap_group',
					'title'     => esc_attr__('Google Map', 'vp_textdomain'),
					'dependency' => array(
						'field'    => 'ozy_buildme_meta_page_background_use_gmap',
						'function' => 'vp_dep_boolean',
					),
					'fields'    => array(					
						array(
							'type' => 'textbox',
							'name' => 'ozy_buildme_meta_page_background_gmap_address',
							'label' => esc_attr__('iFrame Src', 'vp_textdomain'),
							'description' => esc_attr__('Enter src attribute of your Google Map iFrame.', 'vp_textdomain'),
						)												
					),
				),
				array(
					'type' => 'toggle',
					'name' => 'ozy_buildme_meta_page_background_use_slider',
					'label' => esc_attr__('Use Background Slider', 'vp_textdomain'),
					'description' => esc_attr__('Instead of using a static background, you can use background image slider.', 'vp_textdomain'),
				),					
				array(
					'type'      => 'group',
					'repeating' => true,
					'sortable' => true,
					'name'      => 'ozy_buildme_meta_page_background_slider_group',
					'title'     => esc_attr__('Slider Image', 'vp_textdomain'),
					'dependency' => array(
						'field'    => 'ozy_buildme_meta_page_background_use_slider',
						'function' => 'vp_dep_boolean',
					),
					'fields'    => array(					
						array(
							'type' => 'upload',
							'name' => 'ozy_buildme_meta_page_background_slider_image',
							'label' => esc_attr__('Slider Image', 'vp_textdomain'),
							'description' => esc_attr__('Upload or choose custom background image.', 'vp_textdomain'),
						)												
					),
				),
				array(
					'type' => 'toggle',
					'name' => 'ozy_buildme_meta_page_background_use_video_self',
					'label' => esc_attr__('Use Self Hosted Video', 'vp_textdomain'),
					'description' => esc_attr__('Instead of using a static background, you can use self hosted video.', 'vp_textdomain'),
				),					
				array(
					'type'      => 'group',
					'repeating' => false,
					'sortable' => false,
					'name'      => 'ozy_buildme_meta_page_background_video_self_group',
					'title'     => esc_attr__('Self Hosted Video', 'vp_textdomain'),
					'dependency' => array(
						'field'    => 'ozy_buildme_meta_page_background_use_video_self',
						'function' => 'vp_dep_boolean',
					),
					'fields'    => array(					
						array(
							'type' => 'upload',
							'name' => 'ozy_buildme_meta_page_background_video_self_image',
							'label' => esc_attr__('Poster Image', 'vp_textdomain'),
							'description' => esc_attr__('Upload or choose a poster image.', 'vp_textdomain'),
						),
						array(
							'type' => 'upload',
							'name' => 'ozy_buildme_meta_page_background_video_self_mp4',
							'label' => esc_attr__('MP4 File', 'vp_textdomain'),
							'description' => esc_attr__('Upload or choose a MP4 file.', 'vp_textdomain'),
						),
						array(
							'type' => 'upload',
							'name' => 'ozy_buildme_meta_page_background_video_self_webm',
							'label' => esc_attr__('WEBM File', 'vp_textdomain'),
							'description' => esc_attr__('Upload or choose a WEBM file.', 'vp_textdomain'),
						),
						array(
							'type' => 'upload',
							'name' => 'ozy_buildme_meta_page_background_video_self_ogv',
							'label' => esc_attr__('OGV File', 'vp_textdomain'),
							'description' => esc_attr__('Upload or choose an OGV file.', 'vp_textdomain'),
						)
					),
				),
				array(
					'type' => 'toggle',
					'name' => 'ozy_buildme_meta_page_background_use_video_youtube',
					'label' => esc_attr__('Use YouTube Video', 'vp_textdomain'),
					'description' => esc_attr__('Instead of using a static background, you can use YouTube video.', 'vp_textdomain'),
				),					
				array(
					'type'      => 'group',
					'repeating' => false,
					'sortable' => false,
					'name'      => 'ozy_buildme_meta_page_background_video_youtube_group',
					'title'     => esc_attr__('YouTube Video', 'vp_textdomain'),
					'dependency' => array(
						'field'    => 'ozy_buildme_meta_page_background_use_video_youtube',
						'function' => 'vp_dep_boolean',
					),
					'fields'    => array(					
						array(
							'type' => 'upload',
							'name' => 'ozy_buildme_meta_page_background_video_youtube_image',
							'label' => esc_attr__('Poster Image', 'vp_textdomain'),
							'description' => esc_attr__('Upload or choose a poster image.', 'vp_textdomain'),
						),
						array(
							'type' => 'textbox',
							'name' => 'ozy_buildme_meta_page_background_video_youtube_id',
							'label' => esc_attr__('YouTube Video ID', 'vp_textdomain'),
							'description' => esc_attr__('Enter YouTube video ID. http://www.youtube.com/watch?v=<span style="color:red;">mYKA-VokOtA</span> text marked with red is the ID you have to be looking for.', 'vp_textdomain'),
						)
					),
				),
				array(
					'type' => 'toggle',
					'name' => 'ozy_buildme_meta_page_background_use_video_vimeo',
					'label' => esc_attr__('Use Vimeo Video', 'vp_textdomain'),
					'description' => esc_attr__('Instead of using a static background, you can use Vimeo video.', 'vp_textdomain'),
				),					
				array(
					'type'      => 'group',
					'repeating' => false,
					'sortable' => false,
					'name'      => 'ozy_buildme_meta_page_background_video_vimeo_group',
					'title'     => esc_attr__('Vimeo Video', 'vp_textdomain'),
					'dependency' => array(
						'field'    => 'ozy_buildme_meta_page_background_use_video_vimeo',
						'function' => 'vp_dep_boolean',
					),
					'fields'    => array(					
						array(
							'type' => 'upload',
							'name' => 'ozy_buildme_meta_page_background_video_vimeo_image',
							'label' => esc_attr__('Poster Image', 'vp_textdomain'),
							'description' => esc_attr__('Upload or choose a poster image.', 'vp_textdomain'),
						),
						array(
							'type' => 'textbox',
							'name' => 'ozy_buildme_meta_page_background_video_vimeo_id',
							'label' => esc_attr__('Vimeo Video ID', 'vp_textdomain'),
							'description' => esc_attr__('Enter Vimeo video ID. http://vimeo.com/<span style="color:red;">71964690</span> text marked with red is the ID you have to be looking for.', 'vp_textdomain'),
						)
					),
				)
			),
		),
		array(
			'type' => 'radiobutton',
			'name' => 'ozy_buildme_meta_page_page_model',
			'label' => esc_attr__('Default Page Model', 'vp_textdomain'),
			'items' => array(
				array(
					'value' => 'generic',
					'label' => esc_attr__('Use From Theme Options', 'vp_textdomain'),
				),			
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
				'{{first}}',
			),
		)				
	),	
);

/**
 * EOF
 */