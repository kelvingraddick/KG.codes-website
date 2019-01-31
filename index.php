<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
    $seo = get_seo($database_connection, "home");
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
                    <a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/beats/"><h2>BEAT MAKER.</h2></a>
                </div>
                <div class="page_block_widget">
                    <iframe id="mfs_html5" src="https://airbit.com/widgets/html5/?uid=1593&config=464605" class="beat_store" height="400" frameborder="0" scrolling="no"></iframe>
                </div>
                <div class="page_block_content_right">
                    <div class="page_block_description">
                        <p>Listen to and download hip-hop / pop / R&B beats produced by KG The Maker. Download instantly and/or contact me directly for collaboration.</p><br />
                        <img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/kg-the-maker-beat-maker-1.jpg" alt="KG The Maker music producer" style="width: 49%; border-radius: 5px;" />
                        <img src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/kg-the-maker-beat-maker-2.jpg" alt="KG The Maker music producer" style="width: 49%; border-radius: 5px;" />
                    </div>
                    <div class="page_block_button">
                        <i class="fas fa-external-link-alt"></i>
                    </div>
                </div>
            </div>
            <div class="page_block" style="background-color: #ee7a92;">
                <div class="page_block_title">
                    <a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/coding/"><h2>APP/WEBSITE MAKER.</h2></a>
                </div>
                <div class="page_block_content_left" onclick="location.href='https://<?php echo $_SERVER['SERVER_NAME']; ?>/blog/copy-paste-app-snippeta';">
                    <table>
                        <tr>
                            <td>
                                <div class="page_block_icon" style="background-image: url('https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/snippeta-icon.png');"></div>
                            </td>
                            <td>
                                <div class="page_block_description">
                                    <p><b>SNIPPETA IOS APP</b> &middot; Copy, paste, and manage snippets of text! Copy snippet text to your clipboard with a single tap; no highlighting/long-tapping!</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="page_block_time">
                        <i class="fas fa-mobile"></i>&nbsp;App
                    </div>
                    <div class="page_block_button">
                        <i class="fas fa-external-link-alt"></i>
                    </div>
                </div>
                <div class="page_block_content_right" onclick="window.open('https://www.linkify.bio');">
                    <table>
                        <tr>
                            <td>
                                <div class="page_block_icon" style="background-image: url('https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/linkify-bio-icon.png');"></div>
                            </td>
                            <td>
                                <div class="page_block_description">
                                    <p><b>LINKIFY.BIO WEBSITE</b> &middot; Quickly provide multiple links in a social bio or ad through a single link!</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="page_block_time">
                        <i class="fas fa-laptop"></i>&nbsp;Website
                    </div>
                    <div class="page_block_button">
                        <i class="fas fa-external-link-alt"></i>
                    </div>
                </div>
                <div class="page_block_content_left" onclick="window.open('http://www.wavelinkllc.com');">
                    <table>
                        <tr>
                            <td>
                                <div class="page_block_icon" style="background-image: url('https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/wavelink-icon.png');"></div>
                            </td>
                            <td>
                                <div class="page_block_description">
                                    <p><b>WAVE LINK, LLC WEBSITE</b> &middot; Creative 3D website developed for software development company Wave Link, LLC.</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="page_block_time">
                        <i class="fas fa-laptop"></i>&nbsp;Website
                    </div>
                    <div class="page_block_button">
                        <i class="fas fa-external-link-alt"></i>
                    </div>
                </div>
                <div class="page_block_content_right" onclick="window.open('https://github.com/kelvingraddick');">
                    <table>
                        <tr>
                            <td>
                                <div class="page_block_icon" style="background-image: url('https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/github-icon.png');"></div>
                            </td>
                            <td>
                                <div class="page_block_description">
                                    <p><b>..MORE ON GITHUB</b> &middot; My personal GitHub page with more of my programming projects and contributions.</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="page_block_time">
                        <i class="fab fa-github"></i>&nbsp;GitHub page
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
                    $color = array_pop($colors);
                    echo 
                    '<div class="page_block" style="background-color: #'.$color.';" onclick="location.href=\''.$post_url.'\';">
                        <div class="page_block_title">
                            <a href="'.$post_url.'"><h2>'.$post['title'].'</h2></a>
                        </div>
                        <div class="page_block_image" style="background-image:url(\''.$post['main_image_url'].'\'); border: 2px solid #'.get_hex_color($color, -15).'" title="'.$post['title'].'"></div>
                        <div class="page_block_content_right">
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
        <?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
        <script src="https://airbit.com/js/embeds/html5/gatracking.js?gatracking=UA-64813359-1"></script>
	</body>
</html>