<?php
$base_url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$output = '';

foreach (scandir(__DIR__) as $dir_item)
    if(!in_array($dir_item, ['.','..','index.php','.idea', '.git', '.gitignore']))
        $output .= '<a href="' . $base_url . $dir_item . '">' . $dir_item . '</a>' . PHP_EOL;

$output = '<pre>' . $output;
$output .= '</pre>';

echo $output;