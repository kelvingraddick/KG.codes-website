<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
	$database_connection = connect_to_database();
    $setting = get_settings($database_connection);
    $seo = get_seo($database_connection, "beats");
    $slug = $_GET['slug'];
	$result = mysqli_query($database_connection, "SELECT * FROM products WHERE slug = '$slug'");
	if (!$result) { echo 'Could not find beat by the slug specified.'; }
	$beat = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo clean_quotes($beat['title']." | KG.codes"); ?></title>
        <meta name="description" content="<?php echo clean_quotes($beat['short_description']); ?>">
        <meta name="robots" content="index, follow">
        <meta property="fb:app_id" content="361862767338317" />
        <meta property="og:type" content="product" />
        <meta property="og:description" content="<?php echo clean_quotes($beat['short_description']); ?>" />
        <meta property="og:image" content="<?php echo $beat['main_image_url']; ?>" />
        <meta property="og:image:alt" content="<?php echo $beat['title']; ?>" />
        <meta property="og:image:type" content="image/png" />
        <meta property="og:title" content="<?php echo clean_quotes($beat['title']); ?>" />
        <meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
        <meta property="og:site_name" content="KG.codes" />
        <meta property="og:price:amount" content="<?php echo $beat['sale_price']; ?>" />
        <meta property="og:price:currency" content="USD" />
        <meta property="twitter:card" content="product" />
        <meta name="twitter:card" content="product">
        <meta name="twitter:site" content="@KGcodes">
        <meta name="twitter:creator" content="@KGcodes">
        <meta name="twitter:title" content="<?php echo clean_quotes($beat['title']); ?>">
        <meta name="twitter:description" content="<?php echo clean_quotes($beat['short_description']); ?>">
        <meta name="twitter:image:src" content="<?php echo $beat['main_image_url']; ?>">
        <meta name="twitter:data1" content="$<?php echo $beat['sale_price']; ?>">
        <meta name="twitter:label1" content="Price">
        <?php 
            include $_SERVER['DOCUMENT_ROOT'].'/css/main.php';
        ?>
	</head>
	<body>
        <script type="application/ld+json">
            {
                "@context": "http://schema.org/",
                "@type": "Product",
                "name": "<?php echo clean_quotes($beat['title']); ?>",
                "image": ["<?php echo clean_quotes($beat['main_image_url']); ?>"],
                "description": "<?php echo clean_quotes($beat['short_description']); ?>",
                "mpn": "<?php echo clean_quotes($beat['code']); ?>",
                "brand": {
                    "@type": "Thing",
                    "name": "KG.codes"
                },
                "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "5.0",
                    "reviewCount": "5"
                },
                "offers": {
                    "@type": "Offer",
                    "priceCurrency": "USD",
                    "price": "<?php echo clean_quotes($beat['sale_price']); ?>",
                    "itemCondition": "http://schema.org/NewCondition",
                    "availability": "http://schema.org/InStock",
                    "seller": {
                        "@type": "Organization",
                        "name": "KG.codes"
                    }
                }
            }
        </script>
        <div class="page_left">
            <?php
                $beat_url = 'https://'.$_SERVER['SERVER_NAME'].'/beats/'.$beat['slug'];
                $colors = array('eed67a', 'ee7a92', '7a92ee', '7accee');
                shuffle($colors);
            ?>
            <div class="post">
                <div class="post_banner_image" style="background-image:url('<?php echo $beat['main_image_url']; ?>');" title="<?php echo $beat['title']; ?>"></div>
                <div class="post_content" style="border-right: 5px solid #<?php echo array_pop($colors); ?>;">
                    <div class="post_title">
                        <h1><?php echo $beat['title']; ?></h1>
                    </div>
                    <div class="post_sub_title">
                        $<?php echo $beat['sale_price']; ?> &middot;
                        <i class="fab fa-facebook full_post_social_icon" onclick="shareUrlToFacebook(this, '<?php echo $beat_url; ?>');"></i> &nbsp;
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($beat['title']); ?>&url=<?php echo $beat_url; ?>&via=KGcodes" target="_blank"><i class="fab fa-twitter full_post_social_icon"></i></a> &nbsp;
                        <a href="https://www.pinterest.com/pin/create/button/?url=<?php echo $beat_url; ?>&media=<?php echo $beat['tall_image_url']; ?>&description=<?php echo urlencode($beat['title']); ?>" target="_blank" data-pin-do="buttonPin" data-pin-config="above">
                            <i class="fab fa-pinterest full_post_social_icon"></i>
                        </a>
                    </div>
                    <div class="post_body">
                        <iframe src="https://airbit.com/widgets/solo/?b=<?php echo $beat['code']; ?>" height="160" frameborder="0" style="width: 100%;"></iframe>
                        <br /><br />
                        <?php echo $beat['long_description']; ?>
                    </div>
                    <div class="post_sub_title">
                        Want to share this? &nbsp;&nbsp;
                        <i class="fab fa-facebook full_post_social_icon" onclick="shareUrlToFacebook(this, '<?php echo $beat_url; ?>');"></i> &nbsp;
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($beat['title']); ?>&url=<?php echo $beat_url; ?>&via=KGcodes" target="_blank"><i class="fab fa-twitter full_post_social_icon"></i></a> &nbsp;
                        <a href="https://www.pinterest.com/pin/create/button/?url=<?php echo $beat_url; ?>&media=<?php echo $beat['tall_image_url']; ?>&description=<?php echo urlencode($beat['title']); ?>" target="_blank" data-pin-do="buttonPin" data-pin-config="above">
                            <i class="fab fa-pinterest full_post_social_icon"></i>
                        </a>
                    </div>
                    <div class="fb-comments" data-href="<?php echo $beat_url; ?>" data-width="100%" data-numposts="10" data-colorscheme="light"></div>
                </div>
            </div>
        </div>
        <div class="sidebar_right">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        </div>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
	</body>
</html>