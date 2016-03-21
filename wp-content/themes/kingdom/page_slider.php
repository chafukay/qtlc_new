<?php
$cs_sliders_setttings = get_option("cs_sliders_setttings");
$cs_xmlObject = new SimpleXMLElement($cs_sliders_setttings);
if (!empty($cs_node->slider)) {
    // slider slug to id start
    $args = array(
        'name' => (string) $cs_node->slider,
        'post_type' => 'cs_slider',
        'post_status' => 'publish',
        'showposts' => 1,
    );
    $get_posts = get_posts($args);
    if ($get_posts) {
        $cs_node->slider = $get_posts[0]->ID;
    }
    // slider slug to id end
    (int) $get_slider_id = isset($cs_node->slider) ? $cs_node->slider : '';
}
if ($get_slider_id <> '') {
    slider_enqueue_style_scripts($cs_node->slider_type);
    if ($cs_node->slider_type == "Nivo Slider") {
        // nivo code start
        $width = isset($cs_node->width) ? $cs_node->width : '';
        $height = isset($cs_node->height) ? $cs_node->height : '';
        ?>
        <?php
        if ($cs_xmlObject->nivo->auto_play == 'true') {
            $cs_xmlObject->nivo->auto_play = 'false';
        } else if ($cs_xmlObject->nivo->auto_play == '') {
            $cs_xmlObject->nivo->auto_play = 'true';
        }
        ?>
        <script>
            jQuery(function () {
                jQuery('#slidernivo<?php echo $counter_gal ?>').nivoSlider({
                    effect: "<?php echo $cs_xmlObject->nivo->effect ?>",
                    manualAdvance: <?php echo $cs_xmlObject->nivo->auto_play; ?>,
                    animSpeed: <?php echo $cs_xmlObject->nivo->animation_speed ?>,
                    pauseTime: <?php echo $cs_xmlObject->nivo->pause_time ?>,
                });
            });
        </script>
        <style>
            .slider-wrapper<?php echo $counter_gal ?> {
                width:<?php echo $width ?>px;
            }*/
        </style>

        <!--<h1 class="banner-slider-heading">
                        Slider: 
        <?php
        //echo get_the_title("$cs_node->slider");
        //echo " ( ".$cs_node->slider_type." )";
        ?>
                </h1>
        -->
        <?php
        $cs_meta_slider_options = get_post_meta($cs_node->slider, "cs_meta_slider_options", true);
        if ($cs_meta_slider_options <> "") {
            ?>
            <!--slider html-->
            <div class="slider-wrapper<?php echo $counter_gal ?> theme-default">
                <div id="slidernivo<?php echo $counter_gal ?>" class="nivoSlider" style="height:406px;">
                    <?php
                    $path_db = '';
                    $title_db = '';
                    $description_db = '';
                    $link_db = '';
                    $link_target_db = '';
                    $box_align_db = '';
                    $cs_xmlObject = new SimpleXMLElement($cs_meta_slider_options);
                    $counter_nivo_slider_start = 0;
                    foreach ($cs_xmlObject->children() as $as_node) {
                        $counter_nivo_slider_start++;
                        $path_db = isset($as_node->path) ? $as_node->path : '';
                        $title_db = isset($as_node->title) ? $as_node->title : '';
                        $description_db = isset($as_node->description) ? $as_node->description : '';
                        $link_db = isset($as_node->link) ? $as_node->link : '';
                        $link_target_db = isset($as_node->link_target) ? $as_node->link_target : '';
                        $box_align_db = isset($as_node->box_align) ? $as_node->box_align : '';
                        //$image_url = wp_get_attachment_image_src($as_node->path, array(980,418),true);
                        $image_url = cs_attachment_image_src((int) $as_node->path, $cs_node->width, 406);
                        ?>
                        <a target="<?php echo $as_node->link_target; ?>" href="<?php echo $as_node->link ?>"><img src="<?php echo $image_url ?>" data-thumb="<?php echo $image_url ?>" alt="" title="#id<?php echo $counter_nivo_slider_start; ?>" /></a>
                    <?php } ?>
                </div>
                <?php
                $cs_xmlObject = new SimpleXMLElement($cs_meta_slider_options);
                $counter_nivo_slider = 0;
                foreach ($cs_xmlObject->children() as $as_node) {
                    if ($as_node->title != '' && $as_node->description != '' || $as_node->title != '' || $as_node->description != '') {
                        $counter_nivo_slider++
                        ?>
                        <div id="id<?php echo $counter_nivo_slider ?>" class="nivo-html-caption">                
                            <div class="nivo-caption-in <?php echo $as_node->box_align ?>">    
                                <p class="capt-in">
                                <h4 class="white"><a target="<?php echo $as_node->link_target; ?>" class="white" href="<?php echo $as_node->link ?>"><?php
                                        echo substr($as_node->title, 0, 30);
                                        if (strlen($as_node->title) > 30)
                                            echo "...";
                                        ?></a></h4>
                                <div class="clear"></div>
                                <div class="banner-text">
                                    <p>
                                        <?php
                                        echo substr($as_node->description, 0, 220);
                                        if (strlen($as_node->description) > 220)
                                            echo "...";
                                        ?>
                                    </p>
                                </div>     
                                </p>
                            </div>
                        </div>
                    <?php } //If Condition of title ?>
                <?php } // foreach loop end ?>                
            </div>
        <?php } ?>
        <!--slider html-->
        <div class="clear"></div>
        <?php
        // nivo code end
    }
    else if ($cs_node->slider_type == "Sudo Slider") {
        // sudo code start
        $width = isset($cs_node->width) ? $cs_node->width : '';
        $height = isset($cs_node->height) ? $cs_node->height : '';
        ?>

        <div class="banner-slider">
            <!--    <h1 class="banner-slider-heading">
                    Slider: 
            <?php
            echo get_the_title("$cs_node->slider");
            echo " ( " . $cs_node->slider_type . " )";
            ?>
                </h1>
            -->
            <?php
            $cs_meta_slider_options = get_post_meta($cs_node->slider, "cs_meta_slider_options", true);
            if ($cs_meta_slider_options <> "") {
                ?>
                <style>
                    .sudoslider<?php echo $counter_gal ?>{
                        width:<?php echo $width ?>px;
                        height:<?php echo $height ?>px;
                        position:relative !important;
                    }
                    #sudoslider<?php echo $counter_gal ?>{
                        width:<?php echo $width ?>px;
                        height:<?php echo $height ?>px;
                        position:relative !important;
                    }
                    #sudoslider<?php echo $counter_gal ?> img{
                        width:<?php echo $width ?>px;
                        height:<?php echo $height ?>px;
                    }
                </style>
                <?php
                if ($cs_xmlObject->sudo->effect == 'Fade') {
                    $cs_xmlObject->sudo->effect = 'true';
                }
                ?>
                <?php
                if ($cs_xmlObject->sudo->effect == 'Vertical') {
                    $cs_xmlObject->sudo->effect = 'false';
                }
                ?>
                <?php
                if ($cs_xmlObject->sudo->auto_play == '') {
                    $cs_xmlObject->sudo->auto_play = 'false';
                }
                ?>
                <script>
                    jQuery(function ($) {
                        var ajaximages = [
            <?php
            $path_db = '';
            $title_db = '';
            $description_db = '';
            $link_db = '';
            $link_target_db = '';
            $box_align_db = '';
            $cs_xmlObject_sudo = new SimpleXMLElement($cs_meta_slider_options);
            foreach ($cs_xmlObject_sudo->children() as $as_node) {
                $path_db = isset($as_node->path) ? $as_node->path : '';
                $title_db = isset($as_node->title) ? $as_node->title : '';
                $description_db = isset($as_node->description) ? $as_node->description : '';
                $link_db = isset($as_node->link) ? $as_node->link : '';
                $link_target_db = isset($as_node->link_target) ? $as_node->link_target : '';
                $box_align_db = isset($as_node->box_align) ? $as_node->box_align : '';
                ?>
                <?php
                //$image_url = wp_get_attachment_image_src($as_node->path, array(980,418),true);
                $image_url = cs_attachment_image_src((int) $as_node->path, $cs_node->width, 406);
                echo $image_url
                ?>,
                <?php
            }
            ?>
                        ];
                        var imagestext = [
            <?php
            $path_db = '';
            $title_db = '';
            $description_db = '';
            $link_db = '';
            $link_target_db = '';
            $box_align_db = '';
            foreach ($cs_xmlObject_sudo->children() as $as_node) {
                if ($as_node->title != '' && $as_node->description != '' || $as_node->title != '' || $as_node->description != '') {
                    $path_db = isset($as_node->path) ? $as_node->path : '';
                    $title_db = isset($as_node->title) ? $as_node->title : '';
                    $description_db = isset($as_node->description) ? $as_node->description : '';
                    $link_db = isset($as_node->link) ? $as_node->link : '';
                    $link_target_db = isset($as_node->link_target) ? $as_node->link_target : '';
                    $box_align_db = isset($as_node->box_align) ? $as_node->box_align : '';
                    ?>
                                    '<h1 class="title backcolr"><a target="<?php echo $as_node->link_target ?>" href="<?php $as_node->link ?>"><?php
                    echo substr($as_node->title, 0, 16);
                    if (strlen($as_node->title) > 16)
                        echo "...";
                    ?></a></h1><p><?php
                    echo substr($as_node->description, 0, 220);
                    if (strlen($as_node->description) > 220)
                        echo "...";
                    ?></p>',
                                    //echo '<a target="'.$as_node->link_target.'" href="'.$as_node->link.'"><h3>'.$as_node->title .'</h3><p>'. $as_node->description.'</p></a>';
                <?php } ?>
            <?php } ?>
                        ];
                        var caption_text = [
            <?php
            foreach ($cs_xmlObject_sudo->children() as $as_node) {
                if ($as_node->title != '' && $as_node->description != '' || $as_node->title != '' || $as_node->description != '') {
                    //$path_db = $as_node->path;
                    //$title_db = $as_node->title;
                    //$description_db = $as_node->description;
                    //$link_db = $as_node->link;
                    //$link_target_db = $as_node->link_target;
                    $box_align_db = $as_node->box_align;
                    ?>
                                    '<?php
                    echo $box_align_db;
                    ?>',
                <?php } ?>
            <?php } ?>
                        ];
                        var sudoSlider = $("#sudoslider<?php echo $counter_gal ?>").sudoSlider({
                            fade:<?php echo $cs_xmlObject->sudo->effect; ?>,
                            auto: <?php echo $cs_xmlObject->sudo->auto_play; ?>,
                            speed: <?php echo $cs_xmlObject->sudo->animation_speed ?>,
                            pause: <?php echo $cs_xmlObject->sudo->pause_time ?>,
                            //resumePause: 10000,
                            //prevNext:false,
                            prevNext: true,
                            numeric: false,
                            continuous: true,
                            crossFade: false,
                            responsive: true,
                            //vertical:true,
                            ajax: ajaximages,
                            ajaxLoadFunction: function (t) {
                                $(this)
                                        .css("position", "relative")
                                        .append('<div class="caption ' + caption_text[t - 1] + '"><div class="capt-in">' + imagestext[t - 1] + '</div></div>');
                            },
                            beforeAniFunc: function (t) {
                                $(this).children('.caption').hide();
                            },
                            afterAniFunc: function (t) {
                                $(this).children('.caption').slideDown(400);
                            }
                        });
                    });
                </script>
            <?php } ?>
            <div class="sudoslid sudoslider<?php echo $counter_gal ?>">
                <div id="sudoslider<?php echo $counter_gal ?>" class="sudo-slider"></div>
            </div>

            <div class="clear"></div>
        </div>

        <?php
        // sudo code end
    } else if ($cs_node->slider_type == "Anything Slider") {
        // anything code start
        if ($cs_xmlObject->anything->auto_play <> "true") {
            $cs_xmlObject->anything->auto_play = "true";
        }
        $width = $cs_node->width;
        $height = $cs_node->height;
        ?>
        <?php $inc_path_anything = get_template_directory_uri() . '/scripts/frontend/'; ?>
        <style>
            #slider<?php echo $counter_gal ?> {
                width:<?php echo $width ?>px;
                height:<?php echo $height ?>px;
            }
        </style>

        <script>
            jQuery(function ($) {
                $('#slider<?php echo $counter_gal ?>')
                        .anythingSlider({
                            autoPlay: <?php echo $cs_xmlObject->anything->auto_play ?>,
                            animationTime: <?php echo $cs_xmlObject->anything->animation_speed ?>,
                            delay: <?php echo $cs_xmlObject->anything->pause_time ?>,
                            //buildNavigation     : true,
                            //buildStartStop      : true,
                            //navigationFormatter : function(i, panel){
                            //return ['Top', 'Right', 'Bottom', 'Left'][i - 1];
                            //}
                        })
                        .anythingSliderFx({
                            '.caption-top': ['caption-Top', '50px', '1000', 'easeOutBounce'],
                            '.caption-right': ['caption-Right', '130px', '1000', 'easeOutBounce'],
                            '.caption-bottom': ['caption-Bottom', '50px', '1000', 'easeOutBounce'],
                            '.caption-left': ['caption-Left', '130px', '1000', 'easeOutBounce']
                        })
                        // add a close button (x) to the caption
                        .find('div[class*=caption]')
                        .css({position: 'absolute'})
                        //.prepend('<span class="as_close">Close</span>')
                        .find('.as_close').click(function () {
                    var cap = $(this).parent(),
                            ani = {bottom: -50}; // bottom
                    if (cap.is('.caption-top')) {
                        ani = {top: -50};
                    }
                    if (cap.is('.caption-left')) {
                        ani = {left: -150};
                    }
                    if (cap.is('.caption-right')) {
                        ani = {right: -150};
                    }
                    cap.animate(ani, 400);
                });
            });
        </script>

        <div class="banner-slider">
            <!--    <h1 class="banner-slider-heading">
                    Slider: 
            <?php
            //echo get_the_title("$cs_node->slider");
            //echo " ( ".$cs_node->slider_type." )";
            ?>
                </h1>
            -->
            <?php
            $cs_meta_slider_options = get_post_meta($cs_node->slider, "cs_meta_slider_options", true);
            if ($cs_meta_slider_options <> "") {
                ?>
                <ul id="slider<?php echo $counter_gal ?>">
                    <?php
                    $path_db = '';
                    $title_db = '';
                    $description_db = '';
                    $link_db = '';
                    $link_target_db = '';
                    $box_align_db = '';
                    $cs_xmlObject = new SimpleXMLElement($cs_meta_slider_options);
                    foreach ($cs_xmlObject->children() as $as_node) {
                        $path_db = $as_node->path;
                        $title_db = $as_node->title;
                        $description_db = $as_node->description;
                        $link_db = $as_node->link;
                        $link_target_db = $as_node->use_image_as;
                        $box_align_db = $as_node->video_code;
                        if ($as_node->link <> "")
                            $as_node->link = " href = '$as_node->link' target = '$as_node->link_target' ";
                        $image_url = wp_get_attachment_image_src((int) $as_node->path, array(980, 418), true);
                        $image_url = cs_attachment_image_src((int) $as_node->path, $cs_node->width, 406);
                        //$video_id =  substr(parse_url($as_node->video_code, PHP_URL_PATH), 1); 
                        ?>
                        <li>
                            <a target="<?php //echo $as_node->link_target;         ?>" href="<?php echo $as_node->link ?>" ><img src="<?php echo $image_url ?>" /></a>
                            <?php if ($as_node->title != '' && $as_node->description != '' || $as_node->title != '' || $as_node->description != '') { ?>
                                <div class="any-caption caption-<?php echo $as_node->box_align ?>">
                                    <div class="capt-in">
                                        <h1 class="title backcolr">
                                            <a target="<?php echo $as_node->link_target; ?>" class="white" "<?php echo $as_node->link ?>">                                   
                                                <?php
                                                echo substr($as_node->title, 0, 16);
                                                if (strlen($as_node->title) > 16)
                                                    echo "...";
                                                ?>
                                            </a>
                                        </h1>
                                        <p>
                                            <?php
                                            echo substr($as_node->description, 0, 220);
                                            //if ( strlen($as_node->description) > 220 ) echo "...";
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>
                        </li>

                    <?php } ?>
                </ul>

                <div class="clear"></div>
            <?php } ?>
        </div>
        <?php
        // anything code end
    }
    else {
        echo '<div class="box-small no-results-found"> <h5>';
        _e("No results found.", CSDOMAIN);
        echo ' </h5></div>';
    }
}?>