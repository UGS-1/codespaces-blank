<?php
// Output option-based style
if( !function_exists( 'ozy_buildme_style') ) :
	function ozy_buildme_style() {
		global $ozyHelper, $ozy_data, $post;

		// is page based styling enabled?
		$body_style = $content_background_color = $transparent_content_background = '';
		$page_id = get_the_ID();
		
		$shop_page_id = ozy_get_woocommerce_page_id();
		if ($shop_page_id > 0) { $page_id = $shop_page_id; }
		
		if(vp_metabox('ozy_buildme_meta_page.ozy_buildme_meta_page_use_custom_style', null, $page_id) == '1') {
			$_var = 'ozy_buildme_meta_page.ozy_buildme_meta_page_layout_group.0.ozy_buildme_meta_page_layout_';
			$content_background_color 		= vp_metabox($_var . 'ascend_background', null, $page_id);
			$transparent_content_background = vp_metabox($_var . 'transparent_background', null, $page_id);
		}else{
			$content_background_color 		= ozy_get_option('content_background_color', null, $page_id);
		}
		
		if(vp_metabox('ozy_buildme_meta_page.ozy_buildme_meta_page_use_custom_background', null, $page_id) == '1' && !is_search()) {
			$_var = 'background_group.0.ozy_buildme_meta_page_background_';
			$body_style = $ozyHelper->background_style_render(
				ozy_get_metabox($_var . 'color', null, $page_id),
				ozy_get_metabox($_var . 'image', null, $page_id),
				ozy_get_metabox($_var . 'image_size', null, $page_id),
				ozy_get_metabox($_var . 'image_repeat', null, $page_id),
				ozy_get_metabox($_var . 'image_attachment', null, $page_id),
				false,
				ozy_get_metabox($_var . 'image_pos_x', null, $page_id),
				ozy_get_metabox($_var . 'image_pos_y', null, $page_id)				
			);
		}else{
			$_var = 'body_background_';
			$body_style = $ozyHelper->background_style_render(
				ozy_get_option($_var . 'color', null, $page_id), 
				ozy_get_option($_var . 'image', null, $page_id), 
				ozy_get_option($_var . 'image_size', null, $page_id), 
				ozy_get_option($_var . 'image_repeat', null, $page_id), 
				ozy_get_option($_var . 'image_attachment', null, $page_id)
			);
		}
	
	?>
		<style type="text/css">
			@media only screen and (min-width: 1212px) {
				.container{padding:0;width:<?php echo $ozy_data->container_width; ?>px;}
				#content{width:<?php echo $ozy_data->content_width; ?>px;}
				#sidebar{width:<?php echo $ozy_data->sidebar_width; ?>px;}
			}
	
			<?php
				if(ozy_get_option('primary_menu_side_menu') === '-1') {
			?>
				@media only screen and (min-width: 960px) {
					#nav-primary>nav>div>ul>li.menu-item-side-menu{display:none !important;}
				}			
			<?php					
				}
			?>	
	
			/* Body Background Styling
			/*-----------------------------------------------------------------------------------*/
			body{<?php echo $body_style; ?>}
		
			/* Layout and Layout Styling
			/*-----------------------------------------------------------------------------------*/
			#main,
			.main-bg-color{
				background-color:<?php echo $content_background_color ?>;
			}
			#main.header-slider-active>.container,
			#main.footer-slider-active>.container{
				margin-top:0px;
			}
			.ozy-header-slider{
				margin-top:<?php echo ozy_get_option('header_height')?>px;
			}

			#footer .container>div,
			#footer .container,
			#footer{
				height:<?php echo ozy_get_option('footer_height')?>px;min-height:<?php echo ozy_get_option('footer_height')?>px;
			}
			#footer,#footer>footer .container{
				line-height:<?php echo ozy_get_option('footer_height')?>px;
			}
			#footer .top-social-icons>a>span {
				line-height:<?php echo (int)ozy_get_option('footer_height')?>px;
			}
			@-moz-document url-prefix() { 
				#footer .top-social-icons>a>span{line-height:<?php echo (int)ozy_get_option('footer_height')?>px;}
			}

			#footer-wrapper {
				<?php
					$footer_background_image = ozy_get_option('footer_background_image');
					$footer_background_color = ozy_get_option('footer_color_1', 'rgba(0,0,0,1)');
					if($footer_background_image) {
						echo 'background:'. $footer_background_color .' url('. $footer_background_image .') no-repeat center bottom;';
					}else{
						echo 'background-color:'. $footer_background_color .';';
					}
				?>
			}			
			#footer *,
			#footer-widget-bar * {
				color:<?php echo ozy_get_option('footer_color_2', '#ffffff');?> !important;
			}
			#footer a:hover,
			#footer-widget-bar a:hover {
				color:<?php echo ozy_get_option('footer_color_3', '#ff0000');?> !important;
			}				
			#footer,
			#footer-widget-bar,
			#footer .top-social-icons>a {
				border-color:<?php echo ozy_get_option('footer_color_4', '#383838');?>
			}
			#footer-widget-bar>.container>section>div.widget>span.line {
				border-color:<?php echo ozy_get_option('footer_color_3', '#383838');?>
			}			
			#footer a,
			#footer-widget-bar a {
				color:<?php echo ozy_get_option('footer_color_3', '#f33337');?>
			}
			#footer-widget-bar input{
				border-color:<?php echo ozy_get_option('form_button_background_color', '#ffffff');?> !important;				
			}
		<?php 
			$menu_logo_height_inner = ((int)ozy_get_option('primary_menu_height', '100') + 60) . 'px'; //60 : primary menu
			$menu_logo_height = ((int)ozy_get_option('primary_menu_height', '100') + 50 + 40) . 'px'; //60-10=50 : primary menu, 30 : top bar
		
			echo $transparent_content_background == '1' ? '	#main>.container{background-color:transparent !important;-webkit-box-shadow:none !important;-moz-box-shadow:none !important;box-shadow:none !important;}' . PHP_EOL : '' ?>
			@media only screen and (max-width: 479px) {
				#footer{height:<?php echo (int)ozy_get_option('footer_height')*2;?>px;}			
				#main>.container{margin-top:<?php echo ozy_get_option('header_height');?>px;}
			}
			@media only screen and (max-width: 1024px) and (min-width: 480px) {
				#header #title{padding-right:<?php echo (int)(ozy_get_option('header_height')+20);?>px;}
				#header #title>a{line-height:<?php echo ozy_get_option('header_height');?>px;}
				#main>.container{margin-top:<?php echo ozy_get_option('header_height');?>px;}
				#footer{height:<?php echo ozy_get_option('footer_height');?>px;}
			}	
			
		<?php 
		//if(ozy_check_is_woocommerce_page()) { 
		if(is_woocommerce_activated()) {
		?>
			/* WooCommerce
			/*-----------------------------------------------------------------------------------*/
			.ozy-product-overlay .button:hover{
				background-color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('primary_menu_background_color'))?> !important;
				color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('primary_menu_font_color_hover'))?> !important;
				border:1px solid <?php echo ozy_get_option('primary_menu_background_color')?> !important;
			}
			.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
			.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active,
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
			.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active{
				background-color:<?php echo ozy_get_option('content_color_alternate') ?> !important;
				border-color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('content_color_alternate')) ?> !important;
				border-color:<?php echo ozy_get_option('content_color_alternate') ?> !important;
			}
			.woocommerce div.product .woocommerce-tabs ul.tabs li,
			.woocommerce-page div.product .woocommerce-tabs ul.tabs li,
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li,
			.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li{
				border-color:<?php echo ozy_get_option('primary_menu_separator_color') ?>;
			}
			.woocommerce div.product span.price, 
			.woocommerce-page div.product span.price, 
			.woocommerce #content div.product span.price,
			.woocommerce-page #content div.product span.price,
			.star-rating {
				color:<?php echo ozy_get_option('content_color_alternate');?> !important;
			}
			.woocommerce .products .onsale,
			.woocommerce span.onsale, 
			.woocommerce-page span.onsale,
			.woocommerce nav.woocommerce-pagination ul li span.current{
				background-color:<?php echo ozy_get_option('content_color_alternate');?> !important;
				color:<?php echo ozy_get_option('content_color_alternate2');?> !important;				
			}
			.woocommerce nav.woocommerce-pagination ul li {
				background-color:<?php echo ozy_get_option('content_background_color_alternate');?> !important;
				color:<?php echo ozy_get_option('content_color');?> !important;
			}
			.ui-slider .ui-slider-range{background:none repeat scroll 0 0 <?php echo ozy_get_option('content_color_alternate');?>;}
			.woocommerce div.product p.price, 
			.woocommerce-page div.product p.price, 
			.woocommerce #content div.product p.price,
			.woocommerce-page #content div.product p.price,
			.woocommerce div.product .woocommerce-tabs ul.tabs li a,
			.woocommerce-page div.product .woocommerce-tabs ul.tabs li a,
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li a,
			.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a{
				color:<?php echo ozy_get_option('content_color');?> !important;
			}
			.woocommerce-pagination>ul>li>a,
			.woocommerce-pagination>ul>li>span{
				color:<?php echo ozy_get_option('content_color');?> !important;
			}
			#woocommerce-lightbox-cart h3:first-letter,
			#woocommerce-lightbox-cart ul.cart_list.product_list_widget>li{			
				/*border-color:<?php echo  $ozyHelper->change_opacity(ozy_get_option('content_color'),'.2') ?>;*/
				border-color:<?php echo  $ozyHelper->hex2rgba(ozy_get_option('content_color'),'.2') ?>;
			}
			
			.woocommerce-page .button,
			body.woocommerce-page input[type=button],
			body.woocommerce-page input[type=submit],
			body.woocommerce-page button[type=submit]{
				background:<?php echo ozy_get_option('form_button_background_color')?> !important;
				color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('form_button_font_color'))?> !important;
				border:1px solid <?php echo ozy_get_option('form_button_background_color')?> !important;
			}
			.woocommerce-page .button:hover,
			body.woocommerce-page input[type=button]:hover,
			body.woocommerce-page input[type=submit]:hover,
			body.woocommerce-page button[type=submit]:hover{
				background:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('form_button_background_color_hover'))?> !important;
				color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('form_button_font_color_hover'))?> !important;
				border:1px solid <?php echo ozy_get_option('form_button_background_color_hover')?> !important;
			}
			
		<?php } ?>
		
			/* Header Over Primary Menu Styling */
			#info-bar,
			div.ozy-selectBox.ozy-wpml-language-switcher *{
				background-color:<?php echo ozy_get_option('header_info_bar_background_color')?>;
				color:<?php echo ozy_get_option('header_font_color')?>;
			}
			#header{position:<?php echo ozy_get_option('primary_sticky_menu') == '' ? 'absolute' : 'fixed'; ?>}
			#header,
			.menu-item-search,
			nav#top-menu.mobile-view {
				<?php
					$hader_start_color = ozy_get_option('header_background_color_start');
					$hader_end_color = ozy_get_option('header_background_color_end');
				?>
				background: <?php echo $hader_start_color ?>;
				background: -moz-linear-gradient(top, <?php echo $hader_start_color ?> 0%, <?php echo $hader_end_color ?> 100%);
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $hader_start_color ?>), color-stop(100%,<?php echo $hader_end_color ?>));
				background: -webkit-linear-gradient(top, <?php echo $hader_start_color ?> 0%,<?php echo $hader_end_color ?> 100%);
				background: -o-linear-gradient(top, <?php echo $hader_start_color ?> 0%,<?php echo $hader_end_color ?> 100%);
				background: -ms-linear-gradient(top, <?php echo $hader_start_color ?> 0%,<?php echo $hader_end_color ?> 100%);
				background: linear-gradient(to bottom, <?php echo $hader_start_color ?> 0%,<?php echo $hader_end_color ?> 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $hader_start_color ?>', endColorstr='<?php echo $hader_end_color ?>',GradientType=0 );
			}			
			<?php
			$header_background_image = ozy_get_option('header_background_image');
			if($header_background_image) { echo '#header{background:url('. $header_background_image .') repeat center center;}'; }
			?>
			
			#header #info-bar i,
			#header #info-bar .top-social-icons a span,
			#logo-side-info-bar>li i:before {color:<?php echo ozy_get_option('header_alternate_color') ?>;}
			#logo-side-info-bar>li h4,
			.menu-item-search i {color:<?php echo ozy_get_option('header_heading_color') ?>;}
			#logo-side-info-bar>li *{color:<?php echo ozy_get_option('header_font_color') ?>;}
			#header #info-bar,
			#header #info-bar *,
			div.ozy-selectBox.ozy-wpml-language-switcher *,
			ul#logo-side-info-bar>li{border-color:<?php echo ozy_get_option('header_separator_color') ?> !important;}

			/* Primary Menu Styling
			/*-----------------------------------------------------------------------------------*/
			#top-menu .logo>h1>a,
			#top-menu .logo2>h1>a{
				color:<?php echo ozy_get_option('primary_menu_logo_color')?> !important;
			}
		
			#top-menu,
			#top-menu .logo,
			#top-menu>div>div>ul,
			#top-menu>div>div>ul>li,
			#top-menu>div>div>ul>li>a,
			#top-menu>div>div>ul>li>a:before,
			#top-menu>div>div>ul>li>a:after,
			#top-menu>div>div>ul>li>.submenu-button {
				height:60px;
				line-height:60px;
				<?php 
				echo $ozyHelper->font_style_render(
					ozy_get_option('primary_menu_typography_font_face'), 
					ozy_get_option('primary_menu_typography_font_weight'), 
					ozy_get_option('primary_menu_typography_font_style'), 
					ozy_get_option('primary_menu_typography_font_size') . 'px', 
					'', 
					ozy_get_option('primary_menu_font_color')
				);
				?>
			}
			<?php if($ozyHelper->ielt9()) {
				echo "#top-menu .logo{margin-top:-30px;}";
				echo "#logo-side-info-bar{margin-top:-20px;}";
			} ?>
			#top-menu>div>div>ul>li li,
			#top-menu>div>div>ul>li li>a {
				font-family:<?php echo ozy_get_option('typography_font_face') ?>;	
			}
			#header{
				/*line-height:<?php echo $menu_logo_height ?>;*/
				height:<?php echo $menu_logo_height ?>;						
			}
			#header .logo-bar-wrapper{height:<?php echo (int)$menu_logo_height_inner-60; ?>px;}
			#header #top-menu {
				line-height:<?php echo $menu_logo_height_inner ?>;
				height:<?php echo $menu_logo_height_inner ?>;
			}
			#top-menu,
			#top-menu .logo {
				<?php 
				echo $ozyHelper->font_style_render(
					ozy_get_option('primary_menu_typography_font_face'), 
					'300', 
					ozy_get_option('primary_menu_typography_font_style'), 
					ozy_get_option('primary_menu_typography_font_size') . 'px', 
					'', 
					ozy_get_option('primary_menu_font_color')
				);
				?>
				height:auto;
			}
			#top-menu ul ul li a{color:<?php echo ozy_get_option('primary_menu_font_color') ?>;}
			#top-menu>.primary-menu-bar-wrapper>div>ul>li>a:after{background-color:<?php echo ozy_get_option('primary_menu_font_color_hover') ?> !important;}			
			#top-menu ul li>a:before,
			#top-menu span.submenu-button:before,
			#top-menu span.submenu-button:after,
			#top-menu ul ul li.has-sub > a:after {
				background-color:<?php echo ozy_get_option('primary_menu_font_color') ?> !important;
			}
			#top-menu .menu-button:after {border-color:<?php echo ozy_get_option('header_heading_color') ?> !important;}
			#top-menu .menu-button.menu-opened:after,
			#top-menu .menu-button:before {background-color:<?php echo ozy_get_option('header_heading_color') ?> !important;}			
			/*#top-menu .menu-button:after,*/
			#top-menu .menu-item-search>a>span,
			#top-menu .menu-item-wpml>a>span {
				border-color:<?php echo ozy_get_option('primary_menu_font_color') ?> !important;
			}
			#top-menu>.primary-menu-bar-wrapper{
				<?php
					$hader_start_color = ozy_get_option('primary_menu_background_color');
					$hader_end_color = ozy_get_option('primary_menu_background_color_end');
				?>
				background: <?php echo $hader_start_color ?>;
				background: -moz-linear-gradient(top, <?php echo $hader_start_color ?> 0%, <?php echo $hader_end_color ?> 100%);
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $hader_start_color ?>), color-stop(100%,<?php echo $hader_end_color ?>));
				background: -webkit-linear-gradient(top, <?php echo $hader_start_color ?> 0%,<?php echo $hader_end_color ?> 100%);
				background: -o-linear-gradient(top, <?php echo $hader_start_color ?> 0%,<?php echo $hader_end_color ?> 100%);
				background: -ms-linear-gradient(top, <?php echo $hader_start_color ?> 0%,<?php echo $hader_end_color ?> 100%);
				background: linear-gradient(to bottom, <?php echo $hader_start_color ?> 0%,<?php echo $hader_end_color ?> 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $hader_start_color ?>', endColorstr='<?php echo $hader_end_color ?>',GradientType=0 );
			}
			#top-menu>div>div>ul>li:not(:first-child):not(.menu-item-request-rate):not(.menu-item-search)>a>span.s{border-color:<?php echo ozy_get_option('primary_menu_separator_color_2') ?>;}
			@media screen and (max-width:1180px){
				#top-menu #head-mobile {
					line-height:62px;
					min-height:62px;
				}
				.menu-item-search{background:none !important;}
				#top-menu>div>div>ul>li {
					height:auto !important;
				}
				#top-menu,
				#top-menu ul li{
					background-color:<?php echo ozy_get_option('primary_menu_background_color') ?>;
				}
				#header {
					position:relative !important;
					height:inherit !important;
				}
				#top-menu ul li i{color:<?php echo ozy_get_option('primary_menu_font_color') ?>;}
				#top-menu ul li{background:<?php echo ozy_get_option('primary_menu_dropdown_background') ?> !important;}
				#top-menu ul li:hover,
				#top-menu .submenu-button.submenu-opened {
					background-color:<?php echo ozy_get_option('primary_menu_dropdown_background_color_hover') ?>;
					color:<?php echo ozy_get_option('primary_menu_font_color_hover') ?>;
				}
				#top-menu .submenu-button,
				#top-menu>div>div>ul>li:last-child,
				#top-menu ul li{border-color:<?php echo ozy_get_option('primary_menu_dropdown_background_color_hover') ?>;}
				#top-menu ul ul li:not(:last-child)>a{border:none !important;}
			}
			#top-menu ul ul li{background-color:<?php echo ozy_get_option('primary_menu_dropdown_background') ?>;}
			#top-menu ul ul li:not(:last-child)>a{border-bottom:1px solid <?php echo ozy_get_option('primary_menu_dropdown_background_color_hover') ?>;}
			#top-menu ul ul li:hover,
			#top-menu ul ul li.current-menu-item,
			#top-menu ul ul li.current_page_item {
				background-color:<?php echo ozy_get_option('primary_menu_dropdown_background_color_hover') ?>;
				color:<?php echo ozy_get_option('primary_menu_font_color_hover') ?>;
			}
			#header{border-color:<?php echo $ozyHelper->change_opacity(ozy_get_option('primary_menu_separator_color_2'), '0.3')?>;}
			/* Widgets
			/*-----------------------------------------------------------------------------------*/
			.widget li>a{
				color:<?php echo ozy_get_option('content_color'); ?> !important;
			}
			.widget li>a:hover{
				color:<?php echo ozy_get_option('content_color_alternate'); ?> !important;
			}
			.ozy-latest-posts>a>span{
				background-color:<?php echo ozy_get_option('content_color_alternate') ?>;
				color:<?php echo ozy_get_option('content_color') ?>;
			}
			
			/* Page Styling and Typography
			/*-----------------------------------------------------------------------------------*/
			/*breadcrumbs*/
			#breadcrumbs li:last-child{background-color:<?php echo ozy_get_option('content_color_alternate'); ?>}
			#breadcrumbs li:last-child,#breadcrumbs li:last-child>a{color:<?php echo ozy_get_option('content_color_alternate3'); ?>}
			#breadcrumbs li a{color:<?php echo ozy_get_option('content_color'); ?>}
			/*breadcrumbs end*/
			ul.menu li.current_page_item>a,
			.content-color-alternate{color:<?php echo ozy_get_option('content_color_alternate'); ?> !important;}			
			.heading-color,h1.content-color>a,h2.content-color>a,h3.content-color>a,h4.content-color>a,h5.content-color>a,h6.content-color>a,blockquote,.a-page-title {
				color:<?php echo ozy_get_option('heading_color'); ?> !important;
			}
			.ozy-footer-slider,
			.content-font,
			.ozy-header-slider,
			#content,
			#footer-widget-bar,
			#sidebar,
			#footer,
			.tooltipsy,
			.fancybox-inner,
			#woocommerce-lightbox-cart {
				<?php echo $ozyHelper->font_style_render(ozy_get_option('typography_font_face'), 
				ozy_get_option('typography_font_weight'), 
				ozy_get_option('typography_font_style'), 
				ozy_get_option('typography_font_size') . 'px', 
				ozy_get_option('typography_font_line_height') . 'em', 
				ozy_get_option('content_color'));?>
			}
			#content a:not(.ms-btn),
			#sidebar a,#footer a,
			.alternate-text-color,
			#footer-widget-bar>.container>.widget-area a:hover,
			.fancybox-inner a,
			#woocommerce-lightbox-cart a {
				color:<?php echo ozy_get_option('content_color_alternate');?>;
			}
			#footer #social-icons a,
			#ozy-share-div>a>span,
			.page-pagination a {
				background-color:<?php echo ozy_get_option('content_background_color_alternate');?> !important;
				color:<?php echo ozy_get_option('content_color');?> !important;
			}
			.page-pagination a.current{
				background-color:<?php echo ozy_get_option('content_color_alternate');?> !important;
				color:<?php echo ozy_get_option('content_color_alternate2');?> !important;
			}			
			.fancybox-inner,
			#woocommerce-lightbox-cart{
				color:<?php echo ozy_get_option('content_color');?> !important;
			}
			.header-line,
			.single-post .post-submeta>.blog-like-link>span{background-color:<?php echo ozy_get_option('primary_menu_separator_color') ?>;}
			.a-page-title:hover{border-color:<?php echo ozy_get_option('heading_color');?> !important;}
			.nav-box a,
			#page-title-wrapper h1,
			#page-title-wrapper h4,
			#side-nav-bar a,
			#side-nav-bar h3,
			#content h1,
			#sidebar .widget h1,
			#content h2,
			#sidebar .widget h2,
			#content h3,
			#sidebar .widget h3,
			#content h4,
			#sidebar .widget h4,
			#content h5,
			#sidebar .widget h5,
			#content h6,
			#sidebar .widget h6,
			.heading-font,
			#logo,
			#tagline,
			.ozy-ajax-shoping-cart{
				<?php echo $ozyHelper->font_style_render(ozy_get_option('typography_heading_font_face'), '', '', '', '', ozy_get_option('heading_color'));?>
			}
			#page-title-wrapper h1,
			#content h1,
			#footer-widget-bar h1,
			#sidebar h1,
			#footer h1,
			#sidr h1{
					<?php echo $ozyHelper->font_style_render('', 
				ozy_get_option('typography_heading_font_weight_h1'), 
				ozy_get_option('typography_heading_h1_font_style'), 
				ozy_get_option('typography_heading_h1_font_size') . 'px', 
				ozy_get_option('typography_heading_line_height_h1', '1.5') . 'em', '', '', 
				ozy_get_option('typography_heading_font_ls_h1'));?>
			}
			#footer-widget-bar .widget-area h4,
			#sidebar .widget>h4 {
				<?php echo $ozyHelper->font_style_render('', 
				ozy_get_option('typography_heading_font_weight_h4'), 
				ozy_get_option('typography_heading_h4_font_style'), 
				ozy_get_option('typography_heading_h4_font_size') . 'px', 
				ozy_get_option('typography_heading_line_height_h4', '1.5') . 'em', '', '',
				ozy_get_option('typography_heading_font_ls_h4'));?>
			}
			#content h2,
			#footer-widget-bar h2,
			#sidebar h2,
			#footer h2,
			#sidr h2{
				<?php echo $ozyHelper->font_style_render('', 
				ozy_get_option('typography_heading_font_weight_h2'), 
				ozy_get_option('typography_heading_h2_font_style'), 
				ozy_get_option('typography_heading_h2_font_size') . 'px', 
				ozy_get_option('typography_heading_line_height_h2', '1.5') . 'em', '', '',
				ozy_get_option('typography_heading_font_ls_h2'));?>;
			}
			#content h3,
			#footer-widget-bar h3,
			#sidebar h3,
			#footer h3,
			#sidr h3{
				<?php echo $ozyHelper->font_style_render('', 
				ozy_get_option('typography_heading_font_weight_h3'), 
				ozy_get_option('typography_heading_h3_font_style'), 
				ozy_get_option('typography_heading_h3_font_size') . 'px', 
				ozy_get_option('typography_heading_line_height_h3', '1.5') . 'em', '', '',
				ozy_get_option('typography_heading_font_ls_h3'));?>;
			}
			#content h4,
			#page-title-wrapper h4,			
			#footer-widget-bar h4,
			#sidebar h4,
			#footer h4,
			#sidr h4{
				<?php echo $ozyHelper->font_style_render('', 
				ozy_get_option('typography_heading_font_weight_h4'), 
				ozy_get_option('typography_heading_h4_font_style'), 
				ozy_get_option('typography_heading_h4_font_size') . 'px', 
				ozy_get_option('typography_heading_line_height_h4', '1.5') . 'em', '', '',
				ozy_get_option('typography_heading_font_ls_h4'));?>;
			}
			#content h5,
			#footer-widget-bar h5,
			#sidebar h5,
			#footer h5,
			#sidr h5{
				<?php echo $ozyHelper->font_style_render('', 
				ozy_get_option('typography_heading_font_weight_h5'), 
				ozy_get_option('typography_heading_h5_font_style'), 
				ozy_get_option('typography_heading_h5_font_size') . 'px', 
				ozy_get_option('typography_heading_line_height_h5', '1.5') . 'em', '', '',
				ozy_get_option('typography_heading_font_ls_h5'));?>;
			}
			#content h6,
			#footer-widget-bar h6,
			#sidebar h6,
			#footer h6,
			#sidr h6{
				<?php echo $ozyHelper->font_style_render('', 
				ozy_get_option('typography_heading_font_weight_h6'), 
				ozy_get_option('typography_heading_h6_font_style'), 
				ozy_get_option('typography_heading_h6_font_size') . 'px', 
				ozy_get_option('typography_heading_line_height_h6', '1.5') . 'em', '', '',
				ozy_get_option('typography_heading_font_ls_h6'));?>;
			}
			body.single h2.post-title,
			.post-single h2.post-title {
				<?php echo $ozyHelper->font_style_render('', 
				ozy_get_option('typography_heading_font_weight_h1'), 
				ozy_get_option('typography_heading_h1_font_style'), 
				ozy_get_option('typography_heading_h1_font_size') . 'px', 
				'1.1em', '', '!important', 
				ozy_get_option('typography_heading_font_ls_h1'));?>
			}			
			#footer-widget-bar .widget a:hover,
			#sidebar .widget a:hover{color:<?php echo ozy_get_option('content_color')?>;}
			span.plus-icon>span{background-color:<?php echo ozy_get_option('content_color')?>;}
			.content-color,#single-blog-tags>a{color:<?php echo ozy_get_option('content_color'); ?> !important;}
			<?php
			if(ozy_get_metabox('show_loader') == '1' && $ozy_data->device_type === 'computer') {
			?>
			/* Loader
			/*-----------------------------------------------------------------------------------*/
			.deviceis_phone #loaderMask,.deviceis_tablet #loaderMask{display:none!important}#loaderMask{position:fixed;top:0;bottom:0;left:0;right:0;width:100%;height:100%;z-index:1000}#loaderMask>span{position:absolute;display:block;z-index:1001;top:50%;left:50%;margin-top:-48px;margin-left:-50px;width:100px;height:100px;line-height:100px;text-align:center;color:#fff;}.no-js #loaderMask{display:none}#loaderMask .loader-section{position:fixed;top:0;width:51%;height:100%;background:#000;z-index:10}#loaderMask .loader-section.section-left{left:0}#loaderMask .loader-section.section-right{right:0}.loaded #loaderMask .loader-section.section-left{-webkit-transform:translateX(-100%);-ms-transform:translateX(-100%);transform:translateX(-100%);-webkit-transition:all .7s .3s cubic-bezier(0.645,0.045,0.355,1);transition:all .7s .3s cubic-bezier(0.645,0.045,0.355,1)}.loaded #loaderMask .loader-section.section-right{-webkit-transform:translateX(100%);-ms-transform:translateX(100%);transform:translateX(100%);-webkit-transition:all .7s .3s cubic-bezier(0.645,0.045,0.355,1);transition:all .7s .3s cubic-bezier(0.645,0.045,0.355,1)}.loaded #loader{opacity:0;-webkit-transition:all .3s ease-out;transition:all .3s ease-out}.loaded #loaderMask{visibility:hidden;-webkit-transform:translateY(-100%);-ms-transform:translateY(-100%);transform:translateY(-100%);-webkit-transition:all .3s 1s ease-out;transition:all .3s 1s ease-out}#loader,#loader:before,#loader:after{border-radius:50%}#loader:before,#loader:after{position:absolute;content:''}#loader:before{width:5.2em;height:10.2em;background:#000;border-radius:10.2em 0 0 10.2em;top:-0.1em;left:-0.1em;-webkit-transform-origin:5.2em 5.1em;transform-origin:5.2em 5.1em;-webkit-animation:load2 2s infinite ease 1.5s;animation:load2 2s infinite ease 1.5s}#loader{font-size:11px;text-indent:-99999em;top:50%;left:50%;margin-left:-5em;margin-top:-5em;position:relative;width:10em;height:10em;box-shadow:inset 0 0 0 1em #FFF;-webkit-transform:translateZ(0);-ms-transform:translateZ(0);transform:translateZ(0);z-index:11}#loader:after{width:5.2em;height:10.2em;background:#000;border-radius:0 10.2em 10.2em 0;top:-0.1em;left:5.1em;-webkit-transform-origin:0 5.1em;transform-origin:0 5.1em;-webkit-animation:load2 2s infinite ease;animation:load2 2s infinite ease}@-webkit-keyframes load2{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes load2{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}			
			<?php
			}
			?>			
			
			/* Forms
			/*-----------------------------------------------------------------------------------*/
			input,select,textarea{
				<?php echo $ozyHelper->font_style_render(ozy_get_option('typography_font_face'), 
				ozy_get_option('typography_font_weight'), 
				ozy_get_option('typography_font_style'), 
				ozy_get_option('typography_font_size') . 'px', 
				ozy_get_option('typography_font_line_height') . 'em', 
				ozy_get_option('form_font_color'));?>
			}
			.wp-search-form i.oic-zoom{color:<?php echo ozy_get_option('form_font_color') ?>;}
			input:not([type=submit]):not([type=file]),select,textarea{
				background-color:<?php echo $ozyHelper->change_opacity(ozy_get_option('form_background_color'), '.3')?>;
				border-color:<?php echo ozy_get_option('form_background_color')?> !important;
			}
			#request-a-rate input:not([type=submit]):not([type=file]):hover,
			#request-a-rate textarea:hover,
			#request-a-rate select:hover,
			#request-a-rate input:not([type=submit]):not([type=file]):focus,
			#request-a-rate textarea:focus,
			#request-a-rate select:focus,
			#content input:not([type=submit]):not([type=file]):hover,
			#content textarea:hover,
			#content input:not([type=submit]):not([type=file]):focus,
			#content textarea:focus{border-color:<?php echo ozy_get_option('content_color_alternate')?> !important;}
			.generic-button,
			.woocommerce-page .button,
			input[type=button],
			input[type=submit],
			button[type=submit],
			#to-top-button,			
			.tagcloud>a,
			#mc_signup_submit {
				color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('form_button_font_color'))?> !important;
				background-color:<?php echo ozy_get_option('form_button_background_color')?>;
				border:1px solid <?php echo ozy_get_option('form_button_background_color')?>;
			}
			.woocommerce-page .button:hover,
			input[type=button]:hover,
			input[type=submit]:hover,
			button[type=submit]:hover,
			.tagcloud>a:hover{
				background-color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('form_button_background_color_hover'))?>;
				color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('form_button_font_color_hover'))?> !important;
				border:1px solid <?php echo ozy_get_option('form_button_background_color_hover')?>;
			}			
			
			/* Blog Comments & Blog Stuff
			/*-----------------------------------------------------------------------------------*/
			<?php if (is_single() && isset($post->post_type) && $post->post_type === 'post') { ?>
			body.single #main{background-color:<?php echo ozy_get_option('content_background_color_alternate') ?>;}
			body.single #content{background-color:<?php echo ozy_get_option('content_background_color') ?>;}
			body.single .post>article{padding-left:60px;padding-right:60px;}
			@media only screen and (max-width: 479px) {body.single .post>article{padding-left:20px;padding-right:20px;}}
			<?php } ?>
			#comments>h3>span{background-color:<?php echo ozy_get_option('content_color_alternate') ?>;}
			.comment-body>.comment-meta.commentmetadata>a,.comment-body .reply>a,#commentform .form-submit .submit{color:<?php echo ozy_get_option('content_color') ?> !important}
			#commentform .form-submit .submit{border-color:<?php echo ozy_get_option('content_color') ?> !important;}
			#commentform .form-submit .submit:hover{border-color:<?php echo ozy_get_option('content_color_alternate') ?> !important;}
			.single-post .post-submeta>.blog-like-link>span{color:<?php echo ozy_get_option('content_color_alternate3') ?> !important;}
			.featured-thumbnail-header>div{background-color:<?php echo $ozyHelper->hex2rgba(ozy_get_option('content_color_alternate'),'.4') ?>;}
			.post-meta p.g{color:<?php echo ozy_get_option('content_color_alternate2')?>;}	
			.ozy-related-posts .caption,
			.ozy-related-posts .caption>h4>a{
				color:<?php echo ozy_get_option('content_background_color') ?> !important;
				background-color:<?php echo ozy_get_option('content_color') ?>;
			}
			/*post formats*/
			.simple-post-format>div>span,
			.simple-post-format>div>h2,
			.simple-post-format>div>p,
			.simple-post-format>div>p>a,
			.simple-post-format>div>blockquote,
			.post-excerpt-audio>div>div{color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('content_background_color'))?> !important;}
			div.sticky.post-single {
				background-color:<?php echo ozy_get_option('primary_menu_separator_color') ?>;
				border-color:<?php echo ozy_get_option('content_color_alternate') ?>;
			}
			body:not(.page-template-page-isotope-blog):not(.page-template-page-isotope-fitrows-blog) #content .post .post-meta {
				position:absolute;
				left:20px;
				top:20px;
				width:65px;
				padding:8px 0 0 0;
				background-color: <?php echo ozy_get_option('content_color_alternate')?>;
				text-align:center;
			}
			body:not(.page-template-page-isotope-blog):not(.page-template-page-isotope-fitrows-blog) #content .post .post-meta span {
				display:block;
				font-weight:400;
				padding-bottom:4px !important;
			}
			#content .post .post-meta span.d,
			#content .post .post-meta span.c>span.n {
				font-size:24px !important;
				line-height:24px !important;
				font-weight:700;
			}
			#content .post .post-meta span.c>span.t {
				font-size:10px !important;
				line-height:10px !important;
			}
			#content .post .post-meta span.m,
			#content .post .post-meta span.y,
			#content .post .share-box>span {
				font-size:12px !important;
				line-height:12px !important;
				color: <?php echo ozy_get_option('content_color_alternate2')?> !important;
				text-transform:uppercase;
			}
			#content .post .post-meta span.d{
				font-weight:700 !important;
				color: <?php echo ozy_get_option('content_color_alternate2')?> !important;
			}
			#content .post .post-meta span.c {
				padding-top:8px;
				background-color: <?php echo ozy_get_option('content_color_alternate2')?>;
				color: <?php echo ozy_get_option('content_color_alternate3')?>;
			}
			
			/* Shortcodes
			/*-----------------------------------------------------------------------------------*/
			.ozy-postlistwithtitle-feed>a:hover{background-color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('form_button_background_color_hover'))?>;}
			.ozy-postlistwithtitle-feed>a:hover *{color:<?php echo $ozyHelper->rgba2rgb(ozy_get_option('form_button_font_color_hover'))?> !important;}			
			.ozy-accordion>h6.ui-accordion-header>span,
			.ozy-tabs .ozy-nav .ui-tabs-selected a,
			.ozy-tabs .ozy-nav .ui-tabs-active a,
			.ozy-toggle span.ui-icon{background-color:<?php echo ozy_get_option('content_color_alternate') ?>;}
			.ozy-tabs .ozy-nav .ui-tabs-selected a,
			.ozy-tabs .ozy-nav .ui-tabs-active a{border-color:<?php echo ozy_get_option('content_color_alternate') ?> !important;}
			.ozy-tabs .ozy-nav li a{color:<?php echo ozy_get_option('content_color');?> !important;}
			
			/*owl carousel*/
			.ozy-owlcarousel .item.item-extended>a .overlay-one *,
			.ozy-owlcarousel .item.item-extended>a .overlay-two *{color:<?php echo ozy_get_option('content_color_alternate3') ?> !important;}
			.ozy-owlcarousel .item.item-extended>a .overlay-one-bg{
				background-color:<?php echo ozy_get_option('content_color_alternate') ?>;
				background-color:<?php echo $ozyHelper->hex2rgba(ozy_get_option('content_color_alternate'),.50) ?>;
			}
			.ozy-owlcarousel .item.item-extended>a .overlay-two{
				background-color:<?php echo ozy_get_option('content_color_alternate') ?>;
				background-color:<?php echo $ozyHelper->hex2rgba(ozy_get_option('content_color_alternate'),.85) ?>;
			}
			.owl-theme .owl-controls .owl-page.active span{background-color:<?php echo ozy_get_option('content_color_alternate') ?>;}			
			.ozy-button.auto,.wpb_button.wpb_ozy_auto{
				background-color:<?php echo ozy_get_option('form_button_background_color') ?>;
				color:<?php echo ozy_get_option('form_button_font_color')?>;
			}
			.ozy-button.auto:hover,
			.wpb_button.wpb_ozy_auto:hover{
				border-color:<?php echo ozy_get_option('form_button_background_color_hover') ?>;
				color:<?php echo ozy_get_option('form_button_font_color_hover') ?> !important;
				background-color:<?php echo ozy_get_option('form_button_background_color_hover')?>;
			}			
			.ozy-icon.circle{background-color:<?php echo ozy_get_option('content_color') ?>;}
			.ozy-icon.circle2{
				color:<?php echo ozy_get_option('content_color') ?>;
				border-color:<?php echo ozy_get_option('content_color') ?>;
			}
			a:hover>.ozy-icon.square,
			a:hover>.ozy-icon.circle{background-color:transparent !important;color:<?php echo ozy_get_option('content_color') ?>;}
			a:hover>.ozy-icon.circle2{
				color:<?php echo ozy_get_option('content_color') ?>;
				border-color:transparent !important;
			}
			.wpb_content_element .wpb_tabs_nav li.ui-tabs-active{
				background-color:<?php echo ozy_get_option('content_color_alternate') ?> !important;
				border-color:<?php echo ozy_get_option('content_color_alternate') ?> !important;
			}
			.wpb_content_element .wpb_tabs_nav li,
			.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header{border-color:<?php echo ozy_get_option('primary_menu_separator_color') ?> !important;}
			.wpb_content_element .wpb_tabs_nav li.ui-tabs-active>a{color:<?php echo ozy_get_option('content_background_color');?> !important;}
			.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a,
			.wpb_content_element .wpb_accordion_header a{color:<?php echo ozy_get_option('content_color');?> !important;}
			.wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header{
				font-size:<?php echo ozy_get_option('typography_font_size') ?>px !important;
				line-height:<?php echo ozy_get_option('typography_font_line_height') ?>em !important
			}
			.pricing-table .pricing-table-column+.pricetable-featured .pricing-price{color:<?php echo ozy_get_option('content_color_alternate')?> !important;}
			.pricing-table li,
			.pricing-table .pricing-table-column:first-child,
			.pricing-table .pricing-table-column{border-color:<?php echo ozy_get_option('primary_menu_separator_color') ?> !important;}
			.pricing-table .pricing-table-column+.pricetable-featured,
			.pricing-table .pricing-table-column.pricetable-featured:first-child{border:4px solid <?php echo ozy_get_option('content_color_alternate') ?> !important;}
			.ozy-call-to-action-box>div.overlay-wrapper>a,
			.ozy-flex-box .hover-frame h6,
			.owl-for-sale>.overlay>p{
				background-color:<?php echo ozy_get_option('content_color_alternate') ?> !important;
				color:<?php echo ozy_get_option('content_color_alternate2') ?> !important;
			}
			.owl-for-sale>.overlay>span{
				background-color:<?php echo ozy_get_option('content_color_alternate3') ?> !important;
				color:<?php echo ozy_get_option('content_color_alternate2') ?> !important;
			}
			.owl-for-sale>.overlay>h5{
				background-color:<?php echo ozy_get_option('content_color_alternate2') ?> !important;
				color:<?php echo ozy_get_option('content_color_alternate3') ?> !important;
			}		
			.ozy-call-to-action-box>div.overlay-wrapper>h3{color:<?php echo ozy_get_option('content_color_alternate3') ?> !important;}
			.ozy-flex-box .hover-frame h6{font-family:<?php echo ozy_get_option('typography_font_face') ?> !important;}
			.ozy-flex-box .hover-frame-inner:hover {
				-webkit-box-shadow:0 0 0 5px <?php echo ozy_get_option('content_color_alternate') ?> inset;
				-moz-box-shadow:0 0 0 5px <?php echo ozy_get_option('content_color_alternate') ?> inset;
				box-shadow:0 0 0 5px <?php echo ozy_get_option('content_color_alternate') ?> inset;
			}			
			/* Shared Border Color
			/*-----------------------------------------------------------------------------------*/			
			.post .pagination>a,.ozy-border-color,#ozy-share-div.ozy-share-div-blog,.page-content table td,#content table tr,.post-content table td,.ozy-toggle .ozy-toggle-title,
			.ozy-toggle-inner,.ozy-tabs .ozy-nav li a,.ozy-accordion>h6.ui-accordion-header,.ozy-accordion>div.ui-accordion-content,.chat-row .chat-text,#sidebar .widget>h4,
			#sidebar .widget li,.ozy-content-divider,#post-author,.single-post .post-submeta>.blog-like-link,.widget ul ul,blockquote,.page-pagination>a,.page-pagination>span,
			.woocommerce-pagination>ul>li>*,#content select,body.search article.result,div.rssSummary,#content table tr td,#content table tr th,.widget .testimonial-box,
			.facts-bar,.facts-bar>.heading,.ozy-tabs-menu li,.ozy-tab,body.single-ozy_project .post-content h4,#ozy-tickerwrapper,#ozy-tickerwrapper>strong,.ozy-simple-image-grid>div>span,
			#single-blog-tags>a,.comment-body,#comments-form h3#reply-title,.ozy-news-box-ticker-wrapper .news-item {border-color:<?php echo ozy_get_option('primary_menu_separator_color') ?>;}
			#content table tr.featured {border:2px solid <?php echo ozy_get_option('content_color_alternate') ?> !important;}
			#ozy-tickerwrapper div.pagination>a.active>span,
			body.single-ozy_project .post-content h4:before,
			.header-line>span{background-color:<?php echo ozy_get_option('content_color_alternate') ?>;}
			/* Specific heading styling
			/*-----------------------------------------------------------------------------------*/	
		<?php
			$use_no_page_title_margin = $custom_header = false;
			if(!is_search()) {
				$post_id = ozy_get_woocommerce_page_id();		
				if($post_id > 0) {
					echo '.woocommerce-page article .page-title{
						display:none !important
					}';
				}

				/*to get custom post*/				
				if (is_single() && isset($post->post_type) && $post->post_type === 'post' && (int)ozy_get_option('page_blog_page_id')>0) { $post_id = ozy_get_option('page_blog_page_id'); }
				
				if(ozy_get_metabox('use_custom_title', 0, $post_id) == '1') {
					$_var = 'use_custom_title_group.0.ozy_buildme_meta_page_custom_title_';
					$h_height 	= ozy_get_metabox($_var . 'height', '170', $post_id);
					$h_bgcolor 	= ozy_get_metabox($_var . 'bgcolor', '', $post_id);
					$h_bgimage 	= ozy_get_metabox($_var . 'bg', '', $post_id);
					$h_bg_xpos	= ozy_get_metabox($_var . 'bg_x_position', '', $post_id);
					$h_bg_ypos	= ozy_get_metabox($_var . 'bg_y_position', '', $post_id);
					
					$h_css = (int)$h_height > 0 ? 'height:'. $h_height .'px;' : '';
					$h_css.= (int)$h_height > 0 ? $ozyHelper->background_style_render($h_bgcolor, $h_bgimage, 'cover', 'repeat', 'inherit', true, $h_bg_xpos, $h_bg_ypos) : '';
					echo '#page-title-wrapper{'. $h_css .'}';					
					$h_title_color = ozy_get_metabox($_var . 'color', 0, $post_id);
					if($h_title_color) {
						echo '#page-title-wrapper>div>h1{
							color:'. $h_title_color .';
						}';
					}
					$h_sub_title_color = ozy_get_metabox('use_custom_title_group.0.ozy_buildme_meta_page_custom_sub_title_color', 0, $post_id);
					if($h_sub_title_color) {
						echo '#page-title-wrapper>div>h4{
							color:'. $h_sub_title_color .';
							font-weight:300;
						}';
					}
					
					$h_title_position = ozy_get_metabox($_var . 'position', 0, $post_id);
					if($h_title_position) {
						echo '#page-title-wrapper>div>h1,
						#page-title-wrapper>div>h4{
							text-align:'. $h_title_position .';
							font-weight:300;
						}';
					}
					$custom_header = true;
				}else{
					echo '#page-title-wrapper{
						height:170px;
						background-color:rgb(243,243,243);
					}';
				}
			}else{				
				echo '#page-title-wrapper{
					height:170px;
					background-color:rgb(243,243,243);
				}';
			}
			
			if(is_page_template('page-countdown.php') || is_page_template('404.php') || is_404()) {
				echo '#main{margin-top:0!important}';
			}else{
				echo '@media only screen and (min-width: 1180px) {#main{margin-top:'. $menu_logo_height .';}}';
			}
			
			if(ozy_get_metabox('use_no_content_padding') === '1') {
				echo '#main>.container{
					padding-top:0!important;
				}';
			}
		?>		
			
			/* Conditional Page Template Styles
			/*-----------------------------------------------------------------------------------*/
			<?php
			if((is_home() || is_category() || is_archive() || is_tag() || is_author()) && !ozy_get_woocommerce_page_id()) {
				echo '#main{background-color:'. ozy_get_option('content_background_color_alternate') .' !important}';
			}
			?>
			/*project details*/
			.facts-bar{background-color:<?php echo $ozyHelper->change_opacity(ozy_get_option('content_background_color_alternate'),'.3') ?>}
			.ozy-tabs-menu li{background-color:<?php echo ozy_get_option('content_background_color_alternate') ?>}
			.ozy-tabs-menu li>a{color:<?php echo ozy_get_option('content_color') ?> !important}
			
			<?php
			//if(is_page_template('page-project.php')) {
				echo '#project-filter>li>a,.wpb_wrapper.isotope>.ozy_project>.featured-thumbnail>.caption>.heading>a{color:'.  ozy_get_option('content_color_alternate3', '#fff') .'!important}';
				echo '.wpb_wrapper.isotope>.ozy_project>.featured-thumbnail>.caption>.border>span,.wpb_wrapper.isotope>.ozy_project>.featured-thumbnail>.caption>.plus-icon,.wpb_wrapper.isotope>.ozy_project>.featured-thumbnail>.caption>p{color:'.  ozy_get_option('content_color_alternate2', '#000') .'!important;background-color:'.  ozy_get_option('content_color_alternate', '#ffc001') .'!important}';
				echo '#project-filter>li.active{border-color:'. ozy_get_option('content_color_alternate', '#000') .' !important;}';
				echo '#project-filter>li{background-color:' . ozy_get_option('content_color_alternate4', '#30303c') .'!important;}';
			//}
			if(is_page_template('page-grid-gallery.php')) {
			?>
			.ozy-grid-gallery .info {background-color:<?php echo ozy_get_option('content_color_alternate') ?>;}
			<?php
			}
			if(is_page_template('page-isotope-blog.php') || is_page_template('page-isotope-fitrows-blog.php')) {
			?>
			.gutter-sizer { width: 20px; }
			#content .wpb_row.vc_row-fluid>div.parallax-wrapper,
			#main>.container>#content{padding-bottom:40px !important;}
			#content .wpb_wrapper>.post{
				margin:0 0 20px 0 !important;
				float:left;
				clear:none !important;
				position:relative;
				background-color:#fff;
				border-radius:6px;
			}
			#content .wpb_wrapper>.post .post-meta {margin-bottom:10px;}
			.grid-sizer,
			#content .wpb_wrapper>.post {width:270px;}
			#content .wpb_wrapper>.post.post-large{
				width:560px;
				overflow:visible;
			}
			#content .wpb_wrapper>.post>.featured-thumbnail {
				border:0px solid #000;
				-webkit-transition: all .5s;
				transition: all .5s;
			}
			#content .wpb_wrapper>.post>.featured-thumbnail>a>img {
				border-top-left-radius:6px;
				border-top-right-radius:6px;				
			}
			#content .wpb_wrapper>.post>.featured-thumbnail,
			#content .wpb_wrapper>.post:not(.has_thumb).post-small .caption {
				border-top-left-radius:6px;
				border-top-right-radius:6px;				
			}
			#content .wpb_wrapper>.post.post-small .caption,
			#content .wpb_wrapper>.post.post-large>.featured-thumbnail {
				border-bottom-left-radius:6px;
				border-bottom-right-radius:6px;
			}
			#content .wpb_wrapper>.post.post-large>.featured-thumbnail {
				position:absolute;
				top:0;
				right:0;
				max-width:50%;
				height:100%;
				border-top-left-radius:0;
				border-bottom-left-radius:0;
				background-size:cover;
			}
			#content .wpb_wrapper>.post.post-large>.featured-thumbnail>img {
				height:100% !important;
				visibility:hidden;
			}
			.featured-thumbnail>a{
				background-color:transparent;
				height:inherit;
			}
			#content .wpb_wrapper>.post.post-large .caption {
				width:50%;
				height:100%;
				padding:30px 40px 30px 30px;
				-webkit-transition: all .5s;
				transition: all .5s;
				cursor:default;
			}
			#content .wpb_wrapper>.post .caption>h5,
			#content .wpb_wrapper>.post .caption>h5 a,
			#content .wpb_wrapper>.post .caption>h3,
			#content .wpb_wrapper>.post .caption>h3 a {
				border:none !important;
				line-height:1.1em !important;
			}
			#content .wpb_wrapper>.post .caption>h3 {
				font-size:22px;
				line-height:26px;
			}
			#content .wpb_wrapper>.post .caption>h5,
			#content .wpb_wrapper>.post.post-large .caption>h3 {
				margin:0 !important;
				padding:0 0 0 0 !important;
			}
			#content .wpb_wrapper>.post.post-small .caption {
				display:inline-block;
				width:100%;
				padding:30px 20px;
				background-color:#fff;
			}
			body.page-template-page-isotope-fitrows-blog #content .wpb_wrapper>.post.post-type-colorbox .caption { /*for fitRows*/
				position:absolute;
				top:0;
				left:0;
				height:100%;
				width:100%;
			}			
			#content .wpb_wrapper>.post>.featured-thumbnail .post-meta span,
			#content .wpb_wrapper>.post .caption .post-meta span {
				display:inline-block;
				padding:0 5px;
				margin-right:5px;
				font-size:10px;
				border-radius:2px;
				background-color: <?php echo ozy_get_option('content_color_alternate')?>;
			}
			#content .wpb_wrapper>.post>.featured-thumbnail .post-meta span>a,
			#content .wpb_wrapper>.post .caption .post-meta span>a {
				color: <?php echo ozy_get_option('content_color_alternate3')?>;
			}
			#content .wpb_wrapper>.post>.featured-thumbnail .post-meta {
				position:absolute;
				top:23px;
				left:20px;
			}
			#content .wpb_wrapper>.post .read-more {
				display:inline-block;
				margin-top:40px;
				border:1px solid #fff;
				border-radius:2px;
				padding:8px 20px;
				color:#fff;
				text-decoration:none;
				font-size:10px;
			}
			#content .wpb_wrapper>.post.post-type-colorbox {text-align:center;}
			.post.has_thumb .post-title,
			.featured-thumbnail{margin:0 !important;}
			.post-single{padding:0 !important;}

			.post-content img{height:auto;}
			.ozy-owlcarousel.single .owl-pagination{display:none;}
			div.sticky.post-single{border-color:transparent !important;background-color:transparent !important;}
			/*filters*/			
			#blog-filter{
				display:table;
				list-style:none;
				margin:0 auto 30px auto;
				padding:0 20px 0 0;
			}
			#blog-filter>li.s{
				width:1px;
				background-color:transparent !important;
				padding:0 !important;
			}
			#blog-filter>li {
				display:table-cell;
				padding:16px 20px;
				background-color:<?php echo ozy_get_option('content_color_alternate4', '#30303c') ?>!important;
				line-height:1em;
			}
			#blog-filter>li.active{
				border-bottom:2px solid yellow;
				padding-bottom:14px;	
			}
			#blog-filter>li>a {
				text-decoration:none;
				font-weight: 700;
				font-size: 12px;
				opacity:.6;
			}
			#blog-filter>li>a:hover,
			#blog-filter>li.active>a {opacity:1}
					
			/*.load_more_blog,*/
			#blog-filter>li>a{color:<?php echo ozy_get_option('content_color_alternate3', '#fff') ?>!important}
			#blog-filter>li.active{border-color:<?php echo ozy_get_option('content_color_alternate', '#000')?>;}
			
			/*.load_more_blog {
				display:block;
				text-align:center;
				background-color:<?php echo ozy_get_option('content_color_alternate4', '#30303c') ?>!important;
				margin-top:20px;
				padding:14px 0;
				border-radius:3px;
				font-weight:700;
				cursor:pointer;
			}*/
			@media only screen and (max-width: 1180px) {#content .wpb_wrapper>.post{width:33.333%;}}
			@media only screen and (max-width: 800px) {#content .wpb_wrapper>.post{width:50%;}}
			@media only screen and (max-width: 479px) {
				#content .wpb_wrapper>.post.post-large,
				#content .wpb_wrapper>.post{width:100%;}
				#content .wpb_wrapper>.post.post-type-colorbox .caption,
				#content .wpb_wrapper>.post.post-large .caption {
					position:relative !important;
					display:inline-block !important;
					width:100%;
				}
				#content .wpb_wrapper>.post.post-large>.featured-thumbnail {
					position:relative;
					max-width:100%;
					border-top-left-radius: 6px;
					border-top-right-radius: 6px;				
					border-bottom-right-radius: 0;
				}
				#blog-filter,
				#blog-filter>li{
					padding-right:0;
					display:inherit;
				}
			}			
			<?php
			}
			if(is_page_template('page-isotope-blog.php') || is_page_template('page-isotope-fitrows-blog.php') || is_page_template('page-project.php')) {
			?>
			.load_more_blog {
				display:block;
				margin-top:20px;
				padding:14px 0;
				border-radius:3px;
				cursor:pointer;
				background-color:<?php echo ozy_get_option('content_color_alternate4', '#30303c') ?>!important;
				color:<?php echo ozy_get_option('content_color_alternate3', '#fff') ?>!important;
				font-weight:700;
				text-align:center;				
			}
			body.page-template-page-project .load_more_blog {width: calc(100% - 20px);}
			<?php
			}
			if(is_page_template('page-classic-gallery.php') || 
			is_page_template('page-thumbnail-gallery.php') || 
			is_page_template('page-nearby-gallery.php') || 
			is_page_template('page-revo-full.php')) {
			?>
			#main>.container.no-vc,
			#content,
			#content.no-vc{
				max-width:100% !important;
				width:100% !important;
				padding-left:0 !important;
				padding-right:0 !important;
				padding-top:0 !important;
				padding-bottom:0 !important;
			}				
			<?php
			}
			$ozyHelper->render_custom_fonts();
			?>		
		</style>
		<?php
		$ozyHelper->render_google_fonts();
	}
	
	add_action( 'wp_head', 'ozy_buildme_style', 99 );
endif;
?>