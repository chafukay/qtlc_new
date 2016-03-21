<?php
function newsletter_manage() {
	global $wpdb;
		$show_newsletter = '';
		$show_newsletter = get_option("cs_show_newsletter");
?>
	<script>
		function frm_submit(){
			$ = jQuery;
			$("#submit_btn").hide();
			$("#loading_div").html('<img src="<?php echo get_template_directory_uri()?>/images/admin/ajax_loading.gif" />');
			$.ajax({
				type:'POST', 
				url: '<?php echo get_template_directory_uri()?>/include/newsletter_manage_save.php',
				data:$('#frm').serialize(), 
				success: function(response) {
					//$('#frm_slide').get(0).reset();
					$(".form-msgs p").html(response);
					$(".form-msgs").show("");
					$("#submit_btn").show('');
					$("#loading_div").html('');
					slideout();
					//$('#frm_slide').find('.form_result').html(response);
				}
			});
		}
	</script>
<div class="theme-wrap fullwidth">
	<?php include "theme_leftnav.php";?>
    <!-- Right Column Start -->
    <div class="col2 left">
		<!-- Header Start -->
        <div class="wrap-header">
            <h4 class="bold"><?php _e('Newsletter Management',CSDOMAIN)?></h4>            
            <div class="clear"></div>
        </div>
        <!-- Header End -->
        <!-- Content Section Start -->
    	<div class="elements-in">
			<div class='form-msgs' style="display:none"><div class='to-notif success-box'><span class='tick'>&nbsp;</span><p></p><a class='close-it' onclick='tab_close()'>&nbsp;</a></div></div>
        	<div class="option-sec">
                <div class="opt-head">
                    <h6><?php _e('Newsletter',CSDOMAIN)?></h6>
                    <p><?php _e('Switch it on if you want to show Newsletter',CSDOMAIN)?></p>
                </div>
                <div class="opt-conts">
					<form id="frm" method="post" action="javascript:frm_submit()">
                    	<ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Download Newsletter',CSDOMAIN)?></label>
                            </li>
                            <li class="to-field">
                                <a href="<?php echo get_template_directory_uri(); ?>/include/newsletter_export.php" class="button"><?php _e('Download CSV',CSDOMAIN)?></a>
                            </li>
                            <li class="to-desc">
                                <p>
                                    <?php _e('Downloaded All Newsletter Subscribers In CSV Format',CSDOMAIN)?>
                                </p>
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Show Newsletter',CSDOMAIN)?></label>
                            </li>
                            <li class="to-field">
                                <div class="on-off">
                                    <input type="checkbox" name="show_newsletter" class="styled" <?php if($show_newsletter=="on") echo "checked" ?> />
                                </div>
                            </li>
                            <li class="to-desc">
                                <p><?php _e('Switch it on if you want to show Newsletter.',CSDOMAIN)?></p>
                            </li>
                        </ul>
                        <ul class="form-elements noborder">
                            <li class="to-label">
                            </li>
                            <li class="to-field">
                                <input id="submit_btn" type="submit" value="<?php _e('Save',CSDOMAIN)?>" />
                                <div id="loading_div"></div>
                            </li>
                        </ul>
					</form>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>        
        <!-- Content Section End -->
    </div>
    <div class="clear"></div>
    <!-- Right Column End -->
</div>
<?php
}
?>