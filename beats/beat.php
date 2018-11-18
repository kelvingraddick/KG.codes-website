<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/templates.php';
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
        <title><?php echo clean_quotes($beat['title']." | KG The Maker"); ?></title>
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
        <meta property="og:site_name" content="KGTheMaker.com" />
        <meta property="og:price:amount" content="<?php echo $beat['sale_price']; ?>" />
        <meta property="og:price:currency" content="USD" />
        <meta property="twitter:card" content="product" />
        <meta name="twitter:card" content="product">
        <meta name="twitter:site" content="@kgthemaker">
        <meta name="twitter:creator" content="@kgthemaker">
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
                    "name": "KG The Maker"
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
                        "name": "KG The Maker"
                    }
                }
            }
        </script>
		<div id="particles" class="background"></div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        <div class="about">
            <div class="container">
                Hi. I am KG The Maker.<br />
                An app/website programmer, beat maker, and blogger.
            </div>
        </div>
        <div class="container">
            <div class="columns">
                <div class="column">
                    <?php
                        $beat_url = 'https://'.$_SERVER['SERVER_NAME'].'/beats/'.$beat['slug'];
                    ?>
                    <div class="beat_title">
                        <table style="width:100%;">
                            <tr>
                                <td>
                                    <h1><?php echo $beat['title']; ?></h1>
                                </td>
                                <td class="beat_social_icons">
                                    <i class="fab fa-facebook beat_social_icon" onclick="shareUrlToFacebook(this, '<?php echo $beat_url; ?>');"></i>
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($beat['title']); ?>&url=<?php echo $beat_url; ?>&via=kgthemaker" target="_blank"><i class="fab fa-twitter beat_social_icon"></i></a>
                                    <a href="https://www.pinterest.com/pin/create/button/?url=<?php echo $beat_url; ?>&media=<?php echo $beat['tall_image_url']; ?>&description=<?php echo urlencode($beat['title']); ?>" target="_blank" data-pin-do="buttonPin" data-pin-config="above">
                                        <i class="fab fa-pinterest beat_social_icon"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="beat_subtitle">
                        <?php echo $beat['seller']; ?> &middot;
                        <time class="timeago" datetime="<?php echo date(DATE_ISO8601, strtotime($beat['created_time'])); ?>"></time>
                    </div>
                    <iframe src="https://airbit.com/widgets/solo/?b=<?php echo $beat['code']; ?>" height="160" frameborder="0" style="width: 100%;"></iframe>
                    <div class="full_post">
                        <div class="full_post_content">
                            <?php echo $beat['long_description']; ?>
                            <br />
                            <div class="full_post_footer">
                                <div class="full_post_author_image" style="background-image:url('<?php echo $beat['main_image_url']; ?>');"></div>
                                <div class="full_post_subtitle" style="float:left;">by<br /><?php echo $beat['seller']; ?></div>
                                <a href="https://www.pinterest.com/pin/create/button/?url=<?php echo $beat_url; ?>&media=<?php echo $beat['tall_image_url']; ?>&description=<?php echo urlencode($beat['title']); ?>" target="_blank" data-pin-do="buttonPin" data-pin-config="above">
                                    <i class="fab fa-pinterest full_post_footer_button"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($beat['title']); ?>&url=<?php echo $beat_url; ?>&via=kgthemaker" target="_blank"><i class="fab fa-twitter full_post_footer_button"></i></a>
                                <i class="fab fa-facebook full_post_footer_button" onclick="shareUrlToFacebook(this, '<?php echo $beat_url; ?>');"></i>
                            </div>
                        </div>
                        <div class="fb-comments" data-href="<?php echo $beat_url; ?>" data-width="100%" data-numposts="10" data-colorscheme="light"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/js/main.php'; ?>
	</body>
</html>