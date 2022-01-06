<?php
session_start();
$form_file = 'task_12.php';

if(isset($_POST['text']))
    $_SESSION['msg'] = (isset($_SESSION['msg'])) ? $_SESSION['msg'] . ' & ' . $_POST['text'] : $_POST['text'];

header("Location: " . $form_file);
?>