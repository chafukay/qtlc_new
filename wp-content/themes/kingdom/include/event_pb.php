<?php 
foreach ($_POST as $keys=>$values) {
	$$keys = $values;
}
	if ( isset($_POST['name']) ) {
		require_once '../../../../wp-load.php';
		global $wpdb;
			$name = $_POST['name'];
			$counter = $_POST['counter'];
			$cs_event_title_db = '';
			$cs_event_view_db = '';
			$cs_event_type_db = '';
			$cs_event_category_db = '';
			$cs_event_time_db = '';
			$cs_event_organizer_db = '';
			$cs_event_map_db = '';
			$cs_event_excerpt_db = '';
			$cs_event_filterables_db = '';
			$cs_event_pagination_db = '';
			$cs_event_per_page_db = '';
	}
	else {
		$name = ucfirst($cs_node->getName());
			$count_node++;
			$cs_event_title_db = isset($cs_node->cs_event_title) ? $cs_node->cs_event_title : '';
			$cs_event_view_db = isset($cs_node->cs_event_view) ? $cs_node->cs_event_view : '';
			$cs_event_type_db = isset($cs_node->cs_event_type) ? $cs_node->cs_event_type : '' ;
			$cs_event_category_db = isset($cs_node->cs_event_category) ? $cs_node->cs_event_category : '';
			$cs_event_time_db = isset($cs_node->cs_event_time) ? $cs_node->cs_event_time : '';
			$cs_event_organizer_db = isset($cs_node->cs_event_organizer) ? $cs_node->cs_event_organizer : '';
			$cs_event_map_db = isset($cs_node->cs_event_map) ? $cs_node->cs_event_map : '';
			$cs_event_excerpt_db = isset($cs_node->cs_event_excerpt) ? $cs_node->cs_event_excerpt : '';
			$cs_event_filterables_db = isset($cs_node->cs_event_filterables) ? $cs_node->cs_event_filterables : '';
			$cs_event_pagination_db = isset($cs_node->cs_event_pagination) ? $cs_node->cs_event_pagination : '';
			$cs_event_per_page_db = isset($cs_node->cs_event_per_page) ? $cs_node->cs_event_per_page : '';
				$counter = $post->ID.$count_node;
}
?> 
	<li id="<?php echo $name.$counter?>_sort">
    	<div class="add_page_builder_item_show temp-tubes" id="<?php echo $name.$counter?>_del">
            <span class="events">&nbsp;</span>
            <p><?php echo $name?></p>
            <a href="javascript:hide_all('<?php echo $name.$counter?>')" class="options"><?php _e('Options',CSDOMAIN)?></a>
            <a href="javascript:delete_this('<?php echo $name.$counter?>')" class="delete-it">&nbsp;</a>
            <br class="clear" />
        </div>
        
        <div class="poped-up" id="<?php echo $name.$counter?>" style="border:none; background:#f8f8f8;" >
                <div class="opt-head">
                    <h6><?php _e('Edit Event Options',CSDOMAIN)?></h6>
                    <a href="javascript:show_all('<?php echo $name.$counter?>')" class="closeit">&nbsp;</a>
                </div>
            <div class="opt-conts">
            	<ul class="form-elements">
                    <li class="to-label">
                        <label><?php _e('Event Title',CSDOMAIN)?></label>
                    </li>
                    <li class="to-field">
                        <input type="text" name="cs_event_title[]" class="txtfield" value="<?php echo htmlspecialchars($cs_event_title_db)?>" />
                    </li>
                    <li class="to-desc">
                        <p>
                            <?php _e('Event Page Title',CSDOMAIN)?>
                        </p>
                    </li>                                            
                </ul>
                <ul class="form-elements">
                    <li class="to-label">
                        <label><?php _e('View',CSDOMAIN)?></label>
                    </li>
                    <li class="to-field">
                        <select name="cs_event_view[]" class="dropdown">
                            <option value="List View" <?php if($cs_event_view_db=="List View")echo "selected";?> ><?php _e('List View',CSDOMAIN)?></option>
                            <option value="Calender View" <?php if($cs_event_view_db=="Calender View")echo "selected";?> ><?php _e('Calender View',CSDOMAIN)?></option>
                        </select>
                    </li>
                    <li class="to-desc">
                        <p>
                            <?php _e('Select layout for Listing page, calender view contain all the dates of events in calender format. List view contain all the events with title and description in list',CSDOMAIN)?>
                        </p>
                    </li>                                                                                
                </ul>
                <ul class="form-elements">
                    <li class="to-label">
                        <label><?php _e('Event Types',CSDOMAIN)?></label>
                    </li>
                    <li class="to-field">
                        <select name="cs_event_type[]" class="dropdown">
                            <option <?php if($cs_event_type_db=="All Events")echo "selected";?> ><?php _e('All Events',CSDOMAIN)?></option>
                            <option <?php if($cs_event_type_db=="Upcoming Events")echo "selected";?> ><?php _e('Upcoming Events',CSDOMAIN)?></option>
                            <option <?php if($cs_event_type_db=="Past Events")echo "selected";?> ><?php _e('Past Events',CSDOMAIN)?></option>
                        </select>
                    </li>
                    <li class="to-desc">
                        <p>
                            <?php _e('Select layout for Listing page, calender view contain all the dates of events in calender format. List view contain all the events with title and description in list',CSDOMAIN)?>
                        </p>
                    </li>                                                                                
                </ul>
                <ul class="form-elements">
                    <li class="to-label">
                        <label><?php _e('Select Category',CSDOMAIN)?></label>
                    </li>
                    <li class="to-field">
                        <select name="cs_event_category[]" class="dropdown">
                        	<option value="0"><?php _e('-- Select Category --',CSDOMAIN)?></option>
                            <?php show_all_cats('', '', $cs_event_category_db, "event-category");?>
                        </select>
                    </li>
                </ul>
                <ul class="form-elements">
                    <li class="to-label">
                        <label><?php _e('Show Time',CSDOMAIN)?></label>
                    </li>
                    <li class="to-field">
                        <select name="cs_event_time[]" class="dropdown">
                            <option value="Yes" <?php if($cs_event_time_db=="Yes")echo "selected";?> ><?php _e('Yes',CSDOMAIN)?></option>
                            <option value="No" <?php if($cs_event_time_db=="No")echo "selected";?> ><?php _e('No',CSDOMAIN)?></option>
                        </select>
                    </li>
                </ul>
                <ul class="form-elements">
                    <li class="to-label">
                        <label><?php _e('Show Organizer',CSDOMAIN)?></label>
                    </li>
                    <li class="to-field">
                        <select name="cs_event_organizer[]" class="dropdown">
                            <option value="Yes" <?php if($cs_event_organizer_db=="Yes")echo "selected";?> ><?php _e('Yes',CSDOMAIN)?></option>
                            <option value="No" <?php if($cs_event_organizer_db=="No")echo "selected";?> ><?php _e('No',CSDOMAIN)?></option>
                        </select>
                    </li>
                </ul>
                <ul class="form-elements">
                    <li class="to-label">
                        <label><?php _e('Show Map',CSDOMAIN)?></label>
                    </li>
                    <li class="to-field">
                        <select name="cs_event_map[]" class="dropdown">
                            <option value="Yes" <?php if($cs_event_map_db=="Yes")echo "selected";?> ><?php _e('Yes',CSDOMAIN)?></option>
                            <option value="No" <?php if($cs_event_map_db=="No")echo "selected";?> ><?php _e('No',CSDOMAIN)?></option>
                        </select>
                    </li>
                    <li class="to-desc">
                        <p>
                           <?php _e('Show only at List View',CSDOMAIN)?> 
                        </p>
                    </li>                                            
                </ul>
                <ul class="form-elements">
                    <li class="to-label">
                        <label><?php _e('Length of Excerpt',CSDOMAIN)?></label>
                    </li>
                    <li class="to-field">
                        <input type="text" name="cs_event_excerpt[]" class="txtfield" value="<?php if($cs_event_excerpt_db=="")echo "255"; else echo $cs_event_excerpt_db;?>" />
                    </li>
                    <li class="to-desc">
                        <p>
                            <?php _e('Enter number of character for short description text',CSDOMAIN)?>
                        </p>
                    </li>                                        
                </ul>
                <ul class="form-elements">
                    <li class="to-label">
                        <label><?php _e('Filterable',CSDOMAIN)?></label>
                    </li>
                    <li class="to-field">
                        <select name="cs_event_filterables[]" class="dropdown" >
                            <option value="No" <?php if($cs_event_filterables_db=="No")echo "selected";?> ><?php _e('No',CSDOMAIN)?></option>
                            <option value="Yes" <?php if($cs_event_filterables_db=="Yes")echo "selected";?> ><?php _e('Yes',CSDOMAIN)?></option>
                        </select>
                    </li>
                </ul>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Pagination',CSDOMAIN)?></label>
                            </li>
                            <li class="to-field">
                                <select name="cs_event_pagination[]" class="dropdown" onchange="cs_toggle_tog('cs_event_per_page<?php echo $name.$counter?>')" >
                                    <option <?php if($cs_event_pagination_db=="Show Pagination")echo "selected";?> ><?php _e('Show Pagination',CSDOMAIN)?></option>
                                    <option <?php if($cs_event_pagination_db=="Single Page")echo "selected";?> ><?php _e('Single Page',CSDOMAIN)?></option>
                                </select>
                            </li>
                            <li class="to-desc">
                                <p>
                                    <?php _e('Show navigation only at List View',CSDOMAIN)?>
                                </p>
                            </li>                                            
                        </ul>
                        <ul class="form-elements <?php if($cs_event_pagination_db=="Single Page")echo 'no-display';?>" id="cs_event_per_page<?php echo $name.$counter?>">
                            <li class="to-label">
                                <label><?php _e('No. of Events Per Page',CSDOMAIN)?></label>
                            </li>
                            <li class="to-field">
                                <input type="text" name="cs_event_per_page[]" class="txtfield" value="<?php if($cs_event_per_page_db=="")echo "5"; else echo $cs_event_per_page_db;?>" />
                            </li>
                            <li class="to-desc">
                                <p>
                                    <?php _e('Show number of events on per page only at List View',CSDOMAIN)?>
                                </p>
                            </li>                                            
                        </ul>
                <ul class="form-elements noborder">
                    <li class="to-label"></li>
                    <li class="to-field">
                    	<input type="hidden" name="cs_orderby[]" value="event" />
                        <input type="button" value="<?php _e('Save',CSDOMAIN)?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name.$counter?>')" />
                    </li>
                </ul>
            </div>
       </div>
    </li>