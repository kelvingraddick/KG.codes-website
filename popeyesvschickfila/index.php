<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
    $seo = get_seo($database_connection, "popeyesvschickfila");
    $popeyes_total = mysqli_fetch_assoc(mysqli_query($database_connection, "SELECT COUNT(*) as total FROM popeyesvschickfila WHERE type = 0"))['total'];
    $chickfila_total = mysqli_fetch_assoc(mysqli_query($database_connection, "SELECT COUNT(*) as total FROM popeyesvschickfila WHERE type = 1"))['total'];
    $complete_total = $popeyes_total + $chickfila_total;
    $popeyes_percentage = number_format(($popeyes_total / $complete_total) * 100);
    $chickfila_percentage = number_format(($chickfila_total / $complete_total) * 100);
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
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
        <style>
            .header {
                width: 100%;
                padding: 20px;
                text-align: center;
                background-color: #f3f3f3;
            }
            .footer {
                width: 100%;
                padding: 20px;
                text-align: center;
                background-color: #f3f3f3;
            }
            .title_text {
                font-family: 'Roboto', sans-serif;
                font-weight: 700;
                font-size: 25px;
                line-height: 25px;
                color: #353535;
                margin-bottom: 0;
            }
            .sub_title_text {
                font-family: 'Roboto', sans-serif;
                color: #353535;
                margin-bottom: 5px;
            }
            .disclaimer_text {
                font-family: 'Roboto', sans-serif;
                color: #353535;
                font-size: 12px;
                margin-bottom: 0;
            }
            .side {
                width: 50%;
                padding: 20px;
                text-align: center;
            }
            .popeyes_side {
                background-color: #F68323;
            }
            .chickfila_side {
                background-color: #E60E33;
            }
            .logo-container {
                height: 100px;
                text-align: center;
                vertical-align: middle;
            }
            .logo {
                max-height: 100px;
            }
            .sandwich-image {
                height: 150px;
                margin-bottom: 10px;
                border: 5px solid white;
                border-radius: 5px;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center center;
            }
            .vote_button {
                height: 40px;
                width: 100%;
                background-color: #f3f3f3;
                border: 1px solid white;
                border-radius: 5px;
                font-family: 'Roboto', sans-serif;
                font-weight: 700;
                font-size: 20px;
                cursor: pointer;
            }
            .results_text {
                display: none;
                font-family: 'Roboto', sans-serif;
                font-weight: 500;
                font-size: 30px;
                color: white;
            }
            .results_sub_text {
                font-family: 'Roboto', sans-serif;
                font-weight: 400;
                font-size: 15px;
                color: white;
            }
            .social_link {
                font-family: 'Roboto', sans-serif;
                text-decoration: underline;
            }

            @media (min-width: 992px) {
                .logo-container {
                    height: 150px;
                }
                .sandwich-image {
                    height: 300px;
                }
            }
        </style>
	</head>
	<body>
        <div class="page_left">
            <table style="width: 100%;">
                <tr>
                    <td class="header" colspan="2">
                        <div class="sub_title_text">
                            Let's settle the #ChickenWars 🐔 debate!
                        </div>
                        <div class="title_text">
                            Vote for the best chicken sandwich!
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="side popeyes_side">
                        <div class="logo-container">
                            <img class="logo" src="../images/popeyes.png" />
                        </div>
                        <div class="sandwich-image" style="background-image:url('../images/popeyes-chicken-sandwich.jpg');"></div>
                        <button class="vote_button" onclick="vote(0);">Vote</button>
                        <div class="results_text">
                            <?php
                                echo $popeyes_percentage."% <span class=\"results_sub_text\">(".$popeyes_total." votes)</span>";
                            ?>
                        </div>
                    </td>
                    <td class="side chickfila_side">
                        <div class="logo-container">
                            <img class="logo" src="../images/chick-fil-a.png" />
                        </div>
                        <div class="sandwich-image" style="background-image:url('../images/chick-fil-a-chicken-sandwich.jpg');"></div>
                        <button class="vote_button" onclick="vote(1);">Vote</button>
                        <div class="results_text">
                            <?php
                                echo $chickfila_percentage."% <span class=\"results_sub_text\">(".$chickfila_total." votes)</span>";
                            ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="footer" colspan="2">
                        <div class="sub_title_text">
                            Created with ❤️ by <a class="social_link" href="https://www.instagram.com/kg.codes">@KG.codes</a>. <span style="font-weight: 500;">Support by sharing on social!</span>
                        </div>
                        <div class="disclaimer_text">
                            *The Popeyes logo and sandwich imagery are property of Popeyes Louisiana Kitchen, Inc. The Chick-fil-a logo and sandwich imagery are property of Chick-fil-a, Inc.* 
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="sidebar_right">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        </div>
        <form name="vote_form" style="display: none;" method="post" action="submit.php">
            <input id="type" name="type" type="text" />
        </form>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
        <script>
            function vote(type) {
                $("#type").val(type);
                setCookie("vote_type", type, 30);
                document.vote_form.submit();
            }

            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                var expires = "expires="+ d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }

            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for(var i = 0; i <ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return undefined;
            }

            var voteTypeCookie = getCookie("vote_type");
            if (voteTypeCookie) {
                $(".vote_button").hide();
                $(".results_text").show();
            }
        </script>
	</body>
</html>