<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
    error_reporting(-1);
    header("Content-Type: application/rss+xml; charset=utf-8");
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
?>
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel> 
        <title>KG.codes</title>
        <link>https://www.kg.codes</link>
        <atom:link href="https://www.kg.codes/rss/" rel="self" type="application/rss+xml" />
        <description>KG.codes is a programmer, app + website developer, and content creator. Discover content around coding, the software engineering lifestyle, and digital creation.</description>
        <language>en-us</language>
        <copyright>Copyright (C) <?php echo date("Y"); ?> KG.codes</copyright>
        <image>
            <title>KG.codes</title>
            <link>https://www.kg.codes</link>
            <url>https://www.kg.codes/images/background-yellow.png</url>
        </image>
        <?php
            $query = "SELECT * FROM blog_posts WHERE is_published = 1 AND id <= 11 ORDER BY created_time DESC";
            $results = mysqli_query($database_connection, $query) or die(mysql_error());
            while ($post = mysqli_fetch_array($results, MYSQL_ASSOC)) { 
                $post_url = 'https://'.$_SERVER['SERVER_NAME'].'/blog/'.$post['slug'];
                echo
                '<item>
                    <title>'.$post['title'].'</title>
                    <link>'.$post_url.'</link>
                    <description>'.$post['description'].'<![CDATA[<br /><br /><img src="'.$post['main_image_url'].'" />]]></description>
                    <pubDate>'.date("D, d M Y H:i:s O", strtotime($post['created_time'])).'</pubDate>
                    <guid isPermaLink="false">kgcodes-'.$post['id'].'</guid>
                    <author>kelvingraddick@kg.codes (Kelvin Graddick)</author>
                </item>';
            }
        ?>
    </channel>
</rss>