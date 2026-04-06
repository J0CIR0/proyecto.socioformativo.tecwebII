<?php
declare(strict_types=1);

use Cake\Core\Container;
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Identifier\IdentifierInterface;
use Authentication\Identifier\PasswordIdentifier;
use Authentication\Middleware\AuthenticationMiddleware;
use Cake\Http\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;

class AuthenticationServiceProvider implements AuthenticationServiceProviderInterface
{
    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        $service = new AuthenticationService();
        
        $service->setConfig([
            'identityClass' => 'App\Model\Entity\User',
            'fields' => [
                'username' => 'correo',
                'password' => 'password',
            ],
        ]);
        
        $service->loadIdentifier('Authentication.Password', [
            'resolver' => [
                'className' => 'Authentication.Orm',
                'userModel' => 'Users',
            ],
        ]);
        
        $service->loadAuthenticator('Authentication.Session');
        $service->loadAuthenticator('Authentication.Form', [
            'loginUrl' => '/login',
        ]);
        
        return $service;
    }
}
