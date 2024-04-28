<?php
/**
 * Plugin Name: ozythemes BuildMe Theme Essentials
 * Plugin URI: http://themeforest.net/user/freevision/portfolio
 * Description: This plugin will enable Extended Visual Shortcodes for Visual Composer, Custom Fonts, Unlimited Custom Sidebars and few other features for your BUILDME theme.
 * Version: 1.8
 * Author: freevision
 */

define( 'OZY_BUILDME_ESSENTIALS_ACTIVATED', 1 );

/**
 * Custom post types
 */
function ozy_plugin_create_post_types() {
	
	load_plugin_textdomain('vp_textdomain', false, basename( dirname( __FILE__ ) ) . '/translate');
	
	$essentials_options = get_option('ozy_buildme_essentials');
	if(is_array($essentials_options) && isset($essentials_options['project_slug'])) {
		$project_slug = $essentials_options['project_slug'];
	} else {
		$project_slug = 'project';
	}
	
	//User managaged sidebars
	register_post_type( 'ozy_sidebars',
		array(
			'labels' => array(
				'name' => esc_attr__( 'Sidebars', 'vp_textdomain'),
				'singular_name' => esc_attr__( 'Sidebars', 'vp_textdomain'),
				'add_new' => 'Add Sidebar',
				'add_new_item' => 'Add Sidebar',
				'edit_item' => 'Edit Sidebar',
				'new_item' => 'New Sidebar',
				'view_item' => 'View Sidebars',
				'search_items' => 'Search Sidebar',
				'not_found' => 'No Sidebar found',
				'not_found_in_trash' => 'No Sidebar found in Trash'				
			),
			'can_export' => true,
			'public' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => false,				
			'has_archive' => false,
			'rewrite' => false,
			'supports' => array('title'),
			'taxonomies' => array(''),
			'menu_icon' => 'dashicons-align-left'
		)
	);
	
	//Project
	register_post_type( 'ozy_project',
		array(
			'labels' => array(
				'name' => esc_attr__( 'Project', 'vp_textdomain'),
				'singular_name' => esc_attr__( 'Project', 'vp_textdomain'),
				'add_new' => esc_attr__( 'Add Project Item', 'vp_textdomain'),
				'edit_item' => esc_attr__( 'Edit Project Item', 'vp_textdomain'),
				'new_item' => esc_attr__( 'New Project Item', 'vp_textdomain'),
				'view_item' => esc_attr__( 'View Project Item', 'vp_textdomain'),
				'search_items' => esc_attr__( 'Search Project Items', 'vp_textdomain'),
				'not_found' => esc_attr__( 'No Project Items found', 'vp_textdomain'),
				'not_found_in_trash' => esc_attr__( 'No Project Items found in Trash', 'vp_textdomain')				
			),
			'can_export' => true,
			'public' => true,
			'sort' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => $project_slug, 'with_front' => true),
			'supports' => array('title','editor','thumbnail','excerpt','page-attributes','comments'),
			'menu_icon' => 'dashicons-portfolio'
		)
	);	
	
	//User managaged fonts
	register_post_type( 'ozy_fonts',
		array(
			'labels' => array(
				'name' => esc_attr__( 'Custom Fonts', 'vp_textdomain'),
				'singular_name' => esc_attr__( 'Custom Fonts', 'vp_textdomain'),
				'add_new' => 'Add Font',
				'add_new_item' => 'Add Font',
				'edit_item' => 'Edit Font',
				'new_item' => 'New Font',
				'view_item' => 'View Font',
				'search_items' => 'Search Font',
				'not_found' => 'No Font found',
				'not_found_in_trash' => 'No Font found in Trash'				
			),
			'can_export' => true,
			'public' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => false,				
			'has_archive' => false,
			'rewrite' => false,
			'supports' => array('title'),
			'taxonomies' => array(''),
			'menu_icon' => 'dashicons-editor-textcolor'
		)
	);	
}
add_action( 'init', 'ozy_plugin_create_post_types', 0 );

/**
 * Custom taxonomy registration
 */
function ozy_plugin_create_custom_taxonomies()
{
	//Project Categories
	$labels = array(
		'name' => esc_attr__( 'Project Categories', 'vp_textdomain' ),
		'singular_name' => esc_attr__( 'Project Category', 'vp_textdomain' ),
		'search_items' =>  esc_attr__( 'Search Project Categories', 'vp_textdomain' ),
		'popular_items' => esc_attr__( 'Popular Project Categories', 'vp_textdomain' ),
		'all_items' => esc_attr__( 'All Project Categories', 'vp_textdomain' ),
		'parent_item' => esc_attr__( 'Parent Project Categories', 'vp_textdomain' ),
		'parent_item_colon' => esc_attr__( 'Parent Project Category:', 'vp_textdomain' ),
		'edit_item' => esc_attr__( 'Edit Project Category', 'vp_textdomain' ),
		'update_item' => esc_attr__( 'Update Project Category', 'vp_textdomain' ),
		'add_new_item' => esc_attr__( 'Add New Project Category', 'vp_textdomain' ),
		'new_item_name' => esc_attr__( 'New Project Category', 'vp_textdomain' ),
	);
	
	register_taxonomy('project_category', array('ozy_project'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'sort' => true,
		'rewrite' => array( 'slug' => 'project_category' ),
	));
	

}
add_action( 'init', 'ozy_plugin_create_custom_taxonomies', 0 );

/**
 * Options panel for this plugin
 */
class OzyEssentialsOptionsPage_BuildMe
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'ozy Essentials', 
            'manage_options', 
            'ozy-buildme-essentials-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'ozy_buildme_essentials' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>ozy Essentials Options</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'ozy_buildme_essentials_option_group' );
                do_settings_sections( 'ozy-buildme-essentials-setting-admin' );
				do_settings_sections( 'ozy-buildme-essentials-setting-admin-twitter' );
				do_settings_sections( 'ozy-buildme-essentials-setting-admin-instagram' );
			
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'ozy_buildme_essentials_option_group', // Option group
            'ozy_buildme_essentials', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'ozy-buildme-essentials-setting-admin', // ID
            'Options', // Title
            array( $this, 'print_section_info' ), // Callback
            'ozy-buildme-essentials-setting-admin' // Page
        );
		
        add_settings_field(
            'project_slug', 
            'Project Slug Name', 
            array( $this, 'field_callback' ), 
            'ozy-buildme-essentials-setting-admin', 
            'ozy-buildme-essentials-setting-admin'
        );		
		
        add_settings_section(
            'ozy-buildme-essentials-setting-admin-twitter', 
            'Twitter Parameters', 
            array( $this, 'print_twitter_section_info' ),
            'ozy-buildme-essentials-setting-admin-twitter'
        );		

        add_settings_section(
            'ozy-buildme-essentials-setting-admin-instagram', 
            'Instagram Parameters', 
            array( $this, 'print_instagram_section_info' ),
            'ozy-buildme-essentials-setting-admin-instagram'
        );				
		
        add_settings_field(
            'twitter_consumer_key', 
            'Consumer Key', 
            array( $this, 'field_callback_twitter_consumer_key' ), 
            'ozy-buildme-essentials-setting-admin-twitter', 
            'ozy-buildme-essentials-setting-admin-twitter'
        );

		add_settings_field(
            'twitter_secret_key', 
            'Secret Key', 
            array( $this, 'field_callback_twitter_secret_key' ), 
            'ozy-buildme-essentials-setting-admin-twitter', 
            'ozy-buildme-essentials-setting-admin-twitter'
        );
		
		add_settings_field(
            'twitter_token_key', 
            'Access Token Key', 
            array( $this, 'field_callback_twitter_token_key' ), 
            'ozy-buildme-essentials-setting-admin-twitter', 
            'ozy-buildme-essentials-setting-admin-twitter'
        );
		
		add_settings_field(
            'twitter_token_secret_key', 
            'Access Token Secret Key', 
            array( $this, 'field_callback_twitter_token_secret_key' ), 
            'ozy-buildme-essentials-setting-admin-twitter', 
            'ozy-buildme-essentials-setting-admin-twitter'
        );

		add_settings_field(
            'instagram_access_token_key', 
            'Access Token Key', 
            array( $this, 'field_callback_instagram_access_token_key' ), 
            'ozy-buildme-essentials-setting-admin-instagram', 
            'ozy-buildme-essentials-setting-admin-instagram'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        if( !empty( $input['project_slug'] ) )
            $input['project_slug'] = sanitize_text_field( $input['project_slug'] );
			
		if( !empty( $input['twitter_consumer_key'] ) )
            $input['twitter_consumer_key'] = sanitize_text_field( $input['twitter_consumer_key'] );

		if( !empty( $input['twitter_secret_key'] ) )
            $input['twitter_secret_key'] = sanitize_text_field( $input['twitter_secret_key'] );

        if( !empty( $input['twitter_token_key'] ) )
            $input['twitter_token_key'] = sanitize_text_field( $input['twitter_token_key'] );

        if( !empty( $input['twitter_token_secret_key'] ) )
            $input['twitter_token_secret_key'] = sanitize_text_field( $input['twitter_token_secret_key'] );			

		if( !empty( $input['instagram_access_token_key'] ) )
            $input['instagram_access_token_key'] = sanitize_text_field( $input['instagram_access_token_key'] );			

        return $input;
    }

	/** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'If you want your project post types to have a custom slug in the URL, please enter it here.
		<p><strong>You will still have to refresh your permalinks after saving this!</strong>
		<br>This is done by going to Settings > Permalinks and clicking save.</p>';
    }
	
    /** 
     * Print the Section text
     */
    public function print_twitter_section_info()
    {
        print 'Enter required parameters of your Twitter Dev. account <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a>';
    }	

    /** 
     * Get the settings option array and print one of its values : Project Slug
     */
    public function field_callback()
    {
        printf(
            '<input type="text" id="project_slug" name="ozy_buildme_essentials[project_slug]" value="%s" />',
            (!isset($this->options['project_slug']) ? 'project' : esc_attr( $this->options['project_slug']))
        );
    }	
	
    public function print_instagram_section_info()
    {
        print 'Enter required parameters of your Instagram  API. Get your Access Token and User ID <a href="https://api.instagram.com/oauth/authorize/?client_id=ab103e54c54747ada9e807137db52d77&redirect_uri=http://blueprintinteractive.com/tutorials/instagram/uri.php&response_type=code" target="_blank">here</a>.';
    }	

    /** 
     * Get the settings option array and print one of its values : Twitter Consumer Key
     */	
    public function field_callback_twitter_consumer_key()
    {
        printf(
            '<input type="text" id="twitter_consumer_key" name="ozy_buildme_essentials[twitter_consumer_key]" value="%s" />',
            (!isset($this->options['twitter_consumer_key']) ? '' : esc_attr( $this->options['twitter_consumer_key']))
        );
    }

    /** 
     * Get the settings option array and print one of its values : Twitter Secret Key
     */	
    public function field_callback_twitter_secret_key()
    {
        printf(
            '<input type="text" id="twitter_secret_key" name="ozy_buildme_essentials[twitter_secret_key]" value="%s" />',
            (!isset($this->options['twitter_secret_key']) ? '' : esc_attr( $this->options['twitter_secret_key']))
        );		
    }

    /** 
     * Get the settings option array and print one of its values : Twitter Token Key
     */	
    public function field_callback_twitter_token_key()
    {
        printf(
            '<input type="text" id="twitter_token_key" name="ozy_buildme_essentials[twitter_token_key]" value="%s" />',
            (!isset($this->options['twitter_token_key']) ? '' : esc_attr( $this->options['twitter_token_key']))
        );		
    }

    /** 
     * Get the settings option array and print one of its values : Twitter Token Secret Key
     */
    public function field_callback_twitter_token_secret_key()
    {
        printf(
            '<input type="text" id="twitter_token_secret_key" name="ozy_buildme_essentials[twitter_token_secret_key]" value="%s" />',
            (!isset($this->options['twitter_token_secret_key']) ? '' : esc_attr( $this->options['twitter_token_secret_key']))
        );		
    }
	
    /** 
     * Get the settings option array and print one of its values : Instagram Access Token Key
     */
    public function field_callback_instagram_access_token_key()
    {
        printf(
            '<input type="text" id="instagram_access_token_key" name="ozy_buildme_essentials[instagram_access_token_key]" value="%s" />',
            (!isset($this->options['instagram_access_token_key']) ? '' : esc_attr( $this->options['instagram_access_token_key']))
        );		
    }	

}

/** 
 * Register activation redirection
 */
register_activation_hook(__FILE__, 'ozy_essentials_plugin_activate');
add_action('admin_init', 'ozy_essentials_plugin_activate_redirect');

function ozy_essentials_plugin_activate() {
    add_option('ozy_essentials_plugin_activate_redirect', true);
}

function ozy_essentials_plugin_activate_redirect() {
    if (get_option('ozy_essentials_plugin_activate_redirect', false)) {
        delete_option('ozy_essentials_plugin_activate_redirect');
        wp_redirect('options-general.php?page=ozy-buildme-essentials-setting-admin');
    }
}

/**
 * We need this plugin to work only on admin side
 */

if( is_admin() ) {
    $ozy_essentials_options_page = new OzyEssentialsOptionsPage_BuildMe();
}

/**
 * Shortcodes
 */

if ( ! function_exists( 'is_plugin_active' ) ) require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
if(is_plugin_active("js_composer/js_composer.php") && function_exists('wpb_map') && function_exists('vc_set_as_theme')) {

	//Icon Selector Attribute Type
	function ozy_select_an_icon_settings_field($settings, $value) {
	   /*$dependency = vc_generate_dependencies_attributes($settings);
	   return '<div class="select_an_icon">'
				 .'<input name="'.$settings['param_name']
				 .'" id="field_'.$settings['param_name']
				 .'_select" class="wpb_vc_param_value wpb-textinput '
				 .$settings['param_name'].' '.$settings['type'].'_field" type="text" value="'
				 .$value.'" ' . $dependency . '/>'
			 .'</div>';*/
        //$dependency = vc_generate_dependencies_attributes($settings);
       return '<div class="select_an_icon">'
                 .'<input name="'.$settings['param_name']
                 .'" id="field_'.$settings['param_name']
                 .'_select" class="wpb_vc_param_value wpb-textinput '
                 .$settings['param_name'].' '.$settings['type'].'_field" type="text" value="'
                 .$value.'"/>'
             .'</div>';
	}

	vc_add_shortcode_param('select_an_icon', 'ozy_select_an_icon_settings_field', get_template_directory_uri() .'/scripts/admin/admin.js');

	$add_css_animation = array(
		"type" => "dropdown",
		"heading" => esc_attr__("CSS Animation", "vp_textdomain"),
		"param_name" => "css_animation",
		"admin_label" => true,
		"value" => array(esc_attr__("No", "vp_textdomain") => '', esc_attr__("Top to bottom", "vp_textdomain") => "top-to-bottom", esc_attr__("Bottom to top", "vp_textdomain") => "bottom-to-top", esc_attr__("Left to right", "vp_textdomain") => "left-to-right", esc_attr__("Right to left", "vp_textdomain") => "right-to-left", esc_attr__("Appear from center", "vp_textdomain") => "appear"),
		"description" => esc_attr__("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "vp_textdomain")
	);

	$animate_css_effects = array("flash","bounce","shake","tada","swing","wobble","pulse","flip","flipInX","flipOutX","flipInY","flipOutY","fadeIn","fadeInUp","fadeInDown","fadeInLeft","fadeInRight","fadeInUpBig","fadeInDownBig","fadeInLeftBig","fadeInRightBig","fadeOut","fadeOutUp","fadeOutDown","fadeOutLeft","fadeOutRight","fadeOutUpBig","fadeOutDownBig","fadeOutLeftBig","fadeOutRightBig","bounceIn","bounceInDown","bounceInUp","bounceInLeft","bounceInRight","bounceOut","bounceOutDown","bounceOutUp","bounceOutLeft","bounceOutRight","rotateIn","rotateInDownLeft","rotateInDownRight","rotateInUpLeft","rotateInUpRight","rotateOut","rotateOutDownLeft","rotateOutDownRight","rotateOutUpLeft","rotateOutUpRight","hinge","rollIn","rollOut");

	/**
	* Simple Info Box
	*/
	if (!function_exists('ozy_vc_simpleimagegrid')) {
		function ozy_vc_simpleimagegrid( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_simpleimagegrid', $atts);
			extract(shortcode_atts(array(
				'image'			=> '',
				'img_size'		=> 'boxyboxy',
				'element_per_row'	=> '4',
				'extra_css'		=> '',
				'css_animation' => '',
				'hover_model'	=> 'simple_hover'
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}
			
			wp_enqueue_script('masonry');
			
			$output = '';
			$image = explode(',', $image);
			if($hover_model === 'simple_hover') {
				foreach($image as $img_id){
					$attachment  = get_post($img_id);
					$image = wp_get_attachment_image_src($img_id, $img_size);
					if(isset($image[0])) {
						$output .= '<div class="thumb"><a href="'. esc_url($attachment->guid) .'" class="fancybox" rel="gallery" title="'. esc_attr($attachment->post_title) .'"><span></span><img src="'. esc_url($image[0]) .'" alt=""/></a></div>';
					}
				}
			}else{
				foreach($image as $img_id){
					$attachment  = get_post($img_id);
					$image = wp_get_attachment_image_src($img_id, $img_size);
					if(isset($image[0])) {
						$output .= '<div class="thumb ozy-card effect__hover">
							<div class="ozy-card__front">
								<a href="'. esc_url($attachment->guid) .'" class="ozy-card__text fancybox" rel="gallery" title="'. esc_attr($attachment->post_title) .'"><img src="'. esc_url($image[0]) .'" alt=""/></a>
							</div>
							<div class="ozy-card__back">
								<a href="'. esc_url($attachment->guid) .'" class="ozy-card__text fancybox" rel="gallery" title="'. esc_attr($attachment->post_title) .'"><span>'. esc_attr($attachment->post_title) .'</span></a>
							</div>
						</div>';
					}
				}			
			}
			
			return '<div class="ozy-simple-image-grid hover-model-'. esc_attr($hover_model) .' ozy-masonry-gallery column-'. esc_attr($element_per_row) .'" '. $css_animation .'>'. $output .'</div>';
		}
		
		add_shortcode('ozy_vc_simpleimagegrid', 'ozy_vc_simpleimagegrid');
		
		vc_map( array(
			"name" => esc_attr__("Simple Image Grid", "vp_textdomain"),
			"base" => "ozy_vc_simpleimagegrid",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Model", "vp_textdomain"),
					"param_name" => "hover_model",
					"value" => array("simple_hover", "flip_box"),
					"admin_label" => true
				),			
				array(
					"type" => "attach_images",
					"class" => "",
					"heading" => esc_attr__("Images", "vp_textdomain"),
					"param_name" => "image",
					"admin_label" => false,
					"value" => ""
				),
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Image size", "vp_textdomain"),
					"param_name" => "img_size",
					"value" => "boxyboxy",
					"description" => esc_attr__("Enter image size. Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Grid elements per row", "vp_textdomain"),
					"param_name" => "element_per_row",
					"value" => array("4", "2", "3", "5", "6"),
					"admin_label" => false,
					"description" => esc_attr__("Select number of single grid elements per row.", "vp_textdomain")
				),
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   )
		) );
	}	
	
	/**
	* Simple Divider
	*/
	if (!function_exists('ozy_vc_simple_divider')) {
		function ozy_vc_simple_divider( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_simple_divider', $atts);
			extract(shortcode_atts(array(
				'accent_color' => '#ffc000',
				'divider_color' => '#dfdfdf',
				'css_animation' => '',
				'accent_align' => 'left',
				'accent_size' => '1'
				), $atts ) 
			);
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}
			
			$style = 'height:' . esc_attr($accent_size) .'px';
			if((int)$accent_size>1) { $style .= ';margin-top:-'. ((int)$accent_size-1) . 'px'; }
			switch($accent_align) {
				case "right":
					$style .= ';float:right;';
					break;
				case "center":
					$style .= ';position:absolute;left:50%;margin-left:-50px;';
					break;
			}

			return '<div class="header-line'. $css_animation .'" style="background-color:'. esc_attr($divider_color) .'"><span style="'. $style .';background-color:'. esc_attr($accent_color) .'"></span></div>';
		}

		add_shortcode('ozy_vc_simple_divider', 'ozy_vc_simple_divider');

		vc_map( array(
		   "name" => esc_attr__("Simple Divider", "vp_textdomain"),
		   "base" => "ozy_vc_simple_divider",
		   "class" => "",
		   "controls" => "full",
		   'category' => 'by OZY',
		   "icon" => "icon-wpb-ozy-el",
		   "params" => array(
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Accent Color", "vp_textdomain"),
					"param_name" => "accent_color",
					"admin_label" => false,
					"value" => "#ffc000"
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Divider Color", "vp_textdomain"),
					"param_name" => "divider_color",
					"admin_label" => false,
					"value" => "#dfdfdf"
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Align", "vp_textdomain"),
					"param_name" => "accent_align",
					"value" => array("left", "right", "center"),
					"admin_label" => true
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Size", "vp_textdomain"),
					"param_name" => "accent_size",
					"value" => array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10"),
					"admin_label" => false
				)
				,$add_css_animation	
				)
			) 
		);	
	}		
	
	/**
	* Project Listing
	*/
	if (!function_exists('ozy_vc_project_listing')) {
		function ozy_vc_project_listing( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_project_listing', $atts);
			extract( shortcode_atts( array(
				  'title' => '',
				  'item_count' => '',
				  'category_id' => '',				  
				  'tag' => '',
				  'orderby' => 'date',
				  'order' => 'DESC',
				  'post_status' => 'published',
				  'filter_align' => 'left',
				  'column_count' => '4',
				  'item_space' => 'no',
				  'visible_item_count' => '8'
				), $atts ) 
			);
			
			global $ozyHelper;		
			
			if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;

			$output = '';

			wp_enqueue_script('isotope');
			wp_enqueue_style('ozy-project');

			$args = array(
				'hide_empty'    => 1,
				'hierarchical'  => 1,
				'pad_counts'    => false
			);
			
			if(!empty($category_id)) {
				$args['include'] = $category_id;
			}

			$output .= '<ul id="project-filter" class="component-model filter-align-'. esc_attr($filter_align) .'">';
			$output .= '<li class="active"><a href="#all" data-filter=".category-all">'. esc_attr__('ALL PROJECTS', 'vp_textdomain') .'</a></li>';
			$categories = get_terms('project_category', $args); 
			foreach ($categories as $category) {
				$output .= '<li class="s"></li><li><a href="#'. $category->slug .'" data-filter=".category-'. $category->slug .'">'. $category->name .'</a></li>';
			}
			$output .= '</ul>';
			
			$args = array(
				'post_type' 			=> 'ozy_project',
				'posts_per_page'		=> ( (int)$item_count <= 0 ? get_option("posts_per_page") : ((int)$item_count > 0 ? $item_count : 30) ),
				'orderby' 				=> ( !empty($orderby) ? $orderby : 'date' ),
				'order' 				=> ( !empty($order) ? $order : 'DESC' ),
				'ignore_sticky_posts' 	=> 1,
				'meta_key' 				=> '_thumbnail_id'				
			);
			
			if(!empty($category_id)) {
				$args['tax_query'] = array(
					array(
						'taxonomy' 	=> 'project_category',
						'field' 	=> 'id',
						'terms' 	=> explode(",", $category_id),
						'operator' 	=> 'IN'
					)
				);
			}	
			
			$output .= '<div class="ozy-project-listing wpb_wrapper isotope '. ($item_space == 'yes' ? 'custom-gutter' : '') .' column-'. esc_attr($column_count) .'" data-visible_item_count="'. esc_attr($visible_item_count) .'">';
			
			if($item_space == 'yes') {
				$output .= '<div class="grid-sizer"></div><div class="gutter-sizer"></div>';
			}

			$the_query = new WP_Query( $args );

			while ( $the_query->have_posts() ) {
				$the_query->the_post();
								
				$tax_terms = get_the_terms(get_the_ID(), 'project_category');$tax_terms_slug=array();$tax_terms_name=array();
				if(is_array($tax_terms)) {
					$tax_terms_slug = wp_list_pluck($tax_terms, 'slug');
					$tax_terms_name = wp_list_pluck($tax_terms, 'name');
				}
				/*$tax_terms_slug = is_array($tax_terms_slug)? $tax_terms_slug : array();
				$tax_terms_name = is_array($tax_terms_name)? $tax_terms_name : array();*/
				
				$output .= '<div class="category-all category-'. implode(' category-', $tax_terms_slug) .' ozy_project">';

				$thumbnail_image_src = $post_image_src = array();
				if ( has_post_thumbnail() ) { 
					$thumbnail_image_src 	= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'blog' , false );
					$post_image_src 		= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' , false );						

					if ( isset($thumbnail_image_src[0]) && isset($post_image_src[0])) { 
						$output .= '<div class="featured-thumbnail" style="background-image:url('. esc_url($post_image_src[0]) .');">';
							$output .= '<div class="caption">';
								$output .= '<h5 class="heading">';
								$output .= '<a href="'. get_permalink() .'" title="'. get_the_title() .'" rel="bookmark">' . 
								( get_the_title() ? get_the_title() : get_the_time('F j, Y') ) 
								. '</a>';
								$output .= '</h5>';
								$output .= '<div class="border"><span></span></div>';
								$output .= '<p>' . implode(', ', $tax_terms_name) . '</p>';
								$output .= '<a href="'. esc_url($thumbnail_image_src[0]) .'" class="fancybox plus-icon" rel="project-gallery" title="'. esc_attr(get_the_title()) .'"><i class="oic-plus-1"></i></a>';
							$output .= '</div>';
						$output .= get_the_post_thumbnail(get_the_ID(), 'blog');
						$output .= '</div>';
					}
				}
				$output .= '</div>';				
			}
			wp_reset_postdata();

			return $output .'</div>';			
		}

		add_shortcode( 'ozy_vc_project_listing', 'ozy_vc_project_listing' );

		vc_map( array(
		   "name" => esc_attr__("Project Listing", "vp_textdomain"),
		   "base" => "ozy_vc_project_listing",
		   "icon" => "icon-wpb-ozy-el",
		   'category' => 'by OZY',
		   "params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"value" => "",
					"admin_label" => true,
					"description" => esc_attr__("Component title", "vp_textdomain")
				),   
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Post Count", "vp_textdomain"),
					"param_name" => "item_count",
					"value" => "30",
					"admin_label" => false,
					"description" => esc_attr__("How many post will be populated from the source?", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Categories", "vp_textdomain"),
					"param_name" => "category_id",
					"description" => esc_attr__("If you want to narrow output, enter category slug names here. Display posts that have this category (and any children of that category), use category ID (NOT name OR slug). Split IDs with ','. More information; <a href='http://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters' target='_blank'>http://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters</a>", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Tags", "vp_textdomain"),
					"param_name" => "tag",
					"description" => esc_attr__("If you want to narrow output, enter tag slug names here. Display posts that have this tag, use tag slug (NOT name). Split names with ','. More information; <a href='http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters' target='_blank'>http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters</a>", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Order by", "vp_textdomain"),
					"param_name" => "orderby",
					"value" => array(esc_attr__("Date", "vp_textdomain") => "date", esc_attr__("ID", "vp_textdomain") => "ID", esc_attr__("Author", "vp_textdomain") => "author", esc_attr__("Title", "vp_textdomain") => "title", esc_attr__("Modified", "vp_textdomain") => "modified", esc_attr__("Random", "vp_textdomain") => "rand", esc_attr__("Comment count", "vp_textdomain") => "comment_count", esc_attr__("Menu order", "vp_textdomain") => "menu_order" ),
					"description" => esc_attr__('Select how to sort retrieved posts. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.', 'js_composer')
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Order way", "vp_textdomain"),
					"param_name" => "order",
					"value" => array(esc_attr__("Descending", "vp_textdomain") => "DESC", esc_attr__("Ascending", "vp_textdomain") => "ASC" ),
					"description" => esc_attr__('Designates the ascending or descending order. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.', "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Post Status", "vp_textdomain"),
					"param_name" => "post_status",
					"value" => array("publish", "pending", "draft", "auto-draft", "future", "private", "inherit", "trash", "any"),
					"admin_label" => false,
					"description" => esc_attr__("Show posts associated with certain status.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Column Count", "vp_textdomain"),
					"param_name" => "column_count",
					"value" => array("4", "3"),
					"admin_label" => false
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Space Between Items", "vp_textdomain"),
					"param_name" => "item_space",
					"value" => array("no", "yes"),
					"admin_label" => false
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Visible Item Count", "vp_textdomain"),
					"param_name" => "visible_item_count",
					"value" => "8",
					"admin_label" => false,
					"description" => esc_attr__("How many post will be listed All Projects tab?", "vp_textdomain")
				),				
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Filter Align", "vp_textdomain"),
					"param_name" => "filter_align",
					"value" => array("left", "center"),
					"admin_label" => false
				)				
		   )
		) );	
	}	
	
	/**
	* Fancy Tab
	*/
	if (!function_exists('ozy_vc_fancytab_wrapper')) {
		function ozy_vc_fancytab_wrapper( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_fancytab_wrapper', $atts);
			extract(shortcode_atts(array(
				'model'			=> 'tabs-style-underline',
				'color1'		=> '',
				'color2'		=> '',
				'color3'		=> '',
				'color4'		=> '',
				'extra_css'		=> '',
				'css_animation' => ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}

			wp_enqueue_script('fancy-tabs');
			wp_enqueue_style('fancy-tabs');
			
			$GLOBALS['OZY_FANCY_TAB_NAV'] 		= '';
			$GLOBALS['OZY_FANCY_TAB_CONTENT'] 	= '';
			$GLOBALS['OZY_FANCY_TAB_MODEL']		= $model;
			$GLOBALS['OZY_FANCY_TAB_COUNTER']	= 1;
			
			do_shortcode($content);
			
			$output = '<nav><ul>'. $GLOBALS['OZY_FANCY_TAB_NAV'] .'</ul></nav>';
			$output.= '<div class="content-wrap">'. $GLOBALS['OZY_FANCY_TAB_CONTENT'] .'</div>';
			
			global $ozyHelper;
			$ozyHelper->set_footer_style('.tabs nav{background-color:'. esc_attr($color1) .'!important}');
			$ozyHelper->set_footer_style('.tabs nav ul li a{background-color:'. esc_attr($color2) .'!important;color:'. esc_attr($color3) .'!important}');
			$ozyHelper->set_footer_style('.tabs nav ul li:not(.tab-current) a:hover,.tabs-style-bar nav ul li a:focus{color:'. esc_attr($color4) .'!important}');
			$ozyHelper->set_footer_style('.tabs nav ul li.tab-current a{background-color:'. esc_attr($color4) .'!important;color:'. esc_attr($color2) .'!important}');

			switch($model) {
				case 'tabs-style-iconbox':
					$ozyHelper->set_footer_style('.tabs-style-iconbox nav ul li.tab-current a::after{border-top-color:'. esc_attr($color4) .'!important}');
					$ozyHelper->set_footer_style('.tabs-style-iconbox nav ul li:first-child::before, .tabs-style-iconbox nav ul li::after{background:'. esc_attr($color1) .'!important}');					
					break;
				case 'tabs-style-underline':
					$ozyHelper->set_footer_style('.tabs nav ul li a{color:'. esc_attr($color4) .'!important}');
					$ozyHelper->set_footer_style('.tabs nav ul li.tab-current a{background-color:'. esc_attr($color2) .'!important;color:'. esc_attr($color3) .'!important}');
					$ozyHelper->set_footer_style('.tabs-style-underline nav li a::after{background:'. esc_attr($color4) .'!important}');					
					break;
				case 'tabs-style-linetriangle':
					$ozyHelper->set_footer_style('.tabs nav,.tabs nav ul li.tab-current a{background-color:transparent!important;color:'. esc_attr($color3) .'!important}');
					$ozyHelper->set_footer_style('.tabs nav ul li a{background-color:transparent!important;color:'. esc_attr($color4) .'!important}');
					$ozyHelper->set_footer_style('.tabs nav ul li.tab-current a:after{border-top-color:'. esc_attr($color1) .'!important}');
					break;
				case 'tabs-style-topline':
					$ozyHelper->set_footer_style('.tabs-style-topline nav ul li a{background-color:'. esc_attr($color1) .'!important;color:'. esc_attr($color3) .'!important}');
					$ozyHelper->set_footer_style('.tabs-style-topline nav ul li.tab-current a{background-color:'. esc_attr($color2) .'!important;color:'. esc_attr($color4) .'!important}');
					$ozyHelper->set_footer_style('.tabs-style-topline nav li.tab-current a{box-shadow:inset 0 3px 0 '. esc_attr($color4) .'!important}');
					$ozyHelper->set_footer_style('.tabs-style-topline nav li.tab-current{border-top-color:'. esc_attr($color4) .'!important;}');
					$ozyHelper->set_footer_style('.tabs-style-topline nav li{border-bottom:none!important}');
					break;
				case 'tabs-style-iconfall':
					$ozyHelper->set_footer_style('.tabs-style-iconfall nav ul li a{color:'. esc_attr($color3) .'!important}');
					$ozyHelper->set_footer_style('.tabs-style-iconfall nav ul li.tab-current a{color:'. esc_attr($color4) .'!important}');
					$ozyHelper->set_footer_style('.tabs-style-iconfall nav ul li.tab-current a,.tabs-style-iconfall nav ul li a{background-color:transparent!important}');
					$ozyHelper->set_footer_style('.tabs-style-iconfall nav li::before{background-color:'. esc_attr($color4) .'!important}');
					break;
			}

		 	unset($GLOBALS['OZY_FANCY_TAB_NAV']);
			unset($GLOBALS['OZY_FANCY_TAB_CONTENT']);
			unset($GLOBALS['OZY_FANCY_TAB_MODEL']);
			unset($GLOBALS['OZY_FANCY_TAB_COUNTER']);
			
			return '<div class="tabs '. esc_attr($model) .'">'. $output .'</div>';
		}
		
		add_shortcode('ozy_vc_fancytab_wrapper', 'ozy_vc_fancytab_wrapper');
		
		vc_map( array(
			"name" => esc_attr__("Fancy Tab", "vp_textdomain"),
			"base" => "ozy_vc_fancytab_wrapper",
			"as_parent" => array('only' => 'ozy_vc_fancytab'),
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Model", "vp_textdomain"),
					"param_name" => "model",
					"value" => array("", "tabs-style-bar","tabs-style-iconbox","tabs-style-underline","tabs-style-linetriangle","tabs-style-topline","tabs-style-iconfall"),
					"admin_label" => true
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Color #1", "vp_textdomain"),
					"param_name" => "color1",
					"admin_label" => true,
					"value" => "rgba(40,44,42,0.05)"
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Color #2", "vp_textdomain"),
					"param_name" => "color2",
					"admin_label" => true,
					"value" => "#ffffff"
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Color #3", "vp_textdomain"),
					"param_name" => "color3",
					"admin_label" => true,
					"value" => "#000000"
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Color #4", "vp_textdomain"),
					"param_name" => "color4",
					"admin_label" => true,
					"value" => "#34ccff"
				),
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   ),
		   "js_view" => 'VcColumnView'
		) );
	}

	if (!function_exists('ozy_vc_fancytab')) {
		function ozy_vc_fancytab( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_fancytab', $atts);
			extract(shortcode_atts(array(
				'icon'		=> '',
				'title'		=> ''
			), $atts));

			$rand_id = 'tab-section-' . $GLOBALS['OZY_FANCY_TAB_COUNTER'];

			$GLOBALS['OZY_FANCY_TAB_NAV'] 		.= '<li><a href="#'. esc_attr($rand_id) .'" class="'. ($icon && $GLOBALS['OZY_FANCY_TAB_MODEL'] != 'tabs-style-linetriangle' ? 'icon ' . esc_attr($icon) : '') .'"><span>'.esc_attr($title) .'</span></a></li>';
			$GLOBALS['OZY_FANCY_TAB_CONTENT'] 	.= '<section id="'. esc_attr($rand_id) .'">'. $content .'</section>';
			$GLOBALS['OZY_FANCY_TAB_COUNTER']	= $GLOBALS['OZY_FANCY_TAB_COUNTER'] + 1;
			return null;
		}
		
		add_shortcode('ozy_vc_fancytab', 'ozy_vc_fancytab');

		vc_map( array(
			"name" => esc_attr__("Fancy Tab - Item", "vp_textdomain"),
			"base" => "ozy_vc_fancytab",
			"content_element" => true,
			"as_child" => array('only' => 'ozy_vc_fancytab_wrapper'),
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "select_an_icon",
					"heading" => esc_attr__("Icon", "vp_textdomain"),
					"param_name" => "icon",
					"value" => '',
					"admin_label" => false,
					"description" => esc_attr__("Once you select an Icon, title will not be shown on overlay.", "vp_textdomain")
				),array(
					"type" => "textarea_html",
					"class" => "",
					"heading" => esc_attr__("Content", "vp_textdomain"),
					"param_name" => "content",
					"admin_label" => false,
					"value" => ""
				)
		   )
		) );
	}

	class WPBakeryShortCode_Ozy_Vc_Fancytab_Wrapper extends WPBakeryShortCodesContainer{}
	class WPBakeryShortCode_Ozy_Vc_Fancytab extends WPBakeryShortCode{}	
	
	/**
	* News Ticker Box
	*/
	if (!function_exists('ozy_vc_newsticker_box')) {
		function ozy_vc_newsticker_box( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_newsticker_box', $atts);
			extract( shortcode_atts( array(
				  'item_count' => '20',
				  'category_name' => '',
				  'author' => '',
				  'tag' => '',
				  'order_by' => 'date',
				  'order' => 'DESC',
				  'post_status' => 'published',
				  'item_per_page' => '4',
				  'auto_play' => 'true',
				  'direction' => 'down',
				  'ticker_interval' => '2500'
				), $atts ) 
			);
			
			if(!function_exists('ozy_excerpt_max_charlength')) return '';

			$output = "";
			$args = array( 
				'tax_query' => array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array('post-format-quote', 'post-format-aside'),
						'operator' => 'NOT IN'
					)
				),
				'post_type'			=> 'post',
				'posts_per_page' 	=> esc_attr(( (int)$item_count <= 0 ? get_option("posts_per_page") : ((int)$item_count > 0 ? $item_count : 6) )),
				'tag' 				=> ( !empty($tag) ? $tag : $tag ),
				'author_name'		=> ( !empty($author) ? $author : NULL ),
				'category_name'		=> ( !empty($category_name) ? $category_name : NULL ),				
				'author'			=> $author,
				'orderby'			=> ( !empty($orderby) ? $orderby : 'date' ),
				'post_status'		=> ( !empty($post_status) ? $post_status : 'publish' ),
				'order'				=> ( !empty($order) ? $order : 'DESC' )
			);

			$loop = new WP_Query( $args );
			$counter = 0;			
			while ( $loop->have_posts() ) : $loop->the_post();
				$output .= '<li class="news-item">';
				$output .= '<strong>' . get_the_title() . '</strong>' . PHP_EOL;
				$output .= '<p>' . ozy_excerpt_max_charlength(60, true, true);
				$output .= '&nbsp;&nbsp;<a href="'. get_permalink() .'">'. esc_attr__('Read More', 'vp_textdomain') .'</a></p>';
				$output .= '</li>' . PHP_EOL;
				$counter++;
			endwhile;
			wp_reset_postdata();
			
			$output = '<div class="panel ozy-news-box-ticker-wrapper"><div class="panel-body"><ul class="ozy-news-box-ticker" data-item_per_page="'. esc_attr($item_per_page) .'" data-auto_play="'. esc_attr($auto_play) .'" data-direction="'. esc_attr($direction) .'" data-ticker_interval="'. esc_attr($ticker_interval) .'">'. $output .'</ul></div><div class="panel-footer"></div></div>';
			
			return $output;			
		}

		add_shortcode( 'ozy_vc_newsticker_box', 'ozy_vc_newsticker_box' );

		vc_map( array(
		   "name" => esc_attr__("News Ticker Box", "vp_textdomain"),
		   "base" => "ozy_vc_newsticker_box",
		   "icon" => "icon-wpb-ozy-el",
		   'category' => 'by OZY',
		   "params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Item Per Page", "vp_textdomain"),
					"param_name" => "item_per_page",
					"value" => "4",
					"admin_label" => false,
					"description" => esc_attr__("How many post will be listed on the slider?", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Auto Play", "vp_textdomain"),
					"param_name" => "auto_play",
					"value" => array("true", "false"),
					"admin_label" => false
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Direction", "vp_textdomain"),
					"param_name" => "direction",
					"value" => array("down", "up"),
					"admin_label" => false
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Ticker Interval", "vp_textdomain"),
					"param_name" => "ticker_interval",
					"value" => "2500",
					"admin_label" => false
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Post Count", "vp_textdomain"),
					"param_name" => "item_count",
					"value" => "20",
					"admin_label" => false,
					"description" => esc_attr__("How many post will be populated from the source?", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Categories", "vp_textdomain"),
					"param_name" => "category_name",
					"description" => esc_attr__("If you want to narrow output, enter category slug names here. Display posts that have this category (and any children of that category), use category slug (NOT name). Split names with ','. More information; <a href='http://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters' target='_blank'>http://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters</a>", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Tags", "vp_textdomain"),
					"param_name" => "tag",
					"description" => esc_attr__("If you want to narrow output, enter tag slug names here. Display posts that have this tag, use tag slug (NOT name). Split names with ','. More information; <a href='http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters' target='_blank'>http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters</a>", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Author", "vp_textdomain"),
					"param_name" => "author",
					"description" => esc_attr__("If you want to narrow output, enter author slug name here. Display posts that belongs to author, use 'user_nicename' (NOT name). More information; <a href='http://codex.wordpress.org/Class_Reference/WP_Query#Tag_Parameters' target='_blank'>http://codex.wordpress.org/Class_Reference/WP_Query#Tag_Parameters</a>", "vp_textdomain")
				),		
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Order by", "vp_textdomain"),
					"param_name" => "orderby",
					"value" => array(esc_attr__("Date", "vp_textdomain") => "date", esc_attr__("ID", "vp_textdomain") => "ID", esc_attr__("Author", "vp_textdomain") => "author", esc_attr__("Title", "vp_textdomain") => "title", esc_attr__("Modified", "vp_textdomain") => "modified", esc_attr__("Random", "vp_textdomain") => "rand", esc_attr__("Comment count", "vp_textdomain") => "comment_count", esc_attr__("Menu order", "vp_textdomain") => "menu_order" ),
					"description" => esc_attr__('Select how to sort retrieved posts. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.', 'js_composer')
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Order way", "vp_textdomain"),
					"param_name" => "order",
					"value" => array(esc_attr__("Descending", "vp_textdomain") => "DESC", esc_attr__("Ascending", "vp_textdomain") => "ASC" ),
					"description" => esc_attr__('Designates the ascending or descending order. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.', "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Post Status", "vp_textdomain"),
					"param_name" => "post_status",
					"value" => array("publish", "pending", "draft", "auto-draft", "future", "private", "inherit", "trash", "any"),
					"admin_label" => false,
					"description" => esc_attr__("Show posts associated with certain status.", "vp_textdomain")
				)
		   )
		) );
	}	

	/**
	* News Ticker
	*/
	if (!function_exists('ozy_vc_newsticker')) {
		function ozy_vc_newsticker( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_newsticker', $atts);
			extract( shortcode_atts( array(
				  'title' => esc_attr__('NEWS', 'vp_textdomain'),
				  'item_count' => '',
				  'category_name' => '',
				  'author' => '',
				  'tag' => '',
				  'order_by' => 'date',
				  'order' => 'DESC',
				  'post_status' => 'published'
				), $atts ) 
			);

			$output = "";
			$args = array( 
				'tax_query' => array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array('post-format-quote', 'post-format-aside'),
						'operator' => 'NOT IN'
					)
				),
				'post_type'			=> 'post',
				'posts_per_page' 	=> esc_attr(( (int)$item_count <= 0 ? get_option("posts_per_page") : ((int)$item_count > 0 ? $item_count : 6) )),
				'tag' 				=> ( !empty($tag) ? $tag : $tag ),
				'author_name'		=> ( !empty($author) ? $author : NULL ),
				'category_name'		=> ( !empty($category_name) ? $category_name : NULL ),				
				'author'			=> $author,
				'orderby'			=> ( !empty($orderby) ? $orderby : 'date' ),
				'post_status'		=> ( !empty($post_status) ? $post_status : 'publish' ),
				'order'				=> ( !empty($order) ? $order : 'DESC' )
			);

			$loop = new WP_Query( $args );
			$counter = 0;			
			$output .= '<ul>' . PHP_EOL;
			while ( $loop->have_posts() ) : $loop->the_post();
				$output .= '<li>';
				$output .= '<a href="'. get_permalink() .'" class="content-color">'. get_the_title() .'</a>' . PHP_EOL;
				$output .= '</li>' . PHP_EOL;
				$counter++;
			endwhile;
			wp_reset_postdata();
		
			$output .= '</ul>' . PHP_EOL;
			
			$output = '<div id="ozy-tickerwrapper"><strong class="heading-color">'. $title .'</strong><div class="ozy-ticker">' . $output . '</div>';
			$output .= '<div class="pagination">';
			$active_slide = 'active';
			for($i=0;$i<=($counter-1);$i++) {
				$output .= '<a href="#news-'. $i .'" class="'. $active_slide .'" data-slide="'. $i .'"><span></span></a>';
				$active_slide = '';
			}
			$output .= '</div>';
			$output .= '</div>';
			
			return $output;
		}

		add_shortcode( 'ozy_vc_newsticker', 'ozy_vc_newsticker' );

		vc_map( array(
		   "name" => esc_attr__("News Ticker", "vp_textdomain"),
		   "base" => "ozy_vc_newsticker",
		   "icon" => "icon-wpb-ozy-el",
		   'category' => 'by OZY',
		   "params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"value" => esc_attr__("NEWS", "vp_textdomain"),
					"admin_label" => true,
					"description" => esc_attr__("Ticker Title", "vp_textdomain")
				),   
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Post Count", "vp_textdomain"),
					"param_name" => "item_count",
					"value" => "6",
					"admin_label" => false,
					"description" => esc_attr__("How many post will be listed on one page?", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Categories", "vp_textdomain"),
					"param_name" => "category_name",
					"description" => esc_attr__("If you want to narrow output, enter category slug names here. Display posts that have this category (and any children of that category), use category slug (NOT name). Split names with ','. More information; <a href='http://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters' target='_blank'>http://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters</a>", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Tags", "vp_textdomain"),
					"param_name" => "tag",
					"description" => esc_attr__("If you want to narrow output, enter tag slug names here. Display posts that have this tag, use tag slug (NOT name). Split names with ','. More information; <a href='http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters' target='_blank'>http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters</a>", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Author", "vp_textdomain"),
					"param_name" => "author",
					"description" => esc_attr__("If you want to narrow output, enter author slug name here. Display posts that belongs to author, use 'user_nicename' (NOT name). More information; <a href='http://codex.wordpress.org/Class_Reference/WP_Query#Tag_Parameters' target='_blank'>http://codex.wordpress.org/Class_Reference/WP_Query#Tag_Parameters</a>", "vp_textdomain")
				),		
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Order by", "vp_textdomain"),
					"param_name" => "orderby",
					"value" => array(esc_attr__("Date", "vp_textdomain") => "date", esc_attr__("ID", "vp_textdomain") => "ID", esc_attr__("Author", "vp_textdomain") => "author", esc_attr__("Title", "vp_textdomain") => "title", esc_attr__("Modified", "vp_textdomain") => "modified", esc_attr__("Random", "vp_textdomain") => "rand", esc_attr__("Comment count", "vp_textdomain") => "comment_count", esc_attr__("Menu order", "vp_textdomain") => "menu_order" ),
					"description" => esc_attr__('Select how to sort retrieved posts. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.', 'js_composer')
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Order way", "vp_textdomain"),
					"param_name" => "order",
					"value" => array(esc_attr__("Descending", "vp_textdomain") => "DESC", esc_attr__("Ascending", "vp_textdomain") => "ASC" ),
					"description" => esc_attr__('Designates the ascending or descending order. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.', "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Post Status", "vp_textdomain"),
					"param_name" => "post_status",
					"value" => array("publish", "pending", "draft", "auto-draft", "future", "private", "inherit", "trash", "any"),
					"admin_label" => false,
					"description" => esc_attr__("Show posts associated with certain status.", "vp_textdomain")
				)
		   )
		) );
	}
	
	/**
	* Blog Latest Headers
	*/
	if (!function_exists('ozy_vc_blog_latest_posts')) {
		function ozy_vc_blog_latest_posts( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_blog_latest_posts', $atts);
			extract( shortcode_atts( array(
				  'title' => '',
				  'item_count' => '',
				  'category_name' => '',
				  'author' => '',
				  'tag' => '',
				  'order_by' => 'date',
				  'order' => 'DESC',
				  'post_status' => 'published'
				), $atts ) 
			);
			
			global $ozyHelper;		
			
			if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;

			$output = "";
			$args = array( 
				'tax_query' => array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array('post-format-quote', 'post-format-aside'),
						'operator' => 'NOT IN'
					)
				),
				'post_type'			=> 'post',
				'posts_per_page' 	=> esc_attr(( (int)$item_count <= 0 ? get_option("posts_per_page") : ((int)$item_count > 0 ? $item_count : 6) )),
				'tag' 				=> ( !empty($tag) ? $tag : $tag ),
				'author_name'		=> ( !empty($author) ? $author : NULL ),
				'category_name'		=> ( !empty($category_name) ? $category_name : NULL ),
				'author'			=> $author,
				'orderby'			=> ( !empty($orderby) ? $orderby : 'date' ),
				'post_status'		=> ( !empty($post_status) ? $post_status : 'publish' ),
				'order'				=> ( !empty($order) ? $order : 'DESC' )
			);

			$loop = new WP_Query( $args );
			$counter = 0;			
			$output .= '<ul class="blog-listing-latest">' . PHP_EOL;
			while ( $loop->have_posts() ) : $loop->the_post();
				$output .= '<li>';
				$output .= '<div class="box-date"><span class="d">' . get_the_date('d') .'</span><span class="m">' . get_the_date('M') .'</span></div>' . PHP_EOL;
				$output .= '<div class="box-wrapper">' . PHP_EOL;
				$output .= '<p>' . get_the_title() . '</p>' . PHP_EOL;
				$output .= '<a href="' . get_permalink() . '">' . esc_attr__('Read More &rarr;', 'vp_textdomain') . '</a>' . PHP_EOL;
				$output .= '</div>' . PHP_EOL;
				$output .= '</li>' . PHP_EOL;			
			endwhile;
			wp_reset_postdata();
		
			$output .= '</ul>' . PHP_EOL;
			
			$style = 'ul.blog-listing-latest>li div.box-date>span.d{color:'. esc_attr($ozyHelper->rgba2rgb(ozy_get_option('form_button_font_color'))) .' !important;background-color:'. esc_attr(ozy_get_option('form_button_background_color')) .';}';
			$style.= 'ul.blog-listing-latest>li div.box-date>span.m{color:'. esc_attr($ozyHelper->rgba2rgb(ozy_get_option('form_button_font_color_hover'))) .' !important;background-color:'. esc_attr(ozy_get_option('form_button_background_color_hover')) .';}';
			$ozyHelper->set_footer_style($style);
			
			return '<div class="wpb_wrapper">' . ( trim($title) ? '<h2 class="wpb_heading">' . esc_attr($title) . '</h2>' : '' ) . $output . '</div>';
		}

		add_shortcode( 'ozy_vc_blog_latest_posts', 'ozy_vc_blog_latest_posts' );

		vc_map( array(
		   "name" => esc_attr__("Latest Blog Posts", "vp_textdomain"),
		   "base" => "ozy_vc_blog_latest_posts",
		   "icon" => "icon-wpb-ozy-el",
		   'category' => 'by OZY',
		   "params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"value" => "",
					"admin_label" => true,
					"description" => esc_attr__("Component title", "vp_textdomain")
				),   
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Post Count", "vp_textdomain"),
					"param_name" => "item_count",
					"value" => "6",
					"admin_label" => false,
					"description" => esc_attr__("How many post will be listed on one page?", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Categories", "vp_textdomain"),
					"param_name" => "category_name",
					"description" => esc_attr__("If you want to narrow output, enter category slug names here. Display posts that have this category (and any children of that category), use category slug (NOT name). Split names with ','. More information; <a href='http://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters' target='_blank'>http://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters</a>", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Tags", "vp_textdomain"),
					"param_name" => "tag",
					"description" => esc_attr__("If you want to narrow output, enter tag slug names here. Display posts that have this tag, use tag slug (NOT name). Split names with ','. More information; <a href='http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters' target='_blank'>http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters</a>", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Author", "vp_textdomain"),
					"param_name" => "author",
					"description" => esc_attr__("If you want to narrow output, enter author slug name here. Display posts that belongs to author, use 'user_nicename' (NOT name). More information; <a href='http://codex.wordpress.org/Class_Reference/WP_Query#Tag_Parameters' target='_blank'>http://codex.wordpress.org/Class_Reference/WP_Query#Tag_Parameters</a>", "vp_textdomain")
				),		
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Order by", "vp_textdomain"),
					"param_name" => "orderby",
					"value" => array(esc_attr__("Date", "vp_textdomain") => "date", esc_attr__("ID", "vp_textdomain") => "ID", esc_attr__("Author", "vp_textdomain") => "author", esc_attr__("Title", "vp_textdomain") => "title", esc_attr__("Modified", "vp_textdomain") => "modified", esc_attr__("Random", "vp_textdomain") => "rand", esc_attr__("Comment count", "vp_textdomain") => "comment_count", esc_attr__("Menu order", "vp_textdomain") => "menu_order" ),
					"description" => esc_attr__('Select how to sort retrieved posts. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.', 'js_composer')
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Order way", "vp_textdomain"),
					"param_name" => "order",
					"value" => array(esc_attr__("Descending", "vp_textdomain") => "DESC", esc_attr__("Ascending", "vp_textdomain") => "ASC" ),
					"description" => esc_attr__('Designates the ascending or descending order. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.', "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Post Status", "vp_textdomain"),
					"param_name" => "post_status",
					"value" => array("publish", "pending", "draft", "auto-draft", "future", "private", "inherit", "trash", "any"),
					"admin_label" => false,
					"description" => esc_attr__("Show posts associated with certain status.", "vp_textdomain")
				)
		   )
		) );	
	}
	
	/**
	* Timeline
	*/
	if (!function_exists('ozy_vc_timelinewrapper')) {
		function ozy_vc_timelinewrapper( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_timelinewrapper', $atts);
			extract(shortcode_atts(array(
				'title' => '',
				'bg_color' => '#ffffff'
			), $atts));
			
			$element_id = 'ozy-timeline-wrapper_' . rand(100,10000); 
			
			$output = '';
			$output.= ($title ? '<div id="'. $element_id .'" class="ozy-timeline-wrapper"><h4 class="timeline-caption"><span>'. esc_attr($title) .'</span></h4>' : '');
			$output.= '<ul class="timeline">'. do_shortcode($content) .'</ul>';
			$output.= ($title ? '</div>' : '');
			
			if($bg_color) {
				global $ozyHelper;
				if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;
				$ozyHelper->set_footer_style('#'. $element_id . ' .timeline-panel{background-color:'. esc_attr($bg_color) .';}#'. $element_id . ' .timeline-panel:after{border-left-color:'. esc_attr($bg_color) .';}');
			}
			
			return $output;
		}
		
		add_shortcode('ozy_vc_timelinewrapper', 'ozy_vc_timelinewrapper');
		
		vc_map( array(
			"name" => esc_attr__("Timeline Wrapper", "vp_textdomain"),
			"base" => "ozy_vc_timelinewrapper",
			"as_parent" => array('only' => 'ozy_vc_timeline'),
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"value" => "",
					"decription" => esc_attr__("Only place holder", "vp_textdomain"),
					"admin_label" => true
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Item Background / Arrow Color", "vp_textdomain"),
					"param_name" => "bg_color",
					"admin_label" => true,
					"value" => "#ffffff"
				)
		   ),
		   "js_view" => 'VcColumnView'
		) );
	}

	class WPBakeryShortCode_Ozy_Vc_Timelinewrapper extends WPBakeryShortCodesContainer{}

	if (!function_exists('ozy_vc_timeline')) {
		function ozy_vc_timeline( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_timeline', $atts);
			extract(shortcode_atts(array(
				'position' => 'left',
				'title' => '',
				'excerpt' => '',
				'icon' => '',
				'bg_color' => '',
				'text_color' => '',
				'icon_bg_color' => '',
				'icon_color' => '',
				'css_animation' => ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}
			
			if($content) $excerpt = $content; //this line covers new Content field after 1.4 version
			
			$css_text_color = ($text_color ? ' style="color:'. esc_attr($text_color) .'"':'');
			
			$output = '
			 <li class="'. ($position === 'right' ? 'timeline-inverted':'') . $css_animation .'">
			  <div class="timeline-badge" style="'. ('color:'. esc_attr($icon_color) . ';background-color:' . esc_attr($icon_bg_color)) .'"><i class="'. esc_attr($icon) .'"></i></div>
			  <div class="timeline-panel">
				<div class="timeline-heading">
				  <h4 class="timeline-title"'. $css_text_color .'>'. esc_attr($title) .'</h4>
				</div>
				<div class="timeline-body"'. $css_text_color .'>'. do_shortcode($excerpt) .'</div>
			  </div>
			</li>';

			return $output;
		}
		
		add_shortcode( 'ozy_vc_timeline', 'ozy_vc_timeline' );
		
		vc_map( array(
			"name" => esc_attr__("Timeline Item", "vp_textdomain"),
			"base" => "ozy_vc_timeline",
			"content_element" => true,
			"as_child" => array('only' => 'ozy_vc_timelinewrapper'),
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Position", "vp_textdomain"),
					"param_name" => "position",
					"admin_label" => true,
					"value" => array("left", "right")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textarea",
					"class" => "",
					"heading" => esc_attr__("Not in use anymore, please use Content field", "vp_textdomain"),
					"param_name" => "excerpt",
					"admin_label" => false,
					"value" => "",
					"description" => __('Please do not use this field, use Content field instead.', 'vp_textdomain')
				),array(
					"type" => "textarea_html",
					"class" => "",
					"heading" => esc_attr__("Content", "vp_textdomain"),
					"param_name" => "content",
					"admin_label" => false,
					"value" => ""
				),array(
					"type" => "select_an_icon",
					"heading" => esc_attr__("Icon", "vp_textdomain"),
					"param_name" => "icon",
					"value" => '',
					"admin_label" => false,
					"description" => esc_attr__("Once you select an Icon, title will not be shown on overlay.", "vp_textdomain")
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Text Color", "vp_textdomain"),
					"param_name" => "text_color",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Icon Background Color", "vp_textdomain"),
					"param_name" => "icon_bg_color",
					"admin_label" => true,
					"value" => "#222222"
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Icon Color", "vp_textdomain"),
					"param_name" => "icon_color",
					"admin_label" => true,
					"value" => "#ffffff"
				),$add_css_animation
		   )
		) );	
	}

	class WPBakeryShortCode_Ozy_Vc_Timeline extends WPBakeryShortCode{}	
	
	/**
	* Interactive Horizontal Boxes
	*/
	if (!function_exists('ozy_vc_iaboxes')) {
		function ozy_vc_iaboxes( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_iaboxes', $atts);
			extract(shortcode_atts(array(
				'title' => ''
			), $atts));
			
			return '<div class="ozy-iabox-wrapper">'. do_shortcode($content) .'</div>';
		}
		
		add_shortcode('ozy_vc_iaboxes', 'ozy_vc_iaboxes');
		
		vc_map( array(
			"name" => esc_attr__("Interactive Horizontal Boxes", "vp_textdomain"),
			"base" => "ozy_vc_iaboxes",
			"as_parent" => array('only' => 'ozy_vc_iabox,ozy_vc_flipbox'),
			"content_element" => true,
			"show_settings_on_create" => false,	
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "width",
					"value" => "Title",
					"decription" => esc_attr__("Only place holder", "vp_textdomain"),
					"admin_label" => true
				)		
		   ),
		   "js_view" => 'VcColumnView'
		) );
	}

	class WPBakeryShortCode_Ozy_Vc_Iaboxes extends WPBakeryShortCodesContainer{}

	if (!function_exists('ozy_vc_iabox')) {
		function ozy_vc_iabox( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_iabox', $atts);
			extract(shortcode_atts(array(
				'box_size' => '6',
				'title_size' => 'h2',
				'bg_color' => '#222222',
				'title_color' => '#ffffff',
				'excerpt_color' => '#ffffff',
				'use_hover' => '0',
				'bg_hover_color' => '',
				'title_hover_color' => '#ffffff',
				'excerpt_hover_color' => '#ffffff',
				'title_hover' => '',
				'excerpt_hover' => '',			
				'bg_image' => '',
				'title' => '',
				'excerpt' => '',
				'min_height' => '',
				'bg_video' => '0',
				'bg_video_mp4' => '',
				'bg_video_webm' => '',
				'bg_video_ogv' => '',
				'icon' => '',
				'link' => '',
				'link_target' => '_self'
			), $atts));
			
			$box_size = 'vc_col-sm-' . $box_size;
			
			$bg_image = wp_get_attachment_image_src($bg_image, 'full');
			$style = ' style="';
			if(isset($bg_image[0])) {
				$style.= 'background-image:url('. $bg_image[0] .')';
			}
			if($bg_color) {
				$style.= ';background-color:'. esc_attr($bg_color);
			}
			if((int)$min_height>0) {
				$style.= ';min-height:'. $min_height .'px;';
			}
			$style.= '"';
			
			$output = '<div class="ozy-iabox '. esc_attr($box_size) .'" '. $style .'>';
			
			if($bg_video == 'on') { 
				$output .= '<video preload="auto" loop="true" autoplay="true" src="'.esc_url($bg_video_mp4).'">';
				if($bg_video_ogv) $output .='<source type="video/ogv" src="'. esc_url($bg_video_ogv) .'">';
				if($bg_video_mp4) $output .='<source type="video/mp4" src="'. esc_url($bg_video_mp4) .'">';	
				if($bg_video_webm) $output .='<source type="video/webm" src="'. esc_url($bg_video_webm) .'">';
				$output .= '</video>';
			}
			
			$title_hover 	= !$title_hover ? $title : $title_hover;
			$excerpt_hover 	= !$excerpt_hover ? $excerpt : $excerpt_hover;		
			
			$output.= esc_attr($title) ? '<'. esc_attr($title_size) .' style="color:'. esc_attr($title_color) .';" class="heading">'. esc_attr($title) .'</'. esc_attr($title_size) .'>' : '';
			$output.= esc_attr($excerpt) ? '<div style="color:'. esc_attr($excerpt_color) .';font-size:120%;line-height:120%">'. nl2br($excerpt) .'</div>' : '';
			$output.= esc_attr($icon) ? '<i class="'. esc_attr($icon) .'" style="color:'. esc_attr($title_color) .';"></i>' : '';
			if(esc_attr($use_hover) === 'on') {
				$output.= '<a href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'" style="background-color:'. esc_attr($bg_hover_color) .'">';
				$output.= esc_attr($title) ? '<'. esc_attr($title_size) .' style="color:'. esc_attr($title_hover_color) .';" class="heading">'. esc_attr($title_hover) .'</'. esc_attr($title_size) .'>' : '';
				$output.= esc_attr($excerpt) ? '<div style="color:'. esc_attr($excerpt_hover_color) .';font-size:120%;line-height:120%">'. nl2br($excerpt_hover) .'</div>' : '';
				$output.= esc_attr($icon) ? '<i class="'. esc_attr($icon) .'" style="color:'. esc_attr($title_hover_color) .';"></i>' : '';
				$output.= '</a>';
			}else{
				$output.= '<a href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'">';
				$output.= '&nbsp;';
				$output.= '</a>';
			}
			$output.= '</div>';
			
			return $output;
		}
		
		add_shortcode( 'ozy_vc_iabox', 'ozy_vc_iabox' );
		
		vc_map( array(
			"name" => esc_attr__("Interactive Box", "vp_textdomain"),
			"base" => "ozy_vc_iabox",
			"content_element" => true,
			"as_child" => array('only' => 'ozy_vc_iaboxes'),
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Size", "vp_textdomain"),
					"param_name" => "box_size",
					"value" => array("1/2" => "6", "2/3" => "8", "1/3" => "4", "1/4" => "3"),
					"admin_label" => true
				),array(
					"type" => 'dropdown',
					"heading" => esc_attr__("Title Size", "vp_textdomain"),
					"param_name" => "title_size",
					"value" => array("h2", "h1", "h3", "h4", "h5", "h6"),
				),array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Background Image", "vp_textdomain"),
					"param_name" => "bg_image",
					"admin_label" => false,
					"value" => ""
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Background Color", "vp_textdomain"),
					"param_name" => "bg_color",
					"admin_label" => true,
					"value" => "#222222"
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textarea",
					"class" => "",
					"heading" => esc_attr__("Excerpt", "vp_textdomain"),
					"param_name" => "excerpt",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Title Color", "vp_textdomain"),
					"param_name" => "title_color",
					"admin_label" => true,
					"value" => "#ffffff"
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Excerpt Color", "vp_textdomain"),
					"param_name" => "excerpt_color",
					"admin_label" => true,
					"value" => "#ffffff"
				),array(
					"type" => 'dropdown',
					"heading" => esc_attr__("Hover", "vp_textdomain"),
					"param_name" => "use_hover",
					"description" => esc_attr__("If selected, you can set background, title and excerpt color for hover mode.", "vp_textdomain"),
					"value" => array("off", "on"),
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title_hover",
					"admin_label" => false,
					"value" => "",
					"dependency" => Array('element' => "use_hover", 'value' => 'on')
				),array(
					"type" => "textarea",
					"class" => "",
					"heading" => esc_attr__("Excerpt", "vp_textdomain"),
					"param_name" => "excerpt_hover",
					"admin_label" => false,
					"value" => "",
					"dependency" => Array('element' => "use_hover", 'value' => 'on')
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Hover Background Color", "vp_textdomain"),
					"param_name" => "bg_hover_color",
					"admin_label" => true,
					"value" => "#222222",
					"dependency" => Array('element' => "use_hover", 'value' => 'on')
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Hover Title Color", "vp_textdomain"),
					"param_name" => "title_hover_color",
					"admin_label" => true,
					"value" => "#ffffff",
					"dependency" => Array('element' => "use_hover", 'value' => 'on')
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Hover Excerpt Color", "vp_textdomain"),
					"param_name" => "excerpt_hover_color",
					"admin_label" => true,
					"value" => "#ffffff",
					"dependency" => Array('element' => "use_hover", 'value' => 'on')
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("Minimum Height", "vp_textdomain"),
					"param_name" => "min_height",
					"description" => esc_attr__("Set minimum height of your row in pixels. Not required", "vp_textdomain")
				),array(
					"type" => 'dropdown',
					"heading" => esc_attr__("Video Background", "vp_textdomain"),
					"param_name" => "bg_video",
					"description" => esc_attr__("If selected, you can set background of your box as video.", "vp_textdomain"),
					"value" => array("off", "on"),
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("MP4 File", "vp_textdomain"),
					"param_name" => "bg_video_mp4",
					"description" => esc_attr__("MP4 Video file path", "vp_textdomain"),
					"dependency" => Array('element' => "bg_video", 'value' => 'on')
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("WEBM File", "vp_textdomain"),
					"param_name" => "bg_video_webm",
					"description" => esc_attr__("WEBM Video file path", "vp_textdomain"),
					"dependency" => Array('element' => "bg_video", 'value' => 'on')	  
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("OGV File", "vp_textdomain"),
					"param_name" => "bg_video_ogv",
					"description" => esc_attr__("OGV Video file path", "vp_textdomain"),
					"dependency" => Array('element' => "bg_video", 'value' => 'on')
				),array(
					"type" => "select_an_icon",
					"heading" => esc_attr__("Icon", "vp_textdomain"),
					"param_name" => "icon",
					"value" => '',
					"admin_label" => false,
					"description" => esc_attr__("Once you select an Icon, title will not be shown on overlay.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				)
		   )
		) );	
	}

	class WPBakeryShortCode_Ozy_Vc_Iabox extends WPBakeryShortCode{}
	
	/**
	* Spinner List
	*/
	if (!function_exists('ozy_vc_spinnerlist')) {
		function ozy_vc_spinnerlist( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_spinnerlist', $atts);
			extract(shortcode_atts(array(
				'title' => ''
			), $atts));
			
			$output = '<div class="ozy-spinner-list">';
			$output .= '<ul>'. do_shortcode($content) .'</div>';
			$output .= '</div>';
			
			return $output;
		}
		
		add_shortcode('ozy_vc_spinnerlist', 'ozy_vc_spinnerlist');
		
		vc_map( array(
			"name" => esc_attr__("Spinner List", "vp_textdomain"),
			"base" => "ozy_vc_spinnerlist",
			"as_parent" => array('only' => 'ozy_vc_spinnerlist_item'),
			"content_element" => true,
			"show_settings_on_create" => false,	
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "width",
					"value" => "Title",
					"decription" => esc_attr__("Only place holder", "vp_textdomain"),
					"admin_label" => true
				)		
		   ),
		   "js_view" => 'VcColumnView'
		) );
	}

	class WPBakeryShortCode_Ozy_Vc_Spinnerlist extends WPBakeryShortCodesContainer{}

	if (!function_exists('ozy_vc_spinnerlist_item')) {
		function ozy_vc_spinnerlist_item( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_spinnerlist_item', $atts);
			extract(shortcode_atts(array(
				'bg_image' => '',
				'bg_color' => '#000000',
				'fn_color' => '#ffffff',
				'title' => '',
				'sub_title' => '',
				'link' => '',
				'link_target' => '_self'
			), $atts));
			
			$rand_classname = 'spinner-' . rand(0,10000);
			
			$style = '';
			
			if($bg_color && !$bg_image)
				$style.='background-color:'. esc_attr($bg_color).';';

			if($bg_image) {
				$bg_image = wp_get_attachment_image_src($bg_image, 'full');
				if(isset($bg_image[0])) {
					$style.= 'background:'. esc_attr($bg_color) .' url('. esc_url($bg_image[0]) .') no-repeat center center';
				}
			}
				
			$output = '<li class="'. $rand_classname .'">';
			$output .= '<div><a href="'. esc_url($link) .'" target="'. esc_attr($link_target) .'">'. esc_attr($title) . '<span>'. esc_attr($sub_title) .'</span></a></div>';
			$output .= '</li>';
			
			global $ozyHelper;
			if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;
			$ozyHelper->set_footer_style('.'. $rand_classname .'{'. esc_attr($style) .'}');
			$ozyHelper->set_footer_style('.'. $rand_classname .'>div>a{color:'. esc_attr($fn_color) .' !important}');
			
			return $output;
		}
		
		add_shortcode( 'ozy_vc_spinnerlist_item', 'ozy_vc_spinnerlist_item' );
		
		vc_map( array(
			"name" => esc_attr__("Spinner List Item", "vp_textdomain"),
			"base" => "ozy_vc_spinnerlist_item",
			"content_element" => true,
			"as_child" => array('only' => 'ozy_vc_spinnerlist'),
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Background Image", "vp_textdomain"),
					"param_name" => "bg_image",
					"admin_label" => false,
					"value" => ""
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Background Color", "vp_textdomain"),
					"param_name" => "bg_color",
					"admin_label" => true,
					"value" => "#000000"
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Foreground Color", "vp_textdomain"),
					"param_name" => "fn_color",
					"admin_label" => true,
					"value" => "#ffffff"
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Sub Title", "vp_textdomain"),
					"param_name" => "sub_title",
					"admin_label" => true,
					"value" => esc_attr__("CLICK HERE FOR MORE INFO &gt;", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				)
		   )
		) );	
	}

	class WPBakeryShortCode_Ozy_Vc_Spinnerlist_item extends WPBakeryShortCode{}	
	
	/**
	* Multi Location Pretty Map
	*/
	if (!function_exists('ozy_vc_prettymap_multi')) {
		function ozy_vc_prettymap_multi( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_prettymap_multi', $atts);
			extract(shortcode_atts(array(
				'zoom'			=> '13',
				'hue'			=> '#ff0000',
				'saturation'	=> '-30',
				'lightness' 	=> '0',
				'height'		=> '350px',
				'api_key'		=> ''
			), $atts));
			
			$rand_id = 'map_data_' . rand(1, 10000);
			$GLOBALS['OZY_CUSTOM_MAP'] = array();
			
			//wp_enqueue_script('googlemaps', '//maps.google.com/maps/api/js?sensor=false&language=en', array('jquery'), null, true );
			wp_enqueue_script('googlemaps', '//maps.google.com/maps/api/js?'. ($api_key?'key=' . $api_key .'&':'') .'sensor=false&language=en', array('jquery'), null, true );
			
			do_shortcode($content);
			
			wp_localize_script( 'buildme', 'ozyMapData', array($rand_id =>  json_encode($GLOBALS['OZY_CUSTOM_MAP'])) );
			
			unset($GLOBALS['OZY_CUSTOM_MAP']);
			
			return '<div class="ozy-multi-google-map" 
			data-path="'. esc_attr($rand_id) .'" 
			data-zoom="'. esc_attr($zoom) .'" 
			data-hue="'. esc_attr($hue) .'" 
			data-saturation="'. esc_attr($saturation) .'" 
			data-lightness="'. esc_attr($lightness) .'" style="height:'. esc_attr($height) .'"></div>';
		}
		
		add_shortcode('ozy_vc_prettymap_multi', 'ozy_vc_prettymap_multi');
		
		vc_map( array(
			"name" => esc_attr__("Multi Location Google Map", "vp_textdomain"),
			"base" => "ozy_vc_prettymap_multi",
			"as_parent" => array('only' => 'ozy_vc_prettymap_multi_location'),			
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Google Maps API Key", "vp_textdomain"),
					"param_name" => "api_key",
					"admin_label" => false,
					"value" => "",
					'description' => wp_kses(__('<a href="http://freevision.me/google-maps-key/" target="_blank">Learn how to get an API Key.</a>', 'vp_textdomain'),array('a' => array('href' => array(), 'target' => array()))),					
				),			
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Height", "vp_textdomain"),
					"param_name" => "height",
					"admin_label" => true,
					"value" => "350px"
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Zoom Level", "vp_textdomain"),
					"param_name" => "zoom",
					"admin_label" => true,
					"value" => "13"
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Hue Color", "vp_textdomain"),
					"param_name" => "hue",
					"admin_label" => false,
					"value" => "#FF0000"
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Saturation", "vp_textdomain"),
					"param_name" => "saturation",
					"admin_label" => true,
					"value" => "-30"
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Lightness", "vp_textdomain"),
					"param_name" => "lightness",
					"admin_label" => true,
					"value" => "0"
				)		
		   ),
		   "js_view" => 'VcColumnView'		   
		) );
	}
	
	if (!function_exists('ozy_vc_prettymap_multi_location')) {
		function ozy_vc_prettymap_multi_location( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_prettymap_multi_location', $atts);
			extract(shortcode_atts(array(
				'caption'		=> '',
				'address'		=> '',
				'custom_icon'	=> ''
			), $atts));

			$custom_icon = wp_get_attachment_image_src($custom_icon, 'full');
			if(isset($custom_icon[0])) {
				$custom_icon = $custom_icon[0];
			}else{
				$custom_icon = null;
			}
			
			$GLOBALS['OZY_CUSTOM_MAP'][] = array(esc_attr($caption), esc_attr($address), $custom_icon);
			
			return null;
		}
		
		add_shortcode('ozy_vc_prettymap_multi_location', 'ozy_vc_prettymap_multi_location');

		vc_map( array(
			"name" => esc_attr__("Location", "vp_textdomain"),
			"base" => "ozy_vc_prettymap_multi_location",
			"content_element" => true,
			"as_child" => array('only' => 'ozy_vc_prettymap_multi'),
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Info Box Caption", "vp_textdomain"),
					"param_name" => "caption",
					"admin_label" => true,
					"value" => esc_attr__("Head Quarter", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Address", "vp_textdomain"),
					"param_name" => "address",
					"admin_label" => true,
					"value" => esc_attr__("Melbourne, Australia", "vp_textdomain")
				),
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Custom Icon", "vp_textdomain"),
					"param_name" => "custom_icon",
					"description" => esc_attr__("You can select a custom icon for your pin on the map", "vp_textdomain"),
					"admin_label" => false,
					"value" => ""
				)				
		   )
		) );
	}

	class WPBakeryShortCode_Ozy_Vc_Prettymap_Multi extends WPBakeryShortCodesContainer{}
	class WPBakeryShortCode_Ozy_Vc_Prettymap_Multi_Location extends WPBakeryShortCode{}			
	
	/**
	* Pretty Map
	*/
	if (!function_exists('ozy_vc_prettymap')) {
		function ozy_vc_prettymap( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_prettymap', $atts);
			extract(shortcode_atts(array(
				'address'		=> '',
				'zoom'			=> '13',
				'custom_icon'	=> '',
				'hue'			=> '#ff0000',
				'saturation'	=> '-30',
				'lightness' 	=> '0',
				'height'		=> '350px',
				'extra_class_name' => '',
				'api_key'		=> ''
			), $atts));
			
			$custom_icon = wp_get_attachment_image_src($custom_icon, 'full');
			if(isset($custom_icon[0])) {
				$custom_icon = $custom_icon[0];
			}
			
			//wp_enqueue_script('googlemaps', '//maps.google.com/maps/api/js?sensor=false&language=en', array('jquery'), null, true );
			wp_enqueue_script('googlemaps', '//maps.google.com/maps/api/js?'. ($api_key?'key=' . $api_key .'&':'') .'sensor=false&language=en', array('jquery'), null, true );
			
			return '<div class="ozy-google-map '. esc_attr($extra_class_name) .'" 
			data-address="'. esc_attr($address) .'" 
			data-zoom="'. esc_attr($zoom) .'" 
			data-hue="'. esc_attr($hue) .'" 
			data-saturation="'. esc_attr($saturation) .'" 
			data-lightness="'. esc_attr($lightness) .'" 
			data-icon="'. esc_url($custom_icon) .'" style="height:'. esc_attr($height) .'"></div>';
		}
		
		add_shortcode('ozy_vc_prettymap', 'ozy_vc_prettymap');		
		
		vc_map( array(
			"name" => esc_attr__("Custom Google Map", "vp_textdomain"),
			"base" => "ozy_vc_prettymap",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Google Maps API Key", "vp_textdomain"),
					"param_name" => "api_key",
					"admin_label" => false,
					"value" => "",
					'description' => wp_kses(__('<a href="http://freevision.me/google-maps-key/" target="_blank">Learn how to get an API Key.</a>', 'vp_textdomain'),array('a' => array('href' => array(), 'target' => array()))),					
				),			
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Height", "vp_textdomain"),
					"param_name" => "height",
					"admin_label" => true,
					"value" => "350px"
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Address", "vp_textdomain"),
					"param_name" => "address",
					"admin_label" => true,
					"value" => esc_attr__("Melbourne, Australia", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Zoom Level", "vp_textdomain"),
					"param_name" => "zoom",
					"admin_label" => true,
					"value" => "13"
				),			
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Custom Icon", "vp_textdomain"),
					"param_name" => "custom_icon",
					"description" => esc_attr__("You can select a custom icon for your pin on the map", "vp_textdomain"),
					"admin_label" => false,
					"value" => ""
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Hue Color", "vp_textdomain"),
					"param_name" => "hue",
					"admin_label" => false,
					"value" => "#FF0000"
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Saturation", "vp_textdomain"),
					"param_name" => "saturation",
					"admin_label" => true,
					"value" => "-30"
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Lightness", "vp_textdomain"),
					"param_name" => "lightness",
					"admin_label" => true,
					"value" => "0"
				),
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "extra_class_name",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)				
		   )
		) );
	}

	/**
	* Simple Info Box
	*/
	if (!function_exists('ozy_vc_simpleinfobox')) {
		function ozy_vc_simpleinfobox( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_simpleinfobox', $atts);
			extract(shortcode_atts(array(
				'image'			=> '',
				'caption'		=> '',
				'title'			=> '',
				'excerpt'		=> '',
				'fn_color'		=> '#ffffff',
				'bg_color'		=> '#000000',
				'link_caption'	=> 'LEARN MORE',
				'link'			=> '',
				'link_target'	=> '_self',
				'extra_css'		=> '',
				'css_animation' => ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		
			
			$rand_id = "simple-info-box-" . rand(1,10000);
			
			$output = '<div class="ozy-simlple-info-box" id="'. $rand_id .'">';

			$image = wp_get_attachment_image_src($image, 'full');
			if(isset($image[0])) {
				$output .= '<img src="'. esc_url($image[0]) .'" alt="' . esc_attr($caption) . '"/>';
			}
			
			$output .= '<section>';
			$output .= '<h5>'. esc_attr($caption) .'</h5>';
			$output .= '<h2>'. esc_attr($title) .'</h2>';
			if($excerpt) $output .= '<p>'. $excerpt .'</p>';
			$output .= '<a href="'. esc_url($link) .'" target="'. esc_attr($link_target) .'">'. esc_attr($link_caption) .'</a>' . PHP_EOL;
			$output .= '</section>';
				
			$output .= PHP_EOL .'</div>';
			
			global $ozyHelper;
			if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;
			$ozyHelper->set_footer_style("#$rand_id>section>a,#$rand_id h2,#$rand_id h5,#$rand_id {color:". esc_attr($fn_color) ." !important;}");
			$ozyHelper->set_footer_style("#$rand_id>section>a{border-color:". esc_attr($fn_color) ."}");
			
			return $output;
		}
		
		add_shortcode('ozy_vc_simpleinfobox', 'ozy_vc_simpleinfobox');
		
		vc_map( array(
			"name" => esc_attr__("Simple Info Box", "vp_textdomain"),
			"base" => "ozy_vc_simpleinfobox",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Image", "vp_textdomain"),
					"param_name" => "image",
					"admin_label" => false,
					"value" => ""
				),		
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Caption", "vp_textdomain"),
					"param_name" => "caption",
					"admin_label" => true,
					"value" => esc_attr__("Caption Over Title", "vp_textdomain")
				),				
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => esc_attr__("Enter Title Here", "vp_textdomain")
				),
				array(
					"type" => "textarea",
					"class" => "",
					"heading" => esc_attr__("Excerpt", "vp_textdomain"),
					"param_name" => "excerpt",
					"admin_label" => true,
					"value" => ""
				),				
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Foreground Color", "vp_textdomain"),
					"param_name" => "fn_color",
					"admin_label" => false,
					"value" => "#ffffff"
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Background Color", "vp_textdomain"),
					"param_name" => "bg_color",
					"admin_label" => false,
					"value" => "#000000"
				),				
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link Caption", "vp_textdomain"),
					"param_name" => "link_caption",
					"value" => esc_attr__("LEARN MORE", "vp_textdomain"),
					"admin_label" => true
				),				
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				),	
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   )
		) );
	}	
	
	/**
	* Image Box With Caption
	*/
	if (!function_exists('ozy_vc_imageboxwithcaption')) {
		function ozy_vc_imageboxwithcaption( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_imageboxwithcaption', $atts);
			extract(shortcode_atts(array(
				'image'			=> '',
				'caption'		=> '',
				'icon'			=> '',
				'fn_color'		=> '#ffffff',
				'bg_color'		=> '#000000',
				'tag' 			=> 'SEE MORE',
				'link'			=> '',
				'link_target'	=> '_self',
				'extra_css'		=> '',
				'css_animation' => ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		
			
			$rand_id = "image-with-caption-" . rand(1,10000);
			
			$output = '<a href="'. esc_url($link) .'" target="'. esc_attr($link_target) .'" class="ozy-image-with-caption" id="'. $rand_id .'">' . PHP_EOL;

			$image = wp_get_attachment_image_src($image, 'full');
			if(isset($image[0])) {
				$output .= '<figure>';
				if($icon) {
					$output .= '<span><i class="'. esc_attr($icon) .'"></i></span>';
				}
				$output .= '<img src="'. esc_url($image[0]) .'" alt="' . esc_attr($caption) . '"/>';
				$output .= '</figure>';
			}
			
			$output .= '<section>';
			$output .= '<h5>'. esc_attr($caption) .'</h5>';
			if(esc_attr($tag)) {
				$output .= '<span class="tag">'. esc_attr($tag) .'</span>';
			}	
			$output .= '</section>';
				
			//$output .= do_shortcode( $content );
			$output .= PHP_EOL .'</a>';
			
			global $ozyHelper;
			if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;
			$ozyHelper->set_footer_style("#$rand_id h5,#$rand_id {color:". esc_attr($fn_color) ." !important;}");
			$ozyHelper->set_footer_style("#$rand_id span.tag{background-color:". esc_attr($fn_color) .";color:". esc_attr($bg_color) .";}");
			$ozyHelper->set_footer_style("#$rand_id figure>span{background-color:". $ozyHelper->hex2rgba($bg_color, '0.7') .";}");		
			$ozyHelper->set_footer_style("#$rand_id>section{background-color:". esc_attr($bg_color) .";}");
			
			return $output;
		}
		
		add_shortcode('ozy_vc_imageboxwithcaption', 'ozy_vc_imageboxwithcaption');
		
		vc_map( array(
			"name" => esc_attr__("Image Box With Caption", "vp_textdomain"),
			"base" => "ozy_vc_imageboxwithcaption",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Image", "vp_textdomain"),
					"param_name" => "image",
					"admin_label" => false,
					"value" => ""
				),		
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Caption", "vp_textdomain"),
					"param_name" => "caption",
					"admin_label" => true,
					"value" => esc_attr__("Box Title", "vp_textdomain")
				),
				array(
					"type" => "select_an_icon",
					"heading" => esc_attr__("Hover Icon", "vp_textdomain"),
					"param_name" => "icon",
					"value" => '',
					"admin_label" => false
				),			
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Foreground Color", "vp_textdomain"),
					"param_name" => "fn_color",
					"admin_label" => false,
					"value" => "#ffffff"
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Tag Background Color", "vp_textdomain"),
					"param_name" => "bg_color",
					"admin_label" => false,
					"value" => "#000000"
				),					
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Tag", "vp_textdomain"),
					"param_name" => "tag",
					"admin_label" => true,
					"value" => esc_attr__("SEE MORE", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				),	
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   )
		) );
	}

	/**
	* Colored Content Box
	*/
	if (!function_exists('ozy_vc_coloredcontentbox')) {
		function ozy_vc_coloredcontentbox( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_coloredcontentbox', $atts);
			extract(shortcode_atts(array(
				'image'			=> '',
				'caption'		=> 'Caption Goes Here',
				'hover_caption' => 'SHOP NOW',
				'fn_color'		=> '#ffffff',
				'bg_color'		=> '#e42039',
				'tag' 			=> 'SAY SOMETHING',
				'link'			=> '',
				'link_target'	=> '_self',
				'extra_css'		=> '',
				'css_animation' => ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		
			
			$rand_id = "fancybox-" . rand(1,10000);
			
			$output = '<a href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'" class="ozy-colored-content-box" id="'. $rand_id .'">' . PHP_EOL;

			$image = wp_get_attachment_image_src($image, 'full');
			if(isset($image[0])) {
				$output .= '<img src="'. esc_url($image[0]) .'" alt="' . esc_attr($caption) . '"/>';
			}
			
			$output .= '<section class="overlay">';
			$output .= '<span class="caption heading-font">'. esc_attr($caption) .'</span>';
			if(esc_attr($tag)) {
				$output .= '<span class="tag">'. esc_attr($tag) .'</span>';
			}	
			$output .= '</section>';
			$output .= '<section class="overlay-two">';
			$output .= '<h5 class="ozy-vertical-centered-element">'. esc_attr($hover_caption) .'</h5>';
			$output .= '</section>';
				
			//$output .= do_shortcode( $content );
			$output .= PHP_EOL .'</a>';
			
			global $ozyHelper;
			if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;
			$ozyHelper->set_footer_style("#$rand_id>section>span,#$rand_id>section>h5{color:". esc_attr($fn_color) .";}");
			$ozyHelper->set_footer_style("#$rand_id>section>span.caption{background-color:". esc_attr($bg_color) .";color:". esc_attr($fn_color) .";}");
			$ozyHelper->set_footer_style("#$rand_id>section.overlay-two{background-color:". esc_attr($bg_color) .";}");		
			$ozyHelper->set_footer_style("#$rand_id:hover>section.overlay-two{background-color:". $ozyHelper->hex2rgba($bg_color, '0.7') .";}");
			
			return $output;
		}
		
		add_shortcode('ozy_vc_coloredcontentbox', 'ozy_vc_coloredcontentbox');
		
		vc_map( array(
			"name" => esc_attr__("Coloured Content Box", "vp_textdomain"),
			"base" => "ozy_vc_coloredcontentbox",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Image", "vp_textdomain"),
					"param_name" => "image",
					"admin_label" => false,
					"value" => ""
				),		
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Caption", "vp_textdomain"),
					"param_name" => "caption",
					"admin_label" => true,
					"value" => esc_attr__("Caption Goes Here", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Hover Caption", "vp_textdomain"),
					"param_name" => "hover_caption",
					"admin_label" => false,
					"value" => esc_attr__("SHOP NOW", "vp_textdomain")
				),			
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Foreground Color", "vp_textdomain"),
					"param_name" => "fn_color",
					"admin_label" => false,
					"value" => "#ffffff"
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Tag Background Color", "vp_textdomain"),
					"param_name" => "bg_color",
					"admin_label" => false,
					"value" => "#e42039"
				),					
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Tag", "vp_textdomain"),
					"param_name" => "tag",
					"admin_label" => true,
					"value" => esc_attr__("SAY SOMETHING", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				),	
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   )
		) );
	}

	/**
	* Simple Hover Image Box
	*/
	if (!function_exists('ozy_vc_simplehoverimagebox')) {
		function ozy_vc_simplehoverimagebox( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_simplehoverimagebox', $atts);
			extract(shortcode_atts(array(
				'image'			=> '',
				'title'			=> 'TITLE GOES HERE',
				'hover_caption' => '',
				'fn_color'		=> '#ffffff',
				'main_color'	=> '#0094f9',
				'video_path'	=> '',
				'link'			=> '',
				'link_target'	=> '_self',
				'extra_css'		=> '',
				'css_animation' => ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		
			
			$rand_id = "simple-hove-box-" . rand(1,10000);
			$output = '<div class="ozy-simple-hove-box" id="'. $rand_id .'">';
			$output .= '<h5><span class="cbox"></span>'. esc_attr($title) .'</h5>';
			if($video_path) {
				$output .= '<a href="'. esc_url($video_path) .'" title="'. esc_attr($title) .'" class="fancybox-media video-link"><img src="'. plugin_dir_url( __FILE__ ) .'/images/video_icon.png" alt=""/></a>';
			}
			$output .= '<a href="'. esc_url($link) .'" target="'. esc_attr($link_target) .'" id="'. $rand_id .'">' . PHP_EOL;

			$image = wp_get_attachment_image_src($image, 'full');
			if(isset($image[0])) {
				$output .= '<img src="'. esc_url($image[0]) .'" alt="' . esc_attr($title) . '"/>';
			}
			$output .= '<section>';
			$output .= '<p class="ozy-vertical-centered-element">'. esc_attr($hover_caption) . '</p>';			
			$output .= '</section>';
			
			$output .= PHP_EOL .'</a>';			
			$output .= PHP_EOL .'</div>';
			
			global $ozyHelper;
			if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;
			$ozyHelper->set_footer_style("#$rand_id>h5>span.cbox{background-color:". esc_attr($main_color) ."}");
			$ozyHelper->set_footer_style("#$rand_id>a>section{background-color:". $ozyHelper->hex2rgba(esc_attr($main_color), '0.7') ."}");
			$ozyHelper->set_footer_style("#$rand_id>a>section>p{color:". esc_attr($fn_color) ."}");
			
			return $output;
		}
		
		add_shortcode('ozy_vc_simplehoverimagebox', 'ozy_vc_simplehoverimagebox');
		
		vc_map( array(
			"name" => esc_attr__("Simple Hover Image Box", "vp_textdomain"),
			"base" => "ozy_vc_simplehoverimagebox",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true
				),
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Image", "vp_textdomain"),
					"param_name" => "image",
					"admin_label" => false,
					"value" => ""
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Hover Caption", "vp_textdomain"),
					"param_name" => "hover_caption",
					"admin_label" => false
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Main Color", "vp_textdomain"),
					"param_name" => "main_color",
					"admin_label" => false,
					"value" => "#0094f9"
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Foreground Color", "vp_textdomain"),
					"param_name" => "fn_color",
					"admin_label" => false,
					"value" => "#ffffff"
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Video Path", "vp_textdomain"),
					"param_name" => "video_path",
					"admin_label" => true,
					"description" => esc_attr__("Use only YouTube and Vimeo like services", "vp_textdomain")
				),				
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				),	
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   )
		) );
	}	

	/**
	* Flex Box
	*/
	if (!function_exists('ozy_vc_flexbox')) {
		function ozy_vc_flexbox( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_flexbox', $atts);
			extract(shortcode_atts(array(
				'image'			=> '',
				'caption'		=> '',
				'excerpt'		=> '',
				'tag' 			=> 'MORE',
				'link'			=> '',
				'link_target'	=> '_self',
				'extra_css'		=> '',
				'css_animation' => ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		
			$output = '';
			if($image) {
				$image = wp_get_attachment_image_src($image, 'large');			
				$output = '<div class="ozy-flex-box '. $css_animation .'">
				<a class="hover-frame" href="'. esc_url($link) .'" target="'. esc_attr($link_target) .'">
					<span class="hover-frame-wrapper">
						<img src="'. esc_url($image[0]) .'" alt="'. esc_attr($caption) .'"/>
						<span class="hover-frame-inner"></span>
					</span>
					<h6>'. $tag .'</h6>
				</a>
				<h5>'. $caption .'</h5>'. $excerpt .'</div>';
			}
			return $output;
		}
		
		add_shortcode('ozy_vc_flexbox', 'ozy_vc_flexbox');
		
		vc_map( array(
			"name" => esc_attr__("Flex Box", "vp_textdomain"),
			"base" => "ozy_vc_flexbox",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Image", "vp_textdomain"),
					"param_name" => "image",
					"admin_label" => false,
					"value" => ""
				),		
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Caption", "vp_textdomain"),
					"param_name" => "caption",
					"admin_label" => true,
					"value" => esc_attr__("Box Title", "vp_textdomain")
				),
				array(
					"type" => "textarea",
					"class" => "",
					"heading" => esc_attr__("Excerpt", "vp_textdomain"),
					"param_name" => "excerpt",
					"admin_label" => false
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Tag", "vp_textdomain"),
					"param_name" => "tag",
					"admin_label" => true,
					"value" => ""
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				),	
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   )
		) );
	}	
	
	/**
	* Call To Action Box
	*/
	if (!function_exists('ozy_vc_calltoactionbox')) {
		function ozy_vc_calltoactionbox( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_calltoactionbox', $atts);
			extract(shortcode_atts(array(
				'image'			=> '',
				'caption'		=> '',
				'icon'			=> '',
				'link_caption' 	=> '',
				'link'			=> '',
				'link_target'	=> '_self',
				'extra_css'		=> '',
				'css_animation' => ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		
					

			$image = wp_get_attachment_image_src($image, 'full');
			if(isset($image[0])) {
				//$output .= '<img src="'. esc_url($image[0]) .'" alt="' . esc_attr($caption) . '"/>';
				$image = ' style="background-image:url('. esc_url($image[0]) .')"';
			}else{
				$image = '';
			}
			$output = '<div class="ozy-call-to-action-box '. $css_animation .'"'. $image .'>';			
			$output .= '<div class="shadow-wrapper"></div>';
			$output .= '<div class="overlay-wrapper">';
			$output .= '<h3>'. $caption .'</h3>';
			
			$output .= '<a href="'. esc_url($link) .'" target="'. esc_attr($link_target) .'" class="heading-font">'. $link_caption .'</a>';
			if($icon) {
				$output .= '<i class="'. esc_attr($icon) .'"></i>';
			}
			$output .= '</div>';
			$output .= '</div>';
			
			return $output;
		}
		
		add_shortcode('ozy_vc_calltoactionbox', 'ozy_vc_calltoactionbox');
		
		vc_map( array(
			"name" => esc_attr__("Call To Action Box", "vp_textdomain"),
			"base" => "ozy_vc_calltoactionbox",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Image", "vp_textdomain"),
					"param_name" => "image",
					"admin_label" => false,
					"value" => ""
				),		
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Caption", "vp_textdomain"),
					"param_name" => "caption",
					"admin_label" => true,
					"value" => esc_attr__("Box Title", "vp_textdomain")
				),				
				array(
					"type" => "select_an_icon",
					"heading" => esc_attr__("Icon", "vp_textdomain"),
					"param_name" => "icon",
					"value" => '',
					"admin_label" => false
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link Caption", "vp_textdomain"),
					"param_name" => "link_caption",
					"admin_label" => true,
					"value" => esc_attr__("SHOP USED EQUIPMENT &rarr;", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				),	
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   )
		) );
	}	
	
	/**
	* Fancy Image Box
	*/
	if (!function_exists('ozy_vc_fancyimagebox')) {
		function ozy_vc_fancyimagebox( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_fancyimagebox', $atts);
			extract(shortcode_atts(array(
				'image'			=> '',
				'caption'		=> '',
				'excerpt'		=> '',
				'fn_color'		=> '#ffffff',
				'bg_color'		=> '#000000',
				'tag' 			=> 'MORE',
				'link'			=> '',
				'link_target'	=> '_self',
				'extra_css'		=> '',
				'css_animation' => ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		
			
			$rand_id = "fancybox-" . rand(1,10000);
			
			$output = '<a href="'. esc_url($link) .'" target="'. esc_attr($link_target) .'" class="ozy-fancyimagebox" id="'. $rand_id .'">' . PHP_EOL;

			$image = wp_get_attachment_image_src($image, 'full');
			if(isset($image[0])) {
				$output .= '<img src="'. esc_url($image[0]) .'" alt="' . esc_attr($caption) . '"/>';
			}
			
			$output .= '<section>';
			$output .= '<h2 style="display:none">'. esc_attr($caption) .'</h2>';
			$output .= '<section>';	
			if(esc_attr($tag)) {
				$output .= '<span class="tag">'. esc_attr($tag) .'</span>';
			}	
			$output .= '<h2>'. esc_attr($caption) .'</h2>';
			if(esc_attr($excerpt)) {
				$output .= '<span class="line"></span>';
				$output .= '<p>'. esc_attr($excerpt) .'</p>';
			}
			$output .= '</section>';
			$output .= '</section>';
				
			$output .= PHP_EOL .'</a>';
			
			global $ozyHelper;
			if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;
			$ozyHelper->set_footer_style("#$rand_id h2,#$rand_id p,#$rand_id {color:". esc_attr($fn_color) ." !important;}");
			$ozyHelper->set_footer_style("#$rand_id>section>section>span{border-color:". esc_attr($fn_color) .";}");
			$ozyHelper->set_footer_style("#$rand_id>section>section>span.tag{background-color:". $ozyHelper->hex2rgba($bg_color, '0.4') .";}");		
			
			return $output;
		}
		
		add_shortcode('ozy_vc_fancyimagebox', 'ozy_vc_fancyimagebox');
		
		vc_map( array(
			"name" => esc_attr__("Fancy Image Box", "vp_textdomain"),
			"base" => "ozy_vc_fancyimagebox",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Image", "vp_textdomain"),
					"param_name" => "image",
					"admin_label" => false,
					"value" => ""
				),		
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Caption", "vp_textdomain"),
					"param_name" => "caption",
					"admin_label" => true,
					"value" => esc_attr__("Box Title", "vp_textdomain")
				),
				array(
					"type" => "textarea",
					"class" => "",
					"heading" => esc_attr__("Excerpt", "vp_textdomain"),
					"param_name" => "excerpt",
					"admin_label" => false
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Foreground Color", "vp_textdomain"),
					"param_name" => "fn_color",
					"admin_label" => false,
					"value" => "#ffffff"
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Tag Background Color", "vp_textdomain"),
					"param_name" => "bg_color",
					"admin_label" => false,
					"value" => "#000000"
				),					
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Tag", "vp_textdomain"),
					"param_name" => "tag",
					"admin_label" => true,
					"value" => esc_attr__("MORE", "vp_textdomain")
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				),	
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   )
		) );
	}

	/**
	* News Bar
	*/
	if (!function_exists('ozy_vc_newsbar')) {
		function ozy_vc_newsbar( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_newsbar', $atts);
			extract(shortcode_atts(array(
				'title'				=> 'NEWS',
				'sub_title'			=> 'STAY TUNED',
				'link'				=> '',
				'link_caption' 		=> 'VIEW ALL',
				'link_target'		=> '_self',
				'css_animation' 	=> ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		

			$output = '<div class="ozy-news-bar">' . PHP_EOL;

			$args = array(
				'post_type' 			=> 'post',
				'posts_per_page'		=> 3,//esc_attr($posts_per_page),
				'orderby' 				=> 'date',
				'order' 				=> 'DESC',
				'ignore_sticky_posts' 	=> 1,
			);

			$the_query = new WP_Query( $args );

			$output	.= '<ul>';
			
			$output .= '<li><h1 class="content-color-alternate">'. esc_attr($title) .'</h1><h2 class="content-color">'. esc_attr($sub_title) .'</h2><a href="'. esc_url($link) .'" target="'. esc_attr($link_target) .'" class="generic-button">'. esc_attr($link_caption) .'<i class="oic-outlined-iconset-140">&nbsp;</i></a></li>';

			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				
				$output .= '<li>';
				$output .= '<h1 class="t">'. get_the_title() .'</h1>';
				$output .= '<p>' . ozy_excerpt_max_charlength(200, true, false) . '</p>';
				$output .= '<a href="'. get_permalink() .'">'. esc_attr__('READ MORE &nbsp;&nbsp;&gt;', 'vp_textdomain') .'</a>';				
				$output .= '</li>';
			}
			wp_reset_postdata();
			
			$output.= do_shortcode( $content );
			$output.= PHP_EOL .'</ul>';
			$output.= PHP_EOL .'</div>';
			
			return $output;
		}
		
		add_shortcode('ozy_vc_newsbar', 'ozy_vc_newsbar');
		
		vc_map( array(
			"name" => esc_attr__("News Bar", "vp_textdomain"),
			"base" => "ozy_vc_newsbar",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => esc_attr__("NEWS", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Sub Title", "vp_textdomain"),
					"param_name" => "sub_title",
					"admin_label" => true,
					"value" => esc_attr__("STAY TUNED", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true,
					"value" => '',
					"description" => esc_attr__("Link to blog / news page", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link Caption", "vp_textdomain"),
					"param_name" => "link_caption",
					"admin_label" => true,
					"value" => esc_attr__("VIEW ALL", "vp_textdomain")
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				),
				$add_css_animation
		   )
		) );
	}	
	
	/**
	* Fancy Post Accordion
	*/
	if (!function_exists('ozy_vc_fancypostaccordion_feed')) {
		function ozy_vc_fancypostaccordion_feed( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_fancypostaccordion_feed', $atts);
			extract(shortcode_atts(array(
				'link_caption' 		=> 'Find out more →',
				'link_target'		=> '_self',
				'posts_per_page'	=> '6',
				'css_animation' 	=> ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		

			$output = '<div class="ozy-fancyaccordion-feed">' . PHP_EOL;

			$args = array(
				'post_type' 			=> 'post',
				'posts_per_page'		=> esc_attr($posts_per_page),
				'orderby' 				=> 'date',
				'order' 				=> 'DESC',
				'ignore_sticky_posts' 	=> 1,
			);

			$the_query = new WP_Query( $args );
				
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$output .= '<a href="'. get_permalink() .'" target="'. esc_attr($link_target) .'" class="ozy-border-color"><span>';
				$output .= '<div class="d ozy-border-color"><h3>'. get_the_date('d.m.Y') .'</h3></div>';
				$output .= '<h3 class="t">'. get_the_title() .'</h3>';
				
				$categories = get_the_terms(get_the_ID(), 'category');
				if(is_array($categories)) {
					$output .= '<span class="category generic-button">';
					$comma = '';			
					foreach ($categories as $cat) {
						$output .= $comma . $cat->name;
						$comma = ', ';
					}
					$output .= '</span>';
				}
				
				$output .= '<span class="plus-icon"><span class="h"></span><span class="v"></span></span>';
				$output .= '</span></a>';
				$output .= '<div class="panel ozy-border-color"><div>' . ozy_excerpt_max_charlength(200, true, false) . '<p>';
				$output .= '<a href="'. get_permalink() .'">'. esc_attr($link_caption) .'</a>';
				$output .= '</p></div></div>';
			}
			wp_reset_postdata();
			
			$output.= do_shortcode( $content );
			$output.= PHP_EOL .'</div>';
			
			return $output;
		}
		
		add_shortcode('ozy_vc_fancypostaccordion_feed', 'ozy_vc_fancypostaccordion_feed');
		
		vc_map( array(
			"name" => esc_attr__("Fancy Post List", "vp_textdomain"),
			"base" => "ozy_vc_fancypostaccordion_feed",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link Caption", "vp_textdomain"),
					"param_name" => "link_caption",
					"admin_label" => true,
					"value" => esc_attr__("Find out more →", "vp_textdomain")
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				),					
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Item Count", "vp_textdomain"),
					"param_name" => "posts_per_page",
					"value" => array("6", "1", "2", "3", "4", "5", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16"),
					"admin_label" => true,
					"description" => esc_attr__("How many post will be shown on the list.", "vp_textdomain")
				),
				$add_css_animation
		   )
		) );
	}

	/**
	* Post List With Title
	*/
	if (!function_exists('ozy_vc_postlistwithtitle_feed')) {
		function ozy_vc_postlistwithtitle_feed( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_postlistwithtitle_feed', $atts);
			extract(shortcode_atts(array(
				'posts_per_page'	=> '8',
				'extra_css'			=> '',
				'css_animation' 	=> ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		

			$output = '<div class="ozy-postlistwithtitle-feed">' . PHP_EOL;

			$args = array(
				'post_type' 			=> 'post',
				'posts_per_page'		=> esc_attr($posts_per_page),
				'orderby' 				=> 'date',
				'order' 				=> 'DESC',
				'ignore_sticky_posts' 	=> 1,							
				'meta_key' 				=> '_thumbnail_id'
			);

			$the_query = new WP_Query( $args );
				
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$output .= '<a href="'. get_permalink() .'" class="ozy-border-color">';
				$output .= '<h2>'. get_the_title() .'</h2>';
				$output .= '<p>'. get_the_date() .'</p>';
				$output .= '<p>';
				$output .= strip_tags(get_the_category_list(', '));
				$output .= '</p>';
				$output .= '</a>';
			}
			wp_reset_postdata();
			
			$output.= do_shortcode( $content );
			$output.= PHP_EOL .'</div>';
			
			return $output;
		}
		
		add_shortcode('ozy_vc_postlistwithtitle_feed', 'ozy_vc_postlistwithtitle_feed');
		
		vc_map( array(
			"name" => esc_attr__("Post List With Title", "vp_textdomain"),
			"base" => "ozy_vc_postlistwithtitle_feed",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Post Count", "vp_textdomain"),
					"param_name" => "posts_per_page",
					"value" => "8",
					"admin_label" => true
				),		
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   )
		) );
	}

	/**
	* Mail Chimp
	*/
	if (!function_exists('ozy_vc_mailchimp') && function_exists('mailchimpSF_signup_form')) {
		function ozy_vc_mailchimp( $atts, $content = null ) {	  
            $atts = vc_map_get_attributes('ozy_vc_mailchimp', $atts);
			extract(shortcode_atts(array(
				'css_animation' => ''
				), $atts ) 
			);
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}
			
			return '<div class="wpb_content_element">'. do_shortcode('[mailchimpsf_form]') .'</div>';		
		}
		
		add_shortcode('ozy_vc_mailchimp', 'ozy_vc_mailchimp');
		
		vc_map( array(
			"name" => esc_attr__("Mail Chimp", "vp_textdomain"),
			"base" => "ozy_vc_mailchimp",
			"content_element" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				$add_css_animation	
		   )
		) );
	}

	/**
	* Anything Wrapper 2
	*/
	if (!function_exists('ozy_vc_anywrapper2')) {
		function ozy_vc_anywrapper2( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_anywrapper2', $atts);
			extract(shortcode_atts(array(
				'vertical_position' => 'center',
				'horizontal_position' => 'center',
				'width' => '50%',
				'text_align' => 'left',
				'padding_top' => '30px',
				'padding_right' => '30px',
				'padding_bottom' => '30px',
				'padding_left' => '30px'
			), $atts));
			
			$style = 'ozy-anything-wrapper-x';
			$style .= ' v-' . $vertical_position;
			$style .= ' h-' . $horizontal_position;
			
			return '<div class="'. esc_attr($style) .'" style="text-align:'. esc_attr($text_align) .';width:'. esc_attr($width) .';padding:'. esc_attr($padding_top) .' '. esc_attr($padding_right) .' '. esc_attr($padding_bottom) .' '. esc_attr($padding_left) .'">'. do_shortcode($content) .'</div>';
		}
		
		add_shortcode('ozy_vc_anywrapper2', 'ozy_vc_anywrapper2');
		
		vc_map( array(
			"name" => esc_attr__("Anything Wrapper 2", "vp_textdomain"),
			"base" => "ozy_vc_anywrapper2",
			"as_parent" => array('except' => 'ozy_vc_iabox,ozy_vc_flipbox'),
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Vertical Position", "vp_textdomain"),
					"param_name" => "vertical_position",
					"admin_label" => true,
					"value" => array("center","top","bottom")
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Horizontal Position", "vp_textdomain"),
					"param_name" => "horizontal_position",
					"admin_label" => true,
					"value" => array("center","left","right")
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Width", "vp_textdomain"),
					"param_name" => "width",
					"admin_label" => true,
					"value" => "50%"
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Text Align", "vp_textdomain"),
					"param_name" => "text_align",
					"admin_label" => true,
					"value" => array("left","center","right")
				),						
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Padding Top", "vp_textdomain"),
					"param_name" => "padding_top",
					"admin_label" => true,
					"value" => array("30px","0","5px","10px","15px","20px","25px","35px","40px","45px","50px","55px","60px","65px","70px","75px","80px","85px","90px","95px","100px","105px","110px","115px","120px","125px","130px","135px","140px","145px","150px","155px","160px","165px","170px","175px","180px","185px","190px","195px","200px")
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Padding Right", "vp_textdomain"),
					"param_name" => "padding_right",
					"admin_label" => true,
					"value" => array("30px","0","5px","10px","15px","20px","25px","35px","40px","45px","50px","55px","60px","65px","70px","75px","80px","85px","90px","95px","100px","105px","110px","115px","120px","125px","130px","135px","140px","145px","150px","155px","160px","165px","170px","175px","180px","185px","190px","195px","200px")
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Padding Bottom", "vp_textdomain"),
					"param_name" => "padding_bottom",
					"admin_label" => true,
					"value" => array("30px","0","5px","10px","15px","20px","25px","35px","40px","45px","50px","55px","60px","65px","70px","75px","80px","85px","90px","95px","100px","105px","110px","115px","120px","125px","130px","135px","140px","145px","150px","155px","160px","165px","170px","175px","180px","185px","190px","195px","200px")
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Padding Left", "vp_textdomain"),
					"param_name" => "padding_left",
					"admin_label" => true,
					"value" => array("30px","0","5px","10px","15px","20px","25px","35px","40px","45px","50px","55px","60px","65px","70px","75px","80px","85px","90px","95px","100px","105px","110px","115px","120px","125px","130px","135px","140px","145px","150px","155px","160px","165px","170px","175px","180px","185px","190px","195px","200px")
				)									
		   ),
		   "js_view" => 'VcColumnView'
		) );
	}

	class WPBakeryShortCode_Ozy_Vc_Anywrapper2 extends WPBakeryShortCodesContainer{}

	/**
	* Anything Wrapper
	*/
	if (!function_exists('ozy_vc_anywrapper')) {
		function ozy_vc_anywrapper( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_anywrapper', $atts);
			extract(shortcode_atts(array(
				'padding_top' => '30px',
				'padding_right' => '30px',
				'padding_bottom' => '30px',
				'padding_left' => '30px'
			), $atts));
			
			return '<div class="ozy-anything-wrapper" style="display:inline-block;width:100%;padding:'. esc_attr($padding_top) .' '. esc_attr($padding_right) .' '. esc_attr($padding_bottom) .' '. esc_attr($padding_left) .'">'. do_shortcode($content) .'</div>';
		}
		
		add_shortcode('ozy_vc_anywrapper', 'ozy_vc_anywrapper');
		
		vc_map( array(
			"name" => esc_attr__("Anything Wrapper", "vp_textdomain"),
			"base" => "ozy_vc_anywrapper",
			"as_parent" => array('except' => 'ozy_vc_iabox,ozy_vc_flipbox'),
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Padding Top", "vp_textdomain"),
					"param_name" => "padding_top",
					"admin_label" => true,
					"value" => array("30px","0","5px","10px","15px","20px","25px","35px","40px","45px","50px","55px","60px","65px","70px","75px","80px","85px","90px","95px","100px","105px","110px","115px","120px","125px","130px","135px","140px","145px","150px","155px","160px","165px","170px","175px","180px","185px","190px","195px","200px")
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Padding Right", "vp_textdomain"),
					"param_name" => "padding_right",
					"admin_label" => true,
					"value" => array("30px","0","5px","10px","15px","20px","25px","35px","40px","45px","50px","55px","60px","65px","70px","75px","80px","85px","90px","95px","100px","105px","110px","115px","120px","125px","130px","135px","140px","145px","150px","155px","160px","165px","170px","175px","180px","185px","190px","195px","200px")
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Padding Bottom", "vp_textdomain"),
					"param_name" => "padding_bottom",
					"admin_label" => true,
					"value" => array("30px","0","5px","10px","15px","20px","25px","35px","40px","45px","50px","55px","60px","65px","70px","75px","80px","85px","90px","95px","100px","105px","110px","115px","120px","125px","130px","135px","140px","145px","150px","155px","160px","165px","170px","175px","180px","185px","190px","195px","200px")
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Padding Left", "vp_textdomain"),
					"param_name" => "padding_left",
					"admin_label" => true,
					"value" => array("30px","0","5px","10px","15px","20px","25px","35px","40px","45px","50px","55px","60px","65px","70px","75px","80px","85px","90px","95px","100px","105px","110px","115px","120px","125px","130px","135px","140px","145px","150px","155px","160px","165px","170px","175px","180px","185px","190px","195px","200px")
				)									
		   ),
		   "js_view" => 'VcColumnView'
		) );
	}

	class WPBakeryShortCode_Ozy_Vc_Anywrapper extends WPBakeryShortCodesContainer{}

	/**
	* Styled Heading
	*/
	if (!function_exists('ozy_vc_sheading')) {
		function ozy_vc_sheading( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_sheading', $atts);
			extract(shortcode_atts(array(
				'caption' 		=> '',
				'caption_size'	=> 'h1',
				'caption_position'=> 'center',
				'border_style'	=> 'solid',
				'border_size'	=> '1px',
				'accent_color' 	=> '#000',
				'bg_color' 		=> '',
				'padding' 		=> '5px',
				'css_animation' => ''
				), $atts ) 
			);
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}

			$padding = esc_attr($padding) . ' ' . ((int)esc_attr($padding)+5) . 'px';

			return '<div class="wpb_content_element" style="text-align:'. esc_attr($caption_position) .';"><'. esc_attr($caption_size) .' style="border:'. esc_attr($border_size) .' '. esc_attr($border_style) .' '. esc_attr($accent_color) . (esc_attr($bg_color) ? ';background-color:' . esc_attr($bg_color) : '') .';color:'. esc_attr($accent_color) .';padding:'. $padding .';display:inline-block;">'. esc_attr($caption) .'</'. esc_attr($caption_size) .'></div>';
		}

		add_shortcode('ozy_vc_sheading', 'ozy_vc_sheading');

		vc_map( array(
		   "name" => esc_attr__("Styled Heading", "vp_textdomain"),
		   "base" => "ozy_vc_sheading",
		   "class" => "",
		   "controls" => "full",
		   'category' => 'by OZY',
		   "icon" => "icon-wpb-ozy-el",
		   "params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Caption", "vp_textdomain"),
					"param_name" => "caption",
					"admin_label" => true,
					"value" => esc_attr__("Enter your caption here", "vp_textdomain"),
					"description" => esc_attr__("Caption of the component.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Caption Size", "vp_textdomain"),
					"param_name" => "caption_size",
					"admin_label" => true,
					"value" => array("h1", "h2", "h3", "h4", "h5", "h6")
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Caption Position", "vp_textdomain"),
					"param_name" => "caption_position",
					"admin_label" => true,
					"value" => array("center", "left", "right")
				),						
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Border Style", "vp_textdomain"),
					"param_name" => "border_style",
					"admin_label" => true,
					"value" => array("solid","dotted","dashed","double")
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Border Size", "vp_textdomain"),
					"param_name" => "border_size",
					"admin_label" => true,
					"value" => array("0","1px","2px","3px","4px","5px","6px","7px","8px","9px","10px")
				),			
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Accent Color", "vp_textdomain"),
					"param_name" => "accent_color",
					"admin_label" => false,
					"value" => "#000"
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Background Color", "vp_textdomain"),
					"param_name" => "bg_color",
					"admin_label" => false,
					"value" => "#fff"
				),			
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Padding", "vp_textdomain"),
					"param_name" => "padding",
					"admin_label" => true,
					"value" => array("5px","10px","15px","20px","25px","30px","35px","40px","45px","50px")
				),$add_css_animation
			)
		) );
	}

	/**
	* Flip Box
	*/
	if (!function_exists('ozy_vc_flipbox')) {
		function ozy_vc_flipbox( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_flipbox', $atts);
			extract(shortcode_atts(array(
				'front_icon' => '',
				'front_title' => '',
				'front_excerpt' => '',
				'front_bg_color' => '',
				'front_fg_color' => '#222222',
				'front_bg_image' => '',
				'back_icon' => '',
				'back_title' => '',
				'back_excerpt' => '',
				'back_bg_color' => '#222222',
				'back_fg_color' => '#ffffff',
				'back_bg_image' => '',
				'direction' => 'horizontal',
				'height' => '427',
				'link' => '',
				'link_target' => '_self'
			), $atts));

			global $ozyHelper;
			if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;

			$front_bg_image = wp_get_attachment_image_src(esc_attr($front_bg_image), 'full');
			$back_bg_image 	= wp_get_attachment_image_src(esc_attr($back_bg_image), 'full');
			
			$front_bg 	= $ozyHelper->background_style_render(esc_attr($front_bg_color), (isset($front_bg_image[0]) ? esc_attr($front_bg_image[0]):''), '', '', '', '', '', '');
			$back_bg 	= $ozyHelper->background_style_render(esc_attr($back_bg_color), (isset($back_bg_image[0]) ? esc_attr($back_bg_image[0]):''), '', '', '', '', '', '');
			
			return '<div class="flip-container '. esc_attr($direction) .' wpb_content_element" ontouchstart="this.classList.toggle(\'hover\');" style="height:'. esc_attr($height).'px;">
					<a class="flipper" '. (esc_attr($link) ? 'href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'"' : '') .'>
						<span class="front" style="'. $front_bg .'">
							'. (esc_attr($front_icon) ? '<i style="color:'. esc_attr($front_fg_color) .'" class="'. esc_attr($front_icon) .'"></i>' : '') .'
							'. (esc_attr($front_title) ? '<h3 style="color:'. esc_attr($front_fg_color) .'">'. esc_attr($front_title) .'</h3>' : '') .'
							'. (esc_attr($front_excerpt) ? '<p style="color:'. esc_attr($front_fg_color) .'">'. nl2br(strip_tags($front_excerpt)) .'</p>' : '') .'
						</span>
						<span class="back" style="'. $back_bg .'">
							'. (esc_attr($back_icon) ? '<i style="color:'. esc_attr($back_fg_color) .'" class="'. esc_attr($back_icon) .'"></i>' : '') .'
							'. (esc_attr($back_title) ? '<h3 style="color:'. esc_attr($back_fg_color) .'">'. esc_attr($back_title) .'</h3>' : '') .'
							'. (esc_attr($back_excerpt) ? '<p style="color:'. esc_attr($back_fg_color) .'">'. nl2br(strip_tags($back_excerpt)) .'</p>' : '') .'
						</span>
					</a>
				</div>';		
		}
		
		add_shortcode( 'ozy_vc_flipbox', 'ozy_vc_flipbox' );
		
		vc_map( array(
			"name" => esc_attr__("Flip Box", "vp_textdomain"),
			"base" => "ozy_vc_flipbox",
			"content_element" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "select_an_icon",
					"heading" => esc_attr__("Front Icon", "vp_textdomain"),
					"param_name" => "front_icon",
					"value" => '',
					"admin_label" => false
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Front Title", "vp_textdomain"),
					"param_name" => "front_title",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textarea",
					"class" => "",
					"heading" => esc_attr__("Front Excerpt", "vp_textdomain"),
					"param_name" => "front_excerpt",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Front Background Image", "vp_textdomain"),
					"param_name" => "front_bg_image",
					"admin_label" => false,
					"value" => ""
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Front Background Color", "vp_textdomain"),
					"param_name" => "front_bg_color",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Front Foreground Color", "vp_textdomain"),
					"param_name" => "front_fg_color",
					"admin_label" => true,
					"value" => "#222222"
				),array(
					"type" => "select_an_icon",
					"heading" => esc_attr__("Back Icon", "vp_textdomain"),
					"param_name" => "back_icon",
					"value" => '',
					"admin_label" => false
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Back Title", "vp_textdomain"),
					"param_name" => "back_title",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textarea",
					"class" => "",
					"heading" => esc_attr__("Back Excerpt", "vp_textdomain"),
					"param_name" => "back_excerpt",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Back Background Image", "vp_textdomain"),
					"param_name" => "back_bg_image",
					"admin_label" => false,
					"value" => ""
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Back Background Color", "vp_textdomain"),
					"param_name" => "back_bg_color",
					"admin_label" => true,
					"value" => "#222222"
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Back Foreground Color", "vp_textdomain"),
					"param_name" => "back_fg_color",
					"admin_label" => true,
					"value" => "#ffffff"
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Direction", "vp_textdomain"),
					"param_name" => "direction",
					"value" => array("horizontal", "vertical"),
					"admin_label" => true
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Height", "vp_textdomain"),
					"param_name" => "height",
					"admin_label" => true,
					"value" => "427",
					"description" => esc_attr__("Please enter only integer values. Will be processed in pixels.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				)
		   )
		) );	
	}

	/**
	* Textillate
	*/
	if (!function_exists('ozy_vc_textillate')) {
		function ozy_vc_textillate( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_textillate', $atts);
			extract(shortcode_atts(array(
				'size' 				=> '22px',
				'display_time' 		=> '2000',
				'font_color' 		=> '#000000',
				'font_weight' 		=> '300',
				'in_effect' 		=> 'fadeInLeftBig',
				'in_effect_type'	=> 'sequence',
				'out_effect' 		=> 'hinge',
				'out_effect_type'	=> 'shuffle',
				'loop'				=> 'true',
				'align'				=> ''
			), $atts));
			
			switch ($align) {
				case 'right':
					$align = 'width:100%;display:inline-block;text-align:right;';
					break;
				case 'center':
					$align = 'width:100%;display:inline-block;text-align:center;';
					break;
				default:
					$align = '';
			}
			
			$output = '<div class="ozy-tlt" style="'. esc_attr($align) .'color:'. esc_attr($font_color) .';font-weight:'. esc_attr($font_weight) .';font-size:'. esc_attr($size) .'px;line-height:'. ((int)esc_attr($size)+10) .'px" data-display_time="'. esc_attr($display_time) .'" data-in_effect="'. esc_attr($in_effect) .'" data-in_effect_type="'. esc_attr($in_effect_type) .'" data-out_effect="'. esc_attr($out_effect) .'" data-out_effect_type="'. esc_attr($out_effect_type) .'" data-loop="'. esc_attr($loop) .'">';
			$content = explode("<br />", $content);
			if(is_array($content)) {
				$output.= '<ul class="ozy-tlt-texts" style="display: none">';
				foreach($content as $line) {
					$output.= '<li>'. trim($line) .'</li>';
				}
				$output.= '</ul>';
			}
			$output.= '</div>';
			
			return $output;
		}
		
		add_shortcode('ozy_vc_textillate', 'ozy_vc_textillate');

		vc_map( array(
			"name" => esc_attr__("Textillate", "vp_textdomain"),
			"base" => "ozy_vc_textillate",
			"content_element" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textarea",
					"class" => "",
					"heading" => esc_attr__("Content", "vp_textdomain"),
					"param_name" => "content",
					"admin_label" => true,
					"description" => esc_attr__('Each line will be processed as a slide.', 'vp_textdomain'),
					"value" => ""
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Size", "vp_textdomain"),
					"param_name" => "size",
					"value" => array("12", "14", "16", "18", "20", "22", "24", "26", "28", "30", "32", "34", "36", "38", "40", "42", "44", "46", "48", "50", "52", "54", "56", "58", "60", "62", "64", "66", "68", "70", "72", "74", "76", "78", "80", "90", "92", "94", "96", "98", "100"),
					"admin_label" => true
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Display Time", "vp_textdomain"),
					"param_name" => "display_time",
					"admin_label" => true,
					"description" => esc_attr__('Sets the minimum display time for each text before it is replaced.', 'vp_textdomain'),
					"value" => "2000"
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Loop", "vp_textdomain"),
					"param_name" => "loop",
					"value" => array("true", "false"),
					"admin_label" => true
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Color", "vp_textdomain"),
					"param_name" => "font_color",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Color of your text.", "vp_textdomain")
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Font Weight", "vp_textdomain"),
					"param_name" => "font_weight",
					"value" => array("300", "100", "200", "400", "500" , "600", "700", "800", "900"),
					"admin_label" => true
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("In Animation Effect", "vp_textdomain"),
					"param_name" => "in_effect",
					"value" => $animate_css_effects,
					"admin_label" => true
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("In Animation Type", "vp_textdomain"),
					"param_name" => "in_effect_type",
					"value" => array("sequence", "reverse", "sync", "shuffle"),
					"admin_label" => true
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Out Animation Effect", "vp_textdomain"),
					"param_name" => "out_effect",
					"value" => $animate_css_effects,
					"admin_label" => true
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Out Animation Type", "vp_textdomain"),
					"param_name" => "out_effect_type",
					"value" => array("sequence", "reverse", "sync", "shuffle"),
					"admin_label" => true
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Text Align", "vp_textdomain"),
					"param_name" => "align",
					"value" => array("left", "center", "right"),
					"admin_label" => true
				)								
		   )
		) );
	}


	/**
	* Floating Box
	*/
	if (!function_exists('ozy_vc_floatingbox')) {
		function ozy_vc_floatingbox( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_floatingbox', $atts);
			extract(shortcode_atts(array(
				'height' => '300px',
				'align' => 'left'
			), $atts));
			
			return '<div class="ozy-floating-box" style="height:'. esc_attr($height) .';text-align:'. esc_attr($align) .'"><div>'. do_shortcode($content) .'</div></div>';
		}
		
		add_shortcode('ozy_vc_floatingbox', 'ozy_vc_floatingbox');
		
		vc_map( array(
			"name" => esc_attr__("Floating Box", "vp_textdomain"),
			"base" => "ozy_vc_floatingbox",
			"as_parent" => array('except ' => ''),
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Height", "vp_textdomain"),
					"param_name" => "height",
					"value" => "300px",
					"description" => esc_attr__("Please set same height as your row height as initial value, in order to make it work as expected", "vp_textdomain"),
					"admin_label" => true
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Content Align", "vp_textdomain"),
					"param_name" => "align",
					"value" => array("left", "center", "right"),
					"admin_label" => true
				)			
		   ),
		   "js_view" => 'VcColumnView'
		) );
	}

	class WPBakeryShortCode_Ozy_Vc_Floatingbox extends WPBakeryShortCodesContainer{}

	/**
	* Morph Text
	*/
	if (!function_exists('ozy_vc_morphtext')) {
		function ozy_vc_morphtext( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_morphtext', $atts);
			extract(shortcode_atts(array(
				'text_before'	=> '',
				'text_after' 	=> '',
				'text_rotate'	=> '',
				'size' 			=> 'h1',
				'font_color' 	=> '#000000',
				'rotating_color'=> '#000000',
				'separator' 	=> ',',
				'effect' 		=> 'bounceIn',
				'speed' 		=> '2000'
			), $atts));
			
			return '<div><'. esc_attr($size) .' class="ozy-morph-text" style="color:'. esc_attr($font_color) .'" data-separator="'. esc_attr($separator) .'" data-effect="'. esc_attr($effect) .'" data-speed="'. esc_attr($speed) .'"><span class="bt">'. esc_attr($text_before) .'</span> <span class="text-rotate" style="color:'. esc_attr($rotating_color) .'">'. esc_attr($text_rotate) .'</span> '. esc_attr($text_after) .'</'. esc_attr($size) .'"></div>';
		}
		
		add_shortcode('ozy_vc_morphtext', 'ozy_vc_morphtext');

		vc_map( array(
			"name" => esc_attr__("Morph Text", "vp_textdomain"),
			"base" => "ozy_vc_morphtext",
			"content_element" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Before Rotating Text", "vp_textdomain"),
					"param_name" => "text_before",
					"admin_label" => true,
					"description" => esc_attr__('This text will be shown before rotating text.', 'vp_textdomain'),
					"value" => ""
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("After Rotating Text", "vp_textdomain"),
					"param_name" => "text_after",
					"admin_label" => true,
					"description" => esc_attr__('This text will be shown after rotating text.', 'vp_textdomain'),
					"value" => ""
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Rotating Text", "vp_textdomain"),
					"param_name" => "text_rotate",
					"admin_label" => true,
					"description" => esc_attr__('Use separator between words, default ",". Seperator could be managed by the box below.', 'vp_textdomain'),
					"value" => ""
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Separator", "vp_textdomain"),
					"param_name" => "separator",
					"admin_label" => true,
					"description" => esc_attr__('If you don\'t want commas to be the separator, you can define a new separator (|, &, * etc.) by yourself using this field.', 'vp_textdomain'),
					"value" => ","
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Size", "vp_textdomain"),
					"param_name" => "size",
					"value" => array("h1", "h2", "h3", "h4", "h5", "h6"),
					"admin_label" => true
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Color", "vp_textdomain"),
					"param_name" => "font_color",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Color of your text.", "vp_textdomain")
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Rotating Text Color", "vp_textdomain"),
					"param_name" => "rotating_color",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Color of your rotating text.", "vp_textdomain")
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Effect", "vp_textdomain"),
					"param_name" => "effect",
					"value" => $animate_css_effects,
					"admin_label" => true
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Speed", "vp_textdomain"),
					"param_name" => "speed",
					"admin_label" => true,
					"description" => esc_attr__('How many milliseconds until the next word show.', 'vp_textdomain'),
					"value" => "2000"
				)						
		   )
		) );
	}

	/**
	* Spacer
	*/
	if (!function_exists('ozy_vc_spacer')) {
		function ozy_vc_spacer( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_spacer', $atts);
			extract(shortcode_atts(array(
				'size' 			=> '30px'
			), $atts));
			
			return '<div style="height:'. esc_attr($size) .'" class="ozy-spacer"></div>';
		}
		
		add_shortcode('ozy_vc_spacer', 'ozy_vc_spacer');

		vc_map( array(
			"name" => esc_attr__("Spacer", "vp_textdomain"),
			"base" => "ozy_vc_spacer",
			"content_element" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Size", "vp_textdomain"),
					"param_name" => "size",
					"admin_label" => true,
					"description" => esc_attr__('Enter size like 10px, 3em. Please don\'t use percentage values.', 'vp_textdomain'),
					"value" => "30px"
				)
		   )
		) );
	}
	
	/**
	* Instagram Carousel Feeder
	*/
	if (!function_exists('ozy_vc_instagramcarousel')) {
		function ozy_vc_instagramcarousel( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_instagramcarousel', $atts);
			extract(shortcode_atts(array(
				'user'			=> 'self',
				'autoplay'		=> '',
				'items'			=> '',
				'singleitem'	=> '',
				'slidespeed'	=> '',
				'autoheight'	=> '',
				'extra_css'		=> '',
				'css_animation' => ''
			), $atts));
			
			$essentials_options = get_option('ozy_buildme_essentials');
			if( is_array($essentials_options) && isset($essentials_options['instagram_access_token_key'])) {		
				if($css_animation) {
					wp_enqueue_script('waypoints');
					$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
				}
		
				$output = '<div class="ozy-owlcarousel with-feed '. $css_animation .'" data-autoplay="'. esc_attr($autoplay) .'" data-items="'. esc_attr($items) .'" data-singleitem="'. esc_attr($singleitem) .'" data-slidespeed="'. esc_attr($slidespeed) .'" data-paginationSpeed="800" data-autoheight="'. esc_attr($autoheight) .'">' . PHP_EOL;
		
				$result = ozy_fetchCurlData("https://api.instagram.com/v1/users/". esc_attr($user) ."/media/recent/?access_token=". esc_attr($essentials_options['instagram_access_token_key']));
				
				if($result === '-10') {
					$output .= '<div class="item item-extended">Curl is not active on your server</div>';
				}else{
					$result = json_decode($result);
					if(isset($result->data) && is_array($result->data)) {
						foreach ($result->data as $post) {
							$output .= '<div class="item item-extended">';
							$output .= '<img class="lazyOwl" src="'. get_template_directory_uri() .'/images/blank-large.gif" alt="" data-src="'. esc_url($post->images->standard_resolution->url) .'">';
							$output .= '<a href="'. esc_url($post->link) .'" target="_blank">';
							$output .= '</a>';
							$output .= '</div>';
						}
					}else{
						$output .= '<div class="item item-extended">An error occuired. Pleaese check your access token and try again.</div>';
					}
				}
				$output.= do_shortcode( $content );
				$output.= PHP_EOL .'</div>';
			
				return $output;
			}else{
				return 'ozy Essentials Plugin has to be installed and necessary Instagram Parameters has to be set on it';
			}
		}
		
		add_shortcode('ozy_vc_instagramcarousel', 'ozy_vc_instagramcarousel');
		
		vc_map( array(
			"name" => esc_attr__("Instagram Carousel", "vp_textdomain"),
			"base" => "ozy_vc_instagramcarousel",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("User ID", "vp_textdomain"),
					"param_name" => "user",
					"admin_label" => true,
					"value" => "self",
					"description" => esc_attr__('Use your own images or get User ID <a href="http://jelled.com/instagram/lookup-user-id" target="_blank">here</a>.', "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Auto Play", "vp_textdomain"),
					"param_name" => "autoplay",
					"value" => array("true", "false", "1000", "2000", "3000", "4000", "5000", "6000", "7000", "8000", "9000", "10000"),
					"admin_label" => true,
					"description" => esc_attr__("Change to any available integrer for example 3000 to play every 3 seconds. If you set it true default speed will be 5 seconds.", "vp_textdomain")
				),		
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Item Count", "vp_textdomain"),
					"param_name" => "items",
					"value" => array("3", "1", "2", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16"),
					"admin_label" => true,
					"description" => esc_attr__("This variable allows you to set the maximum amount of items displayed at a time with the widest browser width.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Show Single Item?", "vp_textdomain"),
					"param_name" => "singleitem",
					"value" => array("false", "true"),
					"admin_label" => true,
					"description" => esc_attr__("Display only one item. Set Item Count to 1 to make it work as expected.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Slide Speed", "vp_textdomain"),
					"param_name" => "slidespeed",
					"value" => array("200", "100", "300", "400", "500", "600", "700", "800", "900", "1000", "1100", "1200", "1300", "1400", "1500", "1600", "1700", "1800", "1900", "2000"),
					"admin_label" => true,
					"description" => esc_attr__("Slide speed in milliseconds.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Auto Height", "vp_textdomain"),
					"param_name" => "autoheight",
					"value" => array("false", "true"),
					"admin_label" => true,
					"description" => esc_attr__("Add height to owl-wrapper-outer so you can use diffrent heights on slides. Use it only for one item per page setting.", "vp_textdomain")
				),		
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   )
		) );
	}

	/**
	* WooCommerce Carousel
	*/
	if (!function_exists('ozy_vc_woocarousel')) {
		function ozy_vc_woocarousel( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_woocarousel', $atts);
			extract(shortcode_atts(array(
				'autoplay'		=> '',
				'items'			=> '',
				'singleitem'	=> '',
				'slidespeed'	=> '',
				'autoheight'	=> '',
				'extra_css'		=> '',
				'css_animation' => ''
			), $atts));
			
			if(!class_exists('woocommerce')) {
				return '<div>'. esc_attr__('WooCommerce Plugin is not installed or activated', 'vp_textdomain') .'</div>';
			}
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		

			$output = '<div class="ozy-owlcarousel woocommerce-carousel '. $css_animation .'" data-autoplay="'. esc_attr($autoplay) .'" data-items="'. esc_attr($items) .'" data-singleitem="'. esc_attr($singleitem) .'" data-slidespeed="'. esc_attr($slidespeed) .'" data-paginationSpeed="800" data-autoheight="'. esc_attr($autoheight) .'">' . PHP_EOL;

			$args = array(
				'post_type' 			=> 'product',
				'posts_per_page'		=> '8',
				'orderby' 				=> 'date',
				'order' 				=> 'DESC',
				'ignore_sticky_posts' 	=> 1,							
				'meta_key' 				=> '_thumbnail_id'
			);

			$the_query = new WP_Query( $args );
				
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				global $product;
				
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'showbiz');

				$output .= '<div class="item item-extended">';
				$output .= '<figure>';
				if(isset($thumb[0])) {$output .= '<img class="lazyOwl" src="'. get_template_directory_uri() .'/images/blank-large.gif" data-src="'. esc_url($thumb[0]) .'" alt="'. get_the_title() .'"/>';}else{$output .= '<img class="lazyOwl" src="'. get_template_directory_uri() .'/images/blank-large.gif" data-src="'. get_template_directory_uri() .'/images/blank-large.gif" alt=""/>';}
				$output .= '<div class="overlay">';
				$output .= '<div>';

				if ($product->is_in_stock()) {
					$link = array(
						'url' => '',
						'label' => '',
						'class' => ''
					);
					
					$handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );
					
					switch ( $handler ) {
						case "variable" :
							$link['url'] = apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
							$link['label'] = apply_filters( 'variable_add_to_cart_text', esc_attr__( 'SELECT OPTIONS', 'vp_textdomain' ) );
							break;
						case "grouped" :
							$link['url'] = apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
							$link['label'] = apply_filters( 'grouped_add_to_cart_text', esc_attr__( 'VIEW OPTIONS', 'vp_textdomain' ) );
							break;
						case "external" :
							$link['url'] = apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
							$link['label'] = apply_filters( 'external_add_to_cart_text', esc_attr__( 'READ MORE', 'vp_textdomain' ) );
							break;
						default :
							if ( $product->is_purchasable() ) {
								$link['url'] = apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
								$link['label'] = apply_filters( 'add_to_cart_text', esc_attr__( 'ADD TO CART', 'vp_textdomain' ) );
								$link['class'] = apply_filters( 'add_to_cart_class', 'add_to_cart_button' );
							} else {
								$link['url'] = apply_filters( 'not_purchasable_url', get_permalink( $product->id ) );
								$link['label'] = apply_filters( 'not_purchasable_text', esc_attr__( 'READ MORE', 'vp_textdomain' ) );
							}
						break;
					}
					$output .= apply_filters( 'woocommerce_loop_add_to_cart_link', 
						sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s button product_type_%s"><div class="btn-basket">%s</div></a>', 
						esc_url( $link['url'] ), 
						esc_attr( $product->id ), 
						esc_attr( $product->get_sku() ), 
						esc_attr( $link['class'] ), 
						esc_attr( $product->product_type ), 
						esc_html( $link['label'] ) ), $product, $link );
					$output .= '<a href="'. get_permalink() .'" class="product-details">'. esc_attr__('SEE PRODUCT DETAILS', 'vp_textdomain') .'</a>';
				}else{
					$output .= '<a href="' . apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ) .'" class="button">'. apply_filters( 'out_of_stock_add_to_cart_text', esc_attr__( 'READ MORE', 'vp_textdomain' ) ) .'</a>';
				}
							
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</figure>';
				$output .= '<div class="info">';
				$output .= '<h3 class="content-color">'. get_the_title() .'</h3>';
				$output .= '<h5 class="content-color-alternate">'. $product->get_price_html().'</h5>';
				$output .= '</div>';

				$output .= '</div>';			
			}
			wp_reset_postdata();
			
			$output.= do_shortcode( $content );
			$output.= PHP_EOL .'</div>';
			
			return $output;
		}
		
		add_shortcode('ozy_vc_woocarousel', 'ozy_vc_woocarousel');
		
		vc_map( array(
			"name" => esc_attr__("WooCommerce Product Carousel", "vp_textdomain"),
			"base" => "ozy_vc_woocarousel",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(			
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Auto Play", "vp_textdomain"),
					"param_name" => "autoplay",
					"value" => array("true", "false", "1000", "2000", "3000", "4000", "5000", "6000", "7000", "8000", "9000", "10000"),
					"admin_label" => true,
					"description" => esc_attr__("Change to any available integrer for example 3000 to play every 3 seconds. If you set it true default speed will be 5 seconds.", "vp_textdomain")
				),		
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Item Count", "vp_textdomain"),
					"param_name" => "items",
					"value" => array("3", "1", "2", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16"),
					"admin_label" => true,
					"description" => esc_attr__("This variable allows you to set the maximum amount of items displayed at a time with the widest browser width.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Show Single Item?", "vp_textdomain"),
					"param_name" => "singleitem",
					"value" => array("false", "true"),
					"admin_label" => true,
					"description" => esc_attr__("Display only one item. Set Item Count to 1 to make it work as expected.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Slide Speed", "vp_textdomain"),
					"param_name" => "slidespeed",
					"value" => array("200", "100", "300", "400", "500", "600", "700", "800", "900", "1000", "1100", "1200", "1300", "1400", "1500", "1600", "1700", "1800", "1900", "2000"),
					"admin_label" => true,
					"description" => esc_attr__("Slide speed in milliseconds.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Auto Height", "vp_textdomain"),
					"param_name" => "autoheight",
					"value" => array("false", "true"),
					"admin_label" => true,
					"description" => esc_attr__("Add height to owl-wrapper-outer so you can use diffrent heights on slides. Use it only for one item per page setting.", "vp_textdomain")
				),		
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   )
		) );
	}


	/**
	* Owl Carousel Feeder
	*/
	if (!function_exists('ozy_vc_owlcarousel_feed')) {
		function ozy_vc_owlcarousel_feed( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_owlcarousel_feed', $atts);
			extract(shortcode_atts(array(
				'bg_color'		=> '',
				'link_caption' 	=> 'Find out more →',
				'link_target'	=> '',
				'default_overlay' => 'off',
				'autoplay'		=> '',
				'items'			=> '',
				'singleitem'	=> '',
				'slidespeed'	=> '',
				'autoheight'	=> '',
				'extra_css'		=> '',
				'css_animation' => ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		

			$output = '<div class="ozy-owlcarousel wpb_content_element with-feed '. $css_animation .'" data-autoplay="'. esc_attr($autoplay) .'" data-items="'. esc_attr($items) .'" data-singleitem="'. esc_attr($singleitem) .'" data-slidespeed="'. esc_attr($slidespeed) .'" data-paginationSpeed="800" data-autoheight="'. esc_attr($autoheight) .'">' . PHP_EOL;

			$args = array(
				'post_type' 			=> 'post',
				'posts_per_page'		=> '8',
				'orderby' 				=> 'date',
				'order' 				=> 'DESC',
				'ignore_sticky_posts' 	=> 1,							
				'meta_key' 				=> '_thumbnail_id'
			);

			$the_query = new WP_Query( $args );
				
			while ( $the_query->have_posts() ) {
				$the_query->the_post();

				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'showbiz');

				$style = esc_attr($bg_color) ? ' style="background-color:'. esc_attr($bg_color) .';" ' : ''; //height:278px;
				$output .= '<div class="item item-extended" '. $style .'>';
				if(isset($thumb[0])) {
					$output .= '<img class="lazyOwl" src="'. get_template_directory_uri() .'/images/blank-large.gif" data-src="'. esc_url($thumb[0]) .'" alt="'. get_the_title() .'"/>';
				}else{
					$output .= '<img class="lazyOwl" src="'. get_template_directory_uri() .'/images/blank-large.gif" data-src="'. get_template_directory_uri() .'/images/blank-large.gif" alt=""/>';
				}
				$output .= '<a href="'. get_permalink() .'" target="'. esc_attr($link_target) .'">';
				if(esc_attr($default_overlay) === 'on') {
					$output .= '<div class="overlay-two">';
					$output .= '<div>';
					$output .= '<h2>'. get_the_title() .'</h2>';
					$output .= '<h5>'. get_the_date() .'</h5>';
					$output .= '</div>';			
					$output .= '</div>';
				}
				$output .= '</a>';
				$output .= '</div>';			
			}
			wp_reset_postdata();
			
			$output.= do_shortcode( $content );
			$output.= PHP_EOL .'</div>';
			
			return $output;
		}
		
		add_shortcode('ozy_vc_owlcarousel_feed', 'ozy_vc_owlcarousel_feed');
		
		vc_map( array(
			"name" => esc_attr__("Owl Carousel Feed", "vp_textdomain"),
			"base" => "ozy_vc_owlcarousel_feed",
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Carousel Background", "vp_textdomain"),
					"param_name" => "bg_color",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Not requrired. Select a background color for your item.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Hover Overlay?", "vp_textdomain"),
					"param_name" => "default_overlay",
					"value" => array("off", "on"),
					"admin_label" => false,
					"description" => esc_attr__("ON/OFF default overlay on your items.", "vp_textdomain")
				),		
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link Caption", "vp_textdomain"),
					"param_name" => "link_caption",
					"admin_label" => true,
					"value" => esc_attr__("Find out more →", "vp_textdomain")
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				),					
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Auto Play", "vp_textdomain"),
					"param_name" => "autoplay",
					"value" => array("true", "false", "1000", "2000", "3000", "4000", "5000", "6000", "7000", "8000", "9000", "10000"),
					"admin_label" => true,
					"description" => esc_attr__("Change to any available integrer for example 3000 to play every 3 seconds. If you set it true default speed will be 5 seconds.", "vp_textdomain")
				),		
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Item Count", "vp_textdomain"),
					"param_name" => "items",
					"value" => array("3", "1", "2", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16"),
					"admin_label" => true,
					"description" => esc_attr__("This variable allows you to set the maximum amount of items displayed at a time with the widest browser width.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Show Single Item?", "vp_textdomain"),
					"param_name" => "singleitem",
					"value" => array("false", "true"),
					"admin_label" => true,
					"description" => esc_attr__("Display only one item. Set Item Count to 1 to make it work as expected.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Slide Speed", "vp_textdomain"),
					"param_name" => "slidespeed",
					"value" => array("200", "100", "300", "400", "500", "600", "700", "800", "900", "1000", "1100", "1200", "1300", "1400", "1500", "1600", "1700", "1800", "1900", "2000"),
					"admin_label" => true,
					"description" => esc_attr__("Slide speed in milliseconds.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Auto Height", "vp_textdomain"),
					"param_name" => "autoheight",
					"value" => array("false", "true"),
					"admin_label" => true,
					"description" => esc_attr__("Add height to owl-wrapper-outer so you can use diffrent heights on slides. Use it only for one item per page setting.", "vp_textdomain")
				),		
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   )
		) );
	}

	/**
	* Owl Carousel
	*/
	if (!function_exists('ozy_vc_owlcarousel_wrapper')) {
		function ozy_vc_owlcarousel_wrapper( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_owlcarousel_wrapper', $atts);
			extract(shortcode_atts(array(
				'autoplay'		=> 'true',
				'items'			=> '4',
				'singleitem'	=> 'false',
				'slidespeed'	=> '200',
				'autoheight'	=> 'false',
				'extra_css'		=> '',
				'css_animation' => '',
				'bullet_nav'	=> 'on'
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		

			return '<div class="ozy-owlcarousel '. (esc_attr($bullet_nav) != 'on' ? 'navigation-off' : '') .' '. $css_animation .'" data-autoplay="'. esc_attr($autoplay) .'" data-items="'. esc_attr($items) .'" data-singleitem="'. esc_attr($singleitem) .'" data-slidespeed="'. esc_attr($slidespeed) .'" data-paginationSpeed="800" data-autoheight="'. esc_attr($autoheight) .'">' . PHP_EOL . do_shortcode( $content ) . PHP_EOL .'</div>';
		}
		
		add_shortcode('ozy_vc_owlcarousel_wrapper', 'ozy_vc_owlcarousel_wrapper');
		
		vc_map( array(
			"name" => esc_attr__("Owl Carousel", "vp_textdomain"),
			"base" => "ozy_vc_owlcarousel_wrapper",
			"as_parent" => array('only' => 'ozy_vc_owlcarousel,ozy_vc_owlcarousel2,ozy_vc_owlcarousel_testimonial,ozy_vc_owlcarousel_infobox,ozy_vc_owlcarousel_forsale'),
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Auto Play", "vp_textdomain"),
					"param_name" => "autoplay",
					"value" => array("true", "false", "1000", "2000", "3000", "4000", "5000", "6000", "7000", "8000", "9000", "10000"),
					"admin_label" => true,
					"description" => esc_attr__("Change to any available integrer for example 3000 to play every 3 seconds. If you set it true default speed will be 5 seconds.", "vp_textdomain")
				),		
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Item Count", "vp_textdomain"),
					"param_name" => "items",
					"value" => array("4", "1", "2", "3", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16"),
					"admin_label" => true,
					"description" => esc_attr__("This variable allows you to set the maximum amount of items displayed at a time with the widest browser width.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Show Single Item?", "vp_textdomain"),
					"param_name" => "singleitem",
					"value" => array("false", "true"),
					"admin_label" => true,
					"description" => esc_attr__("Display only one item. Set Item Count to 1 to make it work as expected.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Slide Speed", "vp_textdomain"),
					"param_name" => "slidespeed",
					"value" => array("200", "100", "300", "400", "500", "600", "700", "800", "900", "1000", "1100", "1200", "1300", "1400", "1500", "1600", "1700", "1800", "1900", "2000"),
					"admin_label" => true,
					"description" => esc_attr__("Slide speed in milliseconds.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Auto Height", "vp_textdomain"),
					"param_name" => "autoheight",
					"value" => array("false", "true"),
					"admin_label" => true,
					"description" => esc_attr__("Add height to owl-wrapper-outer so you can use diffrent heights on slides. Use it only for one item per page setting.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Bullet Navigation", "vp_textdomain"),
					"param_name" => "bullet_nav",
					"value" => array("on", "off"),
					"admin_label" => true
				),		
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   ),
		   "js_view" => 'VcColumnView'
		) );
	}

	if (!function_exists('ozy_vc_owlcarousel_forsale')) {
		$GLOBALS['FOR_SALE_SLIDE_COUNT'] = 1;
		function ozy_vc_owlcarousel_forsale( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_owlcarousel_forsale', $atts);
			extract(shortcode_atts(array(
				'title' => '',
				'subtitle' => '',
				'tag' => '',
				'image' => '',
				'img_size'		=> 'full',
				'link'			=> '',
				'link_target'	=> ''
			), $atts));
			
			$img_size = strpos(strtolower(esc_attr($img_size)), "x") > -1 ? explode('x', esc_attr($img_size)) : $img_size;
			$output = ''; $rand_class_name = 'rand-class-' . rand(10, 10000);
			$thumb = wp_get_attachment_image_src($image, $img_size);		
			if(isset($thumb[0])) {
				$output .= '<div class="item owl-for-sale '. esc_attr($rand_class_name) .'">';
				if($link) {$output .= '<a href="'. esc_url($link) .'" target="'. esc_attr($link_target) .'">';}
				$output .= '<img src="'. esc_url($thumb[0]) .'" alt="'. esc_attr($img_size) .'"/>';
				if($link) {$output .= '</a>';}
				$output .= '<div class="overlay">';
				$output .= '<span><span>'. $tag .'</span></span>';
				$output .= '<h5>'. $title .'</h5>';
				$output .= '<p>'. $subtitle .'</p>';
				$output .= '</div>';
				$output .= '</div>';
			}
			$GLOBALS['FOR_SALE_SLIDE_COUNT'] = $GLOBALS['FOR_SALE_SLIDE_COUNT'] + 1;
			return $output;
		}

		add_shortcode( 'ozy_vc_owlcarousel_forsale', 'ozy_vc_owlcarousel_forsale' );
		
		vc_map( array(
			"name" => esc_attr__("For Sale Slide", "vp_textdomain"),
			"base" => "ozy_vc_owlcarousel_forsale",
			"content_element" => true,
			"as_child" => array('only' => 'ozy_vc_owlcarousel_wrapper,ozy_vc_owlcarousel_single_wrapper'),
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Sub Title", "vp_textdomain"),
					"param_name" => "subtitle",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Tag", "vp_textdomain"),
					"param_name" => "tag",
					"admin_label" => true,
					"value" => esc_attr__("FOR SALE", "vp_textdomain")
				),array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Image", "vp_textdomain"),
					"param_name" => "image",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Select an image to show as testimonial visual.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("Image size", "vp_textdomain"),
					"param_name" => "img_size",
					"value" => "full",
					"description" => esc_attr__("Enter image size. Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				)		
			)
		) );	
	}
	
	if (!function_exists('ozy_vc_owlcarousel_infobox')) {
		function ozy_vc_owlcarousel_infobox( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_owlcarousel_infobox', $atts);
			extract(shortcode_atts(array(
				'title' => '',
				'subtitle' => '',
				'testimonial_content' => '',
				'image' => '',
				'img_size'		=> 'full',
				'link'			=> '',
				'link_target'	=> '',
				'link_caption' 	=> '',
				'box_color'		=> '',
				'accent_color'	=> '',
				'header_button_color' => '',
				'heading_color' => '',
				'text_color'	=> ''
			), $atts));
			
			$img_size = strpos(strtolower(esc_attr($img_size)), "x") > -1 ? explode('x', esc_attr($img_size)) : $img_size;
			$output = ''; $rand_class_name = 'rand-class-' . rand(10, 10000);
			$thumb = wp_get_attachment_image_src($image, $img_size);		
			if(isset($thumb[0])) {
				//$output .= '<div class="item owl-big-info-box '. esc_attr($rand_class_name) .'"><img class="lazyOwl" data-src="'. esc_url($thumb[0]) .'" src="'. get_template_directory_uri() .'/images/blank-large.gif" alt="'. esc_attr($img_size) .'"/>';
				$output .= '<div class="item owl-big-info-box '. esc_attr($rand_class_name) .'"><img src="'. esc_url($thumb[0]) .'" alt="'. esc_attr($img_size) .'"/>';
				$output .= '<div><div><div>';
				$output .= '<h5>'. $subtitle .'<i class="oic-up-open-big"></i></h5>';
				$output .= '<div>';
				$output .= '<h2>'. $title .'</h2>';
				$output .= '<p>'. $testimonial_content;
				if(esc_attr($link)) {
					$output .= '<a href="'. esc_url($link) .'" target="'. esc_attr($link_target) .'">'. $link_caption .'</a>';
				}
				$output .= '</p>';
				$output .= '</div>';
				$output .= '</div></div></div></div>';
			}
			global $ozyHelper;
			if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;
			$ozyHelper->set_footer_style('.'. $rand_class_name .'>div>div>div>h5{background-color:'. esc_attr($header_button_color) .' !important;;color:'. esc_attr($accent_color) .' !important;;}');
			$ozyHelper->set_footer_style('.'. $rand_class_name .'>div>div>div>h5>i,.'. $rand_class_name .'>div>div>div>div>h2{color:'. esc_attr($heading_color) .' !important;;}');
			$ozyHelper->set_footer_style('.'. $rand_class_name .'>div>div>div>div>p{color:'. esc_attr($text_color) .' !important;}');
			$ozyHelper->set_footer_style('.'. $rand_class_name .'>div>div>div>div>p>a{background-color:'. esc_attr($accent_color) .' !important;;color:'. esc_attr($box_color) .' !important;}');
			$ozyHelper->set_footer_style('.'. $rand_class_name .'>div>div>div>div{background-color:'. esc_attr($ozyHelper->hex2rgba($box_color, '.95')) .' !important;}');
			
			return $output;
		}

		add_shortcode( 'ozy_vc_owlcarousel_infobox', 'ozy_vc_owlcarousel_infobox' );
		
		vc_map( array(
			"name" => esc_attr__("Slide With Info Box", "vp_textdomain"),
			"base" => "ozy_vc_owlcarousel_infobox",
			"content_element" => true,
			"as_child" => array('only' => 'ozy_vc_owlcarousel_wrapper'),
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Sub Title", "vp_textdomain"),
					"param_name" => "subtitle",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textarea",
					"holder" => "div",
					"class" => "",
					"heading" => esc_attr__("Content", "vp_textdomain"),
					"param_name" => "testimonial_content",
					"description" => esc_attr__("Testimonial content.", "vp_textdomain")
				),array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Image", "vp_textdomain"),
					"param_name" => "image",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Select an image to show as testimonial visual.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("Image size", "vp_textdomain"),
					"param_name" => "img_size",
					"value" => "full",
					"description" => esc_attr__("Enter image size. Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link Caption", "vp_textdomain"),
					"param_name" => "link_caption",
					"admin_label" => true,
					"value" => esc_attr__("GET IN TOUCH &rarr;", "vp_textdomain")
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Box Color", "vp_textdomain"),
					"param_name" => "box_color",
					"admin_label" => false,
					"value" => "#3c3c4a"
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Accent Color", "vp_textdomain"),
					"param_name" => "accent_color",
					"admin_label" => false,
					"value" => "#ffc000"
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Header Background / Button Text Color", "vp_textdomain"),
					"param_name" => "header_button_color",
					"admin_label" => false,
					"value" => "#000000"
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Heading Color", "vp_textdomain"),
					"param_name" => "heading_color",
					"admin_label" => false,
					"value" => "#ffffff"
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Text Color", "vp_textdomain"),
					"param_name" => "text_color",
					"admin_label" => false,
					"value" => "#aaaab5"
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
			)
		) );	
	}
	
	if (!function_exists('ozy_vc_owlcarousel')) {
		function ozy_vc_owlcarousel( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_owlcarousel', $atts);
			extract(shortcode_atts(array(
				'src' 			=> '',
				'img_size'		=> 'full',
				'link'			=> '',
				'link_target'	=> ''
			), $atts));

			$output = '';

			$img_size = strpos(strtolower(esc_attr($img_size)), "x") > -1 ? explode('x', esc_attr($img_size)) : $img_size;
			$thumb = wp_get_attachment_image_src($src, $img_size);

			if(isset($thumb[0])) {
				if(esc_attr($link)) $output = '<a href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'">';
				$output .= '<div class="item"><img class="lazyOwl" data-src="'. esc_url($thumb[0]) .'" src="'. get_template_directory_uri() .'/images/blank-large.gif" alt="'. esc_attr($img_size) .'"/></div>';
				if(esc_attr($link)) $output .= '</a>';
			}
			
			return $output;
		}
		
		add_shortcode('ozy_vc_owlcarousel', 'ozy_vc_owlcarousel');

		vc_map( array(
			"name" => esc_attr__("Owl Carousel Item", "vp_textdomain"),
			"base" => "ozy_vc_owlcarousel",
			"content_element" => true,
			"as_child" => array('only' => 'ozy_vc_owlcarousel_wrapper'),
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Carousel Image", "vp_textdomain"),
					"param_name" => "src",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Select images for your slider.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("Image size", "vp_textdomain"),
					"param_name" => "img_size",
					"value" => "full",
					"description" => esc_attr__("Enter image size. Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				),$add_css_animation
		   )
		) );
	}

	if (!function_exists('ozy_vc_owlcarousel2')) {
		function ozy_vc_owlcarousel2( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_owlcarousel2', $atts);
			extract(shortcode_atts(array(
				'src' 			=> '',
				'bg_color'		=> '',
				'icon' 			=> '',
				'icon_src'		=> '',
				'title' 		=> '',
				'excerpt' 		=> '',
				'link_caption' 	=> 'Find out more →',
				'link' 			=> '',
				'link_target'	=> '_self',
				'img_size'		=> 'full',
				'default_overlay' => 'off',
				'overlay_bg' 	=> '',
				'title_size'	=> 'h2'
			), $atts));

			$output = '';

			$img_size = strpos(strtolower(esc_attr($img_size)), "x") > -1 ? explode('x', esc_attr($img_size)) : $img_size;
			$thumb = wp_get_attachment_image_src($src, $img_size);

			$style = esc_attr($bg_color) ? ' style="background-color:'. esc_attr($bg_color) .';" ' : ''; //height:278px;
			$output = '<div class="item item-extended" '. $style .'>';
			if(isset($thumb[0])) {
				$output .= '<img src="'. esc_url($thumb[0]) .'" alt=""/>';
			}else{
				$output .= '<img src="'. get_template_directory_uri() .'/images/blank-large.gif" alt=""/>';
			}
			$output .= '<a'. ($link ? ' href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'"':'') .'>';
			$output .= '<div class="overlay-one '.(esc_attr($default_overlay) === 'on' ? 'overlay-one-bg' : '').'">';
			if(esc_attr($icon_src)) {// && isset($icon_thumb[0])
				$icon_thumb = wp_get_attachment_image_src($icon_src, 'full');
				$output .= '<span><img src="'. esc_url($icon_thumb[0]) .'" alt="'. esc_attr($title) .'"/></span>';
			}else{
				if(esc_attr($icon)){
					$output .= '<span class="'. esc_attr($icon) .'"></span>';
				}else{
					$output .= '<'. $title_size .'>'. esc_attr($title) .'</'. $title_size .'>';
				}
			}
			$output .= '</div>';
			$output .= '<div class="overlay-two"'. ($overlay_bg ? ' style="background-color:'. esc_attr($overlay_bg) .'"':'') .'>';
			$output .= '<p>'. esc_attr($excerpt);
			if($link) {
				$output .= '<span>'. esc_attr($link_caption) .'</span>';
			}
			$output .= '</p>';
			$output .= '</div>';
			$output .= '</a>';
			$output .= '</div>';

			
			return $output;
		}
		
		add_shortcode('ozy_vc_owlcarousel2', 'ozy_vc_owlcarousel2');

		vc_map( array(
			"name" => esc_attr__("Owl Carousel Extended Item", "vp_textdomain"),
			"base" => "ozy_vc_owlcarousel2",
			"content_element" => true,
			"as_child" => array('only' => 'ozy_vc_owlcarousel_wrapper'),
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Carousel Image", "vp_textdomain"),
					"param_name" => "src",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Select images for your slider.", "vp_textdomain")
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Carousel Background", "vp_textdomain"),
					"param_name" => "bg_color",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Not requrired. Select a background color for your item.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "select_an_icon",
					"heading" => esc_attr__("or Icon", "vp_textdomain"),
					"param_name" => "icon",
					"value" => '',
					"admin_label" => false,
					"description" => esc_attr__("Once you select an Icon, title will not be shown on overlay.", "vp_textdomain")
				),array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("or Image Icon", "vp_textdomain"),
					"param_name" => "icon_src",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Once you select an Image Icon, title or Icon will not be shown on overlay.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("Image size", "vp_textdomain"),
					"param_name" => "img_size",
					"value" => "full",
					"description" => esc_attr__("Enter image size. Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "vp_textdomain")
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Default Overlay?", "vp_textdomain"),
					"param_name" => "default_overlay",
					"value" => array("off", "on", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("ON/OFF default overlay on your items.", "vp_textdomain")
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Overlay Background Color", "vp_textdomain"),
					"param_name" => "overlay_bg",
					"value" => "",
					"admin_label" => false
				),array(
					"type" => "textarea",
					"class" => "",
					"heading" => esc_attr__("Excerpt", "vp_textdomain"),
					"param_name" => "excerpt",
					"admin_label" => false,
					"value" => ""
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link Caption", "vp_textdomain"),
					"param_name" => "link_caption",
					"admin_label" => true,
					"value" => esc_attr__("Find out more →", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				)
		   )
		) );
	}
	
	if (!function_exists('ozy_vc_owlcarousel_testimonial')) {
		function ozy_vc_owlcarousel_testimonial( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_owlcarousel_testimonial', $atts);
			extract(shortcode_atts(array(
				'src' 			=> '',
				'img_size'		=> 'full',
				'bg_color'		=> '',
				'title' 		=> '',
				'sub_title'		=> '',
				'excerpt' 		=> '',
				'profile_src'	=> '',
				'link' 			=> '',
				'link_target'	=> '_self'
			), $atts));

			$output = ''; $bg_style = '';

			$img_size = strpos(strtolower(esc_attr($img_size)), "x") > -1 ? explode('x', esc_attr($img_size)) : $img_size;
			$thumb = wp_get_attachment_image_src($src, $img_size);

			$style = esc_attr($bg_color) ? ' style="background-color:'. esc_attr($bg_color) .';" ' : '';
			$output = '<div class="item item-extended testimonial" '. $style .'><div class="overlay-one">';
			//$output .= '<a'. ($link ? ' href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'"':'') .'>';
			
			if(isset($thumb[0])) {
				//$output .= '<img src="'. esc_url($thumb[0]) .'" alt=""/>';
				$bg_style = ' style="background:url('. esc_url($thumb[0]) .');" ';
			}else{
				//$output .= '<img src="'. get_template_directory_uri() .'/images/blank-large.gif" alt=""/>';
				$bg_style = ' style="background:url('. get_template_directory_uri() .'/images/blank-large.gif);" ';
			}
			$output .= '<a'. ($link ? ' href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'"':'') .' '. $bg_style .'>';

			$output .= '<div class="one"><i class="oic-quote-1 icon-1"></i>';
			$output .= esc_attr($excerpt);
			$output .= '<i class="oic-quote-1 icon-2"></i>';
			$output .= '</div>';
			$output .= '<div class="two">';
			if($profile_src) {
				$profile_thumb = wp_get_attachment_image_src($profile_src, 'thumbnail');
				if(isset($profile_thumb[0])) {
					$output .= '<img src="'. esc_url($profile_thumb[0]) .'" class="profile-pic" alt=""/>';
				}
			}
			$output .= '<span><strong>'. esc_attr($title) . '</strong>';
			$output .= '<br/>'. esc_attr($sub_title) .'</span>';
			$output .= '</div>';

			$output .= '</a>';

			$output .= '</div></div>';

			
			return $output;
		}
		
		add_shortcode('ozy_vc_owlcarousel_testimonial', 'ozy_vc_owlcarousel_testimonial');

		vc_map( array(
			"name" => esc_attr__("Owl Carousel Testimonial Item", "vp_textdomain"),
			"base" => "ozy_vc_owlcarousel_testimonial",
			"content_element" => true,
			"as_child" => array('only' => 'ozy_vc_owlcarousel_wrapper'),
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Carousel Background Image", "vp_textdomain"),
					"param_name" => "src",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Select images for your slider.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("Image size", "vp_textdomain"),
					"param_name" => "img_size",
					"value" => "full",
					"description" => esc_attr__("Enter image size. Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "vp_textdomain")
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Carousel Background", "vp_textdomain"),
					"param_name" => "bg_color",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Not requrired. Select a background color for your item.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Sub Title", "vp_textdomain"),
					"param_name" => "sub_title",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textarea",
					"class" => "",
					"heading" => esc_attr__("Excerpt", "vp_textdomain"),
					"param_name" => "excerpt",
					"admin_label" => false,
					"value" => ""
				),array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Profile Picture", "vp_textdomain"),
					"param_name" => "profile_src",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Select a picture to use as profile picture of testimonial's writer.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				)
		   )
		) );
	}	

	class WPBakeryShortCode_Ozy_Vc_Owlcarousel_Wrapper extends WPBakeryShortCodesContainer{}
	class WPBakeryShortCode_Ozy_Vc_Owlcarousel extends WPBakeryShortCode{}
	class WPBakeryShortCode_Ozy_Vc_Owlcarousel2 extends WPBakeryShortCode{}
	class WPBakeryShortCode_Ozy_Vc_Owlcarousel_testimonial extends WPBakeryShortCode{}
	class WPBakeryShortCode_Ozy_Vc_Owlcarousel_forsale extends WPBakeryShortCode{}	
	class WPBakeryShortCode_Ozy_Vc_Owlcarousel_infobox extends WPBakeryShortCode{}	

	/**
	* Owl Carousel Single
	*/
	if (!function_exists('ozy_vc_owlcarousel_single_wrapper')) {
		function ozy_vc_owlcarousel_single_wrapper( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_owlcarousel_single_wrapper', $atts);
			extract(shortcode_atts(array(
				'autoplay'		=> 'true',
				'items'			=> '1',
				'singleitem'	=> 'true',
				'slidespeed'	=> '200',
				'autoheight'	=> 'false',
				'extra_css'		=> '',
				'css_animation' => '',
				'bullet_nav'	=> 'on'
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		

			return '<div class="ozy-owlcarousel single '. 'navigation-'. esc_attr($bullet_nav) .' '. $css_animation .'" data-autoplay="'. esc_attr($autoplay) .'" data-items="'. esc_attr($items) .'" data-singleitem="'. esc_attr($singleitem) .'" data-slidespeed="'. esc_attr($slidespeed) .'" data-paginationSpeed="800" data-autoheight="'. esc_attr($autoheight) .'">' . PHP_EOL . do_shortcode( $content ) . PHP_EOL .'</div>';
		}
		
		add_shortcode('ozy_vc_owlcarousel_single_wrapper', 'ozy_vc_owlcarousel_single_wrapper');
		
		vc_map( array(
			"name" => esc_attr__("Simple Slider", "vp_textdomain"),
			"base" => "ozy_vc_owlcarousel_single_wrapper",
			"as_parent" => array('only' => 'ozy_vc_owlcarousel_single,ozy_vc_owlcarousel_forsale'),
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Auto Play", "vp_textdomain"),
					"param_name" => "autoplay",
					"value" => array("true", "false", "1000", "2000", "3000", "4000", "5000", "6000", "7000", "8000", "9000", "10000"),
					"admin_label" => true,
					"description" => esc_attr__("Change to any available integrer for example 3000 to play every 3 seconds. If you set it true default speed will be 5 seconds.", "vp_textdomain")
				),		
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Slide Speed", "vp_textdomain"),
					"param_name" => "slidespeed",
					"value" => array("200", "100", "300", "400", "500", "600", "700", "800", "900", "1000", "1100", "1200", "1300", "1400", "1500", "1600", "1700", "1800", "1900", "2000"),
					"admin_label" => true,
					"description" => esc_attr__("Slide speed in milliseconds.", "vp_textdomain")
				),
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Navigation", "vp_textdomain"),
					"param_name" => "bullet_nav",
					"value" => array("on", "arrows", "off"),
					"admin_label" => true
				),		
				$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   ),
		   "js_view" => 'VcColumnView'
		) );
	}

	if (!function_exists('ozy_vc_owlcarousel_single')) {
		function ozy_vc_owlcarousel_single( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_owlcarousel_single', $atts);
			extract(shortcode_atts(array(
				'src' 				=> '',
				'img_size'			=> 'full',
				'link'				=> '',
				'link_caption'		=> 'Find Out More',
				'link_target'		=> '',
				'caption'			=> '',
				'excerpt'			=> '',
				'caption_position'	=> '',
				'fn_color'			=> '#ffffff',
				'link_style'		=> 'frame'
			), $atts));

			$output = '';

			$img_size = strpos(strtolower(esc_attr($img_size)), "x") > -1 ? explode('x', esc_attr($img_size)) : $img_size;
			$thumb = wp_get_attachment_image_src($src, $img_size);
			$rand_id = 'owl-item-' . rand(1, 10000);
			
			if(isset($thumb[0])) {
				$output .= '<div class="item '. $rand_id .'" style="width:'. esc_attr($thumb[1]) .'px;height:'. esc_attr($thumb[2]) .'px">';
				$output .= '<img src="'. esc_url($thumb[0]) .'" alt="'. esc_attr($img_size) .'"/>';
				$output .= '<div class="caption">';
				if($caption || $excerpt) {
					$output .= '<h1>'. esc_html($caption) .'</h1>'. ($excerpt ? '<p>'. $excerpt .'</p>' : '');
				}
				if(esc_attr($link)) {
					$output .= '<a href="'. esc_attr($link) .'" target="'. esc_attr($link_target) .'" class="'. esc_attr($link_style) .'">'. $link_caption .'</a>';
				}
				$output .= '</div>';
				$output .= '</div>';
				
				global $ozyHelper;
				if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;
				$ozyHelper->set_footer_style('.' . $rand_id . ' .caption{text-align:'. esc_attr($caption_position) .'}');
				$ozyHelper->set_footer_style('.' . $rand_id . ' .caption a{border-color:'. esc_attr($fn_color) .';}');
				$ozyHelper->set_footer_style('.' . $rand_id . ' .caption h1,.' . $rand_id . ' .caption p,.' . $rand_id . ' .caption a{color:'. esc_attr($fn_color) .' !important;}');
			}			
			return $output;
		}
		
		add_shortcode('ozy_vc_owlcarousel_single', 'ozy_vc_owlcarousel_single');

		vc_map( array(
			"name" => esc_attr__("Simple Slider - Slide", "vp_textdomain"),
			"base" => "ozy_vc_owlcarousel_single",
			"content_element" => true,
			"as_child" => array('only' => 'ozy_vc_owlcarousel_single_wrapper'),
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Carousel Image", "vp_textdomain"),
					"param_name" => "src",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Select images for your slider.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("Image size", "vp_textdomain"),
					"param_name" => "img_size",
					"value" => "full",
					"description" => esc_attr__("Enter image size. Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "vp_textdomain")
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Foreground Color", "vp_textdomain"),
					"param_name" => "fn_color",
					"admin_label" => false,
					"value" => "#ffffff"
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Caption", "vp_textdomain"),
					"param_name" => "caption",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Excerpt", "vp_textdomain"),
					"param_name" => "excerpt",
					"admin_label" => false,
					"value" => ""
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Caption Position", "vp_textdomain"),
					"param_name" => "caption_position",
					"value" => array("left", "right", "center"),
					"admin_label" => false
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link Caption", "vp_textdomain"),
					"param_name" => "link_caption",
					"admin_label" => true,
					"value" => esc_attr__("Find Out More", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Target", "vp_textdomain"),
					"param_name" => "link_target",
					"value" => array("_self", "_blank", "_parent"),
					"admin_label" => false,
					"description" => esc_attr__("Select link target window.", "vp_textdomain")
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Link Style", "vp_textdomain"),
					"param_name" => "link_style",
					"value" => array("frame", "generic-button"),
					"admin_label" => false
				)
		   )
		) );
	}

	class WPBakeryShortCode_Ozy_Vc_Owlcarousel_single_Wrapper extends WPBakeryShortCodesContainer{}
	class WPBakeryShortCode_Ozy_Vc_Owlcarousel_single extends WPBakeryShortCode{}

	/**
	* Counter
	*/
	if (!function_exists('ozy_vc_count_to')) {
		function ozy_vc_count_to( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_count_to', $atts);
			extract(shortcode_atts(array(
				'color' 		=> '#000000',
				'from'			=> 0,
				'to'			=> 100,
				'subtitle' 		=> '',
				'sign'			=> '',
				'signpos'		=> 'right',
				'css_animation' => ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}		
			
			return '<div class="ozy-counter wpb_content_element '. $css_animation .'" style="color:'. esc_attr($color) .'"><div class="timer" data-sign="'. esc_attr($sign) .'" data-signpos="'. esc_attr($signpos) .'" data-from="'. esc_attr($from) .'" data-to="'. esc_attr($to) .'">'. esc_attr($from) .'</div><div class="hr" style="background-color:'. esc_attr($color) .'"></div>'. (esc_attr($subtitle) ? '<span>'. esc_attr($subtitle) .'</span>' : '') .'</div>';
		}
		
		add_shortcode('ozy_vc_count_to', 'ozy_vc_count_to');
		
		vc_map( array(
			"name" => esc_attr__("Count To", "vp_textdomain"),
			"base" => "ozy_vc_count_to",
			"icon" => "",
			"class" => '',
			"controls" => "full",
			'category' => 'by OZY',
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Sub Title", "vp_textdomain"),
					"param_name" => "subtitle",
					"admin_label" => true,
					"value" => "",
					"description" => esc_attr__("Counter title.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("From", "vp_textdomain"),
					"param_name" => "from",
					"admin_label" => true,
					"value" => "0",
					"description" => esc_attr__("Counter start from", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("To", "vp_textdomain"),
					"param_name" => "to",
					"admin_label" => true,
					"value" => "100",
					"description" => esc_attr__("Counter count to", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Sign", "vp_textdomain"),
					"param_name" => "sign",
					"admin_label" => true,
					"value" => "",
					"description" => esc_attr__("Enter a sign like % or whatever you like", "vp_textdomain")
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Sign Position", "vp_textdomain"),
					"param_name" => "signpos",
					"value" => array('right', 'left'),
					"admin_label" => false,
					"description" => esc_attr__("Select position of your sign.", "vp_textdomain")
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Forecolor", "vp_textdomain"),
					"param_name" => "color",
					"value" => "#000000",
					"admin_label" => false
				),$add_css_animation
		   )
		) );	
	}

	/**
	* Twitter Slider
	*/
	if (!function_exists('ozy_vc_twitter_ticker')) {
		function ozy_vc_twitter_ticker( $atts, $content = null ) {
		
			$essentials_options = get_option('ozy_buildme_essentials');
			if( is_array($essentials_options) && 
				isset($essentials_options['twitter_consumer_key']) && 
				isset($essentials_options['twitter_secret_key']) &&
				isset($essentials_options['twitter_token_key']) &&
				isset($essentials_options['twitter_token_secret_key']) ) 
			{
			    $atts = vc_map_get_attributes('ozy_vc_twitter_ticker', $atts);
				extract(shortcode_atts(array(
					'count' => '10',
					'screenname' => 'ozythemes',
					'forecolor' => ''
				), $atts));		
				
				require_once("classes/ozy_twitteroauth.php"); //Path to twitteroauth library
				
				if(!function_exists('getConnectionWithAccessToken')) {
					function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
						$connection = new Ozy_TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
						return $connection;
					}
				}

				$connection = getConnectionWithAccessToken(
					$essentials_options['twitter_consumer_key'],
					$essentials_options['twitter_secret_key'],
					$essentials_options['twitter_token_key'],
					$essentials_options['twitter_token_secret_key']
				);
				 
				$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=". esc_attr($screenname) ."&count=". esc_attr($count));

				if(!function_exists('makeLinks')) {
					function makeLinks($str) {    
						return preg_replace('/(https?):\/\/([A-Za-z0-9\._\-\/\?=&;%,]+)/i', '<a href="$1://$2" target="_blank">$1://$2</a>', $str);
					}
				}

				$output = '';
				if(is_array($tweets)) {
					foreach($tweets as $tweet) {
						$h_time = sprintf( esc_attr__('%s ago', 'vp_textdomain'), human_time_diff( date( 'U', strtotime( $tweet->created_at ) )));

						$output .= '<div>';
						$output .= '<div class="testimonial" style="color:'. esc_attr($forecolor) .'">'. makeLinks($tweet->text) .'<br>'. $h_time  .'</div>';
						$output .= '<div class="info">';
						$output .= '<span class="thumb"><span><img src="'. esc_url($tweet->user->profile_image_url) .'" alt="'. esc_attr($tweet->user->screen_name) .'"/></span></span>';
						$output .= '<span class="username"><a href="'. esc_url('http://twitter.com/' . $tweet->user->screen_name) .'" style="color:'. esc_attr($forecolor) .'" target="_blank">'. $tweet->user->screen_name .'</a></span>';
						$output .= '</div>';
						$output .= '</div>';
					}
									
					return '<div class="ozy-owlcarousel ozy-testimonials wpb_content_element" data-autoplay="true" data-items="1" data-singleitem="true" data-slidespeed="400" data-paginationSpeed="800" data-autoheight="false">' . PHP_EOL . $output . PHP_EOL .'</div>';
				}else{
					return 'Possible Twitter data error.';
				}
			}
			
			return '<p>**Required Twitter parameters are not supplied. Please go to your admin panel, Settings > ozy Essentials.**</p>';
		}

		add_shortcode('ozy_vc_twitter_ticker', 'ozy_vc_twitter_ticker');
		
		vc_map( array(
			"name" => esc_attr__("Twitter Slider", "vp_textdomain"),
			"base" => "ozy_vc_twitter_ticker",
			"content_element" => true,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("ForeColor", "vp_textdomain"),
					"param_name" => "forecolor",
					"value" => "",
					"admin_label" => false,
					"description" => esc_attr__("Font color for rest of the slider", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Count", "vp_textdomain"),
					"param_name" => "count",
					"admin_label" => true,
					"value" => "10"
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Screenname", "vp_textdomain"),
					"param_name" => "screenname",
					"admin_label" => true,
					"value" => "ozythemes"
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)
			)
		) );	
	}

	/**
	* Extended Testimonials Slider
	*/
	if (!function_exists('ozy_vc_extended_testimonials')) {
		function ozy_vc_extended_testimonials( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_extended_testimonials', $atts);
			extract(shortcode_atts(array(
				'forecolor' => ''
			), $atts));
			
			wp_enqueue_script('flexslider');
			wp_enqueue_script('masonry');
			wp_enqueue_style('extended-testimonial-slider');

			global $ozyHelper;
			if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;
			$ozyHelper->set_footer_html('<div class="ozy-testimonials-all content-font"><div class="ozy-testimonials-all-wrapper"><ul>'. do_shortcode($content) .'</ul></div><a href="#0" class="ozy-close-btn"><i class="oic-pe-icon-7-stroke-139">&nbsp;</i></a></div>');
			return '<div class="ozy-testimonials-wrapper ozy-container"><ul class="ozy-testimonials-extended">'. do_shortcode($content) .'</ul><a href="#0" class="ozy-see-all">'. esc_attr__('See all', 'vp_textdomain'). '</a></div>';
		}

		add_shortcode('ozy_vc_extended_testimonials', 'ozy_vc_extended_testimonials');

		vc_map( array(
			"name" => esc_attr__("Extended Testimonials Slider", "vp_textdomain"),
			"base" => "ozy_vc_extended_testimonials",
			"as_parent" => array('only' => 'ozy_vc_extended_testimonial'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)
			),
			"js_view" => 'VcColumnView'
		) );
	}

	if (!function_exists('ozy_vc_extended_testimonial')) {
		function ozy_vc_extended_testimonial( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_extended_testimonial', $atts);
			extract(shortcode_atts(array(
				'title' => '',
				'subtitle' => '',
				'testimonial_content' => '',
				'image' => ''
			), $atts));
			
			$member_image = wp_get_attachment_image_src($image, 'medium');		
			$output = '
			<li class="ozy-testimonials-item">
				<p>'. do_shortcode($testimonial_content) .'</p>
				<div class="ozy-author">';
			if(isset($member_image[0])) {
				$output .= '<img src="'. esc_url($member_image[0]) .'" alt="' . esc_attr($title) . '">';
			}
			$output.='<ul class="ozy-author-info">
						<li>'. esc_attr($title) .'</li>
						<li>'. esc_attr($subtitle) .'</li>
					</ul>
				</div>
			</li>';	
			
			return $output;
		}

		add_shortcode( 'ozy_vc_extended_testimonial', 'ozy_vc_extended_testimonial' );
		
		vc_map( array(
			"name" => esc_attr__("Testimonial", "vp_textdomain"),
			"base" => "ozy_vc_extended_testimonial",
			"content_element" => true,
			"as_child" => array('only' => 'ozy_vc_extended_testimonials'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Sub Title", "vp_textdomain"),
					"param_name" => "subtitle",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textarea",
					"holder" => "div",
					"class" => "",
					"heading" => esc_attr__("Content", "vp_textdomain"),
					"param_name" => "testimonial_content",
					"description" => esc_attr__("Testimonial content.", "vp_textdomain")
				),array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Image", "vp_textdomain"),
					"param_name" => "image",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Select an image to show as testimonial visual.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)
			)
		) );	
	}

	//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
	class WPBakeryShortCode_Ozy_Vc_Extended_testimonials extends WPBakeryShortCodesContainer{}
	class WPBakeryShortCode_Ozy_Vc_Extended_testimonial extends WPBakeryShortCode{}	
	
	/**
	* Testimonials
	*/
	if (!function_exists('ozy_vc_testimonials')) {
		function ozy_vc_testimonials( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_testimonials', $atts);
			extract(shortcode_atts(array(
				'forecolor' => ''
			), $atts));		
			
			$GLOBALS['OZY_TESTIMONIAL_SLIDER_FORECOLOR'] = esc_attr($forecolor);
			
			return '<div class="ozy-owlcarousel ozy-testimonials wpb_content_element" data-autoplay="true" data-items="1" data-singleitem="true" data-slidespeed="400" data-paginationSpeed="800" data-autoheight="false">' . PHP_EOL . do_shortcode( $content ) . PHP_EOL .'</div>';
		}

		add_shortcode('ozy_vc_testimonials', 'ozy_vc_testimonials');

		vc_map( array(
			"name" => esc_attr__("Testimonials Slider", "vp_textdomain"),
			"base" => "ozy_vc_testimonials",
			"as_parent" => array('only' => 'ozy_vc_testimonial'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "icon-wpb-ozy-el",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "colorpicker",
					"heading" => esc_attr__("ForeColor", "vp_textdomain"),
					"param_name" => "forecolor",
					"value" => "",
					"admin_label" => false,
					"description" => esc_attr__("Font color for rest of the slider", "vp_textdomain")
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)
			),
			"js_view" => 'VcColumnView'
		) );
	}

	if (!function_exists('ozy_vc_testimonial')) {
		function ozy_vc_testimonial( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_testimonial', $atts);
			extract(shortcode_atts(array(
				'title' => '',
				'subtitle' => '',
				'testimonial_content' => '',
				'image' => ''
			), $atts));
			
			$output  = '<div style="'. ($GLOBALS['OZY_TESTIMONIAL_SLIDER_FORECOLOR'] ? 'color:' . $GLOBALS['OZY_TESTIMONIAL_SLIDER_FORECOLOR'] : '') .'">';
			$output .= '<div class="testimonial">'. do_shortcode( $testimonial_content ) .'</div>';
			$output .= '<div class="info">';		
			$member_image = wp_get_attachment_image_src($image, 'medium');
			if(isset($member_image[0])) {
				$output .= '<div class="thumb"><span><img src="'. esc_url($member_image[0]) .'" alt="' . esc_attr($title) . '"/></span></div>';
			}
			$output .= '<div class="itext">';
			if(!empty($title)) $output .= '<strong>' . esc_attr($title) . '</strong>';
			if(!empty($subtitle)) $output .= '<br/><small>' . esc_attr($subtitle) . '</small>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			
			return $output;
		}

		add_shortcode( 'ozy_vc_testimonial', 'ozy_vc_testimonial' );
		
		vc_map( array(
			"name" => esc_attr__("Testimonial", "vp_textdomain"),
			"base" => "ozy_vc_testimonial",
			"content_element" => true,
			"as_child" => array('only' => 'ozy_vc_testimonials'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Sub Title", "vp_textdomain"),
					"param_name" => "subtitle",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textarea",
					"holder" => "div",
					"class" => "",
					"heading" => esc_attr__("Content", "vp_textdomain"),
					"param_name" => "testimonial_content",
					"description" => esc_attr__("Testimonial content.", "vp_textdomain")
				),array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Image", "vp_textdomain"),
					"param_name" => "image",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Select an image to show as testimonial visual.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)
			)
		) );	
	}

	//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
	class WPBakeryShortCode_Ozy_Vc_Testimonials extends WPBakeryShortCodesContainer{}
	class WPBakeryShortCode_Ozy_Vc_Testimonial extends WPBakeryShortCode{}

	/**
	* Icon Title with Content
	*/
	if(!function_exists('ozy_title_with_icon_func')) {
		function ozy_title_with_icon_func( $atts, $content=null ) {
            $atts = vc_map_get_attributes('title_with_icon', $atts);
			extract( shortcode_atts( array(
				  'icon' => '',
				  'icon_size' => 'medium',
				  'icon_position' => 'left',
				  'size' => 'h1',
				  'title' => '',
				  'icon_type' => '',
				  'icon_color' => '',
				  'text_color' => '',
				  'icon_bg_color' => 'transparent',
				  'icon_shadow_color' => '',
				  'go_link' => '',
				  'go_target' => '_self',
				  'connected' => 'no',
				  'dot_bg_color' => 'transparent'
				), $atts ) 
			);

			global $ozyHelper;
			if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;
			$element_id = 'tile-with-icon_icon' . rand(100,10000);
			$a_begin = $a_end = $add_style = "";
			if(trim($go_link) !== '') {
				$a_begin = '<a href="' . esc_attr($go_link) . '" '. ($go_target=='fancybox' || $go_target=='fancybox-media' ? 'class':'target') .'="' . esc_attr($go_target) . '">';
				$a_end   = '</a>';
			}

			if($icon_type === 'circle') {
				$icon_bg_color = 'transparent';
				$add_style = 'border-color:'. esc_attr($icon_color) .';';
			}
			
			$o_icon = ($icon ? $a_begin . '<span ' . ($icon_color ? ' style="'. $add_style .'color:'. esc_attr($icon_color) .' !important;background-color:'. esc_attr($icon_bg_color) .' !important;"' : '') . ' class="' . esc_attr($icon) . ' ' . esc_attr($icon_type) . ' ' . esc_attr($icon_size) . ' ' . '" '. (esc_attr($icon_shadow_color) ? 'data-color="'. esc_attr($icon_shadow_color) .'"':'') .'></span>' . $a_end : '');
			
			return '<div id="'. $element_id .'" class="title-with-icon-wrapper '. esc_attr($icon_type) . ' ' . esc_attr($icon_size) .' '. (esc_attr($connected) === 'yes' ? 'connected' : '') .'" data-color="'. esc_attr($dot_bg_color) .'"><div class="wpb_content_element title-with-icon clearfix ' . (trim($content) !== '' ? 'margin-bottom-0 ' : '') . ($icon_position === 'top' ? 'top-style' : '') . '">' . $o_icon . '<' . $size . (!$text_color ? (!$icon ? ' class="no-icon content-color"' : ' class="content-color"'):'') . ' style="'. ($text_color ? 'color:' . esc_attr($text_color) : '') .'">' . $a_begin . $title . $a_end . '</' . $size . '></div>' . (trim($content) !== '' ? '<div class="wpb_content_element '. esc_attr($icon_position) .'-cs title-with-icon-content '. esc_attr($icon_size) .' clearfix" style="'. (esc_attr($text_color) ? 'color:' . esc_attr($text_color) : '') .'">' . wpb_js_remove_wpautop(do_shortcode($content)) . '</div>' : '') . '</div>';
		}
		
		add_shortcode( 'title_with_icon', 'ozy_title_with_icon_func' );
		
		vc_map( array(
			"name" => esc_attr__("Title With Icon", "vp_textdomain"),
			"base" => "title_with_icon",
			"class" => "",
			"controls" => "full",
			'category' => 'by OZY',
			"icon" => "icon-wpb-ozy-el",
			"params" => array(
			  array(
				"type" => "select_an_icon",
				"heading" => esc_attr__("Icon", "vp_textdomain"),
				"param_name" => "icon",
				"value" => '',
				"admin_label" => false,
				"description" => esc_attr__("Title heading style.", "vp_textdomain")
			  ),array(
				"type" => "dropdown",
				"heading" => esc_attr__("Icon Size", "vp_textdomain"),
				"param_name" => "icon_size",
				"value" => array(esc_attr__("medium", "vp_textdomain") => "medium", esc_attr__("large", "vp_textdomain") => "large", esc_attr__("xlarge", "vp_textdomain") => "xlarge", esc_attr__("xxlarge", "vp_textdomain") => "xxlarge", esc_attr__("xxxlarge", "vp_textdomain") => "xxxlarge"),
				"admin_label" => false,
				"description" => esc_attr__("Size of the Icon.", "vp_textdomain")
			  ),array(
				"type" => "dropdown",
				"heading" => esc_attr__("Icon Position", "vp_textdomain"),
				"param_name" => "icon_position",
				"value" => array(esc_attr__("left", "vp_textdomain") => "left", esc_attr__("top", "vp_textdomain") => "top"),
				"admin_label" => false,
				"description" => esc_attr__("Position of the Icon.", "vp_textdomain")
			  ),array(
				"type" => "colorpicker",
				"heading" => esc_attr__("Icon Alternative Color", "vp_textdomain"),
				"param_name" => "icon_color",
				"value" => "",
				"admin_label" => false,
				"description" => esc_attr__("This field is not required.", "vp_textdomain")
			  ),array(
				"type" => "dropdown",
				"heading" => esc_attr__("Icon Background Type", "vp_textdomain"),
				"param_name" => "icon_type",
				"value" => array(esc_attr__("rectangle", "vp_textdomain") => "rectangle", esc_attr__("rounded", "vp_textdomain") => "rounded", esc_attr__("circle", "vp_textdomain") => "circle", esc_attr__("clear", "vp_textdomain") => "clear"),
				"admin_label" => false,
				"description" => esc_attr__("Position of the Icon.", "vp_textdomain")
			  ),array(
				"type" => "colorpicker",
				"heading" => esc_attr__("Icon Background Color", "vp_textdomain"),
				"param_name" => "icon_bg_color",
				"value" => "",
				"admin_label" => false,
				"description" => esc_attr__("Background color of Icon.", "vp_textdomain")
			  ),array(
				"type" => "colorpicker",
				"heading" => esc_attr__("Icon Shadow Color", "vp_textdomain"),
				"param_name" => "icon_shadow_color",
				"value" => "",
				"admin_label" => false,
				"description" => esc_attr__("Shadow color of Icon.", "vp_textdomain")
			  ),array(
				"type" => "dropdown",
				"heading" => esc_attr__("Heading Style", "vp_textdomain"),
				"param_name" => "size",
				"value" => array("h1", "h2", "h3", "h4", "h5", "h6"),
				"admin_label" => false,
				"description" => esc_attr__("Title heading style.", "vp_textdomain")
			  ),array(
				 "type" => "textfield",
				 "class" => "",
				 "heading" => esc_attr__("Link", "vp_textdomain"),
				 "param_name" => "go_link",
				 "admin_label" => true,
				 "value" => "",
				 "description" => esc_attr__("Enter full path.", "vp_textdomain")
			  ),array(
				"type" => "dropdown",
				"heading" => esc_attr__("Link Target", "vp_textdomain"),
				"param_name" => "go_target",
				"value" => array("_self", "_blank", "_parent", "fancybox", "fancybox-media"),
				"admin_label" => false,
				"description" => esc_attr__("Select link target window. fancybox will launch an lightbox window for images, and fancybox-media will launch a lightbox window for frames/video.", "vp_textdomain")
			  ),array(
				 "type" => "textfield",
				 "class" => "",
				 "heading" => esc_attr__("Title", "vp_textdomain"),
				 "param_name" => "title",
				 "admin_label" => true,
				 "value" => esc_attr__("Enter your title here", "vp_textdomain"),
				 "description" => esc_attr__("Content of the title.", "vp_textdomain")
			  ),array(
				"type" => "colorpicker",
				"heading" => esc_attr__("Font Color", "vp_textdomain"),
				"param_name" => "text_color",
				"value" => "",
				"admin_label" => false,
				"description" => esc_attr__("This option will affect Title and Content color.", "vp_textdomain")
			  ),array(
				"type" => "dropdown",
				"heading" => esc_attr__("Connected", "vp_textdomain"),
				"param_name" => "connected",
				"value" => array("no", "yes"),
				"admin_label" => false,
				"description" => esc_attr__("Select yes to connect elements to next one with a dashed border.", "vp_textdomain")
			  ),array(
				"type" => "colorpicker",
				"heading" => esc_attr__("Border Color", "vp_textdomain"),
				"param_name" => "dot_bg_color",
				"value" => "",
				"admin_label" => false,
				"dependency" => Array('element' => "connected", 'value' => 'yes')
			  ),array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_attr__("Content", "vp_textdomain"),
				"param_name" => "content",
				"value" => "",
				"description" => esc_attr__("Type your content here.", "vp_textdomain")
			  )
		   )
		) );
	}
	
	/**
	* Icon
	*/
	if (!function_exists('ozy_vc_icon')) {
		function ozy_vc_icon( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_icon', $atts);
			extract(shortcode_atts(array(
				'icon' => '',
				'size' => 'regular',
				'style' => '',
				'link' => '',
				'target' => '',
				'color' => '',
				'icon_shadow_color' => '',
				'textcolor' => '',
				'align' => 'left',
				'css_animation' => '',
				'el_class' => ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}
			
			$element_id = 'ozy_icon_'. rand(100,10000);
					
			$inline_style = 'style="';
			if(esc_attr($color)) {
				global $ozyHelper;
				if(!function_exists('ozy_get_option') || !is_object($ozyHelper)) return null;
				switch(esc_attr($style)) {
					case 'square':
						$inline_style .= 'background-color:'. esc_attr($color).'!important';
						break;
					case 'circle':
						$inline_style .= 'background-color:'. esc_attr($color);
						break;
					case 'circle2':
						$inline_style .= 'border-color:'. esc_attr($color) .';color:'. esc_attr($color);
						break;
				}
			}
			
			if(esc_attr($textcolor)) {
				$inline_style .= ';color:'. esc_attr($textcolor);
			}
			
			if(esc_attr($align) === 'left' || esc_attr($align) === 'right') {
				$inline_style .= ';float:'. esc_attr($align);
			}
			
			$inline_style .= '"';
			
			$output = '';		
			if(esc_attr($link)) $output .= '<a href="'. esc_attr($link) .'" target="'. esc_attr($target) .'" class="'. esc_attr($el_class) .' ozy-icon-a">';
			$output .= '<span id="'. $element_id .'" class="ozy-icon '. (!esc_attr($link)? esc_attr($el_class) : '') .' wpb_content_element align-'. esc_attr($align) .' ' . esc_attr($size) .' ' . esc_attr($style) . ' icon '. esc_attr($icon) .' '. $css_animation .'" '. $inline_style .' '. (esc_attr($icon_shadow_color) ? 'data-color="'. esc_attr($icon_shadow_color) .'"':'') .'></span>';
			if(esc_attr($link)) $output .= '</a>';
			
			return $output;
		}

		add_shortcode('ozy_vc_icon', 'ozy_vc_icon');
		
		vc_map( array(
		   "name" => esc_attr__("Icon", "vp_textdomain"),
		   "base" => "ozy_vc_icon",
		   "icon" => "icon-wpb-ozy-el",
		   'category' => 'by OZY',
		   "params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => "",
					"description" => esc_attr__("Only place holder.", "vp_textdomain")
				),array(
					"type" => "select_an_icon",
					"class" => "",
					"heading" => esc_attr__("Icon", "vp_textdomain"),
					"param_name" => "icon",
					"admin_label" => true,
					"value" => "",
					"description" => esc_attr__("Select a type icon from the opened window.", "vp_textdomain")
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Size", "vp_textdomain"),
					"param_name" => "size",
					"value" => array("regular", "large", "xlarge", "xxlarge", "xxxlarge"),
					"admin_label" => false
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Style", "vp_textdomain"),
					"param_name" => "style",
					"value" => array("clean", "square", "circle", "circle2"),
					"admin_label" => false
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Align", "vp_textdomain"),
					"param_name" => "align",
					"value" => array("left", "center", "right"),
					"admin_label" => false
				),array(
					"type" => "textfield",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => false
				),array(
					"type" => "dropdown",
					"heading" => esc_attr__("Target Window", "vp_textdomain"),
					"param_name" => "target",
					"value" => array("_self", "_blank"),
					"admin_label" => false
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Background Color", "vp_textdomain"),
					"param_name" => "color",
					"admin_label" => false
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Foreground Color", "vp_textdomain"),
					"param_name" => "textcolor",
					"admin_label" => false
				),array(
					"type" => "colorpicker",
					"heading" => esc_attr__("Icon Shadow Color", "vp_textdomain"),
					"param_name" => "icon_shadow_color",
					"value" => "",
					"admin_label" => false,
					"description" => esc_attr__("Shadow color of Icon.", "vp_textdomain")
				),$add_css_animation,
				array(
					"type" => "textfield",
					"heading" => esc_attr__("Extra class name", "vp_textdomain"),
					"param_name" => "el_class",
					"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vp_textdomain")
				)			
		   )
		) );
	}

	/**
	* Custom List
	*/
	if (!function_exists('ozy_vc_ul')) {
		function ozy_vc_ul( $atts, $content = null ) {
			$atts = vc_map_get_attributes('ozy_vc_ul', $atts);
			extract(shortcode_atts(array(
				'icon' => '',
				'icon_color' => '',
				'ul_content' => '',
				'css_animation' => ''
			), $atts));

			if($content) $ul_content = $content; //this line covers new Content field after 2.0 version			
			
			$content = wpb_js_remove_wpautop($ul_content);
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}
			
			$tag = $style = '';		
			if(strtolower(strpos($content, '<ul'))) {
				$tag = 'ul';
			}else if(strtolower(strpos($content, '<ol'))) {
				$tag = 'ol';
			}
			if($icon_color) {
				$style = ' style="color:'. esc_attr($icon_color) .'"';
			}
			$content = ozy_strip_single($tag, $content);
			$content = str_replace('<li>' , '<li><span class="oic '. esc_attr($icon) .'"'. $style .'></span><span>', $content);
			$content = str_replace('</li>' , '</span></li>', $content);
			$content = ozy_strip_single('p', $content);
			if(!$tag) { 
				$tag = 'ul';
			}
			return '<'. $tag .' class="ozy-custom-list wpb_content_element '. $css_animation .'">'. $content . '</'. $tag .'>';
		}

		add_shortcode('ozy_vc_ul', 'ozy_vc_ul');
		
		vc_map( array(
			"name" => __("Custom List", "vp_textdomain"),
			"base" => "ozy_vc_ul",
			"icon" => "icon-wpb-ozy-el",
			"class" => '',
			"controls" => "full",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => "",
					"description" => __("Only place holder.", "vp_textdomain")
				),array(
					"type" => "select_an_icon",
					"class" => "",
					"heading" => __("Icon", "vp_textdomain"),
					"param_name" => "icon",
					"admin_label" => true,
					"value" => "",
					"description" => __("Select a type icon from the opened window.", "vp_textdomain")
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Icon Color", "vp_textdomain"),
					"param_name" => "icon_color"
				),array(
					"type" => "textarea",
					"class" => "",
					"heading" => __("Content (OLD)", "vp_textdomain"),
					"param_name" => "ul_content",
					"admin_label" => false,
					"description" => __("Please do not use this field, only to cover old versions. Copy your content into next Content field.", "vp_textdomain"),
					"value" => ""
				),array(
					"type" => "textarea_html",
					"class" => "",
					"heading" => __("Content", "vp_textdomain"),
					"param_name" => "content",
					"admin_label" => false,
					"value" => ""
				),$add_css_animation
		   )
		) );	
	}

	function ozy_strip_single($tag,$string){
		$string=preg_replace('/<'.$tag.'[^>]*>/i', '', $string);
		$string=preg_replace('/<\/'.$tag.'>/i', '', $string);
		return $string;
	}

	/**
	* Team Member
	*/
	if (!function_exists('ozy_vc_team_member')) {
		function ozy_vc_team_member( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_team_member', $atts);
			extract(shortcode_atts(array(
				'image' => '',
				'title' => '',
				'sub_title' => '',
				'excerpt' => '',			
				'twitter' => '',
				'facebook' => '',
				'linkedin' => '',
				'pinterest' => '',
				'link' => '',
				'css_animation' => ''
			), $atts));
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}	
			
			$output = PHP_EOL . '<div class="ozy-team_member '. $css_animation .'">' . PHP_EOL;
			$output.= '<figure>';
			$member_image = wp_get_attachment_image_src($image, 'full');
			if(isset($member_image[0])) {
				$output.= $link? '<a href="'. esc_attr($link) .'">' : '';
				$output.= '<img src="'. $member_image[0] .'" alt="'. esc_attr($title) .'">';
				$output.= $link? '</a>' : '';
			}
			$output.= '<figcaption>';
			$output.= esc_attr($title) ? '<h3>'. esc_attr($title) .'</h3>' : '';
			$output.= esc_attr($sub_title) ? '<h5 class="content-color-alternate">'. esc_attr($sub_title) .'</h5>' : '';
			$output.= '<p>'. esc_attr($excerpt) .'</p>';

			$output.= '<div>';
			$output.= esc_attr($twitter) ? '<a href="http://www.twitter.com/'. esc_attr($twitter) .'" target="_blank" class="symbol-twitter tooltip" title="twitter"><span class="symbol">twitter'.'</span></a>' : '';
			$output.= esc_attr($facebook) ? '<a href="http://www.facebook.com/'. esc_attr($facebook) .'" target="_blank" class="symbol-facebook tooltip" title="facebook"><span class="symbol">facebook'.'</span></a>' : '';
			$output.= esc_attr($linkedin) ? '<a href="http://www.linkedin.com/'. esc_attr($linkedin) .'" target="_blank" class="symbol-linkedin tooltip" title="linkedin"><span class="symbol">linkedin'.'</span></a>' : '';
			$output.= esc_attr($pinterest) ? '<a href="http://pinterest.com/'. esc_attr($pinterest) .'" target="_blank" class="symbol-pinterest tooltip" title="pinterest"><span class="symbol">pinterest'.'</span></a>' : '';
			$output.= '</div>';
			
			$output.= '</figcaption>';
			$output.= '</figure>';
			$output.= PHP_EOL . '</div>' . PHP_EOL;		
			
			return $output;
		}

		add_shortcode( 'ozy_vc_team_member', 'ozy_vc_team_member' );
		
		vc_map( array(
			"name" => esc_attr__("Team Member", "vp_textdomain"),
			"base" => "ozy_vc_team_member",
			"icon" => "icon-wpb-ozy-el",
			"class" => '',
			"controls" => "full",
			'category' => 'by OZY',
			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_attr__("Member Image", "vp_textdomain"),
					"param_name" => "image",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Select image for your team member.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Title", "vp_textdomain"),
					"param_name" => "title",
					"admin_label" => true,
					"value" => "",
					"description" => esc_attr__("Title for your Team Member, like a name.", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Sub Title", "vp_textdomain"),
					"param_name" => "sub_title",
					"admin_label" => true,
					"value" => "",
					"description" => esc_attr__("Sub Title for your Team Member, like work title.", "vp_textdomain")
				),array(
					"type" => "textarea",
					"class" => "",
					"heading" => esc_attr__("Excerpt", "vp_textdomain"),
					"param_name" => "excerpt",
					"admin_label" => true,
					"value" => ""
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Twitter", "vp_textdomain"),
					"param_name" => "twitter",
					"admin_label" => true,
					"value" => "",
					"description" => esc_attr__("Enter your Twitter account name", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Facebook", "vp_textdomain"),
					"param_name" => "facebook",
					"admin_label" => true,
					"value" => "",
					"description" => esc_attr__("Enter your Facebook account name", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("LinkedIn", "vp_textdomain"),
					"param_name" => "linkedin",
					"admin_label" => true,
					"value" => "",
					"description" => esc_attr__("Enter your LinkedIn account name", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Pinterest", "vp_textdomain"),
					"param_name" => "pinterest",
					"admin_label" => true,
					"value" => "",
					"description" => esc_attr__("Enter your Pinterest account name", "vp_textdomain")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Link", "vp_textdomain"),
					"param_name" => "link",
					"admin_label" => false,
					"value" => "",
					"description" => esc_attr__("Define a path to details page", "vp_textdomain")
				),$add_css_animation
		   )
		) );	
	}

	/**
	* Divider
	*/
	if (!function_exists('ozy_vc_divider')) {
		function ozy_vc_divider( $atts, $content = null ) {
            $atts = vc_map_get_attributes('ozy_vc_divider', $atts);
			extract(shortcode_atts(array(
				'caption_size' => 'h3',
				'caption' 		=> '',
				'caption_align'	=> 'center',
				'caption_position' => '',
				'border_style'	=> 'solid',
				'border_size' => '1',
				'border_color' => '',
				'css_animation' => '',
				'more_custom' => 'off',
				'width' => '',
				'align' => 'center'
				), $atts ) 
			);
			
			if($css_animation) {
				wp_enqueue_script('waypoints');
				$css_animation = " wpb_animate_when_almost_visible wpb_" . esc_attr($css_animation) . " ";
			}
			
			$output = $more_custom_html = '';
			if(esc_attr($more_custom) == 'on' && esc_attr($width) && esc_attr($align)) {
				$more_custom_html = ';width:'. esc_attr($width) .';max-width:'. esc_attr($width) .';';
				switch(esc_attr($align)) {
					case 'center':
						$more_custom_html .= 'margin:20px auto;';
						break;
					case 'left':
						$more_custom_html .= 'float:left;';
						break;
					case 'right':
						$more_custom_html .= 'float:right;';
						break;						
					default:
						$more_custom_html .= 'margin:0 auto;';
				}
			}
			if('top' === esc_attr($caption_position)){
				$output = ( trim( esc_attr( $caption ) ) ? '<'. esc_attr($caption_size) .' class="ozy-divider-cap-' . esc_attr($caption_align) . ' wpb_content_element">' . esc_attr( $caption ) . '</'. esc_attr($caption_size) .'>' : '' );
				$output.= '<div class="ozy-content-divider '. $css_animation .'" style="border-top-style:'. esc_attr($border_style) . ';border-top-width:' . ('double' == esc_attr($border_style)?'3':esc_attr($border_size)) .'px' . ('' != esc_attr($border_color)?';border-top-color:'. esc_attr($border_color) .'':'') . $more_custom_html .'"></div>';
			}else{
				$output = '<fieldset class="ozy-content-divider '. $css_animation .' wpb_content_element" style="border-top-style:'. esc_attr($border_style) . ';border-top-width:' . ('double' == esc_attr($border_style)?'3':esc_attr($border_size)) .'px' . ('' != esc_attr($border_color)?';border-top-color:'. esc_attr($border_color) .'':'') . $more_custom_html .'">' . ( trim( esc_attr( $caption ) ) ? '<legend class="d' . esc_attr($caption_align) . '" align="' . esc_attr($caption_align) . '">' . esc_attr( $caption ) . '</legend>' : '' ) . '</fieldset>';
			}
			return $output;
		}

		add_shortcode('ozy_vc_divider', 'ozy_vc_divider');

		vc_map( array(
		   "name" => esc_attr__("Separator (Divider) With Caption", "vp_textdomain"),
		   "base" => "ozy_vc_divider",
		   "class" => "",
		   "controls" => "full",
		   'category' => 'by OZY',
		   "icon" => "icon-wpb-ozy-el",
		   "params" => array(
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Caption Size", "vp_textdomain"),
					"param_name" => "caption_size",
					"admin_label" => true,
					"value" => array("h3","h1","h2","h4","h5","h6")
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Caption", "vp_textdomain"),
					"param_name" => "caption",
					"admin_label" => true,
					"value" => esc_attr__("Enter your caption here", "vp_textdomain"),
					"description" => esc_attr__("Caption of the divider.", "vp_textdomain")
				),array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Border Style", "vp_textdomain"),
					"param_name" => "border_style",
					"admin_label" => true,
					"value" => array("solid","dotted","dashed","double")
				),array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Border Size", "vp_textdomain"),
					"param_name" => "border_size",
					"admin_label" => true,
					"value" => array("1","2","3","4","5","6","7","8","9","10")
				),array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_attr__("Border Color", "vp_textdomain"),
					"param_name" => "border_color",
					"admin_label" => false,
					"value" => ""
				),array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Caption Align", "vp_textdomain"),
					"param_name" => "caption_align",
					"admin_label" => true,
					"value" => array("center", "left", "right"),
					"description" => esc_attr__("Caption align.", "vp_textdomain")
				),array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Caption Position", "vp_textdomain"),
					"param_name" => "caption_position",
					"admin_label" => true,
					"value" => array("overlay", "top"),
					"description" => esc_attr__("Caption position.", "vp_textdomain")
				),array(
					"type" => 'dropdown',
					"heading" => esc_attr__("More Customization", "vp_textdomain"),
					"param_name" => "more_custom",
					"value" => array("off", "on"),
				),array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_attr__("Width", "vp_textdomain"),
					"param_name" => "width",
					"admin_label" => true,
					"value" => "400px",
					"dependency" => Array('element' => "more_custom", 'value' => 'on')
				),array(
					"type" => "dropdown",
					"class" => "",
					"heading" => esc_attr__("Align", "vp_textdomain"),
					"param_name" => "align",
					"admin_label" => true,
					"value" => array("center", "left", "right"),
					"dependency" => Array('element' => "more_custom", 'value' => 'on')
				),$add_css_animation	
			)
		) );
	}
}