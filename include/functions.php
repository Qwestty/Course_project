<?php
include 'config.php';

function get_url($pages = '') {
    return HOST . "/include/$pages";
}
function out_url($pages = '') {
    return HOST . "/pages/$pages";
}
function register(){
    header("Location:../include/register.php");
    exit();
}
function db() {
    try {
        return new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=utf8", DB_USER, DB_PASS, [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function db_query($sql = ''){
    if (empty($sql)) return false;
    return db()->query($sql);
}
function get_product(): array
{
    $res = db_query("SELECT * FROM training_card");
    return $res->fetchAll();
}
function get_user_info($login){
    if (empty($login)) return [];
    return db_query("SELECT * FROM `users` WHERE `login` = '$login';")->fetch();
}
function get_products_into($name){
    if (empty($name)) return[];

    return db_query("SELECT * FROM `products` WHERE `name` = '$name';")->fetch();
}

function add_user($login, $pass, $name, $date){
    $password = password_hash($pass, PASSWORD_DEFAULT);
    return db_query("INSERT INTO `users` (`id`, `login`, `pass`, `name`,`date`) VALUES (NULL, '$login', '$password','$name','$date');", true);
}

function register_user($auth_data){
    if (empty($auth_data) || !isset($auth_data['login']) || empty($auth_data['login']) || !isset($auth_data['pass']) || !isset($auth_data
            ['pass2'])) return false;

    $user = get_user_info($auth_data['login']);
    if (!empty($user)){
        $_SESSION['error'] = "Пользователь '" . $auth_data['login'] . "' уже существует!";
        header('Location: register.php');
        die;
    }
    if ($auth_data['pass'] !== $auth_data['pass2']){
        $_SESSION['error'] = "Пароли не совпадают!";
        header('Location: register.php');
        die;
    }
    if (add_user($auth_data['login'],$auth_data['pass'],$auth_data['name'],$auth_data['date'])){
        $_SESSION['success'] = "Регистрация прошла успешно!";
        header('Location: login.php');
        die;
    }
    return true;
}
function login($auth_data){
    if (empty($auth_data) || !isset($auth_data['login']) || empty($auth_data['login']) || !isset($auth_data['pass']) || empty($auth_data['pass'])) {
        $_SESSION['error'] = "Логин или пароль не может быть пустым";
        header('Location: login.php');
        die;
    }
    $user = get_user_info($auth_data['login']);
    if (empty($user)) {
        $_SESSION['error'] = "Логин или пароль неверный!";
        header('Location: login.php');
        die;
    }
    if (password_verify($auth_data['pass'], $user['pass'])) {
        $_SESSION['user'] = $user;
        header('Location: ../pages/index.php');
        $_SESSION['success'] = "Вы успешно вошли в систему!";
        die;
    }else{
        $_SESSION['error'] = "Пароль неверный!";
        header('Location: login.php');
        die;
    }
}

function get_training_card(): array
{
    $res = db_query("SELECT * FROM training_card");
    return $res->fetchAll();
}
function get_trainer_card(): array
{
    $res = db_query("SELECT * FROM `users` WHERE `role` = 1;");
    return $res->fetchAll();
}
function get_faq_card(): array
{
    $res = db_query("SELECT * FROM faq_card");
    return $res->fetchAll();
}

function get_user($id){
    if (empty($id)) return [];
    return db_query("SELECT * FROM `users` WHERE `id` = '$id';")->fetch();
}

function edit_profile($id, $login, $name, $date, $description, $img){

    if (empty($id)){
        return false;
    }
    $product = get_user($id);

    if (empty($login)){
        $login = $product['login'];
    }
    if (empty($name)){
        $name = $product['$name'];
    }
    if (empty($date)){
        $date = $product['$date'];
    }

    return db_query("UPDATE `users` SET `login` = '$login', `name` = '$name', `date` = '$date', `description` = '$description', `img` = '$img' WHERE `id` = '$id';", true);
}

function add_products($training_img, $training_name, $training_description, $training_text) {
    return db_query("INSERT INTO training_card (id, training_img, training_name, training_description, training_text)
    VALUES (NULL, '$training_img' ,'$training_name', '$training_description', '$training_text');", true);
}

function get_goods($enter_data) {
    if (empty($enter_data) || !isset($enter_data['training_name'])
        || empty($enter_data['training_description'])) return false;


    get_goods($_GET['id']);
    $_SESSION['success'] = "Программа успешно добавлена!";
    header('Location: ../pages/index.php');


    add_products($enter_data['training_img'], $enter_data['training_name'],$enter_data['training_description'], $enter_data['training_text']);

    return true;
}

function buy_product($id_card, $id_users) {
    return db_query("INSERT INTO orders (id, id_card, id_users)
    VALUES (NULL, '$id_card','$id_users');", true);
}

function get_product_info($id){
    if (empty($id)) return[];
    return db_query("SELECT * FROM training_card WHERE id = '$id';")->fetch();
}

function get_trainer_info($id){
    if (empty($id)) return[];
    return db_query("SELECT * FROM users WHERE id = '$id';")->fetch();
}

function get_orders($id_users)
{
    $res = db_query("SELECT * FROM orders WHERE id_users = '$id_users'");
    $orders =  $res->fetchAll();
    $orders_array = [];
    foreach ($orders as $order) {
        $product = get_product_info($order['id_card']);
        $orders_array[] = $product;
    }
    return $orders_array;
}
function get_comment_info($id){
    if (empty($id)) return[];
    return db_query("SELECT * FROM users WHERE id = '$id';")->fetch();
}
function post_comment($id_trainer, $comment, $time, $login) {
    return db_query("INSERT INTO comments (id, id_trainer, comment, time, login)
    VALUES (NULL, '$id_trainer','$comment', '$time', '$login');", true);
}
function get_comment($id_users)
{
    $res = db_query("SELECT * FROM comments WHERE id_trainer = '$id_users'");
    $orders =  $res->fetchAll();
    return $orders;
}
function delete_order($id_card) {
    if (empty($id_card)) return false;
    return db_query("DELETE FROM orders WHERE id_card = $id_card;", true);
}
