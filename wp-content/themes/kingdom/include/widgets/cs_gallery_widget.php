<?php
class cs_gallery extends WP_Widget
{
  
   public function __construct() {
		
			parent::__construct(
			'cs_gallery', // Base ID
			__( 'Chimps : Gallery Widget',CSDOMAIN ), // Name
			array( 'classname' => 'gallery-widget', 'description' =>__('Select any gallery to show in widget', CSDOMAIN) ) // Args
			);
		}
  
 
  
  
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ,'get_names_gallery' =>'new') );
    $title = $instance['title'];
	$get_names_gallery = isset( $instance['get_names_gallery'] ) ? esc_attr( $instance['get_names_gallery'] ) : '';
	$viewall_images = isset( $instance['viewall_images'] ) ? esc_attr( $instance['viewall_images'] ) : '';	
	$numevents = isset( $instance['numevents'] ) ? esc_attr( $instance['numevents'] ) : '';	
?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	   <?php _e('Title',CSDOMAIN)?> 
	  <input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
  <p>
  <label for="<?php echo $this->get_field_id('get_names_gallery'); ?>">
	   <?php _e('Select Gallery',CSDOMAIN)?>
	  <select id="<?php echo $this->get_field_id('get_names_gallery'); ?>" name="<?php echo $this->get_field_name('get_names_gallery'); ?>" style="width:225px;">
		<?php
        global $wpdb,$post;
        $newpost = 'posts_per_page=-1&post_type=cs_gallery&order=ASC&post_status=publish';
			$newquery = new WP_Query($newpost);
				while ( $newquery->have_posts() ): $newquery->the_post(); ?>
                    <option <?php if(esc_attr($get_names_gallery) == $post->ID){echo 'selected';}?> value="<?php echo $post->ID;?>" >
	                    <?php echo substr(get_the_title($post->ID), 0, 20);	if ( strlen(get_the_title($post->ID)) > 20 ) echo "...";?>
                    </option>						
			<?php endwhile;?>
      </select>
  </label>
  </p>  
  <p>
  <label for="<?php echo $this->get_field_id('viewall_images'); ?>">
	  <?php _e('View All Gallery Image Url',CSDOMAIN)?>  
	  <input class="upcoming" id="<?php echo $this->get_field_id('viewall_images'); ?>" size="40" name="<?php echo $this->get_field_name('viewall_images'); ?>" type="text" value="<?php echo esc_attr($viewall_images); ?>" />
  </label>
  </p>  
  <p>
  <label for="<?php echo $this->get_field_id('numevents'); ?>">
	  <?php _e('Number of Images',CSDOMAIN)?>  
	  <input class="upcoming" id="<?php echo $this->get_field_id('numevents'); ?>" size="2" name="<?php echo $this->get_field_name('numevents'); ?>" type="text" value="<?php echo esc_attr($numevents); ?>" />
  </label>
  </p>  
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['get_names_gallery'] = $new_instance['get_names_gallery'];
	$instance['viewall_images'] = $new_instance['viewall_images'];	
	$instance['numevents'] = $new_instance['numevents'];		
	
	
    return $instance;
  }
 
	function widget($args, $instance)
	{
		extract($args, EXTR_SKIP);
		global $wpdb, $post;		
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$get_names_gallery = isset( $instance['get_names_gallery'] ) ? esc_attr( $instance['get_names_gallery'] ) : '';
		$viewall_images = isset( $instance['viewall_images'] ) ? esc_attr( $instance['viewall_images'] ) : '';		
		$numevents = isset( $instance['numevents'] ) ? esc_attr( $instance['numevents'] ) : '';		
		if(!isset($numevents)){$numevents = '4';}
		// WIDGET display CODE Start
		echo $before_widget;		
			if (strlen($get_names_gallery) <> 1 || strlen($get_names_gallery) <> 0){
				echo $before_title . $title . $after_title;
			}
			//$term = get_term( $get_names_events, 'event-category' );
 			if($get_names_gallery <> ''){
			$cs_meta_gallery_options = get_post_meta($get_names_gallery, "cs_meta_gallery_options", true);
				if ( $cs_meta_gallery_options <> "" ) {
					$cs_xmlObject = new SimpleXMLElement($cs_meta_gallery_options);
				}
				if(isset($cs_xmlObject)){
					if($numevents > count($cs_xmlObject) ){$numevents = count($cs_xmlObject);}
				
				?>
				<div class="box-in">
                    <?php
					lightbox_enqueue_style_scripts();
					?>
					<ul class="gal-list light-box">
						<?php
						for ( $i = 0; $i < $numevents; $i++ ) {
							$path = $cs_xmlObject->gallery[$i]->path;
							$title = $cs_xmlObject->gallery[$i]->title;
							$description = $cs_xmlObject->gallery[$i]->description;
							$social_network = $cs_xmlObject->gallery[$i]->social_network;
							$use_image_as = $cs_xmlObject->gallery[$i]->use_image_as;
							$video_code = $cs_xmlObject->gallery[$i]->video_code;
							//$image_url = wp_get_attachment_image_src($path, array(438,288),false);
							$image_url = cs_attachment_image_src($path, 62, 62);
							//$image_url_full = wp_get_attachment_image_src($path, 'full',false);
							$image_url_full = cs_attachment_image_src($path, 0, 0);
							?>
								<li><a href="<?php if($use_image_as==1)echo $video_code; else echo $image_url_full;?>" rel="<?php if($use_image_as==1)echo "prettyPhoto"; else echo "prettyPhoto[gallery1]"?>" title="<?php echo $description; ?>"><?php echo "<img src='".$image_url."' alt='".$title."' />"?></a></li>
							<?php }?>
					</ul>
				</div>	  
                <?php if(strlen($viewall_images) > 1){?>          
                    <div class="sec-bot-bar">
                        <a href="<?php echo $viewall_images;?>" class="view-gal"> <?php _e('View Gallery',CSDOMAIN)?></a>
                    </div>                				
                <?php }
				}else{
					echo '<h4>There is no image to show.</h4>';
				}
			}else{	// endif of Category Selection ?>
				<h4> <?php _e('There is no image to show',CSDOMAIN)?></h4>
			<?php }
			echo $after_widget;	// WIDGET display CODE End
		}
	}
add_action( 'widgets_init', create_function('', 'return register_widget("cs_gallery");') );
?>