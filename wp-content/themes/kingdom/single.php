<?php
get_header();
global $post_id;
$cs_layout = '';
$cs_sidebar_left = '';
$cs_sidebar_right = '';
$post_xml = get_post_meta($post->ID, "post", true);
if ($post_xml <> "") {
    $cs_xmlObject = new SimpleXMLElement($post_xml);
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
    <?php
    }
    wp_reset_query();
    ?>
<div class="<?php if (isset($cs_layout)) echo $cs_layout; ?>">
    <?php if (have_posts()) while (have_posts()) : the_post(); ?>
            <!-- Blog Start -->
            <div class="box-in">
                <!-- Blog Post Start -->
                <div class="post" id="<?php the_ID(); ?>">
                    <?php
                    $image_id = cs_get_post_thumbnail($post->ID, 690, 270);
                    featured();
                    if ($image_id <> '') {
                        ?>
                        <a class="thumb" href="<?php echo get_permalink(); ?>">
                            <?php echo $image_id; ?>
                        </a>
                    <?php } ?>
                    <h2><?php echo get_the_title(); ?></h2>
                    <div class="post-opts">
                        <p class="author">
                            <?php printf(__('By: %s', CSDOMAIN), '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() . '</a>') ?>
                        </p>
                        <p class="date">
                            <?php echo date(get_option('date_format'), strtotime(get_the_date())); ?>
                        </p>
                        <p class="category">
                            <?php
                            $before_cat = " " . __('', CSDOMAIN) . " ";
                            echo get_the_term_list("get_the_id()", 'category', $before_cat, ', ', '');
                            ?>
                        </p>
                    </div>
                    <?php
                    the_content();
                    wp_link_pages('before=<p class="link-pages">Page: ');
                    ?>
                </div>
                <!-- Post Extra Options Start -->
                <div class="post-extras">
                    <div class="tags">

                        <p>
                            <?php
                            $before_cat = " " . __('Tags', CSDOMAIN) . ": ";
                            echo get_the_term_list(get_the_id(), 'post_tag', $before_cat, ', ', '');
                            ?>
                        </p>
                    </div>
                    <div class="post-share">
                        <?php
                        if (isset($cs_xmlObject->post_social_sharing) and $cs_xmlObject->post_social_sharing == "on") {
                            ?>
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