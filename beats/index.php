<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
    $seo = get_seo($database_connection, "beats");
    $from = isset($_GET['from']) ? $_GET['from'] : 0;
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
        <div class="page_left" style="padding: 20px;">
            <div class="page_block" style="background-color: #eed67a;">
                <div class="page_block_circle_buttons">
                    <div class="page_block_circle_button"></div>
                    <div class="page_block_circle_button"></div>
                    <div class="page_block_circle_button"></div>
                </div>
                <div class="page_block_title">
                    <h1>KG.codes Beats</h1><span class="header">.</span>
                </div>
                <br />
                Hi. I am KG codes. Beat maker. Listen to and download hip-hop / pop / R&B beats produced by me and inspired by the greats.
                <br />
                Download for free instantly and/or contact me directly for collaboration. Let me know if you use a beat; I want to hear the result!
                <br /><br />
                <iframe id="mfs_html5" src="https://airbit.com/widgets/html5/?uid=1593&config=464601" class="beat_store" height="700" frameborder="0" scrolling="no"></iframe>
                <br /><br />
                <img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/kg-the-maker-beat-maker-1.jpg" alt="KG.codes music producer" style="max-height: 300px; max-width: 49%; border-radius: 5px;" />
                <img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/kg-the-maker-beat-maker-2.jpg" alt="KG.codes music producer" style="max-height: 300px; max-width: 49%; border-radius: 5px;" />
                <br /><br />
                <h2>For a limited time, FREE download for all beats</h2>
                <!--UNLIMITED ('Unlimited' buttons)-->
                <br />
                • instant MP3 download / unlimited use
                <br /><br />
                <h2>Buy EXCLUSIVELY with the 'Exclusive' buttons</h2>
                <br />
                • instant MP3 download / plus track-out stems / unlimited use / beat removed from store
                <br /><br />
                <img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/trust-seals.png" alt="trust seals" style="height: 150px;" />
                <br /><br />
                <?php
                    $latest_beats_query = "SELECT * FROM products WHERE is_published = 1 ORDER BY created_time DESC LIMIT 10 OFFSET $from";
                    $results = mysqli_query($database_connection, $latest_beats_query) or die(mysql_error());
                    while ($beat = mysqli_fetch_array( $results, MYSQLI_ASSOC )) { 
                        $beat_url = 'https://'.$_SERVER['SERVER_NAME'].'/beats/'.$beat['slug'];
                        echo 
                        '<div class="post_block_title">
                            <a href="'.$beat_url.'">
                                <h2>'.$beat['title'].'</h2>
                            </a>
                        </div>
                        <div class="post_sub_title">
                            $'.$beat['sale_price'].' &middot;
                            <i class="fab fa-facebook full_post_social_icon" onclick="shareUrlToFacebook(this, \''.$beat_url.'\');"></i> &nbsp;
                            <a href="https://twitter.com/intent/tweet?text='.urlencode($beat['title']).'&url='.$beat_url.'&via=KGcodes" target="_blank"><i class="fab fa-twitter full_post_social_icon"></i></a> &nbsp;
                            <a href="https://www.pinterest.com/pin/create/button/?url='.$beat_url.'&media='.$beat['tall_image_url'].'&description='.urlencode($beat['title']).'" target="_blank" data-pin-do="buttonPin" data-pin-config="above">
                                <i class="fab fa-pinterest full_post_social_icon"></i>
                            </a>
                        </div>
                        <div class="post_body">
                            <iframe src="https://airbit.com/widgets/solo/?b='.$beat['code'].'" height="160" frameborder="0" style="width: 100%;"></iframe>
                            <br /><br />
                            '.$beat['long_description'].'
                        </div>';
                    }
                ?>
                <?php
                    if (mysqli_num_rows(mysqli_query($database_connection, $latest_beats_query))) {
                        echo '<div class="next_button"><a href="/beats?from='.($from + 10).'" rel="next">PREVIOUS BEATS <i class="fa fa-arrow-right"></i></a></div>';
                    }
                ?>
            </div>
        </div>
        <div class="sidebar_right">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
        <script src="https://airbit.com/js/embeds/html5/gatracking.js?gatracking=UA-64813359-1"></script>
	</body>
</html>