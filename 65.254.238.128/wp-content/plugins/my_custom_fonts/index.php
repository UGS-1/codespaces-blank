<?php
/*
Plugin Name: الخطوط المميزة للمُحرّر المرئي
Plugin URI: http://www.mokfie.com
Description: إضافة مخصصة لعرض الخطوط العربية في محرر ووردبريس لإستخدامها في المقالات والصفحات.
Version: 1.0
Author: Mohammad Okfie | محمد عكفي
Author URI: http://www.facebook.com
*/
function mokfie_buttons($buttons) {
$buttons[] = 'fontselect';
$buttons[] = 'fontsizeselect';
return $buttons;
}
add_filter("mce_buttons", "mokfie_buttons");
function mokfie_custom_fonts($list_fonts){ 
	$list_fonts['font_formats'] = 'خط الكوفي العربي =Droid Arabic Kufi;';
	$list_fonts['font_formats'] .= 'خط النسخ العربي =Droid Arabic Naskh;';
	$list_fonts['font_formats'] .= 'Andale Mono=Andale Mono, Times;Arial=Arial, Helvetica, sans-serif;Arial Black=Arial Black, Avant Garde;Book Antiqua=Book Antiqua, Palatino;Comic Sans MS=Comic Sans MS, sans-serif;Courier New=Courier New, Courier;Georgia=Georgia, Palatino;Helvetica=Helvetica;Impact=Impact, Chicago;Symbol=Symbol;Tahoma=Tahoma, Arial, Helvetica, sans-serif;Terminal=Terminal, Monaco;Times New Roman=Times New Roman, Times;Trebuchet MS=Trebuchet MS, Geneva;Verdana=Verdana, Geneva;Webdings=Webdings;Wingdings=Wingdings';
	$list_fonts['fontsize_formats'] = "10px 12px 14px 16px 18px 24px 30px 36px 48px 60px 72px";
 return $list_fonts;
}
add_filter('tiny_mce_before_init', 'mokfie_custom_fonts' );
function mokfie_show_selected_fonts() {
	$selected_fonts_list = array(
	'Droid+Arabic+Kufi',
	'Droid+Arabic+Naskh',
	'');
    foreach($selected_fonts_list as $fonts) { 
		$path_fonts_css = plugin_dir_url( __FILE__ ).'/css/custom_fonts.css?family='.$fonts.':400,700';
		add_editor_style( str_replace( ',', '%2C', $path_fonts_css ) );
	}
}
add_action( 'init', 'mokfie_show_selected_fonts' );

function reg_stylesheet_fonts() {
	 wp_enqueue_style("reg_fonts", plugin_dir_url( __FILE__ ).'/css/custom_fonts.css', false, "1.0", "all");
}
add_action( 'wp_enqueue_scripts', 'reg_stylesheet_fonts' );
add_action( 'admin_enqueue_scripts', 'reg_stylesheet_fonts' );