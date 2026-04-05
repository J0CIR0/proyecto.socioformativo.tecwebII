<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsersAndProfiles extends AbstractMigration
{
    public function change(): void
    {
        // Tabla users (si no existe)
        if (!$this->hasTable('users')) {
            $table = $this->table('users');
            $table->addColumn('correo', 'string', ['limit' => 255, 'null' => false])
                  ->addColumn('password', 'string', ['limit' => 255, 'null' => false])
                  ->addColumn('created', 'datetime', ['null' => true])
                  ->addColumn('modified', 'datetime', ['null' => true])
                  ->addIndex(['correo'], ['unique' => true])
                  ->create();
        }

        // Tabla profiles
        $table = $this->table('profiles');
        $table->addColumn('user_id', 'integer', ['null' => false])
              ->addColumn('nombre', 'string', ['limit' => 100, 'null' => true])
              ->addColumn('apellido', 'string', ['limit' => 100, 'null' => true])
              ->addColumn('idioma', 'string', ['limit' => 10, 'default' => 'es_ES'])
              ->addColumn('created', 'datetime', ['null' => true])
              ->addColumn('modified', 'datetime', ['null' => true])
              ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE'])
              ->create();
    }
}
