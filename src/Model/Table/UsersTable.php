<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('users');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('Autos', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('name', 'El nombre es requerido')
            ->notEmptyString('last_name', 'El apellido es requerido')
            ->email('correo')
            ->notEmptyString('correo', 'El email es requerido')
            ->notEmptyString('password', 'La contrasena es requerida')
            ->add('password', [
                'length' => [
                    'rule' => ['minLength', 5],
                    'message' => 'La contrasena debe tener al menos 5 caracteres'
                ]
            ])
            ->notEmptyString('rol', 'El rol es requerido')
            ->add('rol', 'inList', [
                'rule' => ['inList', ['admin', 'user']],
                'message' => 'Rol no valido'
            ]);
        
        return $validator;
    }
}

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        if ($entity->isNew() && $entity->password) {
            $entity->password = password_hash($entity->password, PASSWORD_DEFAULT);
        }
        return true;
    }
