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
                Hi. I am KG The Maker. Beat maker.<br /><br />
                <div class="columns is-gapless">
                    <div class="column">
                        LEASING RIGHTS (lease buttons)<br />
                        • beat as mixed stereo MP3 / unlimited use for 1 year
                    </div>
                    <div class="column">
                        EXCLUSIVE RIGHTS (exclusive buttons)<br />
                        • beat as mixed stereo MP3 / track-out stems / unlimited use forever
                    </div>
                </div>
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
        <div class="columns is-centered">
            <div class="column is-narrow">
                <img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/trust-seals.png" style="height: 150px;" />
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
        <script src="https://airbit.com/js/embeds/html5/gatracking.js?gatracking=UA-64813359-1"></script>
	</body>
</html>