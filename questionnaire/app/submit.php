<?php
    ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/email.php';

    $database_connection = connect_to_database();
    $setting = get_settings($database_connection);

	$first_name = addslashes($_POST['first_name']);
	$last_name = addslashes($_POST['last_name']);
	$email_address = addslashes($_POST['email_address']);
    $phone_number = addslashes($_POST['phone_number']);
    $join_email_list = $_POST['join_email_list'];
    $answer_1 = addslashes($_POST['answer_1']);
    $answer_2 = addslashes($_POST['answer_2']);
    $answer_3 = addslashes($_POST['answer_3']);
    $answer_4 = addslashes($_POST['answer_4']);
    $answer_5 = addslashes($_POST['answer_5']);
    $answer_6 = addslashes($_POST['answer_6']);
    $answer_7 = addslashes($_POST['answer_7']);
    $answer_8 = addslashes($_POST['answer_8']);
    $answer_9 = addslashes($_POST['answer_9']);
    $answer_10 = addslashes($_POST['answer_10']);
    $answer_11 = addslashes($_POST['answer_11']);
    $answer_12 = addslashes($_POST['answer_12']);
    $recaptcha_response = $_POST['g-recaptcha-response'];

    $questions = array();
    $questions[1] = 'What is the purpose of the app?';
    $questions[2] = 'What are the app’s main features?';
    $questions[3] = 'What screens should the app have (ex. home screen, profile screen, etc.)?';
    $questions[4] = 'Who are the target users?';
    $questions[5] = 'What push notifications should the app have (if any)? ';
    $questions[6] = 'Do you need both iOS and Android?';
    $questions[7] = 'Is there a similar app out there that this app should work like and/or look like?';
    $questions[8] = 'What are some of the competitor apps (if any)?';
    $questions[9] = 'How will you (and/or the business) make money from the app?';
    $questions[10] = 'Do you have branding/name/logo already?';
    $questions[11] = 'Do you have a timeline?';
    $questions[12] = 'Anything else I should know?';

    $answers = '
    '.$questions[1].': '.$answer_1.'<br />
    '.$questions[2].': '.$answer_2.'<br />
    '.$questions[3].': '.$answer_3.'<br />
    '.$questions[4].': '.$answer_4.'<br />
    '.$questions[5].': '.$answer_5.'<br />
    '.$questions[6].': '.$answer_6.'<br />
    '.$questions[7].': '.$answer_7.'<br />
    '.$questions[8].': '.$answer_8.'<br />
    '.$questions[9].': '.$answer_9.'<br />
    '.$questions[10].': '.$answer_10.'<br />
    '.$questions[11].': '.$answer_11.'<br />
    '.$questions[12].': '.$answer_12.'<br />';

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
    if ($captcha_success -> success == false) {
		header("Location: index.php?failure=true");
	} else if ($captcha_success -> success == true) {
        if (!mysqli_num_rows(mysqli_query($database_connection, "SELECT email_address FROM contacts WHERE email_address = '$email_address'"))) {
            if (mysqli_query($database_connection, "INSERT INTO contacts (first_name, last_name, email_address, phone_number, notes) values('$first_name', '$last_name', '$email_address', '$phone_number', '$answers')")) {

            } else {

            }
        } else {
            $updated_time = date("Y-m-d H:i:s");
            if (mysqli_query($database_connection, "UPDATE contacts SET first_name = '$first_name', last_name = '$last_name', phone_number = '$phone_number', notes = '$answers', updated_time = '$updated_time' where email_address = '$email_address'")){ 

            } else {

            }
        }

        $email = array();
        $email['recipient_email_address'] = $email_address;
        $email['recipient_name'] = $first_name.' '.$last_name;
        $email['subject'] = "Thank you for contacting ".$site_name."!";
        $content = '
            Thank you for contacting '.$site_name.'!<br>
            I will be in touch soon to follow up on your questionnaire answers and to get you a quote!
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
            Email Address: '.$email_address.'<br>
            Phone Number: '.$phone_number.'<br>
            Joined Email List?: '.$join_email_list.'<br>
            '.$answers.'
            <br><br>
        ';
        $email['body'] = get_email_template($content, $setting);
        send_email($email);
        
        header("Location: success.php");
    }
?>