<?php
//adding columns start
add_filter('manage_courses_posts_columns', 'album_columns_add');

function album_columns_add($columns) {
    $columns['category'] = __('Category', CSDOMAIN);
    $columns['tag'] = __('Tags', CSDOMAIN);
    $columns['author'] = __('Author', CSDOMAIN);
    return $columns;
}

add_action('manage_courses_posts_custom_column', 'album_columns');

function album_columns($name) {
    global $post;
    switch ($name) {
        case 'category':
            $categories = get_the_terms($post->ID, 'course-category');
            if ($categories <> "") {
                $couter_comma = 0;
                foreach ($categories as $category) {
                    echo $category->name;
                    $couter_comma++;
                    if ($couter_comma < count($categories)) {
                        echo ", ";
                    }
                }
            }
            break;
        case 'tag':
            $categories = get_the_terms($post->ID, 'course-tag');
            if ($categories <> "") {
                $couter_comma = 0;
                foreach ($categories as $category) {
                    echo $category->name;
                    $couter_comma++;
                    if ($couter_comma < count($categories)) {
                        echo ", ";
                    }
                }
            }
            break;
        case 'author':
            echo get_the_author();
            break;
    }
}

//adding columns end

function cs_album_register() {
    $labels = array(
        'name' => __('Manage Courses', 'kingdom'),
        'add_new' => __('Add New Course', CSDOMAIN),
        'add_new_item' => __('Add New Course', 'kingdom'),
        'edit_item' => __('Edit Course', 'kingdom'),
        'new_item' => __('New Course Item', 'kingdom'),
        'view_item' => __('View Course Item', 'kingdom'),
        'search_items' => __('Search Course', 'kingdom'),
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
        'menu_icon' => get_template_directory_uri() . '/images/admin/album-icon.png',
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'comments')
    );
    register_post_type('courses', $args);
}

$labels = array(
    'name' => __('Course Categories', 'kingdom'),
    'search_items' => __('Search Course Categories', 'kingdom'),
    'edit_item' => __('Edit Course Category', 'kingdom'),
    'update_item' => __('Update Course Category', 'kingdom'),
    'add_new_item' => __('Add New Course Category', 'kingdom'),
    'menu_name' => __('Course Categories', 'kingdom'),
);
register_taxonomy('course-category', array('courses'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'course-category'),
));
add_action('init', 'cs_album_register');

function cs_album_tag() {
    $labels = array(
        'name' => __('Course Tags', 'kingdom'),
        'singular_name' => __('course-tag', 'kingdom'),
        'search_items' => __('Search Tags', 'kingdom'),
        'popular_items' => __('Popular Tags', 'kingdom'),
        'all_items' => __('All Tags', 'kingdom'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit Tag', 'kingdom'),
        'update_item' => __('Update Tag', 'kingdom'),
        'add_new_item' => __('Add New Tag', 'kingdom'),
        'new_item_name' => __('New Tag Name', 'kingdom'),
        'separate_items_with_commas' => __('Separate writers with commas', 'kingdom'),
        'add_or_remove_items' => __('Add or remove tags', 'kingdom'),
        'choose_from_most_used' => __('Choose from the most used tags', 'kingdom'),
        'menu_name' => __('Course Tags', 'kingdom'),
    );
    register_taxonomy('course-tag', 'courses', array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'course-tag'),
    ));
}

add_action('init', 'cs_album_tag');

// adding album meta info start
add_action('add_meta_boxes', 'cs_meta_album_add');

function cs_meta_album_add() {
    add_meta_box('cs_meta_album', __('Course Options', CSDOMAIN), 'cs_meta_album', 'courses', 'normal', 'high');
}

function cs_meta_album($post) {
    $course_date = '';
    $course_eligibility = '';
    $course_apply = '';
    $course_social = '';
    $cs_course = get_post_meta($post->ID, "cs_course", true);
    if ($cs_course <> "") {
        $cs_xmlObject = new SimpleXMLElement($cs_course);
        $course_date = isset($cs_xmlObject->course_date) ? $cs_xmlObject->course_date : '';
        $course_eligibility = isset($cs_xmlObject->course_eligibility) ? $cs_xmlObject->course_eligibility : '';
        $course_apply = isset($cs_xmlObject->course_apply) ? $cs_xmlObject->course_apply : '';
        $course_social = isset($cs_xmlObject->course_social) ? $cs_xmlObject->course_social : '';
    } else {
        $course_date = '';
        $course_eligibility = '';
        $course_apply = '';
        $course_social = '';
    }
    ?>
    <div class="page-wrap page-opts left" style="overflow:hidden; position:relative;">
        <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/scripts/admin/jquery.scrollTo-min.js"></script>
        <div class="option-sec" style="margin-bottom:0;">
            <div class="opt-conts">
                <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Start Date', CSDOMAIN) ?></label></li>
                    <li class="to-field">
                        <!--date picker start-->
                        <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/admin/jquery.ui.datepicker.css">
                        <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/admin/jquery.ui.datepicker.theme.css">
                        <script>
                            jQuery(function ($) {
                                $("#course_date").datepicker({
                                    defaultDate: "+1w",
                                    dateFormat: "yy-mm-dd",
                                    changeMonth: true,
                                    numberOfMonths: 1,
                                    //onSelect: function( selectedDate ) {
                                    //$( "#cs_event_to_date" ).datepicker( "option", "minDate", selectedDate );
                                    //}
                                });
                            });
                        </script>
                        <!--date picker end-->
                        <input type="text" id="course_date" name="course_date" value="<?php
                        if ($course_date == "")
                            echo gmdate("Y-m-d");
                        else
                            echo $course_date
                            ?>" />
                    </li>
                    <li class="to-desc"><p><?php _e('Put start date', CSDOMAIN) ?></p></li>
                </ul>
                <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Eligibility', CSDOMAIN) ?></label></li>
                    <li class="to-field"><input type="text" name="course_eligibility" value="<?php echo htmlspecialchars($course_eligibility) ?>" /></li>
                    <li class="to-desc"><p><?php _e('Put eligibility types', CSDOMAIN) ?></p></li>
                </ul>
                <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Apply Now Url', CSDOMAIN) ?></label></li>
                    <li class="to-field"><input type="text" name="course_apply" value="<?php echo htmlspecialchars($course_apply) ?>" /></li>
                    <li class="to-desc"><p><?php _e('Enter the Full Url', CSDOMAIN) ?></p></li>
                </ul>
                <ul class="form-elements noborder">
                    <li class="to-label"><label><?php _e('Social Sharing', CSDOMAIN) ?></label></li>
                    <li class="to-field">
                        <select name="course_social" class="dropdown">
                            <option <?php if ($course_social == "Yes") echo "selected" ?> ><?php _e('Yes', CSDOMAIN) ?></option>
                            <option <?php if ($course_social == "No") echo "selected" ?> ><?php _e('No', CSDOMAIN) ?></option>
                        </select>
                    </li>
                    <li class="to-desc"><p><?php _e('Make Social Sharing On/Off', CSDOMAIN) ?></p></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>

        <div class="to-tables" style="margin-top: 10px;">
            <div id="add_track" class="poped-up">
                <div class="opt-head">
                    <h6><?php _e('Add Subject', CSDOMAIN) ?></h6>
                    <a href="javascript:closetrack('add_track')" class="closeit">&nbsp;</a>
                </div>
                <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Subject Title', CSDOMAIN) ?></label></li>
                    <li class="to-field"><input type="text" id="subject_title_dummy" name="subject_title_dummy" value="Subject Title" /></li>
                    <li class="to-desc"><p><?php _e('Put Subject title', CSDOMAIN) ?></p></li>
                </ul>
                <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Instructor', CSDOMAIN) ?></label></li>
                    <li class="to-field"><input type="text" id="subject_instructor" name="subject_instructor" /></li>
                    <li class="to-desc"><p><?php _e('Put Instructor Name', CSDOMAIN) ?></p></li>
                </ul>
                <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Credit Hours', CSDOMAIN) ?></label></li>
                    <li class="to-field"><input type="text" id="subject_credit" name="subject_credit" /></li>
                    <li class="to-desc"><p><?php _e('Put The Total Credit Hours', CSDOMAIN) ?></p></li>
                </ul>
                <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Detail Of the Subject(Url)', CSDOMAIN) ?></label></li>
                    <li class="to-field"><input type="text" id="subject_detail" name="subject_detail" /></li>
                    <li class="to-desc"><p><?php _e('Put a Url for the detail of this subject', CSDOMAIN) ?></p></li>
                </ul>
                <ul class="form-elements">
                    <li class="to-label"></li>
                    <li class="to-field"><input type="button" value="<?php _e('Add Subject to List', CSDOMAIN) ?>" onclick="add_track_to_list()" /></li>
                </ul>
            </div>

            <script>
                var counter_track = 0;
                function add_track_to_list() {
                    counter_track++;
                    var dataString = 'counter_track=' + counter_track +
                            '&subject_title=' + jQuery("#subject_title_dummy").val() +
                            '&subject_instructor=' + jQuery("#subject_instructor").val() +
                            '&subject_credit=' + jQuery("#subject_credit").val() +
                            '&subject_detail=' + jQuery("#subject_detail").val();
                    jQuery("#loading").html("<img src='<?php echo get_template_directory_uri() ?>/images/admin/ajax_loading.gif' />");
                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo get_template_directory_uri() ?>/include/album_track.php',
                        data: dataString,
                        success: function (response) {
                            jQuery("#total_tracks").append(response);
                            jQuery("#loading").html("");
                            closetrack('add_track');
                            jQuery("#subject_title_dummy").val("Subject Title");
                            jQuery("#subject_instructor").val("");
                            jQuery("#subject_credit").val("");
                            jQuery("#subject_detail").val("");
                        }
                    });
                }

                jQuery(document).ready(function ($) {
                    $("#total_tracks").sortable({
                        cancel: 'li div.poped-up',
                    });
                });
            </script>
            <h5>
                <span style="padding-top:5px; float:left;"><?php _e('Subjects', CSDOMAIN) ?></span> 
                <a href="javascript:addtrack('add_track')" class="button right"><?php _e('Add Subject', CSDOMAIN) ?></a>
            </h5>
            <ul class="to-rows to-head">
                <li class="album-title"><?php _e('Subject Title', CSDOMAIN) ?></li>
                <li class="actions"><?php _e('Actions', CSDOMAIN) ?></li>
            </ul>
            <ul id="total_tracks">
                <?php
                $subject_title = '';
                $subject_instructor = '';
                $subject_credit = '';
                $subject_detail = '';
                $counter_track = $post->ID;
                if ($cs_course <> "") {
                    foreach ($cs_xmlObject as $track) {
                        if ($track->getName() == "subject") {
                            $subject_title = isset($track->subject_title) ? $track->subject_title : '';
                            $subject_instructor = isset($track->subject_instructor) ? $track->subject_instructor : '';
                            $subject_credit = isset($track->subject_credit) ? $track->subject_credit : '';
                            $subject_detail = isset($track->subject_detail) ? $track->subject_detail : '';
                            $counter_track++;
                            include get_template_directory() . "/include/album_track.php";
                        }
                    }
                }
                ?>
            </ul>

        </div>
    <?php include "inc_meta_layout.php" ?>
        <input type="hidden" name="course_meta_form" value="1" />
        <div class="clear"></div>
    </div>
    <div class="clear"></div>

    <?php
}

if (isset($_POST['course_meta_form']) and $_POST['course_meta_form'] == 1) {
    if (empty($_POST['cs_layout']))
        $_POST['cs_layout'] = 'none';
    add_action('save_post', 'cs_meta_album_save');

    function cs_meta_album_save($post_id) {
        $sxe = new SimpleXMLElement("<course></course>");
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
        if (empty($_POST["course_date"]))
            $_POST["course_date"] = "";
        if (empty($_POST["course_eligibility"]))
            $_POST["course_eligibility"] = "";
        if (empty($_POST["course_apply"]))
            $_POST["course_apply"] = "";
        if (empty($_POST["course_social"]))
            $_POST["course_social"] = "";
        $sxe = save_layout_xml($sxe);
        $sxe->addChild('course_date', $_POST['course_date']);
        $sxe->addChild('course_eligibility', htmlspecialchars($_POST['course_eligibility']));
        $sxe->addChild('course_apply', htmlspecialchars($_POST['course_apply']));
        $sxe->addChild('course_social', $_POST['course_social']);
        $counter = 0;
        if (isset($_POST['subject_title'])) {
            foreach ($_POST['subject_title'] as $count) {
                $track = $sxe->addChild('subject');
                $track->addChild('subject_title', htmlspecialchars($_POST['subject_title'][$counter]));
                $track->addChild('subject_instructor', htmlspecialchars($_POST['subject_instructor'][$counter]));
                $track->addChild('subject_credit', htmlspecialchars($_POST['subject_credit'][$counter]));
                $track->addChild('subject_detail', htmlspecialchars($_POST['subject_detail'][$counter]));
                $counter++;
            }
        }
        update_post_meta($post_id, 'cs_course', $sxe->asXML());
    }

}
// adding album meta info end
?>