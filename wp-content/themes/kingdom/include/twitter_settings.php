<?php
function twitter_settings() {
	$consumerkey = '';
	$cache_limit_time = '';
	$tweet_num_post = '';
	$twitter_datetime_formate = '';
	$consumersecret = '';
	$accesstoken = '';
	$accesstokensecret = '';
		$cs_all_twitter_settings = get_option("cs_all_twitter_settings");
		if ( $cs_all_twitter_settings <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($cs_all_twitter_settings);
				$consumerkey = isset($cs_xmlObject->consumerkey) ? trim($cs_xmlObject->consumerkey) :  '';
				$cache_limit_time = isset($cs_xmlObject->cache_limit_time) ? trim($cs_xmlObject->cache_limit_time) : '';
				$tweet_num_post = isset($cs_xmlObject->tweet_num_post) ?  trim($cs_xmlObject->tweet_num_post) : '';
				$twitter_datetime_formate = isset($cs_xmlObject->twitter_datetime_formate) ? trim($cs_xmlObject->twitter_datetime_formate) : '';
				$consumersecret = isset($cs_xmlObject->consumersecret) ? trim($cs_xmlObject->consumersecret) : '';
				$accesstoken = isset($cs_xmlObject->accesstoken) ? trim($cs_xmlObject->accesstoken) : '';
				$accesstokensecret = isset($cs_xmlObject->accesstokensecret) ? trim($cs_xmlObject->accesstokensecret) : '';
		}
	if(isset($_POST['save']) and $_POST['save'] == "Submit"){	
		foreach ($_REQUEST as $keys=>$values) {
			$$keys = $values;
		}
	}
	$sxe = new SimpleXMLElement("<cs_all_twitter_settings></cs_all_twitter_settings>");
		
			$sxe->addChild('consumerkey',$consumerkey );
			$sxe->addChild('cache_limit_time',$cache_limit_time );
			$sxe->addChild('tweet_num_post',$tweet_num_post );
			$sxe->addChild('twitter_datetime_formate',$twitter_datetime_formate );
			$sxe->addChild('consumersecret',$consumersecret );
			$sxe->addChild('accesstoken',$accesstoken );
			$sxe->addChild('accesstokensecret',$accesstokensecret );
		update_option( "cs_all_twitter_settings", $sxe->asXML() );
?>

<div class="theme-wrap fullwidth">
  <?php include "theme_leftnav.php";?>
  <!-- Right Column Start -->
  <div class="col2 left"> 
    <!-- Header Start -->
    <div class="wrap-header">
      <h4 class="bold"><?php _e('Twitter API Settings',CSDOMAIN)?></h4>
      <div class="clear"></div>
    </div>
    <!-- Header End --> 
    <!-- Content Section Start -->
    <div class="tab-section">
      <div class="tab_menu_container">
        <ul id="tab_menu">
          <li><a href="#uploadlang" class="" rel="tab-uploadlang"><span><?php _e('Twitter Widget Settings',CSDOMAIN)?></span></a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="tab_container">
        <div class="tab_container_in">
          <div id="tab-uploadlang" class="tab-list">
            <div class="option-sec">
              <div class="opt-conts">
              
                <form name="options" method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <ul class="form-elements">
                    <li class="to-label">
                      <label for="screen_name"><?php _e('Cache Time Limit',CSDOMAIN)?> </label>
                    </li>
                    <li class="to-field">
                    
                      <input type="text" name="cache_limit_time" value="<?php echo isset($cache_limit_time) ? $cache_limit_time : '' ; ?>" >
                    </li>
                    <li class="to-desc">
                      <p><?php _e('Please type your Cache Time Limit here',CSDOMAIN)?></p>
                    </li>
                  </ul>
                  <ul class="form-elements">
                    <li class="to-label">
                      <label for="cache_limit_time"><?php _e('Number of tweet',CSDOMAIN)?> </label>
                    </li>
                    <li class="to-field">
                      <input type="text" name="tweet_num_post" value="<?php echo isset($tweet_num_post) ? $tweet_num_post : '' ; ?>" >
                    </li>
                    <li class="to-desc">
                      <p><?php _e('Please enter Number of tweet here',CSDOMAIN)?></p>
                    </li>
                  </ul>
                  <ul class="form-elements">
              <li class="to-label">
                <label for="tweet_num_post"><?php _e('Date Time Formate',CSDOMAIN)?></label>
              </li>
              <li class="to-field">
             
                <select name="twitter_datetime_formate" class="dropdown" id="twitter_datetime_formate" onchange="javascript:home_breadcrumb_toggle(this.value)">

                  <option <?php if( isset($twitter_datetime_formate) && $twitter_datetime_formate == "default"){echo "selected";}?> value="default" ><?php _e('Displays November 06 2012','Faith')?></option>
                  <option <?php if( isset($twitter_datetime_formate) && $twitter_datetime_formate == "eng_suff"){echo "selected";}?> value="eng_suff" ><?php _e('Displays 6th November','Faith')?></option>
                  <option <?php if( isset($twitter_datetime_formate) && $twitter_datetime_formate == "ddmm"){echo "selected";}?> value="ddmm" ><?php _e('Displays 06 Nov','Faith')?></option>
                  <option <?php if( isset($twitter_datetime_formate) && $twitter_datetime_formate == "ddmmyy"){echo "selected";}?> value="ddmmyy" ><?php _e('Displays 06 Nov 2012','Faith')?></option>
                  <option <?php if( isset($twitter_datetime_formate) && $twitter_datetime_formate == "full_date"){echo "selected";}?> value="full_date" ><?php _e('Displays Tues 06 Nov 2012','Faith')?></option>
                  <option <?php if( isset($twitter_datetime_formate) && $twitter_datetime_formate == "time_since"){echo "selected";}?> value="time_since" ><?php _e('Displays in hours, minutes etc','Faith')?></option>
                </select>
              </li>
               <li class="to-desc">
                      <p><?php _e('Please choose your Date Time Formate here',CSDOMAIN)?></p>
                    </li>
            </ul>
                  <ul class="form-elements">
                    <li class="to-label">
                      <label for="twitter_datetime_formate"><?php _e('Consumer Key',CSDOMAIN)?> </label>
                    </li>
                    <li class="to-field">
                   
                      <input type="text" name="consumerkey" value="<?php  echo isset($consumerkey) ? $consumerkey : '' ; ?>" >
                    </li>
                    <li class="to-desc">
                      <p><?php _e('Please type your Consumer Key here',CSDOMAIN)?></p>
                    </li>
                  </ul>
                  <ul class="form-elements">
                    <li class="to-label">
                      <label for="consumer_key"><?php _e('Consumer Secret',CSDOMAIN)?> </label>
                    </li>
                    <li class="to-field">
                   
                      <input type="text" name="consumersecret" value="<?php echo isset($consumersecret) ? $consumersecret : '' ; ?>" >
                    </li>
                    <li class="to-desc">
                      <p><?php _e('Please type your twitter Consumer Secret here',CSDOMAIN)?></p>
                    </li>
                  </ul>
                  <ul class="form-elements">
                    <li class="to-label">
                      <label for="consumer_secret"><?php _e('Access Token',CSDOMAIN)?></label>
                    </li>
                    <li class="to-field">
                    
                      <input type="text" name="accesstoken" value="<?php echo isset($accesstoken) ? $accesstoken : '' ; ?>" >
                    </li>
                     <li class="to-desc">
                      <p><?php _e('Please type your twitter Access Token here',CSDOMAIN)?></p>
                    </li>
                  </ul>
                  <ul class="form-elements">
                    <li class="to-label">
                      <label for="accesstokensecret"><?php _e('Access Token Secret',CSDOMAIN)?> </label>
                    </li>
                    <li class="to-field">
                    
                      <input type="text" name="accesstokensecret" value="<?php echo isset($accesstokensecret) ? $accesstokensecret : '' ; ?>" >
                    </li>
                    <li class="to-desc">
                      <p><?php _e('Please Enter Access Token Secret',CSDOMAIN)?></p>
                    </li>
                  </ul>
                  <ul class="form-elements">
                    <li class="to-label"> </li>
                    <li class="to-field">
                      <input class="button-primary" type="submit" name="save" value="Submit" />
                    </li>
                    <li class="to-desc">
                    <p><?php _e('You can sign up for a API',CSDOMAIN)?></p>
                    </li>
                  </ul>
                </form>
                </ul>
              </div>
            </div>
          </div>
          <!-- Upload Cufon End -->
          <div class="clear"></div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <!-- Content Section End --> 
  </div>
  <div class="clear"></div>
  <!-- Right Column End --> 
</div>
<?php } ?>
