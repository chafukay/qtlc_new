<?php

// Sliders start
function cs_slider_register() {
    //adding columns start
    add_filter('manage_cs_slider_posts_columns', 'slider_columns_add');

    function slider_columns_add($columns) {
        //$columns['category'] = 'Category';
        $columns['author'] = __('Author', CSDOMAIN);
        return $columns;
    }

    add_action('manage_cs_slider_posts_custom_column', 'slider_columns');

    function slider_columns($name) {
        global $post;
        switch ($name) {
            case 'author':
                echo get_the_author();
                break;
        }
    }

    //adding columns end
    $labels = array(
        'name' => __('Manage Slider', 'kingdom'),
        'add_new_item' => __('Add New Slider', 'kingdom'),
        'edit_item' => __('Edit Slider', 'kingdom'),
        'new_item' => __('New Slider Item', 'kingdom'),
        'add_new' => __('Add New Slider', 'kingdom'),
        'view_item' => __('View Slider Item', 'kingdom'),
        'search_items' => __('Search Slider', 'kingdom'),
        'not_found' => __('Nothing found', 'kingdom'),
        'not_found_in_trash' => __('Nothing found in Trash', 'kingdom'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_icon' => get_template_directory_uri() . '/images/admin/slider-icon.png',
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title')
    );
    register_post_type('cs_slider', $args);
}

add_action('init', 'cs_slider_register');

// adding Slider meta info start
add_action('add_meta_boxes', 'cs_meta_slider_add');

function cs_meta_slider_add() {
    add_meta_box('cs_meta_slider', __('Slider Options', CSDOMAIN), 'cs_meta_slider', 'cs_slider', 'normal', 'high');
}

function cs_meta_slider($post) {
    ?>
    <div class="page-wrap">
        <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/scripts/admin/jquery.scrollTo-min.js"></script>
        <div class="option-sec">
            <script>
                jQuery(document).ready(function ($) {
                    $("#sortable").sortable({
                        cancel: 'li div.poped-up',
                    });
                    $(this).append("#sortable").clone();
                });
                var counter = 0;
                function clone(path) {
                    counter = counter + 1;
                    var dataString = 'path=' + path + '&counter=' + counter;
                    jQuery("#loading").html("<img src='<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif' />");
                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo get_template_directory_uri() ?>/include/slider_meta.php',
                        data: dataString,
                        success: function (response) {
                            jQuery("#loading").html("");
                            jQuery("#sortable").append(response);
                        }
                    });
                }
                function del_this(id) {
                    jQuery("#" + id).remove();
                }

                var contheight;
                function slidedit(id) {
                    var $ = jQuery;
                    $.scrollTo('.page-wrap', 800, {easing: 'swing'});
                    contheight = $('.to-social-network').height();
                    var widthvr = $('.to-social-network').height();
                    var popd = $('.poped-up').height();
                    $("#edit_" + id).css("display", "block");
                    $(".poped-up").css("top", widthvr);
                    $(".poped-up").css("height", widthvr);
                    $(".to-social-network").css("height", popd);
                    $('.poped-up').animate({
                        top: 0,
                    }, 800, function () {
    // Animation complete.
                    });
                }
                ;
                function slideclose(id) {
                    var $ = jQuery;
                    $.scrollTo('.page-wrap', 800, {easing: 'swing'});
                    var widthvr = $('.to-social-network').width();
                    $('.poped-up').animate({
                        top: contheight,
                        height: "auto"
                    }, 800, function () {
    // Animation complete.
                    });
                    $(".to-social-network").css("height", "auto");
                    $(".poped-up").hide(800).delay(800);
                    contheight = 0;
                }
                ;
            </script>
            <div class="opt-conts-in">
                <div class="to-social-network">
                    <div class="gal-active">
                        <h5 class="left"><?php _e('Media Added', CSDOMAIN) ?></h5>
                        <div id="loading" style="float:right; margin-right:10px;"></div>
                        <div class="clear"></div>
                        <ul id="sortable">
                            <?php
                            $cs_meta_slider_options = get_post_meta($post->ID, "cs_meta_slider_options", true);
                            $path = '';
                            $cs_slider_title_db = '';
                            $cs_slider_description_db = '';
                            $cs_slider_link_db = '';
                            $cs_slider_link_target_db = '';
                            $cs_slider_box_align_db = '';
                            $cs_slider_use_image_as_db = '';
                            $cs_slider_video_code_db = '';
                            if ($cs_meta_slider_options <> "") {
                                $cs_xmlObject = new SimpleXMLElement($cs_meta_slider_options);
                                $counter_slides = 0;
                                foreach ($cs_xmlObject->children() as $cs_node) {
                                    $counter_slides++;
                                    $path = isset($cs_node->path) ? $cs_node->path : '';
                                    $cs_slider_title_db = isset($cs_node->title) ? $cs_node->title : '';
                                    $cs_slider_description_db = isset($cs_node->description) ? $cs_node->description : '';
                                    $cs_slider_link_db = isset($cs_node->link) ? $cs_node->link : ''; 
                                    $cs_slider_link_target_db = isset($cs_node->link_target) ? $cs_node->link_target : ''; 
                                    $cs_slider_box_align_db = isset($cs_node->box_align) ? $cs_node->box_align : ''; 
                                    $cs_slider_use_image_as_db = isset($cs_node->use_image_as) ? $cs_node->use_image_as : '';
                                    $cs_slider_video_code_db = isset($cs_node->video_code) ? $cs_node->video_code : '';
                                    $counter = $post->ID . $counter_slides;
                                    include get_template_directory() . "/include/slider_meta.php";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="to-social-list">
                        <h5><?php _e('Select Media', CSDOMAIN) ?></h5>
                        <div class="right">
                            <input id="cs_log" name="cs_logo" type="button" class="uploadfile button" value="<?php _e('Upload Media', CSDOMAIN) ?>" style="margin-right:10px" />
                            <input type="button" class="button" value="<?php _e('Reload', CSDOMAIN) ?>" onclick="refresh_media()" />
                        </div>
                        <div class="clear"></div>
                        <script type="text/javascript">
                            function refresh_media() {
                                jQuery("#pagination").html("<img src='<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif' />").load('<?php echo get_template_directory_uri() ?>/include/pagination.php');
                            }
                            function show_next(page_id, total_pages) {
                                jQuery("#pagination").html("<img src='<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif' />").load('<?php echo get_template_directory_uri() ?>/include/pagination.php?page_id=' + page_id + '&total_pages=' + total_pages);
                            }
                        </script>
                        <div class="clear"></div>
                        <div id="pagination">
    <?php include get_template_directory() . "/include/pagination.php"; ?>
                        </div>
                        <input type="hidden" name="slider_meta_form" value="1" />
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <?php
}

// adding Slider meta info end
// saving Slider meta start
if (isset($_POST['slider_meta_form']) and $_POST['slider_meta_form'] == 1) {
    add_action('save_post', 'cs_meta_slider_options');

    function cs_meta_slider_options($post_id) {
        $counter = 0;
        $sxe = new SimpleXMLElement("<slider_options></slider_options>");
        if (isset($_POST['path'])) {
            foreach ($_POST['path'] as $count) {
                $slider = $sxe->addChild('slider');
                $slider->addChild('path', $_POST['path'][$counter]);
                $slider->addChild('title', htmlspecialchars($_POST['cs_slider_title'][$counter]));
                $slider->addChild('description', htmlspecialchars($_POST['cs_slider_description'][$counter]));
                $slider->addChild('link', htmlspecialchars($_POST['cs_slider_link'][$counter]));
                $slider->addChild('link_target', $_POST['cs_slider_link_target'][$counter]);
                $slider->addChild('box_align', $_POST['cs_slider_box_align'][$counter]);
                $counter++;
            }
        }
        update_post_meta($post_id, 'cs_meta_slider_options', $sxe->asXML());
    }

}
// saving Slider meta end
// Sliders end
?>