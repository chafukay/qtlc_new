<?php
get_header();
$cs_layout = '';
$cs_sidebar_left = '';
$cs_sidebar_right = '';
$cs_pagination = '';
$record_per_page = '';
$cs_default_pages = get_option("cs_default_pages");
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
<?php }
?>

<div class="<?php if (isset($cs_layout)) echo $cs_layout; ?> cs-default-page">
    <div class="box">
        <h2 class="heading">
            <?php if (have_posts()) : the_post(); ?>
                <?php
                if (is_author()) :
                    echo __('Author', CSDOMAIN) . " " . __('Archives', CSDOMAIN) . ": " . get_the_author();
                elseif (is_tag() || is_tax('event-tag') || is_tax('course-tag')) :
                    echo __('Tags', CSDOMAIN) . " " . __('Archives', CSDOMAIN) . ": " . single_cat_title('', false);
                elseif (is_category() || is_tax('course-category') || is_tax('event-category')) :
                    echo __('Categories', CSDOMAIN) . " " . __('Archives', CSDOMAIN) . ": " . single_cat_title('', false);
                elseif (is_day()) :
                    printf(__('Daily Archives: %s', CSDOMAIN), '<span>' . get_the_date() . '</span>');
                elseif (is_month()) :
                    printf(__('Monthly Archives: %s', CSDOMAIN), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', CSDOMAIN)) . '</span>');
                elseif (is_year()) :
                    printf(__('Yearly Archives: %s', CSDOMAIN), '<span>' . get_the_date(_x('Y', 'yearly archives date format', CSDOMAIN)) . '</span>');
                else :
                    _e('Blog Archives', CSDOMAIN);
                endif;
                ?>
            </h2>
            <div class="box-in">
                <?php
                rewind_posts();

                if (isset($cs_layout)and ( $cs_layout == "col2 page_box both" or $cs_layout == "col2 page_box both_right" or $cs_layout == "col2 page_box both_left")) {
                    $width = '690';
                    $height = '270';
                } else {
                    $width = '299';
                    $height = '175';
                }
                while (have_posts()) : the_post();
                    $image_id = cs_get_post_thumbnail($post->ID, $width, $height);
                    if ($image_id == '') {
                        $cs_noimage = 'no-image';
                    } else {
                        $cs_noimage = '';
                    }
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
                                <p class="comment-txt">
                                    <a href="<?php echo get_permalink(); ?>#comments"><?php echo get_comments_number($post->ID); ?> <?php _e('Comments', CSDOMAIN) ?></a>
                                </p>
                                <p>
                                    <?php
                                    $before_cat = " " . __('Categories', CSDOMAIN) . ": ";
                                    $categories_list = get_the_term_list(get_the_id(), 'category', $before_cat, ', ', '');
                                    if ($categories_list) {
                                        printf(__('%1$s', CSDOMAIN), $categories_list);
                                    }
                                    ?>
                                </p>
                            </div>
                            <?php
                            if (post_password_required()) {
                                echo cs_password_form();
                            } else {
                                echo '<p>' . substr(get_the_excerpt(), 0, 300) . '...</p>';
                            }
                            ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div><!-- Page End -->

<?php if ($cs_layout == "col2 page_box both" || $cs_layout == "col3 page_box left" || $cs_layout == "col2 page_box both_right") { ?>
    <div class="col1 right hidemobile">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($show_sidebar)) : ?>
        <?php endif; ?>                                    
    </div>
<?php }
?>

<?php if ($cs_layout == "col2 page_box both_right") { ?>
    <div class="col1 hidemobile margin_right_sidebar">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($show_sidebar_left)) : ?>
        <?php endif; ?>                                    
    </div>
<?php } ?>

</div>
<div class="clear"></div>
</div>
</div>
<?php get_footer(); ?>
