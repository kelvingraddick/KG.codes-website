<?php
    $path = ltrim($_SERVER['REQUEST_URI'], '/');
    $elements = explode('/', $path);
    if (!empty($elements[0]) && $elements[0] === 'blog' && !empty($elements[1])) {
        $_GET['slug'] = $elements[1];
        include($_SERVER['DOCUMENT_ROOT'].'/blog/post.php');
    } else if (!empty($elements[0]) && $elements[0] === 'beats' && !empty($elements[1])) {
        $_GET['slug'] = $elements[1];
        include($_SERVER['DOCUMENT_ROOT'].'/beats/beat.php');
    } else {
        include($_SERVER['DOCUMENT_ROOT']);
    }
?>