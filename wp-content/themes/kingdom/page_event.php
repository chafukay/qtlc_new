<div class="events-page">
    <?php
    date_default_timezone_set('UTC');
    $current_time = current_time('Y-m-d H:i', $gmt = 0);
    $meta_compare = '';
    $filter_category = '';


    if ($cs_node->cs_event_type == "Upcoming Events")
        $meta_compare = ">=";
    else if ($cs_node->cs_event_type == "Past Events")
        $meta_compare = "<";

    $row_cat = $wpdb->get_row("SELECT * from " . $wpdb->prefix . "terms WHERE slug = '" . $cs_node->cs_event_category . "'");
    //if ( empty ($row_cat->name) or $row_cat->name == "" ) $row_cat->name = "";
    if (isset($_GET['filter_category'])) {
        $filter_category = $_GET['filter_category'];
    } else {
        if ($row_cat <> '') {
            $filter_category = $row_cat->slug;
        }
    }
    ?>
    <div class="box-in">    
        <?php
        if (empty($_GET['page_id_all']))
            $_GET['page_id_all'] = 1;

        if ($cs_node->cs_event_type == "All Events") {
            $args = array(
                'posts_per_page' => "-1",
                'post_type' => 'events',
                'event-category' => "$filter_category",
                'post_status' => 'publish',
                'orderby' => 'ID',
                'order' => 'ASC',
            );
        } else {
            $args = array(
                'posts_per_page' => "-1",
                'post_type' => 'events',
                'event-category' => "$filter_category",
                'post_status' => 'publish',
                'meta_key' => 'cs_event_from_date_time',
                'meta_value' => $current_time,
                'meta_compare' => $meta_compare,
                'orderby' => 'ID',
                'order' => 'ASC',
            );
        }
        //query_posts($args);
        $custom_query = new WP_Query($args);
        $count_post = 0;
        while ($custom_query->have_posts()) : $custom_query->the_post();
            $count_post++;
        endwhile;

        if ($cs_node->cs_event_pagination == "Single Page")
            $cs_node->cs_event_per_page = -1;
        if ($cs_node->cs_event_filterables == "Yes") {
            ?>                  
            <div class="cat-select">
                <ul>
                    <li><h5><?php echo languageswitcher('category_filter', 'Category Filter') ?></h5></li>
                    <li>
                        <form action="" method="get">
                            <input type="hidden" name="page_id" value="<?php if (isset($_GET['page_id'])) echo $_GET['page_id'] ?>" />
                            <select name="filter_category" onchange="this.form.submit()">
                                <option><?php
                                    if (isset($row_cat->name)) {
                                        echo $row_cat->name;
                                    }
                                    ?></option>
                                <?php
                                $categories = get_categories(array('child_of' => "$row_cat->term_id", 'taxonomy' => 'event-category', 'hide_empty' => 0));
                                foreach ($categories as $category) {
                                    ?>
                                    <option <?php if ($filter_category == $category->cat_name) echo "selected"; ?> ><?php echo $category->cat_name ?></option>
                                <?php } ?>
                            </select>
                        </form>
                    </li>
                </ul>
            </div>
        <?php } ?>

    <!--<h1 class="heading"><?php echo $cs_node->cs_event_title ?> (<?php echo $cs_node->cs_event_type ?> Events)</h1>-->
        <?php
        if ($cs_node->cs_event_view == "List View") {
            ?>
            <div id="tab-timeline" class="listview">
                <span class="rod">&nbsp;</span>
                <!-- Event Section Start -->
                <ul class="timeline">

                    <?php
                    if ($cs_node->cs_event_type == "All Events") {
                        $args = array(
                            'posts_per_page' => "$cs_node->cs_event_per_page",
                            'paged' => $_GET['page_id_all'],
                            'post_type' => 'events',
                            'event-category' => "$filter_category",
                            'post_status' => 'publish',
                            'orderby' => 'ID',
                            'order' => 'ASC',
                        );
                    } else {
                        $args = array(
                            'posts_per_page' => "$cs_node->cs_event_per_page",
                            'paged' => $_GET['page_id_all'],
                            'post_type' => 'events',
                            'event-category' => "$filter_category",
                            'post_status' => 'publish',
                            'meta_key' => 'cs_event_from_date_time',
                            'meta_value' => $current_time,
                            'meta_compare' => $meta_compare,
                            'orderby' => 'ID',
                            'order' => 'ASC',
                        );
                    }
                    //query_posts($args);
                    $custom_query = new WP_Query($args);
                    if ($custom_query->have_posts() <> "") {
                        while ($custom_query->have_posts()): $custom_query->the_post();
                            $cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);
                            if ($cs_event_meta <> "") {
                                $cs_event_meta = new SimpleXMLElement($cs_event_meta);
                            }
                            ?>
                            <li>
                                <div class="event-list">
                                    <div class="rows">
                                        <div class="desc-sec">
                                            <div class="date">
                                                <div class="date-in">
                                                    <?php
                                                    $event_from_date = get_post_meta($post->ID, "cs_event_from_date", true);
                                                    $event_to_date = get_post_meta($post->ID, "cs_event_to_date", true);
                                                    ?>			
                                                    <span><?php echo date('d', strtotime($event_from_date)); ?></span>
                                                    <span><?php echo date('M', strtotime($event_from_date)); ?></span>
                                                </div>
                                            </div>
                                            <?php
                                            $image_id = get_post_thumbnail_id($post->ID);
                                            if ($image_id != '') {
                                                ?>
                                                <div class="thumbnail">
                                                    <?php
                                                    // getting featured image start
                                                    $image_url = cs_get_post_thumbnail($post->ID, 299, 175);
                                                    echo "<a href='" . get_permalink() . "'>" . $image_url . "</a>";
                                                    // getting featured image end
                                                    ?>
                                                </div>                                    
                                            <?php } ?>
                                            <div class="text">
                                                <h3><a href="<?php echo get_permalink(); ?>" class="txthover"><?php
                                                        echo substr(get_the_title(), 0, 50);
                                                        if (strlen(get_the_title()) > 50)
                                                            echo "...";
                                                        ?></a></h3>
                                                <p>
                                                    <?php
                                                    //echo get_the_excerpt()."<br /><br />";
                                                    $get_the_excerpt = trim(preg_replace('/<a[^>]*>(.*)<\/a>/iU', '', get_the_content()));
                                                    $new_excerpt = trim(preg_replace('/\[(.*?)\]/ ', '', $get_the_excerpt));
                                                    echo substr($new_excerpt, 0, "$cs_node->cs_event_excerpt");
                                                    if (strlen($new_excerpt) > "$cs_node->cs_event_excerpt") {
                                                        echo '<a class="readmore" href="' . get_permalink() . '"> ' . __('More...', CSDOMAIN) . '</a>';
                                                    }
                                                    wp_link_pages('before=<p class="link-pages">Page: ');
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="even-opts">
                                        <?php
                                        if ($cs_node->cs_event_time == 'Yes') {
                                            echo "<p class='time'>";
                                            if ($cs_event_meta->event_all_day == "") {
                                                echo $cs_event_meta->event_start_time . " &ndash; " . $cs_event_meta->event_end_time;
                                            } else
                                                echo languageswitcher('event_trans_all_day', 'All Day');
                                            echo "</p>";
                                        }
                                        ?>
                                        <?php
                                        $event_loc_lat = '';
                                        $event_loc_long = '';
                                        $event_loc_zoom = '';
                                        $cs_event_loc = get_post_meta($cs_event_meta->event_address, "cs_event_loc_meta", true);
                                        if ($cs_event_loc <> "") {
                                            $cs_xmlObject = new SimpleXMLElement($cs_event_loc);
                                            $event_loc_lat = isset($cs_xmlObject->event_loc_lat) ? $cs_xmlObject->event_loc_lat : '';
                                            $event_loc_long = isset($cs_xmlObject->event_loc_long) ? $cs_xmlObject->event_loc_long : '';
                                            $event_loc_zoom = isset($cs_xmlObject->event_loc_zoom) ? $cs_xmlObject->event_loc_zoom : '';
                                        } else {
                                            $event_loc_lat = '';
                                            $event_loc_long = '';
                                            $event_loc_zoom = '';
                                        }
                                        ?>                                                                          
                                        <p class="location"><?php echo get_the_title("$cs_event_meta->event_address") ?>
                                            <?php
                                            $event_loc_lat = '';
                                            $event_loc_long = '';
                                            $event_loc_zoom = '';
                                            $loc_address = '';
                                            $loc_city = '';
                                            $loc_postcode = '';
                                            $loc_region = '';
                                            $loc_country = '';
                                            $cs_event_loc = get_post_meta($cs_event_meta->event_address, "cs_event_loc_meta", true);
                                            if ($cs_event_loc <> "") {
                                                $cs_event_loc = new SimpleXMLElement($cs_event_loc);
                                                $event_loc_lat = isset($cs_event_loc->event_loc_lat) ? $cs_event_loc->event_loc_lat : '';
                                                $event_loc_long = isset($cs_event_loc->event_loc_long) ? $cs_event_loc->event_loc_long : '';
                                                $event_loc_zoom = isset($cs_event_loc->event_loc_zoom) ? $cs_event_loc->event_loc_zoom : '';
                                                $loc_address = isset($cs_event_loc->loc_address) ? $cs_event_loc->loc_address : '';
                                                $loc_city = isset($cs_event_loc->loc_city) ? $cs_event_loc->loc_city : '';
                                                $loc_postcode = isset($cs_event_loc->loc_postcode) ? $cs_event_loc->loc_postcode : '';
                                                $loc_region = isset($cs_event_loc->loc_region) ? $cs_event_loc->loc_region : '';
                                                $loc_country = isset($cs_event_loc->loc_country) ? $cs_event_loc->loc_country : '';
                                            } else {
                                                $event_loc_lat = '';
                                                $event_loc_long = '';
                                                $event_loc_zoom = '';
                                                $loc_address = '';
                                                $loc_city = '';
                                                $loc_postcode = '';
                                                $loc_region = '';
                                                $loc_country = '';
                                            }
                                            //if ( $cs_event_meta->event_address <> "" ) {
                                            //if ( $loc_address <> "" ) echo ", " . $loc_address;
                                            //if ( $loc_city <> "" ) echo ", " . $loc_city;
                                            //if ( $loc_postcode <> "" ) echo ", " . $loc_postcode;
                                            //if ( $loc_region <> "" ) echo ", " . $loc_region;
                                            //if ( $loc_country <> "" ) echo ", " . $loc_country;
                                            //}
                                            ?>  
                                        </p>
                                    </div>
                                </div>
                            </li>									
                            <?php
                        endwhile;
                    }
                    ?>
                </ul>
            </div>
            <div class="clear"></div>
            <br />
            <div class="clear"></div>
            <?php
            $qrystr = '';
            if (cs_pagination($count_post, $cs_node->cs_event_per_page, $qrystr) <> '') {
                // pagination start
                if ($cs_node->cs_event_pagination == "Show Pagination" and $cs_node->cs_event_per_page > 0) {
                    echo "<div class='pagination'><h5>" . __('Pages:', CSDOMAIN) . "</h5><ul>";
                    if (isset($_GET['page_id']))
                        $qrystr = "&page_id=" . $_GET['page_id'];
                    if (isset($_GET['filter_category']))
                        $qrystr .= "&filter_category=" . $_GET['filter_category'];
                    echo cs_pagination($count_post, $cs_node->cs_event_per_page, $qrystr);
                    echo "</ul></div>";
                }
                // pagination end
            }
            ?>
            <?php
        }
        else {
            if ($cs_node->cs_event_type == "All Events") {
                $args = array(
                    'posts_per_page' => "-1",
                    'post_type' => 'events',
                    'event-category' => "$filter_category",
                    'post_status' => 'publish',
                    'orderby' => 'ID',
                    'order' => 'ASC',
                );
            } else {
                $args = array(
                    'posts_per_page' => "-1",
                    'post_type' => 'events',
                    'event-category' => "$filter_category",
                    'post_status' => 'publish',
                    'meta_key' => 'cs_event_from_date_time',
                    'meta_value' => $current_time,
                    'meta_compare' => $meta_compare,
                    'orderby' => 'ID',
                    'order' => 'ASC',
                );
            }
            //query_posts($args);
            $custom_query = new WP_Query($args);
            if ($custom_query->have_posts() <> "") {
                while ($custom_query->have_posts()): $custom_query->the_post();
                    $cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);
                    $event_from_date = get_post_meta($post->ID, "cs_event_from_date", true);
                    if ($cs_event_meta <> "") {
                        $cs_event_meta = new SimpleXMLElement($cs_event_meta);
                    }
                    $aaa[] = array(
                        'title' => substr(get_the_title(), 0, 20) . '....',
                        'start' => date("Y-m-d", strtotime($event_from_date)),
                        'url' => get_permalink()
                    );
                endwhile;
            } // have Post Condition

            event_enqueue_styles_scripts();
            ?>
            <script type='text/javascript'>
                jQuery(document).ready(function ($) {
                    $('#calendar').fullCalendar({
                        editable: false,
                        events: <?php echo json_encode($aaa); ?>,
                        eventDrop: function (event, delta) {
                            alert(event.title + ' was moved ' + delta + ' days\n' +
                                    '(should probably update your database)');
                        },
                        loading: function (bool) {
                            if (bool)
                                $('#loading').show();
                            else
                                $('#loading').hide();
                        }
                    });
                });
            </script>
            <div id='loading' style='display:none'>loading...</div>
            <!-- Calendar Start -->
            <div class="calendar">
                <div id="calendar"></div>
            </div>
            <!-- Calendar End -->
<?php } ?>
    </div>
</div>