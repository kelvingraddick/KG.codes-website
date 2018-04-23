<?php
    ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
    require($_SERVER['DOCUMENT_ROOT'].'/utility/sendgrid/sendgrid-php.php');

    $database_connection = connect_to_database();
    $setting = get_settings($database_connection);

    $notes = addslashes($_POST['message']);
	$first_name = addslashes($_POST['first_name']);
	$last_name = addslashes($_POST['last_name']);
	$email_address = addslashes($_POST['email_address']);
    $phone_number = addslashes($_POST['phone_number']);
    $join_email_list = $_POST['join_email_list'];

	if (!mysqli_num_rows(mysqli_query($database_connection, "SELECT email_address FROM contacts WHERE email_address = '$email_address'"))) {
		if (mysqli_query($database_connection, "INSERT INTO contacts (first_name, last_name, email_address, phone_number, notes) values('$first_name', '$last_name', '$email_address', '$phone_number', '$notes')")) {

		} else {

		}
	} else {
        $updated_time = date("Y-m-d H:i:s");
		if (mysqli_query($database_connection, "UPDATE contacts SET first_name = '$first_name', last_name = '$last_name', phone_number = '$phone_number', notes = '$notes', updated_time = '$updated_time' where email_address = '$email_address'")){ 

		} else {

		}
    }

    $email = array();
    $email['api_key'] = $sendgrid_api_key;
    $email['from_email_address'] = $setting['email_address'];
    $email['from_name'] = $site_name;
    $email['to_email_address'] = $email_address;
    $email['to_name'] = $first_name.' '.$last_name;
    $email['body'] = "Thank you for contacting ".$site_name."!";
    send_email($email);
    
    header("Location: success.php");
?>