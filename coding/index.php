<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
    $seo = get_seo($database_connection, "coding");
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
        <div class="page_left" style="padding: 20px;">
            <div class="page_block" style="background-color: #eed67a;">
                <div class="page_block_circle_buttons">
                    <div class="page_block_circle_button"></div>
                    <div class="page_block_circle_button"></div>
                    <div class="page_block_circle_button"></div>
                </div>
                <div class="page_block_title">
                    <h1>KG.codes Coding</h1><span class="header">.</span>
                </div>
                <br />
                Hi. I am KG.codes. App/website maker. Check out my programming projects and contributions below!
                <br />
                Contact me today for inquiries or collaboration.
                <br /><br />
                <div class="page_block_content_left" onclick="location.href='https://<?php echo $_SERVER['SERVER_NAME']; ?>/blog/copy-paste-app-snippeta';">
                    <table>
                        <tr>
                            <td>
                                <div class="page_block_icon" style="background-image: url('https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/snippeta-icon.png');"></div>
                            </td>
                            <td>
                                <div class="page_block_description">
                                    <b>SNIPPETA IOS APP</b> &middot; Copy, paste, and manage snippets of text! Copy snippet text to your clipboard with a single tap; no highlighting/long-tapping!
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
                                    <b>LINKIFY.BIO WEBSITE</b> &middot; Quickly provide multiple links in a social bio or ad through a single link!
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
                                    <b>WAVE LINK, LLC WEBSITE</b> &middot; Creative 3D website developed for software development company Wave Link, LLC.
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
                                    <b>..MORE ON GITHUB</b> &middot; My personal GitHub page with more of my programming projects and contributions.
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
        </div>
        <div class="sidebar_right">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
	</body>
</html>