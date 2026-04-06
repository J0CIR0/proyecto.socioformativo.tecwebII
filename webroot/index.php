<?php
if (PHP_SAPI === 'cli-server') {
    $_SERVER['PHP_SELF'] = '/' . basename(__FILE__);

    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $file = __DIR__ . ($url ?: '');
    if ($url && is_file($file)) {
        return false;
    }
}

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}
define('APP_DIR', 'src');
define('WEBROOT_DIR', 'webroot');
define('WWW_ROOT', ROOT . DS . WEBROOT_DIR . DS);

require ROOT . '/vendor/autoload.php';

$app = require ROOT . '/config/bootstrap.php';

if (!is_object($app)) {
    die('Error: bootstrap.php no retornó una aplicación válida.');
}

$server = new \Cake\Http\Server($app);
$server->emit($server->run());
