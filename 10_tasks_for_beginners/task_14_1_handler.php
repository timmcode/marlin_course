<?php
session_start();
$form_file = 'task_14_1.php';

if(isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}

header("Location: " . $form_file);
?>