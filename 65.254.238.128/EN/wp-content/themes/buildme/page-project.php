<?php
/*
Template Name: Projects
*/
get_header();

ozy_project_meta_params();

/* Widgetized LEFT sidebar */
if(function_exists( 'dynamic_sidebar' ) && $ozyHelper->hasIt($ozy_data->_page_content_css_name,'left-sidebar') && $ozy_data->_page_sidebar_name) {
?>
	<div id="sidebar" class="<?php echo esc_attr($ozy_data->_page_content_css_name); ?>">
		<ul>
        	<?php dynamic_sidebar( $ozy_data->_page_sidebar_name ); ?>
		</ul>
	</div>
	<!--sidebar-->
<?php
}
?>
<div id="content" class="<?php echo esc_attr($ozy_data->_page_content_css_name); ?> template-clean-page">
    <?php if ( have_posts() && $ozy_data->_page_hide_page_content != '1') while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
            <article>
                
                <div class="post-content page-content">
                    <?php the_content(); ?>
					
                    <!--filter-->
                    <ul id="project-filter">
                        <li class="active"><a href="#all" data-filter=".category-all"><?php esc_attr_e('ALL PROJECTS', 'vp_textdomain') ?></a></li>
                        <?php
                        echo ozy_print_project_filter($ozy_data->_project_project_categories_tree, $ozy_data->_project_category_filter_parent, 0, $ozy_data->_project_category_search_type, '');
                        ?>
                    </ul>
                    
                    <!--grid-->
                    <div class="wpb_wrapper isotope column-<?php echo esc_attr($ozy_data->_project_column_count)?>">
					<?php
						$args = array(
							'post_type' 			=> 'ozy_project',
							'posts_per_page'		=> $ozy_data->_project_post_per_load,
							'orderby' 				=> $ozy_data->_project_orderby,
							'order' 				=> $ozy_data->_project_order,
							'ignore_sticky_posts' 	=> 1,
							'meta_key' 				=> '_thumbnail_id',
							'tax_query' => array(
								array(
									'taxonomy' 	=> 'project_category',
									'field' 	=> 'id',
									'terms' 	=> $ozy_data->_project_include_categories,
									'operator' 	=> 'IN'
								),
							),											
						);

						$the_query = new WP_Query( $args );

						while ( $the_query->have_posts() ) {
							$the_query->the_post();
														
							$tax_terms = get_the_terms($post->ID, 'project_category');						
							$tax_terms_slug = wp_list_pluck($tax_terms, 'slug');
							$tax_terms_name = wp_list_pluck($tax_terms, 'name');
						?>
						<div <?php post_class('category-all category-' . implode(' category-', $tax_terms_slug) . ' post-single'); ?>>                        
						<?php
							$thumbnail_image_src = $post_image_src = array();
							if ( has_post_thumbnail() ) { 
								$thumbnail_image_src 	= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog' , false );
								$post_image_src 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' , false );						
	
	
								if ( isset($thumbnail_image_src[0]) && isset($post_image_src[0])) { 
									echo '<div class="featured-thumbnail" style="background-image:url('. esc_url($post_image_src[0]) .');">';
										echo '<div class="caption">';
											echo '<h3 class="heading">';
											echo '<a href="'. esc_attr(get_permalink()) .'" title="'. esc_attr(get_the_title()) .'" rel="bookmark">' . 
											( get_the_title() ? get_the_title() : get_the_time('F j, Y') ) 
											. '</a>';
											echo '</h3>';
											echo '<div class="border"><span></span></div>';
											echo '<p>' . implode(', ', $tax_terms_name) . '</p>';
											echo '<a href="'. esc_url($thumbnail_image_src[0]) .'" class="fancybox plus-icon" title="'. esc_attr(get_the_title()) .'" rel="project-gallery"><i class="oic-plus-1"></i></a>';
										echo '</div>'; 
									the_post_thumbnail('blog');
									echo '</div>'; 
								}
							}

							?>
                        </div><!--.post-single-->                           
                        <?php													
						}
					?>
                    </div>
                    <!--grid-->
					
                    <?php if($the_query->found_posts > $ozy_data->_project_post_per_load) { ?>
                    <span class="load_more_blog" data-layout_type="project" data-item_count="<?php echo esc_attr($ozy_data->_project_post_per_load) ?>" data-offset="0" data-found="<?php echo esc_attr($the_query->found_posts) ?>" data-order_by="<?php echo esc_attr($ozy_data->_project_orderby) ?>" data-order="<?php echo esc_attr($ozy_data->_project_order) ?>" data-category_name="<?php  echo esc_attr((is_array($ozy_data->_project_include_categories) ? join($ozy_data->_project_include_categories,',') : '')) ?>" data-loadingcaption="<?php echo esc_attr__('LOADING...', 'vp_textdomain') ?>" data-loadmorecaption="<?php echo esc_attr__('LOAD MORE POSTS', 'vp_textdomain') ?>"><?php echo esc_attr__('LOAD MORE', 'vp_textdomain') ?></span>
					<!--.load more project-->
                    <?php } ?>
                </div><!--.post-content .page-content -->
            </article>
			
        </div><!--#post-# .post-->

    <?php endwhile; ?>
</div><!--#content-->
<?php
/* Widgetized RIGHT sidebar */
if(function_exists( 'dynamic_sidebar' ) && $ozyHelper->hasIt($ozy_data->_page_content_css_name,'right-sidebar') && $ozy_data->_page_sidebar_name) {
?>
	<div id="sidebar" class="<?php echo esc_attr($ozy_data->_page_content_css_name); ?>">
		<ul>
        	<?php dynamic_sidebar( $ozy_data->_page_sidebar_name ); ?>
		</ul>
	</div>
	<!--sidebar-->
<?php
}
get_footer();
?>
