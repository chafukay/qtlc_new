<?php
foreach ($_POST as $keys=>$values) {
	$$keys = $values;
}
?>
<li id="edit_track<?php echo $counter_track?>">
<div>
    <ul class="to-rows to-cont">
        <li class="album-title" id="album-title<?php echo $counter_track?>" ><?php echo $subject_title?></li>
        <li class="actions">
            <a onclick="javascript:return confirm('Are you sure! You want to delete this Track')" href="javascript:cs_div_remove('edit_track<?php echo $counter_track?>')" class="ac-close">&nbsp;</a>
            <a href="javascript:addtrack('edit_track_form<?php echo $counter_track?>')" class="ac-edit">&nbsp;</a>
        </li>
    </ul>  

	<div class="poped-up" id="edit_track_form<?php echo $counter_track?>">
        <div class="opt-head">
            <h6><?php _e('Edit Subject',CSDOMAIN)?></h6>
            <a href="javascript:closetrack('edit_track_form<?php echo $counter_track?>')" class="closeit">&nbsp;</a>
        </div>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Subject Title',CSDOMAIN)?></label></li>
                <li class="to-field"><input type="text" name="subject_title[]" value="<?php echo htmlspecialchars($subject_title)?>" id="subject_title<?php echo $counter_track?>" /></li>
                <li class="to-desc"><p><?php _e('Put Subject title',CSDOMAIN)?></p></li>
            </ul>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Instructor',CSDOMAIN)?></label></li>
                <li class="to-field"><input type="text" name="subject_instructor[]" value="<?php echo htmlspecialchars($subject_instructor)?>" /></li>
                <li class="to-desc"><p><?php _e('Put Instructor Name',CSDOMAIN)?></p></li>
            </ul>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Credit Hours',CSDOMAIN)?></label></li>
                <li class="to-field"><input type="text" name="subject_credit[]" value="<?php echo htmlspecialchars($subject_credit)?>" /></li>
                <li class="to-desc"><p><?php _e('Put The Total Credit Hours',CSDOMAIN)?></p></li>
            </ul>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Detail Of the Subject(Url)',CSDOMAIN)?></label></li>
                <li class="to-field"><input type="text" name="subject_detail[]" value="<?php echo htmlspecialchars($subject_detail)?>" /></li>
                <li class="to-desc"><p><?php _e('Put a Url for the detail of this subject',CSDOMAIN)?></p></li>
            </ul>
            <ul class="form-elements noborder">
                <li class="to-label"></li>
                <li class="to-field"><input type="button" value="<?php _e('Update Subject',CSDOMAIN)?>" onclick="update_title(<?php echo $counter_track?>); closetrack('edit_track_form<?php echo $counter_track?>')" /></li>
            </ul>
    </div>
</div>
</li>