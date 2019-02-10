<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
    $seo = get_seo($database_connection, "contact");
    $colors = array('eed67a', 'ee7a92', '7a92ee', '7accee');
    shuffle($colors);
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
	<body style="background-color: #<?php echo array_pop($colors); ?>;">
        <div class="page_left">
            <div class="page_block">
                <div class="page_block_title">
                    <h1>CONTACT KG THE MAKER</h1><span class="header">.</span>
                </div>
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