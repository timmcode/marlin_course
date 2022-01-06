<?php
session_start();
$form_file = 'task_11.php';
$users_table = 'task_11_users';

$db = new PDO('mysql:host=mysql;dbname=marlin;charset=utf8','root','3312', [PDO::ERRMODE_EXCEPTION => true]);

if(!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "SELECT * FROM `" . $users_table . "` WHERE `email` = '" . $email . "'";
    $q = $db->prepare($sql);
    $q->bindParam(':email', $email);
    $q->bindParam(':password', $password);
    $q->execute();
    $is_exists = $q->fetch(PDO::FETCH_ASSOC);

    if(!$is_exists) {
        $sql = "INSERT INTO `" . $users_table . "` SET `email` = '" . $email . "', `password` = '" . $password . "'";
        $q = $db->prepare($sql);
        $q->bindParam(':email', $text);
        $q->bindParam(':password', $text);
        $q->execute();

        $_SESSION['msg']['code'] = 'success';
        $_SESSION['msg']['text'] = 'Запись добавлена';
    } else {
        $_SESSION['msg']['code'] = 'danger';
        $_SESSION['msg']['text'] = 'Этот эл адрес уже занят другим пользователем';
    }
    $q = null;
} else {
    $_SESSION['msg']['code'] = 'warning';
    $_SESSION['msg']['text'] = 'Нужно заполнить оба поля';
}

$db = null;

header("Location: " . $form_file);
?>