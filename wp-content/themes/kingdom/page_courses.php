<div class="courses">
   
<?php 
	global $post,$page_id;
	if($cs_node->course_cat <> '0' || $cs_node->course_cat <> ''){
	$row = $wpdb->get_row("SELECT * from ".$wpdb->prefix."terms WHERE slug = '" . $cs_node->course_cat ."'" );
	$course_name = 'Course Name';

	}
    //$row = $wpdb->get_row("SELECT name from ".$wpdb->prefix."terms WHERE slug = " . $cs_blog_cat_db );
    //echo $row->name; 
	if($row <> ''){echo '<h2 class="heading">'.$row->name.'</h2>';}
	   ?>
    <div class="box-in">
    <?php
        if ( empty($_GET['page_id_all']) ) $_GET['page_id_all'] = 1;
        $count_post = 0;
		if($row <> '') {
        	$args = array( 'posts_per_page' => '-1', 'post_type' => 'courses', 'course-category' => "$row->name" ); 
		}
		else{
			$args = array( 'posts_per_page' => '-1', 'post_type' => 'courses' ); 
		}
		$custom_query = new WP_Query($args);
            while ( $custom_query->have_posts()) : $custom_query->the_post();
                $count_post++;
            endwhile;
			wp_reset_query();
            $filter_category = '';
            //if ( empty ($row_cat->name) or $row_cat->name == "" ) $row_cat->name = "";
            if ( $cs_node->course_pagination == "Single Page") $cs_node->course_per_page = -1;
            if ( isset($_GET['filter_category']) ) {
					$filter_category = $_GET['filter_category'];
				}else {
					if($row <> ''){
						$filter_category = $row->slug;
					}
				}            
            if($cs_node->course_filterable == "On"){?>	
                <div class="cat-select">
                    <ul>
                        <li><h5><?php echo languageswitcher('category_filter', 'Category Filter')?></h5></li>
                        <li>
                            <form action="" method="get">
                                <input type="hidden" name="page_id" value="<?php if (isset($_GET['page_id'])) echo $_GET['page_id']?>" />
                                <select name="filter_category" onchange="this.form.submit()">
                                    <option><?php if(isset($row->name)){echo $row->name;}?></option>
                                            <?php
                                                $categories = get_categories( array('child_of' => "$row->term_id", 'taxonomy' => 'course-category', 'hide_empty' => 0) );
                                                foreach ($categories as $category) {?>
                                    <option <?php if($filter_category==$category->cat_name) echo "selected";?> ><?php echo $category->cat_name?></option>
                                    <?php } ?>
                                </select>
                            </form>
                        </li>
                    </ul>
                </div>
				<?php } //End Condition of Filterable ?>    
						<!-- Courses Intro Start 
                    	<div class="intro">
							<?php
                                //$dd = get_page( $page_id );								
                            // getting featured image start
                                //$image_id = cs_get_post_thumbnail($dd->ID, 690, 270);
                                //if($image_id <> ''){
                                   // echo "<a class='thumb'>".$image_id."</a>";
                                //}
                            // getting featured image end
                            ?>  
                            <!--<?php //if($row <> ''){?>
                            <h2 class="colr"><?php //echo $row->name;?></h2>
                            <p>
                            	<?php //echo term_description( $row->term_id,'course-category' ); ?> 
                            </p>
                            <?php //}?>
                        </div>-->
                        <!-- Courses Intro End -->                              
                    <!-- Event List End -->  
 
                       <div class="table-sec">
                       	<ul class="table-head">
      
								<li class="id"><?php echo"Id:";	 _e('Id', CSDOMAIN);?></li>
                                <?php 
								if($course_name <> ''){ ?>
                                <li class="c-name"><?php echo $course_name;?></li>
                                <?php } ?>
                                <li class="programs"><?php  _e('Programs', CSDOMAIN); ?></li>
                                <li class="eligibility hidesmall"><?php _e('Eligibility', CSDOMAIN); ?></li>
                           
          
                            </ul>		
							<?php
							wp_reset_query();
								$args = array( 'posts_per_page' => "$cs_node->course_per_page", 'paged' => $_GET['page_id_all'], 'post_type' => 'courses', 'course-category' => "$filter_category" );
								$custom_query = new WP_Query($args);
									$counter_album_db = 0;
									while ( $custom_query->have_posts()) : $custom_query->the_post();
										$counter_album_db++;
									$cs_album = get_post_meta($post->ID, "cs_course", true);
										if ( $cs_album <> "" ) {
											$cs_xmlObject = new SimpleXMLElement($cs_album);								
										}?>
						 	<!-- Table Section Start -->
                        	<ul class="table-cont">
                            	<li class="id"><?php echo $post->ID;?></li>
                                <li class="c-name"><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></li>
                                <li class="programs">
                                <?php $categories = get_the_terms( $post->ID, 'course-category' );
									if($categories != ''){
										$couter_comma = 0;
										foreach ( $categories as $category ) {
											echo '<a href="'.get_term_link($category->slug,$category->taxonomy).'">'.$category->name.'</a>';
											$couter_comma++;
											if ( $couter_comma < count($categories) ) {
												echo ", ";
											}
										}
								}?>
                                </li>
                                <li class="eligibility hidesmall"><?php echo $cs_xmlObject->course_eligibility;?></li>
                            </ul>
                        	<!-- Table Section Close -->                            						
                            <?php endwhile;?>
						</div>
						<?php
                        $qrystr = '';
						if(cs_pagination($count_post, $cs_node->course_per_page,$qrystr) <> ''){
                        // pagination start
                            if ( $cs_node->course_pagination == "Show Pagination" and $cs_node->course_per_page > 0  ) {
                                echo "<div class='pagination'><h5>".__('Pages:',CSDOMAIN)."</h5><ul>";
                                    if ( isset($_GET['page_id']) ) $qrystr = "&page_id=".$_GET['page_id'];
                                echo cs_pagination($count_post, $cs_node->course_per_page,$qrystr);
                                echo "</ul></div>";
                            }
                        // pagination end
						}
                        ?>
	</div>
</div>