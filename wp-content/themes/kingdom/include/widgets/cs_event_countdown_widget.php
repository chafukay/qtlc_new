<?php
class upcomingevents_count_recent extends WP_Widget
{
  public function __construct() {
		
			parent::__construct(
			'upcomingevents_count_recent', // Base ID
			__( 'Chimps : Event Countdown',CSDOMAIN ), // Name
			array( 'classname' => 'upcoming-eve', 'description' =>__('Select Event to show its countdown',CSDOMAIN), ) // Args
			);
		}
  
   
  
  
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ,'widget_names_events' =>'new') );
    $title = $instance['title'];
	$get_names_events = isset( $instance['get_names_events'] ) ? esc_attr( $instance['get_names_events'] ) : '';
	$numevents = isset( $instance['numevents'] ) ? esc_attr( $instance['numevents'] ) : '';	
?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	 <?php _e('Title',CSDOMAIN)?> 
	  <input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
  <p>
  <label for="<?php echo $this->get_field_id('get_names_events'); ?>">
	 <?php _e('Select Event',CSDOMAIN)?> 
	  <select id="<?php echo $this->get_field_id('get_names_events'); ?>" name="<?php echo $this->get_field_name('get_names_events'); ?>" style="width:225px">
		<?php
        global $wpdb,$post;
		$categories = get_categories('taxonomy=event-category&child_of=0&hide_empty=0'); 
			if($categories != ''){}
				foreach ( $categories as $category){ ?>
                    <option <?php if(esc_attr($get_names_events) == $category->term_id){echo 'selected';}?> value="<?php echo $category->term_id;?>" >
	                    <?php echo substr($category->name, 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?>
                    </option>						
			<?php }?>
      </select>
  </label>
  </p>  
  <p>
  <label for="<?php echo $this->get_field_id('numevents'); ?>">
	 <?php _e('Number of Events',CSDOMAIN)?>  
	  <input class="upcoming" id="<?php echo $this->get_field_id('numevents'); ?>" size="2" name="<?php echo $this->get_field_name('numevents'); ?>" type="text" value="<?php echo esc_attr($numevents); ?>" />
  </label>
  </p>  
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['get_names_events'] = $new_instance['get_names_events'];	
	$instance['numevents'] = $new_instance['numevents'];		
	
	
    return $instance;
  }
 
	function widget($args, $instance)
	{
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$get_names_events = isset( $instance['get_names_events'] ) ? esc_attr( $instance['get_names_events'] ) : '';
		$numevents = isset( $instance['numevents'] ) ? esc_attr( $instance['numevents'] ) : '';		
		if(!isset($numevents)){$numevents = '4';}
		// WIDGET display CODE Start
		echo $before_widget;		
		if (!empty($title))
			echo $before_title . $title . $after_title;
			global $wpdb, $post;
			//$term = get_term( $get_names_events, 'event-category' );
			date_default_timezone_set('UTC');
			$current_time = current_time('Y-m-d H:i', $gmt = 0 ); 
			if($get_names_events <> ''){
				$newterm = get_term_by('id', $get_names_events, 'event-category');
					$args = array(
						'posts_per_page'			=> $numevents,
						'post_type'					=> 'events',
						'post_status'				=> 'publish',
						'meta_key'					=> 'cs_event_from_date_time',
						'meta_value'				=> $current_time,
						'meta_compare'				=> '>',
						'orderby'					=> 'meta_value',
						'order'						=> 'ASC',
						'tax_query' => array(
								array(
									'taxonomy' => 'event-category',
									'field' => 'term_id',
									'terms' => array( $get_names_events)
								) 
							)
						);
                    //query_posts($args);
					$custom_query = new WP_Query($args);
					if ( $custom_query->have_posts() <> "" ) {
					?>
					<ul class="date-list">
					<?php
						$recent_counter = 0;
                        while ( $custom_query->have_posts() ): $custom_query->the_post();
							$recent_counter++;
							$cs_event_from_date = get_post_meta($post->ID, "cs_event_from_date", true);
							$cs_event_from_date_time = get_post_meta(get_the_id(), "cs_event_from_date_time", true);
							//$event_to_date = get_post_meta($instance['get_names_events'], "cs_event_to_date", true);
							$year_event = date("Y", strtotime($cs_event_from_date));
							$month_event = date("m", strtotime($cs_event_from_date));
							$month_event_c = date("M", strtotime($cs_event_from_date));							
							$date_event = date("d", strtotime($cs_event_from_date));
							$cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);
							$date_format = get_option( 'date_format' );
							$time_format = get_option( 'time_format' );							
							if ( $cs_event_meta <> "" ) {
								$cs_event_meta = new SimpleXMLElement($cs_event_meta);
							}			
							$time_left = date("H,i,s", strtotime("$cs_event_meta->event_start_time"));
							$hours = date("H", strtotime($cs_event_from_date_time));
						 	$minute = date("i", strtotime($cs_event_from_date_time));
							$new_excerpt = strip_tags(trim(preg_replace('/\[(.*?)\]/ ','', get_the_content())));
								if($recent_counter == 1){?>
									<?php
									event_countdown_enqueue_scripts();
									?>
                                    <script>
                                        jQuery(function($){
                                                var austDay = new Date();
                                                austDay = new Date(<?php echo $year_event;?>, <?php echo $month_event;?>-1, <?php echo $date_event;?>,'<?php echo $hours; ?>','<?php echo $minute; ?>')
                                                $('#defaultCountdown<?php echo $post->ID;?>').countdown({until: austDay,layout:
												'<div id="timer">' + ''+
													  '<div id="timer_days" class="timer_numbers">{dnn}</div>'+
													  '<div id="timer_hours" class="timer_numbers">{hnn}</div>'+ 
													  '<div id="timer_mins" class="timer_numbers">{mnn}</div>'+
													  '<div id="timer_seconds" class="timer_numbers">{snn}</div>'+
													'<div id="timer_labels">'+
														'<div id="timer_days_label" class="timer_labels"><?php echo languageswitcher( 'trans_days', "Days" ); ?></div>'+
														'<div id="timer_hours_label" class="timer_labels"><?php echo languageswitcher( 'trans_hours', "Hours" ); ?></div>'+
														'<div id="timer_mins_label" class="timer_labels"><?php echo languageswitcher( 'trans_minutes', "Mins" ); ?></div>'+
														'<div id="timer_seconds_label" class="timer_labels"><?php echo languageswitcher( 'trans_seconds', "Secs" ); ?></div>'+
													'</div>'+							
												'</div>'
												});
                                                $('#year').text(austDay.getFullYear());
                                        });                
                                    </script>
									<!-- Events Widget Start -->
									
										<div class="counter-sec">
											<h4 class="colr"><?php echo substr(get_the_title(), 0, 15); if ( strlen(get_the_title()) > 15 ) echo "...";?></h4>
											<div id="defaultCountdown<?php echo $post->ID;?>"></div>
											<div class="clear"></div>
											<div class="current-item">
												<div class="date">
													<h1 class="colr bold"><?php echo $date_event;?></h1>
													<h3 class="colr"><?php echo $month_event_c;?></h3>
												</div>
												<div class="eve-desc">
													<h5><a href="<?php echo get_permalink();?>" class="txthover"><?php echo get_the_title();?></a></h5>
													<p>
													
														<?php echo $month_event_c;?> <?php echo $date_event;?>, <?php echo date( get_option("time_format"), strtotime($cs_event_meta->event_start_time) );?> to <?php echo date( get_option("time_format"), strtotime($cs_event_meta->event_end_time) );?><br />
														<!--<?php echo substr($new_excerpt, 0, 15); if ( strlen($new_excerpt) > 15 ) echo "...";?>-->
													</p>
												</div>
											</div>
										</div>
										<?php }else{?>
											<li>
												<div class="date">
													<h1 class="colr bold"><?php echo $date_event;?></h1>
													<h3 class="colr"><?php echo $month_event_c;?></h3>
												</div>
												<div class="eve-desc">
													<h5><a href="<?php echo get_permalink()?>" class="txthover"><?php echo substr(get_the_title(), 0, 15); if ( strlen(get_the_title()) > 15 ) echo "...";?></a></h5>
													<p>
														<?php echo $month_event_c;?> <?php echo $date_event;?>, <?php echo date( get_option("time_format"), strtotime($cs_event_meta->event_start_time) );?> to <?php echo date( get_option("time_format"), strtotime($cs_event_meta->event_end_time) );?><br />
														<!--<?php echo substr($new_excerpt, 0, 15); if ( strlen($new_excerpt) > 15 ) echo "...";?>-->
													</p>
												</div>
											</li>
									<!-- Events Widget End -->		
								<?php }					
						endwhile;?>						
					</ul>
				<div class="sec-bot-bar">
					<a class="view-cal" href="<?php echo get_term_link($newterm->slug, 'event-category');?>"><?php _e('VIEW ALL EVENTS',CSDOMAIN)?></a>
				</div>
					<?php }else{
							echo '<h4>There is no upcomming event to display.</h4>';
						}
			}	// endif of Category Selection
			echo $after_widget;	// WIDGET display CODE End
		}
	}
add_action( 'widgets_init', create_function('', 'return register_widget("upcomingevents_count_recent");') );
?>