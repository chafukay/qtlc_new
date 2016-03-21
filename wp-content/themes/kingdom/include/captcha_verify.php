<?php
//session_start();
require_once '../../../../wp-load.php';
if ( !session_id() ) add_action( 'init', 'session_start' );

	$counter_gal = $_POST['counter_gal'];
	//echo $_SESSION['aaa'.$counter_gal];
	if ( strlen($_SESSION['sess_cap'.$counter_gal]) && $_POST['key'] == $_SESSION['sess_cap'.$counter_gal] ) {
		echo "Valid";
	} else {
		echo languageswitcher('captcha_error', __("Wrong Captcha Code",CSDOMAIN));
	}
?>


