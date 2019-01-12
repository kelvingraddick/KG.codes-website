<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
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
        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '235797833452640');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=235797833452640&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code -->
	</head>
	<body>
        <div class="page_left">
            <div class="page_block" style="background-color: #eed67a;">
                <div class="page_block_title">
                    <h1>KG THE MAKER BEATS.</h1>
                </div>
                <br />
                Hi. I am KG The Maker. Beat maker. Listen to and download hip-hop / pop / R&B beats produced by me and inspired by the greats.
                <br />
                Download instantly and/or contact me directly for collaboration.
                <br /><br />
                <iframe id="mfs_html5" src="https://airbit.com/widgets/html5/?uid=1593&config=464601" class="beat_store" height="700" frameborder="0" scrolling="no"></iframe>
                <br /><br />
                <img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/kg-the-maker-beat-maker-1.jpg" style="max-height: 300px; max-width: 49%; border-radius: 5px;" />
                <img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/kg-the-maker-beat-maker-2.jpg" style="max-height: 300px; max-width: 49%; border-radius: 5px;" />
                <br /><br />
                UNLIMITED ('Unlimited' buttons)
                <br />
                • instant MP3 download / unlimited use
                <br /><br />
                EXCLUSIVE ('Exclusive' buttons)
                <br />
                • instant MP3 download / plus track-out stems / unlimited use / beat removed from store
                <br /><br />
                <img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/trust-seals.png" style="height: 150px;" />
            </div>
        </div>
        <div class="sidebar_right">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
        <script src="https://airbit.com/js/embeds/html5/gatracking.js?gatracking=UA-64813359-1"></script>
	</body>
</html>