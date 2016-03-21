<!-- Blog Start -->
<div class="news">
        <?php 
	global $post_id;
    //$row = $wpdb->get_row("SELECT name from ".$wpdb->prefix."terms WHERE slug = " . $cs_blog_cat_db );
    //echo $row->name; 
	if($cs_news_title_db <> ''){echo '<h2 class="heading">'.$cs_news_title_db.'</h2>';}
    ?>
        <div class="box-in">
	<?php
	global $post,$post_id;
		if ( empty($_GET['page_id_all']) ) $_GET['page_id_all'] = 1;
		$count_post = 0;
		$args = array( 'posts_per_page' => '-1', 'post_type' => 'post', 'category_name' => "$cs_news_cat_db" ,'post_status' => 'publish');
		$custom_query = new WP_Query($args);
			while ( $custom_query->have_posts()) : $custom_query->the_post();
				$count_post++;
			endwhile;
			if ( $cs_news_pagination_db == "Single Page" ) $cs_news_num_post_db = -1;	
			$args = array( 'posts_per_page' => "$cs_news_num_post_db", 'paged' => $_GET['page_id_all'], 'category_name' => "$cs_news_cat_db" ,'post_status' => 'publish');
			$custom_query = new WP_Query($args);
			$counter_news = 0;
			while ( $custom_query->have_posts()) : $custom_query->the_post();
				$counter_news++;
				$image_id = cs_get_post_thumbnail($post->ID, 690, 270);
				?>                    
					<!-- Post Start -->
					<div class="post <?php if($image_id == ''){ echo 'no-image';}?>">  
                        <?php 
						if($counter_news == 1){							
							if($image_id <> ''){echo "<a href='".get_permalink()."' class='thumb'>".$image_id."</a>";}?>
                        <?php }?>
                        <h2><a href="<?php echo get_permalink()?>"><?php echo get_the_title();?></a></h2>
                        <div class="post-opts">
                            <p class="author">
                            	<?php printf( __('By: %s',CSDOMAIN), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.get_the_author().'</a>' )?>
                            </p>
                            <p class="date"><?php echo date( get_option('date_format'), strtotime(get_the_date()) );?></p>
                            <p class="comment-txt">
                            	<a href="<?php echo get_permalink();?>#comments"><?php echo get_comments_number($post->ID);?> <?php _e('Comments',CSDOMAIN)?></a>
                            </p>
                        </div>
                        <p>
                            <?php   //echo get_the_excerpt()."<br /><br />";
								$get_the_excerpt = trim(preg_replace('/<a[^>]*>(.*)<\/a>/iU','', get_the_content()));
								$new_excerpt = trim(preg_replace('/\[(.*?)\]/ ','', $get_the_excerpt));															
								echo substr($new_excerpt, 0, "$cs_news_excerpt_db");
								if ( strlen( $new_excerpt ) > "$cs_news_excerpt_db" ) {
									echo '... <a class="readmore" href="'.get_permalink().'"> '.__('More...',CSDOMAIN).'</a>';
								}
								wp_link_pages( 'before=<p class="link-pages">Page: ' );
							?>
                        </p>
					</div>
						<?php
				endwhile;
		  $qrystr = '';
                        if (cs_pagination($count_post, $cs_news_num_post_db,$qrystr) <> ''){
                            // pagination start
                            if ( $cs_news_pagination_db == "Show Pagination" and $cs_news_num_post_db > 0 ) {
							echo "<div class='pagination'><h5>".__('Pages:',CSDOMAIN)."</h5><ul>";
                                    $qrystr = '';
                                    if ( isset($_GET['page_id']) ) $qrystr = "&page_id=".$_GET['page_id'];
                                echo cs_pagination($count_post, $cs_news_num_post_db,$qrystr);
                                echo "</ul></div>";
                            }
                            // pagination end
                        }	?>
	</div>
</div>