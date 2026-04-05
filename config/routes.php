<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {

    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {

        // Página principal → users
        $builder->connect('/', ['controller' => 'Users', 'action' => 'index']);

        // Login y logout
        $builder->connect('/login', ['controller' => 'Users', 'action' => 'login']);
        $builder->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);

        $builder->fallbacks();
    });
};

// Rutas para Autos (después del scope existente)
$routes->scope('/autos', function ($builder) {
    $builder->connect('/', ['controller' => 'Autos', 'action' => 'index']);
    $builder->connect('/add', ['controller' => 'Autos', 'action' => 'add']);
    $builder->connect('/edit/{id}', ['controller' => 'Autos', 'action' => 'edit'], ['id' => '\d+', 'pass' => ['id']]);
    $builder->connect('/delete/{id}', ['controller' => 'Autos', 'action' => 'delete'], ['id' => '\d+', 'pass' => ['id']]);
    $builder->fallbacks();
});
