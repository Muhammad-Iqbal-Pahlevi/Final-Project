<?php

require_once __DIR__ . '/../Model/Model.php';
require_once __DIR__ . '/../Model/Category.php';

$id = $_GET['id'];

$categories = new Category();
$categories= $categories->delete($id);

if(isset($id)){
    header("Location: ../Views/index-category.php");
}