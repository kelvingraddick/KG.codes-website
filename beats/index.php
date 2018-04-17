<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/templates.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
    $seo = get_seo($database_connection, "beats");
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
                An app/website programmer, beat maker, and blogger.<br />
                LEASING RIGHTS (lease button)<br />
                • beat as mixed stereo mp3 / can be used for one project / beat can still be sold here <br />
                EXCLUSIVE RIGHTS (buy button)<br />
                • beat as mixed stereo mp3 / unlimited use / beat can no longer be sold here
            </div>
        </div>
        <div class="container">
            <div class="columns">
                <div class="column">
                    <div class="title">BEATS</div>
                    <iframe id="mfs_html5" src="https://airbit.com/widgets/html5/?uid=1593&config=464601" class="beat_store" height="700" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
        <script src="https://airbit.com/js/embeds/html5/gatracking.js?gatracking=UA-64813359-1"></script>
	</body>
</html>