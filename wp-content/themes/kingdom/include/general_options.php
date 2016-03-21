<?php

function general_options() {
    foreach ($_REQUEST as $keys => $values) {
        $$keys = trim($values);
    }
    $cs_color_scheme = "";
    $cs_style_sheet = "";
    $cs_bg = '';
    $cs_bg_position = '';
    $cs_bg_repeat = '';
    $cs_bg_attach = '';
    $cs_bg_pattern = '';
    $custome_pattern = '';
    $cs_bg_color = '';
    $cs_color_scheme = '';
    $cs_style_sheet = '';
    $cs_gs_color_style = get_option("cs_gs_color_style");
    if ($cs_gs_color_style <> "") {
        $sxe = new SimpleXMLElement($cs_gs_color_style);
        $cs_bg = isset($sxe->cs_bg) ? $sxe->cs_bg : '';
        $cs_bg_position = isset($sxe->cs_bg_position) ? $sxe->cs_bg_position : '';
        $cs_bg_repeat = isset($sxe->cs_bg_repeat) ? $sxe->cs_bg_repeat : '';
        $cs_bg_attach = isset($sxe->cs_bg_attach) ? $sxe->cs_bg_attach : '';
        $cs_bg_pattern = isset($sxe->cs_bg_pattern) ? $sxe->cs_bg_pattern : '';
        $custome_pattern = isset($sxe->custome_pattern) ? $sxe->custome_pattern : '';
        $cs_bg_color = isset($sxe->cs_bg_color) ? $sxe->cs_bg_color : '';
        $cs_color_scheme = isset($sxe->cs_color_scheme) ? $sxe->cs_color_scheme : '';
        $cs_style_sheet = isset($sxe->cs_style_sheet) ? $sxe->cs_style_sheet : '';
    } else {
        $custome_pattern = 'none';
    }
    $cs_logo = '';
    $cs_width = '';
    $cs_height = '';
    $cs_gs_logo = get_option("cs_gs_logo");
    if ($cs_gs_logo <> "") {
        $sxe = new SimpleXMLElement($cs_gs_logo);
        $cs_logo = isset($sxe->cs_logo) ? $sxe->cs_logo : '';
        $cs_width = isset($sxe->cs_width) ? $sxe->cs_width : '';
        $cs_height = isset($sxe->cs_height) ? $sxe->cs_height : '';
    }
    if ($cs_width == "")
        $cs_width = 1;
    if ($cs_height == "")
        $cs_height = 1;
    $cs_fav_icon = '';
    $cs_header_code = '';
    $header_phone = '';
    $cs_gs_header_script = get_option("cs_gs_header_script");
    if ($cs_gs_header_script <> "") {
        $sxe = new SimpleXMLElement($cs_gs_header_script);
        $cs_fav_icon = isset($sxe->cs_fav_icon) ? $sxe->cs_fav_icon : '';
        $cs_header_code = isset($sxe->cs_header_code) ? $sxe->cs_header_code : '';
        $header_phone = isset($sxe->header_phone) ? $sxe->header_phone : '';
    }
    $cs_footer_logo = '';
    $cs_copyright = '';
    $cs_powered_by = '';
    $cs_powered_icon = '';
    $cs_analytics = '';
    $cs_gs_footer_settings = get_option("cs_gs_footer_settings");
    if ($cs_gs_footer_settings <> "") {
        $sxe = new SimpleXMLElement($cs_gs_footer_settings);
        $cs_footer_logo = isset($sxe->cs_footer_logo) ? $sxe->cs_footer_logo : '';
        $cs_copyright = isset($sxe->cs_copyright) ? $sxe->cs_copyright : '';
        $cs_powered_by = isset($sxe->cs_powered_by) ? $sxe->cs_powered_by : '';
        $cs_powered_icon = isset($sxe->cs_powered_icon) ? $sxe->cs_powered_icon : '';
        $cs_analytics = isset($sxe->cs_analytics) ? $sxe->cs_analytics : '';
    }
    $cs_gs_captcha = get_option("cs_gs_captcha");
    $captcha = "";
    if ($cs_gs_captcha <> "") {
        $sxe = new SimpleXMLElement($cs_gs_captcha);
        $captcha = isset($sxe->captcha) ? $sxe->captcha : '';
    }
    $cs_gs_others = get_option("cs_gs_others");
    $cs_responsive = "";
    $cs_breadcrumb = "";
    $theme_rtl = "";
    $cs_translation_switcher = "";
    $cs_color_picker = "";
    if ($cs_gs_others <> "") {
        $sxe = new SimpleXMLElement($cs_gs_others);
        $cs_responsive = isset($sxe->responsive) ? $sxe->responsive : '';
        $cs_breadcrumb = isset($sxe->breadcrumb) ? $sxe->breadcrumb : '';
        $theme_rtl = isset($sxe->theme_rtl) ? $sxe->theme_rtl : '';
        $cs_translation_switcher = isset($sxe->translation_switcher) ? $sxe->translation_switcher : '';
        $cs_color_picker = isset($sxe->color_picker) ? $sxe->color_picker : '';
    }
    ?>

    <div class="theme-wrap fullwidth">
        <?php include "theme_leftnav.php"; ?>
        <!-- Right Column Start -->
        <div class="col2 left">
            <!-- Header Start -->
            <div class="wrap-header">
                <h4 class="bold"><?php _e('General Settings', CSDOMAIN) ?></h4>            
                <div class="clear"></div>
            </div>
            <!-- Header End -->
            <script type="text/javascript">
                jQuery(function ($) {
                    $("#width-slider").slider({
                        range: "min",
                        value: <?php echo $cs_width; ?>,
                        min: 1,
                        max: 400,
                        slide: function (event, ui) {
                            $("#width-value").val(ui.value);
                        }
                    });
                    $("#width-value").val($("#width-slider").slider("value"));
                });

                jQuery(function ($) {
                    $("#height-slider").slider({
                        range: "min",
                        value: <?php echo $cs_height; ?>,
                        min: 1,
                        max: 400,
                        slide: function (event, ui) {
                            $("#height-value").val(ui.value);
                        }
                    });
                    $("#height-value").val($("#height-slider").slider("value"));
                });
                function gs_tab(id) {
                    var $ = jQuery;
                    $("#gs_tab_save" + id).hide();
                    $("#gs_tab_loading" + id).show('');
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo get_template_directory_uri() ?>/include/general_options_save.php',
                        data: $('#frm' + id).serialize(),
                        success: function (response) {
                            //$('#frm_slide').get(0).reset();
                            $(".form-msgs p").html(response);
                            $(".form-msgs").show("");
                            $("#gs_tab_save" + id).show('');
                            $("#gs_tab_loading" + id).hide();
                            slideout();
                            //$('#frm_slide').find('.form_result').html(response);
                        }
                    });
                }
                jQuery().ready(function ($) {
                    var container = $('div.container');
                    // validate the form when it is submitted
                    var validator = $("#frm1").validate({
                        errorContainer: container,
                        errorLabelContainer: $(container),
                        errorElement: 'span',
                        errorClass: 'ele-error',
                        meta: "validate"
                    });
                });
                jQuery().ready(function ($) {
                    var container = $('div.container');
                    // validate the form when it is submitted
                    var validator = $("#frm2").validate({
                        errorContainer: container,
                        errorLabelContainer: $(container),
                        errorElement: 'span',
                        errorClass: 'ele-error',
                        meta: "validate"
                    });
                });
                jQuery().ready(function ($) {
                    var container = $('div.container');
                    // validate the form when it is submitted
                    var validator = $("#frm3").validate({
                        errorContainer: container,
                        errorLabelContainer: $(container),
                        errorElement: 'span',
                        errorClass: 'ele-error',
                        meta: "validate"
                    });
                });
                jQuery().ready(function ($) {
                    var container = $('div.container');
                    // validate the form when it is submitted
                    var validator = $("#frm4").validate({
                        errorContainer: container,
                        errorLabelContainer: $(container),
                        errorElement: 'span',
                        errorClass: 'ele-error',
                        meta: "validate"
                    });
                });
                jQuery().ready(function ($) {
                    var container = $('div.container');
                    // validate the form when it is submitted
                    var validator = $("#frm5").validate({
                        errorContainer: container,
                        errorLabelContainer: $(container),
                        errorElement: 'span',
                        errorClass: 'ele-error',
                        meta: "validate"
                    });
                });

                jQuery(document).ready(function ($) {
                    var consoleTimeout;
                    $('.minicolors').each(function () {
                        $(this).minicolors({
                            change: function (hex, opacity) {
                                // Generate text to show in console
                                text = hex ? hex : 'transparent';
                                if (opacity)
                                    text += ', ' + opacity;
                                text += ' / ' + $(this).minicolors('rgbaString');
                            }
                        });
                    });
                });
            </script>

            <div class="tab-section">
                <div class="tab_menu_container">
                    <ul id="tab_menu">  
                        <li><a href="#colorstyle" class="current" rel="tab-color"><span><?php _e('Color and Style', CSDOMAIN) ?></span></a></li>
                        <li><a href="#logo" class="" rel="tab-logo"><span><?php _e('Logo', CSDOMAIN) ?></span></a></li>
                        <li><a href="#headscript" class="" rel="tab-head-scripts"><span><?php _e('Header Scripts', CSDOMAIN) ?></span></a></li>
                        <li><a href="#footersetting" class="" rel="tab-foot-setting"><span><?php _e('Footer Settings', CSDOMAIN) ?></span></a></li>
                        <li><a href="#captcha-settings" class="" rel="tab-captcha"><span><?php _e('Captcha Settings', CSDOMAIN) ?></span></a></li>
                        <li><a href="#responsive" class="" rel="tab-others"><span><?php _e('Others', CSDOMAIN) ?></span></a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="tab_container">
                    <div class="tab_container_in">
                        <div class='form-msgs' style="display:none"><div class='to-notif success-box'><span class='tick'>&nbsp;</span><p></p><a class='close-it' onclick='tab_close()'>&nbsp;</a></div></div>
                        <!-- Color And Style Start -->
                        <div id="tab-color" class="tab-list">
                            <div class="elements">
                                <form id="frm1" method="post" action="javascript:gs_tab(1)">
                                    <div class="option-sec">
                                        <div class="opt-head">
                                            <h6><?php _e('Color And Styles', CSDOMAIN) ?></h6>
                                            <p><?php _e('Theme color scheme and styling setting', CSDOMAIN) ?></p>
                                            <div id="gs_tab_loading1" class="ajax-loaders">
                                                <img src="<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif" />
                                            </div>
                                        </div>
                                        <div class="opt-conts">
                                            <ul class="form-elements">
                                                <li class="to-label">
                                                    <label><?php _e('Select Stylesheet', CSDOMAIN) ?></label>
                                                </li>
                                                <li class="to-field">
                                                    <select name="cs_style_sheet" onchange="hide_custom_color_scheme(this.value)">
                                                        <option value=""><?php _e('Default Color Scheme', CSDOMAIN) ?></option>
                                                        <?php
                                                        foreach (glob(TEMPLATEPATH . "/css/custom_styles/*.css") as $filename) {
                                                            //echo "$filename size " . filesize($filename) . "\n";
                                                            $vals = str_replace(TEMPLATEPATH . "/css/custom_styles/", "", $filename);
                                                            $vals = str_replace(".css", "", $vals);
                                                            ?>
                                                            <option value="<?php echo $vals; ?>" <?php
                                                            if ($cs_style_sheet == $vals) {
                                                                echo "selected";
                                                            }
                                                            ?> ><?php echo ucfirst($vals); ?></option>
                                                                <?php } ?>
                                                        <option value="custom" <?php
                                                        if ($cs_style_sheet == "custom") {
                                                            echo "selected";
                                                        }
                                                        ?> > -- Custom Color Scheme -- </option>
                                                    </select>
                                                </li>
                                                <li class="to-desc"><p><?php _e('Please select stylesheet(color scheme) from dropdown', CSDOMAIN) ?></p></li>
                                                <div class="wpcolor-picker form-elements noborder" id="cs_color_scheme" <?php if ($cs_style_sheet <> "custom") echo 'style="display:none"' ?> >
                                                    <li class="to-label"><label><?php _e('Color Scheme', CSDOMAIN) ?></label></li>
                                                    <li class="to-field"><input type="text" name="cs_color_scheme" value="<?php echo $cs_color_scheme ?>" class="minicolors" size="7" /></li>
                                                    <li class="to-desc"><p><?php _e('Pick a custom color for Scheme of the theme', CSDOMAIN) ?> e.g. #697e09</p></li>
                                                </div>
                                            </ul>
                                            <ul class="form-elements">
                                                <li class="to-label">
                                                    <label><?php _e('Background Image', CSDOMAIN) ?></label>
                                                </li>
                                                <li class="to-field">
                                                    <input id="cs_bg" name="cs_bg" value="<?php echo $cs_bg; ?>" type="text" class="{validate:{accept:'jpg|jpeg|gif|png|bmp'}}" size="36" />
                                                    <input id="cs_bg" name="cs_bg" type="button" class="uploadfile left" value="<?php _e('Browse', CSDOMAIN) ?>"/>
                                                </li>
                                                <li class="to-desc">
                                                    <div class="logo-thumb">
                                                        <?php if ($cs_bg <> "") { ?>
                                                            <img id="cs_bg_img" width="150" height="150" src="<?php echo $cs_bg ?>" />
                                                        <?php } ?>
                                                        <a data-id="cs_bg_img" href="javascript:remove_logo('cs_bg')" class="closethumb">&nbsp;</a>
                                                    </div>
                                                </li>
                                                <div class="wpcolor-picker form-elements noborder">
                                                    <li class="to-label"><label><?php _e('Position', CSDOMAIN) ?></label></li>
                                                    <li class="to-field">
                                                        <input type="radio" name="cs_bg_position" value="left" <?php if ($cs_bg_position == "left") echo "checked" ?> /> <?php _e('Left', CSDOMAIN) ?> &nbsp; 
                                                        <input type="radio" name="cs_bg_position" value="center" <?php if ($cs_bg_position == "center") echo "checked" ?> /> <?php _e('Center', CSDOMAIN) ?> &nbsp; 
                                                        <input type="radio" name="cs_bg_position" value="right" <?php if ($cs_bg_position == "right") echo "checked" ?> /><?php _e('Right', CSDOMAIN) ?>  &nbsp; 
                                                    </li>
                                                    <li class="to-desc"><p></p></li>
                                                </div>
                                                <div class="wpcolor-picker form-elements noborder">
                                                    <li class="to-label"><label><?php _e('Repeat', CSDOMAIN) ?></label></li>
                                                    <li class="to-field">
                                                        <input type="radio" name="cs_bg_repeat" value="no-repeat" <?php if ($cs_bg_repeat == "no-repeat") echo "checked" ?> /> <?php _e('No Repeat', CSDOMAIN) ?>
                                                        <input type="radio" name="cs_bg_repeat" value="repeat" <?php if ($cs_bg_repeat == "repeat") echo "checked" ?> /> <?php _e('Tile', CSDOMAIN) ?>
                                                        <input type="radio" name="cs_bg_repeat" value="repeat-x" <?php if ($cs_bg_repeat == "repeat-x") echo "checked" ?> /> <?php _e('Tile Horizontally', CSDOMAIN) ?>
                                                        <input type="radio" name="cs_bg_repeat" value="repeat-y" <?php if ($cs_bg_repeat == "repeat-y") echo "checked" ?> /><?php _e('Tile Vertically', CSDOMAIN) ?> 
                                                    </li>
                                                    <li class="to-desc"><p></p></li>
                                                </div>
                                                <div class="wpcolor-picker form-elements noborder">
                                                    <li class="to-label"><label><?php _e('Attachment', CSDOMAIN) ?></label></li>
                                                    <li class="to-field">
                                                        <input type="radio" name="cs_bg_attach" value="scroll" <?php if ($cs_bg_attach == "scroll") echo "checked" ?> /> <?php _e('Scroll', CSDOMAIN) ?> &nbsp; 
                                                        <input type="radio" name="cs_bg_attach" value="fixed" <?php if ($cs_bg_attach == "fixed") echo "checked" ?> /><?php _e('Fixed', CSDOMAIN) ?> &nbsp; 
                                                    </li>
                                                    <li class="to-desc"><p></p></li>
                                                </div>
                                            </ul>
                                            <ul class="form-elements">
                                                <li class="to-label">
                                                    <label><?php _e('Background Pattern', CSDOMAIN) ?></label>
                                                </li>
                                                <li class="to-field">
                                                    <div class="meta-input pattern">
                                                        <div class='radio-image-wrapper'>
                                                            <input <?php if ($custome_pattern == "") echo "checked" ?> onclick="select_pattern()" type="radio" name="custome_pattern" class="radio" value="" />
                                                            <label for="radio_0">
                                                                <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/none.png" /></span>
                                                                <span <?php if ($custome_pattern == "") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/tick.png" /></span>
                                                            </label>
                                                        </div>
                                                        <div class='radio-image-wrapper'>
                                                            <input <?php if ($custome_pattern == "pattern1") echo "checked" ?> onclick="select_pattern()" type="radio" name="custome_pattern" class="radio" value="pattern1" />
                                                            <label for="radio_1">
                                                                <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/pattern1.png" /></span>
                                                                <span <?php if ($custome_pattern == "pattern1") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/tick.png" /></span>
                                                            </label>
                                                        </div>
                                                        <div class='radio-image-wrapper'>
                                                            <input <?php if ($custome_pattern == "pattern2") echo "checked" ?> onclick="select_pattern()" type="radio" name="custome_pattern" class="radio" value="pattern2" />
                                                            <label for="radio_2">
                                                                <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/pattern2.png" /></span>
                                                                <span <?php if ($custome_pattern == "pattern2") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/tick.png" /></span>
                                                            </label>
                                                        </div>
                                                        <div class='radio-image-wrapper'>
                                                            <input <?php if ($custome_pattern == "pattern3") echo "checked" ?> onclick="select_pattern()" type="radio" name="custome_pattern" class="radio" value="pattern3" />
                                                            <label for="radio_3">
                                                                <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/pattern3.png" /></span>
                                                                <span <?php if ($custome_pattern == "pattern3") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/tick.png" /></span>
                                                            </label>
                                                        </div>
                                                        <div class='radio-image-wrapper'>
                                                            <input <?php if ($custome_pattern == "pattern4") echo "checked" ?> onclick="select_pattern()" type="radio" name="custome_pattern" class="radio" value="pattern4" />
                                                            <label for="radio_4">
                                                                <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/pattern4.png" /></span>
                                                                <span <?php if ($custome_pattern == "pattern4") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/tick.png" /></span>
                                                            </label>
                                                        </div>
                                                        <div class='radio-image-wrapper'>
                                                            <input <?php if ($custome_pattern == "pattern5") echo "checked" ?> onclick="select_pattern()" type="radio" name="custome_pattern" class="radio" value="pattern5" />
                                                            <label for="radio_5">
                                                                <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/pattern5.png" /></span>
                                                                <span <?php if ($custome_pattern == "pattern5") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/tick.png" /></span>
                                                            </label>
                                                        </div>
                                                        <div class='radio-image-wrapper'>
                                                            <input <?php if ($custome_pattern == "pattern6") echo "checked" ?> onclick="select_pattern()" type="radio" name="custome_pattern" class="radio" value="pattern6" />
                                                            <label for="radio_6">
                                                                <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/pattern6.png" /></span>
                                                                <span <?php if ($custome_pattern == "pattern6") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/tick.png" /></span>
                                                            </label>
                                                        </div>
                                                        <div class='radio-image-wrapper'>
                                                            <input <?php if ($custome_pattern == "pattern7") echo "checked" ?> onclick="select_pattern()" type="radio" name="custome_pattern" class="radio" value="pattern7" />
                                                            <label for="radio_7">
                                                                <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/pattern7.png" /></span>
                                                                <span <?php if ($custome_pattern == "pattern7") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/tick.png" /></span>
                                                            </label>
                                                        </div>
                                                        <div class='radio-image-wrapper'>
                                                            <input <?php if ($custome_pattern == "pattern8") echo "checked" ?> onclick="select_pattern()" type="radio" name="custome_pattern" class="radio" value="pattern8" />
                                                            <label for="radio_8">
                                                                <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/pattern8.png" /></span>
                                                                <span <?php if ($custome_pattern == "pattern8") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/tick.png" /></span>
                                                            </label>
                                                        </div>
                                                        <div class='radio-image-wrapper'>
                                                            <input <?php if ($custome_pattern == "pattern9") echo "checked" ?> onclick="select_pattern()" type="radio" name="custome_pattern" class="radio" value="pattern9" />
                                                            <label for="radio_9">
                                                                <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/pattern9.png" /></span>
                                                                <span <?php if ($custome_pattern == "pattern9") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/tick.png" /></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <input id="cs_bg_pattern" name="cs_bg_pattern" value="<?php echo $cs_bg_pattern; ?>" type="text" class="{validate:{accept:'jpg|jpeg|gif|png|bmp'}}" size="36" />
                                                    <input id="cs_bg_pattern" name="cs_bg_pattern" type="button" class="uploadfile left" value="Browse"/>
                                                </li>
                                                <li class="to-desc">
                                                    <div class="logo-thumb bg_pattern_img">
                                                        <?php if ($cs_bg_pattern <> "") { ?>
                                                            <img id="cs_bg_pattern_img" width="150" height="150" src="<?php echo $cs_bg_pattern; ?>" />
                                                        <?php } ?>
                                                        <a data-id="cs_bg" href="javascript:remove_logo('cs_bg_pattern')" class="closethumb">&nbsp;</a>
                                                    </div>
                                                </li>
                                            </ul>
                                            <ul class="form-elements">
                                                <div class="wpcolor-picker form-elements noborder">
                                                    <li class="to-label"><label><?php _e('Background Color', CSDOMAIN) ?></label></li>
                                                    <li class="to-field"><input type="text" name="cs_bg_color" value="<?php echo $cs_bg_color ?>" class="minicolors" size="7" /></li>
                                                    <li class="to-desc"><p></p></li>
                                                </div>
                                            </ul>
                                            <ul class="form-elements noborder">
                                                <li class="to-label"></li>
                                                <li class="to-field">
                                                    <input type="hidden" name="tab" value="color_style" />
                                                    <input id="gs_tab_save1" class="submit butnthree" type="submit" value="<?php _e('Save', CSDOMAIN) ?>"/>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Color And Style End -->
                        <!-- Logo Tabs -->
                        <div id="tab-logo" class="tab-list">
                            <form id="frm2" method="post" action="javascript:gs_tab(2)">
                                <div class="option-sec">
                                    <div class="opt-head">
                                        <h6><?php _e('Logo Settings', CSDOMAIN) ?></h6>
                                        <p><?php _e('Add your company logo adjust image Width, Height', CSDOMAIN) ?></p>
                                        <div id="gs_tab_loading2" class="ajax-loaders">
                                            <img src="<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif" />
                                        </div>
                                    </div>
                                    <div class="opt-conts">
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Upload Logo', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input id="cs_logo" name="cs_logo" value="<?php echo $cs_logo ?>" type="text" class="{validate:{accept:'jpg|jpeg|gif|png|bmp'}}" size="36" />
                                                <input id="cs_log" name="cs_logo" type="button" class="uploadfile left" value="<?php _e('Browse', CSDOMAIN) ?>"/>
                                            </li>
                                            <li class="to-desc">
                                                <div class="logo-thumb">
                                                    <img id="cs_logo_img" width="<?php echo $cs_width ?>" height="<?php echo $cs_height ?>" src="<?php echo $cs_logo ?>" />
                                                    <a href="javascript:remove_logo('cs_logo')" class="closethumb">&nbsp;</a>
                                                </div>
                                            </li>
                                        </ul>	
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Width', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="slide-range">
                                                    <div class="slidebar">
                                                        <div id="width-slider"></div>
                                                    </div>
                                                </div>
                                                <div class="valueinput">
                                                    <input type="text" name="cs_width" id="width-value" value="<?php echo $cs_width ?>" style="border:0; color:#f6931f; font-weight:bold;" />
                                                    <span>px</span>
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <p>
                                                    <?php _e('Please scroll left to right to increase the width of logo, Right to left decrease the logo width.', CSDOMAIN) ?>
                                                </p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Height', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="slide-range">
                                                    <div class="slidebar">
                                                        <div id="height-slider"></div>
                                                    </div>
                                                </div>
                                                <div class="valueinput">
                                                    <input type="text" name="cs_height" id="height-value" value="<?php echo $cs_height ?>" style="border:0; color:#f6931f; font-weight:bold;" />
                                                    <span>px</span>
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <p>
                                                    <?php _e('Please scroll left to right to increase the Height of Logo, Right to left decrease the logo Height', CSDOMAIN) ?>
                                                </p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements noborder">
                                            <li class="to-label">

                                            </li>
                                            <li class="to-field">
                                                <input type="hidden" name="tab" value="logo" />
                                                <input id="gs_tab_save2" class="submit butnthree" type="submit" value="<?php _e('Save', CSDOMAIN) ?>" onclick="update_logo('cs_logo')" />
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Logo Tabs End -->
                        <!-- Header Script -->
                        <div id="tab-head-scripts" class="tab-list">
                            <form id="frm3" method="post" action="javascript:gs_tab(3)">
                                <div class="option-sec">
                                    <div class="opt-head">
                                        <h6><?php _e('Header Scripts', CSDOMAIN) ?></h6>
                                        <p><?php _e('Paste your Html or Css Code here.', CSDOMAIN) ?></p>
                                        <div id="gs_tab_loading3" class="ajax-loaders">
                                            <img src="<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif" />
                                        </div>
                                    </div>
                                    <div class="opt-conts">
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('FAV Icon', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input id="cs_fav_icon" name="cs_fav_icon" value="<?php echo $cs_fav_icon ?>" type="text" size="36" class="{validate:{accept:'ico|png'}}" />
                                                <input id="cs_fav_icon" name="cs_fav_icon" type="button" class="uploadfile left" value="<?php _e('Browse', CSDOMAIN) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <p>
                                                    <?php _e('Browse a small fav icon, only .ICO or .PNG format allowed. ', CSDOMAIN) ?>
                                                </p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Header Code', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <textarea rows="" cols="" name="cs_header_code"><?php echo $cs_header_code ?></textarea>
                                            </li>
                                            <li class="to-desc">
                                                <p>
                                                    <?php _e('Paste your Html or Css Code here.', CSDOMAIN) ?>
                                                </p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Header Phone No.', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <textarea rows="" cols="" name="header_phone"><?php echo $header_phone ?></textarea>
                                            </li>
                                            <li class="to-desc">
                                                <p>
                                                    <?php _e('Paste your Html or Css Code here.', CSDOMAIN) ?>
                                                </p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements noborder">
                                            <li class="to-label">

                                            </li>
                                            <li class="to-field">
                                                <input type="hidden" name="tab" value="header_script" />
                                                <input id="gs_tab_save3" class="submit butnthree" type="submit" value="<?php _e('Save', CSDOMAIN) ?>"/>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Header Script End -->
                        <!-- Footer Settings -->
                        <div id="tab-foot-setting" class="tab-list">
                            <form id="frm4" method="post" action="javascript:gs_tab(4)">
                                <div class="option-sec">
                                    <div class="opt-head">
                                        <h6><?php _e('Footer Settings', CSDOMAIN) ?></h6>
                                        <p><?php _e('Add footer setting detail', CSDOMAIN) ?></p>
                                        <div id="gs_tab_loading4" class="ajax-loaders">
                                            <img src="<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif" />
                                        </div>
                                    </div>
                                    <div class="opt-conts">
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Custom Copyright', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <textarea rows="2" cols="4" name="cs_copyright"><?php echo $cs_copyright ?></textarea>
                                            </li>
                                            <li class="to-desc">
                                                <p>
                                                    <?php _e('Write Custom Copyright text', CSDOMAIN) ?>  
                                                </p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Powered By Text', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input type="text" name="cs_powered_by" value="<?php echo htmlspecialchars($cs_powered_by) ?>" />
                                            </li>
                                            <li class="to-desc">
                                                <p>
                                                    <?php _e('Please enter powered by text', CSDOMAIN) ?>
                                                </p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Powered By Icon', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <input id="cs_powered_icon" name="cs_powered_icon" value="<?php echo $cs_powered_icon ?>" type="text" size="36" class="{validate:{accept:'jpg|jpeg|gif|png|bmp'}}"/>
                                                <input id="cs_powered_ico" name="cs_powered_icon" type="button" class="uploadfile left" value="<?php _e('Browse', CSDOMAIN) ?>"/>
                                            </li>
                                            <li class="to-desc">
                                                <p>
                                                    <?php _e('Please upload or paste link of image to use in powered by Icon only .JPG, JPEG, PNG, GIF .BMP allowed.', CSDOMAIN) ?> 
                                                </p>
                                            </li>                                                 
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Analytics Code', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <textarea rows="" cols="" name="cs_analytics"><?php echo $cs_analytics ?></textarea>
                                            </li>
                                            <li class="to-desc">
                                                <p>
                                                    <?php _e('Paste your Google Analytics (or other) tracking code here.<br /> This will be added into the footer template of your theme.', CSDOMAIN) ?> 
                                                </p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements noborder">
                                            <li class="to-label">

                                            </li>
                                            <li class="to-field">
                                                <input type="hidden" name="tab" value="footer_settings" />
                                                <input id="gs_tab_save4" class="submit butnthree" type="submit" value="<?php _e('Save', CSDOMAIN) ?>"/>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Footer Settings End -->
                        <div id="tab-captcha" class="tab-list"> 
                            <form id="frm5" method="post" action="javascript:gs_tab(5)">
                                <div class="option-sec">
                                    <div class="opt-head">
                                        <h6><?php _e('Captcha Setting', CSDOMAIN) ?></h6>
                                        <p><?php _e('Captcha Setting', CSDOMAIN) ?></p>
                                        <div id="gs_tab_loading5" class="ajax-loaders">
                                            <img src="<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif" />
                                        </div>
                                    </div>
                                    <div class="opt-conts">
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Captcha', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="captcha" class="styled" <?php if ($captcha == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <p><?php _e('Make the Captcha On/Off', CSDOMAIN) ?></p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements noborder">
                                            <li class="to-label">

                                            </li>
                                            <li class="to-field">
                                                <input type="hidden" name="tab" value="captcha" />
                                                <input id="gs_tab_save5" class="submit butnthree" type="submit" value="<?php _e('Save', CSDOMAIN) ?>"/>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="tab-others" class="tab-list"> 
                            <form id="frm6" method="post" action="javascript:gs_tab(6)">
                                <div class="option-sec">
                                    <div class="opt-head">
                                        <h6><?php _e('Responsive Setting', CSDOMAIN) ?></h6>
                                        <p><?php _e('Set the responsive On/Off', CSDOMAIN) ?></p>
                                        <div id="gs_tab_loading5" class="ajax-loaders">
                                            <img src="<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif" />
                                        </div>
                                    </div>
                                    <div class="opt-conts">
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Responsive', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="cs_responsive" class="styled" <?php if ($cs_responsive == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <p><?php _e('Set the responsive On/Off', CSDOMAIN) ?></p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Breadcrumb', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="cs_breadcrumb" class="styled" <?php if ($cs_breadcrumb == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <p><?php _e('Set the breadcrumb On/Off', CSDOMAIN) ?></p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('RTL On / Off', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="theme_rtl" class="styled" <?php if ($theme_rtl == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <p><?php _e('Set the RTL On/Off', CSDOMAIN) ?></p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Translation Switcher', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="translation_switcher" class="styled" <?php if ($cs_translation_switcher == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <p><?php _e('Set the Translation Switcher On/Off', CSDOMAIN) ?></p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements">
                                            <li class="to-label">
                                                <label><?php _e('Color Picker', CSDOMAIN) ?></label>
                                            </li>
                                            <li class="to-field">
                                                <div class="on-off">
                                                    <input type="checkbox" name="color_picker" class="styled" <?php if ($cs_color_picker == "on") echo "checked" ?> />
                                                </div>
                                            </li>
                                            <li class="to-desc">
                                                <p><?php _e('Set the Color Picker On/Off', CSDOMAIN) ?></p>
                                            </li>
                                        </ul>
                                        <ul class="form-elements noborder">
                                            <li class="to-label">
                                            </li>
                                            <li class="to-field">
                                                <input type="hidden" name="tab" value="tab_others" />
                                                <input id="gs_tab_save6" class="submit butnthree" type="submit" value="<?php _e('Save', CSDOMAIN) ?>"/>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
        <!-- Right Column End -->
    </div>
    <?php
}
?>