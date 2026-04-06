<?php
declare(strict_types=1);

namespace App\Auth;

use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthenticationServiceProvider implements AuthenticationServiceProviderInterface
{
    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        $service = new AuthenticationService();

        $service->setConfig([
            'identityClass' => 'App\\Model\\Entity\\User',
            'unauthenticatedRedirect' => '/login',
            'queryParam' => 'redirect',
        ]);
        
        $service->loadAuthenticator('Authentication.Session');
        $service->loadAuthenticator('Authentication.Form', [
            'loginUrl' => '/login',
            'fields' => [
                'username' => 'correo',
                'password' => 'password',
            ],
            'identifier' => [
                'Authentication.Password' => [
                    'resolver' => [
                        'className' => 'Authentication.Orm',
                        'userModel' => 'Users',
                    ],
                    'fields' => [
                        'username' => 'correo',
                        'password' => 'password',
                    ],
                ],
            ],
        ]);
        
        return $service;
    }
}
