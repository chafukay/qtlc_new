<?php
get_header();
$cs_page_builder = get_post_meta($post->ID, "cs_page_builder", true);
if ($cs_page_builder == '') {
    // if page have no meta info like sample page - start
    if (have_posts())
        while (have_posts()) : the_post();
            echo '<div class="box"><h2 class="heading colr">' . get_the_title() . '</h2><div class="box-in"><p>' . get_the_content() . '</p></div></div>';
            wp_link_pages(array('before' => '<div class="page-link">' . __('Pages', 'kingdom'), 'after' => '</div>'));
            edit_post_link(__('Edit', 'kingdom'), '<span class="edit-link">', '</span>');
            comments_template('', true);
        endwhile;
    // if page have no meta info like sample page - end
}
else {
    $cs_layout = '';
    $cs_sidebar_left = '';
    $cs_sidebar_right = '';
    $cs_xmlObject = new SimpleXMLElement($cs_page_builder);
    $cs_layout = $cs_xmlObject->cs_layout;
    $cs_sidebar_left = $cs_xmlObject->cs_sidebar_left;
    $cs_sidebar_right = $cs_xmlObject->cs_sidebar_right;
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

    foreach ($cs_xmlObject->children() as $cs_node) {
        ?>
        <?php
        if ($cs_node->getName() == "contact" and $cs_node->cs_contact_map_view == "header_view") {
            ?>
            <div class="fullwidth page_box left"><?php echo $cs_node->cs_contact_map; ?></div>
            <?php
        }
    }


    if ($cs_layout == 'col2 page_box both' || $cs_layout == 'col3 page_box right' || $cs_layout == 'col2 page_box both_left') {
        ?>
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
    <?php } ?>
    <div class="<?php echo $cs_layout; ?>">
        <?php
        if (post_password_required()) {
            echo '<div class="in-sec">' . cs_password_form() . '</div>';
        } else {
            $counter_gal = 0;
            foreach ($cs_xmlObject->children() as $cs_node) {
                if ($cs_node->getName() == "rich_editor") {
                    wp_reset_query();
                    //get_template_part( 'loop', 'page' );
                    if ($cs_node->cs_rich_editor_title == "Yes")
                        echo '<h2 class="heading colr">' . get_the_title() . '</h2>';
                    if ($cs_node->cs_rich_editor_desc == "Yes") {
                        echo '<div class="intro">';
                        $content_of_post = get_post($post->ID);
                        $content = $content_of_post->post_content;
                        $content = apply_filters('the_content', $content);
                        $content = str_replace(']]>', ']]>', $content);
                        echo $content;
                        echo '</div>';
                    }
                }
                if ($cs_node->getName() == "gallery") {
                    $counter_gal++;
                    $cs_gal_layout_db = isset($cs_node->layout) ?  $cs_node->layout : '';
                    $cs_gal_album_db = isset($cs_node->album) ? $cs_node->album : '';
                    $cs_gal_title_db = isset($cs_node->title) ? $cs_node->title : '';
                    $cs_gal_desc_db = isset($cs_node->desc) ? $cs_node->desc : '';
                    $cs_gal_pagination_db = isset($cs_node->pagination) ? $cs_node->pagination : '';
                    $cs_gal_media_per_page_db = isset($cs_node->media_per_page) ? $cs_node->media_per_page : '';
                    if ($cs_node->album <> "" and $cs_node->album <> "0")
                        include "page_gallery.php";
                }
                else if ($cs_node->getName() == "slider") {
                    $counter_gal++;
                    if ($cs_node->slider <> "" and $cs_node->slider <> "0")
                        include"page_slider.php";
                }
                else if ($cs_node->getName() == "blog") {
                    $counter_gal++;
                    $cs_blog_title_db = isset($cs_node->cs_blog_title) ? $cs_node->cs_blog_title :'';
                    $cs_blog_cat_db = isset($cs_node->cs_blog_cat) ? $cs_node->cs_blog_cat : '';
                    $cs_blog_excerpt_db = isset($cs_node->cs_blog_excerpt) ? $cs_node->cs_blog_excerpt : '';
                    $cs_blog_num_post_db = isset($cs_node->cs_blog_num_post) ? $cs_node->cs_blog_num_post : '';
                    $cs_blog_pagination_db = isset($cs_node->cs_blog_pagination) ? $cs_node->cs_blog_pagination : '';
                    if ($cs_node->cs_blog_cat <> "" and $cs_node->cs_blog_cat <> "0")
                        include "page_blog.php";
                }
                else if ($cs_node->getName() == "contact") {
                    $counter_gal++;
                    $cs_contact_email_db = isset($cs_node->cs_contact_email) ? $cs_node->cs_contact_email : '';
                    $cs_contact_succ_msg_db = isset($cs_node->cs_contact_succ_msg) ? $cs_node->cs_contact_succ_msg : '';
                    $cs_contact_map_db = isset($cs_node->cs_contact_map) ? $cs_node->cs_contact_map : '';
                    include "page_contact.php";
                } else if ($cs_node->getName() == "news") {
                    $counter_gal++;
                    $cs_news_title_db = isset($cs_node->cs_news_title) ? $cs_node->cs_news_title : '';
                    $cs_news_cat_db = isset($cs_node->cs_news_cat) ? $cs_node->cs_news_cat : '';
                    $cs_news_excerpt_db = isset($cs_node->cs_news_excerpt) ? $cs_node->cs_news_excerpt : "";
                    $cs_news_num_post_db = isset($cs_node->cs_news_num_post) ? $cs_node->cs_news_num_post : '';
                    $cs_news_pagination_db = isset($cs_node->cs_news_pagination) ? $cs_node->cs_news_pagination : '';
                    if ($cs_node->cs_news_cat <> "" and $cs_node->cs_news_cat <> "0")
                        include "page_news.php";
                }
                else if ($cs_node->getName() == "course") {
                    $counter_gal++;
                    $course_cat = isset($cs_node->course_cat) ? $cs_node->course_cat : '';
                    $course_filterable = isset($cs_node->course_filterable) ? $cs_node->course_filterable : '';
                    $course_pagination = isset($cs_node->course_pagination) ? $cs_node->course_pagination : '';
                    $course_per_page = isset($cs_node->course_per_page) ? $cs_node->course_per_page : '';
                    if ($cs_node->course_cat <> "" and $cs_node->course_cat <> "0")
                        include "page_courses.php";
                }
                else if ($cs_node->getName() == "event") {
                    $counter_gal++;
                    if ($cs_node->cs_event_category <> "" and $cs_node->cs_event_category <> "0")
                        include "page_event.php";
                }
            }
        }
        ?>
        <?php wp_reset_query();
        comments_template('', true); ?>
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
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
    </div><!-- Page End -->
    </div>
<?php } ?>
<div class="clear"></div>
</div>
</div>
<?php get_footer(); ?>