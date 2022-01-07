<?php
session_start();

$form_file = 'task_15.php';
$images_table = 'task_15_images';
$errors = false;

$db = new PDO('mysql:host=mysql;dbname=marlin;charset=utf8','root','3312', [PDO::ERRMODE_EXCEPTION => true]);

if(!empty($_FILES['image'])) {
    $file_data = $_FILES['image'];
    if ($file_data['error'] == '0') {
        $file_info = pathinfo($file_data['name']);

        $new_image_name = time() . '.' . $file_info['extension'];
        $image_dir_path_short = 'gallery';
        $image_dir_path_full = __DIR__ . '/' . $image_dir_path_short;

        if(!is_dir($image_dir_path_full))
            mkdir($image_dir_path_full, 0777);

        $image_path_full = $image_dir_path_full . '/' . $new_image_name;
        move_uploaded_file($file_data['tmp_name'], $image_path_full);

        if(!is_file($image_path_full)){
            $errors = true;
            $_SESSION['msg']['code'] = 'danger';
            $_SESSION['msg']['text'] = 'Ошибка загрузки файла';
        } else {
            $sql = "INSERT INTO `" . $images_table . "` SET `image` = '" . $new_image_name . "'";
            $q = $db->prepare($sql);
            $q->bindParam(':image', $new_image_name);
            $q->execute();
        }

        if(!$errors) {
            $_SESSION['msg']['code'] = 'success';
            $_SESSION['msg']['text'] = 'Картинка добавлена';
        }
    } else {
        $errors = true;
        $_SESSION['msg']['code'] = 'danger';
        $_SESSION['msg']['text'] = 'Ошибка. Возможно, не выбрана картинка';
    }
} else {
    $_SESSION['msg']['code'] = 'warning';
    $_SESSION['msg']['text'] = 'Нужно выбрать картинку';
}

$db = null;

header("Location: " . $form_file);