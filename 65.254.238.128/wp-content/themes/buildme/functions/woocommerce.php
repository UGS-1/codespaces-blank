<?php
/**
 * Hook in on activation
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'ozy_woocommerce_image_dimensions', 1 );
 
/**
 * Define image sizes
 */
function ozy_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '300',	// px
		'height'	=> '300',	// px
		'crop'		=> 0 		// true
	);
 
	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 0 		// true
	);
 
	$thumbnail = array(
		'width' 	=> '150',	// px
		'height'	=> '150',	// px
		'crop'		=> 0 		// false
	);
 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
	echo '<section id="woocommerce-main">';
}

function my_theme_wrapper_end() {
	echo '</section>';
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

/** 
* Remove Showing results functionality site-wide 
*/
/*function woocommerce_result_count() { return; }*/
/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 
function woo_related_products_limit() {
	global $product;
	
	$args = array(
		'post_type'        		=> 'product',
		'no_found_rows'    		=> 1,
		'posts_per_page'   		=> 3,
		'ignore_sticky_posts' 	=> 1
	);
	return $args;
}

add_filter( 'loop_shop_columns', 'wc_loop_shop_columns', 1, 10 );
 
/*
* Return a new number of maximum columns for shop archives
* @param int Original value
* @return int New number of columns
*/
function wc_loop_shop_columns( $number_columns ) {
	return 3;
}

// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );
/**
* Convert cart bar into Ajax supported
*/
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
    <div class="cart-contents"><i class="oic-flaticon5-ShoppingCart"></i><div><a href="<?php echo esc_url($woocommerce->cart->get_cart_url()) ?>"><h4><?php  esc_attr_e('Shopping Bag', 'vp_textdomain') ?></h4><p><?php echo $woocommerce->cart->get_cart_total() ?></p></a></div></div>
	<?php
	
	$fragments['div.cart-contents'] = ob_get_clean();
	
	return $fragments;
}

add_filter( 'woocommerce_output_related_products_args', 'ozy_related_products_args' );
function ozy_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 3 related products
	$args['columns'] = 3; // arranged in 3 columns
	return $args;
}

//Remove prettyPhoto lightbox
add_action( 'wp_enqueue_scripts', 'fc_remove_woo_lightbox', 99 );
function fc_remove_woo_lightbox() {
    remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
        wp_dequeue_script( 'prettyPhoto' );
        wp_dequeue_script( 'prettyPhoto-init' );
}

/* This snippet removes the action that inserts thumbnails to products in teh loop
 * and re-adds the function customized with our wrapper in it.
 * It applies to all archives with products.
 *
 * @original plugin: WooCommerce
 * @author of snippet: Brian Krogsard
 * @customized by: ozythemes
 */

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * WooCommerce Loop Product Thumbs
 **/
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
	function woocommerce_template_loop_product_thumbnail() {
		echo woocommerce_get_product_thumbnail();
	}
}


/**
 * WooCommerce Product Thumbnail
 **/
 if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
	
	function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
		global $post, $woocommerce, $product;
		
		if ( ! $placeholder_width ) {
			$placeholder_width = wc_get_image_size( 'shop_catalog_image_width' );
		}
		if ( ! $placeholder_height ) {
			$placeholder_height = wc_get_image_size( 'shop_catalog_image_height' );
		}
		$output = '';
		if ( has_post_thumbnail() ) {
			$output .= '<a href="'. get_permalink($post->ID) .'">'. get_the_post_thumbnail( $post->ID, $size ) .'</a>'; 
		} else {
			$output .= '<img src="'. esc_url(woocommerce_placeholder_img_src()) .'" alt="Placeholder" width="' . esc_attr($placeholder_width) . '" height="' . esc_attr($placeholder_height) . '" />';
		}
		return $output;
	}
 }
?>