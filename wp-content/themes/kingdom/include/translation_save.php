<?php
require_once '../../../../wp-load.php';

foreach ($_REQUEST as $keys=>$values) {
	$$keys = htmlspecialchars(stripslashes($values));
}
	if ( $tab == "tab_events" ) {
		$sxe = new SimpleXMLElement("<trans_events></trans_events>");
			$sxe->addChild('event_trans_booking_url', $event_trans_booking_url );
			$sxe->addChild('event_trans_all_day', $event_trans_all_day );
			$sxe->addChild('event_trans_posted_by', $event_trans_posted_by );
			$sxe->addChild('event_trans_category_filter', $event_trans_category_filter );
		update_option( "cs_trans_events", $sxe->asXML() );
		echo __("Events Translation Saved",CSDOMAIN);
	}
	else if ( $tab == "tab_albums" ) {
		$sxe = new SimpleXMLElement("<trans_albums></trans_albums>");
			$sxe->addChild('release_date', $release_date );
			$sxe->addChild('buy_now', $buy_now );
			$sxe->addChild('lyrics', $lyrics );
			$sxe->addChild('download', $download );
			$sxe->addChild('play', $play );
			$sxe->addChild('pause', $pause );
			$sxe->addChild('amazon', $amazon );
			$sxe->addChild('itunes', $itunes );
			$sxe->addChild('grooveshark', $grooveshark );
			$sxe->addChild('soundcloud', $soundcloud );
		update_option( "cs_trans_albums", $sxe->asXML() );
		echo __("Albums Translation Saved",CSDOMAIN);
	}
	else if ( $tab == "tab_contact" ) {
		$sxe = new SimpleXMLElement("<trans_contact></trans_contact>");
			$sxe->addChild('form_title', $form_title );
			$sxe->addChild('contact_no', $contact_no );
			$sxe->addChild('message', $message );
			$sxe->addChild('captcha', $captcha );
			$sxe->addChild('refresh_captcha', $refresh_captcha );
			$sxe->addChild('name_error', $name_error );
			$sxe->addChild('email_error', $email_error );
			$sxe->addChild('contact_no_error', $contact_no_error );
			$sxe->addChild('message_error', $message_error );
			$sxe->addChild('captcha_error', $captcha_error );
		update_option( "cs_trans_contact", $sxe->asXML() );
		echo __("Contact Translation Saved",CSDOMAIN);
	}
	else if ( $tab == "tab_courses" ) {
		$sxe = new SimpleXMLElement("<trans_courses></trans_courses>");
			$sxe->addChild('course_name', $course_name );
			$sxe->addChild('course_programs', $course_programs );
			$sxe->addChild('course_eligibility', $course_eligibility );
			$sxe->addChild('course_plan', $course_plan );
			$sxe->addChild('subject_title', $subject_title );
			$sxe->addChild('course_instructor', $course_instructor );
			$sxe->addChild('credit_hours', $credit_hours );
			$sxe->addChild('course_apply', $course_apply );
		update_option( "cs_trans_courses", $sxe->asXML() );
		echo __("Courses Translation Saved",CSDOMAIN);
	}
	else if ( $tab == "tab_others" ) {
		$sxe = new SimpleXMLElement("<trans_others></trans_others>");
			$sxe->addChild('title_404', $title_404 );
			$sxe->addChild('content_404', $content_404 );
			$sxe->addChild('share_this_post', $share_this_post );
			$sxe->addChild('follow_us', $follow_us );
			$sxe->addChild('follow_us_on', $follow_us_on );
			$sxe->addChild('need_an_account', $need_an_account );
			$sxe->addChild('newsletter', $newsletter );
			$sxe->addChild('newsletter_thanks', $newsletter_thanks );
			$sxe->addChild('category_filter', $category_filter );
			$sxe->addChild('featured_post', $featured_post );
			
			$sxe->addChild('trans_days', $trans_days ); 
			$sxe->addChild('trans_hours', $trans_hours ); 
			$sxe->addChild('trans_minutes', $trans_minutes ); 
			$sxe->addChild('trans_seconds', $trans_seconds ); 
		update_option( "cs_trans_others", $sxe->asXML() );
		echo __("Others Translation Saved",CSDOMAIN);
	}

?>