<?php
function search_function($search) {
	$posttype_new ='';
	if(isset($_GET['posttype'])){
		$posttype_new = $_GET['posttype'];
			if (is_search()) {	
				global $wpdb, $wp_query;
				if ( empty( $search ) )
					return $search; 
							
				$query_search = $wp_query->query_vars;    
				$n = ! empty( $query_search['exact'] ) ? '' : '%';
				$search = "$wpdb->posts.post_type = '".esc_attr($posttype_new)."' AND";
				
				$searchand = '';
		
				foreach( (array) $query_search['search_terms'] as $term ) {
					$term = esc_sql( like_escape( $term ) );
					$list = array();
					
					array_push($list,"($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')");
					//array_push($list,"($wpdb->posts.post_content LIKE '{$n}{$term}{$n}')");
					
			
					$search .= "{$searchand}";
					$search .= "( ";
					$search .= implode(" OR ",$list);
					$search .= ")";
					$searchand = ' AND ';
				}
		
				if ( ! empty( $search ) ) {
					$search = " AND ({$search}) ";
				}
			}
	}
	return $search;
	
}
add_filter('posts_where','search_function');

class search_field extends WP_Widget
{
 
  
  public function __construct() {
		
			parent::__construct(
			'search_field', // Base ID
			__( 'Chimps : Advance Search',CSDOMAIN ), // Name
			array( 'classname' => 'search_field', 'description' =>__('Welcome box display beside slider',CSDOMAIN ) ) // Args
			);
		} 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
    //$posttype = $instance['posttype'];	

?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	  <?php _e('Title',CSDOMAIN)?> 
	  <input class="upcoming" size="40" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
  <br />
<!--    <p>
  <label for="<?php echo $this->get_field_id('search_input'); ?>">
	  Search in Content: 
	  <input class="upcoming" id="<?php echo $this->get_field_id('search_input'); ?>" name="<?php echo $this->get_field_name('search_input'); ?>" type="checkbox" <?php if(esc_attr($search_input) != '' ){echo 'checked';}?> />
  </label>
  </p> 
-->
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  } 
	function widget($args, $instance)
	{	
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		//$search_input = isset( $instance['search_input'] ) ? esc_attr( $instance['search_input'] ) : '';				
		echo $before_widget;		
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
			?>      
            <form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ) ?>" >
                <div class="box-in">
                    <label for="s" class="no-pad-top"><?php echo  __('Search for:','kingdom') ?></label>
                    <input type="text" value="" class="bar" name="s" id="s" />
                    <label for="s_in"><?php echo  __('Search In:','kingdom') ?></label>
                    <select id="s_in" name="posttype" class="select">
                        <option value="courses"><?php _e('Courses',CSDOMAIN)?></option>
                        <option value="events"><?php _e('Events',CSDOMAIN)?></option>			
                        <option value="post"><?php _e('Default Posts',CSDOMAIN)?></option>			
                    </select>
                    <input type="submit" id="searchsubmit" class="backcolr" value="<?php echo esc_attr__('Search','kingdom') ?>" />
                </div>
        	</form>
			<?php
		echo $after_widget;
		}		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("search_field");') );?>