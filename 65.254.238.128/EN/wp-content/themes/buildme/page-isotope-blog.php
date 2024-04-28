<?php 
/*
Template Name: Blog : Masonry
*/
get_header(); 
?>
	<div id="content" class="<?php echo esc_attr($ozy_data->_page_content_css_name); ?>">
        
        <div class="wpb_row vc_row-fluid">
			<div class="parallax-wrapper">
            	<div class="vc_col-sm-12 wpb_column vc_column_container">
	                <?php if($ozy_data->_blog_filter_visiblity != '0'){ ?>
                	<ul id="blog-filter" class="button-group">
                        <li class="active"><a href="#all" data-filter=".category-all"><?php esc_attr_e('SHOW ALL', 'vp_textdomain') ?></a></li>
						<?php
                        ozy_print_blog_filter();
                        ?>
                    </ul>
					<?php } ?>
                	<div class="wpb_wrapper isotope">
                        <div class="grid-sizer"></div>
                        <div class="gutter-sizer"></div>
						<?php
							$color_meta_path = 'ozy_buildme_meta_post.ozy_buildme_meta_post_thumbnail_color_group.0.ozy_buildme_meta_post_thumbnail_color_';

							$args = array(
                                'cat'				=> $ozy_data->_blog_include_categories,
                                'ignore_sticky_posts' => '1',
								'post_type' 		=> 'post',
                                'post_status'		=> 'publish',
								'posts_per_page'	=> $ozy_data->_blog_post_per_load,
                                'orderby' 			=> $ozy_data->_blog_orderby,
                                'order' 			=> $ozy_data->_blog_order,
								'tax_query' 			=> array(
									array(
										'taxonomy' => 'post_format',
										'field' => 'slug',
										'terms' => array( 'post-format-quote', 'post-format-status', 'post-format-link', 'post-format-aside' ),
										'operator' => 'NOT IN'
									)
								)
							);
                            											
							$the_query = new WP_Query( $args );

							while ( $the_query->have_posts() ) {
								$the_query->the_post();							
							
                                global $more, $ozy_global_params; $more = 0;
								$excerpt_character_count = 130; $title_color = $text_color = $overlay_color = ''; $heading_size = 'h5';
								$post_item_size = esc_attr(vp_metabox('ozy_buildme_meta_post.ozy_buildme_meta_post_item_size')); $post_item_size = !$post_item_size ? 'small' : $post_item_size;
								$post_type = esc_attr(vp_metabox('ozy_buildme_meta_post.ozy_buildme_meta_post_item_type')); $post_type = $post_type ? $post_type : 'standard';
                                
								if(vp_metabox('ozy_buildme_meta_post.ozy_buildme_meta_post_thumbnail_color')==='1') {
									$title_color = ' style="color:'. esc_attr(vp_metabox($color_meta_path . 'heading')) .'!important"';
									$text_color = ' style="border-color:'. esc_attr(vp_metabox($color_meta_path . 'text')) .';color:'. esc_attr(vp_metabox($color_meta_path . 'text')) .'!important"';
									$overlay_color = ' style="background-color:'. esc_attr(vp_metabox($color_meta_path . 'overlay')) .'!important"';
								}
								
                                /*get post format*/
                                $ozy_temporary_post_format = $ozy_current_post_format = get_post_format();
                                if ( false === $ozy_current_post_format ) {
                                    $ozy_current_post_format = 'standard';
                                }

                        ?>
						<div <?php post_class('category-all post-single post-format-'. $ozy_current_post_format . ' post-' . esc_attr($post_item_size) . ' post-type-' . esc_attr($post_type) );?>>                        
						<?php
							if($post_type !== 'colorbox') {
								$thumbnail_image_src = $post_image_src = array();
								if ( has_post_thumbnail() ) { 
									$thumbnail_image_src 	= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog' , false );
									$post_image_src 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' , false );						
		
									if ( isset($thumbnail_image_src[0]) && isset($post_image_src[0])) { 
										if($post_item_size === 'large') {
											echo '<div class="featured-thumbnail" style="background-image:url('. esc_url($thumbnail_image_src[0]) .')"><a href="'. esc_url($thumbnail_image_src[0]) .'" class="fancybox"></a>'; the_post_thumbnail('blog'); echo '</div>';										
										}else{
											echo '<div class="featured-thumbnail"><a href="'. esc_url($thumbnail_image_src[0]) .'" class="fancybox"></a>'; 
											the_post_thumbnail('blog'); 
											echo '<div class="post-meta"><span '. $overlay_color .'>';the_category('</span><span '. $overlay_color .'>');echo '</span></div><!--#post-meta-->';
											echo '</div>';
										}
									}
								}
							}
							?>
                            <div class="caption" <?php echo $post_type === 'colorbox' ? $overlay_color : ''; ?>>
                                <?php
                                if($post_item_size === 'large' || $post_type === 'colorbox') {
									echo '<div class="post-meta"><span '. $overlay_color .'>';the_category('</span><span '. $overlay_color .'>');echo '</span></div><!--#post-meta-->';
								}
                                if($post_item_size === 'large' || $post_type === 'colorbox') {
									$excerpt_character_count = 160;
									$heading_size = 'h3';
								}
								echo '<'. $heading_size .' class="post-title">';
									echo '<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="a-page-title" rel="bookmark" '. $title_color .'>'. ( get_the_title() ? get_the_title() : get_the_time('F j, Y') ) .'</a>';
								echo '</'. $heading_size .'>';
								echo '<p '. $text_color .'>' . ozy_excerpt_max_charlength($excerpt_character_count, true, true) . '</p>';
								
								if($post_item_size === 'large' || $post_type === 'colorbox') {
									echo '<a href="'. esc_url(get_permalink()) .'" class="read-more" '. $text_color .'>'. esc_attr__('READ MORE &rarr;', 'vp_textdomain') .'</a>';
								}
                                ?>
                			</div>
                        </div><!--.post-single-->        
                        <?php } ?>
					</div>
                    
					<?php
                    if($the_query->found_posts > $ozy_data->_blog_post_per_load) { ?>
                    <span class="load_more_blog" data-layout_type="post" data-item_count="<?php echo esc_attr($ozy_data->_blog_post_per_load) ?>" data-offset="0" data-found="<?php echo esc_attr($the_query->found_posts) ?>" data-order_by="<?php echo esc_attr($ozy_data->_blog_orderby) ?>" data-order="<?php echo esc_attr($ozy_data->_blog_order) ?>" data-category_name="<?php  echo is_array($ozy_data->_blog_include_categories) ? join($ozy_data->_blog_include_categories,',') : $ozy_data->_blog_include_categories ?>" data-loadingcaption="<?php echo esc_attr__('LOADING...', 'vp_textdomain') ?>" data-fitrows="false" data-loadmorecaption="<?php echo esc_attr__('LOAD MORE', 'vp_textdomain') ?>"><?php echo esc_attr__('LOAD MORE', 'vp_textdomain') ?></span>
                    <?php } ?>
				</div>
        	</div>
        </div>
	</div><!--#content-->
    
<?php
get_footer();
?>