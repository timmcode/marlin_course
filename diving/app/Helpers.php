<?php

const DS = DIRECTORY_SEPARATOR;

function redirect($url){
    header('Location: ' . $url);
    exit;
}