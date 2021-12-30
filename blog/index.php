<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
    $seo = get_seo($database_connection, "blog");
    $header_h_tag_number = 1;
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
            include $_SERVER['DOCUMENT_ROOT'].'/js/mailchimp.php';
        ?>
	</head>
	<body>
        <div class="page_left" style="padding: 20px;">
            <?php
                $latest_posts_query = "SELECT * FROM blog_posts WHERE is_published = 1 ORDER BY created_time DESC LIMIT 10 OFFSET $from";
                $results = mysqli_query($database_connection, $latest_posts_query) or die(mysql_error());
                $colors = array();
                while ($post = mysqli_fetch_array( $results, MYSQLI_ASSOC )) { 
                    $post_url = 'https://'.$_SERVER['SERVER_NAME'].'/blog/'.$post['slug'];
                    if (empty($colors)) {
                        $colors = array('eed67a', 'fafafa');
                        shuffle($colors);
                    }
                    echo 
                    '<div class="page_block" style="background-color: #'.array_pop($colors).';" onclick="location.href=\''.$post_url.'\';">
                        <div class="page_block_circle_buttons">
                            <div class="page_block_circle_button"></div>
                            <div class="page_block_circle_button"></div>
                            <div class="page_block_circle_button"></div>
                        </div>
                        <div class="page_block_title">
                            <a href="'.$post_url.'"><h2>'.$post['title'].'</h2></a>
                        </div>
                        <div class="page_block_image" style="background-image:url(\''.$post['main_image_url'].'\');" title="'.$post['title'].'"></div>
                        <div class="page_block_content">
                            <div class="page_block_description">
                                <p>'.$post['description'].'</p>
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
        <div class="sidebar_right">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        </div>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
	</body>
</html>