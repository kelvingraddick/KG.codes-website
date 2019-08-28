<?php
    ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
    include $_SERVER['DOCUMENT_ROOT'].'/utility/common.php';

    $database_connection = connect_to_database();
    $setting = get_settings($database_connection);

    $type = $_POST['type'];
	
    if ($type != null && $type != "" && mysqli_query($database_connection, "INSERT INTO popeyesvschickfila (type) values('$type')")) {
        header("Location: /popeyesvschickfila/");
    } else {
        header("Location: /popeyesvschickfila/");
    }
?>