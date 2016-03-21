<?php
	require_once '../../../../wp-load.php';
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = $values;
	}
		$sxe = new SimpleXMLElement("<cs_home_page_announcement></cs_home_page_announcement>");
			if ( empty($show_announcement) ) $show_announcement = "";
				$sxe->addChild('show_announcement', $show_announcement );
				$sxe->addChild('announcement_title', htmlspecialchars(stripslashes($announcement_title)) );
				$sxe->addChild('announcement_cat', $announcement_cat );
			update_option( "cs_home_page_announcement", $sxe->asXML() );
	echo __("Home Page Announcement Settings Saved",CSDOMAIN);
?>