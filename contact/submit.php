<?php
    ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/email.php';

    $database_connection = connect_to_database();
    $setting = get_settings($database_connection);

    $notes = addslashes($_POST['message']);
	$first_name = addslashes($_POST['first_name']);
	$last_name = addslashes($_POST['last_name']);
	$email_address = addslashes($_POST['email_address']);
    $phone_number = addslashes($_POST['phone_number']);
    $join_email_list = $_POST['join_email_list'];
    $recaptcha_response = $_POST['g-recaptcha-response'];

    $url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => $recaptcha_secret_key,
		'response' => $_POST["g-recaptcha-response"]
	);
	$options = array(
		'http' => array (
			'method' => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
    $captcha_success = json_decode($verify);
    if ($first_name == $last_name) {
        header("Location: index.php?failure=true");
    } else if ($captcha_success -> success == false) {
		header("Location: index.php?failure=true");
	} else if ($captcha_success -> success == true) {
        if (!mysqli_num_rows(mysqli_query($database_connection, "SELECT email_address FROM contacts WHERE email_address = '$email_address'"))) {
            $query = mysqli_prepare($database_connection, "INSERT INTO contacts (first_name, last_name, email_address, phone_number, notes) values(?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($query, 'sssss', $first_name, $last_name, $email_address, $phone_number, $notes);
            if (mysqli_stmt_execute($query)) {

            } else {

            }
        } else {
            $updated_time = date("Y-m-d H:i:s");
            $query = mysqli_prepare($database_connection, "UPDATE contacts SET first_name = ?, last_name = ?, phone_number = ?, notes = ?, updated_time = ? where email_address = ?");
            mysqli_stmt_bind_param($query, 'ssssss', $first_name, $last_name, $phone_number, $notes, $updated_time, $email_address);
            if (mysqli_stmt_execute($query)) {

            } else {

            }
        }

        $email = array();
        $email['recipient_email_address'] = $email_address;
        $email['recipient_name'] = $first_name.' '.$last_name;
        $email['subject'] = "Thank you for contacting ".$site_name."!";
        $content = '
            Thank you for contacting '.$site_name.'!<br>
            I will be in touch soon to follow up on your inquiry!
            <br><br>
            In the meantime, feel free to connect with me faster using one of the social buttons below.
            <br><br>
            - KG.codes
            <br><br>
        ';
        $email['body'] = get_email_template($content, $setting);
        send_email($email);

        $email['recipient_email_address'] = $setting['email_address'];
        $email['recipient_name'] = $setting['contact_name'];
        $email['subject'] = $site_name.": You have a new inquiry from ".$first_name." ".$last_name."!";
        $content =
            $site_name.': You have a new inquiry from '.$first_name.' '.$last_name.'!<br>
            Notes: '.$notes.'<br>
            Email Address: '.$email_address.'<br>
            Phone Number: '.$phone_number.'<br>
            Joined Email List?: '.$join_email_list.'<br>
            <br><br>
        ';
        $email['body'] = get_email_template($content, $setting);
        send_email($email);
        
        header("Location: success.php");
    }
?>