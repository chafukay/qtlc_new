<?php
class contact_us_widget extends WP_Widget
{
  
  public function __construct() {
		
			parent::__construct(
			'contact_us_widget', // Base ID
			__( 'Chimps : Contact footer widget',CSDOMAIN ), // Name
			array( 'classname' => 'latest-videos', 'description' => __('Please paste embed code of Latest Video', CSDOMAIN),) // Args
			);
		}
 
  
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$contact_textarea = isset( $instance['contact_textarea'] ) ? esc_attr( $instance['contact_textarea'] ) : '';
	$footer_logo_url = isset( $instance['footer_logo_url'] ) ? esc_attr( $instance['footer_logo_url'] ) : '';	?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
		 <?php _e('Title',CSDOMAIN)?> 
	  <input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p> 
  <p>
  <label for="<?php echo $this->get_field_id('contact_textarea'); ?>">
		 <?php _e('Description',CSDOMAIN)?> <br />
      <textarea rows="3"  cols="35" class="upcoming" id="<?php echo $this->get_field_id('contact_textarea'); ?>" name="<?php echo $this->get_field_name('contact_textarea'); ?>"><?php echo esc_attr($contact_textarea); ?></textarea>
  </label>
  </p>   
  <p>
  <label for="<?php echo $this->get_field_id('footer_logo_url'); ?>">
		 <?php _e('Footer Logo Url',CSDOMAIN)?><br />
      <input class="upcoming" id="<?php echo $this->get_field_id('footer_logo_url'); ?>" size="40" name="<?php echo $this->get_field_name('footer_logo_url'); ?>" type="text" value="<?php echo esc_attr($footer_logo_url); ?>" />
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['contact_textarea'] = $new_instance['contact_textarea'];
    $instance['footer_logo_url'] = $new_instance['footer_logo_url'];		
    return $instance;
  }
 
	function widget($args, $instance)
	{
		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$contact_textarea = empty($instance['contact_textarea']) ? ' ' : apply_filters('widget_title', $instance['contact_textarea']);
		$footer_logo_url = empty($instance['footer_logo_url']) ? ' ' : apply_filters('widget_title', $instance['footer_logo_url']);
		echo $before_widget;	
		if(strlen($title) <> 1){
		// WIDGET display CODE Start
		if (!empty($title))
			//echo $before_title;
			//echo $title;
			//echo $after_title;
			global $wpdb, $post;?>
				<?php if($footer_logo_url <> ''){?><a href="#"><img src="<?php echo $footer_logo_url;?>" alt="" /></a><?php }?>
                	<?php echo '<p>'.html_entity_decode($contact_textarea).'</p>';
					}else{?>
                    <h4> <?php _e('There is no data to display.',CSDOMAIN)?></h4>
                    <?php }?>
	<?php echo $after_widget; ?>
		<?php } 
				}
add_action( 'widgets_init', create_function('', 'return register_widget("contact_us_widget");') );?>
