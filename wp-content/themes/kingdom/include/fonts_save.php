<?php
	require_once '../../../../wp-load.php';
	foreach ($_POST as $keys=>$values) {
		$$keys = $values;
	}
		update_option( "cs_font_settings", $_POST );
	echo __("Fonts Settings Saved",CSDOMAIN);
?>

