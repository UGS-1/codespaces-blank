<?php
/**
* VC ROW
*/
vc_add_param("vc_row", array(
	"type" => 'checkbox',
	"heading" => esc_attr__("Full Width?", "vp_textdomain"),
	"param_name" => "row_fullwidth",
	"description" => esc_attr__("If selected, your row will be stretched to limits of the parent container.", "vp_textdomain"),
	"value" => Array(esc_attr__("Yes, please", "vp_textdomain") => '1')
));

vc_add_param("vc_row", array(
	"type" => 'checkbox',
	"heading" => esc_attr__("Vertical Centered Content?", "vp_textdomain"),
	"param_name" => "row_vertical_center",
	"description" => esc_attr__("If selected, elements in the columns will be tried to aligned as verticaly centered.", "vp_textdomain"),
	"value" => Array(esc_attr__("Yes, please", "vp_textdomain") => '1')
));

vc_add_param("vc_row", array(
	"type" => 'checkbox',
	"heading" => esc_attr__("Full Height?", "vp_textdomain"),
	"param_name" => "row_fullheight",
	"description" => esc_attr__("If selected, your row will be stretched to limits of the document. Useful to build single page sites.", "vp_textdomain"),
	"value" => Array(esc_attr__("Yes, please", "vp_textdomain") => '1')
));

vc_add_param("vc_row", array(
	"type" => 'checkbox',
	"heading" => esc_attr__("Zero Column Space?", "vp_textdomain"),
	"param_name" => "row_zero_column_space",
	"description" => esc_attr__("If selected, your columns inside this row will have no horizontal space between themselves.", "vp_textdomain"),
	"value" => Array(esc_attr__("Yes, please", "vp_textdomain") => '1')
));

if (defined('WPB_VC_VERSION')) { /*font color option removed after 4.4.0, so, add it back*/
	if(version_compare(WPB_VC_VERSION, '4.4.0','>')){
		vc_add_param("vc_row", array(
			"type" => "colorpicker",
			"heading" => esc_attr__('Font Color', 'vp_textdomain'),
			"param_name" => "font_color",
			"description" => esc_attr__("Select font face color", "vp_textdomain"),
			"group" => esc_attr__("Custom Design Options", "vp_textdomain")	
		));		
	}
}

vc_add_param("vc_row", array(
	"type" => 'dropdown',
	"heading" => esc_attr__("Parallax?", "vp_textdomain"),
	"param_name" => "bg_parallax",
	"description" => esc_attr__("If selected, parallax effect will be applied on background image.", "js_composer"),
	"value" => array("", "off", "on"),
	"group" => esc_attr__("Custom Design Options", "vp_textdomain")	
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"heading" => esc_attr__('Background Scroll', 'vp_textdomain'),
	"param_name" => "bg_scroll",
	"value" => array(
			  esc_attr__(" ", 'wpb') => '',
			  esc_attr__("Left", 'wpb') => 'h,-1',
			  esc_attr__("Right", 'wpb') => 'h,1',
			  esc_attr__('Top', 'wpb') => 'y,-1',
			  esc_attr__('Bottom', 'wpb') => 'y,1'
			),
	"description" => esc_attr__("Please do not use with other Background Options", "vp_textdomain"),
	"group" => esc_attr__("Custom Design Options", "vp_textdomain")	
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => esc_attr__("Minimum Height", "vp_textdomain"),
	"param_name" => "row_min_height",
	"description" => esc_attr__("Set minimum height of your row in pixels. Not required", "vp_textdomain")
));

vc_add_param("vc_row", array(
	"type" => 'dropdown',
	"heading" => esc_attr__("Background Slider", "vp_textdomain"),
	"param_name" => "bg_slider",
	"description" => esc_attr__("If selected, you can select background images for your row.", "vp_textdomain"),
	"value" => array("", "off", "on"),
	"group" => esc_attr__("Custom Design Options", "vp_textdomain")	
));

vc_add_param("vc_row", array(
	"type" => "attach_images",
	"heading" => esc_attr__("Images", "vp_textdomain"),
	"param_name" => "bg_slider_images",
	"description" => esc_attr__("Select images for your slider", "vp_textdomain"),
	"dependency" => Array('element' => "bg_slider", 'value' => 'on'),
	"group" => esc_attr__("Custom Design Options", "vp_textdomain")	
));

vc_add_param("vc_row", array(
	"type" => 'dropdown',
	"heading" => esc_attr__("Video Background", "vp_textdomain"),
	"param_name" => "bg_video",
	"description" => esc_attr__("If selected, you can set background of your row as video.", "js_composer"),
	"value" => array("", "off", "on"),
	"group" => esc_attr__("Custom Design Options", "vp_textdomain")	
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => esc_attr__("MP4 File", "vp_textdomain"),
	"param_name" => "bg_video_mp4",
	"description" => esc_attr__("MP4 Video file path", "vp_textdomain"),
	"dependency" => Array('element' => "bg_video", 'value' => 'on'),
	"group" => esc_attr__("Custom Design Options", "vp_textdomain")	
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => esc_attr__("WEBM File", "vp_textdomain"),
	"param_name" => "bg_video_webm",
	"description" => esc_attr__("WEBM Video file path", "vp_textdomain"),
	"dependency" => Array('element' => "bg_video", 'value' => 'on'),
	"group" => esc_attr__("Custom Design Options", "vp_textdomain")	
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => esc_attr__("OGV File", "vp_textdomain"),
	"param_name" => "bg_video_ogv",
	"description" => esc_attr__("OGV Video file path", "vp_textdomain"),
	"dependency" => Array('element' => "bg_video", 'value' => 'on'),
	"group" => esc_attr__("Custom Design Options", "vp_textdomain")	
));

vc_add_param("vc_row", array(
	"type" => "attach_image",
	"heading" => __("Poster Image", "vp_textdomain"),
	"param_name" => "bg_poster_image",
	"description" => __("Poster Image, that will be used as a place holder on mobile devices.", "vp_textdomain"),
	"dependency" => Array('element' => "bg_video", 'value' => 'on'),
	"group" => __("Custom Design Options", "vp_textdomain")	
));

vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"heading" => esc_attr__('Overlay Background', 'vp_textdomain'),
	"param_name" => "video_overlay_color",
	"description" => esc_attr__("Select background color", "vp_textdomain"),
	//"edit_field_class" => 'col-md-6',
	"group" => esc_attr__("Custom Design Options", "vp_textdomain")	
));

/*vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => esc_attr__("Row ID", "vp_textdomain"),
	"param_name" => "row_id",
	"description" => esc_attr__("Set a unique ID for your row. Please do not use spaces and custom characters. Use like; 'about_us' or 'aboutus'. With this option, you can build a single page site.", "js_composer")
));*/

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"heading" => esc_attr__("Bottom Button", "vp_textdomain"),
	"param_name" => "bottom_button",
	"value" => array("", "off", "on"),
	"admin_label" => false,
	"description" => esc_attr__("If selected, you can put a button bottom of your row, useful to jump in page.", "vp_textdomain")
));

vc_add_param("vc_row", array(
	"type" => "select_an_icon",
	"heading" => esc_attr__("Icon", "js_composer"),
	"param_name" => "bottom_button_icon",
	"description" => esc_attr__("Select an icon from the list of available icon set.", "vp_textdomain"),
	"dependency" => Array('element' => "bottom_button", 'value' => 'on')
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => esc_attr__("Link", "js_composer"),
	"param_name" => "bottom_button_link",
	"dependency" => Array('element' => "bottom_button", 'value' => 'on')
));

vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"heading" => esc_attr__("Color", "js_composer"),
	"param_name" => "bottom_button_color",
	"dependency" => Array('element' => "bottom_button", 'value' => 'on'),
	"value" => "#222222"
));
/**
* VC TOGGLE
*/
vc_add_param("vc_toggle", array(
	"type" => 'dropdown',
	"heading" => esc_attr__("Size", "js_composer"),
	"param_name" => "heading_size",
	"description" => esc_attr__("Select size of your heading", "vp_textdomain"),
	"value" => array("", "h4", "h1", "h2", "h3", "h5", "h6")
));

/**
* VC BUTTON 2
*/
vc_add_param("vc_button2", array(
	"type" => "dropdown",
	"heading" => esc_attr__("Full Width?", "vp_textdomain"),
	"param_name" => "full_width",
	"value" => array("", "no", "yes"),
	"group" => esc_attr__("BuildMe Customize", "vp_textdomain"),	
	"admin_label" => false
));
vc_add_param("vc_button2", array(
	"type" => "dropdown",
	"heading" => esc_attr__("Custom Style?", "vp_textdomain"),
	"param_name" => "btn_custom_style",
	"value" => array("", "no", "yes"),
	"group" => esc_attr__("BuildMe Customize", "vp_textdomain"),	
	"admin_label" => false
));
vc_add_param("vc_button2", array(
	"type" => "colorpicker",
	"heading" => esc_attr__('Background Color', 'vp_textdomain'),
	"param_name" => "back_color",
	"description" => esc_attr__("Select background color", "vp_textdomain"),
	"dependency" => Array('element' => "btn_custom_style", 'value' => 'yes'),		
	"group" => esc_attr__("BuildMe Customize", "vp_textdomain"),
	"value" => "#ffd200"
));
vc_add_param("vc_button2", array(
	"type" => "colorpicker",
	"heading" => esc_attr__('Font Color', 'vp_textdomain'),
	"param_name" => "font_color",
	"description" => esc_attr__("Select font face color", "vp_textdomain"),
	"dependency" => Array('element' => "btn_custom_style", 'value' => 'yes'),		
	"group" => esc_attr__("BuildMe Customize", "vp_textdomain"),
	"value" => "#000000"
));
vc_add_param("vc_button2", array(
	"type" => "colorpicker",
	"heading" => esc_attr__('Outline Color', 'vp_textdomain'),
	"param_name" => "outline_color",
	"description" => esc_attr__("Outline color", "vp_textdomain"),
	"dependency" => Array('element' => "btn_custom_style", 'value' => 'yes'),		
	"group" => esc_attr__("BuildMe Customize", "vp_textdomain"),
	"value" => "#ffd200"
));
?>