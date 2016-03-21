<?php
$cs_default_pages = get_option("cs_default_pages");
$cs_layout = '';
$cs_sidebar_left = '';
$cs_sidebar_right = '';
$cs_pagination = '';
$record_per_page = '';
if ($cs_default_pages <> "") {
    $cs_xmlObject = new SimpleXMLElement($cs_default_pages);
    $cs_layout = isset($cs_xmlObject->cs_layout) ? $cs_xmlObject->cs_layout : '';
    $cs_sidebar_left = isset($cs_xmlObject->cs_sidebar_left) ? $cs_xmlObject->cs_sidebar_left : '';
    $cs_sidebar_right = isset($cs_xmlObject->cs_sidebar_right) ? $cs_xmlObject->cs_sidebar_right : '';
    $cs_pagination = isset($cs_xmlObject->cs_pagination) ? $cs_xmlObject->cs_pagination : '';
    $record_per_page = isset($cs_xmlObject->record_per_page) ? $cs_xmlObject->record_per_page : '';
    if ($cs_pagination == 'Single Page') {
        $record_per_page = '-1';
    }
}
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

get_header();
if ($cs_layout == 'col2 page_box both' || $cs_layout == 'col3 page_box right' || $cs_layout == 'col2 page_box both_left') {
    ?>
    <div class="col1 left hidemobile">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($show_sidebar_left)) : ?>
        <?php endif; ?>                                    
    </div>
<?php }//Both ?>
<?php if ($cs_layout == 'col2 page_box both_left') { ?>
    <!--Sidebar Start-->
    <div class="col1 left hidemobile margin_left_sidebar">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($show_sidebar)) : ?>
        <?php endif; ?>                                    
    </div>
<?php } ?>
<div class="<?php if (isset($cs_layout)) echo $cs_layout; ?> cs-default-page">
    <h2 class="heading"><?php printf(__('Search Results %1$s %2$s', CSDOMAIN), ': ', '<span>' . get_search_query() . '</span>'); ?></h2>
    <div class="blog">
        <div class="box-in">
            <?php
            if (isset($cs_layout)and ( $cs_layout == "col2 page_box both" or $cs_layout == "col2 page_box both_right" or $cs_layout == "col2 page_box both_left")) {
                $width = '690';
                $height = '270';
            } else {
                $width = '299';
                $height = '175';
            }
            $image_id = isset($post->ID) ? cs_get_post_thumbnail($post->ID, $width, $height):'';
            
            if ($image_id == '') {
                $cs_noimage = 'no-image';
            } else {
                $cs_noimage = '';
            }
            if (have_posts()) :
                ?>
                <?php while (have_posts()) : the_post();
                    ?>
                    <div  <?php post_class($cs_noimage); ?>>
                        <div class="thumbnail">
        <?php
        if ($image_id <> '') {
            echo "<a href='" . get_permalink() . "' class='thumb'>" . $image_id . "</a>";
        }
        ?>
                        </div>
                        <div class="text">    
                            <h2><a href="<?php echo get_permalink() ?>"><?php echo get_the_title(); ?></a></h2>
                            <div class="post-opts">
                                <p class="author">
        <?php printf(__('By: %s', CSDOMAIN), '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() . '</a>') ?>
                                </p>
                                <p class="date"><?php echo date(get_option('date_format'), strtotime(get_the_date())); ?></p>
                                <p class="comment-txt">
                                    <a href="<?php echo get_permalink(); ?>#comments"><?php echo get_comments_number($post->ID); ?> <?php _e('Comments', CSDOMAIN) ?></a>
                                </p>
                            </div>
        <?php
        if (post_password_required()) {
            echo cs_password_form();
        } else {
            echo '<p>' . get_the_excerpt() . '</p>';
        }
        ?>
                        </div>       
                    </div>
    <?php endwhile; ?>
                <?php
                // pagination start
                if (record_per_page_default_pages() < $wp_query->found_posts) {
                    echo "<div class='pagination'><h5>" . __('Pages:', CSDOMAIN) . "</h5><ul>";
                    $qrystr = '';
                    if (isset($_GET['s']))
                        $qrystr = "&s=" . $_GET['s'];
                    echo cs_pagination($wp_query->found_posts, record_per_page_default_pages(), $qrystr);
                    echo "</ul></div>";
                }
                // pagination end
                ?>
            <?php else : ?>
                <div class="in-sec">
                    <h1 class=""><?php _e('No results found.', CSDOMAIN); ?></h1>
                    <p style="padding:10px 0;"><?php
            _e('Sorry, no posts matched your criteria.', CSDOMAIN);
            _e('Please try again.', CSDOMAIN)
                ?></p>
                        <?php get_search_form(); ?>
                </div>
                <?php endif; ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
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
<div class="clear"></div>
</div>
<?php get_footer(); ?>