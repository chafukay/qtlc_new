<?php
class blogpost_show extends WP_Widget
{
  
  
  
    public function __construct() {
		
			parent::__construct(
			'blogpost_show', // Base ID
			__( 'Chimps : University News',CSDOMAIN ), // Name
			array( 'classname' => 'uni-news', 'description' => 'Select Recent Post to show', ) // Args
			);
		}
  
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$get_names_posts = isset( $instance['get_names_posts'] ) ? esc_attr( $instance['get_names_posts'] ) : '';
	$nop = isset( $instance['nop'] ) ? esc_attr( $instance['nop'] ) : '';
?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	  <?php _e('Title',CSDOMAIN)?> 
	  <input class="upcoming" size="40" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
<p>
  <label for="<?php echo $this->get_field_id('get_names_posts'); ?>">
	 <?php _e('Select Category',CSDOMAIN)?>
	  <select id="<?php echo $this->get_field_id('get_names_posts'); ?>" name="<?php echo $this->get_field_name('get_names_posts'); ?>" style="width:225px">
		<?php
        global $wpdb,$post;
		$categories = get_categories('taxonomy=category&child_of=0&hide_empty=0'); 
			if($categories != ''){}
				foreach ( $categories as $category){ ?>
                    <option <?php if(esc_attr($get_names_posts) == $category->term_id){echo 'selected';}?> value="<?php echo $category->term_id;?>" >
	                    <?php echo substr($category->name, 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?>
                    </option>						
			<?php }?>
      </select>
  </label>
  </p>     
  <p>
  <label for="<?php echo $this->get_field_id('nop'); ?>">
	 <?php _e('Number of Posts To Display',CSDOMAIN)?>
	  <input class="upcoming" size="2" id="<?php echo $this->get_field_id('nop'); ?>" name="<?php echo $this->get_field_name('nop'); ?>" type="text" value="<?php echo esc_attr($nop); ?>" />
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['get_names_posts'] = $new_instance['get_names_posts'];	
	$instance['nop'] = $new_instance['nop'];
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$get_names_posts = isset( $instance['get_names_posts'] ) ? esc_attr( $instance['get_names_posts'] ) : '';		
		if($instance['nop'] == ""){$instance['nop'] = '-1';}
		echo $before_widget;	
		// WIDGET display CODE Start
		if (!empty($title))
			echo $before_title;
			echo $title;
			echo $after_title;
			global $wpdb, $post;?>
            <!-- Links Start -->                                 
                <?php
				$newterm = get_term_by('id', $get_names_posts, 'category');
					$args = array(
						'posts_per_page'			=> $instance['nop'],
						'post_type'					=> 'post',
						'post_status'				=> 'publish',
						'order'						=> 'DESC',
						'tax_query' => array(
								array(
									'taxonomy' => 'category',
									'field' => 'term_id',
									'terms' => array( $get_names_posts)
								) 
							)
						);
                    //query_posts($args);
					$custom_query = new WP_Query($args);
					 if ( $custom_query->have_posts() <> "" ) {
					 ?>
					<div class="box-in">	
						<ul class="news-list">
					 <?php
					 $counter_news = 0;
                        while ( $custom_query->have_posts() ): $custom_query->the_post();
						$image_id = cs_get_post_thumbnail($post->ID, 299, 175);
						$counter_news++;
						if($counter_news == 1){?>
							<li class="first-element">
                                <div class="video">
                                    <?php
                                        if ($image_id  <> "" ) {
                                            echo "<a href='".get_permalink()."'>".$image_id."</a>";
                                        }
                                        else {
                                            //echo "<img width='301' height='110' src='".get_template_directory_uri()."/images/no_image.jpg' />";
                                        }							
                                    ?>
                                </div>
                                <div class="news-desc">
                                    <h4><a href="<?php echo get_permalink(); ?>" class="colr"><?php echo get_the_title();?></a></h4>
                                    <p class="date"><?php echo date( get_option('date_format'), strtotime(get_the_date()) );?></p>
                                    <p>
                                        <?php 
                                            if ( $post->post_excerpt <> "" ) $get_the_excerpt = $post->post_excerpt;
                                            else $get_the_excerpt = $post->post_content;
                                            $get_the_excerpt = trim(preg_replace('/<a[^>]*>(.*)<\/a>/iU','', $get_the_excerpt ));
                                            $new_excerpt = trim(preg_replace('/\[(.*?)\]/ ','', $get_the_excerpt));															
                                            echo substr($new_excerpt, 0, 165);
                                            if ( strlen( $new_excerpt ) > 165 ) {
                                                echo '... <a class="readmore" href="'.get_permalink().'"> Read more</a>';
                                            }
                                        ?>
                                    </p>
                                </div>
                            </li>
						<?php }else{?>
                        <!-- News List Start -->
                        	<li class="small_thumbs">
                            	<?php
								if ( $image_id <> "" ) {
										echo "<a class='thumb' href='".get_permalink()."'>".$image_id."</a>";
									}
									else {
										//echo "<img width='301' height='110' src='".get_template_directory_uri()."/images/no_image.jpg' />";
									}							
								?>
                                <div class="desc">
                                	<h4><a href="<?php echo get_permalink();?>" class="colr"><?php echo get_the_title()?></a></h4>
                                    <p class="date"><?php echo get_the_date(); //echo date( get_option('date_format'), strtotime(get_the_date()) );?></p>
                                    <p>
									<?php 
										if ( $post->post_excerpt <> "" ) $get_the_excerpt = $post->post_excerpt;
										else $get_the_excerpt = $post->post_content;
										$get_the_excerpt = trim(preg_replace('/<a[^>]*>(.*)<\/a>/iU','', $get_the_excerpt ));
										$new_excerpt = trim(preg_replace('/\[(.*?)\]/ ','', $get_the_excerpt));															
										echo substr($new_excerpt, 0, 130);
										if ( strlen( $new_excerpt ) > 130 ) {
											echo '... <a class="readmore" href="'.get_permalink().'"> Read more</a>';
										}
									?>
                            		</p>
                                </div>
                            </li>
						<?php }
						endwhile; 
						?>
						</ul>
                        <!-- News List End -->
                    </div>
                    <div class="sec-bot-bar">
                    <?php echo '<a class="advance-search" href="'.get_category_link($get_names_posts).'">Show All News</a>  ';?>
                    </div>
                    <?php 
					 }
	echo $after_widget;
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("blogpost_show");') );?>