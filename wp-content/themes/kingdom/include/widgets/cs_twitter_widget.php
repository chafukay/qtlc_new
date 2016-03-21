<?php
class cs_twitter_widget extends WP_Widget {
	
	public function __construct() {
		
			parent::__construct(
			'cs_twitter_widget', // Base ID
			__( 'CS : Twitter Widget',CSDOMAIN ), // Name
			array( 'classname' => 'widget widget-latestnews widget-twitter', 'description' =>__('Twitter Widget',CSDOMAIN ) ) // Args
			);
		}
	
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array('title' => ''));
		$title = $instance['title'];
		$username = isset($instance['username']) ? esc_attr($instance['username']) : '';
		$numoftweets = isset($instance['numoftweets']) ? esc_attr($instance['numoftweets']) : '';
	?>
		<label for="<?php echo $this->get_field_id('title'); ?>">
			<span>Title: </span>
			<input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</label>
		<label for="screen_name">User Name<span class="required">(*)</span>: </label>
			<input class="upcoming" id="<?php echo $this->get_field_id('username'); ?>" size="40" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>" />
		<label for="tweet_count">
		<span>Num of Tweets: </span>
		<input class="upcoming" id="<?php echo $this->get_field_id('numoftweets'); ?>" size="2" name="<?php echo $this->get_field_name('numoftweets'); ?>" type="text" value="<?php echo esc_attr($numoftweets); ?>" />
		<div class="clear"></div>
		</label>
	<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['username'] = $new_instance['username'];
		$instance['numoftweets'] = $new_instance['numoftweets'];
		
		return $instance;
	}
	/*function widget($args, $instance) {
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$username = $instance['username'];
		$numoftweets = $instance['numoftweets'];		
		if($numoftweets == ''){$numoftweets = 2;}
		echo $before_widget;
		// WIDGET display CODE Start
		if (!empty($title) && $title <> ' '){
			echo $before_title . $title . $after_title;
		}
		if(strlen($username) > 1){
 				$text ='';
				$return = '';
				$consumerkey = '';
				$consumersecret = '';
				$accesstoken = '';
				$accesstokensecret = '';
				$cacheTime =10000;
				$transName = 'latest-tweets';
				$cs_all_twitter_settings = get_option( "cs_all_twitter_settings" );
					if ( $cs_all_twitter_settings <> "" ) {
						$sxe = new SimpleXMLElement($cs_all_twitter_settings);
							$consumerkey = trim($sxe->consumerkey);
							$consumersecret = trim($sxe->consumersecret);
							$accesstoken =trim($sxe->accesstoken);
							$accesstokensecret = trim($sxe->accesstokensecret);
					}
				require_once  "twitteroauth/twitteroauth.php"; //Path to twitteroauth library
  				$connection = new TwitterOAuth($consumerkey, $consumersecret,$accesstoken, $accesstokensecret);
				$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$username."&count=".$numoftweets);

 
				if(!is_wp_error($tweets) and is_array($tweets)){
					set_transient($transName, $tweets, 60 * $cacheTime);
				}else{
					$tweets= get_transient('latest-tweets');
				}
 				if(!is_wp_error($tweets) and is_array($tweets)){
 					?>
					
					<?php
					$return .= "<div class='widget_slider'>
						<div class='flexslider'>
							<ul class='slides'>";
						foreach($tweets as $tweet) {
							$text = $tweet->{'text'};
							foreach($tweet->{'user'} as $type => $userentity) {
								if($type == 'profile_image_url') {	
									$profile_image_url = $userentity;
								} else if($type == 'screen_name'){
									$screen_name = '<a href="https://twitter.com/' . $userentity . '" target="_blank" class="colrhover" title="' . $userentity . '">@' . $userentity . '</a>';
								}
							}
							foreach($tweet->{'entities'} as $type => $entity) {
							if($type == 'urls') {						
								foreach($entity as $j => $url) {
									$display_url = '<a href="' . $url->{'url'} . '" target="_blank" title="' . $url->{'expanded_url'} . '">' . $url->{'display_url'} . '</a>';
									$update_with = 'Read more at '.$display_url;
									$text = str_replace('Read more at '.$url->{'url'}, '', $text);
									$text = str_replace($url->{'url'}, '', $text);
								}
							} else if($type == 'hashtags') {
								foreach($entity as $j => $hashtag) {
									$update_with = '<a href="https://twitter.com/search?q=%23' . $hashtag->{'text'} . '&src=hash" target="_blank" title="' . $hashtag->{'text'} . '">#' . $hashtag->{'text'} . '</a>';
									$text = str_replace('#'.$hashtag->{'text'}, $update_with, $text);
								}
							} else if($type == 'user_mentions') {
									foreach($entity as $j => $user) {
										  $update_with = '<a href="https://twitter.com/' . $user->{'screen_name'} . '" target="_blank" title="' . $user->{'name'} . '">@' . $user->{'screen_name'} . '</a>';
										  $text = str_replace('@'.$user->{'screen_name'}, $update_with, $text);
									}
								}
							} 
							$large_ts = time();
							$n = $large_ts - strtotime($tweet->{'created_at'});
							if($n < (60)){ $posted = sprintf(__('%d seconds ago','Statfort'),$n); }
							elseif($n < (60*60)) { $minutes = round($n/60); $posted = sprintf(_n('About a Minute Ago','@%d Minutes Ago',$minutes,'Statfort'),$minutes); }
							elseif($n < (60*60*16)) { $hours = round($n/(60*60)); $posted = sprintf(_n('About an Hour Ago','@%d Hours Ago',$hours,'Statfort'),$hours); }
							elseif($n < (60*60*24)) { $hours = round($n/(60*60)); $posted = sprintf(_n('About an Hour Ago','@%d Hours Ago',$hours,'Statfort'),$hours); }
							elseif($n < (60*60*24*6.5)) { $days = round($n/(60*60*24)); $posted = sprintf(_n('About a Day Ago','@%d Days Ago',$days,'Statfort'),$days); }
							elseif($n < (60*60*24*7*3.5)) { $weeks = round($n/(60*60*24*7)); $posted = sprintf(_n('About a Week Ago','%d Weeks Ago',$weeks,'Statfort'),$weeks); } 
							elseif($n < (60*60*24*7*4*11.5)) { $months = round($n/(60*60*24*7*4)) ; $posted = sprintf(_n('About a Month Ago','%d Months Ago',$months,'Statfort'),$months);}
							elseif($n >= (60*60*24*7*4*12)){$years=round($n/(60*60*24*7*52)) ; $posted = sprintf(_n('About a year Ago','%d years Ago',$years,'Statfort'),$years);}
							$return .="<li><div class='tweet'>";
							$return .= "<h6 class='heading-color'>" . $text . "</h6>";
							$return .= "<time datetime='2011-01-12'>" . $posted. "</time>";
							$return .="</div></li>";
					}
			$return .= "</ul></div><em class='fa fa-twitter'></em></div>";
			echo $return;
			?>
			 
			<?php
	}else{
			if(isset($tweets->errors[0]) && $tweets->errors[0] <> ""){
				echo '<span class="bad_authentication">'.$tweets->errors[0]->message.". Please enter valid Twitter API Keys </span>";
			}else{
				echo '<span class="bad_authentication">';
					fnc_no_result_found(false);
				echo '</span>';
			}
		}
}else{ 				
		fnc_no_result_found(false);
	}
	echo $after_widget;
	// WIDGET display CODE End
	}*/
	
	function widget($args, $instance) {
            global $cs_theme_options, $cs_twitter_arg;

           
			$cs_all_twitter_settings = get_option( "cs_all_twitter_settings" );
					if ( $cs_all_twitter_settings <> "" ) {
						$sxe = new SimpleXMLElement($cs_all_twitter_settings);
							$consumerkey = trim($sxe->consumerkey);
							$consumersecret = trim($sxe->consumersecret);
							$accesstoken =trim($sxe->accesstoken);
							$accesstokensecret = trim($sxe->accesstokensecret);
							$cache_limit_time = trim($sxe->cache_limit_time);
							$tweet_num_post = trim($sxe->tweet_num_post);
							$twitter_datetime_formate = trim($sxe->twitter_datetime_formate);
					}
           		
            
            if ($cache_limit_time == '') {
                $cache_limit_time = 60;
            }
            if ($twitter_datetime_formate == '') {
                $twitter_datetime_formate = 'time_since';
            }
            if ($tweet_num_post == '') {
                $tweet_num_post = 5;
            }

            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
            $title = htmlspecialchars_decode(stripslashes($title));
            $username = $instance['username'];
            $numoftweets = $instance['numoftweets'];
            if ($numoftweets == '') {
                $numoftweets = 2;
            }
            echo cs_allow_special_char($before_widget);
            // WIDGET display CODE Start
            if (!empty($title) && $title <> ' ') {
                echo cs_allow_special_char($before_title . $title . $after_title);
            }
		if($consumerkey <> '' && $consumersecret <> '' &&  $accesstoken <> '' && $accesstokensecret <> '')
		{
            if (strlen($username) > 1) {
                require_once get_template_directory() . '/include/widgets/twitteroauth/display-tweets.php';
                display_tweets($username,$twitter_datetime_formate , $tweet_num_post, $numoftweets, $cache_limit_time);
            }
		}
		else{
			echo '<p>Please Set Twitter API</p>';
		}
			 echo cs_allow_special_char($after_widget);
        }
}
add_action('widgets_init', create_function('', 'return register_widget("cs_twitter_widget");'));