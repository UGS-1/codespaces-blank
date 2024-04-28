			<?php
			global $post;
			//$ozy_data->blog_has_super_header = false;
			
			/*header slider*/
			ozy_put_header_slider($ozy_data->header_slider);

			ozy_page_master_meta_params();
			
			ozy_blog_meta_params();
			
			// meta params & bg slider for page
			if (isset($post->post_type) && $post->post_type === 'ozy_project') {
				ozy_page_meta_params('project');
			}else if(is_single()) {
				ozy_page_meta_params('blog');
			}else{
				ozy_page_meta_params();
			}
			
			$content_css 			= $ozy_data->_page_content_css_name;
			$page_title_available 	= is_page() || is_search() || is_archive() || is_category() || is_home() || (isset($post->post_type) && $post->post_type === 'ozy_project');
			
			$shop_page_id = ozy_get_woocommerce_page_id();
			if ($shop_page_id > 0) { 
				ozy_woocommerce_meta_params();
				$content_css = $ozy_data->_woocommerce_content_css_name;
				if(!is_product_category() && !is_product_tag()) {									
					if(ozy_get_metabox('hide_title', 0, $shop_page_id) !== '1') {						
						$ozy_data->_page_custom_page_title = 
							ozy_get_metabox('use_custom_title', 0, $shop_page_id) == '1' ? 
							ozy_get_metabox('use_custom_title_group.0.ozy_buildme_meta_page_custom_title', '', $shop_page_id) : 
							get_the_title($shop_page_id);
						$ozy_data->_page_custom_page_sub_title = 
							ozy_get_metabox('use_custom_title_group.0.ozy_buildme_meta_page_custom_sub_title', '', $shop_page_id);
					}else{
						$ozy_data->_page_hide_page_title = '1';
					}
					$page_title_available = true;
				}else if(is_product_category() || is_product_tag()){ // if is product category page
					global $wp_query;
					$cat_obj = $wp_query->get_queried_object();
					if($cat_obj)    {
						$ozy_data->_page_custom_page_title = $cat_obj->name;
					}				
				}
			}else if (is_single() && isset($post->post_type) && $post->post_type === 'post'){
				$custom_blog_page_id = ozy_get_option('page_blog_page_id');
				//get current WPML language of selected page's id
				if(function_exists('icl_object_id') && $custom_blog_page_id){ $custom_blog_page_id = icl_object_id($custom_blog_page_id,'page',false,ICL_LANGUAGE_CODE); }
				if($custom_blog_page_id) {
					$ozy_data->_page_custom_page_title = 
						ozy_get_metabox('use_custom_title', 0) == '1' ? 
						ozy_get_metabox('use_custom_title_group.0.ozy_buildme_meta_page_custom_title', '', $custom_blog_page_id) : get_the_title($custom_blog_page_id);
					$ozy_data->_page_custom_page_sub_title = 
						ozy_get_metabox('use_custom_title_group.0.ozy_buildme_meta_page_custom_sub_title', '', $custom_blog_page_id);	
					$ozy_data->_page_hide_page_title = '0';
					$page_title_available = true;
					$ozy_data->_page_title_custom_id_for_post = $custom_blog_page_id;
				}				
			}else{				
				if(is_search()) {
					$ozy_data->_page_custom_page_title 		= esc_attr__('Search results for: "', 'vp_textdomain') . get_search_query() . '"';
					$ozy_data->_page_custom_page_sub_title 	= '';
					$ozy_data->_page_hide_page_title = '0';
				}else if(is_home()) {
					$ozy_data->_page_custom_page_title 		= esc_attr__('Blog', 'vp_textdomain');
					$ozy_data->_page_custom_page_sub_title 	= '';
					$ozy_data->_page_hide_page_title = '0';
				}else if(is_author()) {
					if(isset($_GET['author_name'])){$curauth = get_userdatabylogin($author_name);}else{$curauth = get_userdata(intval($author));}
					$ozy_data->_page_custom_page_title 		= esc_attr__('About: ', 'vp_textdomain') . $curauth->display_name;
					$ozy_data->_page_custom_page_sub_title 	= '';
					$ozy_data->_page_hide_page_title = '0';
				}else if(is_category()) {
					$ozy_data->_page_custom_page_title 		= esc_attr__('Category Archives: ', 'vp_textdomain') . single_cat_title( '', false ) ;
					$ozy_data->_page_custom_page_sub_title 	= '';
					$ozy_data->_page_hide_page_title = '0';
				}else if(is_archive()) {
					if ( is_day() ) : /* if the daily archive is loaded */
						$ozy_data->_page_custom_page_title = sprintf(esc_attr__('Daily Archives: %s', 'vp_textdomain'), get_the_date() );
					elseif ( is_month() ) : /* if the montly archive is loaded */
						$ozy_data->_page_custom_page_title = sprintf( esc_attr__('Monthly Archives: %s', 'vp_textdomain'), get_the_date('F Y'));
					elseif ( is_year() ) : /* if the yearly archive is loaded */
						$ozy_data->_page_custom_page_title = sprintf(esc_attr__( 'Yearly Archives: %s', 'vp_textdomain'), get_the_date('Y'));
					else : /* if anything else is loaded, ex. if the tags or categories template is missing this page will load */
						$ozy_data->_page_custom_page_title = esc_attr__('Blog Archives', 'vp_textdomain');
					endif;
					$ozy_data->_page_custom_page_sub_title 	= '';
					$ozy_data->_page_hide_page_title = '0';					
				}else if(is_tag()) {
					$ozy_data->_page_custom_page_title = sprintf(esc_attr__( 'Tag Archives: %s', 'vp_textdomain'), single_tag_title( '', false ));
					$ozy_data->_page_custom_page_sub_title 	= '';
					$ozy_data->_page_hide_page_title = '0';					
				}else{
					if(isset($post->ID)) {
						$ozy_data->_page_custom_page_title = 
							ozy_get_metabox('use_custom_title', 0) == '1' ? 
							ozy_get_metabox('use_custom_title_group.0.ozy_buildme_meta_page_custom_title', '') : get_the_title($post->ID);
						$ozy_data->_page_custom_page_sub_title = 
							ozy_get_metabox('use_custom_title_group.0.ozy_buildme_meta_page_custom_sub_title', '', $post->ID);	
					}
				}
			}
			
			/*page title*/			
			if($ozy_data->_page_hide_page_title != '1' && $page_title_available && !$ozy_data->hide_everything_but_content) { 
			?>
			<div id="page-title-wrapper">
				<div>
					<h1 class="page-title"><?php echo trim($ozy_data->_page_custom_page_title) ? $ozy_data->_page_custom_page_title : get_the_title() ?></h1>
					<?php if($ozy_data->_page_custom_page_sub_title) { echo '<h4>'. $ozy_data->_page_custom_page_sub_title .'</h4>'; } ?>
					<?php if($ozy_data->bread_crumbs != 'disabled') { ozy_the_breadcrumb(); } ?>
				</div>
			</div>
			<?php
			}

			?>