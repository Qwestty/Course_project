<?php

require_once 'functions.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: profile.php');
    die;
}

delete_order($_GET['id']);
$_SESSION['success'] = "Программа успешно удалена!";
header('Location: profile.php');
die;