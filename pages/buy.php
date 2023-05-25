<?php
require_once '../include/functions.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    die;
}

buy_product($_GET['id'], $_SESSION['user']['id']);
$_SESSION['success'] = "Программа добавлена в корзину!";
header('Location: index.php');
die;