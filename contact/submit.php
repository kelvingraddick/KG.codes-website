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

    $from = new SendGrid\Email($site_name, $setting['email_address']);
    $subject = "Thank you for contacting ".$site_name."!";
    $to = new SendGrid\Email($first_name." ".$last_name, $email_address);
    $content = new SendGrid\Content("text/plain", "Thank you for contacting ".$site_name."! We will be in contact soon!");
    $mail = new SendGrid\Mail($from, $subject, $to, $content);
    $apiKey = "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"; // getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);
    $response = $sg->client->mail()->send()->post($mail);
    echo $response->statusCode();
    echo $response->body();
    print_r($response->headers());

    //echo $site_name."<br />";
    //echo $setting['email_address']."<br />";
    //echo $first_name." ".$last_name."<br />";
    //echo $email_address."<br />";
    //echo "statusCode is: ".$response->statusCode()."<br />";
    //echo "headers are: ";
    //print_r($response->headers());
    //echo "<br />";
    //echo "body is: ".$response->body()."<br />";

    /*
    $from = new SendGrid\Email($site_name, $setting['email_address']);
    $subject = "New contact for ".$site_name."!";
    $to = new SendGrid\Email($site_name, $setting['email_address']);
    $content = new SendGrid\Content("text/plain", "New contact for ".$site_name."!");
    $mail = new SendGrid\Mail($from, $subject, $to, $content);
    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);
    $response = $sg->client->mail()->send()->post($mail);
    
    //echo $site_name."<br />";
    //echo $setting['email_address']."<br />";
    //echo $first_name." ".$last_name."<br />";
    //echo $email_address."<br />";
    //echo "statusCode is: ".$response->statusCode()."<br />";
    //echo "headers are: ";
    //print_r($response->headers());
    //echo "<br />";
    //echo "body is: ".$response->body()."<br />";
    */
    
    //header("Location: success.php");
?>