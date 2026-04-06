<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity
{
    protected array $accessible = [
        'name' => true,
        'last_name' => true,
        'correo' => true,
        'password' => true,
        'telefono' => true,
        'idioma' => true,
        'rol' => true,
        'created' => true,
        'modified' => true,
        'autos' => true,
    ];
    
    protected array $_hidden = ['password'];
    
    public function isAdmin(): bool
    {
        return $this->rol === 'admin';
    }

    protected function _setPassword(?string $password): ?string
    {
        if ($password === null || $password === '') {
            return $password;
        }

        return (new DefaultPasswordHasher())->hash($password);
    }
}
