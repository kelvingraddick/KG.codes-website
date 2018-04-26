<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/templates.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
    $seo = get_seo($database_connection, "contact");
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
	</head>
	<body>
		<div id="particles" class="background"></div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        <div class="about">
            <div class="container">
                Hi. I am KG The Maker.<br />
                An app/website programmer, beat maker, and blogger.
            </div>
        </div>
        <div class="container">
            <div class="columns">
                <div class="column">
                    <form id="contact_form" class="contact_form" method="post" action="submit.php">
                        <div class="contact_label">Message</div>
                        <textarea class="contact_textarea" name="message"></textarea>
                        <div class="contact_label">First Name*</div>
                        <input class="contact_textbox" type="text" name="first_name" value="" required>
                        <div class="contact_label">Last Name</div>
                        <input class="contact_textbox" type="text" name="last_name" value="">
                        <div class="contact_label">Email Address*</div>
                        <input class="contact_textbox" type="text" name="email_address" value="" required> 
                        <div class="contact_label">Phone Number</div>
                        <input class="contact_textbox" type="text" name="phone_number" value="">
                        <div class="contact_label">Join Email List?</div>
                        <input class="contact_radio" type="radio" name="join_email_list" value="0" checked="checked">&nbsp;All&nbsp;&nbsp;
                        <input class="contact_radio" type="radio" name="join_email_list" value="1">&nbsp;Blog&nbsp;&nbsp;
                        <input class="contact_radio" type="radio" name="join_email_list" value="2">&nbsp;Beats&nbsp;&nbsp;
                        <input class="contact_radio" type="radio" name="join_email_list" value="3">&nbsp;None
                        <br /><br />
                        <button class="contact_button">Submit</button>
                    </form>
                </div>
                <div class="column is-4">
                    <div class="title">BEATS</div>
                    <iframe id="mfs_html5" src="https://airbit.com/widgets/html5/?uid=1593&config=464605" class="beat_store" height="510" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
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