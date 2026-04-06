<?php
declare(strict_types=1);

require __DIR__ . '/paths.php';
require CAKE . 'functions.php';

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Database\Connection;
use Cake\Database\Driver\Mysql;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;
use Cake\Utility\Security;
use App\Application;

date_default_timezone_set('UTC');

Configure::write('debug', true);

Configure::write('App', [
    'namespace' => 'App',
    'encoding' => 'UTF-8',
    'defaultLocale' => 'es_ES',
    'defaultTimezone' => 'UTC',
    'base' => false,
    'dir' => 'src',
    'webroot' => 'webroot',
    'wwwRoot' => WWW_ROOT,
    'fullBaseUrl' => 'http://172.25.0.208:8765',
    'imageBaseUrl' => 'img/',
    'cssBaseUrl' => 'css/',
    'jsBaseUrl' => 'js/',
    'paths' => [
        'plugins' => [ROOT . DS . 'plugins' . DS],
        'templates' => [ROOT . DS . 'templates' . DS],
        'locales' => [RESOURCES . 'locales' . DS],
    ],
]);

Security::setSalt('f903b8d983a02756153e1d92c5d3bae46f54d93e81fe22bb7110cdcdee6083b9');

Cache::setConfig([
    '_cake_core_' => [
        'className' => 'File',
        'path' => CACHE . 'persistent' . DS,
        'serialize' => true,
        'duration' => '+1 years',
    ],
    '_cake_translations_' => [
        'className' => 'File',
        'path' => CACHE . 'persistent' . DS,
        'serialize' => true,
        'duration' => '+1 years',
    ],
    '_cake_model_' => [
        'className' => 'File',
        'path' => CACHE . 'models' . DS,
        'serialize' => true,
        'duration' => '+1 years',
    ],
]);

ConnectionManager::setConfig('default', [
    'className' => Connection::class,
    'driver' => Mysql::class,
    'persistent' => false,
    'host' => '172.25.0.208',
    'username' => 'root',
    'password' => 'Josue123',
    'database' => 'db_ef',
    'timezone' => 'UTC',
    'encoding' => 'utf8mb4',
    'cacheMetadata' => true,
    'quoteIdentifiers' => false,
    'log' => false,
]);

ConnectionManager::setConfig('test', [
    'className' => Connection::class,
    'driver' => Mysql::class,
    'persistent' => false,
    'host' => '172.25.0.208',
    'username' => 'root',
    'password' => 'Josue123',
    'database' => 'db_ef_test',
    'timezone' => 'UTC',
    'encoding' => 'utf8mb4',
    'cacheMetadata' => true,
    'quoteIdentifiers' => false,
    'log' => false,
]);

Router::defaultRouteClass(\Cake\Routing\Route\DashedRoute::class);
Router::reload();
require CONFIG . 'routes.php';

return new Application(CONFIG);
