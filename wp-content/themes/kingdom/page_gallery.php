<div class="clear"></div>
<div class="gallery-page">
    <div class="box-in">
    <!--<h2 class="heading"><?php //echo get_the_title("$cs_gal_album_db");   ?></h2>-->
        <?php
        // galery slug to id start
        $args = array(
            'name' => (string) $cs_gal_album_db,
            'post_type' => 'cs_gallery',
            'post_status' => 'publish',
            'showposts' => 1,
        );
        $get_posts = get_posts($args);
        if ($get_posts) {
            $cs_gal_album_db = $get_posts[0]->ID;
        }
        // galery slug to id end	
        $cs_meta_gallery_options = get_post_meta((int) $cs_gal_album_db, "cs_meta_gallery_options", true);
        if (empty($_GET['page_id_all']))
            $_GET['page_id_all'] = 1;
        // pagination start
        if ($cs_meta_gallery_options <> "") {
            $cs_xmlObject = new SimpleXMLElement($cs_meta_gallery_options);
            if ($cs_gal_pagination_db == "Show Pagination" and $cs_gal_media_per_page_db > 0) {
                $limit_start = $cs_gal_media_per_page_db * ($_GET['page_id_all'] - 1);
                $limit_end = $limit_start + $cs_gal_media_per_page_db;
                if ($limit_end > count($cs_xmlObject))
                    $limit_end = count($cs_xmlObject);
            }
            else {
                $limit_start = 0;
                $limit_end = count($cs_xmlObject);
            }
        }
        // pagination end
        lightbox_enqueue_style_scripts();
        ?>
        <!-- Gallery Grid End -->
        <ul class="gallery-grid <?php echo $cs_gal_layout_db ?> light-box">
            <?php
            $path = '';
            $title = '';
            $description = '';
            $social_network = '';
            $use_image_as = '';
            $video_code = '';
            if ($cs_meta_gallery_options <> "") {
                //foreach ( $cs_xmlObject->children() as $cs_node ) {
                for ($i = $limit_start; $i < $limit_end; $i++) {
                    $path = isset($cs_xmlObject->gallery[$i]->path) ? $cs_xmlObject->gallery[$i]->path : '';
                    $title = isset($cs_xmlObject->gallery[$i]->title) ? $cs_xmlObject->gallery[$i]->title : '';
                    $description = isset($cs_xmlObject->gallery[$i]->description) ? $cs_xmlObject->gallery[$i]->description : '';
                    $social_network = isset($cs_xmlObject->gallery[$i]->social_network) ? $cs_xmlObject->gallery[$i]->social_network : '';
                    $use_image_as = isset($cs_xmlObject->gallery[$i]->use_image_as) ? $cs_xmlObject->gallery[$i]->use_image_as : '';
                    $video_code = isset($cs_xmlObject->gallery[$i]->video_code) ? $cs_xmlObject->gallery[$i]->video_code : '';
                    //$image_url = wp_get_attachment_image_src($path, array(438,288),false);
                    $image_url = cs_attachment_image_src($path, 468, 288);
                    //$image_url_full = wp_get_attachment_image_src($path, 'full',false);
                    $image_url_full = cs_attachment_image_src($path, 0, 0);
                    ?>                                
                    <?php
                    if ($cs_gal_title_db == "On") {
                        $title = $title;
                    } else {
                        $title = '';
                    }
                    ?>
                    <li class="item">
                        <a href="<?php
                        if ($use_image_as == 1)
                            echo $video_code;
                        else
                            echo $image_url_full;
                        ?>" rel="<?php
                           if ($use_image_as == 1)
                               echo "prettyPhoto";
                           else
                               echo "prettyPhoto[gallery1]"
                               ?>" title="<?php if ($cs_gal_desc_db == "On") echo $description; ?>" class="lightbtn thumb" >
                           <?php echo "<img src='" . $image_url . "' alt='" . $title . "' />" ?>
                           <?php
                           if ($cs_gal_layout_db == 'cs_gal_2_column') {
                               if ($cs_gal_title_db == "On" or $cs_gal_desc_db == "On") {
                                   ?>
                                    <div class="gal-caption">
                                        <h3 class="colr">
                                            <?php
                                            if ($cs_gal_title_db == "On") {
                                                echo substr($title, 0, 30);
                                                if (strlen($title) > 30)
                                                    echo " ...";
                                            }
                                            ?>
                                        </h3>
                                        <p>
                                            <?php
                                            if ($cs_gal_desc_db == "On") {
                                                echo substr($description, 0, 70);
                                                if (strlen($description) > 70)
                                                    echo " ...";
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </a>
                    </li>                          
                    <?php
                }
            }
            ?>
        </ul>
        <div class="clear"></div>    
        <?php
        $qrystr = '';
        if (cs_pagination(count($cs_xmlObject), $cs_gal_media_per_page_db, $qrystr)) {
            if ($cs_gal_pagination_db == "Show Pagination" and $cs_gal_media_per_page_db > 0) {
                echo "<div class='pagination'><h5>" . __('Pages:', CSDOMAIN) . "</h5><ul>";
                $qrystr = '';
                if (isset($_GET['page_id']))
                    $qrystr = "&page_id=" . $_GET['page_id'];
                echo cs_pagination(count($cs_xmlObject), $cs_gal_media_per_page_db, $qrystr);
                echo "</ul></div>";
            }
        }
        ?>
    </div>
</div>