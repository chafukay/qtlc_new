<?php

function social_network() {
    $cs_social_network = get_option("cs_social_network");
    $twitter = '';
    $facebook = '';
    $linkedin = '';
    $digg = '';
    $delicious = '';
    $google_plus = '';
    $google_buzz = '';
    $google_bookmark = '';
    $myspace = '';
    $reddit = '';
    $stumbleupon = '';
    $yahoo_buzz = '';
    $youtube = '';
    $feedburner = '';
    $flickr = '';
    $picasa = '';
    $vimeo = '';
    $tumblr = '';
    if ($cs_social_network <> "") {
        $cs_xmlObject = new SimpleXMLElement($cs_social_network);
        $twitter = isset($cs_xmlObject->twitter) ? $cs_xmlObject->twitter : '';
        $facebook = isset($cs_xmlObject->facebook) ? $cs_xmlObject->facebook : '';
        $linkedin = isset($cs_xmlObject->linkedin) ? $cs_xmlObject->linkedin : '';
        $digg = isset($cs_xmlObject->digg) ? $cs_xmlObject->digg : '';
        $delicious = isset($cs_xmlObject->delicious) ? $cs_xmlObject->delicious : '';
        $google_plus = isset($cs_xmlObject->google_plus) ? $cs_xmlObject->google_plus : '';
        $google_buzz = isset($cs_xmlObject->google_buzz) ? $cs_xmlObject->google_buzz : '';
        $google_bookmark = isset($cs_xmlObject->google_bookmark) ? $cs_xmlObject->google_bookmark : '';
        $myspace = isset($cs_xmlObject->myspace) ? $cs_xmlObject->myspace : '';
        $reddit = isset($cs_xmlObject->reddit) ? $cs_xmlObject->reddit : '';
        $stumbleupon = isset($cs_xmlObject->stumbleupon) ? $cs_xmlObject->stumbleupon : '';
        $yahoo_buzz = isset($cs_xmlObject->yahoo_buzz) ? $cs_xmlObject->yahoo_buzz : '';
        $youtube = isset($cs_xmlObject->youtube) ? $cs_xmlObject->youtube : '';
        $feedburner = isset($cs_xmlObject->feedburner) ? $cs_xmlObject->feedburner : '';
        $flickr = isset($cs_xmlObject->flickr) ? $cs_xmlObject->flickr : '';
        $picasa = isset($cs_xmlObject->picasa) ? $cs_xmlObject->picasa : '';
        $vimeo = isset($cs_xmlObject->vimeo) ? $cs_xmlObject->vimeo : '';
        $tumblr = isset($cs_xmlObject->tumblr) ? $cs_xmlObject->tumblr : '';
    }
    ?>
    <script>
        function frm_submit() {
            $ = jQuery;
            $("#submit_btn").hide();
            $("#loading_div").html('<img src="<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif" />');
            $.ajax({
                type: 'POST',
                url: '<?php echo get_template_directory_uri() ?>/include/social_network_save.php',
                data: $('#frm').serialize(),
                success: function (response) {
                    //$('#frm_slide').get(0).reset();
                    $(".form-msgs p").html(response);
                    $(".form-msgs").show("");
                    $("#submit_btn").show('');
                    $("#loading_div").html('');
                    slideout();
                    //$('#frm_slide').find('.form_result').html(response);
                }
            });
        }
        function frm_submit2() {
            $ = jQuery;
            $("#submit_btn2").hide();
            $("#loading_div2").html('<img src="<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif" />');
            $.ajax({
                type: 'POST',
                url: '<?php echo get_template_directory_uri() ?>/include/social_sharing_save.php',
                data: $('#frm2').serialize(),
                success: function (response) {
                    //$('#frm_slide').get(0).reset();
                    $(".form-msgs p").html(response);
                    $(".form-msgs").show("");
                    $("#submit_btn2").show('');
                    $("#loading_div2").html('');
                    slideout();
                    //$('#frm_slide').find('.form_result').html(response);
                }
            });
        }
    </script>

    <div class="theme-wrap fullwidth">
        <?php include "theme_leftnav.php"; ?>
        <!-- Right Column Start -->
        <div class="col2 left">
            <!-- Header Start -->
            <div class="wrap-header">
                <h4 class="bold"><?php _e('Social Networking', CSDOMAIN) ?></h4>

                <div class="clear"></div>
            </div>
            <!-- Header End -->
            <!-- Content Section Start -->
            <div class="tab-section">
                <div class="tab_menu_container">
                    <ul id="tab_menu">  
                        <li><a href="#chooselang" class="current" rel="tab-chooselang"><span><?php _e('Social Networking', CSDOMAIN) ?></span></a></li>
                        <li><a href="#uploadlang" class="" rel="tab-uploadlang"><span><?php _e('Social Sharing', CSDOMAIN) ?></span></a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="tab_container">
                    <div class='form-msgs' style="display:none"><div class='to-notif success-box'><span class='tick'>&nbsp;</span><p></p><a class='close-it' onclick='tab_close()'>&nbsp;</a></div></div>
                    <div class="tab_container_in">
                        <!-- social network Start -->
                        <div id="tab-chooselang" class="tab-list">
                            <div class="option-sec">
                                <form id="frm" method="post" action="javascript:frm_submit()">
                                    <div class="opt-head">
                                        <h6><?php _e('Social Network Settings', CSDOMAIN) ?></h6>
                                        <p><?php _e('Social Network Settings', CSDOMAIN) ?></p>
                                    </div>
                                    <div class="opt-conts">
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Twitter', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="twitter" value="<?php echo htmlspecialchars($twitter) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/twitter.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Facebook', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="facebook" value="<?php echo htmlspecialchars($facebook) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/facebook.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Linkedin', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="linkedin" value="<?php echo htmlspecialchars($linkedin) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/linkedin.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Digg', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="digg" value="<?php echo htmlspecialchars($digg) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/digg.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Delicious', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="delicious" value="<?php echo htmlspecialchars($delicious) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/delicious.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Google+', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="google_plus" value="<?php echo htmlspecialchars($google_plus) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/google_plus.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Google Buzz', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="google_buzz" value="<?php echo htmlspecialchars($google_buzz) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/google_buzz.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Google Bookmark', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="google_bookmark" value="<?php echo htmlspecialchars($google_bookmark) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/google_bookmark.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Myspace', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="myspace" value="<?php echo htmlspecialchars($myspace) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/myspace.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Reddit', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="reddit" value="<?php echo htmlspecialchars($reddit) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/reddit.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Stumbleupon', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="stumbleupon" value="<?php echo htmlspecialchars($stumbleupon) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/stumbleupon.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Youtube', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="youtube" value="<?php echo htmlspecialchars($youtube) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/youtube.gif" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Feedburner', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="feedburner" value="<?php echo htmlspecialchars($feedburner) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/feedburner.gif" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Flickr', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="flickr" value="<?php echo htmlspecialchars($flickr) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/flikr.gif" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Picasa', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="picasa" value="<?php echo htmlspecialchars($picasa) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/picasa.gif" />
                                                </div>
                                            </li>
                                        </ul>

                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Vimeo', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="vimeo" value="<?php echo htmlspecialchars($vimeo) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/vimeo.gif" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Tumblr', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="tumblr" value="<?php echo htmlspecialchars($tumblr) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/tumbler.gif" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements noborder">
                                            <li class="to-label"></li>
                                            <li class="to-field">
                                                <input id="submit_btn" type="submit" value="<?php _e('Save Network Settings', CSDOMAIN) ?>" />
                                                <div id="loading_div"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- social network End -->
                        <?php
                        $twitter = '';
                        $facebook = '';
                        $linkedin = '';
                        $digg = '';
                        $delicious = '';
                        $google_plus = '';
                        $google_buzz = '';
                        $google_bookmark = '';
                        $myspace = '';
                        $reddit = '';
                        $stumbleupon = '';
                        $yahoo_buzz = '';
                        $rss = '';
                        $cs_social_share = get_option("cs_social_share");
                        if ($cs_social_share <> "") {
                            $cs_xmlObject = new SimpleXMLElement($cs_social_share);
                            $twitter = isset($cs_xmlObject->twitter) ? $cs_xmlObject->twitter  :'';
                            $facebook = isset($cs_xmlObject->facebook) ? $cs_xmlObject->facebook  :'';
                            $linkedin = isset($cs_xmlObject->linkedin) ? $cs_xmlObject->linkedin : '';
                            $digg = isset($cs_xmlObject->digg) ? $cs_xmlObject->digg  : '';
                            $delicious = isset($cs_xmlObject->delicious) ? $cs_xmlObject->delicious : ''; 
                            $google_plus = isset($cs_xmlObject->google_plus) ? $cs_xmlObject->google_plus : '';
                            $google_buzz = isset($cs_xmlObject->google_buzz)  ? $cs_xmlObject->google_buzz :'';
                            $google_bookmark = isset($cs_xmlObject->google_bookmark) ? $cs_xmlObject->google_bookmark :'';
                            $myspace = isset($cs_xmlObject->myspace) ? $cs_xmlObject->myspace  :'';
                            $reddit = isset($cs_xmlObject->reddit) ? $cs_xmlObject->reddit : '';
                            $stumbleupon = isset($cs_xmlObject->stumbleupon) ? $cs_xmlObject->stumbleupon : ''; 
                            $yahoo_buzz = isset($cs_xmlObject->yahoo_buzz) ? $cs_xmlObject->yahoo_buzz : '';
                            $rss = isset($cs_xmlObject->rss) ? $cs_xmlObject->rss : '';
                        }
                        ?>
                        <!-- social share Tabs -->
                        <div id="tab-uploadlang" class="tab-list">
                            <div class="option-sec">
                                <form id="frm2" method="post" action="javascript:frm_submit2()">
                                    <div class="opt-head">
                                        <h6><?php _e('Social Sharing Settings', CSDOMAIN) ?></h6>
                                        <p><?php _e('Social Sharing Settings..', CSDOMAIN) ?></p>
                                    </div>
                                    <div class="opt-conts">
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Twitter', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="twitter" class="styled" <?php if ($twitter == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/twitter.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Facebook', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="facebook" class="styled" <?php if ($facebook == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/facebook.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Linkedin', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="linkedin" class="styled" <?php if ($linkedin == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/linkedin.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Digg', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="digg" class="styled" <?php if ($digg == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/digg.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Delicious', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="delicious" class="styled" <?php if ($delicious == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/delicious.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Google+', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="google_plus" class="styled" <?php if ($google_plus == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/google_plus.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Google Buzz', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="google_buzz" class="styled" <?php if ($google_buzz == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/google_buzz.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Google Bookmark', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="google_bookmark" class="styled" <?php if ($google_bookmark == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/google_bookmark.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Myspace', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="myspace" class="styled" <?php if ($myspace == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/myspace.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Reddit', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="reddit" class="styled" <?php if ($reddit == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/reddit.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Stumbleupon', CSDOMAIN) ?> </label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="stumbleupon" class="styled" <?php if ($stumbleupon == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/stumbleupon.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('RSS', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="rss" class="styled" <?php if ($rss == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <div class="icon-thumb">
                                                    <img src="<?php echo get_template_directory_uri() ?>/images/admin/rss.png" />
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="form-elements noborder">
                                            <li class="to-label"></li>
                                            <li class="to-field">
                                                <input id="submit_btn2" type="submit" value="<?php _e('Save Sharing Settings', CSDOMAIN) ?>" />
                                                <div id="loading_div2"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- social share End -->
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
    <?php
}
?>