<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    public array $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'null' => false, 'autoIncrement' => true],
        'name' => ['type' => 'string', 'length' => 100, 'null' => true],
        'last_name' => ['type' => 'string', 'length' => 100, 'null' => true],
        'correo' => ['type' => 'string', 'length' => 250, 'null' => true],
        'created' => ['type' => 'datetime', 'null' => true],
        'modified' => ['type' => 'datetime', 'null' => true],
        'password' => ['type' => 'string', 'length' => 255, 'null' => true],
        'phone' => ['type' => 'string', 'length' => 20, 'null' => true],
        'rol' => ['type' => 'string', 'length' => 20, 'null' => true],
        'idioma' => ['type' => 'string', 'length' => 10, 'null' => true],
        'telefono' => ['type' => 'string', 'length' => 20, 'null' => true],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']],
            'correo_unique' => ['type' => 'unique', 'columns' => ['correo']],
        ],
    ];

    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Admin',
                'last_name' => 'Tester',
                'correo' => 'admin@example.com',
                'created' => '2026-04-02 06:49:01',
                'modified' => '2026-04-02 06:49:01',
                'password' => '$2y$10$AaV4xa7NlsY7v8sJ5m2fDeYNpH31xjNwmMCPJgCOuK7yhU9PAot1K',
                'rol' => 'admin',
                'idioma' => 'es_ES',
                'telefono' => '70000000',
                'phone' => null,
            ],
        ];
        parent::init();
    }
}
