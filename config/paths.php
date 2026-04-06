<?php
declare(strict_types=1);

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}
if (!defined('APP_DIR')) {
    define('APP_DIR', 'src');
}
if (!defined('WEBROOT_DIR')) {
    define('WEBROOT_DIR', 'webroot');
}
if (!defined('TESTS')) {
    define('TESTS', ROOT . DS . 'tests' . DS);
}
if (!defined('APP')) {
    define('APP', ROOT . DS . APP_DIR . DS);
}
if (!defined('CAKE_CORE_INCLUDE_PATH')) {
    define('CAKE_CORE_INCLUDE_PATH', ROOT . DS . 'vendor' . DS . 'cakephp' . DS . 'cakephp');
}
if (!defined('CORE_PATH')) {
    define('CORE_PATH', CAKE_CORE_INCLUDE_PATH . DS);
}
if (!defined('CAKE')) {
    define('CAKE', CORE_PATH . 'src' . DS);
}
if (!defined('CONFIG')) {
    define('CONFIG', ROOT . DS . 'config' . DS);
}
if (!defined('WWW_ROOT')) {
    define('WWW_ROOT', ROOT . DS . WEBROOT_DIR . DS);
}
if (!defined('LOGS')) {
    define('LOGS', ROOT . DS . 'logs' . DS);
}
if (!defined('TMP')) {
    define('TMP', ROOT . DS . 'tmp' . DS);
}
if (!defined('CACHE')) {
    define('CACHE', TMP . 'cache' . DS);
}
if (!defined('RESOURCES')) {
    define('RESOURCES', ROOT . DS . 'resources' . DS);
}
