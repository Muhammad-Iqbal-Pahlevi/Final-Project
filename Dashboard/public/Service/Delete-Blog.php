<?php

require_once __DIR__ . '/../Model/Model.php';
require_once __DIR__ . '/../Model/Post.php';

$id = $_GET["id"];
$posts = new Post();
if (isset($id)) {
    $posts = $posts->delete($id);
    if ($posts) {
        header("Location: ../Views/Index-Blog.php");
    }
}