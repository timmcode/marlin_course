<?php
session_start();
$base = basename(__FILE__);

$db = new PDO('mysql:host=mysql;dbname=marlin;charset=utf8','root','3312', [PDO::ERRMODE_EXCEPTION => true]);

if(!empty($_POST['text'])) {
    $text = $_POST['text'];

    $sql = "SELECT * FROM task_8_users WHERE `uname` = :uname";
    $q = $db->prepare($sql);
    $q->bindParam(':uname', $text);
    $q->execute();
    $is_exists = $q->fetch(PDO::FETCH_ASSOC);

    if(!$is_exists) {
        $sql = "INSERT INTO task_8_users VALUES (null,:fname,:lname,:uname)";
        $q = $db->prepare($sql);
        $q->bindParam(':fname', $text);
        $q->bindParam(':lname', $text);
        $q->bindParam(':uname', $text);
        $q->execute();

        $_SESSION['msg']['code'] = 'success';
        $_SESSION['msg']['text'] = 'Запись добавлена';
    } else {
        $_SESSION['msg']['code'] = 'danger';
        $_SESSION['msg']['text'] = 'Запись уже существует';
    }
    $q = null;
} else {
    $_SESSION['msg']['code'] = 'warning';
    $_SESSION['msg']['text'] = 'Нужно ввести данные';
}

$db = null;

header("Location: task_10.php");
?>