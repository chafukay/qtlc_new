<?php
foreach ($_POST as $keys => $values) {
    $$keys = $values;
}
if (isset($_POST['name'])) {
    require_once '../../../../wp-load.php';
    global $wpdb;
    $name = $_POST['name'];
    $counter = $_POST['counter'];
    $cs_contact_map_db = '';
    $cs_contact_email_db = '';
    $cs_contact_succ_msg_db = '';
    $cs_contact_map_view_db = '';
} else {
    $name = ucfirst($cs_node->getName());
    $count_node++;
    $cs_contact_map_db = isset($cs_node->cs_contact_map) ? $cs_node->cs_contact_map : '';
    $cs_contact_email_db = isset($cs_node->cs_contact_email) ? $cs_node->cs_contact_email : '';
    $cs_contact_succ_msg_db = isset($cs_node->cs_contact_succ_msg) ? $cs_node->cs_contact_succ_msg : '';
    $cs_contact_map_view_db = isset($cs_node->cs_contact_map_view) ? $cs_node->cs_contact_map_view : '';
    $counter = $post->ID . $count_node;
}
?> 
<li id="<?php echo $name . $counter ?>_sort">
    <div class="add_page_builder_item_show temp-tubes" id="<?php echo $name . $counter ?>_del">
        <span class="blog">&nbsp;</span>
        <p><?php echo $name ?></p>
        <a href="javascript:hide_all('<?php echo $name . $counter ?>')" class="options"><?php _e('Options', CSDOMAIN) ?></a>
        <a href="javascript:delete_this('<?php echo $name . $counter ?>')" class="delete-it">&nbsp;</a>
        <br class="clear" />
    </div>
    <div class="poped-up" id="<?php echo $name . $counter ?>" style="border:none; background:#f8f8f8;" >
        <div class="opt-head">
            <h6><?php _e('Edit Contact Form', CSDOMAIN) ?></h6>
            <a href="javascript:show_all('<?php echo $name . $counter ?>')" class="closeit">&nbsp;</a>
        </div>
        <div class="opt-conts">
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Google Map IFrame Code', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <textarea name="cs_contact_map[]"><?php echo $cs_contact_map_db; ?></textarea>
                </li>
                <li class="to-desc">
                    <p>
                        <?php _e('Please enter Google Map IFrame Code (For Address)', CSDOMAIN) ?> 
                    </p>
                </li>                    
            </ul>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Contact Email', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <input type="text" name="cs_contact_email[]" class="txtfield" value="<?php if ($cs_contact_email_db == "") echo get_option("admin_email");
                        else echo $cs_contact_email_db; ?>" />
                </li>
                <li class="to-desc">
                    <p>
                        <?php _e('Please enter Contact email Address.', CSDOMAIN) ?> 
                    </p>
                </li>                    
            </ul>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Map View', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <select name="cs_contact_map_view[]" class="dropdown">
                        <option value="content_view" <?php if ($cs_contact_map_view_db == "content_view") echo "selected"; ?> ><?php _e('Content View', CSDOMAIN) ?></option>
                        <option value="header_view" <?php if ($cs_contact_map_view_db == "header_view") echo "selected"; ?> ><?php _e('Header View', CSDOMAIN) ?></option>
                    </select>
                </li>
                <li class="to-desc">
                    <p>
                        <?php _e('Please Select map view', CSDOMAIN) ?>
                    </p>
                </li>                    
            </ul>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Successful Message', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <textarea name="cs_contact_succ_msg[]"><?php if ($cs_contact_succ_msg_db == "") echo "Email Sent Successfully.\nThank you, your message has been submitted to us.";
                        else echo $cs_contact_succ_msg_db; ?></textarea>
                </li>
            </ul>
            <ul class="form-elements noborder">
                <li class="to-label">
                </li>
                <li class="to-field">
                    <input type="hidden" name="cs_orderby[]" value="contact" />
                    <input type="button" value="<?php _e('Save', CSDOMAIN) ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $counter ?>')" />
                </li>
            </ul>
        </div>
    </div>
</li>