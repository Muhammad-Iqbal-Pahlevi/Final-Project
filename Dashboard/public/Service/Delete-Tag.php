<?php

require_once __DIR__ . '/../Model/Model.php';
require_once __DIR__ . '/../Model/Tags.php';

$id = $_GET['id'];

$tags = new Tags();
$tags= $tags->delete($id);

if(isset($id)){
    header("Location: ../Views/Index-Tags.php");
}