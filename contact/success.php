<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
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
        <div class="page_left" style="padding: 20px;">
            <div class="page_block" style="background-color: #eed67a;">
                <div class="page_block_circle_buttons">
                    <div class="page_block_circle_button"></div>
                    <div class="page_block_circle_button"></div>
                    <div class="page_block_circle_button"></div>
                </div>
                <div class="page_block_title">
                    <h1>Contact KG.codes</h1><span class="header">.</span>
                </div>
                <br />
                Thanks for contacting KG.codes!
                <br />
                I will be in contact soon.
            </div>
        </div>
        <div class="sidebar_right">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
	</body>
</html>