<?php
session_start();
$form_file = 'task_13.php';

if(isset($_POST['push_count']))
    $_SESSION['push_count'] = (int)$_POST['push_count'] + 1;

header("Location: " . $form_file);
?>