<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>
            Подготовительные задания к курсу
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
            <div class="col-md-6">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Задание
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        </div>
                    </div>
                    <?php
                    $list = [
                        [
                            'title' => [
                                'text'  => 'My Tasks',
                                'class' => 'mt-2',
                            ],
                            'value' => [
                                'text'          => '130 / 500',
                                'block_class'   => 'mb-3',
                                'bg_class'      => 'bg-fusion-400',
                                'width'         => '65',
                            ]
                        ],
                        [
                            'title' => [
                                'text'  => 'Transfered',
                                'class' => '',
                            ],
                            'value' => [
                                'text'          => '440 TB',
                                'block_class'   => 'mb-3',
                                'bg_class'      => 'bg-success-500',
                                'width'         => '34',
                            ]
                        ],
                        [
                            'title' => [
                                'text'  => 'Bugs Squashed',
                                'class' => 'mt-2',
                            ],
                            'value' => [
                                'text'          => '77%',
                                'block_class'   => 'mb-3',
                                'bg_class'      => 'bg-info-400',
                                'width'         => '77',
                            ]
                        ],
                        [
                            'title' => [
                                'text'  => 'User Testing',
                                'class' => 'mt-2',
                            ],
                            'value' => [
                                'text'          => '7 days',
                                'block_class'   => 'mb-g',
                                'bg_class'      => 'bg-primary-300',
                                'width'         => '84',
                            ]
                        ],
                    ];
                    ?>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <?php foreach ($list as $item) { ?>
                            <div class="d-flex <?=$item['title']['class']?>">
                                <?=$item['title']['text']?>
                                <span class="d-inline-block ml-auto"><?=$item['value']['text']?></span>
                            </div>
                            <div class="progress progress-sm <?=$item['value']['block_class']?>">
                                <div class="progress-bar <?=$item['value']['bg_class']?>" role="progressbar" style="width: <?=$item['value']['width']?>%;" aria-valuenow="<?=$item['value']['width']?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <?php } ?>
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
