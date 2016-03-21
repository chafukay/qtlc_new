<?php
	require_once '../../../../wp-load.php';
	global $wpdb;
	$_POST['newsletter_email'] = trim( $_POST['newsletter_email'] );
	$row = $wpdb->get_row("SELECT email from ".$wpdb->prefix."cs_newsletter where email = '" . $_POST['newsletter_email'] . "'" );

		$email_check = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$";
		
		if ( $_POST['newsletter_email'] == "" ) {
			echo "Empty Email Field";
		}
                else if (!filter_var($_POST['newsletter_email'], FILTER_VALIDATE_EMAIL)) {
		//else if ( !preg_match('/'.$email_check.'/i', $_POST['newsletter_email'] ) ) {
			echo languageswitcher('email_error', "Invalid Email Address");
		}
		else if ( $wpdb->num_rows > 0 ) {
			if ( $row->email == $_POST['newsletter_email'] ) {
				echo languageswitcher('email_error', "This Email Already Exist");
			}
		}
		else {
			$wpdb->insert( $wpdb->prefix.'cs_newsletter', 
					array( 
						'email' => $_POST['newsletter_email'],
						'ip' => $_SERVER['REMOTE_ADDR'],
						'date_time' => gmdate("Y-m-d H:i:s")
					)
			);
			echo languageswitcher('newsletter_thanks', "Thanks for your subscription");
		}
?>