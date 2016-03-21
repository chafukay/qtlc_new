<?php
class newsletter extends WP_Widget
{
  
  
   
   public function __construct() {
		
			parent::__construct(
			'newsletter', // Base ID
			__( 'Chimps : Newsletter',CSDOMAIN ), // Name
			array( 'classname' => 'newsletter-widget', 'description' =>__('Newsletter or Subscription',CSDOMAIN ) ) // Args
			);
		}
  
  
 
  
 
  function form($instance)
  {
	$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	$title = $instance['title'];
	$short_desc = empty($instance['short_desc']) ? ' ' : apply_filters('widget_title', $instance['short_desc']);			
	?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">
            <?php _e('Title',CSDOMAIN)?> 
            <input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </label>
    </p>     
    <p>
      <label for="<?php echo $this->get_field_id('short_desc'); ?>">
             <?php _e('Short Description',CSDOMAIN)?><br />
          <textarea rows="2"  cols="35" class="upcoming" id="<?php echo $this->get_field_id('short_desc'); ?>" name="<?php echo $this->get_field_name('short_desc'); ?>"><?php echo esc_attr($short_desc); ?></textarea>
      </label>    
    </p>     
    <?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];	
    $instance['short_desc'] = $new_instance['short_desc'];		
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
	extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);	
		$short_desc = empty($instance['short_desc']) ? ' ' : apply_filters('widget_title', $instance['short_desc']);			
		echo $before_widget;	
			// WIDGET display CODE Start
			if (!empty($title))
				echo $before_title;
				echo $title;
				echo $after_title;
				global $wpdb, $post,$counter_node;
				$counter_node++;

			?>
            <div class="newsletter-class">
				<!-- Newsletter Start -->
					<script>
                        function frm_newsletter_<?php echo $counter_node; ?>(){
							var $ = jQuery;
                            $("#btn_newsletter-<?php echo $counter_node; ?>").hide();
                            $("#process_newsletter-<?php echo $counter_node; ?>").html('<img src="<?php echo get_template_directory_uri()?>/images/ajax_loading.gif" />');
                            $.ajax({
                                type:'POST', 
                                url: '<?php echo get_template_directory_uri()?>/include/newsletter_save.php',
                                data:$('#frm_newsletter-<?php echo $counter_node; ?>').serialize(), 
                                success: function(response) {
                                    $('#frm_newsletter-<?php echo $counter_node; ?>').get(0).reset();
                                    $('#newsletter_mess-<?php echo $counter_node; ?>').show('');
                                    $('#newsletter_mess-<?php echo $counter_node; ?>').html(response);
                                    $("#btn_newsletter-<?php echo $counter_node; ?>").show('');
                                    $("#process_newsletter-<?php echo $counter_node; ?>").html('');
                                    //$('#frm_slide').find('.form_result').html(response);
                                }
                            });
                        }
                    </script>                    
                    <!-- Newsletter End -->		
                    <div class="clear"></div>
						<form id="frm_newsletter-<?php echo $counter_node; ?>" action="javascript:frm_newsletter_<?php echo $counter_node; ?>() ">
                            <div id="newsletter_mess-<?php echo $counter_node; ?>"></div>
								<?php if($short_desc != ''){ 
											echo '<p>';
											echo substr($short_desc, 0, 120); 
											if ( strlen($short_desc) > 120 ) echo "..."; 
											echo '</p>';
										}
								?>
                                <div class="input_buttn_container">
                                    <input type="text" class="bar" name="newsletter_email" value=" <?php _e('Enter Email Address',CSDOMAIN)?>" onfocus="if(this.value==' <?php _e('Enter Email Address',CSDOMAIN)?>') {this.value='';}" onblur="if(this.value=='') {this.value=' <?php _e('Enter Email Address',CSDOMAIN)?>';}" />
                                    <button id="btn_newsletter-<?php echo $counter_node; ?>" class="backcolr"> <?php _e('Submit',CSDOMAIN)?></button>
                                    <div id="process_newsletter-<?php echo $counter_node; ?>"></div>                         
                                </div>   
				        </form>
                    <!-- Newsletter End -->              
                    </div>
			<?php
		echo $after_widget;
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("newsletter");') );?>