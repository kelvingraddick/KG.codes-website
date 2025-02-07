<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/Parsedown.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
    $seo = get_seo($database_connection, "blog");
    $slug = $_GET['slug'];
	$result = mysqli_query($database_connection, "SELECT * FROM blog_posts WHERE slug = '$slug'");
	if (!$result) { echo 'Could not find post by the slug specified.'; }
    $post = mysqli_fetch_assoc($result);
    $post_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $post_content = $post['type'] == 1 ? (new Parsedown())->text($post['content']) : $post['content'];
?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo clean_quotes($post['title']); ?></title>
        <meta name="description" content="<?php echo clean_quotes($post['description']); ?>">
        <meta name="robots" content="index, follow">
        <meta property="og:type" content="article" />
        <meta property="fb:app_id" content="361862767338317" />
        <meta property="og:description" content="<?php echo clean_quotes($post['description']); ?>" />
        <meta property="og:image" content="<?php echo $post['main_image_url']; ?>" />
        <meta property="og:image:alt" content="<?php echo clean_quotes($post['title']); ?>" />
        <meta property="og:image:type" content="image/png" />
        <meta property="og:title" content="<?php echo clean_quotes($post['title']); ?>" />
        <meta property="og:url" content="<?php echo $post_url; ?>" />
        <meta property="og:site_name" content="KG.codes" />
        <meta property="article:author" content="Kelvin Graddick - KG.codes" />
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@KGcodes">
        <meta name="twitter:creator" content="@KGcodes">
        <meta name="twitter:title" content="<?php echo clean_quotes($post['title']); ?>">
        <meta name="twitter:description" content="<?php echo clean_quotes($post['description']); ?>">
        <meta name="twitter:image:src" content="<?php echo $post['main_image_url']; ?>">
        <?php 
            include $_SERVER['DOCUMENT_ROOT'].'/css/main.php';
        ?>
	</head>
	<body>
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "NewsArticle",
                "mainEntityOfPage": {
                    "@type": "WebPage",
                    "@id": "<?php echo $post_url; ?>"
                },
                "headline": "<?php echo clean_quotes($post['title']); ?>",
                "image": ["<?php echo $post['main_image_url']; ?>"],
                "datePublished": "<?php echo date(DATE_ISO8601, strtotime($post['created_time'])); ?>",
                "dateModified": "<?php echo date(DATE_ISO8601, strtotime($post['created_time'])); ?>",
                "author": {
                    "@type": "Person",
                    "name": "Kelvin Graddick - KG.codes"
                },
                "publisher": {
                    "@type": "Organization",
                    "name": "Google",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "<?php echo $setting['logo']; ?>"
                    }
                },
                "description": "<?php echo clean_quotes($post['description']); ?>",
                "articleBody": "<?php echo strip_tags(clean_quotes($post_content)); ?>"
            }
        </script>
        <div class="page_left">
            <?php
                $colors = array('eed67a', 'fafafa');
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
                        <?php echo get_time_to_read($post_content); ?> &middot;&nbsp;
                        <i class="fab fa-facebook full_post_social_icon" onclick="shareUrlToFacebook(this, '<?php echo $post_url; ?>');"></i> &nbsp;
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($post['title']); ?>&url=<?php echo $post_url; ?>&via=KGcodes" target="_blank"><i class="fab fa-twitter full_post_social_icon"></i></a> &nbsp;
                        <a href="https://www.pinterest.com/pin/create/button/?url=<?php echo $post_url; ?>&media=<?php echo $post['tall_image_url']; ?>&description=<?php echo urlencode($post['title']); ?>" target="_blank" data-pin-do="buttonPin" data-pin-config="above">
                            <i class="fab fa-pinterest full_post_social_icon"></i>
                        </a>
                    </div>
                    <div class="content post_body">
                        <?php echo $post_content; ?>
                    </div>
                    <div class="post_sub_title">
                        Want to share this? &nbsp;&nbsp;
                        <i class="fab fa-facebook full_post_social_icon" onclick="shareUrlToFacebook(this, '<?php echo $post_url; ?>');"></i> &nbsp;
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($post['title']); ?>&url=<?php echo $post_url; ?>&via=KGcodes" target="_blank"><i class="fab fa-twitter full_post_social_icon"></i></a> &nbsp;
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