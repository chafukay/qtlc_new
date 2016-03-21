<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
    <!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
    <!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
    <!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
        <head>
            <?php
// genereal setting start
            global $cs_responsive, $theme_rtl, $cs_transwitch, $consumerkey, $consumersecret, $accesstoken, $accesstokensecret;
            $cs_bg = '';
            $pattern = '';   
            $cs_bg_position = '';
            $cs_bg_repeat = '';
            $cs_bg_attach = '';
            $cs_bg_pattern = '';
            $custome_pattern = '';
            $cs_bg_color = '';
            $cs_color_scheme = '';
            $cs_style_sheet = '';
            $cs_gs_color_style = get_option("cs_gs_color_style");
            if ($cs_gs_color_style <> "") {
                $sxe = new SimpleXMLElement($cs_gs_color_style);
                $cs_bg = isset($sxe->cs_bg) ? $sxe->cs_bg : "";
                $cs_bg_position = isset($sxe->cs_bg_position) ? $sxe->cs_bg_position : '';
                $cs_bg_repeat = isset($sxe->cs_bg_repeat) ? $sxe->cs_bg_repeat : "";
                $cs_bg_attach = isset($sxe->cs_bg_attach) ? $sxe->cs_bg_attach : '';
                $cs_bg_pattern = isset($sxe->cs_bg_pattern) ? $sxe->cs_bg_pattern : '';
                $custome_pattern = isset($sxe->custome_pattern) ? $sxe->custome_pattern : '';
                $cs_bg_color = isset($sxe->cs_bg_color) ? $sxe->cs_bg_color : '';
                $cs_color_scheme = isset($sxe->cs_color_scheme) ? $sxe->cs_color_scheme : '';
                $cs_style_sheet = isset($sxe->cs_style_sheet) ? $sxe->cs_style_sheet : '';
                if ($custome_pattern <> "")
                    $pattern = get_template_directory_uri() . "/images/pattern/" . $custome_pattern . "-bg.png";
                else
                    $pattern = $cs_bg_pattern;
            }
            $cs_logo = '';
            $cs_width = '';
            $cs_height = '';
            $cs_gs_logo = get_option("cs_gs_logo");
            if ($cs_gs_logo <> "") {
                $sxe = new SimpleXMLElement($cs_gs_logo);
                $cs_logo = isset($sxe->cs_logo) ? $sxe->cs_logo : '';
                $cs_width = isset($sxe->cs_width) ? $sxe->cs_width : '';
                $cs_height = isset($sxe->cs_height) ? $sxe->cs_height : '';
            }
            $cs_fav_icon = '';
            $cs_header_code = '';
            $header_phone = '';
            $cs_gs_header_script = get_option("cs_gs_header_script");
            if ($cs_gs_header_script <> "") {
                $sxe = new SimpleXMLElement($cs_gs_header_script);
                $cs_fav_icon = isset($sxe->cs_fav_icon) ? $sxe->cs_fav_icon : '';
                $cs_header_code = isset($sxe->cs_header_code) ? $sxe->cs_header_code : '';
                $header_phone = isset($sxe->header_phone) ? $sxe->header_phone : '';
            }

            $cs_gs_others = get_option("cs_gs_others");
            $cs_responsive = "";
            $cs_breadcrumb = "";
            $theme_rtl = "";
            $cs_transwitch = '';
            $cs_color_picker = '';
            if ($cs_gs_others <> "") {
                $sxe = new SimpleXMLElement($cs_gs_others);
                $cs_responsive = isset($sxe->responsive) ? $sxe->responsive : '';
                $cs_breadcrumb = isset($sxe->breadcrumb) ? $sxe->breadcrumb : '';
                $theme_rtl = isset($sxe->theme_rtl) ? $sxe->theme_rtl : '';
                $cs_transwitch = isset($sxe->translation_switcher) ? $sxe->translation_switcher : "";
                $cs_color_picker = isset($sxe->color_picker) ? $sxe->color_picker : '';
            }
            // genereal setting end

            $cs_all_twitter_settings = get_option("cs_all_twitter_settings");
            $consumerkey = '';
            $consumersecret = '';
            $accesstoken = '';
            $accesstokensecret = '';
            if ($cs_all_twitter_settings <> "") {
                $sxe = new SimpleXMLElement($cs_all_twitter_settings);
                $consumerkey = isset($sxe->consumerkey) ? $sxe->consumerkey : '';
                $consumersecret = isset($sxe->consumersecret) ? $sxe->consumersecret : '';
                $accesstoken = isset($sxe->accesstoken) ? $sxe->accesstoken : '';
                $accesstokensecret = isset($sxe->accesstokensecret) ? $sxe->accesstokensecret : '';
            }

            $color_picker_enable = 0;

            if ($cs_color_picker == "on") {
                if (isset($_POST['color_picker'])) {
                    $_SESSION['color_picker_sess'] = $_POST['color_picker'];
                    $cs_color_scheme = $_SESSION['color_picker_sess'];
                    $color_picker_enable = 1;
                } else if (isset($_SESSION['color_picker_sess'])) {
                    $cs_color_scheme = $_SESSION['color_picker_sess'];
                    $color_picker_enable = 1;
                }
            }
            ?>


            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta charset="<?php bloginfo('charset'); ?>" />


            <?php if ($cs_responsive <> '') { ?>
                <!-- Mobile Specific Metas
                ================================================== 
                -->
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
            <?php } ?>

            <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
            <!--// Javascript //-->

            <?php
            if (is_singular() && get_option('thread_comments'))
                wp_enqueue_script('comment-reply');
            ?>

            <link rel="shortcut icon" href="<?php echo $cs_fav_icon ?>" />
            <link rel="gymextream-touch-icon" href="<?php echo $cs_fav_icon ?>" alt="" />


            <?php
            wp_head();

            if ($cs_color_picker == "on") {
                if (file_exists(TEMPLATEPATH . "/color_picker/inc_color_picker.php"))
                    include_once "color_picker/inc_color_picker.php";
            }
            ?>

            <?php if ($cs_style_sheet <> "custom" and $cs_style_sheet <> "") { ?>
                <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/custom_styles/<?php echo $cs_style_sheet ?>.css" />
                <?php
            } else if ($cs_style_sheet == "custom" or $color_picker_enable == 1) {
                ?>
                <style>
                    .colr,
                    .txthover:hover,
                    .ddsmoothmenu ul li ul li a:hover,
                    .ddsmoothmenu ul li ul li a.selected,
                    .theme-default .nivoSlider a,
                    #footer .heading,
                    .category-widget ul li a:hover,
                    .post-list li .desc h6 a:hover,
                    .post h2 a:hover,
                    .post-extras .tags a:hover,
                    .table-sec .table-cont li.c-name a:hover,
                    .any-caption h1 a,
                    .sudo-slider li .caption .capt-in a,
                    .tabs-widget .widgettitle,
                    .widget_categories ul li.cat-item a:hover,
                    .widget_archive ul li a:hover,
                    .gal-caption h3,
                    ul.timeline li:hover .desc-sec .text h3 a,
                    .event-location h2															{color:<?php echo $cs_color_scheme ?> !important;}

                    .backcolr,
                    #backcolr,
                    .ddsmoothmenu ul li ul,
                    .backcolrhover:hover,
                    .backcolrdark,
                    .ddsmoothmenu > ul > li > a:hover,
                    .ddsmoothmenu > ul > li.current-menu-item > a,
                    .ddsmoothmenu > ul > li > a.selected,
                    .pagination a:hover, .pagination a.active,
                    .post:hover .date-sec,
                    .filter-sec nav a:hover, .filter-sec nav a.active,
                    ul.timeline li:hover .desc-sec .date .date-in,
                    #wp-calendar thead,
                    .button, button, input[type="submit"],
                    input[type="reset"], input[type="button"],
                    .tagcloud a																	{background-color:<?php echo $cs_color_scheme ?> !important;}

                    .bordercolr,
                    .bordercolrover:hover,
                    .box,
                    .page_box,
                    blockquote .block,
                    .tabs-widget .tab_menu_container a											{border-color:<?php echo $cs_color_scheme ?> !important;}


                </style>
                <?php
            }


            echo $cs_header_code;
            ?>


        </head>
        <body <?php
        body_class('dd');
        echo ($pattern) ? 'style="background:url(' . $pattern . ') ' . $cs_bg_color . ';"' : ''
        ?> >
            <!-- Outer Wrapper Start -->


            <div id="outer-wrapper" <?php echo ($cs_bg) ? 'style="background:url(' . $cs_bg . ') ' . $cs_bg_repeat . ' top ' . $cs_bg_position . ' ' . $cs_bg_attach . ';"' : '' ?> >
                <!-- Header Start -->
                <div id="header">
                    <div class="headtop">
                        <div class="inner">
                            <!-- Logo End -->                
                            <div class="five columns left">
                                <a href="<?php echo home_url(); ?>" class="logo"><img style="width:<?php echo $cs_width ?>px; height:<?php echo $cs_height ?>px" src="<?php echo $cs_logo ?>" alt="<?php echo bloginfo('name') ?>" /></a>
                            </div>
                            <!-- Logo End -->
                            <div class="eleven columns right">
                                <!-- Top Links Start -->
                                <?php
                                // Menu parameters		
                                $defaults = array(
                                    'theme_location' => 'top-menu',
                                    'menu' => '',
                                    'container' => '',
                                    'container_class' => 'menu-{menu slug}-container',
                                    'container_id' => '',
                                    'menu_class' => '',
                                    'menu_id' => '',
                                    'echo' => true,
                                    'fallback_cb' => '',
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'items_wrap' => '%3$s',
                                    'depth' => 0,
                                    'walker' => '',);
                                if (has_nav_menu('top-menu')) {
                                    ?>
                                    <ul class="top-links">
                                        <?php
                                        wp_nav_menu($defaults);
                                        if (isset($sxe->translation_switcher) ? $sxe->translation_switcher : '' == "on") {
                                            echo language_selector_flags();
                                        }
                                        ?>  


                                    </ul>
                                <?php } else { ?>
                                <?php }
                                ?>
                                <div class="clear"></div>
                                <!-- Top Links End -->
                                <h2 class="white right">
                                    <strong><?php echo $header_phone; ?></strong>
                                </h2>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="navigation bordercolr backcolr">
                        <div class="inner">
                            <nav class="ddsmoothmenu">
                                <?php
                                // Menu parameters		
                                $defaults = array(
                                    'theme_location' => 'main-menu',
                                    'menu' => '',
                                    'container' => '',
                                    'container_class' => 'menu-{menu slug}-container',
                                    'container_id' => '',
                                    'menu_class' => 'top-navigation',
                                    'menu_id' => '',
                                    'echo' => true,
                                    'fallback_cb' => 'wp_page_menu',
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'items_wrap' => '<ul>%3$s</ul>',
                                    'depth' => 0,
                                    'walker' => '',);
                                wp_nav_menu($defaults);
                                ?>
                                <div class="clear"></div>
                            </nav>
                            <!-- Navigation End -->
                            <div class="search">            
                                <a href="javascript:cs_amimate('search-box')" class="search-btn">&nbsp;</a>					
                                <ul id="search-box">
                                    <script type="text/javascript">
                                        function remove_text() {
                                            if (jQuery(".s").val() == "<?php _e('Search for:', CSDOMAIN); ?>") {
                                                jQuery(".s").val('');
                                            }
                                        }
                                    </script>
                                    <form id="searchform" action="<?php echo home_url() ?>" method="get" role="search">
                                        <li>
                                            <input name="s" value="<?php _e('Search for:', CSDOMAIN); ?>"
                                                   onfocus="if (this.value == '<?php _e('Search for:', CSDOMAIN); ?>') {
                                                               this.value = '';
                                                           }"
                                                   onblur="if (this.value == '') {
                                                               this.value = '<?php _e('Search for:', CSDOMAIN); ?>';
                                                           }" type="text" class="bar s" />
                                        </li>
                                        <li><input id="searchsubmit" type="submit" onClick="remove_text()" value="<?php _e('Search', CSDOMAIN) ?>" class="go backcolr" /></li>
                                    </form>					
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header End -->
                <div class="clear"></div>
                <?php
                if (is_home() || is_front_page()) {
                    $cs_home_page_announcement = get_option("cs_home_page_announcement");
                    $show_announcement = '';
                    $announcement_title = '';
                    $announcement_cat = '';
                    if ($cs_home_page_announcement <> "") {
                        $cs_xmlObject = new SimpleXMLElement($cs_home_page_announcement);
                        $show_announcement = isset($cs_xmlObject->show_announcement) ? $cs_xmlObject->show_announcement : '';
                        $announcement_title = isset($cs_xmlObject->announcement_title) ? $cs_xmlObject->announcement_title : '';
                        $announcement_cat = isset($cs_xmlObject->announcement_cat) ? $cs_xmlObject->announcement_cat : '';
                    }
                    global $cs_node;
                    $show_slider = "";
                    $cs_home_page_slider = get_option("cs_home_page_slider");
                    if ($cs_home_page_slider <> "") {
                        $cs_xmlObject = new SimpleXMLElement($cs_home_page_slider);
                        $cs_node = new stdClass();
                        $show_slider = isset($cs_xmlObject->show_slider) ? $cs_xmlObject->show_slider : '';
                        $cs_node->slider_type = isset($cs_xmlObject->slider_type) ? $cs_xmlObject->slider_type : '';
                        $cs_node->slider = isset($cs_xmlObject->slider_id) ? $cs_xmlObject->slider_id : '';
                    }
                    ?>
                    <?php if ($show_announcement == 'on') { ?>
                        <!-- Banner Start -->
                        <div id="banner">
                            <div class="inner">
                                <div class="headlines">
                                    <?php if ($show_announcement <> '') { ?>
                                        <h4 class="white"><?php echo $announcement_title; ?></h4>
                                        <div id="slider2" class="sliderwrapper">
                                            <?php
                                            wp_reset_query();
                                            $args = array(
                                                'posts_per_page' => -1,
                                                'post_type' => 'post',
                                                'post_status' => 'publish',
                                                'order' => 'DESC',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'category',
                                                        'field' => 'term_id',
                                                        'terms' => array("$announcement_cat")
                                                    )
                                                )
                                            );
                                            query_posts($args);
                                            if (have_posts() <> "") {
                                                while (have_posts()): the_post();
                                                    $new_excerpt = trim(preg_replace('/\[(.*?)\]/ ', '', get_the_title()));
                                                    ?>
                                                    <div class="contentdiv">
                                                        <p><span class="colr"><?php echo get_the_date(); ?></span> : <?php
                                                            echo "<a href='" . get_permalink() . "'>" . substr($new_excerpt, 0, 95) . "</a>";
                                                            if (strlen($new_excerpt) > 95)
                                                                echo "...  <a href='" . get_permalink() . "'>Keep Reading</a>";
                                                            ?></p>
                                                    </div>
                                                    <?php
                                                endwhile;
                                            }
                                            wp_reset_query();
                                            ?>
                                        </div>
                                        <div id="paginate-slider2" class="paginationn">
                                            <a href="#" class="prev">&nbsp;</a>
                                            <a href="#" class="next">&nbsp;</a>
                                        </div>
                                    <?php } ?>
                                    <script type="text/javascript">
                                        featuredcontentslider.init({
                                            id: "slider2", //id of main slider DIV
                                            contentsource: ["inline", ""], //Valid values: ["inline", ""] or ["ajax", "path_to_file"]
                                            toc: "markup", //Valid values: "#increment", "markup", ["label1", "label2", etc]
                                            nextprev: ["Previous", "Next"], //labels for "prev" and "next" links. Set to "" to hide.
                                            revealtype: "click", //Behavior of pagination links to reveal the slides: "click" or "mouseover"
                                            enablefade: [true, 0.2], //[true/false, fadedegree]
                                            autorotate: [true, 3000], //[true/false, pausetime]
                                            onChange: function (previndex, curindex) {  //event handler fired whenever script changes slide
                                                //previndex holds index of last slide viewed b4 current (1=1st slide, 2nd=2nd etc)
                                                //curindex holds index of currently shown slide (1=1st slide, 2nd=2nd etc)
                                            }
                                        });
                                    </script>
                                </div>
                                <div class="clear"></div>
                                <?php if ($show_slider == 'on') { ?>
                                    <div id="gallery">
                                        <div id="main">
                                            <?php
                                            $counter_gal = 1;
                                            $cs_node->width = 1000;
                                            $cs_node->height = 406;
                                            ?>               	
                                            <div id="images" class="" style="width:<?php echo $cs_node->width; ?>px;">
                                                <?php include "page_slider.php" ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- Banner End -->
                    <?php } ?>
                    <div class="clear"></div>
                <?php } ?>

                <?php
                wp_reset_query();
                ?>
                <?php
                if (is_home() || is_front_page()) {
                    
                } else {
                    global $post, $wp_query;
                    ?>
                    <!-- Page Heading Section Start -->
                    <div id="page-title">
                        <div class="inner">
                            <h1>
                                <?php
                                //echo substr(get_the_title(),0,45);if(strlen(get_the_title()) > 45){echo '...';}
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
                                    the_title();
                                //_e( 'Blog Archives', CSDOMAIN );
                                endif;
                                ?>
                            </h1>
                            <div class="page-share">
                                <?php
                                wp_reset_query();
                                //Social Sharing Footer Icons

                                $twitter = '';
                                $facebook = '';
                                $linkedin = '';
                                $digg = '';
                                $delicious = '';
                                $google_plus = '';
                                $google_buzz = '';
                                $google_bookmark = '';
                                $myspace = '';
                                $reddit = '';
                                $stumbleupon = '';
                                $yahoo_buzz = '';
                                $youtube = '';
                                $feedburner = '';
                                $flickr = '';
                                $picasa = '';
                                $vimeo = '';
                                $tumblr = '';

                                $cs_social_network = get_option("cs_social_network");
                                if ($cs_social_network <> "") {
                                    $cs_xmlObject = new SimpleXMLElement($cs_social_network);
                                    $twitter = isset($cs_xmlObject->twitter) ? $cs_xmlObject->twitter : '';
                                    $facebook = isset($cs_xmlObject->facebook) ? $cs_xmlObject->facebook : '';
                                    $linkedin = isset($cs_xmlObject->linkedin) ? $cs_xmlObject->linkedin : '';
                                    $digg = isset($cs_xmlObject->digg) ? $cs_xmlObject->digg : '';
                                    $delicious = isset($cs_xmlObject->delicious) ? $cs_xmlObject->delicious : '';
                                    $google_plus = isset($cs_xmlObject->google_plus) ? $cs_xmlObject->google_plus : '';
                                    $google_buzz = isset($cs_xmlObject->google_buzz) ? $cs_xmlObject->google_buzz : '';
                                    $google_bookmark = isset($cs_xmlObject->google_bookmark) ? $cs_xmlObject->google_bookmark : '';
                                    $myspace = isset($cs_xmlObject->myspace) ? $cs_xmlObject->myspace : '';
                                    $reddit = isset($cs_xmlObject->reddit) ? $cs_xmlObject->reddit : '';
                                    $stumbleupon = isset($cs_xmlObject->stumbleupon) ? $cs_xmlObject->stumbleupon : '';
                                    $yahoo_buzz = isset($cs_xmlObject->yahoo_buzz) ? $cs_xmlObject->yahoo_buzz : '';
                                    $youtube = isset($cs_xmlObject->youtube) ? $cs_xmlObject->youtube : '';
                                    $feedburner = isset($cs_xmlObject->feedburner) ? $cs_xmlObject->feedburner : "";
                                    $flickr = isset($cs_xmlObject->flickr) ? $cs_xmlObject->flickr : '';
                                    $picasa = isset($cs_xmlObject->picasa) ? $cs_xmlObject->picasa : '';
                                    $vimeo = isset($cs_xmlObject->vimeo) ? $cs_xmlObject->vimeo : '';
                                    $tumblr = isset($cs_xmlObject->tumblr) ? $cs_xmlObject->tumblr : '';
                                }
                                ?>
                                <!-- Follow Us Start -->
                                <ul class="social">
                                    <?php if ($twitter != '') { ?><li><a title="Twitter" href="<?php echo $twitter; ?>" class="share_twitter" target="_blank">&nbsp;</a></li><?php } ?>
                                    <?php if ($facebook != '') { ?><li><a  title="Facebook" href="<?php echo $facebook; ?>" class="share_fb" target="_blank">&nbsp;</a></li><?php } ?>
                                    <?php if ($linkedin != '') { ?><li><a  title="Linkedin" href="<?php echo $linkedin; ?>" class="share_linkedin" target="_blank">&nbsp;</a></li><?php } ?>
                                    <?php if ($digg != '') { ?><li><a  title="Digg" href="<?php echo $digg; ?>" class="share_digg" target="_blank">&nbsp;</a></li><?php } ?>
                                    <?php if ($delicious != '') { ?><li><a  title="Delicious" href="<?php echo $delicious; ?>" class="share_delicious" target="_blank">&nbsp;</a></li><?php } ?>
                                    <?php if ($google_plus != '') { ?><li><a  title="Google Plus" href="<?php echo $google_plus; ?>" class="share_google_plus" target="_blank">&nbsp;</a></li><?php } ?>
                                    <?php if ($google_buzz != '') { ?><li><a  title="Google Buzz" href="<?php echo $google_buzz; ?>" class="share_google_buzz" target="_blank">&nbsp;</a></li><?php } ?>
                                    <?php if ($google_bookmark != '') { ?><li><a  title="Google Bookmark" href="<?php echo $google_bookmark; ?>" class="share_google_bookmark" target="_blank">&nbsp;</a></li><?php } ?>                                                                                                                                            
                                    <?php if ($myspace != '') { ?><li><a  title="Myspace" href="<?php echo $myspace; ?>" class="share_myspace" target="_blank">&nbsp;</a></li><?php } ?>
                                    <?php if ($reddit != '') { ?><li><a  title="Reddit" href="<?php echo $reddit; ?>" class="share_reddit" target="_blank">&nbsp;</a></li><?php } ?>
                                    <?php if ($stumbleupon != '') { ?><li><a  title="Stumbleupon" href="<?php echo $stumbleupon; ?>" class="share_stumbleupon" target="_blank">&nbsp;</a></li><?php } ?>
                                    <?php if ($youtube != '') { ?><li><a  title="Youtube" href="<?php echo $youtube; ?>" class="share_youtube" target="_blank">&nbsp;</a></li><?php } ?>
                                    <?php if ($feedburner != '') { ?><li><a  title="Feedburner" href="<?php echo $feedburner; ?>" class="share_feedburner" target="_blank">&nbsp;</a></li><?php } ?>
                                    <?php if ($flickr != '') { ?><li><a  title="Flickr" href="<?php echo $flickr; ?>" class="share_flickr" target="_blank">&nbsp;</a></li><?php } ?>                                                                                                                                
                                    <?php if ($picasa != '') { ?><li><a  title="Picasa" href="<?php echo $picasa; ?>" class="share_picasa" target="_blank">&nbsp;</a></li><?php } ?>                                                                                                                                                                
                                    <?php if ($vimeo != '') { ?><li><a  title="Vimeo" href="<?php echo $vimeo; ?>" class="share_vimeo" target="_blank">&nbsp;</a></li><?php } ?>
                                    <?php if ($tumblr != '') { ?><li><a title="Tumblr"  href="<?php echo $tumblr; ?>" class="share_tumblr" target="_blank">&nbsp;</a></li><?php } ?>                                                                                                                                                                
                                </ul>                
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>   
                <?php } ?>     
                <div class="content-sec">
                    <div class="inner">
                        <!-- Page Heading Section End -->
                        <div class="clear"></div>
                        <?php
                        wp_reset_query();
                        if (is_home() || is_front_page()) {
                            
                        } else {
                            global $post, $wp_query;
                            ?>        
                            <?php if ($cs_breadcrumb <> '') { ?>
                                <div class="clear"></div>
                                <div class='breadcrumb' id="bread-crumb">
                                    <?php
                                    // if there is a parent, display the link
                                    echo '<ul>';
                                    echo '<li><a href="' . get_bloginfo('url') . '" class="txthover">';
                                    echo bloginfo('name') . '</a>';
                                    echo '</li>';
                                    echo'<li>';
                                    if (is_category() || is_single()) {
                                        $categories_event = get_the_terms($post->ID, 'event-category');
                                        $categories_album = get_the_terms($post->ID, 'course-category');
                                        if ($categories_event <> '') {
                                            $couter_comma_event = 0;
                                            foreach ($categories_event as $category) {
                                                echo '<a href="' . get_term_link($category->slug, 'event-category') . '">' . $category->name . '</a>';
                                                if ($couter_comma_event <= count($category->name)) {
                                                    echo " - ";
                                                }
                                                $couter_comma_event++;
                                            }
                                        } else if ($categories_album <> '') {
                                            $categories = $categories_album;
                                            $couter_comma_album = 0;
                                            foreach ($categories as $category) {
                                                echo '<a href="' . get_term_link($category->slug, 'course-category') . '">' . $category->name . '</a>';
                                                if ($couter_comma_album <= count($category)) {
                                                    echo " - ";
                                                }
                                                $couter_comma_album++;
                                            }
                                        } else {
                                            $categories = get_the_category();
                                            $couter_comma_default = 0;
                                            if ($categories <> '') {
                                                foreach ($categories as $category) {
                                                    echo '<a href="' . get_term_link($category->slug, $category->taxonomy) . '">' . $category->name . '</a>';
                                                    if ($couter_comma_default <= count($category->name)) {
                                                        echo " - ";
                                                    }
                                                    $couter_comma_default++;
                                                }
                                            }
                                        }
                                    }
                                    if (is_single()) {
                                        echo '</a></li><li><a class="colr">';
                                        echo the_title() . '</a></li>';
                                    } else if (is_page()) {
                                        if ($post->post_parent <> 0) {
                                            echo '<li><a href="' . get_permalink($post->post_parent) . '">' . get_the_title($post->post_parent) . '</a></li><li>';
                                        }
                                        echo the_title() . '</li>';
                                    }
                                    echo '<div class="clear"></div>';
                                    echo '</ul>';
                                    ?>
                                </div>
                                <div class="clear"></div>
                            <?php }//Breadcrumbs Condition Ends?>        
                            <?php
                            global $post_id, $post;
                            $page_id_custom = get_page($page_id);
                            if ($page_id_custom <> '') {
                                $image_id = cs_get_post_thumbnail($page_id_custom->ID, 990, 200);
                                if (is_page() and $image_id <> '') {
                                    ?>
                                    <div class="sub_banner">
                                        <?php echo $image_id; ?>
                                    </div> 
                                    <?php
                                }
                            }
                            ?>

                            <?php
                        }
                        wp_reset_query();
                        ?>
                        <div class="columns">
                        