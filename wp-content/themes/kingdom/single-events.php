<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
get_header();
global $post_id;
$cs_layout = '';
$cs_sidebar_left = '';
$cs_sidebar_right = '';
$event_social_sharing = '';
$event_start_time = '';
$event_end_time = '';
$event_all_day = '';
$event_booking_url = '';
$event_address = '';
$post_xml = get_post_meta($post->ID, "cs_event_meta", true);
if ($post_xml <> "") {
    $cs_xmlObject = new SimpleXMLElement($post_xml);
    $cs_layout = isset($cs_xmlObject->cs_layout) ? $cs_xmlObject->cs_layout : '';
    $cs_sidebar_left = isset($cs_xmlObject->cs_sidebar_left) ? $cs_xmlObject->cs_sidebar_left : '';
    $cs_sidebar_right = isset($cs_xmlObject->cs_sidebar_right) ? $cs_xmlObject->cs_sidebar_right : '';
    $event_social_sharing = isset($cs_xmlObject->event_social_sharing) ? $cs_xmlObject->event_social_sharing : '';
    $event_start_time = isset($cs_xmlObject->event_start_time) ? $cs_xmlObject->event_start_time : '';
    $event_end_time = isset($cs_xmlObject->event_end_time) ? $cs_xmlObject->event_end_time : '';
    $event_all_day = isset($cs_xmlObject->event_all_day) ? $cs_xmlObject->event_all_day : '';
    $event_booking_url = isset($cs_xmlObject->event_booking_url) ? $cs_xmlObject->event_booking_url : '';
    $event_address = isset($cs_xmlObject->event_address) ? $cs_xmlObject->event_address : '';

    if ($cs_layout == "left") {
        $cs_layout = "col3 page_box right";
        $show_sidebar_left = $cs_sidebar_left;
    } else if ($cs_layout == "right") {
        $cs_layout = "col3 page_box left";
        $show_sidebar = $cs_sidebar_right;
    } else if ($cs_layout == "both") {
        $cs_layout = "col2 page_box both";
        $show_sidebar = $cs_sidebar_right;
        $show_sidebar_left = $cs_sidebar_left;
    } else if ($cs_layout == "both_left") {
        $cs_layout = "col2 page_box both_left";
        $show_sidebar = $cs_sidebar_right;
        $show_sidebar_left = $cs_sidebar_left;
    } else if ($cs_layout == "both_right") {
        $cs_layout = "col2 page_box both_right";
        $show_sidebar = $cs_sidebar_right;
        $show_sidebar_left = $cs_sidebar_left;
    } else
        $cs_layout = "fullwidth box";
}


$event_loc_lat = '';
$event_loc_long = '';
$event_loc_zoom = '';
$loc_address = '';
$loc_city = '';
$loc_postcode = '';
$loc_region = '';
$loc_country = '';
$cs_event_loc = get_post_meta("$cs_xmlObject->event_address", "cs_event_loc_meta", true);
if ($cs_event_loc <> "") {
    $cs_event_loc = new SimpleXMLElement($cs_event_loc);
    $event_loc_lat = isset($cs_event_loc->event_loc_lat) ? $cs_event_loc->event_loc_lat : '';
    $event_loc_long = isset($cs_event_loc->event_loc_long) ? $cs_event_loc->event_loc_long : '';
    $event_loc_zoom = isset($cs_event_loc->event_loc_zoom) ? $cs_event_loc->event_loc_zoom  : '';
    $loc_address = isset($cs_event_loc->loc_address) ? $cs_event_loc->loc_address : '';
    $loc_city = isset($cs_event_loc->loc_city) ? $cs_event_loc->loc_city  : '';
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
?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var map;
        var myLatLng = new google.maps.LatLng(<?php echo $event_loc_lat; ?>, <?php echo $event_loc_long; ?>)
        //Initialize MAP
        var myOptions = {
            zoom: <?php echo $event_loc_zoom; ?>,
            center: myLatLng,
            disableDefaultUI: true,
            zoomControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
        //End Initialize MAP
        //Set Marker
        var marker = new google.maps.Marker({
            position: map.getCenter(),
            map: map
        });
        marker.getPosition();
        //End marker

        //Set info window
        var infowindow = new google.maps.InfoWindow({
            content: '',
            position: myLatLng
        });
        infowindow.open(map);
    });
</script>
<?php if ($cs_layout == 'col2 page_box both' || $cs_layout == 'col3 page_box right' || $cs_layout == 'col2 page_box both_left') { ?>
    <div class="col1 left hidemobile">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($show_sidebar_left)) : ?>
        <?php endif; ?>                                    
    </div>
<?php }//Both?>
<?php if ($cs_layout == 'col2 page_box both_left') { ?>
    <!--Sidebar Start-->
    <div class="col1 left hidemobile margin_left_sidebar">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($show_sidebar)) : ?>
        <?php endif; ?>                                    
    </div>
    <?php
}
wp_reset_query();
?>
<div class="<?php if (isset($cs_layout)) echo $cs_layout; ?>">
    <?php
    if (have_posts())
        while (have_posts()) : the_post();
            $cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);
            if ($cs_event_meta <> "")
                $cs_event_meta = new SimpleXMLElement($cs_event_meta);
            ?>
            <!-- Events Start -->
            <div class="blog">
                <div class="box-in">
                    <!-- Post Start -->
                    <div class="post event-detail">
                        <!--<h2 class="ev-head"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>-->
                        <?php
                        $image_id = cs_get_post_thumbnail($post->ID, 690, 270);
                        if ($image_id <> '') {
                            ?>
                            <a class="thumb" href="<?php echo get_permalink() ?>">
                                <?php echo $image_id; ?>
                            </a>
                        <?php } ?>
                        <div class="clear"></div>
                        <div class="post-opts even-opts">
                            <p class="author">
                                <?php printf(__('By: %s', CSDOMAIN), '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() . '</a>') ?>
                            </p>
                            <p class="date">
                                <?php
                                $event_from_date = get_post_meta($post->ID, "cs_event_from_date", true);
                                $event_to_date = get_post_meta($post->ID, "cs_event_to_date", true);
                                echo date(get_option('date_format'), strtotime($event_from_date)) . ' - ' . date(get_option('date_format'), strtotime($event_to_date))
                                ?>
                            </p>
                            <p>
                                <?php
                                if ($cs_xmlObject->event_all_day == "") {
                                    echo date(get_option("time_format"), strtotime($cs_xmlObject->event_start_time));
                                    echo " &ndash; ";
                                    echo date(get_option("time_format"), strtotime($cs_xmlObject->event_end_time));
                                } else {
                                    echo languageswitcher('event_trans_all_day', "All Day");
                                }
                                ?>
                            </p>
                            <p class="comment-txt">
                                <a href="<?php echo get_permalink(); ?>#comments"><?php echo get_comments_number($post->ID); ?> <?php _e('Comments', CSDOMAIN) ?></a>
                            </p>
                        </div>
                        <?php
                        the_content();
                        wp_link_pages('before=<p class="link-pages">Page: ');
                        ?>
                        <div class="event-location">
                            <h2 class="colr bold"><?php echo languageswitcher('event_location', 'Event Location') ?></h2>
                            <div class="map-section">
                                <div class="location-opts">
                                    <p>
                                        <?php
                                        if ($cs_xmlObject->event_address <> "") {
                                            echo get_the_title("$cs_xmlObject->event_address");
                                            if ($loc_address <> "")
                                                echo ", " . $loc_address;
                                            if ($loc_city <> "")
                                                echo ", " . $loc_city;
                                            if ($loc_postcode <> "")
                                                echo ", " . $loc_postcode;
                                            if ($loc_region <> "")
                                                echo ", " . $loc_region;
                                            if ($loc_country <> "")
                                                echo ", " . $loc_country;
                                        }
                                        ?>
                                    </p>
                                </div>                                    
                                <div class="mapbox">
                                    <?php if ($event_loc_lat <> "" && $event_loc_long <> "") { ?>
                                        <div id="map_canvas" style="height:300px"></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Post End -->
                    <!-- Post Extra Options Start -->
                    <div class="post-extras">
                        <div class="tags">
                            <p>
                                <?php
                                $before_cat = " " . __('Categories', CSDOMAIN) . ": ";
                                echo get_the_term_list(get_the_id(), 'event-category', $before_cat, ', ', '');
                                ?> 
                            </p>
                            <p>
                                <?php
                                $before_cat = " " . __('Tags', CSDOMAIN) . ": ";
                                echo get_the_term_list(get_the_id(), 'event-tag', $before_cat, ', ', '');
                                ?>
                            </p>
                        </div>
                        <?php if ($cs_xmlObject->event_social_sharing == "on") { ?>
                            <div class="post-share">
                                <div class="social_sharing">
                                    <h5><?php echo languageswitcher('share_this_post', "Share This Post") ?></h5>
                                    <?php social_share() ?>
                                </div>
                            </div>
                        <?php } ?>                            
                    </div>
                </div>

                <div class="clear"></div>
                <?php if (get_the_author_meta('description')) : ?>
                    <div class="about-author">
                        <a href="#" class="thumb"><?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('PixFill_author_bio_avatar_size', 53)); ?></a>
                        <div class="desc">
                            <h4 class="colr"><?php echo get_the_author(); ?></h4>
                            <p>
                                <?php the_author_meta('description'); ?>
                            </p>
                        </div>
                    </div>
                    <!-- About Author End -->
                <?php endif; ?>                    
                <div class="clear"></div>
                <!-- Blog Start -->                    	
            <?php endwhile; // end of the loop. ?>
        <?php
        comments_template('', true);
        wp_reset_query();
        ?>     
    </div>                                               
</div>                                                            
</div>                
<?php if ($cs_layout == 'col2 page_box both_right') { ?>
    <!--Sidebar Start-->
    <div class="col1 hidemobile margin_right_sidebar">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($show_sidebar_left)) : ?>
        <?php endif; ?>                                    
    </div>
<?php } ?>

<?php if ($cs_layout == "col2 page_box both" || $cs_layout == 'col3 page_box left' || $cs_layout == 'col2 page_box both_right') { ?>
    <!--Sidebar Start-->
    <div class="col1 right hidemobile">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($show_sidebar)) : ?>
        <?php endif; ?>                                    
    </div>
<?php } ?>  
</div>
</div>
</div>
<?php get_footer(); ?>