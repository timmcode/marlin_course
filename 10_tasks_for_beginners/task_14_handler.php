<?php
session_start();
$form_file = 'task_14.php';
$users_table = 'task_11_users';

$db = new PDO('mysql:host=mysql;dbname=marlin;charset=utf8','root','3312', [PDO::ERRMODE_EXCEPTION => true]);

if(!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM `" . $users_table . "` WHERE `email` = '" . $email . "'";
    $q = $db->prepare($sql);
    $q->bindParam(':email', $email);
    $q->execute();
    $q_result = $q->fetch(PDO::FETCH_ASSOC);

    if($q_result) {
        if(password_verify($password, $q_result['password'])) {
            $_SESSION['user']['id'] = $q_result['id'];
            $_SESSION['user']['email'] = $email;
        } else {
            $_SESSION['msg']['code'] = 'danger';
            $_SESSION['msg']['text'] = 'Неверный пароль';
            $_SESSION['msg']['email'] = $email;
        }
    } else {
        $_SESSION['msg']['code'] = 'danger';
        $_SESSION['msg']['text'] = 'Этот эл адрес не найден';
    }
    $q = null;
} else {
    $_SESSION['msg']['code'] = 'warning';
    $_SESSION['msg']['text'] = 'Нужно заполнить оба поля';
}

$db = null;

header("Location: " . $form_file);
?>