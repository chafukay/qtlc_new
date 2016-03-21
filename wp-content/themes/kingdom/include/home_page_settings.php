<?php

function home_page_settings() {
    global $post;
    $show_slider = "";
    $slider_type = "";
    $slider_id = "";
    $cs_home_page_slider = get_option("cs_home_page_slider");
    if ($cs_home_page_slider <> "") {
        $cs_xmlObject = new SimpleXMLElement($cs_home_page_slider);
        $show_slider = isset($cs_xmlObject->show_slider) ? $cs_xmlObject->show_slider : '';
        $slider_type = isset($cs_xmlObject->slider_type) ? $cs_xmlObject->slider_type : '';
        $slider_id = isset($cs_xmlObject->slider_id) ? $cs_xmlObject->slider_id : '';
    }
    ?>
    <script>
        function frm_submit() {
            var $ = jQuery;
            $("#submit_btn").hide();
            $("#loading_div").html('<img src="<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif" />');
            $.ajax({
                type: 'POST',
                url: '<?php echo get_template_directory_uri() ?>/include/home_page_slider_save.php',
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
            var $ = jQuery;
            $("#submit_btn2").hide();
            $("#loading_div2").html('<img src="<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif" />');
            $.ajax({
                type: 'POST',
                url: '<?php echo get_template_directory_uri() ?>/include/home_page_notification_save.php',
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
                <h4 class="bold"><?php _e('Home Page Settings', CSDOMAIN) ?></h4>            
                <div class="clear"></div>
            </div>
            <!-- Header End -->
            <!-- Content Section Start -->
            <div class="tab-section">
                <div class="tab_menu_container">
                    <ul id="tab_menu">  
                        <li><a href="#" class="current" rel="tab-1"><span><?php _e('Home Page Slider', CSDOMAIN) ?></span></a></li>
                        <li><a href="#" class="" rel="tab-2"><span><?php _e('Home Page Announcement', CSDOMAIN) ?></span></a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="tab_container">
                    <div class='form-msgs' style="display:none"><div class='to-notif success-box'><span class='tick'>&nbsp;</span><p></p><a class='close-it' onclick='tab_close()'>&nbsp;</a></div></div>
                    <div class="tab_container_in">
                        <!-- social network Start -->
                        <div id="tab-1" class="tab-list">
                            <div class="option-sec">
                                <form id="frm" method="post" action="javascript:frm_submit()">
                                    <div class="opt-head">
                                        <h6><?php _e('Home Page Slider', CSDOMAIN) ?></h6>
                                        <p><?php _e('Edit home page slider settings', CSDOMAIN) ?></p>
                                    </div>
                                    <div class="opt-conts">
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Show Slider', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="show_slider" class="styled" <?php if ($show_slider == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <p><?php _e('Switch it on if you want to show slider at home page. If you switch it off it will not show slider at home page', CSDOMAIN) ?></p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Choose Slider Type', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <select name="slider_type" class="dropdown">
                                                    <option <?php
                                                    if ($slider_type == "Anything Slider") {
                                                        echo "selected";
                                                    }
                                                    ?> ><?php _e('Anything Slider', CSDOMAIN) ?></option>
                                                    <option <?php
                                                if ($slider_type == "Nivo Slider") {
                                                    echo "selected";
                                                }
                                                    ?> ><?php _e('Nivo Slider', CSDOMAIN) ?></option>
                                                    <option <?php
                                                    if ($slider_type == "Sudo Slider") {
                                                        echo "selected";
                                                    }
                                                    ?> ><?php _e('Sudo Slider', CSDOMAIN) ?></option>
                                                </select>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Select Slider', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <select name="slider_id" class="dropdown">
                                                    <option value=""><?php _e('-- Select Slider --', CSDOMAIN) ?></option>
                                                    <?php
                                                    $query = array('post_type' => 'cs_slider', 'orderby' => 'ID');
                                                    $wp_query = new WP_Query($query);
                                                    while ($wp_query->have_posts()) : $wp_query->the_post();
                                                        ?>
                                                        <option <?php if ($post->post_name == $slider_id) echo "selected"; ?> value="<?php echo $post->post_name ?>"><?php echo $post->post_title ?></option>
        <?php
    endwhile;
    ?>
                                                </select>
                                            </li>
                                            <li class="to-desc">
                                                <p><?php _e('Select Slider from drop down to show at home page. To creat new slider go to Manage Slider', CSDOMAIN) ?></p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements noborder">
                                            <li class="to-label">
                                            </li>
                                            <li class="to-field">
                                                <input id="submit_btn" type="submit" value="<?php _e('Save Slider', CSDOMAIN) ?>" />
                                                <div id="loading_div"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- social network End -->
                        <?php
                        $cs_home_page_announcement = get_option("cs_home_page_announcement");
                        $show_announcement = '';
                        $announcement_title = '';
                        $announcement_cat = '';
                        if ($cs_home_page_announcement <> "") {
                            $cs_xmlObject = new SimpleXMLElement($cs_home_page_announcement);
                            $show_announcement = isset($cs_xmlObject->show_announcement) ? $cs_xmlObject->show_announcement : '';
                            $announcement_title = isset($cs_xmlObject->announcement_title) ? $cs_xmlObject->announcement_title : '';
                            $announcement_cat = isset($cs_xmlObject->announcement_cat) ? $cs_xmlObject->announcement_cat : '';
                        }
                        ?>
                        <!-- social share Tabs -->
                        <div id="tab-2" class="tab-list">
                            <div class="option-sec">
                                <form id="frm2" method="post" action="javascript:frm_submit2()">
                                    <div class="opt-head">
                                        <h6><?php _e('Home Page Announcement', CSDOMAIN) ?></h6>
                                        <p><?php _e('Home Page Announcement', CSDOMAIN) ?></p>
                                    </div>
                                    <div class="opt-conts">
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Show Announcement', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="show_announcement" class="styled" <?php if ($show_announcement == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <p><?php _e('Switch it on if you want to show announcement at home page', CSDOMAIN) ?></p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Announcement Title', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="announcement_title" value="<?php echo htmlspecialchars($announcement_title) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <p><?php _e('Put Announcement Title', CSDOMAIN) ?> </p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Select Category', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <select name="announcement_cat">
                                                    <option value="0"><?php _e('-- Select Category --', CSDOMAIN) ?></option>
                                                    <?php
                                                    $selected = "";
                                                    $categories = get_categories(array('taxonomy' => 'category'));
                                                    foreach ($categories as $category) {
                                                        ?>
                                                        <option <?php if ($category->term_id == $announcement_cat) echo "selected"; ?> value="<?php echo $category->term_id ?>" ><?php echo $category->cat_name ?></option>
        <?php
    }
    ?>
                                                </select>
                                            </li>
                                            <li class="to-desc">
                                                <p><?php _e('Select a category from dropdown for home page announcement', CSDOMAIN) ?></p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements noborder">
                                            <li class="to-label">
                                            </li>
                                            <li class="to-field">
                                                <input id="submit_btn2" type="submit" value="<?php _e('Save', CSDOMAIN) ?>" />
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
<?php } ?>