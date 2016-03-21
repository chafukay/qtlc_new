<?php
foreach ($_POST as $keys => $values) {
    $$keys = $values;
}
if (isset($_POST['name'])) {
    require_once '../../../../wp-load.php';
    global $wpdb;
    $name = $_POST['name'];
    $counter = $_POST['counter'];
    $cs_gal_layout_db = '';
    $cs_gal_album_db = '';
    $cs_gal_title_db = '';
    $cs_gal_desc_db = '';
    $cs_gal_pagination_db = '';
    $cs_gal_media_per_page_db = '';
} else {
    $name = ucfirst($cs_node->getName());
    $count_node++;
    $cs_gal_layout_db = isset($cs_node->layout) ? $cs_node->layout : '';
    $cs_gal_album_db = isset($cs_node->album) ? $cs_node->album : "";
    $cs_gal_title_db = isset($cs_node->title) ? $cs_node->title : '';
    $cs_gal_desc_db = isset($cs_node->desc) ? $cs_node->desc : '';
    $cs_gal_pagination_db = isset($cs_node->pagination) ? $cs_node->pagination  :'';
    $cs_gal_media_per_page_db = isset($cs_node->media_per_page) ? $cs_node->media_per_page : '';
    $counter = $post->ID . $count_node;
}
?> 
<li id="<?php echo $name . $counter ?>_sort">
    <div class="add_page_builder_item_show temp-tubes" id="<?php echo $name . $counter ?>_del">
        <span class="gallery">&nbsp;</span>
        <p><?php echo $name ?></p>
        <a href="javascript:hide_all('<?php echo $name . $counter ?>')" class="options"><?php _e('Options', CSDOMAIN) ?></a>
        <a href="javascript:delete_this('<?php echo $name . $counter ?>')" class="delete-it">&nbsp;</a>
        <br class="clear" />
    </div>
    <div class="poped-up" id="<?php echo $name . $counter ?>" style="border:none; background:#f8f8f8;" >
        <div class="opt-head">
            <h6><?php _e('Edit Gallery Options', CSDOMAIN) ?></h6>
            <a href="javascript:show_all('<?php echo $name . $counter ?>')" class="closeit">&nbsp;</a>
        </div>
        <div class="opt-conts">
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Choose Gallery Layout', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <select name="cs_gal_layout[]" class="dropdown">
                        <option value="cs_gal_4_column" <?php if ($cs_gal_layout_db == "cs_gal_4_column") echo "selected"; ?> ><?php _e('4 Column', CSDOMAIN) ?></option>
                        <option value="cs_gal_3_column" <?php if ($cs_gal_layout_db == "cs_gal_3_column") echo "selected"; ?> ><?php _e('3 Column', CSDOMAIN) ?></option>
                        <option value="cs_gal_2_column" <?php if ($cs_gal_layout_db == "cs_gal_2_column") echo "selected"; ?> ><?php _e('2 Column', CSDOMAIN) ?></option>
                    </select>
                </li>
                <li class="to-desc">
                    <p>
                        <?php _e('Select gallery layout, single column, double column, thriple column or four column', CSDOMAIN) ?>
                    </p>
                </li>                                                                                
            </ul>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Choose Gallery/Album', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <select name="cs_gal_album[]" class="dropdown">
                        <option value="0"><?php _e('-- Select Gallery --', CSDOMAIN) ?></option>
                        <?php
                        $query = array('post_type' => 'cs_gallery', 'orderby' => 'ID', 'post_status' => 'publish');
                        $wp_query = new WP_Query($query);
                        while ($wp_query->have_posts()) : $wp_query->the_post();
                            ?>
                            <option <?php if ($post->post_name == $cs_gal_album_db) echo "selected"; ?> value="<?php echo $post->post_name ?>"><?php echo $post->post_title ?></option>
                            <?php
                        endwhile;
                        empty($post);
                        ?>
                    </select>
                </li>
                <li class="to-desc">
                    <p>
                        <?php _e('Select gallery album to show images.', CSDOMAIN) ?>
                    </p>
                </li>                                                                                
            </ul>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Show Title', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <select name="cs_gal_title[]" class="dropdown">
                        <option <?php if ($cs_gal_title_db == "On") echo "selected"; ?> ><?php _e('On', CSDOMAIN) ?></option>
                        <option <?php if ($cs_gal_title_db == "Off") echo "selected"; ?> ><?php _e('Off', CSDOMAIN) ?></option>
                    </select>
                </li>
            </ul>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Show Description', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <select name="cs_gal_desc[]" class="dropdown">
                        <option <?php if ($cs_gal_desc_db == "On") echo "selected"; ?> ><?php _e('On', CSDOMAIN) ?></option>
                        <option <?php if ($cs_gal_desc_db == "Off") echo "selected"; ?> ><?php _e('Off', CSDOMAIN) ?></option>
                    </select>
                </li>
            </ul>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Pagination', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <select name="cs_gal_pagination[]" class="dropdown" onchange="cs_toggle_tog('cs_gal_media_per_page<?php echo $name . $counter ?>')" >
                        <option <?php if ($cs_gal_pagination_db == "Show Pagination") echo "selected"; ?> ><?php _e('Show Pagination', CSDOMAIN) ?></option>
                        <option <?php if ($cs_gal_pagination_db == "Single Page") echo "selected"; ?> ><?php _e('Single Page', CSDOMAIN) ?></option>
                    </select>
                </li>
            </ul>
            <ul class="form-elements <?php if ($cs_gal_pagination_db == "Single Page") echo 'no-display'; ?>" id="cs_gal_media_per_page<?php echo $name . $counter ?>">
                <li class="to-label">
                    <label><?php _e('No. of Media Per Page', CSDOMAIN) ?></label>
                </li>
                <li class="to-field">
                    <input type="text" name="cs_gal_media_per_page[]" class="txtfield" value="<?php if ($cs_gal_media_per_page_db == "") echo "5";
                        else echo $cs_gal_media_per_page_db; ?>" />
                </li>
            </ul>
            <ul class="form-elements noborder">
                <li class="to-label">

                </li>
                <li class="to-field">
                    <input type="hidden" name="cs_orderby[]" value="gallery" />
                    <input type="button" value="<?php _e('Save', CSDOMAIN) ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $counter ?>')" />
                </li>
            </ul>
        </div>
    </div>
</li>