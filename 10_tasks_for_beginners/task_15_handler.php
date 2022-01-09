<?php
session_start();

const form_file = 'task_15.php';
const images_table = 'task_15_images';

function addImage2DB($new_image_name)
{
    $db = new PDO('mysql:host=mysql;dbname=marlin;charset=utf8','root','3312', [PDO::ERRMODE_EXCEPTION => true]);

    $sql = "INSERT INTO `" . images_table . "` SET `image` = '" . $new_image_name . "'";
    $q = $db->prepare($sql);
    $q->bindParam(':image', $new_image_name);
    $q->execute();

    $db = null;
}

function saveImages($data)
{
    $errors = [];
    $files_data = [];

    if(!is_array($data['name'])) {
        foreach ($data as $file_param_name => $file_param_value)
            $files_data[0][$file_param_name] = $file_param_value;
    } else
        $files_data = $data;

    foreach ($files_data['name'] as $file_key => $file_name){
        if ($files_data['error'][$file_key] == '0') {
            $file_info = pathinfo($files_data['name'][$file_key]);

            $new_image_name = md5(microtime()) . '.' . $file_info['extension'];
            $image_dir_path_short = 'gallery';
            $image_dir_path_full = __DIR__ . '/' . $image_dir_path_short;

            if(!is_dir($image_dir_path_full))
                mkdir($image_dir_path_full, 0777);

            $image_path_full = $image_dir_path_full . '/' . $new_image_name;
            move_uploaded_file($files_data['tmp_name'][$file_key], $image_path_full);

            if(!is_file($image_path_full)){
                $errors[$file_key] = 'Ошибка загрузки файла в хранилище';
            } else {
                addImage2DB($new_image_name);
            }
        } else {
            if($files_data['error'][$file_key] == 4 && $files_data['name'][$file_key] == '')
                continue;

            $errors[$file_key] = 'Ошибка. Возможно, не выбрана картинка';
        }
    }

    return compact('errors');
}

if(!empty($_FILES['image']['name'])) {
    $result = saveImages($_FILES['image']);

    if(empty($result['errors'])) {
        $_SESSION['msg']['code'] = 'success';
        $_SESSION['msg']['text'] = 'Картинки добавлена';
    } else {
        $_SESSION['msg']['code'] = 'warning';
        $_SESSION['msg']['text'] = 'Возникли проблемы при загрузке изображений!' . PHP_EOL;
        foreach ($result['errors'] as $error_key => $error_text)
            $_SESSION['msg']['text'] .= 'Файл: ' . $_FILES['image']['name'][$error_key] . '. Ошибка: ' . $error_text . PHP_EOL;
    }
} else {
    $_SESSION['msg']['code'] = 'warning';
    $_SESSION['msg']['text'] = 'Нужно выбрать картинки';
}


header("Location: " . form_file);