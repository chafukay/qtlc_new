<?php
foreach ($_POST as $keys => $values) {
    $$keys = $values;
}
if (isset($_POST['name'])) {
    require_once '../../../../wp-load.php';
    global $wpdb;
    $name = $_POST['name'];
    $counter = $_POST['counter'];
    $course_cat = '';
    $course_filterable = '';
    $course_pagination = '';
    $course_per_page = '';
} else {
    $name = ucfirst($cs_node->getName());
    $count_node++;
    $course_cat = isset($cs_node->course_cat) ? $cs_node->course_cat : '';
    $course_filterable = isset($cs_node->course_filterable) ? $cs_node->course_filterable : '';
    $course_pagination = isset($cs_node->course_pagination) ? $cs_node->course_pagination : '';
    $course_per_page = isset($cs_node->course_per_page) ? $cs_node->course_per_page : '';
    $counter = $post->ID . $count_node;
}
?> 
<li id="<?php echo $name . $counter ?>_sort">
    <div class="add_page_builder_item_show temp-tubes" id="<?php echo $name . $counter ?>_del">
        <span class="album">&nbsp;</span>
        <p><?php echo $name ?></p>
        <a href="javascript:hide_all('<?php echo $name . $counter ?>')" class="options"><?php _e('Options', CSDOMAIN) ?></a>
        <a href="javascript:delete_this('<?php echo $name . $counter ?>')" class="delete-it">&nbsp;</a>
        <br class="clear" />
    </div>
    <div class="poped-up" id="<?php echo $name . $counter ?>" style="border:none; background:#f8f8f8;" >
        <div class="opt-head">
            <h6><?php _e('Edit Course Options', CSDOMAIN) ?></h6>
            <a href="javascript:show_all('<?php echo $name . $counter ?>')" class="closeit">&nbsp;</a>
        </div>
        <div class="opt-conts">
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Choose Category', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <select name="course_cat[]" class="dropdown">
                        <option value="0"><?php _e('-- Select Category --', CSDOMAIN) ?></option>
                        <?php show_all_cats('', '', $course_cat, "course-category"); ?>
                    </select>
                </li>
                <li class="to-desc">
                    <p>
                        <?php _e('Choose category', CSDOMAIN) ?>
                    </p>
                </li>
            </ul>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Filterable', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <select name="course_filterable[]" class="dropdown" >
                        <option <?php if ($course_filterable == "Off") echo "selected"; ?> ><?php _e('Off', CSDOMAIN) ?></option>
                        <option <?php if ($course_filterable == "On") echo "selected"; ?> ><?php _e('On', CSDOMAIN) ?></option>
                    </select>
                </li>
            </ul>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Pagination', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <select name="course_pagination[]" class="dropdown" onchange="cs_toggle_tog('cs_album_per_page<?php echo $name . $counter ?>')" >
                        <option <?php if ($course_pagination == "Show Pagination") echo "selected"; ?> ><?php _e('Show Pagination', CSDOMAIN) ?></option>
                        <option <?php if ($course_pagination == "Single Page") echo "selected"; ?> ><?php _e('Single Page', CSDOMAIN) ?></option>
                    </select>
                </li>
            </ul>
            <ul class="form-elements <?php if ($course_pagination == "Single Page") echo 'no-display'; ?>" id="cs_album_per_page<?php echo $name . $counter ?>">
                <li class="to-label">
                    <label><?php _e('No. of Record Per Page', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <input type="text" name="course_per_page[]" class="txtfield" value="<?php if ($course_per_page == "") echo "5";
                        else echo $course_per_page; ?>" />
                </li>
            </ul>
            <ul class="form-elements noborder">
                <li class="to-label">
                    <label></label>
                </li>
                <li class="to-field">
                    <input type="hidden" name="cs_orderby[]" value="course" />
                    <input type="button" value="<?php _e('Save', CSDOMAIN) ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $counter ?>')" />
                </li>
            </ul>
        </div>
    </div>
</li>