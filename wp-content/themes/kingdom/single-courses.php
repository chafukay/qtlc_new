<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
get_header();
global $post_id, $post;
$cs_layout = '';
$cs_sidebar_left = '';
$cs_sidebar_right = '';
$course_date = '';
$course_eligibility = '';
$course_apply = '';
$course_social = '';
if (have_posts())
    while (have_posts()) : the_post();
        $cs_album = get_post_meta($post->ID, "cs_course", true);
        if ($cs_album <> "") {
            $cs_xmlObject = new SimpleXMLElement($cs_album);
            $cs_layout = isset($cs_xmlObject->cs_layout) ? $cs_xmlObject->cs_layout : '';
            $cs_sidebar_left = isset($cs_xmlObject->cs_sidebar_left) ? $cs_xmlObject->cs_sidebar_left : '';
            $cs_sidebar_right = isset($cs_xmlObject->cs_sidebar_right) ? $cs_xmlObject->cs_sidebar_right : '';
            $course_date = isset($cs_xmlObject->course_date) ? $cs_xmlObject->course_date : '';
            $course_eligibility = isset($cs_xmlObject->course_eligibility) ? $cs_xmlObject->course_eligibility : '';
            $course_apply = isset($cs_xmlObject->course_apply) ? $cs_xmlObject->course_apply : '';
            $course_social = isset($cs_xmlObject->course_social) ? $cs_xmlObject->course_social : "";
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
        <?php }//Both?>
        <?php if ($cs_layout == 'col2 page_box both_left') { ?>
            <!--Sidebar Start-->
            <div class="col1 left hidemobile margin_left_sidebar">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($show_sidebar)) : ?>
                <?php endif; ?>                                    
            </div>
        <?php } ?>
        <div class="<?php echo $cs_layout; ?>">
            <div class="box-in">
                <!-- Courses Intro Start -->
                <div class="intro post">
                    <?php
                    $image_id = cs_get_post_thumbnail($post->ID, 690, 270);
                    if ($image_id <> '') {
                        ?>
                        <a class="thumb" href="<?php echo get_permalink(); ?>">
                            <?php echo $image_id; ?>
                        </a>
                    <?php } ?>
                    <div class="clear"></div>
                    <div class="post-opts">
                        <p class="author">
                            <?php printf(__('By: %s', CSDOMAIN), '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() . '</a>') ?>
                        </p>
                        <p class="date"><?php echo date(get_option('date_format'), strtotime($course_date)); ?></p>
                        <p class="comment-txt">
                            <a href="<?php echo get_permalink(); ?>#comments"><?php echo get_comments_number($post->ID); ?> <?php _e('Comments', CSDOMAIN) ?></a>
                        </p>
                    </div>
                    <div class="intro-desc">
                        <?php
                        the_content();
                        wp_link_pages('before=<p class="link-pages">Page: ');
                        ?>
                    </div>
                    <div class="box intro-box">
                        <div class="box-in">
                            <h3 class="colr"><?php echo languageswitcher('course_plan', 'Course Plan') ?></h3>
                            <ul>
                                <li>
                                    <p><?php _e('Start time', CSDOMAIN) ?></p>
                                    <p><?php echo date(get_option('date_format'), strtotime($course_date)) ?></p>
                                </li>
                                <li>
                                    <p><?php echo languageswitcher('course_programs', 'Course Program') ?></p>
                                    <p>
                                        <?php
                                        echo get_the_term_list(get_the_id(), 'course-category', '', ', ', '');
                                        ?> 
                                    </p>
                                </li>
                                <li>
                                    <p><?php echo languageswitcher('course_eligibility', 'Eligibility') ?></p>
                                    <p><?php echo $course_eligibility; ?></p>
                                </li>
                                <li>

                                    <?php
                                    $tags_list = get_the_term_list(get_the_id(), 'course-tag', '', ', ', '');
                                    if ($tags_list) {
                                        echo '<p>';
                                        _e('Tags', CSDOMAIN);
                                        echo '</p>';
                                        echo '<p>' . $tags_list . '</p>';
                                    }
                                    ?> 
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Courses Intro End -->
                <!-- Table Section Start -->
                <div class="table-sec">
                    <ul class="table-head">
                        <li class="id"><?php _e('Id', CSDOMAIN) ?></li>
                        <li class="subject-title"><?php echo languageswitcher('subject_title', 'Subject Title') ?></li>
                        <li class="campus hidesmall"><?php echo languageswitcher('course_instructor', 'Instructor') ?></li>
                        <li class="class-time"><?php echo languageswitcher('credit_hours', 'Credit Hours') ?></li>
                        <li class="class-time"><?php _e('More...', CSDOMAIN) ?></li>
                    </ul>
                    <?php
                    $subject_counter = 0;
                    $subject_title = '';
                    $subject_instructor = '';
                    $subject_credit = '';
                    $subject_detail = '';
                    foreach ($cs_xmlObject as $track) {
                        if ($track->getName() == "subject") {
                            $subject_counter++;
                            $subject_title = isset($track->subject_title) ? $track->subject_title : '';
                            $subject_instructor = isset($track->subject_instructor) ? $track->subject_instructor : '';
                            $subject_credit = isset($track->subject_credit) ? $track->subject_credit : '';
                            $subject_detail = isset($track->subject_detail) ? $track->subject_detail : '';
                            ?>
                            <ul class="table-cont">
                                <li class="id"><?php echo $subject_counter; ?></li>
                                <li class="subject-title"><?php echo $track->subject_title; ?></li>
                                <li class="campus hidesmall"><?php echo $track->subject_instructor; ?></li>
                                <li class="class-time"><?php echo $track->subject_credit; ?></li>
                                <li class="class-time"><a class="document_class" href="<?php echo $track->subject_detail; ?>">&nbsp;</a></li>
                            </ul>
                            <?php
                        }
                    }
                    ?>
                </div>
                <!-- Table Section Close -->
                <!-- Across Categories Start -->
                <div class="acros-cats">
                    <a href="<?php echo $course_apply; ?>" class="backcolr"><?php echo languageswitcher('course_apply', "Apply Now") ?></a>
                </div>
                <!-- Across Categories End -->
                <!-- Post Extra Options Start -->
                <div class="post-extras course-extra">
                    <?php
                    if ($course_social == 'Yes') {
                        ?>
                        <div class="post-share">
                            <div class="social_sharing">
                                <h5><?php echo languageswitcher('share_this_post', "Share This Post") ?></h5>
                                <?php social_share() ?>
                            </div>
                        </div>
                    <?php } ?>  
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