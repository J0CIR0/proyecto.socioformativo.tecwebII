<?php
declare(strict_types=1);

return [
    'Authentication' => [
        'identityAttribute' => 'identity',
        'unauthenticatedRedirect' => '/login',
        'queryParam' => 'redirect',
        'identityClass' => 'App\Model\Entity\User',
        'authError' => 'Debes iniciar sesion para acceder.',
    ],
];
