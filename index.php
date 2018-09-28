<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/templates.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
    $seo = get_seo($database_connection, "home");
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
            include $_SERVER['DOCUMENT_ROOT'].'/js/onesignal.php';
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
                    <div class="title">BLOG</div>
                    <?php
                        $latest_posts_query = "SELECT * FROM blog_posts WHERE is_published = 1 ORDER BY created_time DESC LIMIT 10 OFFSET $from";
                        $results = mysqli_query($database_connection, $latest_posts_query) or die(mysql_error());
                        while ($post = mysqli_fetch_array( $results, MYSQL_ASSOC )) { 
                            echo create_blog_post_thumbnail($post);
                        }
                    ?>
                    <?php
                        if (mysqli_num_rows(mysqli_query($database_connection, $latest_posts_query))) {
                            echo '<div class="about"><a href="/?from='.($from + 10).'" rel="next"><u>Previous Posts</u> <i class="fa fa-arrow-right"></i></a></div>';
                        }
                    ?>
                </div>
                <div class="column is-4">
                    <div class="title">BEATS</div>
                    <iframe id="mfs_html5" src="https://airbit.com/widgets/html5/?uid=1593&config=464605" class="beat_store" height="510" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
        <script src="https://airbit.com/js/embeds/html5/gatracking.js?gatracking=UA-64813359-1"></script>
	</body>
</html>