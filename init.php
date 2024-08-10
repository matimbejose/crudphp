<?php
    define('ROOT_PATH', __DIR__ . '/');
    define('WEB_ROOT', str_replace($_SERVER['DOCUMENT_ROOT'], '', ROOT_PATH));
    define('ASSETS_PATH', WEB_ROOT . 'assets/');
    define('MODULO', trim($_SERVER['REQUEST_URI'], '/'));

    if($_SERVER['HTTP_HOST'] == 'localhost'){
        define('HOST','http://'. $_SERVER['HTTP_HOST'].':8080/');
    }else{
        define('HOST', 'https://'.$_SERVER['HTTP_HOST'].'/');
    }
    