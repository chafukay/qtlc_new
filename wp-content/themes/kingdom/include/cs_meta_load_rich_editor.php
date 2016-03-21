<?php 
$cs_rich_editor_title_db = '';
$cs_rich_editor_desc_db = '';
if ( isset($cs_node->cs_rich_editor_title) ) $cs_rich_editor_title_db = $cs_node->cs_rich_editor_title;
if ( isset($cs_node->cs_rich_editor_desc) ) $cs_rich_editor_desc_db = $cs_node->cs_rich_editor_desc;
?>
<li id="sort">
    <div class="temp-tubes add_page_builder_item_show" id="">
        <span class="editor">&nbsp;</span>
            <p>
               <?php _e('Rich Editor Content Area',CSDOMAIN)?> 
            </p>
            <a href="javascript:hide_all('rich_editor')" class="options"><?php _e('Options',CSDOMAIN)?> </a>
            <br class="clear" />
        <span class="del_btn"></span>
    </div>

		<div class="poped-up" id="rich_editor" style="border:none; background:#f8f8f8;" >
			<div class="opt-head">
                <h6><?php _e('Edit Rich Editor Settings',CSDOMAIN)?></h6>
                <a href="javascript:show_all('rich_editor')" class="closeit">&nbsp;</a>
			</div>
            <div class="opt-conts">
            	<ul class="form-elements">
                    <li class="to-label">
                        <label><?php _e('Show Title',CSDOMAIN)?></label>
                    </li>
                    <li class="to-field">
                        <select name="cs_rich_editor_title" class="dropdown">
                            <option value="Yes" <?php if($cs_rich_editor_title_db=="Yes")echo "selected";?> ><?php _e('Yes',CSDOMAIN)?></option>
                            <option value="No" <?php if($cs_rich_editor_title_db=="No")echo "selected";?> ><?php _e('No',CSDOMAIN)?></option>
                        </select>
                    </li>
                    <li class="to-desc">
                        <p>
                           <?php _e('Show the title of the page',CSDOMAIN)?> 
                        </p>
                    </li>                    
                </ul>
                <ul class="form-elements">
                    <li class="to-label">
                        <label><?php _e('Show Description',CSDOMAIN)?></label>
                    </li>
                    <li class="to-field">
                        <select name="cs_rich_editor_desc" class="dropdown">
                            <option value="Yes" <?php if($cs_rich_editor_desc_db=="Yes")echo "selected";?> ><?php _e('Yes',CSDOMAIN)?></option>
                            <option value="No" <?php if($cs_rich_editor_desc_db=="No")echo "selected";?> ><?php _e('No',CSDOMAIN)?></option>
                        </select>
                    </li>
                    <li class="to-desc">
                        <p>
                            <?php _e('Show the description of the page',CSDOMAIN)?>
                        </p>
                    </li>
                </ul>
                <ul class="form-elements noborder">
                    <li class="to-label"></li>
                    <li class="to-field">
		                <input type="hidden" name="cs_orderby[]" value="rich_editor" />
                        <input type="button" value="<?php _e('Save',CSDOMAIN)?>" style="margin-right:10px;" onclick="javascript:show_all('rich_editor')" />
                    </li>
                </ul>
			</div>
		</div>

</li>
