<?php
declare(strict_types=1);

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {
    $routes->setRouteClass(DashedRoute::class);
    
    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/', ['controller' => 'Autos', 'action' => 'index']);
        $builder->connect('/login', ['controller' => 'Users', 'action' => 'login']);
        $builder->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);
        $builder->connect('/autos', ['controller' => 'Autos', 'action' => 'index']);
        $builder->connect('/autos/add', ['controller' => 'Autos', 'action' => 'add']);
        $builder->connect('/autos/edit/{id}', ['controller' => 'Autos', 'action' => 'edit'], ['id' => '\d+', 'pass' => ['id']]);
        $builder->connect('/autos/delete/{id}', ['controller' => 'Autos', 'action' => 'delete'], ['id' => '\d+', 'pass' => ['id']]);
        $builder->connect('/profiles/edit', ['controller' => 'Profiles', 'action' => 'edit']);
        $builder->connect('/profiles/language', ['controller' => 'Profiles', 'action' => 'language']);
        $builder->connect('/users', ['controller' => 'Users', 'action' => 'index']);
        $builder->connect('/users/view/{id}', ['controller' => 'Users', 'action' => 'view'], ['id' => '\d+', 'pass' => ['id']]);
        $builder->connect('/users/edit/{id}', ['controller' => 'Users', 'action' => 'edit'], ['id' => '\d+', 'pass' => ['id']]);
        $builder->connect('/users/delete/{id}', ['controller' => 'Users', 'action' => 'delete'], ['id' => '\d+', 'pass' => ['id']]);
        $builder->connect('/users/add', ['controller' => 'Users', 'action' => 'add']);
        
        $builder->fallbacks();
    });
};
