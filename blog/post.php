<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
    $seo = get_seo($database_connection, "blog");
    $slug = $_GET['slug'];
	$result = mysqli_query($database_connection, "SELECT * FROM blog_posts WHERE slug = '$slug'");
	if (!$result) { echo 'Could not find post by the slug specified.'; }
	$post = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo clean_quotes($post['title']." | KG The Maker"); ?></title>
        <meta name="description" content="<?php echo clean_quotes($post['description']); ?>">
        <meta name="robots" content="index, follow">
        <meta property="fb:app_id" content="361862767338317" />
        <meta property="og:description" content="<?php echo clean_quotes($post['description']); ?>" />
        <meta property="og:image" content="<?php echo $post['main_image_url']; ?>" />
        <meta property="og:image:alt" content="<?php echo $post['title']; ?>" />
        <meta property="og:image:type" content="image/png" />
        <meta property="og:title" content="<?php echo clean_quotes($post['title']); ?>" />
        <meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
        <meta property="og:site_name" content="KGTheMaker.com" />
        <meta property="article:author" content="Kelvin Graddick - KGTheMaker.com" />
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@kgthemaker">
        <meta name="twitter:creator" content="@kgthemaker">
        <meta name="twitter:title" content="<?php echo clean_quotes($post['title']); ?>">
        <meta name="twitter:description" content="<?php echo clean_quotes($post['description']); ?>">
        <meta name="twitter:image:src" content="<?php echo $post['main_image_url']; ?>">
        <?php 
            switch ($post['type']) {
                default : echo '<meta property="og:type" content="article" /><meta property="twitter:card" content="summary_large_image" />'; break;
            }
            include $_SERVER['DOCUMENT_ROOT'].'/css/main.php';
        ?>
	</head>
	<body>
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "NewsArticle",
                "headline": "<?php echo clean_quotes($post['title']); ?>",
                "image": ["<?php echo $post['main_image_url']; ?>"],
                "datePublished": "<?php echo date(DATE_ISO8601, strtotime($post['created_time'])); ?>",
                "description": "<?php echo clean_quotes($post['description']); ?>",
                "articleBody": "<?php echo clean_quotes($post['content']); ?>"
            }
        </script>
        <div class="page_left">
            <?php
                $post_url = 'https://'.$_SERVER['SERVER_NAME'].'/blog/'.$post['slug'];
                $colors = array('eed67a', 'ee7a92', '7a92ee', '7accee');
                shuffle($colors);
            ?>
            <div class="post">
                <div class="post_banner_image" style="background-image:url('<?php echo $post['main_image_url']; ?>');" title="<?php echo $post['title']; ?>"></div>
                <div class="post_content" style="border-right: 5px solid #<?php echo array_pop($colors); ?>;">
                    <div class="post_title">
                        <h1><?php echo $post['title']; ?></h1>
                    </div>
                    <div class="post_sub_title">
                        <?php echo $post['author']; ?> &middot;
                        <?php echo get_time_to_read($post['content']); ?> &middot;&nbsp;
                        <i class="fab fa-facebook full_post_social_icon" onclick="shareUrlToFacebook(this, '<?php echo $post_url; ?>');"></i> &nbsp;
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($post['title']); ?>&url=<?php echo $post_url; ?>&via=kgthemaker" target="_blank"><i class="fab fa-twitter full_post_social_icon"></i></a> &nbsp;
                        <a href="https://www.pinterest.com/pin/create/button/?url=<?php echo $post_url; ?>&media=<?php echo $post['tall_image_url']; ?>&description=<?php echo urlencode($post['title']); ?>" target="_blank" data-pin-do="buttonPin" data-pin-config="above">
                            <i class="fab fa-pinterest full_post_social_icon"></i>
                        </a>
                    </div>
                    <div class="post_body">
                        <?php echo $post['content']; ?>
                    </div>
                    <div class="post_sub_title">
                        Want to share this? &nbsp;&nbsp;
                        <i class="fab fa-facebook full_post_social_icon" onclick="shareUrlToFacebook(this, '<?php echo $post_url; ?>');"></i> &nbsp;
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($post['title']); ?>&url=<?php echo $post_url; ?>&via=kgthemaker" target="_blank"><i class="fab fa-twitter full_post_social_icon"></i></a> &nbsp;
                        <a href="https://www.pinterest.com/pin/create/button/?url=<?php echo $post_url; ?>&media=<?php echo $post['tall_image_url']; ?>&description=<?php echo urlencode($post['title']); ?>" target="_blank" data-pin-do="buttonPin" data-pin-config="above">
                            <i class="fab fa-pinterest full_post_social_icon"></i>
                        </a>
                    </div>
                    <div class="fb-comments" data-href="<?php echo $post_url; ?>" data-width="100%" data-numposts="10" data-colorscheme="light"></div>
                </div>
            </div>
        </div>
        <div class="sidebar_right">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        </div>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
	</body>
</html>