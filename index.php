<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
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
        <div class="sidebar_left">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        </div>
        <div class="page_right">
            <div class="page_block" style="background-color: #eed67a;" onclick="location.href='https://<?php echo $_SERVER['SERVER_NAME']; ?>/beats/';">
                <div class="page_block_title">
                    <a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/beats/"><h1>BEAT MAKER.</h1></a>
                </div>
                <div class="page_block_widget">
                    <iframe id="mfs_html5" src="https://airbit.com/widgets/html5/?uid=1593&config=464605" class="beat_store" height="400" frameborder="0" scrolling="no"></iframe>
                </div>
                <div class="page_block_content">
                    <div class="page_block_description">
                        Listen to and download hip-hop / pop / R&B beats produced by KG The Maker. Download instantly and/or contact me directly for collaboration.<br /><br />
                        <img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/kg-the-maker-beat-maker-1.jpg" style="width: 49%; border-radius: 5px;" />
                        <img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/kg-the-maker-beat-maker-2.jpg" style="width: 49%; border-radius: 5px;" />
                    </div>
                    <div class="page_block_button">
                        <i class="fas fa-external-link-alt"></i>
                    </div>
                </div>
            </div>
            <?php
                $latest_posts_query = "SELECT * FROM blog_posts WHERE is_published = 1 ORDER BY created_time DESC LIMIT 10 OFFSET $from";
                $results = mysqli_query($database_connection, $latest_posts_query) or die(mysql_error());
                $colors = array();
                while ($post = mysqli_fetch_array( $results, MYSQL_ASSOC )) { 
                    $post_url = 'https://'.$_SERVER['SERVER_NAME'].'/blog/'.$post['slug'];
                    if (empty($colors)) {
                        $colors = array('eed67a', 'ee7a92', '7a92ee', '7accee');
                        shuffle($colors);
                    }
                    echo 
                    '<div class="page_block" style="background-color: #'.array_pop($colors).';" onclick="location.href=\''.$post_url.'\';">
                        <div class="page_block_title">
                            <a href="'.$post_url.'"><h1>'.$post['title'].'</h1></a>
                        </div>
                        <div class="page_block_image" style="background-image:url(\''.$post['main_image_url'].'\');" title="'.$post['title'].'"></div>
                        <div class="page_block_content">
                            <div class="page_block_description">
                                '.$post['description'].'
                            </div>
                            <div class="page_block_time">
                                <i class="far fa-clock"></i>&nbsp;'.get_time_to_read($post['content']).'
                            </div>
                            <div class="page_block_button">
                                <i class="fas fa-external-link-alt"></i>
                            </div>
                        </div>
                    </div>';
                }
            ?>
            <?php
                if (mysqli_num_rows(mysqli_query($database_connection, $latest_posts_query))) {
                    echo '<div class="next_button"><a href="/?from='.($from + 10).'" rel="next">PREVIOUS POSTS <i class="fa fa-arrow-right"></i></a></div>';
                }
            ?>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
        <script src="https://airbit.com/js/embeds/html5/gatracking.js?gatracking=UA-64813359-1"></script>
	</body>
</html>