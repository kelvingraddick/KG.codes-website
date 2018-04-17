<?php
    $path = ltrim($_SERVER['REQUEST_URI'], '/');
    $elements = explode('/', $path);
    if (empty($elements[0]) || $elements[0] !== 'blog' || empty($elements[1])) {
        include($_SERVER['DOCUMENT_ROOT']);
    } else {
        $_GET['slug'] = $elements[1];
        include($_SERVER['DOCUMENT_ROOT'].'/blog/post.php');
    }
?>