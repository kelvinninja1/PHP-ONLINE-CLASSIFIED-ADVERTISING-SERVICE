<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEWS_PATH', ROOT . DS . 'views');

define('PRELINK',substr($_SERVER['PHP_SELF'], strpos($_SERVER['PHP_SELF'], "/project"), strpos($_SERVER['PHP_SELF'], "webroot/index.php")-strpos($_SERVER['PHP_SELF'], "/project")));//префикс для внутренних ссылок, чтобы не зависеть от расположения каталога сайта относительно базового каталога
//echo PRELINK."-".$_SERVER['PHP_SELF']."--".strpos($_SERVER['PHP_SELF'], "webroot/index.php");die;
//die(PRELINK);
require_once(ROOT . DS . 'lib' . DS . 'init.php');

try {
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    App::run($_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    echo $e->getMessage();
//    Router::redirect(PRELINK);
}

