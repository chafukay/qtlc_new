<?php
	if ( empty($cs_xmlObject->cs_layout) ) $cs_xmlObject = new stdClass();
	if ( empty($cs_xmlObject->cs_layout) ) $cs_xmlObject->cs_layout = "";
	if ( empty($cs_xmlObject->cs_sidebar_left) ) $cs_xmlObject->cs_sidebar_left = "";
	if ( empty($cs_xmlObject->cs_sidebar_right) ) $cs_xmlObject->cs_sidebar_right = "";
	
	$counter = isset($counter) ? $counter : 0;
?>
    <div class="option-sec row">
        <div class="opt-head">
            <h6><?php _e('Select Layout',CSDOMAIN)?></h6>
        </div>
        <div class="opt-conts">
            <div class="meta-input">
                <div class='radio-image-wrapper'>
                    <input <?php if($cs_xmlObject->cs_layout=="none")echo "checked"?> onclick="show_sidebar('none')" type="radio" name="cs_layout" class="radio" value="none" id="radio_1" />
                    <label for="radio_1">
                        <span class="ss"><img src="<?php echo get_template_directory_uri()?>/images/admin/1.png" /></span>
                        <span <?php if($cs_xmlObject->cs_layout=="none")echo "class='check-list'"?> id="check-list"><img src="<?php echo get_template_directory_uri()?>/images/admin/1-hover.png" /></span>
                    </label>
                </div>
                <div class='radio-image-wrapper'>
                    <input <?php if($cs_xmlObject->cs_layout=="right")echo "checked"?> onclick="show_sidebar('right')" type="radio" name="cs_layout" class="radio" value="right" id="radio_2"  />
                    <label for="radio_2">
                        <span class="ss"><img src="<?php echo get_template_directory_uri()?>/images/admin/2.png" /></span>
                        <span <?php if($cs_xmlObject->cs_layout=="right")echo "class='check-list'"?> id="check-list"><img src="<?php echo get_template_directory_uri()?>/images/admin/2-hover.png" /></span>
                    </label>
                </div>
                <div class='radio-image-wrapper'>
                    <input <?php if($cs_xmlObject->cs_layout=="left")echo "checked"?> onclick="show_sidebar('left')" type="radio" name="cs_layout" class="radio" value="left" id="radio_3" />
                    <label for="radio_3">
                        <span class="ss"><img src="<?php echo get_template_directory_uri()?>/images/admin/3.png" /></span>
                        <span <?php if($cs_xmlObject->cs_layout=="left")echo "class='check-list'"?> id="check-list"><img src="<?php echo get_template_directory_uri()?>/images/admin/3-hover.png" /></span>
                    </label>
                </div>
                <div class='radio-image-wrapper'>
                    <input <?php if($cs_xmlObject->cs_layout=="both_right")echo "checked"?> onclick="show_sidebar('both')" type="radio" name="cs_layout" class="radio" value="both_right" id="radio_4" />
                    <label for="radio_4">
                        <span class="ss"><img src="<?php echo get_template_directory_uri()?>/images/admin/4.png" /></span>
                        <span <?php if($cs_xmlObject->cs_layout=="both_right")echo "class='check-list'"?> id="check-list"><img src="<?php echo get_template_directory_uri()?>/images/admin/4-hover.png" /></span>
                    </label>
                </div>
                <div class='radio-image-wrapper'>
                    <input <?php if($cs_xmlObject->cs_layout=="both_left")echo "checked"?> onclick="show_sidebar('both')" type="radio" name="cs_layout" class="radio" value="both_left" id="radio_5" />
                    <label for="radio_5">
                        <span class="ss"><img src="<?php echo get_template_directory_uri()?>/images/admin/5.png" /></span>
                        <span <?php if($cs_xmlObject->cs_layout=="both_left")echo "class='check-list'"?> id="check-list"><img src="<?php echo get_template_directory_uri()?>/images/admin/5-hover.png" /></span>
                    </label>
                </div>
                <div class='radio-image-wrapper'>
                    <input <?php if($cs_xmlObject->cs_layout=="both")echo "checked"?> onclick="show_sidebar('both')" type="radio" name="cs_layout" class="radio" value="both" id="radio_6" />
                    <label for="radio_6">
                        <span class="ss"><img src="<?php echo get_template_directory_uri()?>/images/admin/6.png" /></span>
                        <span <?php if($cs_xmlObject->cs_layout=="both")echo "class='check-list'"?> id="check-list"><img src="<?php echo get_template_directory_uri()?>/images/admin/6-hover.png" /></span>
                    </label>
                </div>
            </div>
            <ul class="form-elements meta-body" style="border-top:#C4C4C4 solid 1px; border-bottom:0; <?php if($cs_xmlObject->cs_sidebar_left == ""){echo "display:none";}else echo "display:block";?>" id="sidebar_left" >
                <li class="to-label">
                    <label><?php _e('Select Left Sidebar',CSDOMAIN)?></label>
                </li>
                <li class="to-field">
                    <select name="cs_sidebar_left" class="select_dropdown" id="page-option-choose-left-sidebar">
                        <?php
                        $parts = explode( "<name>", get_option("cs_sidebar") );
                        foreach ( $parts as $val ) {
                            if ( $val <> "" ) {
                                $counter++;
                        ?>
                                <option <?php if($cs_xmlObject->cs_sidebar_left==$val){echo "selected";}?> ><?php echo $val;?></option>
                        <?php 
                            }
                        }
                        ?>
                    </select>
                </li>
            </ul>
            <ul class="form-elements meta-body" style="border-top:#C4C4C4 solid 1px; border-bottom:0; <?php if($cs_xmlObject->cs_sidebar_right == ""){echo "display:none";}else echo "display:block";?>" id="sidebar_right" >
                <li class="to-label">
                    <label><?php _e('Select Right Sidebar',CSDOMAIN)?></label>
                </li>
                <li class="to-field">
                    <select name="cs_sidebar_right" class="select_dropdown" id="page-option-choose-right-sidebar">
                        <?php
                        $parts = explode( "<name>", get_option("cs_sidebar") );
                        foreach ( $parts as $val ) {
                            if ( $val <> "" ) {
                                $counter++;
                        ?>
                                <option <?php if($cs_xmlObject->cs_sidebar_right==$val){echo "selected";}?> ><?php echo $val;?></option>
                        <?php 
                            }
                        }
                        ?>
                    </select>
                </li>
            </ul>
        </div>
    </div>
<div class="clear"></div>