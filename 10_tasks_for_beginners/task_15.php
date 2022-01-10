<?php
session_start();
$form_action_add_file = 'task_15_handler.php';
$delete_file = 'task_15_1_handler.php';

$images_table = 'task_15_images';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        Задание 15 - Загрузка изображений
    </title>
    <meta name="description" content="Chartist.html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
    <link rel="stylesheet" media="screen, print" href="css/statistics/chartist/chartist.css">
    <link rel="stylesheet" media="screen, print" href="css/miscellaneous/lightgallery/lightgallery.bundle.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-regular.css">
</head>
<body class="mod-bg-1 mod-nav-link ">
<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-md-6">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Задание 15 - Загрузка изображений
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-content">
                            <div class="form-group">
                                <?php if(isset($_SESSION['msg']['code'])){ ?>
                                    <div class="alert alert-<?=$_SESSION['msg']['code']?> fade show" role="alert">
                                        <?=$_SESSION['msg']['text']?>
                                    </div>
                                <?php } ?>

                                <form action="<?=$form_action_add_file?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput_1">Image Multiupload</label>
                                        <input enctype="multipart/form-data" type="file" id="simpleinput_1" class="form-control" name="image[]" multiple >
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput_2">Image</label>
                                        <input type="file" id="simpleinput_2" class="form-control" name="image[]">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput_3">Image</label>
                                        <input type="file" id="simpleinput_3" class="form-control" name="image[]">
                                    </div>
                                    <button class="btn btn-success mt-3">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Загруженные картинки
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <?php
                $db = new PDO('mysql:host=mysql;dbname=marlin;charset=utf8','root','3312', [PDO::ERRMODE_EXCEPTION => true]);

                $sql = "SELECT * FROM `" . $images_table . "`";
                $q = $db->prepare($sql);
                $q->execute();
                $q_results = $q->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-content image-gallery">
                            <div class="row">
                                <?php foreach ($q_results as $image) { ?>
                                    <div class="col-md-3 image">
                                        <img src="gallery/<?=$image['image']?>">
                                        <a class="btn btn-danger" href="<?=$delete_file?>?id=<?=$image['id']?>" onclick="confirm('Вы уверены?');">Удалить</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>


<script src="js/vendors.bundle.js"></script>
<script src="js/app.bundle.js"></script>
<script>
    // default list filter
    initApp.listFilter($('#js_default_list'), $('#js_default_list_filter'));
    // custom response message
    initApp.listFilter($('#js-list-msg'), $('#js-list-msg-filter'));
</script>
</body>
</html>
<?php
if(isset($_SESSION['msg'])) {
    unset($_SESSION['msg']);
}
?>