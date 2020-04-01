<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
    $seo = get_seo($database_connection, "appdevelopmentquestionnaire");
    $failure = isset($_GET['failure']) ? $_GET['failure'] : false;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php 
            echo get_metatags($seo, $setting); ; 
            include $_SERVER['DOCUMENT_ROOT'].'/css/main.php';
        ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
	<body>
        <div class="page_left" style="padding: 20px;">
            <div class="page_block" style="background-color: #eed67a;">
                <div class="page_block_circle_buttons">
                    <div class="page_block_circle_button"></div>
                    <div class="page_block_circle_button"></div>
                    <div class="page_block_circle_button"></div>
                </div>
                <div class="page_block_title">
                    <h1>App Development Questionnaire</h1>
                </div>
                <br />
                ✍🏾 <u>Fill out this questionnaire</u> to get started building your a iOS/Android app.
                They are basic questions about your business and what you are looking for.<br />
                Please answer these as best you can and feel free add any information that you feel helps.
                After you answer these questions, I can get a <u>quote</u> out to you immediately.
                <form id="contact_form" class="contact_form" method="post" action="submit.php">
                    <table class="contact_row">
                        <tr>
                            <td>
                                <div class="contact_label">First Name*</div>
                                <input class="contact_textbox" type="text" name="first_name" value="" required>
                            </td>
                            <td>
                                <div class="contact_label">Last Name</div>
                                <input class="contact_textbox" type="text" name="last_name" value="">
                            </td>
                        </tr>
                    </table>
                    <table class="contact_row">
                        <tr>
                            <td>
                                <div class="contact_label">Email Address*</div>
                                <input class="contact_textbox" type="text" name="email_address" value="" required> 
                            </td>
                            <td>
                                <div class="contact_label">Phone Number</div>
                                <input class="contact_textbox" type="text" name="phone_number" value="">
                            </td>
                        </tr>
                    </table>
                    <div class="contact_label">Join Email List?</div>
                    <input class="contact_radio" type="radio" name="join_email_list" value="0" checked="checked">&nbsp;Yes&nbsp;&nbsp;
                    <input class="contact_radio" type="radio" name="join_email_list" value="1">&nbsp;No&nbsp;&nbsp;
                    <br />
                    <div class="contact_label">What is the purpose of the app?</div>
                    <textarea class="contact_textarea" name="answer_1"></textarea>
                    <div class="contact_label">What are the app’s main features?</div>
                    <textarea class="contact_textarea" name="answer_2"></textarea>
                    <div class="contact_label">What screens should the app have (ex. home screen, profile screen, etc.)?</div>
                    <textarea class="contact_textarea" name="answer_3"></textarea>
                    <div class="contact_label">Who are the target users?</div>
                    <textarea class="contact_textarea" name="answer_4"></textarea>
                    <div class="contact_label">What push notifications should the app have (if any)? </div>
                    <textarea class="contact_textarea" name="answer_5"></textarea>
                    <div class="contact_label">Do you need both iOS and Android?</div>
                    <textarea class="contact_textarea" name="answer_6"></textarea>
                    <div class="contact_label">Is there a similar app out there that this app should work like and/or look like?</div>
                    <textarea class="contact_textarea" name="answer_7"></textarea>
                    <div class="contact_label">What are some of the competitor apps (if any)?</div>
                    <textarea class="contact_textarea" name="answer_8"></textarea>
                    <div class="contact_label">How will you (and/or the business) make money from the app?</div>
                    <textarea class="contact_textarea" name="answer_9"></textarea>
                    <div class="contact_label">Do you have branding/name/logo already?</div>
                    <textarea class="contact_textarea" name="answer_10"></textarea>
                    <div class="contact_label">Do you have a timeline?</div>
                    <textarea class="contact_textarea" name="answer_11"></textarea>
                    <div class="contact_label">Anything else I should know?</div>
                    <textarea class="contact_textarea" name="answer_12"></textarea>
                    <br /><br />
                    <div class="g-recaptcha" data-sitekey="6LdZ08QUAAAAAAoH7slZ0M9G1AU4lJnESinBYays"></div>
                    <br />
                    <button class="contact_button">Submit</button>
                    <?php
                        if ($failure == true) {
                            echo '<br /><br /><div style="color:red;">reCAPTCHA failed! Please fill out the reCAPTCHA form.</div>';
                        }
                    ?>
                </form>
            </div>
        </div>
        <div class="sidebar_right">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.min.js"></script>
        <script>
            $("#contact_form").validate({
                rules: {
                    first_name: {
                        required: true
                    },
                    email_address: {
                        required: true,
                        email: true
                    },
                    phone_number: {
                        digits: true
                    },
                    join_email_list: {
                        required: true
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        </script>
	</body>
</html>