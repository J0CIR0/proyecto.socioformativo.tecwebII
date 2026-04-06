<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AutosTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('autos');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('marca', 'La marca es requerida')
            ->notEmptyString('modelo', 'El modelo es requerido')
            ->notEmptyString('tipo_combustible', 'El tipo de combustible es requerido');
        
        return $validator;
    }
}
