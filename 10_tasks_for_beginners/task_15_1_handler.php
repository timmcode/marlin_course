<?php
session_start();

$form_file = 'task_15.php';

function deleteImage()
{
    $images_table = 'task_15_images';
    $errors = [];

    $db = new PDO('mysql:host=mysql;dbname=marlin;charset=utf8', 'root', '3312', [PDO::ERRMODE_EXCEPTION => true]);

    if (!empty($_GET['id'])) {
        $image_id = (int)$_GET['id'];

        $sql = "SELECT * FROM `" . $images_table . "` WHERE `id` = '" . $image_id . "'";
        $q = $db->prepare($sql);
        $q->execute();
        $q_results = $q->fetch(PDO::FETCH_ASSOC);

        if (!$q_results)
            return([
                'code' => 'warning',
                'text' => 'Отсутствует запись в БД']);

        $image_path_full = __DIR__ . '/gallery/' . $q_results['image'];

        if(!is_file($image_path_full))
            $errors[] = 'Файл изображения не найден';

        $sql = "DELETE FROM `" . $images_table . "` WHERE `id` = '" . $image_id . "'";
        $q = $db->prepare($sql);
        $q->execute();

        return([
            'code' => $errors ? 'warning' : 'success',
            'text' => 'Изображение удалено.' . (($errors) ? ' ' . join(' ', $errors) : '')]);

    } else {
        return([
            'code' => 'warning',
            'text' => 'Отсутствует ID изображения']);
    }
}

$db = null;

$_SESSION['msg'] = deleteImage();

header("Location: " . $form_file);