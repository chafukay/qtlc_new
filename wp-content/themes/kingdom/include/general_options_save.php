<?php
require_once '../../../../wp-load.php';
global $wpdb;
foreach ($_REQUEST as $keys=>$values) {
	$$keys = $values;
}	
	if ( $tab == "color_style" ) {
		$sxe = new SimpleXMLElement("<cs_gs_color_style></cs_gs_color_style>");
			$sxe->addChild('cs_style_sheet', $cs_style_sheet );
			$sxe->addChild('cs_color_scheme', $cs_color_scheme );
			$sxe->addChild('cs_bg', $cs_bg );
			$sxe->addChild('cs_bg_position', $cs_bg_position );
			$sxe->addChild('cs_bg_repeat', $cs_bg_repeat );
			$sxe->addChild('cs_bg_attach', $cs_bg_attach );
			$sxe->addChild('cs_bg_pattern', $cs_bg_pattern );
			$sxe->addChild('custome_pattern', $custome_pattern );
			$sxe->addChild('cs_bg_color', $cs_bg_color );
		update_option( "cs_gs_color_style", $sxe->asXML() );
		echo __("Color and Styles Saved",CSDOMAIN);
	}
	else if ( $tab == "logo" ) {
		$sxe = new SimpleXMLElement("<cs_gs_logo></cs_gs_logo>");
			$sxe->addChild('cs_logo', $cs_logo );
			$sxe->addChild('cs_width', $cs_width );
			$sxe->addChild('cs_height', $cs_height );
		update_option( "cs_gs_logo", $sxe->asXML() );
		echo __("Logo Settings Saved",CSDOMAIN);
	}
	else if ( $tab == "header_script" ) {
		$sxe = new SimpleXMLElement("<cs_gs_header_script></cs_gs_header_script>");
			$sxe->addChild('cs_fav_icon', $cs_fav_icon );
			$sxe->addChild('cs_header_code', htmlspecialchars(stripslashes($cs_header_code)) );
			$sxe->addChild('header_phone', htmlspecialchars(stripslashes($header_phone)) );
		update_option( "cs_gs_header_script", $sxe->asXML() );
		echo __("Header Script Saved",CSDOMAIN);
	}
	else if ( $tab == "footer_settings" ) {
		$sxe = new SimpleXMLElement("<cs_gs_footer_settings></cs_gs_footer_settings>");
			$sxe->addChild('cs_copyright', htmlspecialchars(stripslashes($cs_copyright)) );
			$sxe->addChild('cs_powered_by', htmlspecialchars(stripslashes($cs_powered_by)) );
			$sxe->addChild('cs_powered_icon', $cs_powered_icon );
			$sxe->addChild('cs_analytics', htmlspecialchars(stripslashes($cs_analytics)) );
		update_option( "cs_gs_footer_settings", $sxe->asXML() );
		echo __("Footer Settings Saved",CSDOMAIN);
	}
	else if ( $tab == "captcha" ) {
		$sxe = new SimpleXMLElement("<cs_gs_captcha></cs_gs_captcha>");
			if ( empty($captcha) ) $captcha = '';
				$sxe->addChild('captcha', $captcha );
		update_option( "cs_gs_captcha", $sxe->asXML() );
		echo __("Captcha Settings Saved",CSDOMAIN);
	}
	else if ( $tab == "tab_others" ) {
		$sxe = new SimpleXMLElement("<cs_gs_others></cs_gs_others>");
			if ( empty($cs_responsive) ) $cs_responsive = '';
			if ( empty($cs_breadcrumb) ) $cs_breadcrumb = '';
			if ( empty($theme_rtl) ) $theme_rtl = '';
			if ( empty($color_picker) ) $color_picker = '';
			if ( empty($translation_switcher) ) $translation_switcher = '';
				$sxe->addChild('responsive', $cs_responsive );
				$sxe->addChild('breadcrumb', $cs_breadcrumb );
				$sxe->addChild('theme_rtl', $theme_rtl );
				$sxe->addChild('color_picker', $color_picker );
				$sxe->addChild('translation_switcher', $translation_switcher );			
		update_option( "cs_gs_others", $sxe->asXML() );		
		echo __("Other Settings Saved",CSDOMAIN);		 
	}
?>