<?php
foreach ($_POST as $keys => $values) {
    $$keys = $values;
}
if (isset($_POST['name'])) {
    require_once '../../../../wp-load.php';
    global $wpdb;
    $name = $_POST['name'];
    $counter = $_POST['counter'];
    $cs_slider_type_db = '';
    $cs_slider_db = '';
    $cs_slider_width_db = '';
    $cs_slider_height_db = '';
} else {
    $name = ucfirst($cs_node->getName());
    $count_node++;
    $cs_slider_type_db = isset($cs_node->slider_type) ? $cs_node->slider_type : '';
    $cs_slider_db = isset($cs_node->slider) ? $cs_node->slider : '';
    $cs_slider_width_db = isset($cs_node->width) ? $cs_node->width : '';
    $cs_slider_height_db = isset($cs_node->height) ? $cs_node->height : '';
    $counter = $post->ID . $count_node;
}
?> 
<li id="<?php echo $name . $counter ?>_sort">
    <div class="add_page_builder_item_show temp-tubes" id="<?php echo $name . $counter ?>_del">
        <span class="slider">&nbsp;</span>
        <p><?php echo $name ?></p>
        <a href="javascript:hide_all('<?php echo $name . $counter ?>')" class="options"><?php _e('Options', CSDOMAIN) ?></a>
        <a href="javascript:delete_this('<?php echo $name . $counter ?>')" class="delete-it">&nbsp;</a>
        <br class="clear" />
    </div>
    <div class="poped-up" id="<?php echo $name . $counter ?>" style="border:none; background:#f8f8f8;" >
        <div class="opt-head">
            <h6><?php _e('Edit Slider Options', CSDOMAIN) ?></h6>
            <a href="javascript:show_all('<?php echo $name . $counter ?>')" class="closeit">&nbsp;</a>
        </div>
        <div class="opt-conts">
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Choose Slider Type', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <select name="cs_slider_type[]" class="dropdown" onchange="cs_toggle_height(this.value, 'cs_slider_height<?php echo $name . $counter ?>')">
                        <option <?php if ($cs_slider_type_db == "Anything Slider") {
    echo "selected";
} ?> ><?php _e('Anything Slider', CSDOMAIN) ?></option>
                        <option <?php if ($cs_slider_type_db == "Nivo Slider") {
    echo "selected";
} ?> ><?php _e('Nivo Slider', CSDOMAIN) ?></option>
                        <option <?php if ($cs_slider_type_db == "Sudo Slider") {
    echo "selected";
} ?> ><?php _e('Sudo Slider', CSDOMAIN) ?></option>
                    </select>
                </li>
            </ul>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Choose Slider', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <select name="cs_slider[]" class="dropdown">
                        <option value="0"><?php _e('-- Select Slider --', CSDOMAIN) ?></option>
                        <?php
                        $query = array('posts_per_page' => '-1', 'post_type' => 'cs_slider', 'orderby' => 'ID', 'post_status' => 'publish');
                        $wp_query = new WP_Query($query);
                        while ($wp_query->have_posts()) : $wp_query->the_post();
                            ?>
                            <option <?php if ($post->post_name == $cs_slider_db) echo "selected"; ?> value="<?php echo $post->post_name ?>"><?php echo $post->post_title ?></option>
    <?php
endwhile;
?>
                    </select>
                </li>
            </ul>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Slider Width', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <input type="text" name="cs_slider_width[]" class="txtfield" value="<?php if ($cs_slider_width_db == "") echo "500";
else echo $cs_slider_width_db; ?>" />
                </li>
                <li class="to-desc">
                    <p>
<?php _e('Slider width in PX', CSDOMAIN) ?>
                    </p>
                </li>                                        
            </ul>
            <ul class="form-elements <?php if ($cs_slider_type_db == "Nivo Slider") echo 'no-display'; ?>" id="cs_slider_height<?php echo $name . $counter ?>">
                <li class="to-label">
                    <label><?php _e('Slider Height', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <input type="text" name="cs_slider_height[]" class="txtfield" value="<?php if ($cs_slider_height_db == "") echo "300";
else echo $cs_slider_height_db; ?>" />
                </li>
                <li class="to-desc">
                    <p>
<?php _e('Slider Height in PX', CSDOMAIN) ?>
                    </p>
                </li>                                                            
            </ul>
            <ul class="form-elements noborder">
                <li class="to-label">
                </li>
                <li class="to-field">
                    <input type="hidden" name="cs_orderby[]" value="slider" />
                    <input type="button" value="<?php _e('Save', CSDOMAIN) ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $counter ?>')" />
                </li>
            </ul>
        </div>
    </div>
</li>