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
        <div class="page_right" style="padding: 20px;">
            <div class="page_block page_block_cards" style="background-color: #eed67a;">
                <div class="page_block_circle_buttons">
                    <div class="page_block_circle_button"></div>
                    <div class="page_block_circle_button"></div>
                    <div class="page_block_circle_button"></div>
                </div>
                <div class="page_block_title page_block_title_cards">
                    <a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/coding/"><h2>App + Website Maker</h2></a><span class="header">.</span>
                </div>
                <div class="page_block_description page_block_description_cards">
                    <p>
                    I'm a professional software developer who's been in the industry for ~8 years.
                    I've built many websites, web app, mobile apps, services, APIs, and databases with ❤️.
                    </p>
                    <div class="page_block_link page_block_link_cards">
                        <a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/coding/">Learn more about my coding&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
                <div id="cards_left" class="cards">
                    <table>
                        <tr>
                            <td>
                                <div class="card">
                                    <div class="card_header">
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="card_header_title">
                                                        Snippeta &middot; iOS app
                                                    </div>
                                                    <div class="card_header_description">
                                                        Copy, manage, and paste snippets of text to your clipboard with a single tap; no highlighting/long-tapping!
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="card_header_icon" style="background-image: url('https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/snippeta-icon.png');"></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card_footer">
                                        <a class="card_footer_link" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/blog/copy-paste-app-snippeta" target="_blank"><i class="fas fa-info-circle"></i> Details</a>
                                        <a class="card_footer_link card_footer_link_right" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/blog/copy-paste-app-snippeta" target="_blank"><i class="fab fa-github"></i> GitHub</a>
                                    </div>
                                </div>
                            </td>
                            <td>   
                                <div class="card">
                                    <div class="card_header">
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="card_header_title">
                                                        Linkify.Bio &middot; website
                                                    </div>
                                                    <div class="card_header_description">
                                                        Quickly provide multiple links in a social bio or ad through a single link!
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="card_header_icon" style="background-image: url('https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/linkify-bio-icon.png');"></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card_footer">
                                        <a class="card_footer_link" href="https://www.linkify.bio" target="_blank"><i class="fas fa-info-circle"></i> Details</a>
                                        <a class="card_footer_link card_footer_link_right" href="https://github.com/kelvingraddick/Linkify.Bio-website" target="_blank"><i class="fab fa-github"></i> GitHub</a>
                                    </div>
                                </div>
                            </td>
                            <td> 
                                <div class="card">
                                    <div class="card_header">
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="card_header_title">
                                                        Wave Link &middot; website
                                                    </div>
                                                    <div class="card_header_description">
                                                        Creative 3D website developed for software development company Wave Link, LLC.
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="card_header_icon" style="background-image: url('https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/wavelink-icon.png');"></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card_footer">
                                        <a class="card_footer_link" href="http://www.wavelinkllc.com" target="_blank"><i class="fas fa-info-circle"></i> Details</a>
                                        <a class="card_footer_link card_footer_link_right" href="http://www.wavelinkllc.com" target="_blank"><i class="fab fa-github"></i> GitHub</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table> 
                </div>
                <div id="cards_right" class="cards">
                    <table>
                        <tr>
                            <td>
                                <div class="card">
                                    <div class="card_header">
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="card_header_title">
                                                        GitHub &middot; KG.codes
                                                    </div>
                                                    <div class="card_header_description">
                                                        My personal GitHub page with more of my programming projects and contributions.
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="card_header_icon" style="background-image: url('https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/github-icon.png');"></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card_footer">
                                        <a class="card_footer_link" href="https://github.com/kelvingraddick" target="_blank"><i class="fas fa-info-circle"></i> Details</a>
                                        <a class="card_footer_link card_footer_link_right" href="https://github.com/kelvingraddick" target="_blank"><i class="fab fa-github"></i> GitHub</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card">
                                    <div class="card_header">
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="card_header_title">
                                                        KG.codes &middot; website
                                                    </div>
                                                    <div class="card_header_description">
                                                        My personal/professional website, portfolio, and blog (this website 😉)
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="card_header_icon" style="background-image: url('https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/kg-the-maker-logo-portrait.png');"></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card_footer">
                                        <a class="card_footer_link" href="https://kg.codes" target="_blank"><i class="fas fa-info-circle"></i> Details</a>
                                        <a class="card_footer_link card_footer_link_right" href="https://github.com/kelvingraddick/KG.codes-website" target="_blank"><i class="fab fa-github"></i> GitHub</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card">
                                    <div class="card_header">
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="card_header_title">
                                                        Mercedes Benz &middot; iOS app
                                                    </div>
                                                    <div class="card_header_description">
                                                        The mobile app for the Mercedez Benz of Columbus, GA. Vehicle listings, appointments, and news.
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="card_header_icon" style="background-image: url('https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/mercedes-benz-icon.jpg');"></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card_footer">
                                        <a class="card_footer_link" href="https://github.com/kelvingraddick/Mercedes-Benz-of-Columbus" target="_blank"><i class="fas fa-info-circle"></i> Details</a>
                                        <a class="card_footer_link card_footer_link_right" href="https://github.com/kelvingraddick/Mercedes-Benz-of-Columbus" target="_blank"><i class="fab fa-github"></i> GitHub</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table> 
                </div>
            </div>
            <?php
                $latest_posts_query = "SELECT * FROM blog_posts WHERE is_published = 1 ORDER BY created_time DESC LIMIT 10 OFFSET $from";
                $results = mysqli_query($database_connection, $latest_posts_query) or die(mysql_error());
                $colors = array();
                while ($post = mysqli_fetch_array( $results, MYSQL_ASSOC )) { 
                    $post_url = 'https://'.$_SERVER['SERVER_NAME'].'/blog/'.$post['slug'];
                    if (empty($colors)) {
                        $colors = array('eed67a', 'fafafa');
                        shuffle($colors);
                    }
                    $color = array_pop($colors);
                    echo 
                    '<div class="page_block" style="background-color: #'.$color.';" onclick="location.href=\''.$post_url.'\';">
                        <div class="page_block_circle_buttons">
                            <div class="page_block_circle_button"></div>
                            <div class="page_block_circle_button"></div>
                            <div class="page_block_circle_button"></div>
                        </div>
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
                    echo '<div class="next_button"><a href="/?from='.($from + 10).'" rel="next">Previous Posts&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a></div>';
                }
            ?>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
        <script src="https://airbit.com/js/embeds/html5/gatracking.js?gatracking=UA-64813359-1"></script>
        <script src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/js/jquery.pause.min.js"></script>
        <script>
            $("#cards_right").scrollLeft(document.getElementById("cards_right").scrollWidth);
            $(window).load(function() {
                $("#cards_left").animate({ scrollLeft: document.getElementById("cards_left").scrollWidth - document.getElementById("cards_left").scrollLeft - $(".page_block").width() }, 10000, 'linear');
                $("#cards_right").animate({ scrollLeft: document.getElementById("cards_right").scrollWidth - document.getElementById("cards_right").scrollLeft - $(".page_block").width() }, 10000, 'linear');
            });
            $("#cards_left").hover(function() { $("#cards_left").pause(); }, function() { $("#cards_left").resume(); });
            $("#cards_right").hover(function() { $("#cards_right").pause(); }, function() { $("#cards_right").resume(); });
        </script>
	</body>
</html>