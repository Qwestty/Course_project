<?php
require_once 'functions.php';
if (!isset($_SESSION['user']['id'])){
    header('Location: ');
    die;
}

$id = $_POST['id'];
edit_profile($id, $_POST['login'], $_POST['name'], $_POST['date'], $_POST['description'], $_POST['img']);
header('Location: profile.php');
die;