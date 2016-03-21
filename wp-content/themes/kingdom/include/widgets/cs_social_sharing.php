<?php
class social_sharing extends WP_Widget
{
  
    public function __construct() {
		
			parent::__construct(
			'social_sharing', // Base ID
			__( 'Chimps : Social Sharing',CSDOMAIN ), // Name
			array( 'classname' => 'social-widget', 'description' =>__('Welcome box display beside slider',CSDOMAIN ) ) // Args
			);
		}
  
  
  
  
  
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$social_sharing = isset( $instance['social_sharing'] ) ? esc_attr( $instance['social_sharing'] ) : '';	
?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">
      <?php _e('Title',CSDOMAIN)?> 
      <input class="upcoming" size="40" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('social_sharing'); ?>">
	 <?php _e('Social Sharing',CSDOMAIN)?> 
	  <select id="<?php echo $this->get_field_id('social_sharing'); ?>" name="<?php echo $this->get_field_name('social_sharing'); ?>" style="width:225px">
        <option><?php _e('Yes',CSDOMAIN)?></option>
        <option><?php _e('No',CSDOMAIN)?></option>
      </select>
  </label>
  </p>     
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['social_sharing'] = $new_instance['social_sharing'];		
    return $instance;
  }
 
	function widget($args, $instance)
	{
	
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$social_sharing = isset( $instance['social_sharing'] ) ? esc_attr( $instance['social_sharing'] ) : '';				
		// WIDGET display CODE Start
		if (!empty($title))
		echo $before_widget;
			echo $before_title;
			echo $title;
			echo $after_title;
			global $wpdb, $post;
				if($social_sharing == 'Yes'){
				$cs_social_share = get_option("cs_social_share");							
				if($cs_social_share != ''){
                //Social Sharing Footer Icons
                $cs_social_network = get_option("cs_social_network");
                        if ( $cs_social_network <> "" ) {
                            $cs_xmlObject = new SimpleXMLElement($cs_social_network);
                                $twitter = $cs_xmlObject->twitter;
                                $facebook = $cs_xmlObject->facebook;
                                $linkedin = $cs_xmlObject->linkedin;
                                $digg = $cs_xmlObject->digg;
                                $delicious = $cs_xmlObject->delicious;
                                $google_plus = $cs_xmlObject->google_plus;
                                $google_buzz = $cs_xmlObject->google_buzz;
                                $google_bookmark = $cs_xmlObject->google_bookmark;
                                $myspace = $cs_xmlObject->myspace;
                                $reddit = $cs_xmlObject->reddit;
                                $stumbleupon = $cs_xmlObject->stumbleupon;
                                $yahoo_buzz = $cs_xmlObject->yahoo_buzz;
                                $youtube = $cs_xmlObject->youtube;
                                $feedburner = $cs_xmlObject->feedburner;
                                $flickr = $cs_xmlObject->flickr;
                                $picasa = $cs_xmlObject->picasa;
                                $vimeo = $cs_xmlObject->vimeo;
                                $tumblr = $cs_xmlObject->tumblr;
                        }
                    ?>
                    <!-- Follow Us Start -->
                    <ul class="footer_sharing">
                        <?php if($twitter != ''){?><li><a title="Twitter" href="<?php echo $twitter;?>" class="share_twitter" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($facebook != ''){?><li><a  title="Facebook" href="<?php echo $facebook;?>" class="share_fb" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($linkedin != ''){?><li><a  title="Linkedin" href="<?php echo $linkedin;?>" class="share_linkedin" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($digg != ''){?><li><a  title="Digg" href="<?php echo $digg;?>" class="share_digg" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($delicious != ''){?><li><a  title="Delicious" href="<?php echo $delicious;?>" class="share_delicious" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($google_plus != ''){?><li><a  title="Google Plus" href="<?php echo $google_plus;?>" class="share_google_plus" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($google_buzz != ''){?><li><a  title="Google Buzz" href="<?php echo $google_buzz;?>" class="share_google_buzz" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($google_bookmark != ''){?><li><a  title="Google Bookmark" href="<?php echo $google_bookmark;?>" class="share_google_bookmark" target="_blank">&nbsp;</a></li><?php }?>                                                                                                                                            
                        <?php if($myspace != ''){?><li><a  title="Myspace" href="<?php echo $myspace;?>" class="share_myspace" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($reddit != ''){?><li><a  title="Reddit" href="<?php echo $reddit;?>" class="share_reddit" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($stumbleupon != ''){?><li><a  title="Stumbleupon" href="<?php echo $stumbleupon;?>" class="share_stumbleupon" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($youtube != ''){?><li><a  title="Youtube" href="<?php echo $youtube;?>" class="share_youtube" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($feedburner != ''){?><li><a  title="Feedburner" href="<?php echo $feedburner;?>" class="share_feedburner" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($flickr != ''){?><li><a  title="Flickr" href="<?php echo $flickr;?>" class="share_flickr" target="_blank">&nbsp;</a></li><?php }?>                                                                                                                                
                        <?php if($picasa != ''){?><li><a  title="Picasa" href="<?php echo $picasa;?>" class="share_picasa" target="_blank">&nbsp;</a></li><?php }?>                                                                                                                                                                
                        <?php if($vimeo != ''){?><li><a  title="Vimeo" href="<?php echo $vimeo;?>" class="share_vimeo" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($tumblr != ''){?><li><a title="Tumblr"  href="<?php echo $tumblr;?>" class="share_tumblr" target="_blank">&nbsp;</a></li><?php }?>                                                                                                                                                                
                    </ul>
					<?php }
				}else{
					echo '<h4>There is no content to Show</h4>';
				}
	echo $after_widget;
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("social_sharing");') );?>