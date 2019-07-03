<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
    $seo = get_seo($database_connection, "socialengager");
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
	<body style="background-color: #ee7a92;">
        <div class="page_left">
            <div class="page_block" style="background-color: #ee7a92;">
                <div class="page_block_title">
                    <h1>SOCIAL ENGAGER: BY KG.CODES</h1><span class="header">.</span>
                </div>
                <br />
                The social engager is a free tool for aggregating various social media feeds targeted by genre, hashtags, etc.
                <br />
                This tool can be used to quickly and effectively engage with social media content within your niche in a meaningful way.
                <br /><br />

                <div class="page_block_title">
                    <h2>INSTAGRAM</h2><span class="header">.</span>
                </div>
                <form id="instagram_contact_form" class="contact_form" method="post">
                    <div class="contact_label">Hashtag:</div>
                    <input id="instagram_textbox" class="contact_textbox" type="text" name="hashtag" value="" required>
                    <br /><br />
                    <button class="contact_button">Search for posts</button>
                </form>
                <br />
                <div id="instagram_links_container"></div>

                <div class="page_block_title">
                    <h2>YOUTUBE</h2><span class="header">.</span>
                </div>
                <form id="youtube_contact_form" class="contact_form" method="post">
                    <div class="contact_label">Search:</div>
                    <input id="youtube_textbox" class="contact_textbox" type="text" name="query" value="" required>
                    <br /><br />
                    <button class="contact_button">Search for videos</button>
                </form>
                <br />
                <div id="youtube_links_container"></div>

            </div>
        </div>
        <div class="sidebar_right">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.min.js"></script>
        <script>
            $("#instagram_contact_form")
                .submit(function(e) { e.preventDefault(); })
                .validate({
                    rules: {
                        hashtag: {
                            required: true
                        }
                    },
                    submitHandler: getInstagramPosts
                });
            
            $("#youtube_contact_form")
                .submit(function(e) { e.preventDefault(); })
                .validate({
                    rules: {
                        query: {
                            required: true
                        }
                    },
                    submitHandler: getYouTubeVideos
                });

            function getInstagramPosts() {
                var instagramLinksContainer = $('#instagram_links_container');
                instagramLinksContainer.html('Loading...');
                var hashtag = $('#instagram_textbox').val().replace(' ', '').replace('#', '');
                $.get('https://www.instagram.com/explore/tags/' + hashtag + '/?__a=1', function( data ) {
                    if (data && data.graphql && data.graphql.hashtag && data.graphql.hashtag.edge_hashtag_to_media && data.graphql.hashtag.edge_hashtag_to_media.edges) {
                        instagramLinksContainer.html('');
                        var posts = data.graphql.hashtag.edge_hashtag_to_media.edges;
                        for (var i = 0; i < posts.length; i++) {
                            $.get('https://api.instagram.com/oembed?url=http://instagr.am/p/' + posts[i].node.shortcode + '/', function( data2 ) {
                                var html = data2 && data2.html;
                                instagramLinksContainer.append(html);
                            });
                        }
                    }
                });
            }

            function getYouTubeVideos() {
                var youtubeLinksContainer = $('#youtube_links_container');
                youtubeLinksContainer.html('Loading...');
                var query = $('#youtube_textbox').val();
                $.get('https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=25&order=date&q=' + query + '&type=video&key=' + 'AIzaSyAxu3zYMgyYWDeEN7oTXoPvcsABw77fqVs', function( data ) {
                    console.error(data);
                    if (data && data.items) {
                        youtubeLinksContainer.html('');
                        var videos = data.items;
                        for (var i = 0; i < videos.length; i++) {
                            var displayUrl = videos[i].snippet && videos[i].snippet.thumbnails && videos[i].snippet.thumbnails.high && videos[i].snippet.thumbnails.high.url;
                            var postUrl = 'https://youtu.be/' + (videos[i].id && videos[i].id.videoId);
                            var channel = videos[i].snippet && videos[i].snippet.channelTitle;
                            var text = videos[i].snippet && videos[i].snippet.description;
                            var displayTime = new Date(videos[i].snippet && videos[i].snippet.publishedAt).toLocaleString();
                            youtubeLinksContainer.append(`
                                <div class="card">
                                    <div class="card-image">
                                        <figure class="image is-4by3">
                                            <img src="` + displayUrl +  `" alt="Placeholder image">
                                        </figure>
                                    </div>
                                    <div class="card-content">
                                        <div class="content">
                                            ` + channel + `
                                            <br><br>
                                            ` + text + `
                                            <br><br>
                                            <time>` + displayTime + `</time>
                                        </div>
                                    </div>
                                    <footer class="card-footer">
                                        <a href="` + postUrl +  `" class="card-footer-item">View On YouTube</a>
                                    </footer>
                                </div>
                                <br /><br />
                            `);
                        }
                    }
                });
            }
        </script>
	</body>
</html>