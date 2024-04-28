<?php 
get_header(); 

$hide_title = false; $has_gallery = false;

/*get post format*/
$ozy_temporary_post_format = $ozy_current_post_format = get_post_format();
if ( false === $ozy_current_post_format ) { $ozy_current_post_format = 'standard'; }

if ( have_posts() ) while ( have_posts() ) : the_post();

?>
<div id="content" class="<?php echo esc_attr($ozy_data->_page_content_css_name); echo esc_attr($ozy_data->blog_has_super_header ? ' has-super-header' : ''); ?>">
    <div class="wpb_row vc_row-fluid">
        <div class="parallax-wrapper">
            <div class="vc_col-sm-12 wpb_column vc_column_container">
                <div class="wpb_wrapper">

                    <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                
                        <article>
							<?php
								/*here i am handling content to extract media objects*/
								ob_start();
								//if this is a gallery post, please remove gallery shortcode to render it as expected
								if( has_shortcode( get_the_content(), 'gallery' ) ) {
									 ozy_convert_classic_gallery();
									$has_gallery = true;
								}else{
									the_content();
								}
								
								$ozy_content_output = ob_get_clean();
								
								$video_files = vp_metabox('ozy_buildme_meta_project.ozy_buildme_meta_project_video_files');
								$project_map = esc_attr(vp_metabox('ozy_buildme_meta_project.ozy_buildme_meta_project_map'));
                            ?>
                            
                            <div id="ozy-tabs-container">
                                <ul class="ozy-tabs-menu">
                                    <li class="current"><a href="#ozy-tab-1"><?php esc_attr_e('Project Details', 'vp_textdomain') ?></a></li>
                                    <?php if(is_array($video_files) && count($video_files) > 0) { ?><li><a href="#ozy-tab-2"><?php esc_attr_e('Movies', 'vp_textdomain') ?></a></li><?php } ?>
                                    <?php if($project_map) { ?><li><a href="#ozy-tab-3"><?php esc_attr_e('Map', 'vp_textdomain') ?></a></li><?php } ?>
                                </ul>
                                <div class="ozy-tab">
                                    <div id="ozy-tab-1" class="ozy-tab-content">									
                                    <?php                                
										if( $has_gallery ) {
											echo $ozyHelper->project_unite_gallery();
										} else {
											if(!$ozy_data->blog_has_super_header) {
												if ( has_post_thumbnail() ) { 
													$thumbnail_image_src	= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' , false );
													$post_image_src 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog' , false );
													 if ( isset($thumbnail_image_src[0]) && isset($post_image_src[0])) { 
														 echo '<div class="featured-thumbnail" style="background-image:url('. esc_url($post_image_src[0]) .');"><a href="'. esc_url($thumbnail_image_src[0]) .'" class="fancybox"><span class="oic-simple-line-icons-49"></span></a>'; the_post_thumbnail('blog'); echo '</div>';
													 }
												}
											}
										}
                                    ?>
                                    </div>
                                    <div id="ozy-tab-2" class="ozy-tab-content">
                                    <?php
										/*video files*/
										if(is_array($video_files) && count($video_files) > 0) {
											echo '<div id="unite-gallery-'. rand(100,100000) .'" class="unite-gallery init-later" style="display:none;">';
											foreach($video_files as $video) {
												if($video['ozy_buildme_meta_project_meta_video_youtube']) {
													echo '<img alt="'. esc_attr(strip_tags($video['ozy_buildme_meta_project_meta_video_label'])) .'" data-type="youtube" 
														data-videoid="'. esc_attr(strip_tags($video['ozy_buildme_meta_project_meta_video_youtube'])) .'" 
														data-description="'. esc_attr(strip_tags($video['ozy_buildme_meta_project_meta_video_label'])) .'">';	
												}else if($video['ozy_buildme_meta_project_meta_video_vimeo']) {
													echo '<img alt="'. esc_attr(strip_tags($video['ozy_buildme_meta_project_meta_video_label'])) .'"
														 data-type="vimeo"
														 src="'. esc_url($video['ozy_buildme_meta_project_meta_video_img']) .'"
														 data-image="'. esc_url($video['ozy_buildme_meta_project_meta_video_img']) .'"
														 data-videoid="'. esc_attr(strip_tags($video['ozy_buildme_meta_project_meta_video_vimeo'])) .'"
														 data-description="'. esc_attr(strip_tags($video['ozy_buildme_meta_project_meta_video_label'])) .'">';
												}
											}
											echo '</div>';
										}
									?>
                                    </div>
                                    <div id="ozy-tab-3" class="ozy-tab-content">
                                    <?php
										echo do_shortcode('[ozy_vc_prettymap address="'. $project_map .'" height="400px" extra_class_name="init-later"]');
									?>
                                    </div>
                                </div>
                            </div>
                            
							<?php
                                /*meta boxes*/
                                $meta_boxes = vp_metabox('ozy_buildme_meta_project.ozy_buildme_meta_project_meta_info');
                                if(is_array($meta_boxes) && count($meta_boxes) > 1) {
							?>
                            <div class="clear"></div> 
                            <div class="facts-bar">
                            	<h6 class="heading"><?php esc_attr_e('FACTS', 'vp_textdomain') ?></h6>
                            <?php
                                    echo '<ul>';
                                    foreach($meta_boxes as $meta) {
                                        if($meta['ozy_buildme_meta_project_meta_info_label'] && $meta['ozy_buildme_meta_project_meta_info_value']) {
                                            echo '<li>'. ($meta['ozy_buildme_meta_project_meta_info_icon'] ? '<i class="'. ozy_safe_html_output($meta['ozy_buildme_meta_project_meta_info_icon']) .'"></i>':'') .'<strong>'. ozy_safe_html_output($meta['ozy_buildme_meta_project_meta_info_label']) . ':</strong> '. ozy_safe_html_output($meta['ozy_buildme_meta_project_meta_info_value']) .'</li>';
                                        }
                                    }
                                    echo '</ul>';
							?>
                            </div>                            
                            <?php
                                }
                            ?>
                            
                            <div class="clear"></div> 
                            
                            <div class="post-content">                               
                                <?php
									echo $ozy_content_output;
                                ?>
                            </div><!--.post-content-->

                            <?php edit_post_link('<p><small>Edit this entry</small></p>','',''); ?>
                            
                        </article>
                
                    </div><!-- #post-## -->
                    
                </div>
            </div>
        </div>
    </div>       
</div><!--#content-->

<?php 
endwhile; /* end loop */
get_footer(); 
?>