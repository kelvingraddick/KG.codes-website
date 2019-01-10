<?php

    function connect_to_database() {
		$database_connection = mysqli_connect($GLOBALS['database_host'],
							$GLOBALS['database_username'],
							$GLOBALS['database_password'],
							$GLOBALS['database_name'])
							or die("Cannot connect to database.");
		mysqli_set_charset($database_connection, "utf8mb4");
		return $database_connection;
	}

	function get_settings($database_connection) {
		$settings = mysqli_query($database_connection, "SELECT * FROM settings");
		if (!$settings) { echo 'Could not load settings data.'; exit; }
		$setting = array();
		while($row = mysqli_fetch_assoc($settings)) {
			$setting[$row['code']] = $row['value'];
		}
		return $setting;
    }
    
    function get_seo($database_connection, $page) {
        $seo = mysqli_fetch_assoc(mysqli_query($database_connection, "SELECT * FROM seo WHERE page = '$page'"));
        if (!$seo) { return; }
        return $seo;
    }
    
    function get_metatags($seo, $setting) {
        $metatags = <<< EOF
                    <title>{title}</title>
                    <meta name="description" content="{description}">
                    <meta name="keywords" content="{keywords}">
                    <meta name="author" content="{title}">
                    <meta name="robots" content="index, follow">
                    <meta property="fb:app_id" content="361862767338317" />
                    <meta property="og:description" content="{description}" />
                    <meta property="og:image" content="{logo}" />
                    <meta property="og:title" content="{title}" />
                    <meta property="og:url" content="{url}" />
                    <meta property="og:site_name" content="KG The Maker" />
                    <meta property="og:type" content="article" />
                    <meta property="article:author" content="KG The Maker" />
                    <meta name="twitter:card" content="summary_large_image">
                    <meta name="twitter:site" content="{twitter}">
                    <meta name="twitter:creator" content="{twitter}">
                    <meta name="twitter:title" content="{title}">
                    <meta name="twitter:description" content="{description}">
                    <meta name="twitter:image:src" content="{logo}">
EOF;
        $metatags = str_replace("{title}", $seo['title'], $metatags);
        $metatags = str_replace("{description}", $seo['description'], $metatags); 
        $metatags = str_replace("{keywords}", $seo['keywords'], $metatags);
        $metatags = str_replace("{logo}", "https://www.kgthemaker.com/images/background-yellow.png", $metatags);
        $metatags = str_replace("{url}", "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $metatags);
        $metatags = str_replace("{twitter}", $setting['twitter_link'], $metatags);
        return $metatags;
    }

    function clean_quotes($string) {
        return str_replace('"', '&quot;', $string);
    }

	function mysqli_result($mysqli, $sql) {
		$result = $mysqli->query($sql);
		$value = $result->fetch_array(MYSQLI_NUM);
		return is_array($value) ? $value[0] : "";
    }

    function get_time_to_read($html) {
        $word_count = str_word_count(strip_tags($html));
        $minutes = floor($word_count / 200);
        $seconds = floor($word_count % 200 / (200 / 60));
        return ($minutes == 0 ? $seconds." second" : $minutes." minute")." read";
    }
    
?>