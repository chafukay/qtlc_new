<?php

//adding short code start 
/* 	function cs_slider_fun ( $atts ) {
  foreach ( $atts as $key=>$val ) {
  echo $key . " = " . $val;
  }
  }
  add_shortcode( 'cs_slider', 'cs_slider_fun' );
 */
//adding short code end

function slider_setting() {
    $cs_sliders_setttings = get_option("cs_sliders_setttings");
    $cs_anything_effect = '';
    $cs_anything_auto_play = '';
    $cs_anything_animation_speed = '';
    $cs_anything_pause_time = '';
    $cs_nivo_effect = '';
    $cs_nivo_auto_play = '';
    $cs_nivo_animation_speed = '';
    $cs_nivo_pause_time = '';
    $cs_sudo_effect = '';
    $cs_sudo_auto_play = '';
    $cs_sudo_animation_speed = '';
    $cs_sudo_pause_time = '';
    if ($cs_sliders_setttings <> "") {
        $cs_xmlObject = new SimpleXMLElement($cs_sliders_setttings);
        $cs_anything_effect = isset($cs_xmlObject->anything->effect) ? $cs_xmlObject->anything->effect : '';
        $cs_anything_auto_play = isset($cs_xmlObject->anything->auto_play) ? $cs_xmlObject->anything->auto_play : '';
        $cs_anything_animation_speed = isset($cs_xmlObject->anything->animation_speed) ? $cs_xmlObject->anything->animation_speed : '';
        $cs_anything_pause_time = isset($cs_xmlObject->anything->pause_time) ? $cs_xmlObject->anything->pause_time : '';
        $cs_nivo_effect = isset($cs_xmlObject->nivo->effect) ? $cs_xmlObject->nivo->effect : '';
        $cs_nivo_auto_play = isset($cs_xmlObject->nivo->auto_play) ? $cs_xmlObject->nivo->auto_play : '';
        $cs_nivo_animation_speed = isset($cs_xmlObject->nivo->animation_speed) ? $cs_xmlObject->nivo->animation_speed : '';
        $cs_nivo_pause_time = isset($cs_xmlObject->nivo->pause_time) ? $cs_xmlObject->nivo->pause_time : '';
        $cs_sudo_effect = isset($cs_xmlObject->sudo->effect) ? $cs_xmlObject->sudo->effect : '';
        $cs_sudo_auto_play = isset($cs_xmlObject->sudo->auto_play) ? $cs_xmlObject->sudo->auto_play : '';
        $cs_sudo_animation_speed = isset($cs_xmlObject->sudo->animation_speed) ? $cs_xmlObject->sudo->animation_speed : '';
        $cs_sudo_pause_time = isset($cs_xmlObject->sudo->pause_time) ? $cs_xmlObject->sudo->pause_time : '';
    }
    ?>

    <div class="theme-wrap fullwidth">


    <?php include "theme_leftnav.php"; ?>
        <script type="text/javascript">
            jQuery().ready(function ($) {
                var container = $('div.container');
                // validate the form when it is submitted
                var validator = $("#frm").validate({
                    errorContainer: container,
                    errorLabelContainer: $(container),
                    errorElement: 'span',
                    errorClass: 'ele-error',
                    meta: "validate"
                });
            });
        </script>
        <form id="frm" method="" action="javascript:sliders_save()">
            <!-- Right Column Start -->
            <div class="col2 left">
                <!-- Header Start -->
                <div class="wrap-header">
                    <h4 class="bold"><?php _e('Slider Managment', CSDOMAIN) ?></h4>

                    <div class="clear"></div>
                </div>
                <!-- Header End -->
                <!-- Content Section Start -->
                <div class='form-msgs' style="display:none"><div class='to-notif success-box'><span class='tick'>&nbsp;</span><p></p><a class='close-it' onclick='tab_close()'>&nbsp;</a></div></div>
                <div class="elements-in">
                    <div class="option-sec">
                        <div class="opt-head">
                            <h6><?php _e('Choose Slider Type', CSDOMAIN) ?></h6>
                            <p><?php _e('Slider type Nivo-Slider, Anything-Slider, Sudo-Slider settings', CSDOMAIN) ?></p>
                            <span id="loading_div"></span>
                        </div>
                        <div class="opt-conts">
                            <ul class="form-elements noborder">
                                <li class="to-label">
                                    <label><?php _e('Choose Slider Type', CSDOMAIN) ?></label>
                                </li>
                                <li class="to-field">

                                    <select class="dropdown" id="slider_types" name="slider_type" onchange="javascript:show_hide_slider(this.value)">
                                        <option></option>
                                        <option value="anything_slider"><?php _e('Anything Slider', CSDOMAIN) ?></option>
                                        <option value="nivo_slider"><?php _e('Nivo Slider', CSDOMAIN) ?></option>
                                        <option value="sudo_slider"><?php _e('Sudo Slider', CSDOMAIN) ?></option>
                                    </select>
                                </li>
                                <li class="to-desc">
                                    <p><?php _e('Please select slider type', CSDOMAIN) ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="elements" id="slider_types">
                        <div class="option-sec row" id="anything_slider" style="display:none" >
                            <div class="opt-head">
                                <h6><?php _e('Anything Slider Options', CSDOMAIN) ?></h6>
                                <p><?php _e('Configure Anything Slider settings', CSDOMAIN) ?></p>
                            </div>
                            <div class="opt-conts">
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Effects', CSDOMAIN) ?></label>
                                    </li>
                                    <li class="to-field">
                                        <select class="dropdown" name="cs_anything_effect">
                                            <option <?php if ($cs_anything_effect == "fade") {
        echo "selected";
    } ?> ><?php _e('Fade', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_anything_effect == "Horizontal") {
        echo "selected";
    } ?> ><?php _e('Horizontal', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_anything_effect == "Vertical") {
        echo "selected";
    } ?> ><?php _e('Vertical', CSDOMAIN) ?></option>
                                        </select>
                                    </li>
                                    <li class="to-desc">
                                        <p>
    <?php _e('Please select Effect to Anything Slider', CSDOMAIN) ?> ('Defult:fade').
                                        </p>
                                    </li>
                                </ul>
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Auto Play', CSDOMAIN) ?></label>
                                    </li>
                                    <li class="to-field">
                                        <div class="on-off">
                                            <input type="checkbox" name="cs_anything_auto_play" value="true" <?php if ($cs_anything_auto_play == "true") {
        echo "checked";
    } ?> class="styled" />					
                                        </div>
                                    </li>
                                    <li class="to-desc">
                                        <p>
    <?php _e('If true, the slideshow will start running on page load', CSDOMAIN) ?>
                                        </p>
                                    </li>
                                </ul>
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Animation Speed', CSDOMAIN) ?></label>
                                    </li>
                                    <li class="to-field">
                                        <input type="text" name="cs_anything_animation_speed" size="5" class="{validate:{required:true}} bar" value="<?php echo $cs_anything_animation_speed ?>" />
                                    </li>
                                    <li class="to-desc">
                                        <p>
    <?php _e('How long the slideshow transition takes', CSDOMAIN) ?>  (in milliseconds)
                                        </p>
                                    </li>
                                </ul>
                                <ul class="form-elements noborder">
                                    <li class="to-label">
                                        <label><?php _e('Pause Time', CSDOMAIN) ?></label>
                                    </li>
                                    <li class="to-field">
                                        <input type="text" name="cs_anything_pause_time" size="5" class="{validate:{required:true}} bar" value="<?php echo $cs_anything_pause_time ?>" />
                                    </li>
                                    <li class="to-desc">
                                        <p>
    <?php _e('Resume slideshow after user interaction', CSDOMAIN) ?>  (in milliseconds)
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="option-sec row" id="nivo_slider" style="display:none" >
                            <div class="opt-head">
                                <h6><?php _e('Nivo Slider Options', CSDOMAIN) ?></h6>
                                <p><?php _e('Configure Nivo Slider setting', CSDOMAIN) ?></p>
                            </div>
                            <div class="opt-conts">
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Effects', CSDOMAIN) ?></label>
                                    </li>
                                    <li class="to-field">
                                        <select class="dropdown" name="cs_nivo_effect">
                                            <option <?php if ($cs_nivo_effect == "sliceDown") {
        echo "selected";
    } ?> ><?php _e('slice Down', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "sliceDownLeft") {
        echo "selected";
    } ?> ><?php _e('slice Down Left', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "sliceUp") {
        echo "selected";
    } ?> ><?php _e('slice Up', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "sliceUpLeft") {
        echo "selected";
    } ?> ><?php _e('slice Up Left', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "sliceUpDown") {
                                            echo "selected";
                                        } ?> ><?php _e('slice Up Down', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "sliceUpDownLeft") {
                                            echo "selected";
                                        } ?> ><?php _e('slice Up Down Left', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "fold") {
                                            echo "selected";
                                        } ?> ><?php _e('fold', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "fade") {
                                            echo "selected";
                                        } ?> ><?php _e('fade', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "random") {
                                            echo "selected";
                                        } ?> ><?php _e('random', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "slideInRight") {
                                            echo "selected";
                                        } ?> ><?php _e('slide In Right', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "slideInLeft") {
                                            echo "selected";
                                        } ?> ><?php _e('slide In Left', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "boxRandom") {
                                            echo "selected";
                                        } ?> ><?php _e('box Random', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "boxRain") {
                                            echo "selected";
                                        } ?> ><?php _e('box Rain', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "boxRainReverse") {
                                            echo "selected";
                                        } ?> ><?php _e('box Rain Reverse', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "boxRainGrow") {
                                            echo "selected";
                                        } ?> ><?php _e('box Rain Grow', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_nivo_effect == "boxRainGrowReverse") {
                                            echo "selected";
                                        } ?> ><?php _e('box Rain Grow Reverse', CSDOMAIN) ?></option>
                                        </select>
                                    </li>
                                    <li class="to-desc">
                                        <p>
                                            <?php _e('Please select Effect to Anything Slider', CSDOMAIN) ?>   ('Defult:fade').
                                        </p>
                                    </li>
                                </ul>
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Auto Play', CSDOMAIN) ?></label>
                                    </li>
                                    <li class="to-field">
                                        <div class="on-off">
                                            <input type="checkbox" name="cs_nivo_auto_play" value="true" <?php if ($cs_nivo_auto_play == "true") {
                                            echo "checked";
                                        } ?> class="styled" />					
                                        </div>
                                    </li>
                                    <li class="to-desc">
                                        <p>
    <?php _e('If true, the slideshow will start running on page load', CSDOMAIN) ?>
                                        </p>
                                    </li>
                                </ul>
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Animation Speed', CSDOMAIN) ?></label>
                                    </li>
                                    <li class="to-field">
                                        <input type="text" name="cs_nivo_animation_speed" size="5" class="{validate:{required:true}} bar" value="<?php echo $cs_nivo_animation_speed ?>" />
                                    </li>
                                    <li class="to-desc">
                                        <p>
    <?php _e('How long the slideshow transition takes', CSDOMAIN) ?>  (in milliseconds)
                                        </p>
                                    </li>
                                </ul>
                                <ul class="form-elements noborder">
                                    <li class="to-label">
                                        <label><?php _e('Pause Time', CSDOMAIN) ?></label>
                                    </li>
                                    <li class="to-field">
                                        <input type="text" name="cs_nivo_pause_time" size="5" class="{validate:{required:true}} bar" value="<?php echo $cs_nivo_pause_time ?>" />
                                    </li>
                                    <li class="to-desc">
                                        <p>
    <?php _e('Resume slideshow after user interaction', CSDOMAIN) ?>  (in milliseconds)
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="option-sec row" id="sudo_slider" style="display:none" >
                            <div class="opt-head">
                                <h6><?php _e('Sudo Slider Options', CSDOMAIN) ?></h6>
                                <p><?php _e('Configure Sudo Slider setting', CSDOMAIN) ?></p>
                            </div>
                            <div class="opt-conts">
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Effects', CSDOMAIN) ?></label>
                                    </li>
                                    <li class="to-field">
                                        <select class="dropdown" name="cs_sudo_effect">
                                            <option <?php if ($cs_sudo_effect == "fade") {
                                            echo "selected";
                                        } ?> ><?php _e('fanythingade', CSDOMAIN) ?></option>
                                            <option <?php if ($cs_sudo_effect == "Vertical") {
                                            echo "selected";
                                        } ?> ><?php _e('Vertical', CSDOMAIN) ?></option>
                                        </select>
                                    </li>
                                    <li class="to-desc">
                                        <p>
    <?php _e('Please select Effect to Anything Slider', CSDOMAIN) ?>  ('Defult:fade').
                                        </p>
                                    </li>
                                </ul>
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Auto Play', CSDOMAIN) ?></label>
                                    </li>
                                    <li class="to-field">
                                        <div class="on-off">
                                            <input type="checkbox" name="cs_sudo_auto_play" value="true" <?php if ($cs_sudo_auto_play == "true") {
        echo "checked";
    } ?> class="styled" />					
                                        </div>
                                    </li>
                                    <li class="to-desc">
                                        <p>
    <?php _e('If true, the slideshow will start running on page load', CSDOMAIN) ?>
                                        </p>
                                    </li>
                                </ul>
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Animation Speed', CSDOMAIN) ?></label>
                                    </li>
                                    <li class="to-field">
                                        <input type="text" name="cs_sudo_animation_speed" size="5" class="{validate:{required:true}} bar" value="<?php echo $cs_sudo_animation_speed ?>" />
                                    </li>
                                    <li class="to-desc">
                                        <p>
    <?php _e('How long the slideshow transition takes', CSDOMAIN) ?>   (in milliseconds)
                                        </p>
                                    </li>
                                </ul>
                                <ul class="form-elements noborder">
                                    <li class="to-label">
                                        <label><?php _e('Pause Time', CSDOMAIN) ?></label>
                                    </li>
                                    <li class="to-field">
                                        <input type="text" name="cs_sudo_pause_time" size="5" class="{validate:{required:true}} bar" value="<?php echo $cs_sudo_pause_time ?>" />
                                    </li>
                                    <li class="to-desc">
                                        <p>
    <?php _e('Resume slideshow after user interaction', CSDOMAIN) ?> (in milliseconds)
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="wrap-footer" style="display:none;">
                    <input id="btn_save" class="butnthree right" type="submit" name="submit" value="<?php _e('Save All Sliders', CSDOMAIN) ?>" />
                    <div class="clear"></div>
                </div>
                <!-- Content Section End -->
        </form>
    </div>
    <div class="clear"></div>
    <!-- Right Column End -->

    <script type="text/javascript">
        function show_hide_slider(id) {
            if (id == "") {
                jQuery("div#all_tabs").hide();
            } else {
                jQuery("div#all_tabs").show('');
            }
            jQuery("div#slider_types > div").hide();
            jQuery("#" + id).show('');
            jQuery(".wrap-footer").show('');
        }
        function sliders_save() {
            $ = jQuery;
            $("#btn_save").hide();
            $("#loading_div").html('<img src="<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif" />');
            $.ajax({
                type: 'POST',
                url: '<?php echo get_template_directory_uri() ?>/include/slider_setting_save.php',
                data: $('#frm').serialize(),
                success: function (response) {
                    $("#loading_div").html('');
                    $("#btn_save").show('');
                    $(".form-msgs p").html(response);
                    $(".form-msgs").show("");
                    slideout();
                }
            })
        }
    </script>
    <?php
}
?>