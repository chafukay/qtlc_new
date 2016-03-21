<?php
function translation() {
	$cs_trans_events = get_option( "cs_trans_events" );
		if ( $cs_trans_events <> "" ) {
			$sxe = new SimpleXMLElement($cs_trans_events);
				$event_trans_list_view = $sxe->event_trans_list_view;
				$event_trans_calendar_view = $sxe->event_trans_calendar_view;
				$event_trans_booking_url = $sxe->event_trans_booking_url;
				$event_trans_all_day = $sxe->event_trans_all_day;
				$event_location = $sxe->event_location;
		}
		else {
				$event_trans_list_view = '';
				$event_trans_calendar_view = '';
				$event_trans_booking_url = '';
				$event_trans_all_day = '';
				$event_location = '';
		}
	$cs_trans_courses = get_option( "cs_trans_courses" );
		if ( $cs_trans_courses <> "" ) {
			$sxe = new SimpleXMLElement($cs_trans_courses);
				$course_name = $sxe->course_name;
				$course_programs = $sxe->course_programs;
				$course_eligibility = $sxe->course_eligibility;
				$course_plan = $sxe->course_plan;
				$subject_title = $sxe->subject_title;
				$course_instructor = $sxe->course_instructor;
				$credit_hours = $sxe->credit_hours;
				$course_apply = $sxe->course_apply;
		}
		else {
				$course_name = '';
				$course_programs = '';
				$course_eligibility = '';
				$course_plan = '';
				$subject_title = '';
				$course_instructor = '';
				$credit_hours = '';
				$course_apply = '';
		}
	$cs_trans_contact = get_option( "cs_trans_contact" );
		if ( $cs_trans_contact <> "" ) {
			$sxe = new SimpleXMLElement($cs_trans_contact);
				$form_title = $sxe->form_title;
				$contact_no = $sxe->contact_no;
				$message = $sxe->message;
				$captcha = $sxe->captcha;
				$refresh_captcha = $sxe->refresh_captcha;
				$name_error = $sxe->name_error;
				$email_error = $sxe->email_error;
				$contact_no_error = $sxe->contact_no_error;
				$message_error = $sxe->message_error;
				$captcha_error = $sxe->captcha_error;
		}
		else {
				$form_title = '';
				$contact_no = '';
				$message = '';
				$captcha = '';
				$refresh_captcha = '';
				$name_error = '';
				$email_error = '';
				$contact_no_error = '';
				$message_error = '';
				$captcha_error = '';
		}
	$cs_trans_others = get_option( "cs_trans_others" );
		if ( $cs_trans_others <> "" ) {
			$sxe = new SimpleXMLElement($cs_trans_others);
				$title_404 = $sxe->title_404;
				$content_404 = $sxe->content_404;
				$share_this_post = $sxe->share_this_post;
				$follow_us = $sxe->follow_us;
				$follow_us_on = $sxe->follow_us_on;
				$need_an_account = $sxe->need_an_account;
				$newsletter = $sxe->newsletter;
				$newsletter_thanks = $sxe->newsletter_thanks;
				$category_filter = $sxe->category_filter;
				$featured_post = $sxe->featured_post;
				$trans_days = $sxe->trans_days;
				$trans_hours = $sxe->trans_hours;
				$trans_minutes = $sxe->trans_minutes;
				$trans_seconds = $sxe->trans_seconds;
		}
		else {
				$title_404 = '';
				$content_404 = '';
				$share_this_post = '';
				$follow_us = '';
				$follow_us_on = '';
				$need_an_account = '';
				$newsletter = '';
				$newsletter_thanks = '';
				$category_filter = '';
				$featured_post = '';
				
				$trans_days = '';
				$trans_hours = '';
				$trans_minutes = '';
				$trans_seconds = '';
		}
?>
<div class="theme-wrap fullwidth">
	<?php include "theme_leftnav.php";?>
    <!-- Right Column Start -->
    <div class="col2 left">
		<!-- Header Start -->
        <div class="wrap-header">
            <h4 class="bold"><?php _e('Translation',CSDOMAIN)?></h4>
            <div class="clear"></div>
        </div>
        <!-- Header End -->
        <script type="text/javascript">
			function gs_tab(id){
				jQuery("#trans_tab_save"+id).hide();
				jQuery("#trans_tab_loading"+id).show('');
				jQuery.ajax({
					type:'POST', 
					url: '<?php echo get_template_directory_uri()?>/include/translation_save.php', 
					data:jQuery('#frm'+id).serialize(), 
					success: function(response) {
						//jQuery('#frm_slide').get(0).reset();
						jQuery(".form-msgs p").html(response);
						jQuery(".form-msgs").show("");
						jQuery("#trans_tab_save"+id).show('');
						jQuery("#trans_tab_loading"+id).hide();
						slideout();
						//jQuery('#frm_slide').find('.form_result').html(response);
					}
				});
			}
		jQuery().ready(function($) {
			var container = $('div.container');
			// validate the form when it is submitted
			var validator = $("#frm1").validate({
				errorContainer: container,
				errorLabelContainer: $(container),
				errorElement:'span',
				errorClass:'ele-error',				
				meta: "validate"
			});
		});
		jQuery().ready(function($) {
			var container = $('div.container');
			// validate the form when it is submitted
			var validator = $("#frm2").validate({
				errorContainer: container,
				errorLabelContainer: $(container),
				errorElement:'span',
				errorClass:'ele-error',				
				meta: "validate"
			});
		});
		jQuery().ready(function($) {
			var container = $('div.container');
			// validate the form when it is submitted
			var validator = $("#frm3").validate({
				errorContainer: container,
				errorLabelContainer: $(container),
				errorElement:'span',
				errorClass:'ele-error',				
				meta: "validate"
			});
		});
			
		</script>
        <div class="tab-section">
            <div class="tab_menu_container">
                <ul id="tab_menu">
                    <li><a href="#" class="" rel="tab-events"><span><?php _e('Events',CSDOMAIN)?></span></a></li>
                    <li><a href="#" class="" rel="tab_courses"><span><?php _e('Courses',CSDOMAIN)?></span></a></li>
                    <li><a href="#" class="" rel="tab-contact"><span><?php _e('Contact',CSDOMAIN)?></span></a></li>
                    <li><a href="#" class="" rel="tab-others"><span><?php _e('Others',CSDOMAIN)?></span></a></li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="tab_container">
                <div class="tab_container_in">
					<div class='form-msgs' style="display:none"><div class='to-notif success-box'><span class='tick'>&nbsp;</span><p></p><a class='close-it' onclick='tab_close()'>&nbsp;</a></div></div>
                    
                    <div id="tab-events" class="tab-list">
                        <form id="frm1" method="post" action="javascript:gs_tab(1)">
                            <div class="option-sec">
                                <div class="opt-head">
                                    <h6><?php _e('Events Translation',CSDOMAIN)?></h6>
                                    <p><?php _e('Events Translation',CSDOMAIN)?></p>
                                    <div id="trans_tab_loading1" class="ajax-loaders">
                                    	<img src="<?php echo get_template_directory_uri()?>/images/admin/ajax_loading.gif" />
                                    </div>
                                </div>
                                <div class="opt-conts">
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('List View',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="event_trans_list_view" value="<?php echo htmlspecialchars($event_trans_list_view)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Calendar View',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="event_trans_calendar_view" value="<?php echo htmlspecialchars($event_trans_calendar_view)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Booking Url',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="event_trans_booking_url" value="<?php echo htmlspecialchars($event_trans_booking_url)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('All Day',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="event_trans_all_day" value="<?php echo htmlspecialchars($event_trans_all_day)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Event Location',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="event_location" value="<?php echo htmlspecialchars($event_location)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements noborder">
                                        <li class="to-label"></li>
                                        <li class="to-field">
                                           	<input type="hidden" name="tab" value="tab_events" />
                                            <input id="trans_tab_save1" class="submit butnthree" type="submit" value="<?php _e('Save',CSDOMAIN)?>"/>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="tab_courses" class="tab-list">
                        <form id="frm2" method="post" action="javascript:gs_tab(2)">
                            <div class="option-sec">
                                <div class="opt-head">
                                    <h6><?php _e('Courses Translation',CSDOMAIN)?></h6>
                                    <p><?php _e('Courses Translation',CSDOMAIN)?></p>
                                    <div id="trans_tab_loading2" class="ajax-loaders">
                                    	<img src="<?php echo get_template_directory_uri()?>/images/admin/ajax_loading.gif" />
                                    </div>
                                </div>
                                <div class="opt-conts">
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Course Name',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="course_name" value="<?php echo htmlspecialchars($course_name)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Programs',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="course_programs" value="<?php echo htmlspecialchars($course_programs)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Eligibility',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="course_eligibility" value="<?php echo htmlspecialchars($course_eligibility)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Course Plan',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="course_plan" value="<?php echo htmlspecialchars($course_plan)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Subject Title',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="subject_title" value="<?php echo htmlspecialchars($subject_title)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Instructor',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="course_instructor" value="<?php echo htmlspecialchars($course_instructor)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Credit Hours',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="credit_hours" value="<?php echo htmlspecialchars($credit_hours)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Apply Now',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="course_apply" value="<?php echo htmlspecialchars($course_apply)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements noborder">
                                        <li class="to-label"></li>
                                        <li class="to-field">
                                           	<input type="hidden" name="tab" value="tab_courses" />
                                            <input id="trans_tab_save2" class="submit butnthree" type="submit" value="<?php _e('Save',CSDOMAIN)?>"/>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="tab-contact" class="tab-list"> 
                        <form id="frm3" method="post" action="javascript:gs_tab(3)">
                            <div class="option-sec">
                                <div class="opt-head">
                                    <h6><?php _e('Contact Translation',CSDOMAIN)?></h6>
                                    <p><?php _e('Contact Translation',CSDOMAIN)?></p>
                                    <div id="trans_tab_loading3" class="ajax-loaders">
                                    	<img src="<?php echo get_template_directory_uri()?>/images/admin/ajax_loading.gif" />
                                    </div>
                                </div>
                                <div class="opt-conts">
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Form Title',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="form_title" value="<?php echo htmlspecialchars($form_title)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Contact No',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="contact_no" value="<?php echo htmlspecialchars($contact_no)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Message',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="message" value="<?php echo htmlspecialchars($message)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Captcha',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="captcha" value="<?php echo htmlspecialchars($captcha)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Refresh Captcha',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="refresh_captcha" value="<?php echo htmlspecialchars($refresh_captcha)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Name (Error)',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="name_error" value="<?php echo htmlspecialchars($name_error)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Email (Error)',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="email_error" value="<?php echo htmlspecialchars($email_error)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Contact No. (Error)',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="contact_no_error" value="<?php echo htmlspecialchars($contact_no_error)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Message (Error)',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="message_error" value="<?php echo htmlspecialchars($message_error)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Captcha (Error)',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="captcha_error" value="<?php echo htmlspecialchars($captcha_error)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements noborder">
                                        <li class="to-label"></li>
                                        <li class="to-field">
                                           	<input type="hidden" name="tab" value="tab_contact" />
                                            <input id="gs_tab_save6" class="submit butnthree" type="submit" value="<?php _e('Save',CSDOMAIN)?>"/>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="tab-others" class="tab-list"> 
                        <form id="frm4" method="post" action="javascript:gs_tab(4)">
                            <div class="option-sec">
                                <div class="opt-head">
                                    <h6><?php _e('Other Translation',CSDOMAIN)?></h6>
                                    <p><?php _e('Other Translation',CSDOMAIN)?></p>
                                    <div id="trans_tab_loading3" class="ajax-loaders">
                                    	<img src="<?php echo get_template_directory_uri()?>/images/admin/ajax_loading.gif" />
                                    </div>
                                </div>
                                <div class="opt-conts">
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('404 Title',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="title_404" value="<?php echo htmlspecialchars($title_404)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('404 Content',CSDOMAIN)?></label></li>
                                        <li class="to-field"><textarea name="content_404"><?php echo $content_404?></textarea></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Share This Post',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="share_this_post" value="<?php echo htmlspecialchars($share_this_post)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Follow Us',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="follow_us" value="<?php echo htmlspecialchars($follow_us)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Follow Us on',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="follow_us_on" value="<?php echo htmlspecialchars($follow_us_on)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Need an Account?',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="need_an_account" value="<?php echo htmlspecialchars($need_an_account)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Newsletter',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="newsletter" value="<?php echo htmlspecialchars($newsletter)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Newsletter (Success)',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="newsletter_thanks" value="<?php echo htmlspecialchars($newsletter_thanks)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Category Filter',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="category_filter" value="<?php echo htmlspecialchars($category_filter)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Featured Post',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="featured_post" value="<?php echo htmlspecialchars($featured_post)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Days',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="trans_days" value="<?php echo htmlspecialchars($trans_days)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Hours',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="trans_hours" value="<?php echo htmlspecialchars($trans_hours)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Minutes',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="trans_minutes" value="<?php echo htmlspecialchars($trans_minutes)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Seconds',CSDOMAIN)?></label></li>
                                        <li class="to-field"><input type="text" name="trans_seconds" value="<?php echo htmlspecialchars($trans_seconds)?>" /></li>
                                        <li class="to-desc"><p></p></li>
                                    </ul>
                                    <ul class="form-elements noborder">
                                        <li class="to-label"></li>
                                        <li class="to-field">
                                           	<input type="hidden" name="tab" value="tab_others" />
                                            <input id="gs_tab_save6" class="submit butnthree" type="submit" value="<?php _e('Save',CSDOMAIN)?>"/>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- Right Column End -->
</div>
<?php
}
?>