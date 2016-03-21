<?php
class tabs_widget_show extends WP_Widget
{
  
  
   public function __construct() {
		
			parent::__construct(
			'tabs_widget_show', // Base ID
			__( 'Chimps : Tabs Widget',CSDOMAIN ), // Name
			array( 'classname' => 'tabs-widget', 'description' =>__('Select Widgets from options for tabs.',CSDOMAIN ) ) // Args
			);
		}
  
  
  
  
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];	
	$get_default_widget_one = isset( $instance['get_default_widget_one'] ) ? esc_attr( $instance['get_default_widget_one'] ) : '';	
	
	$title_widget_two = isset( $instance['title_widget_two'] ) ? esc_attr( $instance['title_widget_two'] ) : '';		
	$get_default_widget_two = isset( $instance['get_default_widget_two'] ) ? esc_attr( $instance['get_default_widget_two'] ) : '';	
?>
	
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">
          <?php _e('Title',CSDOMAIN)?> 
          <input class="upcoming" size="40" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </label>
    </p>
    <br />    
    <p>
      <label for="<?php echo $this->get_field_id('get_default_widget_one'); ?>">
         <?php _e('Select Widget First Tab',CSDOMAIN)?> 
          <select id="<?php echo $this->get_field_id('get_default_widget_one'); ?>" name="<?php echo $this->get_field_name('get_default_widget_one'); ?>" style="width:225px">
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Archives'){echo 'selected';}?> value='WP_Widget_Archives'><?php _e('Archives',CSDOMAIN)?></option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Calendar'){echo 'selected';}?> value='WP_Widget_Calendar'><?php _e('Calendar',CSDOMAIN)?></option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Categories'){echo 'selected';}?> value='WP_Widget_Categories'><?php _e('Categories',CSDOMAIN)?></option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Links'){echo 'selected';}?> value='WP_Widget_Links'><?php _e('Links',CSDOMAIN)?></option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Meta'){echo 'selected';}?> value='WP_Widget_Meta'><?php _e('Meta',CSDOMAIN)?></option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Pages'){echo 'selected';}?> value='WP_Widget_Pages'><?php _e('Pages',CSDOMAIN)?></option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Recent_Comments'){echo 'selected';}?> value='WP_Widget_Recent_Comments'><?php _e('Recent_Comments',CSDOMAIN)?></option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Recent_Posts'){echo 'selected';}?> value='WP_Widget_Recent_Posts'><?php _e('Recent_Posts',CSDOMAIN)?></option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_RSS'){echo 'selected';}?> value='WP_Widget_RSS'><?php _e('RSS',CSDOMAIN)?></option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Search'){echo 'selected';}?> value='WP_Widget_Search'><?php _e('Search',CSDOMAIN)?></option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Tag_Cloud'){echo 'selected';}?> value='WP_Widget_Tag_Cloud'><?php _e('Tag Cloud',CSDOMAIN)?></option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Text'){echo 'selected';}?> value='WP_Widget_Text'><?php _e('Text',CSDOMAIN)?></option>
          </select>
      </label>
    </p>     
<br />
    <p>
        <label for="<?php echo $this->get_field_id('title_widget_two'); ?>">
         <?php _e('Title',CSDOMAIN)?> 
          <input class="upcoming" size="40" id="<?php echo $this->get_field_id('title_widget_two'); ?>" name="<?php echo $this->get_field_name('title_widget_two'); ?>" type="text" value="<?php echo esc_attr($title_widget_two); ?>" />
        </label>
    </p>  
	<p>
	  <label for="<?php echo $this->get_field_id('get_default_widget_two'); ?>">
		  <?php _e('Select Widget Second Tab',CSDOMAIN)?>
		  <select id="<?php echo $this->get_field_id('get_default_widget_two'); ?>" name="<?php echo $this->get_field_name('get_default_widget_two'); ?>" style="width:225px">
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Archives'){echo 'selected';}?> value='WP_Widget_Archives'><?php _e('Archives',CSDOMAIN)?></option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Calendar'){echo 'selected';}?> value='WP_Widget_Calendar'><?php _e('Calendar',CSDOMAIN)?></option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Categories'){echo 'selected';}?> value='WP_Widget_Categories'><?php _e('Categories',CSDOMAIN)?></option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Links'){echo 'selected';}?> value='WP_Widget_Links'><?php _e('Links',CSDOMAIN)?></option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Meta'){echo 'selected';}?> value='WP_Widget_Meta'><?php _e('Meta',CSDOMAIN)?></option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Pages'){echo 'selected';}?> value='WP_Widget_Pages'><?php _e('Pages',CSDOMAIN)?></option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Recent_Comments'){echo 'selected';}?> value='WP_Widget_Recent_Comments'><?php _e('Recent Comments',CSDOMAIN)?></option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Recent_Posts'){echo 'selected';}?> value='WP_Widget_Recent_Posts'><?php _e('Recent Posts',CSDOMAIN)?></option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_RSS'){echo 'selected';}?> value='WP_Widget_RSS'><?php _e('RSS',CSDOMAIN)?></option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Search'){echo 'selected';}?> value='WP_Widget_Search'><?php _e('Search',CSDOMAIN)?></option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Tag_Cloud'){echo 'selected';}?> value='WP_Widget_Tag_Cloud'><?php _e('Tag Cloud',CSDOMAIN)?>
                        </option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Text'){echo 'selected';}?> value='WP_Widget_Text'><?php _e('Text',CSDOMAIN)?></option>
		  </select>
	  </label>
	</p>     	
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];		
    $instance['get_default_widget_one'] = $new_instance['get_default_widget_one'];		
    
	$instance['title_widget_two'] = $new_instance['title_widget_two'];			
	$instance['get_default_widget_two'] = $new_instance['get_default_widget_two'];				

    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);						
		$get_default_widget_one = isset( $instance['get_default_widget_one'] ) ? esc_attr( $instance['get_default_widget_one'] ) : '';				
		
		$title_widget_two = isset( $instance['title_widget_two'] ) ? esc_attr( $instance['title_widget_two'] ) : '';								
		$get_default_widget_two = isset( $instance['get_default_widget_two'] ) ? esc_attr( $instance['get_default_widget_two'] ) : '';
		
		echo $before_widget;	
		// WIDGET display CODE Start
						
		if (!empty($title))
			//echo $before_title;
			//echo $title;
			//echo $after_title;
			global $wpdb, $post;?>
			<div class="tab_menu_container">
				<ul id="tab_menu<?php echo $title.$get_default_widget_one;?>">  
					<li style="width:50%;"><a class="" rel="<?php echo $title.$get_default_widget_one;?>"><?php echo $title;?></a></li>
					<li style="width:49%;"><a class="current" rel="<?php echo $title_widget_two.$get_default_widget_two;?>"><?php echo $title_widget_two;?></a></li>
				</ul>
				<div class="clear"></div>
			</div>
			<!-- Tabs End -->
			<!-- Tabs Container Start -->
			<div class="tab_container">
				<div class="tab_container_in">                            
					<!-- Recent Tab Start -->
					<div id="<?php echo $title.$get_default_widget_one;?>" class="tab-list">
						<?php the_widget($get_default_widget_one);?>
					</div> 
					<!-- Recent Tab End -->
					<!-- Popular Tab Start -->
					<div id="<?php echo $title_widget_two.$get_default_widget_two;?>" class="tab-list">
						<?php the_widget($get_default_widget_two);?>
					</div>
				<!-- Popular Tab End -->
				<div class="clear"></div>
			</div>
		</div>
			<?php
			cs_tabs_enqueue_scripts();
			?>
			<script>
				menuscript.definemenu("tab_menu<?php echo $title.$get_default_widget_one;?>", 0);
			</script>        
			<!-- Tabs Container End -->			
               <?php
	echo $after_widget;
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("tabs_widget_show");') );?>