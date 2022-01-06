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
    } else {
        $_SESSION['is_exists'] = true;
    }
    $q = null;
}

$db = null;

header("Location: task_9.php");
?>